initReviewForm(),initReplies(),initTexfieldsLabels(),showMoreReviews(),getWebName=function(e){return e.replace(/\s/g,"-").toLowerCase()};var Score=function(e){var i=e,a=i.name,t=i.value,s=new XMLHttpRequest;(function(e,i){BUSY_REQUEST||(BUSY_REQUEST=!0,s.abort(),s=$.ajax({url:"/casino/rate",data:{name:e,value:i},dataType:"json",type:"post",success:function(e){"Casino already rated!"==e.body.success&&($(".icon-icon_available").toggleClass("icon-icon_unavailable"),$(".icon-icon_unavailable").removeClass("icon-icon_available"),$(".thanx").html(e.body.success)),$(".rating-container").next(".action-field").show()},error:function(e){"abort"!=e.statusText&&console.log("err")},complete:function(){BUSY_REQUEST=!1}}))})(a,t)};function AddingReview(e){var a,t,s,r,n,d,o,l,v,c,p,f,u,m,i=this.obj=e,w=$("#reviews-form").data("img-dir"),h=$("#reviews-form").data("country"),g=i.find("input[name=submit]"),x=$(".reviews-qty"),b="not-valid",_=$(".reviews-form").data("casino-id"),y=localStorage.getItem("casino_"+_+"_reviewed"),E=localStorage.getItem("casino_"+_+"_score"),R=new XMLHttpRequest;_prepReview=function(e){var i=e;return t=i.find("input[name=name]"),s=i.find("input[name=email]"),r=i.find("textarea[name=body]"),n=i.find(".field-error-required"),d=i.find(".field-error-rate"),_contact_error=i.find(".field-error"),l=t.val(),v=s.val(),c=r.val(),casino_name=$(".rating-container").data("casino-name"),u=$(".rating-current-value span").text(),ok=!(a=0),null!=i.data("id")?(a=i.data("id"),p=!0,0<i.next().find(".reply-data-holder").length?(o=i.next().find(".reply-data-holder"),f=!1):(f=!0,a=i.closest(".reply").prev().data("id"),_setReviewerName(i),o=i.closest(".reply-data-holder")),m=i.find(".js-reply-btn span")):(p=!1,o=$("#review-data-holder")),""===l?(t.parent().addClass(b),ok=!1):t.parent().removeClass(b),""!==v&&/^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i.test(v)?s.parent().removeClass(b):(s.parent().addClass(b),ok=!1),""===c?(r.parent().addClass(b),ok=!1):r.parent().removeClass(b),ok?(_contact_error.hide(),n.hide()):n.show(),p||("0"===u?(d.show(),i.find($(".rating-container")).addClass(b),ok=!1):(d.hide(),i.find($(".rating-container")).removeClass(b))),ok},_setReviewerName=function(e){var i=e.find(".review-name").text();c="<strong>@"+i+"</strong> "+r.val().substr(i.length+1)},_changeName=function(){$("#reviews-form input[name=name]").on("keyup",function(){$("#reviews-form .review-name").text($(this).val())})},_prepAjaxData=function(e){var i={casino:casino_name,name:l,email:v,body:c,parent:a,casino_id:$(".reviews-form").attr("data-casino-id")};_sendReview(i,e)},_sendReview=function(e,i){BUSY_REQUEST||(BUSY_REQUEST=!0,R.abort(),R=$.ajax({url:"/casino/review-write",data:e,dataType:"json",timeout:2e4,type:"POST",success:function(e){_loadData(e,i),t.val(""),s.val(""),r.val("").addClass("expanding"),_onEvents(),$(".form .js-expanding-textfields").slideUp()},error:function(e){_errors_found=$.parseJSON(e.responseText),console.error("Could not send message!"),console.log(_errors_found.body.message)},complete:function(){BUSY_REQUEST=!1}}))},_showEmptyMessage=function(){_searchListsContainer.parent().hide(),_searchCasinosContainer.parent().hide(),_searchPagesContainer.parent().hide(),_searchEmptyContainer.show(),_searchAllButton.parent().fadeOut()},_loadData=function(e,i){if($.isEmptyObject(e))_showEmptyMessage();else{function a(){return p?'                        <div class="review review-child '+l.toLowerCase()+'" data-id="'+e.body.id+'" data-img-dir="'+w+'">                            <div class="review-wrap">                                <div class="review-info">                                    <div class="review-info-top">                                        <div class="review-flag">                                            <img src="'+w+'" alt="'+h+'" width="15" height="12">                                        </div>                                        <div class="review-info-body">                                            <div class="review-name">'+l+'</div>                                            <div class="review-date">'+_getCurrDate()+'</div>                                        </div>                                    </div>                                </div>                                <div class="review-body">                                    <div class="review-text">                                        <p>'+c+'</p>                                    </div>                                    <div class="review-underline">                                        <a href="#" class="review-replies js-reply-btn">Reply</a>                                        <div class="votes js-vote">                                            <a href="#" class="votes-like vote-button" data-id="'+e.body.id+'">                                                <i class="icon-icon_likes"></i>                                                <span class="bubble bubble-vote">0</span>                                            </a>                                        </div>                                    </div>                                    <div class="review-form">                                        <div class="form">                                            <div class="form-row">                                                <div class="textfield-holder">                                                    <textarea rows="5" class="expanding textfield" name="body" placeholder="Write your review..."></textarea>                                                </div>                                            </div>                                            <div class="hidden js-expanding-textfields">                                                <div class="form-row form-multicol">                                                    <div class="form-col">                                                        <div class="textfield-holder error">                                                            <input type="text" name="name" class="textfield" placeholder="Name">                                                        </div>                                                    </div>                                                    <div class="form-col">                                                        <div class="textfield-holder error">                                                            <input type="text" name="email" class="textfield" placeholder="Email (it won\'t be published)">                                                        </div>                                                    </div>                                                </div>                                                <div class="form-row">                                                    <div class="review-submit-holder">                                                        <input class="btn" name="submit" type="submit" value="ADD YOUR REPLY">                                                        <div>                                                            <div class="field-error-required not-valid action-field">                                                                Please fill in the required fields.                                                            </div>                                                            <div class="field-success success action-field">                                                                Thank You!                                                            </div>                                                        </div>                                                    </div>                                                </div>                                            </div>                                        </div>                                    </div>                                </div>                            </div>                        </div>                        ':'                        <div class="review review-parent '+l.toLowerCase()+'" data-id="'+e.body.id+'">                            <div class="review-wrap">                                <div class="review-info">                                    <div class="review-info-top">                                        <div class="review-flag">                                            <img src="'+w+'" alt="'+h+'" width="15" height="12">                                        </div>                                        <div class="review-info-body">                                            <div class="review-name">'+l+'</div>                                            <div class="review-date">'+_getCurrDate()+'</div>                                        </div>                                    </div>                                    <div class="list-rating '+getWebName(get_rating(u))+'">                                        <div class="list-rating-wrap">                                            <div class="list-rating-score">'+u+'</div>                                            <div class="list-rating-text">'+get_rating(u)+'</div>                                        </div>                                    </div>                                </div>                                <div class="review-body">                                    <div class="review-text">                                        <p>'+c+'</p>                                    </div>                                    <div class="review-underline">                                        <a href="#" class="review-replies js-reply-btn">Reply</a>                                        <div class="votes js-vote">                                            <a href="#" class="votes-like vote-button"  data-id="'+e.body.id+'">                                                <i class="icon-icon_likes"></i>                                                <span class="bubble bubble-vote">0</span>                                            </a>                                        </div>                                    </div>                                    <div class="review-form">                                        <div class="form">                                            <div class="form-row">                                                <div class="textfield-holder">                                                    <textarea rows="5" class="expanding textfield" name="body" placeholder="Write your review..."></textarea>                                                </div>                                            </div>                                            <div class="hidden js-expanding-textfields">                                                <div class="form-row form-multicol">                                                    <div class="form-col">                                                        <div class="textfield-holder error">                                                            <input type="text" name="name" class="textfield" placeholder="Name">                                                        </div>                                                    </div>                                                    <div class="form-col">                                                        <div class="textfield-holder error">                                                            <input type="text" name="email" class="textfield" placeholder="Email (it won\'t be published)">                                                        </div>                                                    </div>                                                </div>                                                <div class="form-row">                                                    <div class="review-submit-holder">                                                        <input class="btn" name="submit" type="submit" value="ADD YOUR REPLY">                                                        <div>                                                            <div class="field-error-required not-valid action-field">                                                                Please fill in the required fields.                                                            </div>                                                            <div class="field-success success action-field">                                                                Thank You!                                                            </div>                                                        </div>                                                    </div>                                                </div>                                            </div>                                        </div>                                    </div>                                </div>                            </div>                        </div>                        <div class="reply review">                            <div class="reply-data-holder"></div>                        </div>                        '}f?$(a()).insertAfter(i):o.prepend(a()),_refreshData()}},_refreshData=function(){p||(x.text(parseInt(x.text())+1),localStorage.setItem("casino_"+_+"_reviewed",1),localStorage.setItem("casino_"+_+"_score",u)),p&&m.text(parseInt(m.text())+1),$(".review-form").slideUp(),initReviewForm(),initTexfieldsLabels(),new Vote($(".js-vote")),$(".review, .reply").each(function(){new AddingReview($(this))}),grayscaleIE()},_doIfReviewedAlready=function(){var e=$("#reviews-form");$(".review-rating",e).addClass("active"),$("textarea",e).addClass("disabled"),$(".rating-bar").barrating("set",E),$(".rating-current-value span").text(E),$("textarea[name=body]",e).attr("placeholder","You have already reviewed")},_initForms=function(){g.off(),g.on({click:function(e){!1===_prepReview(i)?e.stopPropagation():_prepAjaxData(i)}})},_onEvents=function(){y?(_doIfReviewedAlready(),_initForms()):(_initForms(),_changeName())},_onEvents()}function _getCurrDate(){var e=new Date;return e.getDate()+"."+(e.getMonth()+1)+"."+e.getFullYear()}function get_rating(e){return $string=8<e?"Excellent":6<e&&e<=8?"Very good":4<e&&e<=6?"Good":2<e&&e<=4?"Poor":"Terrible",$string}function initReviewForm(){var e=$(".expanding"),i=$(".js-expanding-textfields");$(".box img.not-accepted").length?e.unbind("mouseenter mouseleave mouseover click focus"):e.on("focus",function(){$(this).removeClass("expanding"),$(this).closest(".form").find(i).slideDown()})}function initTexfieldsLabels(){var e=$(".textfield");e.focus(function(){$(this).parent().addClass("active").removeClass("not-valid")}),e.blur(function(){""==$(this).val()&&$(this).parent().removeClass("active")})}function initReplies(){$("#reviews").on("click",".js-reply-btn",function(e){var i=$(this).closest(".reply.review");if(0<i.length&&0<i.find(".reply-data-holder").length){var a=$(this).parent().parent().parent().find(".review-name").text();$(this).parent().parent().find("textarea").val("@"+a+" ")}return $(this).parent().next().slideToggle(),!1})}function showMoreReviews(){var e=$(".js-more-reviews"),s=(e.data("reviews"),$("#review-data-holder")),r=$(".reply-data-holder"),i=$(".rating-container").data("casino-name"),n=new XMLHttpRequest;e.on("click",function(){return a($(this),$(this).data("type")),!1}),$(".not-accepted").length&&e.css("pointer-events","auto");var a=function(a,t){BUSY_REQUEST||(BUSY_REQUEST=!0,n.abort(),n=$.ajax({url:"/casino/more-reviews/"+getWebName(i)+"/"+a.data("page"),dataType:"HTML",data:{id:a.data("id"),type:t},type:"GET",success:function(e){"review"==t?(s.append(e),a.data("page")>=a.data("total")/5-1&&a.hide()):"reply"==t&&a.closest(".reply").find(r).append(e),a.data("page")>=a.data("total")/5-1&&a.hide();var i=a.data("page");a.data("page",++i),d(),showMoreReviews()},error:function(e){"abort"!=e.statusText&&console.log("err")},complete:function(){BUSY_REQUEST=!1}}))},d=function(){initReviewForm(),initTexfieldsLabels(),Vote($(".js-vote")),$(".review").each(function(){new AddingReview($(this))}),grayscaleIE()}}function grayscaleIE(){if(10<=getInternetExplorerVersion()){$("img.not-accepted").each(function(){var e=$(this);e.css({position:"absolute"}).wrap("<div class='img_wrapper' style='display: inline-block'>").clone().addClass("img_grayscale").css({position:"absolute","z-index":"5",opacity:"0"}).insertBefore(e).queue(function(){var e=$(this);e.parent().css({width:this.width,height:this.height}),e.dequeue()}),this.src=function(e){var i=document.createElement("canvas"),a=i.getContext("2d"),t=new Image;t.src=e,i.width=t.width,i.height=t.height,a.drawImage(t,0,0);for(var s=a.getImageData(0,0,i.width,i.height),r=0;r<s.height;r++)for(var n=0;n<s.width;n++){var d=4*r*s.width+4*n,o=(s.data[d]+s.data[1+d]+s.data[2+d])/3;s.data[d]=o,s.data[1+d]=o,s.data[2+d]=o}return a.putImageData(s,0,0,0,0,s.width,s.height),i.toDataURL()}(this.src)})}}function getInternetExplorerVersion(){var e=-1;if("Microsoft Internet Explorer"==navigator.appName){var i=navigator.userAgent;null!=new RegExp("MSIE ([0-9]{1,}[.0-9]{0,})").exec(i)&&(e=parseFloat(RegExp.$1))}else if("Netscape"==navigator.appName){i=navigator.userAgent;null!=new RegExp("Trident/.*rv:([0-9]{1,}[.0-9]{0,})").exec(i)&&(e=parseFloat(RegExp.$1))}return e}