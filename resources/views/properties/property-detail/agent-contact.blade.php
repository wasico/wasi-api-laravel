<h1 class="section-title">Contacta al Agente</h1>
<!-- BEING AGENT INFORMATION -->
<div class="property-agent-info">
    <div class="agent-detail col-md-4">
        <div class="image">
            <img alt="" src="{{ $realtor['photo'] }}" />
        </div>

        <div class="info">
            <header>
                <h2>{{ $realtor['first_name'] }} {{ $realtor['last_name'] }}<small>{{ $realtor['address'] }}</small></h2>
            </header>

            <ul class="contact-us">
                <li><i class="fa fa-envelope"></i><a href="mailto:{{ $realtor['email'] }}">{{ $realtor['email'] }}</a></li>
                <li><i class="fa fa-map-marker"></i> {{ $realtor['address'] }}</li>
                <li><i class="fa fa-phone"></i> {{ $realtor['cell_phone'] }}</li>
            </ul>
        </div>
    </div>

    <form class="form-style col-md-8" id="contact_form">
        {{ csrf_field() }}
        <div class="col-sm-6 form-group">
            <input type="text" id="name" name="name" placeholder="Nombre" class="form-control required fromName" />
            <span class="error-message" id="name_error"> </span>
        </div>

        <div class="col-sm-6 form-group">
            <input type="text" id="lastName" name="lastName" placeholder="Apellido" class="form-control required fromName" />
            <span class="error-message" id="lastname_error"> </span>
        </div>

        <div class="col-sm-12 form-group">
            <input type="email" id="email" name="email" placeholder="Email" class="form-control required fromEmail" />
            <span class="error-message" id="email_error"> </span>
        </div>

        <div class="col-sm-12 form-group">
            <input type="text" id="subject" name="subject" placeholder="Asunto" class="form-control required subject" />
            <span class="error-message" id="subject_error"> </span>
        </div>

        <div class="col-sm-12 form-group">
            <textarea name="message" id="message" placeholder="Mensaje" class="form-control required"></textarea>
            <span class="error-message" id="message_error"> </span>
        </div>

        <div class="row">
            <div class="col-sm-8 col-sm-push-2 g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"></div>
        </div>

        <div class="col-sm-12 form-group">
            <input type="checkbox" id="receive_newsletter" name="receive_newsletter" placeholder="Deseo recibir noticias y actualizaciones sobre los inmuebles ofertados."/>
            Deseo recibir noticias y actualizaciones sobre los inmuebles ofertados.
        </div>

        <hr class="col-sm-12">
        <div class="col-sm-4 col-sm-push-4">
            <button id="send_contact_request" type="button" class="btn btn-default-color submit_form"><i class="fa fa-envelope"></i> Enviar</button>
        </div>
    </form>
</div>
<!-- END AGENT INFORMATION -->