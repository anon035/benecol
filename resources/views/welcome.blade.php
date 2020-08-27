@extends('layouts.base')
@section('content')
<!-- Slider Section Start Here -->
<div class="slider-section2">
    <div class="overly-fullbg"></div>
    <div class="item">
        <img class="header-background-image" src="{{ asset('images/full-slider/cover.jpg') }}" alt="Slider image">
    </div>
</div>
</div>
<!-- Slider Section end Here -->

<!-- Upcoming Match Section Start Here-->
<div class="upcoming-section2">
    <div class="container">
        <div class="row">
            <h2>Nasledujúce zápasy</h2>
            @if (isset($upcomingMatches) && $upcomingMatches)
            <div id="upcoming" class="rs-carousel owl-carousel" data-loop="true" data-items="1" data-margin="30"
                data-autoplay="true" data-autoplay-timeout="5200" data-smart-speed="2000" data-dots="false"
                data-nav="false" data-nav-speed="false" data-mobile-device="1" data-mobile-device-nav="false"
                data-mobile-device-dots="false" data-ipad-device="1" data-ipad-device-nav="false"
                data-ipad-device-dots="false" data-ipad-device2="1" data-ipad-device-nav2="false"
                data-ipad-device-dots2="false" data-md-device="1" data-md-device-nav="false"
                data-md-device-dots="false">
                @for ($i = 0; $i < 3; $i++) <div class="item vertical-align">
                    <div class="col-md-4 col-sm-4 col-xs-12 first">
                        <img src="{{ $upcomingMatches[$i]['homeTeam']['logo'] }}"
                            alt="{!! $upcomingMatches[$i]['homeTeam']['name'] !!}">
                        <h4>{!! $upcomingMatches[$i]['homeTeam']['name'] !!}</h4>
                    </div>

                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <span class="vs">VS</span>
                        <span class="date">{{ $upcomingMatches[$i]['date'] }}</span>
                        <span class="category">{{ $upcomingMatches[$i]['name'] }}</span>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12 last">
                        <img src="{{ $upcomingMatches[$i]['awayTeam']['logo'] }}"
                            alt="{!! $upcomingMatches[$i]['awayTeam']['name'] !!}">
                        <h4>{!! $upcomingMatches[$i]['awayTeam']['name'] !!}</h4>
                    </div>
            </div>
            @endfor
            @endif
        </div>
    </div>
</div>
</div>
<!-- Upcoming Match Section end Here-->

<!-- All news area Start Here-->
<div class="all-news-area sec-spacer">
    <div class="container">
        @if (!$articles->isEmpty())
        <div class="row">
            <div class="col-md-12">
                <h3 class="title-bg">Novinky</h3>
                <div class="row">
                    <div class="col-sm-10">
                        <div class="latest-news-slider">
                            @foreach ($articles as $article)
                            <div>
                                <div class="news-normal-block">
                                    <div class="news-img">
                                        <a href="{{ route('article.single', ['article' => $article]) }}">
                                            <img src="{{ asset($article->photo_path) }}" alt="{{ $article->title }}" />
                                        </a>
                                    </div>
                                    <h4 class="news-title">
                                        <a href="{{ route('article.single', ['article' => $article]) }}">
                                            {{ $article->title }}
                                        </a>
                                    </h4>
                                    <div class="news-btn">
                                        <a class="primary-btn"
                                            href="{{ route('article.single', ['article' => $article]) }}">Čítať viac</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="latest-news-nav">
                            @foreach ($articles as $article)
                            <div><img src="{{ asset($article->photo_path) }}" alt="{{ $article->title }}" /></div>
                            @endforeach
                        </div>
                        <div>
                            <a href="{{ route('article.list') }}">
                                <button class="custom-btn all-articles-btn">
                                    Všetky novinky
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <div class="separator-100"></div>
        <div class="row">
            @if (isset($lastResults) && $lastResults)
            @php
            $lastMatchResult = array_shift($lastResults);
            @endphp
            <div class="col-md-4">
                <div class="sidebar-area left-side-area">
                    <h3 class="title-bg">Najnovšie Výsledky</h3>
                    <div class="today-match-teams text-center">
                        <div class="overly-bg"></div>
                        <div class="title-head">
                            <h4>Výsledky posledného zápasu </h4>
                            <span class="date">{{ $lastMatchResult['date'] }} - {{ $lastMatchResult['name'] }}</span>
                        </div>
                        <div class="today-score">
                            <div class="today-match-team width-wrapper">
                                <img src="{{ $lastMatchResult['homeTeam']['logo'] }}"
                                    alt="{!! $lastMatchResult['homeTeam']['name'] !!}" />
                                <h4>{!! $lastMatchResult['homeTeam']['name'] !!}</h4>
                            </div>
                            <div class="today-final-score">
                                {{ $lastMatchResult['homeTeam']['score'] }} <span>-</span>
                                {{ $lastMatchResult['awayTeam']['score'] }}
                                <h4>Konečné skóre</h4>
                            </div>
                            <div class="today-match-team width-wrapper">
                                <img src="{{ $lastMatchResult['awayTeam']['logo'] }}"
                                    alt="{!! $lastMatchResult['awayTeam']['name'] !!}" />
                                <h4>{!! $lastMatchResult['awayTeam']['name'] !!}</h4>
                            </div>
                        </div>
                        <div class="title-head">
                            <h4>Predchádzajúce výsledky</h4>
                        </div>
                        <div class="recent-match-results">
                            @foreach ($lastResults as $lastResult)
                            <div class="single-result">
                                <div class="team-result clearfix vertical-align">
                                    <div class="text-left match-result-list single-part">
                                        {!! $lastResult['homeTeam']['name'] !!}</div>
                                    <div class="text-center match-score single-part">
                                        <span class="score">{{ $lastResult['homeTeam']['score'] }}</span> - <span
                                            class="score">{{ $lastResult['awayTeam']['score'] }}</span>
                                        <div><small>{{ $lastResult['name'] }}</small></div>
                                    </div>
                                    <div class="text-left match-result-list single-part">
                                        {!! $lastResult['awayTeam']['name'] !!}</div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @if (isset($lastMatchResult) && $lastMatchResult)
            <div class="col-md-8">
                @else
                <div class="col-md-12">
                    @endif
                    <div class="row">
                        <div class="col-sm-8 col-xs-8 match-view-tite">
                            <h3 class="title-bg">Nasledujúce zápasy</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="match-list">
                                <div class="overly-bg"></div>
                                <table class="match-table">
                                    <tbody>
                                        @foreach ($upcomingMatches as $match)
                                        <tr>
                                            <td class="medium-font">
                                                <span
                                                    class="{{ (strpos($match['homeTeam']['name'], 'BENECOL') !== false ? 'bold-benecol' : '') }}">{!!
                                                    $match['homeTeam']['name'] !!}</span>
                                            </td>
                                            <td class="big-font">VS
                                            </td>
                                            <td class="medium-font">
                                                <span
                                                    class="{{ (strpos($match['awayTeam']['name'], 'BENECOL') !== false ? 'bold-benecol' : '') }}">{!!
                                                    $match['awayTeam']['name'] !!}</span>
                                            </td>
                                            <td>
                                                {{ $match['date'] }}<br>
                                                {{ $match['name'] }}
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
        </div>
    </div>
    <!-- All news area end Here-->

    @endsection