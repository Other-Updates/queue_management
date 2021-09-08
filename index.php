<?php

//test

define('ENVIRONMENT', 'production');



if (defined('ENVIRONMENT')) {

    switch (ENVIRONMENT) {

        case 'development':

            error_reporting(E_ALL);

            break;



        case 'testing':

        case 'production':

            error_reporting(0);

            break;



        default:

            exit('The application environment is not set correctly.');
    }
}



$system_path = 'system';

$application_folder = 'application';



if (defined('STDIN')) {

    chdir(dirname(__FILE__));
}



if (realpath($system_path) !== FALSE) {

    $system_path = realpath($system_path) . '/';
}





$system_path = rtrim($system_path, '/') . '/';





if (!is_dir($system_path)) {

    exit("Your system folder path does not appear to be set correctly. Please open the following file and correct this: " . pathinfo(__FILE__, PATHINFO_BASENAME));
}



define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));



define('EXT', '.php');



define('BASEPATH', str_replace("\\", "/", $system_path));



// Path to the front controller (this file)

define('FCPATH', str_replace(SELF, '', __FILE__));



// Name of the "system folder"

define('SYSDIR', trim(strrchr(trim(BASEPATH, '/'), '/'), '/'));





// The path to the "application" folder

if (is_dir($application_folder)) {

    define('APPPATH', $application_folder . '/');
} else {

    if (!is_dir(BASEPATH . $application_folder . '/')) {

        exit("Your application folder path does not appear to be set correctly. Please open the following file and correct this: " . SELF);
    }



    define('APPPATH', BASEPATH . $application_folder . '/');
}





require_once BASEPATH . 'core/CodeIgniter.php';



