@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">

                <div class="row">
                    <div class="col-md-10">
                        <h1>Posts</h1>
                    </div>
                    <div class="col-md-2">
                        <a href="{{url('dashboard/post/create')}}" class="btn btn-primary" style="margin-top: 20px;">Novo</a>
                    </div>
                </div>

                @if(Session::has('flash_message'))
                    <p class="alert alert-success"><i class="material-icons">done</i>{{ Session::get('flash_message') }}</p>
                @endif

                <div class="table-responsive">
                    <table id="posts" class="table">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Título</th>
                            <th>Slug</th>
                            <th>Imagem</th>
                            <th>Categoria</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @foreach($posts as $post)
                            <tr>
                                <td>{{$post->id}}</td>
                                <td>{{$post->name}}</td>
                                <td>{{$post->slug}}</td>
                                <td><img src="{{asset('/images/post/'.$post->feature_img)}}" width="100" height="100"></td>
                                <td>{{$post->category->name}}</td>
                                <td>
                                    <a href="{{route('dashboard.post.show', array('id' => $post->id))}}" class="btn btn-success">Ver Detalhes</a>
                                </td>
                                <td>
                                    <a href="{{route('dashboard.post.edit', array('id' => $post->id))}}" class="btn btn-primary">Editar</a>
                                </td>
                                <td>
                                    {!! Form::open(['method' => 'DELETE','route' => ['dashboard.post.destroy', $post->id]]) !!}
                                    {!! Form::button('Remover', ['title' => 'Remover', 'type' => 'submit', 'class' => 'btn btn-danger btnRemove']) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection
