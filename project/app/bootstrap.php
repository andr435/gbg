<?php

// load config
require_once '../app/config/config.php';

// autoload
spl_autoload_register(function($className){
    require_once 'core/'.$className.'.php';
});