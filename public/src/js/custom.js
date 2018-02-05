;(function($) {
    var PAGE = $('#conf').data('page');
    BUSY_REQUEST = false;

    $(document).ready(function() {
        // initMultirow();
        sliderInit();
        initExpandingText();
        initBarRating();
        initCustomSelect();
        initSearch();
        initMobileMenu();

        $('.js-tooltip').tooltipster({
            trigger: 'click',
            maxWidth: 279,
            animation: 'grow'
        });

        $('.js-tooltip-content').tooltipster({
            trigger: 'click',
            minWidth: 460,
            animation: 'grow',
            interactive: true,
            contentAsHTML: true,
            functionReady: function(){
                $('body').addClass('shadow');
            },
            functionAfter: function(){
                $('body').removeClass('shadow');
            }
        });
    });

    function initMobileMenu() {
        var btn = $('#js-mobile-menu-opener, #js-mobile-menu-close');
        var menu =  $('.header-menu');

        btn.on('click',  function(e) {
            console.log("nnn"); 
            $('body').toggleClass('menu-opened');
            btn.toggleClass('active');

            $(document).on('click touchstart',function(e) {
                if ($(e.target).closest(menu).length==0 && $(e.target).closest(btn).length==0){
                    $("body").removeClass('menu-opened');
                    btn.removeClass('active');
                }
            });
            e.preventDefault();
        });
    }

    function initSearch() {
        var _btnOpen = $('.js-search-opener');
        var _btnClose = $('.js-search-close');

        _btnOpen.on('click', function(e) {
            $('body').addClass('search-opened');
        });

        _btnClose.on('click', function(e) {
            $('body').removeClass('search-opened');
        });
    }

    function initCustomSelect() {
        //custom select
        $('.js-filter').select2({
            minimumResultsForSearch: -1,
            dropdownCssClass: 'filters-sort-dropdown'
        });

        $('.js-filter').select2MultiCheckboxes({
            templateSelection: function(selected, total) {
              // return "Selected " + selected.length + " of " + total;
              return selected[0];
            }
        })
    }

    function initBarRating() {
        var container = $('.rating-container');
        $('.rating-bar', container).barrating('show', {
            showSelectedRating: false,
            onSelect: function(value, text, event) {
                if (typeof event != 'undefined') {
                    var _this = $(event.currentTarget);
                    var _classes = 'terrible poor good very-good excellent';

                    _this
                        .closest(container)
                        .find('.rating-current-text')
                        .text(text)
                        .removeClass(_classes)
                        .addClass(getWebName(text));
                    _this
                        .closest(container)
                        .find('.rating-current-value')
                        .text(value + '/10' );
                }
            }
        });
        // $('.rating-bar', container).barrating('set', 3);
    }

    function getWebName(name) {
        return name.replace(/\s/g, '-').toLowerCase();
    }

    function initExpandingText() {
       $('.js-condense').condense({
        condensedLength: 410,
        moreText: "Read More",
        lessText: "Read Less",
        ellipsis: "...",
       });
    }

    function initMultirow() {
        var multirowContainer = $('.js-multirow');
        multirowContainer.each(function(index, el) {
            var num = $(this).find('div').length;

            if (num > 1) {
                var showedNum = num - 1;
                $(this).readmore({
                    moreLink: '<a href="#" class="multirow-trigger multirow-open">+'+ showedNum +'</a>',
                    lessLink: '<a href="#" class="multirow-trigger multirow-close">Show Less</a>',
                    collapsedHeight: 21,
                    speed: 1,
                    blockProcessed: function(el) {
                        chaneBtnPosition(el);
                    },
                    beforeToggle: function(trigger, el, expanded) {
                        $(el).parent().toggleClass('active');

                        if (expanded) {
                            chaneBtnPosition(el);
                        } else {
                            // $(el).append(trigger);
                            $(trigger).insertAfter(el);
                        }
                    }
                });
            }

            function chaneBtnPosition(el) {
                var $opener = $(el).parent().find('.multirow-trigger');
                var etalon = $(el).find('div').first();
                etalon.append($opener);
            }
        });
    }

    function sliderInit() {
        var swiper = new Swiper('#main-carousel', {
            slidesPerView: 6,
            // centeredSlides: true,
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
                // 768: {
                //     slidesPerView: 3,
                // },
                // 640: {
                //     slidesPerView: 2,
                // },
                // 320: {
                //     slidesPerView: 1,
                // }
            }
        });

        var swiper = new Swiper('#casinos-nav', {
            slidesPerView: 'auto',
            spaceBetween: 30,
            freeMode: true
        });
    }

})(jQuery);