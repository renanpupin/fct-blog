@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h1>Editar Categoria "{{$categoria->name}}"</h1>

                @if($errors->any())
                    <div class="col-md-12">
                        <div class="alert alert-danger" role="alert">
                            @foreach($errors->all() as $error)
                                <p><i class="material-icons">error_outline</i>{{ $error }}</p>
                            @endforeach
                        </div>
                    </div>
                @endif

                {!! Form::model($categoria,['route' => ['dashboard.categoria.update',$categoria->id], 'method' => 'PUT']) !!}
                    <div class="form-group grid-m-6 grid-s-12 grid-xs-12">
                        {!! Form::label('name', 'Nome *', null, ['for' => 'name', 'class' => 'form-control']) !!}
                        {!! Form::text('name',null,['id' => 'name', 'class' => 'form-control']) !!}
                    </div>
                    <div class="form-group grid-m-3 grid-s-3 button-field">
                        {!! Form::button('Editar',[
                            'id' => 'btnEditar',
                            'type' => 'submit',
                            'class' => 'btn btn-primary ripple'
                        ])!!}
                    </div>
                {{ Form::close() }}

            </div>
        </div>
    </div>
@endsection
