$(document).ready(function () {

    $('.slider').bxSlider({
        mode: 'fade',
        auto: true,
        speed: 2000,
        pause: 10000,
        pager: true,
        controls: true,
        /* Class selectors from step 1 */
        nextSelector: '.custom-controls .bxNext',
        prevSelector: '.custom-controls .bxPrev',
        nextText: '',
        prevText: '',
        adaptiveHeight: true
    });

});