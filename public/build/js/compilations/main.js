var AJAX_CUR_PAGE=1;!function(e){function t(){function t(e){var t=document.createElement("canvas"),n=t.getContext("2d"),o=new Image;o.src=e,t.width=o.width,t.height=o.height,n.drawImage(o,0,0);for(var a=n.getImageData(0,0,t.width,t.height),i=0;i<a.height;i++)for(var s=0;s<a.width;s++){var r=4*i*a.width+4*s,c=(a.data[r]+a.data[r+1]+a.data[r+2])/3;a.data[r]=c,a.data[r+1]=c,a.data[r+2]=c}return n.putImageData(a,0,0,0,0,a.width,a.height),t.toDataURL()}n()>=10&&e(".not-accepted").each(function(){var n=e(this);n.css({position:"absolute"}).wrap("<div class='img_wrapper' style='display: inline-block'>").clone().addClass("img_grayscale").css({position:"absolute","z-index":"5",opacity:"0"}).insertBefore(n).queue(function(){var t=e(this);t.parent().css({width:this.width,height:this.height}),t.dequeue()}),this.src=t(this.src)})}function n(){var e=-1;if("Microsoft Internet Explorer"==navigator.appName){var t=navigator.userAgent,n=new RegExp("MSIE ([0-9]{1,}[.0-9]{0,})");null!=n.exec(t)&&(e=parseFloat(RegExp.$1))}else if("Netscape"==navigator.appName){var t=navigator.userAgent,n=new RegExp("Trident/.*rv:([0-9]{1,}[.0-9]{0,})");null!=n.exec(t)&&(e=parseFloat(RegExp.$1))}return e}function o(t,n){var o=n,a=t.body.bonus.amount,i=t.body.bonus.code,s=t.body.bonus.games_allowed,r=t.body.bonus.min_deposit,c=t.body.bonus.type,l=t.body.bonus.wagering,d="bonus-free",u="icon-icon_bonuses",f="",p="";"First Deposit Bonus"==c&&(d="bonus-first",u="icon-free-bonus-icon"),"Free Play"==c&&(c="Free Bonus"),"No code required"!=i&&(f="js-copy-to-clip js-copy-tooltip"),""==r&&(r="Free",p="success");var h=e(e("#bonus-box-tpl").html()).filter(".tooltip-content");return h.addClass(d),h.find(".tooltip-templates-title").text(o+" "+c),h.find(".tooltip-templates-button a").attr("href","/visit/"+k(o)),h.find(".bonus-box-heading span").text(a+" "+c),h.find(".bonus-box-btn.dashed").addClass(f).attr("data-code",i).text(i),h.find(".bonus-box-wagering").text(l),h.find(".list-item-trun").text(s),h.find(".bubble").attr("title",s),h.find(".bonus-box-dep").addClass(p).text(r),h.find(".bonus-box-circle i").addClass(u),h}function a(){var t=0;return e(window).resize(function(){t=e(document).width()}),1e3>t?!0:/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)?!0:!1}function i(){var e=document.querySelector(".header-menu__list-holder");if(e){var t=a(),n=t?"click":"hover";e.addEventListener(n,function(e){for(var t,n=this,o=e.target;o!=n;){if(o.classList.contains("expand-holder")){if(t=document.querySelector(".expand-holder.opened"),t==o){{t.querySelector(".expand-menu")}t.classList.remove("opened")}else t?(t.classList.remove("opened"),setTimeout(function(){o.classList.add("opened")},400)):o.classList.add("opened");break}o=o.parentNode}},!0)}}function s(t,n){e(t).each(function(t,o){var a=e(this).find(".list-item-trun"),i=e(this).find(".bubble");a.text().length>=n&&i.css("visibility","visible")})}function r(t){var n,o=t,a=o.find(".news-email"),i=o.find(".news-btn"),s=e("#news-success"),r=e("#news-note"),c="not-valid",l=new XMLHttpRequest;_prepMessage=function(){return n=a.val(),ok=!0,""!==n&&E(n)?a.parent().removeClass(c):(a.parent().addClass(c),ok=!1),ok?r.hide():r.show(),ok},_sendNews=function(t){l.abort(),l=e.ajax({url:"/newsletter/subscribe",data:{email:t},dataType:"json",timeout:2e4,type:"POST",success:function(t){if("ok"==t.status)s.show(),r.hide(),i.prop("disabled",!0),a.val(""),_onEvents();else if("error"==t.status){var n=JSON.parse(t.body);e(".action-added").remove(),e.each(n,function(t,n){var o='<div class="action-field action-added not-valid ">'+n+"</div>";e(".review-submit-holder .msg-holder").append(o)})}},error:function(e){console.error("Could not send message!")}})},_onEvents=function(){i.on({click:function(e){var t=_prepMessage();t===!1?e.stopPropagation():_sendNews(n)}})},_init=function(){_onEvents()},_init()}function c(t){var n,o,a,i=e(".contact-name"),s=e(".contact-email"),r=e(".contact-message"),c=e(".contact-btn"),l=e("#contact-us-success"),d=e("#contact-us-note"),u=e("#server-error-note"),f="not-valid",p=new XMLHttpRequest;_prepContact=function(){return n=i.val(),o=s.val(),a=r.val(),ok=!0,""!==n&&S(n)?i.parent().removeClass(f):(i.parent().addClass(f),ok=!1),""!==o&&E(o)?s.parent().removeClass(f):(s.parent().addClass(f),ok=!1),""!==a&&R(a)?r.parent().removeClass(f):(r.parent().addClass(f),ok=!1),ok?d.hide():d.show(),ok},_sendMessage=function(t,n,o){p.abort(),p=e.ajax({url:"/contact/send",data:{name:t,email:n,message:o},dataType:"json",timeout:2e4,type:"POST",success:function(e){if("ok"==e.status)l.show(),d.hide(),u.hide(),c.prop("disabled",!0),i.val(""),s.val(""),r.val(""),_onEvents();else if("error"==e.status){{JSON.parse(e.body)}u.show()}},error:function(e){console.error("Could not send message!")}})},_onEvents=function(){c.on({click:function(e){var t=_prepContact();t===!1?e.stopPropagation():_sendMessage(n,o,a)}})},_init=function(){_onEvents()},_init()}function l(){var t=e(".expanding"),n=e(".js-expanding-textfields");t.on("focus",function(){e(this).removeClass("expanding"),e(this).closest(".form").find(n).slideDown()})}function d(t){this.obj=t;var n,o,a,i,s,r,c,u,f,v,m,g,b,w,_=t,y=e("#reviews-form").data("img-dir"),x=e("#reviews-form").data("country"),C=_.find("input[name=submit]"),j=e(".reviews-qty"),T="not-valid",L=e(".reviews-form").data("casino-id"),M=localStorage.getItem("casino_"+L+"_reviewed"),A=localStorage.getItem("casino_"+L+"_score"),B=new XMLHttpRequest;_prepReview=function(t){var l=t;return o=l.find("input[name=name]"),a=l.find("input[name=email]"),i=l.find("textarea[name=body]"),s=l.find(".field-error-required"),r=l.find(".field-error-rate"),_contact_error=l.find(".field-error"),u=o.val(),f=a.val(),v=i.val(),casino_name=e(".rating-container").data("casino-name"),b=e(".rating-current-value span").text(),n=0,ok=!0,void 0!=l.data("id")?(n=l.data("id"),m=!0,l.next().find(".reply-data-holder").length>0?(c=l.next().find(".reply-data-holder"),g=!1):(g=!0,n=l.closest(".reply").prev().data("id"),_setReviewerName(l),c=l.closest(".reply-data-holder")),w=l.find(".js-reply-btn span")):(m=!1,c=e("#review-data-holder")),""!==u&&S(u)?o.parent().removeClass(T):(o.parent().addClass(T),ok=!1),""!==f&&E(f)?a.parent().removeClass(T):(a.parent().addClass(T),ok=!1),""!==v&&R(v)?i.parent().removeClass(T):(i.parent().addClass(T),ok=!1),ok?(_contact_error.hide(),s.hide()):s.show(),m||("0"===b?(r.show(),l.find(e(".rating-container")).addClass(T),ok=!1):(r.hide(),l.find(e(".rating-container")).removeClass(T))),ok},_setReviewerName=function(e){var t=e.find(".review-name").text(),n="<strong>@"+t+"</strong> ";v=n+i.val()},_changeName=function(){e("#reviews-form input[name=name]").on("keyup",function(){e("#reviews-form .review-name").text(e(this).val())})},_prepAjaxData=function(t){var o={casino:casino_name,name:u,email:f,body:v,parent:n,invision_casino_id:e(".reviews-form").attr("data-invision-casino-id"),casino_id:e(".reviews-form").attr("data-casino-id")};_sendReview(o,t)},_sendReview=function(t,n){B.abort(),B=e.ajax({url:"/casino/review-write",data:t,dataType:"json",timeout:2e4,type:"POST",success:function(t){"ok"==t.status?(_loadData(t,n),o.val(""),a.val(""),i.val("").addClass("expanding"),_onEvents(),e(".reviews-form").attr("data-invision-casino-id",t.body.review_invision_id),e(".form .js-expanding-textfields").slideUp()):"error"==t.status&&(console.error(t.body),_errors_found=e.parseJSON(jqXHR.responseJSON.body),_contact_error.html(_errors_found.join("<br />")).show())},error:function(t){_errors_found=e.parseJSON(t.responseJSON.body),console.error("Could not send message!"),_contact_error.html(_errors_found.join("<br />")).show()}})},_loadData=function(t,n){function o(){var n=e(e("#comment-tpl").html()).filter(".review");return n.attr("data-id",t.body.id),n.find(".review-flag img").attr({src:y,alt:x}),n.find(".review-name").text(u),n.find(".review-date").text(U()),n.find(".review-text p").text(v),n.find(".js-vote a").attr("data-id",t.body.id),m?(n.addClass(u.toLowerCase()+" review-child").attr("data-img-dir",y),n.find(".list-rating").remove()):(n.addClass(u.toLowerCase()+" review-parent"),n.find(".list-rating").addClass(k(p(b))),n.find(".list-rating-score").text(b),n.find(".list-rating-text").text(p(b))),n}e.isEmptyObject(t)?_showEmptyMessage():(g?e(o()).insertAfter(n):c.prepend(o()),_refreshData())},_refreshData=function(){m||(j.text(parseInt(j.text())+1),localStorage.setItem("casino_"+L+"_reviewed",1),localStorage.setItem("casino_"+L+"_score",b)),m&&w.text(parseInt(w.text())+1),e(".review-form").slideUp(),l(),h(),new I(e(".js-vote")),e(".review, .reply").each(function(){new d(e(this))})},_doIfReviewedAlready=function(){var t=e("#reviews-form");e(".review-rating",t).addClass("active"),e("textarea",t).addClass("disabled"),e(".rating-bar").barrating("set",A),e(".rating-current-value span").text(A),e("textarea[name=body]",t).attr("placeholder","You have already reviewed")},_initForms=function(){C.off(),C.on({click:function(e){var t=_prepReview(_);t===!1?e.stopPropagation():_prepAjaxData(_)}})},_onEvents=function(){M?(_doIfReviewedAlready(),_initForms()):(_initForms(),_changeName())},_init=function(){_onEvents()},_init()}function u(t,n){function o(t,n){e("html, body").animate({scrollTop:t.offset().top-n},1e3)}if("undefined"!=typeof t)o(t,n);else{var a=e(".js-scroll");a.on("click",function(t){var n=e(e(this).attr("href"));o(n,0),t.preventDefault()})}}function f(){var t=e(".js-more-reviews"),n=(t.data("reviews"),e("#review-data-holder")),o=e(".reply-data-holder"),a=e(".rating-container").data("casino-name"),i=new XMLHttpRequest;t.on("click",function(){return s(e(this),e(this).data("type")),!1});var s=function(t,s){BUSY_REQUEST||(BUSY_REQUEST=!0,i.abort(),i=e.ajax({url:"/casino/more-reviews/"+k(a)+"/"+t.data("page"),dataType:"HTML",data:{id:t.data("id"),type:s},type:"GET",success:function(e){"review"==s?(n.append(e),t.data("page")>=t.data("total")/5&&t.hide()):"reply"==s&&t.closest(".reply").find(o).append(e),t.data("page")>=t.data("total")/5&&t.hide();var a=t.data("page");t.data("page",++a),r()},error:function(e){"abort"!=e.statusText&&console.log("err")},complete:function(){BUSY_REQUEST=!1}}))},r=function(){l(),h(),new I(e(".js-vote")),e(".review").each(function(){new d(e(this))})}}function p(e){return $string=e>8?"Excellent":e>6&&8>=e?"Very good":e>4&&6>=e?"Good":e>2&&4>=e?"Poor":"Terrible",$string}function h(){var t=e(".textfield");t.focus(function(){e(this).parent().addClass("active").removeClass("not-valid")}),t.blur(function(){""==e(this).val()&&e(this).parent().removeClass("active")})}function v(){e("#reviews").on("click",".js-reply-btn",function(t){return e(this).parent().next().slideToggle(),!1})}function m(t){function n(t){var n=t.closest(i).find(".mobile-popup-body"),r=t.closest(i).find(".mobile-popup-title"),c=(t.closest(i).find(".js-tooltip-content"),t.data("name")),l=t.data("is-free"),d=new XMLHttpRequest;d.abort(),d=e.ajax({url:"/casino/bonus",data:{casino:c,is_free:l},dataType:"json",type:"GET",success:function(t){"ok"==t.status&&($bonus=o(t,c),l?n.prepend($bonus):n.append($bonus),r.text($bonus.find(".tooltip-templates-title").text()),n.find(".js-tooltip").tooltipster(tooltipConfig),n.find(".js-copy-tooltip").tooltipster(copyTooltipConfig),s(e(".bonus-box"),21),g(),e(".overlay, .loader").fadeOut("fast"))}}),a(t)}function a(t){t.closest(i).find(r).fadeIn("fast"),e("html, body").addClass("no-scroll")}var i=e(".list-item"),r=e(".js-mobile-pop"),c=e(".js-mobile-pop-open"),l=e(".js-mobile-pop-close");c.off("click"),690>=t&&(c.on("click",".btn-round",function(t){return e(".overlay, .loader").fadeIn("fast"),n(e(this)),!1}),l.on("click",function(t){return e(this).closest(r).fadeOut("fast").find(".mobile-popup-body").html(""),e("html, body").removeClass("no-scroll"),!1}))}function g(){function t(t){var n=e("<input readonly>");e("body").append(n),n.val(e(t).data("code")).select(),document.execCommand("copy"),n.remove()}var n=e(".js-copy-to-clip");n.on("click",function(e){t(this),e.preventDefault()})}function b(){var t=e("#js-mobile-menu-opener, #js-mobile-menu-close"),n=e(".header-menu");t.on("click",function(o){e("body").toggleClass("menu-opened"),t.toggleClass("active"),e(document).on("click touchstart",function(o){0==e(o.target).closest(n).length&&0==e(o.target).closest(t).length&&(e("body").removeClass("menu-opened"),t.removeClass("active"))}),o.preventDefault()})}function w(){var t=e(".header-search"),n=e(".js-search-opener",t),o=e(".js-mobile-search-opener"),a=e(".js-search-close",t),i=e(".js-mobile-search-close"),s=e(".js-mobile-search-clear"),r=e(".js-search-drop"),c=e(".header-search-input input");n.on("click",function(t){e("body").addClass("search-opened"),c.focus(),_(r),e(document).on("click touchstart",function(t){0==e(t.target).closest(r).length&&0==e(t.target).closest(c).length&&0==e(t.target).closest(o).length&&0==e(t.target).closest(n).length&&y(r)})}),c.on("keydown",function(e){13!=e.keyCode&&_(r)}),a.on("click",function(e){y(r)}),o.on("click",function(t){e("body").addClass("mobile-search-opened"),c.focus()}),i.on("click",function(t){c.val("").focus(),e("body").removeClass("mobile-search-opened")}),s.on("click",function(){c.val("").focus()})}function _(e){setTimeout(function(){e.show()},50)}function y(t){t.hide(),e("body").removeClass("search-opened")}function x(){var t=e(".js-filter > option");e(".js-filter").select2MultiCheckboxes({templateSelection:function(e,t){return"Game software"}}),t.prop("selected",!1)}function C(){var t=e(".rating-container"),n=(t.data("casino-rating"),{showSelectedRating:!1,onSelect:function(n,o,a){if("undefined"!=typeof a){var i=e(a.currentTarget),s="terrible poor good very-good excellent";i.closest(t).find(".rating-current-text").text(o).removeClass(s).addClass(k(o)),i.closest(t).find(".rating-current-value span").text(n),i.closest(t).find(".rating-current").attr("data-rating-current",n),new P({value:n,name:t.data("casino-name")})}}});e(".rating-bar",t).barrating("show",n)}function k(e){return e.replace(/\s/g,"-").toLowerCase()}function j(){e.fn.moreLines=function(t){"use strict";return this.each(function(){var n=e(this),o=(n.find("p"),"b-morelines_"),a="js-morelines_",i="section",s=parseFloat(n.css("line-height")),r=1,c=n.innerHeight(),l=e.extend({linecount:r,baseclass:o,basejsclass:a,classspecific:i,buttontxtmore:"more lines",buttontxtless:"less lines",animationspeed:r},t),d=l.baseclass+l.classspecific+"_ellipsis",u=l.baseclass+l.classspecific+"_button",f=l.baseclass+l.classspecific+"_wrapper",p=l.basejsclass+l.classspecific+"_wrapper",h=e("<div>").addClass(f+" "+p).css({"max-width":n.css("width")}),v=s*l.linecount;if(n.wrap(h),n.parent().not(p)&&c>v){n.addClass(d).css({"min-height":v,"max-height":v,overflow:"hidden"});var m=e("<div>",{"class":u,click:function(){n.toggleClass(d),e(this).toggleClass(u+"_active"),"none"!==n.css("max-height")?n.css({height:v,"max-height":""}).animate({height:c},l.animationspeed,function(){m.html(l.buttontxtless)}):n.animate({height:v},l.animationspeed,function(){m.html(l.buttontxtmore),n.css("max-height",v)})},html:l.buttontxtmore});n.after(m)}}),this},e(".js-condense").moreLines({linecount:3,baseclass:"js-condense",basejsclass:"js-condense",classspecific:"_readmore",buttontxtmore:"Read More",buttontxtless:"Read Less",animationspeed:250})}function T(){function t(e,t,n){var o=e.closest(".swiper-container"),a=t;a.clientX>o.offset().left+o.width()/1.3?n.slideNext(500):a.clientX<o.offset().left+o.width()/6&&n.slidePrev(500)}var n=(new Swiper("#main-carousel",{slidesPerView:6,spaceBetween:5,navigation:{nextEl:".carousel-next",prevEl:".carousel-prev"},breakpoints:{1024:{freeMode:!0,slidesPerView:"auto"}}}),{slidesPerView:"auto",spaceBetween:30,allowTouchMove:!1,slidesOffsetAfter:-220,on:{slideChangeTransitionStart:function(t){e(".links-left").fadeIn("fast")},slideChangeTransitionEnd:function(t){0==this.translate&&e(".links-left").fadeOut("fast")}},breakpoints:{1024:{allowTouchMove:!0},690:{spaceBetween:15,allowTouchMove:!0}}}),o=new Swiper(".links-casinos #links-nav",n);n.slidesOffsetAfter=-330;var a=new Swiper(".links-games #links-nav",n);e(window).width()>1024&&(e(".links-casinos .links-nav a").on("mouseenter",function(n){t(e(this),n,o)}),e(".links-games .links-nav a").on("mouseenter",function(n){t(e(this),n,a)}))}function E(e){var t=/^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;return t.test(e)}function S(e){return""!=e?!0:void 0}function R(e){return""!=e?!0:void 0}function U(){var e=new Date,t=e.getDate(),n=e.getMonth()+1,o=e.getFullYear();return e=t+"."+n+"."+o}BUSY_REQUEST=!1;var L=e(window).width();e(document).ready(function(){i(),O(),b(),new Y(e(".header"));var t=e(".rating-container").data("user-rate");t>0&&(e(".br-widget").children().each(function(){e(this).unbind("mouseenter mouseleave mouseover"),parseInt(e(this).data("rating-value"))<=parseInt(t)&&e(this).addClass("br-active")}),e(".br-widget").unbind("mouseenter mouseleave mouseover"))}),e.fn.scrollEnd=function(t,n){e(this).scroll(function(){var o=e(this);o.data("scrollTimeout")&&clearTimeout(o.data("scrollTimeout")),o.data("scrollTimeout",setTimeout(t,n))})};var M=0;if(e(window).on("scroll",function(){M<e(window).scrollTop()?(e("body").removeClass("site__header_sticky"),M=e(window).scrollTop()):M-e(window).scrollTop()>e(window).height()/3&&(e("body").addClass("site__header_sticky"),M=e(window).scrollTop()),0===e(window).scrollTop()&&e("body").removeClass("site__header_sticky")}),e(window).width()<768&&(e(window).scrollEnd(function(){0!==e(window).scrollTop()&&e("body").addClass("site__header_sticky")},800),/\/reviews\//.test(window.location.href)&&e(".btn-group-mobile .btn-middle").length>0)){var A=!1,B=e(window).height()/2+e(window).scrollTop();e(window).on("scroll",function(){e(window).scrollTop()>B&&A===!1&&(e("body").append('<a rel="nofollow" target="_blank" class="btn-play-now" href="'+e(".btn-group-mobile .btn-middle").attr("href")+'">Play Now</a>'),e("body").addClass("play-now-appended"),A=!0)})}e(window).resize(function(t){L=e(window).width(),m(L)}),tooltipConfig={trigger:"click",maxWidth:279,animation:"grow",debug:!1},copyTooltipConfig={trigger:"click",maxWidth:260,minWidth:260,animation:"grow",contentAsHTML:!0,debug:!1,functionBefore:function(e,t){e.content('\r\n                <div class="centered">\r\n                    <i class="icon icon-icon_available"></i> Code copied to clipboard\r\n                </div>\r\n            ')}},contentTooltipConfig={trigger:"click",minWidth:460,interactive:!0,contentAsHTML:!0,debug:!1,content:e(".loader"),animation:"fade",contentCloning:!1,functionReady:function(){e("body").addClass("shadow"),s(e(".bonus-box"),15),e(".js-tooltip").tooltipster(tooltipConfig)},functionAfter:function(){e("body").removeClass("shadow")},functionBefore:function(t,n){var a=e(n.origin);if(a.data("loaded")!==!0){var i=a.data("name"),r=a.data("is-free"),c=new XMLHttpRequest;c.abort(),c=e.ajax({url:"/casino/bonus",data:{casino:i,is_free:r},dataType:"json",type:"GET",success:function(n){"ok"==n.status&&(t.content(o(n,i)),setTimeout(function(){e(".js-tooltip").tooltipster(tooltipConfig),e(".js-copy-tooltip").tooltipster(copyTooltipConfig),g(),s(e(".bonus-box"),15)},50)),a.data("loaded",!0)}})}}};var O=function(){if(T(),j(),C(),x(),w(),g(),m(L),l(),v(),h(),f(),s(e(".list .bonus-box"),21),s(e(".bonus-item .bonus-box"),33),t(),e(".message .close").on("click",function(t){e(this).parent().fadeOut(),t.preventDefault()}),e(".js-history-back").on("click",function(e){window.history.back(),e.preventDefault()}),e("#filters").length>0&&new q(e("#filters")),e("#reviews").length>0&&(e(".review").each(function(t){new d(e(this))}),e('[href="#reviews"]').on("click",function(){return u(e("#reviews"),100),!1})),e(".js-vote").length>0&&new I(e(".js-vote")),e(".js-run-counter").length>0){var n=e(".js-run-counter").data("name");runPlayCounter(n)}e(".contact-form").length>0&&new c(e(".contact-form")),new r(e(".subscribe")),e(".js-tooltip").tooltipster(tooltipConfig),e(".js-copy-tooltip").tooltipster(copyTooltipConfig),e(".js-tooltip-content").tooltipster(contentTooltipConfig)},q=function(t){var n,o,a=t,i=this,r=a.find("input[type=checkbox]"),c=a.find("input[type=radio]"),l=a.find("select[name=soft]"),d=e(".data-container"),u=e(".data-add-container"),f=d.data("type"),p=d.data("type-value"),h=(e(".aj-content"),e(".empty-filters")),v=a.next(".data-container-holder").find(".holder"),g=e(".list-item").length,b=e(".qty-items").data("load-total"),w=Math.floor(b/g);_currentClick=0,_request=new XMLHttpRequest,"undefined"==typeof f&&(f="game_type"),_url=a.data("url");var _=function(){n=e(".js-more-items"),o=e(".js-reset-items"),r.off(),r.on("click",function(){_ajaxRequestCasinos(y(f,p),"replace")}),c.off(),c.on("click",function(){_ajaxRequestCasinos(y(f,p),"replace")}),e(".js-filter > option").on("click",function(){var t=0;e(".js-filter > option").each(function(n,o){e(this).prop("selected")&&t++})}),l.off(),l.on("change",function(){_ajaxRequestCasinos(y(f,p),"replace")}),n.off(),n.on("click",function(){return _ajaxRequestCasinos(y(f,p,"add"),"add"),!1}),o.off(),o.on("click",function(){return _ajaxRequestCasinos(y(f,p,"reset"),"add"),!1})},y=function(t,n,o){var a={};return e.each(r,function(t,n){e(n).is(":checked")&&(a[e(n).attr("name")]=1),"reset"==o&&(a[e(n).attr("name")]="",e(n).prop("checked",!1))}),e.each(c,function(t,n){e(n).is(":checked")&&(a[e(n).attr("name")]=e(n).attr("value")),"reset"==o&&(a[e(n).attr("name")]=1,0==t&&e(n).prop("checked",!0))}),a[t]=n,"undefined"!=l.val()&&null!=l.val()&&(a.software=l.val().join(),"reset"==o&&(a.software="")),"undefined"==typeof AJAX_CUR_PAGE&&(AJAX_CUR_PAGE=1),("add"!=o||"reset"==o)&&(AJAX_CUR_PAGE=0),void 0!=a.label&&"Mobile"==a.label&&(a.compatibility="mobile",delete a.label),a};_ajaxRequestCasinos=function(t,o){if("add"==o?n.addClass("loading"):e(".overlay, .loader").fadeIn("fast"),!BUSY_REQUEST){BUSY_REQUEST=!0,_request.abort(),_request=e.ajax({url:_url+AJAX_CUR_PAGE,data:t,dataType:"html",type:"GET",success:function(t){function a(){e(".js-tooltip").tooltipster(tooltipConfig),e(".js-copy-tooltip").tooltipster(copyTooltipConfig),e(".js-tooltip-content").tooltipster(contentTooltipConfig),m(L)}var i=e(t).find(".loaded-item"),r=e(t).filter("[data-load-total]").data("load-total");"replace"==o?(d.html(t),u.html(""),0==i.length?(n.hide(),v.hide(),h.show()):(n.show(),v.show(),h.hide()),r<=i.length&&n.hide(),a(),AJAX_CUR_PAGE=1,_currentClick=0):(AJAX_CUR_PAGE++,_currentClick++,setTimeout(function(){u.append(i),n.removeClass("loading"),a(),_currentClick>=w&&n.hide()},1e3)),_construct(),s(e(".data-add-container .bonus-box, .data-container .bonus-box"),21)},error:function(e){"abort"!=e.statusText&&console.log("err")},complete:function(){BUSY_REQUEST=!1,e(".overlay, .loader").fadeOut("fast")}});var a=setTimeout(function(){},300);_hideLoading=function(){clearTimeout(a)}}},_loadData=function(e){},_construct=function(){_(),a[0].obj=i},_construct()},I=function(t){var n=t,o=n.find(".vote-button"),a=new XMLHttpRequest,i=function(){o.off(),o.on("click",function(){var t=e(this).data("id"),n=e(this).data("success"),o=e(this).data("type");return _updateVote(e(this),_getTarget(o),s(o,t,n)),!1})},s=function(e,t,n){var o={id:t};return o};_getTarget=function(e){var t="/casino/review-like";return t},_updateVote=function(t,n,o){BUSY_REQUEST||(BUSY_REQUEST=!0,a.abort(),a=e.ajax({url:n,data:o,dataType:"json",type:"post",success:function(n){var o=e(t).find(".bubble-vote"),a=o.text();o.text(++a)},error:function(e){"abort"!=e.statusText&&console.log("err")},complete:function(){BUSY_REQUEST=!1}}))},i()},P=function(t){var n=t,o=n.name,a=n.value,i=new XMLHttpRequest,s=function(){r(o,a)},r=function(t,n){BUSY_REQUEST||(BUSY_REQUEST=!0,i.abort(),i=e.ajax({url:"/casino/rate",data:{name:t,value:n},dataType:"json",type:"post",success:function(t){"Casino already rated!"==t.body.success&&(e(".icon-icon_available").toggleClass("icon-icon_unavailable"),e(".icon-icon_unavailable").removeClass("icon-icon_available"),e(".thanx").html(t.body.success)),e(".rating-container").next(".action-field").show()},error:function(e){"abort"!=e.statusText&&console.log("err")},complete:function(){BUSY_REQUEST=!1}}))};s()},Y=function(t){var n=t,o=this,a=n.find(".js-trigger-search"),i=n.find("#search-all"),s=n.find("#search"),r=n.find("#search-form"),c=(n.find(".search-results"),r.find("input")),l=r.find(".js-mobile-search-clear"),d=s.find("#search-casinos ul"),u=s.find("#search-lists ul"),f=s.find("#search-pages ul"),p=s.find("#search-empty"),h=(s.data("img-dir"),!0),v=!1,m=5,g=1,b=1,w=1,_=new XMLHttpRequest;window.contentBeforeSearch;var x=function(){a.on("click",function(){return S("/search"),A(),!1}),c.on({focus:function(){S("/search"),A()},keyup:function(e){if(27==e.keyCode)P(),A();else if(13==e.keyCode)""!=c.val()&&(E(),c.blur()),A();else{var t=n.find("#search__popup");t.addClass("load"),S("/search"),A()}""!=c.val()?i.parent().fadeIn():i.parent().fadeOut()}}),l.on("click",function(){return c.val("").focus(),S("/search"),A(),!1}),i.on("click",function(){return""!=c.val()&&E(),!1})},C=function(){e("#site-content").html("").append(contentBeforeSearch),e(".js-search-drop").show(),e("body").removeClass("advanced-search-opened"),setTimeout(function(){O()},1e3)},k=function(){var t=e("#js-search-more-lists"),n=e(".more-lists",t),o=n.data("total-casinos"),a=e("#js-search-more-casinos"),i=e(".more-num",a),s=i.data("total-casinos"),r=e("#js-search-more-pages"),c=e(".more-num",r),l=c.data("total-games"),d=Math.floor(o/m),u=Math.floor(s/m),f=Math.floor(l/m),p=o%m,h=s%m,_=l%m;m>p&&1==d&&n.text(p),m>h&&1==u&&i.text(h),m>_&&1==f&&c.text(_),t.on("click",function(){return T("/search/more-lists/"+b,e(".search-title span").text(),e("#all-lists-container"),"lists"),v=!0,b>=d?t.fadeOut():t.fadeIn(),b>=d-1&&p>0&&n.text(p),b++,!1}),a.on("click",function(){return T("/search/more-casinos/"+g,e(".search-title span").text(),e("#all-casinos-container"),"casinos"),v=!0,g>=u?a.fadeOut():a.fadeIn(),g>=u-1&&h>0&&i.text(h),g++,!1}),r.on("click",function(){return T("/search/more-games/"+w,e(".search-title span").text(),e("#all-games-container"),"games"),v=!0,w>=f?r.fadeOut():r.fadeIn(),w>=f-1&&_>0&&c.text(_),w++,!1})},j=function(){u.empty(),d.empty(),f.empty()},T=function(t,n,o,a){if(!BUSY_REQUEST){BUSY_REQUEST=!0,_.abort(),_=e.ajax({url:t,data:{value:n},dataType:"json",type:"GET",success:function(e){_hideLoading(),L(e,o,a)},error:function(e){"abort"!=e.statusText&&(_hideLoading(),console.log("err"),B())},complete:function(){_hideLoading(),BUSY_REQUEST=!1}});var i=setTimeout(function(){},300);_hideLoading=function(){clearTimeout(i)}}},E=function(){window.scrollTo(0,0);var t=e("#site-content");BUSY_REQUEST||(BUSY_REQUEST=!0,_.abort(),_=e.ajax({url:"/search/advanced",data:{value:c.val()},dataType:"HTML",type:"GET",success:function(n){e("body").addClass("advanced-search-opened"),contentBeforeSearch=e("#site-content .main, #site-content .promo").detach(),t.html(n),I(),k(),t.find("#js-search-back").each(function(){e(this).on({click:function(){C()}})}),e(".js-mobile-search-close").on("click",function(){C()})},error:function(e){"abort"!=e.statusText&&console.log("err")},complete:function(){BUSY_REQUEST=!1}}))},S=function(t,n){if(!BUSY_REQUEST){BUSY_REQUEST=!0,_.abort(),_=e.ajax({url:t,data:{value:c.val(),page:n},dataType:"json",type:"GET",success:function(e){_hideLoading(),M(e)},error:function(e){"abort"!=e.statusText&&(_hideLoading(),console.log("err"),B())},complete:function(){_hideLoading(),BUSY_REQUEST=!1}});var o=setTimeout(function(){},300);_hideLoading=function(){clearTimeout(o)}}},R=function(e){return e.replace(/\s/g,"-").toLowerCase()},U=function(e){var t='<li>\r\n                    <a class="search-results-label" href='+e.link+'"/">\r\n                        '+e.name+"\r\n                    </a>\r\n                </li>";return t},L=function(e,t,n){var o,a=e.body.results;if("lists"===n)for(var i=0;i<a.length;i++){var s=U({link:a[i].url,name:a[i].title});t.append(s)}else for(var r in a){"games"==n?o="play/"+R(a[r]):"casinos"==n&&(o="reviews/"+R(a[r])+"-review");var s=U({link:o,name:a[r]});t.append(s)}},M=function(t){var n=t.body.lists,o=t.body.casinos,a=t.body.games;if(v||j(),e.isEmptyObject(n)&&e.isEmptyObject(o)&&e.isEmptyObject(a))B();else{q(),e.isEmptyObject(n)?u.parent().hide().next().addClass("single"):(u.parent().show().next().removeClass("single"),t.body.total_lists>3&&Math.ceil(t.body.total_lists/3)>b||(b=1)),e.isEmptyObject(o)?d.parent().hide().next().addClass("single"):(d.parent().show().next().removeClass("single"),t.body.total_casinos>3&&Math.ceil(t.body.total_casinos/3)>g||(g=1)),e.isEmptyObject(a)?f.parent().hide().prev().addClass("single"):(f.parent().show().prev().removeClass("single"),t.body.total_pages>3&&Math.ceil(t.body.total_casinos/3)>w||(w=1)),u.html("");for(var i=0;i<n.length;i++){var s=U({link:n[i].url,name:n[i].title});u.append(s)}for(var r in o){var s=U({link:"reviews/"+R(o[r])+"-review",name:o[r]});d.append(s)}for(var c in a){var s=U({link:"play/"+R(a[c]),name:a[c]});f.append(s)}}Y()},A=function(){w=1,g=1},B=function(){u.parent().hide(),d.parent().hide(),f.parent().hide(),p.show(),i.parent().fadeOut()},q=function(){u.parent().show(),d.parent().show(),f.parent().show(),p.hide()},I=function(){y(e(".js-search-drop")),h=!0},P=function(){I()},Y=function(){var t=n.find(".search-results-label");t.each(function(){e(this).html(function(e,t){return t.replace(new RegExp(c.val().toLowerCase(),"ig"),"<b>$&</b>")})})},Q=function(){x(),n[0].obj=o};o.close=function(){P()},Q()}}(jQuery);
"use strict";$(window).load(function(){var t=null!==document.ontouchstart?"click":"touchstart",e=function(t,e,n,o,r){function i(e,n,o){o="undefined"==typeof o?0:"-"+o+"px",t.css({"margin-right":o}).width(Math.round(e)).height(Math.round(n))}this.resizeOnWidth=function(t){i(t,t*e)},this.resizeOnWidthHeight=function(t,a){if(a/t>e){r("height");var l=t*e;if(l+2*o.outerHeight(!0)>a){var s=l+(a-l-2*o.outerHeight(!0));i(s/e,s)}else i(t,l)}else{r("width");var c=a/e,d=n>t?1:2,u=o.outerWidth(!0);if(c+u*d>t)if(n>t){var f=c+(t-c-u*d);i(f,f*e,u)}else{var f=c+(t-c-2*u);i(f,f*e)}else if(n>t){var h=t-c;i(c,a,h)}else i(c,a)}}},n=function(n){function o(){r()}function r(){$(n.events.reload).on("click",function(){a()}),$(n.events.fullscreen).on("click",function(){l()}),$(v).on(t,function(){void 0!==n.triggerOnPlay&&n.triggerOnPlay()}),i(),void 0!==n.triggerOnPlay&&$(n.events.fullscreen).on("click",function(){n.triggerOnPlay()})}function i(){var e=h.contents().find("#overlay").attr("data-game-url");"undefined"!=typeof e&&e!==!1&&(f=!0,$(v).on(t,function(){v.trigger("click"),u===!1&&l()}))}function a(){var t=h.attr("src");h.attr("src",null),f&&!p&&(p=!0,h.load(function(){i()})),h.attr("src",t)}function l(){u?(u=!1,f&&a(),$("body").removeClass("fullscreenGameplay"),s()):(u=!0,$("body").addClass("fullscreenGameplay")),d()}function s(){g.removeClass("top-player-controler").removeClass("left-player-controler").removeClass("right-player-controler")}function c(t){s(),"width"==t?g.addClass(n.desktopWidth>$(window).width()?"left-player-controler":"right-player-controler"):"height"==t&&g.addClass("top-player-controler")}function d(){u?m.resizeOnWidthHeight($(window).width(),$(window).height()):m.resizeOnWidth(h.parent().width())}document.domain=n.domain;var u=!1,f=!1,h=$(n.iframe),g=$(n.extraElements),p=!1,y=h.attr("height")/h.attr("width");h.removeAttr("width").removeAttr("height");var m=new e(h,y,n.desktopWidth,g,c),v=h.contents().find(n.events.play);$(window).on("orientationchange, resize",function(){d()}).resize(),o()},o={domain:"casinoslists.com",iframe:"#gameplay_iframe",extraElements:".player-controls",mobileWidth:690,desktopWidth:1200,events:{reload:"#play-replay",fullscreen:"#play-fullscreen",play:"#game_play_button"},triggerOnPlay:function(){var t=window.location.href.substring(window.location.href.lastIndexOf("/")+1),e=new XMLHttpRequest;BUSY_REQUEST||(BUSY_REQUEST=!0,e.abort(),e=$.ajax({url:"/play-counter",data:{name:t},dataType:"json",type:"post",success:function(t){},error:function(t){"abort"!=t.statusText&&console.log("err")},complete:function(){BUSY_REQUEST=!1}}))}};new n(o)});
