@extends('layouts.base', ['title' => 'Tréneri'])

@section('content')
<!-- Our Team Start Here-->
<div class="our-team-section team-inner-page sec-spacer">
	<div class="container">
		<div class="row">
			@foreach ($trainers as $trainer)
			<div class="col-md-3 col-sm-6 col-xs-6">
				<a href="{{route('trainers', ['id' => $trainer->id])}}">
					<div class="our-team">
						<img width="450" height="617" src="{{ $trainer->photo ? asset($trainer->photo->path) : '' }}"
							alt="" />
						<div class="person-details">
							<div class="overly-bg"></div>
							<h5 class="person-name">
								{{ ($trainer->title_before ? $trainer->title_before . ' ' : '') }}{{ $trainer->name . ' ' . $trainer->surname }}{{ ($trainer->title_after ? ', ' . $trainer->title_after : '') }}
							</h5>
							<table class="person-info coach-photo-fix">
								<tbody>
									<tr>
										<td>Tel. č.</td>
										<td>{{ $trainer->phone_number }}</td>
									</tr>
									<tr>
										<td>Kategória</td>
										<td>{{ $trainer->category->name }}</td>
									</tr>
									<tr>
										<td colspan="2">FA BENECOL</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</a>
			</div>
			@endforeach
		</div>
	</div>
</div>
<!-- Our Team end Here-->


@endsection