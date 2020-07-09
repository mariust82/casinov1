function sliderInit() {
    var swiperMain = new Swiper('#main-carousel', {
        slidesPerView: 6,
        spaceBetween: 5,
        navigation: {
            nextEl: '.carousel-next',
            prevEl: '.carousel-prev',
        },
        breakpoints: {
            1024: {
                freeMode: true,
                slidesPerView: 'auto'
            },
        }
    });

    var linksSwiperParams = {
        slidesPerView: 'auto',
        freeMode: true,
        allowTouchMove: false,
        on: {
            slideChangeTransitionStart: function (argument) {
                $('.links-left, .links-right').fadeIn('fast');
            },
            slideChangeTransitionEnd: function (argument) {
                if (this.translate == 0) {
                    $('.links-left').fadeOut('fast');
                }

                if (this.isEnd) {
                    $('.links-right').fadeOut('fast');
                }
            },
        },
        breakpoints: {
            1024: {
                allowTouchMove: true,
            },
            690: {
                allowTouchMove: true,
            }
        }
    }

    if ($('#links-nav').length) {
        var swiperLinks = new Swiper('.links-casinos #links-nav', linksSwiperParams);

        var swiperLinks2 = new Swiper('.links-games #links-nav', linksSwiperParams);

        var swiperLinksIndx = $("#links-nav .active").parent().index() - 1;

        if ($('.links-casinos #links-nav').length)
            swiperLinks.slideTo(swiperLinksIndx, 300);
        if ($('.links-games #links-nav').length)
            swiperLinks2.slideTo(swiperLinksIndx, 300);

    }

    if ($(window).width() > 1024) {
        $('.links-casinos .links-nav a').on('mouseenter', function (e) {
            swiperAction($(this), e, swiperLinks);
        });

        $('.links-games .links-nav a').on('mouseenter', function (e) {
            swiperAction($(this), e, swiperLinks2);
        });

        function swiperAction(_this, _e, _id) {
            var container = _this.closest('.swiper-container');
            var curPosition = _e;

            if (curPosition.clientX > container.offset().left + (container.width() / 1.3)) {
                _id.slideNext(500);
            } else if (curPosition.clientX < container.offset().left + (container.width() / 6)) {
                _id.slidePrev(500);
            }
        }
    }
}
