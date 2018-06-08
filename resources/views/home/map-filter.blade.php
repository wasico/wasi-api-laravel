<!-- BEGIN HOME MAP -->
<div id="home-map">
    <div id="properties_map"></div>

    <!-- BEGIN MAP PROPERTY FILTER -->
    <div id="map-property-filter">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <i id="filter-close" class="fa fa-minus"></i>
                    <form action="{{ route('properties-list') }}">
                        <div class="form-group">
                            <div class="form-control-large">
                                <input type="text" class="form-control" name="location" placeholder="Ciudad, Departamento, País...">
                            </div>

                            <div class="form-control-large">
                                <select id="search_prop_type" name="search_prop_type" data-placeholder="Tipo de inmueble">
                                    <option value=""> </option>
                                    @foreach($propertyTypes as $types)
                                        <option value=""> </option>
                                        <option value="{{ $types['id_property_type'] }}">{{ $types['nombre'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-control-small">
                                <select id="search_status" name="search_status" data-placeholder="Estatus">
                                    <option value=""> </option>
                                    @foreach($propertyPurposes as $purpose)
                                        <option value="{{ $purpose }}">{{ $purpose }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-control-small">
                                <select id="search_bedrooms" name="search_bedrooms" data-placeholder="Habitaciones">
                                    <option value=""> </option>
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="5plus">5+</option>
                                </select>
                            </div>

                            <div class="form-control-small">
                                <select id="search_bathrooms" name="search_bathrooms" data-placeholder="Baños">
                                    <option value=""> </option>
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="4plus">4+</option>
                                </select>
                            </div>

                            <div class="form-control-small">
                                <select id="search_minprice" name="search_minprice" data-placeholder="Precio mín.">
                                    <option value=""> </option>
                                    <option value="{{ $priceRanges['min_sale_price'] }}">{{ number_format($priceRanges['min_sale_price']) }}</option>
                                    <option value="{{ $priceRanges['min_rent_price'] }}">{{ number_format($priceRanges['min_rent_price']) }}</option>
                                </select>
                            </div>

                            <div class="form-control-small">
                                <select id="search_maxprice" name="search_maxprice" data-placeholder="Precio máx.">
                                    <option value=""> </option>
                                    <option value="{{ $priceRanges['max_rent_price'] }}">{{ number_format($priceRanges['max_rent_price']) }}</option>
                                    <option value="{{ $priceRanges['max_sale_price'] }}">{{ number_format($priceRanges['max_sale_price']) }}</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-fullcolor">Buscar</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- END MAP PROPERTY FILTER -->
</div>
<!-- END HOME MAP -->