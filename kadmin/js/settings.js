$(document).ready(function () {

    var table = $('.ml_table_name').data('table');//назва таблиці, в яку вставляють поле
    var tm = TweenMax,
        $body = $('body'),
        $delete = $('.delete_dialog'),
        $window = $(window),
        $change_pass = $('.pass_dialog');
    $dialogBg = $('.dialog_bg');


//ввімкнення вимкнення ПОЛЯ
    $('body').on('click', '.ml_on_off', function () {

        var elem = $(this).parents('tr');
        var active = $(this).hasClass('active') ? 1 : 0;
        // var field_name = elem.find('.ml_name').text();
        var field_name = elem.find('.ml_name').attr('typeCol');
        // var table = $('[data-table]').attr('data-table');
        var table = elem.attr('tableCol');
        var id = $('[data-table-id]').attr('data-table-id');
        $.ajax({
            url: '',
            data: {on_off: active, table: table, name: field_name, id: id},
            type: 'POST',
            success: function (data) {
                console.log(data);
                data == 0 ? elem.addClass("disabled_tr") : elem.removeClass("disabled_tr");
                //відображення повідомлення про успішне збереження
                var text = 'Successfully Saved!';
                showSuccessMessage(text);
            },
            error: function () {
                //відображення повідомлення про помилку
                var text = 'Error!';
                showErrorMessage(text)
            }
        });
    });


//зміна title ПОЛЯ
    $("body").on('change', 'input.ml_title', function () {

        var elem = $(this).parents('tr');
        // var field_name = elem.find('.ml_name').text();
        var field_name = elem.find('.ml_name').attr('typeCol');
        // var table = $('[data-table]').attr('data-table');
        var table = elem.attr('tableCol');
        var id = $('[data-table-id]').attr('data-table-id');
        var title = $(this).val();

        $.ajax({
            url: '',
            type: 'POST',
            data: {'name': field_name, 'table': table, 'changeTitle': title, 'id': id},
            success: function (data) {
                //відображення повідомлення про успішне збереження
                var text = 'Successfully Saved!';
                showSuccessMessage(text);
            },
            error: function () {
                //відображення повідомлення про помилку
                var text = 'Error!';
                showErrorMessage()
            }
        });
    });


//зміна style ПОЛІВ
    $("body").on('change', '.ml_style', function () {

        var elem = $(this).parents('tr');
        // var field_name = elem.find('.ml_name').text();
        var field_name = elem.find('.ml_name').attr('typeCol');
        // var table = $('[data-table]').attr('data-table');
        var table = elem.attr('tableCol');
        var id = $('[data-table-id]').attr('data-table-id');
        var style = $(this).val();

        $.ajax({
            url: '',
            type: 'POST',
            data: {'name': field_name, 'table': table, 'changeStyle': style, 'id': id},
            success: function (data) {
                //відображення повідомлення про успішне збереження
                var text = 'Successfully Saved!';
                showSuccessMessage(text);
            },
            error: function () {
                //відображення повідомлення про помилку
                var text = 'Error!';
                showErrorMessage()
            }
        });
    });


//збереження нової назви ТАБЛИЦІ
    $(".ml_save_table_name").on('submit', function (event) {
        event.preventDefault();
        $('.validate_error').removeClass('.validate_error');
        var vall = $(".ml_new_table_name").val();
        var sect = $(".ml_new_table_name").parents('section');

        if (vall != '') {
            sect.addClass('loading');
            $.ajax({
                url: '',
                type: 'POST',
                data: {'newTableName': vall, 'table': table},
                success: function () {
                    sect.removeClass('loading');
                    //відображення повідомлення про успішне збереження
                    var text = 'Successfully Saved!';
                    showSuccessMessage(text);
                    $('.ml_table_name').text(vall);
                },
                error: function () {
                    sect.removeClass('loading');
                    //відображення повідомлення про помилку і збереженні
                    var text = 'Error!';
                    showErrorMessage(text);
                }
            });
        } else {
            $(".ml_new_table_name").addClass('validate_error');
            //відображення повідомлення про успішне збереження
            var text = 'Incorrect values!';
            showErrorMessage(text);
        }

    });

//ввімкнення вимкнення ТАБЛИЦІ
    $('#on_off_table').on('click', function () {
        var table = $('[data-table]').attr('data-table');
        var checked = $(this).prop("checked") ? 1 : 0;

        $.ajax({
            url: '',
            type: 'POST',
            data: {'on_off_table': checked, 'table': table},
            success: function () {
                (checked == 0) ? $("table.table").addClass('disabled') : $("table.table").removeClass('disabled');
                var text = 'Incorrect values!';
                showSuccessMessage(text);

            },
            error: function () {
                //відображення повідомлення про помилку і збереженні
                var text = 'Error!';
                showErrorMessage(text);
            }
        });
    });

//ready end
});

function showSuccessMessage(text) {
    $('.toast.success').toast('open');
    $('.tcell').find('p').html(text);

    setTimeout(function () {
        $('.toast.success').toast('close');
    }, 1000);
}

function showErrorMessage(text) {
    $('.toast.error').toast('open');
    $('.tcell').find('p').html(text);

    setTimeout(function () {
        $('.toast.error').toast('close');
    }, 1000);
}

function show_meta() {
    var tm = TweenMax;
    tm.fromTo($('.meta_tags'), 1.2, {'display': 'none', x: -500, autoAlpha: 0},
        {'display': 'block', x: 0, autoAlpha: 1, ease: Power3.easeInOut});
    tm.to(window, 2, {scrollTo: {y: 1500}, ease: Power2.easeOut, delay: .2});
    $(".show_meta").fadeOut();
}
