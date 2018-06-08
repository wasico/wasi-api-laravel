{!! $property['observations'] ? $property['observations'] : '<p>No disponible</p>' !!}


<!-- BEGIN PROPERTY AMENITIES LIST -->
<h1 class="section-title">Características</h1>

<div class="col-md-6">
    <h2>Internas</h2>
    <ul class="property-amenities-list">
        @foreach ($property['features']['internal'] as $internal)
            <li class="enabled"> {{ $internal['nombre'] }} </li>        
        @endforeach
    </ul>
</div>

<div class="col-md-6">
    <h2>Externas</h2>
    <ul class="property-amenities-list">
        @foreach ($property['features']['external'] as $external)
            <li class="enabled"> {{ $external['nombre'] }} </li>        
        @endforeach
    </ul>    
</div>
<!-- END PROPERTY AMENITIES LIST -->

