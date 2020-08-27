@extends('layouts.base', ['title' => 'Moja Dochádzka'])

@section('content')

<!-- Point Table Section Start -->
<div class="rs-point-table sec-spacer">
    <div class="container">
        <ul class="point-menu">
            <li class="active">
                <a data-toggle="tab" href="#tre">Tréningy</a>
            </li>
            <li><a data-toggle="tab" href="#zap">Zápasy<span class="new-event-notification"></span></a></li>
            <li><a data-toggle="tab" href="#tur">Turnaje</a></li>
        </ul>

        <div class="tab-content responsive-event-center">
            <div id="tre" class="tab-pane fade in active">
                <table>
                    <tr>
                        <td class="team-name">Dátum</td>
                        <td>Kategória</td>
                        <td>Účasť</td>
                    </tr>
                    @foreach ($trainings as $attendance)
                    <tr>
                        <td class="team-name">{{ $attendance->event_date->isoFormat('D. M. Y') }}</td>
                        <td>{{ $attendance->category->name }}</td>
                        <td>
                            @if ($attendance->is_present)
                            <i title="Zúčastnil sa" class="fa fa-2x fa-check fa-times-old"></i>
                            @else
                            <i title="Zúčastnil sa" class="fa fa-2x fa-times fa-times-old"></i>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
            <div id="zap" class="tab-pane fade">
                <table>
                    <tr>
                        <td class="team-name">Dátum</td>
                        <td>Kategória</td>
                        <td>Účasť</td>
                    </tr>
                    @foreach ($matches as $attendance)
                    <tr>
                        <td class="team-name">{{ $attendance->event_date->isoFormat('D. M. Y') }}</td>
                        <td>{{ $attendance->category->name }}</td>
                        <td>
                            @if ($attendance->is_present)
                            <i title="Zúčastnil sa" class="fa fa-2x fa-check fa-times-old"></i>
                            @else
                            <i title="Zúčastnil sa" class="fa fa-2x fa-times fa-times-old"></i>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
            <div id="tur" class="tab-pane fade">
                <table>
                    <tr>
                        <td class="team-name">Dátum</td>
                        <td>Kategória</td>
                        <td>Účasť</td>
                    </tr>
                    @foreach ($tournaments as $attendance)
                    <tr>
                        <td class="team-name">{{ $attendance->event_date->isoFormat('D. M. Y') }}</td>
                        <td>{{ $attendance->category->name }}</td>
                        <td>
                            @if ($attendance->is_present)
                            <i title="Zúčastnil sa" class="fa fa-2x fa-check fa-times-old"></i>
                            @else
                            <i title="Zúčastnil sa" class="fa fa-2x fa-times fa-times-old"></i>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Point Table Section End -->

@endsection