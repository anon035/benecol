@extends('layouts.base', ['title' => 'Albumy'])

@section('content')
<div id="rs-blog" class="rs-blog sec-spacer">

    <div class="container">
        <div class="row">

            @foreach ($albums as $album)

            <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="single-blog-slide">
                    <div class="images">
                        <a href="{{ route('gallery', ['albumId'=> $album->id]) }}"><img src="{{ $album->picture }}"
                                alt="{{ $album->picture }}"></a>
                    </div>
                    <div class="blog-details">
                        <h3><a href="{{ route('gallery', ['albumId'=> $album->id]) }}">{{ $album->name }} </a></h3>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection