var AJAX_CUR_PAGE = 0;
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

var initImageLazyLoad = function () {
    if (typeof imageDefer != "undefined") {
        imageDefer("lazy_loaded");
    }
};
function changeViewElements(filterView,container,gridClass,listClass){
    var boxView = filterView.find('.icon-box_view'),
    listView = filterView.find('.icon-list_view'),
    filterViewBtn = filterView.find('.icon');
    filterViewBtn.click(function(event) {
        event.stopPropagation();
        event.stopImmediatePropagation();
        var $this = $(this);
        if($this.hasClass('icon-box_view') && listView.hasClass('active')){
            listView.removeClass('active');
            $this.addClass('active');
            container.removeClass(listClass);
            container.addClass(gridClass);
        }else if($this.hasClass('icon-list_view') && boxView.hasClass('active')){
            boxView.removeClass('active');
            $this.addClass('active');
            container.addClass(listClass);
            container.removeClass(gridClass);

        }
    });
}

(function ($) {
    BUSY_REQUEST = false;
    var ww = $(window).width();

    $(document).ready(function () {


        //Load Defer Scripts and Binding
        if ($('.links-nav').length) {
            loadScripts(['bindings', 'assets/swiper']);
        }
        loadScripts(['assets/jquery-select2', 'filters']);

        $(document).on('scroll mousemove', function(){
            loadStyles(['ion.rangeSlider']);
            loadScripts(['assets/ion.rangeSlider.min', 'assets/tooltipster', 'assets/swiper', 'bindings']);
            $(document).unbind("scroll mousemove");

            initSite();
            initToggleMenu();
            initSearch();
            initTooltipseter();
            bindButtons();

            new SearchPanel($('.header'));

            if ($('#filters').length > 0) {
                new Filters($('#filters'));
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

        document.ontouchmove = function (e) {
            e.preventDefault();
        }

        detectIsKeyboardOpened();
        initMobileLayoutOfTable();
        responsiveTables();

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
        if($('.filter').find('.view').length > 0){
            changeViewElements($('.filter .view'),$('.data-container-holder'),'grid_view','list-view');
        }
        gridViewBoxPopup();
        
            
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
    
    $(".list-item-flex").on('click',function(){     
        var id = $(this).data('id');
        $.ajax({    
            url: '/timeframe-tooltip',
            type: 'POST',
            data: {
                id: id              
            },
            dataType: 'html'
        })
        .done(function (data) {
           
        });
    });

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

    function menuHoverAction() {
        if (!checkIfIsMobileDevice()) {
            $('.header-menu__list-holder .expand-holder').on('mouseout', function (e) {
                $('.expand-holder').removeClass('opened');
            })
        }
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

function gridViewBoxPopup(){
    console.log('testing');
    if($('.open-popup-spec').length > 0){
        $('.open-popup-spec').click(function(){
            $(".welcome_package-popup-trigger").closest('.wp-title').find('.welcome_package-popup').removeClass('active');
            $(this).closest('.popup-spec').find('.popup-casino-spec').toggleClass('active');
            $('.open-popup-spec').not(this).closest('.popup-spec').find('.popup-casino-spec').removeClass('active');
        });
        $('.close-popup-spec').click(function(){
            $('.popup-casino-spec').removeClass('active');
        });
    }
    if($(".welcome_package-popup-trigger").length > 0){
        $(".welcome_package-popup-trigger").click(function(){
            $('.open-popup-spec').closest('.popup-spec').find('.popup-casino-spec').removeClass('active');
            $(this).closest('.wp-title').find('.welcome_package-popup').toggleClass('active');
            $(".welcome_package-popup-trigger").not(this).closest('.wp-title').find('.welcome_package-popup').removeClass('active');
        });
        $('.close-popup-wp').click(function(){
            $('.welcome_package-popup').removeClass('active');
        });
    }
}

