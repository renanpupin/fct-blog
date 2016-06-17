<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use App\Category;

class WebsiteController extends Controller
{
    public function indexWebsite(){
        $posts = Post::paginate(12);
        $categorias = Category::get();

        return view('index')->with("posts", $posts)->with("categorias", $categorias);
    }

    public function postCategory($slug){
        $category_id = Category::where('slug', $slug)->get();

    }
}
