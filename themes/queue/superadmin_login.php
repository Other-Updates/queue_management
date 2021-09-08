<?php
$theme_path = $this->config->item('theme_locations') . 'queue';
$is_logo_allowed = $this->config->item('is_logo_allowed');
$is_favicon_allowed = $this->config->item('is_favicon_allowed');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $this->config->item('site_title'); ?></title>
        <?php if ($is_favicon_allowed): ?>
            <link rel="icon" type="image/png" href="<?php echo $theme_path ?>/service/images/favicon.png" />
        <?php endif; ?>
        <!-- Global stylesheets -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
        <link href="<?php echo $theme_path; ?>/service/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
        <link href="<?php echo $theme_path; ?>/service/css/bootstrap.css" rel="stylesheet" type="text/css">
        <link href="<?php echo $theme_path; ?>/service/css/core.css" rel="stylesheet" type="text/css">
        <link href="<?php echo $theme_path; ?>/service/css/components.css" rel="stylesheet" type="text/css">
        <link href="<?php echo $theme_path; ?>/service/css/colors.css" rel="stylesheet" type="text/css">
        <!-- /global stylesheets -->

        <!-- Core JS files -->
        <script type="text/javascript" src="<?php echo $theme_path; ?>/service/js/plugins/loaders/pace.min.js"></script>
        <script type="text/javascript" src="<?php echo $theme_path; ?>/service/js/core/libraries/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo $theme_path; ?>/service/js/core/libraries/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo $theme_path; ?>/service/js/plugins/loaders/blockui.min.js"></script>
        <!-- /core JS files -->

        <!-- Theme JS files -->
        <script type="text/javascript" src="<?php echo $theme_path; ?>/service/js/plugins/forms/styling/uniform.min.js"></script>

        <script type="text/javascript" src="<?php echo $theme_path; ?>/service/js/core/app.js"></script>
        <script type="text/javascript" src="<?php echo $theme_path; ?>/service/js/pages/login.js"></script>
        <!-- /theme JS files -->

        <!-- Google Maps -->
        <script type="text/javascript" src='http://maps.google.com/maps/api/js?key=AIzaSyDqCaUcj4_XFkzC32uLa4HUFdzvAmjXbpg&sensor=false&libraries=places'></script>
        <!-- /Google Maps -->
        <style>
            <.bg-slate-800 {
                position:fixed;
                width:100%;
                background:none !important;
            }-->
        </style>
    </head>
    <body class="login-container bg-slate-800">
        <!--<img src="<?php echo $theme_path; ?>/service/images/login-bg.jpg" class="img-responsive"/>-->
        <!-- Page container -->
        <div class="page-container">
            <!-- Page content -->
            <div class="page-content">
                <!-- Main content -->
                <div class="content-wrapper">
                    <?php echo $content; ?>
                </div>
                <!-- /main content -->
            </div>
            <!-- /page content -->
        </div>
        <!-- /page container -->
    </body>
    <script type="text/javascript">
        var user_location;
        initialize();
        var geocoder;
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(successFunction, errorFunction);
        }
        //Get the latitude and the longitude;
        function successFunction(position) {
            var lat = position.coords.latitude;
            var lng = position.coords.longitude;
            $('#latitude').val(lat);
            $('#longitude').val(lng);
            codeLatLng(lat, lng)
        }

        function errorFunction() {
            console.log('Geocoder failed');
        }

        function initialize() {
            geocoder = new google.maps.Geocoder();
        }

        function codeLatLng(lat, lng) {
            var latlng = new google.maps.LatLng(lat, lng);
            geocoder.geocode({'latLng': latlng}, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[2]) {
                        user_location = results[2].formatted_address;
                        user_location = user_location.split(', ');
                        current_location = user_location[0] + ',<br> ' + user_location[1];
                        $('#user_location').val(current_location);
                    } else {
                        console.log('No results found');
                    }
                } else {
                    console.log('Geocoder failed due to: ' + status);
                }
            });
        }

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                console.log('Geolocation is not supported by this browser.');
            }
        }

        function showPosition(position) {
            latitude = position.coords.latitude;
            longitude = position.coords.longitude;
        }
    </script>
</html>