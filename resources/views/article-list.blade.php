@extends('layouts.base', ['title' => 'Novinky'])
@section('content')

<div class="rs-point-table sec-spacer">
    <div class="container">
        <div class="tab-content">
            <div id="sfl" class="tab-pane fade in active mobile-scrollX">
                <table>
                    <tr>
                        <td></td>
                        <td class="team-name">Názov</td>
                        <td>Popis</td>
                        <td>Dátum vytvorenia</td>
                    </tr>
                    @foreach ($articles as $article)
                    <tr>
                        <td><img src="{{ $article->photo_path }}" /></td>
                        <td class="team-name"><a
                                href="{{ route('article.single', ['article' => $article]) }}">{{ $article->title }}</a>
                        </td>
                        <td>
                            <p class="margin-null">
                                {{ strip_tags(substr($article->content, 0, 100)) }}...
                            </p>
                        </td>
                        <td>{{ $article->created_at->isoFormat('D. M. Y') }}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>

@endsection