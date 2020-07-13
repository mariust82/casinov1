var AJAX_CUR_PAGE = 1;
var GAME_CURR_PAGE = 1;
var NEW_CURR_PAGE = 1;
var BEST_CURR_PAGE = 1;
var COUNTRY_CURR_PAGE = 1;
var BEST_BANKING_PAGE = 1;
var searched_value = '';
var isSearchResultEvent = false;

$.ajaxSetup({
    cache: true
});

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

function loadScripts(_scripts) {
    var version = $('.controller_main').data("version");
    $.each(_scripts, function(index, script) {
        if (!$("script[src='/public/build/js/compilations/assets/"+script+".js?v="+version+"']").length) {
            $("body").append($('<script defer type="text/javascript" src="/public/build/js/compilations/assets/'+script+'.js?v='+version+'"></script>"'));
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
    }
}

var initImageLazyLoad = function () {
    if (typeof imageDefer != "undefined") {
        imageDefer("lazy_loaded");
    }
};

(function ($) {
    BUSY_REQUEST = false;
    var ww = $(window).width();

    $(document).ready(function () {
        $(document).on('scroll mousemove', function(){
            loadScripts(['tooltipster', 'bindings', 'swiper', 'jquery-select2']);
            $(document).unbind("scroll mousemove");
            initToggleMenu();
            initSearch();
            initMobileBonusesPop(ww);
            new SearchPanel($('.header'));
            initTooltipseter();

            if ($('#filters').length > 0) {
                new Filters($('#filters'));
            }
            new newsletter($('.subscribe'));
        });

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
                    loadScripts(['search-tracker']);
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

        initImageLazyLoad();
    });

    $(document).ajaxComplete(function() {
        initImageLazyLoad();
    });

    //detect when scrolling is stoped
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
            var body = $('body');
            $(window).on('scroll', function () {
                if ($(window).scrollTop() > position && appended === false) {
                    body.append('<a rel="nofollow" target="_blank" class="btn-play-now" href="' + $('.btn-group-mobile .btn-middle').attr('href') + '">Play Now</a>');
                    body.addClass('play-now-appended');
                    appended = true;
                }
            });
        }
    }

    var initSite = function () {
        initExpandingText();
        copyToClipboard();
        checkStringLength($('.list .bonus-box'), 21);
        checkStringLength($('.bonus-item .bonus-box'), 33);
        grayscaleIE();

        $('.message .close').on('click', function (e) {
            $(this).parent().fadeOut();
            e.preventDefault();
        });

        $('.js-history-back').on('click', function (e) {
            window.history.back();
            e.preventDefault();
        });
    }

    function menuHoverAction() {
        if (!checkIfIsMobileDevice()) {
            $('.header-menu__list-holder .expand-holder').on('mouseout', function (e) {
                $('.expand-holder').removeClass('opened');
            })
        }
    }

    function checkStringLength(box, num) {
        $(box).each(function () {
            var child = $(this).find('.list-item-trun');
            var bubble = $(this).find('.bubble');

            if (child.text().length >= num) {
                bubble.css('visibility', 'visible');
            }
        });
    }

    function copyToClipboard() {
        window.Clipboard = (function (window, document, navigator) {
            var textArea,
                copy;

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

    function initExpandingText() {
        $.fn.moreLines = function (options) {

            "use strict";

            this.each(function () {

                var element = $(this),
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

    function validateEmail(email) {
        var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
        return pattern.test(email);
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

    function raiseCasinoPage(key) {
        if (key === 'new') {
            NEW_CURR_PAGE++;
        } else if (key === 'best') {
            BEST_CURR_PAGE++;
        } else if (key === 'country') {
            COUNTRY_CURR_PAGE++;
        }
    }

    //remove HTML tags from text
    function strip(html) {
        var tmp = document.createElement("DIV");
        tmp.innerHTML = html;
        return tmp.textContent || tmp.innerText || "";
    }
})(jQuery);
