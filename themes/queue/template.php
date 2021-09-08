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
            .logo_adjus{
                margin-left: -51px !important;
            }

        </style>
        <!-- /theme JS files -->
    </head>
    <body>
        <!-- Main navbar -->
        <div class="navbar navbar-inverse">
            <div class="navbar-header">
                <a class="navbar-brand">
                    <?php if ($this->user_auth->get_log() != ''): ?>

                        <img src="<?php echo $this->user_auth->get_log() ?>" alt=""  id="nav_img">
                        <div style="font-family:inherit; font-size: 32px; padding: 2px; text-transform: uppercase;" id="nav_img2" class="img_display ">
                            <img src="<?php echo $theme_path; ?>/service/images/small.png" alt="" style="width:34%; margin-top:-80px;">
                        </div>
                    <?php endif; ?>
                    <?php if ($this->user_auth->get_log() == ''): ?>
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
                <?php if ($this->user_auth->get_log() != ''): ?>
                    <ul class="nav navbar-nav">
                        <li><a class="sidebar-control sidebar-main-toggle hidden-xs" id="icon-top"><i class="icon-paragraph-justify3 logo_adjus"></i></a></li>
                    </ul>
                <?php endif; ?>
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
                        ?>
                        <li class="dropdown dropdown-user">
                            <a class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?php echo $exists; ?>" alt="">
                                <span><?php echo ucfirst($this->user_auth->get_username()); ?></span>
                                <i class="caret"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a href="<?php echo base_url() . 'users/my_profile'; ?>"><i class="icon-user-plus"></i> My profile</a></li>
                                <li><a href="<?php echo base_url() . 'users/logout'; ?>"><i class="icon-switch2" style="color:black"></i> Logout</a></li>
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
                                            <li><a href="<?php echo base_url() . 'users/logout'; ?>"><i class="icon-switch2"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /user menu -->

                        <?php
                        # Initialize
                        $breadcrumb_title_1 = $breadcrumb_title_2 = $title = '';
                        $dashboard = '';
                        $users = $manage_users = $manage_user_types = $manage_user_modules = $manage_user_sections = '';
                        $masters = $counter = $category_type = $subcategory = $advertisement = '';
                        $service_management = $category = '';
                        $manage_reports = $reports = $feedback = '';
                        $employee_management = $employee = $counter_employee = '';

                        # Dashboard
                        if (($this->uri->uri_string() == 'dashboard') || ($this->uri->uri_string() == 'dashboard/index') || ($this->uri->uri_string() == '')) {
                            $dashboard = 'active';
                            $title = 'Dashboard';
                            $breadcrumb_title_1 = 'Dashboard';
                            $breadcrumb_title_2 = '';
                        }

                        # Masters - Counter
                        if (($this->uri->uri_string() == 'masters/counter') || ($this->uri->uri_string() == 'masters/counter/index') || ($this->uri->uri_string() == 'masters/counter/add') || ($this->router->class == 'counter' && $this->router->method == 'edit')) {
                            $masters = $counter = 'active';
                            $titles = 'Masters - Manage Counters';
                            $breadcrumb_title_1 = 'Masters';
                            $breadcrumb_title_2 = 'Manage Counters';
                        }
                        if (($this->uri->uri_string() == 'masters/category_type') || ($this->uri->uri_string() == 'masters/category_type/index') || ($this->uri->uri_string() == 'masters/category_type/add') || ($this->router->class == 'category_type' && $this->router->method == 'edit')) {
                            $masters = $category_type = 'active';
                            $titles = 'Masters - Manage Category Type';
                            $breadcrumb_title_1 = 'Masters';
                            $breadcrumb_title_2 = 'Manage Category Type';
                        }
                        if (($this->uri->uri_string() == 'masters/subcategory') || ($this->uri->uri_string() == 'masters/subcategory/index') || ($this->uri->uri_string() == 'masters/subcategory/add') || ($this->router->class == 'subcategory' && $this->router->method == 'edit')) {
                            $masters = $subcategory = 'active';
                            $titles = 'Masters - Manage Category & Subcategory ';
                            $breadcrumb_title_1 = 'Masters';
                            $breadcrumb_title_2 = 'Manage Category & Subcategory ';
                        }
                        # Masters - Advertisement
                        if (($this->uri->uri_string() == 'masters/advertisement') || ($this->uri->uri_string() == 'masters/advertisement/index') || ($this->uri->uri_string() == 'masters/advertisement/add') || ($this->router->class == 'advertisement' && $this->router->method == 'edit') || ($this->router->class == 'advertisement' && $this->router->method == 'view')) {
                            $masters = $advertisement = 'active';
                            $titles = 'Masters - Manage Advertisement';
                            $breadcrumb_title_1 = 'Masters';
                            $breadcrumb_title_2 = 'Manage Advertisement ';
                        }

                        # Users
                        if (($this->uri->uri_string() == 'users') || ($this->uri->uri_string() == 'users/index') || ($this->uri->uri_string() == 'users/add') || ($this->router->class == 'users' && $this->router->method == 'edit')) {
                            $users = $manage_users = 'active';
                            $title = 'Users - Manage Users';
                            $breadcrumb_title_1 = 'Users';
                            $breadcrumb_title_2 = 'Manage Users';
                        }

                        # User Types

                        if (($this->uri->uri_string() == 'users/user_types') || ($this->uri->uri_string() == 'users/user_types/add') || ($this->router->class == 'user_types' && $this->router->method == 'edit') || ($this->router->class == 'user_types' && $this->router->method == 'view')) {
                            $users = $user_types = 'active';
                            $titles = 'Users - Manage User Types';
                            $breadcrumb_title_1 = 'Users';
                            $breadcrumb_title_2 = 'Manage User Types';
                        }

                        # User Modules
                        if (($this->uri->uri_string() == 'users/user_modules') || ($this->uri->uri_string() == 'users/user_modules/index') || ($this->uri->uri_string() == 'users/user_modules/add') || ($this->router->class == 'user_modules' && $this->router->method == 'edit')) {
                            $users = $manage_user_modules = 'active';
                            $title = 'Users - Manage User Modules';
                            $breadcrumb_title_1 = 'Users';
                            $breadcrumb_title_2 = 'Manage User Modules';
                        }

                        # User Sections
                        if (($this->uri->uri_string() == 'users/user_sections') || ($this->uri->uri_string() == 'users/user_sections/index') || ($this->uri->uri_string() == 'users/user_sections/add') || ($this->router->class == 'user_sections' && $this->router->method == 'edit')) {
                            $users = $manage_user_sections = 'active';
                            $title = 'Users - Manage User Sections';
                            $breadcrumb_title_1 = 'Users';
                            $breadcrumb_title_2 = 'Manage User Sections';
                        }

                        # Service_management
                        if (($this->uri->uri_string() == 'service_management/category') || ($this->uri->uri_string() == 'service_management/category/index') || ($this->uri->uri_string() == 'service_management/category/add') || ($this->uri->uri_string() == 'service_management/category/edit') || ($this->router->class == 'category' && $this->router->method == 'edit') || ($this->router->class == 'category' && $this->router->method == 'view')) {
                            $service_management = $manage_category = 'active';
                            $titles = 'Service Management - Manage Category';
                            $breadcrumb_title_1 = 'Service Management';
                            $breadcrumb_title_2 = 'Manage Category';
                        }
                        if (($this->uri->uri_string() == 'service_management/category_type') || ($this->uri->uri_string() == 'service_management/category_type/index') || ($this->uri->uri_string() == 'service_management/category_type/add') || ($this->router->class == 'category_type' && $this->router->method == 'edit')) {

                            $service_management = $category_type = 'active';
                            $titles = 'Service Management - Manage Category Type';

                            $breadcrumb_title_1 = 'Service Management';
                            $breadcrumb_title_2 = 'Manage Category Type';
                        }
                        # Employee_management
                        if (($this->uri->uri_string() == 'employee_management/employee') || ($this->uri->uri_string() == 'employee_management/employee/index') || ($this->uri->uri_string() == 'employee_management/employee/add') || ($this->router->class == 'employee' && $this->router->method == 'edit')) {
                            $employee_management = $employee = 'active';
                            $titles = 'Employee Management - Manage Employee';
                            $breadcrumb_title_1 = 'Employee Management';
                            $breadcrumb_title_2 = 'Manage Employee';
                        }
                        if (($this->uri->uri_string() == 'employee_management/emp_counter') || ($this->uri->uri_string() == 'employee_management/emp_counter/index') || ($this->uri->uri_string() == 'employee_management/emp_counter/add') || ($this->router->class == 'emp_counter' && $this->router->method == 'edit')) {
                            $employee_management = $counter_employee = 'active';
                            $titles = 'Employee Management - Manage Employee Counter';
                            $breadcrumb_title_1 = 'Employee Management';
                            $breadcrumb_title_2 = 'Manage Employee Counter';
                        }


                        # Manage Reports

                        if (($this->uri->uri_string() == 'reports') || ($this->uri->uri_string() == 'reports/index') || ($this->uri->uri_string() == 'reports/add')) {
                            $manage_reports = $reports = 'active';
                            $titles = 'Reports - Manage Reports';

                            $breadcrumb_title_1 = 'Reports';
                            $breadcrumb_title_2 = 'Manage Reports';
                        }

                        if (($this->uri->uri_string() == 'reports/feedback') || ($this->uri->uri_string() == 'reports/feedback')) {
                            $manage_reports = $feedback = 'active';
                            $titles = 'Reports - Manage Feedback';
                            $breadcrumb_title_1 = 'Reports';
                            $breadcrumb_title_2 = 'Manage Feedback';
                        }
                        ?>
                        <!-- Main navigation -->
                        <div class="sidebar-category sidebar-category-visible">
                            <div class="category-content no-padding">
                                <ul class="navigation navigation-main navigation-accordion">
                                    <!-- Main -->
                                    <!--<li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li>-->
                                    <?php if ($this->user_auth->is_module_allowed('dashboard')): ?>
                                        <li class="<?php echo $dashboard; ?>"><a href="<?php echo base_url(); ?>"><i class="icon-home2"></i> <span>Dashboard</span></a></li>
                                    <?php endif; ?>

                                    <?php if ($this->user_auth->is_module_allowed('masters')): ?>
                                        <li class="<?php echo $masters; ?>">
                                            <a href="javascript:void(0);"><i class="icon-grid"></i><span>Masters</span></a>
                                            <ul>
                                                <?php if ($this->user_auth->is_section_allowed('masters', 'counter')): ?> <li class="<?php echo $counter; ?>"><a href="<?php echo base_url() . 'masters/counter'; ?>"><i class="icon-chevron-right"></i>Counter</a></li> <?php endif; ?>

                                                <?php if ($this->user_auth->is_section_allowed('masters', 'category_type')): ?>
                                                    <li class="<?php echo $category_type; ?>"><a href="<?php echo base_url() . 'masters/category_type'; ?>"><i class="icon-chevron-right"></i>Manage Category</a> </li>
                                                <?php endif; ?>
                                                <?php if ($this->user_auth->is_section_allowed('masters', 'sub_category')): ?>

                                                    <li class="<?php echo $subcategory; ?>"><a href="<?php echo base_url() . 'masters/subcategory'; ?>"><i class="icon-chevron-right"></i>Manage Sub Category</a> </li>
                                                <?php endif; ?>
                                                <?php if ($this->user_auth->is_section_allowed('masters', 'advertisement')): ?>
                                                    <li class="<?php echo $advertisement; ?>"><a href="<?php echo base_url() . 'masters/advertisement'; ?>"><i class="icon-chevron-right"></i>Manage Advertisement</a> </li>
                                                <?php endif; ?>
                                            </ul>
                                        </li>
                                    <?php endif; ?>
                                    <?php if ($this->user_auth->is_module_allowed('users')): ?>
                                        <li class="<?php echo $users; ?>">
                                            <a href="javascript:void(0);"><i class="icon-users4"></i> <span>Users</span></a>
                                            <ul>
                                                <?php if ($this->user_auth->is_section_allowed('users', 'users')): ?>
                                                    <li class="<?php echo $manage_users; ?>"><a href="<?php echo base_url() . 'users'; ?>"><i class="icon-chevron-right"></i>Manage Users</a> </li>
                                                <?php endif; ?>

                                                <?php if ($this->user_auth->is_section_allowed('users', 'user_types')): ?>
                                                    <li class="<?php echo $user_types; ?>"><a href="<?php echo base_url() . 'users/user_types'; ?>"><i class="icon-chevron-right"></i>Manage User Types</a></li>
                                                <?php endif; ?>

                                                <?php if ($this->user_auth->is_section_allowed('users', 'user_modules')): ?>

                                                    <li class="<?php echo $manage_user_modules; ?>"><a href="<?php echo base_url() . 'users/user_modules'; ?>"><i class="icon-chevron-right"></i>Manage User Modules</a></li>
                                                <?php endif; ?>
                                                <?php if ($this->user_auth->is_section_allowed('users', 'user_sections')): ?>
                                                    <li class="<?php echo $manage_user_sections; ?>"><a href="<?php echo base_url() . 'users/user_sections'; ?>"><i class="icon-chevron-right"></i>Manage User Sections</a></li>
                                                <?php endif; ?>
                                            </ul>
                                        </li>
                                    <?php endif; ?>



                                    <?php if ($this->user_auth->is_module_allowed('employee_management')): ?>
                                        <li class="<?php echo $employee_management; ?>">
                                            <a href="javascript:void(0);"><i class="glyphicon glyphicon-user" ></i> <span>Employee Management</span></a>
                                            <ul>
                                                <?php if ($this->user_auth->is_section_allowed('employee_management', 'employee')): ?> <li class="<?php echo $employee; ?>"><a href="<?php echo base_url() . 'employee_management/employee'; ?>"><i class="icon-chevron-right"></i>Manage Employee</a> </li>
                                                <?php endif; ?>
                                            </ul>
                                            <ul>
                                                <?php if ($this->user_auth->is_section_allowed('employee_management', 'counter_employee')): ?> <li class="<?php echo $counter_employee; ?>"><a href="<?php echo base_url() . 'employee_management/emp_counter'; ?>"><i class="icon-chevron-right"></i>Manage Counter</a> </li>
                                                <?php endif; ?>
                                            </ul>
                                        </li>
                                    <?php endif; ?>
                                    <?php if ($this->user_auth->is_module_allowed('manage_reports')): ?>
                                        <li class="<?php echo $manage_reports; ?>">
                                            <a href="javascript:void(0);"><i class="glyphicon glyphicon-duplicate" ></i> <span>Manage Reports</span></a>
                                            <ul>
                                                <?php if ($this->user_auth->is_section_allowed('manage_reports', 'reports')): ?> <li class="<?php echo $reports; ?>"><a href="<?php echo base_url() . 'reports'; ?>"><i class="icon-chevron-right"></i>Token Report</a> </li>
                                                <?php endif; ?>
                                            </ul>
                                            <ul>
                                                <?php //if ($this->user_auth->is_section_allowed('analytics_reports', 'reports')):  ?> <li class="<?php echo $reports; ?>"><a href="<?php echo base_url() . 'reports/analytics_reports'; ?>"><i class="icon-chevron-right"></i>Analytics Report</a> </li>
                                                <?php //endif; ?>
                                            </ul>
                                            <ul>
                                                <?php if ($this->user_auth->is_section_allowed('manage_reports', 'feedback')): ?> <li class="<?php echo $feedback; ?>"><a href="<?php echo base_url() . 'reports/feedback'; ?>"><i class="icon-chevron-right"></i>Feedback</a> </li>
                                                <?php endif; ?>
                                            </ul>
                                        </li>
                                    <?php endif; ?>

                                    <li class="">
                                        <a target = '_blank' href="<?php echo base_url() . 'queprocess'; ?>"><i class="icon-users4"></i> <span>Queue Process</span></a>
                                    </li>

                                    <li class="">
                                        <a target = '_blank' href="<?php echo base_url() . 'counterscreen'; ?>"><i class="icon-grid"></i> <span>Counter Screen</span></a>
                                    </li>


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