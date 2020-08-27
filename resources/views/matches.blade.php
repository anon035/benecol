@extends('layouts.base', ['title' => 'Zápasy ' . $name])

@section('content')
<!-- Point Table Section Start -->
<div class="rs-result sec-spacer">
	<div class="container">
		<h3 class="title-bg">Prehľad zápasov</h3>
		<div class="tab-content team-result">
			<div class="overly-bg"></div>
			<div id="sfl" class="tab-pane fade in active">
				<table class="matches-color">
					@forelse ($matches as $match)
					<tr class="single-result result-align">
						<td class="team-name team1 text-center">
							@if (!strpos($match['homeTeam']['logo'], 'default') && $match['homeTeam']['name'])
								<img class="result-img" src="{{ $match['homeTeam']['logo'] }}">
							@elseif(!$match['homeTeam']['name'])
								<i class="fa fa-2x fa-shield unknown-team"></i>
							@endif
							{!! $match['homeTeam']['name'] !!}
						</td>
						<td class="text-center match-result"><span class="match-score">{{ $match['homeTeam']['score'] }}
								: {{ $match['awayTeam']['score'] }}</span></td>
						<td class="team-name team2 text-center">
							{!! $match['awayTeam']['name'] !!}
							@if (!strpos($match['awayTeam']['logo'], 'default'))
								<img class="result-img" src="{{ $match['awayTeam']['logo'] }}">
							@elseif(!$match['awayTeam']['name'])
								<i class="fa fa-2x fa-shield unknown-team"></i>
							@endif
						</td>
						<td class="match-venu text-center">
							<span class="match-date">
								<i class="fa fa-calendar"></i>  {{ $match['date'] }}
							</span>
						</td>
					</tr>
					@empty
					<tr>
						<td colspan="4">Nenašli sa žiadne zápasy</td>
					</tr>
					@endforelse
				</table>
			</div>
		</div>
	</div>
</div>
<!-- Point Table Section End -->

<!-- Point Table Section Start -->
<div class="rs-point-table sec-spacer">
	<div class="container">
		<h3 class="title-bg">Tabuľka</h3>
		<div class="separator-70"></div>
		<div class="tab-content">
			<div id="sfl" class="tab-pane fade in active">
				<table>
					<tr>
						<td></td>
						<td class="team-name">Klub</td>
						<td>Z</td>
						<td>V</td>
						<td>R</td>
						<td>P</td>
						<td>Skóre</td>
						<td>B</td>
						<td>K</td>
						<td>+/-</td>
						<td>FP</td>
					</tr>
					@forelse ($points as $club)
					<tr>
						@foreach ($club as $tableData)
						<td>{!! $tableData !!}</td>
						@endforeach
					</tr>
					@empty
					<tr>
						<td colspan="11">Nenašli sa žiadne dáta</td>
					</tr>
					@endforelse
				</table>
			</div>

		</div>
	</div>
</div>
<!-- Point Table Section End -->

@endsection