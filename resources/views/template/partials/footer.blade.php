<footer id="footer">
    <div id="footer-top" class="container">
        <div class="row">
            <div class="block col-sm-3">
                <a href="index.html"><img src="{{ asset('images/logo.png') }}" alt="Cozy Logo" /></a>
                <br><br>
                <p>Cozy es la mejor agencia inmobiliaria.</p>
            </div>
            <div class="block col-sm-3">
                <h3>Contacto</h3>
                <ul class="footer-contacts">
                    <li><i class="fa fa-map-marker"></i> {{ $contactInfo['address'] }}</li>
                    <li><i class="fa fa-phone"></i> {{ $contactInfo['phone'] }}</li>
                    <li><i class="fa fa-envelope"></i> <a href="mailto:{{ $contactInfo['email'] }}">{{ $contactInfo['email'] }}</a></li>
                </ul>
            </div>
            <div class="block col-sm-6">
                <h3>Últimas propiedades</h3>
                <ul class="footer-listings">
                    @foreach($latestThreeProperties as $property)
                        <li>
                            <div class="image">
                                <a href="{{ route('property-detail', $property['id_property']) }}"><img src="{{ $property['image'] }}" alt="" /></a>
                            </div>
                            <p><a href="{{ route('property-detail', $property['id_property']) }}">{{ $property['title'] }}<span>+</span></a></p>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>


    <!-- BEGIN COPYRIGHT -->
    <div id="copyright">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    &copy; 2014 Cozy - Real Estate template. All rights reserved. Developed by <a href="http://www.wiselythemes.com" target="_blank">WiselyThemes</a>

                    <!-- BEGIN SOCIAL NETWORKS -->
                    <ul class="social-networks">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-google"></i></a></li>
                        <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                        <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                        <li><a href="#"><i class="fa fa-rss"></i></a></li>
                    </ul>
                    <!-- END SOCIAL NETWORKS -->

                </div>
            </div>
        </div>
    </div>
    <!-- END COPYRIGHT -->

</footer>