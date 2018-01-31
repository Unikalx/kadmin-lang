$(document).ready(function () {
    $('.lang_wrrap a').click(function () {
        var $lang = $(this).attr('lang');
        $.ajax({
            url: "/session.php",
            type: "POST",
            data: {
                adminLang: $lang
            },
            success: function () {
                window.location.href = '/kadmin'
            },
            error: function () {
                console.log('error')
            }
        });
    });
});