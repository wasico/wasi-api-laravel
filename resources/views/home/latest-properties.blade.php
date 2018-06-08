<h1 class="section-title" data-animation-direction="from-bottom" data-animation-delay="50">Últimas Propiedades</h1>

<!-- BEGIN LATEST PROPERTIES SLIDER -->
<div id="latest-properties-slider" class="owl-carousel fullwidthsingle2" data-animation-direction="from-bottom" data-animation-delay="250">
    @foreach($firstFiveProperties as $prop)
        <div class="item">
            <div class="image">
                <a href="{{ route('property-detail', $prop['id_property']) }}">
                    <img src="{{ $prop['image'] }}"
                         alt="{{ $prop['image_description'] }}" />
                </a>
            </div>
            <div class="price">
                <i class="fa fa-home"></i>
                @if($prop['for_sale'])
                    Venta
                    <span>{{ number_format($prop['sale_price'], 2).' '.$prop['iso_currency'] }}</span>
                @elseif($prop['for_rent'])
                    Alquiler
                    <span>{{ number_format($prop['rent_price'], 2).' '.$prop['iso_currency'] }}</span>
                @else
                    Transferencia
                    <span>{{ number_format($prop['sale_price'], 2).' '.$prop['iso_currency'] }}</span>
                @endif
            </div>
            <div class="info" class="col-md-12">
                <div class="item-title col-md-8">
                    <h3><a href="{{ route('property-detail', $prop['id_property']) }}">{{ $prop['title'] }}</a></h3>
                    <span class="location">{{ $prop['city_label'] }}, {{ $prop['region_label'] }}, {{ $prop['country_label'] }}</span>
                </div>
                <ul class="amenities col-md-4">
                    <li><i class="icon-area"></i>{{ $prop['area'] && $prop['area'] != 0 ? $prop['area'] : 'N/A'.' '.$prop['unit_area_label'] }}</li>
                    <li><i class="icon-bedrooms"></i> {{ $prop['bedrooms'] ? $prop['bedrooms'] : 'N/A' }}</li>
                    <li><i class="icon-bathrooms"></i> {{ $prop['bathrooms'] ? $prop['bathrooms'] : 'N/A' }}</li>
                </ul>
                <div class="description row col-md-12">
                    <div class="col-md-12">
                        {!! $prop['observations'] ? $prop['observations'] : '<p>No disponible</p>' !!}
                    </div>
                    <div class="col-md-3 col-md-push-10" style="position:relative">
                        <a href="{{ route('property-detail', $prop['id_property']) }}" class="btn btn-default-color">Ver más</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
