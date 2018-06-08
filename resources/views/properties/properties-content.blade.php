@extends('properties.properties')
<!-- BEGIN CONTENT 1 WRAPPER -->
@section('inner-content')
    @component('template.components.breadcrumb-component')
        <ul class="breadcrumb">
            @slot('title')
                Listado de Inmuebles
            @endslot
            <li><a href="/">Inicio</a></li>
            <li><a href="{{ route('properties-list') }}">Propiedades</a></li>
            <li><a href="{{ route('properties-list') }}">Listado de Inmuebles</a></li>
        </ul>
    @endcomponent
    <div class="content gray">
        <div class="container">
            <div class="row">
                <!-- BEGIN MAIN CONTENT 1 -->
                <div class="main col-sm-8">
                    @include('properties.properties-list')
                </div>
                <!-- BEGIN SIDEBAR 1 -->
                <div class="sidebar gray col-sm-4">
                    @include('properties.properties-sidebar')
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('js/properties/searchProperties.js') }}"></script>
@endpush
<!-- END CONTENT WRAPPER -->

