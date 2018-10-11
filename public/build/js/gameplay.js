'use strict';
$(window).load(function(){

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
                var spaceReq = (width < mobileWidth ? 1 : 2);
                var extraElWidth = $extraEl.outerWidth(true);
                if (widthBasedOnHeight + extraElWidth * spaceReq > width) {
                    if (width < mobileWidth) {
                        var newWidthWithExtraEl = widthBasedOnHeight + (width - widthBasedOnHeight - extraElWidth * spaceReq);
                        setIframeAttr(newWidthWithExtraEl, newWidthWithExtraEl * ratio, extraElWidth);
                    } else {
                        var newWidthWithExtraEl = widthBasedOnHeight + (width - widthBasedOnHeight - extraElWidth * 2);
                        setIframeAttr(newWidthWithExtraEl, newWidthWithExtraEl * ratio);
                    }
                } else {
                    if (width < mobileWidth) {
                        var extraSpace = width - widthBasedOnHeight;
                        setIframeAttr(widthBasedOnHeight, height, extraSpace);
                    } else {
                        setIframeAttr(widthBasedOnHeight, height);
                    }
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

        var ratioResize = new RatioResize($iframe, ratio, configuration.desktopWidth, $extraEl, setExtraElement);

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

            //setTimeout(function () {
                addMobileEvent();
                //add config function trigger
                if(undefined !== configuration.triggerOnPlay){
                    $(configuration.events.fullscreen).on('click', function () {
                        configuration.triggerOnPlay();
                    });
                }
            //}, 500);
        }

        function addMobileEvent() {
            var gameUrl = $iframe.contents().find("#overlay").attr('data-game-url');
            if (typeof gameUrl !== typeof undefined && gameUrl !== false) {
                isMobile = true;
                var iframePlayButton = $iframe.contents().find(configuration.events.play);
                $(iframePlayButton).on(clickEvent, function () {
                    iframePlayButton.trigger('click');
                    if(fullscreen === false){
                        toogleFullscreen();
                    }
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

        // function getExtraHeight() {
        //     //Calculate the height of extra elements
        //     var $elements = $iframe.parent().children().not(iframe);
        //     var elHeight = 0;
        //     $elements.each(function () {
        //         elHeight += $(this).outerHeight(true);
        //     });
        //     return elHeight;
        // }

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
                if (configuration.desktopWidth > $(window).width()) {
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
        triggerOnPlay: function runPlayCounter() {
            console.log('custom function')
            // _request = new XMLHttpRequest;
            //
            // if (BUSY_REQUEST) return;
            // BUSY_REQUEST = true;
            // _request.abort();
            //
            // _request = $.ajax({
            //     url: '/play-counter',
            //     data: {
            //         name: _name
            //     },
            //     dataType: 'json',
            //     type: 'post',
            //     success: function (data) {
            //     },
            //     error: function (XMLHttpRequest) {
            //         if (XMLHttpRequest.statusText != "abort") {
            //             console.log('err');
            //         }
            //     },
            //     complete: function () {
            //         BUSY_REQUEST = false;
            //     }
            // });
        }
    };

    //if ($iframe.length > 0) {
        new GameplayResize(gameplayConfig);
    //}

});
