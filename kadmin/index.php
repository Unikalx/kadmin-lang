<?php

// SET DB CONFIG
include_once('config.php');
include_once('startup.php');
include_once('Model/M_Users.php');

//error_reporting(E_ALL & ~E_NOTICE);
// CONNECT TO DB
startup();

// MANAGERS
$mUsers = M_Users::Instance();

// if user is not register - go to register page.
$mUsers->ifLogin();

// CHARSET
header('Content-type: text/html; charset=utf-8');

// SET AUTO CONTROLLERS

function __autoload($class_name)
{
	if ($class_name != 'C_Array_Array'){
		include_once ('Controller/' . $class_name . '.php');
	}	
}

// CHOOSE CONTROLLER
$t = trim(mysql_real_escape_string($_GET['t']));
$t{0} = strtoupper($t{0});
$t = str_replace("_cat", "_Cat", $t);
$t = str_replace("_tag", "_Tag", $t);
$t = str_replace("_comment", "_Comment", $t);
$t = str_replace("_setting", "_Setting", $t);
$c =  trim(mysql_real_escape_string($_GET['c']));
$c{0} = strtoupper($c{0});

$class = 'C_' . $t . '_' . $c;


if(class_exists($class)){
	$controller = new $class();
}else{
	$controller = new C_Home();
}

$controller->Request();