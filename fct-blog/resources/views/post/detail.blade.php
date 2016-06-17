@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h1>Post "{{$post->id}}"</h1>

                @if(Session::has('flash_message'))
                    <p class="alert alert-success"><i class="material-icons">done</i>{{ Session::get('flash_message') }}</p>
                @endif

                <div class="table-responsive">
                    <table id="categorias" class="table">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Título</th>
                            <th>Slug</th>
                            <th>Conteúdo</th>
                            <th>Categoria</th>
                            <th>Imagem</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{$post->id}}</td>
                            <td>{{$post->title}}</td>
                            <td>{{$post->slug}}</td>
                            <td>{{$post->content}}</td>
                            <td>{{$post->category->name}}</td>
                            <td><img src="{{asset('/images/post/'.$post->feature_img)}}" width="100" height="100"></td>
                            <td>
                                <a href="{{route('dashboard.post.edit', array('id' => $post->id))}}">Editar</a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
