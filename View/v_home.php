<?php
include_once('config.php');
include_once('startup.php');
include_once('Model/M_Users.php');

startup();

// створюємо екземпляр класу M_Users
$mUsers = M_Users::Instance();

$mUsers->ifLogin();

//last login date
	$date = $_SESSION['authorize']['last_login'];
	$day = date("d-m-Y", strtotime($date));
	$time = date("G:i", strtotime($date));
?>
<section>
	<span class='h1'>Добро пожаловать в панель управления сайтом<p class='fr || color_grey' style="font-size: 1.5rem">Последний вход был: <?=$day?> (в <?=$time?>)</p></span>
<!--	<div class='row'>-->
<!--		<div class='col_6'>-->
<!--			<div class='pre_input'>Section Name</div>-->
<!--			<input type='text' name='section_name' class='input'>-->
<!--		</div>-->
<!--		<div class='col_6'>-->
<!--			<div class='pre_input'>Choose a Date</div>-->
<!--			<input type='text' name='date' class='input || datepicker'>-->
<!--		</div>-->
<!--	</div>-->
<!---->
<!--	<div class='pre_input'>Short Description</div>-->
<!--	<textarea type='text' name='textarea' class='input'></textarea>-->

	<br>
	<h2>Пожалуйста, выберите нужный пункт меню слева для начала работы.</h2><br><br>
	<p>Сайт разработан в Korzun Studio. Cвязь с нами:</p>
	<ul style="margin-left: 3rem;">
		<li>+38098-820-30-45</li>
		<li>+38063-695-04-35</li>
		<li>i@korzun.com.ua</li>
		<li><a href="http://www.korzun.com.ua">http://www.korzun.com.ua</a></li>
	</ul>
	<br><br><br>

</section>
