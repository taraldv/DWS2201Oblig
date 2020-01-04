<?php
define('ROOT', dirname(__DIR__) . '/');
define('APP', ROOT . 'app' . '/');
define('VIEW', ROOT . 'app' . '/' . 'view' . '/');
define('MODEL', ROOT . 'app' . '/' . 'model' . '/');
define('CORE', ROOT . 'app' . '/' . 'core' . '/');
define('CONTROLLER' , ROOT . 'app' . '/' . 'controller' . '/');
$modules = [ROOT,APP,CORE,CONTROLLER,MODEL];
set_include_path(get_include_path() . PATH_SEPARATOR . implode(PATH_SEPARATOR,$modules));
spl_autoload_register('spl_autoload',false);

error_reporting(E_ALL);
ini_set('display_errors','on');
new Application;
?>
