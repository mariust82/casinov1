function SearchTracker(e){if("undefined"!=typeof dataLayer){var a,r={event:"search",Category:"UserSearch"};r.item=e,console.log(r),a=r,dataLayer.push(a)}}
var AJAX_CUR_PAGE=1,GAME_CURR_PAGE=1,NEW_CURR_PAGE=1,BEST_CURR_PAGE=1,COUNTRY_CURR_PAGE=1,ALL_CASINOS_KEY=1,BEST_BANKING_PAGE=1,searched_value="",isSearchResultEvent=!1;function tmsIframe(){$(".tms_iframe").length&&$(".tms_iframe").each(function(){var e=document.createElement("iframe");$.each(this.attributes,function(){"class"!=this.name&&e.setAttribute(this.name.replace("data-",""),this.value)}),$(this).append(e)})}var initImageLazyLoad=function(){imageDefer("lazy_loaded")};function validateEmail(e){return/^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i.test(e)}!function(L){BUSY_REQUEST=!1;var p=L(window).width();L(document).ready(function(){var t,n,a,o,e,s;initImageLazyLoad(),function(){var e=document.querySelector(".header-menu__list-holder");if(e){var t=N(),n=t?"click":"hover";e.addEventListener(n,function(e){for(var t,n=e.target;n!=this;){if(n.classList.contains("expand-holder")){if((t=document.querySelector(".expand-holder.opened"))==n){t.querySelector(".expand-menu");"expand-menu"!==e.target.className&&t.classList.remove("opened")}else t?("expand-menu"!==e.target.className&&t.classList.remove("opened"),setTimeout(function(){n.classList.add("opened")},400)):n.classList.add("opened");break}n=n.parentNode}},!0)}}(),P(),t=L("#js-mobile-menu-opener, #js-mobile-menu-close"),n=L(".header-menu"),a=null,o=L("html, body"),t.on("click",function(e){L("body").toggleClass("menu-opened"),t.toggleClass("active"),N()&&(a=L(window).scrollTop(),o.hasClass("no-scroll")?O():(M(),x(a)),L(".expand-menu__list-item.active ").closest(".expand-holder").addClass("opened")),L(document).on("click touchstart",function(e){0==L(e.target).closest(n).length&&0==L(e.target).closest(t).length&&(L("body").removeClass("menu-opened"),N()&&(M(),x(a)),t.removeClass("active"))}),e.preventDefault()}),N()||L(".header-menu__list-holder .expand-holder").on("mouseout",function(e){L(".expand-holder").removeClass("opened")}),e=.01*window.innerHeight,document.documentElement.style.setProperty("--vh",e+"px"),L(window).on("resize",function(){var e=.01*window.innerHeight;document.documentElement.style.setProperty("--vh",e+"px")}),(s=L(".plain-text iframe")).length&&s.each(function(e,t){L(t).wrap('<div class="iframe-wrapper"></div>')}),document.ontouchmove=function(e){e.preventDefault()},L(document).on("focus","input, textarea",function(){L("body").addClass("kbopened")}),L(document).on("blur","input, textarea",function(){L("body").removeClass("kbopened")}),function(){var n=L(".plain-text table, .widget.table table"),a=n.find("tr"),e=n.find("th"),t=!1;L(window).width()<768&&o();function o(){L(".separate-table").remove(),e.each(function(e,t){var o=e,s=L('<table class="separate-table"></table>');a.each(function(e,t){var n=L(t).find("th").eq(o).clone().wrap("<tr></tr>").parent(),a=L(t).find("td").eq(o).clone().wrap("<tr></tr>").parent();s.append(n,a)}),s.insertBefore(n)}),n.remove(),t=!0}L(window).resize(function(){L(window).width()<768?t||o():(n.insertAfter(".separate-table:first"),L(".separate-table").remove(),t=!1)})}(),L(".search_input").on({blur:function(e){var t=L(this).val().trim();isSearchResultEvent||L(".search-tag-manager").length&&L(this).val().trim()==t||2<t.length&&t!=searched_value&&SearchTracker(searched_value=t)}}),L("#search-all").on({mousedown:function(){isSearchResultEvent=!0},mouseup:function(){isSearchResultEvent=!1}}),L(".js-more-games").click(function(){L(this).addClass("loading");var e=L(this).data("software"),t=L(this);console.dir("/games-by-software/"+GAME_CURR_PAGE),_request=L.ajax({url:"/games-by-software/"+GAME_CURR_PAGE,data:{page:GAME_CURR_PAGE,software:e},dataType:"html",type:"post",success:function(e){setTimeout(function(){t.removeClass("loading"),j()},1e3),GAME_CURR_PAGE++,L(".games-list").append(e),L(t).data("total")===L(".games-list").children().length&&L(t).hide()},error:function(e){jQuery.parseJSON(e.responseJSON.body.message)[0];"abort"!=e.statusText&&console.log("err")},complete:function(){BUSY_REQUEST=!1}})}),L(".js-all-casinos").click(function(){L(this).addClass("loading");var e=L(this).data("key"),t=L(this);new v(L("#filters")),_request=L.ajax({url:"/load-all-casinos/"+ALL_CASINOS_KEY,data:{page:ALL_CASINOS_KEY,type:e,software:L(t).data("software")},dataType:"html",type:"post",success:function(e){setTimeout(function(){t.removeClass("loading"),j()},1e3),ALL_CASINOS_KEY++,L(t).parent().prev().find(".list-body").append(e),L(t).data("total")===L(t).parent().prev().find(".list-body").children().length&&L(t).hide()},error:function(e){jQuery.parseJSON(e.responseJSON.body.message)[0];"abort"!=e.statusText&&console.log("err")},complete:function(){BUSY_REQUEST=!1}})}),L(".js-more-casinos").click(function(){L(this).addClass("loading");var n=L(this).data("key"),a=L(this);_request=L.ajax({url:"/casinos-by-software/"+l(n),data:{page:l(n),type:n,software:L(a).data("software")},dataType:"html",type:"post",success:function(e){var t;setTimeout(function(){a.removeClass("loading"),j()},1e3),"new"===(t=n)?NEW_CURR_PAGE++:"best"===t?BEST_CURR_PAGE++:"country"===t&&COUNTRY_CURR_PAGE++,L(a).parent().prev().find(".list-body").append(e),L(a).data("total")===L(a).parent().prev().find(".list-body").children().length&&L(a).hide()},error:function(e){jQuery.parseJSON(e.responseJSON.body.message)[0];"abort"!=e.statusText&&console.log("err")},complete:function(){BUSY_REQUEST=!1}})}),L(".js-more-banking").click(function(){L(this).addClass("loading");L(this).data("key");var t=L(this);_request=L.ajax({url:"/casinos-by-banking/"+BEST_BANKING_PAGE,data:{page:BEST_BANKING_PAGE,banking:L(t).data("banking")},dataType:"html",type:"post",success:function(e){setTimeout(function(){t.removeClass("loading"),j()},1e3),BEST_BANKING_PAGE++,L(t).parent().prev().find(".list-body").append(e),L(t).data("total")===L(t).parent().prev().find(".list-body").children().length&&L(t).hide()},error:function(e){jQuery.parseJSON(e.responseJSON.body.message)[0];"abort"!=e.statusText&&console.log("err")},complete:function(){BUSY_REQUEST=!1}})}),L(".load-more").click(function(){new XMLHttpRequest;var e=L(this).data("category"),t=L(this);L.ajax({url:"/load-more/"+e+"/"+AJAX_CUR_PAGE,data:{page:AJAX_CUR_PAGE,category:e},dataType:"html",type:"post",success:function(e){AJAX_CUR_PAGE++,console.dir(e),console.dir(e),L(".cards-list-wrapper").append(e),L(t).data("total")===L(".cards-list-wrapper").children().length&&L(t).hide()},error:function(e){jQuery.parseJSON(e.responseJSON.body.message)[0];"abort"!=e.statusText&&(console.log("err"),__this.closest(_obj).next(".action-field.not-valid").show())},complete:function(){BUSY_REQUEST=!1}})}),/iPhone|iPad|iPod/i.test(navigator.userAgent)&&L("html").addClass("ios-device");var i;L(window).scrollTop()+L(window).height()>L(document).height()-260?tmsIframe():(i=L(window).width()<768?"touchstart":"mousemove",L(window).one(i,tmsIframe));L(window).trigger("scroll"),new c(L(".header"));var r=L(".rating-container").data("user-rate");L(".box img.not-accepted").length?L(".br-widget a").unbind("mouseenter mouseleave mouseover click"):0<r&&(L(".br-widget").children().each(function(){L(this).unbind("mouseenter mouseleave mouseover click"),parseInt(L(this).data("rating-value"))<=parseInt(r)&&L(this).addClass("br-active")}),L(".br-widget").unbind("mouseenter mouseleave mouseover click")),initImageLazyLoad()}),L.fn.scrollEnd=function(t,n){L(this).scroll(function(){var e=L(this);e.data("scrollTimeout")&&clearTimeout(e.data("scrollTimeout")),e.data("scrollTimeout",setTimeout(t,n))})};var e=0;if(L(window).on("scroll",function(){e<L(window).scrollTop()?(L("body").removeClass("site__header_sticky"),e=L(window).scrollTop()):e-L(window).scrollTop()>L(window).height()/3&&(L("body").addClass("site__header_sticky"),e=L(window).scrollTop()),0===L(window).scrollTop()&&L("body").removeClass("site__header_sticky")}),L(window).width()<768&&(L(window).scrollEnd(function(){0!==L(window).scrollTop()&&L("body").addClass("site__header_sticky")},800),/\/reviews\//.test(window.location.href)&&0<L(".btn-group-mobile .btn-middle").length)){var t=!1,n=L(window).height()/2+L(window).scrollTop();L(window).on("scroll",function(){L(window).scrollTop()>n&&!1===t&&(L("body").append('<a rel="nofollow" target="_blank" class="btn-play-now" href="'+L(".btn-group-mobile .btn-middle").attr("href")+'">Play Now</a>'),L("body").addClass("play-now-appended"),t=!0)})}function h(e){var n=L(".controller_main").data("version");L.each(e,function(e,t){L("script[src='/public/build/js/compilations/assets/"+t+".js']").length||L("body").append(L('<script type="text/javascript" src="/public/build/js/compilations/assets/'+t+".js?"+n+'"><\/script>"'))})}tooltipConfig={trigger:"click",maxWidth:279,animation:"grow",debug:!1},copyTooltipConfig={trigger:"click",maxWidth:260,minWidth:260,animation:"grow",contentAsHTML:!0,debug:!1,functionBefore:function(e,t){e.content('                <div class="centered">                    <i class="icon icon-icon_available"></i> Code copied to clipboard                </div>            ')}},contentTooltipConfig={trigger:"click",minWidth:460,interactive:!0,contentAsHTML:!0,debug:!1,content:L(".loader"),animation:"fade",contentCloning:!1,functionReady:function(){L("body").addClass("shadow"),E(L(".bonus-box"),15),L(".js-tooltip").tooltipster(tooltipConfig)},functionAfter:function(){L("body").removeClass("shadow")},functionBefore:function(t,e){var n=L(e.origin);if(!0!==n.data("loaded")){var a=n.data("name"),o=n.data("is-free"),s=new XMLHttpRequest;s.abort(),s=L.ajax({url:"/casino/bonus",data:{casino:a,is_free:o},dataType:"html",type:"GET",success:function(e){t.content(e),setTimeout(function(){i()},50),n.data("loaded",!0)}})}else setTimeout(function(){i()},50);function i(){L(".js-tooltip").tooltipster(tooltipConfig),L(".js-copy-tooltip").tooltipster(copyTooltipConfig),k(),E(L(".bonus-box"),15)}}};var P=function(){var o,s,e,t,n,a,i,r,c,l,d,u;if(function(){if(!L("#main-carousel").length&&!L("#links-nav").length)return;h(["swiper"]);new Swiper("#main-carousel",{slidesPerView:6,spaceBetween:50,navigation:{nextEl:".carousel-next",prevEl:".carousel-prev"},breakpoints:{1024:{freeMode:!0,slidesPerView:"auto"}}});var e={slidesPerView:"auto",spaceBetween:30,freeMode:!0,allowTouchMove:!1,on:{slideChangeTransitionStart:function(e){L(".links-left, .links-right").fadeIn("fast")},slideChangeTransitionEnd:function(e){0==this.translate&&L(".links-left").fadeOut("fast"),this.isEnd&&L(".links-right").fadeOut("fast")}},breakpoints:{1024:{allowTouchMove:!0},690:{spaceBetween:15,allowTouchMove:!0}}};if(L("#links-nav").length){var t=new Swiper(".links-casinos #links-nav",e),n=new Swiper(".links-games #links-nav",e),a=L("#links-nav .active").parent().index()-1;L(".links-casinos #links-nav").length&&t.slideTo(a,300),L(".links-games #links-nav").length&&n.slideTo(a,300)}if(1024<L(window).width()){function o(e,t,n){var a=e.closest(".swiper-container"),o=t;o.clientX>a.offset().left+a.width()/1.3?n.slideNext(500):o.clientX<a.offset().left+a.width()/6&&n.slidePrev(500)}L(".links-casinos .links-nav a").on("mouseenter",function(e){o(L(this),e,t)}),L(".links-games .links-nav a").on("mouseenter",function(e){o(L(this),e,n)})}}(),L.fn.moreLines=function(u){"use strict";return this.each(function(){var e=L(this),t=(e.find("p"),parseFloat(e.css("line-height"))),n=e.innerHeight(),a=L.extend({linecount:1,baseclass:"b-morelines_",basejsclass:"js-morelines_",classspecific:"section",buttontxtmore:"more lines",buttontxtless:"less lines",animationspeed:1},u),o=a.baseclass+a.classspecific+"_ellipsis",s=a.baseclass+a.classspecific+"_button",i=a.baseclass+a.classspecific+"_wrapper",r=a.basejsclass+a.classspecific+"_wrapper",c=L("<div>").addClass(i+" "+r).css({"max-width":e.css("width")}),l=t*a.linecount;if(e.wrap(c),e.parent().not(r)&&l<n){e.addClass(o).css({"min-height":l,"max-height":l,overflow:"hidden"});var d=L("<div>",{class:s,click:function(){e.toggleClass(o),L(this).toggleClass(s+"_active"),"none"!==e.css("max-height")?e.css({height:l,"max-height":""}).animate({height:"100%"},a.animationspeed,function(){d.html(a.buttontxtless)}):e.animate({height:l},a.animationspeed,function(){d.html(a.buttontxtmore),e.css("max-height",l)})},html:a.buttontxtmore});e.after(d)}}),this},L(".js-condense").moreLines({linecount:3,baseclass:"js-condense",basejsclass:"js-condense",classspecific:"_readmore",buttontxtmore:"Read More",buttontxtless:"Read Less",animationspeed:250}),(o=L(".rating-container")).data("casino-rating"),s=o.attr("data-user-rate"),e={showSelectedRating:!1,onSelect:function(e,t,n){if(void 0!==n){var a=L(n.currentTarget);L(".br-widget").children().each(function(){L(this).unbind("mouseenter mouseleave mouseover click"),parseInt(L(this).data("rating-value"))<=parseInt(s)&&L(this).addClass("br-active")}),L(".br-widget").unbind("mouseenter mouseleave mouseover click"),a.closest(o).find(".rating-current-text").text(t).removeClass("terrible poor good very-good excellent").attr("class","rating-current-text "+T(t)),a.closest(o).find(".rating-current-value span").text(e),a.closest(o).find(".rating-current").attr("data-rating-current",e),new Score({value:e,name:o.data("casino-name")})}}},L(".rating-bar",o).barrating("show",e),function(){if(!L(".js-filter").length)return;h(["jquery-select2"]);var e=L(".js-filter > option");L(".js-filter").select2MultiCheckboxes({templateSelection:function(){return"Game software"}}),e.prop("selected",!1)}(),t=L(".header-search"),n=L(".js-search-opener",t),a=L(".js-mobile-search-opener"),i=L(".js-search-close",t),r=L(".js-mobile-search-close"),c=L(".js-mobile-search-clear"),l=L(".js-search-drop"),d=L(".header-search-input input"),u=0,n.on("click",function(e){L("body").addClass("search-opened"),d.focus(),C(l),L(document).on("click touchstart",function(e){0==L(e.target).closest(l).length&&0==L(e.target).closest(d).length&&0==L(e.target).closest(a).length&&0==L(e.target).closest(n).length&&(d.val(""),I(l))})}),d.on("keydown",function(e){13!=e.keyCode?(isSearchResultEvent=!0,C(l)):isSearchResultEvent=!1}),i.on("click",function(e){I(l)}),a.on("click",function(e){u=L(window).scrollTop(),L("body").addClass("mobile-search-opened"),O(),d.focus()}),r.on("click",function(e){d.val("").blur(),L("body").removeClass("mobile-search-opened"),M(),x(u)}),c.on("click",function(){d.val("").focus()}),d.on("focus",function(){x(0)}),l.on("scroll",function(e){d.blur()}),k(),y(p),g(),L("#reviews").on("click",".js-reply-btn",function(e){var t=L(this).closest(".reply.review");if(0<t.length&&0<t.find(".reply-data-holder").length){var n=L(this).parent().parent().parent().find(".review-name").text();L(this).parent().parent().find("textarea").val("@"+n+" ")}return L(this).parent().next().slideToggle(),!1}),w(),function o(){var e=L(".js-more-reviews");var s=L("#review-data-holder");var i=L(".reply-data-holder");var t=L(".rating-container").data("casino-name");var r=new XMLHttpRequest;e.on("click",function(){return n(L(this),L(this).data("type")),!1});L(".not-accepted").length&&e.css("pointer-events","auto");var n=function(n,a){BUSY_REQUEST||(BUSY_REQUEST=!0,r.abort(),r=L.ajax({url:"/casino/more-reviews/"+T(t)+"/"+n.data("page"),dataType:"HTML",data:{id:n.data("id"),type:a},type:"GET",success:function(e){"review"==a?(s.append(e),n.data("page")>=n.data("total")/5-1&&n.hide()):"reply"==a&&n.closest(".reply").find(i).append(e),n.data("page")>=n.data("total")/5-1&&n.hide();var t=n.data("page");n.data("page",++t),c(),o()},error:function(e){"abort"!=e.statusText&&console.log("err")},complete:function(){BUSY_REQUEST=!1}}))},c=function(){g(),w(),new b(L(".js-vote")),L(".review").each(function(){new AddingReview(L(this))}),_()}}(),E(L(".list .bonus-box"),21),E(L(".bonus-item .bonus-box"),33),_(),L(".js-table-package-opener").on("click",function(e){L(this).closest("tr").toggleClass("active"),e.preventDefault()}),L(".message .close").on("click",function(e){L(this).parent().fadeOut(),e.preventDefault()}),L(".js-history-back").on("click",function(e){window.history.back(),e.preventDefault()}),0<L("#filters").length&&new v(L("#filters")),0<L("#reviews").length&&(L(".review").each(function(e){new AddingReview(L(this))}),L('[href="#reviews"]').on("click",function(){return function(e,t){if(void 0!==e)a(e,t);else{var n=L(".js-scroll");n.on("click",function(e){var t=L(L(this).attr("href"));a(t,0),e.preventDefault()})}function a(e,t){L("html, body").animate({scrollTop:e.offset().top-t},1e3)}}(L("#reviews"),100),!1})),0<L(".js-vote").length&&new b(L(".js-vote")),0<L(".js-run-counter").length){var f=L(".js-run-counter").data("name");runPlayCounter(f)}0<L(".contact-form").length&&new handleContactUs(L(".contact-form")),new m(L(".subscribe")),h(["tooltipster"]),L(".js-tooltip").tooltipster(tooltipConfig),L(".js-copy-tooltip").tooltipster(copyTooltipConfig),L(".js-tooltip-content").tooltipster(contentTooltipConfig)};function _(){if(10<=function(){var e=-1;if("Microsoft Internet Explorer"==navigator.appName){var t=navigator.userAgent,n=new RegExp("MSIE ([0-9]{1,}[.0-9]{0,})");null!=n.exec(t)&&(e=parseFloat(RegExp.$1))}else if("Netscape"==navigator.appName){var t=navigator.userAgent,n=new RegExp("Trident/.*rv:([0-9]{1,}[.0-9]{0,})");null!=n.exec(t)&&(e=parseFloat(RegExp.$1))}return e}()){L("img.not-accepted").each(function(){var e=L(this);e.css({position:"absolute"}).wrap("<div class='img_wrapper' style='display: inline-block'>").clone().addClass("img_grayscale").css({position:"absolute","z-index":"5",opacity:"0"}).insertBefore(e).queue(function(){var e=L(this);e.parent().css({width:this.width,height:this.height}),e.dequeue()}),this.src=function(e){var t=document.createElement("canvas"),n=t.getContext("2d"),a=new Image;a.src=e,t.width=a.width,t.height=a.height,n.drawImage(a,0,0);for(var o=n.getImageData(0,0,t.width,t.height),s=0;s<o.height;s++)for(var i=0;i<o.width;i++){var r=4*s*o.width+4*i,c=(o.data[r]+o.data[r+1]+o.data[r+2])/3;o.data[r]=c,o.data[r+1]=c,o.data[r+2]=c}return n.putImageData(o,0,0,0,0,o.width,o.height),t.toDataURL()}(this.src)})}}function N(){var e=L(window).width();return L(window).resize(function(){e=L(window).width()}),e<1e3||!!/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)}function E(e,o){L(e).each(function(e,t){var n=L(this).find(".list-item-trun"),a=L(this).find(".bubble");n.text().length>=o&&a.css("visibility","visible")})}function m(e){var t,n=e,a=n.find(".news-email"),o=n.find(".news-btn"),s=L("#news-success"),i=L("#news-note"),r="not-valid",c=new XMLHttpRequest;_prepMessage=function(){return t=a.val(),ok=!0,""!==t&&validateEmail(t)?a.parent().removeClass(r):(a.parent().addClass(r),ok=!1),ok?i.hide():i.show(),ok},_sendNews=function(e){c.abort(),c=L.ajax({url:"/newsletter/subscribe",data:{email:e},dataType:"json",timeout:2e4,type:"POST",success:function(e){if("ok"==e.status)s.show(),i.hide(),o.prop("disabled",!0),a.val(""),_onEvents();else if("error"==e.status){var t=JSON.parse(e.body);L(".action-added").remove(),L.each(t,function(e,t){var n='<div class="action-field action-added not-valid ">'+t+"</div>";L(".review-submit-holder .msg-holder").append(n)})}},error:function(e){console.error("Could not send message!")}})},_onEvents=function(){o.on({click:function(e){!1===_prepMessage()?e.stopPropagation():_sendNews(t)}})},_init=function(){_onEvents()},_init()}var v=function(e){var s,t,n=e,a=this,o=n.find("input[type=checkbox]"),i=n.find("input[type=radio]"),r=n.find("select[name=soft]"),c=L(".data-container"),l=L(".data-add-container"),d=c.data("type"),u=c.data("type-value"),f=(L(".aj-content"),L(".empty-filters")),p=n.next(".data-container-holder").find(".holder"),h=L(".list-item").length,m=L("#default"),v=L(".qty-items").data("load-total"),g=(Math.floor(v/h),new XMLHttpRequest);void 0===d&&(d="game_type");var b=n.data("url");if(m.prop("checked",!0),"/games-filter/"===b){var w=new MutationObserver(function(e){var t=0;e.forEach(function(e){"childList"===e.type&&0!==e.addedNodes.length&&t<1&&(initImageLazyLoad(),t++)})});w.observe(L(".data-container").get(0),{childList:!0,subtree:!0}),w.observe(L(".data-add-container").get(0),{childList:!0,subtree:!0})}var y=function(e,t,n){var a={};return L.each(o,function(e,t){L(t).is(":checked")&&(a[L(t).attr("name")]=1),"reset"==n&&(a[L(t).attr("name")]="",L(t).prop("checked",!1))}),L.each(i,function(e,t){L(t).is(":checked")&&(a[L(t).attr("name")]=L(t).attr("value")),"reset"==n&&(a[L(t).attr("name")]=1,0==e&&L(t).prop("checked",!0))}),a[e]=t,"undefined"!=r.val()&&null!=r.val()&&(a.software=r.val().join(),"reset"==n&&(a.software="")),void 0===AJAX_CUR_PAGE&&(AJAX_CUR_PAGE=1),"add"==n&&"reset"!=n||(AJAX_CUR_PAGE=0),null!=a.label&&"Mobile"==a.label&&(a.compatibility="mobile",delete a.label),a};_ajaxRequestCasinos=function(e,a){if(console.dir("test"),"add"==a?s.addClass("loading"):L(".overlay, .loader").fadeIn("fast"),!BUSY_REQUEST){BUSY_REQUEST=!0,g.abort();var o="/games-filter/"==b?24:100;"/casinos"===location.pathname&&(b="load-all-casinos/"),g=L.ajax({url:b+AJAX_CUR_PAGE,data:e,dataType:"html",type:"GET",success:function(e){var t=L(e).find(".loaded-item"),n=L(e).filter("[data-load-total]").data("load-total");"replace"==a?(c.html(e),l.html(""),L(".qty-items").attr("data-load-total",n),L(".qty-items-quantity").text(n),t.length===L(".qty-items").attr("data-load-total")?(0<t.length?(p.show(),f.hide()):(p.hide(),f.show()),s.hide()):(s.show(),p.show(),f.hide()),j(),AJAX_CUR_PAGE=1,0):(AJAX_CUR_PAGE++,0,setTimeout(function(){l.append(t),s.removeClass("loading"),j(),t.length<o&&s.hide()},1e3)),_construct(),E(L(".data-add-container .bonus-box, .data-container .bonus-box"),21)},error:function(e){"abort"!=e.statusText&&console.log("err")},complete:function(){BUSY_REQUEST=!1,L(".overlay, .loader").fadeOut("fast"),"/casinos-filter/"===b?parseInt(L(".qty-items").attr("data-load-total"))<=100?L(".js-more-items").hide():L(".js-more-items").show():"/games-filter/"===b&&(parseInt(L(".qty-items-quantity").html())<=24?L(".js-more-items").hide():L(".js-more-items").show()),_()}})}},_construct=function(){s=L(".js-more-items"),t=L(".js-reset-items"),o.off(),o.on("click",function(){_ajaxRequestCasinos(y(d,u),"replace")}),i.off(),i.on("click",function(){_ajaxRequestCasinos(y(d,u),"replace")}),L(".js-filter > option").on("click",function(){L(".js-filter > option").each(function(e,t){L(this).prop("selected")})}),r.off(),r.on("change",function(){_ajaxRequestCasinos(y(d,u),"replace")}),s.off(),s.on("click",function(){return _ajaxRequestCasinos(y(d,u,"add"),"add"),!1}),t.off(),t.on("click",function(){return _ajaxRequestCasinos(y(d,u,"reset"),"add"),!1}),n[0].obj=a},_construct()};function g(){var e=L(".expanding"),t=L(".js-expanding-textfields");L(".box img.not-accepted").length?e.unbind("mouseenter mouseleave mouseover click focus"):e.on("focus",function(){L(this).removeClass("expanding"),L(this).closest(".form").find(t).slideDown()})}var b=function(e){var s=e,t=s.find(".vote-button"),n=new XMLHttpRequest,a=function(e,t,n){return{id:t,is_like:n}};_getTarget=function(e){var t="/casino/review-like";return"article"===e&&(t="/blog/rate"),t},_updateVote=function(a,o,e){BUSY_REQUEST||(BUSY_REQUEST=!0,n.abort(),n=L.ajax({url:o,data:e,dataType:"json",type:"post",success:function(e){if("/casino/review-like"===o){if("not_ok"==e.body.status)console.log(e.body.message);else{var t=L(a).find(".bubble-vote"),n=t.text();t.text(++n)}a.closest(s).next(".action-field.success").show()}else"/blog/rate"===o&&(L(a.parent().parent()).find(".votes-like .vote-block-num, .like .vote-block-num").text(e.body.likes),L(a.parent().parent()).find(".votes-dislike .vote-block-num, .dislike .vote-block-num").text(e.body.dislikes),a.closest(s).next(".action-field.success").show())},error:function(e){jQuery.parseJSON(e.responseJSON.body.message)[0];"abort"!=e.statusText&&__this.closest(s).next(".action-field.not-valid").show()},complete:function(){BUSY_REQUEST=!1}}))},t.off(),t.on("click",function(){var e=L(this).data("id"),t=L(this).data("success"),n=L(this).data("type");return _updateVote(L(this),_getTarget(n),a(n,e,t)),!1})};var c=function(e){var n,a,t=e,o=this,s=t.find(".js-trigger-search"),i=t.find("#search-all"),r=t.find("#search"),c=t.find("#search-form"),l=c.find("input"),d=c.find(".js-mobile-search-clear"),u=r.find("#search-casinos ul"),f=r.find("#search-lists ul"),p=r.find("#search-pages ul"),h=r.find("#search-empty"),g=(r.data("img-dir"),!1),b=1,w=1,y=1,m=new XMLHttpRequest;window.contentBeforeSearch;var _=function(){L("#site-content").html("").append(contentBeforeSearch),L(".js-search-drop").show(),L("body").removeClass("advanced-search-opened"),l.blur(),setTimeout(function(){P()},1e3)},E=function(e,t,n,a){BUSY_REQUEST||(BUSY_REQUEST=!0,m.abort(),m=L.ajax({url:e,data:{value:t},dataType:"json",type:"GET",success:function(e){T(e,n,a)},error:function(e){"abort"!=e.statusText&&R()},complete:function(){BUSY_REQUEST=!1}}))},v=function(){window.scrollTo(0,0);var v=L("#site-content");BUSY_REQUEST||(BUSY_REQUEST=!0,m.abort(),m=L.ajax({url:"/search/advanced",data:{value:l.val()},dataType:"HTML",type:"GET",success:function(e){var t,n,a,o,s,i,r,c,l,d,u,f,p,h,m;L("body").addClass("advanced-search-opened"),g||(contentBeforeSearch=L("#site-content .main, #site-content .promo").detach()),g=!0,v.html(e),U(),t=L("#js-search-more-lists"),n=L(".more-lists",t),a=n.data("total-casinos"),o=L("#js-search-more-casinos"),s=L(".more-num",o),i=s.data("total-casinos"),r=L("#js-search-more-pages"),c=L(".more-num",r),l=c.data("total-games"),d=Math.floor(a/5),u=Math.floor(i/5),f=Math.floor(l/5),h=i%5,m=l%5,(p=a%5)<5&&1==d&&n.text(p),h<5&&1==u&&s.text(h),m<5&&1==f&&c.text(m),t.on("click",function(){return E("/search/more-lists/"+w,L(".search-title span").text(),L("#all-lists-container"),"lists"),d<=w?t.fadeOut():t.fadeIn(),d-1<=w&&0<p&&n.text(p),w++,!1}),o.on("click",function(){return E("/search/more-casinos/"+b,L(".search-title span").text(),L("#all-casinos-container"),"casinos"),u<=b?o.fadeOut():o.fadeIn(),u-1<=b&&0<h&&s.text(h),b++,!1}),r.on("click",function(){return E("/search/more-games/"+y,L(".search-title span").text(),L("#all-games-container"),"games"),f<=y?r.fadeOut():r.fadeIn(),f-1<=y&&0<m&&c.text(m),y++,!1}),M(),v.find("#js-search-back").each(function(){L(this).on({click:function(){_()}})}),L(".js-mobile-search-close").on("click",function(){_()})},error:function(e){"abort"!=e.statusText&&console.log("err")},complete:function(){BUSY_REQUEST=!1}}))},k=function(e,t){N()&&O(),BUSY_REQUEST&&a==n||(BUSY_REQUEST=!0,m.abort(),m=L.ajax({url:e,data:{value:l.val(),page:t},dataType:"json",type:"GET",success:function(e){j(e)},error:function(e){"abort"!=e.statusText&&R()},complete:function(e){a++,BUSY_REQUEST=!1}}))},x=function(e){return e.replace(/\s/g,"-").toLowerCase()},C=function(e){return'<li>                    <a class="search-results-label" href="/'+e.link.replace("/games/","")+'">                        '+e.name+"                    </a>                </li>"},T=function(e,t,n){var a,o=e.body.results;if("lists"===n)for(var s=0;s<o.length;s++){var i=C({link:o[s].url,name:o[s].title});t.append(i)}else for(var r in o){"games"==n?a="play/"+x(o[r]):"casinos"==n&&(a="reviews/"+x(o[r])+"-review");i=C({link:a,name:o[r]});t.append(i)}},j=function(e){var t=e.body.lists,n=e.body.casinos,a=e.body.games;if(f.empty(),u.empty(),p.empty(),L.isEmptyObject(t)&&L.isEmptyObject(n)&&L.isEmptyObject(a))R();else{A(),L.isEmptyObject(t)?f.parent().hide().next().addClass("single"):(f.parent().show().next().removeClass("single"),3<e.body.total_lists&&Math.ceil(e.body.total_lists/3)>w||(w=1)),L.isEmptyObject(n)?u.parent().hide().next().addClass("single"):(u.parent().show().next().removeClass("single"),3<e.body.total_casinos&&Math.ceil(e.body.total_casinos/3)>b||(b=1)),L.isEmptyObject(a)?p.parent().hide().prev().addClass("single"):(p.parent().show().prev().removeClass("single"),3<e.body.total_pages&&Math.ceil(e.body.total_casinos/3)>y||(y=1)),f.html("");for(var o=0;o<t.length;o++){var s=C({link:t[o].url,name:t[o].title});f.append(s)}for(var i in n){s=C({link:"reviews/"+x(n[i])+"-review",name:n[i]});u.append(s)}for(var r in a){s=C({link:"play/"+x(a[r]),name:a[r]});p.append(s)}""!=l.val()&&G()}},S=function(){b=y=1},R=function(){f.parent().hide(),u.parent().hide(),p.parent().hide(),h.show(),i.parent().fadeOut()},A=function(){f.parent().show(),u.parent().show(),p.parent().show(),h.hide()},U=function(){I(L(".js-search-drop")),!0},B=function(){U()},G=function(){t.find(".search-results-label").each(function(){L(this).html(function(e,t){return t.replace(new RegExp(l.val().toLowerCase(),"ig"),"<b>$&</b>")})})};o.close=function(){B()},s.on("click",function(){return k("/search"),S(),!1}),l.on({focus:function(){a=n=0,k("/search"),S()},keyup:function(e){27==e.keyCode?B():13==e.keyCode?(isSearchResultEvent=!0,""!=l.val()&&(v(),l.blur())):(isSearchResultEvent=!1,t.find("#search__popup").addClass("load"),n++,k("/search")),S(),""!=l.val()?i.parent().fadeIn():i.parent().fadeOut()}}),d.on("click",function(){return l.val("").focus(),k("/search"),S(),!1}),i.on("click",function(){return""!=l.val()&&v(),!1}),t[0].obj=o};function w(){var e=L(".textfield");e.focus(function(){L(this).parent().addClass("active").removeClass("not-valid")}),e.blur(function(){""==L(this).val()&&L(this).parent().removeClass("active")})}function y(e){var s=L(".list-item, .pick"),t=(L(".js-mobile-pop"),L(".btn-round")),i=(L(".js-mobile-pop-close"),0);if(e<=690){t.off("click"),t.on("click",function(e){var a,o,t,n;return i=L(window).scrollTop(),L(".overlay, .loader").fadeIn("fast"),a=L(this),o=a.closest(s).find(".list-item-cell-buttons"),t=a.data("name"),n=a.data("is-free"),(new XMLHttpRequest).abort(),L.ajax({url:"/casino/bonus",data:{casino:t,is_free:n},dataType:"html",type:"GET",success:function(e){L(e).insertAfter(o);var t=a.closest(s).find(".js-mobile-pop");t.find(".js-tooltip").tooltipster(tooltipConfig),t.find(".js-copy-tooltip").tooltipster(copyTooltipConfig);var n=t.find(".js-mobile-pop-close");E(L(".bonus-box"),21),k(),L(".overlay, .loader").fadeOut("fast"),t.fadeIn("fast").fadeIn("fast"),O(),n.on("click",function(e){return t.fadeOut("fast").find(".mobile-popup-body").html(""),M(),L(".overlay, .loader").fadeOut("fast"),x(i),L(t).remove(),!1})}}),!1})}}function k(){window.Clipboard=function(d,u,e){var f;function p(){return e.userAgent.match(/ipad|iphone/i)}return{copy:function(e,t){var n,a,o,s,i,r,c,l=(n=e,(a=document.createElement("DIV")).innerHTML=n,a.textContent||a.innerText||"");o=l,s=t,f=u.createElement("textArea"),p()&&f.setAttribute("readonly","readonly"),f.value=o,s.parent().append(f),p()?((i=u.createRange()).selectNodeContents(f),(r=d.getSelection()).removeAllRanges(),r.addRange(i),f.setSelectionRange(0,999999)):f.select(),c=t,u.execCommand("copy"),c.parent().find(f).remove()}}}(window,document,navigator),L(".js-copy-to-clip").on("click touch",function(e){Clipboard.copy(L(this).data("code"),L(this)),e.preventDefault()})}function x(e){L("html, body").animate({scrollTop:e},5)}function O(){L("html, body").addClass("no-scroll")}function M(){L("html, body").removeClass("no-scroll")}function C(e){setTimeout(function(){e.slideDown("fast")},300)}function I(e){e.slideUp("fast"),setTimeout(function(){L("body").removeClass("search-opened")},300)}function T(e){return e.replace(/\s/g,"-").toLowerCase()}function l(e){var t;return"new"===e?t=NEW_CURR_PAGE:"best"===e?t=BEST_CURR_PAGE:"country"===e&&(t=COUNTRY_CURR_PAGE),t}function j(){L(".js-tooltip").tooltipster(tooltipConfig),L(".js-copy-tooltip").tooltipster(copyTooltipConfig),L(".js-tooltip-content").tooltipster(contentTooltipConfig),y(p)}}(jQuery);
function handleContactUs(e){var a,t,n,o=$(".contact-name"),s=$(".contact-email"),r=$(".contact-message"),c=$(".contact-btn"),l=$("#contact-us-success"),d=$("#contact-us-note"),i=$("#server-error-note"),p="not-valid",u=new XMLHttpRequest;_prepContact=function(){return a=o.val(),t=s.val(),n=r.val(),ok=!0,""===a?(o.parent().addClass(p),ok=!1):o.parent().removeClass(p),""!==t&&validateEmail(t)?s.parent().removeClass(p):(s.parent().addClass(p),ok=!1),""===n?(r.parent().addClass(p),ok=!1):r.parent().removeClass(p),ok?d.hide():d.show(),ok},_sendMessage=function(e,a,t){u.abort(),u=$.ajax({url:"/contact/send",data:{name:e,email:a,message:t},dataType:"json",timeout:2e4,type:"POST",success:function(e){if("ok"==e.status)l.show(),d.hide(),i.hide(),c.prop("disabled",!0),o.val(""),s.val(""),r.val(""),_onEvents();else if("error"==e.status){JSON.parse(e.body);i.show()}},error:function(e){console.error("Could not send message!")}})},_onEvents=function(){c.on({click:function(e){!1===_prepContact()?e.stopPropagation():_sendMessage(a,t,n)}})},_onEvents()}
