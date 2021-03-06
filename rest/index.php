<?php

// respond to preflights
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
  if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']) &&
      ($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'] == 'PUT' || $_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'] == 'POST')) {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: Content-Type, X-Requested-With');
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
 }
  exit;
}

require_once('../backend/libraries/autoload.php');
include('aop/config-aop.php');

use backend\common\rest\library\Request;

ini_set('error_reporting', E_ALL);

Logger::configure(APP_ROOT . '/config/log4php.xml');
$logger = Logger::getLogger("RESTGATEWAY");
$loggerError = Logger::getLogger("ERROR");
$request = new Request ();

$package = 'backend\app\rest\controllers\\';
$packageViews = 'backend\common\rest\views\\';

$controller_name = $package . ucfirst($request->url_elements [1]) . 'Controller';
$logger->info(array(
    'timestamp' => $request->datetime,
    'request' => $request));

$result = null;
if (class_exists($controller_name)) {
    $controller = new $controller_name($request);
    $action_name = strtolower($request->verb) . 'Action';
    $result = $controller->$action_name();
} else {
    $result ['request_time'] = date("D M j G:i:s T Y", $request->datetime);
    $result ['status'] = "fail";
    $result ['message'] = "Bad Request";
}

$view_name = $packageViews . ucfirst($request->format) . 'View';

if (class_exists($view_name)) {
    $view = new $view_name ();
    $view->render($result);
}
$logger->info(array(
    'timestamp' => $request->datetime,
    'result' => $result));
