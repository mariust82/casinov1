'use strict';
$(function () {

    var clickEvent = ((document.ontouchstart !== null) ? 'click' : 'touchstart');

    var RatioResize = function ($iframe, ratio, mobileWidth, $extraEl, setExtraElement) {
        this.resizeOnWidth = function (width) {
            //Adding width and height on iframe keeping proportions
            setIframeAttr(width, width * ratio);
        };

        //Adding width and height on iframe keeping proportions
        this.resizeOnWidthHeight = function (width, height) {
            //width 100%
            if (ratio < height / width) {
                setExtraElement('height');
                var heightBasedOnWidth = width * ratio;
                //if we have extra elements, take in to account
                if (heightBasedOnWidth + $extraEl.outerHeight(true) * 2 > height) {
                    var newHeightWithExtraEl = heightBasedOnWidth + (height - heightBasedOnWidth - $extraEl.outerHeight(true) * 2);
                    setIframeAttr(newHeightWithExtraEl / ratio, newHeightWithExtraEl);
                } else {
                    setIframeAttr(width, heightBasedOnWidth);
                }
                //height 100%
            } else {
                setExtraElement('width');
                var widthBasedOnHeight = height / ratio;
                //if we have extra elements, take in to account
                var spaceReq = 2;
                var extraElWidth = $extraEl.outerWidth(true);
                if (widthBasedOnHeight + extraElWidth * spaceReq > width) {
                    var newWidthWithExtraEl = widthBasedOnHeight + (width - widthBasedOnHeight - extraElWidth * 2);
                    setIframeAttr(newWidthWithExtraEl, newWidthWithExtraEl * ratio);
                } else {
                    setIframeAttr(widthBasedOnHeight, height);
                }
            }
        };

        function setIframeAttr(width, height, marginRight) {
            marginRight = (typeof marginRight === "undefined" ? 0 : '-' + marginRight + 'px');
            $iframe.css({'margin-right': marginRight}).width(Math.round(width)).height(Math.round(height));
        }
    };

    var GameplayResize = function (configuration) {
        //Set domain same as gameplay domain for communication between iframe - site
        document.domain = configuration.domain;
        //Set screen state
        var fullscreen = false;
        //Check if mobile
        var isMobile = false;
        //Find iframe
        var $iframe = $(configuration.iframe);
        //Find extra element for fullscreen
        var $extraEl = $(configuration.extraElements)

        var eventIsSet = false;

        // Find and save the aspect ratio for iframe based on inline width and height
        var ratio = $iframe.attr('height') / $iframe.attr('width');
        $iframe.removeAttr("width").removeAttr("height");

        var ratioResize = new RatioResize($iframe, ratio, configuration.mobileWidth, $extraEl, setExtraElement);

        function init() {
            //Attach button events
            setEvents();
        }

        function setEvents() {

            $(configuration.events.reload).on('click', function () {
                reloadFrame();
            });

            $(configuration.events.fullscreen).on('click', function () {
                toogleFullscreen();
            });

            $iframe.one('load', function () {
                addMobileEvent();
                //add config function trigger
                if(undefined !== configuration.triggerOnPlay){
                    var iframePlayButton = $iframe.contents().find(configuration.events.play);
                    $(iframePlayButton).on('click', function () {
                        configuration.triggerOnPlay();
                    });
                }
            });

        }

        function addMobileEvent() {
            var gameUrl = $iframe.contents().find("#overlay").attr('data-game-url');
            if (typeof gameUrl !== typeof undefined && gameUrl !== false) {
                isMobile = true;
                var iframePlayButton = $iframe.contents().find(configuration.events.play);
                $(iframePlayButton).on(clickEvent, function () {
                    iframePlayButton.trigger('click');
                    toogleFullscreen();
                });
            }
        }

        function reloadFrame() {
            var src = $iframe.attr('src');
            $iframe.attr('src', null);
            if (isMobile && !eventIsSet) {
                eventIsSet = true;
                $iframe.load(function () {
                    addMobileEvent();
                });
            }
            $iframe.attr('src', src);

        }

        //Toogle fullscreen state
        function toogleFullscreen() {
            if (fullscreen) {
                fullscreen = false;

                if (isMobile) {
                    reloadFrame();
                }

                $('body').removeClass('fullscreenGameplay');
                clearExtraElement();
            } else {
                fullscreen = true;
                $('body').addClass('fullscreenGameplay');
            }
            onResize();
        }

        function clearExtraElement() {
            $extraEl.removeClass('top-player-controler').removeClass('left-player-controler').removeClass('right-player-controler');
        }

        function setExtraElement(orientation) {
            clearExtraElement();
            if (orientation == 'width') {
                if (configuration.tabletWidth > $(window).width()) {
                    $extraEl.addClass('left-player-controler');
                } else {
                    $extraEl.addClass('right-player-controler');
                }
            } else if (orientation == 'height') {
                $extraEl.addClass('top-player-controler');
            }
        }

        function onResize() {
            // Resize the iframe when the window is resized
            if (fullscreen) {
                ratioResize.resizeOnWidthHeight($(window).width(), $(window).height());
            } else {
                //resize based on parent width
                ratioResize.resizeOnWidth($iframe.parent().width());
            }
        }

        $(window).on("orientationchange, resize", function () {
            onResize();
            // Resize to fix iframe on page load.
        }).resize();

        init();
    }

    var gameplayConfig = {
        domain: 'casinoslists.com',
        iframe: '#gameplay_iframe',
        extraElements: '.player-controls',
        mobileWidth: 690,
        desktopWidth: 1200,
        events: {
            reload: '#play-replay',
            fullscreen: '#play-fullscreen',
            play: '#game_play_button'
        },
        triggerOnPlay: function() {
	     var gameName = window.location.href.substring(window.location.href.lastIndexOf("/")+1);
             var request = new XMLHttpRequest;
             if (BUSY_REQUEST) return;
             BUSY_REQUEST = true;
             request.abort();
             request = $.ajax({
                 url: '/play-counter',
                 data: {
                     name: gameName
                 },
                 dataType: 'json',
                 type: 'post',
                 success: function (data) {
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
        }
    };

    new GameplayResize(gameplayConfig);
});
