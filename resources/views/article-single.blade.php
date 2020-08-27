@extends('layouts.base', ['title' => $article->title])
@section('content')
<div class="single-blog-details sec-spacer">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="single-image">
                <img src="{{ asset($article->photo_path) }}" alt="single">
                </div>
                <div>
                    <h2 class="title-bg">{{ $article->title }}</h2>
                </div>
                {!! $article->content !!}
            </div>
        </div>
    </div>
</div>
@endsection