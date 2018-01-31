<?php 

include_once('config.php');
include_once('startup.php');
include_once('Model/Model.php');

startup();
$db = Model::Instance();
session_start();
if (isset($_POST['message']) AND $_POST['message'] != ''){

	$to_name = 'KORZUN CMS ADMIN';
	$to_email = 'admin.korzun@gmail.com';
	$from_name = 'FROM KORZUN CMS - '. SITE_NAME;
	$from_email = CLIENT_EMAIL;
	
	$subject = $_POST['subject']." - ".$_POST['name']. "- письмо с сайта";
	
	$headers = "From: $from_name<".CLIENT_EMAIL.">\n";
	$headers.= "Reply-To: <$from_email>\n";
	$headers .= "X-Mailer: PHPMailer\n";
	$headers .= 'MIME-Version: 1.0' . "\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
	
	$message = "Имя сайта: ".SITE_NAME."<br/>\r\n";
	$message .= "Категория проблемы: ".$_POST['subject']."<br/>\r\n";
	if ($_POST['message'] != ''){$message .= "<br/>Сообщение: ".$_POST['message']."<br/>\r\n";}

		mail("$to_name<$to_email>", $subject, $message, $headers);
		$_SESSION['alert_mail'] = '<div class="h2">Спасибо за обращение!</div><p>Мы с Вами обязательно свяжемся!</p>';
		header('Location:/kadmin?mail');
} else {
	header('Location:/kadmin');
}	
?>