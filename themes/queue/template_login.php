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
<style>
.bg-slate-800 {
	background-size:cover;
}
</style>
    </head>

    <body class="login-container bg-slate-800">

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
</html>
