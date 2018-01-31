$(document).ready(function(){
	var tm = TweenMax,
	tl = new TimelineMax,
	$body = $('body'),
	$window = $(window),
	$aside = $('aside'),
	$main = $('main'),
	$objOpacify = $('nav span, .right_icon, #Text, .copyright'),
	$asideLogoSvg = $('aside .logo svg'),
	$submenuTrigger = $('.has_submenu'),
	$logo = $('.logo'),
	$wave = $('#wave'),
	$page = $('html, body'),
	$dialog = $('.help_dialog'),
	$delete = $('.delete_dialog')
	$dialogBg = $('.dialog_bg'),
	$dialogIcon = $('.dialog_bg span'),
	$dialogClose = $('.dialog_close'),
	$helpButton = $('.help'),
	$switcher = $('.switch'),
	$searchIcon = $('.search'),
	$searchForm = $('.search_form'),
	$uploadContainer = $('.upload_container'),
	$uploadBtn = $('.upload_gallery'),
	$scrollBar = $('.custom_scroll_bar'),
	$scrollWrap1 = $('.custom_scroll_wrap1'),
	$scrollWrap2 = $('.custom_scroll_wrap2'),
	$customScroll = $('.custom_scroll'),
	$nav = $('nav'),
	$dropZone = $('.dropzone'),
	$deletedText = $('.file_deleted'),
	$watchThumb = $('.watch_thumbnail'),
	$watchThumbDialog = $('.input_preview'),
	$uploadBtns = $('.delete_thumbnail, .watch_thumbnail'),
	$uploadFile = $('.upload_file'),
	$galleryDelete = $('.gallery_delete'),

	asideWidth = $aside.width(),

	windowHeight = $window.height;

	setScrollBar();
	validate();

	waveAnim = tm.to($('#wave'), 2.5, {y: 4, rotation: 5, yoyo: true, repeat: -1, ease: Power1.easeInOut});



	$('.step_first_btn').on('click', function() {
	var $siblings = $(this).closest('.step3_btn').siblings();
		//$siblings.removeClass('active')
		$(this).closest('.step3_btn').toggleClass('active');

	});
	$('.back_step_icon').on('click', function() {
		$(this).closest('.step3_btn').removeClass('active')
	});

	// set position from left on search form
	//$searchForm.each(function(){
	//	var searchIconOffset = $('.search').offset().left;
	//	$(this).css('left', searchIconOffset+'px');
	//});

	$searchIcon.on('click', function(event) {
		event.stopPropagation();
		$searchForm.toggleClass('active');
		if ($searchForm.hasClass('active')) { showSearch(); } else { hideSearch(); };
	});
	$searchForm.on('click', function(event) { event.stopPropagation(); });
	$(document).on('click', function() {
		if ($searchForm.hasClass('active')) { hideSearch()  };
	});

	// on esc press hide search form
	$(document).keyup(function(e) {
		if (e.keyCode == 27) { $searchForm.removeClass('active') }
	});

	$logo.on('mouseenter', function() {
		tm.to($wave, 1.5, {y: 15, rotation: 0, ease: Power1.easeInOut});
		waveAnim.kill();
	});

	$logo.on('mouseleave', function() {
		tm.to($wave, 1.5, {y: 0, rotation: 0, ease: Power1.easeInOut, onComplete: restart});
		function restart() {waveAnim.restart()}
	});

	// toggle submenu in aside
	$submenuTrigger.on('click', function(event) {
		var $this = $(this),
		$siblingsUl = $this.closest('li').siblings().find('ul'),
		$siblingsLinks = $this.closest('li').siblings().find('a');
		event.preventDefault();
		$this.toggleClass('active_nav');
		$this.next('ul').slideToggle(300);
		$siblingsUl.slideUp();
		$siblingsLinks.removeClass('active_nav');
		setTimeout(function () {
			setScrollBar();
		}, 300);
	});

	// reduce or increase size of left aside
	$('.burger').on('click', function(event) {
		var $this = $(this);
		event.preventDefault();
		$aside.toggleClass('active');
		if ($aside.hasClass('active')) { reduceAside() } else { increaseAside(); };
	});

	// show meta tags
	$('.show_meta').on('click', function(event) {
		event.preventDefault();

		tm.to($(this), .1, {autoAlpha: 0, 'display': 'none', y: -20});
		tm.fromTo($('.meta_tags'), 1.2, {'display': 'none', x: -500, autoAlpha: 0},
			{'display': 'block', x: 0, autoAlpha: 1, ease: Power3.easeInOut});
		tm.to(window, 2, {scrollTo:{y:1500}, ease:Power2.easeOut, delay: .2});
	});

	// count inputs length value
	$('.to_count').each(function() {
		var $this = $(this);
		$this.on('keyup', function() {
			var $counter = $this.prev('.pre_input').find('.input_count'),
			inputVal = $this.val(),
			inputLength = inputVal.length;
			$counter.text('['+inputLength+']');
			if (inputLength == 0) {$counter.text('')};
		});
	});

    $( ".datepicker" ).datepicker({ dateFormat: "yy-mm-dd" });
    $( ".datetimepicker" ).datetimepicker({ dateFormat: "yy-mm-dd" });

	$(".table tbody").sortable({
		handle : '.replace',
		axis:'y',
		cursor: 'move',
		containment: '.table tbody',
		stop: sortRows,
		helper: fixWidthHelper,
		update: function( event, ui ) {
			var name = ui.item.find('.ml_name').html();
			var type = ui.item.find('.ml_type_text_field').html();

			if(type == undefined || type=='')
				type = ui.item.find('.ml_type').html();

			var prev_name = ui.item.prev().find('.ml_name').html();
			var table = $('.ml_table_name').data('table');

			$.ajax({
				url: '',
				type: 'POST',
				data: {table:table, prev_name: prev_name,current_type: type,current_name:name},
				success: function(){
					//відображення повідомлення про успішне збереження
					var text = 'Позиция сохранена!';
					showSuccessMessage(text)
				}
			});

		}
	}).disableSelection();

	$(".gallery_container").sortable({
		handle : '.gallery_move',
		cursor: 'move',
		containment: '.gallery_container',
		stop: sortRowsGallery,
		helper: fixWidthHelper
	}).disableSelection();

	//$galleryDelete.on('click', function() {
	//	$(this).closest('.gallery_image').remove()
	//});

	$uploadBtn.on('click', function() {	openUpload() });

	$('body').on('click', '.upload_opened', function() { closeUpload(); });

	$('.replace').on('click', function(event) { event.preventDefault(); });

	function sortRows (){
		$('#sortdata').val($('.table tbody').sortable('toArray').join(','));

		 $('#sform').submit();
	}


	function sortRowsGallery (){
		$('#sortdatagallery').val($('.gallery_container').sortable('toArray').join(','));

		$('#sformgallery').submit();
	}

	$.fn.toast = function(action) {
		var $this = $(this),
		$toast = $('.toast'),
		$toastClose = $('.toast_close');

		$toastClose.on('click', function() { $this.toast('close'); });
		if (action === "open") {
			$this.show().addClass('active')
		}
		if (action === "close") {
			$this.fadeOut(2000)
		}
	}

	$helpButton.on('click', function() { openDialog($dialog); });

	$dialogClose.on('click', function() { closeDialog(); });

	$watchThumb.on('click', function() {
		$watchThumbDialog.attr('src', $(this).parent().attr('data-image-url'));
		openInputPreview();
	});

	$('body').on('click', '.input_preview_opened', function() { closeInputPreview(); });

	$('body').on('click','.switch', function() { $(this).toggleClass('active') });

	$scrollWrap2.on('mousewheel', function() {
		setTimeout(function () {
			var outerHeight = $scrollWrap1.height(),
			innerHeight = $customScroll.height(),
			customScrollPos = $customScroll.position().top,
			setBarPercent = (customScrollPos / (- innerHeight)),
			setBar = outerHeight * setBarPercent;
			tm.set($scrollBar, {y: setBar});
		}, 50);
	});

	$scrollBar.each(function(){
		var $this = $(this);
		scrollBarDrag = Draggable.create($this, {
			bounds: $scrollWrap1,
			type:"y",
			lockAxis: true,
			cursor: 'default',
			onDrag:function() {
				var barPos = $this.position().top,
				outerHeight = $scrollWrap1.height(),
				innerHeight = $customScroll.height(),
				setScrollTop = barPos / outerHeight * innerHeight;
				$scrollWrap2.scrollTop(setScrollTop);
			}
		});
	});

	// custom upload input stuff
	// clear input
	$('.delete_thumbnail').on('click', function() {
		var $this = $(this),
		$input = $this.parent().next(),
		$textSpan = $this.parent().siblings('label').find('.file_name');
		$input.replaceWith($input.val('').clone(true));


		var _this = $(this),
			div = _this.closest('div'),
			table = div.attr('data-table'),
			field = div.attr('data-field'),
			id = $('[name="' + table + '[id]"]').attr('value');


		if (~(_this.parent().attr('data-image-url').indexOf('data:image'))) {
			hideUploadIcons($this.parent().attr('data-field'));
			$textSpan.hide();
			if (!$deletedText.hasClass('animated')) {showDeletedFile(field); }
			$deletedText.addClass('animated');
			showSuccessMessage('Файл удален');

		} else {
            console.log('else');
			$.ajax({
				url: '',
				type: 'post',
				dataType: 'json',
				data: {id: id, field: field, 'delete': true},
				success: function (data) {
					hideUploadIcons($this.parent().attr('data-field'));
					$textSpan.hide();
					if (!$deletedText.hasClass('animated')) { showDeletedFile(field); };
					$deletedText.addClass('animated');
					showSuccessMessage('Файл удален');
				}
			});
		}




	});

	$('body').on('mouseenter', 'aside.active li', function() {
		var $obj = $(this).find('ul').first();
		console.log($obj);
		tm.to($obj, 0.2, { display: 'block', autoAlpha: 1 });
		$(this).on('mouseleave', function() {
			tm.to($obj, 0.2, { display: 'none', autoAlpha: 0 });
		});
	});

	$('.upload').each(function() {
		var $input = $(this),
		$label = $input.next('label'),
		labelVal = $label.html();

		$input.on('change', function(e) {
			var fileName = '';

			var field = $(this).attr('data-field');

			readURL(this, field);
			showUploadIcons(field);
			if(this.files && this.files.length > 1)
				fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}', this.files.length);
			else if(e.target.value)
				fileName = e.target.value.split('\\').pop();
			if(fileName)
				$label.find('.file_name').show().html(fileName);
			else
				$label.html(labelVal);
		});
		// firefox bug fix
		$input.on('focus', function(){ $input.addClass('has-focus'); }).on('blur', function(){ $input.removeClass('has-focus'); });
	});

	$('body').on('click', '.show_modal_delete', function() {
		$('.ml_del_field').attr('data-id',$(this).parents('tr').attr('id'));
		openDialog($delete);
		return false;
	});
	$('body').on('click','.modal_close', function() { closeDialog(); return false;});

	// set image preview path
	function readURL(input, field) {

		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('div[data-field="' + field + '"]').attr('data-image-url', e.target.result);
			};
			reader.readAsDataURL(input.files[0]);
		}
	}

	$uploadFile.each(function(){
		var $this = $(this),
		$label = $this.find('label');
		if ($label.length > 1) { showUploadIcons() }
	});

	function showUploadIcons(field) { $('[data-field="' + field + '"] .delete_thumbnail, [data-field="' + field + '"] .watch_thumbnail, [data-field="' + field + '"] .pdf').addClass('active'); }

	function hideUploadIcons(field) { $('[data-field="' + field + '"] .delete_thumbnail, [data-field="' + field + '"] .watch_thumbnail, [data-field="' + field + '"] .pdf').removeClass('active'); }

	function showDeletedFile(field) {

		$deletedText = $('[data-field="' + field +  '"] .file_deleted')

		tl.to($deletedText, 1, {opacity: 1, 'display': 'block'})
		.to($deletedText, 1, {opacity: 0, 'display': 'none', delay: .5, onComplete: removeActive});
		function removeActive() {	$deletedText.removeClass('animated') }
	}

	// set up custom scrollbar
	function setScrollBar() {
		var outerHeight = $scrollWrap1.height(),
		innerHeight = $customScroll.height(),
		setBarheight = outerHeight / innerHeight * 100;

		$scrollBar.css('height', setBarheight+'%')
		if (innerHeight < outerHeight) { $scrollBar.fadeOut(); } else { $scrollBar.fadeIn(); };
	}

	// fix sort on drag(jquery ui)
	function fixWidthHelper(e, ui) {
		ui.children().each(function() { $(this).width($(this).width()); });
		return ui;
	}

	// Search form at the header
	function showSearch() {
		tm.fromTo($searchForm, .3, {'display': 'none', y: -220}, {'display': 'block', y: 0, ease: Power3.easeInOut})
	}
	function hideSearch() {
		tm.to($searchForm, .3, {'display': 'none', y: -220, ease: Power3.easeInOut})
	}

	//open-close dialog window
	function openDialog($dialog) {
		var wPos = $window.scrollTop();
		$dialog.show().addClass('active_dialog');
		$dialogBg.show();
		// remove scroll
		$body.addClass('dialog_opened');
		$body.css('top', - wPos+'px');
		$body.attr('data-scroll', wPos);
	}
	function closeDialog() {
		var wPos = $body.attr('data-scroll');
		$('.dialog').hide().removeClass('active_dialog');
		$dialogBg.hide();
		// return scroll
		$body.removeClass('dialog_opened');
		$window.scrollTop(wPos);
	}

	// open-close input file image preview
	function openInputPreview() {
		var wPos = $window.scrollTop();
		$watchThumbDialog.show().addClass('active');
		$dialogBg.show().addClass('input_preview_opened');
		// remove scroll
		$body.addClass('dialog_opened');
		$body.css('top', - wPos+'px');
		$body.attr('data-scroll', wPos);
	}
	function closeInputPreview() {
		var wPos = $window.scrollTop();
		$watchThumbDialog.hide().removeClass('active');
		$dialogBg.hide().removeClass('input_preview_opened');
		// remove scroll
		$body.removeClass('dialog_opened');
		$window.scrollTop(wPos);
		console.log('CLOSE');
	}

	// open-close big upload window(drag and drop)
	function openUpload() {
		var wPos = $window.scrollTop();
		$uploadContainer.show().addClass('active');
		$dialogBg.show().addClass('upload_opened');
		$dropZone.show();
		// remove scroll
		$body.addClass('dialog_opened');
		$body.css('top', - wPos+'px');
		$body.attr('data-scroll', wPos);
	}
	function closeUpload() {
		var wPos = $window.scrollTop();
		$uploadContainer.removeClass('active');
		$dialogBg.hide().removeClass('upload_opened');
		$dropZone.hide();
		// remove scroll
		$body.removeClass('dialog_opened');
		$window.scrollTop(wPos);
	}

	//reduce or increase size of left sidebar
	function reduceAside () {
		tm.to($objOpacify, .2, {opacity: 0, 'display': 'none'});
		tm.to($aside, .2, {width: 60, delay: .2 });
		tm.to($asideLogoSvg, .2, {'margin-left': '0'});
		tm.to($main, .2, {'margin-left': '60', delay: .2});
		$submenuTrigger.removeClass('active_nav');
		$('nav ul ul').hide()
	}
	function increaseAside () {
		tm.to($objOpacify, .2, {opacity: 1, 'display': 'block', delay: .2});
		tm.to($aside, .2, {width: asideWidth });
		tm.to($asideLogoSvg, .2, {'margin-left': '12%'});
		tm.to($main, .2, {'margin-left': '250'});
	}

	// validation function
	function validate() {
		$('.validate_form').each(function() {
			var $this = $(this),
			$validate = $this.find('.validate'),
			$validateEmail =  $this.find('.validate_email'),
			$validateTel = $this.find('.validate_tel'),
			$validatePass = $this.find('.validate_pass'),
			$validatePassConfirm = $this.find('.validate_pass_confirm'),
			$validateCaptcha = $this.find('.validate_captcha'),
			$validateCaptchaImg = $this.find('.validate_captcha_img'),

			checkEmail = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/,
			checkTel =  /[0-9 -()+]+$/,
			randCaptcha = Math.floor(Math.random() * 9);

			if(randCaptcha == 0){var captchaNumber = 08532;}
			if(randCaptcha == 1){var captchaNumber = 20864;}
			if(randCaptcha == 2){var captchaNumber = 38204;}
			if(randCaptcha == 3){var captchaNumber = 42032;}
			if(randCaptcha == 4){var captchaNumber = 49146;}
			if(randCaptcha == 5){var captchaNumber = 59749;}
			if(randCaptcha == 6){var captchaNumber = 60880;}
			if(randCaptcha == 7){var captchaNumber = 67185;}
			if(randCaptcha == 8){var captchaNumber = 68880;}

			$validateCaptchaImg.attr('src', '../img/captcha/captcha_'+randCaptcha+'.png');

			$this.on('submit', function() {
				var error = '',
					passValue = $validatePass.val(),
					passConfirmValue = $validatePassConfirm.val();


				$validate.each(function() {
					value = $(this).val();
					if (value.length === 0) {
						error++; $(this).addClass('validate_error');
						$(this).prev('svg').css('color', '#C59392')
					} else {
						$(this).removeClass('validate_error');
						$(this).prev('svg').css('color', '#95B4BC')
					}
				});
				$validateEmail.each(function() {
					value = $(this).val();
					if (checkEmail.test(value) == false) { error++; $(this).addClass('validate_error') } else { $(this).removeClass('validate_error') }
				});
				$validateTel.each(function() {
					value = $(this).val();
					if (value.length < 7 || (!checkTel.test(value))) { error++; $(this).addClass('validate_error') } else { $(this).removeClass('validate_error') }
				});
				$validatePass.each(function() {
					if (passValue =='' || passValue.length <= 6) { error++; $(this).addClass('validate_error') } else { $(this).removeClass('validate_error') }
				});
				$validatePassConfirm.each(function() {
					if (passValue != passConfirmValue || passValue =='') {
						console.log(passValue + '**' + passConfirmValue);
						error++; $(this).addClass('validate_error') } else { $(this).removeClass('validate_error') }
				});
				$validateCaptcha.each(function() {
					value = $(this).val();
					if (value != captchaNumber) { error++; $(this).addClass('validate_error') } else { $(this).removeClass('validate_error') }
				});
				if (error) {
					$('.toast.error').toast('open');
					$('.inst_valid').each(function(){
						$(this).removeClass('valid');
					});

					return false;
				}else{
					$('.inst_valid').each(function(){
						$(this).addClass('valid');
					});
				}
			});
	});
}


////////////////
	$('.checkbox').on('click',function(){
		if (!$(this).is(':checked')) {
			$(this).val(0);
			$(this).attr('checked',false);
		}else{
			$(this).val(1);
			$(this).attr('checked',true);
		}
	});
( function( factory ) {
	if ( typeof define === "function" && define.amd ) {

	} else {
		factory( jQuery.datepicker );
	}
}( function( datepicker ) {

datepicker.regional.ru = {
	closeText: "Закрыть",
	prevText: "Назад",
	nextText: "Вперед",
	currentText: "Сегодня",
	monthNames: [ "Январь", "Февраль", "Март", "Апрель", "Май", "Июнь",
		"Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь" ],
	monthNamesShort: [ "янв.", "фев.", "мар", "апр.", "май", "июн",
		"июл.", "авг", "сен.", "окт.", "ноя.", "дек." ],
	dayNames: [ "Воскресенье", "Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота" ],
	dayNamesShort: [ "вс.", "пон.", "вт.", "ср.", "чт.", "пят.", "суб." ],
	dayNamesMin: [ "Вс","Пн","Вт","Ср","Чт","Пт","Сб" ],
	weekHeader: "Нед.",
	dateFormat: "dd/mm/yy",
	firstDay: 1,
	isRTL: false,
	showMonthAfterYear: false,
	yearSuffix: "" };
datepicker.setDefaults( datepicker.regional.ru );

return datepicker.regional.ru;

} ) );	
//ready end
});

