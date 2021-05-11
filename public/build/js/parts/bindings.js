var ww = $(window).width();

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

function closeCasinoPopup(container){
    $('.bonus-popup').find('.close_popup-wp').click(function(e){
        e.stopPropagation();
        $('.bonus-popup').remove();
    });
}

function feedbackPopup(_this) {
    var _request = new XMLHttpRequest();
    _request.abort();
    _request = $.ajax({
        url: "/casino/feedback-popup",
        data: {
            id: _this.data('casino-id')
        },
        dataType: 'HTML',
        timeout: 20000,
        type: 'POST',
        cache: false,
        success: function (data) {
            if($(data).filter('.cl-lightbox').data('show-popup') == 1) {
                $('body').append(data);
                $(".js-drag-rate").ionRangeSlider(rangeRatingConfig);
            }
        },
        error: function (jqXHR) {
            console.log(jqXHR);
        }
    });
}

function feedbackPopupNextStep(step, isFinal) {
    var slides = $('.cl-lightbox-slide');
    slides.hide();
    slides.eq(step - 1).show();
    
    if (isFinal) {
        setTimeout(function() {
            closeClLightbox();
        }, 3000);
    }
}

function showCasinoBonuses(){

    $('.js-bonus-trigger').click(function(e){
        e.stopPropagation();

        var _this = $(this);
        var _buttonPosition = _this.offset();
        if(_this.find('.bonus').length > 0){
            if($('body').find('.bonus-popup').hasClass('active')){
                $('.bonus-popup').remove();
            }else{
                var _request = new XMLHttpRequest();
                _request.abort();
                _request = $.ajax( {
                    url: "/casino-bonuses-popup",
                    data: {
                        id: _this.data('casino-id')
                    },
                    dataType: 'html',
                    timeout: 20000,
                    type: 'GET',
                    success: function ( data ) {
                        if($('.bonus-popup').length > 0){
                            $('.bonus-popup').remove();
                        }

                        $('body').append(data);
                        closeCasinoPopup(_this);

                        var popPositionTop = _buttonPosition.top + _this.outerHeight();
                        var popPositionLeft = _buttonPosition.left + _this.width()/2;
                        var pop = $('.bonus-popup');
                        var popHeight = pop.outerHeight();
                        var popWidth = pop.width();
                        var buttonWidth = _this.width();

                        var popPosition = {
                            top: popPositionTop,
                            left: popPositionLeft
                        };

                        if (popPositionTop - popHeight - _this.outerHeight() > $(window).scrollTop()) {
                            popPosition['top'] = _buttonPosition.top-popHeight;
                            pop.addClass('above');
                        } else {
                            pop.removeClass('above');
                        }

                        if (popPositionLeft - (popWidth/2) < 0) {
                            popPosition['left'] = _buttonPosition.left;
                            pop.addClass('on-right');
                        } else {
                            pop.removeClass('on-right');
                        }

                        if (popPositionLeft + (popWidth/2) > $(window).width()) {
                            popPosition['left'] = _buttonPosition.left + buttonWidth - popWidth;
                            pop.addClass('on-left');
                        } else {
                            pop.removeClass('on-left');
                        }

                        pop.addClass('active').css(popPosition);

                        copyToClipboard();
                        $('.js-copy-tooltip').tooltipster(copyTooltipConfig);

                    },
                    error: function ( jqXHR ) {

                    }
                });
            }

            $('body').on('click', function(e) {
                if ($(e.target).closest('.bonus-popup').length == 0) {
                    $('.bonus-popup').remove();
                }
            });
        }

    });
}

if($('.js-bonus-trigger').length > 0 ){
    showCasinoBonuses();
}

if($('.similar_casinos-slider').length > 0){
    var similarSlider = $('.similar_casinos-slider');
    var isDown = false;
    var startX,
        scrollL;

    similarSlider
    .mousedown(function(e) {
        isDown = true;
        $(this).addClass('active');
        startX = e.pageX - $(this).offset().left;
        scrollL = $(this).scrollLeft();
    })
    .mouseleave(function(){
        isDown = false;
        $(this).removeClass('active');
    })
    .mouseup(function(){
        isDown = false;
        $(this).removeClass('active');
    })
    .mousemove(function (e) {
        if(!isDown) return;
        e.preventDefault();
        var xAxis = e.pageX - $(this).offset().left;
        var walk = (xAxis - startX) * 1;
        $(this).scrollLeft(scrollL - walk);
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
    }
}

//Load defer for pages on that you can see the footer on first load
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

var rangeRatingConfig = {
    min: 0,
    max: 10,
    step: 1,
    from: $('.rating-container').data('user-rate'),
    grid: true,
    values: ['&nbsp;', 'Terrible', '&nbsp;', 'Poor', '&nbsp;', 'Good', '&nbsp;', 'Very good', '&nbsp;', 'Excellent', '&nbsp;'],
    skin: "round",
    grid_snap: true,
    hide_from_to: true,
    hide_min_max: true,
    onChange: function (data) {
        $('.drag-rate-range-score').html('<span>' + data.from + '</span>' + '/10 ' + '<span>' + getGrade(data.from).text + '</span>');
        $('.drag-rate-range')
                .removeClass('terrible poor good very-good excellent')
                .addClass(getGrade(data.from).class);
    },
    onFinish: function (data) {
        // fired on pointer release
        var container = $('[data-casino-name]');
        $('.drag-rate-range-title').text('Your review');
        new Score({
            value: data.from,
            name: container.data('casino-name')
        });
    },
    onStart: function (data) {
        $(data.slider)
            .find('.irs-handle.single')
            .attr('id', 'gtm_rating');
    }
}

$('body').on('click', '.cl-lightbox-close', closeClLightbox);

$('body').on('keyup', function(e) {
    if (e.keyCode == 27) {
        closeClLightbox();
    }
});

function closeClLightbox() {
    $('.cl-lightbox').fadeOut('fast', function() {
        $(this).remove();
    });
}

var Score = function (obj) {
    var _obj = obj,
        _name = _obj.name,
        _score = _obj.value,
        _request = new XMLHttpRequest;

    var _init = function () {
        _updateScore(_name, _score);
    },
    _updateScore = function (_name, _score) {
        if (_score == 0)
            return;
        if (BUSY_REQUEST)
            return;
        BUSY_REQUEST = true;
        _request.abort();

        _request = $.ajax({
            url: '/casino/rate',
            data: {
                name: _name,
                value: _score
            },
            dataType: 'json',
            type: 'post',
            success: function (data) {
                var types_array = ['Excellent', 'Very good', 'Good', 'Poor', 'Terrible'];
                if (data.body['success'] == "Casino already rated!") {
                    $(".icon-icon_available").toggleClass("icon-icon_unavailable");
                    $(".icon-icon_unavailable").removeClass("icon-icon_available");
                    $('.thanx').html(data.body['success']);
                }

                $('.drag-rate').find('.action-field').show();

                $('.drag-rate-range-score').html('<span>' + _score + '</span>' + '/10 ' + '<span>' + getGrade(_score).text + '</span>');
                $('.rating-container-score-value').text(data.body['total_score']);
                $('.count-value').text(data.body['total_votes']);

                $( ".rating-container-stats-row" ).each(function( index ) {
                    var percents = setVotePercents(data.body['votes'][types_array[index]], data.body['total_votes']);
                    $(this).find('.rating-container-stats-bar').css('width', percents);
                    $(this).find('.rating-container-stats-score').html( percents + "<span>(" + data.body['votes'][types_array[index]] + ")</span>");
                });

                $('.rating-container-score-grade')
                        .removeClass('terrible poor good very-good excellent no-score')
                        .addClass(getGrade(data.body['total_score']).class)
                        .text(getGrade(data.body['total_score']).text);
                        
                if ($('.cl-lightbox').length > 0) {
                    setTimeout(function() {
                        feedbackPopupNextStep(2);
                        $('.form.cl-lightbox-slide').each(function () {
                            new AddingReview($(this));
                        });
                    }, 2000);
                }
            },
            error: function (XMLHttpRequest) {
                if (XMLHttpRequest.statusText != "abort")
                {
                    console.log('err');
                }
            },
            complete: function () {
                BUSY_REQUEST = false;
            }
        });
    };
    _init();
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
copyTooltipConfigGames = {
    trigger: 'click',
    maxWidth: 260,
    minWidth: 260,
    animation: 'grow',
    contentAsHTML: true,
    debug: false,
    functionBefore: function (instance, helper) {
        instance.content('\
                <div class="centered">\
                     Code copied to clipboard\
                </div>\
            ');
    }
};

contentTooltipConfigPopup = {
    trigger: 'click',
    maxWidth: 460,
    interactive: true,
    contentAsHTML: true,
    debug: false,
    content: $('.loader'),
    animation: 'fade',
    contentCloning: false,
    theme: 'tooltipster-popup',
    functionReady: function (origin, tooltip) {
        $('body').addClass('shadow');
        setTimeout(function () {
            $(".tooltipster-fade.tooltipster-show").css("opacity", "1");
            contentTooltipConfigPopupActions($(tooltip.origin))
        }, 500)
    },
    functionAfter: function () {
        $('body').removeClass('shadow');
        $(".tooltipster-fade.tooltipster-show").css("opacity", "1");
    },
    functionBefore: function (instance, helper) {
        var $origin = $(helper.origin);

        if ($origin.data('loaded') !== true) {
            var _name = $origin.data('name');
            var _is_free = $origin.data('is-free');
            var _request = new XMLHttpRequest();
            _request.abort();
            _request = $.ajax({
                url: "/casino/bonus-popup",
                data: {
                    casino: _name,
                    is_free: _is_free,
                },
                dataType: 'html',
                type: 'POST',
                success: function (response) {
                    instance.content(response);
                    setTimeout(function () {
                        contentTooltipConfigPopupActions($origin)
                    }, 150)
                    setTimeout(function () {
                        $(".tooltipster-fade.tooltipster-show").css("opacity", "1");
                    }, 700)
                    $origin.data('loaded', true);
                }
            });
        }
    }
};


function getGrade(score) {
    var current = (typeof score != 'undefined') ? score : $('.rating-container').data('user-rate');
    var result = {};

    switch (current) {
        case 1:
        case 2:
            result['text'] = 'Terrible';
            result['class'] = 'terrible';
            break;
        case 3:
        case 4:
            result['text'] = 'Poor';
            result['class'] = 'poor';
            break;
        case 5:
        case 6:
            result['text'] = 'Good';
            result['class'] = 'good';
            break;
        case 7:
        case 8:
            result['text'] = 'Very good';
            result['class'] = 'very-good';
            break;
        case 9:
        case 10:
            result['text'] = 'Excellent';
            result['class'] = 'excellent';
            break;
        default:
            result['text'] = '';
            result['class'] = '';
    }

    return result;
}

function setVotePercents(vote, total_votes){
    var percent  = Math.round( ( vote / total_votes ) * 100);
    return percent + '%';
}

$(".js-drag-rate").ionRangeSlider(rangeRatingConfig);

function contentTooltipConfigPopupActions(origin) {
    checkStringLength($('.bonus-box'), 15);
    if ($(window).width() > 767) {
        $('.bonus-info .content_popup').niceScroll({
            cursorcolor: "#A8AEC8",
            cursorwidth: "3px",
            autohidemode: false,
            cursorborder: "1px solid #A8AEC8",
            railoffset: {top: 0, left: 20},
            horizrailenabled: false,
        });
    }
    $('.js-tooltip').tooltipster(tooltipConfig);
    $('.js-copy-tooltip').tooltipster(copyTooltipConfig);
    copyToClipboard();

    $('.close_btn').on('click', function () {
        origin.tooltipster('hide');
    });
}

var contentPopupWidth = 460;
if (ww < 768) {
    contentPopupWidth = 300;
}

contentTooltipConfig = {
    trigger: 'click',
    minWidth: contentPopupWidth,
    interactive: true,
    contentAsHTML: true,
    debug: false,
    content: $('.loader'),
    animation: 'fade',
    position: 'top',
    contentCloning: false,
    theme: 'tooltipster-bonus',
    functionReady: function (instance, helper) {
        $('body').addClass('shadow');
        checkStringLength($('.bonus-box'), 15);
        $('.js-tooltip').tooltipster(tooltipConfig);
        setTimeout(function () {
            $(".tooltipster-fade.tooltipster-show").css("opacity", "1");
        }, 500)
    },
    functionPosition: function (instance, helper, position) {
        if (ww < 768 && ww > 375) {
            position.coord.left += 20;
            return position;
        }

        // if (ww <= 375 && ww > 330) {
        //     position.coord.left = ;
        //     return position;
        // }

        // if (ww <= 330) {
        //     position.coord.left += 5;
        //     return position;
        // }
    },
    functionAfter: function () {
        $('body').removeClass('shadow');
        $(".tooltipster-fade.tooltipster-show").css("opacity", "1");
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
                    if (ww < 768) {
                        $('.tooltipster-sidetip .tooltipster-box').css({
                            borderRadius: '6px'
                        })
                    }

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
            checkStringLength($('.bonus-box-list'), 15);
        }
    }
};

function unlockScreen() {
    $('html, body').removeClass('no-scroll');
}

function lockScreen() {
    $('html, body').addClass('no-scroll');
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
                        } else if (response.status == "error") {
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

function goToPosition(_position) {
    $('html, body').animate({
        scrollTop: _position
    }, 5);
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
                    } else {
                        if (currentOpened) {
                            if (e.target.className !== 'expand-menu') {
                                currentOpened.classList.remove('opened');
                            }
                            setTimeout(function () {
                                currentTarget.classList.add('opened');
                            }, 400);
                        } else {
                            currentTarget.classList.add('opened');
                        }
                    }

                    break;
                } else {
                    currentTarget = currentTarget.parentNode;
                }
            }
        }, true);
    }
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

function sliderInit(params) {
    var swiperMain = new Swiper(params.container, {
        slidesPerView: params.sledesPerViw,
        spaceBetween: 5,
        navigation: {
            nextEl: params.nextClass,
            prevEl: params.prevClass,
        },
        breakpoints: {
            1024: {
                freeMode: true,
                slidesPerView: 6,
            },
            768: {
                slidesPerView: 5,
            },
            700: {
                slidesPerView: 4.5,
            },
            639: {
                slidesPerView: 4.5,
            },
            479: {
                slidesPerView: 2.5,
            },
            320: {
                slidesPerView: 2,
            }
        },
        on: {
            reachEnd: function(e) {
            if (params.hasLazySlides) {
                getMoreSlides({
                    url: params.lazySlidesUrl,
                    container: params.container,
                    self: swiperMain,
                    callback: params.callBack,
                    // page: slideSwiper.navPage
                });
            }

            }
        }
    });

    var slidePage = 1;
    function getMoreSlides(obj) {
        if (obj.self) {
            var container = $(obj.container).parent();
            var dataObject = {};

            dataObject['id'] = container.find('.carousel-next').data('id');
            dataObject['type'] = container.find('.carousel-next').data('type');
            dataObject['page'] = slidePage;

            $.ajax({
                url: obj.url + slidePage,
                type: 'POST',
                dataType: 'html',
                data: dataObject,
            })
            .done(function(data) {
                obj.self.appendSlide(data);
                obj.self.update();
                slidePage++;

                if (obj.callback) {
                    obj.callback();
                }
            })
            .fail(function() {
                console.log("error");
            });
        }
    }

    var linksSwiperParams = {
        slidesPerView: 'auto',
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

sliderInit({
    container: '#main-carousel',
    sledesPerViw: 6,
    nextClass: '.cn1',
    prevClass: '.cp1'
});

sliderInit({
    container: '#best-country',
    sledesPerViw: 4,
    nextClass: '.cn2',
    prevClass: '.cp2',
    hasLazySlides: true,
    lazySlidesUrl: '/casinos-by-country/',
    callBack: ndbActions
});

sliderInit({
    container: '#best-software',
    sledesPerViw: 4,
    nextClass: '.cn2',
    prevClass: '.cp2',
    hasLazySlides: true,
    lazySlidesUrl: '/casinos-by-software/',
    callBack: ndbActions
});

sliderInit({
    container: '#ndb-software',
    sledesPerViw: 4,
    nextClass: '.cn3',
    prevClass: '.cp3',
    hasLazySlides: true,
    lazySlidesUrl: '/casinos-by-software/',
    callBack: ndbActions
});

sliderInit({
    container: '#ndb-country',
    sledesPerViw: 4,
    nextClass: '.cn3',
    prevClass: '.cp3',
    hasLazySlides: true,
    lazySlidesUrl: '/casinos-by-country/',
    callBack: ndbActions
});

sliderInit({
    container: '#no-deposit-casinos',
    sledesPerViw: 4,
    nextClass: '.cn4',
    prevClass: '.cp4'
});

sliderInit({
    container: '#top-software',
    sledesPerViw: 4,
    nextClass: '.cn5',
    prevClass: '.cp5'
});

sliderInit({
    container: '#top-banking',
    sledesPerViw: 6,
    nextClass: '.cn6',
    prevClass: '.cp6'
});

function ndbActions() {
    refresh();
}

function refresh() {
    $('.js-tooltip').tooltipster(tooltipConfig);
    $('.js-copy-tooltip').tooltipster(copyTooltipConfig);
    $('.js-tooltip-content').tooltipster(contentTooltipConfig);
    $('.js-tooltip-content-popup').tooltipster(contentTooltipConfigPopup);
    // initMobileBonusesPop(ww);
    if($('.js-bonus-trigger').length > 0){
        showCasinoBonuses();
    }
    copyToClipboard();
}

function copyToClipboard() {
    var btn = $('.js-copy-to-clip');

    btn.on('click', function (e) {
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

//remove HTML tags from text
function strip(html) {
    var tmp = document.createElement("DIV");
    tmp.innerHTML = html;
    return tmp.textContent || tmp.innerText || "";
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

function initTooltipseter() {
   $('.js-tooltip').tooltipster(tooltipConfig);
    $('.js-copy-tooltip').tooltipster(copyTooltipConfig);
    $('.js-tooltip-content').tooltipster(contentTooltipConfig);
    $('.js-tooltip-content-popup').tooltipster(contentTooltipConfigPopup);
}

function bindButtons() {
    $('.search_input').on({
        blur: function (e) {
            var search_val = $(this).val().trim();
            if (isSearchResultEvent)
                return;
            if ($('.search-tag-manager').length && $(this).val().trim() == search_val)
                return;
            if (search_val.length > 2 && search_val != searched_value) {
                searched_value = search_val;
                loadScripts(['assets/search-tracker']);
                SearchTracker(search_val);
            }
        }
    });

    $('#search-all').on({
        mousedown: function () {
            isSearchResultEvent = true;
        },
        mouseup: function () {
            isSearchResultEvent = false;
        }
    });

    $('.js-more-games').on('click', function () {
        $(this).addClass('loading');
        var id = $(this).data('software');
        var self = $(this);
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
                }, 100);
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
                }, 100);
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
                }, 100);
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
}

var Filters = function (obj) {
    var _obj = obj,
            _self = this,
            _switchers = _obj.find('input[type=checkbox]'),
            _radios = _obj.find('input[type=radio]'),
            _selectFilter = _obj.find('select[name=soft]'),
            _targetContainer = $('.data-container'),
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
        if ($('.data-container-holder').data('limit-per-page')) {
            limit_items = $('.data-container-holder').data('limit-per-page');
        }
        if (location.pathname === '/casinos') {
            _url = 'load-all-casinos/';
        }

        _request = $.ajax({
            url: _url + AJAX_CUR_PAGE,
            data: _ajaxDataParams,
            dataType: 'html',
            type: 'GET',
            success: function (data) {
                _targetAddContainer = $('.data-add-container');
                var cont = $(data).find('.loaded-item');
                var loadTotal = $(data).filter('[data-load-total]').data('load-total');
                var qty_items = $('.qty-items');
                if (_action == 'replace') {
                    _targetContainer.html(data);
                    _targetAddContainer.html('');
                    qty_items.attr('data-load-total', loadTotal);
                    $('.qty-items-quantity').text(loadTotal);

                    if (cont.length === parseInt(qty_items.attr('data-load-total'))) {
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

                    if (parseInt($('.qty-items').attr('data-load-total')) <= limit_items) {
                        $('.js-more-items').hide();
                    } else {
                        $('.js-more-items').show();
                    }
                    // gridViewBoxPopup();
                } else if (_url === '/games-filter/') {

                    if (parseInt($('.qty-items-quantity').html()) <= limit_items) {
                        $('.js-more-items').hide();
                    } else {
                        $('.js-more-items').show();
                    }
                }
                grayscaleIE();
                initImageLazyLoad();
                copyToClipboard();
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
                    return;
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
                    _showAllButton();
                } else {
                    _hideAllButton();
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
            _showAllButton = function () {
                _searchAllButton.parent().fadeIn();
                _searchAllButton.closest('.header-search').addClass('search-active');
            },
            _hideAllButton = function () {
                _searchAllButton.parent().removeClass('search-active').fadeOut();
                _searchAllButton.closest('.header-search').removeClass('search-active');
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
                        _hideAllButton();
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
                if(_searchInput.val() == ''){
                    if($('#search-suggestions').length <= 0){
                        _request = $.ajax({
                            url: '/search-suggestions',
                            data: {},
                            dataType: 'html',
                            type: 'GET',
                            success: function (data) {
                                _hideLoading();
                                $('.search-results').append(data);
                                $('#search-suggestions').show();
                                $('#search-lists').hide();
                                $('#search-casinos').hide();
                                $('#search-pages').hide();
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
                    }
                }else{
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
                            $('#search-suggestions').remove();
                            $('.search-lists').show();
                            $('.search-casinos').show();
                            $('.search-pages').show();
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
                }

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
                _hideAllButton();
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

var initSite = function () {

    copyToClipboard();
    checkStringLength($('.list .bonus-box'), 21);
    checkStringLength($('.bonus-item .bonus-box'), 33);
    grayscaleIE();

    initMobileMenu();

    $('.message .close').on('click', function (e) {
        $(this).parent().fadeOut();
        e.preventDefault();
    });

    $('.js-history-back').on('click', function (e) {
        window.history.back();
        e.preventDefault();
    });
}

function gridViewBoxPopup(){
    $('.data-container-holder').on('click', '.open-popup-spec', function(){
        $(".welcome_package-popup-trigger").closest('.wp-title').find('.welcome_package-popup').removeClass('active');
        $(this).closest('.popup-spec').find('.popup-casino-spec').toggleClass('active');
        $('.open-popup-spec').not(this).closest('.popup-spec').find('.popup-casino-spec').removeClass('active');
    });

    $('.data-container-holder').on('click', '.close-popup-spec', function(){
        $('.popup-casino-spec').removeClass('active');
    });

    $('.data-container-holder').on('click', '.welcome_package-popup-trigger', function(){
        $('.open-popup-spec').closest('.popup-spec').find('.popup-casino-spec').removeClass('active');
        $(this).closest('.wp-title').find('.welcome_package-popup').toggleClass('active');
        $(".welcome_package-popup-trigger").not(this).closest('.wp-title').find('.welcome_package-popup').removeClass('active');
    });

    $('.data-container-holder').on('click', '.close-popup-wp', function(){
        $('.welcome_package-popup').removeClass('active');
    });
}
gridViewBoxPopup();

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

function menuHoverAction() {
    if (!checkIfIsMobileDevice()) {
        $('.header-menu__list-holder .expand-holder').on('mouseout', function (e) {
            $('.expand-holder').removeClass('opened');
        })
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
                fullheight = element.children('span').innerHeight() - (parseInt($("p",  element).first().css("margin-top")) * 2),
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

initExpandingText();

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
responsiveTables();

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

$("body").on('click', ".tf_flex", function() {
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
        $('body').removeClass('site__header_hidden');
    }
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

function CloseTFPopup() {
    $('.close_tf_wrap').on('click', function (e) {
        console.dir($(this).parent().parent().parent());
        $(this).parent().parent().parent().remove();
        e.stopPropagation();
    });
}

function setIframeAsResponsive() {
    var iframes = $('.plain-text iframe');

    if (iframes.length) {
        iframes.each(function (index, el) {
            $(el).wrap('<div class="iframe-wrapper"></div>');
        });
    }
}

setIframeAsResponsive();