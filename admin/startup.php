<?php
function startup()
{

// настройки подключения к БД :
    $hostname = DB_HOST_SITE;
    $username = DB_USER_SITE;
    $password = DB_PASSWORD_SITE;
    $dbName = DB_NAME_SITE;


    $mysqli = new mysqli($hostname, $username, $password, $dbName);

// подключение к БД :
    /*mysql_connect($hostname, $username, $password) or die("No connect with data base");
    mysql_query("SET NAMES utf8");
    mysql_select_db($dbName) or die("No data base");*/

//відкриваємо сеанс сесії
    session_start();
}