@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h1>Nova Categoria</h1>

                @if($errors->any())
                    {{--{{dd($errors)}}--}}
                    <div class="col-md-12">
                        <div class="alert alert-danger" role="alert">
                            @foreach($errors->all() as $error)
                                <p><i class="material-icons">error_outline</i>{!! $error !!}</p>
                            @endforeach
                        </div>
                    </div>
                @endif

                {!! Form::open(['route' => ['dashboard.categoria.store'], 'method' => 'POST']) !!}
                <div class="form-group grid-m-6 grid-s-12 grid-xs-12">
                    {!! Form::label('name', 'Nome *', null, ['for' => 'name', 'class' => 'form-control']) !!}
                    {!! Form::text('name',null,['id' => 'name', 'class' => 'form-control']) !!}
                </div>
                <div class="form-group grid-m-3 grid-s-3 button-field">
                    {!! Form::button('Cadastrar',[
                        'id' => 'btnCadastrar',
                        'type' => 'submit',
                        'class' => 'btn btn-primary ripple'
                    ])!!}
                </div>
                {{ Form::close() }}

            </div>
        </div>
    </div>
@endsection
