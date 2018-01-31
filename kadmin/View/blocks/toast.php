<div class="error toast">
	<span class='toast_close'><svg class='icon'><use xlink:href='/kadmin/View/img/svgdefs.svg#icon_close'></use></svg></span>
	<div class='table'>
		<div class='tcell'>
			<svg class='icon || toast_icon'><use xlink:href='/kadmin/View/img/svgdefs.svg#icon_error'></use></svg>
		</div>
		<div class='tcell'>
			<p>Ошибка</p>
		</div>
	</div>
</div>

<div class="success toast">
	<span class='toast_close'><svg class='icon'><use xlink:href='/kadmin/View/img/svgdefs.svg#icon_close'></use></svg></span>
	<div class='table'>
		<div class='tcell'>
			<svg class='icon || toast_icon'><use xlink:href='/kadmin/View/img/svgdefs.svg#icon_check'></use></svg>
		</div>
		<div class='tcell'>
			<p>Ошибка</p>
		</div>
	</div>
</div>
<? if (isset($_GET['mail'])){?>
<script>
$('document').ready(function(){
	showSuccessMessage('Сообщение отправлено');
});
</script>
<? } ?>