@extends('layouts.base', ['title' => $title])

@section('content')
<div class="rs-point-table sec-spacer">
    <div class="container">
        <div class="tab-content responsive-event-center">
            <table class="events-player-table">
                <tr>
                    <td class="team-name">Dátum</td>
                    <td>Čas</td>
                    <td>Poznámka</td>
                    <td>Kategória</td>
                    <td>Účasť</td>
                </tr>
                @foreach ($events as $event)                
                <tr>
                    <td>{{ $event->event_date->isoFormat('D. M. Y') }}</td>
                    <td>{{ $event->event_date->isoFormat('H:mm') }}</td>
                    <td>{{ $event->note }}</td>
                    <td>{{ $event->category->name }}</td>
                    @php
                    $participant = $event->participants()->where('player_id',Auth::user()->id)->first();
                    @endphp
                    <td>
                        <p class="participate-btn-wrapper">
                            @if ($participant->user_submitted)
                            @if ($participant->is_present)
                            <i title="Zúčastním sa" class="fa fa-2x fa-check fa-check-old"></i>
                            @else
                            <i title="Nezúčastním sa" class="fa fa-2x fa-times fa-times-old"></i>
                            @endif
                            @else
                            <div class="events-participate-btn-wrapper">
                                <form method="POST"
                                    action="{{ route('participate', ['participate' => 'no', 'event' => $event]) }}">
                                    @csrf
                                    <button class="participate-btn">
                                        <i title="Nezúčastním sa" class="fa fa-2x fa-times"></i>
                                    </button>
                                </form>
                                <form method="POST"
                                    action="{{ route('participate', ['participate' => 'yes', 'event' => $event]) }}">
                                    @csrf
                                    <button class="participate-btn">
                                        <i title="Zúčastním sa" class="fa fa-2x fa-check"></i>
                                    </button>
                                </form>
                            </div>
                            @endif
                        </p>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>


@endsection