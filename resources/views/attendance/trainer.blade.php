@extends('layouts.base', ['title' => 'Vytvoriť dochádzku'])

@section('content')

<!-- Point Table Section Start -->
<div class="rs-point-table sec-spacer">
    <div class="container">
        @if ($errors->any())
        @foreach ($errors->all() as $error)
        <p class="error-message">{{ $error }}</p>
        @endforeach
        @endif
        @isset($message)
        <p class="success-message">
            <i class="fa fa-check"></i> {{ $message }}
        </p>
        @endisset
        <div class="tab-content attendance-admin-radio atr-hover">
            <form onsubmit="checkTypeSelected()" method="POST" action="{{ route('trainer.attendance.store') }}">
                @csrf
                <div class="select-type-category">
                    <label class="checkbox-container">Tréning
                        <input value="training" name="event_type" checked type="radio">
                        <span class="checkmark"></span>
                    </label>
                    <label class="checkbox-container">Turnaj
                        <input value="tournament" name="event_type" type="radio">
                        <span class="checkmark"></span>
                    </label>
                    <label class="checkbox-container">Zápas
                        <input value="match" name="event_type" type="radio">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="select-category">
                    <h3>Vyberte Kategóriu: </h3>
                    <select required class="custom-input" style="margin: 0; width: 150px;" name="category_id">
                        <option value="">Vyberte kategóriu</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <h3>Vyberte Hráčov <i class="fa fa-arrow-down"></i></h3>
                <div id="sfl" class="tab-pane fade in active">
                    @foreach ($categories as $category)
                    <button type="button" class="collapsible">{{ $category->name }}</button>
                    <div class="content">
                        <div class="content-heading">
                            <p>ID</p>
                            <p>Číslo dresu</p>
                            <p>Meno</p>
                            <p>Účasť</p>
                        </div>
                        @foreach ($category->users as $user)
                        @if ($user->user_type == 'player')
                        <div class="content-body">
                            <p>{{ $user->registration_number }}</p>
                            <p>{{ $user->dress_number }}</p>
                            <p>{{ $user->name . ' ' . $user->surname }}</p>
                            <p>
                                <label>
                                    <input type="radio" checked value="-1" name="is_present[{{ $user->id }}]" />
                                    <span onclick="handleCheck(this)">
                                        <i style="color:lightskyblue;" class="fa fa-minus-square"></i>
                                    </span>
                                </label>
                                <label>
                                    <input type="radio" value="0" name="is_present[{{ $user->id }}]" />
                                    <span onclick="handleCheck(this)">
                                        <i class="fa fa-times"></i>
                                    </span>
                                </label>
                                <label>
                                    <input type="radio" value="1" name="is_present[{{ $user->id }}]" />
                                    <span onclick="handleCheck(this)">
                                        <i class="fa fa-check"></i>
                                    </span>
                                </label>
                            </p>
                        </div>
                        @endif
                        @endforeach
                    </div>
                    @endforeach
                </div>
                <div class="news-btn attendance-btn">
                    <button class="custom-btn"><i title="Odoslať" class="fa fa-paper-plane"></i> Odoslať</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    handleCheck = (content) => {
        let spanWrapper = content.parentNode.parentNode;
        let icons = spanWrapper.querySelectorAll("span i");
        let clickedIcon = content.querySelector("i");
        for(icon of icons){
            icon.style.color = "lightgray";
        }
        if(clickedIcon.className.includes("check")){
            clickedIcon.style.color = "limegreen";
        }
        if(clickedIcon.className.includes("minus")){
            clickedIcon.style.color = "lightskyblue";
        }
        if(clickedIcon.className.includes("times")){
            clickedIcon.style.color = "orangered";
        }
    }
</script>
@endpush
@endsection