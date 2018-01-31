<header>
	<div class='tcell'>
		<span class='burger || header_icon' data-change-menu-view title='Hide menu'><svg class='icon'><use xlink:href='View/img/svgdefs.svg#icon_menu'></use></svg></span>
		<span class='help || header_icon' title='Help'><svg class='icon'><use xlink:href='View/img/svgdefs.svg#icon_help'></use></svg></span>
		<?php if (!empty($_GET['t']) && $_GET['v'] == 'table' && ($_GET['t'] != 'orders' && $_GET['t'] != 'faq')) : ?>
			<span class='search || header_icon' title='Search' data-search-toggle><svg class='icon'><use xlink:href='View/img/svgdefs.svg#icon_search'></use></svg></span>
		<?php else : ?>
			<span class='search || header_icon' title='Search' data-search-toggle style="display: none"><svg class='icon'><use xlink:href='View/img/svgdefs.svg#icon_search'></use></svg></span>
		<?php endif?>
		<a href='/' class='to_website || header_icon' title='Go to the website' target='_blank'><svg class='icon'><use xlink:href='View/img/svgdefs.svg#icon_home'></use></svg><span>Открыть сайт</span></a>
		<div class='header_user'>
			<a href='/kadmin/login' title='Logout' class='logout'><svg class='icon'><use xlink:href='View/img/svgdefs.svg#icon_exit'></use></svg></a>
			<div class='logged_as'>
				Вы вошли как <?php if($_SESSION['authorize']['status'] == 1 ){ echo "Super Admin";} else{ echo"Admin";}?>
			</div>
		</div>
<!--        <div class="lang_block">-->
<!--            <div class="lang_wrrap">-->
<!--                <a href="/" class="--><?//= ($_SESSION['adminLang'] == 'ru')?'active':'' ?><!--" onclick="return false" lang="ru">Рус</a>-->
<!--                <a href="/" class="--><?//= ($_SESSION['adminLang'] == 'ua')?'active':'' ?><!--" onclick="return false" lang="ua">Укр</a>-->
<!--            </div>-->
<!--        </div>-->
	</div>
</header>
<form action='#' method='POST' class='search_form || clearfix' data-search-form>
	<div class='h3'>Search in <span data-search-table-name></span></div>
	<div class='row' data-url-or-name>
		<div class='col_6'>
			<input name='field_name' type='radio' id='radio1' value="name" checked>
			<label for='radio1'>in names</label>
		</div>
		<div class='col_6'>
			<input name='field_name' type='radio' id='radio2' value="url">
			<label for='radio2'>in url</label>
		</div>
	</div>
	<input type='search' name='field_value' class='input'>
	<button class='clear button || fr' type="submit">Search</button>
</form>

<!-- Dialogs -->
<div class='dialog_close || dialog_bg'><span><svg class='icon'><use xlink:href='View/img/svgdefs.svg#icon_close'></use></svg></span></div>
<!-- Help dialog -->
<div class="help_dialog || dialog">
	<div class="h2">Помощь</div>
	<p>Если у Вас возникли вопросы - напишите нам:</p>
	<form action='/kadmin/mailer.php' method='POST' class='clearfix'>
		<select name='subject' class='input'>
			<option value='' selected disabled>Выберите категорию</option>
			<option value='Техническая поддержка'>Техническая поддержка</option>
			<option value='Финансовая поддержка'>Финансовая поддержка</option>
			<option value='Другое'>Другое</option>
		</select>
		<span>Ваше сообщение</span>
		<textarea name='message' class='input'></textarea>
		<button class='button || fr'>Отправить</button>
	</form>
</div>
<!-- Delete dialog -->
<div class= "delete_dialog || dialog">
	<div class="h2">ВНИМАНИЕ</div>
	<p class="tc" >Вы действительно хотите удалить?</p>
	<p class="tc">
		<button class='button || modal_close' style="margin: 0 1rem;">НЕТ</button>
		<button class='button || ml_del_field' style="margin: 0 1rem;">ДА</button>
	</p>
</div>
<!-- Change password dialog -->
<div class= "pass_dialog || dialog">
	<div class="row" style="margin-bottom: 12px;">
		<div class="h2">Изменить пароль</div>
		<form action="" class='new_pass' style="padding-bottom: 0;">
			<span>Новый пароль:</span>
			<input type="password"  class="input || validate_pass">
			<span>Подтвердите пароль:</span>
			<input type="password"  class="input || validate_pass_confirm">
			<div class="tc">
				<button class='button || ml_save_change' style="margin: 0 1rem;">Сохранить</button>
			</div>
		</form>
	</div>
</div>

<!-- INPUT	FILE	IMAGE	PREVIEW -->
<img class='input_preview' src="#">