(()=>{"use strict";class e{constructor(e){this.$header=e,this.$mainMenu=this.$header.find(".main-menu"),this.$menuIcon=this.$header.find(".menu-icon"),this.$mainMenu.find(".menu-item-has-children").append('<div class="menu-arrow"></div>'),this.$menuArrow=this.$mainMenu.find(".menu-arrow"),this.initMenu()}initSticky(){jQuery("body").hasClass("page-template-checkout")||jQuery("body").hasClass("page-template-pricing")||jQuery("body").hasClass("page-template-pricing-2")||window.addEventListener("scroll",(()=>this.makeSticky()))}makeSticky(){window.pageYOffset>0?this.$header.addClass("header--sticky"):this.$header.removeClass("header--sticky")}initMenu(){this.$menuArrow.on("click",(e=>{jQuery(e.target).toggleClass("menu-arrow--open"),jQuery(e.target).siblings(".sub-menu").toggleClass("sub-menu--open")})),this.$menuIcon.on("click",(()=>{this.$menuIcon.toggleClass("menu-icon--open"),this.$mainMenu.toggleClass("main-menu--open")}))}}class t{constructor(e){this.$promotionSection=e,this.initSticky()}initSticky(){jQuery("body").hasClass("page-template-pricing")&&window.addEventListener("scroll",(()=>this.makeSticky()))}makeSticky(){window.pageYOffset>0?this.$promotionSection.addClass("promotion-section--sticky"):this.$promotionSection.removeClass("promotion-section--sticky")}}class n{constructor(e,t,n){this.id=e,this.$modal=t,this.$trigger=n,this.$trigger.on("click",(e=>this.openModal(e))),this.$modal.find(".modal__overlay, .modal__close").on("click",(e=>this.closeModal(e)))}openModal(e){e.preventDefault(),this.$modal.addClass("modal--open"),jQuery("body").addClass("modal--open"),document.dispatchEvent(new Event(this.id+"-opened"))}closeModal(e){e.preventDefault(),this.$modal.removeClass("modal--open"),jQuery("body").removeClass("modal--open"),document.dispatchEvent(new Event(this.id+"-closed"))}}class o{constructor(e){document.addEventListener("modal-2-opened",(e=>this.onModalVideoOpen(e))),document.addEventListener("modal-2-closed",(e=>this.onModalVideoClosed(e)))}onModalVideoOpen(e){e.preventDefault(),jQuery(".modal--video iframe").attr("src","https://www.youtube.com/embed/NxrTXQNExh4?feature=oembed&autoplay=1")}onModalVideoClosed(e){e.preventDefault(),jQuery(".modal--video iframe").attr("src","")}}class i{constructor(e){this.$accordion=e,this.$accordionTitle=this.$accordion.children(".accordion__title"),this.$accordionContent=this.$accordion.children(".accordion__content"),this.$accordionTitle.on("click",(e=>this.onAccordionClick(e)))}onAccordionClick(e){e.preventDefault(),this.$accordionContent.slideToggle(300,"swing",(()=>{this.$accordion.toggleClass("accordion--opened")}))}}class s{constructor(e){this.$searchInput=e.find("input"),this.$searchResults=e.find(".doc-search__results"),this.nonce=this.$searchInput.attr("data-nonce"),this.postType=this.$searchInput.attr("data-post-type"),this.postCategory=this.$searchInput.attr("data-post-category"),this.$searchInput.on("keyup",(e=>this.onKeyUp(e)))}onKeyUp(e){e.preventDefault();let t=this.$searchInput.val();clearTimeout(this.timeout),t.length<=3?this.$searchResults.hide().html(""):(this.$searchResults.show().html('<p class="mb-0">Searching for articles: <strong>'+t+"</strong></p>"),this.timeout=setTimeout((()=>this.makeAjaxCall()),500))}makeAjaxCall(){jQuery.ajax({type:"POST",data:{action:"modula_search_articles",nonce:this.nonce,post_type:this.postType,post_category:this.postCategory,s:this.$searchInput.val()},url:modula.ajaxurl,success:e=>{this.$searchResults.show().html(e)}})}}const a="transitionend";const r={TRANSITION_END:"bsTransitionEnd",getUID(e){do{e+=~~(1e6*Math.random())}while(document.getElementById(e));return e},getSelectorFromElement(e){let t=e.getAttribute("data-target");if(!t||"#"===t){const n=e.getAttribute("href");t=n&&"#"!==n?n.trim():""}try{return document.querySelector(t)?t:null}catch(e){return null}},getTransitionDurationFromElement(e){if(!e)return 0;let t=jQuery(e).css("transition-duration"),n=jQuery(e).css("transition-delay");const o=parseFloat(t),i=parseFloat(n);return o||i?(t=t.split(",")[0],n=n.split(",")[0],1e3*(parseFloat(t)+parseFloat(n))):0},reflow:e=>e.offsetHeight,triggerTransitionEnd(e){jQuery(e).trigger(a)},supportsTransitionEnd:()=>Boolean(a),isElement:e=>(e[0]||e).nodeType,typeCheckConfig(e,t,n){for(const i in n)if(Object.prototype.hasOwnProperty.call(n,i)){const s=n[i],a=t[i],l=a&&r.isElement(a)?"element":(o=a,{}.toString.call(o).match(/\s([a-z]+)/i)[1].toLowerCase());if(!new RegExp(s).test(l))throw new Error(`${e.toUpperCase()}: Option "${i}" provided type "${l}" but expected type "${s}".`)}var o},findShadowRoot(e){if(!document.documentElement.attachShadow)return null;if("function"==typeof e.getRootNode){const t=e.getRootNode();return t instanceof ShadowRoot?t:null}return e instanceof ShadowRoot?e:e.parentNode?r.findShadowRoot(e.parentNode):null}};jQuery.fn.emulateTransitionEnd=function(e){let t=!1;return jQuery(this).one(r.TRANSITION_END,(()=>{t=!0})),setTimeout((()=>{t||r.triggerTransitionEnd(this)}),e),this},jQuery.event.special[r.TRANSITION_END]={bindType:a,delegateType:a,handle(e){if(jQuery(e.target).is(this))return e.handleObj.handler.apply(this,arguments)}};const l="bs.tab",c=jQuery.fn.tab,d="hide.bs.tab",u="hidden.bs.tab",h="show.bs.tab",p="shown.bs.tab",m="click.bs.tab.data-api",y="active",g="fade",f="show",j=".active",Q="li > .active";class v{constructor(e){this._element=e}static get VERSION(){return"4.3.1"}show(){if(this._element.parentNode&&this._element.parentNode.nodeType===Node.ELEMENT_NODE&&jQuery(this._element).hasClass(y)||jQuery(this._element).hasClass("disabled"))return;let e,t;const n=jQuery(this._element).closest(".nav, .list-group")[0],o=r.getSelectorFromElement(this._element);if(n){const e="UL"===n.nodeName||"OL"===n.nodeName?Q:j;t=jQuery.makeArray(jQuery(n).find(e)),t=t[t.length-1]}const i=jQuery.Event(d,{relatedTarget:this._element}),s=jQuery.Event(h,{relatedTarget:t});if(t&&jQuery(t).trigger(i),jQuery(this._element).trigger(s),s.isDefaultPrevented()||i.isDefaultPrevented())return;o&&(e=document.querySelector(o)),this._activate(this._element,n);const a=()=>{const e=jQuery.Event(u,{relatedTarget:this._element}),n=jQuery.Event(p,{relatedTarget:t});jQuery(t).trigger(e),jQuery(this._element).trigger(n)};e?this._activate(e,e.parentNode,a):a()}dispose(){jQuery.removeData(this._element,l),this._element=null}_activate(e,t,n){const o=(!t||"UL"!==t.nodeName&&"OL"!==t.nodeName?jQuery(t).children(j):jQuery(t).find(Q))[0],i=n&&o&&jQuery(o).hasClass(g),s=()=>this._transitionComplete(e,o,n);if(o&&i){const e=r.getTransitionDurationFromElement(o);jQuery(o).removeClass(f).one(r.TRANSITION_END,s).emulateTransitionEnd(e)}else s()}_transitionComplete(e,t,n){if(t){jQuery(t).removeClass(y);const e=jQuery(t.parentNode).find("> .dropdown-menu .active")[0];e&&jQuery(e).removeClass(y),"tab"===t.getAttribute("role")&&t.setAttribute("aria-selected",!1)}if(jQuery(e).addClass(y),"tab"===e.getAttribute("role")&&e.setAttribute("aria-selected",!0),r.reflow(e),e.classList.contains(g)&&e.classList.add(f),e.parentNode&&jQuery(e.parentNode).hasClass("dropdown-menu")){const t=jQuery(e).closest(".dropdown")[0];if(t){const e=[].slice.call(t.querySelectorAll(".dropdown-toggle"));jQuery(e).addClass(y)}e.setAttribute("aria-expanded",!0)}n&&n()}static _jQueryInterface(e){return this.each((function(){const t=jQuery(this);let n=t.data(l);if(n||(n=new v(this),t.data(l,n)),"string"==typeof e){if(void 0===n[e])throw new TypeError(`No method named "${e}"`);n[e]()}}))}}jQuery(document).on(m,'[data-toggle="tab"], [data-toggle="pill"], [data-toggle="list"]',(function(e){e.preventDefault(),v._jQueryInterface.call(jQuery(this),"show")})),jQuery.fn.tab=v._jQueryInterface,jQuery.fn.tab.Constructor=v,jQuery.fn.tab.noConflict=()=>(jQuery.fn.tab=c,v._jQueryInterface),window.Modula=new class{constructor(){this.initHeader(),this.initScrollAnimation(),this.initModals(),this.initAccordions(),this.initDocSearch(),this.initEvents(),this.initWaypoints(),this.initPromotionSection(),this.initCurrency(),this.initPostNavigation(),this.initCheckoutPage()}initHeader(){new e(jQuery(".header"))}initPromotionSection(){new t(jQuery(".promotion-section"))}initScrollAnimation(){jQuery('a[href*="#"]:not([href="#"])').on("click",(function(e){let t;location.pathname.replace(/^\//,"")===this.pathname.replace(/^\//,"")&&location.hostname===this.hostname&&(t=jQuery(this.hash),t=t.length?t:jQuery("[name="+this.hash.slice(1)+"]"),t.length&&(e.preventDefault(),jQuery("html, body").animate({scrollTop:t.offset().top},1e3,"swing")))}))}initModals(){new n("modal-1",jQuery(".modal--login"),jQuery(".login-link")),new n("modal-2",jQuery(".modal--video"),jQuery(".banner-section .hero__img, .banner-section .hero__play-icon, .hero-section-2__hero")),jQuery(".changelog-link").each((function(){var e=jQuery(this).attr("data-count");new n("modal-changelog-"+e,jQuery("#modal--changelog-"+e),jQuery("#changelog-link-"+e))}))}initAccordions(e=jQuery(".accordion")){e.each((function(e){new i(jQuery(this))}))}initDocSearch(e=jQuery(".doc-search")){e.each((function(){new s(jQuery(this))}))}initEvents(){new o}initWaypoints(){"undefined"!=typeof Waypoint&&(jQuery(".illustration").each((function(){let e=jQuery(this);new Waypoint({element:e,offset:"36%",handler:function(t){e.addClass("illustration--animate")}})})),jQuery(".waypoint").each((function(){let e=jQuery(this);new Waypoint({element:e,offset:"75%",handler:function(t){e.addClass("in-viewport")}})})))}initPostNavigation(){if("undefined"==typeof Waypoint)return;if(0==jQuery(".post-navigation").length)return;let e=jQuery(".post-navigation");new Waypoint({element:jQuery(".post-content"),offset:"200px",handler:function(t){"down"===t&&e.addClass("stick"),"up"===t&&e.removeClass("stick")}}),new Waypoint({element:jQuery(".post-content > *:last-child"),offset:"200px",handler:function(t){"down"===t&&e.addClass("invisible"),"up"===t&&e.removeClass("invisible")}}),jQuery(".post-content .alignwide, .post-content .alignfull").on("mouseenter",(()=>{e.addClass("invisible")})),jQuery(".post-content .alignwide, .post-content .alignfull").on("mouseleave",(()=>{e.removeClass("invisible")})),jQuery(".post-navigation").find(".ez-toc-list a").each((function(e){var t=jQuery(this).attr("href");t=t.replace("-_",""),jQuery(this).attr("href",t)}))}initCurrency(){var e={EUR:"&euro;",GBP:"&pound;",USD:"&dollar;"};jQuery(window).on("ppeddfsAfterFsMarkup",(function(){jQuery("span.fsc-currency").each((function(){var t=jQuery(this),n=t.text();e[n]&&t.html(e[n])}))}))}initCheckoutPage(){jQuery("body").hasClass("page-template-checkout")}}})();