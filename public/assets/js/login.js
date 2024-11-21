(function ($) {
    "use strict";
    /*----------------------------------------
     passward show hide
     ----------------------------------------*/
    const PASSWORDSHOW = $('.show-hide span');
    const SHOWCLASS = $('.show-hide');
    SHOWCLASS.show();
    PASSWORDSHOW.addClass('show');

    PASSWORDSHOW.click(function () {
        if ($(this).hasClass('show')) {
            $('input[name="password"]').attr('type', 'text');
            $('input[name="password_confirmation"]').attr('type', 'text');
            $(this).removeClass('show');
        } else {
            $('input[name="password"]').attr('type', 'password');
            $('input[name="password_confirmation"]').attr('type', 'password');
            $(this).addClass('show');
        }
    });
    $('form button[type="submit"]').on('click', function () {
        PASSWORDSHOW.addClass('show');
        SHOWCLASS.parent().find('input[name="password"]').attr('type', 'password');
        SHOWCLASS.parent().find('input[name="password_confirmation"]').attr('type', 'password');
    });

})(jQuery);
