<h1 class="section-title" data-animation-direction="from-bottom" data-animation-delay="50">Más Inmuebles</h1>

<div id="property-gallery2" class="property-gallery2">
    @foreach($nextSixProperties as $prop)
        <div class="item" data-animation-direction="from-bottom" data-animation-delay="{{ 350 + ($loop->index+1) * 100 }}">
            <a href="{{ route('property-detail', $prop['id_property']) }}">
                <h3>{{ $prop['title'] }}</h3>
                <span class="location">{{ $prop['city_label'] }}, {{ $prop['region_label'] }}, {{ $prop['country_label'] }}</span>
            </a>
            <img src="{{ $prop['image'] }}"
                 alt="{{ $prop['image_description'] }}" />
        </div>
    @endforeach
</div>