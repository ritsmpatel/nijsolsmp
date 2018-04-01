<?php error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE ^ E_DEPRECATED);
session_start();
ini_set('upload_max_filesize', '200M');
ini_set('post_max_size', '200M');
// live
/*define('DB_SERVER', '127.0.0.1');
define('DB_NAME', 'nijsolad_pgs');
define('DB_USER', 'nijsolad_pgs');
define('DB_PASSWORD', '01PGS007');*/

/*define('DB_SERVER', '127.0.0.1');
define('DB_NAME', 'nijsolad_devnijsolsmp');
define('DB_USER', 'nijsolad_devsmp');
define('DB_PASSWORD', '01devSmp007');
*/

define('DB_SERVER', '127.0.0.1');
define('DB_NAME',$db_name);
define('DB_USER',$db_user);
define('DB_PASSWORD',$db_pass);

/*define('DB_SERVER', 'localhost');
define('DB_NAME', 'pgs_software');
define('DB_USER', 'root');
define('DB_PASSWORD', '');*/

define('DB_CHARSET', 'utf8');
define('DB_PREFIX','pgs_');
define('SITE_NAME', $short_name);
// All Urls
//define('SITE_URL', 'http://localhost/pgs/');
define('SITE_URL', 'http://'.$site_name."/");

define('FILE_UPLOAD_PATH' ,SITE_URL.'photo/');
define('FILE_UPLOAD_PATH_TIME_TABLE' ,SITE_URL.'time_table/');
define('SESSION_PREFIX','pgs_session_');
define('DATE_SEPARATOR','-');

// OPPS Management Folder Url
define('LOGIN_URL', SITE_URL.'login/');
define('MASTER_URL', SITE_URL.'master/');
define('PROCESSING_URL', SITE_URL.'processing/');
define('REPORT_URL', SITE_URL.'report/');
define('BLANK_REPORT_URL', SITE_URL.'blank_report/');
define('SETUP_URL', SITE_URL.'setup/');
define('UTILITIES_URL', SITE_URL.'utilities/');
define('HELP_URL', SITE_URL.'help/');
define('BUS_INFO_URL', SITE_URL.'bus_info/');
define('SPECIAL_SETUP_URL', SITE_URL.'special_setup/');
define('COMPLAIN_BOX_URL', SITE_URL.'complain_box/');
define('SEMESTER_RESULT_URL', SITE_URL.'semester_result/');
define('SETTINGS_URL', SITE_URL.'settings/');
define('NOTIFICATION_URL', SITE_URL.'notification/');
define('CMS_URL', SITE_URL.'cms/');

//short url
define('SHORT_MASTERS_URL', '../masters/');
define('SHORT_TRANSACTIONS_URL', '../transactions/');

define('ADMIN_LOGIN_USER_ID','admin_login_user_id');
define('ADMIN_LOGIN_USER_NAME','admin_login_user_name');
define('ADMIN_LOGIN_USER_TYPE','admin_login_user_type_id');
define('ADMIN_LOGIN_USER_PROPER_NAME','admin_login_user_proper_name');

// Button
define('BTN_ADD','btn btn-primary width100'); 
define('BTN_CANCEL','cancel btn btn-embossed btn-default'); 

// Popup header
define('POPUP_HEADER','modal-header bg-primary');
?>