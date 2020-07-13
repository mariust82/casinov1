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

function initTooltipseter() {
    $('.js-tooltip').tooltipster(tooltipConfig);
    $('.js-copy-tooltip').tooltipster(copyTooltipConfig);
    $('.js-tooltip-content').tooltipster(contentTooltipConfig);
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
        $(window).on('scroll mousemove', function(){
            loadScripts(['tooltipster', 'swiper', 'jquery-select2', 'bindings']);
            $(window).unbind("scroll mousemove");
        });

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

        $(window).on('scroll mousemove', function(){
            $(window).unbind("scroll mousemove");
            new SearchPanel($('.header'));
            initTooltipseter();
        });

        if (checkIfIsMobileDevice()) {
            loadScripts(['swiper']);
        }

        loadScripts(['Slider']);
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
        initSearch();
        copyToClipboard();
        initMobileBonusesPop(ww);
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

        $(window).on('scroll mousemove', function(){
            $(window).unbind("scroll mousemove");
            if ($('#filters').length > 0) {
                new Filters($('#filters'));
            }
            new newsletter($('.subscribe'));
        });

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
            _loadNewContent = true,
            _loadMoreContent = false,
            _is_content_detached = false,
            _showMoreNum = 5,
            _fromCasinos = 1,
            _fromLists = 1,
            _fromPages = 1,
            _request = new XMLHttpRequest();
        window.contentBeforeSearch;
        var nr_requests; // nr requests sent
        var nr_requests_completed; // nr requests completed

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
                        // _loadMoreContent = true;

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
                        _hideLoading();
                        _loadMoreData(data, container, type);
                    },
                    error: function (XMLHttpRequest) {
                        if (XMLHttpRequest.statusText != "abort") {
                            _hideLoading();
                            console.log('err');
                            _showEmptyMessage();
                        }
                    },
                    complete: function () {
                        _hideLoading();
                        BUSY_REQUEST = false;
                    }
                });

                var loadDelay = setTimeout(function () {
                }, 300);

                _hideLoading = function () {
                    clearTimeout(loadDelay);
                }
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
                if (BUSY_REQUEST && (nr_requests_completed == nr_requests)) // if nr request completed = nr request sent
                {
                    return;
                }
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
                        _hideLoading();
                        _loadData(data);

                    },
                    error: function (XMLHttpRequest) {
                        if (XMLHttpRequest.statusText != "abort") {
                            _hideLoading();
                            console.log('err');
                            _showEmptyMessage();
                        }
                    },
                    complete: function (data) {
                        _hideLoading();
                        nr_requests_completed++;
                        BUSY_REQUEST = false;
                    }
                });

                var loadDelay = setTimeout(function () {
                }, 300);

                _hideLoading = function () {
                    clearTimeout(loadDelay);
                }
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

                if (!_loadMoreContent) {
                    _clearSearchBody();
                }

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
                        if (!(data.body.total_lists > 3 && Math.ceil(data.body.total_lists / 3) > _fromLists)) {
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

                        if (!(data.body.total_casinos > 3 && Math.ceil(data.body.total_casinos / 3) > _fromCasinos)) {
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
                        if (!(data.body.total_pages > 3 && Math.ceil(data.body.total_casinos / 3) > _fromPages)) {
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

    function menuHoverAction() {
        if (!checkIfIsMobileDevice()) {
            $('.header-menu__list-holder .expand-holder').on('mouseout', function (e) {
                $('.expand-holder').removeClass('opened');
            })
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

    function refresh() {
        $('.js-tooltip').tooltipster(tooltipConfig);
        $('.js-copy-tooltip').tooltipster(copyTooltipConfig);
        $('.js-tooltip-content').tooltipster(contentTooltipConfig);
        initMobileBonusesPop(ww);
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
