<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

use App\Http\Requests;

use Validator;
use Session;

class CategoryController extends Controller
{
    public function index(){
        $categorias = Category::paginate(5);

        return view('category.index')->with('categorias', $categorias);
    }

    public function show($id){
        $categoria = Category::find($id);

        return view('category.detail')->with('categoria', $categoria);
    }

    public function edit($id){

        $categoria = Category::findOrNew($id);

        return view('category.edit')->with('categoria', $categoria);
    }

    public function update(Request $request, $id){

        $categoria = Category::find($id);

        //definir mais uma regra de name unique
        $regras = array(
            'name' => 'required|string|max:20'
        );

        $mensagens = array(
            'name.required' => 'O campo nome deve ser preenchido.',
            'name.max' => 'O campo :attribute pode ter no máximo 20 caracteres.'
        );

        $validator = Validator::make($request->all(), $regras, $mensagens);

        if ($validator->fails()) {
            return redirect('dashboard/categoria/'.$id.'/edit')
                ->withErrors($validator)
                ->withInput();
        }

        $categoria->name = $request['name'];
        $categoria->slug = str_slug($request['name']);
        $categoria->save();

        Session::flash('flash_message', 'Categoria alterada com sucesso!');

        //return redirect()->action('CategoryController@show',['id' => $id]);
        return redirect('dashboard/categoria/'.$id);
    }

    public function create(){
        return view('category.create');
    }

    public function store(Request $request){



        //definir mais uma regra de name unique
        $regras = array(
            'name' => 'required|string|max:20|unique:category'
        );

        $mensagens = array(
            'name.required' => 'O campo nome deve ser preenchido.',
            'name.max' => 'O campo nome pode ter no máximo 20 caracteres.',
            'name.unique' => 'A categoria digitada já existe'
        );

        $validator = Validator::make($request->all(), $regras, $mensagens);

        if ($validator->fails()) {
            return redirect('dashboard/categoria/create')
                ->withErrors($validator)
                ->withInput();
        }

        $categoria = Category::Create([
            'name' => $request['name'],
            'slug' => str_slug($request['name'])
        ]);

        Session::flash('flash_message', 'Categoria salva com sucesso!');

        //return redirect()->action('CategoryController@show',['id' => $id]);
        return redirect('dashboard/categoria/'.$categoria->id);
    }

    public function destroy($id)
    {
        $categoria = Category::find($id);

        if(!empty($categoria))
        {
            $categoria->delete();
            Session::flash('flash_message', 'Categoria removida com sucesso!');
            return redirect()->back();
        }

        Session::flash('flash_message', 'Categoria não encontrada.');
        return redirect()->back();
    }
}
