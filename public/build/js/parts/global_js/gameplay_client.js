document.domain = window.location.hostname.replace("www.","").replace("dev.","");


var ClientGameplayCONFIG = function() {

    // Selector for the subdomain iframe loaded in client
    var iframeSelector = '#gameplay_iframe';

    // Selector for the play button
    var playButtonSelector = '#game_play_button';

    // Selector for the reload button
    var reloadButtonSelector = '#play-replay';

    // Selector for the fullscreen button
    var fullscreenButtonSelector = '#play-fullscreen';

    // Object holding margin configuration for different gameplay states (fullscreen desktop/mobile)
    var marginSettings = {
        desktop: {
            top: 0,
            right: 0,
            bottom: 0,
            left: 0
        },
        mobile: {
            top: 0,
            right: 0,
            bottom: 0,
            left: 0
        }
    };

    // Handler function for fullscreen events
    /* This is a function that controls
        what happens with the elements in the
        parent site (mainly css changes) when fullscreen is triggered
        in addition to the behavior defined in the
        gameplay component
     */
    this.fullscreenHandler = function() {};

    // Handler function for play button click events
    this.playGameHandler = function() {};
    // Handler function for play button click events
    this.reloadHandler = function() {};


    // Setters
    this.setIframeSelector = function(selector) {

        iframeSelector = selector;
    };
    this.setPlayButtonSelector = function(selector) {

        playButtonSelector = selector;
    };
    this.setReloadButtonSelector = function(selector) {

        reloadButtonSelector = selector;
    };
    this.setFullscreenButtonSelector = function(selector) {

        fullscreenButtonSelector = selector;
    };
    this.setFullscreenHandler = function(handler) {

        this.fullscreenHandler = handler;
    };
    this.setplayGameHandler = function(handler) {

        this.playGameHandler = handler;
    };
    this.setreloadGameHandler = function(handler) {

        this.reloadGameHandler = handler;
    };
    this.setDesktopFullscreenMargin = function(top, right, bottom, left) {

        top = top || 0;
        right = right || 0;
        bottom = bottom || 0;
        left = left || 0;

        marginSettings.desktop = {
            top: top || 0,
            right: right || 0,
            bottom: bottom || 0,
            left: left || 0
        }
    };
    this.setMobileFullscreenMargin = function(top, right, bottom, left) {

        top = top || 0;
        right = right || 0;
        bottom = bottom || 0;
        left = left || 0;

        marginSettings.mobile = {
            top: top || 0,
            right: right || 0,
            bottom: bottom || 0,
            left: left || 0
        }
    };


    // Getters
    this.getIframeSelector = function() {

        return iframeSelector;
    };
    this.getPlayButtonSelector = function() {

        return playButtonSelector;
    };
    this.getReloadButtonSelector = function() {

        return reloadButtonSelector;
    };
    this.getFullscreenButtonSelector = function() {

        return fullscreenButtonSelector;
    };
    this.getDesktopFullscreenMargin = function() {

        return marginSettings.desktop;
    };
    this.getMobileFullscreenMargin = function() {

        return marginSettings.mobile;
    };
};

var ClientGameplay = function(CONFIG) {

    var iframeWindow = document.querySelector(CONFIG.getIframeSelector()).contentWindow,
        iframe = $(CONFIG.getIframeSelector()),
        play_button = $(CONFIG.getPlayButtonSelector()),
        reload_button = $(CONFIG.getReloadButtonSelector()),
        fullscreen_button = $(CONFIG.getFullscreenButtonSelector()),
        game_ratio = 0,
        is_first_load = true;

    this.init = function() {

        // Send configuration object to iframe
        iframeWindow.Gameplay.setClientConfig(CONFIG);

        // Set game ratio
        if(is_first_load) {

            setGameRatio();
        }

        if(iframe.hasClass('fullscreen')) {

            iframeWindow.Gameplay.toggleFullScreen(true);
        }

        bindEvents();

        is_first_load = false;
    };

    var setGameRatio = function() {

        var screenshot = $(iframeWindow.document.getElementById('screenshot'));
        game_ratio = screenshot.width() / screenshot.height();
    };
    var bindEvents = function() {

        // Bind play button
        play_button.off('click');
        play_button.on('click', iframeWindow.Gameplay.engageGameplay);

        // Bind reload button
        if(is_first_load) {

            reload_button.on('click', reloadFrame);
        }

        // Bind fullscreen button
        if(is_first_load) {

            fullscreen_button.on('click', function () {

                iframeWindow.Gameplay.toggleFullScreen();
            });
        }

        // Bind iframe resize on window resize
        $(iframeWindow).on('resize', iframeWindow.Gameplay.resizeElements);
    };
    var reloadFrame = function() {

        var is_fullscreen = iframeWindow.Gameplay.is_fullscreen;
        var game_ratio = iframeWindow.Gameplay.game_ratio;

        // Display play button after iframe reloads if not screenshot
        if(iframeWindow.document.getElementsByTagName('body')[0].dataset.type !== 'screenshot' && !iframeWindow.document.getElementsByTagName('body')[0].dataset.restricted) {

            iframe.one('load', function() {

                play_button.show();
            });
        }
        // iframe.
        iframe.attr('src', iframe.attr('src'));
    };
};
