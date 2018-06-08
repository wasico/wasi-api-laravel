<div id="listing-header" class="clearfix">
    <div class="form-control-small">
        <select id="sort_by" name="sort_by" data-placeholder="Ordenar">
            <option value=""> </option>
            <option value="data">Ordenar por fecha</option>
            <option value="area">Ordenar por área</option>
        </select>
    </div>

    <div class="sort">
        <ul>
            <li class="active"><i data-toggle="tooltip" data-placement="top" title="Orden descendente" class="fa fa-chevron-down"></i></li>
            <li><i data-toggle="tooltip" data-placement="top" title="Orden ascendente" class="fa fa-chevron-up"></i></li>
        </ul>
    </div>
</div>

<!-- BEGIN PROPERTY LISTING -->
<div id="property-listing" class="list-style clearfix">
    <div class="row">
        @foreach($properties as $prop)
            <div class="item col-md-4"><!-- Set width to 4 columns for grid view mode only -->
                <div class="image">
                    <a href="{{ route('property-detail', $prop['id_property']) }}">
                        <span class="btn btn-default"><i class="fa fa-file-o"></i> Detalles</span>
                    </a>
                    <img src="{{ $prop['image'] }}"
                            alt="{{ $prop['image_description'] }}" />
                </div>
                <div class="price">
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
                <div class="info">
                    <h3>
                        <a href="{{ route('property-detail', $prop['id_property']) }}">{{ $prop['title'] }}</a>
                        <small>{{ $prop['address'] }}</small>
                    </h3>
                    <div class="col-md-12">
                        {!! $prop['observations'] !!}
                    </div>

                    <ul class="amenities col-md-4">
                        <li><i class="icon-area"></i>{{ $prop['built_area'].' '.$prop['unit_area_label'] }}</li>
                        <li><i class="icon-bedrooms"></i> {{ $prop['bedrooms'] }}</li>
                        <li><i class="icon-bathrooms"></i> {{ $prop['bathrooms'] }}</li>
                    </ul>
                </div>
            </div>
        @endforeach
    </div>
</div>
<!-- END PROPERTY LISTING -->


<!-- BEGIN PAGINATION -->
<div class="pagination">
    <ul id="previous">
        <li><a href="{{ route('properties-list', array('page' => $currentPage - 1)) }}" class="{{ $currentPage == 1 ? 'disable-link' : '' }}"><i class="fa fa-chevron-left"></i></a></li>
    </ul>
    <ul>
        @for($i = 1; $i <= $totalPages; $i++)
            <li class="{{ $i == $currentPage ? 'active' : '' }}">
                <a href="{{ route('properties-list', array('page' => $i)) }}">{{ $i }}</a>
            </li>
        @endfor
    </ul>
    <ul id="next">
        <li><a href="{{ route('properties-list', array('page' => $currentPage + 1)) }}" class="{{ $currentPage == $totalPages ? 'disable-link' : '' }}"><i class="fa fa-chevron-right"></i></a></li>
    </ul>
</div>
<!-- END PAGINATION -->