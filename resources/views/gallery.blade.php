@extends(
'layouts.base',
['title' => $title, 'extra' => [
[
'title' => 'Fotogaléria',
'link' => route('gallery')
]
]])

@section('content')

<!-- Gallery Section2 Start Here-->
<div class="gallery-section-page2 sec-spacer">
    <div class="gallery-section-area">
        <div class="container">
            <div class="gallery-pagination">
                @if ($previousPhotos)
                <a href="#" onclick="
                                                event.preventDefault(); 
                                                    document.getElementById('previous-form').submit();
                                                    ">
                    <i class="fa fa-chevron-left"></i> Predchádzajúca
                </a>
                <form id="previous-form" action="{{ route('gallery.post', ['albumId' => $albumId]) }}" method="POST"
                    style="display: none;">
                    @csrf
                    <input type="hidden" value="{{ $previousPhotos }}" name="url" />
                </form>
                @endif
                @if ($nextPhotos)
                <a href="#" onclick="
                                                event.preventDefault(); 
                                                    document.getElementById('next-form').submit();
                                                    ">
                    Nasledujúca <i class="fa fa-chevron-right"></i>
                </a>
                <form id="next-form" action="{{ route('gallery.post', ['albumId' => $albumId]) }}" method="POST"
                    style="display: none;">
                    @csrf
                    <input type="hidden" value="{{ $nextPhotos }}" name="url" />
                </form>
                @endif
            </div>
        </div>

        <div class="container">
            <h3 class="title-bg">Fotogaléria</h3>
            <div class="row">
                @foreach ($photos as $photo)
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="single-gallery">
                        <img src="{{ $photo }}" alt="">
                        <div class="popup-icon">
                            <a class="image-popup" href="{{ $photo }}"><i class="fa fa-arrows-alt"></i></a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="container">
            <div class="gallery-pagination">
                @if ($previousPhotos)
                <a href="#" onclick="
                                        event.preventDefault(); 
                                            document.getElementById('previous-form').submit();
                                            ">
                    <i class="fa fa-chevron-left"></i> Predchádzajúca
                </a>
                <form id="previous-form" action="{{ route('gallery.post', ['albumId' => $albumId]) }}" method="POST"
                    style="display: none;">
                    @csrf
                    <input type="hidden" value="{{ $previousPhotos }}" name="url" />
                </form>
                @endif
                @if ($nextPhotos)
                <a href="#" onclick="
                                        event.preventDefault(); 
                                            document.getElementById('next-form').submit();
                                            ">
                    Nasledujúca <i class="fa fa-chevron-right"></i>
                </a>
                <form id="next-form" action="{{ route('gallery.post', ['albumId' => $albumId]) }}" method="POST"
                    style="display: none;">
                    @csrf
                    <input type="hidden" value="{{ $nextPhotos }}" name="url" />
                </form>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- Gallery Section2 End Here-->

@endsection