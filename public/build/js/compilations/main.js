var AJAX_CUR_PAGE=1;function tmsIframe(){$(".tms_iframe").length&&$(".tms_iframe").each(function(){var e=document.createElement("iframe");$.each(this.attributes,function(){"class"!=this.name&&e.setAttribute(this.name.replace("data-",""),this.value)}),$(this).append(e)})}!function(B){BUSY_REQUEST=!1;var w=B(window).width();B(document).ready(function(){!function(){var e=document.querySelector(".header-menu__list-holder");if(e){var t=r()?"click":"hover";e.addEventListener(t,function(e){for(var t,n=e.target;n!=this;){if(n.classList.contains("expand-holder")){if((t=document.querySelector(".expand-holder.opened"))==n){t.querySelector(".expand-menu");"expand-menu"!==e.target.className&&t.classList.remove("opened")}else t?("expand-menu"!==e.target.className&&t.classList.remove("opened"),setTimeout(function(){n.classList.add("opened")},400)):n.classList.add("opened");break}n=n.parentNode}},!0)}}(),q(),function(){var t=B("#js-mobile-menu-opener, #js-mobile-menu-close"),n=B(".header-menu"),o=null,a=B("html, body");t.on("click",function(e){B("body").toggleClass("menu-opened"),t.toggleClass("active"),r()&&(o=B(window).scrollTop(),a.hasClass("no-scroll")?a.addClass("no-scroll"):(a.removeClass("no-scroll"),d(o)),B(".expand-menu__list-item.active ").closest(".expand-holder").addClass("opened")),B(document).on("click touchstart",function(e){0==B(e.target).closest(n).length&&0==B(e.target).closest(t).length&&(B("body").removeClass("menu-opened"),r()&&(u(),d(o)),t.removeClass("active"))}),e.preventDefault()})}(),r()||B(".header-menu__list-holder .expand-holder").on("mouseout",function(e){B(".expand-holder").removeClass("opened")}),B(".load-more").click(function(){new XMLHttpRequest;var e=B(this).data("category"),t=B(this);B.ajax({url:"/load-more/"+e+"/"+AJAX_CUR_PAGE,data:{page:AJAX_CUR_PAGE,category:e},dataType:"html",type:"post",success:function(e){AJAX_CUR_PAGE++,console.dir(e),console.dir(e),B(".cards-list-wrapper").append(e),B(t).data("total")===B(".cards-list-wrapper").children().length&&B(t).hide()},error:function(e){jQuery.parseJSON(e.responseJSON.body.message)[0];"abort"!=e.statusText&&(console.log("err"),__this.closest(_obj).next(".action-field.not-valid").show())},complete:function(){BUSY_REQUEST=!1}})}),/iPhone|iPad|iPod/i.test(navigator.userAgent)&&B("body").addClass("ios-device");var e;B(window).scrollTop()+B(window).height()>B(document).height()-260?tmsIframe():(e=B(window).width()<768?"touchstart":"mousemove",B(window).one(e,tmsIframe));B(window).trigger("scroll"),new c(B(".header"));var t=B(".rating-container").data("user-rate");B(".box img.not-accepted").length?B(".br-widget a").unbind("mouseenter mouseleave mouseover click"):0<t&&(B(".br-widget").children().each(function(){B(this).unbind("mouseenter mouseleave mouseover click"),parseInt(B(this).data("rating-value"))<=parseInt(t)&&B(this).addClass("br-active")}),B(".br-widget").unbind("mouseenter mouseleave mouseover click"))}),B.fn.scrollEnd=function(t,n){B(this).scroll(function(){var e=B(this);e.data("scrollTimeout")&&clearTimeout(e.data("scrollTimeout")),e.data("scrollTimeout",setTimeout(t,n))})};var e=0;if(B(window).on("scroll",function(){e<B(window).scrollTop()?(B("body").removeClass("site__header_sticky"),e=B(window).scrollTop()):e-B(window).scrollTop()>B(window).height()/3&&(B("body").addClass("site__header_sticky"),e=B(window).scrollTop()),0===B(window).scrollTop()&&B("body").removeClass("site__header_sticky")}),B(window).width()<768&&(B(window).scrollEnd(function(){0!==B(window).scrollTop()&&B("body").addClass("site__header_sticky")},800),/\/reviews\//.test(window.location.href)&&0<B(".btn-group-mobile .btn-middle").length)){var t=!1,n=B(window).height()/2+B(window).scrollTop();B(window).on("scroll",function(){B(window).scrollTop()>n&&!1===t&&(B("body").append('<a rel="nofollow" target="_blank" class="btn-play-now" href="'+B(".btn-group-mobile .btn-middle").attr("href")+'">Play Now</a>'),B("body").addClass("play-now-appended"),t=!0)})}B(window).resize(function(e){_(w=B(window).width())}),tooltipConfig={trigger:"click",maxWidth:279,animation:"grow",debug:!1},copyTooltipConfig={trigger:"click",maxWidth:260,minWidth:260,animation:"grow",contentAsHTML:!0,debug:!1,functionBefore:function(e,t){e.content('                <div class="centered">                    <i class="icon icon-icon_available"></i> Code copied to clipboard                </div>            ')}},contentTooltipConfig={trigger:"click",minWidth:460,interactive:!0,contentAsHTML:!0,debug:!1,content:B(".loader"),animation:"fade",contentCloning:!1,functionReady:function(){B("body").addClass("shadow"),b(B(".bonus-box"),15),B(".js-tooltip").tooltipster(tooltipConfig)},functionAfter:function(){B("body").removeClass("shadow")},functionBefore:function(t,e){var n=B(e.origin);if(!0!==n.data("loaded")){var o=n.data("name"),a=n.data("is-free"),i=new XMLHttpRequest;i.abort(),i=B.ajax({url:"/casino/bonus",data:{casino:o,is_free:a},dataType:"html",type:"GET",success:function(e){t.content(e),setTimeout(function(){B(".js-tooltip").tooltipster(tooltipConfig),B(".js-copy-tooltip").tooltipster(copyTooltipConfig),l(),b(B(".bonus-box"),15)},50),n.data("loaded",!0)}})}}};var q=function(){if(function(){new Swiper("#main-carousel",{slidesPerView:6,spaceBetween:5,navigation:{nextEl:".carousel-next",prevEl:".carousel-prev"},breakpoints:{1024:{freeMode:!0,slidesPerView:"auto"}}});var e={slidesPerView:"auto",spaceBetween:30,freeMode:!0,allowTouchMove:!1,slidesOffsetAfter:-220,on:{slideChangeTransitionStart:function(e){B(".links-left").fadeIn("fast")},slideChangeTransitionEnd:function(e){0==this.translate&&B(".links-left").fadeOut("fast")}},breakpoints:{1024:{allowTouchMove:!0},690:{spaceBetween:15,allowTouchMove:!0}}};if(B("#links-nav").length){var t=new Swiper(".links-casinos #links-nav",e);e.slidesOffsetAfter=-330;var n=new Swiper(".links-games #links-nav",e),o=B("#links-nav .active").parent().index()-1,a=B(window).width()/2-50,i=-B("#links-nav .active").parent().position().left+a;r()?(B(".links-casinos #links-nav").length&&t.setTranslate(i),B(".links-games #links-nav").length&&n.setTranslate(i)):(B(".links-casinos #links-nav").length&&t.slideTo(o,300),B(".links-games #links-nav").length&&n.slideTo(o,300))}if(1024<B(window).width()){function s(e,t,n){var o=e.closest(".swiper-container"),a=t;a.clientX>o.offset().left+o.width()/1.3?n.slideNext(500):a.clientX<o.offset().left+o.width()/6&&n.slidePrev(500)}B(".links-casinos .links-nav a").on("mouseenter",function(e){s(B(this),e,t)}),B(".links-games .links-nav a").on("mouseenter",function(e){s(B(this),e,n)})}}(),B.fn.moreLines=function(u){"use strict";return this.each(function(){var e=B(this),t=(e.find("p"),parseFloat(e.css("line-height"))),n=e.innerHeight(),o=B.extend({linecount:1,baseclass:"b-morelines_",basejsclass:"js-morelines_",classspecific:"section",buttontxtmore:"more lines",buttontxtless:"less lines",animationspeed:1},u),a=o.baseclass+o.classspecific+"_ellipsis",i=o.baseclass+o.classspecific+"_button",s=o.baseclass+o.classspecific+"_wrapper",r=o.basejsclass+o.classspecific+"_wrapper",c=B("<div>").addClass(s+" "+r).css({"max-width":e.css("width")}),l=t*o.linecount;if(e.wrap(c),e.parent().not(r)&&l<n){e.addClass(a).css({"min-height":l,"max-height":l,overflow:"hidden"});var d=B("<div>",{class:i,click:function(){e.toggleClass(a),B(this).toggleClass(i+"_active"),"none"!==e.css("max-height")?e.css({height:l,"max-height":""}).animate({height:"100%"},o.animationspeed,function(){d.html(o.buttontxtless)}):e.animate({height:l},o.animationspeed,function(){d.html(o.buttontxtmore),e.css("max-height",l)})},html:o.buttontxtmore});e.after(d)}}),this},B(".js-condense").moreLines({linecount:3,baseclass:"js-condense",basejsclass:"js-condense",classspecific:"_readmore",buttontxtmore:"Read More",buttontxtless:"Read Less",animationspeed:250}),function(){var a=B(".rating-container"),i=(a.data("casino-rating"),a.attr("data-user-rate")),e={showSelectedRating:!1,onSelect:function(e,t,n){if(void 0!==n){var o=B(n.currentTarget);B(".br-widget").children().each(function(){B(this).unbind("mouseenter mouseleave mouseover click"),parseInt(B(this).data("rating-value"))<=parseInt(i)&&B(this).addClass("br-active")}),B(".br-widget").unbind("mouseenter mouseleave mouseover click"),o.closest(a).find(".rating-current-text").text(t).removeClass("terrible poor good very-good excellent").attr("class","rating-current-text "+p(t)),o.closest(a).find(".rating-current-value span").text(e),o.closest(a).find(".rating-current").attr("data-rating-current",e),new s({value:e,name:a.data("casino-name")})}}};B(".rating-bar",a).barrating("show",e)}(),function(){var e=B(".js-filter > option");B(".js-filter").select2MultiCheckboxes({templateSelection:function(e,t){return"Game software"}}),e.prop("selected",!1)}(),function(){var e=B(".header-search"),t=B(".js-search-opener",e),n=B(".js-mobile-search-opener"),o=B(".js-search-close",e),a=B(".js-mobile-search-close"),i=B(".js-mobile-search-clear"),s=B(".js-search-drop"),r=B(".header-search-input input"),c=null;t.on("click",function(e){B("body").addClass("search-opened"),r.focus(),f(s),B(document).on("click touchstart",function(e){0==B(e.target).closest(s).length&&0==B(e.target).closest(r).length&&0==B(e.target).closest(n).length&&0==B(e.target).closest(t).length&&(r.val(""),I(s))})}),r.on("keydown",function(e){13!=e.keyCode&&f(s)}),o.on("click",function(e){I(s)}),n.on("click",function(e){c=B(window).scrollTop(),B("body").addClass("mobile-search-opened"),B("html, body").addClass("no-scroll"),r.focus()}),a.on("click",function(e){r.val("").blur(),B("body").removeClass("mobile-search-opened"),u(),d(c)}),i.on("click",function(){r.val("").focus()})}(),l(),_(w),y(),B("#reviews").on("click",".js-reply-btn",function(e){return B(this).parent().next().slideToggle(),!1}),C(),function a(){var e=B(".js-more-reviews");e.data("reviews");var i=B("#review-data-holder");var s=B(".reply-data-holder");var t=B(".rating-container").data("casino-name");var r=new XMLHttpRequest;e.on("click",function(){return console.log("Clicked"),n(B(this),B(this).data("type")),!1});B(".not-accepted").length&&e.css("pointer-events","auto");var n=function(n,o){BUSY_REQUEST||(BUSY_REQUEST=!0,r.abort(),r=B.ajax({url:"/casino/more-reviews/"+p(t)+"/"+n.data("page"),dataType:"HTML",data:{id:n.data("id"),type:o},type:"GET",success:function(e){"review"==o?(i.append(e),n.data("page")>=n.data("total")/5-1&&n.hide()):"reply"==o&&n.closest(".reply").find(s).append(e),n.data("page")>=n.data("total")/5-1&&n.hide();var t=n.data("page");n.data("page",++t),c(),a()},error:function(e){"abort"!=e.statusText&&console.log("err")},complete:function(){BUSY_REQUEST=!1}}))},c=function(){y(),C(),new k(B(".js-vote")),B(".review").each(function(){new x(B(this))})}}(),b(B(".list .bonus-box"),21),b(B(".bonus-item .bonus-box"),33),function(){if(10<=function(){var e=-1;if("Microsoft Internet Explorer"==navigator.appName){var t=navigator.userAgent;null!=new RegExp("MSIE ([0-9]{1,}[.0-9]{0,})").exec(t)&&(e=parseFloat(RegExp.$1))}else if("Netscape"==navigator.appName){t=navigator.userAgent;null!=new RegExp("Trident/.*rv:([0-9]{1,}[.0-9]{0,})").exec(t)&&(e=parseFloat(RegExp.$1))}return e}()){B("img.not-accepted").each(function(){var e=B(this);e.css({position:"absolute"}).wrap("<div class='img_wrapper' style='display: inline-block'>").clone().addClass("img_grayscale").css({position:"absolute","z-index":"5",opacity:"0"}).insertBefore(e).queue(function(){var e=B(this);e.parent().css({width:this.width,height:this.height}),e.dequeue()}),this.src=function(e){var t=document.createElement("canvas"),n=t.getContext("2d"),o=new Image;o.src=e,t.width=o.width,t.height=o.height,n.drawImage(o,0,0);for(var a=n.getImageData(0,0,t.width,t.height),i=0;i<a.height;i++)for(var s=0;s<a.width;s++){var r=4*i*a.width+4*s,c=(a.data[r]+a.data[1+r]+a.data[2+r])/3;a.data[r]=c,a.data[1+r]=c,a.data[2+r]=c}return n.putImageData(a,0,0,0,0,a.width,a.height),t.toDataURL()}(this.src)})}}(),B(".js-table-package-opener").on("click",function(e){B(this).closest("tr").toggleClass("active"),e.preventDefault()}),B(".message .close").on("click",function(e){B(this).parent().fadeOut(),e.preventDefault()}),B(".js-history-back").on("click",function(e){window.history.back(),e.preventDefault()}),0<B("#filters").length&&new i(B("#filters")),0<B("#reviews").length&&(B(".review").each(function(e){new x(B(this))}),B('[href="#reviews"]').on("click",function(){return function(e,t){if(void 0!==e)n(e,t);else{B(".js-scroll").on("click",function(e){n(B(B(this).attr("href")),0),e.preventDefault()})}function n(e,t){B("html, body").animate({scrollTop:e.offset().top-t},1e3)}}(B("#reviews"),100),!1})),0<B(".js-vote").length&&new k(B(".js-vote")),0<B(".js-run-counter").length){var e=B(".js-run-counter").data("name");runPlayCounter(e)}0<B(".contact-form").length&&new a(B(".contact-form")),new o(B(".subscribe")),B(".js-tooltip").tooltipster(tooltipConfig),B(".js-copy-tooltip").tooltipster(copyTooltipConfig),B(".js-tooltip-content").tooltipster(contentTooltipConfig)};function r(){var e=B(window).width();return B(window).resize(function(){e=B(window).width()}),e<1e3||!!/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)}function b(e,a){B(e).each(function(e,t){var n=B(this).find(".list-item-trun"),o=B(this).find(".bubble");n.text().length>=a&&o.css("visibility","visible")})}function o(e){var t,n=e,o=n.find(".news-email"),a=n.find(".news-btn"),i=B("#news-success"),s=B("#news-note"),r="not-valid",c=new XMLHttpRequest;_prepMessage=function(){return t=o.val(),ok=!0,""!==t&&T(t)?o.parent().removeClass(r):(o.parent().addClass(r),ok=!1),ok?s.hide():s.show(),ok},_sendNews=function(e){c.abort(),c=B.ajax({url:"/newsletter/subscribe",data:{email:e},dataType:"json",timeout:2e4,type:"POST",success:function(e){if("ok"==e.status)i.show(),s.hide(),a.prop("disabled",!0),o.val(""),_onEvents();else if("error"==e.status){var t=JSON.parse(e.body);B(".action-added").remove(),B.each(t,function(e,t){var n='<div class="action-field action-added not-valid ">'+t+"</div>";B(".review-submit-holder .msg-holder").append(n)})}},error:function(e){console.error("Could not send message!")}})},_onEvents=function(){a.on({click:function(e){!1===_prepMessage()?e.stopPropagation():_sendNews(t)}})},_init=function(){_onEvents()},_init()}function a(e){var t,n,o,a=B(".contact-name"),i=B(".contact-email"),s=B(".contact-message"),r=B(".contact-btn"),c=B("#contact-us-success"),l=B("#contact-us-note"),d=B("#server-error-note"),u="not-valid",f=new XMLHttpRequest;_prepContact=function(){return t=a.val(),n=i.val(),o=s.val(),ok=!0,""!==t&&j(t)?a.parent().removeClass(u):(a.parent().addClass(u),ok=!1),""!==n&&T(n)?i.parent().removeClass(u):(i.parent().addClass(u),ok=!1),""!==o&&E(o)?s.parent().removeClass(u):(s.parent().addClass(u),ok=!1),ok?l.hide():l.show(),ok},_sendMessage=function(e,t,n){f.abort(),f=B.ajax({url:"/contact/send",data:{name:e,email:t,message:n},dataType:"json",timeout:2e4,type:"POST",success:function(e){if("ok"==e.status)c.show(),l.hide(),d.hide(),r.prop("disabled",!0),a.val(""),i.val(""),s.val(""),_onEvents();else if("error"==e.status){JSON.parse(e.body);d.show()}},error:function(e){console.error("Could not send message!")}})},_onEvents=function(){r.on({click:function(e){!1===_prepContact()?e.stopPropagation():_sendMessage(t,n,o)}})},_init=function(){_onEvents()},_init()}var i=function(e){var s,t,n=e,o=this,a=n.find("input[type=checkbox]"),i=n.find("input[type=radio]"),r=n.find("select[name=soft]"),c=B(".data-container"),l=B(".data-add-container"),d=c.data("type"),u=c.data("type-value"),f=(B(".aj-content"),B(".empty-filters")),p=n.next(".data-container-holder").find(".holder"),h=B(".list-item").length,m=B("#default"),v=B(".qty-items").data("load-total");Math.floor(v/h);_currentClick=0,_request=new XMLHttpRequest,void 0===d&&(d="game_type"),_url=n.data("url"),m.prop("checked",!0);var g=function(e,t,n){var o={};return B.each(a,function(e,t){B(t).is(":checked")&&(o[B(t).attr("name")]=1),"reset"==n&&(o[B(t).attr("name")]="",B(t).prop("checked",!1))}),B.each(i,function(e,t){B(t).is(":checked")&&(o[B(t).attr("name")]=B(t).attr("value")),"reset"==n&&(o[B(t).attr("name")]=1,0==e&&B(t).prop("checked",!0))}),o[e]=t,"undefined"!=r.val()&&null!=r.val()&&(o.software=r.val().join(),"reset"==n&&(o.software="")),void 0===AJAX_CUR_PAGE&&(AJAX_CUR_PAGE=1),"add"==n&&"reset"!=n||(AJAX_CUR_PAGE=0),null!=o.label&&"Mobile"==o.label&&(o.compatibility="mobile",delete o.label),o};_ajaxRequestCasinos=function(e,a){if(console.dir("test"),"add"==a?s.addClass("loading"):B(".overlay, .loader").fadeIn("fast"),!BUSY_REQUEST){BUSY_REQUEST=!0,_request.abort();var i="/games-filter/"==_url?24:100;_request=B.ajax({url:_url+AJAX_CUR_PAGE,data:e,dataType:"html",type:"GET",success:function(e){var t=B(e).find(".loaded-item"),n=B(e).filter("[data-load-total]").data("load-total");function o(){B(".js-tooltip").tooltipster(tooltipConfig),B(".js-copy-tooltip").tooltipster(copyTooltipConfig),B(".js-tooltip-content").tooltipster(contentTooltipConfig),_(w)}"replace"==a?(c.html(e),l.html(""),B(".qty-items").attr("data-load-total",n),B(".qty-items-quantity").text(n),t.length<i?(0<t.length?(p.show(),f.hide()):(p.hide(),f.show()),s.hide()):(s.show(),p.show(),f.hide()),o(),AJAX_CUR_PAGE=1,_currentClick=0):(AJAX_CUR_PAGE++,_currentClick++,setTimeout(function(){l.append(t),s.removeClass("loading"),o(),t.length<i&&s.hide()},1e3)),_construct(),b(B(".data-add-container .bonus-box, .data-container .bonus-box"),21)},error:function(e){"abort"!=e.statusText&&console.log("err")},complete:function(){BUSY_REQUEST=!1,B(".overlay, .loader").fadeOut("fast")}});var t=setTimeout(function(){},300);_hideLoading=function(){clearTimeout(t)}}},_loadData=function(e){},_construct=function(){s=B(".js-more-items"),t=B(".js-reset-items"),a.off(),a.on("click",function(){_ajaxRequestCasinos(g(d,u),"replace")}),i.off(),i.on("click",function(){_ajaxRequestCasinos(g(d,u),"replace")}),B(".js-filter > option").on("click",function(){B(".js-filter > option").each(function(e,t){B(this).prop("selected")})}),r.off(),r.on("change",function(){_ajaxRequestCasinos(g(d,u),"replace")}),s.off(),s.on("click",function(){return _ajaxRequestCasinos(g(d,u,"add"),"add"),!1}),t.off(),t.on("click",function(){return _ajaxRequestCasinos(g(d,u,"reset"),"add"),!1}),n[0].obj=o},_construct()};function y(){var e=B(".expanding"),t=B(".js-expanding-textfields");B(".box img.not-accepted").length?e.unbind("mouseenter mouseleave mouseover click focus"):e.on("focus",function(){B(this).removeClass("expanding"),B(this).closest(".form").find(t).slideDown()})}var k=function(e){var i=e,t=i.find(".vote-button"),n=new XMLHttpRequest,o=function(e,t,n){return{id:t,is_like:n}};_getTarget=function(e){var t="/casino/review-like";return"article"===e&&(t="/blog/rate"),t},_updateVote=function(o,a,e){BUSY_REQUEST||(BUSY_REQUEST=!0,n.abort(),n=B.ajax({url:a,data:e,dataType:"json",type:"post",success:function(e){e.body.message;if("/casino/review-like"===a){var t=B(o).find(".bubble-vote"),n=t.text();t.text(++n),o.closest(i).next(".action-field.success").show()}else"/blog/rate"===a&&(B(o.parent().parent()).find(".votes-like .vote-block-num, .like .vote-block-num").text(e.body.likes),B(o.parent().parent()).find(".votes-dislike .vote-block-num, .dislike .vote-block-num").text(e.body.dislikes),o.closest(i).next(".action-field.success").show())},error:function(e){jQuery.parseJSON(e.responseJSON.body.message)[0];"abort"!=e.statusText&&(console.log("err"),__this.closest(i).next(".action-field.not-valid").show())},complete:function(){BUSY_REQUEST=!1}}))},t.off(),t.on("click",function(){var e=B(this).data("id"),t=B(this).data("success"),n=B(this).data("type");return _updateVote(B(this),_getTarget(n),o(n,e,t)),!1})};function x(e){var n,o,a,i,s,r,c,l,d,u,f,p,t=this.obj=e,h=(B("#reviews-form").data("img-dir"),B("#reviews-form").data("country"),t.find("input[name=submit]")),m=B(".reviews-qty"),v="not-valid",g=B(".reviews-form").data("casino-id"),w=localStorage.getItem("casino_"+g+"_reviewed"),b=localStorage.getItem("casino_"+g+"_score"),_=new XMLHttpRequest;_prepReview=function(e){var t=e;return o=t.find("input[name=name]"),a=t.find("input[name=email]"),i=t.find("textarea[name=body]"),s=t.find(".field-error-required"),r=t.find(".field-error-rate"),_contact_error=t.find(".field-error"),c=o.val(),l=a.val(),d=i.val(),casino_name=B(".rating-container").data("casino-name"),f=B(".rating-current-value span").text(),ok=!(n=0),null!=t.data("id")?(n=t.data("id"),u=!0,0<t.next().find(".reply-data-holder").length?(t.next().find(".reply-data-holder"),!1):(!0,n=t.closest(".reply").prev().data("id"),_setReviewerName(t),t.closest(".reply-data-holder")),p=t.find(".js-reply-btn span")):(u=!1,B("#review-data-holder")),""!==c&&j(c)?o.parent().removeClass(v):(o.parent().addClass(v),ok=!1),""!==l&&T(l)?a.parent().removeClass(v):(a.parent().addClass(v),ok=!1),""!==d&&E(d)?i.parent().removeClass(v):(i.parent().addClass(v),ok=!1),ok?(_contact_error.hide(),s.hide()):s.show(),u||("0"===f?(r.show(),t.find(B(".rating-container")).addClass(v),ok=!1):(r.hide(),t.find(B(".rating-container")).removeClass(v))),ok},_setReviewerName=function(e){var t=e.find(".review-name").text();d="<strong>@"+t+"</strong> "+i.val()},_changeName=function(){B("#reviews-form input[name=name]").on("keyup",function(){B("#reviews-form .review-name").text(B(this).val())})},_prepAjaxData=function(e){var t={casino:casino_name,name:c,email:l,body:d,parent:n,casino_id:B(".reviews-form").attr("data-casino-id")};_sendReview(t,e)},_sendReview=function(e,t){BUSY_REQUEST||(BUSY_REQUEST=!0,_.abort(),_=B.ajax({url:"/casino/review-write",data:e,dataType:"json",timeout:2e4,type:"POST",success:function(e){_loadData(e,t),o.val(""),a.val(""),i.val("").addClass("expanding"),_onEvents(),B(".form .js-expanding-textfields").slideUp()},error:function(e){_errors_found=B.parseJSON(e.responseText),console.error("Could not send message!"),console.log(_errors_found.body.message)},complete:function(){BUSY_REQUEST=!1}}))},_loadData=function(e,t){B("#review-data-holder").load(location.href+" #review-data-holder",function(){_refreshData()},500)},_refreshData=function(){u||(m.text(parseInt(m.text())+1),localStorage.setItem("casino_"+g+"_reviewed",1),localStorage.setItem("casino_"+g+"_score",f)),u&&p.text(parseInt(p.text())+1),B(".review-form").slideUp(),y(),C(),new k(B(".js-vote")),B(".review, .reply").each(function(){new x(B(this))})},_doIfReviewedAlready=function(){var e=B("#reviews-form");B(".review-rating",e).addClass("active"),B("textarea",e).addClass("disabled"),B(".rating-bar").barrating("set",b),B(".rating-current-value span").text(b),B("textarea[name=body]",e).attr("placeholder","You have already reviewed")},_initForms=function(){h.off(),h.on({click:function(e){!1===_prepReview(t)?e.stopPropagation():_prepAjaxData(t)}})},_onEvents=function(){w?(_doIfReviewedAlready(),_initForms()):(_initForms(),_changeName())},_init=function(){_onEvents()},_init()}var s=function(e){var t=e,n=t.name,o=t.value,a=new XMLHttpRequest;(function(e,t){BUSY_REQUEST||(BUSY_REQUEST=!0,a.abort(),a=B.ajax({url:"/casino/rate",data:{name:e,value:t},dataType:"json",type:"post",success:function(e){"Casino already rated!"==e.body.success&&(B(".icon-icon_available").toggleClass("icon-icon_unavailable"),B(".icon-icon_unavailable").removeClass("icon-icon_available"),B(".thanx").html(e.body.success)),B(".rating-container").next(".action-field").show()},error:function(e){"abort"!=e.statusText&&console.log("err")},complete:function(){BUSY_REQUEST=!1}}))})(n,o)},c=function(e){var o,a,t=e,n=this,i=t.find(".js-trigger-search"),s=t.find("#search-all"),r=t.find("#search"),c=t.find("#search-form"),l=(t.find(".search-results"),c.find("input")),d=c.find(".js-mobile-search-clear"),u=r.find("#search-casinos ul"),f=r.find("#search-lists ul"),p=r.find("#search-pages ul"),h=r.find("#search-empty"),m=(r.data("img-dir"),!1),v=1,g=1,w=1,b=new XMLHttpRequest;window.contentBeforeSearch;function _(){B("#site-content").html("").append(contentBeforeSearch),B(".js-search-drop").show(),B("body").removeClass("advanced-search-opened"),l.blur(),setTimeout(function(){q()},1e3)}function y(e){return e.replace(/\s/g,"-").toLowerCase()}function k(e){return'<li>                    <a class="search-results-label" href="/'+e.link.replace("/games/","")+'">                        '+e.name+"                    </a>                </li>"}var x=function(e,t,n,o){if(!BUSY_REQUEST){BUSY_REQUEST=!0,b.abort(),b=B.ajax({url:e,data:{value:t},dataType:"json",type:"GET",success:function(e){_hideLoading(),j(e,n,o)},error:function(e){"abort"!=e.statusText&&(_hideLoading(),console.log("err"),R())},complete:function(){_hideLoading(),BUSY_REQUEST=!1}});var a=setTimeout(function(){},300);_hideLoading=function(){clearTimeout(a)}}},C=function(){window.scrollTo(0,0);var t=B("#site-content");BUSY_REQUEST||(BUSY_REQUEST=!0,b.abort(),b=B.ajax({url:"/search/advanced",data:{value:l.val()},dataType:"HTML",type:"GET",success:function(e){B("body").addClass("advanced-search-opened"),m||(contentBeforeSearch=B("#site-content .main, #site-content .promo").detach()),m=!0,t.html(e),A(),function(){var e=B("#js-search-more-lists"),t=B(".more-lists",e),n=t.data("total-casinos"),o=B("#js-search-more-casinos"),a=B(".more-num",o),i=a.data("total-casinos"),s=B("#js-search-more-pages"),r=B(".more-num",s),c=r.data("total-games"),l=Math.floor(n/5),d=Math.floor(i/5),u=Math.floor(c/5),f=n%5,p=i%5,h=c%5;f<5&&1==l&&t.text(f),p<5&&1==d&&a.text(p),h<5&&1==u&&r.text(h),e.on("click",function(){return x("/search/more-lists/"+g,B(".search-title span").text(),B("#all-lists-container"),"lists"),l<=g?e.fadeOut():e.fadeIn(),l-1<=g&&0<f&&t.text(f),g++,!1}),o.on("click",function(){return x("/search/more-casinos/"+v,B(".search-title span").text(),B("#all-casinos-container"),"casinos"),d<=v?o.fadeOut():o.fadeIn(),d-1<=v&&0<p&&a.text(p),v++,!1}),s.on("click",function(){return x("/search/more-games/"+w,B(".search-title span").text(),B("#all-games-container"),"games"),u<=w?s.fadeOut():s.fadeIn(),u-1<=w&&0<h&&r.text(h),w++,!1})}(),t.find("#js-search-back").each(function(){B(this).on({click:function(){_()}})}),B(".js-mobile-search-close").on("click",function(){_()})},error:function(e){"abort"!=e.statusText&&console.log("err")},complete:function(){BUSY_REQUEST=!1}}))},T=function(e,t){if(!BUSY_REQUEST||a!=o){BUSY_REQUEST=!0,b.abort(),b=B.ajax({url:e,data:{value:l.val(),page:t},dataType:"json",type:"GET",success:function(e){_hideLoading(),E(e)},error:function(e){"abort"!=e.statusText&&(_hideLoading(),console.log("err"),R())},complete:function(e){_hideLoading(),a++,BUSY_REQUEST=!1}});var n=setTimeout(function(){},300);_hideLoading=function(){clearTimeout(n)}}},j=function(e,t,n){var o,a=e.body.results;if("lists"===n)for(var i=0;i<a.length;i++){var s=k({link:a[i].url,name:a[i].title});t.append(s)}else for(var r in a){"games"==n?o="play/"+y(a[r]):"casinos"==n&&(o="reviews/"+y(a[r])+"-review");s=k({link:o,name:a[r]});t.append(s)}},E=function(e){var t=e.body.lists,n=e.body.casinos,o=e.body.games;if(f.empty(),u.empty(),p.empty(),B.isEmptyObject(t)&&B.isEmptyObject(n)&&B.isEmptyObject(o))R();else{U(),B.isEmptyObject(t)?f.parent().hide().next().addClass("single"):(f.parent().show().next().removeClass("single"),3<e.body.total_lists&&Math.ceil(e.body.total_lists/3)>g||(g=1)),B.isEmptyObject(n)?u.parent().hide().next().addClass("single"):(u.parent().show().next().removeClass("single"),3<e.body.total_casinos&&Math.ceil(e.body.total_casinos/3)>v||(v=1)),B.isEmptyObject(o)?p.parent().hide().prev().addClass("single"):(p.parent().show().prev().removeClass("single"),3<e.body.total_pages&&Math.ceil(e.body.total_casinos/3)>w||(w=1)),f.html("");for(var a=0;a<t.length;a++){var i=k({link:t[a].url,name:t[a].title});f.append(i)}for(var s in n){i=k({link:"reviews/"+y(n[s])+"-review",name:n[s]});u.append(i)}for(var r in o){i=k({link:"play/"+y(o[r]),name:o[r]});p.append(i)}""!=l.val()&&L()}},S=function(){v=w=1},R=function(){f.parent().hide(),u.parent().hide(),p.parent().hide(),h.show(),s.parent().fadeOut()},U=function(){f.parent().show(),u.parent().show(),p.parent().show(),h.hide()},A=function(){I(B(".js-search-drop")),!0},M=function(){A()},L=function(){t.find(".search-results-label").each(function(){B(this).html(function(e,t){return t.replace(new RegExp(l.val().toLowerCase(),"ig"),"<b>$&</b>")})})};n.close=function(){M()},i.on("click",function(){return T("/search"),S(),!1}),l.on({focus:function(){a=o=0,T("/search"),S()},keyup:function(e){27==e.keyCode?M():13==e.keyCode?""!=l.val()&&(C(),l.blur()):(t.find("#search__popup").addClass("load"),o++,T("/search")),S(),""!=l.val()?s.parent().fadeIn():s.parent().fadeOut()}}),d.on("click",function(){return l.val("").focus(),T("/search"),S(),!1}),s.on("click",function(){return""!=l.val()&&C(),!1}),t[0].obj=n};function C(){var e=B(".textfield");e.focus(function(){B(this).parent().addClass("active").removeClass("not-valid")}),e.blur(function(){""==B(this).val()&&B(this).parent().removeClass("active")})}function _(e){var s=B(".list-item"),r=B(".js-mobile-pop"),t=B(".btn-round"),n=B(".js-mobile-pop-close"),o=null;if(e<=690){function a(e){var t=e.closest(s).find(".mobile-popup-body"),n=e.closest(s).find(".mobile-popup-title"),o=(e.closest(s).find(".js-tooltip-content"),e.data("name")),a=e.data("is-free"),i=new XMLHttpRequest;i.abort(),i=B.ajax({url:"/casino/bonus",data:{casino:o,is_free:a},dataType:"html",type:"GET",success:function(e){$bonus=e,a?t.prepend($bonus):t.append($bonus),n.text(B($bonus).find(".tooltip-templates-title").text()),t.find(".js-tooltip").tooltipster(tooltipConfig),t.find(".js-copy-tooltip").tooltipster(copyTooltipConfig),b(B(".bonus-box"),21),l(),B(".overlay, .loader").fadeOut("fast")}}),function(e){e.closest(s).find(r).fadeIn("fast"),B("html, body").addClass("no-scroll")}(e)}t.off("click"),t.on("click",function(e){return o=B("html, body").scrollTop(),B(".overlay, .loader").fadeIn("fast"),a(B(this)),!1}),n.on("click",function(e){return B(this).closest(r).fadeOut("fast").find(".mobile-popup-body").html(""),B("html, body").removeClass("no-scroll"),B(".overlay, .loader").fadeOut("fast"),B("html, body").animate({scrollTop:o},10),!1})}}function l(){function n(){return e.userAgent.match(/ipad|iphone/i)}var o,a,e,i;window.Clipboard=(o=window,a=document,e=navigator,{copy:function(e,t){!function(e,t){i=a.createElement("textArea"),n()&&i.setAttribute("readonly","readonly"),i.value=e,t.parent().append(i)}(function(e){var t=document.createElement("DIV");return t.innerHTML=e,t.textContent||t.innerText||""}(e),t),function(){var e,t;n()?((e=a.createRange()).selectNodeContents(i),(t=o.getSelection()).removeAllRanges(),t.addRange(e),i.setSelectionRange(0,999999)):i.select()}(),function(e){a.execCommand("copy"),e.parent().find(i).remove()}(t)}}),B(".js-copy-to-clip").on("click touch",function(e){Clipboard.copy(B(this).data("code"),B(this)),e.preventDefault()})}function d(e){B("html, body").animate({scrollTop:e},5)}function u(){B("html, body").removeClass("no-scroll")}function f(e){setTimeout(function(){e.slideDown("fast")},300)}function I(e){e.slideUp("fast"),setTimeout(function(){B("body").removeClass("search-opened")},300)}function p(e){return e.replace(/\s/g,"-").toLowerCase()}function T(e){return/^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i.test(e)}function j(e){if(""!=e)return!0}function E(e){if(""!=e)return!0}}(jQuery);
"use strict";$(function(){function f(r,l,t,s,c){function d(t,e,n){n=void 0===n?0:"-"+n+"px",r.css({"margin-right":n}).width(Math.round(t)).height(Math.round(e))}this.resizeOnWidth=function(t){d(t,t*l)},this.resizeOnWidthHeight=function(t,e){if(l<e/t){c("height");var n=t*l;if(n+2*s.outerHeight(!0)>e){var r=n+(e-n-2*s.outerHeight(!0));d(r/l,r)}else d(t,n)}else{c("width");var i=e/l,o=s.outerWidth(!0);if(t<i+2*o){var a=t-i-2*o+i;d(a,a*l)}else d(i,e)}}}var g=null!==document.ontouchstart?"click":"touchstart";new function(n){document.domain=n.domain;var t=!1,r=!1,i=$(n.iframe),e=$(n.extraElements),o=!1,a=i.attr("height")/i.attr("width");i.removeAttr("width").removeAttr("height");var l=new f(i,a,n.mobileWidth,e,function(t){u(),"width"==t?n.tabletWidth>$(window).width()?e.addClass("left-player-controler"):e.addClass("right-player-controler"):"height"==t&&e.addClass("top-player-controler")});function s(){var t=i.contents().find("#overlay").attr("data-game-url");if(void 0!==t&&!1!==t){r=!0;var e=i.contents().find(n.events.play);$(e).on(g,function(){e.trigger("click"),d()})}}function c(){var t=i.attr("src");i.attr("src",null),r&&!o&&(o=!0,i.load(function(){s()})),i.attr("src",t)}function d(){t?(t=!1,r&&c(),$("body").removeClass("fullscreenGameplay"),u()):(t=!0,$("body").addClass("fullscreenGameplay")),h()}function u(){e.removeClass("top-player-controler").removeClass("left-player-controler").removeClass("right-player-controler")}function h(){t?l.resizeOnWidthHeight($(window).width(),$(window).height()):l.resizeOnWidth(i.parent().width())}$(window).on("orientationchange, resize",function(){h()}).resize(),$(n.events.reload).on("click",function(){c()}),$(n.events.fullscreen).on("click",function(){d()}),setTimeout(function(){s(),void 0!==n.triggerOnPlay&&$(n.events.fullscreen).on("click",function(){n.triggerOnPlay()})},500)}({domain:"casinoslists.com",iframe:"#gameplay_iframe",extraElements:".player-controls",mobileWidth:690,desktopWidth:1200,events:{reload:"#play-replay",fullscreen:"#play-fullscreen",play:"#game_play_button"},triggerOnPlay:function(){var t=window.location.href.substring(window.location.href.lastIndexOf("/")+1),e=new XMLHttpRequest;BUSY_REQUEST||(BUSY_REQUEST=!0,e.abort(),e=$.ajax({url:"/play-counter",data:{name:t},dataType:"json",type:"post",success:function(t){},error:function(t){"abort"!=t.statusText&&console.log("err")},complete:function(){BUSY_REQUEST=!1}}))}})});
