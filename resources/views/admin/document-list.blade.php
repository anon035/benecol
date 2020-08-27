@extends('layouts.base', ['title' => 'Dokumenty'])
@section('content')
<div class="rs-point-table sec-spacer">
    <div class="container">
        @if ($errors->any())
        @foreach ($errors->all() as $error)
        <p class="error-message">{{ $error }}</p>
        @endforeach
        @endif
        <div class="tab-content">
            <form method="POST" action="{{ ($document ? route('documents.update', ['document' => $document]) : route('documents.store')) }}" enctype="multipart/form-data">
                @csrf
                @if ($document)
                @method('PUT')
                <h3 class="title-bg">Upraviť dokument</h3>
                @else
                <h3 class="title-bg">Pridať nový dokument</h3>
                @endif
                <div class="notification-photo-input">
                    <p>Názov dokumentu: </p>
                    <input class="custom-input form-control" value="{{ ($document && $document->name ? $document->name : '') }}" type="text" required name="name" placeholder="Zadajte názov dokumentu">
                </div>
                <div class="notification-photo-input">
                    <p>Súbor: </p>
                    @if ($document && $document->path)
                    <a href="{{ asset($document->path) }}" target="_blank">
                        Dokument
                        <small>({{ $document->name }})</small></a>
                    @endif
                    <input class="custom-input form-control" type="file" {{ ($document ? '' : 'required') }} name="file" placeholder="Vyberte súbor">
                </div>
                <div class="news-btn notification-btn send-btn-wrapper">
                    <button type="submit" class="custom-btn"><i title="Odoslať" class="fa fa-plus"></i>{{ ($document ? 'Upraviť' : 'Pridať') }}</button>
                </div>
            </form>
            <h3 class="title-bg mobile-hide">Zoznam dokumentov</h3>
            <div class="tab-content responsive-event-center document-list-wrapper">
                <div id="all" class="tab-pane fade in active">
                    <table>
                        <tbody>
                            <tr>
                                <td style="team-name">Názov súboru</td>
                                <td class="desktop"></td>
                                <td>Akcia</td>
                                <td>Poradie</td>
                            </tr>
                            @foreach ($documents as $document)
                            <tr>
                                <td style="team-name">
                                    <a target="_blank" href="{{ asset($document->path) }}">
                                        {{ $document->name }}
                                    </a>
                                </td>
                                <td class="desktop"></td>
                                <td>
                                    <a href="{{ route('documents.edit', ['document' => $document->id]) }}"><i class="fa fa-edit"></i></a>
                                    <a href="#" onclick="
                                        event.preventDefault();
                                        if (confirm('Vymazať document natrvalo?')) {
                                            document.getElementById('delete-form-{{$document->id}}').submit();
                                            }
                                            ">
                                        <i title="Vymazať" class="fa user-list-icon fa-trash"></i>
                                    </a>
                                    <form id="delete-form-{{$document->id}}" action="{{ route('documents.destroy', ['document' => $document->id]) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                                <td>
                                    <input name="reorder[{{ $document->id }}]" value="{{ $document->order }}" class="order" data-reorder-input type="number" />
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="send-btn-wrapper">
                        <form method="POST" name="reorderForm" action="{{ route('documents.reorder') }}" onsubmit="sendReorder(event)">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="custom-btn"><i class="fa fa-paper-plane"></i> Odoslať</button>
                            <div id="order-input-wrapper">

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const sendReorder = (e) => {
        e.preventDefault();
        let inputWrapper = document.getElementById('order-input-wrapper');
        inputWrapper.innerHTML = '';
        let inputs = document.querySelectorAll('[data-reorder-input]').forEach(input => {
            let newInput = document.createElement('input');
            newInput.name = input.name;
            newInput.value = input.value;
            newInput.type = 'hidden';
            inputWrapper.appendChild(newInput);
        });

        e.target.submit();
    }
</script>
@endpush
