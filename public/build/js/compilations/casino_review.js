initBarRating(),initReviewForm(),initReplies(),initTexfieldsLabels(),showMoreReviews(),initTableOpen(),initAddReview(),getWebName=function(e){return e.replace(/\s/g,"-").toLowerCase()};var Score=function(e){var t=e,a=t.name,n=t.value,i=new XMLHttpRequest;(function(e,t){BUSY_REQUEST||(BUSY_REQUEST=!0,i.abort(),i=$.ajax({url:"/casino/rate",data:{name:e,value:t},dataType:"json",type:"post",success:function(e){"Casino already rated!"==e.body.success&&($(".icon-icon_available").toggleClass("icon-icon_unavailable"),$(".icon-icon_unavailable").removeClass("icon-icon_available"),$(".thanx").html(e.body.success)),$(".rating-container").next(".action-field").show()},error:function(e){"abort"!=e.statusText&&console.log("err")},complete:function(){BUSY_REQUEST=!1}}))})(a,n)};function _getCurrDate(){var e=new Date,t=e.getDate(),a=e.getMonth()+1;return t<10&&(t="0"+t),a<10&&(a="0"+a),t+"."+a+"."+e.getFullYear()}function get_rating(e){return $string=8<e?"Excellent":6<e&&e<=8?"Very good":4<e&&e<=6?"Good":2<e&&e<=4?"Poor":"Terrible",$string}function AddingReview(e){var a,n,i,r,o,s,d,l,c,v,u,f,p,g,t=this.obj=e,m=$("#reviews-form").data("img-dir"),w=$("#reviews-form").data("country"),h=t.find("input[name=submit]"),_=$(".reviews-qty"),b="not-valid",x=$(".reviews-form").data("casino-id"),y=localStorage.getItem("casino_"+x+"_reviewed"),R=localStorage.getItem("casino_"+x+"_score"),C=new XMLHttpRequest;_prepReview=function(e){var t=e;return n=t.find("input[name=name]"),i=t.find("input[name=email]"),r=t.find("textarea[name=body]"),o=t.find(".field-error-required"),s=t.find(".field-error-rate"),_contact_error=t.find(".field-error"),l=n.val(),c=i.val(),v=r.val(),casino_name=$(".rating-container").data("casino-name"),p=$(".rating-current-value span").text(),a=0,ok=!0,null!=t.data("id")?(a=t.data("id"),console.log(a+"ttt"),u=!0,0<t.next().find(".reply-data-holder").length?(d=t.next().find(".reply-data-holder"),f=!1):(f=!0,a=t.closest(".reply").prev().data("id"),_setReviewerName(t),d=t.closest(".reply-data-holder")),g=t.find(".js-reply-btn span"),console.log(a+"t4")):(u=!1,d=$("#review-data-holder")),console.log(a+"t"),""===l?(n.parent().addClass(b),ok=!1):n.parent().removeClass(b),""!==c&&/^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i.test(c)?i.parent().removeClass(b):(i.parent().addClass(b),ok=!1),""===v?(r.parent().addClass(b),ok=!1):r.parent().removeClass(b),ok?(_contact_error.hide(),o.hide()):o.show(),u||("0"===p?(s.show(),t.find($(".rating-container")).addClass(b),ok=!1):(s.hide(),t.find($(".rating-container")).removeClass(b))),ok},_setReviewerName=function(e){var t=e.find(".review-name").text();v="<strong>@"+t+"</strong> "+r.val().substr(t.length+1)},_changeName=function(){$("#reviews-form input[name=name]").on("keyup",function(){$("#reviews-form .review-name").text($(this).val())})},_prepAjaxData=function(e){var t={casino:casino_name,name:l,email:c,body:v,parent:a,casino_id:$(".reviews-form").attr("data-casino-id")};_sendReview(t,e)},_sendReview=function(e,t){BUSY_REQUEST||(BUSY_REQUEST=!0,C.abort(),console.log(e),C=$.ajax({url:"/casino/review-write",data:e,dataType:"json",timeout:2e4,type:"POST",success:function(e){_loadData(e,t),n.val(""),i.val(""),r.val("").addClass("expanding"),_onEvents(),$(".form .js-expanding-textfields").slideUp()},error:function(e){_errors_found=$.parseJSON(e.responseText),console.error("Could not send message!"),console.log(_errors_found.body.message)},complete:function(){BUSY_REQUEST=!1}}))},_showEmptyMessage=function(){_searchListsContainer.parent().hide(),_searchCasinosContainer.parent().hide(),_searchPagesContainer.parent().hide(),_searchEmptyContainer.show(),_searchAllButton.parent().fadeOut()},_loadData=function(t,e){if($.isEmptyObject(t))_showEmptyMessage();else{function a(){var e=$(".review-element").clone();return n(e,u?"review-child":"review-parent",l,t.body.id,m,w,v)}function n(e,t,a,n,i,r,o){return $(e).removeClass("review-element"),$(e).removeClass("hidden"),$(e).removeAttr("hidden"),$(e).addClass(t),$(e).addClass(a.toLowerCase()),$(e).addClass("review-parent"),$(e).attr("data-id",n),$(e).find(".review-flag img").attr("src",i),$(e).find(".review-flag img").attr("alt",r),$(e).find(".review-name").text(a),$(e).find(".review-date").text(_getCurrDate()),$(e).find(".review-text").html(o),e.find(".js-vote .votes-like").attr("data-id",n),"review-parent"===t?($(e).find(".list-rating").addClass(getWebName(get_rating(p))),$(e).find(".list-rating-score").text(p),$(e).find(".list-rating-text").text(getWebName(get_rating(p)))):($(e).find(".list-rating").remove(),$(e).attr("data-img-dir",m)),e}f?$(a()).insertAfter(e):(d.prepend($(".to-clone").clone()),d.prepend(a())),_refreshData()}},_refreshData=function(){u||(_.text(parseInt(_.text())+1),localStorage.setItem("casino_"+x+"_reviewed",1),localStorage.setItem("casino_"+x+"_score",p)),u&&g.text(parseInt(g.text())+1),$(".review-form").slideUp(),initReviewForm(),initTexfieldsLabels(),new Vote($(".js-vote")),$(".review, .reply").each(function(){new AddingReview($(this))}),grayscaleIE()},_doIfReviewedAlready=function(){var e=$("#reviews-form");$(".review-rating",e).addClass("active"),$("textarea",e).addClass("disabled"),$(".rating-bar").barrating("set",R),$(".rating-current-value span").text(R),$("textarea[name=body]",e).attr("placeholder","You have already reviewed")},_initForms=function(){h.off(),h.on({click:function(e){!1===_prepReview(t)?e.stopPropagation():_prepAjaxData(t)}})},_onEvents=function(){y?(_doIfReviewedAlready(),_initForms()):(_initForms(),_changeName())},_onEvents()}function showMoreReviews(){var e=$(".js-more-reviews"),i=(e.data("reviews"),$("#review-data-holder")),r=$(".reply-data-holder"),t=$(".rating-container").data("casino-name"),o=new XMLHttpRequest;e.on("click",function(){return a($(this),$(this).data("type")),!1}),$(".not-accepted").length&&e.css("pointer-events","auto");var a=function(a,n){BUSY_REQUEST||(BUSY_REQUEST=!0,o.abort(),o=$.ajax({url:"/casino/more-reviews/"+getWebName(t)+"/"+a.data("page"),dataType:"HTML",data:{id:a.data("id"),type:n},type:"GET",success:function(e){"review"==n?(i.append(e),a.data("page")>=a.data("total")/5-1&&a.hide()):"reply"==n&&a.closest(".reply").find(r).append(e),a.data("page")>=a.data("total")/5-1&&a.hide();var t=a.data("page");a.data("page",++t),s(),showMoreReviews()},error:function(e){"abort"!=e.statusText&&console.log("err")},complete:function(){BUSY_REQUEST=!1}}))},s=function(){initReviewForm(),initTexfieldsLabels(),Vote($(".js-vote")),$(".review").each(function(){new AddingReview($(this))}),grayscaleIE()}}function initReviewForm(){var e=$(".expanding"),t=$(".js-expanding-textfields");$(".box img.not-accepted").length?e.unbind("mouseenter mouseleave mouseover click focus"):e.on("focus",function(){$(this).removeClass("expanding"),$(this).closest(".form").find(t).slideDown()})}function initTexfieldsLabels(){var e=$(".textfield");e.focus(function(){$(this).parent().addClass("active").removeClass("not-valid")}),e.blur(function(){""==$(this).val()&&$(this).parent().removeClass("active")})}function initReplies(){$("#reviews").on("click",".js-reply-btn",function(e){var t=$(this).closest(".reply.review");if(0<t.length&&0<t.find(".reply-data-holder").length){var a=$(this).parent().parent().parent().find(".review-name").text();$(this).parent().parent().find("textarea").val("@"+a+" ")}return $(this).parent().next().slideToggle(),!1})}function initBarRating(){var i=$(".rating-container"),r=i.attr("data-user-rate"),e={showSelectedRating:!1,onSelect:function(e,t,a){if(void 0!==a){var n=$(a.currentTarget);$(".br-widget").children().each(function(){$(this).unbind("mouseenter mouseleave mouseover click"),parseInt($(this).data("rating-value"))<=parseInt(r)&&$(this).addClass("br-active")}),$(".br-widget").unbind("mouseenter mouseleave mouseover click"),n.closest(i).find(".rating-current-text").text(t).removeClass("terrible poor good very-good excellent").attr("class","rating-current-text "+getWebName(t)),n.closest(i).find(".rating-current-value span").text(e),n.closest(i).find(".rating-current").attr("data-rating-current",e),new Score({value:e,name:i.data("casino-name")})}}};$().barrating&&$(".rating-bar",i).barrating("show",e)}function initTableOpen(){$(".js-table-package-opener").on("click",function(e){$(this).closest("tr").toggleClass("active"),e.preventDefault()})}function initScrollTo(e,t){void 0!==e?a(e,t):$(".js-scroll").on("click",function(e){a($($(this).attr("href")),0),e.preventDefault()});function a(e,t){$("html, body").animate({scrollTop:e.offset().top-t},1e3)}}function initAddReview(){$(".review").each(function(){new AddingReview($(this))})}