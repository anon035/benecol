@extends('layouts.base', ['title' => 'Migrácia hráčov'])

@section('content')

<div class="rs-point-table sec-spacer">
    <div class="container">
        <form onsubmit="return atLeastOneCheckboxChecked()" method="POST" action="{{ route('migration') }}">
            @csrf
            @method('PUT')

            <ul class="point-menu">
                <li class="active">
                    <a data-toggle="tab" href="#all">Všetci</a>
                </li>
                @foreach ($categories as $category)
                @if (!$category->users->isEmpty())
                <li>
                    <a data-toggle="tab" href="#{{ $category->id }}">
                        {{ $category->name }}
                    </a>
                </li>
                @endif
                @endforeach
                @foreach ($birthYears as $year => $players)
                <li>
                    <a data-toggle="tab" href="#{{ $year }}">
                        {{ $year }}
                    </a>
                </li>
                @endforeach
            </ul>
            <div class="notification-photo-input">
                <p>Vyberte novú kategóriu: *</p>
                <select required class="custom-input form-control" name="new_category" >
                    <option value="">
                        Vyberte novú kategóriu
                    </option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="tab-content responsive-event-center">
                <div id="all" class="tab-pane fade in active">
                    <table>
                        <tr>
                            <td>Registračné číslo</td>
                            <td>Meno</td>
                            <td>Dátum narodenia</td>
                            <td>Kategória</td>
                            <td>
                                Migrovať
                                <input type="checkbox" class="notification-select-all bg-light">
                            </td>
                        </tr>
                        @foreach ($categories as $category)
                        @if (!$category->users->isEmpty())
                        @foreach ($category->users as $player)
                        <tr>
                            <td>{{ $player->registration_number }}</td>
                            <td>{{ $player->name . ' ' . $player->surname }}</td>
                            <td>{{ $player->birth_date->isoFormat('D. M. Y') }}</td>
                            <td>{{ $category->name }}</td>
                            <td class="text-align-center">
                                <input name="players[]" value="{{ $player->id }}" type="checkbox"
                                    class="notification-checkbox" />
                            </td>
                        </tr>
                        @endforeach
                        @endif
                        @endforeach
                    </table>
                </div>
                @foreach ($categories as $category)
                @if (!$category->users->isEmpty())
                <div id="{{ $category->id }}" class="tab-pane fade">
                    <table>
                        <tr>
                            <td>Registračné číslo</td>
                            <td>Meno</td>
                            <td>Dátum narodenia</td>
                            <td>Kategória</td>
                            <td>
                                Migrovať
                                <input type="checkbox" class="notification-select-all bg-light">
                            </td>
                        </tr>
                        @foreach ($category->users as $player)
                        <tr>
                            <td>{{ $player->registration_number }}</td>
                            <td>{{ $player->name . ' ' . $player->surname }}</td>
                            <td>{{ $player->birth_date->isoFormat('D. M. Y') }}</td>
                            <td>{{ $category->name }}</td>
                            <td class="text-align-center">
                                <input name="players[]" value="{{ $player->id }}" type="checkbox"
                                    class="notification-checkbox" />
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                @endif
                @endforeach
                @foreach ($birthYears as $year => $players)
                <div id="{{ $year }}" class="tab-pane fade">
                    <table>
                        <tr>
                            <td>Registračné číslo</td>
                            <td>Meno</td>
                            <td>Dátum narodenia</td>
                            <td>Kategória</td>
                            <td>
                                Migrovať
                                <input type="checkbox" class="notification-select-all bg-light">
                            </td>
                        </tr>
                        @foreach ($players as $player)
                        <tr>
                            <td>{{ $player->registration_number }}</td>
                            <td>{{ $player->name . ' ' . $player->surname }}</td>
                            <td>{{ $player->birth_date->isoFormat('D. M. Y') }}</td>
                            <td>{{ $player->category->name }}</td>
                            <td class="text-align-center">
                                <input name="players[]" value="{{ $player->id }}" type="checkbox"
                                    class="notification-checkbox" />
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                @endforeach
            </div>
            <div class="news-btn notification-btn send-btn-wrapper">
                <button type="submit" class="custom-btn"><i title="Migrovať" class="fa fa-random"></i> Migrovať</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    // uncheck all checkboxes when change category select
        let categoryItems = document.querySelectorAll(".point-menu li");
        let checkboxes = document.querySelectorAll("input[type=checkbox]");
        categoryItems.forEach(cat => {
            cat.addEventListener("click", () => {
                if(cat.className != 'active'){
                    checkboxes.forEach(checkbox => {
                        checkbox.checked = false;
                    });
                }
            })
        });
        
    // check if at least one checkbox is checked
    atLeastOneCheckboxChecked = () => {
        if(!Array.prototype.slice.call(checkboxes).some(x => x.checked)){
            return false;
        }
        return true;     
    }

</script>
@endpush

@endsection