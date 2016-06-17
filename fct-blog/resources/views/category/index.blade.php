@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">

                <div class="row">
                    <div class="col-md-10">
                        <h1>Categorias</h1>
                    </div>
                    <div class="col-md-2">
                        <a href="{{url('dashboard/categoria/create')}}" class="btn btn-primary" style="margin-top: 20px;">Novo</a>
                    </div>
                </div>

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
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            @foreach($categorias as $categoria)
                            <tr>
                                <td>{{$categoria->id}}</td>
                                <td>{{$categoria->name}}</td>
                                <td>{{$categoria->slug}}</td>
                                <td>
                                    <a href="{{route('dashboard.categoria.show', array('id' => $categoria->id))}}" class="btn btn-success">Ver Detalhes</a>
                                </td>
                                <td>
                                    <a href="{{route('dashboard.categoria.edit', array('id' => $categoria->id))}}" class="btn btn-primary">Editar</a>
                                </td>
                                <td>
                                    {!! Form::open(['method' => 'DELETE','route' => ['dashboard.categoria.destroy', $categoria->id]]) !!}
                                        {!! Form::button('Remover', ['title' => 'Remover', 'type' => 'submit', 'class' => 'btn btn-danger btnRemove']) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $categorias->links() }}
            </div>
        </div>
    </div>
@endsection
