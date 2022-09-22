$(document).ready(function() {
    /* page loader */
    var loading = $("#loading");
    $(window).on('load', function() {
        if (loading) {
            loading.hide();
        }
    });

    var servicesSlider = $('#services-slider');
    servicesSlider.owlCarousel({
        margin: 20,
        dots: false,
        loop: true,
        auto: true,
        speed: 1000,
        slideTransition: 'linear',
        autoplay: true,
        autoplaySpeed: 4500,
        lazyLoad: true,
        autoplayTimeout: 6000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1,
                dots: true
            },
            600: {
                items: 2
            },
            1000: {
                items: 3
            }
        }
    }, $(".services-slider-control").removeClass("d-none"));
    // Go to the next item
    $('.services-slider-control .next-control').click(function() {
        servicesSlider.trigger('next.owl.carousel');
    })
    // Go to the previous item
    $('.services-slider-control .prev-control').click(function() {
        // With optional speed parameter
        // Parameters has to be in square bracket '[]'
        servicesSlider.trigger('prev.owl.carousel', [300]);
    });

    var whyChooseUsSlider = $("#why-choose-us-slider");
    whyChooseUsSlider.owlCarousel({
            animateOut: 'animate__fadeIn',
            animateIn: 'animate__fadeOut',
            loop: true,
            dots: false,
            speed: 1000,
            slideTransition: 'linear',
            // autoplay: true,
            autoplaySpeed: 4500,
            lazyLoad: true,
            autoplayTimeout: 6000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1
                }
            }
        },
        // setTimeout(() => {
        $(".feature-images-slider-control").removeClass("d-none")
        // }, 2000);
    );
    // Go to the next item
    $('.feature-images-slider-control .next-control').click(function() {
        whyChooseUsSlider.trigger('next.owl.carousel');
    })
    // Go to the previous item
    $('.feature-images-slider-control .prev-control').click(function() {
        // With optional speed parameter
        // Parameters has to be in square bracket '[]'
        whyChooseUsSlider.trigger('prev.owl.carousel', [300]);
    });



    /* Jquery.lazy*/
    // $(function() {
    //     $('.lazy').lazy({
    //         visibleOnly: true,
    //         effect: "fadeIn",
    //         effectTime: 2000,
    //         threshold: 0,
    //         onError: function(element) {
    //             console.log('error loading ' + element.data('src'));
    //         }
    //     });
    // });



    /* products sort dropdown radio */
    function radioSelect(arg1, arg2) {
        if (arg1.is(':checked')) {
            arg1.siblings().addClass("active");
            arg2.html(arg1.siblings("label").html());
        } else {
            arg2.html("Recommended");
        }
        arg1.on("click", function() {
            arg2.html($(this).siblings("label").html());
        });
    }
    var selected = $("#selected");
    var selected_sort = $("input[type='radio'][name='sort']");
    var selected_sort_checked = $("input[type='radio'][name='sort']:checked");
    radioSelect(selected_sort, selected)
    selected.html(selected_sort_checked.siblings("label").html());


    /*  */
    $(".item-dropdown-content").mouseover(function() {
        if (!$(this).siblings(".nav-link").hasClass("active")) {
            $(this).siblings(".nav-link").css({ "color": "#209E02" })
        }
    })
    $(".item-dropdown-content").mouseleave(function() {
        if (!$(this).siblings(".nav-link").hasClass("active")) {
            $(this).siblings(".nav-link").css({ "color": "#414143" });
        }
    });


    /* Overlay effect toggler*/
    var overlay = $("#overlay");

    /* Toggling user sidenav */
    var sidebarToggler = $("#sidebar-toggler");
    var sidenavWrapper = $(".sidenav-wrapper");
    sidebarToggler.click(function() {
        overlay.addClass("show");
        sidenavWrapper.addClass("show");
    })
    /* Remove overlay */
    if (overlay) {
        overlay.click(function() {
            overlay.removeClass("show");
            sidenavWrapper.removeClass("show");
        })
    }


    (function() {

        /* product details image preview */
        $('.thumb').each(function() {
            let y = $(".thumb").children().attr('src');
            $('#screen').children('img').attr('src', y);
            return false;
        });


        /* image preview in product-details-v2.php page on page load*/
        var activeImgUrl = "";
        $(".preview-img").each(function() {
            $(this).siblings().css({ 'background-image': 'url(' + $(this).val() + ')', 'background-size': 'contain', 'background-repeat': 'no-repeat', 'background-position': 'center' })
            if ($(this).is(':checked')) {
                activeImgUrl = $(this).val();
                $('#img-preview-screen').css({
                    'background-image': 'url(' + activeImgUrl + ')',
                    'background-size': 'contain',
                    'background-repeat': 'no-repeat',
                    'background-position': 'top',
                    'transition': 'all 1s'
                })
            }
        });
    })();

    /* image preview in product-details-v2.php page on image click */
    var selectedImgUrl = "";
    $(".product_click").each(function() {
        $(this).on('click', ".preview-img",(function() {
            if ($(this).is(':checked')) {
                selectedImgUrl = $(this).val();
                $('#img-preview-screen').css({
                    'background-image': 'url(' + selectedImgUrl + ')',
                    'background-size': 'contain',
                    'background-repeat': 'no-repeat',
                    'background-position': 'center',
                    'transition': 'all 1s'
                })
            }
        }))
    });




    /* product quick view */
    var quickViewBtn = $("#sidebar-toggler");
    var itemPreview = $(".sidenav-wrapper");
    sidebarToggler.click(function() {
        overlay.addClass("show");
        sidenavWrapper.addClass("show");
    })
    /* Remove overlay */
    if (overlay) {
        overlay.click(function() {
            overlay.removeClass("show");
            sidenavWrapper.removeClass("show");
        })
    }


});