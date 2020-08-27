@extends('layouts.base', ['title' => 'Udalosti'])

@section('content')
<!-- Point Table Section Start -->
<div class="rs-point-table sec-spacer">
    <div class="container">
        <a href="{{ route('events.create') }}">
            <button class="custom-btn margin-bottom-30">
                <i title="Vytvoriť" class="fa fa-plus"></i> Vytvoriť udalosť
            </button>
        </a>
        <ul class="point-menu">
            <li class="active"><a data-toggle="tab" href="#tre">Tréningy</a></li>
            <li><a data-toggle="tab" href="#tur">Turnaje</a></li>
            <li><a data-toggle="tab" href="#zap">Zápasy</a></li>
        </ul>
        <div class="tab-content">
            <div id="tre" class="tab-pane fade in active">

                @if(!$trainings->isEmpty())
                <label for="hasSuit">Filter: </label>
                <div class="filter-wrapper">

                    <select class="custom-input" id="category-filter">
                        <option value="0">Vyberte kategóriu: </option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <table id="trainings">
                    <tr>
                        <td>#</td>
                        <td class="team-name">Dátum</td>
                        <td>Čas</td>
                        <td>Kategória</td>
                        <td>Poznámka</td>
                        <td>Akcia</td>
                    </tr>
                    @foreach ($trainings as $training)
                    <tr data-cat="{{ $training->category->id }}">
                        <td>{{ $training->id }}</td>
                        <td class="team-name">{{ $training->event_date->isoFormat('D. M. Y') }}</td>
                        <td>{{ $training->event_date->isoFormat('H:mm') }}</td>
                        <td>{{ $training->category->name }}</td>
                        <td>{{ $training->note }}</td>
                        <td>
                            <a class="edit-icon-position"
                                href="{{ route('events.edit', ['event' => $training->id]) }}"><i
                                    class="fa fa-edit"></i></a>
                            <a href="#"
                                onclick="event.preventDefault();
                                                if (confirm('Vymazať udalosť natrvalo?')){
                                                        document.getElementById('delete-form-{{$training->id}}').submit();}"><i
                                    title="Vymazať" class="fa user-list-icon fa-trash"></i>
                            </a>
                            <form id="delete-form-{{$training->id}}"
                                action="{{ route('events.destroy', ['event' => $training->id]) }}" method="POST"
                                style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table>
                @else
                <div class="box-bubble sb4">Nieje vytvorený žiaden tréning</div>
                @endif
            </div>
            <div id="zap" class="tab-pane fade in ">
                @forelse ($matches as $match)
                <button class="collapsible" type="button">
                    {{ $match->event_date->isoFormat('D. M. Y H:mm') . ' - ' . $match->category->name . ' - ' . $match->note }}
                    <a class="edit-icon-position" href="{{ route('events.edit', ['event' => $match->id]) }}"><i
                            class="fa fa-edit"></i></a>
                    <a href="#" onclick="event.preventDefault();
                                        if (confirm('Vymazať udalosť natrvalo?')){
                                                document.getElementById('delete-form-{{$match->id}}').submit();}"><i
                            title="Vymazať" class="fa user-list-icon fa-trash"></i>
                    </a>
                    <form id="delete-form-{{$match->id}}"
                        action="{{ route('events.destroy', ['event' => $match->id]) }}" method="POST"
                        style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </button>
                <div class="content">
                    <form action="{{ route('events.update', ['event' => $match->id]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="content-heading">
                            <p>Reg. číslo</p>
                            <p>Číslo dresu</p>
                            <p>Meno</p>
                            <p>Hráč sa vyjadril</p>
                            <p>
                                Účasť
                                <input type="checkbox" class="notification-select-all">
                                <button class="events-save-btn" type="submit"><i class="fa fa-save"></i></button>
                            </p>
                        </div>
                        @foreach ($match->participants as $participant)
                        <div class="content-body">
                            <p>{{ $participant->player->registration_number }}</p>
                            <p>{{ $participant->player->dress_number }}</p>
                            <p>{{ $participant->player->name . ' ' . $participant->player->surname }}</p>
                            <p>{{ $participant->user_submitted ? 'Áno' : 'Nie' }}</p>
                            <input type="hidden" name="participants[{{ $participant->id }}][is_present]" value="0">
                            <p><input name="participants[{{ $participant->id }}][is_present]" value="1"
                                    {{ $participant->is_present ? 'checked' : '' }}
                                    class="notification-checkbox {{ $participant->user_submitted ? 'user-submitted' : '' }}"
                                    type="checkbox"></p>
                        </div>
                        @endforeach
                    </form>
                </div>

                @empty
                <div class="box-bubble sb4">Nieje vytvorený žiaden zápas</div>
                @endforelse
            </div>
            <div id="tur" class="tab-pane fade in">
                @forelse ($tournaments as $tournament)
                <button class="collapsible" type="button">
                    {{ $tournament->event_date->isoFormat('D. M. Y H:mm') . ' - ' . $tournament->category->name . ' - ' . $tournament->note }}
                    <a class="edit-icon-position" href="{{ route('events.edit', ['event' => $tournament->id]) }}"><i
                            class="fa fa-edit"></i></a>
                    <a href="#"
                        onclick="event.preventDefault();
                                        if (confirm('Vymazať udalosť natrvalo?')){
                                                document.getElementById('delete-form-{{$tournament->id}}').submit();}"><i
                            title="Vymazať" class="fa user-list-icon fa-trash"></i>
                    </a>
                    <form id="delete-form-{{$tournament->id}}"
                        action="{{ route('events.destroy', ['event' => $tournament->id]) }}" method="POST"
                        style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </button>
                <div class="content">
                    <form action="{{ route('events.update', ['event' => $tournament->id]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="content-heading">
                            <p>Reg. číslo</p>
                            <p>Číslo dresu</p>
                            <p>Meno</p>
                            <p>Hráč sa vyjadril</p>
                            <p>
                                Účasť
                                <input type="checkbox" class="notification-select-all">
                                <button class="events-save-btn" type="submit"><i class="fa fa-save"></i></button>
                            </p>
                        </div>
                        @foreach ($tournament->participants as $participant)
                        <div class="content-body">
                            <p>{{ $participant->player->registration_number }}</p>
                            <p>{{ $participant->player->dress_number }}</p>
                            <p>{{ $participant->player->name . ' ' . $participant->player->surname }}</p>
                            <p>{{ $participant->user_submitted ? 'Áno' : 'Nie' }}</p>
                            <input type="hidden" name="participants[{{ $participant->id }}][is_present]" value="0">
                            <p>
                                <input name="participants[{{ $participant->id }}][is_present]" value="1"
                                    {{ $participant->is_present ? 'checked' : '' }}
                                    class="notification-checkbox {{ $participant->user_submitted ? 'user-submitted' : '' }}"
                                    type="checkbox">
                            </p>
                        </div>
                        @endforeach
                    </form>
                </div>
                @empty
                <div class="box-bubble sb4">Nieje vytvorený žiaden turnaj</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
<!-- Point Table Section End -->

@push('scripts')
<script>
    const birthYear = document.getElementById("category-filter");

    birthYear.addEventListener("change", () => {
        let playerRows = document.querySelectorAll("#trainings tr[data-cat]");
        for(playerRow of playerRows){
            if(birthYear.value != 0){
                if(birthYear.value !== playerRow.getAttribute("data-cat")){
                    playerRow.style.display = "none";
                } else {
                    playerRow.style.display = "";
                }
            } else {
                playerRow.style.display = "";
            }
        }
    });


</script>
@endpush

@endsection