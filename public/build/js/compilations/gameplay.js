function imageDefer(e){var t=window.navigator.userAgent;if(-1<t.indexOf("MSIE ")||-1<t.indexOf("Trident/"))for(var r=document.getElementsByClassName(e),n=0;n<r.length;n++)r[n].src=r[n].getAttribute("data-src");else{var s=new IntersectionObserver(function(e){for(var t=0;t<e.length;t++){var r=e[t].target;!0===e[t].isIntersecting&&""==r.src&&(r.src=r.getAttribute("data-src"))}},{threshold:[0]});for(r=document.getElementsByClassName(e),n=0;n<r.length;n++)s.observe(r[n])}}
function SearchTracker(e){if("undefined"!=typeof dataLayer){var a,r={event:"search",Category:"UserSearch"};r.item=e,console.log(r),a=r,dataLayer.push(a)}}
var AJAX_CUR_PAGE=1,GAME_CURR_PAGE=1,NEW_CURR_PAGE=1,BEST_CURR_PAGE=1,COUNTRY_CURR_PAGE=1,ALL_CASINOS_KEY=1,BEST_BANKING_PAGE=1,searched_value="",isSearchResultEvent=!1;function sliderInit(){if($("#main-carousel").length||$("#links-nav").length){new Swiper("#main-carousel",{slidesPerView:6,spaceBetween:5,navigation:{nextEl:".carousel-next",prevEl:".carousel-prev"},breakpoints:{1024:{freeMode:!0,slidesPerView:"auto"}}});var e={slidesPerView:"auto",spaceBetween:30,freeMode:!0,allowTouchMove:!1,on:{slideChangeTransitionStart:function(e){$(".links-left, .links-right").fadeIn("fast")},slideChangeTransitionEnd:function(e){0==this.translate&&$(".links-left").fadeOut("fast"),this.isEnd&&$(".links-right").fadeOut("fast")}},breakpoints:{1024:{allowTouchMove:!0},690:{spaceBetween:15,allowTouchMove:!0}}};if($("#links-nav").length){var t=new Swiper(".links-casinos #links-nav",e),n=new Swiper(".links-games #links-nav",e),i=$("#links-nav .active").parent().index()-1;$(".links-casinos #links-nav").length&&t.slideTo(i,300),$(".links-games #links-nav").length&&n.slideTo(i,300)}if(1024<$(window).width()){function o(e,t,n){var i=e.closest(".swiper-container"),o=t;o.clientX>i.offset().left+i.width()/1.3?n.slideNext(500):o.clientX<i.offset().left+i.width()/6&&n.slidePrev(500)}$(".links-casinos .links-nav a").on("mouseenter",function(e){o($(this),e,t)}),$(".links-games .links-nav a").on("mouseenter",function(e){o($(this),e,n)})}}}function loadScripts(e){$(".controller_main").data("version");$.each(e,function(e,t){$("script[src='/public/build/js/compilations/assets/"+t+".js']").length||$("body").append($('<script type="text/javascript" src="/public/build/js/compilations/assets/'+t+'.js"><\/script>"'))})}function initCustomSelect(){if($(".js-filter").length){var e=$(".js-filter > option");$(".js-filter").select2MultiCheckboxes({templateSelection:function(){return"Game software"}}),e.prop("selected",!1)}}function tmsIframe(){$(".tms_iframe").length&&$(".tms_iframe").each(function(){var e=document.createElement("iframe");$.each(this.attributes,function(){"class"!=this.name&&e.setAttribute(this.name.replace("data-",""),this.value)}),$(this).append(e)})}var initImageLazyLoad=function(){console.log("asdasd"),imageDefer("lazy_loaded")};function validateEmail(e){return/^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i.test(e)}!function(l){BUSY_REQUEST=!1;l(window).width();l(document).ready(function(){return void initImageLazyLoad()}),l.fn.scrollEnd=function(t,n){l(this).scroll(function(){var e=l(this);e.data("scrollTimeout")&&clearTimeout(e.data("scrollTimeout")),e.data("scrollTimeout",setTimeout(t,n))})};var e=0;if(l(window).on("scroll",function(){e<l(window).scrollTop()?(l("body").removeClass("site__header_sticky"),e=l(window).scrollTop()):e-l(window).scrollTop()>l(window).height()/3&&(l("body").addClass("site__header_sticky"),e=l(window).scrollTop()),0===l(window).scrollTop()&&l("body").removeClass("site__header_sticky")}),l(window).width()<768&&(l(window).scrollEnd(function(){0!==l(window).scrollTop()&&l("body").addClass("site__header_sticky")},800),/\/reviews\//.test(window.location.href)&&0<l(".btn-group-mobile .btn-middle").length)){var t=!1,n=l(window).height()/2+l(window).scrollTop();l(window).on("scroll",function(){l(window).scrollTop()>n&&!1===t&&(l("body").append('<a rel="nofollow" target="_blank" class="btn-play-now" href="'+l(".btn-group-mobile .btn-middle").attr("href")+'">Play Now</a>'),l("body").addClass("play-now-appended"),t=!0)})}tooltipConfig={trigger:"click",maxWidth:279,animation:"grow",debug:!1},copyTooltipConfig={trigger:"click",maxWidth:260,minWidth:260,animation:"grow",contentAsHTML:!0,debug:!1,functionBefore:function(e,t){e.content('                <div class="centered">                    <i class="icon icon-icon_available"></i> Code copied to clipboard                </div>            ')}},contentTooltipConfig={trigger:"click",minWidth:460,interactive:!0,contentAsHTML:!0,debug:!1,content:l(".loader"),animation:"fade",contentCloning:!1,functionReady:function(){l("body").addClass("shadow"),c(l(".bonus-box"),15),l(".js-tooltip").tooltipster(tooltipConfig)},functionAfter:function(){l("body").removeClass("shadow")},functionBefore:function(t,e){var n=l(e.origin);if(!0!==n.data("loaded")){var i=n.data("name"),o=n.data("is-free"),a=new XMLHttpRequest;a.abort(),a=l.ajax({url:"/casino/bonus",data:{casino:i,is_free:o},dataType:"html",type:"GET",success:function(e){t.content(e),setTimeout(function(){s()},50),n.data("loaded",!0)}})}else setTimeout(function(){s()},50);function s(){l(".js-tooltip").tooltipster(tooltipConfig),l(".js-copy-tooltip").tooltipster(copyTooltipConfig),r(),c(l(".bonus-box"),15)}}};function c(e,o){l(e).each(function(e,t){var n=l(this).find(".list-item-trun"),i=l(this).find(".bubble");n.text().length>=o&&i.css("visibility","visible")})}function r(){window.Clipboard=function(d,u,e){var f;function p(){return e.userAgent.match(/ipad|iphone/i)}return{copy:function(e,t){var n,i,o,a,s,l,c,r=(n=e,(i=document.createElement("DIV")).innerHTML=n,i.textContent||i.innerText||"");o=r,a=t,f=u.createElement("textArea"),p()&&f.setAttribute("readonly","readonly"),f.value=o,a.parent().append(f),p()?((s=u.createRange()).selectNodeContents(f),(l=d.getSelection()).removeAllRanges(),l.addRange(s),f.setSelectionRange(0,999999)):f.select(),c=t,u.execCommand("copy"),c.parent().find(f).remove()}}}(window,document,navigator),l(".js-copy-to-clip").on("click touch",function(e){Clipboard.copy(l(this).data("code"),l(this)),e.preventDefault()})}}(jQuery);
"use strict";$(function(){var f=null!==document.ontouchstart?"click":"touchstart",g=function(o,l,t,s,c){function d(t,e,n){n=void 0===n?0:"-"+n+"px",o.css({"margin-right":n}).width(Math.round(t)).height(Math.round(e))}this.resizeOnWidth=function(t){d(t,t*l)},this.resizeOnWidthHeight=function(t,e){if(l<e/t){c("height");var n=t*l;if(n+2*s.outerHeight(!0)>e){var o=n+(e-n-2*s.outerHeight(!0));d(o/l,o)}else d(t,n)}else{c("width");var i=e/l,r=s.outerWidth(!0);if(t<i+2*r){var a=i+(t-i-2*r);d(a,a*l)}else d(i,e)}}};new function(n){document.domain=n.domain;var t=!1,o=!1,i=$(n.iframe),e=$(n.extraElements),r=!1,a=i.attr("height")/i.attr("width");i.removeAttr("width").removeAttr("height");var l=new g(i,a,n.mobileWidth,e,function(t){u(),"width"==t?n.tabletWidth>$(window).width()?e.addClass("left-player-controler"):e.addClass("right-player-controler"):"height"==t&&e.addClass("top-player-controler")});function s(){var t=i.contents().find("#overlay").attr("data-game-url");if(void 0!==t&&!1!==t){o=!0;var e=i.contents().find(n.events.play);$(e).on(f,function(){e.trigger("click"),d()})}}function c(){var t=i.attr("src");i.attr("src",null),o&&!r&&(r=!0,i.load(function(){s()})),i.attr("src",t)}function d(){t?(t=!1,o&&c(),$("body").removeClass("fullscreenGameplay"),u()):(t=!0,$("body").addClass("fullscreenGameplay")),h()}function u(){e.removeClass("top-player-controler").removeClass("left-player-controler").removeClass("right-player-controler")}function h(){t?l.resizeOnWidthHeight($(window).width(),$(window).height()):l.resizeOnWidth(i.parent().width())}$(window).on("orientationchange, resize",function(){h()}).resize(),$(n.events.reload).on("click",function(){c()}),$(n.events.fullscreen).on("click",function(){d()}),i.one("load",function(){if(s(),void 0!==n.triggerOnPlay){var t=i.contents().find(n.events.play);$(t).on("click",function(){n.triggerOnPlay()})}})}({domain:"casinoslists.com",iframe:"#gameplay_iframe",extraElements:".player-controls",mobileWidth:690,desktopWidth:1200,events:{reload:"#play-replay",fullscreen:"#play-fullscreen",play:"#game_play_button"},triggerOnPlay:function(){var t=window.location.href.substring(window.location.href.lastIndexOf("/")+1),e=new XMLHttpRequest;BUSY_REQUEST||(BUSY_REQUEST=!0,e.abort(),e=$.ajax({url:"/play-counter",data:{name:t},dataType:"json",type:"post",success:function(t){},error:function(t){"abort"!=t.statusText&&console.log("err")},complete:function(){BUSY_REQUEST=!1}}))}})});
