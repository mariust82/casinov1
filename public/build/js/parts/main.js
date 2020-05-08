var AJAX_CUR_PAGE = 1;
var GAME_CURR_PAGE = 1;
var NEW_CURR_PAGE = 1;
var BEST_CURR_PAGE = 1;
var COUNTRY_CURR_PAGE = 1;
var ALL_CASINOS_KEY = 1;
var BEST_BANKING_PAGE = 1;
var searched_value = '';
var isSearchResultEvent = false;

function sliderInit() {
    if(!($('#main-carousel').length || $('#links-nav').length))   return;

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
        spaceBetween: 30,
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
                spaceBetween: 15,
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


function loadScripts(_scripts) {
    var version = $('.controller_main').data("version");

    $.each(_scripts, function(index, script) {
        if (!$("script[src='/public/build/js/compilations/assets/"+script+".js']").length) {
            $("body").append($('<script type="text/javascript" src="/public/build/js/compilations/assets/'+script+'.js"></script>"'));
        }
    });
}

function initCustomSelect() {
    if(!$('.js-filter').length)  return;
    var _filterOptions = $('.js-filter > option');
    $('.js-filter').select2MultiCheckboxes({
        templateSelection: function () {
            return "Game software";
        }
    })
    _filterOptions.prop("selected", false);
}

function tmsIframe() {
    if ($(".tms_iframe").length) {
        $(".tms_iframe").each(function () {
            var iframe = document.createElement("iframe");
            $.each(this.attributes, function () {
                if (this.name == "class")
                    return;
                iframe.setAttribute(this.name.replace("data-", ""), this.value);
            });
            $(this).append(iframe);
        });
    }
}

// Load game images after page load
var initImageLazyLoad = function() {
    imageDefer("lazy_loaded");
};

/*

var configImgLazyLoad = new imageDeferCONFIG();
var initImageLazyLoad = function () {
    configImgLazyLoad.setImagesSelector('.data-logo_image');
    configImgLazyLoad.setDeferLoadAmount(8);
    if (navigator.userAgent.match(/(iPhone|iPod|Android|webOS|BlackBerry|IEMobile|Opera Mini)/i)) {
        configImgLazyLoad.setPageLoadAmount(4);
    } else {
        configImgLazyLoad.setPageLoadAmount(16);
    }
    configImgLazyLoad.setScrollOffset(200);

    new imageDefer(configImgLazyLoad);
};
*/

function validateEmail(email) {
    var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
    return pattern.test(email);
}

(function ($) {
    BUSY_REQUEST = false;
    var ww = $(window).width();

    $(document).ready(function () {
        loadScripts(['tooltipster', 'swiper']);
        if(window.location.href.indexOf('games/'))
            loadScripts(['jquery-select2']);
        initImageLazyLoad();
        initToggleMenu();
        initSite();
        initMobileMenu();
        menuHoverAction();
        setStyleProps();
        setIframeAsResponsive();

        document.ontouchmove = function (e) {
            e.preventDefault();
        }
        detectIsKeyboardOpened();
        initMobileLayoutOfTable();

        $('.search_input').on({
            blur: function(e){
                var search_val = $(this).val().trim();
                if(isSearchResultEvent) return;
                if($('.search-tag-manager').length  && $(this).val().trim() == search_val) return;
                if (search_val.length > 2 && search_val != searched_value) {
                    searched_value = search_val;
                    SearchTracker(search_val);
                }
            }
        });
        
        $('#search-all').on({
            mousedown: function(){
                isSearchResultEvent = true;
            },
            mouseup: function(){
                isSearchResultEvent = false;
            }
        });

        $('.js-more-games').click(function () {
            $(this).addClass('loading');
            var id = $(this).data('software');
            var self = $(this);
            console.dir('/games-by-software/' + GAME_CURR_PAGE);
            _request = $.ajax({
                url: '/games-by-software/' + GAME_CURR_PAGE,
                data: {
                    page: GAME_CURR_PAGE,
                    software: id
                },
                dataType: 'html',
                type: 'post',
                success: function (data) {
                    setTimeout(function () {
                        self.removeClass('loading');
                        refresh();
                    }, 1000);
                    GAME_CURR_PAGE++;
                    $('.games-list').append(data);
                    if ($(self).data('total') === $('.games-list').children().length) {
                        $(self).hide();
                    }
                },
                error: function (XMLHttpRequest) {
                    var msg = jQuery.parseJSON(XMLHttpRequest.responseJSON.body.message)[0];
                    if (XMLHttpRequest.statusText != "abort") {
                        console.log('err');
                    }
                },
                complete: function () {
                    BUSY_REQUEST = false;
                }
            });
        });
        
        $('.js-all-casinos').click(function () {
            $(this).addClass('loading');
            var key = $(this).data('key');
            var self = $(this);
             new Filters($('#filters'));
            _request = $.ajax({
                url: '/load-all-casinos/' + ALL_CASINOS_KEY,
                data: {
                    page: ALL_CASINOS_KEY,
                    type: key,
                    software: $(self).data('software')
                },
                dataType: 'html',
                type: 'post',
                success: function (data) {
                    setTimeout(function () {
                        self.removeClass('loading');
                        refresh();
                    }, 1000);
                    ALL_CASINOS_KEY++;
                    $(self).parent().prev().find('.list-body').append(data);
                    if ($(self).data('total') === $(self).parent().prev().find('.list-body').children().length) {
                        $(self).hide();
                    }
                },
                error: function (XMLHttpRequest) {
                    var msg = jQuery.parseJSON(XMLHttpRequest.responseJSON.body.message)[0];
                    if (XMLHttpRequest.statusText != "abort") {
                        console.log('err');
                    }
                },
                complete: function () {
                    BUSY_REQUEST = false;
                }
            });
        });

        $('.js-more-casinos').click(function () {
            $(this).addClass('loading');
            var key = $(this).data('key');
            var self = $(this);
            _request = $.ajax({
                url: '/casinos-by-software/' + determineCasinoPage(key),
                data: {
                    page: determineCasinoPage(key),
                    type: key,
                    software: $(self).data('software')
                },
                dataType: 'html',
                type: 'post',
                success: function (data) {
                    setTimeout(function () {
                        self.removeClass('loading');
                        refresh();
                    }, 1000);
                    raiseCasinoPage(key);
                    $(self).parent().prev().find('.list-body').append(data);
                    if ($(self).data('total') === $(self).parent().prev().find('.list-body').children().length) {
                        $(self).hide();
                    }
                },
                error: function (XMLHttpRequest) {
                    var msg = jQuery.parseJSON(XMLHttpRequest.responseJSON.body.message)[0];
                    if (XMLHttpRequest.statusText != "abort") {
                        console.log('err');
                    }
                },
                complete: function () {
                    BUSY_REQUEST = false;
                }
            });
        });

        $('.js-more-banking').click(function () {
            $(this).addClass('loading');
            var key = $(this).data('key');
            var self = $(this);
            _request = $.ajax({
                url: '/casinos-by-banking/' + BEST_BANKING_PAGE,
                data: {
                    page: BEST_BANKING_PAGE,
                    banking: $(self).data('banking')
                },
                dataType: 'html',
                type: 'post',
                success: function (data) {
                    setTimeout(function () {
                        self.removeClass('loading');
                        refresh();
                    }, 1000);
                    BEST_BANKING_PAGE++;
                    $(self).parent().prev().find('.list-body').append(data);
                    if ($(self).data('total') === $(self).parent().prev().find('.list-body').children().length) {
                        $(self).hide();
                    }
                },
                error: function (XMLHttpRequest) {
                    var msg = jQuery.parseJSON(XMLHttpRequest.responseJSON.body.message)[0];
                    if (XMLHttpRequest.statusText != "abort") {
                        console.log('err');
                    }
                },
                complete: function () {
                    BUSY_REQUEST = false;
                }
            });
        });

        $('.load-more').click(function () {
            var _request = new XMLHttpRequest();
            var category = $(this).data('category');
            var self = $(this);
            _request = $.ajax({
                url: '/load-more/' + category + '/' + AJAX_CUR_PAGE,
                data: {
                    page: AJAX_CUR_PAGE,
                    category: category
                },
                dataType: 'html',
                type: 'post',
                success: function (data) {
                    AJAX_CUR_PAGE++;
                    console.dir(data);
                    console.dir(data);
                    $('.cards-list-wrapper').append(data);
                    if ($(self).data('total') === $('.cards-list-wrapper').children().length) {
                        $(self).hide();
                    }
                },
                error: function (XMLHttpRequest) {
                    var msg = jQuery.parseJSON(XMLHttpRequest.responseJSON.body.message)[0];
                    if (XMLHttpRequest.statusText != "abort") {
                        console.log('err');
                        __this.closest(_obj).next('.action-field.not-valid').show();
                    }
                },
                complete: function () {
                    BUSY_REQUEST = false;
                }
            });
        });

        if (/iPhone|iPad|iPod/i.test(navigator.userAgent)) {
            $('html').addClass('ios-device');
        }

        function initMobileLayoutOfTable() {
            var _table = $('.plain-text table, .widget.table table');
            var _tr = _table.find('tr');
            var _th = _table.find('th');
            var _isInited = false;

            if ($(window).width() < 768)
                init();

            $(window).resize(function () {
                if ($(window).width() < 768) {
                    if (!_isInited)
                        init();
                } else {
                    destroy();
                }
            });

            function init() {
                $('.separate-table').remove();
                _th.each(function (index, el) {
                    var i = index;
                    var _newTable = $('<table class="separate-table"></table>');

                    _tr.each(function (index, el) {
                        var _itemTh = $(el).find('th').eq(i).clone().wrap('<tr></tr>').parent();
                        var _itemTd = $(el).find('td').eq(i).clone().wrap('<tr></tr>').parent();
                        _newTable.append(_itemTh, _itemTd);
                    });

                    _newTable.insertBefore(_table);
                });

                _table.remove();
                _isInited = true;
            }

            function destroy() {
                _table.insertAfter('.separate-table:first');

                $('.separate-table').remove();
                _isInited = false;
            }
        }

        function setIframeAsResponsive() {
            var iframes = $('.plain-text iframe');

            if (iframes.length) {
                iframes.each(function (index, el) {
                    $(el).wrap('<div class="iframe-wrapper"></div>');
                });
            }
        }

        function setStyleProps() {
            var vh = window.innerHeight * 0.01;
            document.documentElement.style.setProperty('--vh', vh + 'px');

            $(window).on('resize', function () {
                var vh = window.innerHeight * 0.01;
                document.documentElement.style.setProperty('--vh', vh + 'px');
            });
        }

//Load defer for pages on that you can see the footer on first load
        var footerHeight = 260;
        if ($(window).scrollTop() + $(window).height() > $(document).height() - footerHeight) {
            tmsIframe();
        } else {
            var deferEvent;
            if ($(window).width() < 768)
                deferEvent = 'touchstart';
            else
                deferEvent = 'mousemove';
            $(window).one(deferEvent, tmsIframe);
        }

        $(window).trigger('scroll');

        new SearchPanel($('.header'));

        var user_rate = $('.rating-container').data('user-rate');

        if ($('.box img.not-accepted').length) {
            $('.br-widget a').unbind("mouseenter mouseleave mouseover click");
        } else {

            if (user_rate > 0) {
                $('.br-widget').children().each(function () {
                    $(this).unbind("mouseenter mouseleave mouseover click");
                    if (parseInt($(this).data('rating-value')) <= parseInt(user_rate)) {
                        $(this).addClass('br-active');
                    }
                });
                $('.br-widget').unbind("mouseenter mouseleave mouseover click");
            }
        }

/*        $(window).mousemove(function () {
            loadScripts(['swiper']);
        });
        $(window).scroll(function(){
            loadScripts(['swiper']);
        });*/
        initImageLazyLoad();


    });

    function menuHoverAction() {
        if (!checkIfIsMobileDevice()) {
            $('.header-menu__list-holder .expand-holder').on('mouseout', function (e) {
                $('.expand-holder').removeClass('opened');
            })
        }
    }

    $.fn.scrollEnd = function (callback, timeout) {
        $(this).scroll(function () {
            var $this = $(this);
            if ($this.data('scrollTimeout')) {
                clearTimeout($this.data('scrollTimeout'));
            }
            $this.data('scrollTimeout', setTimeout(callback, timeout));
        });
    };

    var windowToBottom = 0;

    $(window).on('scroll', function () {
        //scroll down
        if (windowToBottom < $(window).scrollTop()) {
            $('body').removeClass('site__header_sticky');
            windowToBottom = $(window).scrollTop();
            //scroll up
        } else {
            if ((windowToBottom - $(window).scrollTop()) > ($(window).height() / 3)) {
                $('body').addClass('site__header_sticky');
                windowToBottom = $(window).scrollTop();
            }
        }
        if ($(window).scrollTop() === 0) {
            $('body').removeClass('site__header_sticky');
        }
    });

    if ($(window).width() < 768) {
        $(window).scrollEnd(function () {
            if ($(window).scrollTop() !== 0) {
                $('body').addClass('site__header_sticky');
            }
        }, 800);

        if (/\/reviews\//.test(window.location.href) && $('.btn-group-mobile .btn-middle').length > 0) {
            var appended = false;
            var position = $(window).height() / 2 + $(window).scrollTop();
            $(window).on('scroll', function () {
                if ($(window).scrollTop() > position && appended === false) {
                    $('body').append('<a rel="nofollow" target="_blank" class="btn-play-now" href="' + $('.btn-group-mobile .btn-middle').attr('href') + '">Play Now</a>');
                    $('body').addClass('play-now-appended');
                    appended = true;
                }
            });
        }
    }




    tooltipConfig = {
        trigger: 'click',
        maxWidth: 279,
        animation: 'grow',
        debug: false,
    };

    copyTooltipConfig = {
        trigger: 'click',
        maxWidth: 260,
        minWidth: 260,
        animation: 'grow',
        contentAsHTML: true,
        debug: false,
        functionBefore: function (instance, helper) {
            instance.content('\
                <div class="centered">\
                    <i class="icon icon-icon_available"></i> Code copied to clipboard\
                </div>\
            ');
        }
    };

    contentTooltipConfig = {
        trigger: 'click',
        minWidth: 460,
        interactive: true,
        contentAsHTML: true,
        debug: false,
        content: $('.loader'),
        animation: 'fade',
        contentCloning: false,
        functionReady: function () {
            $('body').addClass('shadow');
            checkStringLength($('.bonus-box'), 15);
            $('.js-tooltip').tooltipster(tooltipConfig);
        },
        functionAfter: function () {
            $('body').removeClass('shadow');
        },
        functionBefore: function (instance, helper) {
            var $origin = $(helper.origin);

            if ($origin.data('loaded') !== true) {

                var _name = $origin.data('name');
                var _is_free = $origin.data('is-free');
                var _request = new XMLHttpRequest();

                _request.abort();
                _request = $.ajax({
                    url: "/casino/bonus",
                    data: {
                        casino: _name,
                        is_free: _is_free,
                    },
                    dataType: 'html',
                    type: 'GET',
                    success: function (response) {
                        instance.content(response);
                        setTimeout(function () {
                            updateHandlers();
                        }, 50);
                        $origin.data('loaded', true);
                    }
                });
            } else {
                setTimeout(function () {
                    updateHandlers();
                }, 50);
            }

            function updateHandlers() {
                $('.js-tooltip').tooltipster(tooltipConfig);
                $('.js-copy-tooltip').tooltipster(copyTooltipConfig);
                copyToClipboard();
                checkStringLength($('.bonus-box'), 15);
            }
        }
    };

    var initSite = function () {
       // sliderInit();
        initExpandingText();
        initBarRating();
       // initCustomSelect();
        initSearch();
        copyToClipboard();
        initMoboleBonusesPop(ww);
        initReviewForm();
        initReplies();
        initTexfieldsLabels();
        showMoreReviews();
        checkStringLength($('.list .bonus-box'), 21);
        checkStringLength($('.bonus-item .bonus-box'), 33);
        grayscaleIE();
        initTableOpen();

        $('.message .close').on('click', function (e) {
            $(this).parent().fadeOut();
            e.preventDefault();
        });

        $('.js-history-back').on('click', function (e) {
            window.history.back();
            e.preventDefault();
        });

        if ($('#filters').length > 0) {
            new Filters($('#filters'));
        }

        if ($('#reviews').length > 0) {
            $('.review').each(function (i) {
                new AddingReview($(this));
            });

            $('[href="#reviews"]').on('click', function () {
                initScrollTo($('#reviews'), 100);
                return false;
            });
        }

        if ($('.js-vote').length > 0) {
            new Vote($('.js-vote'));
        }

        if ($('.js-run-counter').length > 0) {
            var _name = $('.js-run-counter').data('name');
            runPlayCounter(_name);
        }

        if ($('.contact-form').length > 0) {
            new handleContactUs($('.contact-form'));
        }

        new newsletter($('.subscribe'));

        $('.js-tooltip').tooltipster(tooltipConfig);
        $('.js-copy-tooltip').tooltipster(copyTooltipConfig);
        $('.js-tooltip-content').tooltipster(contentTooltipConfig);
    }

    function initTableOpen() {
        $('.js-table-package-opener').on('click', function (e) {
            $(this).closest('tr').toggleClass('active');
            e.preventDefault();
        });
    }

    function grayscaleIE() {
        if (getInternetExplorerVersion() >= 10) {
            $('img.not-accepted').each(function () {
                var el = $(this);
                el.css({"position": "absolute"}).wrap("<div class='img_wrapper' style='display: inline-block'>").clone().addClass('img_grayscale').css({"position": "absolute", "z-index": "5", "opacity": "0"}).insertBefore(el).queue(function () {
                    var el = $(this);
                    el.parent().css({"width": this.width, "height": this.height});
                    el.dequeue();
                });
                this.src = grayscaleIE10(this.src);
            });

            function grayscaleIE10(src) {
                var canvas = document.createElement('canvas');
                var ctx = canvas.getContext('2d');
                var imgObj = new Image();
                imgObj.src = src;
                canvas.width = imgObj.width;
                canvas.height = imgObj.height;
                ctx.drawImage(imgObj, 0, 0);
                var imgPixels = ctx.getImageData(0, 0, canvas.width, canvas.height);
                for (var y = 0; y < imgPixels.height; y++) {
                    for (var x = 0; x < imgPixels.width; x++) {
                        var i = (y * 4) * imgPixels.width + x * 4;
                        var avg = (imgPixels.data[i] + imgPixels.data[i + 1] + imgPixels.data[i + 2]) / 3;
                        imgPixels.data[i] = avg;
                        imgPixels.data[i + 1] = avg;
                        imgPixels.data[i + 2] = avg;
                    }
                }
                ctx.putImageData(imgPixels, 0, 0, 0, 0, imgPixels.width, imgPixels.height);
                return canvas.toDataURL();
            }
            ;
        }
        ;
    }

    function getInternetExplorerVersion() {
        var rv = -1;
        if (navigator.appName == 'Microsoft Internet Explorer') {
            var ua = navigator.userAgent;
            var re = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
            if (re.exec(ua) != null)
                rv = parseFloat(RegExp.$1);
        }
        else if (navigator.appName == 'Netscape') {
            var ua = navigator.userAgent;
            var re = new RegExp("Trident/.*rv:([0-9]{1,}[\.0-9]{0,})");
            if (re.exec(ua) != null)
                rv = parseFloat(RegExp.$1);
        }
        return rv;
    }

    function checkIfIsMobileDevice() {

        var winsize = $(window).width();

        $(window).resize(function () {
            winsize = $(window).width();
        });

        if (winsize < 1000) {
            return true;
        }

        if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
            return true;
        }
        return false;
    }


    function initToggleMenu() {
        var targetNode = document.querySelector('.header-menu__list-holder');
        if (targetNode) {
            var isMobile = checkIfIsMobileDevice();
            var eventL = isMobile ? 'click' : 'hover';

            targetNode.addEventListener(eventL, function (e) {

                var that = this, currentOpened, currentTarget = e.target;
                while (currentTarget != that) {
                    if (currentTarget.classList.contains('expand-holder')) {
                        currentOpened = document.querySelector('.expand-holder.opened');
                        if (currentOpened == currentTarget) {
                            var toggleSection = currentOpened.querySelector(".expand-menu");
                            if (e.target.className !== 'expand-menu') {
                                currentOpened.classList.remove('opened');
                            }
                        }
                        else {
                            if (currentOpened) {
                                if (e.target.className !== 'expand-menu') {
                                    currentOpened.classList.remove('opened');
                                }
                                setTimeout(function () {
                                    currentTarget.classList.add('opened');
                                }, 400);
                            }
                            else {
                                currentTarget.classList.add('opened');
                            }
                        }
                        break;
                    }
                    else {
                        currentTarget = currentTarget.parentNode;
                    }
                }
            }, true);
        }
    }
    function checkStringLength(box, num) {
        $(box).each(function (index, el) {
            var child = $(this).find('.list-item-trun');
            var bubble = $(this).find('.bubble');

            if (child.text().length >= num) {
                bubble.css('visibility', 'visible');
            }
        });
    }

    function newsletter(obj) {
        var _wrap = obj,
                _field_email = _wrap.find('.news-email'),
                _send_btn = _wrap.find('.news-btn'),
                _contact_success = $('#news-success'),
                _contact_error = $('#news-note'),
                _contact_error_class = 'not-valid',
                email,
                _request = new XMLHttpRequest();

        _prepMessage = function () {
            email = _field_email.val();
            ok = true;

            if (email === '' || !validateEmail(email)) {
                _field_email.parent().addClass(_contact_error_class);
                ok = false;
            } else {
                _field_email.parent().removeClass(_contact_error_class);
            }

            if (!ok) {
                _contact_error.show();
            } else {
                _contact_error.hide();
            }

            return ok;
        },
                _sendNews = function (email) {
                    _request.abort();
                    _request = $.ajax({
                        url: "/newsletter/subscribe",
                        data: {
                            email: email,
                        },
                        dataType: 'json',
                        timeout: 20000,
                        type: 'POST',
                        success: function (response) {
                            if (response.status == "ok") {
                                _contact_success.show();
                                _contact_error.hide();
                                _send_btn.prop('disabled', true);
                                _field_email.val('');
                                _onEvents();
                            }
                            else if (response.status == "error") {
                                var arr = JSON.parse(response.body);

                                $('.action-added').remove();
                                $.each(arr, function (index, val) {
                                    var $msg = '<div class="action-field action-added not-valid ">' + val + '</div>';
                                    $('.review-submit-holder .msg-holder').append($msg);
                                });
                            }
                        },
                        error: function (XMLHttpRequest) {
                            console.error("Could not send message!");
                        }
                    });
                },
                _onEvents = function () {
                    _send_btn.on({
                        'click': function (e) {
                            var error = _prepMessage();
                            if (error === false) {
                                e.stopPropagation();
                            } else {
                                _sendNews(email);
                            }
                        }
                    });
                },
                _init = function () {
                    _onEvents();
                };

        _init();
    }



    var Filters = function (obj) {
        var _obj = obj,
                _self = this,
                _switchers = _obj.find('input[type=checkbox]'),
                _radios = _obj.find('input[type=radio]'),
                _selectFilter = _obj.find('select[name=soft]'),
                _targetContainer = $('.data-container'),
                _targetAddContainer = $('.data-add-container'),
                _paramName = _targetContainer.data('type'),
                _paramValue = _targetContainer.data('type-value'),
                _ajaxContent = $('.aj-content'),
                _emptyContent = $('.empty-filters'),
                _loaderHolder = _obj.next('.data-container-holder').find('.holder'),
                _moreButton,
                _resetButton,
                _itemsPerPage = $('.list-item').length,
                _defaultButton = $('#default'),
                _totalItems = $('.qty-items').data('load-total'),
                _clicks = Math.floor(_totalItems / _itemsPerPage),
                _currentClick = 0,
                _request = new XMLHttpRequest();

        if (typeof _paramName == 'undefined') {
            _paramName = 'game_type';
        }

        var _url = _obj.data('url');
        _defaultButton.prop('checked', true);

        if (_url === "/games-filter/") {
            var dataContainerMutationObserver = new MutationObserver(function (mutations) {
                var c = 0;

                mutations.forEach(function (mutation) {
                    if (mutation.type === "childList" && mutation.addedNodes.length !== 0 && c < 1) {
                        initImageLazyLoad();
                        c++;
                    }
                });
            });

            dataContainerMutationObserver.observe($('.data-container').get(0),
                    {
                        childList: true,
                        subtree: true,
                    });
            dataContainerMutationObserver.observe($('.data-add-container').get(0),
                    {
                        childList: true,
                        subtree: true,
                    });
        }


        var _onEvent = function () {
            _moreButton = $('.js-more-items');
            _resetButton = $('.js-reset-items');
            _switchers.off();
            _switchers.on('click', function () {
                _ajaxRequestCasinos(_getAjaxParams(_paramName, _paramValue), 'replace');
            });

            _radios.off();
            _radios.on('click', function () {
                _ajaxRequestCasinos(_getAjaxParams(_paramName, _paramValue), 'replace');
            });

            $('.js-filter > option').on('click', function () {
                var counter = 0;
                $('.js-filter > option').each(function (index, el) {
                    if ($(this).prop("selected")) {
                        counter++;
                    }
                });
            });

            _selectFilter.off();
            _selectFilter.on('change', function () {
                _ajaxRequestCasinos(_getAjaxParams(_paramName, _paramValue), 'replace');
            });

            _moreButton.off();
            _moreButton.on('click', function () {
                _ajaxRequestCasinos(_getAjaxParams(_paramName, _paramValue, 'add'), 'add');
                return false;
            });

            _resetButton.off();
            _resetButton.on('click', function () {
                _ajaxRequestCasinos(_getAjaxParams(_paramName, _paramValue, 'reset'), 'add');

                return false;
            });

        },
                _getAjaxParams = function (_paramName, _paramValue, _action) {

                    var _ajaxDataParams = {};
                    $.each(_switchers, function (index, el) {
                        if ($(el).is(':checked')) {
                            _ajaxDataParams[$(el).attr('name')] = 1;
                        }

                        if (_action == 'reset') {
                            _ajaxDataParams[$(el).attr('name')] = '';
                            $(el).prop('checked', false);
                        }
                    });

                    $.each(_radios, function (index, el) {
                        if ($(el).is(':checked')) {
                            _ajaxDataParams[$(el).attr('name')] = $(el).attr('value');
                        }

                        if (_action == 'reset') {
                            _ajaxDataParams[$(el).attr('name')] = 1;
                            if (index == 0) {
                                $(el).prop('checked', true);
                            }
                        }
                    });

                    _ajaxDataParams[_paramName] = _paramValue;

                    if (_selectFilter.val() != 'undefined' && _selectFilter.val() != null) {
                        _ajaxDataParams['software'] = _selectFilter.val().join();

                        if (_action == 'reset') {
                            _ajaxDataParams['software'] = '';

                        }
                    }

                    if (typeof AJAX_CUR_PAGE == "undefined")
                        AJAX_CUR_PAGE = 1;

                    if (_action != 'add' || _action == 'reset') {
                        AJAX_CUR_PAGE = 0;
                    }

                    if (_ajaxDataParams["label"] != undefined && _ajaxDataParams["label"] == "Mobile") {
                        _ajaxDataParams["compatibility"] = "mobile";
                        delete _ajaxDataParams.label;
                    }

                    return _ajaxDataParams;
                }

        _ajaxRequestCasinos = function (_ajaxDataParams, _action) {
            console.dir('test');
            if (_action == 'add') {
                _moreButton.addClass('loading');
            } else {
                $('.overlay, .loader').fadeIn('fast');
            }

            if (BUSY_REQUEST)
                return;
            BUSY_REQUEST = true;
            _request.abort();
            var limit_items = (_url == '/games-filter/') ? 24 : 100;
            if (location.pathname === '/casinos') {
                _url = 'load-all-casinos/';
            }
            _request = $.ajax({
                url: _url + AJAX_CUR_PAGE,
                data: _ajaxDataParams,
                dataType: 'html',
                type: 'GET',
                success: function (data) {
                    var cont = $(data).find('.loaded-item');
                    var loadTotal = $(data).filter('[data-load-total]').data('load-total');

                    if (_action == 'replace') {
                        _targetContainer.html(data);
                        _targetAddContainer.html('');
                        $('.qty-items').attr('data-load-total', loadTotal);
                        $('.qty-items-quantity').text(loadTotal);

                        if (cont.length === $('.qty-items').attr('data-load-total')) {
                            if (cont.length > 0) {
                                _loaderHolder.show();
                                _emptyContent.hide();
                            } else {
                                _loaderHolder.hide();
                                _emptyContent.show();
                            }
                            _moreButton.hide();
                        } else {
                            _moreButton.show();
                            _loaderHolder.show();
                            _emptyContent.hide();
                        }

                        refresh();
                        AJAX_CUR_PAGE = 1;
                        _currentClick = 0;
                    } else {
                        AJAX_CUR_PAGE++;
                        _currentClick++;

                        setTimeout(function () {
                            _targetAddContainer.append(cont);
                            _moreButton.removeClass('loading');
                            refresh();

                            if (cont.length < limit_items) {
                                _moreButton.hide();
                            }
                        }, 1000)
                    }
                    _construct();
                    checkStringLength($('.data-add-container .bonus-box, .data-container .bonus-box'), 21);
                },
                error: function (XMLHttpRequest) {
                    if (XMLHttpRequest.statusText != "abort") {
                        console.log('err');
                    }
                },
                complete: function () {
                    BUSY_REQUEST = false;
                    $('.overlay, .loader').fadeOut('fast');
                    if (_url === '/casinos-filter/') {
                        if (parseInt($('.qty-items').attr('data-load-total')) <= 100) {
                            $('.js-more-items').hide();
                        } else {
                            $('.js-more-items').show();
                        }
                    } else if (_url === '/games-filter/') {

                        if (parseInt($('.qty-items-quantity').html()) <= 24) {
                            $('.js-more-items').hide();
                        } else {
                            $('.js-more-items').show();
                        }
                    }
                    grayscaleIE();
                }
            });
        },
                _construct = function () {
                    _onEvent();
                    _obj[0].obj = _self;
                };

        _construct();
    };

    function initReviewForm() {
        var field = $('.expanding');
        var hiddenBlocks = $('.js-expanding-textfields');

        if ($('.box img.not-accepted').length) {
            field.unbind("mouseenter mouseleave mouseover click focus");
        } else {
            field.on('focus', function () {
                $(this).removeClass('expanding');
                $(this).closest('.form').find(hiddenBlocks).slideDown();
            });
        }
    }

    var Vote = function (obj) {

        var _obj = obj,
                _trigger = _obj.find('.vote-button'),
                _request = new XMLHttpRequest;

        var _init = function () {
            _trigger.off();
            _trigger.on('click', function () {
                var _id = $(this).data('id');
                var _success = $(this).data('success');
                var _target = $(this).data('type');

                _updateVote($(this), _getTarget(_target), _getData(_target, _id, _success));

                return false;
            });
        },
                _getData = function (_target, _id, _success) {
                    var _ret = {id: _id, is_like: _success};
                    return _ret;
                }

        _getTarget = function (_arg) {
            var _target = '/casino/review-like';
            if (_arg === 'article') {
                _target = '/blog/rate';
            }
            return _target;
        },
                _updateVote = function (_this, _target, _data) {
                    if (BUSY_REQUEST)
                        return;
                    BUSY_REQUEST = true;
                    _request.abort();

                    _request = $.ajax({
                        url: _target,
                        data: _data,
                        dataType: 'json',
                        type: 'post',
                        success: function (data) {
                            if (_target === '/casino/review-like') {
                                if (data.body.status == 'not_ok') {
                                    console.log(data.body.message);
                                } else {
                                    var _holderLikes = $(_this).find('.bubble-vote');
                                    var _oldLikes = _holderLikes.text();
                                    _holderLikes.text(++_oldLikes);
                                }
                                _this.closest(_obj).next('.action-field.success').show();
                            } else if (_target === '/blog/rate') {
                                $(_this.parent().parent()).find('.votes-like .vote-block-num, .like .vote-block-num').text(data.body.likes);
                                $(_this.parent().parent()).find('.votes-dislike .vote-block-num, .dislike .vote-block-num').text(data.body.dislikes);

                                _this.closest(_obj).next('.action-field.success').show();
                            }
                        },
                        error: function (XMLHttpRequest) {
                            var msg = jQuery.parseJSON(XMLHttpRequest.responseJSON.body.message)[0];
                            if (XMLHttpRequest.statusText != "abort") {
                                __this.closest(_obj).next('.action-field.not-valid').show();
                            }
                        },
                        complete: function () {
                            BUSY_REQUEST = false;
                        }
                    });
                };
        _init();
    };

    function initScrollTo(_target, _offset) {
        if (typeof _target !== "undefined") {
            action(_target, _offset);
        } else {
            var btn = $('.js-scroll');
            btn.on('click', function (a) {
                var target = $($(this).attr('href'));
                action(target, 0);
                a.preventDefault();
            });
        }

        function action(target, offset) {
            $('html, body').animate({
                scrollTop: target.offset().top - offset
            }, 1000);
        }
    }

    function showMoreReviews() {
        var _btn = $('.js-more-reviews');
        var _holderParent = $('#review-data-holder');
        var _holderMoreChild = $('.reply-data-holder');
        var _name = $('.rating-container').data('casino-name');
        var _request = new XMLHttpRequest;
        _btn.on('click', function () {
            _addReviews($(this), $(this).data('type'));
            return false;
        });

        if ($(".not-accepted").length)
            _btn.css("pointer-events", "auto");

        var _addReviews = function (_this, _type) {
            if (BUSY_REQUEST)
                return;
            BUSY_REQUEST = true;
            _request.abort();
            _request = $.ajax({
                url: '/casino/more-reviews/' + getWebName(_name) + '/' + _this.data('page'),
                dataType: 'HTML',
                data: {
                    id: _this.data('id'),
                    type: _type
                },
                type: 'GET',
                success: function (data) {

                    if (_type == 'review') {
                        _holderParent.append(data);
                        if (_this.data('page') >= (_this.data('total') / 5) - 1) {
                            _this.hide();
                        }
                    } else if (_type == 'reply') {
                        _this.closest('.reply').find(_holderMoreChild).append(data);
                    }

                    if (_this.data('page') >= (_this.data('total') / 5) - 1) {
                        _this.hide();
                    }

                    var _page = _this.data('page');

                    _this.data('page', ++_page);

                    _refreshData();

                    showMoreReviews();
                },
                error: function (XMLHttpRequest) {
                    if (XMLHttpRequest.statusText != "abort") {
                        console.log('err');
                    }
                },
                complete: function () {
                    BUSY_REQUEST = false;
                }
            });
        },
                _refreshData = function () {

                    initReviewForm();
                    initTexfieldsLabels();

                    new Vote($('.js-vote'));
                    $('.review').each(function () {
                        new AddingReview($(this));
                    });
                    grayscaleIE();
                };
    }

    var SearchPanel = function (obj) {
        var _obj = obj,
                _self = this,
                _searchButton = _obj.find('.js-trigger-search'),
                _searchAllButton = _obj.find('#search-all'),
                _searchContainer = _obj.find('#search'),
                _searchForm = _obj.find('#search-form'),
                _searchInput = _searchForm.find('input'),
                _searchUpdate = _searchForm.find('.js-mobile-search-clear'), // clear text
                _searchCasinosContainer = _searchContainer.find('#search-casinos ul'),
                _searchListsContainer = _searchContainer.find('#search-lists ul'),
                _searchPagesContainer = _searchContainer.find('#search-pages ul'),
                _searchEmptyContainer = _searchContainer.find('#search-empty'),
                _imgDir = _searchContainer.data('img-dir'),
                _loadNewContent = true,
                _loadMoreContent = false,
                _is_content_detached = false,
                _showMoreNum = 5,
                _fromCasinos = 1,
                _fromLists = 1,
                _fromPages = 1,
                _request = new XMLHttpRequest();
        window.contentBeforeSearch;
            var nr_requests;
            var nr_requests_completed;

            var _onEvent = function () {

            _searchButton.on(
                    'click',
                    function () {
                        _ajaxRequestPopup('/search');
                        _resetPages();
                        return false;
                    });

            _searchInput.on({
                'focus': function () {
                    nr_requests = 0;
                    nr_requests_completed = 0;
                    _ajaxRequestPopup('/search');
                    _resetPages();
                },
                'keyup': function (e) {
                    if (e.keyCode == 27) {
                        _hidePanel();
                        _resetPages();
                    } else if (e.keyCode == 13) {
                        isSearchResultEvent = true;
                        if (_searchInput.val() != '') {
                            _ajaxRequestAdvanced();
                            _searchInput.blur();
                        }
                        _resetPages();
                    } else {
                        isSearchResultEvent = false;
                        var searchPopup = _obj.find('#search__popup');
                        searchPopup.addClass('load');
                        nr_requests++;
                        _ajaxRequestPopup('/search');
                        _resetPages();
                    }

                    if (_searchInput.val() != '') {
                        _searchAllButton.parent().fadeIn();
                    } else {
                        _searchAllButton.parent().fadeOut();
                    }
                },
            });

            _searchUpdate.on(
                    'click',
                    function () {
                        _searchInput.val('').focus();
                        _ajaxRequestPopup('/search');
                        _resetPages();
                        return false;
                    }
            );

            _searchAllButton.on(
                    'click',
                    function () {
                        if (_searchInput.val() != '') {
                            _ajaxRequestAdvanced();
                        }
                        return false;
                    }
            );
        },
                _closeSearch = function () {
                    $('#site-content').html('').append(contentBeforeSearch);
                    $('.js-search-drop').show();
                    $('body').removeClass('advanced-search-opened');
                    _searchInput.blur();
                    setTimeout(function () {
                        initSite();
                    }, 1000);
                },
                _initMoreButtons = function () {
                    var _searchMoreLists = $('#js-search-more-lists');
                    var _searchMoreListsNumHolder = $('.more-lists', _searchMoreLists);
                    var _searchMoreListsNum = _searchMoreListsNumHolder.data('total-casinos');


                    var _searchMoreCasinos = $('#js-search-more-casinos');
                    var _searchMoreCasinosNumHolder = $('.more-num', _searchMoreCasinos);
                    var _searchMoreCasinosNum = _searchMoreCasinosNumHolder.data('total-casinos');

                    var _searchMorePages = $('#js-search-more-pages');
                    var _searchMorePagesNumHolder = $('.more-num', _searchMorePages);
                    var _searchMorePagesNum = _searchMorePagesNumHolder.data('total-games');

                    var _clicksLists = Math.floor(_searchMoreListsNum / _showMoreNum);
                    var _clicksCasinos = Math.floor(_searchMoreCasinosNum / _showMoreNum);
                    var _clicksPages = Math.floor(_searchMorePagesNum / _showMoreNum);

                    var _remainderLists = _searchMoreListsNum % _showMoreNum;
                    var _remainderCasinos = _searchMoreCasinosNum % _showMoreNum;
                    var _remainderPages = _searchMorePagesNum % _showMoreNum;

                    if (_remainderLists < _showMoreNum && _clicksLists == 1) {
                        _searchMoreListsNumHolder.text(_remainderLists);
                    }

                    if (_remainderCasinos < _showMoreNum && _clicksCasinos == 1) {
                        _searchMoreCasinosNumHolder.text(_remainderCasinos);
                    }

                    if (_remainderPages < _showMoreNum && _clicksPages == 1) {
                        _searchMorePagesNumHolder.text(_remainderPages);
                    }

                    _searchMoreLists.on(
                            'click',
                            function () {
                                _ajaxMore('/search/more-lists/' + _fromLists, $('.search-title span').text(), $('#all-lists-container'), 'lists');

                                if (_fromLists >= _clicksLists) {
                                    _searchMoreLists.fadeOut();
                                } else {
                                    _searchMoreLists.fadeIn();
                                }

                                if (_fromLists >= _clicksLists - 1 && _remainderLists > 0) {
                                    _searchMoreListsNumHolder.text(_remainderLists);
                                }
                                _fromLists++;

                                return false;
                            }
                    );

                    _searchMoreCasinos.on(
                            'click',
                            function () {
                                _ajaxMore('/search/more-casinos/' + _fromCasinos, $('.search-title span').text(), $('#all-casinos-container'), 'casinos');

                                if (_fromCasinos >= _clicksCasinos) {
                                    _searchMoreCasinos.fadeOut();
                                } else {
                                    _searchMoreCasinos.fadeIn();
                                }

                                if (_fromCasinos >= _clicksCasinos - 1 && _remainderCasinos > 0) {
                                    _searchMoreCasinosNumHolder.text(_remainderCasinos);
                                }
                                _fromCasinos++;
                                return false;
                            }
                    );

                    _searchMorePages.on(
                            'click',
                            function () {
                                _ajaxMore('/search/more-games/' + _fromPages, $('.search-title span').text(), $('#all-games-container'), 'games');

                                if (_fromPages >= _clicksPages) {
                                    _searchMorePages.fadeOut();
                                } else {
                                    _searchMorePages.fadeIn();
                                }
                                if (_fromPages >= _clicksPages - 1 && _remainderPages > 0) {
                                    _searchMorePagesNumHolder.text(_remainderPages);
                                }
                                _fromPages++;
                                return false;
                            }
                    );
                },
                _clearSearchBody = function () {
                    _searchListsContainer.empty();
                    _searchCasinosContainer.empty();
                    _searchPagesContainer.empty();
                },
                _ajaxMore = function (target, val, container, type) {
                    if (BUSY_REQUEST)
                        return;
                    BUSY_REQUEST = true;
                    _request.abort();
                    _request = $.ajax({
                        url: target,
                        data: {
                            value: val
                        },
                        dataType: 'json',
                        type: 'GET',
                        success: function (data) {
                            _loadMoreData(data, container, type);
                        },
                        error: function (XMLHttpRequest) {
                            if (XMLHttpRequest.statusText != "abort") {
                                _showEmptyMessage();
                            }
                        },
                        complete: function () {
                            BUSY_REQUEST = false;
                        }
                    });
                },
                _ajaxRequestAdvanced = function () {
                    window.scrollTo(0, 0);
                    var _response_container = $('#site-content');
                    if (BUSY_REQUEST)
                        return;
                    BUSY_REQUEST = true;
                    _request.abort();
                    _request = $.ajax({
                        url: '/search/advanced',
                        data: {
                            value: _searchInput.val(),
                        },
                        dataType: 'HTML',
                        type: 'GET',
                        success: function (data) {
                            $('body').addClass('advanced-search-opened');
                            if (!_is_content_detached) {
                                contentBeforeSearch = $('#site-content .main, #site-content .promo').detach();
                            }
                            _is_content_detached = true;
                            _response_container.html(data);
                            _hidePopup();
                            _initMoreButtons();
                            unlockScreen();

                            _response_container.find('#js-search-back').each(function () {
                                $(this).on({
                                    click: function () {
                                        _closeSearch();
                                    }
                                })
                            });

                            $('.js-mobile-search-close').on('click', function () {
                                _closeSearch();
                            });
                        },
                        error: function (XMLHttpRequest) {
                            if (XMLHttpRequest.statusText != "abort") {
                                console.log('err');
                            }
                        },
                        complete: function () {
                            BUSY_REQUEST = false;
                        }
                    });
                },
                _ajaxRequestPopup = function (target, page) {
                    if (checkIfIsMobileDevice()) {
                        lockScreen();
                    }
                    if (BUSY_REQUEST && (nr_requests_completed == nr_requests)) return;
                    BUSY_REQUEST = true;
                    _request.abort();
                    _request = $.ajax({
                        url: target,
                        data: {
                            value: _searchInput.val(),
                            page: page
                        },
                        dataType: 'json',
                        type: 'GET',
                        success: function (data) {
                            _loadData(data);
                        },
                        error: function (XMLHttpRequest) {
                            if (XMLHttpRequest.statusText != "abort") {
                                _showEmptyMessage();
                            }
                        },
                        complete: function (data) {
                            nr_requests_completed++;
                            BUSY_REQUEST = false;
                        }
                    });
                },
                getWebName = function (name) {
                    return name.replace(/\s/g, '-').toLowerCase();
                },
                getItemPattern = function (itemData) {
                    var pattern = '<li>\
                    <a class="search-results-label" href="/' + itemData.link.replace("/games/", "") + '">\
                        ' + itemData.name + '\
                    </a>\
                </li>';
                    return pattern;
                },
                _loadMoreData = function (data, container, type) {
                    var items = data.body.results;
                    var link;
                    if (type === 'lists') {
                        for (var i = 0; i < items.length; i++) {
                            var _item = getItemPattern({
                                link: items[i]['url'],
                                name: items[i]['title']
                            });
                            container.append(_item);
                        }
                    } else {
                        for (var item in items) {
                            if (type == 'games') {
                                link = 'play/' + getWebName(items[item]);
                            } else if (type == 'casinos') {
                                link = 'reviews/' + getWebName(items[item]) + '-review';
                            }

                            var _item = getItemPattern({
                                link: link,
                                name: items[item]
                            });
                            container.append(_item);
                        }
                    }
                },
                _loadData = function (data) {
                    var lists = data.body.lists;
                    var casinos = data.body.casinos;
                    var pages = data.body.games;

                    if (!_loadMoreContent)
                        _clearSearchBody();

                    if ($.isEmptyObject(lists) && $.isEmptyObject(casinos) && $.isEmptyObject(pages)) {
                        _showEmptyMessage();
                    } else {
                        _hideEmptyMessage();

                        if (!$.isEmptyObject(lists)) {
                            _searchListsContainer
                                    .parent()
                                    .show()
                                    .next()
                                    .removeClass('single');

                            if (data.body.total_lists > 3 && Math.ceil(data.body.total_lists / 3) > _fromLists) {
                            } else {
                                _fromLists = 1;
                            }
                        } else {
                            _searchListsContainer
                                    .parent()
                                    .hide()
                                    .next()
                                    .addClass('single');
                        }

                        if (!$.isEmptyObject(casinos)) {
                            _searchCasinosContainer
                                    .parent()
                                    .show()
                                    .next()
                                    .removeClass('single');

                            if (data.body.total_casinos > 3 && Math.ceil(data.body.total_casinos / 3) > _fromCasinos) {
                            } else {
                                _fromCasinos = 1;
                            }
                        } else {
                            _searchCasinosContainer
                                    .parent()
                                    .hide()
                                    .next()
                                    .addClass('single');
                        }

                        if (!$.isEmptyObject(pages)) {
                            _searchPagesContainer
                                    .parent()
                                    .show()
                                    .prev()
                                    .removeClass('single');
                            if (data.body.total_pages > 3 && Math.ceil(data.body.total_casinos / 3) > _fromPages) {
                            } else {
                                _fromPages = 1;
                            }
                        } else {
                            _searchPagesContainer
                                    .parent()
                                    .hide()
                                    .prev()
                                    .addClass('single');
                        }
                        _searchListsContainer.html("");
                        for (var i = 0; i < lists.length; i++) {

                            var _item = getItemPattern({
                                link: (lists[i]['url']),
                                name: lists[i]['title']
                            });
                            _searchListsContainer.append(_item);
                        }

                        for (var casino in casinos) {

                            var _item = getItemPattern({
                                link: 'reviews/' + getWebName(casinos[casino]) + '-review',
                                name: casinos[casino]
                            });
                            _searchCasinosContainer.append(_item);
                        }

                        for (var page in pages) {

                            var _item = getItemPattern({
                                link: 'play/' + getWebName(pages[page]),
                                name: pages[page]
                            });

                            _searchPagesContainer.append(_item);
                        }
                        if (_searchInput.val() != '') {
                            _illumination();
                        }
                    }
                },
                _resetPages = function () {
                    _fromPages = 1;
                    _fromCasinos = 1;
                },
                _showEmptyMessage = function () {
                    _searchListsContainer.parent().hide();
                    _searchCasinosContainer.parent().hide();
                    _searchPagesContainer.parent().hide();
                    _searchEmptyContainer.show();
                    _searchAllButton.parent().fadeOut();
                },
                _hideEmptyMessage = function () {
                    _searchListsContainer.parent().show();
                    _searchCasinosContainer.parent().show();
                    _searchPagesContainer.parent().show();
                    _searchEmptyContainer.hide();
                },
                _hidePopup = function () {
                    searchDropClose($('.js-search-drop'));
                    _loadNewContent = true;
                },
                _hidePanel = function () {
                    _hidePopup();
                },
                _illumination = function () {
                    var searchItems = _obj.find('.search-results-label');
                    searchItems.each(function () {
                        $(this).html(function (_, html) {
                            return html.replace(new RegExp(_searchInput.val().toLowerCase(), 'i\g'), '<b>$&</b>')
                        });
                    });
                },
                _construct = function () {
                    _onEvent();
                    _obj[0].obj = _self;
                };
        _self.close = function () {
            _hidePanel();
        };
        _construct();
    };

    function initTexfieldsLabels() {
        var field = $('.textfield');
        field.focus(function () {
            $(this).parent().addClass('active').removeClass('not-valid');
        });
        field.blur(function () {
            if ($(this).val() == '') {
                $(this).parent().removeClass('active');
            }
        });
    }

    function initReplies() {
        $('#reviews').on('click', '.js-reply-btn', function (e) {
            var replyReview = $(this).closest('.reply.review');
            if (replyReview.length > 0 && replyReview.find('.reply-data-holder').length > 0) {
                var userName = $(this).parent().parent().parent().find('.review-name').text();
                $(this).parent().parent().find('textarea').val('@' + userName + ' ');
            }
            $(this).parent().next().slideToggle();
            return false;
        });
    }

    function initMoboleBonusesPop(_ww) {
        var _container = $('.list-item, .pick');
        var _mobilePop = $('.js-mobile-pop');
        var _btnOpen = $('.btn-round');
        var _btnClose = $('.js-mobile-pop-close');
        var _position = 0;

        if (_ww <= 690) {
            _btnOpen.off('click');

            function cloneContent(_this) {
                var _contentHolder = _this.closest(_container).find('.list-item-cell-buttons');
                var _name = _this.data('name');
                var _is_free = _this.data('is-free');
                var _request = new XMLHttpRequest();

                _request.abort();
                _request = $.ajax({
                    url: "/casino/bonus",
                    data: {
                        casino: _name,
                        is_free: _is_free,
                    },
                    dataType: 'html',
                    type: 'GET',
                    success: function (response) {
                        $(response).insertAfter(_contentHolder);

                        var _mobilePop = _this.closest(_container).find('.js-mobile-pop');
                        _mobilePop.find('.js-tooltip').tooltipster(tooltipConfig);
                        _mobilePop.find('.js-copy-tooltip').tooltipster(copyTooltipConfig);
                        var _btnClose = _mobilePop.find('.js-mobile-pop-close');
                        checkStringLength($('.bonus-box'), 21);
                        copyToClipboard();

                        $('.overlay, .loader').fadeOut('fast');
                        _mobilePop.fadeIn('fast').fadeIn('fast');
                        lockScreen();
                        _btnClose.on('click', function (e) {
                            _mobilePop.fadeOut('fast')
                                    .find('.mobile-popup-body')
                                    .html('');
                            unlockScreen();
                            $('.overlay, .loader').fadeOut('fast');

                            goToPosition(_position);
                            $(_mobilePop).remove();
                            return false;
                        });
                    }
                });
            }

            _btnOpen.on('click', function (e) {
                _position = $(window).scrollTop();
                $('.overlay, .loader').fadeIn('fast');
                cloneContent($(this));
                return false;
            });
        }
    }

    function strip(html) {
        var tmp = document.createElement("DIV");
        tmp.innerHTML = html;
        return tmp.textContent || tmp.innerText || "";
    }

    function copyToClipboard() {
        window.Clipboard = (function (window, document, navigator) {
            var textArea, copy;

            function isOS() {
                return navigator.userAgent.match(/ipad|iphone/i);
            }

            function createTextArea(text, self) {
                textArea = document.createElement('textArea');
                if (isOS()) {
                    textArea.setAttribute('readonly', 'readonly');
                }
                textArea.value = text;
                self.parent().append(textArea);
            }

            function selectText() {
                var range,
                        selection;

                if (isOS()) {
                    range = document.createRange();
                    range.selectNodeContents(textArea);
                    selection = window.getSelection();
                    selection.removeAllRanges();
                    selection.addRange(range);
                    textArea.setSelectionRange(0, 999999);
                } else {
                    textArea.select();
                }
            }

            function copyToClipboard(self) {
                document.execCommand('copy');
                self.parent().find(textArea).remove();
            }

            copy = function (text, self) {
                var strippedText = strip(text);
                createTextArea(strippedText, self);
                selectText();
                copyToClipboard(self);
            };

            return {
                copy: copy
            };
        })(window, document, navigator);

        $('.js-copy-to-clip').on('click touch', function (e) {
            Clipboard.copy($(this).data('code'), $(this));
            e.preventDefault();
        });
    }

    function initMobileMenu() {
        var btn = $('#js-mobile-menu-opener, #js-mobile-menu-close');
        var menu = $('.header-menu');
        var position = null;
        var _window = $('html, body');

        btn.on('click', function (e) {
            $('body').toggleClass('menu-opened');
            btn.toggleClass('active');

            if (checkIfIsMobileDevice()) {
                position = $(window).scrollTop();
                if (_window.hasClass('no-scroll')) {
                    lockScreen();
                } else {
                    unlockScreen();
                    goToPosition(position);
                }

                $('.expand-menu__list-item.active ').closest('.expand-holder').addClass('opened');
            }

            $(document).on('click touchstart', function (e) {
                if ($(e.target).closest(menu).length == 0 && $(e.target).closest(btn).length == 0) {
                    $("body").removeClass('menu-opened');
                    if (checkIfIsMobileDevice()) {
                        unlockScreen();

                        goToPosition(position);
                    }
                    btn.removeClass('active');
                }
            });
            e.preventDefault();
        });
    }

    function goToPosition(_position) {
        $('html, body').animate({
            scrollTop: _position
        }, 5);
    }

    function initSearch() {
        var _container = $('.header-search');
        var _btnOpen = $('.js-search-opener', _container);
        var _btnMobileOpen = $('.js-mobile-search-opener');
        var _btnClose = $('.js-search-close', _container);
        var _btnMobileClose = $('.js-mobile-search-close');
        var _btnMobileClear = $('.js-mobile-search-clear');
        var _drop = $('.js-search-drop');
        var _input = $('.header-search-input input');
        var _position = 0;

        _btnOpen.on('click', function (e) {
            $('body').addClass('search-opened');
            _input.focus();

            searchDropOpen(_drop);

            $(document).on('click touchstart', function (e) {
                if ($(e.target).closest(_drop).length == 0
                        && $(e.target).closest(_input).length == 0
                        && $(e.target).closest(_btnMobileOpen).length == 0
                        && $(e.target).closest(_btnOpen).length == 0) {
                    _input.val("");
                    searchDropClose(_drop);
                }
            });
        });

        _input.on('keydown', function (e) {
            if (e.keyCode != 13) {
                isSearchResultEvent = true;
                searchDropOpen(_drop);
            } else {
                isSearchResultEvent = false;
            }
        });

        _btnClose.on('click', function (e) {
            searchDropClose(_drop);
        });

        _btnMobileOpen.on('click', function (e) {
            _position = $(window).scrollTop();
            $('body').addClass('mobile-search-opened');
            lockScreen();
            _input.focus();
        });

        _btnMobileClose.on('click', function (e) {
            _input.val('').blur();
            $('body').removeClass('mobile-search-opened');
            unlockScreen();

            goToPosition(_position);
        });

        _btnMobileClear.on('click', function () {
            _input.val('').focus();
        });

        _input.on('focus', function () {
            goToPosition(0);
        });

        _drop.on('scroll', function (event) {
            _input.blur();
        });
    }

    function detectIsKeyboardOpened() {
        $(document).on('focus', 'input, textarea', function () {
            $('body').addClass('kbopened');
        });

        $(document).on('blur', 'input, textarea', function () {
            $('body').removeClass('kbopened');
        });
    }

    function lockScreen() {
        $('html, body').addClass('no-scroll');
    }

    function unlockScreen() {
        $('html, body').removeClass('no-scroll');
    }

    function searchDropOpen(_drop) {
        setTimeout(function () {
            _drop.slideDown('fast');
        }, 300);
    }

    function searchDropClose(_drop) {
        _drop.slideUp('fast');
        setTimeout(function () {
            $('body').removeClass('search-opened');
        }, 300);
    }



    function initBarRating() {
        var container = $('.rating-container');
        var defRating = container.data('casino-rating');
        var user_rate = container.attr('data-user-rate');
        var ratingParams = {
            showSelectedRating: false,
            onSelect: function (value, text, event) {
                if (typeof event != 'undefined') {
                    var _this = $(event.currentTarget);
                    var _classes = 'terrible poor good very-good excellent';

                    $('.br-widget').children().each(function () {
                        $(this).unbind("mouseenter mouseleave mouseover click");
                        if (parseInt($(this).data('rating-value')) <= parseInt(user_rate)) {
                            $(this).addClass('br-active');
                        }
                    });
                    $('.br-widget').unbind("mouseenter mouseleave mouseover click");

                    _this
                            .closest(container)
                            .find('.rating-current-text')
                            .text(text)
                            .removeClass(_classes)
                            .attr("class", "rating-current-text " + getWebName(text));
                    _this
                            .closest(container)
                            .find('.rating-current-value span')
                            .text(value);
                    _this
                            .closest(container)
                            .find('.rating-current')
                            .attr('data-rating-current', value);
                    new Score({
                        value: value,
                        name: container.data('casino-name')
                    });
                }
            }
        };
        $('.rating-bar', container).barrating('show', ratingParams);
    }

    function getWebName(name) {
        return name.replace(/\s/g, '-').toLowerCase();
    }

    function initExpandingText() {

        $.fn.moreLines = function (options) {

            "use strict";

            this.each(function () {

                var element = $(this),
                        textelement = element.find("p"),
                        baseclass = "b-morelines_",
                        basejsclass = "js-morelines_",
                        currentclass = "section",
                        singleline = parseFloat(element.css("line-height")),
                        auto = 1,
                        fullheight = element.innerHeight(),
                        settings = $.extend({
                            linecount: auto,
                            baseclass: baseclass,
                            basejsclass: basejsclass,
                            classspecific: currentclass,
                            buttontxtmore: "more lines",
                            buttontxtless: "less lines",
                            animationspeed: auto
                        }, options),
                        ellipsisclass = settings.baseclass + settings.classspecific + "_ellipsis",
                        buttonclass = settings.baseclass + settings.classspecific + "_button",
                        wrapcss = settings.baseclass + settings.classspecific + "_wrapper",
                        wrapjs = settings.basejsclass + settings.classspecific + "_wrapper",
                        wrapper = $("<div>").addClass(wrapcss + ' ' + wrapjs).css({'max-width': element.css('width')}),
                        linescount = singleline * settings.linecount;

                element.wrap(wrapper);

                if (element.parent().not(wrapjs)) {

                    if (fullheight > linescount) {

                        element.addClass(ellipsisclass).css({'min-height': linescount, 'max-height': linescount, 'overflow': 'hidden'});

                        var moreLinesButton = $("<div>", {
                            "class": buttonclass,
                            click: function () {

                                element.toggleClass(ellipsisclass);
                                $(this).toggleClass(buttonclass + '_active');

                                if (element.css('max-height') !== 'none') {
                                    element.css({'height': linescount, 'max-height': ''}).animate({height: '100%'}, settings.animationspeed, function () {
                                        moreLinesButton.html(settings.buttontxtless);
                                    });

                                } else {
                                    element.animate({height: linescount}, settings.animationspeed, function () {
                                        moreLinesButton.html(settings.buttontxtmore);
                                        element.css('max-height', linescount);
                                    });
                                }
                            },
                            html: settings.buttontxtmore
                        });

                        element.after(moreLinesButton);

                    }
                }
            });

            return this;
        };

        $('.js-condense').moreLines({
            linecount: 3,
            baseclass: 'js-condense',
            basejsclass: 'js-condense',
            classspecific: '_readmore',
            buttontxtmore: "Read More",
            buttontxtless: "Read Less",
            animationspeed: 250
        });
    }



    function determineCasinoPage(key) {
        var page;
        if (key === 'new') {
            page = NEW_CURR_PAGE;
        } else if (key === 'best') {
            page = BEST_CURR_PAGE;
        } else if (key === 'country') {
            page = COUNTRY_CURR_PAGE;
        }
        return page;
    }

    function refresh() {
        $('.js-tooltip').tooltipster(tooltipConfig);
        $('.js-copy-tooltip').tooltipster(copyTooltipConfig);
        $('.js-tooltip-content').tooltipster(contentTooltipConfig);
        initMoboleBonusesPop(ww);
    }

    function raiseCasinoPage(key) {
        if (key === 'new') {
            NEW_CURR_PAGE++;
        } else if (key === 'best') {
            BEST_CURR_PAGE++;
        } else if (key === 'country') {
            COUNTRY_CURR_PAGE++;
        }
    }
})(jQuery);
