@extends('properties.properties')

@section('inner-content')
	@component('template.components.breadcrumb-component')
        <ul class="breadcrumb">
            @slot('title')
                Nuestra empresa
            @endslot
			<ul class="breadcrumb">
				<li><a href="{{ route('home') }}">Inicio </a></li>
				<li><a href="{{ route('about-us') }}">Nuestra empresa </a></li>
			</ul>
        </ul>
    @endcomponent
	<div class="row">
		<div class="main col-sm-6">
			<div class="center">
				<h2 class="section-highlight" data-animation-direction="from-left" data-animation-delay="50">Cozy it's a clean and modern Real Estate Template!</h2>
				<p class="darker-text" data-animation-direction="from-left" data-animation-delay="250">Very professional and highly customizable html5 template with lots of custom pages and useful features.</p>
				<p data-animation-direction="from-left" data-animation-delay="650">Mauris hendrerit risus a arcu dapibus varius. Quisque dictum, erat molestie vehicula pellentesque, enim elit sodales leo, id pharetra mi tortor at tellus. Etiam ornare, enim at tincidunt congue, nibh dui suscipit augue, pellentesque hendrerit ligula lorem vehicula sapien. Nunc aliquet pulvinar porta. Sed et ligula at lacus posuere convallis ornare, enim at tincidunt congue, nibh dui suscipit augue.</p>
				<br/>
				<a href="#" class="btn btn-default-color" data-animation-direction="from-left" data-animation-delay="850">Buy Cozy Template!</a>
			</div>
		</div>

		<div class="col-sm-6">
			<img id="about-img" src="http://placehold.it/670x592" alt="" data-animation-direction="from-right" data-animation-delay="200" />
		</div>
	</div>
@endsection