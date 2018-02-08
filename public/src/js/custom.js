;(function($) {
    BUSY_REQUEST = false;

    $(document).ready(function() {
        // initMultirow();
        sliderInit();
        initExpandingText();
        initBarRating();
        initCustomSelect();
        initSearch();
        initMobileMenu();
        copyToClipboard();
        initMoboleBonusesPop();
        new SearchPanel ( $('.header-search') );

        tooltipConfig = {
            trigger: 'click',
            maxWidth: 279,
            animation: 'grow',
            contentCloning: true
        };

        copyTooltipConfig = {
            trigger: 'click',
            maxWidth: 260,
            minWidth: 260,
            animation: 'grow',
            contentAsHTML: true,
            functionBefore: function(instance, helper) {
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
            animation: 'grow',
            interactive: true,
            contentAsHTML: true,
            functionReady: function(){
                $('body').addClass('shadow');
            },
            functionAfter: function(){
                $('body').removeClass('shadow');
            }
        };

        $('.js-tooltip').tooltipster(tooltipConfig);
        $('.js-copy-tooltip').tooltipster(copyTooltipConfig);
        $('.js-tooltip-content').tooltipster(contentTooltipConfig);

    });

    var SearchPanel = function(obj) {
        var _obj = obj,
            _self = this,
            _searchButton = _obj.find('.js-trigger-search'),
            _searchContainer = _obj.find('#search'),
            _searchForm = _obj.find('#search-form'),
            _searchBody = _obj.find('.search-results'),
            _searchInput = _searchForm.find('input'),
            _searchUpdate = _searchForm.find('.js-mobile-search-clear'), // clear text
            _searchCasinosContainer = _searchContainer.find('#search-casinos ul'),
            _searchPagesContainer = _searchContainer.find('#search-pages ul'),
            _searchEmptyContainer = _searchContainer.find('#search-empty'),
            // _searchMoreCasinos = _searchContainer.find('.js-search-more-casinos'),
            // _searchMorePages = _searchContainer.find('.js-search-more-pages'),
            _imgDir = _searchContainer.data('img-dir'),
            _loadNewContent = true,
            _loadMoreContent = false,
            _clickCounter = 0,
            _fromPages = 2,
            _fromCasinos = 2,
            loadDelay = 0,
            // scrollingBlock = $('.js-scrolling'),
            _request = new XMLHttpRequest();

        // window.contentBeforeSearch = $('.main').html();

        var _onEvent = function() {
                // _initSearch();

                _searchButton.on(
                    'click',
                    function() {
                        _ajaxRequestPopup('/search');
                        _resetPages();
                        return false;
                    });

                _searchInput.on({
                    'focus': function() {
                        _ajaxRequestPopup('/search');
                        _resetPages();
                    },
                    'keyup': function(e) {
                        if (e.keyCode == 27) {
                            _hidePanel();
                            _resetPages();
                        } else if (e.keyCode == 13) {
                            // _ajaxRequestPopup('/search/advanced.json');
                            location.href = "/search/advanced/?value="+_searchInput.val();
                            _resetPages();
                        } else {
                            var searchPopup = _obj.find('#search__popup');
                            searchPopup.addClass('load');
                            _ajaxRequestPopup('/search');
                            _resetPages();
                        }
                    }
                });

                _searchUpdate.on(
                    'click',
                    function() {
                        _searchInput.val('').focus();
                        _ajaxRequestPopup('/search');
                        _resetPages();
                        return false;
                    }
                );

                // _searchMorePages.on(
                //     'click',
                //     function() {
                //         _ajaxRequestPopup('/search/pages.json', _fromPages);
                //         _loadMoreContent = true;
                //         _fromPages++;
                //         return false;
                //     }
                // );

                // _searchMoreCasinos.on(
                //     'click',
                //     function() {
                //         _ajaxRequestPopup('/search/casinos.json', _fromCasinos);
                //         _loadMoreContent = true;
                //         _fromCasinos++;
                //         return false;
                //     }
                // );
            },

            _initSearch = function() {
                var btn = $('.js-trigger-search, .search-back');
                var searchForm = $('.search');
                var searchFormBody = $('.search-results, .search-box, .search-input', searchForm);

                btn.on('click', function(e) {
                    setTimeout(function() {
                        $('body').toggleClass('search-expanded');
                        searchForm.find('.search-textfield').focus();
                    }, 200);

                    $('.js-trigger-search').toggleClass('active');

                    searchForm.css({
                        'left': btn[0].getBoundingClientRect().right - searchForm.width(),
                        'right': 'auto'
                    });

                    $(document).on('click touchstart', function(e) {
                        if ($(e.target).closest(searchFormBody).length == 0 && $(e.target).closest(btn).length == 0) {
                            $("body").removeClass('search-expanded');
                            btn.removeClass('active');
                        }
                    });
                    e.preventDefault();
                });
            },
            _clearSearchBody = function() {
                _searchCasinosContainer.empty();
                _searchPagesContainer.empty();
            },
            _ajaxRequestPopup = function(target, page) {
                if (BUSY_REQUEST) return;
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
                    success: function(data) {
                        _hideLoading();
                        _loadData(data);
                    },
                    error: function(XMLHttpRequest) {
                        if (XMLHttpRequest.statusText != "abort") {
                            _hideLoading();
                            console.log('err');
                            _showEmptyMessage();
                        }
                    },
                    complete: function() {
                        _hideLoading();
                        BUSY_REQUEST = false;
                    }
                });

                var loadDelay = setTimeout(function() {
                    _searchContainer.addClass('loading');
                }, 300);

                _hideLoading = function(){
                    clearTimeout(loadDelay);
                    _searchContainer.removeClass('loading');
                }
            },

            _loadData = function(data) {
                var casinos = data.body.casinos;
                var pages = data.body.games;

                if (!_loadMoreContent) {
                    _clearSearchBody();
                }

                if ($.isEmptyObject(casinos) && $.isEmptyObject(pages)) {
                    _showEmptyMessage();
                } else {
                    _hideEmptyMessage();

                    if (!$.isEmptyObject(casinos)) {
                        _searchCasinosContainer
                            .parent()
                            .show()
                            .next()
                            .removeClass('single');

                        if (data.body.total_casinos > 3 && Math.ceil(data.body.total_casinos / 3) > _fromCasinos) {
                            // _searchMoreCasinos.show();
                        } else {
                            // _searchMoreCasinos.hide();
                            _fromCasinos = 2;
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
                            // _searchMorePages.show();
                        } else {
                            // _searchMorePages.hide();
                            _fromPages = 2;
                        }
                    } else {
                        _searchPagesContainer
                            .parent()
                            .hide()
                            .prev()
                            .addClass('single');
                    }

                    function getWebName(name) {
                        return name.replace(/\s/g, '_').toLowerCase();
                    }

                    function getItemPattern(itemData) {
                        var pattern = '<li>\
                            <a href="/'+itemData.link+'">\
                                '+itemData.name+'\
                            </a>\
                        </li>';


                        return pattern;
                    }

                    for (var casino in casinos) {

                        var _item = getItemPattern({
                            link: casinos[casino].url,
                            img: _imgDir + '/casino_logo_light/124x82/' + casinos[casino].code + '.png',
                            name: casinos[casino].name
                        });
                        _searchCasinosContainer.append(_item);
                    }

                    for (var page in pages) {

                        var _item = getItemPattern({
                            link: pages[page].url,
                            // img: _imgDir + '/top10_search_pages/' + getWebName(pages[page].name) + '.png',
                            name: pages[page].name
                        });

                        _searchPagesContainer.append(_item);
                    }
                }
                // _updateCustomScroll();
                _illumination();
            },

            _resetPages = function() {
                _fromPages = 2;
                _fromCasinos = 2;
            },

            _updateCustomScroll =function(){
                var headHeight = $('.search-box').outerHeight();
                var wh = $(window).height()-headHeight;
                if (wh > 652) {
                    wh = 652;
                }

                scrollingBlock.mCustomScrollbar('destroy');
                scrollingBlock.mCustomScrollbar('update');
                setTimeout(function() {
                    scrollingBlock.mCustomScrollbar({
                      set_height:wh,

                      scrollInertia: 0,
                      // autoHideScrollbar: true,
                      advanced: {
                          updateOnContentResize: true
                      }
                    });

                    if (_loadMoreContent) {
                        scrollingBlock.mCustomScrollbar("scrollTo", "bottom");
                    }
                    _loadMoreContent = false;
                }, 0);
            },
            _showEmptyMessage = function(){
                _searchCasinosContainer.parent().hide();
                _searchPagesContainer.parent().hide();
                _searchEmptyContainer.show();
            },
            _hideEmptyMessage = function(){
                _searchCasinosContainer.parent().show();
                _searchPagesContainer.parent().show();
                _searchEmptyContainer.hide();
            },
            _hidePopup = function() {
                $('body').removeClass('search-expanded');
                _loadNewContent = true;
            },
            _hidePanel = function() {
                _hidePopup();
            },
            _illumination = function() {
                var searchItems = _obj.find('.search-results-label');
                searchItems.each(function() {
                    $(this).html(function(_, html) {
                        return html.replace(new RegExp(_searchInput.val().toLowerCase(), 'i\g'), '<b>$&</b>')
                    });
                });
            },
            _construct = function() {
                _onEvent();
                _obj[0].obj = _self;
            };
        _self.close = function() {
            _hidePanel();
        };

        _construct();
    };

    function initMoboleBonusesPop() {
        var _container = $('.list-item');
        var _mobilePop = $('.js-mobile-pop');
        var _btnOpen = $('.js-mobile-pop-open');
        var _btnClose = $('.js-mobile-pop-close');

        function cloneContent(_this) {
            var _contentHolder = _this.closest(_container).find('.mobile-popup-body');
            var _items = _this.closest(_container).find('.tooltip-content');

            _items.each(function(index, el) {
                $(el).clone().appendTo(_contentHolder);
            });

            _contentHolder.find('.tooltip-content').each(function(index, el) {
                var tempText = $(el).find('.list-item-trun').text();
                $(el).find('.list-item-trun').next('.bubble').attr('title', tempText);
            });

            _contentHolder.find('.js-tooltip').tooltipster(tooltipConfig);
            _contentHolder.find('.js-copy-tooltip').tooltipster(copyTooltipConfig);
            copyToClipboard();
            showPop(_this);

        }

        function showPop(_this) {
            _this
                .closest(_container)
                .find(_mobilePop)
                .fadeIn('fast');
        }

        _btnOpen.on('click', function(e) {

            cloneContent($(this));
            return false;
        });

        _btnClose.on('click', function(e) {
            $(this)
                .closest(_mobilePop)
                .fadeOut('fast')
                .find('.mobile-popup-body')
                .html('');
                
            return false;
        });
    }


    function copyToClipboard() {
        var btn = $('.js-copy-to-clip');

        btn.on('click', function(e) {
            initAction(this);
            e.preventDefault();
        });

        function initAction(element) {
            var $temp = $('<input readonly>');
            $('body').append($temp);
            $temp.val($(element).data('code')).select();
            document.execCommand('copy');
            $temp.remove();
        }
    }

    function initMobileMenu() {
        var btn = $('#js-mobile-menu-opener, #js-mobile-menu-close');
        var menu =  $('.header-menu');

        btn.on('click',  function(e) {
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
        var _container = $('.header-search');
        var _btnOpen = $('.js-search-opener', _container);
        var _btnMobileOpen = $('.js-mobile-search-opener');
        var _btnClose = $('.js-search-close', _container);
        var _btnMobileClose = $('.js-mobile-search-close');
        var _btnMobileClear = $('.js-mobile-search-clear');
        var _drop = $('.js-search-drop');
        var _input = $('.header-search-input input');

        _btnOpen.on('click', function(e) {
            $('body').addClass('search-opened');
            _input.focus();

            searchDropOpen(_drop);

            $(document).on('click touchstart',function(e) {
                if ($(e.target).closest(_drop).length==0 
                    && $(e.target).closest(_input).length==0
                    && $(e.target).closest(_btnMobileOpen).length==0 
                    && $(e.target).closest(_btnOpen).length==0){
                    searchDropClose(_drop);
                }
            });
        });

        _btnClose.on('click', function(e) {
            searchDropClose(_drop);
        });

        _btnMobileOpen.on('click', function(e) {
            $('body').addClass('mobile-search-opened');
            _input.focus();
        });

        _btnMobileClose.on('click', function(e) {
            $('body').removeClass('mobile-search-opened');
        });

        _btnMobileClear.on('click', function() {
            _input.val('').focus();
        });
    }

    function searchDropOpen(_drop) {
        setTimeout(function(){
            _drop.slideDown('300');
        }, 300);
    }

    function searchDropClose(_drop) {
        _drop.slideUp('300', function() {
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

        var swiper = new Swiper('#links-nav', {
            slidesPerView: 'auto',
            spaceBetween: 30,
            freeMode: true
        });
    }

})(jQuery);