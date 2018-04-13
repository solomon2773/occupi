<?php
ini_set('memory_limit', '2048M');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


use Zend\Mvc\Application;
use Zend\Stdlib\ArrayUtils;
//phpinfo();

/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
chdir(dirname(__DIR__));

// Decline static file requests back to the PHP built-in webserver
if (php_sapi_name() === 'cli-server') {
    $path = realpath(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    if (__FILE__ !== $path && is_file($path)) {
        return false;
    }
    unset($path);
}

// Composer autoloading
include __DIR__ . '/../vendor/autoload.php';

if (! class_exists(Application::class)) {
    throw new RuntimeException(
        "Unable to load application.\n"
        . "- Type `composer install` if you are developing locally.\n"
        . "- Type `vagrant ssh -c 'composer install'` if you are using Vagrant.\n"
        . "- Type `docker-compose run zf composer install` if you are using Docker.\n"
    );
}


// Retrieve configuration
date_default_timezone_set("America/Chicago");
//$appConfig = ArrayUtils::merge($appConfig, require __DIR__ . '/../config/development.config.php');
$development_allowed_ips = array('47.184.19.124','198.154.108.246','45.35.53.196','47.184.9.118');
$client_ip = $_SERVER['REMOTE_ADDR'];
//$client_ip_HTTP_X_FORWARDED_FOR = $_SERVER['HTTP_X_FORWARDED_FOR'];
if(in_array($development_allowed_ips,$development_allowed_ips)){
  //  echo $client_ip_HTTP_X_FORWARDED_FOR;
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);

    $appConfig = require __DIR__ . '/../config/application.config.php';
   // if (file_exists(__DIR__ . '/../config/development.config.php')) {
    $appConfig = ArrayUtils::merge($appConfig, require __DIR__ . '/../config/development.config.php');
   // }
} else {
    $appConfig = require __DIR__ . '/../config/application.config.php';
}
define("SITE_URL_SSL", "https://occupi.yottatrend.com/");
define("ROOT_PATH", "/home/occupi/public_html");
// Run the application!
Application::init($appConfig)->run();


