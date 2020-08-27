@extends('layouts.base', ['title' => 'Zmena hesla'])

@section('content')

<div class="rs-point-table sec-spacer">
    <div class="container">
        <div class="tab-content">
            @switch($message)
            @case('success')
            <div>
                <h2 class="success-message"><i class="fa fa-check"></i> Super! Vaše heslo bolo úspešne zmenené.</h2>
            </div>
            @break
            @case('pass-check')
            <div>
                <h2 class="error-message">Vaše nové heslá sa nerovnajú.</h2>
            </div>
            @break
            @case('pass-wrong')
            <div>
                <h2 class="error-message">Zadali ste zlé heslo.</h2>
            </div>
            @break

            @endswitch
            <form method="POST" enctype="multipart/form-data"
                action="{{ route('password-change', ['user' => Auth::user()]) }}" novalidate="">
                @csrf
                <div>
                    <span>Zadajte <strong>staré</strong> heslo: *</span>
                    <input required="" class="custom-input form-control responsibile-input" value="" type="password"
                        name="password" placeholder="Vaše staré heslo">
                </div>
                <div>
                    <span>Zadajte nové heslo: *</span>
                    <input required="" class="custom-input form-control responsibile-input" value="" type="password"
                        name="new_password" placeholder="Vaše nové heslo">
                </div>
                <div>
                    <span>Zopakujte nové heslo: *</span>
                    <input required="" class="custom-input form-control responsibile-input" value="" type="password"
                        name="new_password_check" placeholder="Zopakujte nové heslo">
                </div>
                <div class="news-btn notification-btn send-btn-wrapper">
                    <button class="custom-btn"><i title="Odoslať" class="fa fa-plus"></i>
                        Zmeniť</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection