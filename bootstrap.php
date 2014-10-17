<?php
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Slim\Slim;


date_default_timezone_set('America/Los_Angeles');
require 'vendor/autoload.php';

$isDevMode = true;
$mode = isset($mode) ? $mode : 'production';

$rootPath = realpath(dirname(__DIR__));

//config
$config = array(
    'logger'                   => '',
    'logger_name'              => 'AwesomeAPI',
    'log_file'                 => $rootPath . '/logs/api.log',
    'log_signal'               => Logger::DEBUG, //minimum signal lvl to be logged (debug,info,notice,warning,critical,alert,emergency)
    'app_path'                 => $rootPath . '/src',
);


//slim instance
$app = new Slim(array(
    'debug' => $isDevMode,
    'mode' => $mode
));


// DI loggger
$app->container->singleton('log', function () use ($config) {
    // create a log channel
    $log = new Logger($config['logger_name']);
    $log->pushHandler(new StreamHandler($config['log_file'], $config['log_signal']));
    return $log;
});


//setup middleware
$app->view(new \JsonApiView());
$app->add(new \JsonApiMiddleware());
