@extends('layouts.base', ['title' => 'Vytvoriť udalosť'])

@section('content')
<!-- Point Table Section Start -->
<div class="rs-point-table sec-spacer">
    <div class="container">
        @if ($errors->any())
        @foreach ($errors->all() as $error)
        <p class="error-message">{{ $error }}</p>
        @endforeach
        @endif
        <div class="tab-content">
            <form method="POST" action="{{ route('events.store') }}" onsubmit="return atLeastOneCheckboxChecked()">
                @csrf
                <p class="event-error-message">
                    Musíte vybrať druh udalosti!
                    <i style="transform: rotate(90deg)" title="Vyberte druh" class="fa fa-share"></i>
                </p>
                <div class="select-type-category">
                    <label class="checkbox-container">Tréning
                        <input value="training" checked name="event_type" type="radio">
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
                <div class="create-event-inputs">
                    <div class="event-additional-title">
                        <p>Dátum udalosti: </p>
                        <input class="custom-input form-control" type="date" name="event_date" required
                            placeholder="dd.mm.rrrr" />
                    </div>
                    <div class="event-additional-title">
                        <p>Čas udalosti: </p>
                        <input class="custom-input form-control" type="time" name="event_time" required
                            placeholder="Čas udalosti" />
                    </div>
                    <div class="event-additional-title">
                        <p>Poznámka: </p>
                        <input maxlength="80" class="custom-input form-control" type="text" name="note" placeholder="Poznámka" />
                    </div>
                    <div id="category-select">
                        <p>Kategória: </p>
                        <select class="custom-input form-control" name="category_id">
                            <option>
                                Vyberte
                            </option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="separator-40"></div>
                <div id="sfl" class="tab-pane fade in active">
                    <h3>Vyberte účastníkov udalosti <i class="fa fa-arrow-down"></i></h3>
                    @foreach ($categories as $category)
                    <button class="collapsible" type="button">
                        {{ $category->name }}
                    </button>
                    <div class="content">
                        <div class="content-heading">
                            <p>ID</p>
                            <p>Číslo dresu</p>
                            <p>Meno</p>
                            <p>
                                Účasť
                                <input type="checkbox" title="Vyberte všetkých v kategórií"
                                    class="notification-select-all">
                            </p>
                        </div>
                        @foreach ($category->users as $user)
                        @if ($user->user_type == 'player')
                        <div class="content-body">
                            <p>{{ $user->registration_number }}</p>
                            <p>{{ $user->dress_number }}</p>
                            <p>{{ $user->name . ' ' . $user->surname }}</p>
                            <p><input name="participants[][player_id]" title="Zaškrtnutím vyberiete hráča"
                                    value="{{ $user->id }}" class="notification-checkbox" type="checkbox"></p>
                        </div>
                        @endif
                        @endforeach
                    </div>
                    @endforeach
                </div>
                <div class="ce-btn-wrapper news-btn notification-btn">
                    <button class="custom-btn"><i title="Odoslať" class="fa fa-share"></i> Vytvoriť</button>
                </div>
            </form>
        </div>

    </div>

</div>
<!-- Point Table Section End -->
<script>
    // handle display inputs / participant on create event page 
    const trainingInput = document.querySelector("input[value=training]");
    const tournamentInput = document.querySelector("input[value=tournament]");
    const matchInput = document.querySelector("input[value=match]");
    const participantSelect = document.querySelector("#sfl");
    const categorySelect = document.getElementById("category-select");
    // hide participant select container initially
    participantSelect.style.display = "none";
    trainingInput.addEventListener("change", () => {
        if (trainingInput.checked) {
            participantSelect.style.display = "none";
            categorySelect.style.display = "initial";
        }
    });

    tournamentInput.addEventListener("change", () => {
        if (tournamentInput.checked) {
            participantSelect.style.display = "initial";
        }
    });
    matchInput.addEventListener("change", () => {
        if (matchInput.checked) {
            participantSelect.style.display = "initial";
        }
    });


    // check if at least one participant is chosen
    let checkboxes = document.querySelectorAll("input[type=checkbox]");
    atLeastOneCheckboxChecked = () => {
        if(tournamentInput.checked || matchInput.checked){
            if(!Array.prototype.slice.call(checkboxes).some(x => x.checked)){
                return false;
            }
            return true;     
        }
    }
</script>
@endsection