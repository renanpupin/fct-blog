<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use App\Category;
use Carbon\Carbon;

class WebsiteController extends Controller
{
    public function indexWebsite(){

        //order by date
        $posts = Post::paginate(12);

        foreach($posts as $post){
            $post["date"] = Carbon::parse($post->created_at)->format('d/m/Y');
        }
//        dd($posts);

        $categorias = Category::get();

        return view('index')->with("posts", $posts)->with("categorias", $categorias);
    }

    public function postCategory($slug){
        //para o menu
        $categorias = Category::get();

        $categoria = Category::where('slug', $slug)->first();

        $posts = Post::where('id_category', $categoria->id)->paginate(12);

        return view('category')->with("posts", $posts)->with("categoria", $categoria)->with("categorias", $categorias);
    }

    public function postDetail($slug){
        //para não bugar o menu
        $categorias = Category::get();

        $post = Post::where('slug', $slug)->first();

        $post->date = Carbon::parse($post->created_at)->format('d/m/Y');

        return view('post')->with("post", $post)->with("categorias", $categorias);

    }
}
