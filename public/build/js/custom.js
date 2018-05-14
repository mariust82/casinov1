;(function($) {
    BUSY_REQUEST = false;
    var ww = $(window).width();

    $(document).ready(function() {
        initSite();
        initMobileMenu();
        new SearchPanel ( $('.header') );
        
        var user_rate = $('.rating-container').data('user-rate');
        if (user_rate > 0) {
            $('.br-widget').children().each(function() {
                console.dir($(this).data('rating-value'));
                $(this).unbind("mouseenter mouseleave mouseover");
               if (parseInt($(this).data('rating-value')) <= parseInt(user_rate)) {
                   $(this).addClass('br-active');
               }
            });
            $('.br-widget').unbind("mouseenter mouseleave mouseover");
        }   
        
    });
    
    var windowToBottom = 0;
    
    $(window).on('scroll', function(){
        
        //scroll down
        if (windowToBottom < $(window).scrollTop()) {
            $('.header').removeClass('site__header_sticky');
            windowToBottom = $(window).scrollTop();
        //scroll up
        } else { 
            if ( (windowToBottom - $(window).scrollTop()) > ($(window).height() / 3) ) {
                $('.header').addClass('site__header_sticky');
                windowToBottom = $(window).scrollTop();
            }
        }
        
         if ($(window).scrollTop() === 0) {
            $('.header').removeClass('site__header_sticky');
        }
    });

    $(window).resize(function(event) {
        ww = $(window).width();

        initMoboleBonusesPop(ww);
    });

    tooltipConfig = {
        trigger: 'click',
        maxWidth: 279,
        animation: 'grow',
        debug: false,
        // contentCloning: true
    };

    copyTooltipConfig = {
        trigger: 'click',
        maxWidth: 260,
        minWidth: 260,
        animation: 'grow',
        contentAsHTML: true,
        debug: false,
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
        interactive: true,
        contentAsHTML: true,
        debug: false,
        content: $('.loader'),
        animation: 'fade',
        contentCloning: false,
        functionReady: function(){
            $('body').addClass('shadow');
            checkStringLength($('.bonus-box'), 15);
            $('.js-tooltip').tooltipster(tooltipConfig);
        },
        functionAfter: function(){
            $('body').removeClass('shadow');
        },
        functionBefore: function(instance, helper) {
            
            var $origin = $(helper.origin);

            if ($origin.data('loaded') !== true) {

                var _name = $origin.data('name');
                var _is_free = $origin.data('is-free');
                var _request = new XMLHttpRequest();

                _request.abort();
                _request = $.ajax( {
                    url: "/casino/bonus",
                    data: {
                        casino: _name,
                        is_free: _is_free,
                    },
                    dataType: 'json',
                    type: 'GET',
                    success: function (response) {
                        if(response.status =="ok") {
                            instance.content(getBonusPattern(response, _name));
                            setTimeout(function(){
                                $('.js-tooltip').tooltipster(tooltipConfig);
                                $('.js-copy-tooltip').tooltipster(copyTooltipConfig);
                                copyToClipboard();
                                checkStringLength($('.bonus-box'), 15);
                            }, 50)
                        }
                        $origin.data('loaded', true);
                    }
                });
            }
        }
    };
    
    var initSite = function() {
        // setTimeout(function(){
        //     debugger;
        // }, 1000);

        // initMultirow();
        sliderInit();
        initExpandingText();
        initBarRating();
        initCustomSelect();
        initSearch();
        copyToClipboard();
        initMoboleBonusesPop(ww);
        initReviewForm();
        initReplies();
        initTexfieldsLabels();
        showMoreReviews();
        checkStringLength($('.list .bonus-box'), 21);
        checkStringLength($('.bonus-item .bonus-box'), 33);

        $('.message .close').on('click', function(e) {
            $(this).parent().fadeOut();
            e.preventDefault();
        });

        $('.js-history-back').on('click', function(e) {
            window.history.back();
            e.preventDefault();
        });

        if ($('#filters').length > 0) {
            new Filters ( $('#filters') );
        }

        if ($('#player-wrap').length > 0){
            initPlayerControls();
        }

        if ($('#reviews').length > 0){
            $('.review').each(function(i) {
                new AddingReview ( $(this) );
            });

            $('[href="#reviews"]').on('click', function() {
                initScrollTo($('#reviews'), 100);
                return false;
            });
        }

        if ($('.js-vote').length > 0) {
            new Vote ( $('.js-vote') );
        }

        if ($('.js-run-counter').length > 0) {
            var _name = $('.js-run-counter').data('name');
            runPlayCounter(_name);
        }

        if ($('.contact-form').length > 0) {
            new handleContactUs($( '.contact-form' ));
        }

        new newsletter($( '.subscribe' ));

        $('.js-tooltip').tooltipster(tooltipConfig);
        $('.js-copy-tooltip').tooltipster(copyTooltipConfig);
        $('.js-tooltip-content').tooltipster(contentTooltipConfig);
    }

    function getBonusPattern(data, name) {
        var _name = name;
        var _amount = data.body.bonus.amount;
        var _code = data.body.bonus.code;
        var _games_allowed = data.body.bonus.games_allowed;
        var _min_deposit = data.body.bonus.min_deposit;
        var _type = data.body.bonus.type;
        var _wagering = data.body.bonus.wagering;
        var _block_class = 'bonus-free';
        var _icon = 'icon-icon_bonuses';
        var _code_class = '';
        var _success_class = '';

        if (_type == 'First Deposit Bonus') {
            _block_class = 'bonus-first';
            _icon = 'icon-free-bonus-icon';
        };

        if (_type == 'Free Play') {
            _type = "Free Bonus";
        };

        if (_code != 'No code required') _code_class = 'js-copy-to-clip js-copy-tooltip';

        if (_min_deposit == ''){
            _min_deposit = 'Free';
            _success_class = 'success';

        };

        var pattern = '\
            <div class="tooltip-content '+_block_class+'">\
                <div class="tooltip-templates-heading">\
                    <div class="tooltip-templates-title">'+_name+' '+_type+'</div>\
                    <div class="tooltip-templates-button">\
                        <a href="/visit/'+getWebName(_name)+'" target="_blank" rel="nofollow" class="btn btn-small">VISIT CASINO</a>\
                    </div>\
                </div>\
                <div class="tooltip-templates-body">\
                    <div class="bonus-box">\
                        <div class="bonus-box-heading">\
                            <span>'+_amount+' '+_type+'</span>\
                        </div>\
                        <div class="bonus-box-body">\
                            <div class="bonus-box-btn dashed '+_code_class+'" data-code="'+_code+'">'+_code+'</div>\
                            <std:unset name="code_class"/>\
                            <ul class="bonus-box-list">\
                                <li>\
                                    <span class="bonus-box-list-label">Wagering</span>\
                                    <strong>'+_wagering+'</strong>\
                                </li>\
                                <li>\
                                    <span class="bonus-box-list-label">Games allowed</span>\
                                    <strong class="list-item-flex">\
                                        <span class="list-item-trun">'+_games_allowed+'</span>\
                                        <span class="bubble js-tooltip tooltipstered" title="'+_games_allowed+'">More</span>\
                                    </strong>\
                                </li>\
                                <li>\
                                    <span class="bonus-box-list-label">Min. deposit</span>\
                                    <strong class="'+_success_class+'">'+_min_deposit+'</strong>\
                                </li>\
                            </ul>\
                        </div>\
                        <div class="bonus-box-circle">\
                            <i class="'+_icon+'"></i>\
                        </div>\
                    </div>\
                </div>\
            </div>\
        ';

        return pattern;
    }

    function checkStringLength(box, num) {
        $(box).each(function(index, el) {
            var child = $(this).find('.list-item-trun');
            var bubble = $(this).find('.bubble');

            if (child.text().length >= num) {
                bubble.css('visibility', 'visible');
            }
        });
    }

    function newsletter(obj){
        var _wrap = obj,
            _field_email = _wrap.find('.news-email'),
            _send_btn = _wrap.find('.news-btn'),
            _contact_success = $('#news-success'),
            _contact_error = $('#news-note'),
            _contact_error_class = 'not-valid',
             email,
            _request = new XMLHttpRequest();

       _prepMessage = function(){
                email = _field_email.val();
                ok = true;

            if(email === '' || !validateEmail(email)){
                _field_email.parent().addClass(_contact_error_class);
                ok = false;
            } else {
                _field_email.parent().removeClass(_contact_error_class);
            }

           if(!ok) {
               _contact_error.show();
           } else {
               _contact_error.hide();
           }

            return ok;
        },

       _sendNews = function(email){
            _request.abort();
            _request = $.ajax( {
                url: "/newsletter/subscribe",
                data: {
                    email: email,
                },
                dataType: 'json',
                timeout: 20000,
                type: 'POST',
                success: function ( response ) {
                    if(response.status =="ok") {
                        _contact_success.show();
                        _contact_error.hide();
                        _send_btn.prop('disabled', true);
                        _field_email.val('');
                        _onEvents();
                    }
                    else if(response.status=="error") {
                        // console.error(response.body);
                        var arr = JSON.parse(response.body);

                        $('.action-added').remove();
                        $.each(arr, function(index, val) {
                            var $msg = '<div class="action-field action-added not-valid ">'+val+'</div>';
                            $('.review-submit-holder .msg-holder').append($msg);
                        });
                    }
                },
                error: function ( XMLHttpRequest ) {
                    console.error("Could not send message!");
                }
            });
        },

       _onEvents = function(){
            _send_btn.on({
                'click': function(e){
                   var error = _prepMessage();
                   if (error === false) {
                       e.stopPropagation();
                   } else {
                        _sendNews(email);
                   }
                }
            });
        },

       _init = function(){
            _onEvents();
        };

       _init();
    }

    function handleContactUs(obj){
        var _wrap = obj,
            _field_name = $('.contact-name'),
            _field_email = $('.contact-email'),
            _field_message = $('.contact-message'),
            _contact_btn = $('.contact-btn'),
            _contact_success = $('#contact-us-success'),
            _contact_error = $('#contact-us-note'),
            _server_error = $('#server-error-note'),
            _contact_error_class = 'not-valid',
             name,
             email,
             message,
            _request = new XMLHttpRequest();

       _prepContact = function(){
                name = _field_name.val();
                email = _field_email.val();
                message = _field_message.val();
                ok = true;
            if(name === '' || !_validateInputName(name)){
                _field_name.parent().addClass(_contact_error_class);
                ok = false;
            } else {
                _field_name.parent().removeClass(_contact_error_class);
            }
            if(email === '' || !validateEmail(email)){
                _field_email.parent().addClass(_contact_error_class);
                ok = false;
            } else {
                _field_email.parent().removeClass(_contact_error_class);
            }
            if(message === '' || !_validateInputMessage(message)){
                _field_message.parent().addClass(_contact_error_class);
                ok = false;
            } else {
                _field_message.parent().removeClass(_contact_error_class);
            }

           if(!ok) {
               _contact_error.show();
           } else {
               _contact_error.hide();
           }

            return ok;
        },

       _sendMessage = function(name, email, message){
            _request.abort();
            _request = $.ajax( {
                url: "/contact/send",
                data: {
                    name: name,
                    email: email,
                    message: message
                },
                dataType: 'json',
                timeout: 20000,
                type: 'POST',
                success: function ( response ) {
                    if(response.status =="ok") {
                        _contact_success.show();
                        _contact_error.hide();
                        _server_error.hide();
                        _contact_btn.prop('disabled', true);
                        _field_name.val('');
                        _field_email.val('');
                        _field_message.val('');
                        _onEvents();
                    }
                    else if(response.status=="error") {
                        // console.error(response.body);
                        var arr = JSON.parse(response.body);

                        _server_error.show();
                    }
                },
                error: function ( XMLHttpRequest ) {
                    console.error("Could not send message!");
                }
            });
        },

       _onEvents = function(){
            _contact_btn.on({
                'click': function(e){
                   var error = _prepContact();

                   if (error === false) {
                       e.stopPropagation();
                   } else {
                        _sendMessage(name, email, message);
                   }
                }
            });
        },

       _init = function(){
            _onEvents();
        };

       _init();
    }

    var Filters = function(obj) {
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
            _itemsPerPage = 25,
            _request = new XMLHttpRequest();

            if (typeof _paramName == 'undefined') {
                _paramName = 'game_type';
            }

            _url = _obj.data('url');

        var _onEvent = function() {
                _moreButton = $('.js-more-items');
                _resetButton = $('.js-reset-items');

                _switchers.off();
                _switchers.on('click', function() {
                    _ajaxRequestCasinos(_getAjaxParams(_paramName, _paramValue), 'replace');
                });

                _radios.off();
                _radios.on('click', function() {
                    _ajaxRequestCasinos(_getAjaxParams(_paramName, _paramValue), 'replace');
                });

                $('.js-filter > option').on('click', function() {
                    var counter = 0;
                    $('.js-filter > option').each(function(index, el) {
                        if ($(this).prop("selected")) {
                            counter++;
                        }
                    });
                });

                _selectFilter.off();
                _selectFilter.on('change', function() {
                    _ajaxRequestCasinos(_getAjaxParams(_paramName, _paramValue), 'replace');
                });

                _moreButton.off();
                _moreButton.on('click', function() {
                    _ajaxRequestCasinos(_getAjaxParams(_paramName, _paramValue, 'add'), 'add');

                    return false;
                });

                _resetButton.off();
                _resetButton.on('click', function() {
                    _ajaxRequestCasinos(_getAjaxParams(_paramName, _paramValue, 'reset'), 'add');

                    return false;
                });

            },

            _getAjaxParams = function (_paramName , _paramValue, _action) {
                var _ajaxDataParams = {};

                $.each(_switchers, function(index, el) {
                    if ($(el).is(':checked')) {
                    _ajaxDataParams[$(el).attr('name')] = 1;
                    }

                    if (_action == 'reset') {
                        _ajaxDataParams[$(el).attr('name')] = '';
                        $(el).prop('checked', false);
                    }
                });

                $.each(_radios, function(index, el) {
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

                    _itemsPerPage = 12;

                    if (_action == 'reset') {
                        _ajaxDataParams['software'] = '';

                    }
                }

                if( typeof AJAX_CUR_PAGE == "undefined" ) AJAX_CUR_PAGE = 0;
                AJAX_CUR_PAGE++;
                if (_action != 'add' || _action == 'reset') {
                    AJAX_CUR_PAGE = 0;
                }
                // _ajaxDataParams['page'] = AJAX_CUR_PAGE;

                return _ajaxDataParams;
            }

            _ajaxRequestCasinos = function(_ajaxDataParams, _action) {
                $('.overlay, .loader').fadeIn('fast');

                if (BUSY_REQUEST) return;
                BUSY_REQUEST = true;
                _request.abort();
                _request = $.ajax({
                    url: _url+AJAX_CUR_PAGE,
                    data: _ajaxDataParams,
                    dataType: 'html',
                    type: 'GET',
                    success: function(data) {
                        var cont = $(data).find('.loaded-item');
                        // var cont = $(data).filter('.loaded-item');

                        if (_action == 'replace') {
                            _targetContainer.html(data);
                            _targetAddContainer.html('');

                            var loadTotal = $(data).filter('[data-load-total]').data('load-total');

                            $('.qty-items span').text(loadTotal);

                            if (loadTotal > 0) {
                                $('[data-total]').data('total', loadTotal);
                            }

                            if (cont.length == 0) {
                                _moreButton.hide();
                                _loaderHolder.hide();
                                _emptyContent.show();
                            } else {
                                _moreButton.show();
                                _loaderHolder.show();
                                _emptyContent.hide();
                            }
                        } else {
                            _targetAddContainer.append(cont);
                        }

                        if (AJAX_CUR_PAGE >= Math.floor($('.data-add-container').data('total') / _itemsPerPage)) {
                            _moreButton.hide();
                        }

                        // initRateSlider();
                        // changeNumSize();
                        _construct();

                        $('.js-tooltip').tooltipster(tooltipConfig);
                        $('.js-copy-tooltip').tooltipster(copyTooltipConfig);
                        $('.js-tooltip-content').tooltipster(contentTooltipConfig);
                        initMoboleBonusesPop(ww);

                        checkStringLength($('.data-add-container .bonus-box, .data-container .bonus-box'), 21);
                    },
                    error: function(XMLHttpRequest) {
                        if (XMLHttpRequest.statusText != "abort") {
                            console.log('err');
                        }
                    },
                    complete: function() {
                        BUSY_REQUEST = false;
                        $('.overlay, .loader').fadeOut('fast');
                    }
                });

                var loadDelay = setTimeout(function() {
                }, 300);

                _hideLoading = function(){
                    clearTimeout(loadDelay);
                }
            },

            _loadData = function(data) {

            },
            _construct = function() {
                _onEvent();
                _obj[0].obj = _self;
            };

        _construct();
    };

    function goToPage(game_name, width, height) {
        window.open("http://game.casinoslists.com/game_play.php?game="+game_name+"&width="+width+"&height="+height,"_blank","toolbar=0,location=0,menubar=0,width="+width+",height="+height);
    }

    function goToFrame(url) {
        var frame = $('#single-play');
        var container = $('.player-holder');

        container.addClass('playing');
        frame.attr('src',url);
    }

    var reloadFrame = function(btnReload){
        var _init = function(){
            btnReload.on({
                click: function(){
                    _reload();
                }
            });
        };
        var _reload = function(){
            var frame = $('#single-play');
            var src = frame.attr('src');
            frame.attr('src', null);
            frame.attr('src', src);
        };
        
        _init();
    };

    function runPlayCounter(_name) {
        _request = new XMLHttpRequest;

        if(BUSY_REQUEST) return;
        BUSY_REQUEST = true;
        _request.abort();

        _request = $.ajax( {
            url: '/play-counter',
            data:{
                name: _name
            },
            dataType: 'json',
            type: 'post',
            success: function (data) {
            },
            error: function ( XMLHttpRequest ) {
                if ( XMLHttpRequest.statusText != "abort" ) {
                    console.log( 'err' );
                }
            },
            complete: function(){
                BUSY_REQUEST = false;
            }
        } );
    }

    function initPlayerControls() {
        var _btnFull = $('#play-fullscreen');
        var _btnReplay = $('#play-replay');
        var _btnGoPage = $('#go-to-page');
        var _btnGoFrame = $('#go-to-frame');
        var _container = $('#player-wrap');
        var _body = $('body');

        _btnGoFrame.on('click', function() {
            var _name = $(this).data('name');
            var _url = $(this).data('url');
            goToFrame(_url);
            runPlayCounter(_name);
            return false;
        });

        _btnGoPage.on('click', function() {
            var _name = $(this).data('name');
            var _width = $(this).data('width');
            var _height = $(this).data('height');
            goToPage(_name, _width, _height);
            runPlayCounter(_name);
            return false;
        });

        _btnReplay.on('click', function() {
            reloadFrame($(this));
            return false;
        });

        _btnFull.on('click', function() {
            _body.toggleClass('fullscreen');
            return false;
        });
    }

    function initReviewForm() {
        var field = $('.expanding');
        var hiddenBlocks = $('.js-expanding-textfields');

        field.on('focus', function() {
            $(this).removeClass('expanding');
            $(this).closest('.form').find(hiddenBlocks).slideDown();
        });
    }

    var Vote = function(obj) {

            var _obj = obj,
                _trigger = _obj.find('.vote-button'),
                _request = new XMLHttpRequest;

            var _init = function() {
                _trigger.off();
                _trigger.on('click', function() {
                    var _id = $(this).data('id');
                    var _success = $(this).data('success');
                    var _target = $(this).data('type');

                    _updateVote($(this), _getTarget(_target), _getData(_target, _id, _success));

                    return false;
                });

            },

            _getData = function(_target, _id, _success){
                var _ret = {id:_id};
                // if (_target == 'review') _ret.review_id = _id;
                // else _ret.article_id = _id;
                return _ret;
            }

            _getTarget = function(_arg) {
                var _target = '/casino/review-like';

                return _target;
            },

            _updateVote = function(_this, _target, _data){
                if(BUSY_REQUEST) return;
                BUSY_REQUEST = true;
                _request.abort();

                _request = $.ajax( {
                    url: _target,
                    data:_data,
                    dataType: 'json',
                    type: 'post',
                    success: function (data) {
                        //console.log(data.body.likes);
                        //var currentVotes = _this.find('.vote-block-num');
                        //currentVotes.text(parseInt(currentVotes.text())+1);
                        var _holderLikes = $(_this).find('.bubble-vote');
                        var _oldLikes = _holderLikes.text();
                        _holderLikes.text(++_oldLikes);

                        // _this.closest(_obj).next('.action-field.success').show();
                        //_this.parent().addClass('disabled');
                    },
                    error: function ( XMLHttpRequest ) {
                        if ( XMLHttpRequest.statusText != "abort" ) {
                            console.log( 'err' );
                            // _this.closest(_obj).next('.action-field.not-valid').show();
                        }
                    },
                    complete: function(){
                        BUSY_REQUEST = false;
                    }
                } );
            };
        _init();
    };

    function AddingReview(obj){

        this.obj = obj;
        var _wrap = obj,
            _imgDir = $('#reviews-form').data('img-dir'),
            _countryCode = $('#reviews-form').data('country'),
            _send_btn = _wrap.find('input[name=submit]'),
            _qty = $('.reviews-qty'),
            _contact_error_class = 'not-valid',
            _casinoID = $('.reviews-form').data('casino-id'),
            // _storage_name = localStorage.getItem('casino_'+_casinoID+'_name'),
            _storage_casino_id_reviewed = localStorage.getItem('casino_'+_casinoID+'_reviewed'),
            _storage_review_score = localStorage.getItem('casino_'+_casinoID+'_score'),
             _reviewID,
            _field_name,
            _field_email,
            _field_message,
            _contact_error_required,
            _contact_error_rate,
            _reviewHolder,
             name,
             email,
             message,
             _is_child,
             _is_child_of_child,
             _rate_slider_result,
             _childReplies,
            _request = new XMLHttpRequest();

       _prepReview = function(_self){

            var parent = _self;
            _field_name = parent.find('input[name=name]');
            _field_email = parent.find('input[name=email]');
            _field_message = parent.find('textarea[name=body]');
            _contact_error_required = parent.find('.field-error-required');
            _contact_error_rate = parent.find('.field-error-rate');
            _contact_error = parent.find('.field-error');
            name = _field_name.val();
            email = _field_email.val();
            message = _field_message.val();
            casino_name = $('.rating-container').data('casino-name');
            _rate_slider_result = $('.rating-current-value span').text();
            _reviewID = 0;
            ok = true;

            if (parent.data('id') != undefined) {
                _reviewID = parent.data('id');
                _is_child = true;


                if (parent.next().find('.reply-data-holder').length > 0) {
                    _reviewHolder = parent.next().find('.reply-data-holder');
                    _is_child_of_child = false;
                } else {
                    _is_child_of_child = true;
                    _reviewID = parent.closest('.reply').prev().data('id');
                    _setReviewerName(parent);
                    _reviewHolder = parent.closest('.reply-data-holder');
                }

                _childReplies = parent.find('.js-reply-btn span');
            } else {
                _is_child = false;
                _reviewHolder = $('#review-data-holder');
            }


            if(name === '' || !_validateInputName(name)){
                _field_name.parent().addClass(_contact_error_class);
                ok = false;
            } else {
                _field_name.parent().removeClass(_contact_error_class);
            }
            if(email === '' || !validateEmail(email)){
                _field_email.parent().addClass(_contact_error_class);
                ok = false;
            } else {
                _field_email.parent().removeClass(_contact_error_class);
            }
            if(message === '' || !_validateInputMessage(message)){
                _field_message.parent().addClass(_contact_error_class);
                ok = false;
            } else {
                _field_message.parent().removeClass(_contact_error_class);
            }


            if(!ok) {
                _contact_error_required.show();
            } else {
                _contact_error.hide();
                _contact_error_required.hide();
            }

            if (!_is_child) {
                if (_rate_slider_result === '0') {
                    _contact_error_rate.show();
                    parent.find($('.rating-container')).addClass(_contact_error_class);
                    ok = false;
                } else {
                    _contact_error_rate.hide();
                    parent.find($('.rating-container')).removeClass(_contact_error_class);
                }
            }

            return ok;
        },

        _setReviewerName = function(parent){
            var name = parent.find('.review-name').text();
            var pattern = '<strong>@'+name+'</strong> ';

            message = pattern+_field_message.val();
        },

        _changeName = function(){
            $('#reviews-form input[name=name]').on('keyup', function() {
                $('#reviews-form .review-name').text($(this).val());
            });
        },

        _prepAjaxData = function(_this){
            var ajaxData = {
                casino: casino_name,
                name: name,
                email: email,
                body: message,
                parent: _reviewID
            };

            _sendReview(ajaxData, _this);
        },

       _sendReview = function(ajaxData, _this){
            _request.abort();
            _request = $.ajax( {
                url: "/casino/review-write",
                data: ajaxData,
                dataType: 'json',
                timeout: 20000,
                type: 'POST',
                success: function ( data ) {
                    if(data.status =="ok") {
                        _loadData(data, _this);
                        // _send_btn.prop('disabled', true);
                        _field_name.val('');
                        _field_email.val('');
                        _field_message.val('').addClass('expanding');
                        _onEvents();
                        $('.form .js-expanding-textfields').slideUp();
                    }
                    else if(data.status=="error") {
                        console.error(data.body);
                        _errors_found = $.parseJSON(jqXHR.responseJSON.body);
                        _contact_error.html(_errors_found.join('<br />')).show();
                    }
                },
                error: function ( jqXHR ) {
                    _errors_found = $.parseJSON(jqXHR.responseJSON.body);
                    console.error("Could not send message!");
                    _contact_error.html(_errors_found.join('<br />')).show();
                }
            });
        },

        _loadData = function(data, _this) {

            if ($.isEmptyObject(data)) {
                _showEmptyMessage();
            } else {

                function getItemPattern() {
                    var pattern;

                    if (_is_child) {
                        pattern = '\
                        <div class="review review-child '+name.toLowerCase()+'" data-id="'+data.body.id+'" data-img-dir="'+_imgDir+'">\
                            <div class="review-wrap">\
                                <div class="review-info">\
                                    <div class="review-info-top">\
                                        <div class="review-flag">\
                                            <img src="'+_imgDir+'" alt="'+_countryCode+'" width="15" height="12">\
                                        </div>\
                                        <div class="review-info-body">\
                                            <div class="review-name">'+name+'</div>\
                                            <div class="review-date">'+_getCurrDate()+'</div>\
                                        </div>\
                                    </div>\
                                </div>\
                                <div class="review-body">\
                                    <div class="review-text">\
                                        <p>'+message+'</p>\
                                    </div>\
                                    <div class="review-underline">\
                                        <a href="#" class="review-replies js-reply-btn">Reply</a>\
                                        <div class="votes js-vote">\
                                            <a href="#" class="votes-like vote-button" data-id="'+data.body.id+'">\
                                                <i class="icon-icon_likes"></i>\
                                                <span class="bubble bubble-vote">0</span>\
                                            </a>\
                                        </div>\
                                    </div>\
                                    <div class="review-form">\
                                        <div class="form">\
                                            <div class="form-row">\
                                                <div class="textfield-holder">\
                                                    <textarea rows="5" class="expanding textfield" name="body" placeholder="Write your review..."></textarea>\
                                                </div>\
                                            </div>\
                                            <div class="hidden js-expanding-textfields">\
                                                <div class="form-row form-multicol">\
                                                    <div class="form-col">\
                                                        <div class="textfield-holder error">\
                                                            <input type="text" name="name" class="textfield" placeholder="Name">\
                                                        </div>\
                                                    </div>\
                                                    <div class="form-col">\
                                                        <div class="textfield-holder error">\
                                                            <input type="text" name="email" class="textfield" placeholder="Email (it won\'t be published)">\
                                                        </div>\
                                                    </div>\
                                                </div>\
                                                <div class="form-row">\
                                                    <div class="review-submit-holder">\
                                                        <input class="btn" name="submit" type="submit" value="ADD YOUR REPLY">\
                                                        <div>\
                                                            <div class="field-error-required not-valid action-field">\
                                                                Please fill in the required fields.\
                                                            </div>\
                                                            <div class="field-success success action-field">\
                                                                Thank You!\
                                                            </div>\
                                                        </div>\
                                                    </div>\
                                                </div>\
                                            </div>\
                                        </div>\
                                    </div>\
                                </div>\
                            </div>\
                        </div>\
                        ';
                    } else {
                        pattern = '\
                        <div class="review review-parent '+name.toLowerCase()+'" data-id="'+data.body.id+'">\
                            <div class="review-wrap">\
                                <div class="review-info">\
                                    <div class="review-info-top">\
                                        <div class="review-flag">\
                                            <img src="'+_imgDir+'" alt="'+_countryCode+'" width="15" height="12">\
                                        </div>\
                                        <div class="review-info-body">\
                                            <div class="review-name">'+name+'</div>\
                                            <div class="review-date">'+_getCurrDate()+'</div>\
                                        </div>\
                                    </div>\
                                    <div class="list-rating '+getWebName(get_rating(_rate_slider_result))+'">\
                                        <div class="list-rating-wrap">\
                                            <div class="list-rating-score">'+_rate_slider_result+'</div>\
                                            <div class="list-rating-text">'+get_rating(_rate_slider_result)+'</div>\
                                        </div>\
                                    </div>\
                                </div>\
                                <div class="review-body">\
                                    <div class="review-text">\
                                        <p>'+message+'</p>\
                                    </div>\
                                    <div class="review-underline">\
                                        <a href="#" class="review-replies js-reply-btn">Reply</a>\
                                        <div class="votes js-vote">\
                                            <a href="#" class="votes-like vote-button"  data-id="'+data.body.id+'">\
                                                <i class="icon-icon_likes"></i>\
                                                <span class="bubble bubble-vote">0</span>\
                                            </a>\
                                        </div>\
                                    </div>\
                                    <div class="review-form">\
                                        <div class="form">\
                                            <div class="form-row">\
                                                <div class="textfield-holder">\
                                                    <textarea rows="5" class="expanding textfield" name="body" placeholder="Write your review..."></textarea>\
                                                </div>\
                                            </div>\
                                            <div class="hidden js-expanding-textfields">\
                                                <div class="form-row form-multicol">\
                                                    <div class="form-col">\
                                                        <div class="textfield-holder error">\
                                                            <input type="text" name="name" class="textfield" placeholder="Name">\
                                                        </div>\
                                                    </div>\
                                                    <div class="form-col">\
                                                        <div class="textfield-holder error">\
                                                            <input type="text" name="email" class="textfield" placeholder="Email (it won\'t be published)">\
                                                        </div>\
                                                    </div>\
                                                </div>\
                                                <div class="form-row">\
                                                    <div class="review-submit-holder">\
                                                        <input class="btn" name="submit" type="submit" value="ADD YOUR REPLY">\
                                                        <div>\
                                                            <div class="field-error-required not-valid action-field">\
                                                                Please fill in the required fields.\
                                                            </div>\
                                                            <div class="field-success success action-field">\
                                                                Thank You!\
                                                            </div>\
                                                        </div>\
                                                    </div>\
                                                </div>\
                                            </div>\
                                        </div>\
                                    </div>\
                                </div>\
                            </div>\
                        </div>\
                        <div class="reply review">\
                            <div class="reply-data-holder"></div>\
                        </div>\
                        ';
                    }

                    return pattern;
                }

                if (_is_child_of_child) {
                    $(getItemPattern()).insertAfter(_this)
                } else {
                    _reviewHolder.prepend(getItemPattern());
                }


                _refreshData();
            }
        },

        _refreshData = function(){
            if (!_is_child){
                _qty.text(parseInt(_qty.text())+1);

                localStorage.setItem('casino_'+_casinoID+'_reviewed', 1);
                // localStorage.setItem('casino_'+_casinoID+'_name', name);
                localStorage.setItem('casino_'+_casinoID+'_score', _rate_slider_result);
            }
            if (_is_child) _childReplies.text(parseInt(_childReplies.text())+1);

            // initReplies();
            $('.review-form').slideUp();
            initReviewForm();
            initTexfieldsLabels();

            new Vote ( $('.js-vote') );

            $('.review, .reply').each(function() {
                new AddingReview ( $(this) );
            });
        },

        _doIfReviewedAlready = function(){
            var formContainer = $('#reviews-form');

            // _changeName(_storage_name);
            $('.review-rating', formContainer).addClass('active');
            $('textarea', formContainer).addClass('disabled');
            $('.rating-bar').barrating('set', _storage_review_score);
            $('.rating-current-value span').text(_storage_review_score);
            $('textarea[name=body]', formContainer).attr('placeholder', 'You have already reviewed');
        },

        _initForms = function() {
            _send_btn.off();
            _send_btn.on({
                'click': function(e){
                   var error = _prepReview(_wrap);

                   if (error === false) {
                       e.stopPropagation();
                   } else {
                        _prepAjaxData(_wrap);
                   }
                }
            });
        },

       _onEvents = function(){
            if (_storage_casino_id_reviewed) {
                _doIfReviewedAlready();
                _initForms();
            } else {
                _initForms();
                _changeName();
            }
        },

       _init = function(){
            _onEvents();
        };

       _init();
    }

    function initScrollTo(_target, _offset) {

        if (typeof _target !== "undefined") {
            action(_target, _offset);
        } else {
            var btn = $('.js-scroll');

            btn.on('click', function(a) {
                var target = $($(this).attr('href'));
                // var targetOffset = target.offset().top;

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
        var _totalReviews = _btn.data('reviews');
        var _holderParent = $('#review-data-holder');
        var _holderMoreChild = $('.reply-data-holder');
        var _name = $('.rating-container').data('casino-name');
        var _request = new XMLHttpRequest;
        var currentReplyId

        _btn.on('click',  function() {
            _addReviews($(this), $(this).data('type'));
            return false;
        });

        var _addReviews = function(_this, _type){

            if(BUSY_REQUEST) return;
            BUSY_REQUEST = true;
            _request.abort();

            _request = $.ajax( {
                url: '/casino/more-reviews/'+getWebName(_name)+'/'+_this.data('page'),
                dataType: 'HTML',
                data:{
                    id:_this.data('id'),
                    type: _type
                },
                type: 'GET',
                success: function (data) {
                    if (_type == 'review') {
                        _holderParent.append(data);
                        if (_this.data('page') >= _this.data('total') / 5) {
                            _this.hide();
                        }
                    } else if (_type == 'reply') {
                        _this.closest('.reply').find(_holderMoreChild).append(data);
                    }

                    if (_this.data('page') >= _this.data('total') / 5) {
                        _this.hide();
                    }

                    var _page = _this.data('page');

                    _this.data('page', ++_page);

                    _refreshData();
                },
                error: function ( XMLHttpRequest ) {
                    if ( XMLHttpRequest.statusText != "abort" ) {
                        console.log( 'err' );
                    }
                },
                complete: function(){
                    BUSY_REQUEST = false;
                }
            } );
        },

        _refreshData = function(){
            // initReplies();
            initReviewForm();
            initTexfieldsLabels();

            new Vote ( $('.js-vote') );
            $('.review').each(function() {
                new AddingReview ( $(this) );
            });
        };
    }

    function get_rating($name) {
        if ($name > 8) {
            $string = 'Excellent';
        } else if($name > 6 && $name <= 8){
            $string = 'Very good';
        } else if($name > 4 && $name <= 6){
            $string = 'Good';
        } else if($name > 2 && $name <= 4){
            $string = 'Poor';
        } else {
            $string = 'Terrible';
        }

        return $string;
    }

    var Score = function(obj) {

            var _obj = obj,
                _name = _obj.name,
                _score = _obj.value,
                _request = new XMLHttpRequest;

            var _init = function() {
                _updateScore(_name, _score);
            },

            _updateScore = function(_name, _score){
                if(BUSY_REQUEST) return;
                BUSY_REQUEST = true;
                _request.abort();

                _request = $.ajax( {
                    url: '/casino/rate',
                    data: {
                        name: _name,
                        value: _score
                    },
                    dataType: 'json',
                    type: 'post',
                    success: function (data) {
                        if (data.body['success'] == "Casino already rated!") {
                            $(".icon-icon_available").toggleClass("icon-icon_unavailable");
                            $(".icon-icon_unavailable").removeClass("icon-icon_available");
                            $('.thanx').html(data.body['success']);
                        }
                        $('.rating-container').next('.action-field').show();
                    },
                    error: function ( XMLHttpRequest ) {
                        if ( XMLHttpRequest.statusText != "abort" ) {
                            console.log( 'err' );
                        }
                    },
                    complete: function(){
                        BUSY_REQUEST = false;
                    }
                } );
            };
        _init();
    };

    var SearchPanel = function(obj) {
        var _obj = obj,
            _self = this,
            _searchButton = _obj.find('.js-trigger-search'),
            _searchAllButton = _obj.find('#search-all'),
            _searchContainer = _obj.find('#search'),
            _searchForm = _obj.find('#search-form'),
            _searchBody = _obj.find('.search-results'),
            _searchInput = _searchForm.find('input'),
            _searchUpdate = _searchForm.find('.js-mobile-search-clear'), // clear text
            _searchCasinosContainer = _searchContainer.find('#search-casinos ul'),
            _searchListsContainer = _searchContainer.find('#search-lists ul'),
            _searchPagesContainer = _searchContainer.find('#search-pages ul'),
            _searchEmptyContainer = _searchContainer.find('#search-empty'),

            _imgDir = _searchContainer.data('img-dir'),
            _loadNewContent = true,
            _loadMoreContent = false,

            _showMoreNum = 5,
            _fromCasinos = 1,
            _fromLists = 1,
            _fromPages = 1,

            loadDelay = 0,
            // scrollingBlock = $('.js-scrolling'),
            _request = new XMLHttpRequest();
            window.contentBeforeSearch;

        var _onEvent = function() {

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
                            if (_searchInput.val() != '') {
                                // location.href = '/search/advanced?value='+_searchInput.val();
                                // _searchInput.val('');
                                _ajaxRequestAdvanced();
                            }
                            _resetPages();
                        } else {
                            var searchPopup = _obj.find('#search__popup');
                            searchPopup.addClass('load');
                            _ajaxRequestPopup('/search');
                            _resetPages();
                        }

                        if (_searchInput.val() != '') {
                            _searchAllButton.parent().fadeIn();
                        } else {
                            _searchAllButton.parent().fadeOut();
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

                _searchAllButton.on(
                    'click',
                    function() {
                        if (_searchInput.val() != '') {
                            // location.href = '/search/advanced?value='+_searchInput.val();
                            // _searchInput.val('');
                            _ajaxRequestAdvanced();
                        }

                        return false;
                    }
                );
            },

            _closeSearch = function() {
                $('#site-content').html('').append(contentBeforeSearch);
                $('.js-search-drop').show();
                $('body').removeClass('advanced-search-opened');

                setTimeout(function(){
                    initSite();
                }, 1000);
            },

            _initMoreButtons = function() {
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
                    function() {
                        _ajaxMore('/search/more-lists/'+_fromLists, $('.search-title span').text(), $('#all-lists-container'), 'lists');
                        _loadMoreContent = true;
                        
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
                    function() {
                        _ajaxMore('/search/more-casinos/'+_fromCasinos, $('.search-title span').text(), $('#all-casinos-container'), 'casinos');
                        _loadMoreContent = true;
                        
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
                    function() {
                        _ajaxMore('/search/more-games/'+_fromPages, $('.search-title span').text(), $('#all-games-container'), 'games');
                        _loadMoreContent = true;
                        
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

            _clearSearchBody = function() {
                _searchListsContainer.empty();
                _searchCasinosContainer.empty();
                _searchPagesContainer.empty();
            },

            _ajaxMore = function(target, val, container, type) {
                if (BUSY_REQUEST) return;
                BUSY_REQUEST = true;
                _request.abort();
                _request = $.ajax({
                    url: target,
                    data: {
                        value: val
                    },
                    dataType: 'json',
                    type: 'GET',
                    success: function(data) {
                        _hideLoading();
                        _loadMoreData(data, container, type);
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
                    // _searchContainer.addClass('loading');
                }, 300);

                _hideLoading = function(){
                    clearTimeout(loadDelay);
                    // _searchContainer.removeClass('loading');
                }
            },

            _ajaxRequestAdvanced = function() {
                var _response_container = $('#site-content');
                if (BUSY_REQUEST) return;
                BUSY_REQUEST = true;
                _request.abort();
                _request = $.ajax({
                    url: '/search/advanced',
                    data: {
                        value: _searchInput.val(),
                    },
                    dataType: 'HTML',
                    type: 'GET',
                    success: function(data) {
                        $('body').addClass('advanced-search-opened');
                        contentBeforeSearch = $('#site-content .main, #site-content .promo').detach();
                        _response_container.html(data);
                        _hidePopup();
                        _initMoreButtons();

                        _response_container.find('#js-search-back').each(function() {
                            $(this).on({
                                click: function() {
                                    _closeSearch();
                                }
                            })
                        });

                        $('.js-mobile-search-close').on('click', function() {
                            _closeSearch();
                        });
                    },
                    error: function(XMLHttpRequest) {
                        if (XMLHttpRequest.statusText != "abort") {
                            console.log('err');
                        }
                    },
                    complete: function() {
                        BUSY_REQUEST = false;
                    }
                });
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
                        console.dir(data);
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
                    // _searchContainer.addClass('loading');
                }, 300);

                _hideLoading = function(){
                    clearTimeout(loadDelay);
                    // _searchContainer.removeClass('loading');
                }
            },

            getWebName = function(name) {
                return name.replace(/\s/g, '-').toLowerCase();
            },

            getItemPattern = function(itemData) {
                var pattern = '<li>\
                    <a class="search-results-label" href="/'+itemData.link+'">\
                        '+itemData.name+'\
                    </a>\
                </li>';

                return pattern;
            },

            _loadMoreData = function(data, container, type) {
                var items = data.body.results;
                console.dir(items);
                var link;
                if (type === 'lists') {
                    for (var i =0;i<items.length;i++) {
                        var _item = getItemPattern({
                            link: items[i]['url'],
                            name: items[i]['title']
                        });

                        container.append(_item);
                    }
                } else {
                    for (var item in items) {
                        if (type == 'games') {
                            link = 'play/'+getWebName(items[item]);
                        } else if(type == 'casinos') {
                            link = 'reviews/'+getWebName(items[item])+'-review';
                        }

                        var _item = getItemPattern({
                            link: link,
                            name: items[item]
                        });

                        container.append(_item);
                    }
                }
            },

            _loadData = function(data) {
                var lists = data.body.lists;
                console.dir(lists);
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

                        if (data.body.total_lists > 3 && Math.ceil(data.body.total_lists / 3) > _fromLists) {
                            // _searchMoreCasinos.show();
                        } else {
                            // _searchMoreCasinos.hide();
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
                            // _searchMoreCasinos.show();
                        } else {
                            // _searchMoreCasinos.hide();
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
                            // _searchMorePages.show();
                        } else {
                            // _searchMorePages.hide();
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
                    for (var i = 0; i< lists.length;i++) {

                        var _item = getItemPattern({
                            link: (lists[i]['url']),
                            name: lists[i]['title']
                        });
                        _searchListsContainer.append(_item);
                    }

                    for (var casino in casinos) {

                        var _item = getItemPattern({
                            link: 'reviews/'+getWebName(casinos[casino])+'-review',
                            name: casinos[casino]
                        });
                        _searchCasinosContainer.append(_item);
                    }

                    for (var page in pages) {

                        var _item = getItemPattern({
                            link: 'play/'+getWebName(pages[page]),
                            name: pages[page]
                        });

                        _searchPagesContainer.append(_item);
                    }
                }
                _illumination();
            },

            _resetPages = function() {
                _fromPages = 1;
                _fromCasinos = 1;
            },

            _showEmptyMessage = function(){
                _searchCasinosContainer.parent().hide();
                _searchPagesContainer.parent().hide();
                _searchEmptyContainer.show();
                _searchAllButton.parent().fadeOut();
            },
            _hideEmptyMessage = function(){
                _searchCasinosContainer.parent().show();
                _searchPagesContainer.parent().show();
                _searchEmptyContainer.hide();
            },
            _hidePopup = function() {
                searchDropClose($('.js-search-drop'));
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

    function initTexfieldsLabels() {
        var field = $('.textfield');

        field.focus(function() {
            $(this).parent().addClass('active').removeClass('not-valid');
        });

        field.blur(function() {
            if ($(this).val() == '') {
                $(this).parent().removeClass('active');
            }
        });
    }

    function initReplies() {
        $('#reviews').on('click', '.js-reply-btn', function(e) {
            $(this).parent().next().slideToggle();

            return false;
        });
    }

    function initMoboleBonusesPop(_ww) {
        var _container = $('.list-item');
        var _mobilePop = $('.js-mobile-pop');
        var _btnOpen = $('.js-mobile-pop-open');
        var _btnClose = $('.js-mobile-pop-close');

        _btnOpen.off('click');

        if (_ww <= 690) {

            function cloneContent(_this) {
                var _contentHolder = _this.closest(_container).find('.mobile-popup-body');
                var _items = _this.closest(_container).find('.js-tooltip-content');

                _items.each(function(index, el) {

                    var _name = $(el).data('name');
                    var _is_free = $(el).data('is-free');
                    var _request = new XMLHttpRequest();

                    _request.abort();
                    _request = $.ajax( {
                        url: "/casino/bonus",
                        data: {
                            casino: _name,
                            is_free: _is_free,
                        },
                        dataType: 'json',
                        type: 'GET',
                        success: function (response) {
                            if(response.status =="ok") {
                                _contentHolder.append(getBonusPattern(response, _name));

                                _contentHolder.find('.js-tooltip').tooltipster(tooltipConfig);
                                _contentHolder.find('.js-copy-tooltip').tooltipster(copyTooltipConfig);
                                checkStringLength($('.bonus-box'), 21);
                                copyToClipboard();
                                $('.overlay, .loader').fadeOut('fast');
                            }
                        }
                    });
                });
                
                showPop(_this);
            }

            function showPop(_this) {
                _this
                    .closest(_container)
                    .find(_mobilePop)
                    .fadeIn('fast');
            }

            _btnOpen.on('click', function(e) {
                $('.overlay, .loader').fadeIn('fast');
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
        // $('.js-filter').select2({
        //     minimumResultsForSearch: -1,
        //     dropdownCssClass: 'filters-sort-dropdown'
        // });

        var _filterOptions = $('.js-filter > option');

        $('.js-filter').select2MultiCheckboxes({
            templateSelection: function(selected, total) {
              // return "Selected " + selected.length + " of " + total;
              return "Game software";
            }
        })

        _filterOptions.prop("selected",false);
    };

    function initBarRating() {
        var container = $('.rating-container');
        var defRating = container.data('casino-rating');

        var ratingParams = {
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
                        .find('.rating-current-value span')
                        .text(value );

                    _this
                        .closest(container)
                        .find('.rating-current')
                        .attr('data-rating-current', value);

                    new Score ({
                        value: value,
                        name: container.data('casino-name')
                    });
                }
            }
        };

        // if (defRating > 0) {

        //     $('.rating-bar')
        //     .barrating('destroy')
        //     .prop('value', defRating)
        //     .barrating(ratingParams);

        //     $('.rating-current-value').html(defRating+'/10');
        // };

        $('.rating-bar', container).barrating('show', ratingParams);
    }

    function getWebName(name) {
        return name.replace(/\s/g, '-').toLowerCase();
    }

    function initExpandingText() {
        function cInit() {
           $('.js-condense').condense({
            condensedLength: 410,
            moreText: "Read More",
            lessText: "Read Less",
            ellipsis: "...",
            debug: false
           });
           if($().condense) {
            // $('.js-condense').next('.js-condense').fadeIn();

            $('.js-condense').css({
                maxHeight: '100%'
            });
           }
        }

        function cDestroy() {
            $('.js-condense').each(function(index, el) {
                if ($(this).hasClass('.cloned')) {
                    $(this).remove();
                } else {
                    $(this).show().attr('style', '').insertAfter('.condensedParent');
                    $(this).find('.condense_control').remove();
                    $('.condensedParent').remove();
                }
            });
        }

        cInit();

        var resizeTimer;
        $(window).resize(function(event) {
            clearTimeout(resizeTimer);
              resizeTimer = setTimeout(function() {
                cDestroy();
                cInit();
              }, 250);
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
        var swiperMain = new Swiper('#main-carousel', {
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

        var linksSwiperParams = {
            slidesPerView: 'auto',
            spaceBetween: 30,
            // virtualTranslate: false,
            allowTouchMove:false,
            slidesOffsetAfter:-220,
            on: {
                slideChangeTransitionStart: function (argument) {
                    $('.links-left').fadeIn('fast');
                },
                slideChangeTransitionEnd: function (argument) {

                    if (this.translate == 0) {
                        $('.links-left').fadeOut('fast');
                    }

                },
            },
            breakpoints: {
                1024: {
                    allowTouchMove:true,
                },
                690: {
                    spaceBetween: 15,
                    allowTouchMove:true,
                }
            }
        }

        var swiperLinks = new Swiper('.links-casinos #links-nav', linksSwiperParams);

        linksSwiperParams['slidesOffsetAfter'] = -330; //for games links slider
        var swiperLinks2 = new Swiper('.links-games #links-nav', linksSwiperParams);

        if ($(window).width() > 1024) {
            $('.links-casinos .links-nav a').on('mouseenter', function(e) {
                swiperAction($(this), e, swiperLinks);
            });

            $('.links-games .links-nav a').on('mouseenter', function(e) {
                swiperAction($(this), e, swiperLinks2);
            });

            function swiperAction(_this, _e, _id) {
                var container = _this.closest('.swiper-container');
                var curPosition = _e;

                if (curPosition.clientX > container.offset().left + (container.width()/1.3)) {
                    _id.slideNext(500);
                } else if (curPosition.clientX < container.offset().left + (container.width()/6)){
                    _id.slidePrev(500);
                }
            }
        }
    }

    function validateEmail(email){
        var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
        return pattern.test(email);
    }

    function _validateInputName(txt) {
         // var regex = /^[a-zA-Z0-9 ]+$/;
         // return regex.test(txt);

         if (txt != '') {
            return true;
         }
     }

    function _validateInputMessage(txt) {
         // var regex = /^[\w\.,:;!\s]+$/;
         // return regex.test(txt);

         if (txt != '') {
            return true;
         }
     }

    function _getCurrDate(){
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth()+1; //January is 0!
        var yyyy = today.getFullYear();

        return today = dd + '.' + mm + '.' + yyyy;
    }

})(jQuery);