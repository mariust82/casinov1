function imageDefer(e){var t=window.navigator.userAgent;if(-1<t.indexOf("MSIE ")||-1<t.indexOf("Trident/"))for(var r=document.getElementsByClassName(e),n=0;n<r.length;n++)r[n].src=r[n].getAttribute("data-src");else{var s=new IntersectionObserver(function(e){for(var t=0;t<e.length;t++){var r=e[t].target;!0===e[t].isIntersecting&&""==r.src&&(r.src=r.getAttribute("data-src"))}},{threshold:[0]});for(r=document.getElementsByClassName(e),n=0;n<r.length;n++)s.observe(r[n])}}
function SearchTracker(e){if("undefined"!=typeof dataLayer){var a,r={event:"search",Category:"UserSearch"};r.item=e,console.log(r),a=r,dataLayer.push(a)}}
var AJAX_CUR_PAGE=1,GAME_CURR_PAGE=1,NEW_CURR_PAGE=1,BEST_CURR_PAGE=1,COUNTRY_CURR_PAGE=1,ALL_CASINOS_KEY=1,BEST_BANKING_PAGE=1,searched_value="",isSearchResultEvent=!1;function tmsIframe(){$(".tms_iframe").length&&$(".tms_iframe").each(function(){var e=document.createElement("iframe");$.each(this.attributes,function(){"class"!=this.name&&e.setAttribute(this.name.replace("data-",""),this.value)}),$(this).append(e)})}function loadScripts(e){$(".controller_main").data("version");$.each(e,function(e,t){$("script[src='/public/build/js/compilations/assets/"+t+".js']").length||$("body").append($('<script type="text/javascript" src="/public/build/js/compilations/assets/'+t+'.js"><\/script>"'))})}function initCustomSelect(){if($(".js-filter").length){var e=$(".js-filter > option");$(".js-filter").select2MultiCheckboxes({templateSelection:function(){return"Game software"}}),e.prop("selected",!1)}}function sliderInit(){new Swiper("#main-carousel",{slidesPerView:6,spaceBetween:5,navigation:{nextEl:".carousel-next",prevEl:".carousel-prev"},breakpoints:{1024:{freeMode:!0,slidesPerView:"auto"}}});var e={slidesPerView:"auto",spaceBetween:30,freeMode:!0,allowTouchMove:!1,on:{slideChangeTransitionStart:function(e){$(".links-left, .links-right").fadeIn("fast")},slideChangeTransitionEnd:function(e){0==this.translate&&$(".links-left").fadeOut("fast"),this.isEnd&&$(".links-right").fadeOut("fast")}},breakpoints:{1024:{allowTouchMove:!0},690:{spaceBetween:15,allowTouchMove:!0}}};if($("#links-nav").length){var t=new Swiper(".links-casinos #links-nav",e),n=new Swiper(".links-games #links-nav",e),o=$("#links-nav .active").parent().index()-1,a=$(window).width()/2-50;$("#links-nav .active").parent().position().left;$(".links-casinos #links-nav").length&&t.slideTo(o,300),$(".links-games #links-nav").length&&n.slideTo(o,300)}if(1024<$(window).width()){function s(e,t,n){var o=e.closest(".swiper-container"),a=t;a.clientX>o.offset().left+o.width()/1.3?n.slideNext(500):a.clientX<o.offset().left+o.width()/6&&n.slidePrev(500)}$(".links-casinos .links-nav a").on("mouseenter",function(e){s($(this),e,t)}),$(".links-games .links-nav a").on("mouseenter",function(e){s($(this),e,n)})}}var initImageLazyLoad=function(){};function runJquery(P){BUSY_REQUEST=!1;var u=P(window).width();P(document).ready(function(){var t,n,o,a,e,s;loadScripts(["tooltipster","swiper"]),-1!=window.location.href.indexOf("games/")&&loadScripts(["jquery-select2"]),function(){var e=document.querySelector(".header-menu__list-holder");if(e){var t=N(),n=t?"click":"hover";e.addEventListener(n,function(e){for(var t,n=e.target;n!=this;){if(n.classList.contains("expand-holder")){if((t=document.querySelector(".expand-holder.opened"))==n){t.querySelector(".expand-menu");"expand-menu"!==e.target.className&&t.classList.remove("opened")}else t?("expand-menu"!==e.target.className&&t.classList.remove("opened"),setTimeout(function(){n.classList.add("opened")},400)):n.classList.add("opened");break}n=n.parentNode}},!0)}}(),B(),t=P("#js-mobile-menu-opener, #js-mobile-menu-close"),n=P(".header-menu"),o=null,a=P("html, body"),t.on("click",function(e){P("body").toggleClass("menu-opened"),t.toggleClass("active"),N()&&(o=P(window).scrollTop(),a.hasClass("no-scroll")?O():(I(),v(o)),P(".expand-menu__list-item.active ").closest(".expand-holder").addClass("opened")),P(document).on("click touchstart",function(e){0==P(e.target).closest(n).length&&0==P(e.target).closest(t).length&&(P("body").removeClass("menu-opened"),N()&&(I(),v(o)),t.removeClass("active"))}),e.preventDefault()}),N()||P(".header-menu__list-holder .expand-holder").on("mouseout",function(e){P(".expand-holder").removeClass("opened")}),e=.01*window.innerHeight,document.documentElement.style.setProperty("--vh",e+"px"),P(window).on("resize",function(){var e=.01*window.innerHeight;document.documentElement.style.setProperty("--vh",e+"px")}),(s=P(".plain-text iframe")).length&&s.each(function(e,t){P(t).wrap('<div class="iframe-wrapper"></div>')}),document.ontouchmove=function(e){e.preventDefault()},P(document).on("focus","input, textarea",function(){P("body").addClass("kbopened")}),P(document).on("blur","input, textarea",function(){P("body").removeClass("kbopened")}),function(){var n=P(".plain-text table, .widget.table table"),o=n.find("tr"),e=n.find("th"),t=!1;P(window).width()<768&&a();function a(){P(".separate-table").remove(),e.each(function(e,t){var a=e,s=P('<table class="separate-table"></table>');o.each(function(e,t){var n=P(t).find("th").eq(a).clone().wrap("<tr></tr>").parent(),o=P(t).find("td").eq(a).clone().wrap("<tr></tr>").parent();s.append(n,o)}),s.insertBefore(n)}),n.remove(),t=!0}P(window).resize(function(){P(window).width()<768?t||a():(n.insertAfter(".separate-table:first"),P(".separate-table").remove(),t=!1)})}(),P(".search_input").on({blur:function(e){var t=P(this).val().trim();isSearchResultEvent||P(".search-tag-manager").length&&P(this).val().trim()==t||2<t.length&&t!=searched_value&&SearchTracker(searched_value=t)}}),P("#search-all").on({mousedown:function(){isSearchResultEvent=!0},mouseup:function(){isSearchResultEvent=!1}}),P(".js-more-games").click(function(){P(this).addClass("loading");var e=P(this).data("software"),t=P(this);console.dir("/games-by-software/"+GAME_CURR_PAGE),_request=P.ajax({url:"/games-by-software/"+GAME_CURR_PAGE,data:{page:GAME_CURR_PAGE,software:e},dataType:"html",type:"post",success:function(e){setTimeout(function(){t.removeClass("loading"),C()},1e3),GAME_CURR_PAGE++,P(".games-list").append(e),P(t).data("total")===P(".games-list").children().length&&P(t).hide()},error:function(e){jQuery.parseJSON(e.responseJSON.body.message)[0];"abort"!=e.statusText&&console.log("err")},complete:function(){BUSY_REQUEST=!1}})}),P(".js-all-casinos").click(function(){P(this).addClass("loading");var e=P(this).data("key"),t=P(this);new p(P("#filters")),_request=P.ajax({url:"/load-all-casinos/"+ALL_CASINOS_KEY,data:{page:ALL_CASINOS_KEY,type:e,software:P(t).data("software")},dataType:"html",type:"post",success:function(e){setTimeout(function(){t.removeClass("loading"),C()},1e3),ALL_CASINOS_KEY++,P(t).parent().prev().find(".list-body").append(e),P(t).data("total")===P(t).parent().prev().find(".list-body").children().length&&P(t).hide()},error:function(e){jQuery.parseJSON(e.responseJSON.body.message)[0];"abort"!=e.statusText&&console.log("err")},complete:function(){BUSY_REQUEST=!1}})}),P(".js-more-casinos").click(function(){P(this).addClass("loading");var n=P(this).data("key"),o=P(this);_request=P.ajax({url:"/casinos-by-software/"+c(n),data:{page:c(n),type:n,software:P(o).data("software")},dataType:"html",type:"post",success:function(e){var t;setTimeout(function(){o.removeClass("loading"),C()},1e3),"new"===(t=n)?NEW_CURR_PAGE++:"best"===t?BEST_CURR_PAGE++:"country"===t&&COUNTRY_CURR_PAGE++,P(o).parent().prev().find(".list-body").append(e),P(o).data("total")===P(o).parent().prev().find(".list-body").children().length&&P(o).hide()},error:function(e){jQuery.parseJSON(e.responseJSON.body.message)[0];"abort"!=e.statusText&&console.log("err")},complete:function(){BUSY_REQUEST=!1}})}),P(".js-more-banking").click(function(){P(this).addClass("loading");P(this).data("key");var t=P(this);_request=P.ajax({url:"/casinos-by-banking/"+BEST_BANKING_PAGE,data:{page:BEST_BANKING_PAGE,banking:P(t).data("banking")},dataType:"html",type:"post",success:function(e){setTimeout(function(){t.removeClass("loading"),C()},1e3),BEST_BANKING_PAGE++,P(t).parent().prev().find(".list-body").append(e),P(t).data("total")===P(t).parent().prev().find(".list-body").children().length&&P(t).hide()},error:function(e){jQuery.parseJSON(e.responseJSON.body.message)[0];"abort"!=e.statusText&&console.log("err")},complete:function(){BUSY_REQUEST=!1}})}),P(".load-more").click(function(){new XMLHttpRequest;var e=P(this).data("category"),t=P(this);P.ajax({url:"/load-more/"+e+"/"+AJAX_CUR_PAGE,data:{page:AJAX_CUR_PAGE,category:e},dataType:"html",type:"post",success:function(e){AJAX_CUR_PAGE++,console.dir(e),console.dir(e),P(".cards-list-wrapper").append(e),P(t).data("total")===P(".cards-list-wrapper").children().length&&P(t).hide()},error:function(e){jQuery.parseJSON(e.responseJSON.body.message)[0];"abort"!=e.statusText&&(console.log("err"),__this.closest(_obj).next(".action-field.not-valid").show())},complete:function(){BUSY_REQUEST=!1}})}),/iPhone|iPad|iPod/i.test(navigator.userAgent)&&P("html").addClass("ios-device");var i;P(window).scrollTop()+P(window).height()>P(document).height()-260?tmsIframe():(i=P(window).width()<768?"touchstart":"mousemove",P(window).one(i,tmsIframe));P(window).trigger("scroll"),new l(P(".header"));var r=P(".rating-container").data("user-rate");P(".box img.not-accepted").length?P(".br-widget a").unbind("mouseenter mouseleave mouseover click"):0<r&&(P(".br-widget").children().each(function(){P(this).unbind("mouseenter mouseleave mouseover click"),parseInt(P(this).data("rating-value"))<=parseInt(r)&&P(this).addClass("br-active")}),P(".br-widget").unbind("mouseenter mouseleave mouseover click"))}),P.fn.scrollEnd=function(t,n){P(this).scroll(function(){var e=P(this);e.data("scrollTimeout")&&clearTimeout(e.data("scrollTimeout")),e.data("scrollTimeout",setTimeout(t,n))})};var e=0;if(P(window).on("scroll",function(){e<P(window).scrollTop()?(P("body").removeClass("site__header_sticky"),e=P(window).scrollTop()):e-P(window).scrollTop()>P(window).height()/3&&(P("body").addClass("site__header_sticky"),e=P(window).scrollTop()),0===P(window).scrollTop()&&P("body").removeClass("site__header_sticky")}),P(window).width()<768&&(P(window).scrollEnd(function(){0!==P(window).scrollTop()&&P("body").addClass("site__header_sticky")},800),/\/reviews\//.test(window.location.href)&&0<P(".btn-group-mobile .btn-middle").length)){var t=!1,n=P(window).height()/2+P(window).scrollTop();P(window).on("scroll",function(){P(window).scrollTop()>n&&!1===t&&(P("body").append('<a rel="nofollow" target="_blank" class="btn-play-now" href="'+P(".btn-group-mobile .btn-middle").attr("href")+'">Play Now</a>'),P("body").addClass("play-now-appended"),t=!0)})}tooltipConfig={trigger:"click",maxWidth:279,animation:"grow",debug:!1},copyTooltipConfig={trigger:"click",maxWidth:260,minWidth:260,animation:"grow",contentAsHTML:!0,debug:!1,functionBefore:function(e,t){e.content('                <div class="centered">                    <i class="icon icon-icon_available"></i> Code copied to clipboard                </div>            ')}},contentTooltipConfig={trigger:"click",minWidth:460,interactive:!0,contentAsHTML:!0,debug:!1,content:P(".loader"),animation:"fade",contentCloning:!1,functionReady:function(){P("body").addClass("shadow"),E(P(".bonus-box"),15),P(".js-tooltip").tooltipster(tooltipConfig)},functionAfter:function(){P("body").removeClass("shadow")},functionBefore:function(t,e){var n=P(e.origin);if(!0!==n.data("loaded")){var o=n.data("name"),a=n.data("is-free"),s=new XMLHttpRequest;s.abort(),s=P.ajax({url:"/casino/bonus",data:{casino:o,is_free:a},dataType:"html",type:"GET",success:function(e){t.content(e),setTimeout(function(){i()},50),n.data("loaded",!0)}})}else setTimeout(function(){i()},50);function i(){P(".js-tooltip").tooltipster(tooltipConfig),P(".js-copy-tooltip").tooltipster(copyTooltipConfig),m(),E(P(".bonus-box"),15)}}};var B=function(){var e,t,n,o,a,s,i,r,l,c;if(P.fn.moreLines=function(u){"use strict";return this.each(function(){var e=P(this),t=(e.find("p"),parseFloat(e.css("line-height"))),n=e.innerHeight(),o=P.extend({linecount:1,baseclass:"b-morelines_",basejsclass:"js-morelines_",classspecific:"section",buttontxtmore:"more lines",buttontxtless:"less lines",animationspeed:1},u),a=o.baseclass+o.classspecific+"_ellipsis",s=o.baseclass+o.classspecific+"_button",i=o.baseclass+o.classspecific+"_wrapper",r=o.basejsclass+o.classspecific+"_wrapper",l=P("<div>").addClass(i+" "+r).css({"max-width":e.css("width")}),c=t*o.linecount;if(e.wrap(l),e.parent().not(r)&&c<n){e.addClass(a).css({"min-height":c,"max-height":c,overflow:"hidden"});var d=P("<div>",{class:s,click:function(){e.toggleClass(a),P(this).toggleClass(s+"_active"),"none"!==e.css("max-height")?e.css({height:c,"max-height":""}).animate({height:"100%"},o.animationspeed,function(){d.html(o.buttontxtless)}):e.animate({height:c},o.animationspeed,function(){d.html(o.buttontxtmore),e.css("max-height",c)})},html:o.buttontxtmore});e.after(d)}}),this},P(".js-condense").moreLines({linecount:3,baseclass:"js-condense",basejsclass:"js-condense",classspecific:"_readmore",buttontxtmore:"Read More",buttontxtless:"Read Less",animationspeed:250}),(e=P(".rating-container")).data("casino-rating"),e.attr("data-user-rate"),initCustomSelect(),t=P(".header-search"),n=P(".js-search-opener",t),o=P(".js-mobile-search-opener"),a=P(".js-search-close",t),s=P(".js-mobile-search-close"),i=P(".js-mobile-search-clear"),r=P(".js-search-drop"),l=P(".header-search-input input"),c=0,n.on("click",function(e){P("body").addClass("search-opened"),l.focus(),g(r),P(document).on("click touchstart",function(e){0==P(e.target).closest(r).length&&0==P(e.target).closest(l).length&&0==P(e.target).closest(o).length&&0==P(e.target).closest(n).length&&(l.val(""),M(r))})}),l.on("keydown",function(e){13!=e.keyCode?(isSearchResultEvent=!0,g(r)):isSearchResultEvent=!1}),a.on("click",function(e){M(r)}),o.on("click",function(e){c=P(window).scrollTop(),P("body").addClass("mobile-search-opened"),O(),l.focus()}),s.on("click",function(e){l.val("").blur(),P("body").removeClass("mobile-search-opened"),I(),v(c)}),i.on("click",function(){l.val("").focus()}),l.on("focus",function(){v(0)}),r.on("scroll",function(e){l.blur()}),m(),h(u),E(P(".list .bonus-box"),21),E(P(".bonus-item .bonus-box"),33),_(),P(".js-table-package-opener").on("click",function(e){P(this).closest("tr").toggleClass("active"),e.preventDefault()}),P(".message .close").on("click",function(e){P(this).parent().fadeOut(),e.preventDefault()}),P(".js-history-back").on("click",function(e){window.history.back(),e.preventDefault()}),0<P("#filters").length&&new p(P("#filters")),0<P("#reviews").length&&(P(".review").each(function(e){new AddingReview(P(this))}),P('[href="#reviews"]').on("click",function(){return function(e,t){if(void 0!==e)o(e,t);else{var n=P(".js-scroll");n.on("click",function(e){var t=P(P(this).attr("href"));o(t,0),e.preventDefault()})}function o(e,t){P("html, body").animate({scrollTop:e.offset().top-t},1e3)}}(P("#reviews"),100),!1})),0<P(".js-run-counter").length){var d=P(".js-run-counter").data("name");runPlayCounter(d)}new f(P(".subscribe")),P(".js-tooltip").tooltipster(tooltipConfig),P(".js-copy-tooltip").tooltipster(copyTooltipConfig),P(".js-tooltip-content").tooltipster(contentTooltipConfig)};function _(){if(10<=function(){var e=-1;if("Microsoft Internet Explorer"==navigator.appName){var t=navigator.userAgent,n=new RegExp("MSIE ([0-9]{1,}[.0-9]{0,})");null!=n.exec(t)&&(e=parseFloat(RegExp.$1))}else if("Netscape"==navigator.appName){var t=navigator.userAgent,n=new RegExp("Trident/.*rv:([0-9]{1,}[.0-9]{0,})");null!=n.exec(t)&&(e=parseFloat(RegExp.$1))}return e}()){P("img.not-accepted").each(function(){var e=P(this);e.css({position:"absolute"}).wrap("<div class='img_wrapper' style='display: inline-block'>").clone().addClass("img_grayscale").css({position:"absolute","z-index":"5",opacity:"0"}).insertBefore(e).queue(function(){var e=P(this);e.parent().css({width:this.width,height:this.height}),e.dequeue()}),this.src=function(e){var t=document.createElement("canvas"),n=t.getContext("2d"),o=new Image;o.src=e,t.width=o.width,t.height=o.height,n.drawImage(o,0,0);for(var a=n.getImageData(0,0,t.width,t.height),s=0;s<a.height;s++)for(var i=0;i<a.width;i++){var r=4*s*a.width+4*i,l=(a.data[r]+a.data[r+1]+a.data[r+2])/3;a.data[r]=l,a.data[r+1]=l,a.data[r+2]=l}return n.putImageData(a,0,0,0,0,a.width,a.height),t.toDataURL()}(this.src)})}}function N(){var e=P(window).width();return P(window).resize(function(){e=P(window).width()}),e<1e3||!!/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)}function E(e,a){P(e).each(function(e,t){var n=P(this).find(".list-item-trun"),o=P(this).find(".bubble");n.text().length>=a&&o.css("visibility","visible")})}function f(e){var t,n=e,o=n.find(".news-email"),a=n.find(".news-btn"),s=P("#news-success"),i=P("#news-note"),r="not-valid",l=new XMLHttpRequest;_prepMessage=function(){return t=o.val(),ok=!0,""!==t&&/^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i.test(t)?o.parent().removeClass(r):(o.parent().addClass(r),ok=!1),ok?i.hide():i.show(),ok},_sendNews=function(e){l.abort(),l=P.ajax({url:"/newsletter/subscribe",data:{email:e},dataType:"json",timeout:2e4,type:"POST",success:function(e){if("ok"==e.status)s.show(),i.hide(),a.prop("disabled",!0),o.val(""),_onEvents();else if("error"==e.status){var t=JSON.parse(e.body);P(".action-added").remove(),P.each(t,function(e,t){var n='<div class="action-field action-added not-valid ">'+t+"</div>";P(".review-submit-holder .msg-holder").append(n)})}},error:function(e){console.error("Could not send message!")}})},_onEvents=function(){a.on({click:function(e){!1===_prepMessage()?e.stopPropagation():_sendNews(t)}})},_init=function(){_onEvents()},_init()}var p=function(e){var s,t,n=e,o=this,a=n.find("input[type=checkbox]"),i=n.find("input[type=radio]"),r=n.find("select[name=soft]"),l=P(".data-container"),c=P(".data-add-container"),d=l.data("type"),u=l.data("type-value"),f=(P(".aj-content"),P(".empty-filters")),p=n.next(".data-container-holder").find(".holder"),h=P(".list-item").length,m=P("#default"),v=P(".qty-items").data("load-total"),g=(Math.floor(v/h),new XMLHttpRequest);void 0===d&&(d="game_type");var b=n.data("url");if(m.prop("checked",!0),"/games-filter/"===b){var w=new MutationObserver(function(e){var t=0;e.forEach(function(e){"childList"===e.type&&0!==e.addedNodes.length&&t<1&&(initImageLazyLoad(),t++)})});w.observe(P(".data-container").get(0),{childList:!0,subtree:!0}),w.observe(P(".data-add-container").get(0),{childList:!0,subtree:!0})}var y=function(e,t,n){var o={};return P.each(a,function(e,t){P(t).is(":checked")&&(o[P(t).attr("name")]=1),"reset"==n&&(o[P(t).attr("name")]="",P(t).prop("checked",!1))}),P.each(i,function(e,t){P(t).is(":checked")&&(o[P(t).attr("name")]=P(t).attr("value")),"reset"==n&&(o[P(t).attr("name")]=1,0==e&&P(t).prop("checked",!0))}),o[e]=t,"undefined"!=r.val()&&null!=r.val()&&(o.software=r.val().join(),"reset"==n&&(o.software="")),void 0===AJAX_CUR_PAGE&&(AJAX_CUR_PAGE=1),"add"==n&&"reset"!=n||(AJAX_CUR_PAGE=0),null!=o.label&&"Mobile"==o.label&&(o.compatibility="mobile",delete o.label),o};_ajaxRequestCasinos=function(e,o){if(console.dir("test"),"add"==o?s.addClass("loading"):P(".overlay, .loader").fadeIn("fast"),!BUSY_REQUEST){BUSY_REQUEST=!0,g.abort();var a="/games-filter/"==b?24:100;"/casinos"===location.pathname&&(b="load-all-casinos/"),g=P.ajax({url:b+AJAX_CUR_PAGE,data:e,dataType:"html",type:"GET",success:function(e){var t=P(e).find(".loaded-item"),n=P(e).filter("[data-load-total]").data("load-total");"replace"==o?(l.html(e),c.html(""),P(".qty-items").attr("data-load-total",n),P(".qty-items-quantity").text(n),t.length===P(".qty-items").attr("data-load-total")?(0<t.length?(p.show(),f.hide()):(p.hide(),f.show()),s.hide()):(s.show(),p.show(),f.hide()),C(),AJAX_CUR_PAGE=1,0):(AJAX_CUR_PAGE++,0,setTimeout(function(){c.append(t),s.removeClass("loading"),C(),t.length<a&&s.hide()},1e3)),_construct(),E(P(".data-add-container .bonus-box, .data-container .bonus-box"),21)},error:function(e){"abort"!=e.statusText&&console.log("err")},complete:function(){BUSY_REQUEST=!1,P(".overlay, .loader").fadeOut("fast"),"/casinos-filter/"===b?parseInt(P(".qty-items").attr("data-load-total"))<=100?P(".js-more-items").hide():P(".js-more-items").show():"/games-filter/"===b&&(parseInt(P(".qty-items-quantity").html())<=24?P(".js-more-items").hide():P(".js-more-items").show()),_()}});var t=setTimeout(function(){},300);_hideLoading=function(){clearTimeout(t)}}},_loadData=function(e){},_construct=function(){s=P(".js-more-items"),t=P(".js-reset-items"),a.off(),a.on("click",function(){_ajaxRequestCasinos(y(d,u),"replace")}),i.off(),i.on("click",function(){_ajaxRequestCasinos(y(d,u),"replace")}),P(".js-filter > option").on("click",function(){P(".js-filter > option").each(function(e,t){P(this).prop("selected")})}),r.off(),r.on("change",function(){_ajaxRequestCasinos(y(d,u),"replace")}),s.off(),s.on("click",function(){return _ajaxRequestCasinos(y(d,u,"add"),"add"),!1}),t.off(),t.on("click",function(){return _ajaxRequestCasinos(y(d,u,"reset"),"add"),!1}),n[0].obj=o},_construct()};var l=function(e){var o,a,t=e,n=this,s=t.find(".js-trigger-search"),i=t.find("#search-all"),r=t.find("#search"),l=t.find("#search-form"),c=(t.find(".search-results"),l.find("input")),d=l.find(".js-mobile-search-clear"),u=r.find("#search-casinos ul"),f=r.find("#search-lists ul"),p=r.find("#search-pages ul"),h=r.find("#search-empty"),g=(r.data("img-dir"),!1),b=1,w=1,y=1,m=new XMLHttpRequest;window.contentBeforeSearch;var _=function(){P("#site-content").html("").append(contentBeforeSearch),P(".js-search-drop").show(),P("body").removeClass("advanced-search-opened"),c.blur(),setTimeout(function(){B()},1e3)},E=function(e,t,n,o){if(!BUSY_REQUEST){BUSY_REQUEST=!0,m.abort(),m=P.ajax({url:e,data:{value:t},dataType:"json",type:"GET",success:function(e){_hideLoading(),j(e,n,o)},error:function(e){"abort"!=e.statusText&&(_hideLoading(),console.log("err"),S())},complete:function(){_hideLoading(),BUSY_REQUEST=!1}});var a=setTimeout(function(){},300);_hideLoading=function(){clearTimeout(a)}}},v=function(){window.scrollTo(0,0);var v=P("#site-content");BUSY_REQUEST||(BUSY_REQUEST=!0,m.abort(),m=P.ajax({url:"/search/advanced",data:{value:c.val()},dataType:"HTML",type:"GET",success:function(e){var t,n,o,a,s,i,r,l,c,d,u,f,p,h,m;P("body").addClass("advanced-search-opened"),g||(contentBeforeSearch=P("#site-content .main, #site-content .promo").detach()),g=!0,v.html(e),U(),t=P("#js-search-more-lists"),n=P(".more-lists",t),o=n.data("total-casinos"),a=P("#js-search-more-casinos"),s=P(".more-num",a),i=s.data("total-casinos"),r=P("#js-search-more-pages"),l=P(".more-num",r),c=l.data("total-games"),d=Math.floor(o/5),u=Math.floor(i/5),f=Math.floor(c/5),h=i%5,m=c%5,(p=o%5)<5&&1==d&&n.text(p),h<5&&1==u&&s.text(h),m<5&&1==f&&l.text(m),t.on("click",function(){return E("/search/more-lists/"+w,P(".search-title span").text(),P("#all-lists-container"),"lists"),d<=w?t.fadeOut():t.fadeIn(),d-1<=w&&0<p&&n.text(p),w++,!1}),a.on("click",function(){return E("/search/more-casinos/"+b,P(".search-title span").text(),P("#all-casinos-container"),"casinos"),u<=b?a.fadeOut():a.fadeIn(),u-1<=b&&0<h&&s.text(h),b++,!1}),r.on("click",function(){return E("/search/more-games/"+y,P(".search-title span").text(),P("#all-games-container"),"games"),f<=y?r.fadeOut():r.fadeIn(),f-1<=y&&0<m&&l.text(m),y++,!1}),I(),v.find("#js-search-back").each(function(){P(this).on({click:function(){_()}})}),P(".js-mobile-search-close").on("click",function(){_()})},error:function(e){"abort"!=e.statusText&&console.log("err")},complete:function(){BUSY_REQUEST=!1}}))},C=function(e,t){if(N()&&O(),!BUSY_REQUEST||a!=o){BUSY_REQUEST=!0,m.abort(),m=P.ajax({url:e,data:{value:c.val(),page:t},dataType:"json",type:"GET",success:function(e){_hideLoading(),x(e)},error:function(e){"abort"!=e.statusText&&(_hideLoading(),console.log("err"),S())},complete:function(e){_hideLoading(),a++,BUSY_REQUEST=!1}});var n=setTimeout(function(){},300);_hideLoading=function(){clearTimeout(n)}}},T=function(e){return e.replace(/\s/g,"-").toLowerCase()},k=function(e){return'<li>                    <a class="search-results-label" href="/'+e.link.replace("/games/","")+'">                        '+e.name+"                    </a>                </li>"},j=function(e,t,n){var o,a=e.body.results;if("lists"===n)for(var s=0;s<a.length;s++){var i=k({link:a[s].url,name:a[s].title});t.append(i)}else for(var r in a){"games"==n?o="play/"+T(a[r]):"casinos"==n&&(o="reviews/"+T(a[r])+"-review");i=k({link:o,name:a[r]});t.append(i)}},x=function(e){var t=e.body.lists,n=e.body.casinos,o=e.body.games;if(f.empty(),u.empty(),p.empty(),P.isEmptyObject(t)&&P.isEmptyObject(n)&&P.isEmptyObject(o))S();else{A(),P.isEmptyObject(t)?f.parent().hide().next().addClass("single"):(f.parent().show().next().removeClass("single"),3<e.body.total_lists&&Math.ceil(e.body.total_lists/3)>w||(w=1)),P.isEmptyObject(n)?u.parent().hide().next().addClass("single"):(u.parent().show().next().removeClass("single"),3<e.body.total_casinos&&Math.ceil(e.body.total_casinos/3)>b||(b=1)),P.isEmptyObject(o)?p.parent().hide().prev().addClass("single"):(p.parent().show().prev().removeClass("single"),3<e.body.total_pages&&Math.ceil(e.body.total_casinos/3)>y||(y=1)),f.html("");for(var a=0;a<t.length;a++){var s=k({link:t[a].url,name:t[a].title});f.append(s)}for(var i in n){s=k({link:"reviews/"+T(n[i])+"-review",name:n[i]});u.append(s)}for(var r in o){s=k({link:"play/"+T(o[r]),name:o[r]});p.append(s)}""!=c.val()&&G()}},R=function(){b=y=1},S=function(){f.parent().hide(),u.parent().hide(),p.parent().hide(),h.show(),i.parent().fadeOut()},A=function(){f.parent().show(),u.parent().show(),p.parent().show(),h.hide()},U=function(){M(P(".js-search-drop")),!0},L=function(){U()},G=function(){t.find(".search-results-label").each(function(){P(this).html(function(e,t){return t.replace(new RegExp(c.val().toLowerCase(),"ig"),"<b>$&</b>")})})};n.close=function(){L()},s.on("click",function(){return C("/search"),R(),!1}),c.on({focus:function(){a=o=0,C("/search"),R()},keyup:function(e){27==e.keyCode?L():13==e.keyCode?(isSearchResultEvent=!0,""!=c.val()&&(v(),c.blur())):(isSearchResultEvent=!1,t.find("#search__popup").addClass("load"),o++,C("/search")),R(),""!=c.val()?i.parent().fadeIn():i.parent().fadeOut()}}),d.on("click",function(){return c.val("").focus(),C("/search"),R(),!1}),i.on("click",function(){return""!=c.val()&&v(),!1}),t[0].obj=n};function h(e){var s=P(".list-item, .pick"),t=(P(".js-mobile-pop"),P(".btn-round")),i=(P(".js-mobile-pop-close"),0);if(e<=690){t.off("click"),t.on("click",function(e){var o,a,t,n;return i=P(window).scrollTop(),P(".overlay, .loader").fadeIn("fast"),o=P(this),a=o.closest(s).find(".list-item-cell-buttons"),o.closest(s).find(".js-tooltip-content"),t=o.data("name"),n=o.data("is-free"),(new XMLHttpRequest).abort(),P.ajax({url:"/casino/bonus",data:{casino:t,is_free:n},dataType:"html",type:"GET",success:function(e){console.log("123"),console.log("response => "+e),P(e).insertAfter(a);var t=o.closest(s).find(".js-mobile-pop");t.find(".js-tooltip").tooltipster(tooltipConfig),t.find(".js-copy-tooltip").tooltipster(copyTooltipConfig);var n=t.find(".js-mobile-pop-close");E(P(".bonus-box"),21),m(),P(".overlay, .loader").fadeOut("fast"),t.fadeIn("fast").fadeIn("fast"),O(),n.on("click",function(e){return t.fadeOut("fast").find(".mobile-popup-body").html(""),I(),P(".overlay, .loader").fadeOut("fast"),v(i),P(t).remove(),!1})}}),!1})}}function m(){window.Clipboard=function(d,u,e){var f;function p(){return e.userAgent.match(/ipad|iphone/i)}return{copy:function(e,t){var n,o,a,s,i,r,l,c=(n=e,(o=document.createElement("DIV")).innerHTML=n,o.textContent||o.innerText||"");a=c,s=t,f=u.createElement("textArea"),p()&&f.setAttribute("readonly","readonly"),f.value=a,s.parent().append(f),p()?((i=u.createRange()).selectNodeContents(f),(r=d.getSelection()).removeAllRanges(),r.addRange(i),f.setSelectionRange(0,999999)):f.select(),l=t,u.execCommand("copy"),l.parent().find(f).remove()}}}(window,document,navigator),P(".js-copy-to-clip").on("click touch",function(e){Clipboard.copy(P(this).data("code"),P(this)),e.preventDefault()})}function v(e){P("html, body").animate({scrollTop:e},5)}function O(){P("html, body").addClass("no-scroll")}function I(){P("html, body").removeClass("no-scroll")}function g(e){setTimeout(function(){e.slideDown("fast")},300)}function M(e){e.slideUp("fast"),setTimeout(function(){P("body").removeClass("search-opened")},300)}function c(e){var t;return"new"===e?t=NEW_CURR_PAGE:"best"===e?t=BEST_CURR_PAGE:"country"===e&&(t=COUNTRY_CURR_PAGE),t}function C(){P(".js-tooltip").tooltipster(tooltipConfig),P(".js-copy-tooltip").tooltipster(copyTooltipConfig),P(".js-tooltip-content").tooltipster(contentTooltipConfig),h(u)}}!function(){var e=setInterval(function(){console.log(window.jQuery),window.jQuery&&(runJquery(jQuery),clearInterval(e))},100)}();
"use strict";$(function(){var f=null!==document.ontouchstart?"click":"touchstart",g=function(o,l,t,s,c){function d(t,e,n){n=void 0===n?0:"-"+n+"px",o.css({"margin-right":n}).width(Math.round(t)).height(Math.round(e))}this.resizeOnWidth=function(t){d(t,t*l)},this.resizeOnWidthHeight=function(t,e){if(l<e/t){c("height");var n=t*l;if(n+2*s.outerHeight(!0)>e){var o=n+(e-n-2*s.outerHeight(!0));d(o/l,o)}else d(t,n)}else{c("width");var i=e/l,r=s.outerWidth(!0);if(t<i+2*r){var a=i+(t-i-2*r);d(a,a*l)}else d(i,e)}}};new function(n){document.domain=n.domain;var t=!1,o=!1,i=$(n.iframe),e=$(n.extraElements),r=!1,a=i.attr("height")/i.attr("width");i.removeAttr("width").removeAttr("height");var l=new g(i,a,n.mobileWidth,e,function(t){u(),"width"==t?n.tabletWidth>$(window).width()?e.addClass("left-player-controler"):e.addClass("right-player-controler"):"height"==t&&e.addClass("top-player-controler")});function s(){var t=i.contents().find("#overlay").attr("data-game-url");if(void 0!==t&&!1!==t){o=!0;var e=i.contents().find(n.events.play);$(e).on(f,function(){e.trigger("click"),d()})}}function c(){var t=i.attr("src");i.attr("src",null),o&&!r&&(r=!0,i.load(function(){s()})),i.attr("src",t)}function d(){t?(t=!1,o&&c(),$("body").removeClass("fullscreenGameplay"),u()):(t=!0,$("body").addClass("fullscreenGameplay")),h()}function u(){e.removeClass("top-player-controler").removeClass("left-player-controler").removeClass("right-player-controler")}function h(){t?l.resizeOnWidthHeight($(window).width(),$(window).height()):l.resizeOnWidth(i.parent().width())}$(window).on("orientationchange, resize",function(){h()}).resize(),$(n.events.reload).on("click",function(){c()}),$(n.events.fullscreen).on("click",function(){d()}),i.one("load",function(){if(s(),void 0!==n.triggerOnPlay){var t=i.contents().find(n.events.play);$(t).on("click",function(){n.triggerOnPlay()})}})}({domain:"casinoslists.com",iframe:"#gameplay_iframe",extraElements:".player-controls",mobileWidth:690,desktopWidth:1200,events:{reload:"#play-replay",fullscreen:"#play-fullscreen",play:"#game_play_button"},triggerOnPlay:function(){var t=window.location.href.substring(window.location.href.lastIndexOf("/")+1),e=new XMLHttpRequest;BUSY_REQUEST||(BUSY_REQUEST=!0,e.abort(),e=$.ajax({url:"/play-counter",data:{name:t},dataType:"json",type:"post",success:function(t){},error:function(t){"abort"!=t.statusText&&console.log("err")},complete:function(){BUSY_REQUEST=!1}}))}})});
