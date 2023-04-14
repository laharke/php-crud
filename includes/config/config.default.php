<?php

// Title BAR
define('MSG_PAGE_TITLE', 'MPI Servicios Industriales, Bahia Blanca');

// Generales
define('SITE_URL', 'mpisa.web.vianetcon.com.ar');

// DATABASE PARAMETERS
define ('DBDRIVER','pgsql');
define ('DBNAME','jalil');
define ('DBHOST','unix(/tmp)'); 
define ('DBUSER','postgres'); 
define ('DBPASSWORD','');

// DIR PARAMETERS
define ('DIR_TEMPLATES_PATH',DIR_SERVER_PATH . 'templates/');
define ('DIR_INCLUDES_PATH', DIR_SERVER_PATH . 'includes/');
define ('DIR_JS_PATH',DIR_INCLUDES_PATH . 'js/');
define ('DIR_JQUERY_PATH',DIR_JS_PATH . 'jquery/');
define ('DIR_IMAGES_PATH','images/');

define ('APLICACION_PG_DUMP','/usr/bin/pg_dump');
define ('APLICACION_PSQL','/usr/bin/psql');
define ('APLICACION_SUDO','/usr/bin/sudo');

// IMAGES
// Envio de mails
define('SMTP_SERVER', 'ms1.bvconline.com.ar');
define('SMTP_AUTH', '1');
define('SMTP_USER', 'traq');
define('SMTP_PASS', 'zieq5tj1');
define('SMTP_FROM', 'traq@bvconline.com.ar');
define('SMTP_FROM_NAME', 'JalilStamps');

// SETEOS POR DEFECTO
define('DEFAULT_IDIOMA', 'es');
define('RECORDS_PER_PAGE', 25);
define('LASTS_ITEMS_COUNT', 100);


?>