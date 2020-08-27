@extends('layouts.base', ['title' => 'Kontakt'])

@section('content')
<!-- Contact Section Start -->
<div class="contact-page-section sec-spacer">
	<div class="container">
		@if ($errors->any())
		@foreach ($errors->all() as $error)
		<p class="error-message">{{ $error }}</p>
		@endforeach
		@endif
		@switch($message)
		@case('success')
		<div>
			<h2 class="success-message"><i class="fa fa-check"></i> Vaša správa bola úspešne odoslaná. Ďakujeme.</h2>
		</div>
		@break
		@case('captcha-wrong')
		<div>
			<h2 class="error-message">Zadali ste zlý výsledok (výsledok zadajte slovom).</h2>
		</div>
		@break
		@endswitch
		<div class="mapouter">
			<div class="gmap_canvas"><iframe width="100%" height="500" id="gmap_canvas"
					src="https://maps.google.com/maps?q=fa%20benecol&t=&z=15&ie=UTF8&iwloc=&output=embed"
					frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>Google Maps Generator by <a
					href="https://www.embedgooglemap.net">embedgooglemap.net</a></div>
			<style>
				.mapouter {
					position: relative;
					text-align: right;
					height: 500px;
					width: 100%;
				}

				.gmap_canvas {
					overflow: hidden;
					background: none !important;
					height: 500px;
					width: 100%;
				}
			</style>
		</div>
		<div class="row contact-address-section">
			<div class="col-md-4 contact-pd">
				<div class="contact-address">
					<i class="fa fa-map-marker"></i>
					<h4>Adresa</h4>
					<p>Postupimská 37</p>
					<p>Košice 040 22</p>
				</div>
			</div>
			<div class="col-md-4 contact-pd">
				<div class="contact-phone">
					<i class="fa fa-phone"></i>
					<h4>Telefónne číslo</h4>
					<a href="tel:+421 915 650 721">0915 650 721 - Manažér</a>
					<a href="tel:+421 907 934 814">0907 934 814 - Prezident</a>
				</div>
			</div>
			<div class="col-md-4 contact-pd">
				<div class="contact-email">
					<i class="fa fa-envelope"></i>
					<h4>Emailová adresa</h4>
					<a href="mailto:benecol@benecol.sk">
						<p>benecol@benecol.sk</p>
					</a>
					<a href="https://www.benecol.sk">
						<p>www.benecol.sk</p>
					</a>
				</div>
			</div>
			<div class="col-md-4 contact-pd">
				<div class="contact-address">
					<i class="fa fa-university"></i>
					<h4>IBAN:</h4>
					<p>SK38 0200 0000 0018 8393 3457</p>
				</div>
			</div>
			<div class="col-md-4 contact-pd">
				<div class="contact-email">
					<i class="fa fa-file-text "></i>
					<h4>IČO:</h4>
					<p>35562439</p>
				</div>
			</div>
			<div class="col-md-4 contact-pd">
				<div class="contact-email">
					<i class="fa fa-file-text-o"></i>
					<h4>DIČ:</h4>
					<p>2021881180</p>
				</div>
			</div>
		</div>

		<h3 class="title-bg">Kontaktný formulár</h3>
		<div class="contact-comment-section">
			<div id="form-message"></div>
			<form id="contact-form" method="POST" action="{{ route('contact.send') }}">
				@csrf
				<fieldset>
					<div class="row">
						<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
								<label>Krstné meno *</label>
								<input placeholder="Vaše krstné meno" required name="name" id="name"
									class="form-control" type="text">
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
								<label>Priezvisko *</label>
								<input placeholder="Vaše priezvisko" required name="surname" id="surname"
									class="form-control" type="text">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
								<label>Váš Email *</label>
								<input placeholder="Zadajte email" required name="email" id="email" class="form-control"
									type="email">
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
								<label>Predmet správy *</label>
								<input placeholder="Zadajte predmet správy" required name="subject" id="subject"
									class="form-control" type="text">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>Správa *</label>
								<textarea placeholder="Čo nám chcete povedať..." required cols="40" rows="10"
									id="message" name="msg" class="textarea form-control"></textarea>
							</div>
						</div>
						<div class="col-md-4 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>Napíšte výsledok slovom (6 <i class="fa fa-minus"></i> 3 = ) *</label>
								<input name="captcha" required type="text" class="form-control" />
							</div>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="form-group mb-0">
								<button class="custom-btn"><i title="Odoslať" class="fa fa-send"></i> Odoslať</button>
							</div>
						</div>
					</div>
				</fieldset>
			</form>
		</div>
	</div>
</div>
<!-- Contact Section End -->

@endsection