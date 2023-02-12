import './bootstrap';
import jQuery from 'jquery';
window.$ = jQuery;

$(function () {

    $('.refresh-button').on('click', function () {
        $('.refresh-spinner').removeClass('hidden')
        $(this).addClass('pointer-events-none')
        $(this).text('Обновление')
    })

})
