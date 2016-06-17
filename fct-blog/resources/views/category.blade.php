@extends('layouts.homeLayout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="row">
                    <h1>{{$categoria->name}}</h1>
                    @foreach($posts as $post)
                        <div class="col-md-4">
                            <div style="margin-bottom: 20px; border: 1px solid #e7e7e7;">
                                <div class="post-header" style="border-bottom: 1px solid #e7e7e7;">
                                    <img src="{{asset('/images/post/'.$post->feature_img)}}" style="width: 100%; height: 200px;">
                                </div>
                                <div class="post-body" style="padding: 15px; text-align: center;">
                                    <span class="pull-left" style="">{{$post->date}}</span>
                                    <span class="label label-primary pull-right" style="">{{$post->category->name}}</span>
                                    <h3 style="padding: 15px 0px;">{{$post->title}}</h3>
                                    <a href="/post/{{$post->slug}}" class="btn btn-success" style="width: 100px;">LER</a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    @if(count($posts) == 0)
                        <p>Sem posts para esta categoria</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
