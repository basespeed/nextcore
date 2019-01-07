(function ($) {
    'use strict';

    $(document).ready(function () {
        $('.woocommerce-pagination ul li .next').html('<i class="fa fa-angle-right" aria-hidden="true"></i>');
        $('.woocommerce-pagination ul li .prev').html('<i class="fa fa-angle-left" aria-hidden="true"></i>');

        var txt_filter_slide_price = $('.sidebar_main .widget-content .price_slider_wrapper .price_slider_amount .price_label').text();

        txt_filter_slide_price.replace('—','saddsa');

        $('.sidebar_main .widget-content ul.product-categories li.cat-parent').append('<i class="fa fa-angle-right" aria-hidden="true"></i>');

        $('.sidebar_main .widget-content ul.product-categories li').on('click', function (event) {
            var target = $( event.target );
            if(target.is('i')){
                $(this).find('.children').slideToggle();
                $(this).find('i').toggleClass('active');
            }
        });

        $( "#slider" ).slider();

        if($('.woocommerce-product-gallery__wrapper.carousel-container').hasClass('colums')){
            var $carousel = $('.carousel').flickity({
                cellAlign: 'left',
                contain: true,
                freeScroll: true,
                wrapAround: true,
                pageDots: true,
                verticalCells: true
            });

            var $carouselNav = $('.carousel-nav');
            var $carouselNavCells = $carouselNav.find('.carousel-cell');

            $carouselNav.on( 'click', '.carousel-cell', function( event ) {
                var index = $( event.currentTarget ).index();
                $carousel.flickity( 'select', index );
            });

            var flkty = $carousel.data('flickity');
            var navTop  = $carouselNav.position().top;
            var navCellHeight = $carouselNavCells.height();
            var navHeight = $carouselNav.height();

            $carousel.on( 'select.flickity', function() {
                // set selected nav cell
                $carouselNav.find('.is-nav-selected').removeClass('is-nav-selected');
                var $selected = $carouselNavCells.eq( flkty.selectedIndex )
                    .addClass('is-nav-selected');
                // scroll nav
                var scrollY = $selected.position().top +
                    $carouselNav.scrollTop() - ( navHeight + navCellHeight ) / 2;
                $carouselNav.animate({
                    scrollTop: scrollY
                });
            });

            $('#slide_main_single_product_mobile').flickity();

            $('#slide_single_product_mobile .row_col').flickity({
                // options
                cellAlign: 'left',
                contain: true,
                freeScroll: true,
                wrapAround: true,
                asNavFor: '#slide_main_single_product_mobile',
                pageDots: false,
                verticalCells: true
            });
        }else{
            $('#slide_main_single_product').flickity();

            $('#slide_single_product .row_col').flickity({
                // options
                cellAlign: 'left',
                contain: true,
                freeScroll: true,
                wrapAround: true,
                asNavFor: '#slide_main_single_product',
                pageDots: false,
                verticalCells: true
            });

        }

    });

}(jQuery));


