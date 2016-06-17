<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WebsiteController@indexWebsite');
Route::get('/categorias/{slug}', 'WebsiteController@postCategory');

Route::auth();


Route::group(['prefix' => 'dashboard'], function() {
    Route::get('/home', 'HomeController@index');

    Route::group(['middleware' => 'auth'], function() {

        //rotas de categorias
        Route::resource('categoria', 'CategoryController');

        //rotas de posts
        Route::get('/post', 'PostController@index');
        Route::get('/post/create', 'PostController@create');
        Route::post('/post', ['as' => 'dashboard.post.store', 'uses' => 'PostController@store']);
        Route::get('/post/{id}', ['as' => 'dashboard.post.show', 'uses' => 'PostController@show']);
        Route::get('/post/{id}/edit', ['as' => 'dashboard.post.edit', 'uses' => 'PostController@edit']);
        Route::put('/post/{id}', ['as' => 'dashboard.post.update', 'uses' => 'PostController@update']);
        Route::delete('/post/{id}', ['as' => 'dashboard.post.destroy', 'uses' => 'PostController@destroy']);
    });
});
