<!-- BEGIN SIMILAR PROPERTIES -->
@if(sizeof($similarProperties) > 1)
    <h1 class="section-title">Propiedades similares</h1>
    <div id="similar-properties" class="grid-style1 clearfix">
        <div class="row">
            @foreach($similarProperties as $sproperty)
                @if($property['id_property'] != $sproperty['id_property'])
                    <div class="item col-md-4">
                        <div class="image">
                            <a href="{{ route('property-detail', $sproperty['id_property']) }}">
                                <h3>{{ $sproperty['title'] }}</h3>
                                <span class="location">{{ $sproperty['city_label'] }}, {{ $sproperty['region_label'] }}, {{ $sproperty['country_label'] }}</span>
                            </a>
                            <img src="{{ $sproperty['image'] }}" alt="" />
                        </div>
                        <div class="price">
                            <i class="fa fa-home"></i>
                            @if($sproperty['for_sale'])
                                Venta
                                <span>{{ number_format($sproperty['sale_price'], 2).' '.$sproperty['iso_currency'] }}</span>
                            @elseif($sproperty['for_rent'])
                                Alquiler
                                <span>{{ number_format($sproperty['rent_price'], 2).' '.$sproperty['iso_currency'] }}</span>
                            @else
                                Transferencia
                                <span>{{ number_format($sproperty['sale_price'], 2).' '.$sproperty['iso_currency'] }}</span>
                            @endif
                        </div>
                        <ul class="amenities">
                            <li><i class="icon-area"></i>{{ $sproperty['area'] && $sproperty['area'] != 0 ? $sproperty['area'] : 'N/A'.' '.$sproperty['unit_area_label'] }}</li>
                            <li><i class="icon-bedrooms"></i> {{ $sproperty['bedrooms'] ? $sproperty['bedrooms'] : 'N/A' }}</li>
                            <li><i class="icon-bathrooms"></i> {{ $sproperty['bathrooms'] ? $sproperty['bathrooms'] : 'N/A' }}</li>
                        </ul>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    <p class="center">
        <a href="{{ route('properties-list', array('id_region' => $property['id_region'], 'id_property_type' => $property['id_property_type'])) }}"
           class="btn btn-default-color" data-grid-id="similar-properties" data-load-amount="3">
           Cargar más propiedades
        </a>
    </p>
@endif
<!-- END PROPERTIES ASSIGNED -->