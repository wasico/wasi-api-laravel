@extends('properties.properties')

@section('inner-content')
	@component('template.components.breadcrumb-component')
        <ul class="breadcrumb">
            @slot('title')
                Contacto
            @endslot
			<ul class="breadcrumb">
				<li><a href="{{ route('home') }}">Inicio </a></li>
				<li><a href="{{ route('contact-us') }}">Contacto </a></li>
			</ul>
        </ul>
    @endcomponent
	<div class="content contacts">
		<div id="contacts_map"></div>

		<div class="container">
			<div class="row">

				<div id="contacts-overlay" class="col-sm-7">
					<i id="contacts-overlay-close" class="fa fa-minus"></i>

					<ul class="col-sm-6">
						<li><i class="fa fa-map-marker"></i> 24th Street, New York, USA</li>
						<li><i class="fa fa-envelope"></i> <a href="mailto:youremail@domain.com">youremail@domain.com</a></li>
					</ul>

					<ul class="col-sm-6">
						<li><i class="fa fa-phone"></i> Tel.: 00351 123 456 789</li>
						<li><i class="fa fa-print"></i> Fax: 00351 456 789 101</li>
					</ul>
				</div>

				<!-- BEGIN MAIN CONTENT -->
				<div class="main col-sm-4 col-sm-offset-8">
					<h2 class="section-title">Contact Form</h2>
					<p class="col-sm-12 center">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse facilisis purus sed justo egestas dapibus. <strong>Etiam vel sagittis</strong> nisi. Curabitur ac egestas lorem. Sed ut odio iaculis, interdum magna non, mattis dolor. Vestibulum id dignissim elit. <a href="#">Learn more</a></p>

					<form>
						<div class="col-sm-12">
							<input type="text" name="Name" placeholder="Name" class="form-control required fromName" />

							<input type="email" name="Email" placeholder="Email" class="form-control required fromEmail"  />

							<input type="text" name="Subject" placeholder="Subject" class="form-control required subject"  />
							<textarea name="Message" placeholder="Message" class="form-control required"></textarea>
						</div>

						<div class="center">
							<button type="submit" class="btn btn-default-color btn-lg submit_form"><i class="fa fa-envelope"></i> Send Message</button>
						</div>
					</form>
				</div>
				<!-- END MAIN CONTENT -->

			</div>
		</div>
	</div>
@endsection
@push('scripts')
	<script src="{{ asset('js/about-us/mapAgency.js') }}"></script>
@endpush