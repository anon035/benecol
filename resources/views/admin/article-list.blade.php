@extends('layouts.base', ['title' => 'Novinky'])
@section('content')
<div class="rs-point-table sec-spacer">


    <div class="container">
        <a href="{{ route('article.create') }}">
            <button class="custom-btn margin-bottom-30">
                <i title="Vytvoriť" class="fa fa-plus"></i> Pridať novinku
            </button>
        </a>
        <div class="tab-content">
            <div id="sfl" class="tab-pane fade in active">
                <table>
                    <tr>
                        <td class="team-name">Názov</td>
                        <td>Dátum vytvorenia</td>
                        <td>Poradie (zostupne)</td>
                        <td>Akcia</td>
                    </tr>
                    @foreach ($articles as $article)
                    <tr>
                        <td class="team-name"><a
                                href="{{ route('article.single', ['article' => $article]) }}">{{ $article->title }}</a>
                        </td>
                        <td>{{ $article->created_at->isoFormat('D. M. Y') }}</td>
                        <td>
                            <input name="reorder[{{ $article->id }}]" value="{{ $article->order }}" class="order"
                                data-reorder-input type="number" />
                        </td>
                        <td>
                            <a href="{{ route('article.edit', ['article' => $article]) }}"><i
                                    class="fa fa-edit"></i></a>
                            <a href="#" onclick="event.preventDefault();
                                    if (confirm('Vymazať novinku natrvalo?')){
                                            document.getElementById('delete-form-{{$article->id}}').submit();}"><i
                                    title="Vymazať" class="fa user-list-icon fa-trash"></i>
                            </a>
                            <form id="delete-form-{{$article->id}}"
                                action="{{ route('article.destroy', ['article' => $article->id]) }}" method="POST"
                                style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table>
                <div class="send-btn-wrapper">
                    <form method="POST" name="reorderForm" action="{{ route('article.reorder') }}"
                        onsubmit="sendReorder(event)">
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