;(function () {
    var body = $('body');
    body.off('click', '.gallery_delete').on('click', '.gallery_delete', function (e) {
        e.preventDefault();
        var _this = $(this),
            image = _this.closest('.gallery_image'),
            imageId = image.attr('data-image-id');

        $.ajax({
            url: '',
            type: 'post',
            data: {deletePhotoGallery: true, imageId: imageId},
            dataType: 'json',

            success: function (res) {
                if (res.status == 'success') {
                    image.remove();
                    showSuccessMessage('Успешно удалено');
                    if ($('.gallery_image').length == 0)
                        $('.gallery_container').append("<span>Эта галерея пустая</span>");
                } else {
                    if (res.status == 'error') {
                        showErrorMessage(res.message);
                    }
                }
            }
        });
    });

// Зміна позицій полів
    $('form[data-gallery-sort-pos]').on('submit', function (e) {
        e.preventDefault();

        var imagesHId = $('input#sortdatagallery').val().split(',');
        var imagesId = [];
        //var galleryId = $('input[name="gallery[id]"]').val();
        var first_position = 1;

        imagesHId.forEach(function (item) {
            imagesId.push(item.slice(6));
        });

        $.ajax({
            url: '',
            type: 'post',
            data: {changePositionImage: true, fields_id: imagesId, first_position: first_position},
            dataType: "json"
        });
    });

    function isValidUrl(url) {
        var objRE = /[a-z0-9_\-]+$/i;
        return objRE.test(url);
    }

//валідація при збереженні форми
    $('[data-edit-create]').on('submit', function (eventObject) {

        var url = $.trim($('#url').val());
        var nameUA = $.trim($('[nameInput="ua"]').val());
        var nameRU = $.trim($('[nameInput="ru"]').val());
        var nameEN = $.trim($('[nameInput="en"]').val());

        var hasNameUa = false;
        var hasNameRu = false;
        var hasNameEn = false;
        var hasUrl = false;
        var error = false;
        var input = $('input');

        var newPassword = $('#newPassword').val();
        var repeatPassword = $('#repeatPassword').val();

        if (newPassword != repeatPassword) {
            error = 'Password wasn\'t valid';
            eventObject.preventDefault();
            $('#repeatPassword').addClass('validate_error');
            $('#newPassword').addClass('validate_error');
        }

        if (input.is('[nameInput="ua"]')) {
            hasNameUa = true;
        }
        if (input.is('[nameInput="ru"]')) {
            hasNameRu = true;
        }
        if (input.is('[nameInput="en"]')) {
            hasNameEn = true;
        }

        if (input.is('#url')) {
            hasUrl = true;
        }


        if ($('[name="galleries[id_category]"]').val() == "0" && $('select').is('[name="galleries[id_category]"]')) {
            error = 'Не выбрана категория';
            eventObject.preventDefault();
            $('[name="galleries[id_category]"]').addClass('validate_error')
        }

        if (!(+$('[name="subsections[id_section]"]').val()) && $('select').is('[name="subsections[id_section]"]')) {
            error = 'Не выбрана секция';
            eventObject.preventDefault();
            $('[name="subsections[id_section]"]').addClass('validate_error')
        }

        if (!(+$('[name="articles[id_article_cat]"]').val()) && $('select').is('[name="articles[id_article_cat]"]')) {
            error = 'Не выбрана секция';
            eventObject.preventDefault();
            $('[name="articles[id_article_cat]"]').addClass('validate_error')
        }

        if (!(+$('[name="users[password]"]').val() != '') && $('input').is('[name="users[password]"]')) {
            error = 'Пароль не верный';
            eventObject.preventDefault();
            $('[name="users[password]"]').addClass('validate_error')
        }

        if ($('[name="a_cat[]"]').length <= 0 && ($('[data-table-name=products]').length > 0 || $('[data-table-name=articles]').length > 0) && $('select[name="cats_in"]').length > 0) {
            error = 'Не выбрана категория';
            eventObject.preventDefault();
            $('[name="cats_in"]').addClass('validate_error')
        }

        if (!isValidUrl(url) && url != '') {
            eventObject.preventDefault();
            $('#url').addClass('validate_error');
            error = 'URL не подходит!';
        } else {
            var newUrl = url.replace(/ /g, '-');
            newUrl = newUrl.replace(/"/g, '');
            newUrl = newUrl.replace(/_/g, '-');
            newUrl = newUrl.replace(/'/g, '');
            newUrl = newUrl.replace(/,/g, '');
            newUrl = newUrl.replace(/&/g, 'and');
            $('#url').val(newUrl.toLowerCase());
        }

        if (hasUrl && url == '') {
            eventObject.preventDefault();
            $('#url').addClass('validate_error');
            error = 'Вы не ввели "url"';
        }

        if (hasNameUa && nameUA == '') {
            eventObject.preventDefault();
            $('[nameInput="ua"]').addClass('validate_error');
            error = 'Вы не ввели "Название UA"';
        } else {
            $('[nameInput="ua"]').removeClass('validate_error')
        }

        if (hasNameRu && nameRU == '') {
            eventObject.preventDefault();
            $('[nameInput="ru"]').addClass('validate_error');
            error = 'Вы не ввели "Название RU"';
        } else {
            $('[nameInput="ru"]').removeClass('validate_error')
        }

        if (hasNameEn && nameEN == '') {
            eventObject.preventDefault();
            $('[nameInput="en"]').addClass('validate_error');
            error = 'Вы не ввели "Название EN"';
        } else {
            $('[nameInput="en"]').removeClass('validate_error')
        }
        if (error) {
            showErrorMessage(error);
        }

    });

//add cat
    $('[data-delete-cat]').on('click', function (e) {
        e.preventDefault();
        var val = $(this).closest('[data-val]').attr('data-val');
        $('[data-cat-in] [data-val="' + val + '"]').remove();
    });

    $('[data-add-cat]').on('click', function (e) {
        e.preventDefault();

        var id = $('[name="cats_in"]').val();
        var name = $('[name="cats_in"] option[value="' + id + '"]').text();

        if (id != 0 && !$('[data-cat-in] [data-val=' + id + ']').length) {
            $('[name="cats_in"] option:first').attr('selected', true);

            var input = '<input type="hidden" name="a_cat[]" value="' + id + '" data-val="' + id + '">';
            $('[data-cat-in]').append(input);

            var span = $('<span data-val="' + id + '">' + name + ' <a data-delete-cat href="#"><svg class="icon"><use xlink:href="/kadmin/view/img/svgdefs.svg#icon_close"></use></svg></a></span>');
            $('[data-cat-in]').append(span);
            TweenMax.from(span, 0.3, {scale: 0, autoAlpha: 0, ease: Back.easeOut})
        }

    });


    $('[data-add-tag]').on('click', function (e) {
        e.preventDefault();

        var arrTags = [];
        $('[data-val]').each(function (item, value) {
            arrTags.push($(value).attr('data-val'));
        });

        if ($('[name="in_tag"]').val().trim() && !~arrTags.indexOf($('[name="in_tag"]').val().trim())) {
            $('[data-tags-in]').append('<input type="hidden" name="a_tag[]" value="' + $('[name="in_tag"]').val() + '" data-val="' + $('[name="in_tag"]').val() + '">');

            var span = $('<span>' + $('[name="in_tag"]').val() + ' <a data-delete-tag href="#"><img class="icon" style="width:8.7px;height:8.7px;" src="View/img/letter-x.png"></a></span>');

            $('[data-tags-name]').append(span);
            TweenMax.from(span, 0.3, {scale: 0, autoAlpha: 0, ease: Back.easeOut})

            $('[name="in_tag"]').val('');
        }

    });


    $('body').off('click', '[data-delete-tag]').on('click', '[data-delete-tag]', function (e) {
        e.preventDefault();

        var _this = $(this);
        var span = _this.parent();

        span.find('a').remove();
        $('[data-val="' + span.html().trim() + '"]').remove();

        span.remove();
    });

//autocomplete
    $('#tagautocomplete').autocomplete({
        minLength: 1,
        appendTo: ".autocomplete",
        source: function (request, response) {

            $.ajax({
                url: "",
                type: 'post',
                dataType: "json",
                data: {
                    tagautocomplete: request.term,
                },
                success: function (data) {
                    response(data);
                    console.log(data);
                }
            });
        }
    });

/////////////////////////

// META VALUES
    $(".ml_meta").keyup(function () {

        var input = $("[data-input-name='" + $(this).attr('name') + "']");
        //URL
        if ($(this).attr('id') == 'url') {
            var string = input.text();
            //початкове значення юрл
            var start_val = $('[data-url-start]').attr('data-url-start');
            if (start_val !== '') {
                input.html(string.replace(start_val, $(this).val()));
            } else {
                //позиція входження юрл в строку
                var entrance = $('[data-first-entrance]').attr('data-first-entrance');
                input.html(string.substring(0, entrance) + $(this).val() + string.substring(entrance));
            }
            $('[data-url-start]').attr('data-url-start', $(this).val());//url
        } else {
            //titile, description
            input.html($(this).val());
        }
    });

//Media Video/Journal
    $("[name='media[type]']").on('click', function () {
        if ($(this).val() == 1) {
            $('.ml_video').show(800);
        } else {
            $('.ml_video').hide(500);
        }
    });

// відображення поля для зміни пароля в редагування Users
    $('.hide_pass').on('click', function () {
        $(this).hide(500);
        $('.pass_block').show(500);
    });

// зміна назви картинки в галереї (products/galleries)
    $('.gallery_image textarea.input').on('change', function () {
        var val = $(this).val();
        if (val == '') val = ' ';
        var id = $(this).parents('.gallery_image').attr('data-image-id');

        $.ajax({
            url: "",
            type: 'post',
            data: {
                new_name: val,
                id: id
            },
            success: function (data) {
                showSuccessMessage("Описани фото изменено")
            }
        });
    });
})();

$(document).ready(function () {
    $('[button]').click(function () {
        var lang = $(this).attr('button');
        $('[button]').removeClass('active_button');
        $('[langSections]').hide();
        $(this).addClass('active_button');
        $('[langSections="' + lang + '"]').show();
    })
});