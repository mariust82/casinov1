!function(e){"function"==typeof define&&define.amd?define(["public/build/js/compilations/jquery"],e):"object"==typeof exports?module.exports=e(require("public/build/js/compilations/jquery")):e(jQuery)}(function(h){"use strict";var a="readmore",i={speed:100,collapsedHeight:200,heightMargin:16,moreLink:'<a href="#">Read More</a>',lessLink:'<a href="#">Close</a>',embedCSS:!0,blockCSS:"display: block; width: 100%;",startOpen:!1,blockProcessed:function(){},beforeToggle:function(){},afterToggle:function(){}},n={},d=0;function l(e){var t=e.clone().css({height:"auto",width:e.width(),maxHeight:"none",overflow:"hidden"}).insertAfter(e),i=t.outerHeight(),o=parseInt(t.css({maxHeight:""}).css("max-height").replace(/[^-\d\.]/g,""),10),a=e.data("defaultHeight");t.remove();var n=o||e.data("collapsedHeight")||a;e.data({expandedHeight:i,maxHeight:o,collapsedHeight:n}).css({maxHeight:"none"})}var o,s,r,c,p=(o=function(){h("[data-readmore]").each(function(){var e=h(this),t="true"===e.attr("aria-expanded");l(e),e.css({height:e.data(t?"expandedHeight":"collapsedHeight")})})},s=100,function(){var e=this,t=arguments,i=r&&!c;clearTimeout(c),c=setTimeout(function(){c=null,r||o.apply(e,t)},s),i&&o.apply(e,t)});function g(e,t){this.element=e,this.options=h.extend({},i,t),function(e){if(!n[e.selector]){var t=" ";e.embedCSS&&""!==e.blockCSS&&(t+=e.selector+" + [data-readmore-toggle], "+e.selector+"[data-readmore]{"+e.blockCSS+"}"),t+=e.selector+"[data-readmore]{transition: height "+e.speed+"ms;overflow: hidden;}",i=document,o=t,(a=i.createElement("style")).type="text/css",a.styleSheet?a.styleSheet.cssText=o:a.appendChild(i.createTextNode(o)),i.getElementsByTagName("head")[0].appendChild(a),n[e.selector]=!0}var i,o,a}(this.options),this._defaults=i,this._name=a,this.init(),window.addEventListener?(window.addEventListener("load",p),window.addEventListener("resize",p)):(window.attachEvent("load",p),window.attachEvent("resize",p))}g.prototype={init:function(){var t=h(this.element);t.data({defaultHeight:this.options.collapsedHeight,heightMargin:this.options.heightMargin}),l(t);var e=t.data("collapsedHeight"),i=t.data("heightMargin");if(t.outerHeight(!0)<=e+i)return this.options.blockProcessed&&"function"==typeof this.options.blockProcessed&&this.options.blockProcessed(t,!1),!0;var o,a,n,s=t.attr("id")||(n=++d,String(null==a?"rmjs-":a)+n),r=this.options.startOpen?this.options.lessLink:this.options.moreLink;t.attr({"data-readmore":"","aria-expanded":this.options.startOpen,id:s}),t.after(h(r).on("click",(o=this,function(e){o.toggle(this,t[0],e)})).attr({"data-readmore-toggle":s,"aria-controls":s})),this.options.startOpen||t.css({height:e}),this.options.blockProcessed&&"function"==typeof this.options.blockProcessed&&this.options.blockProcessed(t,!0)},toggle:function(e,t,i){i&&i.preventDefault(),e=e||h('[aria-controls="'+this.element.id+'"]')[0],t=t||this.element;var o,a,n=h(t),s="",r="",d=!1,l=n.data("collapsedHeight");n.height()<=l?(s=n.data("expandedHeight")+"px",r="lessLink",d=!0):(s=l,r="moreLink"),this.options.beforeToggle&&"function"==typeof this.options.beforeToggle&&this.options.beforeToggle(e,n,!d),n.css({height:s}),n.on("transitionend",(o=this,function(){o.options.afterToggle&&"function"==typeof o.options.afterToggle&&o.options.afterToggle(e,n,d),h(this).attr({"aria-expanded":d}).off("transitionend")})),h(e).replaceWith(h(this.options[r]).on("click",(a=this,function(e){a.toggle(this,t,e)})).attr({"data-readmore-toggle":n.attr("id"),"aria-controls":n.attr("id")}))},destroy:function(){h(this.element).each(function(){var e=h(this);e.attr({"data-readmore":null,"aria-expanded":null}).css({maxHeight:"",height:""}).next("[data-readmore-toggle]").remove(),e.removeData()})}},h.fn.readmore=function(t){var i=arguments,o=this.selector;return"object"==typeof(t=t||{})?this.each(function(){if(h.data(this,"plugin_"+a)){var e=h.data(this,"plugin_"+a);e.destroy.apply(e)}t.selector=o,h.data(this,"plugin_"+a,new g(this,t))}):"string"==typeof t&&"_"!==t[0]&&"init"!==t?this.each(function(){var e=h.data(this,"plugin_"+a);e instanceof g&&"function"==typeof e[t]&&e[t].apply(e,Array.prototype.slice.call(i,1))}):void 0}});