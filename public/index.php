<?php
use Hopelessness\Application;
use Zend\Loader\StandardAutoloader;

require_once '../vendor/autoload.php';

$autoloader = new StandardAutoloader();
$autoloader->registerNamespace('Hopelessness', '../library/Hopelessness')
    ->register();

$application = new Application();
$application->run();
