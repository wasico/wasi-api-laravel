<!DOCTYPE html>
    <!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
    <!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
    <!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
    <!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
    <head>
        <meta charset="utf-8" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Page Title -->
        <title>Cozy</title>

        <meta name="description" content="Cozy - Responsive Real Estate HTML5 Template" />
        <!-- Mobile Meta Tag -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

        <!-- Fav and touch icons -->
        <link rel="shortcut icon" type="image/x-icon" href="images/fav_touch_icons/favicon.ico" />
        <link rel="apple-touch-icon" href="images/fav_touch_icons/apple-touch-icon.png" />
        <link rel="apple-touch-icon" sizes="72x72" href="images/fav_touch_icons/apple-touch-icon-72x72.png" />
        <link rel="apple-touch-icon" sizes="114x114" href="images/fav_touch_icons/apple-touch-icon-114x114.png" />

        <!-- IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <!-- Google Web Font -->
        <link href="http://fonts.googleapis.com/css?family=Raleway:300,500,900%7COpen+Sans:400,700,400italic" rel="stylesheet" type="text/css" />

        <!-- Bootstrap CSS -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />

        <!-- Template CSS -->
        <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" />

        <!-- Modernizr -->
        <script src="{{ asset('js/modernizr-2.8.1.min.js') }}"></script>

         <script>
            // rename myToken as you like
            window.myToken = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]);?>
        </script>

    </head>
    <body>
        <div class="wrapper">
            @include('template.partials.header')

            <div class="content">
                @yield('content')
            </div>

            @include('template.partials.footer')
        </div>
        @include('template.scripts')
        @stack('scripts')
    </body>
</html>