<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;
use App\Post;
use App\Category;
use Session;
use Auth;
use File;

class PostController extends Controller
{
    public function index(){
        $posts = Post::paginate(10);

        return view('post.index')->with('posts', $posts);
    }

    public function show($id){
        $post = Post::find($id);

        return view('post.detail')->with('post', $post);
    }

    public function edit($id){

        $post = Post::findOrNew($id);

        $categorias = Category::lists('name', 'id')->all();

        return view('post.edit')->with('post', $post)->with('categorias', $categorias);
    }

    public function update(Request $request, $id){

        $post = Post::find($id);



        if($post->title == $request["title"]){
            $regras = array(
                'title' => 'required|string|max:100',
                'content' => 'required|string|max:100000',
                'feature_img' => 'max:5120|mimes:jpeg,png,gif,bmp',
                'id_category' => 'required'
            );
        }else{
            $regras = array(
                'title' => 'required|string|max:100|unique:post',
                'content' => 'required|string|max:100000',
                'feature_img' => 'max:5120|mimes:jpeg,png,gif,bmp',
                'id_category' => 'required'
            );
        }

        $mensagens = array(
            'required' => 'O campo :attribute deve ser preenchido.',
            'max' => 'O campo :attribute pode ter no máximo :max caracteres.',
            'name.unique' => 'A post digitado já existe'
        );

        $validator = Validator::make($request->all(), $regras, $mensagens);

        if ($validator->fails()) {
            return redirect('dashboard/post/'.$id.'/edit')
                ->withErrors($validator)
                ->withInput();
        }

        if($request->hasFile('feature_img') && !$request->file('feature_img')->isValid()){
            $validator->errors()->add('feature_img', 'Ocorreu um erro com a imagem.');
            return redirect('dashboard/post/'.$id.'/edit')
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->hasFile('feature_img')) {
            $imageName = md5(uniqid()).'.'.$request->file('feature_img')->getClientOriginalExtension();
            $destinationPath = base_path().'/public/images/post/';
            $request->file('feature_img')->move($destinationPath, $imageName);

            File::delete($destinationPath.$post->feature_img);

            $post->feature_img = $imageName;
        }


        $post->title= $request['title'];
        $post->slug = str_slug($request['title']);
        $post->content = $request['content'];
        $post->id_category = $request['id_category'];
        $post->save();

        Session::flash('flash_message', 'Post alterado com sucesso!');

        return redirect('dashboard/post/'.$id);
    }

    public function create(){

        $categorias = Category::lists('name', 'id')->all();

        return view('post.create')->with('categorias', $categorias);
    }

    public function store(Request $request){

        //'avatar' => 'dimensions:min_width=100,min_height=200'
        //'file' => ''
        $regras = array(
            'title' => 'required|string|max:100|unique:post',
            'content' => 'required|string|max:100000',
            'feature_img' => 'required|max:5120|mimes:jpeg,png,gif,bmp',
            'id_category' => 'required'
        );

        $mensagens = array(
            'required' => 'O campo :attribute deve ser preenchido.',
            'max' => 'O campo :attribute pode ter no máximo :max caracteres.',
            'name.unique' => 'A post digitado já existe'
        );

        $validator = Validator::make($request->all(), $regras, $mensagens);

        if ($validator->fails()) {
            return redirect('dashboard/post/create')
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->hasFile('feature_img') && $request->file('feature_img')->isValid()) {
            $imageName = md5(uniqid()).'.'.$request->file('feature_img')->getClientOriginalExtension();
            $destinationPath = base_path().'/public/images/post/';
            $request->file('feature_img')->move($destinationPath, $imageName);
        }else{
            $validator->errors()->add('feature_img', 'Ocorreu um erro com a imagem.');
            return redirect('dashboard/post/create')
                ->withErrors($validator)
                ->withInput();
        }

        $post = Post::Create([
            'title' => $request['title'],
            'slug' => str_slug($request['title']),
            'content' => $request['content'],
            'feature_img' => $imageName,
            'id_category' => $request['id_category'],
            'id_user' => Auth::user()->id,

        ]);

        Session::flash('flash_message', 'Post criado com sucesso!');

        return redirect('dashboard/post/'.$post->id);
    }

    public function destroy($id)
    {
        $post = Post::find($id);

        if(!empty($post))
        {
            $imageName = $post->feature_img;
            $destinationPath = base_path().'/public/images/post/';
            File::delete($destinationPath.$imageName);

            $post->delete();

            Session::flash('flash_message', 'Post removido com sucesso!');

            return redirect()->back();
        }

        Session::flash('flash_message', 'Post não encontrado.');

        return redirect()->back();
    }
}
