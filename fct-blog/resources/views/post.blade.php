@extends('layouts.homeLayout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="row">
                    <div class="col-md-12">
                        <div style="margin-bottom: 20px; border: 1px solid #e7e7e7;">
                            <div class="post-header" style="border-bottom: 1px solid #e7e7e7;">
                                <img src="{{asset('/images/post/'.$post->feature_img)}}" style="width: 100%; height: 400px;">
                            </div>
                            <div class="post-body" style="padding: 15px; text-align: center;">
                                <span class="pull-left" style="">{{$post->date}}</span>
                                <span class="label label-primary pull-right" style="">{{$post->category->name}}</span>
                                <h3 style="padding: 15px 0px;">{{$post->title}}</h3>
                                <p style="text-align: justify;">{{$post->content}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
