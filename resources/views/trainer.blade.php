@extends(
'layouts.base',
['title' => $trainer->title_before . ' ' . $trainer->name . ' ' . $trainer->surname . ' ' . $trainer->title_after, 'extra' => [
    [
        'title' => 'Tréneri',
        'link' => route('trainers')
    ]
]])

@section('content')

<!-- Team Single Start -->
<div class="rs-team-single-section team-inner-page sec-spacer">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="rs-team-single-image">
                    <img src="{{ $trainer->photo ? asset($trainer->photo->path) : '' }}" alt="">
                    <div class="player-info">
                        <h3 class="player-title">{{ ($trainer->title_before ? $trainer->title_before . ' ' : '') }}{{ $trainer->name . ' ' . $trainer->surname }}{{ ($trainer->title_after ? ', ' . $trainer->title_after : '') }}</h3>                        
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="rs-team-single-text mb-50">
                    <h3>Osobné Údaje</h3>
                    <div class="row single-details mb-30">
                        <div class="col-md-10 single-team-info">
                            <table class="trainer-indentation">
                                <tr>
                                    <td>
                                        <h3>Tel. č:</h3>
                                    </td>
                                    <td>
                                        <h4>{{ $trainer->phone_number }}</h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h3>Email:</h3>
                                    </td>
                                    <td>
                                        <h4 class="trainer-mail">{{ $trainer->email }}</h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h3>Kategórie:</h3>
                                    </td>
                                    <td>
                                        <h4>{{ $trainer->responsibility }}</h4>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <h3>Kariéra</h3>
                    <div class="row single-details">
                        <div class="col-md-12 single-team-info">
                            <p>
                                <strong>Trénerská licencia:</strong><br />
                                {{ $trainer->licence }}
                            </p>
                            <p>
                                <strong>Certifikát:</strong><br />
                                {{ $trainer->certificate }}
                            </p>
                            <p class="margin-null">
                                <strong>Športová kariéra:</strong><br />
                                {!! $trainer->clubs !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Team Single End  -->

@endsection