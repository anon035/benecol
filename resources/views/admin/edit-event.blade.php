@extends('layouts.base', ['title' => 'Upraviť udalosť'])

@section('content')
<!-- Point Table Section Start -->
<div class="rs-point-table sec-spacer">
    <div class="container">
        @if ($errors->any())
        @foreach ($errors->all() as $error)
        <p class="error-message">{{ $error }}</p>
        @endforeach
        @endif
        @php
        if (get_browser()->browser == 'Safari') {
        $eventDateFormat = 'D. M. Y';
        } else {
        $eventDateFormat = 'YYYY-MM-DD';
        }
        @endphp
        <div class="tab-content">
            <form method="POST" action="{{ route('events.update-details', ['event' => $event->id]) }}">
                @csrf
                @method('PUT')
                <h2>
                    @switch($event->event_type)
                        @case('training')
                            Tréning
                            @break
                        @case('match')
                            Zápas
                            @break
                        @case('tournament')
                        Turnaj
                        @break                            
                    @endswitch
                </h2>
                <div class="create-event-inputs">
                    <input type="hidden" value="{{ $event->event_type }}" name="event_type">
                    <div class="event-additional-title">
                        <p>Dátum udalosti: </p>
                        <input class="custom-input form-control"
                            value="{{ $event->event_date->isoFormat($eventDateFormat) }}" type="date" name="event_date"
                            required placeholder="dd.mm.rrrr" />
                    </div>
                    <div class="event-additional-title">
                        <p>Čas udalosti: </p>
                        <input class="custom-input form-control" value="{{ $event->event_date->isoFormat('HH:mm') }}"
                            type="time" name="event_time" required placeholder="Čas udalosti" />
                    </div>
                    <div class="event-additional-title">
                        <p>Poznámka: </p>
                        <input maxlength="80" class="custom-input form-control" value="{{ $event->note ?? '' }}"
                            type="text" name="note" placeholder="Poznámka" />
                    </div>
                    <div id="category-select">
                        <p>Kategória: </p>
                        <select class="custom-input form-control" name="category_id">
                            <option>
                                Vyberte
                            </option>
                            @foreach ($categories as $category)
                            <option {{ ($event->category_id == $category->id ? 'selected' : '') }}
                                value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                @if ($event->event_type != 'training')
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
                            <input type="checkbox" title="Vyberte všetkých v kategórií" class="notification-select-all">
                        </p>
                    </div>
                    @foreach ($category->users as $user)
                    @if ($user->user_type == 'player')
                    <div class="content-body">
                        <p>{{ $user->registration_number }}</p>
                        <p>{{ $user->dress_number }}</p>
                        <p>{{ $user->name . ' ' . $user->surname }}</p>
                        <p><input {{ in_array($user->id, $participants) ? 'checked' : '' }}
                                name="participants[][player_id]" title="Zaškrtnutím vyberiete hráča"
                                value="{{ $user->id }}" class="notification-checkbox" type="checkbox"></p>
                    </div>
                    @endif
                    @endforeach
                </div>
                @endforeach
                @endif

                <div class="ce-btn-wrapper news-btn notification-btn">
                    <button class="custom-btn"><i title="Odoslať" class="fa fa-share"></i> Upraviť</button>
                </div>
            </form>
        </div>

    </div>

</div>
<!-- Point Table Section End -->

@endsection