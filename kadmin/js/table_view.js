var Url = {

	url: {},

	format: function () {
		this.url['path'] = window.location.origin + window.location.pathname;
		var search = window.location.search.slice(1).split('&');

		for(var i = 0; i < search.length; ++i) {

			var a = search[i].split('=');
			if (a[0]) {
				this.url[a[0]]=decodeURI(a[1]);
			}
		}
		console.log(this.url);
	},

	redirect: function () {

		var link = this.url['path'];
		var f = false;
		for (var t in this.url) {
			if (t != 'path' && this.url[t]) {
				link += (f?'&':'?') + t + '=' + this.url[t];
				f = true;
			}
		}

		window.location.href = link;
	},

	update: function (key, value) {
		this.url[key] = value;
	},

	log: function () {
		console.log(this.url);
	}
};

$(document).ready(function(){
	var tm = TweenMax,
		objOpacify = $('nav span, .right_icon, #Text, .copyright'),
		aside = $('aside'),
		main = $('main'),
		asideLogoSvg = $('aside .logo svg'),
		submenuTrigger = $('.has_submenu')

//зміна виведення кількості товарів на сторінці +
	$('a[data-item-val]').on('click', function(e){
		e.preventDefault();
		var items_count = $(this).attr('data-item-val');
		$.ajax({
			url: '',
			type: 'post',
			data: {'items_count': items_count},
			success: function(){
				location.reload();
			},
			error: function () {

			}
		});
	});

// Зміна позицій полів
	$('form[data-table-sort-pos]').on('submit', function(e){
		e.preventDefault();
		var table_name = $('[data-table-name]').attr('data-table-name');
		var trs_id = $('input#sortdata').val();
		var fields_id = getFieldsId(trs_id);
		var first_position = $('[data-first-position]').attr('data-first-position');

		$.ajax({
			url: '',
			type: 'post',
			data: {table_name: table_name, fields_id: fields_id, first_position: first_position},
			dataType: "json"
		});
	});

	// Змінити значення всіх чекбоксів на сторінці +
	$('input#check_all').on('click', function(e){
		var checkbox_value = $(this).prop('checked');
		if (checkbox_value == true) {
			$('[data-table-checkbox]').prop('checked', true);
		} else {
			$('[data-table-checkbox]').attr('checked', false);
		}
	});

// Видалення обраних полів з таблиці
	$('[data-delete-fields]').on('click', function(e){
		var table_name = $('[data-table-name]').attr('data-table-name');
		var fields_id = getSelectedId();

		$.ajax({
			url: '',
			type: 'post',
			data: {table_name: table_name, deleted_id: fields_id},
			dataType: 'json',
			success: function(data){
				if(data['status'] == "ok") {
					$('[data-table-checkbox]:checked').each(function(i, elem){
						$(this).parents('[data-field-id]').fadeOut(500).remove();
					});
					showSuccessMessage('Успешно удалено');
				} else {
					showErrorMessage('Ошибка удаления');
				}
			}
		});
	});

// Фільтр для продуктів
//	$('[data-show-select-level-1]').on('click', function() {
//		showFilterProductSelect(1);
//	});

// Підсвітка активного меню
	(function(){
		var table_name = $('[data-table-name]').attr('data-table-name');
		var up_level_id = $('[data-up-level-id]').attr('data-up-level-id');
		var menu_item = $('[data-menu-name="' + table_name + '"]');

		menu_item.find('>a').addClass('active_nav');
		menu_item.find('ul').eq(0).css('display', 'block');
		menu_item.parents('ul').css('display', 'block').prev('a').addClass('active_nav');
		if(up_level_id != "") {
			menu_item.find('li[data-menu-up-level=' + up_level_id + '] a').addClass('active_nav');
		}

	})();


	// Надіслати повідомлення підпищикам
	$('[data-send-subscr]').on('click', function (e) {
		var message_area = $('[data-subscr-message]'),
			subject_area = $('input[name="subscr_subject"]');
		var message = message_area.val(),
			subject = subject_area.val(),
			subscrs_id = getSelectedId();
		if (message == "") {
			showErrorMessage('Message can\'t be empty');
			return false;
		}
		if (subject == "") {
			showErrorMessage('Subject can\'t be empty');
			return false;
		}
		if (subscrs_id.length == 0) {
			showErrorMessage('You should check receivers');
			return false;
		}
		$.ajax({
			url: '/kadmin/?c=view',
			type: 'post',
			data: {
				subscr_message: 1,
				message: message,
				subject: subject,
				subscrs_id: subscrs_id
			},
			dataType: "json",
			success: function(data){
				if(data['status']) {
					message_area.val("");
					subject_area.val("");
					showSuccessMessage('Сообщение отправлено');
				} else {
					showErrorMessage('Ошибка отправки');
				}
			}
		});

	});


	// Встановлення куки на стан меню
	//$('[data-change-menu-view]').on('click', function () {
	//	var menu_status;
	//	if ($('aside').is('.active')) {
	//		menu_status = 'active';
	//	} else {
	//		menu_status = 'not_active'
	//	}
    //
	//	$.ajax({
	//		url: '/kadmin/?c=view',
	//		type: 'post',
	//		data: {
	//			menu_status : menu_status
	//		},
	//		dataType: "json"
	//	});
	//});


	//if (aside.hasClass('active')) {
	//	tm.to(objOpacify, .2, {opacity: 0, 'display': 'none'});
	//	tm.to(aside, .2, {width: 60, delay: .2 });
	//	tm.to(asideLogoSvg, .2, {'margin-left': '0'});
	//	tm.to(main, .2, {'margin-left': '60', delay: .2});
	//	submenuTrigger.removeClass('active_nav');
	//	$('nav ul ul').hide();
	//}

//фільтрація галереї і продуктів по категрріям
	$('.ml_filter').on('change',function(e){
		e.preventDefault();
		var id = $(this).val();
		Url.format();
		Url.update("cat",id);
		Url.redirect();
	});
	//end ready
});



// Отримати GET параметри
function parseGetParams() {
	var $_GET = {};
	var __GET = window.location.search.substring(1).split("&");
	for(var i=0; i<__GET.length; i++) {
		var getVar = __GET[i].split("=");
		$_GET[getVar[0]] = typeof(getVar[1])=="undefined" ? "" : getVar[1];
	}
	return $_GET;
}


// Отримати масив id полів
function getFieldsId(trs_id){
	var trs_id_arr = trs_id.split(',');
	var fields_id = [];
	for(var i = 0; i < trs_id_arr.length; i++){
		fields_id[i] = $('tr#' + trs_id_arr[i]).attr('data-field-id');
	}
	return fields_id;
}

// Приховати діалогове вікно
function closeDialog() {
	var body = $('body');
	var wPos = body.attr('data-scroll');
	$('.dialog').hide().removeClass('active_dialog');
	$('.dialog_bg').hide();
	// return scroll
	body.removeClass('dialog_opened');
	$(window).scrollTop(wPos);
}

// Отримати id відмічених чекбоксами полів
function getSelectedId () {
	var fields_id = [];
	$('[data-table-checkbox]:checked').each(function(i, elem){
		fields_id[i] = $(this).parents('[data-field-id]').attr('data-field-id');
	});
	return fields_id;
}