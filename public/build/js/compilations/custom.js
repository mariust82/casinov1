var AJAX_CUR_PAGE=1;!function(L){BUSY_REQUEST=!1;var b=L(window).width();L(document).ready(function(){var t,n;!function(){var e=document.querySelector(".header-menu__list-holder");if(e){var t=function(){var e=0;if(L(window).resize(function(){e=L(document).width()}),e<1e3)return!0;if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent))return!0;return!1}(),n=t?"click":"hover";e.addEventListener(n,function(e){for(var t,n=e.target;n!=this;){if(n.classList.contains("expand-holder")){if((t=document.querySelector(".expand-holder.opened"))==n){t.querySelector(".expand-menu");t.classList.remove("opened")}else t?(t.classList.remove("opened"),setTimeout(function(){n.classList.add("opened")},400)):n.classList.add("opened");break}n=n.parentNode}},!0)}}(),M(),t=L("#js-mobile-menu-opener, #js-mobile-menu-close"),n=L(".header-menu"),t.on("click",function(e){L("body").toggleClass("menu-opened"),t.toggleClass("active"),L(document).on("click touchstart",function(e){0==L(e.target).closest(n).length&&0==L(e.target).closest(t).length&&(L("body").removeClass("menu-opened"),t.removeClass("active"))}),e.preventDefault()}),new o(L(".header"));var e=L(".rating-container").data("user-rate");console.log(L(".box img.not-accepted").length),L(".box img.not-accepted").length?L(".br-widget a").unbind("mouseenter mouseleave mouseover click"):0<e&&(L(".br-widget").children().each(function(){L(this).unbind("mouseenter mouseleave mouseover"),parseInt(L(this).data("rating-value"))<=parseInt(e)&&L(this).addClass("br-active")}),L(".br-widget").unbind("mouseenter mouseleave mouseover"))}),L.fn.scrollEnd=function(t,n){L(this).scroll(function(){var e=L(this);e.data("scrollTimeout")&&clearTimeout(e.data("scrollTimeout")),e.data("scrollTimeout",setTimeout(t,n))})};var e=0;if(L(window).on("scroll",function(){e<L(window).scrollTop()?(L("body").removeClass("site__header_sticky"),e=L(window).scrollTop()):e-L(window).scrollTop()>L(window).height()/3&&(L("body").addClass("site__header_sticky"),e=L(window).scrollTop()),0===L(window).scrollTop()&&L("body").removeClass("site__header_sticky")}),L(window).width()<768&&(L(window).scrollEnd(function(){0!==L(window).scrollTop()&&L("body").addClass("site__header_sticky")},800),/\/reviews\//.test(window.location.href)&&0<L(".btn-group-mobile .btn-middle").length)){var t=!1,n=L(window).height()/2+L(window).scrollTop();L(window).on("scroll",function(){L(window).scrollTop()>n&&!1===t&&(L("body").append('<a rel="nofollow" target="_blank" class="btn-play-now" href="'+L(".btn-group-mobile .btn-middle").attr("href")+'">Play Now</a>'),L("body").addClass("play-now-appended"),t=!0)})}L(window).resize(function(e){_(b=L(window).width())}),tooltipConfig={trigger:"click",maxWidth:279,animation:"grow",debug:!1},copyTooltipConfig={trigger:"click",maxWidth:260,minWidth:260,animation:"grow",contentAsHTML:!0,debug:!1,functionBefore:function(e,t){e.content('                <div class="centered">                    <i class="icon icon-icon_available"></i> Code copied to clipboard                </div>            ')}},contentTooltipConfig={trigger:"click",minWidth:460,interactive:!0,contentAsHTML:!0,debug:!1,content:L(".loader"),animation:"fade",contentCloning:!1,functionReady:function(){L("body").addClass("shadow"),w(L(".bonus-box"),15),L(".js-tooltip").tooltipster(tooltipConfig)},functionAfter:function(){L("body").removeClass("shadow")},functionBefore:function(t,e){var n=L(e.origin);if(!0!==n.data("loaded")){var o=n.data("name"),a=n.data("is-free"),i=new XMLHttpRequest;i.abort(),i=L.ajax({url:"/casino/bonus",data:{casino:o,is_free:a},dataType:"json",type:"GET",success:function(e){"ok"==e.status&&(t.content(c(e,o)),setTimeout(function(){L(".js-tooltip").tooltipster(tooltipConfig),L(".js-copy-tooltip").tooltipster(copyTooltipConfig),v(),w(L(".bonus-box"),15)},50)),n.data("loaded",!0)}})}}};var M=function(){var a,e,t,n,o,i,s,r,c,l,d;if(function(){new Swiper("#main-carousel",{slidesPerView:6,spaceBetween:5,navigation:{nextEl:".carousel-next",prevEl:".carousel-prev"},breakpoints:{1024:{freeMode:!0,slidesPerView:"auto"}}});var e={slidesPerView:"auto",spaceBetween:30,allowTouchMove:!1,slidesOffsetAfter:-220,on:{slideChangeTransitionStart:function(e){L(".links-left").fadeIn("fast")},slideChangeTransitionEnd:function(e){0==this.translate&&L(".links-left").fadeOut("fast")}},breakpoints:{1024:{allowTouchMove:!0},690:{spaceBetween:15,allowTouchMove:!0}}},t=new Swiper(".links-casinos #links-nav",e);e.slidesOffsetAfter=-330;var n=new Swiper(".links-games #links-nav",e);if(1024<L(window).width()){function o(e,t,n){var o=e.closest(".swiper-container"),a=t;a.clientX>o.offset().left+o.width()/1.3?n.slideNext(500):a.clientX<o.offset().left+o.width()/6&&n.slidePrev(500)}L(".links-casinos .links-nav a").on("mouseenter",function(e){o(L(this),e,t)}),L(".links-games .links-nav a").on("mouseenter",function(e){o(L(this),e,n)})}}(),L.fn.moreLines=function(u){"use strict";return this.each(function(){var e=L(this),t=(e.find("p"),parseFloat(e.css("line-height"))),n=e.innerHeight(),o=L.extend({linecount:1,baseclass:"b-morelines_",basejsclass:"js-morelines_",classspecific:"section",buttontxtmore:"more lines",buttontxtless:"less lines",animationspeed:1},u),a=o.baseclass+o.classspecific+"_ellipsis",i=o.baseclass+o.classspecific+"_button",s=o.baseclass+o.classspecific+"_wrapper",r=o.basejsclass+o.classspecific+"_wrapper",c=L("<div>").addClass(s+" "+r).css({"max-width":e.css("width")}),l=t*o.linecount;if(e.wrap(c),e.parent().not(r)&&l<n){e.addClass(a).css({"min-height":l,"max-height":l,overflow:"hidden"});var d=L("<div>",{class:i,click:function(){e.toggleClass(a),L(this).toggleClass(i+"_active"),"none"!==e.css("max-height")?e.css({height:l,"max-height":""}).animate({height:n},o.animationspeed,function(){d.html(o.buttontxtless)}):e.animate({height:l},o.animationspeed,function(){d.html(o.buttontxtmore),e.css("max-height",l)})},html:o.buttontxtmore});e.after(d)}}),this},L(".js-condense").moreLines({linecount:3,baseclass:"js-condense",basejsclass:"js-condense",classspecific:"_readmore",buttontxtmore:"Read More",buttontxtless:"Read Less",animationspeed:250}),(a=L(".rating-container")).data("casino-rating"),e={showSelectedRating:!1,onSelect:function(e,t,n){if(void 0!==n){var o=L(n.currentTarget);o.closest(a).find(".rating-current-text").text(t).removeClass("terrible poor good very-good excellent").addClass(U(t)),o.closest(a).find(".rating-current-value span").text(e),o.closest(a).find(".rating-current").attr("data-rating-current",e),new m({value:e,name:a.data("casino-name")})}}},L(".rating-bar",a).barrating("show",e),t=L(".js-filter > option"),L(".js-filter").select2MultiCheckboxes({templateSelection:function(e,t){return"Game software"}}),t.prop("selected",!1),n=L(".header-search"),o=L(".js-search-opener",n),i=L(".js-mobile-search-opener"),s=L(".js-search-close",n),r=L(".js-mobile-search-close"),c=L(".js-mobile-search-clear"),l=L(".js-search-drop"),d=L(".header-search-input input"),o.on("click",function(e){L("body").addClass("search-opened"),d.focus(),g(l),L(document).on("click touchstart",function(e){0==L(e.target).closest(l).length&&0==L(e.target).closest(d).length&&0==L(e.target).closest(i).length&&0==L(e.target).closest(o).length&&(d.val(""),B(l))})}),d.on("keydown",function(e){13!=e.keyCode&&g(l)}),s.on("click",function(e){B(l)}),i.on("click",function(e){L("body").addClass("mobile-search-opened"),d.focus()}),r.on("click",function(e){d.val("").focus(),L("body").removeClass("mobile-search-opened")}),c.on("click",function(){d.val("").focus()}),v(),_(b),j(),L("#reviews").on("click",".js-reply-btn",function(e){return L(this).parent().next().slideToggle(),!1}),R(),function(){var e=L(".js-more-reviews"),a=(e.data("reviews"),L("#review-data-holder")),i=L(".reply-data-holder"),t=L(".rating-container").data("casino-name"),s=new XMLHttpRequest;e.on("click",function(){return n(L(this),L(this).data("type")),!1});var n=function(n,o){BUSY_REQUEST||(BUSY_REQUEST=!0,s.abort(),s=L.ajax({url:"/casino/more-reviews/"+U(t)+"/"+n.data("page"),dataType:"HTML",data:{id:n.data("id"),type:o},type:"GET",success:function(e){"review"==o?(a.append(e),n.data("page")>=n.data("total")/5&&n.hide()):"reply"==o&&n.closest(".reply").find(i).append(e),n.data("page")>=n.data("total")/5&&n.hide();var t=n.data("page");n.data("page",++t),r()},error:function(e){"abort"!=e.statusText&&console.log("err")},complete:function(){BUSY_REQUEST=!1}}))},r=function(){j(),R(),new T(L(".js-vote")),L(".review").each(function(){new E(L(this))})}}(),w(L(".list .bonus-box"),21),w(L(".bonus-item .bonus-box"),33),function(){if(10<=function(){var e=-1;if("Microsoft Internet Explorer"==navigator.appName){var t=navigator.userAgent,n=new RegExp("MSIE ([0-9]{1,}[.0-9]{0,})");null!=n.exec(t)&&(e=parseFloat(RegExp.$1))}else if("Netscape"==navigator.appName){var t=navigator.userAgent,n=new RegExp("Trident/.*rv:([0-9]{1,}[.0-9]{0,})");null!=n.exec(t)&&(e=parseFloat(RegExp.$1))}return e}()){L(".not-accepted").each(function(){var e=L(this);e.css({position:"absolute"}).wrap("<div class='img_wrapper' style='display: inline-block'>").clone().addClass("img_grayscale").css({position:"absolute","z-index":"5",opacity:"0"}).insertBefore(e).queue(function(){var e=L(this);e.parent().css({width:this.width,height:this.height}),e.dequeue()}),this.src=function(e){var t=document.createElement("canvas"),n=t.getContext("2d"),o=new Image;o.src=e,t.width=o.width,t.height=o.height,n.drawImage(o,0,0);for(var a=n.getImageData(0,0,t.width,t.height),i=0;i<a.height;i++)for(var s=0;s<a.width;s++){var r=4*i*a.width+4*s,c=(a.data[r]+a.data[r+1]+a.data[r+2])/3;a.data[r]=c,a.data[r+1]=c,a.data[r+2]=c}return n.putImageData(a,0,0,0,0,a.width,a.height),t.toDataURL()}(this.src)})}}(),L(".message .close").on("click",function(e){L(this).parent().fadeOut(),e.preventDefault()}),L(".js-history-back").on("click",function(e){window.history.back(),e.preventDefault()}),0<L("#filters").length&&new h(L("#filters")),0<L("#reviews").length&&(L(".review").each(function(e){new E(L(this))}),L('[href="#reviews"]').on("click",function(){return function(e,t){if(void 0!==e)o(e,t);else{var n=L(".js-scroll");n.on("click",function(e){var t=L(L(this).attr("href"));o(t,0),e.preventDefault()})}function o(e,t){L("html, body").animate({scrollTop:e.offset().top-t},1e3)}}(L("#reviews"),100),!1})),0<L(".js-vote").length&&new T(L(".js-vote")),0<L(".js-run-counter").length){var u=L(".js-run-counter").data("name");runPlayCounter(u)}0<L(".contact-form").length&&new p(L(".contact-form")),new f(L(".subscribe")),L(".js-tooltip").tooltipster(tooltipConfig),L(".js-copy-tooltip").tooltipster(copyTooltipConfig),L(".js-tooltip-content").tooltipster(contentTooltipConfig)};function c(e,t){var n=t,o=e.body.bonus.amount,a=e.body.bonus.code,i=e.body.bonus.games_allowed,s=e.body.bonus.min_deposit,r=e.body.bonus.type,c=e.body.bonus.wagering,l="bonus-free",d="icon-icon_bonuses",u="",f="";"First Deposit Bonus"==r&&(l="bonus-first",d="icon-free-bonus-icon"),"Free Play"==r&&(r="Free Bonus"),"No code required"!=a&&(u="js-copy-to-clip js-copy-tooltip"),""==s&&(s="Free",f="success");var p=L(L("#bonus-box-tpl").html()).filter(".tooltip-content");return p.addClass(l),p.find(".tooltip-templates-title").text(n+" "+r),p.find(".tooltip-templates-button a").attr("href","/visit/"+U(n)),p.find(".bonus-box-heading span").text(o+" "+r),p.find(".bonus-box-btn.dashed").addClass(u).attr("data-code",a).text(a),p.find(".bonus-box-wagering").text(c),p.find(".list-item-trun").text(i),p.find(".bubble").attr("title",i),p.find(".bonus-box-dep").addClass(f).text(s),p.find(".bonus-box-circle i").addClass(d),p}function w(e,a){L(e).each(function(e,t){var n=L(this).find(".list-item-trun"),o=L(this).find(".bubble");n.text().length>=a&&o.css("visibility","visible")})}function f(e){var t,n=e,o=n.find(".news-email"),a=n.find(".news-btn"),i=L("#news-success"),s=L("#news-note"),r="not-valid",c=new XMLHttpRequest;_prepMessage=function(){return t=o.val(),ok=!0,""!==t&&A(t)?o.parent().removeClass(r):(o.parent().addClass(r),ok=!1),ok?s.hide():s.show(),ok},_sendNews=function(e){c.abort(),c=L.ajax({url:"/newsletter/subscribe",data:{email:e},dataType:"json",timeout:2e4,type:"POST",success:function(e){if("ok"==e.status)i.show(),s.hide(),a.prop("disabled",!0),o.val(""),_onEvents();else if("error"==e.status){var t=JSON.parse(e.body);L(".action-added").remove(),L.each(t,function(e,t){var n='<div class="action-field action-added not-valid ">'+t+"</div>";L(".review-submit-holder .msg-holder").append(n)})}},error:function(e){console.error("Could not send message!")}})},_onEvents=function(){a.on({click:function(e){!1===_prepMessage()?e.stopPropagation():_sendNews(t)}})},_init=function(){_onEvents()},_init()}function p(e){var t,n,o,a=L(".contact-name"),i=L(".contact-email"),s=L(".contact-message"),r=L(".contact-btn"),c=L("#contact-us-success"),l=L("#contact-us-note"),d=L("#server-error-note"),u="not-valid",f=new XMLHttpRequest;_prepContact=function(){return t=a.val(),n=i.val(),o=s.val(),ok=!0,""!==t&&O(t)?a.parent().removeClass(u):(a.parent().addClass(u),ok=!1),""!==n&&A(n)?i.parent().removeClass(u):(i.parent().addClass(u),ok=!1),""!==o&&q(o)?s.parent().removeClass(u):(s.parent().addClass(u),ok=!1),ok?l.hide():l.show(),ok},_sendMessage=function(e,t,n){f.abort(),f=L.ajax({url:"/contact/send",data:{name:e,email:t,message:n},dataType:"json",timeout:2e4,type:"POST",success:function(e){if("ok"==e.status)c.show(),l.hide(),d.hide(),r.prop("disabled",!0),a.val(""),i.val(""),s.val(""),_onEvents();else if("error"==e.status){JSON.parse(e.body);d.show()}},error:function(e){console.error("Could not send message!")}})},_onEvents=function(){r.on({click:function(e){!1===_prepContact()?e.stopPropagation():_sendMessage(t,n,o)}})},_init=function(){_onEvents()},_init()}var h=function(e){var i,t,n=e,o=this,a=n.find("input[type=checkbox]"),s=n.find("input[type=radio]"),r=n.find("select[name=soft]"),c=L(".data-container"),l=L(".data-add-container"),d=c.data("type"),u=c.data("type-value"),f=(L(".aj-content"),L(".empty-filters")),p=n.next(".data-container-holder").find(".holder"),h=L(".list-item").length,m=L(".qty-items").data("load-total"),v=Math.floor(m/h);_currentClick=0,_request=new XMLHttpRequest,void 0===d&&(d="game_type"),_url=n.data("url");var g=function(e,t,n){var o={};return L.each(a,function(e,t){L(t).is(":checked")&&(o[L(t).attr("name")]=1),"reset"==n&&(o[L(t).attr("name")]="",L(t).prop("checked",!1))}),L.each(s,function(e,t){L(t).is(":checked")&&(o[L(t).attr("name")]=L(t).attr("value")),"reset"==n&&(o[L(t).attr("name")]=1,0==e&&L(t).prop("checked",!0))}),o[e]=t,"undefined"!=r.val()&&null!=r.val()&&(o.software=r.val().join(),"reset"==n&&(o.software="")),void 0===AJAX_CUR_PAGE&&(AJAX_CUR_PAGE=1),"add"==n&&"reset"!=n||(AJAX_CUR_PAGE=0),null!=o.label&&"Mobile"==o.label&&(o.compatibility="mobile",delete o.label),o};_ajaxRequestCasinos=function(e,a){if("add"==a?i.addClass("loading"):L(".overlay, .loader").fadeIn("fast"),!BUSY_REQUEST){BUSY_REQUEST=!0,_request.abort(),_request=L.ajax({url:_url+AJAX_CUR_PAGE,data:e,dataType:"html",type:"GET",success:function(e){var t=L(e).find(".loaded-item"),n=L(e).filter("[data-load-total]").data("load-total");function o(){L(".js-tooltip").tooltipster(tooltipConfig),L(".js-copy-tooltip").tooltipster(copyTooltipConfig),L(".js-tooltip-content").tooltipster(contentTooltipConfig),_(b)}"replace"==a?(c.html(e),l.html(""),0==t.length?(i.hide(),p.hide(),f.show()):(i.show(),p.show(),f.hide()),n<=t.length&&i.hide(),o(),AJAX_CUR_PAGE=1,_currentClick=0):(AJAX_CUR_PAGE++,_currentClick++,setTimeout(function(){l.append(t),i.removeClass("loading"),o(),_currentClick>=v&&i.hide()},1e3)),_construct(),w(L(".data-add-container .bonus-box, .data-container .bonus-box"),21)},error:function(e){"abort"!=e.statusText&&console.log("err")},complete:function(){BUSY_REQUEST=!1,L(".overlay, .loader").fadeOut("fast")}});var t=setTimeout(function(){},300);_hideLoading=function(){clearTimeout(t)}}},_loadData=function(e){},_construct=function(){i=L(".js-more-items"),t=L(".js-reset-items"),a.off(),a.on("click",function(){_ajaxRequestCasinos(g(d,u),"replace")}),s.off(),s.on("click",function(){_ajaxRequestCasinos(g(d,u),"replace")}),L(".js-filter > option").on("click",function(){L(".js-filter > option").each(function(e,t){L(this).prop("selected")})}),r.off(),r.on("change",function(){_ajaxRequestCasinos(g(d,u),"replace")}),i.off(),i.on("click",function(){return _ajaxRequestCasinos(g(d,u,"add"),"add"),!1}),t.off(),t.on("click",function(){return _ajaxRequestCasinos(g(d,u,"reset"),"add"),!1}),n[0].obj=o},_construct()};function j(){var e=L(".expanding"),t=L(".js-expanding-textfields");e.on("focus",function(){L(this).removeClass("expanding"),L(this).closest(".form").find(t).slideDown()})}var T=function(e){var t=e.find(".vote-button"),n=new XMLHttpRequest,o=function(e,t,n){return{id:t}};_getTarget=function(e){return"/casino/review-like"},_updateVote=function(o,e,t){BUSY_REQUEST||(BUSY_REQUEST=!0,n.abort(),n=L.ajax({url:e,data:t,dataType:"json",type:"post",success:function(e){var t=L(o).find(".bubble-vote"),n=t.text();t.text(++n)},error:function(e){"abort"!=e.statusText&&console.log("err")},complete:function(){BUSY_REQUEST=!1}}))},t.off(),t.on("click",function(){var e=L(this).data("id"),t=L(this).data("success"),n=L(this).data("type");return _updateVote(L(this),_getTarget(n),o(n,e,t)),!1})};function E(e){var n,o,a,i,s,r,c,l,d,u,f,p,h,m,t=this.obj=e,v=L("#reviews-form").data("img-dir"),g=L("#reviews-form").data("country"),b=t.find("input[name=submit]"),w=L(".reviews-qty"),_="not-valid",y=L(".reviews-form").data("casino-id"),x=localStorage.getItem("casino_"+y+"_reviewed"),C=localStorage.getItem("casino_"+y+"_score"),k=new XMLHttpRequest;_prepReview=function(e){var t=e;return o=t.find("input[name=name]"),a=t.find("input[name=email]"),i=t.find("textarea[name=body]"),s=t.find(".field-error-required"),r=t.find(".field-error-rate"),_contact_error=t.find(".field-error"),l=o.val(),d=a.val(),u=i.val(),casino_name=L(".rating-container").data("casino-name"),h=L(".rating-current-value span").text(),n=0,ok=!0,null!=t.data("id")?(n=t.data("id"),f=!0,0<t.next().find(".reply-data-holder").length?(c=t.next().find(".reply-data-holder"),p=!1):(p=!0,n=t.closest(".reply").prev().data("id"),_setReviewerName(t),c=t.closest(".reply-data-holder")),m=t.find(".js-reply-btn span")):(f=!1,c=L("#review-data-holder")),""!==l&&O(l)?o.parent().removeClass(_):(o.parent().addClass(_),ok=!1),""!==d&&A(d)?a.parent().removeClass(_):(a.parent().addClass(_),ok=!1),""!==u&&q(u)?i.parent().removeClass(_):(i.parent().addClass(_),ok=!1),ok?(_contact_error.hide(),s.hide()):s.show(),f||("0"===h?(r.show(),t.find(L(".rating-container")).addClass(_),ok=!1):(r.hide(),t.find(L(".rating-container")).removeClass(_))),ok},_setReviewerName=function(e){var t=e.find(".review-name").text();u="<strong>@"+t+"</strong> "+i.val()},_changeName=function(){L("#reviews-form input[name=name]").on("keyup",function(){L("#reviews-form .review-name").text(L(this).val())})},_prepAjaxData=function(e){var t={casino:casino_name,name:l,email:d,body:u,parent:n,invision_casino_id:L(".reviews-form").attr("data-invision-casino-id"),casino_id:L(".reviews-form").attr("data-casino-id")};_sendReview(t,e)},_sendReview=function(e,t){k.abort(),k=L.ajax({url:"/casino/review-write",data:e,dataType:"json",timeout:2e4,type:"POST",success:function(e){"ok"==e.status?(_loadData(e,t),o.val(""),a.val(""),i.val("").addClass("expanding"),_onEvents(),L(".reviews-form").attr("data-invision-casino-id",e.body.review_invision_id),L(".form .js-expanding-textfields").slideUp()):"error"==e.status&&(console.error(e.body),_errors_found=L.parseJSON(jqXHR.responseJSON.body),_contact_error.html(_errors_found.join("<br />")).show())},error:function(e){_errors_found=L.parseJSON(e.responseJSON.body),console.error("Could not send message!"),_contact_error.html(_errors_found.join("<br />")).show()}})},_loadData=function(i,e){if(L.isEmptyObject(i))_showEmptyMessage();else{function t(){var e,t,n,o,a=L(L("#comment-tpl").html()).filter(".review");return a.attr("data-id",i.body.id),a.find(".review-flag img").attr({src:v,alt:g}),a.find(".review-name").text(l),a.find(".review-date").text((e=new Date,t=e.getDate(),n=e.getMonth()+1,o=e.getFullYear(),e=t+"."+n+"."+o)),a.find(".review-text p").text(u),a.find(".js-vote a").attr("data-id",i.body.id),f?(a.addClass(l.toLowerCase()+" review-child").attr("data-img-dir",v),a.find(".list-rating").remove()):(a.addClass(l.toLowerCase()+" review-parent"),a.find(".list-rating").addClass(U(S(h))),a.find(".list-rating-score").text(h),a.find(".list-rating-text").text(S(h))),a}p?L(t()).insertAfter(e):c.prepend(t()),_refreshData()}},_refreshData=function(){f||(w.text(parseInt(w.text())+1),localStorage.setItem("casino_"+y+"_reviewed",1),localStorage.setItem("casino_"+y+"_score",h)),f&&m.text(parseInt(m.text())+1),L(".review-form").slideUp(),j(),R(),new T(L(".js-vote")),L(".review, .reply").each(function(){new E(L(this))})},_doIfReviewedAlready=function(){var e=L("#reviews-form");L(".review-rating",e).addClass("active"),L("textarea",e).addClass("disabled"),L(".rating-bar").barrating("set",C),L(".rating-current-value span").text(C),L("textarea[name=body]",e).attr("placeholder","You have already reviewed")},_initForms=function(){b.off(),b.on({click:function(e){!1===_prepReview(t)?e.stopPropagation():_prepAjaxData(t)}})},_onEvents=function(){x?(_doIfReviewedAlready(),_initForms()):(_initForms(),_changeName())},_init=function(){_onEvents()},_init()}function S(e){return $string=8<e?"Excellent":6<e&&e<=8?"Very good":4<e&&e<=6?"Good":2<e&&e<=4?"Poor":"Terrible",$string}var m=function(e){var t=e,n=t.name,o=t.value,a=new XMLHttpRequest;(function(e,t){BUSY_REQUEST||(BUSY_REQUEST=!0,a.abort(),a=L.ajax({url:"/casino/rate",data:{name:e,value:t},dataType:"json",type:"post",success:function(e){"Casino already rated!"==e.body.success&&(L(".icon-icon_available").toggleClass("icon-icon_unavailable"),L(".icon-icon_unavailable").removeClass("icon-icon_available"),L(".thanx").html(e.body.success)),L(".rating-container").next(".action-field").show()},error:function(e){"abort"!=e.statusText&&console.log("err")},complete:function(){BUSY_REQUEST=!1}}))})(n,o)},o=function(e){var t=e,n=this,o=t.find(".js-trigger-search"),a=t.find("#search-all"),i=t.find("#search"),s=t.find("#search-form"),c=(t.find(".search-results"),s.find("input")),r=s.find(".js-mobile-search-clear"),l=i.find("#search-casinos ul"),d=i.find("#search-lists ul"),u=i.find("#search-pages ul"),f=i.find("#search-empty"),g=(i.data("img-dir"),!1),b=1,w=1,_=1,p=new XMLHttpRequest;window.contentBeforeSearch;var y=function(){L("#site-content").html("").append(contentBeforeSearch),L(".js-search-drop").show(),L("body").removeClass("advanced-search-opened"),c.blur(),setTimeout(function(){M()},1e3)},x=function(e,t,n,o){if(!BUSY_REQUEST){BUSY_REQUEST=!0,p.abort(),p=L.ajax({url:e,data:{value:t},dataType:"json",type:"GET",success:function(e){_hideLoading(),k(e,n,o)},error:function(e){"abort"!=e.statusText&&(_hideLoading(),console.log("err"),E())},complete:function(){_hideLoading(),BUSY_REQUEST=!1}});var a=setTimeout(function(){},300);_hideLoading=function(){clearTimeout(a)}}},h=function(){window.scrollTo(0,0);var v=L("#site-content");BUSY_REQUEST||(BUSY_REQUEST=!0,p.abort(),p=L.ajax({url:"/search/advanced",data:{value:c.val()},dataType:"HTML",type:"GET",success:function(e){var t,n,o,a,i,s,r,c,l,d,u,f,p,h,m;L("body").addClass("advanced-search-opened"),g||(contentBeforeSearch=L("#site-content .main, #site-content .promo").detach()),g=!0,v.html(e),R(),t=L("#js-search-more-lists"),n=L(".more-lists",t),o=n.data("total-casinos"),a=L("#js-search-more-casinos"),i=L(".more-num",a),s=i.data("total-casinos"),r=L("#js-search-more-pages"),c=L(".more-num",r),l=c.data("total-games"),d=Math.floor(o/5),u=Math.floor(s/5),f=Math.floor(l/5),h=s%5,m=l%5,(p=o%5)<5&&1==d&&n.text(p),h<5&&1==u&&i.text(h),m<5&&1==f&&c.text(m),t.on("click",function(){return x("/search/more-lists/"+w,L(".search-title span").text(),L("#all-lists-container"),"lists"),d<=w?t.fadeOut():t.fadeIn(),d-1<=w&&0<p&&n.text(p),w++,!1}),a.on("click",function(){return x("/search/more-casinos/"+b,L(".search-title span").text(),L("#all-casinos-container"),"casinos"),u<=b?a.fadeOut():a.fadeIn(),u-1<=b&&0<h&&i.text(h),b++,!1}),r.on("click",function(){return x("/search/more-games/"+_,L(".search-title span").text(),L("#all-games-container"),"games"),f<=_?r.fadeOut():r.fadeIn(),f-1<=_&&0<m&&c.text(m),_++,!1}),v.find("#js-search-back").each(function(){L(this).on({click:function(){y()}})}),L(".js-mobile-search-close").on("click",function(){y()})},error:function(e){"abort"!=e.statusText&&console.log("err")},complete:function(){BUSY_REQUEST=!1}}))},m=function(e,t){if(!BUSY_REQUEST){BUSY_REQUEST=!0,p.abort(),p=L.ajax({url:e,data:{value:c.val(),page:t},dataType:"json",type:"GET",success:function(e){_hideLoading(),j(e)},error:function(e){"abort"!=e.statusText&&(_hideLoading(),console.log("err"),E())},complete:function(){_hideLoading(),BUSY_REQUEST=!1}});var n=setTimeout(function(){},300);_hideLoading=function(){clearTimeout(n)}}},v=function(e){return e.replace(/\s/g,"-").toLowerCase()},C=function(e){return'<li>                    <a class="search-results-label" href="/'+e.link.replace("/games/","")+'">                        '+e.name+"                    </a>                </li>"},k=function(e,t,n){var o,a=e.body.results;if("lists"===n)for(var i=0;i<a.length;i++){var s=C({link:a[i].url,name:a[i].title});t.append(s)}else for(var r in a){"games"==n?o="play/"+v(a[r]):"casinos"==n&&(o="reviews/"+v(a[r])+"-review");s=C({link:o,name:a[r]});t.append(s)}},j=function(e){var t=e.body.lists,n=e.body.casinos,o=e.body.games;if(d.empty(),l.empty(),u.empty(),L.isEmptyObject(t)&&L.isEmptyObject(n)&&L.isEmptyObject(o))E();else{S(),L.isEmptyObject(t)?d.parent().hide().next().addClass("single"):(d.parent().show().next().removeClass("single"),3<e.body.total_lists&&Math.ceil(e.body.total_lists/3)>w||(w=1)),L.isEmptyObject(n)?l.parent().hide().next().addClass("single"):(l.parent().show().next().removeClass("single"),3<e.body.total_casinos&&Math.ceil(e.body.total_casinos/3)>b||(b=1)),L.isEmptyObject(o)?u.parent().hide().prev().addClass("single"):(u.parent().show().prev().removeClass("single"),3<e.body.total_pages&&Math.ceil(e.body.total_casinos/3)>_||(_=1)),d.html("");for(var a=0;a<t.length;a++){var i=C({link:t[a].url,name:t[a].title});d.append(i)}for(var s in n){i=C({link:"reviews/"+v(n[s])+"-review",name:n[s]});l.append(i)}for(var r in o){i=C({link:"play/"+v(o[r]),name:o[r]});u.append(i)}""!=c.val()&&A()}},T=function(){b=_=1},E=function(){d.parent().hide(),l.parent().hide(),u.parent().hide(),f.show(),a.parent().fadeOut()},S=function(){d.parent().show(),l.parent().show(),u.parent().show(),f.hide()},R=function(){B(L(".js-search-drop")),!0},U=function(){R()},A=function(){t.find(".search-results-label").each(function(){L(this).html(function(e,t){return t.replace(new RegExp(c.val().toLowerCase(),"ig"),"<b>$&</b>")})})};n.close=function(){U()},o.on("click",function(){return m("/search"),T(),!1}),c.on({focus:function(){m("/search"),T()},keyup:function(e){27==e.keyCode?U():13==e.keyCode?""!=c.val()&&(h(),c.blur()):(t.find("#search__popup").addClass("load"),m("/search")),T(),""!=c.val()?a.parent().fadeIn():a.parent().fadeOut()}}),r.on("click",function(){return c.val("").focus(),m("/search"),T(),!1}),a.on("click",function(){return""!=c.val()&&h(),!1}),t[0].obj=n};function R(){var e=L(".textfield");e.focus(function(){L(this).parent().addClass("active").removeClass("not-valid")}),e.blur(function(){""==L(this).val()&&L(this).parent().removeClass("active")})}function _(e){var s=L(".list-item"),r=L(".js-mobile-pop"),t=L(".btn-round"),n=L(".js-mobile-pop-close");if(e<=690){function o(e){var t=e.closest(s).find(".mobile-popup-body"),n=e.closest(s).find(".mobile-popup-title"),o=(e.closest(s).find(".js-tooltip-content"),e.data("name")),a=e.data("is-free"),i=new XMLHttpRequest;i.abort(),i=L.ajax({url:"/casino/bonus",data:{casino:o,is_free:a},dataType:"json",type:"GET",success:function(e){"ok"==e.status&&($bonus=c(e,o),a?t.prepend($bonus):t.append($bonus),n.text($bonus.find(".tooltip-templates-title").text()),t.find(".js-tooltip").tooltipster(tooltipConfig),t.find(".js-copy-tooltip").tooltipster(copyTooltipConfig),w(L(".bonus-box"),21),v(),L(".overlay, .loader").fadeOut("fast"))}}),e.closest(s).find(r).fadeIn("fast"),L("html, body").addClass("no-scroll")}t.off("click"),t.on("click",function(e){return L(".overlay, .loader").fadeIn("fast"),o(L(this)),!1}),n.on("click",function(e){return L(this).closest(r).fadeOut("fast").find(".mobile-popup-body").html(""),L("html, body").removeClass("no-scroll"),!1})}}function v(){window.Clipboard=function(d,u,e){var f;function p(){return e.userAgent.match(/ipad|iphone/i)}return{copy:function(e,t){var n,o,a,i,s,r,c,l=(n=e,(o=document.createElement("DIV")).innerHTML=n,o.textContent||o.innerText||"");a=l,i=t,f=u.createElement("textArea"),p()&&f.setAttribute("readonly","readonly"),f.value=a,i.parent().append(f),p()?((s=u.createRange()).selectNodeContents(f),(r=d.getSelection()).removeAllRanges(),r.addRange(s),f.setSelectionRange(0,999999)):f.select(),c=t,u.execCommand("copy"),c.parent().find(f).remove()}}}(window,document,navigator),L(".js-copy-to-clip").on("click touch",function(e){Clipboard.copy(L(this).data("code"),L(this)),e.preventDefault()})}function g(e){setTimeout(function(){e.slideDown("fast")},300)}function B(e){e.slideUp("fast"),setTimeout(function(){L("body").removeClass("search-opened")},300)}function U(e){return e.replace(/\s/g,"-").toLowerCase()}function A(e){return/^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i.test(e)}function O(e){if(""!=e)return!0}function q(e){if(""!=e)return!0}}(jQuery);