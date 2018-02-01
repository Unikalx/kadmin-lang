<?php
include_once('config.php');
//include_once('startup.php');
include_once('Model/M_Users.php');
include_once('Model/Model.php');

//startup();
session_start();

// MANAGERS.
$mUsers = M_Users::Instance();
$db = Model::Instance();

// EXIT.
$mUsers->Logout();

$db->Array_clean('SELECT * FROM `users`');

// GET INFO FROM THE FORM
if (!empty($_POST)) {
    if ($mUsers->Login($_POST['login'], $_POST['password'], $_POST['remember'])) {

        $last_login = $mUsers->Get_last_login($_POST['login']);

        $_SESSION['authorize']['last_login'] = $last_login['last_login'];
        $_SESSION['authorize']['last_activity'] = $last_login['last_activity'];
        $_SESSION['authorize']['id_user'] = $last_login['id_user'];
        $_SESSION['authorize']['status'] = $last_login['status'];

        setcookie('login', $_POST['login']);

//        $mUsers->LastLoginUpdate($_POST['login']);
        header('Location: /admin');

    }
}
// CHARSET :
header('Content-type: text/html; charset=utf-8');
?>

<!doctype html>
<html>
<head>
    <?php include('View/blocks/head_tags.php'); ?>
</head>
<body style='overflow-y: scroll'>

<form action='' method="POST" class='login_form || validate_form'>
    <a href='' class='logo'><?php include('View/blocks/svg/logo.php'); ?></a>
    <div class='input_wrap'>
        <svg class='icon'>
            <use xlink:href='View/img/svgdefs.svg#icon_person'></use>
        </svg>
        <input type='text' name='login' placeholder='Логин для входа' class='input || validate'></div>
    <div class='input_wrap'>
        <svg class='icon'>
            <use xlink:href='View/img/svgdefs.svg#icon_key'></use>
        </svg>
        <input type='password' name='password' placeholder='Ваш пароль' class='input || validate'></div>
    <div class='input_wrap'>
        <input name='remember' type='checkbox' id='remember'>
        <label for='remember'>Запомнить меня</label>
        <button class='button || fr'>Вход</button>
    </div>
</form>
<div class='under_login'>
    <span>Copyright 2008-<?= date('Y') ?>&nbsp;|&nbsp;<a href="http://www.korzun.com.ua" style="margin: 0;">Korzun Studio</a></span>
</div>

<?php include('View/blocks/toast.php'); ?>

</body>
</html>