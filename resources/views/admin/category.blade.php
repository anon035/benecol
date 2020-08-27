@extends('layouts.base', ['title' => 'Kategórie'])

@section('content')

<!-- Point Table Section Start -->
<div class="rs-point-table sec-spacer">
    <div class="container">
        @if ($errors->any())
        @foreach ($errors->all() as $error)
        <p class="error-message">{{ $error }}</p>
        @endforeach
        @endif
        <div class="tab-content responsive-event-center">
            <div class="membership-admin-base-topay">
                @if($category)
                <form method="POST" action="{{ route('category.update', ['category' => $category]) }}">
                    @method('PUT')
                    @else
                    <form method="POST" action="{{ route('category.store') }}">
                        @endif
                        @csrf
                        <label for="name">{{ $category ? 'Upraviť' : 'Vytvoriť' }} Kategóriu</label>
                        <div class="create-category-cat-alias">
                            <input value="{{ $category && $category->name ? $category->name : '' }}" required
                                minlength="1" type="text" class="custom-input form-control" name="name" id="name"
                                placeholder="Názov kategórie napr. U19">
                            <label for="trainings_visible">Zobrazuje sa v tréningoch</label>
                            <input type="hidden" value="0" name="trainings_visible" />
                            <p>
                                <input type="checkbox" class="notification-checkbox show-training-checkbox"
                                    {{ ($category && $category->trainings_visible ? 'checked' : (!$category ? 'checked' : '')) }}
                                    value="1" id="trainings_visible" name="trainings_visible" />
                                <small><i class="fa fa-long-arrow-left"></i> Odškrtnite ak si želáte
                                    nezobrazovať</small>
                            </p>
                            <label for="futbalnet_path">Link ku kategórií</label>
                            <input value="{{ $category && $category->futbalnet_path ? $category->futbalnet_path : '' }}"
                                minlength="1" type="text" class="custom-input form-control create-category-link"
                                name="futbalnet_path" id="futbalnet_path" placeholder="Link k dátam kategórie">
                        </div>
                        <div class="create-category-btn-wrapper">
                            <button type="submit" class="custom-btn"><i class="fa fa-check"></i>
                                {{$category ? 'Upraviť' : 'Vytvoriť'}}</button>
                        </div>
                    </form>
            </div>
            <div id="players" class="tab-pane fade in active">
                <table class="membership-responsive-create-category">
                    <tr>
                        <td>Názov Kategórie</td>
                        <td>Link</td>
                        <td>Akcia</td>
                    </tr>
                    @forelse ($categories as $category)
                    <tr>
                        <td class="team-name">{{ $category->name }}</td>
                        <td><a target="_blank" title="{{$category->futbalnet_path}}"
                                href="{{$category->futbalnet_path}}">Link</a></td>
                        <td>
                            <a href="{{ route('attendance.index', ['category' => $category]) }}">
                                <i class="fa fa-users">
                                </i>
                            </a>
                            <a href="{{ route('category.edit', ['category' => $category]) }}"><i
                                    class="fa fa-edit"></i></a>
                            <a href="#"
                                onclick="
                                                event.preventDefault();
                                                            if(confirm('Vymazať kategóriu?'))  {
                                                                document.getElementById('delete-form-{{$category->id}}').submit(); }">
                                <i title="Vymazať" class="fa user-list-icon fa-trash"></i></a>
                            <form id="delete-form-{{$category->id}}"
                                action="{{ route('category.destroy', ['category' => $category->id]) }}" method="POST"
                                style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @empty
                    <div class="box-bubble sb4">Pre zobrazenie vytvorte kategóriu</div>
                    @endforelse
                </table>
            </div>
            <!-- end zoznam hracov -->

        </div>
    </div>
</div>
<!-- Point Table Section End -->


@endsection
