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

function initMobileBonusesPop(_ww) {
    var _container = $('.block .container');
    var _btnOpen = $('.btn-round');
    var _position = document.body.scrollTop;

    if (_ww <= 690) {
        _btnOpen.off('click');

        function cloneContent(_this) {
            var _contentHolder = _this.closest(_container);
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
                    var _mobilePop =  $(response).insertAfter(_contentHolder);
                    _mobilePop.find('.js-tooltip').tooltipster(tooltipConfig);
                    _mobilePop.find('.js-copy-tooltip').tooltipster(copyTooltipConfig);
                    var _btnClose = _mobilePop.find('.js-mobile-pop-close');
                    checkStringLength($('.bonus-box'), 21);
                    copyToClipboard();

                    $('.overlay, .loader').fadeOut('fast');
                    _mobilePop.fadeIn('fast').fadeIn('fast');
                    var headBar = $('html, body').hasClass('site__header_sticky');
                    if(headBar) $('html, body').removeClass('site__header_sticky');
                    lockScreen();
                    _btnClose.on('click', function (e) {
                        $('body').addClass('site__header_sticky');
                        _mobilePop.fadeOut('fast')
                            .find('.mobile-popup-body')
                            .html('');
                        unlockScreen();
                        if(headBar)   $('html, body').addClass('site__header_sticky');

                        $('.overlay, .loader').fadeOut('fast');

                        goToPosition(_position);
                        _mobilePop.remove();
                        return false;
                    });
                }
            });
        }

        _btnOpen.on('click', function (e) {
            _position = $(window).scrollTop();
            $('.overlay, .loader').fadeIn('fast');
            cloneContent($(this));
            $('body').removeClass('site__header_sticky');
            return false;
        });
    }
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

function initToggleMenu() {
    var targetNode = document.querySelector('.header-menu__list-holder');
    if (targetNode) {
        var isMobile = checkIfIsMobileDevice();

        var eventL = isMobile ? 'click' : 'hover';

        targetNode.addEventListener(eventL, function (e) {

            var that = this, currentOpened,
                currentTarget = e.target;
            while (currentTarget != that) {
                if (currentTarget.classList.contains('expand-holder')) {
                    currentOpened = document.querySelector('.expand-holder.opened');
                    if (currentOpened == currentTarget) {
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
        _emptyContent = $('.empty-filters'),
        _loaderHolder = _obj.next('.data-container-holder').find('.holder'),
        _moreButton,
        _resetButton,
        _defaultButton = $('#default'),
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
                var qty_items = $('.qty-items');
                if (_action == 'replace') {
                    _targetContainer.html(data);
                    _targetAddContainer.html('');
                    qty_items.attr('data-load-total', loadTotal);
                    $('.qty-items-quantity').text(loadTotal);

                    if (cont.length === qty_items.attr('data-load-total')) {
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
                        initImageLazyLoad();

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
                initImageLazyLoad();
            }
        });

        var loadDelay = setTimeout(function () {
        }, 300);

        _hideLoading = function () {
            clearTimeout(loadDelay);
        }
    },
        _loadData = function (data) {

        },
        _construct = function () {
            _onEvent();
            _obj[0].obj = _self;
        };

    _construct();
};

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

