@extends('layouts.base', ['title' => 'Môj Profil'])

@section('content')

<!-- Team Single Start -->


<div class="rs-team-single-section team-inner-page sec-spacer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="rs-team-single-text mb-50">
                    <h3>Notifikácie</h3>
                    <div class="row single-details mb-30">
                        <p>
                            Vaše notifikácie sú {{ (Auth::user()->notifications_on ? "zapnuté" : "vypnuté") }}
                        </p>
                        <form method="POST" action="{{route('notification.switch')}}">
                            @csrf
                            <input name="notifications_on" type="hidden"
                                value="{{ (Auth::user()->notifications_on ? 0 : 1) }}" />
                            <button class="another-btn" type="submit">
                                {{ Auth::user()->notifications_on ? 'Vypnúť' : 'Zapnúť' }}
                                notifikácie
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="rs-team-single-text mb-50">
                    <h3>Osobné Údaje</h3>
                    <div class="row single-details mb-30">
                        <div class="col-md-10 single-team-info">
                            <table class="trainer-indentation">
                                <tr>
                                    <td>
                                        <h3>Meno a priezvisko: </h3>
                                    </td>
                                    <td>
                                        <h4>{{ $user->name . ' ' . $user->surname }}</h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h3>Dátum narodenia: </h3>
                                    </td>
                                    <td>
                                        <h4>{{ $user->birth_date->isoFormat('D. M. Y') }}</h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h3>Tel. č:</h3>
                                    </td>
                                    <td>
                                        <h4>{{ $user->phone_number }}</h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h3>Email:</h3>
                                    </td>
                                    <td>
                                        <h4 class="trainer-mail">{{ $user->email }}</h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h3>Registračné číslo: </h3>
                                    </td>
                                    <td>
                                        <h4>{{ $user->registration_number }}</h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h3>Kategórie:</h3>
                                    </td>
                                    <td>
                                        <h4>{{ $user->category->name }}</h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h3>Partkovacia karta: </h3>
                                    </td>
                                    <td>
                                        <h4>{{ $user->parking_card }}</h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h3>Číslo dresu: </h3>
                                    </td>
                                    <td>
                                        <h4>{{ $user->dress_number }}</h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h3>Súprava: </h3>
                                    </td>
                                    <td>
                                        <h4>{{ $user->has_suit == 1 ? 'Áno' : 'Nie' }}</h4>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Team Single End  -->

@endsection