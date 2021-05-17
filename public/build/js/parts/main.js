jQuery.migrateMute = true;
var AJAX_CUR_PAGE = 1;
var SCRIPTS_LOADED = false;
var STYLES_LOADED = false;
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
function loadScripts() {
    var version = $('.controller_main').data("version");
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker
            .register('/sw.js?v=' + version)
            .then(function () {
                console.log('SW registered!');
            });
    }
    if (!$("script[src='/public/build/js/compilations/defer.js?v="+version+"']").length) {
        $("body").append($('<script defer type="text/javascript" src="/public/build/js/compilations/defer.js?v='+version+'"></script>"'));
        SCRIPTS_LOADED = true;
    }

    initSite();
    initToggleMenu();
    initSearch();
    initTooltipseter();
    bindButtons();
    scrollToBlock();
    menuHoverAction();

    new SearchPanel($('.header'));

    if ($('#filters').length > 0) {
        new ListFilters($('#filters'));
    }

    if ($('.filter-filter').length > 0) {
        new ListFilters($('#filters'));
    }

    new newsletter($('.subscribe'));
}

function loadStyles() {
    var version = $('.controller_main').data("version");
    if (!$("link[href='/public/build/css/compilations/defer.css?v="+version+"']").length) {
        $("body").append($('<link rel="stylesheet" type="text/css" href="/public/build/css/compilations/defer.css?v='+version+'" media="all">"'));
        STYLES_LOADED = true;
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

        $('body').on('click', '.btn_visit', function(){
            feedbackPopup($(this));
        });

        //Load Defer Scripts and Binding
        if ($('.filter').length) {
            setTimeout(function() {
                if (!STYLES_LOADED) {
                    loadStyles();
                }

                if (!SCRIPTS_LOADED) {
                    loadScripts();
                }
            }, 3000);
        }

        $(document).one('scroll mousemove', function(){
            if (!STYLES_LOADED) {
                loadStyles();
            }

            if (!SCRIPTS_LOADED) {
                loadScripts();
            }
        });

        setStyleProps();

        // document.ontouchmove = function (e) {
        //     e.preventDefault();
        // }

        detectIsKeyboardOpened();
        initMobileLayoutOfTable();

        if (/iPhone|iPad|iPod/i.test(navigator.userAgent)) {
            $('html').addClass('ios-device');
        }

        initImageLazyLoad();
    });

    $(document).ajaxComplete(function() {
        initImageLazyLoad();
    });

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