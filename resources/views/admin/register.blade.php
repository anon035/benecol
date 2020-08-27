@extends('layouts.base', ['title' => 'Registrácia člena'])

@section('content')

<!-- Point Table Section Start -->
<div class="rs-point-table sec-spacer">
    <div class="container">
        @if ($errors->any())
        @foreach ($errors->all() as $error)
        <p class="error-message">{{ $error }}</p>
        @endforeach
        @endif
        @if (!$user)
        <ul class="point-menu">
            <li class="active">
                <a data-toggle="tab" href="#player">Hráč</a>
            </li>
            <li><a data-toggle="tab" href="#coach">Tréner</a></li>
        </ul>
        @endif
        @php
        if (get_browser()->browser == 'Safari') {
        $bDayFormat = 'D. M. Y';
        } else {
        $bDayFormat = 'YYYY-MM-DD';
        }
        @endphp
        <div class="tab-content responsive-event-center">
            @if ($errors->count())
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endif
            @if(!$user || ($user && $user->user_type == 'player'))
            <div id="player" class="tab-pane fade in active">
                @if($user)
                <form class="registration-form" method="POST"
                    action="{{ route('users.update', ['user' => $user->id]) }}" enctype="multipart/form-data">
                    @method('PUT')
                    @else
                    <form class="registration-form" method="POST" action="{{ route('users.store') }}"
                        enctype="multipart/form-data">
                        @endif
                        @csrf
                        <input type="hidden" name="user_type" value="player">
                        <div class="form-group">
                            <label for="name">Meno hráča</label>
                            <input value="{{ $user && $user->name ? $user->name : '' }}" autocomplete="off" required
                                name="name" type="text" class="form-control" id="name" placeholder="Meno">
                        </div>
                        <div class="form-group">
                            <label for="surname">Priezvisko</label>
                            <input value="{{ $user && $user->surname ? $user->surname : '' }}" autocomplete="off"
                                required name="surname" type="text" class="form-control" id="surname"
                                placeholder="Priezvisko">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input value="{{ $user && $user->email ? $user->email : '' }}" autocomplete="off" required
                                name="email" type="email" class="form-control" id="email" placeholder="Zadajte email">
                        </div>
                        <div class="form-group">
                            <label for="birthdate">Dátum narodenia</label>
                            <input
                                value="{{ $user && $user->birth_date ? $user->birth_date->isoFormat($bDayFormat) : '' }}"
                                autocomplete="off" required name="birth_date" type="date" class="form-control"
                                id="birthdate" placeholder="dd.mm.rrrr">
                        </div>
                        <div class="form-group">
                            <label for="regnumber">Registračné číslo <span class="regnumber">(7 ciferné)</span></label>
                            <input value="{{ $user && $user->registration_number ? $user->registration_number : '' }}"
                                autocomplete="off" required name="registration_number" minlength="7" maxlength="7"
                                type="text" class="form-control" id="regnumber" placeholder="Registračné číslo">
                        </div>
                        <div class="form-group">
                            <label for="phone">Tel. číslo</label>
                            <input value="{{ $user && $user->phone_number ? $user->phone_number : '' }}"
                                autocomplete="off" required name="phone_number" minlength="10" type="text"
                                class="form-control" id="phone" placeholder="Tel. číslo">
                        </div>
                        <div class="form-group">
                            <label for="playernum">Číslo dresu</label>
                            <input value="{{ $user && $user->dress_number ? $user->dress_number : '' }}"
                                autocomplete="off" min="0" name="dress_number" type="number" class="form-control"
                                id="playernum" placeholder="Číslo">
                        </div>
                        <div class="form-group">
                            <label for="parking_card">Parkovacia karta</label>
                            <input value="{{ $user && $user->parking_card ? $user->parking_card : '' }}"
                                autocomplete="off" min="0" name="parking_card" type="text" class="form-control"
                                id="parking-card" placeholder="Číslo parkovacej karty">
                        </div>
                        <div class="form-group">
                            <label for="suit">Súprava</label>
                            <select required class="form-control" name="has_suit" id="suit">
                                <option value="">Vyberte</option>
                                <option {{ $user && !$user->has_suit ? 'selected' : '' }} value="0">Nie</option>
                                <option {{ $user && $user->has_suit ? 'selected' : '' }} value="1">Áno</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="category">Kategória</label>
                            <select required class="form-control" name="category_id" id="category">
                                <option value="">Vyberte</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $user && $user->category_id == $category->id ? 'selected' : ''}}>
                                    {{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="reg-btn">
                            @if($user)
                            <button type="submit" class="custom-btn"><i class="fa fa-edit"></i> Upraviť</button>
                            @else
                            <button type="submit" class="custom-btn"><i title="Odoslať" class="fa fa-plus"></i>
                                Vytvoriť</button>
                            @endif
                        </div>
                    </form>
            </div>
            @endif
            @if(!$user || ($user && $user->user_type == 'trainer'))
            @if($user)
            <div id="coach" class="tab-pane active">
                <form class="registration-form" method="POST"
                    action="{{ route('users.update', ['user' => $user->id]) }}" enctype="multipart/form-data">
                    @method('PUT')
                    @else
                    <div id="coach" class="tab-pane fade">
                        <form class="registration-form" method="POST" action="{{ route('users.store') }}"
                            enctype="multipart/form-data">
                            @endif
                            @csrf
                            <input type="hidden" name="user_type" value="trainer">
                            <div class="form-group">
                                <label for="name">Meno trenéra</label>
                                <input value="{{ $user && $user->name ? $user->name : '' }}" autocomplete="off" required
                                    name="name" type="text" class="form-control" id="name" placeholder="Meno">
                            </div>
                            <div class="form-group">
                                <label for="surname">Priezvisko</label>
                                <input value="{{ $user && $user->surname ? $user->surname : '' }}" autocomplete="off"
                                    required name="surname" type="text" class="form-control" id="surname"
                                    placeholder="Priezvisko">
                            </div>
                            <div class="form-group">
                                <label for="title_before">Titul (pred menom)</label>
                                <input value="{{ $user && $user->title_before ? $user->title_before : '' }}"
                                    autocomplete="off" name="title_before" type="text" class="form-control" id="name"
                                    placeholder="Titul pred menom">
                            </div>
                            <div class="form-group">
                                <label for="title_after">Titul (za menom)</label>
                                <input value="{{ $user && $user->title_after ? $user->title_after : '' }}"
                                    autocomplete="off" name="title_after" type="text" class="form-control" id="name"
                                    placeholder="Titul za menom">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input value="{{ $user && $user->email ? $user->email : '' }}" autocomplete="off"
                                    required name="email" type="email" class="form-control" id="email"
                                    placeholder="Zadajte email">
                            </div>
                            <div class="form-group">
                                <label for="birthdate">Dátum narodenia</label>
                                <input
                                    value="{{ $user && $user->birth_date ? $user->birth_date->isoFormat($bDayFormat) : '' }}"
                                    autocomplete="off" required name="birth_date" type="date" placeholder="dd.mm.rrrr"
                                    class="form-control" id="birthdate">
                            </div>
                            <div class="form-group">
                                <label for="regnumber">Registračné číslo <span class="regnumber">(7
                                        ciferné)</span></label>
                                <input
                                    value="{{ $user && $user->registration_number ? $user->registration_number : '' }}"
                                    autocomplete="off" required name="registration_number" minlength="7" maxlength="7"
                                    type="text" class="form-control" id="regnumber" placeholder="Registračné číslo">
                            </div>
                            <div class="form-group">
                                <label for="phone">Tel. číslo</label>
                                <input value="{{ $user && $user->phone_number ? $user->phone_number : '' }}"
                                    autocomplete="off" required name="phone_number" minlength="10" type="text"
                                    class="form-control" id="phone" placeholder="Tel. číslo">
                            </div>
                            <div class="form-group">
                                <label for="parking_card">Parkovacia karta</label>
                                <input value="{{ $user && $user->parking_card ? $user->parking_card : '' }}"
                                    autocomplete="off" min="0" name="parking_card" type="text" class="form-control"
                                    id="parking-card" placeholder="Číslo parkovacej karty">
                            </div>
                            <div class="form-group">
                                <label for="coachphoto">Profilová fotografia</label>
                                @if ($user)
                                <input autocomplete="off" name="photo" type="file" class="form-control" id="coachphoto">
                                <img width="200" src="{{ asset($user->photo->path) }}" />
                                @else
                                <input autocomplete="off" required name="photo" type="file" class="form-control"
                                    id="coachphoto">
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="category">Kategória</label>
                                <select required class="form-control" name="category_id" id="category">
                                    <option value="">Vyberte</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $user && $user->category_id == $category->id ? 'selected' : ''}}>
                                        {{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="register-coach-additional-title">
                                <h3 class="title-bg">Údaje o trénerovi</h3>
                            </div>
                            <div class="form-group">
                                <label for="responsibility">Zodpovednosť</label>
                                <input value="{{ $user && $user->responsibility ? $user->responsibility : '' }}"
                                    placeholder="Zadajte kategóriu" autocomplete="off" required name="responsibility"
                                    type="text" class="form-control" id="coach-add-cat">
                            </div>
                            <div class="form-group">
                                <label for="licence">Trénerská licencia</label>
                                <input value="{{ $user && $user->licence ? $user->licence : '' }}"
                                    placeholder="Zadajte licenciu" autocomplete="off" required name="licence"
                                    type="text" class="form-control" id="coach-add-licence">
                            </div>
                            <div class="form-group">
                                <label for="certificate">Certifikát</label>
                                <input value="{{ $user && $user->certificate ? $user->certificate : '' }}"
                                    placeholder="Zadajte certifikáty" autocomplete="off" required name="certificate"
                                    type="text" class="form-control" id="coach-add-cert">
                            </div>
                            <div class="form-group textarea-reg">
                                <label for="clubs">Športová kariéra</label>
                                <textarea maxlength="1200" placeholder="Kluby, v ktorých tréner pôsobil"
                                    autocomplete="off" name="clubs" class="form-control"
                                    id="editor">{{ $user && $user->clubs ? $user->clubs : '' }}</textarea>
                            </div>
                            <div class="reg-btn">
                                @if($user)
                                <button type="submit" class="custom-btn"><i class="fa fa-edit"></i> Upraviť</button>
                                @else
                                <button type="submit" class="custom-btn"><i title="Odoslať" class="fa fa-plus"></i>
                                    Vytvoriť</button>
                                @endif
                            </div>
                        </form>
                    </div>
                    @endif
            </div>
        </div>
    </div>
    <!-- Point Table Section End -->

    @push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/12.3.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
    @endpush

    @endsection