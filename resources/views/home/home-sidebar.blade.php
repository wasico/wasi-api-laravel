<h2 class="section-title" data-animation-direction="from-bottom" data-animation-delay="50">Contáctanos</h2>
<ul class="contact-us" data-animation-direction="from-bottom" data-animation-delay="250">
    <li><i class="fa fa-map-marker"></i> {{ $contactInfo['address'] }}</li>
    <li><i class="fa fa-phone"></i> {{ $contactInfo['phone'] }}</li>
    <li><i class="fa fa-envelope"></i> <a href="mailto:{{ $contactInfo['email'] }}">{{ $contactInfo['email'] }}</a></li>
</ul>

<h2 class="section-title" data-animation-direction="from-bottom" data-animation-delay="50">Nuestros Aliados</h2>

<div id="partners">
    @for($i = 0; $i < sizeof($clients) - 1; $i++)
        <div class="item" data-animation-direction="from-bottom" data-animation-delay="{{ 250 + ($i+1) * 100 }}">
            <a href="#"><img src="{{ $clients[$i]['photo'] }}" alt=""
                             onmouseover="this.src='{{ $clients[$i]['photo'] }}';"
                             onmouseout="this.src='{{ $clients[$i]['photo'] }}';"/></a>
        </div>
    @endfor
</div>
