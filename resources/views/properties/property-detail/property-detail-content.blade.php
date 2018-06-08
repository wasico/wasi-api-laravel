@extends('properties.properties')
<!-- BEGIN CONTENT 1 WRAPPER -->
@section('inner-content')
    @component('template.components.breadcrumb-component')
        <ul class="breadcrumb">
            @slot('title')
                Detalle de la propiedad
            @endslot
            <li><a href="index.html">Inicio</a></li>
            <li><a href="#">Propiedades</a></li>
            <li><a href="{{ route('properties-list', array('id_property_type' => $property['id_property_type'])) }}">Listado de {{ $property['property_type_label'] }}</a></li>
            <li><a href="{{ route('property-detail', $property['id_property']) }}">Detalle del Inmueble #{{ $property['id_property'] }}</a></li>
        </ul>
    @endcomponent
    <div class="content gray">
        <div class="container">
            <div class="row">
                <!-- BEGIN MAIN CONTENT 1 -->
                <div class="main col-sm-8">
                    @include('properties.property-detail.property-gallery')
                    @include('properties.property-detail.property-features')
                    @if($property['latitude'] != '' && $property['longitude'] != '')
                        @include('properties.property-detail.property-location')
                    @endif
                    @include('properties.property-detail.agent-contact')
                    @include('properties.property-detail.similar-properties')
                </div>
                <!-- BEGIN SIDEBAR 1 -->
                <div class="sidebar gray col-sm-4 col-sm-push-1">
                    @include('properties.properties-sidebar')
                </div>
            </div>
        </div>
    </div>
@endsection
<!-- END CONTENT WRAPPER -->
@push('scripts')
    <script>
        const coordinates = {
            lat: @json($property).latitude,
            lng: @json($property).longitude
        };
        const mapData = {
            coordinates: coordinates,
            location: `{{ $property['city_label'] }}, {{ $property['region_label'] }}, {{ $property['country_label'] }}`,
            picture: "{{ $property['image'] }}",
            propertyType: "{{ $property['property_type_label'] }}",
            icon: "{{ asset('images/markers/coral-marker-residential.png') }}"
        }
        const realtor = @json($realtor);
    </script>
    <script src="{{ asset('js/properties/propertyMap.js') }}"></script>
    <script src="{{ asset('js/properties/propertyContactForm.js') }}"></script>
@endpush

