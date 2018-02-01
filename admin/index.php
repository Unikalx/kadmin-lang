<?php
include_once('config.php');
include_once('Model/M_Users.php');

// MANAGERS
$mUsers = M_Users::Instance();

// if user is not register - go to register page.
$mUsers->ifLogin();

// CHARSET
header('Content-type: text/html; charset=utf-8');

// SET AUTO CONTROLLERS
function __autoload($class_name)
{
    if ($class_name != 'C_Array_Array') {
        include_once('Controller/' . $class_name . '.php');
    }
}

// CHOOSE CONTROLLER
$t = trim($_GET['t']);

$t{0} = strtoupper($t{0});
$t = str_replace("_cat", "_Cat", $t);
$t = str_replace("_tag", "_Tag", $t);
$t = str_replace("_comment", "_Comment", $t);
$t = str_replace("_setting", "_Setting", $t);
$c = trim($_GET['c']);
$c{0} = strtoupper($c{0});
$class = 'C_' . $t . '_' . $c;


if (class_exists($class)) {
    $controller = new $class();
} else {
    $controller = new C_Home();
}

$controller->Request();