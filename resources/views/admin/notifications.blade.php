@extends('layouts.base', ['title' => 'Notifikácie'])

@section('content')

<div class="rs-point-table sec-spacer">
    <div class="container">
            @if ($errors->any())
            @foreach ($errors->all() as $error)
            <p class="error-message">{{ $error }}</p>
            @endforeach
            @endif
            @switch($message)
            @case('success')
            <div>
                <h2 class="success-message"><i class="fa fa-check"></i> Notifikácia bola úspešne odoslaná.</h2>
            </div>
            @break
            @endswitch
        <div class="tab-content">
            <h3>Vyberte hráčov, ktorým bude zaslaná notifikácia <i class="fa fa-arrow-down"></i></h3>
            <form onsubmit="return recipientValidation()" class="notification-form" action="{{ route('notifications.send') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div id="sfl" class="tab-pane fade in active">
                    <button class="collapsible" type="button">Tréneri</button>
                    <div class="content">
                        <div class="content-heading">
                            <p>ID</p>
                            <p>Meno</p>
                            <p>
                                Notifikácia
                                <input type="checkbox" class="notification-select-all">
                            </p>
                        </div>
                        @foreach ($trainers as $user)
                        <div class="content-body">
                            <p>{{ $user->registration_number }}</p>
                            <p>{{ $user->name . ' ' . $user->surname }}</p>
                            <p><input value="{{ $user->email }}" name="recipients[]" class="notification-checkbox"
                                    type="checkbox"></p>
                        </div>
                        @endforeach
                    </div>
                    @foreach ($categories as $category)
                    <button class="collapsible" type="button">{{ $category->name }}</button>
                    <div class="content">
                        <div class="content-heading">
                            <p>ID</p>
                            <p>Meno</p>
                            <p>
                                Notifikácia
                                <input type="checkbox" class="notification-select-all">
                            </p>
                        </div>
                        @foreach ($category->users as $user)
                        <div class="content-body">
                            <p>{{ $user->registration_number }}</p>
                            <p>{{ $user->name . ' ' . $user->surname }}</p>
                            <p><input value="{{ $user->email }}" name="recipients[]" class="notification-checkbox"
                                    type="checkbox"></p>
                        </div>
                        @endforeach
                    </div>
                    @endforeach
                    <div class="notification-photo-input">
                        <p>Predmet správy: </p>
                        <input class="custom-input form-control" type="text" required name="subject"
                            placeholder="Zadajte predmet správy">
                    </div>
                    <div class="notification-textarea">
                        <textarea id="editor" name="body" placeholder="Zadajte text notifikácie"></textarea>
                    </div>
                    <div class="notification-photo-input">
                        <p>Fotografia: </p>
                        <input class="custom-input form-control" type="file" name="photo"
                            placeholder="Priložte fotografiu">
                    </div>
                    <div class="news-btn notification-btn">
                        <button class="custom-btn"><i title="Odoslať" class="fa fa-paper-plane"></i> Odoslať</button>
                    </div>
            </form>
        </div>
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
<script>
    // check if at least one user is chosen
    recipientValidation = () => {
        let checkboxes = document.querySelectorAll("[name='recipients[]']");
    for(checkbox of checkboxes){
        if(checkbox.checked){
            return true;
        }
    }
    alert("Vyberte aspoň jedného príjemcu správy");
    return false;
    }
</script>
@endpush

@endsection