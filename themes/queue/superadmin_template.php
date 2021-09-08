<?php
$theme_path = $this->config->item('theme_locations') . 'queue';
$is_logo_allowed = $this->config->item('is_logo_allowed');
$is_favicon_allowed = $this->config->item('is_favicon_allowed');
$is_user_module_allowed = $this->config->item('user_modules');

$is_user_section_allowed = $this->config->item('user_sections');
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
        <!--<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">-->
        <link href="<?php echo $theme_path; ?>/css/font_family.css" rel="stylesheet" type="text/css">
        <link href="<?php echo $theme_path; ?>/service/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
        <link href="<?php echo $theme_path; ?>/service/css/bootstrap.css" rel="stylesheet" type="text/css">
        <link href="<?php echo $theme_path; ?>/service/css/core.css" rel="stylesheet" type="text/css">
        <link href="<?php echo $theme_path; ?>/service/css/components.css" rel="stylesheet" type="text/css">
        <link href="<?php echo $theme_path; ?>/service/css/colors.css" rel="stylesheet" type="text/css">
        <link href="<?php echo $theme_path; ?>/service/css/sweetalert.css" rel="stylesheet" type="text/css">

        <!-- /global stylesheets -->

        <!-- Core JS files -->
        <script type="text/javascript" src="<?php echo $theme_path; ?>/service/js/plugins/loaders/pace.min.js"></script>
        <script type="text/javascript" src="<?php echo $theme_path; ?>/service/js/core/libraries/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo $theme_path; ?>/service/js/core/libraries/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo $theme_path; ?>/service/js/plugins/loaders/blockui.min.js"></script>
        <script type="text/javascript" src="<?php echo $theme_path; ?>/service/js/core/bootstrap-confirmation.min.js"></script>
        <script type="text/javascript" src="<?php echo $theme_path; ?>/service/js/core/jquery.confirm.min.js"></script>
        <script type="text/javascript" src="<?php echo $theme_path; ?>/service/js/core/sweet.js"></script>
        <script type="text/javascript" src="<?php echo $theme_path; ?>/service/js/core/sweetalert.min.js"></script>

        <!-- /core JS files -->

        <!-- Theme JS files -->
        <script type="text/javascript" src="<?php echo $theme_path; ?>/service/js/plugins/forms/styling/uniform.min.js"></script>
        <script type="text/javascript" src="<?php echo $theme_path; ?>/service/js/plugins/notifications/pnotify.min.js"></script>
        <script type="text/javascript" src="<?php echo $theme_path; ?>/service/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
        <script type="text/javascript" src="<?php echo $theme_path; ?>/service/js/plugins/tables/datatables/datatables.min.js"></script>
        <script type="text/javascript" src="<?php echo $theme_path; ?>/service/js/plugins/forms/selects/select2.min.js"></script>
        <script type="text/javascript" src="<?php echo $theme_path; ?>/service/js/plugins/notifications/jgrowl.min.js"></script>
        <script type="text/javascript" src="<?php echo $theme_path; ?>/service/js/plugins/ui/moment/moment.min.js"></script>
        <script type="text/javascript" src="<?php echo $theme_path; ?>/service/js/plugins/pickers/daterangepicker.js"></script>
        <script type="text/javascript" src="<?php echo $theme_path; ?>/service/js/plugins/pickers/anytime.min.js"></script>
        <script type="text/javascript" src="<?php echo $theme_path; ?>/service/js/plugins/pickers/pickadate/picker.js"></script>
        <script type="text/javascript" src="<?php echo $theme_path; ?>/service/js/plugins/pickers/pickadate/picker.date.js"></script>
        <script type="text/javascript" src="<?php echo $theme_path; ?>/service/js/plugins/pickers/pickadate/picker.time.js"></script>
        <script type="text/javascript" src="<?php echo $theme_path; ?>/service/js/plugins/pickers/pickadate/legacy.js"></script>
        <script type="text/javascript" src="<?php echo $theme_path; ?>/service/js/plugins/notifications/pnotify.min.js"></script>
        <script type="text/javascript" src="<?php echo $theme_path; ?>/service/js/plugins/forms/selects/bootstrap_multiselect.js"></script>


        <!--<script type="text/javascript" src="<?php echo $theme_path; ?>/service/js/core/libraries/jquery_ui/interactions.min.js"></script>-->
        <script type="text/javascript" src="<?php echo $theme_path; ?>/service/js/core/libraries/jquery_ui/widgets.min.js"></script>
        <script type="text/javascript" src="<?php echo $theme_path; ?>/service/js/core/libraries/jquery_ui/effects.min.js"></script>
        <script type="text/javascript" src="<?php echo $theme_path; ?>/service/js/pages/datatables_basic.js"></script>
        <script type="text/javascript" src="<?php echo $theme_path; ?>/service/js/core/app.js"></script>
        <script type="text/javascript" src="<?php echo $theme_path; ?>/service/js/pages/form_multiselect.js"></script>
        <script type="text/javascript" src="<?php echo $theme_path; ?>/service/js/pages/components_modals.js"></script>
        <script type="text/javascript" src="<?php echo $theme_path; ?>/service/js/pages/form_checkboxes_radios.js"></script>
        <script type="text/javascript" src="<?php echo $theme_path; ?>/service/js/pages/form_inputs.js"></script>
        <script type="text/javascript" src="<?php echo $theme_path; ?>/service/js/pages/picker_date.js"></script>


        <script type="text/javascript" src="<?php echo $theme_path; ?>/js/export_excel.js"></script>

        <script type="text/javascript">
            var base_url = '<?php echo $this->config->item('base_url'); ?>';
            var ct_class = '<?php echo $this->router->class; ?>';
            var ct_method = '<?php echo $this->router->method; ?>';
        </script>
        <style>
            .img_hide{
                visibility: hidden;

            }
            .img_display{
                visibility: hidden;
            }
            .img_view{
                width:20%;
                height:20%;
                margin-bottom: 700px;
            }
            .sidebar-xs .ml--75 {
                margin-left: -655px !important;
            }

        </style>
        <!-- /theme JS files -->
    </head>
    <body>
        <!-- Main navbar -->
        <div class="navbar navbar-inverse">
            <div class="navbar-header">
                <a class="navbar-brand" href="<?php echo base_url(); ?>">
                    <?php if ($is_logo_allowed): ?>
                        <img src="<?php echo $theme_path; ?>/service/images/logo1.png" alt="" >
                    <?php endif; ?>
                    <?php if (!$is_logo_allowed): ?>
                        <div style="font-family:inherit; font-size: 32px; padding: 2px; text-transform: uppercase;" id="nav_img">
                            <img src="<?php echo $theme_path; ?>/service/images/logo1.png" alt="" style="width:18%;" >
                        </div>
                        <div style="font-family:inherit; font-size: 32px; padding: 2px; text-transform: uppercase;" id="nav_img2" class="img_display ">
                            <img src="<?php echo $theme_path; ?>/service/images/small.png" alt="" style="width:34%; margin-top:-80px;">
                        </div>
                    <?php endif; ?>
                </a>
                <ul class="nav navbar-nav visible-xs-block">
                    <li><a data-toggle="collapse" data-target="#navbar-mobile,#nav_img2"><i class="icon-tree5"></i></a></li>
                    <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
                </ul>
            </div>
            <div class="navbar-collapse collapse" id="navbar-mobile">
                <ul class="nav navbar-nav">
                    <li><a class="sidebar-control sidebar-main-toggle hidden-xs" id="icon-top"><i class="icon-paragraph-justify3 ml--75"></i></a></li>
                </ul>


                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <?php
                        $file_name = $this->user_auth->get_profile_image();

                        $prefix = pathinfo($file_name, PATHINFO_FILENAME);
                        $suffix = pathinfo($file_name, PATHINFO_EXTENSION);
                        $thumb_name = $prefix . '_thumb' . '.' . $suffix;

                        $exists = FCPATH . 'attachments/profile_image/' . $prefix . '.' . $suffix;

//                        $profile_image = (!empty($thumb_name) && $exists) ? $thumb_name : 'default_profile_image.png';
                        ?>
                        <li class="dropdown dropdown-user">
                            <a class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?php echo $exists; ?>" alt="">
                                <span><?php echo ucfirst($this->user_auth->get_username()); ?></span>
                                <i class="caret"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a href="<?php echo base_url() . 'superadmin/my_profile'; ?>"><i class="icon-user-plus" title="My profile"></i> My profile</a></li>
                                <li><a href="<?php echo base_url() . 'superadmin/logout'; ?>"><i class="icon-switch2" style="color:black" title="Logout"></i> Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="page-container">
            <!-- Page content -->
            <div class="page-content">
                <!-- Main sidebar -->
                <div class="sidebar sidebar-main">
                    <div class="sidebar-content">
                        <!-- User menu -->
                        <div class="sidebar-user">
                            <div class="category-content">
                                <div class="media">
                                    <?php
                                    $file_name = $this->user_auth->get_profile_image();

                                    $prefix = pathinfo($file_name, PATHINFO_FILENAME);
                                    $suffix = pathinfo($file_name, PATHINFO_EXTENSION);
                                    $thumb_name = $prefix . '_thumb' . '.' . $suffix;

                                    $exists = base_url() . 'attachments/profile_image/' . $prefix . '.' . $suffix;

//                                    $profile_image = (!empty($thumb_name) && $exists) ? $thumb_name : 'default_profile_image.png';
                                    ?>
                                    <a href="#" class="media-left"><img src="<?php echo $exists; ?>" class="img-circle img-sm" alt=""></a>
                                    <div class="media-body">
                                        <?php
                                        $username = $this->user_auth->get_username();
                                        $username = (strlen($username) > 13) ? substr($username, 0, 13) . '...' : $username;
                                        ?>
                                        <span class="media-heading text-semibold"><?php echo ucfirst($username); ?></span>
                                        <div class="text-size-mini text-muted">
                                            <i class="icon-pin text-size-small"></i> &nbsp;Coimbatore, IN
                                        </div>
                                    </div>
                                    <div class="media-right media-middle">
                                        <ul class="icons-list">
                                            <li><a href="<?php echo base_url() . 'superadmin/logout'; ?>"><i class="icon-switch2" title="Logout"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /user menu -->

                        <?php
                        # Initialize
                        $breadcrumb_title_1 = $breadcrumb_title_2 = $title = '';
                        $dashboard = $home = $analytics = '';

                        $manage_client = $client = '';

                        # Dashboard - Home
                        if (($this->uri->uri_string() == 'superadmin') || ($this->uri->uri_string() == 'dashboard/index') || ($this->uri->uri_string() == 'superadmin/dashboard') || ($this->uri->uri_string() == 'superadmin/my_profile')) {
                            $dashboard = $home = 'active';
                            $title = 'Dashboard';
                            $breadcrumb_title_1 = 'Dashboard';
                            $breadcrumb_title_2 = '';
                        }



                        # Manage Client - Client

                        if (($this->uri->uri_string() == 'superadmin/client') || ($this->uri->uri_string() == 'superadmin/client/add') || ($this->router->class == 'client' && $this->router->method == 'edit')) {
                            $manage_client = $client = 'active';
                            $title = 'Manage Client - Client';
                            $breadcrumb_title_1 = 'Manage Client';
                            $breadcrumb_title_2 = 'Client';
                        }
                        ?>
                        <!-- Main navigation -->
                        <div class="sidebar-category sidebar-category-visible">
                            <div class="category-content no-padding">
                                <ul class="navigation navigation-main navigation-accordion">
                                    <li class="<?php echo $dashboard; ?>">
                                        <a href="javascript:void(0);"><i class="icon-home2"></i> <span>Dashboard</span></a>
                                        <ul>
                                            <li class="<?php echo $home; ?>"><a href="<?php echo base_url() . 'superadmin/dashboard'; ?>"><i class="icon-chevron-right"></i>Home</a></li>
                                        </ul>
                                    </li>
                                    <li class="<?php echo $manage_client; ?>">
                                        <a href="javascript:void(0);"><i class="icon-users4"></i> <span>Client Management</span></a>
                                        <ul>
                                            <li class="<?php echo $client; ?>"><a href="<?php echo base_url() . 'superadmin/client'; ?>"><i class="icon-chevron-right"></i>Clients</a> </li>
                                        </ul>
                                    </li>
                                    <!-- /main -->
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-wrapper">
                    <div class="page-header page-header-default">


                        <?php
                        $active_class_1 = ($breadcrumb_title_2 == '') ? 'active' : '';
                        $active_class_2 = ($breadcrumb_title_2 != '') ? 'active' : '';
                        ?>
                        <div class="breadcrumb-line">
                            <ul class="breadcrumb">
                                <li><a href="<?php echo base_url(); ?>"><i class="icon-home2 position-left"></i> Home</a></li>
                                <li class="<?php echo $active_class_1; ?>"><?php echo $breadcrumb_title_1; ?></li>
                                <?php if ($breadcrumb_title_2 != ''): ?>
                                    <li class="<?php echo $active_class_2; ?>"><?php echo $breadcrumb_title_2; ?></li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                    <!-- /page header -->

                    <!-- Content area -->
                    <div class="content">
                        <div class="session_msg">
                            <?php echo $session_msg; ?>
                        </div>
                        <?php echo $content; ?>

                        <!-- Footer -->
                        <div class="footer text-muted">
                            <span style="float:left;"><?php echo $this->config->item('site_footer') ?></span>&nbsp;
                            <span style="float:right;">Powered by <a href="http://www.f2fsolutions.co.in" target="_blank" class="powered_link">F2F Solutions</a></span>
                        </div>
                    </div>
                    <!-- /content area -->
                </div>
                <!-- /main content -->
            </div>
            <!-- /page content -->
        </div>
        <!-- /page container -->
        <div id="ajax-loader" style="display:none;"></div>
    </body>
</html>
<script type="text/javascript">
    $(document).ready(function () {
        $('form').submit(function () {
            $('button[type = "submit"]').attr('disabled', 'disabled');
            $('button[type = "submit"]').html('Please wait Processing');
        });
        if ((ct_class == 'service_entry' || ct_class == 'for_service' || ct_class == 'for_dispatch') && (ct_method == 'index'))
            $('th.sorting_disabled').css('width', '160px');
        else if ((ct_class == 'technician') && (ct_method == 'index'))
            $('th.sorting_disabled').css('width', '100px');
        else
            $('th.sorting_disabled').css('width', '135px');
        $('input[type = "text"]').attr('autocomplete', 'off');
        $('#icon-top').click(function () {
            $("#nav_img").toggleClass("img_hide");
            $("#nav_img2").toggleClass("img_display");
            $("#nav_img2").toggleClass("img_view");


        });
    });
    function session_message() {
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() . 'api/load_session_message'; ?>',
            success: function (session_msg) {
                $('.session_msg').html(session_msg);
            }
        });
    }
</script>
<!--<link rel="stylesheet" href="<?php echo $theme_path; ?>/node_modules/material-datetimepicker/bootstrap-material-datetimepicker.css" />
<script type="text/javascript" src="<?php echo $theme_path; ?>/node_modules/material-datetimepicker/material.min.js"></script>
<script type="text/javascript" src="<?php echo $theme_path; ?>/node_modules/material-datetimepicker/moment-with-locales.min.js"></script>
<script type="text/javascript" src="<?php echo $theme_path; ?>/node_modules/material-datetimepicker/bootstrap-material-datetimepicker.js"></script>-->
<script type="text/javascript">


    $(document).ready(function ()
    {




        /*   $('.date').bootstrapMaterialDatePicker
         ({
         time: false,
         format: 'DD/MM/YYYY',
         clearButton: true
         });

         $('.time').bootstrapMaterialDatePicker
         ({
         date: false,
         shortTime: false,
         format: 'HH:mm'
         });

         $('.date-format').bootstrapMaterialDatePicker
         ({
         format: 'MM/DD/YYYY HH:mm'
         });
         $('.date-fr').bootstrapMaterialDatePicker
         ({
         format: 'DD/MM/YYYY HH:mm',
         lang: 'fr',
         weekStart: 1,
         cancelText: 'ANNULER',
         nowButton: true,
         switchOnClick: true
         });

         $('.date-end').bootstrapMaterialDatePicker
         ({
         weekStart: 0, format: 'DD/MM/YYYY HH:mm'
         });
         $('.date-start').bootstrapMaterialDatePicker
         ({
         weekStart: 0, format: 'DD/MM/YYYY HH:mm', shortTime: true
         }).on('change', function (e, date)
         {
         $('.date-end').bootstrapMaterialDatePicker('setMinDate', date);
         });

         $('.min-date').bootstrapMaterialDatePicker({format: 'DD/MM/YYYY HH:mm', minDate: new Date()});

         $.material.init()*/
    });
</script>
<style type="text/css">
    #ajax-loader {
        position:fixed;
        top:0px;
        right:0px;
        width:100%;
        height:100%;
        background-color:#1b1515;
        background-size: 7%;
        background-image:<?php echo base_url() ?>.'themes/queue/service/images/ajax-loader/loading.gif';
        background-repeat:no-repeat;
        background-position:center;
        z-index:10000000;
        opacity: 0.7;
        filter: alpha(opacity=40);
    }
</style>