var AJAX_CUR_PAGE = 1;
var GAME_CURR_PAGE = 1;
var NEW_CURR_PAGE = 1;
var BEST_CURR_PAGE = 1;
var NDB_CURR_PAGE = 1;
var COUNTRY_CURR_PAGE = 1;
var BEST_BANKING_PAGE = 1;
var searched_value = '';
var isSearchResultEvent = false;

$.ajaxSetup({
    cache: true
});

function scrollToBlock() {
    $('body').on('click', 'a[href^="#"]', function() {
        var block = $(this).attr('href');

        if ($(block).length > 0) {
            $('html, body').animate({
                scrollTop: $(block).offset().top
            }, 400);
        }

        return false;
    });
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
        if (!$("script[src='/public/build/js/compilations/"+script+".js?v="+version+"']").length) {
            $("body").append($('<script defer type="text/javascript" src="/public/build/js/compilations/'+script+'.js?v='+version+'"></script>"'));
        }
    });
}
function loadStyles(_styles) {
    var version = $('.controller_main').data("version");
    $.each(_styles, function(index, style) {
        if (!$("link[href='/public/build/js/compilations/"+style+".js?v="+version+"']").length) {
            $("head").append($('<link rel="stylesheet" type="text/css" href="/public/build/css/compilations/'+style+'.css?v='+version+'" media="all">"'));
        }
    });
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

var initImageLazyLoad = function () {
    if (typeof imageDefer != "undefined") {
        imageDefer("lazy_loaded");
    }
};

(function ($) {
    BUSY_REQUEST = false;
    var ww = $(window).width();

    $(document).ready(function () {

        $('body').on('click', '.btn_visit', function(){
            feedbackPopup($(this));
        });
        
        //Load Defer Scripts and Binding
        if ($('.links-nav').length) {
            loadScripts(['bindings', 'assets/swiper']);
        }

        if (!$('.casino-review').length && $('.btn_visit').length) {
            loadScripts(['casino_review']);
        }
        
        if ($('.filter').length) {
            loadScripts(['assets/jquery-select2', 'filters']);
        }

        $(document).on('scroll mousemove', function(){
            loadStyles(['ion.rangeSlider']);
            loadScripts(['assets/ion.rangeSlider.min', 'assets/jquery-nicescroll', 'assets/tooltipster', 'assets/swiper', 'bindings']);
            $(document).unbind("scroll mousemove");

            initSite();
            initToggleMenu();
            initSearch();
            initTooltipseter();
            bindButtons();

            new SearchPanel($('.header'));

            if ($('#filters').length > 0) {
                new ListFilters($('#filters'));
            }

            if ($('.filter-filter').length > 0) {
                new ListFilters($('#filters'));
            }

            new newsletter($('.subscribe'));
        });
        initExpandingText();
        menuHoverAction();
        setStyleProps();
        setIframeAsResponsive();
        scrollToBlock();

        document.ontouchmove = function (e) {
            e.preventDefault();
        }

        detectIsKeyboardOpened();
        initMobileLayoutOfTable();
        responsiveTables();

        if (/iPhone|iPad|iPod/i.test(navigator.userAgent)) {
            $('html').addClass('ios-device');
        }

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

    $(".tf_flex").on('click',function() {
            var id = $(this).data('id');
            var _this = $(this);
            $.ajax({
                url: '/timeframe-tooltip',
                type: 'POST',
                data: {
                    id: id
                },
                dataType: 'html'
            })
            .done(function (data) {
                $(".software-tooltipster").remove();
                _this.append(data);
                CloseTFPopup();
            });
    });

    var windowToBottom = 5;
    $(window).on('scroll', function () {

        if (windowToBottom < $(window).scrollTop()) {
            //scroll down
            $('body').addClass('site__header_hidden');
            windowToBottom = $(window).scrollTop();
        } else {
            //scroll up
            if ((windowToBottom - $(window).scrollTop()) > ($(window).height() / 3)) {
                $('body').removeClass('site__header_hidden');
                windowToBottom = $(window).scrollTop();
            }
        }

        if ($(window).scrollTop() < 5) {
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

    function menuHoverAction() {
        if (!checkIfIsMobileDevice()) {
            $('.header-menu__list-holder .expand-holder').on('mouseout', function (e) {
                $('.expand-holder').removeClass('opened');
            })
        }
    }

    function CloseTFPopup() {
        $('.close_tf_wrap').on('click', function (e) {
            console.dir($(this).parent().parent().parent());
            $(this).parent().parent().parent().remove();
            e.stopPropagation();
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

    function initMobileLayoutOfTable() {
        var _table = $('.basic_table');
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

    // if a table have more than 2 columns and the table has class ".advanced_table"
    function responsiveTables(breakpoint) {
        breakpoint = breakpoint || '800px';
        if ($('.advanced_table').length > 0) {
            $('.advanced_table').each(function(i) {
                i++;
                var className = 'jrt-instance-' + i;
                var $this = $(this);
                $this.addClass('jrt');
                $this.addClass(className);
                var respondHtml = '<style type="text/css">\n';
                respondHtml +=
                    '@media only screen and (max-width:' +
                    breakpoint +
                    ')  {\n';
                if ($this.find('thead').length > 0) {
                    $this.find('thead th').each(function(i) {
                        var $tdText = $(this)
                            .text()
                            .replace(/\s+/g, ' ');
                        i++;
                        respondHtml +=
                            '\t.' +
                            className +
                            '>tbody>tr>td.jrt-cell-' +
                            i +
                            ':before { content: "' +
                            $tdText +
                            '"; }\n';
                    });
                }
                $this.find('tbody td').each(function(i) {
                    $(this).wrapInner( "<em></em>" );
                });
                $this.find('tbody > tr').each(function(i) {
                    var $this = $(this);
                    i++;
                    var arrColspan = [];
                    var modIndex = [];
                    $this.find('td').each(function(i, c, m) {
                        var $this = $(this);
                        i++;
                        if (modIndex > 0) {
                            modIndex[0];
                            i++;
                        }
                        if (arrColspan > 0) {
                            m = i + arrColspan.shift() - 1;
                            modIndex.splice(0, 1);
                            modIndex.push(m);
                            i = m;
                        }
                        if ($this.is('[colspan]')) {
                            c = parseInt($(this).prop('colspan'), 10);
                            arrColspan.push(c);
                        }
                        $this.addClass('jrt-cell-' + i);
                    });
                });
                if ($this.find('thead').length > 0) {
                    respondHtml += '}\n';
                    respondHtml += '</style>';
                    $this.before(respondHtml);
                }
            });
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
                    fullheight = element.innerHeight() - (parseInt($("p",  $(this)).first().css("margin-top")) * 2),
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
                    wrapper = $("<div>").addClass(wrapcss + ' ' + wrapjs);
                    singleline = (singleline / 1.6) + parseFloat(element.css("font-size"));
                    var linescount = singleline * settings.linecount;

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

                element.fadeIn();
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

    function setStyleProps() {
        var vh = window.innerHeight * 0.01;
        document.documentElement.style.setProperty('--vh', vh + 'px');

        $(window).on('resize', function () {
            var vh = window.innerHeight * 0.01;
            document.documentElement.style.setProperty('--vh', vh + 'px');
        });
    }

})(jQuery);
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
    } else if (key === 'ndb') {
        page = NDB_CURR_PAGE;
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
    } else if (key === 'ndb') {
        NDB_CURR_PAGE++;
    } else if (key === 'country') {
        COUNTRY_CURR_PAGE++;
    }
}