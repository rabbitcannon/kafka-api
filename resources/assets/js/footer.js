$(window).on('load', function() {
    $('#status').fadeOut();
    $('#preloader').delay(350).fadeOut('slow');
    $('div#app').css('display', 'block');
    $('body').delay(350).css({'overflow':'visible'});
});