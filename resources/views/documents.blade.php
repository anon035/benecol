@extends('layouts.base', ['title' => 'Dokumenty'])

@section('content')

<div class="rs-point-table sec-spacer">
    <div class="container">
        <div class="tab-content">
            <h3 class="title-bg">Zoznam dokumentov</h3>
            <div class="tab-content responsive-event-center document-list-wrapper">
                <div id="all" class="tab-pane fade in active">
                    <table>
                        <tbody>
                            <tr>
                                <td style="team-name">Názov súboru</td>
                            </tr>
                            @foreach ($documents as $document)
                            <tr>
                                <td style="team-name">
                                    <a target="_blank" href="{{ asset($document->path) }}">
                                        {{ $document->name }}
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection