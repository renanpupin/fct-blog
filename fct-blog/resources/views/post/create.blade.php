@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h1>Novo Post</h1>

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

                {!! Form::open(['route' => ['dashboard.post.store'], 'method' => 'POST', 'files' => true]) !!}
                    <div class="form-group grid-m-6 grid-s-12 grid-xs-12">
                        {!! Form::label('title', 'Title *', null, ['for' => 'title', 'class' => 'form-control']) !!}
                        {!! Form::text('title',null,['id' => 'title', 'class' => 'form-control']) !!}
                    </div>
                    <div class="form-group grid-m-6 grid-s-12 grid-xs-12">
                        {!! Form::label('content', 'Conteúdo *', null, ['for' => 'content', 'class' => 'form-control']) !!}
                        {!! Form::textarea('content',null,['id' => 'content', 'class' => 'form-control']) !!}
                    </div>
                    <div class="form-group grid-m-6 grid-s-12 grid-xs-12">
                        {!! Form::label('feature_img', 'Imagem *', null, ['for' => 'feature_img', 'class' => 'form-control']) !!}
                        {!! Form::file('feature_img',null,['id' => 'feature_img', 'class' => 'form-control']) !!}
                    </div>
                    <div class="form-group grid-m-6 grid-s-12 grid-xs-12">
                        {!! Form::label('id_category', 'Categoria *', null, ['for' => 'id_category', 'class' => 'form-control']) !!}
                        {!!Form::select('id_category', $categorias, null, ['id' => 'id_category', 'class' => 'form-control']) !!}
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
