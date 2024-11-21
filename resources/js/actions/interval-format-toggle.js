$(document).ready( function(){
    const basicRadio = $('#basicRadio');
    const cronRadio = $('#cronRadio');
    const cronFormat = $('.cronFormat')
    const basicFormat = $('.basicFormat')

    if (basicRadio.is(":checked")) {
        basicFormat.removeClass('d-none');
        cronFormat.addClass('d-none')
    }

    if (cronRadio.is(":checked")) {
        cronFormat.removeClass('d-none');
        basicFormat.addClass('d-none')
    }

    cronRadio.on('click', function () {
        cronFormat.removeClass('d-none');
        basicFormat.addClass('d-none')
    })

    basicRadio.on('click', function () {
        basicFormat.removeClass('d-none');
        cronFormat.addClass('d-none')
    })

});
