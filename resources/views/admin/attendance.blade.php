@extends('layouts.base', ['title' => 'Dochádzka'])

@section('content')
<!-- Point Table Section Start -->
<div class="rs-point-table sec-spacer">
    <div class="container">
        <a href="{{ route('attendance.create') }}">
            <button class="custom-btn margin-bottom-30">
                <i title="Vytvoriť dochádzku" class="fa fa-plus"></i> Vytvoriť dochádzku
            </button>
        </a>
        <ul class="point-menu">
            <li class="active"><a data-toggle="tab" href="#tre">Tréningy</a></li>
            <li><a data-toggle="tab" href="#zap">Zápasy</a></li>
            <li><a data-toggle="tab" href="#tur">Turnaje</a></li>
        </ul>
        <div class="tab-content attendance-admin-radio">
            <div id="tre" class="tab-pane fade in active">
                @foreach ($trainings as $attendanceId => $attendance)
                <button class="collapsible">
                    {{ $attendanceId }}
                </button>
                <div class="content">
                    <div class="content-heading">
                        <p class="attendance-admin-width30">ID</p>
                        <p class="attendance-admin-width30">Meno</p>
                        <p class="attendance-admin-width20">Účasť</p>
                        <p class="attendance-admin-width20 text-align-left text-align-center">Akcia</p>
                    </div>
                    @foreach ($attendance as $player)
                    <div class="content-body">
                        <p class="attendance-admin-width30">{{ $player->player->registration_number }}</p>
                        <p class="attendance-admin-width30">{{ $player->player->name . ' ' . $player->player->surname }}
                        </p>
                        <div class="attendance-admin-width20 text-align-center">
                            <form method="POST" onchange="this.submit()"
                                action="{{ route('attendance.update', ['attendance' => $player]) }}">
                                @csrf
                                @method('PUT')
                                <label>
                                    <input type="radio" {{ ($player->is_present ? '' : 'checked') }} name="is_present"
                                        value="0" />
                                    <span><i class="fa fa-times"
                                            {{ ($player->is_present ? 'style=color:lightgray;cursor:pointer;' : '') }}></i></span>
                                </label>
                                <label>
                                    <input type="radio" {{ ($player->is_present ? 'checked' : '') }} name="is_present"
                                        value="1" />
                                    <span><i class="fa fa-check"
                                            {{ ($player->is_present ? '' : 'style=color:lightgray;cursor:pointer;') }}></i></span>
                                </label>
                            </form>
                        </div>
                        <div class="attendance-admin-width20 text-align-center">
                            <a href="#" onclick="event.preventDefault();
                                if (confirm('Odobrať hráča z dochádzky natrvalo?')){
                                        document.getElementById('delete-form-{{$player->id}}').submit();}"><i
                                    title="Vymazať" class="fa fa-trash"></i>
                            </a>
                            <form id="delete-form-{{$player->id}}" method="POST"
                                action="{{ route('attendance.destroy', ['attendance' => $player]) }}"
                                style="display:none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endforeach
            </div>
            <div id="zap" class="tab-pane fade in ">
                @foreach ($matches as $attendanceId => $attendance)
                <button class="collapsible">
                    {{ $attendanceId }}
                </button>
                <div class="content">
                    <div class="content-heading">
                        <p class="attendance-admin-width30">ID</p>
                        <p class="attendance-admin-width30">Meno</p>
                        <p class="attendance-admin-width20">Účasť</p>
                        <p class="attendance-admin-width20 text-align-left text-align-center">Akcia</p>
                    </div>
                    @foreach ($attendance as $player)
                    <div class="content-body">
                        <p class="attendance-admin-width30">{{ $player->player->registration_number }}</p>
                        <p class="attendance-admin-width30">{{ $player->player->name . ' ' . $player->player->surname }}
                        </p>
                        <div class="attendance-admin-width20 text-align-center">
                            <form method="POST" onchange="this.submit()"
                                action="{{ route('attendance.update', ['attendance' => $player]) }}">
                                @csrf
                                @method('PUT')
                                <label>
                                    <input type="radio" {{ ($player->is_present ? '' : 'checked') }} name="is_present"
                                        value="0" />
                                    <span><i class="fa fa-times"
                                            {{ ($player->is_present ? 'style=color:lightgray;cursor:pointer;' : '') }}></i></span>
                                </label>
                                <label>
                                    <input type="radio" {{ ($player->is_present ? 'checked' : '') }} name="is_present"
                                        value="1" />
                                    <span><i class="fa fa-check"
                                            {{ ($player->is_present ? '' : 'style=color:lightgray;cursor:pointer;') }}></i></span>
                                </label>
                            </form>
                        </div>
                        <div class="attendance-admin-width20 text-align-center">
                            <a href="#" onclick="event.preventDefault();
                                    if (confirm('Odobrať hráča z dochádzky natrvalo?')){
                                            document.getElementById('delete-form-{{$player->id}}').submit();}"><i
                                    title="Vymazať" class="fa fa-trash"></i>
                            </a>
                            <form id="delete-form-{{$player->id}}" method="POST"
                                action="{{ route('attendance.destroy', ['attendance' => $player]) }}"
                                style="display:none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endforeach
            </div>
            <div id="tur" class="tab-pane fade in">
                @foreach ($tournaments as $attendanceId => $attendance)
                <button class="collapsible">
                    {{ $attendanceId }}
                </button>
                <div class="content">
                    <div class="content-heading">
                        <p class="attendance-admin-width30">ID</p>
                        <p class="attendance-admin-width30">Meno</p>
                        <p class="attendance-admin-width20">Účasť</p>
                        <p class="attendance-admin-width20 text-align-left text-align-center">Akcia</p>
                    </div>
                    @foreach ($attendance as $player)
                    <div class="content-body">
                        <p class="attendance-admin-width30">{{ $player->player->registration_number }}</p>
                        <p class="attendance-admin-width30">{{ $player->player->name . ' ' . $player->player->surname }}
                        </p>
                        <div class="attendance-admin-width20 text-align-center">
                            <form method="POST" onchange="this.submit()"
                                action="{{ route('attendance.update', ['attendance' => $player]) }}">
                                @csrf
                                @method('PUT')
                                <label>
                                    <input type="radio" {{ ($player->is_present ? '' : 'checked') }} name="is_present"
                                        value="0" />
                                    <span><i class="fa fa-times"
                                            {{ ($player->is_present ? 'style=color:lightgray;cursor:pointer;' : '') }}></i></span>
                                </label>
                                <label>
                                    <input type="radio" {{ ($player->is_present ? 'checked' : '') }} name="is_present"
                                        value="1" />
                                    <span><i class="fa fa-check"
                                            {{ ($player->is_present ? '' : 'style=color:lightgray;cursor:pointer;') }}></i></span>
                                </label>
                            </form>
                        </div>
                        <div class="attendance-admin-width20 text-align-center">
                            <a href="#" onclick="event.preventDefault();
                                    if (confirm('Odobrať hráča z dochádzky natrvalo?')){
                                            document.getElementById('delete-form-{{$player->id}}').submit();}"><i
                                    title="Vymazať" class="fa fa-trash"></i>
                            </a>
                            <form id="delete-form-{{$player->id}}" method="POST"
                                action="{{ route('attendance.destroy', ['attendance' => $player]) }}"
                                style="display:none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- Point Table Section End -->

@endsection
