$(document).ready(function () {
    $('.lang_wrrap a').click(function () {
        var $lang = $(this).attr('lang');
        var href = window.location.pathname;
        var path = href.split("/");
        var lang = path[1]; // язык из адресной строки

        $.ajax({
            url: "/session.php",
            type: "POST",
            data: {
                lang: $lang
            },
            success: function (data) {
                var check = data; // data = 1 || 2  проверка на какую кнопку было нажато
                if (check == 1) {
                    edit_lang('ua');
                } else if (check == 2) {
                    edit_lang('de');
                }
                function edit_lang(language) {
                    if (lang != language) {
                        if (href == '/ua' || href == '/de') {
                            window.location.href = '/'+language
                        } else {
                            path.splice(0, 2);
                            window.location.href = '/'+language+'/' + path.join('/');
                        }
                    }
                }
            },
            error: function () {
                console.log('error')
            }
        });
    });
});