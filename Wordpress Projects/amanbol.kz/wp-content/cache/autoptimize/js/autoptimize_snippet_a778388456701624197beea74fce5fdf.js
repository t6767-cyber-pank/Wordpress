!function(t,e){"use strict";if("object"==typeof module&&"object"==typeof module.exports){if(!t.document)throw new Error("HC-Sticky requires a browser to run.");module.exports=e(t)}else"function"==typeof define&&define.amd?define("hcSticky",[],e(t)):e(t)}("undefined"!=typeof window?window:this,function(t){"use strict";var e={top:0,bottom:0,bottomEnd:0,innerTop:0,innerSticker:null,stickyClass:"sticky",stickTo:null,followScroll:!0,responsive:null,mobileFirst:!1,onStart:null,onStop:null,onBeforeResize:null,onResize:null,resizeDebounce:100,disable:!1,queries:null,queryFlow:"down"},o=function(t,e,o){console.log("%c! HC Sticky:%c "+t+"%c "+o+" is now deprecated and will be removed. Use%c "+e+"%c instead.","color: red","color: darkviolet","color: black","color: darkviolet","color: black")},i=t.document,n=function(s,r){var l=this;if("string"==typeof s&&(s=i.querySelector(s)),!s)return!1;r.queries&&o("queries","responsive","option"),r.queryFlow&&o("queryFlow","mobileFirst","option");var a={},c=n.Helpers,f=s.parentNode;"static"===c.getStyle(f,"position")&&(f.style.position="relative");var p=function(){var t=0<arguments.length&&void 0!==arguments[0]?arguments[0]:{};c.isEmptyObject(t)&&!c.isEmptyObject(a)||(a=Object.assign({},e,a,t))},d=function(){return a.disable},u=function(){var o,i=a.responsive||a.queries;if(i){var n=t.innerWidth;if(o=r,(a=Object.assign({},e,o||{})).mobileFirst)for(var s in i)s<=n&&!c.isEmptyObject(i[s])&&p(i[s]);else{var l=[];for(var f in i){var d={};d[f]=i[f],l.push(d)}for(var u=l.length-1;0<=u;u--){var g=l[u],m=Object.keys(g)[0];n<=m&&!c.isEmptyObject(g[m])&&p(g[m])}}}},g={css:{},position:null,stick:function(){var t=0<arguments.length&&void 0!==arguments[0]?arguments[0]:{};c.hasClass(s,a.stickyClass)||(!1===m.isAttached&&m.attach(),g.position="fixed",s.style.position="fixed",s.style.left=m.offsetLeft+"px",s.style.width=m.width,void 0===t.bottom?s.style.bottom="auto":s.style.bottom=t.bottom+"px",void 0===t.top?s.style.top="auto":s.style.top=t.top+"px",s.classList?s.classList.add(a.stickyClass):s.className+=" "+a.stickyClass,a.onStart&&a.onStart.call(s,Object.assign({},a)))},release:function(){var t=0<arguments.length&&void 0!==arguments[0]?arguments[0]:{};if(t.stop=t.stop||!1,!0===t.stop||"fixed"===g.position||null===g.position||!(void 0===t.top&&void 0===t.bottom||void 0!==t.top&&(parseInt(c.getStyle(s,"top"))||0)===t.top||void 0!==t.bottom&&(parseInt(c.getStyle(s,"bottom"))||0)===t.bottom)){!0===t.stop?!0===m.isAttached&&m.detach():!1===m.isAttached&&m.attach();var e=t.position||g.css.position;g.position=e,s.style.position=e,s.style.left=!0===t.stop?g.css.left:m.positionLeft+"px",s.style.width="absolute"!==e?g.css.width:m.width,void 0===t.bottom?s.style.bottom=!0===t.stop?"":"auto":s.style.bottom=t.bottom+"px",void 0===t.top?s.style.top=!0===t.stop?"":"auto":s.style.top=t.top+"px",s.classList?s.classList.remove(a.stickyClass):s.className=s.className.replace(new RegExp("(^|\\b)"+a.stickyClass.split(" ").join("|")+"(\\b|$)","gi")," "),a.onStop&&a.onStop.call(s,Object.assign({},a))}}},m={el:i.createElement("div"),offsetLeft:null,positionLeft:null,width:null,isAttached:!1,init:function(){for(var t in m.el.className="sticky-spacer",g.css)m.el.style[t]=g.css[t];m.el.style["z-index"]="-1";var e=c.getStyle(s);m.offsetLeft=c.offset(s).left-(parseInt(e.marginLeft)||0),m.positionLeft=c.position(s).left,m.width=c.getStyle(s,"width")},attach:function(){f.insertBefore(m.el,s),m.isAttached=!0},detach:function(){m.el=f.removeChild(m.el),m.isAttached=!1}},h=void 0,v=void 0,y=void 0,b=void 0,S=void 0,w=void 0,k=void 0,E=void 0,x=void 0,L=void 0,T=void 0,j=void 0,O=void 0,C=void 0,z=void 0,N=void 0,H=void 0,R=void 0,A=function(){var e,o,n,r;g.css=(e=s,o=c.getCascadedStyle(e),n=c.getStyle(e),r={height:e.offsetHeight+"px",left:o.left,right:o.right,top:o.top,bottom:o.bottom,position:n.position,display:n.display,verticalAlign:n.verticalAlign,boxSizing:n.boxSizing,marginLeft:o.marginLeft,marginRight:o.marginRight,marginTop:o.marginTop,marginBottom:o.marginBottom,paddingLeft:o.paddingLeft,paddingRight:o.paddingRight},o.float&&(r.float=o.float||"none"),o.cssFloat&&(r.cssFloat=o.cssFloat||"none"),n.MozBoxSizing&&(r.MozBoxSizing=n.MozBoxSizing),r.width="auto"!==o.width?o.width:"border-box"===r.boxSizing||"border-box"===r.MozBoxSizing?e.offsetWidth+"px":n.width,r),m.init(),h=!(!a.stickTo||!("document"===a.stickTo||a.stickTo.nodeType&&9===a.stickTo.nodeType||"object"==typeof a.stickTo&&a.stickTo instanceof("undefined"!=typeof HTMLDocument?HTMLDocument:Document))),v=a.stickTo?h?i:"string"==typeof a.stickTo?i.querySelector(a.stickTo):a.stickTo:f,z=(R=function(){var t=s.offsetHeight+(parseInt(g.css.marginTop)||0)+(parseInt(g.css.marginBottom)||0),e=(z||0)-t;return-1<=e&&e<=1?z:t})(),b=(H=function(){return h?Math.max(i.documentElement.clientHeight,i.body.scrollHeight,i.documentElement.scrollHeight,i.body.offsetHeight,i.documentElement.offsetHeight):v.offsetHeight})(),S=h?0:c.offset(v).top,w=a.stickTo?h?0:c.offset(f).top:S,k=t.innerHeight,N=s.offsetTop-(parseInt(g.css.marginTop)||0),y=a.innerSticker?"string"==typeof a.innerSticker?i.querySelector(a.innerSticker):a.innerSticker:null,E=isNaN(a.top)&&-1<a.top.indexOf("%")?parseFloat(a.top)/100*k:a.top,x=isNaN(a.bottom)&&-1<a.bottom.indexOf("%")?parseFloat(a.bottom)/100*k:a.bottom,L=y?y.offsetTop:a.innerTop?a.innerTop:0,T=isNaN(a.bottomEnd)&&-1<a.bottomEnd.indexOf("%")?parseFloat(a.bottomEnd)/100*k:a.bottomEnd,j=S-E+L+N},B=t.pageYOffset||i.documentElement.scrollTop,I=0,q=void 0,F=function(){z=R(),b=H(),O=S+b-E-T,C=k<z;var e=t.pageYOffset||i.documentElement.scrollTop,o=c.offset(s).top,n=o-e,r=void 0;q=e<B?"up":"down",I=e-B,j<(B=e)?O+E+(C?x:0)-(a.followScroll&&C?0:E)<=e+z-L-(k-(j-L)<z-L&&a.followScroll&&0<(r=z-k-L)?r:0)?g.release({position:"absolute",bottom:w+f.offsetHeight-O-E}):C&&a.followScroll?"down"===q?n+z+x<=k+.9?g.stick({bottom:x}):"fixed"===g.position&&g.release({position:"absolute",top:o-E-j-I+L}):Math.ceil(n+L)<0&&"fixed"===g.position?g.release({position:"absolute",top:o-E-j+L-I}):e+E-L<=o&&g.stick({top:E-L}):g.stick({top:E-L}):g.release({stop:!0})},M=!1,D=!1,P=function(){M&&(c.event.unbind(t,"scroll",F),M=!1)},W=function(){null!==s.offsetParent&&"none"!==c.getStyle(s,"display")?(A(),b<=z?P():(F(),M||(c.event.bind(t,"scroll",F),M=!0))):P()},V=function(){s.style.position="",s.style.left="",s.style.top="",s.style.bottom="",s.style.width="",s.classList?s.classList.remove(a.stickyClass):s.className=s.className.replace(new RegExp("(^|\\b)"+a.stickyClass.split(" ").join("|")+"(\\b|$)","gi")," "),g.css={},!(g.position=null)===m.isAttached&&m.detach()},U=function(){V(),u(),d()?P():W()},Y=function(){a.onBeforeResize&&a.onBeforeResize.call(s,Object.assign({},a)),U(),a.onResize&&a.onResize.call(s,Object.assign({},a))},$=a.resizeDebounce?c.debounce(Y,a.resizeDebounce):Y,Q=function(){D&&(c.event.unbind(t,"resize",$),D=!1),P()},X=function(){D||(c.event.bind(t,"resize",$),D=!0),u(),d()?P():W()};this.options=function(t){return t?a[t]:Object.assign({},a)},this.refresh=U,this.update=function(t){p(t),r=Object.assign({},r,t||{}),U()},this.attach=X,this.detach=Q,this.destroy=function(){Q(),V()},this.triggerMethod=function(t,e){"function"==typeof l[t]&&l[t](e)},this.reinit=function(){o("reinit","refresh","method"),U()},p(r),X(),c.event.bind(t,"load",U)};if(void 0!==t.jQuery){var s=t.jQuery,r="hcSticky";s.fn.extend({hcSticky:function(t,e){return this.length?"options"===t?s.data(this.get(0),r).options():this.each(function(){var o=s.data(this,r);o?o.triggerMethod(t,e):(o=new n(this,t),s.data(this,r,o))}):this}})}return t.hcSticky=t.hcSticky||n,n}),function(t){"use strict";var e=t.hcSticky,o=t.document;"function"!=typeof Object.assign&&Object.defineProperty(Object,"assign",{value:function(t,e){if(null==t)throw new TypeError("Cannot convert undefined or null to object");for(var o=Object(t),i=1;i<arguments.length;i++){var n=arguments[i];if(null!=n)for(var s in n)Object.prototype.hasOwnProperty.call(n,s)&&(o[s]=n[s])}return o},writable:!0,configurable:!0}),Array.prototype.forEach||(Array.prototype.forEach=function(t){var e,o;if(null==this)throw new TypeError("this is null or not defined");var i=Object(this),n=i.length>>>0;if("function"!=typeof t)throw new TypeError(t+" is not a function");for(1<arguments.length&&(e=arguments[1]),o=0;o<n;){var s;o in i&&(s=i[o],t.call(e,s,o,i)),o++}});var i=function(){function e(e){var o=t.event;return o.target=o.target||o.srcElement||e,o}var i=o.documentElement,n=function(){};i.addEventListener?n=function(t,e,o){t.addEventListener(e,o,!1)}:i.attachEvent&&(n=function(t,o,i){t[o+i]=i.handleEvent?function(){var o=e(t);i.handleEvent.call(i,o)}:function(){var o=e(t);i.call(t,o)},t.attachEvent("on"+o,t[o+i])});var s=function(){};return i.removeEventListener?s=function(t,e,o){t.removeEventListener(e,o,!1)}:i.detachEvent&&(s=function(t,e,o){t.detachEvent("on"+e,t[e+o]);try{delete t[e+o]}catch(i){t[e+o]=void 0}}),{bind:n,unbind:s}}(),n=function(e,i){return t.getComputedStyle?i?o.defaultView.getComputedStyle(e,null).getPropertyValue(i):o.defaultView.getComputedStyle(e,null):e.currentStyle?i?e.currentStyle[i.replace(/-\w/g,function(t){return t.toUpperCase().replace("-","")})]:e.currentStyle:void 0},s=function(e){var i=e.getBoundingClientRect(),n=t.pageYOffset||o.documentElement.scrollTop,s=t.pageXOffset||o.documentElement.scrollLeft;return{top:i.top+n,left:i.left+s}};e.Helpers={isEmptyObject:function(t){for(var e in t)return!1;return!0},debounce:function(t,e,o){var i=void 0;return function(){var n=this,s=arguments,r=o&&!i;clearTimeout(i),i=setTimeout(function(){i=null,o||t.apply(n,s)},e),r&&t.apply(n,s)}},hasClass:function(t,e){return t.classList?t.classList.contains(e):new RegExp("(^| )"+e+"( |$)","gi").test(t.className)},offset:s,position:function(t){var e=t.offsetParent,o=s(e),i=s(t),r=n(e),l=n(t);return o.top+=parseInt(r.borderTopWidth)||0,o.left+=parseInt(r.borderLeftWidth)||0,{top:i.top-o.top-(parseInt(l.marginTop)||0),left:i.left-o.left-(parseInt(l.marginLeft)||0)}},getStyle:n,getCascadedStyle:function(e){var i=e.cloneNode(!0);i.style.display="none",Array.prototype.slice.call(i.querySelectorAll('input[type="radio"]')).forEach(function(t){t.removeAttribute("name")}),e.parentNode.insertBefore(i,e.nextSibling);var n=void 0;i.currentStyle?n=i.currentStyle:t.getComputedStyle&&(n=o.defaultView.getComputedStyle(i,null));var s={};for(var r in n)!isNaN(r)||"string"!=typeof n[r]&&"number"!=typeof n[r]||(s[r]=n[r]);if(Object.keys(s).length<3)for(var l in s={},n)isNaN(l)||(s[n[l].replace(/-\w/g,function(t){return t.toUpperCase().replace("-","")})]=n.getPropertyValue(n[l]));if(s.margin||"auto"!==s.marginLeft?s.margin||s.marginLeft!==s.marginRight||s.marginLeft!==s.marginTop||s.marginLeft!==s.marginBottom||(s.margin=s.marginLeft):s.margin="auto",!s.margin&&"0px"===s.marginLeft&&"0px"===s.marginRight){var a=e.offsetLeft-e.parentNode.offsetLeft,c=a-(parseInt(s.left)||0)-(parseInt(s.right)||0),f=e.parentNode.offsetWidth-e.offsetWidth-a-(parseInt(s.right)||0)+(parseInt(s.left)||0)-c;0!==f&&1!==f||(s.margin="auto")}return i.parentNode.removeChild(i),i=null,s},event:i}}(window);