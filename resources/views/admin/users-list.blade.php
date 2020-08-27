@extends('layouts.base', ['title' => 'Použivatelia'])

@section('content')

<!-- Point Table Section Start -->
<div class="rs-point-table sec-spacer">


    <div class="container">
        <a href="{{ route('users.create') }}">
            <button class="custom-btn margin-bottom-30">
                <i title="Vytvoriť" class="fa fa-plus"></i> Registrácia člena
            </button>
        </a>
        <ul class="point-menu">
            <li class="active">
                <a data-toggle="tab" href="#players">Hráči</a>
            </li>
            <li>
                <a data-toggle="tab" href="#coaches">Tréneri</a>
            </li>
        </ul>

        <div class="tab-content scroll-width">
            <div id="players" class="tab-pane fade in active">
                <label for="hasSuit">Filter: </label>
                <div class="filter-wrapper">
                    <select class="custom-input" id="hasSuit">
                        <option value="-1">Vyberte súpravu: </option>
                        <option value="1">Áno</option>
                        <option value="0">Nie</option>
                    </select>
                    <p> alebo </p>
                    <select class="custom-input" id="birthYear">
                        <option value="0">Vyberte rok narodenia: </option>
                        @foreach ($playersBirthYear as $birthYear)
                        <option value="{{ $birthYear->year }}">{{ $birthYear->year }}</option>
                        @endforeach
                    </select>
                </div>
                <table>
                    <tr>
                        <td>Dres</td>
                        <td>Registračné číslo</td>
                        <td>Meno</td>
                        <td>Dátum Narodenia</td>
                        <td>E-mail</td>
                        <td>Tel. Číslo</td>
                        <td>Kategória</td>
                        <td>Akcia</td>
                    </tr>
                    @forelse ($players as $player)
                    <tr data-suit="{{ $player->has_suit }}" data-year="{{ $player->birth_date->isoFormat('Y') }}">
                        <td>{{ $player->dress_number }}</td>
                        <td>{{ $player->registration_number }}</td>
                        <td>{{ $player->surname . ' ' . $player->name }}</td>
                        <td>{{ $player->birth_date->isoFormat('D. M. Y') }}</td>
                        <td>{{ $player->email }}</td>
                        <td>{{ $player->phone_number }}</td>
                        <td>{{ $player->category ? $player->category->name : '' }}</td>
                        <td class="action-icons">
                            <a href="{{ route('users.attendance', ['user' => $player]) }}">
                                <i class="fa fa-id-badge">
                                </i>
                            </a>
                            <a href="{{ route('users.edit', ['user' => $player]) }}"><i class="fa fa-edit"></i></a>
                            @if ($player->trashed())
                            <a href="#"
                                onclick="event.preventDefault();
                                                            document.getElementById('unlock-form-{{$player->id}}').submit();">
                                <i title="Odomknúť" class="fa user-list-icon fa-lock"></i></a>
                            <form id="unlock-form-{{$player->id}}"
                                action="{{ route('users.unlock', ['user' => $player]) }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                            @else
                            <a href="#"
                                onclick="event.preventDefault();
                                                            document.getElementById('lock-form-{{$player->id}}').submit();">
                                <i title="Zamknúť" class="fa user-list-icon fa-unlock"></i></a>
                            <form id="lock-form-{{$player->id}}" action="{{ route('users.lock', ['user' => $player]) }}"
                                method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                            @endif
                            <a href="#"
                                onclick="event.preventDefault();
                                        if (confirm('Resetovať heslo?')){
                                                        document.getElementById('reset-form-{{$player->id}}').submit();}"><i
                                    class="fa user-list-icon fa-key" aria-hidden="true" title="Reset hesla"></i></a>
                            <form id="reset-form-{{$player->id}}"
                                action="{{ route('users.reset-password', ['user' => $player]) }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                            <a href="#"
                                onclick="event.preventDefault();
                                        if (confirm('Vymazať hráča natrvalo?')){
                                                        document.getElementById('delete-form-{{$player->id}}').submit();}"><i
                                    title="Vymazať" class="fa user-list-icon fa-trash"></i></a>
                            <form id="delete-form-{{$player->id}}"
                                action="{{ route('users.destroy', ['user' => $player]) }}" method="POST"
                                style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @empty
                    <div class="box-bubble sb4">Pre zobrazenie vytvorte hráča</div>
                    @endforelse
                </table>
            </div>
            <!-- end zoznam hracov -->

            <!-- zoznam trenerov -->
            <div id="coaches" class="tab-pane fade">
                <table>
                    <tr>
                        <td>Registračné číslo</td>
                        <td>Meno</td>
                        <td>Dátum Narodenia</td>
                        <td>E-mail</td>
                        <td>Tel. Číslo</td>
                        <td>Kategória</td>
                        <td>Akcia</td>
                    </tr>
                    @forelse ($trainers as $trainer)

                    <tr>
                        <td>{{ $trainer->registration_number }}</td>
                        <td>{{ $trainer->surname . ' ' . $trainer->name }}</td>
                        <td>{{ $trainer->birth_date->isoFormat('D. M. Y') }}</td>
                        <td>{{ $trainer->email }}</td>
                        <td>{{ $trainer->phone_number }}</td>
                        <td>{{ $trainer->category ? $trainer->category->name : '' }}</td>
                        <td>
                            <a href="{{ route('users.edit', ['user' => $trainer]) }}"><i class="fa fa-edit"></i></a>
                            @if ($trainer->trashed())
                            <a href="#"
                                onclick="event.preventDefault();
                                                                document.getElementById('unlock-form-{{$trainer->id}}').submit();">
                                <i title="Odomknúť" class="fa user-list-icon fa-lock"></i></a>
                            <form id="unlock-form-{{$trainer->id}}"
                                action="{{ route('users.unlock', ['user' => $trainer]) }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                            @else
                            <a href="#"
                                onclick="event.preventDefault();
                                                                document.getElementById('lock-form-{{$trainer->id}}').submit();">
                                <i title="Zamknúť" class="fa user-list-icon fa-unlock"></i></a>
                            <form id="lock-form-{{$trainer->id}}"
                                action="{{ route('users.lock', ['user' => $trainer]) }}" method="POST"
                                style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                            @endif
                            <a href="#"
                                onclick="event.preventDefault();
                                        if (confirm('Resetovať heslo?')){
                                                        document.getElementById('reset-form-{{$trainer->id}}').submit();}"><i
                                    class="fa user-list-icon fa-key" aria-hidden="true" title="Reset hesla"></i></a>
                            <form id="reset-form-{{$trainer->id}}"
                                action="{{ route('users.reset-password', ['user' => $trainer]) }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                            <a href="#"
                                onclick="event.preventDefault();
                                                    if (confirm('Vymazať trénera natrvalo?')){
                                                                    document.getElementById('delete-form-{{$trainer->id}}').submit();}"><i
                                    title="Vymazať" class="fa user-list-icon fa-trash"></i></a>
                            <form id="delete-form-{{$trainer->id}}"
                                action="{{ route('users.destroy', ['user' => $trainer]) }}" method="POST"
                                style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @empty
                    <div class="box-bubble sb4">Pre zobrazenie vytvorte trénera</div>
                    @endforelse
                </table>
            </div>
            <!-- end zoznam trenerov -->
        </div>
    </div>
</div>
<!-- Point Table Section End -->

@push('scripts')
<script>
    const hasSuit = document.getElementById("hasSuit");
    const birthYear = document.getElementById("birthYear");
    hasSuit.addEventListener("change", () => {
        if(birthYear.value !== 0){
            birthYear.value = 0;
        }
        let playerRows = document.querySelectorAll("#players tr[data-suit]");
        for (playerRow of playerRows) {
            if (hasSuit.value == 1) {
            if (playerRow.getAttribute("data-suit") == 1) {
                playerRow.style.display = "";
            } else {
                playerRow.style.display = "none";
            }
            } else if (hasSuit.value == 0) {
            if (playerRow.getAttribute("data-suit") == 0) {
                playerRow.style.display = "";
            } else {
                playerRow.style.display = "none";
            }
            } else if (hasSuit.value == -1) {
            playerRow.style.display = "";
            }
        }
    });

    birthYear.addEventListener("change", () => {
        if(hasSuit.value !== -1){
            hasSuit.value = -1;
        }
        let playerRows = document.querySelectorAll("#players tr[data-year]");
        for(playerRow of playerRows){
            if(birthYear.value != 0){
                if(birthYear.value !== playerRow.getAttribute("data-year")){
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
