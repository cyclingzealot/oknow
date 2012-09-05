<?php

define('PROJECT_HOME', dirname(__FILE__));
define('APPLICATION_MODE','testing');

require_once(PROJECT_HOME . '/config.php');

set_include_path(
        '.'
        . PATH_SEPARATOR . PROJECT_HOME
        . PATH_SEPARATOR . PROJECT_HOME . '/Model/'
        . PATH_SEPARATOR . PROJECT_HOME . '/Controller/'
        . PATH_SEPARATOR . get_include_path()
);


function _cl($c) {
	$includePath = str_replace('_', '/', $c) . '.php';	
    include_once $includePath;
}

spl_autoload_register('_cl');
