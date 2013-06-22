<?php
use Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper;
use Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper;
use Hopelessness\Application;
use Symfony\Component\Console\Helper\HelperSet;
use Zend\Loader\StandardAutoloader;

require_once './vendor/autoload.php';

$autoloader = new StandardAutoloader();
$autoloader->registerNamespace('Hopelessness', './library/Hopelessness')
    ->register();

$application = new Application();

$helperSet = new HelperSet(array(
    'db' => new ConnectionHelper($application['db']),
    'em' => new EntityManagerHelper($application['orm'])
));
