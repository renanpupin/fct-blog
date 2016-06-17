@extends('layouts.homeLayout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="row">
                    @foreach($posts as $post)
                        <div class="col-md-3">
                            {{$post->title}}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
