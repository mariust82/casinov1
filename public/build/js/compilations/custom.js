var AJAX_CUR_PAGE=1,GAME_CURR_PAGE=1;function tmsIframe(){$(".tms_iframe").length&&$(".tms_iframe").each(function(){var e=document.createElement("iframe");$.each(this.attributes,function(){"class"!=this.name&&e.setAttribute(this.name.replace("data-",""),this.value)}),$(this).append(e)})}!function(L){BUSY_REQUEST=!1;var w=L(window).width();L(document).ready(function(){!function(){var e=document.querySelector(".header-menu__list-holder");if(e){var t=r()?"click":"hover";e.addEventListener(t,function(e){for(var t,n=e.target;n!=this;){if(n.classList.contains("expand-holder")){if((t=document.querySelector(".expand-holder.opened"))==n){t.querySelector(".expand-menu");"expand-menu"!==e.target.className&&t.classList.remove("opened")}else t?("expand-menu"!==e.target.className&&t.classList.remove("opened"),setTimeout(function(){n.classList.add("opened")},400)):n.classList.add("opened");break}n=n.parentNode}},!0)}}(),O(),function(){var t=L("#js-mobile-menu-opener, #js-mobile-menu-close"),n=L(".header-menu"),o=null,a=L("html, body");t.on("click",function(e){L("body").toggleClass("menu-opened"),t.toggleClass("active"),r()&&(o=L(window).scrollTop(),a.hasClass("no-scroll")?a.addClass("no-scroll"):(a.removeClass("no-scroll"),u(o)),L(".expand-menu__list-item.active ").closest(".expand-holder").addClass("opened")),L(document).on("click touchstart",function(e){0==L(e.target).closest(n).length&&0==L(e.target).closest(t).length&&(L("body").removeClass("menu-opened"),r()&&(p(),u(o)),t.removeClass("active"))}),e.preventDefault()})}(),r()||L(".header-menu__list-holder .expand-holder").on("mouseout",function(e){L(".expand-holder").removeClass("opened")}),L(".js-more-games").click(function(){L(this).addClass("loading");var e=L(this).data("software"),t=L(this);console.dir("/games-by-software/"+GAME_CURR_PAGE),_request=L.ajax({url:"/games-by-software/"+GAME_CURR_PAGE,data:{page:GAME_CURR_PAGE,software:e},dataType:"html",type:"post",success:function(e){setTimeout(function(){t.removeClass("loading"),refresh()},1e3),GAME_CURR_PAGE++,L(".games-list").append(e),L(t).data("total")===L(".games-list").children().length&&L(t).hide()},error:function(e){jQuery.parseJSON(e.responseJSON.body.message)[0];"abort"!=e.statusText&&console.log("err")},complete:function(){BUSY_REQUEST=!1}})}),L(".load-more").click(function(){new XMLHttpRequest;var e=L(this).data("category"),t=L(this);L.ajax({url:"/load-more/"+e+"/"+AJAX_CUR_PAGE,data:{page:AJAX_CUR_PAGE,category:e},dataType:"html",type:"post",success:function(e){AJAX_CUR_PAGE++,console.dir(e),console.dir(e),L(".cards-list-wrapper").append(e),L(t).data("total")===L(".cards-list-wrapper").children().length&&L(t).hide()},error:function(e){jQuery.parseJSON(e.responseJSON.body.message)[0];"abort"!=e.statusText&&(console.log("err"),__this.closest(_obj).next(".action-field.not-valid").show())},complete:function(){BUSY_REQUEST=!1}})}),/iPhone|iPad|iPod/i.test(navigator.userAgent)&&L("body").addClass("ios-device");var e;L(window).scrollTop()+L(window).height()>L(document).height()-260?tmsIframe():(e=L(window).width()<768?"touchstart":"mousemove",L(window).one(e,tmsIframe));L(window).trigger("scroll"),new c(L(".header"));var t=L(".rating-container").data("user-rate");L(".box img.not-accepted").length?L(".br-widget a").unbind("mouseenter mouseleave mouseover click"):0<t&&(L(".br-widget").children().each(function(){L(this).unbind("mouseenter mouseleave mouseover click"),parseInt(L(this).data("rating-value"))<=parseInt(t)&&L(this).addClass("br-active")}),L(".br-widget").unbind("mouseenter mouseleave mouseover click"))}),L.fn.scrollEnd=function(t,n){L(this).scroll(function(){var e=L(this);e.data("scrollTimeout")&&clearTimeout(e.data("scrollTimeout")),e.data("scrollTimeout",setTimeout(t,n))})};var e=0;if(L(window).on("scroll",function(){e<L(window).scrollTop()?(L("body").removeClass("site__header_sticky"),e=L(window).scrollTop()):e-L(window).scrollTop()>L(window).height()/3&&(L("body").addClass("site__header_sticky"),e=L(window).scrollTop()),0===L(window).scrollTop()&&L("body").removeClass("site__header_sticky")}),L(window).width()<768&&(L(window).scrollEnd(function(){0!==L(window).scrollTop()&&L("body").addClass("site__header_sticky")},800),/\/reviews\//.test(window.location.href)&&0<L(".btn-group-mobile .btn-middle").length)){var t=!1,n=L(window).height()/2+L(window).scrollTop();L(window).on("scroll",function(){L(window).scrollTop()>n&&!1===t&&(L("body").append('<a rel="nofollow" target="_blank" class="btn-play-now" href="'+L(".btn-group-mobile .btn-middle").attr("href")+'">Play Now</a>'),L("body").addClass("play-now-appended"),t=!0)})}L(window).resize(function(e){_(w=L(window).width())}),tooltipConfig={trigger:"click",maxWidth:279,animation:"grow",debug:!1},copyTooltipConfig={trigger:"click",maxWidth:260,minWidth:260,animation:"grow",contentAsHTML:!0,debug:!1,functionBefore:function(e,t){e.content('                <div class="centered">                    <i class="icon icon-icon_available"></i> Code copied to clipboard                </div>            ')}},contentTooltipConfig={trigger:"click",minWidth:460,interactive:!0,contentAsHTML:!0,debug:!1,content:L(".loader"),animation:"fade",contentCloning:!1,functionReady:function(){L("body").addClass("shadow"),b(L(".bonus-box"),15),L(".js-tooltip").tooltipster(tooltipConfig)},functionAfter:function(){L("body").removeClass("shadow")},functionBefore:function(t,e){var n=L(e.origin);if(!0!==n.data("loaded")){var o=n.data("name"),a=n.data("is-free"),i=new XMLHttpRequest;i.abort(),i=L.ajax({url:"/casino/bonus",data:{casino:o,is_free:a},dataType:"html",type:"GET",success:function(e){t.content(e),setTimeout(function(){L(".js-tooltip").tooltipster(tooltipConfig),L(".js-copy-tooltip").tooltipster(copyTooltipConfig),d(),b(L(".bonus-box"),15)},50),n.data("loaded",!0)}})}}};var O=function(){if(function(){new Swiper("#main-carousel",{slidesPerView:6,spaceBetween:5,navigation:{nextEl:".carousel-next",prevEl:".carousel-prev"},breakpoints:{1024:{freeMode:!0,slidesPerView:"auto"}}});var e={slidesPerView:"auto",spaceBetween:30,freeMode:!0,allowTouchMove:!1,slidesOffsetAfter:-220,on:{slideChangeTransitionStart:function(e){L(".links-left").fadeIn("fast")},slideChangeTransitionEnd:function(e){0==this.translate&&L(".links-left").fadeOut("fast")}},breakpoints:{1024:{allowTouchMove:!0},690:{spaceBetween:15,allowTouchMove:!0}}};if(L("#links-nav").length){var t=new Swiper(".links-casinos #links-nav",e);e.slidesOffsetAfter=-330;var n=new Swiper(".links-games #links-nav",e),o=L("#links-nav .active").parent().index()-1,a=L(window).width()/2-50,i=-L("#links-nav .active").parent().position().left+a;r()?(L(".links-casinos #links-nav").length&&t.setTranslate(i),L(".links-games #links-nav").length&&n.setTranslate(i)):(L(".links-casinos #links-nav").length&&t.slideTo(o,300),L(".links-games #links-nav").length&&n.slideTo(o,300))}if(1024<L(window).width()){function s(e,t,n){var o=e.closest(".swiper-container"),a=t;a.clientX>o.offset().left+o.width()/1.3?n.slideNext(500):a.clientX<o.offset().left+o.width()/6&&n.slidePrev(500)}L(".links-casinos .links-nav a").on("mouseenter",function(e){s(L(this),e,t)}),L(".links-games .links-nav a").on("mouseenter",function(e){s(L(this),e,n)})}}(),L.fn.moreLines=function(u){"use strict";return this.each(function(){var e=L(this),t=(e.find("p"),parseFloat(e.css("line-height"))),n=e.innerHeight(),o=L.extend({linecount:1,baseclass:"b-morelines_",basejsclass:"js-morelines_",classspecific:"section",buttontxtmore:"more lines",buttontxtless:"less lines",animationspeed:1},u),a=o.baseclass+o.classspecific+"_ellipsis",i=o.baseclass+o.classspecific+"_button",s=o.baseclass+o.classspecific+"_wrapper",r=o.basejsclass+o.classspecific+"_wrapper",c=L("<div>").addClass(s+" "+r).css({"max-width":e.css("width")}),l=t*o.linecount;if(e.wrap(c),e.parent().not(r)&&l<n){e.addClass(a).css({"min-height":l,"max-height":l,overflow:"hidden"});var d=L("<div>",{class:i,click:function(){e.toggleClass(a),L(this).toggleClass(i+"_active"),"none"!==e.css("max-height")?e.css({height:l,"max-height":""}).animate({height:"100%"},o.animationspeed,function(){d.html(o.buttontxtless)}):e.animate({height:l},o.animationspeed,function(){d.html(o.buttontxtmore),e.css("max-height",l)})},html:o.buttontxtmore});e.after(d)}}),this},L(".js-condense").moreLines({linecount:3,baseclass:"js-condense",basejsclass:"js-condense",classspecific:"_readmore",buttontxtmore:"Read More",buttontxtless:"Read Less",animationspeed:250}),function(){var a=L(".rating-container"),i=(a.data("casino-rating"),a.attr("data-user-rate")),e={showSelectedRating:!1,onSelect:function(e,t,n){if(void 0!==n){var o=L(n.currentTarget);L(".br-widget").children().each(function(){L(this).unbind("mouseenter mouseleave mouseover click"),parseInt(L(this).data("rating-value"))<=parseInt(i)&&L(this).addClass("br-active")}),L(".br-widget").unbind("mouseenter mouseleave mouseover click"),o.closest(a).find(".rating-current-text").text(t).removeClass("terrible poor good very-good excellent").attr("class","rating-current-text "+h(t)),o.closest(a).find(".rating-current-value span").text(e),o.closest(a).find(".rating-current").attr("data-rating-current",e),new s({value:e,name:a.data("casino-name")})}}};L(".rating-bar",a).barrating("show",e)}(),function(){var e=L(".js-filter > option");L(".js-filter").select2MultiCheckboxes({templateSelection:function(e,t){return"Game software"}}),e.prop("selected",!1)}(),function(){var e=L(".header-search"),t=L(".js-search-opener",e),n=L(".js-mobile-search-opener"),o=L(".js-search-close",e),a=L(".js-mobile-search-close"),i=L(".js-mobile-search-clear"),s=L(".js-search-drop"),r=L(".header-search-input input"),c=0;t.on("click",function(e){L("body").addClass("search-opened"),r.focus(),l(s),L(document).on("click touchstart",function(e){0==L(e.target).closest(s).length&&0==L(e.target).closest(r).length&&0==L(e.target).closest(n).length&&0==L(e.target).closest(t).length&&(r.val(""),P(s))})}),r.on("keydown",function(e){13!=e.keyCode&&l(s)}),o.on("click",function(e){P(s)}),n.on("click",function(e){c=L(window).scrollTop(),L("body").addClass("mobile-search-opened"),f(),r.focus()}),a.on("click",function(e){r.val("").blur(),L("body").removeClass("mobile-search-opened"),p(),u(c)}),i.on("click",function(){r.val("").focus()})}(),d(),_(w),y(),L("#reviews").on("click",".js-reply-btn",function(e){return L(this).parent().next().slideToggle(),!1}),C(),function a(){var e=L(".js-more-reviews");e.data("reviews");var i=L("#review-data-holder");var s=L(".reply-data-holder");var t=L(".rating-container").data("casino-name");var r=new XMLHttpRequest;e.on("click",function(){return console.log("Clicked"),n(L(this),L(this).data("type")),!1});L(".not-accepted").length&&e.css("pointer-events","auto");var n=function(n,o){BUSY_REQUEST||(BUSY_REQUEST=!0,r.abort(),r=L.ajax({url:"/casino/more-reviews/"+h(t)+"/"+n.data("page"),dataType:"HTML",data:{id:n.data("id"),type:o},type:"GET",success:function(e){"review"==o?(i.append(e),n.data("page")>=n.data("total")/5-1&&n.hide()):"reply"==o&&n.closest(".reply").find(s).append(e),n.data("page")>=n.data("total")/5-1&&n.hide();var t=n.data("page");n.data("page",++t),c(),a()},error:function(e){"abort"!=e.statusText&&console.log("err")},complete:function(){BUSY_REQUEST=!1}}))},c=function(){y(),C(),new x(L(".js-vote")),L(".review").each(function(){new k(L(this))})}}(),b(L(".list .bonus-box"),21),b(L(".bonus-item .bonus-box"),33),function(){if(10<=function(){var e=-1;if("Microsoft Internet Explorer"==navigator.appName){var t=navigator.userAgent;null!=new RegExp("MSIE ([0-9]{1,}[.0-9]{0,})").exec(t)&&(e=parseFloat(RegExp.$1))}else if("Netscape"==navigator.appName){t=navigator.userAgent;null!=new RegExp("Trident/.*rv:([0-9]{1,}[.0-9]{0,})").exec(t)&&(e=parseFloat(RegExp.$1))}return e}()){L("img.not-accepted").each(function(){var e=L(this);e.css({position:"absolute"}).wrap("<div class='img_wrapper' style='display: inline-block'>").clone().addClass("img_grayscale").css({position:"absolute","z-index":"5",opacity:"0"}).insertBefore(e).queue(function(){var e=L(this);e.parent().css({width:this.width,height:this.height}),e.dequeue()}),this.src=function(e){var t=document.createElement("canvas"),n=t.getContext("2d"),o=new Image;o.src=e,t.width=o.width,t.height=o.height,n.drawImage(o,0,0);for(var a=n.getImageData(0,0,t.width,t.height),i=0;i<a.height;i++)for(var s=0;s<a.width;s++){var r=4*i*a.width+4*s,c=(a.data[r]+a.data[1+r]+a.data[2+r])/3;a.data[r]=c,a.data[1+r]=c,a.data[2+r]=c}return n.putImageData(a,0,0,0,0,a.width,a.height),t.toDataURL()}(this.src)})}}(),L(".js-table-package-opener").on("click",function(e){L(this).closest("tr").toggleClass("active"),e.preventDefault()}),L(".message .close").on("click",function(e){L(this).parent().fadeOut(),e.preventDefault()}),L(".js-history-back").on("click",function(e){window.history.back(),e.preventDefault()}),0<L("#filters").length&&new i(L("#filters")),0<L("#reviews").length&&(L(".review").each(function(e){new k(L(this))}),L('[href="#reviews"]').on("click",function(){return function(e,t){if(void 0!==e)n(e,t);else{L(".js-scroll").on("click",function(e){n(L(L(this).attr("href")),0),e.preventDefault()})}function n(e,t){L("html, body").animate({scrollTop:e.offset().top-t},1e3)}}(L("#reviews"),100),!1})),0<L(".js-vote").length&&new x(L(".js-vote")),0<L(".js-run-counter").length){var e=L(".js-run-counter").data("name");runPlayCounter(e)}0<L(".contact-form").length&&new a(L(".contact-form")),new o(L(".subscribe")),L(".js-tooltip").tooltipster(tooltipConfig),L(".js-copy-tooltip").tooltipster(copyTooltipConfig),L(".js-tooltip-content").tooltipster(contentTooltipConfig)};function r(){var e=L(window).width();return L(window).resize(function(){e=L(window).width()}),e<1e3||!!/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)}function b(e,a){L(e).each(function(e,t){var n=L(this).find(".list-item-trun"),o=L(this).find(".bubble");n.text().length>=a&&o.css("visibility","visible")})}function o(e){var t,n=e,o=n.find(".news-email"),a=n.find(".news-btn"),i=L("#news-success"),s=L("#news-note"),r="not-valid",c=new XMLHttpRequest;_prepMessage=function(){return t=o.val(),ok=!0,""!==t&&T(t)?o.parent().removeClass(r):(o.parent().addClass(r),ok=!1),ok?s.hide():s.show(),ok},_sendNews=function(e){c.abort(),c=L.ajax({url:"/newsletter/subscribe",data:{email:e},dataType:"json",timeout:2e4,type:"POST",success:function(e){if("ok"==e.status)i.show(),s.hide(),a.prop("disabled",!0),o.val(""),_onEvents();else if("error"==e.status){var t=JSON.parse(e.body);L(".action-added").remove(),L.each(t,function(e,t){var n='<div class="action-field action-added not-valid ">'+t+"</div>";L(".review-submit-holder .msg-holder").append(n)})}},error:function(e){console.error("Could not send message!")}})},_onEvents=function(){a.on({click:function(e){!1===_prepMessage()?e.stopPropagation():_sendNews(t)}})},_init=function(){_onEvents()},_init()}function a(e){var t,n,o,a=L(".contact-name"),i=L(".contact-email"),s=L(".contact-message"),r=L(".contact-btn"),c=L("#contact-us-success"),l=L("#contact-us-note"),d=L("#server-error-note"),u="not-valid",f=new XMLHttpRequest;_prepContact=function(){return t=a.val(),n=i.val(),o=s.val(),ok=!0,""!==t&&E(t)?a.parent().removeClass(u):(a.parent().addClass(u),ok=!1),""!==n&&T(n)?i.parent().removeClass(u):(i.parent().addClass(u),ok=!1),""!==o&&j(o)?s.parent().removeClass(u):(s.parent().addClass(u),ok=!1),ok?l.hide():l.show(),ok},_sendMessage=function(e,t,n){f.abort(),f=L.ajax({url:"/contact/send",data:{name:e,email:t,message:n},dataType:"json",timeout:2e4,type:"POST",success:function(e){if("ok"==e.status)c.show(),l.hide(),d.hide(),r.prop("disabled",!0),a.val(""),i.val(""),s.val(""),_onEvents();else if("error"==e.status){JSON.parse(e.body);d.show()}},error:function(e){console.error("Could not send message!")}})},_onEvents=function(){r.on({click:function(e){!1===_prepContact()?e.stopPropagation():_sendMessage(t,n,o)}})},_init=function(){_onEvents()},_init()}var i=function(e){var s,t,n=e,o=this,a=n.find("input[type=checkbox]"),i=n.find("input[type=radio]"),r=n.find("select[name=soft]"),c=L(".data-container"),l=L(".data-add-container"),d=c.data("type"),u=c.data("type-value"),f=(L(".aj-content"),L(".empty-filters")),p=n.next(".data-container-holder").find(".holder"),h=L(".list-item").length,m=L("#default"),v=L(".qty-items").data("load-total");Math.floor(v/h);_currentClick=0,_request=new XMLHttpRequest,void 0===d&&(d="game_type"),_url=n.data("url"),m.prop("checked",!0);var g=function(e,t,n){var o={};return L.each(a,function(e,t){L(t).is(":checked")&&(o[L(t).attr("name")]=1),"reset"==n&&(o[L(t).attr("name")]="",L(t).prop("checked",!1))}),L.each(i,function(e,t){L(t).is(":checked")&&(o[L(t).attr("name")]=L(t).attr("value")),"reset"==n&&(o[L(t).attr("name")]=1,0==e&&L(t).prop("checked",!0))}),o[e]=t,"undefined"!=r.val()&&null!=r.val()&&(o.software=r.val().join(),"reset"==n&&(o.software="")),void 0===AJAX_CUR_PAGE&&(AJAX_CUR_PAGE=1),"add"==n&&"reset"!=n||(AJAX_CUR_PAGE=0),null!=o.label&&"Mobile"==o.label&&(o.compatibility="mobile",delete o.label),o};_ajaxRequestCasinos=function(e,a){if(console.dir("test"),"add"==a?s.addClass("loading"):L(".overlay, .loader").fadeIn("fast"),!BUSY_REQUEST){BUSY_REQUEST=!0,_request.abort();var i="/games-filter/"==_url?24:100;_request=L.ajax({url:_url+AJAX_CUR_PAGE,data:e,dataType:"html",type:"GET",success:function(e){var t=L(e).find(".loaded-item"),n=L(e).filter("[data-load-total]").data("load-total");function o(){L(".js-tooltip").tooltipster(tooltipConfig),L(".js-copy-tooltip").tooltipster(copyTooltipConfig),L(".js-tooltip-content").tooltipster(contentTooltipConfig),_(w)}"replace"==a?(c.html(e),l.html(""),L(".qty-items").attr("data-load-total",n),L(".qty-items-quantity").text(n),t.length<i?(0<t.length?(p.show(),f.hide()):(p.hide(),f.show()),s.hide()):(s.show(),p.show(),f.hide()),o(),AJAX_CUR_PAGE=1,_currentClick=0):(AJAX_CUR_PAGE++,_currentClick++,setTimeout(function(){l.append(t),s.removeClass("loading"),o(),t.length<i&&s.hide()},1e3)),_construct(),b(L(".data-add-container .bonus-box, .data-container .bonus-box"),21)},error:function(e){"abort"!=e.statusText&&console.log("err")},complete:function(){BUSY_REQUEST=!1,L(".overlay, .loader").fadeOut("fast")}});var t=setTimeout(function(){},300);_hideLoading=function(){clearTimeout(t)}}},_loadData=function(e){},_construct=function(){s=L(".js-more-items"),t=L(".js-reset-items"),a.off(),a.on("click",function(){_ajaxRequestCasinos(g(d,u),"replace")}),i.off(),i.on("click",function(){_ajaxRequestCasinos(g(d,u),"replace")}),L(".js-filter > option").on("click",function(){L(".js-filter > option").each(function(e,t){L(this).prop("selected")})}),r.off(),r.on("change",function(){_ajaxRequestCasinos(g(d,u),"replace")}),s.off(),s.on("click",function(){return _ajaxRequestCasinos(g(d,u,"add"),"add"),!1}),t.off(),t.on("click",function(){return _ajaxRequestCasinos(g(d,u,"reset"),"add"),!1}),n[0].obj=o},_construct()};function y(){var e=L(".expanding"),t=L(".js-expanding-textfields");L(".box img.not-accepted").length?e.unbind("mouseenter mouseleave mouseover click focus"):e.on("focus",function(){L(this).removeClass("expanding"),L(this).closest(".form").find(t).slideDown()})}var x=function(e){var i=e,t=i.find(".vote-button"),n=new XMLHttpRequest,o=function(e,t,n){return{id:t,is_like:n}};_getTarget=function(e){var t="/casino/review-like";return"article"===e&&(t="/blog/rate"),t},_updateVote=function(o,a,e){BUSY_REQUEST||(BUSY_REQUEST=!0,n.abort(),n=L.ajax({url:a,data:e,dataType:"json",type:"post",success:function(e){e.body.message;if("/casino/review-like"===a){var t=L(o).find(".bubble-vote"),n=t.text();t.text(++n),o.closest(i).next(".action-field.success").show()}else"/blog/rate"===a&&(L(o.parent().parent()).find(".votes-like .vote-block-num, .like .vote-block-num").text(e.body.likes),L(o.parent().parent()).find(".votes-dislike .vote-block-num, .dislike .vote-block-num").text(e.body.dislikes),o.closest(i).next(".action-field.success").show())},error:function(e){jQuery.parseJSON(e.responseJSON.body.message)[0];"abort"!=e.statusText&&(console.log("err"),__this.closest(i).next(".action-field.not-valid").show())},complete:function(){BUSY_REQUEST=!1}}))},t.off(),t.on("click",function(){var e=L(this).data("id"),t=L(this).data("success"),n=L(this).data("type");return _updateVote(L(this),_getTarget(n),o(n,e,t)),!1})};function k(e){var n,o,a,i,s,r,c,l,d,u,f,p,t=this.obj=e,h=(L("#reviews-form").data("img-dir"),L("#reviews-form").data("country"),t.find("input[name=submit]")),m=L(".reviews-qty"),v="not-valid",g=L(".reviews-form").data("casino-id"),w=localStorage.getItem("casino_"+g+"_reviewed"),b=localStorage.getItem("casino_"+g+"_score"),_=new XMLHttpRequest;_prepReview=function(e){var t=e;return o=t.find("input[name=name]"),a=t.find("input[name=email]"),i=t.find("textarea[name=body]"),s=t.find(".field-error-required"),r=t.find(".field-error-rate"),_contact_error=t.find(".field-error"),c=o.val(),l=a.val(),d=i.val(),casino_name=L(".rating-container").data("casino-name"),f=L(".rating-current-value span").text(),ok=!(n=0),null!=t.data("id")?(n=t.data("id"),u=!0,0<t.next().find(".reply-data-holder").length?(t.next().find(".reply-data-holder"),!1):(!0,n=t.closest(".reply").prev().data("id"),_setReviewerName(t),t.closest(".reply-data-holder")),p=t.find(".js-reply-btn span")):(u=!1,L("#review-data-holder")),""!==c&&E(c)?o.parent().removeClass(v):(o.parent().addClass(v),ok=!1),""!==l&&T(l)?a.parent().removeClass(v):(a.parent().addClass(v),ok=!1),""!==d&&j(d)?i.parent().removeClass(v):(i.parent().addClass(v),ok=!1),ok?(_contact_error.hide(),s.hide()):s.show(),u||("0"===f?(r.show(),t.find(L(".rating-container")).addClass(v),ok=!1):(r.hide(),t.find(L(".rating-container")).removeClass(v))),ok},_setReviewerName=function(e){var t=e.find(".review-name").text();d="<strong>@"+t+"</strong> "+i.val()},_changeName=function(){L("#reviews-form input[name=name]").on("keyup",function(){L("#reviews-form .review-name").text(L(this).val())})},_prepAjaxData=function(e){var t={casino:casino_name,name:c,email:l,body:d,parent:n,casino_id:L(".reviews-form").attr("data-casino-id")};_sendReview(t,e)},_sendReview=function(e,t){BUSY_REQUEST||(BUSY_REQUEST=!0,_.abort(),_=L.ajax({url:"/casino/review-write",data:e,dataType:"json",timeout:2e4,type:"POST",success:function(e){_loadData(e,t),o.val(""),a.val(""),i.val("").addClass("expanding"),_onEvents(),L(".form .js-expanding-textfields").slideUp()},error:function(e){_errors_found=L.parseJSON(e.responseText),console.error("Could not send message!"),console.log(_errors_found.body.message)},complete:function(){BUSY_REQUEST=!1}}))},_loadData=function(e,t){L("#review-data-holder").load(location.href+" #review-data-holder",function(){_refreshData()},500)},_refreshData=function(){u||(m.text(parseInt(m.text())+1),localStorage.setItem("casino_"+g+"_reviewed",1),localStorage.setItem("casino_"+g+"_score",f)),u&&p.text(parseInt(p.text())+1),L(".review-form").slideUp(),y(),C(),new x(L(".js-vote")),L(".review, .reply").each(function(){new k(L(this))})},_doIfReviewedAlready=function(){var e=L("#reviews-form");L(".review-rating",e).addClass("active"),L("textarea",e).addClass("disabled"),L(".rating-bar").barrating("set",b),L(".rating-current-value span").text(b),L("textarea[name=body]",e).attr("placeholder","You have already reviewed")},_initForms=function(){h.off(),h.on({click:function(e){!1===_prepReview(t)?e.stopPropagation():_prepAjaxData(t)}})},_onEvents=function(){w?(_doIfReviewedAlready(),_initForms()):(_initForms(),_changeName())},_init=function(){_onEvents()},_init()}var s=function(e){var t=e,n=t.name,o=t.value,a=new XMLHttpRequest;(function(e,t){BUSY_REQUEST||(BUSY_REQUEST=!0,a.abort(),a=L.ajax({url:"/casino/rate",data:{name:e,value:t},dataType:"json",type:"post",success:function(e){"Casino already rated!"==e.body.success&&(L(".icon-icon_available").toggleClass("icon-icon_unavailable"),L(".icon-icon_unavailable").removeClass("icon-icon_available"),L(".thanx").html(e.body.success)),L(".rating-container").next(".action-field").show()},error:function(e){"abort"!=e.statusText&&console.log("err")},complete:function(){BUSY_REQUEST=!1}}))})(n,o)},c=function(e){var o,a,t=e,n=this,i=t.find(".js-trigger-search"),s=t.find("#search-all"),r=t.find("#search"),c=t.find("#search-form"),l=(t.find(".search-results"),c.find("input")),d=c.find(".js-mobile-search-clear"),u=r.find("#search-casinos ul"),f=r.find("#search-lists ul"),p=r.find("#search-pages ul"),h=r.find("#search-empty"),m=(r.data("img-dir"),!1),v=1,g=1,w=1,b=new XMLHttpRequest;window.contentBeforeSearch;function _(){L("#site-content").html("").append(contentBeforeSearch),L(".js-search-drop").show(),L("body").removeClass("advanced-search-opened"),l.blur(),setTimeout(function(){O()},1e3)}function y(e){return e.replace(/\s/g,"-").toLowerCase()}function x(e){return'<li>                    <a class="search-results-label" href="/'+e.link.replace("/games/","")+'">                        '+e.name+"                    </a>                </li>"}var k=function(e,t,n,o){if(!BUSY_REQUEST){BUSY_REQUEST=!0,b.abort(),b=L.ajax({url:e,data:{value:t},dataType:"json",type:"GET",success:function(e){_hideLoading(),E(e,n,o)},error:function(e){"abort"!=e.statusText&&(_hideLoading(),console.log("err"),R())},complete:function(){_hideLoading(),BUSY_REQUEST=!1}});var a=setTimeout(function(){},300);_hideLoading=function(){clearTimeout(a)}}},C=function(){window.scrollTo(0,0);var t=L("#site-content");BUSY_REQUEST||(BUSY_REQUEST=!0,b.abort(),b=L.ajax({url:"/search/advanced",data:{value:l.val()},dataType:"HTML",type:"GET",success:function(e){L("body").addClass("advanced-search-opened"),m||(contentBeforeSearch=L("#site-content .main, #site-content .promo").detach()),m=!0,t.html(e),A(),function(){var e=L("#js-search-more-lists"),t=L(".more-lists",e),n=t.data("total-casinos"),o=L("#js-search-more-casinos"),a=L(".more-num",o),i=a.data("total-casinos"),s=L("#js-search-more-pages"),r=L(".more-num",s),c=r.data("total-games"),l=Math.floor(n/5),d=Math.floor(i/5),u=Math.floor(c/5),f=n%5,p=i%5,h=c%5;f<5&&1==l&&t.text(f),p<5&&1==d&&a.text(p),h<5&&1==u&&r.text(h),e.on("click",function(){return k("/search/more-lists/"+g,L(".search-title span").text(),L("#all-lists-container"),"lists"),l<=g?e.fadeOut():e.fadeIn(),l-1<=g&&0<f&&t.text(f),g++,!1}),o.on("click",function(){return k("/search/more-casinos/"+v,L(".search-title span").text(),L("#all-casinos-container"),"casinos"),d<=v?o.fadeOut():o.fadeIn(),d-1<=v&&0<p&&a.text(p),v++,!1}),s.on("click",function(){return k("/search/more-games/"+w,L(".search-title span").text(),L("#all-games-container"),"games"),u<=w?s.fadeOut():s.fadeIn(),u-1<=w&&0<h&&r.text(h),w++,!1})}(),t.find("#js-search-back").each(function(){L(this).on({click:function(){_()}})}),L(".js-mobile-search-close").on("click",function(){_()})},error:function(e){"abort"!=e.statusText&&console.log("err")},complete:function(){BUSY_REQUEST=!1}}))},T=function(e,t){if(!BUSY_REQUEST||a!=o){BUSY_REQUEST=!0,b.abort(),b=L.ajax({url:e,data:{value:l.val(),page:t},dataType:"json",type:"GET",success:function(e){_hideLoading(),j(e)},error:function(e){"abort"!=e.statusText&&(_hideLoading(),console.log("err"),R())},complete:function(e){_hideLoading(),a++,BUSY_REQUEST=!1}});var n=setTimeout(function(){},300);_hideLoading=function(){clearTimeout(n)}}},E=function(e,t,n){var o,a=e.body.results;if("lists"===n)for(var i=0;i<a.length;i++){var s=x({link:a[i].url,name:a[i].title});t.append(s)}else for(var r in a){"games"==n?o="play/"+y(a[r]):"casinos"==n&&(o="reviews/"+y(a[r])+"-review");s=x({link:o,name:a[r]});t.append(s)}},j=function(e){var t=e.body.lists,n=e.body.casinos,o=e.body.games;if(f.empty(),u.empty(),p.empty(),L.isEmptyObject(t)&&L.isEmptyObject(n)&&L.isEmptyObject(o))R();else{U(),L.isEmptyObject(t)?f.parent().hide().next().addClass("single"):(f.parent().show().next().removeClass("single"),3<e.body.total_lists&&Math.ceil(e.body.total_lists/3)>g||(g=1)),L.isEmptyObject(n)?u.parent().hide().next().addClass("single"):(u.parent().show().next().removeClass("single"),3<e.body.total_casinos&&Math.ceil(e.body.total_casinos/3)>v||(v=1)),L.isEmptyObject(o)?p.parent().hide().prev().addClass("single"):(p.parent().show().prev().removeClass("single"),3<e.body.total_pages&&Math.ceil(e.body.total_casinos/3)>w||(w=1)),f.html("");for(var a=0;a<t.length;a++){var i=x({link:t[a].url,name:t[a].title});f.append(i)}for(var s in n){i=x({link:"reviews/"+y(n[s])+"-review",name:n[s]});u.append(i)}for(var r in o){i=x({link:"play/"+y(o[r]),name:o[r]});p.append(i)}""!=l.val()&&B()}},S=function(){v=w=1},R=function(){f.parent().hide(),u.parent().hide(),p.parent().hide(),h.show(),s.parent().fadeOut()},U=function(){f.parent().show(),u.parent().show(),p.parent().show(),h.hide()},A=function(){P(L(".js-search-drop")),!0},M=function(){A()},B=function(){t.find(".search-results-label").each(function(){L(this).html(function(e,t){return t.replace(new RegExp(l.val().toLowerCase(),"ig"),"<b>$&</b>")})})};n.close=function(){M()},i.on("click",function(){return T("/search"),S(),!1}),l.on({focus:function(){a=o=0,T("/search"),S()},keyup:function(e){27==e.keyCode?M():13==e.keyCode?""!=l.val()&&(C(),l.blur()):(t.find("#search__popup").addClass("load"),o++,T("/search")),S(),""!=l.val()?s.parent().fadeIn():s.parent().fadeOut()}}),d.on("click",function(){return l.val("").focus(),T("/search"),S(),!1}),s.on("click",function(){return""!=l.val()&&C(),!1}),t[0].obj=n};function C(){var e=L(".textfield");e.focus(function(){L(this).parent().addClass("active").removeClass("not-valid")}),e.blur(function(){""==L(this).val()&&L(this).parent().removeClass("active")})}function _(e){var s=L(".list-item"),r=L(".js-mobile-pop"),t=L(".btn-round"),n=L(".js-mobile-pop-close"),c=L(".wrapper"),l=0;if(e<=690){function o(e){var t=e.closest(s).find(".mobile-popup-body"),n=e.closest(s).find(".mobile-popup-title"),o=(e.closest(s).find(".js-tooltip-content"),e.data("name")),a=e.data("is-free"),i=new XMLHttpRequest;i.abort(),i=L.ajax({url:"/casino/bonus",data:{casino:o,is_free:a},dataType:"html",type:"GET",success:function(e){$bonus=e,a?t.prepend($bonus):t.append($bonus),n.text(L($bonus).find(".tooltip-templates-title").text()),t.find(".js-tooltip").tooltipster(tooltipConfig),t.find(".js-copy-tooltip").tooltipster(copyTooltipConfig),b(L(".bonus-box"),21),d(),L(".overlay, .loader").fadeOut("fast")}}),function(e){e.closest(s).find(r).fadeIn("fast"),f(),c.css("top",-1*l)}(e)}t.off("click"),t.on("click",function(e){return l=L("html, body").scrollTop(),L(".overlay, .loader").fadeIn("fast"),o(L(this)),!1}),n.on("click",function(e){return L(this).closest(r).fadeOut("fast").find(".mobile-popup-body").html(""),p(),L(".overlay, .loader").fadeOut("fast"),u(l),c.removeAttr("style"),!1})}}function d(){function n(){return e.userAgent.match(/ipad|iphone/i)}var o,a,e,i;window.Clipboard=(o=window,a=document,e=navigator,{copy:function(e,t){!function(e,t){i=a.createElement("textArea"),n()&&i.setAttribute("readonly","readonly"),i.value=e,t.parent().append(i)}(function(e){var t=document.createElement("DIV");return t.innerHTML=e,t.textContent||t.innerText||""}(e),t),function(){var e,t;n()?((e=a.createRange()).selectNodeContents(i),(t=o.getSelection()).removeAllRanges(),t.addRange(e),i.setSelectionRange(0,999999)):i.select()}(),function(e){a.execCommand("copy"),e.parent().find(i).remove()}(t)}}),L(".js-copy-to-clip").on("click touch",function(e){Clipboard.copy(L(this).data("code"),L(this)),e.preventDefault()})}function u(e){L("html, body").animate({scrollTop:e},5)}function f(){L("html, body").addClass("no-scroll")}function p(){L("html, body").removeClass("no-scroll")}function l(e){setTimeout(function(){e.slideDown("fast")},300)}function P(e){e.slideUp("fast"),setTimeout(function(){L("body").removeClass("search-opened")},300)}function h(e){return e.replace(/\s/g,"-").toLowerCase()}function T(e){return/^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i.test(e)}function E(e){if(""!=e)return!0}function j(e){if(""!=e)return!0}}(jQuery);