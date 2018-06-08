<!-- BEGIN CONTENT 1 WRAPPER -->
<div class="content gray">
    <div class="container">
        <div class="row">
            <!-- BEGIN MAIN CONTENT 1 -->
            <div class="main col-sm-8">
                @include('home.latest-properties')
                @include('home.properties-gallery')
            </div>
            <!-- BEGIN SIDEBAR 1 -->
            <div class="sidebar gray col-sm-4">
                @include('home.home-sidebar')
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        const properties = @json($mapProperties);
    </script>

    <script type="text/javascript">
        (function($){
            "use strict";

            $(document).ready(function(){
                //Create properties map
                Cozy.propertiesMap(properties, 'properties_map');
            });
        })(jQuery);
    </script>
@endpush