<?php

//foreach ($_SERVER as $key => $val) echo "$key: $val<br>";

define ('DIR_SERVER_PATH','/var/www/html/php-smarty/crud/');

function require_once_automatic($dir) {
    $files = dir($dir);
    while (false !== ($file = $files->read())) {
        if (ereg(".+\.php$", $file)) {
            if ($file <> "inc.php") require_once($files->path.'/'.$file);
            //echo "incluye:".$files->path.'/'.$file."<br>";
        }
    }
    $files->close();
}
// Seteos varios
ini_set('auto_globals_jit', 0);
ini_set('display_errors', 0);

// Configuracion general custom
$files = glob(DIR_SERVER_PATH .'includes/config/custom/*.php');
foreach ($files as $file) require_once($file);

// Configuracion general default
$files = glob(DIR_SERVER_PATH .'includes/config/*.php');
foreach ($files as $file) require_once($file);

// Externos
//require_once ('DB.php');
require_once (DIR_SERVER_PATH . 'includes/classes/smarty/Smarty.class.php');
//require_once (DIR_INCLUDES_PATH . 'classes/pdf/html2fpdf.php');


// Clases
$files = glob(DIR_SERVER_PATH .'includes/classes/*.php');
foreach ($files as $file) require_once($file);

// Librerias propias
$files = glob(DIR_SERVER_PATH .'includes/functions/*.php');
foreach ($files as $file) require_once($file);

// Inicializa la conexion con la base de datos, la session, y otros.

// Inicio el objeto json
     $json = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);

// Init Smarty php-engine
     $smarty = new Smarty;
     $smarty->template_dir = DIR_SERVER_PATH.'/templates/';
     $smarty->compile_dir = DIR_SERVER_PATH.'/templates_c/';
     $smarty->config_dir = DIR_SERVER_PATH.'/includes/class/smarty/configs/';
     $smarty->cache_dir = DIR_SERVER_PATH.'/includes/class/smarty/cache/';
     $smarty->left_delimiter = '{{';
     $smarty->right_delimiter = '}}';


     session_start();


     if (strstr(strtoupper($_SERVER['HTTP_USER_AGENT']), 'MSIE 8')) {

         define('IE', '8');

     } elseif (strstr(strtoupper($_SERVER['HTTP_USER_AGENT']), 'MSIE 7')) {

         define('IE', '7');

     } else {

         define('IE', 'no');

     }

?>