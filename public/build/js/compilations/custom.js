var AJAX_CUR_PAGE=1;!function(M){BUSY_REQUEST=!1;var b=M(window).width();M(document).ready(function(){var t,n;!function(){var e=document.querySelector(".header-menu__list-holder");if(e){var t=function(){var e=0;if(M(window).resize(function(){e=M(document).width()}),e<1e3)return!0;if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent))return!0;return!1}(),n=t?"click":"hover";e.addEventListener(n,function(e){for(var t,n=e.target;n!=this;){if(n.classList.contains("expand-holder")){if((t=document.querySelector(".expand-holder.opened"))==n){t.querySelector(".expand-menu");t.classList.remove("opened")}else t?(t.classList.remove("opened"),setTimeout(function(){n.classList.add("opened")},400)):n.classList.add("opened");break}n=n.parentNode}},!0)}}(),q(),t=M("#js-mobile-menu-opener, #js-mobile-menu-close"),n=M(".header-menu"),t.on("click",function(e){M("body").toggleClass("menu-opened"),t.toggleClass("active"),M(document).on("click touchstart",function(e){0==M(e.target).closest(n).length&&0==M(e.target).closest(t).length&&(M("body").removeClass("menu-opened"),t.removeClass("active"))}),e.preventDefault()}),M(".header-menu__list-holder .expand-holder").on("mouseout",function(e){M(".expand-holder").removeClass("opened")}),new o(M(".header"));var e=M(".rating-container").data("user-rate");M(".box img.not-accepted").length?M(".br-widget a").unbind("mouseenter mouseleave mouseover click"):0<e&&(M(".br-widget").children().each(function(){M(this).unbind("mouseenter mouseleave mouseover click"),parseInt(M(this).data("rating-value"))<=parseInt(e)&&M(this).addClass("br-active")}),M(".br-widget").unbind("mouseenter mouseleave mouseover click")),setTimeout(function(){M(".tms_iframe").map(function(){var e=document.createElement("iframe");M.each(this.attributes,function(){e.setAttribute(this.name.replace("data-",""),this.value)}),this.after(e)}),function(){"use strict";var e,t=document.getElementsByClassName("show-text-visible");if(null!==t)for(e=0;e<t.length;e++){var n,o=t[e].getElementsByTagName("iframe");if(0<o.length)for(n=0;n<o.length;n++)a(o[n])}function a(e){var t=e.getAttribute("width"),n=e.getAttribute("height")/t;e.style.width="100%",window.addEventListener("resize",function(){e.style.height=e.clientWidth*n+"px"}),window.dispatchEvent(new Event("resize"))}}()},300)}),M.fn.scrollEnd=function(t,n){M(this).scroll(function(){var e=M(this);e.data("scrollTimeout")&&clearTimeout(e.data("scrollTimeout")),e.data("scrollTimeout",setTimeout(t,n))})};var e=0;if(M(window).on("scroll",function(){e<M(window).scrollTop()?(M("body").removeClass("site__header_sticky"),e=M(window).scrollTop()):e-M(window).scrollTop()>M(window).height()/3&&(M("body").addClass("site__header_sticky"),e=M(window).scrollTop()),0===M(window).scrollTop()&&M("body").removeClass("site__header_sticky")}),M(window).width()<768&&(M(window).scrollEnd(function(){0!==M(window).scrollTop()&&M("body").addClass("site__header_sticky")},800),/\/reviews\//.test(window.location.href)&&0<M(".btn-group-mobile .btn-middle").length)){var t=!1,n=M(window).height()/2+M(window).scrollTop();M(window).on("scroll",function(){M(window).scrollTop()>n&&!1===t&&(M("body").append('<a rel="nofollow" target="_blank" class="btn-play-now" href="'+M(".btn-group-mobile .btn-middle").attr("href")+'">Play Now</a>'),M("body").addClass("play-now-appended"),t=!0)})}M(window).resize(function(e){_(b=M(window).width())}),tooltipConfig={trigger:"click",maxWidth:279,animation:"grow",debug:!1},copyTooltipConfig={trigger:"click",maxWidth:260,minWidth:260,animation:"grow",contentAsHTML:!0,debug:!1,functionBefore:function(e,t){e.content('                <div class="centered">                    <i class="icon icon-icon_available"></i> Code copied to clipboard                </div>            ')}},contentTooltipConfig={trigger:"click",minWidth:460,interactive:!0,contentAsHTML:!0,debug:!1,content:M(".loader"),animation:"fade",contentCloning:!1,functionReady:function(){M("body").addClass("shadow"),w(M(".bonus-box"),15),M(".js-tooltip").tooltipster(tooltipConfig)},functionAfter:function(){M("body").removeClass("shadow")},functionBefore:function(t,e){var n=M(e.origin);if(!0!==n.data("loaded")){var o=n.data("name"),a=n.data("is-free"),i=new XMLHttpRequest;i.abort(),i=M.ajax({url:"/casino/bonus",data:{casino:o,is_free:a},dataType:"json",type:"GET",success:function(e){"ok"==e.status&&(t.content(c(e,o)),setTimeout(function(){M(".js-tooltip").tooltipster(tooltipConfig),M(".js-copy-tooltip").tooltipster(copyTooltipConfig),g(),w(M(".bonus-box"),15)},50)),n.data("loaded",!0)}})}}};var q=function(){var a,i,e,t,n,o,s,r,c,l,d,u;if(function(){new Swiper("#main-carousel",{slidesPerView:6,spaceBetween:5,navigation:{nextEl:".carousel-next",prevEl:".carousel-prev"},breakpoints:{1024:{freeMode:!0,slidesPerView:"auto"}}});var e={slidesPerView:"auto",spaceBetween:30,allowTouchMove:!1,slidesOffsetAfter:-220,on:{slideChangeTransitionStart:function(e){M(".links-left").fadeIn("fast")},slideChangeTransitionEnd:function(e){0==this.translate&&M(".links-left").fadeOut("fast")}},breakpoints:{1024:{allowTouchMove:!0},690:{spaceBetween:15,allowTouchMove:!0}}},t=new Swiper(".links-casinos #links-nav",e);e.slidesOffsetAfter=-330;var n=new Swiper(".links-games #links-nav",e);if(1024<M(window).width()){function o(e,t,n){var o=e.closest(".swiper-container"),a=t;a.clientX>o.offset().left+o.width()/1.3?n.slideNext(500):a.clientX<o.offset().left+o.width()/6&&n.slidePrev(500)}M(".links-casinos .links-nav a").on("mouseenter",function(e){o(M(this),e,t)}),M(".links-games .links-nav a").on("mouseenter",function(e){o(M(this),e,n)})}}(),M.fn.moreLines=function(u){"use strict";return this.each(function(){var e=M(this),t=(e.find("p"),parseFloat(e.css("line-height"))),n=e.innerHeight(),o=M.extend({linecount:1,baseclass:"b-morelines_",basejsclass:"js-morelines_",classspecific:"section",buttontxtmore:"more lines",buttontxtless:"less lines",animationspeed:1},u),a=o.baseclass+o.classspecific+"_ellipsis",i=o.baseclass+o.classspecific+"_button",s=o.baseclass+o.classspecific+"_wrapper",r=o.basejsclass+o.classspecific+"_wrapper",c=M("<div>").addClass(s+" "+r).css({"max-width":e.css("width")}),l=t*o.linecount;if(e.wrap(c),e.parent().not(r)&&l<n){e.addClass(a).css({"min-height":l,"max-height":l,overflow:"hidden"});var d=M("<div>",{class:i,click:function(){e.toggleClass(a),M(this).toggleClass(i+"_active"),"none"!==e.css("max-height")?e.css({height:l,"max-height":""}).animate({height:"100%"},o.animationspeed,function(){d.html(o.buttontxtless)}):e.animate({height:l},o.animationspeed,function(){d.html(o.buttontxtmore),e.css("max-height",l)})},html:o.buttontxtmore});e.after(d)}}),this},M(".js-condense").moreLines({linecount:3,baseclass:"js-condense",basejsclass:"js-condense",classspecific:"_readmore",buttontxtmore:"Read More",buttontxtless:"Read Less",animationspeed:250}),(a=M(".rating-container")).data("casino-rating"),i=a.attr("data-user-rate"),e={showSelectedRating:!1,onSelect:function(e,t,n){if(void 0!==n){var o=M(n.currentTarget);M(".br-widget").children().each(function(){M(this).unbind("mouseenter mouseleave mouseover click"),parseInt(M(this).data("rating-value"))<=parseInt(i)&&M(this).addClass("br-active")}),M(".br-widget").unbind("mouseenter mouseleave mouseover click"),o.closest(a).find(".rating-current-text").text(t).removeClass("terrible poor good very-good excellent").attr("class","rating-current-text "+U(t)),o.closest(a).find(".rating-current-value span").text(e),o.closest(a).find(".rating-current").attr("data-rating-current",e),new v({value:e,name:a.data("casino-name")})}}},M(".rating-bar",a).barrating("show",e),t=M(".js-filter > option"),M(".js-filter").select2MultiCheckboxes({templateSelection:function(e,t){return"Game software"}}),t.prop("selected",!1),n=M(".header-search"),o=M(".js-search-opener",n),s=M(".js-mobile-search-opener"),r=M(".js-search-close",n),c=M(".js-mobile-search-close"),l=M(".js-mobile-search-clear"),d=M(".js-search-drop"),u=M(".header-search-input input"),o.on("click",function(e){M("body").addClass("search-opened"),u.focus(),y(d),M(document).on("click touchstart",function(e){0==M(e.target).closest(d).length&&0==M(e.target).closest(u).length&&0==M(e.target).closest(s).length&&0==M(e.target).closest(o).length&&(u.val(""),O(d))})}),u.on("keydown",function(e){13!=e.keyCode&&y(d)}),r.on("click",function(e){O(d)}),s.on("click",function(e){M("body").addClass("mobile-search-opened"),u.focus()}),c.on("click",function(e){u.val("").focus(),M("body").removeClass("mobile-search-opened")}),l.on("click",function(){u.val("").focus()}),g(),_(b),T(),M("#reviews").on("click",".js-reply-btn",function(e){return M(this).parent().next().slideToggle(),!1}),R(),function(){var e=M(".js-more-reviews"),a=(e.data("reviews"),M("#review-data-holder")),i=M(".reply-data-holder"),t=M(".rating-container").data("casino-name"),s=new XMLHttpRequest;e.on("click",function(){return n(M(this),M(this).data("type")),!1});var n=function(n,o){BUSY_REQUEST||(BUSY_REQUEST=!0,s.abort(),s=M.ajax({url:"/casino/more-reviews/"+U(t)+"/"+n.data("page"),dataType:"HTML",data:{id:n.data("id"),type:o},type:"GET",success:function(e){"review"==o?(a.append(e),n.data("page")>=n.data("total")/5&&n.hide()):"reply"==o&&n.closest(".reply").find(i).append(e),n.data("page")>=n.data("total")/5&&n.hide();var t=n.data("page");n.data("page",++t),r()},error:function(e){"abort"!=e.statusText&&console.log("err")},complete:function(){BUSY_REQUEST=!1}}))},r=function(){T(),R(),new j(M(".js-vote")),M(".review").each(function(){new E(M(this))})}}(),w(M(".list .bonus-box"),21),w(M(".bonus-item .bonus-box"),33),function(){if(10<=function(){var e=-1;if("Microsoft Internet Explorer"==navigator.appName){var t=navigator.userAgent,n=new RegExp("MSIE ([0-9]{1,}[.0-9]{0,})");null!=n.exec(t)&&(e=parseFloat(RegExp.$1))}else if("Netscape"==navigator.appName){var t=navigator.userAgent,n=new RegExp("Trident/.*rv:([0-9]{1,}[.0-9]{0,})");null!=n.exec(t)&&(e=parseFloat(RegExp.$1))}return e}()){M(".not-accepted").each(function(){var e=M(this);e.css({position:"absolute"}).wrap("<div class='img_wrapper' style='display: inline-block'>").clone().addClass("img_grayscale").css({position:"absolute","z-index":"5",opacity:"0"}).insertBefore(e).queue(function(){var e=M(this);e.parent().css({width:this.width,height:this.height}),e.dequeue()}),this.src=function(e){var t=document.createElement("canvas"),n=t.getContext("2d"),o=new Image;o.src=e,t.width=o.width,t.height=o.height,n.drawImage(o,0,0);for(var a=n.getImageData(0,0,t.width,t.height),i=0;i<a.height;i++)for(var s=0;s<a.width;s++){var r=4*i*a.width+4*s,c=(a.data[r]+a.data[r+1]+a.data[r+2])/3;a.data[r]=c,a.data[r+1]=c,a.data[r+2]=c}return n.putImageData(a,0,0,0,0,a.width,a.height),t.toDataURL()}(this.src)})}}(),M(".js-table-package-opener").on("click",function(e){M(this).closest("tr").toggleClass("active"),e.preventDefault()}),M(".message .close").on("click",function(e){M(this).parent().fadeOut(),e.preventDefault()}),M(".js-history-back").on("click",function(e){window.history.back(),e.preventDefault()}),0<M("#filters").length&&new m(M("#filters")),0<M("#reviews").length&&(M(".review").each(function(e){new E(M(this))}),M('[href="#reviews"]').on("click",function(){return function(e,t){if(void 0!==e)o(e,t);else{var n=M(".js-scroll");n.on("click",function(e){var t=M(M(this).attr("href"));o(t,0),e.preventDefault()})}function o(e,t){M("html, body").animate({scrollTop:e.offset().top-t},1e3)}}(M("#reviews"),100),!1})),0<M(".js-vote").length&&new j(M(".js-vote")),0<M(".js-run-counter").length){var f=M(".js-run-counter").data("name");runPlayCounter(f)}0<M(".contact-form").length&&new h(M(".contact-form")),new p(M(".subscribe")),M(".js-tooltip").tooltipster(tooltipConfig),M(".js-copy-tooltip").tooltipster(copyTooltipConfig),M(".js-tooltip-content").tooltipster(contentTooltipConfig)};function c(e,t){var n=t,o=e.body.bonus.amount,a=e.body.bonus.code,i=e.body.bonus.games_allowed,s=e.body.bonus.min_deposit,r=e.body.bonus.type,c=e.body.bonus.wagering,l="bonus-free",d="icon-icon_bonuses",u="",f="";"First Deposit Bonus"==r&&(l="bonus-first",d="icon-free-bonus-icon"),"Free Play"==r&&(r="Free Bonus"),"No code required"!=a&&(u="js-copy-to-clip js-copy-tooltip"),""==s&&(s="Free",f="success");var p=M(M("#bonus-box-tpl").html()).filter(".tooltip-content");return p.addClass(l),p.find(".tooltip-templates-title").text(n+" "+r),p.find(".tooltip-templates-button a").attr("href","/visit/"+U(n)),p.find(".bonus-box-heading span").text(o+" "+r),p.find(".bonus-box-btn.dashed").addClass(u).attr("data-code",a).text(a),p.find(".bonus-box-wagering").text(c),p.find(".list-item-trun").text(i),p.find(".bubble").attr("title",i),p.find(".bonus-box-dep").addClass(f).text(s),p.find(".bonus-box-circle i").addClass(d),p}function w(e,a){M(e).each(function(e,t){var n=M(this).find(".list-item-trun"),o=M(this).find(".bubble");n.text().length>=a&&o.css("visibility","visible")})}function p(e){var t,n=e,o=n.find(".news-email"),a=n.find(".news-btn"),i=M("#news-success"),s=M("#news-note"),r="not-valid",c=new XMLHttpRequest;_prepMessage=function(){return t=o.val(),ok=!0,""!==t&&A(t)?o.parent().removeClass(r):(o.parent().addClass(r),ok=!1),ok?s.hide():s.show(),ok},_sendNews=function(e){c.abort(),c=M.ajax({url:"/newsletter/subscribe",data:{email:e},dataType:"json",timeout:2e4,type:"POST",success:function(e){if("ok"==e.status)i.show(),s.hide(),a.prop("disabled",!0),o.val(""),_onEvents();else if("error"==e.status){var t=JSON.parse(e.body);M(".action-added").remove(),M.each(t,function(e,t){var n='<div class="action-field action-added not-valid ">'+t+"</div>";M(".review-submit-holder .msg-holder").append(n)})}},error:function(e){console.error("Could not send message!")}})},_onEvents=function(){a.on({click:function(e){!1===_prepMessage()?e.stopPropagation():_sendNews(t)}})},_init=function(){_onEvents()},_init()}function h(e){var t,n,o,a=M(".contact-name"),i=M(".contact-email"),s=M(".contact-message"),r=M(".contact-btn"),c=M("#contact-us-success"),l=M("#contact-us-note"),d=M("#server-error-note"),u="not-valid",f=new XMLHttpRequest;_prepContact=function(){return t=a.val(),n=i.val(),o=s.val(),ok=!0,""!==t&&B(t)?a.parent().removeClass(u):(a.parent().addClass(u),ok=!1),""!==n&&A(n)?i.parent().removeClass(u):(i.parent().addClass(u),ok=!1),""!==o&&L(o)?s.parent().removeClass(u):(s.parent().addClass(u),ok=!1),ok?l.hide():l.show(),ok},_sendMessage=function(e,t,n){f.abort(),f=M.ajax({url:"/contact/send",data:{name:e,email:t,message:n},dataType:"json",timeout:2e4,type:"POST",success:function(e){if("ok"==e.status)c.show(),l.hide(),d.hide(),r.prop("disabled",!0),a.val(""),i.val(""),s.val(""),_onEvents();else if("error"==e.status){JSON.parse(e.body);d.show()}},error:function(e){console.error("Could not send message!")}})},_onEvents=function(){r.on({click:function(e){!1===_prepContact()?e.stopPropagation():_sendMessage(t,n,o)}})},_init=function(){_onEvents()},_init()}var m=function(e){var s,t,n=e,o=this,a=n.find("input[type=checkbox]"),i=n.find("input[type=radio]"),r=n.find("select[name=soft]"),c=M(".data-container"),l=M(".data-add-container"),d=c.data("type"),u=c.data("type-value"),f=(M(".aj-content"),M(".empty-filters")),p=n.next(".data-container-holder").find(".holder"),h=M(".list-item").length,m=M("#default"),v=M(".qty-items").data("load-total");Math.floor(v/h);_currentClick=0,_request=new XMLHttpRequest,void 0===d&&(d="game_type"),_url=n.data("url"),m.prop("checked",!0);var g=function(e,t,n){var o={};return M.each(a,function(e,t){M(t).is(":checked")&&(o[M(t).attr("name")]=1),"reset"==n&&(o[M(t).attr("name")]="",M(t).prop("checked",!1))}),M.each(i,function(e,t){M(t).is(":checked")&&(o[M(t).attr("name")]=M(t).attr("value")),"reset"==n&&(o[M(t).attr("name")]=1,0==e&&M(t).prop("checked",!0))}),o[e]=t,"undefined"!=r.val()&&null!=r.val()&&(o.software=r.val().join(),"reset"==n&&(o.software="")),void 0===AJAX_CUR_PAGE&&(AJAX_CUR_PAGE=1),"add"==n&&"reset"!=n||(AJAX_CUR_PAGE=0),null!=o.label&&"Mobile"==o.label&&(o.compatibility="mobile",delete o.label),o};_ajaxRequestCasinos=function(e,a){if("add"==a?s.addClass("loading"):M(".overlay, .loader").fadeIn("fast"),!BUSY_REQUEST){BUSY_REQUEST=!0,_request.abort();var i="/games-filter/"==_url?24:100;_request=M.ajax({url:_url+AJAX_CUR_PAGE,data:e,dataType:"html",type:"GET",success:function(e){var t=M(e).find(".loaded-item"),n=M(e).filter("[data-load-total]").data("load-total");function o(){M(".js-tooltip").tooltipster(tooltipConfig),M(".js-copy-tooltip").tooltipster(copyTooltipConfig),M(".js-tooltip-content").tooltipster(contentTooltipConfig),_(b)}"replace"==a?(c.html(e),l.html(""),M(".qty-items").attr("data-load-total",n),M(".qty-items-quantity").text(n),t.length<i?(0<t.length?(p.show(),f.hide()):(p.hide(),f.show()),s.hide()):(s.show(),p.show(),f.hide()),o(),AJAX_CUR_PAGE=1,_currentClick=0):(AJAX_CUR_PAGE++,_currentClick++,setTimeout(function(){l.append(t),s.removeClass("loading"),o(),t.length<i&&s.hide()},1e3)),_construct(),w(M(".data-add-container .bonus-box, .data-container .bonus-box"),21)},error:function(e){"abort"!=e.statusText&&console.log("err")},complete:function(){BUSY_REQUEST=!1,M(".overlay, .loader").fadeOut("fast")}});var t=setTimeout(function(){},300);_hideLoading=function(){clearTimeout(t)}}},_loadData=function(e){},_construct=function(){s=M(".js-more-items"),t=M(".js-reset-items"),a.off(),a.on("click",function(){_ajaxRequestCasinos(g(d,u),"replace")}),i.off(),i.on("click",function(){_ajaxRequestCasinos(g(d,u),"replace")}),M(".js-filter > option").on("click",function(){M(".js-filter > option").each(function(e,t){M(this).prop("selected")})}),r.off(),r.on("change",function(){_ajaxRequestCasinos(g(d,u),"replace")}),s.off(),s.on("click",function(){return _ajaxRequestCasinos(g(d,u,"add"),"add"),!1}),t.off(),t.on("click",function(){return _ajaxRequestCasinos(g(d,u,"reset"),"add"),!1}),n[0].obj=o},_construct()};function T(){var e=M(".expanding"),t=M(".js-expanding-textfields");M(".box img.not-accepted").length?e.unbind("mouseenter mouseleave mouseover click focus"):e.on("focus",function(){M(this).removeClass("expanding"),M(this).closest(".form").find(t).slideDown()})}var j=function(e){var t=e.find(".vote-button"),n=new XMLHttpRequest,o=function(e,t,n){return{id:t}};_getTarget=function(e){return"/casino/review-like"},_updateVote=function(o,e,t){BUSY_REQUEST||(BUSY_REQUEST=!0,n.abort(),n=M.ajax({url:e,data:t,dataType:"json",type:"post",success:function(e){var t=M(o).find(".bubble-vote"),n=t.text();t.text(++n)},error:function(e){"abort"!=e.statusText&&console.log("err")},complete:function(){BUSY_REQUEST=!1}}))},t.off(),t.on("click",function(){var e=M(this).data("id"),t=M(this).data("success"),n=M(this).data("type");return _updateVote(M(this),_getTarget(n),o(n,e,t)),!1})};function E(e){var n,o,a,i,s,r,c,l,d,u,f,p,h,m,t=this.obj=e,v=M("#reviews-form").data("img-dir"),g=M("#reviews-form").data("country"),b=t.find("input[name=submit]"),w=M(".reviews-qty"),_="not-valid",y=M(".reviews-form").data("casino-id"),x=localStorage.getItem("casino_"+y+"_reviewed"),C=localStorage.getItem("casino_"+y+"_score"),k=new XMLHttpRequest;_prepReview=function(e){var t=e;return o=t.find("input[name=name]"),a=t.find("input[name=email]"),i=t.find("textarea[name=body]"),s=t.find(".field-error-required"),r=t.find(".field-error-rate"),_contact_error=t.find(".field-error"),l=o.val(),d=a.val(),u=i.val(),casino_name=M(".rating-container").data("casino-name"),h=M(".rating-current-value span").text(),n=0,ok=!0,null!=t.data("id")?(n=t.data("id"),f=!0,0<t.next().find(".reply-data-holder").length?(c=t.next().find(".reply-data-holder"),p=!1):(p=!0,n=t.closest(".reply").prev().data("id"),_setReviewerName(t),c=t.closest(".reply-data-holder")),m=t.find(".js-reply-btn span")):(f=!1,c=M("#review-data-holder")),""!==l&&B(l)?o.parent().removeClass(_):(o.parent().addClass(_),ok=!1),""!==d&&A(d)?a.parent().removeClass(_):(a.parent().addClass(_),ok=!1),""!==u&&L(u)?i.parent().removeClass(_):(i.parent().addClass(_),ok=!1),ok?(_contact_error.hide(),s.hide()):s.show(),f||("0"===h?(r.show(),t.find(M(".rating-container")).addClass(_),ok=!1):(r.hide(),t.find(M(".rating-container")).removeClass(_))),ok},_setReviewerName=function(e){var t=e.find(".review-name").text();u="<strong>@"+t+"</strong> "+i.val()},_changeName=function(){M("#reviews-form input[name=name]").on("keyup",function(){M("#reviews-form .review-name").text(M(this).val())})},_prepAjaxData=function(e){var t={casino:casino_name,name:l,email:d,body:u,parent:n,invision_casino_id:M(".reviews-form").attr("data-invision-casino-id"),casino_id:M(".reviews-form").attr("data-casino-id")};_sendReview(t,e)},_sendReview=function(e,t){BUSY_REQUEST||(BUSY_REQUEST=!0,k.abort(),k=M.ajax({url:"/casino/review-write",data:e,dataType:"json",timeout:2e4,type:"POST",success:function(e){"ok"==e.status?(_loadData(e,t),o.val(""),a.val(""),i.val("").addClass("expanding"),_onEvents(),M(".reviews-form").attr("data-invision-casino-id",e.body.review_invision_id),M(".form .js-expanding-textfields").slideUp()):"error"==e.status&&(console.error(e.body),_errors_found=M.parseJSON(jqXHR.responseJSON.body),_contact_error.html(_errors_found.join("<br />")).show())},error:function(e){_errors_found=M.parseJSON(e.responseJSON.body),console.error("Could not send message!"),_contact_error.html(_errors_found.join("<br />")).show()},complete:function(){BUSY_REQUEST=!1}}))},_loadData=function(i,e){if(M.isEmptyObject(i))_showEmptyMessage();else{function t(){var e,t,n,o,a=M(M("#comment-tpl").html()).filter(".review");return a.attr("data-id",i.body.id),a.find(".review-flag img").attr({src:v,alt:g}),a.find(".review-name").text(l),a.find(".review-date").text((e=new Date,t=e.getDate(),n=e.getMonth()+1,o=e.getFullYear(),e=t+"."+n+"."+o)),a.find(".review-text p").text(u),a.find(".js-vote a").attr("data-id",i.body.id),f?(a.addClass(l.toLowerCase()+" review-child").attr("data-img-dir",v),a.find(".list-rating").remove()):(a.addClass(l.toLowerCase()+" review-parent"),a.find(".list-rating").addClass(U(S(h))),a.find(".list-rating-score").text(h),a.find(".list-rating-text").text(S(h))),a}p?M(t()).insertAfter(e):c.prepend(t()),_refreshData()}},_refreshData=function(){f||(w.text(parseInt(w.text())+1),localStorage.setItem("casino_"+y+"_reviewed",1),localStorage.setItem("casino_"+y+"_score",h)),f&&m.text(parseInt(m.text())+1),M(".review-form").slideUp(),T(),R(),new j(M(".js-vote")),M(".review, .reply").each(function(){new E(M(this))})},_doIfReviewedAlready=function(){var e=M("#reviews-form");M(".review-rating",e).addClass("active"),M("textarea",e).addClass("disabled"),M(".rating-bar").barrating("set",C),M(".rating-current-value span").text(C),M("textarea[name=body]",e).attr("placeholder","You have already reviewed")},_initForms=function(){b.off(),b.on({click:function(e){!1===_prepReview(t)?e.stopPropagation():_prepAjaxData(t)}})},_onEvents=function(){x?(_doIfReviewedAlready(),_initForms()):(_initForms(),_changeName())},_init=function(){_onEvents()},_init()}function S(e){return $string=8<e?"Excellent":6<e&&e<=8?"Very good":4<e&&e<=6?"Good":2<e&&e<=4?"Poor":"Terrible",$string}var v=function(e){var t=e,n=t.name,o=t.value,a=new XMLHttpRequest;(function(e,t){BUSY_REQUEST||(BUSY_REQUEST=!0,a.abort(),a=M.ajax({url:"/casino/rate",data:{name:e,value:t},dataType:"json",type:"post",success:function(e){"Casino already rated!"==e.body.success&&(M(".icon-icon_available").toggleClass("icon-icon_unavailable"),M(".icon-icon_unavailable").removeClass("icon-icon_available"),M(".thanx").html(e.body.success)),M(".rating-container").next(".action-field").show()},error:function(e){"abort"!=e.statusText&&console.log("err")},complete:function(){BUSY_REQUEST=!1}}))})(n,o)},o=function(e){var o,a,t=e,n=this,i=t.find(".js-trigger-search"),s=t.find("#search-all"),r=t.find("#search"),c=t.find("#search-form"),l=(t.find(".search-results"),c.find("input")),d=c.find(".js-mobile-search-clear"),u=r.find("#search-casinos ul"),f=r.find("#search-lists ul"),p=r.find("#search-pages ul"),h=r.find("#search-empty"),g=(r.data("img-dir"),!1),b=1,w=1,_=1,m=new XMLHttpRequest;window.contentBeforeSearch;var y=function(){M("#site-content").html("").append(contentBeforeSearch),M(".js-search-drop").show(),M("body").removeClass("advanced-search-opened"),l.blur(),setTimeout(function(){q()},1e3)},x=function(e,t,n,o){if(!BUSY_REQUEST){BUSY_REQUEST=!0,m.abort(),m=M.ajax({url:e,data:{value:t},dataType:"json",type:"GET",success:function(e){_hideLoading(),j(e,n,o)},error:function(e){"abort"!=e.statusText&&(_hideLoading(),console.log("err"),R())},complete:function(){_hideLoading(),BUSY_REQUEST=!1}});var a=setTimeout(function(){},300);_hideLoading=function(){clearTimeout(a)}}},v=function(){window.scrollTo(0,0);var v=M("#site-content");BUSY_REQUEST||(BUSY_REQUEST=!0,m.abort(),m=M.ajax({url:"/search/advanced",data:{value:l.val()},dataType:"HTML",type:"GET",success:function(e){var t,n,o,a,i,s,r,c,l,d,u,f,p,h,m;M("body").addClass("advanced-search-opened"),g||(contentBeforeSearch=M("#site-content .main, #site-content .promo").detach()),g=!0,v.html(e),A(),t=M("#js-search-more-lists"),n=M(".more-lists",t),o=n.data("total-casinos"),a=M("#js-search-more-casinos"),i=M(".more-num",a),s=i.data("total-casinos"),r=M("#js-search-more-pages"),c=M(".more-num",r),l=c.data("total-games"),d=Math.floor(o/5),u=Math.floor(s/5),f=Math.floor(l/5),h=s%5,m=l%5,(p=o%5)<5&&1==d&&n.text(p),h<5&&1==u&&i.text(h),m<5&&1==f&&c.text(m),t.on("click",function(){return x("/search/more-lists/"+w,M(".search-title span").text(),M("#all-lists-container"),"lists"),d<=w?t.fadeOut():t.fadeIn(),d-1<=w&&0<p&&n.text(p),w++,!1}),a.on("click",function(){return x("/search/more-casinos/"+b,M(".search-title span").text(),M("#all-casinos-container"),"casinos"),u<=b?a.fadeOut():a.fadeIn(),u-1<=b&&0<h&&i.text(h),b++,!1}),r.on("click",function(){return x("/search/more-games/"+_,M(".search-title span").text(),M("#all-games-container"),"games"),f<=_?r.fadeOut():r.fadeIn(),f-1<=_&&0<m&&c.text(m),_++,!1}),v.find("#js-search-back").each(function(){M(this).on({click:function(){y()}})}),M(".js-mobile-search-close").on("click",function(){y()})},error:function(e){"abort"!=e.statusText&&console.log("err")},complete:function(){BUSY_REQUEST=!1}}))},C=function(e,t){if(!BUSY_REQUEST||a!=o){BUSY_REQUEST=!0,m.abort(),m=M.ajax({url:e,data:{value:l.val(),page:t},dataType:"json",type:"GET",success:function(e){_hideLoading(),E(e)},error:function(e){"abort"!=e.statusText&&(_hideLoading(),console.log("err"),R())},complete:function(e){_hideLoading(),a++,BUSY_REQUEST=!1}});var n=setTimeout(function(){},300);_hideLoading=function(){clearTimeout(n)}}},k=function(e){return e.replace(/\s/g,"-").toLowerCase()},T=function(e){return'<li>                    <a class="search-results-label" href="/'+e.link.replace("/games/","")+'">                        '+e.name+"                    </a>                </li>"},j=function(e,t,n){var o,a=e.body.results;if("lists"===n)for(var i=0;i<a.length;i++){var s=T({link:a[i].url,name:a[i].title});t.append(s)}else for(var r in a){"games"==n?o="play/"+k(a[r]):"casinos"==n&&(o="reviews/"+k(a[r])+"-review");s=T({link:o,name:a[r]});t.append(s)}},E=function(e){var t=e.body.lists,n=e.body.casinos,o=e.body.games;if(f.empty(),u.empty(),p.empty(),M.isEmptyObject(t)&&M.isEmptyObject(n)&&M.isEmptyObject(o))R();else{U(),M.isEmptyObject(t)?f.parent().hide().next().addClass("single"):(f.parent().show().next().removeClass("single"),3<e.body.total_lists&&Math.ceil(e.body.total_lists/3)>w||(w=1)),M.isEmptyObject(n)?u.parent().hide().next().addClass("single"):(u.parent().show().next().removeClass("single"),3<e.body.total_casinos&&Math.ceil(e.body.total_casinos/3)>b||(b=1)),M.isEmptyObject(o)?p.parent().hide().prev().addClass("single"):(p.parent().show().prev().removeClass("single"),3<e.body.total_pages&&Math.ceil(e.body.total_casinos/3)>_||(_=1)),f.html("");for(var a=0;a<t.length;a++){var i=T({link:t[a].url,name:t[a].title});f.append(i)}for(var s in n){i=T({link:"reviews/"+k(n[s])+"-review",name:n[s]});u.append(i)}for(var r in o){i=T({link:"play/"+k(o[r]),name:o[r]});p.append(i)}""!=l.val()&&L()}},S=function(){b=_=1},R=function(){f.parent().hide(),u.parent().hide(),p.parent().hide(),h.show(),s.parent().fadeOut()},U=function(){f.parent().show(),u.parent().show(),p.parent().show(),h.hide()},A=function(){O(M(".js-search-drop")),!0},B=function(){A()},L=function(){t.find(".search-results-label").each(function(){M(this).html(function(e,t){return t.replace(new RegExp(l.val().toLowerCase(),"ig"),"<b>$&</b>")})})};n.close=function(){B()},i.on("click",function(){return C("/search"),S(),!1}),l.on({focus:function(){a=o=0,C("/search"),S()},keyup:function(e){27==e.keyCode?B():13==e.keyCode?""!=l.val()&&(v(),l.blur()):(t.find("#search__popup").addClass("load"),o++,C("/search")),S(),""!=l.val()?s.parent().fadeIn():s.parent().fadeOut()}}),d.on("click",function(){return l.val("").focus(),C("/search"),S(),!1}),s.on("click",function(){return""!=l.val()&&v(),!1}),t[0].obj=n};function R(){var e=M(".textfield");e.focus(function(){M(this).parent().addClass("active").removeClass("not-valid")}),e.blur(function(){""==M(this).val()&&M(this).parent().removeClass("active")})}function _(e){var s=M(".list-item"),r=M(".js-mobile-pop"),t=M(".btn-round"),n=M(".js-mobile-pop-close");if(e<=690){function o(e){var t=e.closest(s).find(".mobile-popup-body"),n=e.closest(s).find(".mobile-popup-title"),o=(e.closest(s).find(".js-tooltip-content"),e.data("name")),a=e.data("is-free"),i=new XMLHttpRequest;i.abort(),i=M.ajax({url:"/casino/bonus",data:{casino:o,is_free:a},dataType:"json",type:"GET",success:function(e){"ok"==e.status&&($bonus=c(e,o),a?t.prepend($bonus):t.append($bonus),n.text($bonus.find(".tooltip-templates-title").text()),t.find(".js-tooltip").tooltipster(tooltipConfig),t.find(".js-copy-tooltip").tooltipster(copyTooltipConfig),w(M(".bonus-box"),21),g(),M(".overlay, .loader").fadeOut("fast"))}}),e.closest(s).find(r).fadeIn("fast"),M("html, body").addClass("no-scroll")}t.off("click"),t.on("click",function(e){return M(".overlay, .loader").fadeIn("fast"),o(M(this)),!1}),n.on("click",function(e){return M(this).closest(r).fadeOut("fast").find(".mobile-popup-body").html(""),M("html, body").removeClass("no-scroll"),!1})}}function g(){window.Clipboard=function(d,u,e){var f;function p(){return e.userAgent.match(/ipad|iphone/i)}return{copy:function(e,t){var n,o,a,i,s,r,c,l=(n=e,(o=document.createElement("DIV")).innerHTML=n,o.textContent||o.innerText||"");a=l,i=t,f=u.createElement("textArea"),p()&&f.setAttribute("readonly","readonly"),f.value=a,i.parent().append(f),p()?((s=u.createRange()).selectNodeContents(f),(r=d.getSelection()).removeAllRanges(),r.addRange(s),f.setSelectionRange(0,999999)):f.select(),c=t,u.execCommand("copy"),c.parent().find(f).remove()}}}(window,document,navigator),M(".js-copy-to-clip").on("click touch",function(e){Clipboard.copy(M(this).data("code"),M(this)),e.preventDefault()})}function y(e){setTimeout(function(){e.slideDown("fast")},300)}function O(e){e.slideUp("fast"),setTimeout(function(){M("body").removeClass("search-opened")},300)}function U(e){return e.replace(/\s/g,"-").toLowerCase()}function A(e){return/^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i.test(e)}function B(e){if(""!=e)return!0}function L(e){if(""!=e)return!0}}(jQuery);