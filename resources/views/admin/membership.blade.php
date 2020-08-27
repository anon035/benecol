@extends('layouts.base', ['title' => 'Členské'])

@section('content')
<!-- Point Table Section Start -->
<div class="rs-point-table sec-spacer">
    <div class="container">
        <div class="tab-content responsive-event-center">
            <div class="membership-admin-base-topay">
                <form method="POST" action="{{ route('membership.update-total') }}">
                    @csrf
                    @method('PUT')
                    <label for="phone">Nastavte sumu Členského poplatku</label>
                    <input name="total" required minlength="1" placeholder="Zadajte hodnotu členského" type=" text"
                        class="form-control" id="phone" placeholder="Zajdate sumu v €">
                    <button type="submit" class="custom-btn"><i class="fa fa-check"></i> Nastaviť</button>
                </form>
            </div>
            <div class="tab-pane fade in active">
                <form class="membership-admin-set-payed" method="POST" action="{{ route('membership.update-all') }}">
                    @csrf
                    @method('PUT')
                    <table class="membership-responsive">
                        <tr>
                            <td>Registračné číslo</td>
                            <td>Meno</td>
                            <td>Kategória</td>
                            <td>Poznámka</td>
                            <td>Zaplatené / Total</td>
                        </tr>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->registration_number }}</td>
                            <td>{{ $user->name . ' ' . $user->surname }}</td>
                            <td>{{ $user->category->name }}</td>
                            <td>
                                <input type="text" value="{{ $user->membership->note }}"
                                    name="players[{{ $user->id }}][note]" class="form-control">
                            </td>
                            <td>
                                <input class="membership-admin-input-payed form-control"
                                    name="players[{{ $user->id }}][amount]" type="number"
                                    value="{{ $user->membership->amount }}"> /
                                <input type="number" name="players[{{ $user->id }}][total]" class="membership-admin-input-payed membership-admin-input-total form-control"
                                    value="{{ $user->membership->total }}"> €
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    <button type="submit" class="custom-btn"><i class="fa fa-paper-plane"></i> Odoslať</button>
                </form>
            </div>
            <!-- end zoznam hracov -->

        </div>
    </div>
</div>
<!-- Point Table Section End -->

@endsection