<header id="header">
    <div id="top-bar">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <ul id="top-info">
                        <li>Teléfono: {{ $contactInfo['phone'] }}</li>
                        <li>Email: <a href="mailto:{{ $contactInfo['email'] }}">{{ $contactInfo['email'] }}</a></li>
                        <li class="divider"></li>
                        <li>Dirección: {{ $contactInfo['address'] }}</li>
                    </ul>
                    <!--<ul id="top-buttons">
                        <li>
                            <div class="language-switcher">
                                <span><i class="fa fa-globe"></i> English</span>
                                <ul>
                                    <li><a href="#">Deutsch</a></li>
                                    <li><a href="#">Espa&ntilde;ol</a></li>
                                    <li><a href="#">Fran&ccedil;ais</a></li>
                                    <li><a href="#">Portugu&ecirc;s</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>-->
                </div>
            </div>
        </div>
    </div>

    <div id="nav-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <a href="{{ route('home') }}" class="nav-logo"><img src="{{ asset('images/logo.png') }}" alt="Cozy Logo" /></a>

                    <!-- BEGIN SEARCH -->
                    <div id="sb-search" class="sb-search">
                        <form>
                            <input class="sb-search-input" placeholder="Buscar..." type="text" value="" name="search" id="search">
                            <input class="sb-search-submit" type="submit" value="">
                            <i class="fa fa-search sb-icon-search"></i>
                        </form>
                    </div>
                    <!-- END SEARCH -->

                    <!-- BEGIN MAIN MENU -->
                    <nav class="navbar">
                        <button id="nav-mobile-btn"><i class="fa fa-bars"></i></button>

                        <ul class="nav navbar-nav">
                            <li><a class="active" href="{{ route('home') }}">Inicio</a></li>
                            <li class="dropdown">
                                <a href="#" data-toggle="dropdown" data-hover="dropdown">Ventas<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    @for($i = 0; $i < 4; $i++)
                                        <li>
                                            <a href="{{ route('properties-list', array('id_property_type' => $typesForSale[$i]['id_property_type'], 'for_sale' => true)) }}">
                                                {{ $typesForSale[$i]['nombre'] }}
                                            </a>
                                        </li>
                                    @endfor
                                    <li class="divider"></li>
                                    <li>
                                        <a href="{{ route('properties-list') }}">Ver más</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="dropdown">
                                <a href="#" data-toggle="dropdown" data-hover="dropdown">Alquiler<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    @for($i = 0; $i < 4; $i++)
                                        <li>
                                            <a href="{{ route('properties-list', array('id_property_type' => $typesForRent[$i]['id_property_type'], 'for_rent' => true)) }}">
                                                {{ $typesForRent[$i]['nombre'] }}
                                            </a>
                                        </li>
                                    @endfor
                                    <li class="divider"></li>
                                    <li>
                                        <a href="{{ route('properties-list') }}">Ver más</a>
                                    </li>
                                </ul>
                            </li>

                            <!--<li><a href="blog-listing1.html">Blog</a></li>-->
                            <li><a href="{{ route('about-us') }}">Nuestra empresa</a></li>
                            <li><a href="{{ route('contact-us') }}">Contacto</a></li>
                        </ul>

                    </nav>
                    <!-- END MAIN MENU -->
                </div>
            </div>
        </div>
    </div>
</header>