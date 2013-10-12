<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Basic project directory
define('BASE_DIR', __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);

// Directory configuration
define('SRC_DIR',           BASE_DIR . 'src' . DIRECTORY_SEPARATOR);
define('INTERFACE_DIR',     SRC_DIR . 'Interface' . DIRECTORY_SEPARATOR);
define('VIEW_CLASS_DIR',    SRC_DIR . 'App' . DIRECTORY_SEPARATOR . 'Data' . DIRECTORY_SEPARATOR . 'VIEW' . DIRECTORY_SEPARATOR);
define('TEMPLATE_DIR',      SRC_DIR . 'Template' . DIRECTORY_SEPARATOR);

// Template Config
define('TPL_MODE_HTML_FULL',        'html/full');
define('TPL_MODE_HTML_ACTION_ONLY', 'html/action');
define('TPL_MODE_JSON',             'json');
define('TPL_HTML_BASE',             TEMPLATE_DIR . 'base.html');
define('TPL_JSON_BASE',             TEMPLATE_DIR . 'jsonBase.html');

// Resource Config
define('RESOURCE_TYPE',         'DB');
define('RESOURCE_SYSTEM',       'MySQL');
define('RESOURCE_DB_HOST',      '127.0.0.1');
define('RESOURCE_DB_PORT',      '3306');
define('RESOURCE_DB_NAME',      'multiplechoice');
define('RESOURCE_DB_USER',      'multiplechoice');
define('RESOURCE_DB_PASSWORD',  'test123');

// Security Config
define('MD5_MOD', 'Mul71pl3');

// Misc Config
define('CFG_WEB_ROOT', '/Multiplechoice/htdocs');

// Hook configuration
$GLOBALS['arrCFGPrehooks']  = array(
);
$GLOBALS['arrCFGPosthooks'] = array(
);

// @TODO THIS IS JUST FOR MY XAMPP
if(isset($_SERVER['REDIRECT_URL'])) {
    $_SERVER['REDIRECT_URL'] = str_replace(CFG_WEB_ROOT, '', $_SERVER['REDIRECT_URL']);
}

/**
 * PHP Autoloader function
 *
 * @author Holger Szüsz <hszuesz@live.com>
 * @param String $strClassname
 */
function __autoload($strClassname) {
    if(substr($strClassname, 0, 1) === 'I') {
        include_once INTERFACE_DIR . str_replace('_', DIRECTORY_SEPARATOR, $strClassname) . '.php';
    } else if(substr($strClassname, 0, 4) === 'view') {
        include_once VIEW_CLASS_DIR . $strClassname . '.php';
    } else {
        include_once SRC_DIR . str_replace('_', DIRECTORY_SEPARATOR, $strClassname) . '.php';
    }
}