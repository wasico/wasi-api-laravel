<h1 class="property-title">{{ $property['title'] }} <small>{{ $property['city_label'] }}, {{ $property['region_label'] }}, {{ $property['country_label'] }}</small></h1>

<div class="property-topinfo">
<ul class="amenities">
    <li><i class="icon-apartment"></i> {{ $property['property_type_label'] }}</li>
    <li><i class="icon-area"></i> {{ $property['area'] && $property['area'] != 0 ? $property['area'] : 'N/A' }} {{ $property['unit_area_label'] }}</li>
    <li><i class="icon-bedrooms"></i> {{ $property['bedrooms'] ? $property['bedrooms'] : 'N/A' }}</li>
    <li><i class="icon-bathrooms"></i> {{ $property['bathrooms'] ? $property['bathrooms'] : 'N/A' }}</li>
</ul>

<div id="property-id">ID: #{{ $property['id_property'] }}</div>
</div>

<!-- BEGIN PROPERTY DETAIL SLIDERS WRAPPER -->
<div id="property-detail-wrapper" class="style1">

    <div class="price">
        @if($property['for_sale'])
            Venta
            <span>{{ number_format($property['sale_price'], 2).' '.$property['iso_currency'] }}</span>
        @elseif($property['for_rent'])
            Alquiler
            <span>{{ number_format($property['rent_price'], 2).' '.$property['iso_currency'] }}</span>
        @else
            Transferencia
            <span>{{ number_format($property['sale_price'], 2).' '.$property['iso_currency'] }}</span>
        @endif
    </div>

    <!-- BEGIN PROPERTY DETAIL LARGE IMAGE SLIDER -->
    <div id="property-detail-large" class="owl-carousel">
        @if (isset($property['galleries']) && sizeof($property['galleries']) > 0))
            @foreach ($property['galleries'][0] as $photo)
                @if(!$loop->first)
                    <div class="item">
                        <img src="{{ $photo['url'] }}" alt="" />
                    </div>
                @endif
            @endforeach
        @endif
    </div>
    <!-- END PROPERTY DETAIL LARGE IMAGE SLIDER -->

    <!-- BEGIN PROPERTY DETAIL THUMBNAILS SLIDER -->
    <div id="property-detail-thumbs" class="owl-carousel">
        @if (isset($property['galleries']) && sizeof($property['galleries']) > 0))
            @foreach ($property['galleries'][0] as $photo)
                @if(!$loop->first)
                    <div class="item">
                        <img src="{{ $photo['url'] }}" alt="" />
                    </div>
                @endif
            @endforeach
        @endif
    </div>
    <!-- END PROPERTY DETAIL THUMBNAILS SLIDER -->
</div>
