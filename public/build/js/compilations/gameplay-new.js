"use strict";$(function(){var t=null!==document.ontouchstart?"click":"touchstart",e=function(t,e,n,i,o){function r(e,n,i){i=void 0===i?0:"-"+i+"px",t.css({"margin-right":i}).width(Math.round(e)).height(Math.round(n))}this.resizeOnWidth=function(t){r(t,t*e)},this.resizeOnWidthHeight=function(t,n){if(e<n/t){o("height");var a=t*e;if(a+2*i.outerHeight(!0)>n){var l=a+(n-a-2*i.outerHeight(!0));r(l/e,l)}else r(t,a)}else{o("width");var c=n/e,s=i.outerWidth(!0);if(c+2*s>t){var d=c+(t-c-2*s);r(d,d*e)}else r(c,n)}}};new function(n){function i(){$(n.events.reload).on("click",function(){r()}),$(n.events.fullscreen).on("click",function(){a()}),setTimeout(function(){o(),void 0!==n.triggerOnPlay&&$(n.events.fullscreen).on("click",function(){n.triggerOnPlay()})},500)}function o(){var e=h.contents().find("#overlay").attr("data-game-url");if(void 0!==e&&!1!==e){d=!0;var i=h.contents().find(n.events.play);$(i).on(t,function(){i.trigger("click"),a()})}}function r(){var t=h.attr("src");h.attr("src",null),d&&!f&&(f=!0,h.load(function(){o()})),h.attr("src",t)}function a(){s?(s=!1,d&&r(),$("body").removeClass("fullscreenGameplay"),l()):(s=!0,$("body").addClass("fullscreenGameplay")),c()}function l(){u.removeClass("top-player-controler").removeClass("left-player-controler").removeClass("right-player-controler")}function c(){s?m.resizeOnWidthHeight($(window).width(),$(window).height()):m.resizeOnWidth(h.parent().width())}document.domain=n.domain;var s=!1,d=!1,h=$(n.iframe),u=$(n.extraElements),f=!1,g=h.attr("height")/h.attr("width");h.removeAttr("width").removeAttr("height");var m=new e(h,g,n.mobileWidth,u,function(t){l(),"width"==t?n.tabletWidth>$(window).width()?u.addClass("left-player-controler"):u.addClass("right-player-controler"):"height"==t&&u.addClass("top-player-controler")});$(window).on("orientationchange, resize",function(){c()}).resize(),i()}({domain:"casinofreak.com",iframe:"#iframe-game-play",extraElements:"#gameplay-section-head-controls",mobileWidth:690,tabletWidth:1200,events:{reload:"#gameplay-section-refresh",fullscreen:"#gameplay-section-popup",play:"#game_play_button"},triggerOnPlay:function(){console.log("custom function")}})});