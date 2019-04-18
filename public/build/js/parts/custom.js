var AJAX_CUR_PAGE = 1;

(function($) {
    BUSY_REQUEST = false;
    var ww = $(window).width();

    $(document).ready(function() {
        initToggleMenu();
        initSite();
        initMobileMenu();
        new SearchPanel ( $('.header') );

        var user_rate = $('.rating-container').data('user-rate');

        console.log($('.box img.not-accepted').length);

        if($('.box img.not-accepted').length){
            $('.br-widget a').unbind("mouseenter mouseleave mouseover click");
        }else {


            if (user_rate > 0) {
                $('.br-widget').children().each(function () {
                    $(this).unbind("mouseenter mouseleave mouseover");
                    if (parseInt($(this).data('rating-value')) <= parseInt(user_rate)) {
                        $(this).addClass('br-active');
                    }
                });
                $('.br-widget').unbind("mouseenter mouseleave mouseover");
            }
        }

    });

    //detect when scrolling is stoped
    $.fn.scrollEnd = function(callback, timeout) {
      $(this).scroll(function(){
        var $this = $(this);
        if ($this.data('scrollTimeout')) {
          clearTimeout($this.data('scrollTimeout'));
        }
        $this.data('scrollTimeout', setTimeout(callback,timeout));
      });
    };
    //detect when scrolling is stopped
    
    var windowToBottom = 0;
    
    $(window).on('scroll', function(){
        
        //scroll down
        if (windowToBottom < $(window).scrollTop()) {
            $('body').removeClass('site__header_sticky');
            windowToBottom = $(window).scrollTop();
        //scroll up
        } else { 
            if ( (windowToBottom - $(window).scrollTop()) > ($(window).height() / 3) ) {
                $('body').addClass('site__header_sticky');
                windowToBottom = $(window).scrollTop();
            }
        }
        
         if ($(window).scrollTop() === 0) {
            $('body').removeClass('site__header_sticky');
        }
    });

    if ($(window).width() < 768) {
        $(window).scrollEnd(function(){
            if ($(window).scrollTop() !== 0) {
                $('body').addClass('site__header_sticky');
            }
        }, 800);

        if (/\/reviews\//.test(window.location.href) && $('.btn-group-mobile .btn-middle').length > 0) {
            var appended = false;
            var position = $(window).height() / 2 + $(window).scrollTop();
            $(window).on('scroll', function() {
                if ($(window).scrollTop() > position && appended === false) {
                    $('body').append('<a rel="nofollow" target="_blank" class="btn-play-now" href="' + $('.btn-group-mobile .btn-middle').attr('href') + '">Play Now</a>');
                    $('body').addClass('play-now-appended');
                    appended = true;
                }
            });
        }
    }

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
        grayscaleIE();
        initTableOpen();

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

    function initTableOpen() {
        $('.js-table-package-opener').on('click', function(e) {
            $(this).closest('tr').toggleClass('active');
            // $(this).closest('tr').find('td:last-child, td:nth-child(5)').show();
            e.preventDefault();
        });
    }

    function grayscaleIE() {
        if (getInternetExplorerVersion() >= 10){
            $('.not-accepted').each(function(){
                var el = $(this);
                el.css({"position":"absolute"}).wrap("<div class='img_wrapper' style='display: inline-block'>").clone().addClass('img_grayscale').css({"position":"absolute","z-index":"5","opacity":"0"}).insertBefore(el).queue(function(){
                    var el = $(this);
                    el.parent().css({"width":this.width,"height":this.height});
                    el.dequeue();
                });
                this.src = grayscaleIE10(this.src);
            });
            
            function grayscaleIE10(src){
                var canvas = document.createElement('canvas');
                var ctx = canvas.getContext('2d');
                var imgObj = new Image();
                imgObj.src = src;
                canvas.width = imgObj.width;
                canvas.height = imgObj.height; 
                ctx.drawImage(imgObj, 0, 0); 
                var imgPixels = ctx.getImageData(0, 0, canvas.width, canvas.height);
                for(var y = 0; y < imgPixels.height; y++){
                    for(var x = 0; x < imgPixels.width; x++){
                        var i = (y * 4) * imgPixels.width + x * 4;
                        var avg = (imgPixels.data[i] + imgPixels.data[i + 1] + imgPixels.data[i + 2]) / 3;
                        imgPixels.data[i] = avg; 
                        imgPixels.data[i + 1] = avg; 
                        imgPixels.data[i + 2] = avg;
                    }
                }
                ctx.putImageData(imgPixels, 0, 0, 0, 0, imgPixels.width, imgPixels.height);
                return canvas.toDataURL();
            };
        };
    }

    function getInternetExplorerVersion(){
        var rv = -1;
        if (navigator.appName == 'Microsoft Internet Explorer'){
            var ua = navigator.userAgent;
            var re  = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
            if (re.exec(ua) != null)
            rv = parseFloat( RegExp.$1 );
        }
        else if (navigator.appName == 'Netscape'){
            var ua = navigator.userAgent;
            var re  = new RegExp("Trident/.*rv:([0-9]{1,}[\.0-9]{0,})");
            if (re.exec(ua) != null)
            rv = parseFloat( RegExp.$1 );
        }
        return rv;
    };

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

        //map data to bonus box
        var pattern = $($('#bonus-box-tpl').html()).filter('.tooltip-content');
            pattern.addClass(_block_class);
            pattern.find('.tooltip-templates-title').text(_name+' '+_type);
            pattern.find('.tooltip-templates-button a').attr('href', '/visit/'+getWebName(_name)+'');
            pattern.find('.bonus-box-heading span').text(_amount+' '+_type);
            pattern.find('.bonus-box-btn.dashed')
               .addClass(_code_class)
               .attr('data-code', _code)
               .text(_code);
            pattern.find('.bonus-box-wagering').text(_wagering);
            pattern.find('.list-item-trun').text(_games_allowed);
            pattern.find('.bubble').attr('title', _games_allowed);
            pattern.find('.bonus-box-dep')
               .addClass(_success_class)
               .text(_min_deposit);
            pattern.find('.bonus-box-circle i').addClass(_icon);

        return pattern;
    }

    function checkIfIsMobileDevice(){

        var winsize= 0;
        $( window ).resize(function() {
            winsize = $(document).width()
        });

        if(winsize < 1000){
            return true;
        }

        if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {

            return true;
        }

        return false;
    }



    function initToggleMenu() {
        var targetNode = document.querySelector('.header-menu__list-holder');
        if (targetNode) {


            var isMobile =  checkIfIsMobileDevice();

            var eventL = isMobile ? 'click' : 'hover';

            targetNode.addEventListener( eventL, function(e) {
                var that = this,currentOpened,
                    currentTarget = e.target;
                while(currentTarget != that) {
                    if(currentTarget.classList.contains( 'expand-holder' )) {
                        currentOpened = document.querySelector('.expand-holder.opened');
                        if (currentOpened == currentTarget) {
                            var toggleSection = currentOpened.querySelector(".expand-menu");
                            currentOpened.classList.remove('opened');
                        }
                        else {
                            if(currentOpened) {
                                currentOpened.classList.remove('opened');
                                setTimeout(function(){
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
            _itemsPerPage = $('.list-item').length,
            _totalItems = $('.qty-items').data('load-total'),
            _clicks = Math.floor(_totalItems/_itemsPerPage);
            _currentClick = 0,
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

                    if (_action == 'reset') {
                        _ajaxDataParams['software'] = '';

                    }
                }

                if( typeof AJAX_CUR_PAGE == "undefined" ) AJAX_CUR_PAGE = 1;
                
                if (_action != 'add' || _action == 'reset') {
                    AJAX_CUR_PAGE = 0;
                }

                if(_ajaxDataParams["label"]!=undefined && _ajaxDataParams["label"]=="Mobile") {
                    _ajaxDataParams["compatibility"] = "mobile";
                    delete _ajaxDataParams.label;
                }

                return _ajaxDataParams;
            }

            _ajaxRequestCasinos = function(_ajaxDataParams, _action) {

                if (_action == 'add') {
                    _moreButton.addClass('loading');
                } else {
                    $('.overlay, .loader').fadeIn('fast');
                }

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
                        var loadTotal = $(data).filter('[data-load-total]').data('load-total');

                        if (_action == 'replace') {
                            _targetContainer.html(data);
                            _targetAddContainer.html('');

                            if (cont.length == 0 ) {
                                _moreButton.hide();
                                _loaderHolder.hide();
                                _emptyContent.show();
                            } else {
                                _moreButton.show();
                                _loaderHolder.show();
                                _emptyContent.hide();
                            }

                            if (loadTotal <= cont.length) {
                                _moreButton.hide();
                            }
                            refresh();
                            AJAX_CUR_PAGE = 1;
                            _currentClick = 0;
                        } else {
                            AJAX_CUR_PAGE++;
                            _currentClick++;
                            
                            setTimeout(function(){
                                _targetAddContainer.append(cont);
                                _moreButton.removeClass('loading');
                                refresh();

                                if(_currentClick >= _clicks){
                                    _moreButton.hide();
                                }
                            }, 1000)
                        }

                        _construct();

                        function refresh() {
                            $('.js-tooltip').tooltipster(tooltipConfig);
                            $('.js-copy-tooltip').tooltipster(copyTooltipConfig);
                            $('.js-tooltip-content').tooltipster(contentTooltipConfig);
                            initMoboleBonusesPop(ww);
                        }

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
                parent: _reviewID,
                invision_casino_id : $('.reviews-form').attr('data-invision-casino-id'),
                casino_id : $('.reviews-form').attr('data-casino-id')
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
                        $('.reviews-form').attr('data-invision-casino-id',data.body.review_invision_id);
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
                    //map data to comment
                    var pattern = $($('#comment-tpl').html()).filter('.review');

                        pattern.attr('data-id', data.body.id);
                        pattern.find('.review-flag img')
                               .attr({
                                'src': _imgDir,
                                'alt': _countryCode
                               });
                        pattern.find('.review-name').text(name);
                        pattern.find('.review-date').text(_getCurrDate());
                        pattern.find('.review-text p').text(message);
                        pattern.find('.js-vote a').attr('data-id', data.body.id);

                    if (_is_child) {
                        pattern.addClass(name.toLowerCase()+' review-child')
                               .attr('data-img-dir', _imgDir);
                        pattern.find('.list-rating').remove();
                    } else {
                        pattern.addClass(name.toLowerCase()+' review-parent');
                        pattern.find('.list-rating').addClass(getWebName(get_rating(_rate_slider_result)));
                        pattern.find('.list-rating-score').text(_rate_slider_result);
                        pattern.find('.list-rating-text').text(get_rating(_rate_slider_result));
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
                        if ( XMLHttpRequest.statusText != "abort" )
                        {
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
            _is_content_detached = false,

            _showMoreNum = 5,
            _fromCasinos = 1,
            _fromLists = 1,
            _fromPages = 1,

            loadDelay = 0,
            // scrollingBlock = $('.js-scrolling'),
            _request = new XMLHttpRequest();
        window.contentBeforeSearch;
        var nr_requests; // nr requests sent
        var nr_requests_completed; // nr requests completed

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
                        nr_requests = 0;
                        nr_requests_completed = 0;
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
                                _searchInput.blur();
                            }
                            _resetPages();
                        } else {
                            var searchPopup = _obj.find('#search__popup');
                            searchPopup.addClass('load');
                            nr_requests++;
                            // console.log("Nr_request = "+nr_requests);
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

                _searchInput.blur();
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
                        // _loadMoreContent = true;

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
                        // _loadMoreContent = true;

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
                window.scrollTo(0, 0);
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
                        if (!_is_content_detached) {
                            contentBeforeSearch = $('#site-content .main, #site-content .promo').detach();
                        }
                        _is_content_detached = true;
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
                if (BUSY_REQUEST && (nr_requests_completed == nr_requests)) // if nr request completed = nr request sent
                {
                    //  console.log("\n\n END \n\n");
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
                    success: function(data) {
                        // console.log("request succes " + _searchInput.val());
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
                    complete: function(data) {
                        // console.log('request complete');
                        _hideLoading();
                        nr_requests_completed++;
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
                    <a class="search-results-label" href="/'+itemData.link.replace("/games/","")+'">\
                        '+itemData.name+'\
                    </a>\
                </li>';

                return pattern;
            },

            _loadMoreData = function(data, container, type) {
                var items = data.body.results;
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
                    if (_searchInput.val() != '') {
                        _illumination();
                    }
                }
            },

            _resetPages = function() {
                _fromPages = 1;
                _fromCasinos = 1;
            },

            _showEmptyMessage = function(){
                _searchListsContainer.parent().hide();
                _searchCasinosContainer.parent().hide();
                _searchPagesContainer.parent().hide();
                _searchEmptyContainer.show();
                _searchAllButton.parent().fadeOut();
            },
            _hideEmptyMessage = function(){
                _searchListsContainer.parent().show();
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
        var _btnOpen = $('.btn-round');
        var _btnClose = $('.js-mobile-pop-close');

        if (_ww <= 690) {
            _btnOpen.off('click');

            function cloneContent(_this) {
                var _contentHolder = _this.closest(_container).find('.mobile-popup-body');
                var _heading = _this.closest(_container).find('.mobile-popup-title');
                var _items = _this.closest(_container).find('.js-tooltip-content');
                var _name = _this.data('name');
                var _is_free = _this.data('is-free');
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
                            $bonus = getBonusPattern(response, _name);
                            
                            if(_is_free) {
                                _contentHolder.prepend($bonus);
                            } else {
                                _contentHolder.append($bonus);
                            }

                            _heading.text($bonus.find('.tooltip-templates-title').text());

                            _contentHolder.find('.js-tooltip').tooltipster(tooltipConfig);
                            _contentHolder.find('.js-copy-tooltip').tooltipster(copyTooltipConfig);
                            checkStringLength($('.bonus-box'), 21);
                            copyToClipboard();
                            $('.overlay, .loader').fadeOut('fast');
                        }
                    }
                });
                
                showPop(_this);
            }

            function showPop(_this) {
                _this
                    .closest(_container)
                    .find(_mobilePop)
                    .fadeIn('fast');
                $('html, body').addClass('no-scroll');
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
                $('html, body').removeClass('no-scroll');
                return false;
            });
        }
    }

    //remove HTML tags from text
    function strip(html) {
       var tmp = document.createElement("DIV");
       tmp.innerHTML = html;
       return tmp.textContent || tmp.innerText || "";
    }

    function copyToClipboard() {
        window.Clipboard = (function(window, document, navigator) {
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

            copy = function(text, self) {
                var strippedText = strip(text);
                createTextArea(strippedText, self);
                selectText();
                copyToClipboard(self);
            };

            return {
                copy: copy
            };
        })(window, document, navigator);

        $('.js-copy-to-clip').on('click touch', function(e) {
            Clipboard.copy($(this).data('code'), $(this));
            e.preventDefault();
        });
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
                    _input.val("");
                    searchDropClose(_drop);
                }
            });
        });

        _input.on('keydown', function(e) {
            if (e.keyCode != 13) {
                searchDropOpen(_drop);
            }
        });

        _btnClose.on('click', function(e) {
            searchDropClose(_drop);
        });

        _btnMobileOpen.on('click', function(e) {
            $('body').addClass('mobile-search-opened');
            _input.focus();
        });

        _btnMobileClose.on('click', function(e) {
            _input.val('').focus();
            $('body').removeClass('mobile-search-opened');
        });

        _btnMobileClear.on('click', function() {
            _input.val('').focus();
        });
    }

    function searchDropOpen(_drop) {
        setTimeout(function(){
            _drop.slideDown('fast');
        }, 300);
    }

    function searchDropClose(_drop) {
        _drop.slideUp('fast');
        setTimeout(function(){
            $('body').removeClass('search-opened');
        }, 300);
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

        $.fn.moreLines = function (options) {

        "use strict";

            this.each(function(){

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
                    }, options ),
                    
                    ellipsisclass = settings.baseclass+settings.classspecific+"_ellipsis",
                    buttonclass = settings.baseclass+settings.classspecific+"_button",
                    wrapcss = settings.baseclass+settings.classspecific+"_wrapper",
                    wrapjs = settings.basejsclass+settings.classspecific+"_wrapper",
                    wrapper = $("<div>").addClass(wrapcss+ ' ' +wrapjs).css({'max-width': element.css('width')}),
                    linescount = singleline * settings.linecount;

                element.wrap(wrapper);

                if (element.parent().not(wrapjs)) {

                    if (fullheight > linescount) {

                    element.addClass(ellipsisclass).css({'min-height': linescount, 'max-height': linescount, 'overflow': 'hidden'});

                    var moreLinesButton = $("<div>", {
                        "class": buttonclass,
                        click: function() {

                            element.toggleClass(ellipsisclass);
                            $(this).toggleClass(buttonclass+'_active');

                            if (element.css('max-height') !== 'none') {
                                element.css({'height': linescount, 'max-height': ''}).animate({height:fullheight}, settings.animationspeed, function () {
                                    moreLinesButton.html(settings.buttontxtless);
                                });

                            } else {
                                element.animate({height:linescount}, settings.animationspeed, function () {
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
