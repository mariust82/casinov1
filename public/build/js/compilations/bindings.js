var ww=$(window).width();function unlockScreen(){$("html, body").removeClass("no-scroll")}function lockScreen(){$("html, body").addClass("no-scroll")}function newsletter(e){var t,o=e,n=o.find(".news-email"),a=o.find(".news-btn"),s=$("#news-success"),i=$("#news-note"),r="not-valid",c=new XMLHttpRequest;_prepMessage=function(){return t=n.val(),ok=!0,""!==t&&validateEmail(t)?n.parent().removeClass(r):(n.parent().addClass(r),ok=!1),ok?i.hide():i.show(),ok},_sendNews=function(e){c.abort(),c=$.ajax({url:"/newsletter/subscribe",data:{email:e},dataType:"json",timeout:2e4,type:"POST",success:function(e){if("ok"==e.status)s.show(),i.hide(),a.prop("disabled",!0),n.val(""),_onEvents();else if("error"==e.status){var t=JSON.parse(e.body);$(".action-added").remove(),$.each(t,function(e,t){var o='<div class="action-field action-added not-valid ">'+t+"</div>";$(".review-submit-holder .msg-holder").append(o)})}},error:function(e){console.error("Could not send message!")}})},_onEvents=function(){a.on({click:function(e){!1===_prepMessage()?e.stopPropagation():_sendNews(t)}})},_init=function(){_onEvents()},_init()}function initMobileBonusesPop(e){var s=$(".block .container"),t=$(".btn-round"),i=document.body.scrollTop;if(e<=690){t.off("click"),t.on("click",function(e){var t,a,o,n;return i=$(window).scrollTop(),$(".overlay, .loader").fadeIn("fast"),t=$(this),a=t.closest(s),o=t.data("name"),n=t.data("is-free"),(new XMLHttpRequest).abort(),$.ajax({url:"/casino/bonus",data:{casino:o,is_free:n},dataType:"html",type:"GET",success:function(e){var t=$(e).insertAfter(a);t.find(".js-tooltip").tooltipster(tooltipConfig),t.find(".js-copy-tooltip").tooltipster(copyTooltipConfig);var o=t.find(".js-mobile-pop-close");checkStringLength($(".bonus-box"),21),copyToClipboard(),$(".overlay, .loader").fadeOut("fast"),t.fadeIn("fast").fadeIn("fast");var n=$("html, body").hasClass("site__header_sticky");n&&$("html, body").removeClass("site__header_sticky"),lockScreen(),o.on("click",function(e){return $("body").addClass("site__header_sticky"),t.fadeOut("fast").find(".mobile-popup-body").html(""),unlockScreen(),n&&$("html, body").addClass("site__header_sticky"),$(".overlay, .loader").fadeOut("fast"),goToPosition(i),t.remove(),!1})}}),$("body").removeClass("site__header_sticky"),!1})}}function initSearch(){var e=$(".header-search"),t=$(".js-search-opener",e),o=$(".js-mobile-search-opener"),n=$(".js-search-close",e),a=$(".js-mobile-search-close"),s=$(".js-mobile-search-clear"),i=$(".js-search-drop"),r=$(".header-search-input input"),c=0;t.on("click",function(e){$("body").addClass("search-opened"),r.focus(),searchDropOpen(i),$(document).on("click touchstart",function(e){0==$(e.target).closest(i).length&&0==$(e.target).closest(r).length&&0==$(e.target).closest(o).length&&0==$(e.target).closest(t).length&&(r.val(""),searchDropClose(i))})}),r.on("keydown",function(e){13!=e.keyCode?(isSearchResultEvent=!0,searchDropOpen(i)):isSearchResultEvent=!1}),n.on("click",function(e){searchDropClose(i)}),o.on("click",function(e){c=$(window).scrollTop(),$("body").addClass("mobile-search-opened"),lockScreen(),r.focus()}),a.on("click",function(e){r.val("").blur(),$("body").removeClass("mobile-search-opened"),unlockScreen(),goToPosition(c)}),s.on("click",function(){r.val("").focus()}),r.on("focus",function(){goToPosition(0)}),i.on("scroll",function(e){r.blur()})}function goToPosition(e){$("html, body").animate({scrollTop:e},5)}function initMobileMenu(){var t=$("#js-mobile-menu-opener, #js-mobile-menu-close"),o=$(".header-menu"),n=null,a=$("html, body");t.on("click",function(e){$("body").toggleClass("menu-opened"),t.toggleClass("active"),checkIfIsMobileDevice()&&(n=$(window).scrollTop(),a.hasClass("no-scroll")?lockScreen():(unlockScreen(),goToPosition(n)),$(".expand-menu__list-item.active ").closest(".expand-holder").addClass("opened")),$(document).on("click touchstart",function(e){0==$(e.target).closest(o).length&&0==$(e.target).closest(t).length&&($("body").removeClass("menu-opened"),checkIfIsMobileDevice()&&(unlockScreen(),goToPosition(n)),t.removeClass("active"))}),e.preventDefault()})}function initToggleMenu(){var e=document.querySelector(".header-menu__list-holder");if(e){var t=checkIfIsMobileDevice()?"click":"hover";e.addEventListener(t,function(e){for(var t,o=e.target;o!=this;){if(o.classList.contains("expand-holder")){(t=document.querySelector(".expand-holder.opened"))==o?"expand-menu"!==e.target.className&&t.classList.remove("opened"):t?("expand-menu"!==e.target.className&&t.classList.remove("opened"),setTimeout(function(){o.classList.add("opened")},400)):o.classList.add("opened");break}o=o.parentNode}},!0)}}function searchDropOpen(e){setTimeout(function(){e.slideDown("fast")},300)}function searchDropClose(e){e.slideUp("fast"),setTimeout(function(){$("body").removeClass("search-opened")},300)}function sliderInit(){new Swiper("#main-carousel",{slidesPerView:6,spaceBetween:5,navigation:{nextEl:".carousel-next",prevEl:".carousel-prev"},breakpoints:{1024:{freeMode:!0,slidesPerView:"auto"}}});var e={slidesPerView:"auto",freeMode:!0,allowTouchMove:!1,on:{slideChangeTransitionStart:function(e){$(".links-left, .links-right").fadeIn("fast")},slideChangeTransitionEnd:function(e){0==this.translate&&$(".links-left").fadeOut("fast"),this.isEnd&&$(".links-right").fadeOut("fast")}},breakpoints:{1024:{allowTouchMove:!0},690:{allowTouchMove:!0}}};if($("#links-nav").length){var t=new Swiper(".links-casinos #links-nav",e),o=new Swiper(".links-games #links-nav",e),n=$("#links-nav .active").parent().index()-1;$(".links-casinos #links-nav").length&&t.slideTo(n,300),$(".links-games #links-nav").length&&o.slideTo(n,300)}if(1024<$(window).width()){function a(e,t,o){var n=e.closest(".swiper-container"),a=t;a.clientX>n.offset().left+n.width()/1.3?o.slideNext(500):a.clientX<n.offset().left+n.width()/6&&o.slidePrev(500)}$(".links-casinos .links-nav a").on("mouseenter",function(e){a($(this),e,t)}),$(".links-games .links-nav a").on("mouseenter",function(e){a($(this),e,o)})}}function refresh(){$(".js-tooltip").tooltipster(tooltipConfig),$(".js-copy-tooltip").tooltipster(copyTooltipConfig),$(".js-tooltip-content").tooltipster(contentTooltipConfig),initMobileBonusesPop(ww)}function copyToClipboard(){window.Clipboard=function(c,l,e){var d;function u(){return e.userAgent.match(/ipad|iphone/i)}return{copy:function(e,t){var o,n,a,s,i,r=strip(e);o=r,n=t,d=l.createElement("textArea"),u()&&d.setAttribute("readonly","readonly"),d.value=o,n.parent().append(d),u()?((a=l.createRange()).selectNodeContents(d),(s=c.getSelection()).removeAllRanges(),s.addRange(a),d.setSelectionRange(0,999999)):d.select(),i=t,l.execCommand("copy"),i.parent().find(d).remove()}}}(window,document,navigator),$(".js-copy-to-clip").on("click touch",function(e){Clipboard.copy($(this).data("code"),$(this)),e.preventDefault()})}function strip(e){var t=document.createElement("DIV");return t.innerHTML=e,t.textContent||t.innerText||""}function checkStringLength(e,o){$(e).each(function(){var e=$(this).find(".list-item-trun"),t=$(this).find(".bubble");e.text().length>=o&&t.css("visibility","visible")})}function initTooltipseter(){$(".js-tooltip").tooltipster(tooltipConfig),$(".js-copy-tooltip").tooltipster(copyTooltipConfig),$(".js-tooltip-content").tooltipster(contentTooltipConfig)}function bindButtons(){$(".search_input").on({blur:function(e){var t=$(this).val().trim();isSearchResultEvent||$(".search-tag-manager").length&&$(this).val().trim()==t||2<t.length&&t!=searched_value&&(searched_value=t,loadScripts(["assets/search-tracker"]),SearchTracker(t))}}),$("#search-all").on({mousedown:function(){isSearchResultEvent=!0},mouseup:function(){isSearchResultEvent=!1}}),$(".js-more-games").click(function(){$(this).addClass("loading");var e=$(this).data("software"),t=$(this);console.dir("/games-by-software/"+GAME_CURR_PAGE),_request=$.ajax({url:"/games-by-software/"+GAME_CURR_PAGE,data:{page:GAME_CURR_PAGE,software:e},dataType:"html",type:"post",success:function(e){setTimeout(function(){t.removeClass("loading"),refresh()},1e3),GAME_CURR_PAGE++,$(".games-list").append(e),$(t).data("total")===$(".games-list").children().length&&$(t).hide()},error:function(e){jQuery.parseJSON(e.responseJSON.body.message)[0];"abort"!=e.statusText&&console.log("err")},complete:function(){BUSY_REQUEST=!1}})}),$(".js-more-casinos").click(function(){$(this).addClass("loading");var t=$(this).data("key"),o=$(this);_request=$.ajax({url:"/casinos-by-software/"+determineCasinoPage(t),data:{page:determineCasinoPage(t),type:t,software:$(o).data("software")},dataType:"html",type:"post",success:function(e){setTimeout(function(){o.removeClass("loading"),refresh()},1e3),raiseCasinoPage(t),$(o).parent().prev().find(".list-body").append(e),$(o).data("total")===$(o).parent().prev().find(".list-body").children().length&&$(o).hide()},error:function(e){jQuery.parseJSON(e.responseJSON.body.message)[0];"abort"!=e.statusText&&console.log("err")},complete:function(){BUSY_REQUEST=!1}})}),$(".js-more-banking").click(function(){$(this).addClass("loading");var t=$(this);_request=$.ajax({url:"/casinos-by-banking/"+BEST_BANKING_PAGE,data:{page:BEST_BANKING_PAGE,banking:$(t).data("banking")},dataType:"html",type:"post",success:function(e){setTimeout(function(){t.removeClass("loading"),refresh()},1e3),BEST_BANKING_PAGE++,$(t).parent().prev().find(".list-body").append(e),$(t).data("total")===$(t).parent().prev().find(".list-body").children().length&&$(t).hide()},error:function(e){jQuery.parseJSON(e.responseJSON.body.message)[0];"abort"!=e.statusText&&console.log("err")},complete:function(){BUSY_REQUEST=!1}})}),$(".load-more").click(function(){new XMLHttpRequest;var e=$(this).data("category"),t=$(this);$.ajax({url:"/load-more/"+e+"/"+AJAX_CUR_PAGE,data:{page:AJAX_CUR_PAGE,category:e},dataType:"html",type:"post",success:function(e){AJAX_CUR_PAGE++,console.dir(e),$(".cards-list-wrapper").append(e),$(t).data("total")===$(".cards-list-wrapper").children().length&&$(t).hide()},error:function(e){jQuery.parseJSON(e.responseJSON.body.message)[0];"abort"!=e.statusText&&(console.log("err"),__this.closest(_obj).next(".action-field.not-valid").show())},complete:function(){BUSY_REQUEST=!1}})})}tooltipConfig={trigger:"click",maxWidth:279,animation:"grow",debug:!1},copyTooltipConfig={trigger:"click",maxWidth:260,minWidth:260,animation:"grow",contentAsHTML:!0,debug:!1,functionBefore:function(e,t){e.content('                <div class="centered">                    <i class="icon icon-icon_available"></i> Code copied to clipboard                </div>            ')}},contentTooltipConfig={trigger:"click",minWidth:460,interactive:!0,contentAsHTML:!0,debug:!1,content:$(".loader"),animation:"fade",contentCloning:!1,functionReady:function(){$("body").addClass("shadow"),checkStringLength($(".bonus-box"),15),$(".js-tooltip").tooltipster(tooltipConfig)},functionAfter:function(){$("body").removeClass("shadow")},functionBefore:function(t,e){var o=$(e.origin);if(!0!==o.data("loaded")){var n=o.data("name"),a=o.data("is-free"),s=new XMLHttpRequest;s.abort(),s=$.ajax({url:"/casino/bonus",data:{casino:n,is_free:a},dataType:"html",type:"GET",success:function(e){t.content(e),setTimeout(function(){i()},50),o.data("loaded",!0)}})}else setTimeout(function(){i()},50);function i(){$(".js-tooltip").tooltipster(tooltipConfig),$(".js-copy-tooltip").tooltipster(copyTooltipConfig),copyToClipboard(),checkStringLength($(".bonus-box"),15)}}};var Filters=function(e){var i,t,o=e,n=this,a=o.find("input[type=checkbox]"),s=o.find("input[type=radio]"),r=o.find("select[name=soft]"),c=$(".data-container"),l=$(".data-add-container"),d=c.data("type"),u=c.data("type-value"),f=$(".empty-filters"),p=o.next(".data-container-holder").find(".holder"),h=$("#default"),m=new XMLHttpRequest;void 0===d&&(d="game_type");var g=o.data("url");if(h.prop("checked",!0),"/games-filter/"===g){var v=new MutationObserver(function(e){var t=0;e.forEach(function(e){"childList"===e.type&&0!==e.addedNodes.length&&t<1&&(initImageLazyLoad(),t++)})});v.observe($(".data-container").get(0),{childList:!0,subtree:!0}),v.observe($(".data-add-container").get(0),{childList:!0,subtree:!0})}var b=function(e,t,o){var n={};return $.each(a,function(e,t){$(t).is(":checked")&&(n[$(t).attr("name")]=1),"reset"==o&&(n[$(t).attr("name")]="",$(t).prop("checked",!1))}),$.each(s,function(e,t){$(t).is(":checked")&&(n[$(t).attr("name")]=$(t).attr("value")),"reset"==o&&(n[$(t).attr("name")]=1,0==e&&$(t).prop("checked",!0))}),n[e]=t,"undefined"!=r.val()&&null!=r.val()&&(n.software=r.val().join(),"reset"==o&&(n.software="")),"undefined"==typeof AJAX_CUR_PAGE&&(AJAX_CUR_PAGE=1),"add"==o&&"reset"!=o||(AJAX_CUR_PAGE=0),null!=n.label&&"Mobile"==n.label&&(n.compatibility="mobile",delete n.label),n};_ajaxRequestCasinos=function(e,a){if("add"==a?i.addClass("loading"):$(".overlay, .loader").fadeIn("fast"),!BUSY_REQUEST){BUSY_REQUEST=!0,m.abort();var s="/games-filter/"==g?24:100;"/casinos"===location.pathname&&(g="load-all-casinos/"),m=$.ajax({url:g+AJAX_CUR_PAGE,data:e,dataType:"html",type:"GET",success:function(e){var t=$(e).find(".loaded-item"),o=$(e).filter("[data-load-total]").data("load-total"),n=$(".qty-items");"replace"==a?(c.html(e),l.html(""),n.attr("data-load-total",o),$(".qty-items-quantity").text(o),t.length===n.attr("data-load-total")?(0<t.length?(p.show(),f.hide()):(p.hide(),f.show()),i.hide()):(i.show(),p.show(),f.hide()),refresh(),AJAX_CUR_PAGE=1,0):(AJAX_CUR_PAGE++,0,setTimeout(function(){l.append(t),i.removeClass("loading"),refresh(),initImageLazyLoad(),t.length<s&&i.hide()},1e3)),_construct(),checkStringLength($(".data-add-container .bonus-box, .data-container .bonus-box"),21)},error:function(e){"abort"!=e.statusText&&console.log("err")},complete:function(){BUSY_REQUEST=!1,$(".overlay, .loader").fadeOut("fast"),"/casinos-filter/"===g?parseInt($(".qty-items").attr("data-load-total"))<=100?$(".js-more-items").hide():$(".js-more-items").show():"/games-filter/"===g&&(parseInt($(".qty-items-quantity").html())<=24?$(".js-more-items").hide():$(".js-more-items").show()),grayscaleIE(),initImageLazyLoad()}});var t=setTimeout(function(){},300);_hideLoading=function(){clearTimeout(t)}}},_loadData=function(e){},_construct=function(){i=$(".js-more-items"),t=$(".js-reset-items"),a.off(),a.on("click",function(){_ajaxRequestCasinos(b(d,u),"replace")}),s.off(),s.on("click",function(){_ajaxRequestCasinos(b(d,u),"replace")}),$(".js-filter > option").on("click",function(){$(".js-filter > option").each(function(e,t){$(this).prop("selected")})}),r.off(),r.on("change",function(){_ajaxRequestCasinos(b(d,u),"replace")}),i.off(),i.on("click",function(){return _ajaxRequestCasinos(b(d,u,"add"),"add"),!1}),t.off(),t.on("click",function(){return _ajaxRequestCasinos(b(d,u,"reset"),"add"),!1}),o[0].obj=n},_construct()},SearchPanel=function(e){var a,s,t=e,o=this,n=t.find(".js-trigger-search"),i=t.find("#search-all"),r=t.find("#search"),c=t.find("#search-form"),l=c.find("input"),d=c.find(".js-mobile-search-clear"),u=r.find("#search-casinos ul"),f=r.find("#search-lists ul"),p=r.find("#search-pages ul"),h=r.find("#search-empty"),v=!1,b=1,y=1,k=1,m=new XMLHttpRequest;window.contentBeforeSearch;var g=function(){i.parent().fadeIn(),i.closest(".header-search").addClass("search-active")},_=function(){i.parent().removeClass("search-active").fadeOut(),i.closest(".header-search").removeClass("search-active")},w=function(){$("#site-content").html("").append(contentBeforeSearch),$(".js-search-drop").show(),$("body").removeClass("advanced-search-opened"),l.blur(),setTimeout(function(){initSite()},1e3)},C=function(e,t,o,n){if(!BUSY_REQUEST){BUSY_REQUEST=!0,m.abort(),m=$.ajax({url:e,data:{value:t},dataType:"json",type:"GET",success:function(e){_hideLoading(),x(e,o,n)},error:function(e){"abort"!=e.statusText&&(_hideLoading(),console.log("err"),U())},complete:function(){_hideLoading(),BUSY_REQUEST=!1}});var a=setTimeout(function(){},300);_hideLoading=function(){clearTimeout(a)}}},T=function(){window.scrollTo(0,0);var g=$("#site-content");BUSY_REQUEST||(BUSY_REQUEST=!0,m.abort(),m=$.ajax({url:"/search/advanced",data:{value:l.val()},dataType:"HTML",type:"GET",success:function(e){var t,o,n,a,s,i,r,c,l,d,u,f,p,h,m;$("body").addClass("advanced-search-opened"),_(),v||(contentBeforeSearch=$("#site-content .main, #site-content .promo").detach()),v=!0,g.html(e),M(),t=$("#js-search-more-lists"),o=$(".more-lists",t),n=o.data("total-casinos"),a=$("#js-search-more-casinos"),s=$(".more-num",a),i=s.data("total-casinos"),r=$("#js-search-more-pages"),c=$(".more-num",r),l=c.data("total-games"),d=Math.floor(n/5),u=Math.floor(i/5),f=Math.floor(l/5),h=i%5,m=l%5,(p=n%5)<5&&1==d&&o.text(p),h<5&&1==u&&s.text(h),m<5&&1==f&&c.text(m),t.on("click",function(){return C("/search/more-lists/"+y,$(".search-title span").text(),$("#all-lists-container"),"lists"),d<=y?t.fadeOut():t.fadeIn(),d-1<=y&&0<p&&o.text(p),y++,!1}),a.on("click",function(){return C("/search/more-casinos/"+b,$(".search-title span").text(),$("#all-casinos-container"),"casinos"),u<=b?a.fadeOut():a.fadeIn(),u-1<=b&&0<h&&s.text(h),b++,!1}),r.on("click",function(){return C("/search/more-games/"+k,$(".search-title span").text(),$("#all-games-container"),"games"),f<=k?r.fadeOut():r.fadeIn(),f-1<=k&&0<m&&c.text(m),k++,!1}),unlockScreen(),g.find("#js-search-back").each(function(){$(this).on({click:function(){w()}})}),$(".js-mobile-search-close").on("click",function(){w()})},error:function(e){"abort"!=e.statusText&&console.log("err")},complete:function(){BUSY_REQUEST=!1}}))},E=function(e,t){if(checkIfIsMobileDevice()&&lockScreen(),!BUSY_REQUEST||s!=a){var o=l.val();o=o.replace(".","&middot;"),BUSY_REQUEST=!0,m.abort(),m=$.ajax({url:e,data:{value:o,page:t},dataType:"json",type:"GET",success:function(e){_hideLoading(),R(e)},error:function(e){"abort"!=e.statusText&&(_hideLoading(),console.log("err"),U())},complete:function(e){_hideLoading(),s++,BUSY_REQUEST=!1}});var n=setTimeout(function(){},300);_hideLoading=function(){clearTimeout(n)}}},S=function(e){return e.replace(/\s/g,"-").toLowerCase()},j=function(e){return'<li>                    <a class="search-results-label" href="/'+e.link.replace("/games/","")+'">                        '+e.name+"                    </a>                </li>"},x=function(e,t,o){var n,a=e.body.results;if("lists"===o)for(var s=0;s<a.length;s++){var i=j({link:a[s].url,name:a[s].title});t.append(i)}else for(var r in a){"games"==o?n="play/"+S(a[r]):"casinos"==o&&(n="reviews/"+S(a[r])+"-review");i=j({link:n,name:a[r]});t.append(i)}},R=function(e){var t=e.body.lists,o=e.body.casinos,n=e.body.games;if(f.empty(),u.empty(),p.empty(),$.isEmptyObject(t)&&$.isEmptyObject(o)&&$.isEmptyObject(n))U();else{L(),$.isEmptyObject(t)?f.parent().hide().next().addClass("single"):(f.parent().show().next().removeClass("single"),3<e.body.total_lists&&Math.ceil(e.body.total_lists/3)>y||(y=1)),$.isEmptyObject(o)?u.parent().hide().next().addClass("single"):(u.parent().show().next().removeClass("single"),3<e.body.total_casinos&&Math.ceil(e.body.total_casinos/3)>b||(b=1)),$.isEmptyObject(n)?p.parent().hide().prev().addClass("single"):(p.parent().show().prev().removeClass("single"),3<e.body.total_pages&&Math.ceil(e.body.total_casinos/3)>k||(k=1)),f.html("");for(var a=0;a<t.length;a++){var s=j({link:t[a].url,name:t[a].title});f.append(s)}for(var i in o){s=j({link:"reviews/"+S(o[i])+"-review",name:o[i]});u.append(s)}for(var r in n){s=j({link:"play/"+S(n[r]),name:n[r]});p.append(s)}""!=l.val()&&B()}},A=function(){b=k=1},U=function(){f.parent().hide(),u.parent().hide(),p.parent().hide(),h.show(),_()},L=function(){f.parent().show(),u.parent().show(),p.parent().show(),h.hide()},M=function(){searchDropClose($(".js-search-drop")),!0},P=function(){M()},B=function(){t.find(".search-results-label").each(function(){$(this).html(function(e,t){return t.replace(new RegExp(l.val().toLowerCase(),"ig"),"<b>$&</b>")})})};o.close=function(){P()},n.on("click",function(){console.log("asdad")}),l.on({focus:function(){s=a=0,E("/search"),A()},keyup:function(e){27==e.keyCode?P():13==e.keyCode?(isSearchResultEvent=!0,""!=l.val()&&(T(),l.blur())):(isSearchResultEvent=!1,t.find("#search__popup").addClass("load"),a++,E("/search")),A(),""!=l.val()?g():_()}}),d.on("click",function(){return l.val("").focus(),E("/search"),A(),!1}),i.on("click",function(){return""!=l.val()&&T(),!1}),t[0].obj=o},initSite=function(){copyToClipboard(),checkStringLength($(".list .bonus-box"),21),checkStringLength($(".bonus-item .bonus-box"),33),grayscaleIE(),initMobileMenu(),$(".message .close").on("click",function(e){$(this).parent().fadeOut(),e.preventDefault()}),$(".js-history-back").on("click",function(e){window.history.back(),e.preventDefault()})};