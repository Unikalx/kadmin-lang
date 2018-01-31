<?php
session_start();
if (isset($_POST['lang'])) {
    switch ($_POST['lang']) {
        case 'ua':
            $_SESSION['lang'] = 'ua';
            echo 1;
            break;
        case 'de':
            $_SESSION['lang'] = 'de';
            echo 2;
            break;
    }
}
if (isset($_POST['adminLang'])) {
    switch ($_POST['adminLang']) {
        case 'ua':
            $_SESSION['adminLang'] = 'ua';
            echo 1;
            break;
        case 'de':
            $_SESSION['adminLang'] = 'de';
            echo 2;
            break;
    }
}
?>

