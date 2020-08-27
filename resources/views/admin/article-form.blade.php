@extends('layouts.base', ['title' => $article ? 'Upraviť novinku' : 'Vytvoriť novinku'])
@section('content')
<div class="rs-point-table sec-spacer">
    <div class="container">
        @if ($errors->any())
        @foreach ($errors->all() as $error)
        <p class="error-message">{{ $error }}</p>
        @endforeach
        @endif
        <div class="tab-content">
            @if ($article)
            <form method="POST" enctype="multipart/form-data"
                action="{{ route('article.update', ['article' => $article]) }}">
                @method('PUT')
                @else
                <form method="POST" enctype="multipart/form-data" action="{{ route('article.store') }}">
                    @endif
                    @csrf
                    <div>
                        <span>Názov novinky:</span>
                        <input class="custom-input form-control responsibile-input"
                            value="{{ $article && $article->title ? $article->title : '' }}" type="text" name="title"
                            placeholder="Zadajte názov novinky" required />
                    </div>
                    @if ($article)
                    <div class="article-news-photo-preview">
                        <span>Náhľad fotografie:</span>
                        <img width="500" src="{{ asset($article->photo_path) }}" alt="">
                    </div>
                    <div>
                        <span>Nahrať novú fotografiu:</span>
                        <input class="custom-input form-control responsibile-input" type="file" name="photo"
                            placeholder="Zadajte názov novinky" />
                    </div>
                    @else
                    <div>
                        <span>Fotografia:</span>
                        <input class="custom-input form-control responsibile-input" type="file" name="photo"
                            placeholder="Zadajte názov novinky" required />
                    </div>
                    @endif
                    <div class="notification-textarea">
                        <span>Text novinky:</span>
                        <textarea id="editor" name="content"
                            placeholder="Zadajte text pre novinku">{{ $article && $article->content ? $article->content : '' }}</textarea>
                    </div>
                    <div class="news-btn notification-btn send-btn-wrapper">
                        <button type="submit" class="custom-btn"><i title="Odoslať" class="fa fa-plus"></i>
                            {{ $article ? ' Upraviť' : ' Vytvoriť' }}</button>
                    </div>
                </form>
        </div>
    </div>
</div>

@push('scripts')
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: "#editor",
        plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "textcolor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic underline | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
        entities: "160,nbsp",
        entity_encoding: "named",
        entity_encoding: "raw"
});
</script>
@endpush

@endsection