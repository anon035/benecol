@extends('layouts.base', ['title' => 'Dochádzka hráča'])
@section('content')
@php
$eventTypes = [
'training' => 'Tréning',
'match' => 'Zápas',
'tournament' => 'Turnaj',
]
@endphp
<div class="rs-point-table sec-spacer">
    <div class="container">
        <div class="tab-content attendance-admin-radio">
            <div id="tre" class="tab-pane fade in active">
                <div class="content player-attendance">
                    <div class="content-heading">
                        <p class="attendance-admin-width30">Meno</p>
                        <p class="attendance-admin-width30">Udalosť</p>
                        <p class="attendance-admin-width30">Typ</p>
                        <p class="attendance-admin-width20">Účasť</p>
                        <p class="attendance-admin-width20 text-align-left text-align-center">Akcia</p>
                    </div>
                    @foreach ($attendance as $single)
                    <div class="content-body">
                        <p class="attendance-admin-width30">
                            {{ ($single->player ? $single->player->name : '') . ' ' . ($single->player ? $single->player->surname : '') }}
                        </p>
                        <p class="attendance-admin-width30">
                            {{ $single->event_date->isoFormat('D. M. Y') . ' - ' .( $single->category ? $single->category->name:'') . ' (vytvoril: ' . ($single->trainer ? $single->trainer->name : '') . ' ' . ($single->trainer ? $single->trainer->surname : '') . ')' }}
                        </p>
                        <p class="attendance-admin-width30">
                            {{ $eventTypes[$single->event_type] }}
                        </p>
                        <div class="attendance-admin-width20 text-align-center">
                            <form method="POST" onchange="this.submit()"
                                action="{{ route('attendance.update', ['attendance' => $single]) }}">
                                @csrf
                                @method('PUT')
                                <label>
                                    <input type="radio" {{ ($single->is_present ? '' : 'checked') }} name="is_present"
                                        value="0" />
                                    <span><i class="fa fa-times"
                                            {{ ($single->is_present ? 'style=color:lightgray;cursor:pointer;' : '') }}></i></span>
                                </label>
                                <label>
                                    <input type="radio" {{ ($single->is_present ? 'checked' : '') }} name="is_present"
                                        value="1" />
                                    <span><i class="fa fa-check"
                                            {{ ($single->is_present ? '' : 'style=color:lightgray;cursor:pointer;') }}></i></span>
                                </label>
                            </form>
                        </div>
                        <div class="attendance-admin-width20 text-align-center">
                            <a href="#" onclick="event.preventDefault();
                if (confirm('Odobrať hráča z dochádzky natrvalo?')){
                        document.getElementById('delete-form-{{$single->id}}').submit();}"><i title="Vymazať"
                                    class="fa fa-trash"></i>
                            </a>
                            <form id="delete-form-{{$single->id}}" method="POST"
                                action="{{ route('attendance.destroy', ['attendance' => $single]) }}"
                                style="display:none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
