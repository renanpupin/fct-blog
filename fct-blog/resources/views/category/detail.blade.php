@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h1>Categoria "{{$categoria->name}}"</h1>

                @if(Session::has('flash_message'))
                    <p class="alert alert-success"><i class="material-icons">done</i>{{ Session::get('flash_message') }}</p>
                @endif

                <div class="table-responsive">
                    <table id="categorias" class="table">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nome</th>
                            <th>Slug</th>
                            <th>Opções</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$categoria->id}}</td>
                                <td>{{$categoria->name}}</td>
                                <td>{{$categoria->slug}}</td>
                                <td>
                                    <a href="{{route('dashboard.categoria.edit', array('id' => $categoria->id))}}">Editar</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
