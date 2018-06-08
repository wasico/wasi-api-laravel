<!-- BEGIN ADVANCED SEARCH -->
<h2 class="section-title">Búsqueda de Propiedades</h2>
<form action="{{ route('properties-list') }}">
    <div class="form-group">
        <div class="col-sm-12">
            <input type="text" class="form-control" id="location" name="location" placeholder="Ciudad, Departamento, País...">
        
            <select class="col-sm-12" id="search_prop_type" name="search_prop_type" data-placeholder="Tipo de inmueble">
                <option value=""> </option>
                @foreach($propertyTypes as $types)
                    <option value=""> </option>
                    <option value="{{ $types['id_property_type'] }}">{{ $types['nombre'] }}</option>
                @endforeach
            </select>

            <select id="search_status" name="search_status" data-placeholder="Estatus">
                <option value=""> </option>
                @foreach($propertyPurposes as $purpose)
                    <option value="{{ $purpose }}">{{ $purpose }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6">
            <select id="search_minarea" name="search_minarea" data-placeholder="Área mín.">
                <option value=""> </option>  
                <option value="0">0</option>
            </select>
        </div>

        <div class="col-md-6">
            <select id="search_maxarea" name="search_maxarea" data-placeholder="Área máx.">
                <option value=""> </option> 
                <option value="0">0</option>
                <option value="{{ $areaRanges['max_area'] }}">{{ $areaRanges['max_area'] }}</option>
            </select>
        </div>

        <div class="col-sm-12">
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

        <div class="col-md-6">
            <select id="search_minprice" name="search_minprice" data-placeholder="Precio mín.">
                <option value=""> </option>
                <option value="{{ $priceRanges['min_sale_price'] }}">{{ number_format($priceRanges['min_sale_price']) }}</option>
                <option value="{{ $priceRanges['min_rent_price'] }}">{{ number_format($priceRanges['min_rent_price']) }}</option>
            </select>
        </div>

        <div class="col-md-6">
            <select id="search_maxprice" name="search_maxprice" data-placeholder="Precio máx.">
                <option value=""> </option>
                <option value="{{ $priceRanges['max_rent_price'] }}">{{ number_format($priceRanges['max_rent_price']) }}</option>
                <option value="{{ $priceRanges['max_sale_price'] }}">{{ number_format($priceRanges['max_sale_price']) }}</option>
            </select>
        </div>

        <p>&nbsp;</p>
        <p class="center">
            <button class="btn btn-default-color" id="search_property_action">Buscar</button>
        </p>
    </div>
</form>