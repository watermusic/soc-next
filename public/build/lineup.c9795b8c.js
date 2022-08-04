/*! For license information please see lineup.c9795b8c.js.LICENSE.txt */
(self.webpackChunk=self.webpackChunk||[]).push([[144],{2462:()=>{var t=document.querySelector('[aria-controls="mobile-menu"]');t&&t.addEventListener("click",(function(t){document.querySelector("#mobile-menu").classList.toggle("hidden")}))},6667:(t,e,r)=>{"use strict";r(2462);var n=r(5166),o=r(5684),i=(r(8309),r(1539),r(8674),r(2526),r(1817),r(2165),r(6992),r(8783),r(3948),r(2443),r(9341),r(3706),r(2703),r(9070),r(8011),r(489),r(9554),r(4747),r(8304),r(5069),r(7042),r(8452)),a=r(8133),u=r(1315);r(9826);function l(t){return l="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t},l(t)}function c(){c=function(){return t};var t={},e=Object.prototype,r=e.hasOwnProperty,n="function"==typeof Symbol?Symbol:{},o=n.iterator||"@@iterator",i=n.asyncIterator||"@@asyncIterator",a=n.toStringTag||"@@toStringTag";function u(t,e,r){return Object.defineProperty(t,e,{value:r,enumerable:!0,configurable:!0,writable:!0}),t[e]}try{u({},"")}catch(t){u=function(t,e,r){return t[e]=r}}function s(t,e,r,n){var o=e&&e.prototype instanceof p?e:p,i=Object.create(o.prototype),a=new S(n||[]);return i._invoke=function(t,e,r){var n="suspendedStart";return function(o,i){if("executing"===n)throw new Error("Generator is already running");if("completed"===n){if("throw"===o)throw i;return P()}for(r.method=o,r.arg=i;;){var a=r.delegate;if(a){var u=_(a,r);if(u){if(u===h)continue;return u}}if("next"===r.method)r.sent=r._sent=r.arg;else if("throw"===r.method){if("suspendedStart"===n)throw n="completed",r.arg;r.dispatchException(r.arg)}else"return"===r.method&&r.abrupt("return",r.arg);n="executing";var l=f(t,e,r);if("normal"===l.type){if(n=r.done?"completed":"suspendedYield",l.arg===h)continue;return{value:l.arg,done:r.done}}"throw"===l.type&&(n="completed",r.method="throw",r.arg=l.arg)}}}(t,r,a),i}function f(t,e,r){try{return{type:"normal",arg:t.call(e,r)}}catch(t){return{type:"throw",arg:t}}}t.wrap=s;var h={};function p(){}function v(){}function y(){}var d={};u(d,o,(function(){return this}));var m=Object.getPrototypeOf,g=m&&m(m(E([])));g&&g!==e&&r.call(g,o)&&(d=g);var w=y.prototype=p.prototype=Object.create(d);function b(t){["next","throw","return"].forEach((function(e){u(t,e,(function(t){return this._invoke(e,t)}))}))}function x(t,e){function n(o,i,a,u){var c=f(t[o],t,i);if("throw"!==c.type){var s=c.arg,h=s.value;return h&&"object"==l(h)&&r.call(h,"__await")?e.resolve(h.__await).then((function(t){n("next",t,a,u)}),(function(t){n("throw",t,a,u)})):e.resolve(h).then((function(t){s.value=t,a(s)}),(function(t){return n("throw",t,a,u)}))}u(c.arg)}var o;this._invoke=function(t,r){function i(){return new e((function(e,o){n(t,r,e,o)}))}return o=o?o.then(i,i):i()}}function _(t,e){var r=t.iterator[e.method];if(void 0===r){if(e.delegate=null,"throw"===e.method){if(t.iterator.return&&(e.method="return",e.arg=void 0,_(t,e),"throw"===e.method))return h;e.method="throw",e.arg=new TypeError("The iterator does not provide a 'throw' method")}return h}var n=f(r,t.iterator,e.arg);if("throw"===n.type)return e.method="throw",e.arg=n.arg,e.delegate=null,h;var o=n.arg;return o?o.done?(e[t.resultName]=o.value,e.next=t.nextLoc,"return"!==e.method&&(e.method="next",e.arg=void 0),e.delegate=null,h):o:(e.method="throw",e.arg=new TypeError("iterator result is not an object"),e.delegate=null,h)}function L(t){var e={tryLoc:t[0]};1 in t&&(e.catchLoc=t[1]),2 in t&&(e.finallyLoc=t[2],e.afterLoc=t[3]),this.tryEntries.push(e)}function k(t){var e=t.completion||{};e.type="normal",delete e.arg,t.completion=e}function S(t){this.tryEntries=[{tryLoc:"root"}],t.forEach(L,this),this.reset(!0)}function E(t){if(t){var e=t[o];if(e)return e.call(t);if("function"==typeof t.next)return t;if(!isNaN(t.length)){var n=-1,i=function e(){for(;++n<t.length;)if(r.call(t,n))return e.value=t[n],e.done=!1,e;return e.value=void 0,e.done=!0,e};return i.next=i}}return{next:P}}function P(){return{value:void 0,done:!0}}return v.prototype=y,u(w,"constructor",y),u(y,"constructor",v),v.displayName=u(y,a,"GeneratorFunction"),t.isGeneratorFunction=function(t){var e="function"==typeof t&&t.constructor;return!!e&&(e===v||"GeneratorFunction"===(e.displayName||e.name))},t.mark=function(t){return Object.setPrototypeOf?Object.setPrototypeOf(t,y):(t.__proto__=y,u(t,a,"GeneratorFunction")),t.prototype=Object.create(w),t},t.awrap=function(t){return{__await:t}},b(x.prototype),u(x.prototype,i,(function(){return this})),t.AsyncIterator=x,t.async=function(e,r,n,o,i){void 0===i&&(i=Promise);var a=new x(s(e,r,n,o),i);return t.isGeneratorFunction(r)?a:a.next().then((function(t){return t.done?t.value:a.next()}))},b(w),u(w,a,"Generator"),u(w,o,(function(){return this})),u(w,"toString",(function(){return"[object Generator]"})),t.keys=function(t){var e=[];for(var r in t)e.push(r);return e.reverse(),function r(){for(;e.length;){var n=e.pop();if(n in t)return r.value=n,r.done=!1,r}return r.done=!0,r}},t.values=E,S.prototype={constructor:S,reset:function(t){if(this.prev=0,this.next=0,this.sent=this._sent=void 0,this.done=!1,this.delegate=null,this.method="next",this.arg=void 0,this.tryEntries.forEach(k),!t)for(var e in this)"t"===e.charAt(0)&&r.call(this,e)&&!isNaN(+e.slice(1))&&(this[e]=void 0)},stop:function(){this.done=!0;var t=this.tryEntries[0].completion;if("throw"===t.type)throw t.arg;return this.rval},dispatchException:function(t){if(this.done)throw t;var e=this;function n(r,n){return a.type="throw",a.arg=t,e.next=r,n&&(e.method="next",e.arg=void 0),!!n}for(var o=this.tryEntries.length-1;o>=0;--o){var i=this.tryEntries[o],a=i.completion;if("root"===i.tryLoc)return n("end");if(i.tryLoc<=this.prev){var u=r.call(i,"catchLoc"),l=r.call(i,"finallyLoc");if(u&&l){if(this.prev<i.catchLoc)return n(i.catchLoc,!0);if(this.prev<i.finallyLoc)return n(i.finallyLoc)}else if(u){if(this.prev<i.catchLoc)return n(i.catchLoc,!0)}else{if(!l)throw new Error("try statement without catch or finally");if(this.prev<i.finallyLoc)return n(i.finallyLoc)}}}},abrupt:function(t,e){for(var n=this.tryEntries.length-1;n>=0;--n){var o=this.tryEntries[n];if(o.tryLoc<=this.prev&&r.call(o,"finallyLoc")&&this.prev<o.finallyLoc){var i=o;break}}i&&("break"===t||"continue"===t)&&i.tryLoc<=e&&e<=i.finallyLoc&&(i=null);var a=i?i.completion:{};return a.type=t,a.arg=e,i?(this.method="next",this.next=i.finallyLoc,h):this.complete(a)},complete:function(t,e){if("throw"===t.type)throw t.arg;return"break"===t.type||"continue"===t.type?this.next=t.arg:"return"===t.type?(this.rval=this.arg=t.arg,this.method="return",this.next="end"):"normal"===t.type&&e&&(this.next=e),h},finish:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.finallyLoc===t)return this.complete(r.completion,r.afterLoc),k(r),h}},catch:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.tryLoc===t){var n=r.completion;if("throw"===n.type){var o=n.arg;k(r)}return o}}throw new Error("illegal catch attempt")},delegateYield:function(t,e,r){return this.delegate={iterator:E(t),resultName:e,nextLoc:r},"next"===this.method&&(this.arg=void 0),h}},t}function s(t,e,r,n,o,i,a){try{var u=t[i](a),l=u.value}catch(t){return void r(t)}u.done?e(l):Promise.resolve(l).then(n,o)}function f(t){return function(){var e=this,r=arguments;return new Promise((function(n,o){var i=t.apply(e,r);function a(t){s(i,n,o,a,u,"next",t)}function u(t){s(i,n,o,a,u,"throw",t)}a(void 0)}))}}var h=(0,o.Q_)("lineup",(function(){var t=(0,n.iH)(!1),e=(0,n.iH)(!1),r=(0,n.iH)(!1),o=(0,n.iH)(null),i=(0,n.iH)([]);function a(){return(a=f(c().mark((function r(){var n;return c().wrap((function(r){for(;;)switch(r.prev=r.next){case 0:return i.value=[],e.value=!0,r.prev=2,r.next=5,fetch("/api/lineups");case 5:return n=r.sent,r.next=8,n.json();case 8:i.value=r.sent,t.value=!0,r.next=15;break;case 12:r.prev=12,r.t0=r.catch(2),o.value=r.t0;case 15:return r.prev=15,e.value=!1,r.finish(15);case 18:case"end":return r.stop()}}),r,null,[[2,12,15,18]])})))).apply(this,arguments)}function u(){return(u=f(c().mark((function t(e){return c().wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return r.value=!0,t.prev=1,t.next=4,fetch("/api/lineups",{method:"POST",cache:"no-cache",headers:{"Content-Type":"application/json"},body:JSON.stringify(e)}).then((function(t){return t.json()}));case 4:t.sent,t.next=10;break;case 7:t.prev=7,t.t0=t.catch(1),o.value=t.t0;case 10:return t.prev=10,this.hydrate(),r.value=!1,t.finish(10);case 14:case"end":return t.stop()}}),t,this,[[1,7,10,14]])})))).apply(this,arguments)}var l=(0,n.Fl)((function(){return function(t){return i.value.find((function(e){return e.matchday===t}))}}));return{initialized:t,loading:e,saving:r,errors:o,lineups:i,hydrate:function(){return a.apply(this,arguments)},getLineUpByMatchday:l,createOrUpdateLineup:function(t){return u.apply(this,arguments)}}})),p=(r(7327),"bench"),v="pitch",y=function(t){var e="";switch(t){case"TW":default:e="bg-rose-500";break;case"AB":e="bg-blue-500";break;case"MF":e="bg-yellow-500";break;case"ST":e="bg-emerald-500"}return e},d=[{x:50,y:5,num:1},{x:25,y:25,num:2},{x:50,y:20,num:3},{x:75,y:25,num:4},{x:39,y:41,num:5},{x:61,y:41,num:6},{x:20,y:59,num:7},{x:50,y:65,num:8},{x:80,y:59,num:9},{x:28.5,y:78,num:10},{x:70.5,y:78,num:11}];function m(t){return m="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t},m(t)}function g(){g=function(){return t};var t={},e=Object.prototype,r=e.hasOwnProperty,n="function"==typeof Symbol?Symbol:{},o=n.iterator||"@@iterator",i=n.asyncIterator||"@@asyncIterator",a=n.toStringTag||"@@toStringTag";function u(t,e,r){return Object.defineProperty(t,e,{value:r,enumerable:!0,configurable:!0,writable:!0}),t[e]}try{u({},"")}catch(t){u=function(t,e,r){return t[e]=r}}function l(t,e,r,n){var o=e&&e.prototype instanceof f?e:f,i=Object.create(o.prototype),a=new S(n||[]);return i._invoke=function(t,e,r){var n="suspendedStart";return function(o,i){if("executing"===n)throw new Error("Generator is already running");if("completed"===n){if("throw"===o)throw i;return P()}for(r.method=o,r.arg=i;;){var a=r.delegate;if(a){var u=_(a,r);if(u){if(u===s)continue;return u}}if("next"===r.method)r.sent=r._sent=r.arg;else if("throw"===r.method){if("suspendedStart"===n)throw n="completed",r.arg;r.dispatchException(r.arg)}else"return"===r.method&&r.abrupt("return",r.arg);n="executing";var l=c(t,e,r);if("normal"===l.type){if(n=r.done?"completed":"suspendedYield",l.arg===s)continue;return{value:l.arg,done:r.done}}"throw"===l.type&&(n="completed",r.method="throw",r.arg=l.arg)}}}(t,r,a),i}function c(t,e,r){try{return{type:"normal",arg:t.call(e,r)}}catch(t){return{type:"throw",arg:t}}}t.wrap=l;var s={};function f(){}function h(){}function p(){}var v={};u(v,o,(function(){return this}));var y=Object.getPrototypeOf,d=y&&y(y(E([])));d&&d!==e&&r.call(d,o)&&(v=d);var w=p.prototype=f.prototype=Object.create(v);function b(t){["next","throw","return"].forEach((function(e){u(t,e,(function(t){return this._invoke(e,t)}))}))}function x(t,e){function n(o,i,a,u){var l=c(t[o],t,i);if("throw"!==l.type){var s=l.arg,f=s.value;return f&&"object"==m(f)&&r.call(f,"__await")?e.resolve(f.__await).then((function(t){n("next",t,a,u)}),(function(t){n("throw",t,a,u)})):e.resolve(f).then((function(t){s.value=t,a(s)}),(function(t){return n("throw",t,a,u)}))}u(l.arg)}var o;this._invoke=function(t,r){function i(){return new e((function(e,o){n(t,r,e,o)}))}return o=o?o.then(i,i):i()}}function _(t,e){var r=t.iterator[e.method];if(void 0===r){if(e.delegate=null,"throw"===e.method){if(t.iterator.return&&(e.method="return",e.arg=void 0,_(t,e),"throw"===e.method))return s;e.method="throw",e.arg=new TypeError("The iterator does not provide a 'throw' method")}return s}var n=c(r,t.iterator,e.arg);if("throw"===n.type)return e.method="throw",e.arg=n.arg,e.delegate=null,s;var o=n.arg;return o?o.done?(e[t.resultName]=o.value,e.next=t.nextLoc,"return"!==e.method&&(e.method="next",e.arg=void 0),e.delegate=null,s):o:(e.method="throw",e.arg=new TypeError("iterator result is not an object"),e.delegate=null,s)}function L(t){var e={tryLoc:t[0]};1 in t&&(e.catchLoc=t[1]),2 in t&&(e.finallyLoc=t[2],e.afterLoc=t[3]),this.tryEntries.push(e)}function k(t){var e=t.completion||{};e.type="normal",delete e.arg,t.completion=e}function S(t){this.tryEntries=[{tryLoc:"root"}],t.forEach(L,this),this.reset(!0)}function E(t){if(t){var e=t[o];if(e)return e.call(t);if("function"==typeof t.next)return t;if(!isNaN(t.length)){var n=-1,i=function e(){for(;++n<t.length;)if(r.call(t,n))return e.value=t[n],e.done=!1,e;return e.value=void 0,e.done=!0,e};return i.next=i}}return{next:P}}function P(){return{value:void 0,done:!0}}return h.prototype=p,u(w,"constructor",p),u(p,"constructor",h),h.displayName=u(p,a,"GeneratorFunction"),t.isGeneratorFunction=function(t){var e="function"==typeof t&&t.constructor;return!!e&&(e===h||"GeneratorFunction"===(e.displayName||e.name))},t.mark=function(t){return Object.setPrototypeOf?Object.setPrototypeOf(t,p):(t.__proto__=p,u(t,a,"GeneratorFunction")),t.prototype=Object.create(w),t},t.awrap=function(t){return{__await:t}},b(x.prototype),u(x.prototype,i,(function(){return this})),t.AsyncIterator=x,t.async=function(e,r,n,o,i){void 0===i&&(i=Promise);var a=new x(l(e,r,n,o),i);return t.isGeneratorFunction(r)?a:a.next().then((function(t){return t.done?t.value:a.next()}))},b(w),u(w,a,"Generator"),u(w,o,(function(){return this})),u(w,"toString",(function(){return"[object Generator]"})),t.keys=function(t){var e=[];for(var r in t)e.push(r);return e.reverse(),function r(){for(;e.length;){var n=e.pop();if(n in t)return r.value=n,r.done=!1,r}return r.done=!0,r}},t.values=E,S.prototype={constructor:S,reset:function(t){if(this.prev=0,this.next=0,this.sent=this._sent=void 0,this.done=!1,this.delegate=null,this.method="next",this.arg=void 0,this.tryEntries.forEach(k),!t)for(var e in this)"t"===e.charAt(0)&&r.call(this,e)&&!isNaN(+e.slice(1))&&(this[e]=void 0)},stop:function(){this.done=!0;var t=this.tryEntries[0].completion;if("throw"===t.type)throw t.arg;return this.rval},dispatchException:function(t){if(this.done)throw t;var e=this;function n(r,n){return a.type="throw",a.arg=t,e.next=r,n&&(e.method="next",e.arg=void 0),!!n}for(var o=this.tryEntries.length-1;o>=0;--o){var i=this.tryEntries[o],a=i.completion;if("root"===i.tryLoc)return n("end");if(i.tryLoc<=this.prev){var u=r.call(i,"catchLoc"),l=r.call(i,"finallyLoc");if(u&&l){if(this.prev<i.catchLoc)return n(i.catchLoc,!0);if(this.prev<i.finallyLoc)return n(i.finallyLoc)}else if(u){if(this.prev<i.catchLoc)return n(i.catchLoc,!0)}else{if(!l)throw new Error("try statement without catch or finally");if(this.prev<i.finallyLoc)return n(i.finallyLoc)}}}},abrupt:function(t,e){for(var n=this.tryEntries.length-1;n>=0;--n){var o=this.tryEntries[n];if(o.tryLoc<=this.prev&&r.call(o,"finallyLoc")&&this.prev<o.finallyLoc){var i=o;break}}i&&("break"===t||"continue"===t)&&i.tryLoc<=e&&e<=i.finallyLoc&&(i=null);var a=i?i.completion:{};return a.type=t,a.arg=e,i?(this.method="next",this.next=i.finallyLoc,s):this.complete(a)},complete:function(t,e){if("throw"===t.type)throw t.arg;return"break"===t.type||"continue"===t.type?this.next=t.arg:"return"===t.type?(this.rval=this.arg=t.arg,this.method="return",this.next="end"):"normal"===t.type&&e&&(this.next=e),s},finish:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.finallyLoc===t)return this.complete(r.completion,r.afterLoc),k(r),s}},catch:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.tryLoc===t){var n=r.completion;if("throw"===n.type){var o=n.arg;k(r)}return o}}throw new Error("illegal catch attempt")},delegateYield:function(t,e,r){return this.delegate={iterator:E(t),resultName:e,nextLoc:r},"next"===this.method&&(this.arg=void 0),s}},t}function w(t,e,r,n,o,i,a){try{var u=t[i](a),l=u.value}catch(t){return void r(t)}u.done?e(l):Promise.resolve(l).then(n,o)}function b(t){return function(){var e=this,r=arguments;return new Promise((function(n,o){var i=t.apply(e,r);function a(t){w(i,n,o,a,u,"next",t)}function u(t){w(i,n,o,a,u,"throw",t)}a(void 0)}))}}var x=(0,o.Q_)("player",(function(){var t=(0,n.iH)([]),e=(0,n.iH)(!1),r=(0,n.iH)(null),o=(0,n.iH)(null);function i(){return(i=b(g().mark((function n(){return g().wrap((function(n){for(;;)switch(n.prev=n.next){case 0:return t.value=[],e.value=!0,n.prev=2,n.next=5,fetch("/api/players").then((function(t){return t.json()}));case 5:t.value=n.sent,n.next=11;break;case 8:n.prev=8,n.t0=n.catch(2),r.value=n.t0;case 11:return n.prev=11,e.value=!1,n.finish(11);case 14:case"end":return n.stop()}}),n,null,[[2,8,11,14]])})))).apply(this,arguments)}var a=(0,n.Fl)((function(){return function(t){return o.value===t}})),u=(0,n.Fl)((function(){return null!==o.value})),l=(0,n.Fl)((function(){return o.value})),c=(0,n.Fl)((function(){return t.value.filter((function(t){return t.state===v}))})),s=(0,n.Fl)((function(){return t.value.filter((function(t){return t.state===p}))})),f=(0,n.Fl)((function(){return function(e){return t.value.filter((function(t){return"bench"===t.state&&t.position.shortcut===e}))}}));return{loading:e,errors:r,players:t,markedPosition:o,hydrate:function(){return i.apply(this,arguments)},markPosition:function(t){o.value=t},movePlayerToPitch:function(e){if(null!==o.value){var r=this.getPlayerOnPitchByPosition(o.value);null!==r&&(r.state=p,r.state_num=null);var n=t.value.find((function(t){return e.id===t.id}));n.state=v,n.state_num=o.value,o.value=null}else alert("Bitte erst die Position für den Spieler markieren.")},movePlayerToPitchFromLineup:function(e){t.value.forEach((function(t){t.state=p,t.state_num=null,e&&e.data.forEach((function(e){t.id===e.id_player&&(t.state=v,t.state_num=e.num)}))}))},getPlayerOnPitchByPosition:function(e){return t.value.find((function(t){return e===t.state_num&&t.state===v}))||null},isMarkedPosition:a,hasMarkedPosition:u,getMarkedPosition:l,getPlayersOnPitch:c,getPlayersOnBench:s,getPlayersOnBenchByPosition:f,getPlayersOnPitchAsLineup:function(){var e=t.value.filter((function(t){return t.state===v})),r=[];return e.forEach((function(t){r.push({num:t.state_num,id_player:t.id})})),r}}}));function _(t){return _="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t},_(t)}function L(){L=function(){return t};var t={},e=Object.prototype,r=e.hasOwnProperty,n="function"==typeof Symbol?Symbol:{},o=n.iterator||"@@iterator",i=n.asyncIterator||"@@asyncIterator",a=n.toStringTag||"@@toStringTag";function u(t,e,r){return Object.defineProperty(t,e,{value:r,enumerable:!0,configurable:!0,writable:!0}),t[e]}try{u({},"")}catch(t){u=function(t,e,r){return t[e]=r}}function l(t,e,r,n){var o=e&&e.prototype instanceof f?e:f,i=Object.create(o.prototype),a=new S(n||[]);return i._invoke=function(t,e,r){var n="suspendedStart";return function(o,i){if("executing"===n)throw new Error("Generator is already running");if("completed"===n){if("throw"===o)throw i;return P()}for(r.method=o,r.arg=i;;){var a=r.delegate;if(a){var u=b(a,r);if(u){if(u===s)continue;return u}}if("next"===r.method)r.sent=r._sent=r.arg;else if("throw"===r.method){if("suspendedStart"===n)throw n="completed",r.arg;r.dispatchException(r.arg)}else"return"===r.method&&r.abrupt("return",r.arg);n="executing";var l=c(t,e,r);if("normal"===l.type){if(n=r.done?"completed":"suspendedYield",l.arg===s)continue;return{value:l.arg,done:r.done}}"throw"===l.type&&(n="completed",r.method="throw",r.arg=l.arg)}}}(t,r,a),i}function c(t,e,r){try{return{type:"normal",arg:t.call(e,r)}}catch(t){return{type:"throw",arg:t}}}t.wrap=l;var s={};function f(){}function h(){}function p(){}var v={};u(v,o,(function(){return this}));var y=Object.getPrototypeOf,d=y&&y(y(E([])));d&&d!==e&&r.call(d,o)&&(v=d);var m=p.prototype=f.prototype=Object.create(v);function g(t){["next","throw","return"].forEach((function(e){u(t,e,(function(t){return this._invoke(e,t)}))}))}function w(t,e){function n(o,i,a,u){var l=c(t[o],t,i);if("throw"!==l.type){var s=l.arg,f=s.value;return f&&"object"==_(f)&&r.call(f,"__await")?e.resolve(f.__await).then((function(t){n("next",t,a,u)}),(function(t){n("throw",t,a,u)})):e.resolve(f).then((function(t){s.value=t,a(s)}),(function(t){return n("throw",t,a,u)}))}u(l.arg)}var o;this._invoke=function(t,r){function i(){return new e((function(e,o){n(t,r,e,o)}))}return o=o?o.then(i,i):i()}}function b(t,e){var r=t.iterator[e.method];if(void 0===r){if(e.delegate=null,"throw"===e.method){if(t.iterator.return&&(e.method="return",e.arg=void 0,b(t,e),"throw"===e.method))return s;e.method="throw",e.arg=new TypeError("The iterator does not provide a 'throw' method")}return s}var n=c(r,t.iterator,e.arg);if("throw"===n.type)return e.method="throw",e.arg=n.arg,e.delegate=null,s;var o=n.arg;return o?o.done?(e[t.resultName]=o.value,e.next=t.nextLoc,"return"!==e.method&&(e.method="next",e.arg=void 0),e.delegate=null,s):o:(e.method="throw",e.arg=new TypeError("iterator result is not an object"),e.delegate=null,s)}function x(t){var e={tryLoc:t[0]};1 in t&&(e.catchLoc=t[1]),2 in t&&(e.finallyLoc=t[2],e.afterLoc=t[3]),this.tryEntries.push(e)}function k(t){var e=t.completion||{};e.type="normal",delete e.arg,t.completion=e}function S(t){this.tryEntries=[{tryLoc:"root"}],t.forEach(x,this),this.reset(!0)}function E(t){if(t){var e=t[o];if(e)return e.call(t);if("function"==typeof t.next)return t;if(!isNaN(t.length)){var n=-1,i=function e(){for(;++n<t.length;)if(r.call(t,n))return e.value=t[n],e.done=!1,e;return e.value=void 0,e.done=!0,e};return i.next=i}}return{next:P}}function P(){return{value:void 0,done:!0}}return h.prototype=p,u(m,"constructor",p),u(p,"constructor",h),h.displayName=u(p,a,"GeneratorFunction"),t.isGeneratorFunction=function(t){var e="function"==typeof t&&t.constructor;return!!e&&(e===h||"GeneratorFunction"===(e.displayName||e.name))},t.mark=function(t){return Object.setPrototypeOf?Object.setPrototypeOf(t,p):(t.__proto__=p,u(t,a,"GeneratorFunction")),t.prototype=Object.create(m),t},t.awrap=function(t){return{__await:t}},g(w.prototype),u(w.prototype,i,(function(){return this})),t.AsyncIterator=w,t.async=function(e,r,n,o,i){void 0===i&&(i=Promise);var a=new w(l(e,r,n,o),i);return t.isGeneratorFunction(r)?a:a.next().then((function(t){return t.done?t.value:a.next()}))},g(m),u(m,a,"Generator"),u(m,o,(function(){return this})),u(m,"toString",(function(){return"[object Generator]"})),t.keys=function(t){var e=[];for(var r in t)e.push(r);return e.reverse(),function r(){for(;e.length;){var n=e.pop();if(n in t)return r.value=n,r.done=!1,r}return r.done=!0,r}},t.values=E,S.prototype={constructor:S,reset:function(t){if(this.prev=0,this.next=0,this.sent=this._sent=void 0,this.done=!1,this.delegate=null,this.method="next",this.arg=void 0,this.tryEntries.forEach(k),!t)for(var e in this)"t"===e.charAt(0)&&r.call(this,e)&&!isNaN(+e.slice(1))&&(this[e]=void 0)},stop:function(){this.done=!0;var t=this.tryEntries[0].completion;if("throw"===t.type)throw t.arg;return this.rval},dispatchException:function(t){if(this.done)throw t;var e=this;function n(r,n){return a.type="throw",a.arg=t,e.next=r,n&&(e.method="next",e.arg=void 0),!!n}for(var o=this.tryEntries.length-1;o>=0;--o){var i=this.tryEntries[o],a=i.completion;if("root"===i.tryLoc)return n("end");if(i.tryLoc<=this.prev){var u=r.call(i,"catchLoc"),l=r.call(i,"finallyLoc");if(u&&l){if(this.prev<i.catchLoc)return n(i.catchLoc,!0);if(this.prev<i.finallyLoc)return n(i.finallyLoc)}else if(u){if(this.prev<i.catchLoc)return n(i.catchLoc,!0)}else{if(!l)throw new Error("try statement without catch or finally");if(this.prev<i.finallyLoc)return n(i.finallyLoc)}}}},abrupt:function(t,e){for(var n=this.tryEntries.length-1;n>=0;--n){var o=this.tryEntries[n];if(o.tryLoc<=this.prev&&r.call(o,"finallyLoc")&&this.prev<o.finallyLoc){var i=o;break}}i&&("break"===t||"continue"===t)&&i.tryLoc<=e&&e<=i.finallyLoc&&(i=null);var a=i?i.completion:{};return a.type=t,a.arg=e,i?(this.method="next",this.next=i.finallyLoc,s):this.complete(a)},complete:function(t,e){if("throw"===t.type)throw t.arg;return"break"===t.type||"continue"===t.type?this.next=t.arg:"return"===t.type?(this.rval=this.arg=t.arg,this.method="return",this.next="end"):"normal"===t.type&&e&&(this.next=e),s},finish:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.finallyLoc===t)return this.complete(r.completion,r.afterLoc),k(r),s}},catch:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.tryLoc===t){var n=r.completion;if("throw"===n.type){var o=n.arg;k(r)}return o}}throw new Error("illegal catch attempt")},delegateYield:function(t,e,r){return this.delegate={iterator:E(t),resultName:e,nextLoc:r},"next"===this.method&&(this.arg=void 0),s}},t}function k(t,e,r,n,o,i,a){try{var u=t[i](a),l=u.value}catch(t){return void r(t)}u.done?e(l):Promise.resolve(l).then(n,o)}var S={key:0},E={key:1},P={key:2,class:"flex items-center justify-between w-full px-3"},O=(0,n._)("div",{class:"flex-1"},null,-1),j={class:"relative"},U={class:"block truncate"},H={class:"pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2"},T={key:0,class:"absolute inset-y-0 left-0 flex items-center pl-3 text-amber-600"},F={class:"flex-1 flex justify-end"},N=[(0,n._)("svg",{xmlns:"http://www.w3.org/2000/svg",class:"h-6 w-6 text-gray-700",fill:"none",viewBox:"0 0 24 24",stroke:"currentColor","stroke-width":"2"},[(0,n._)("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"})],-1)];const G={__name:"MatchDay",setup:function(t){var e=h(),r=x(),o=[{id:1,name:"1. Spieltag",unavailable:!1},{id:2,name:"2. Spieltag",unavailable:!1},{id:3,name:"3. Spieltag",unavailable:!1},{id:4,name:"4. Spieltag",unavailable:!1},{id:5,name:"5. Spieltag",unavailable:!1}],l=(0,n.iH)(o[0]),c=function(t){var n=e.getLineUpByMatchday(t.id);r.movePlayerToPitchFromLineup(n)};return e.$subscribe((function(t,e){!0===e.initialized&&c(l)})),(0,n.YP)(l,function(){var t,e=(t=L().mark((function t(e){return L().wrap((function(t){for(;;)switch(t.prev=t.next){case 0:c(e);case 1:case"end":return t.stop()}}),t)})),function(){var e=this,r=arguments;return new Promise((function(n,o){var i=t.apply(e,r);function a(t){k(i,n,o,a,u,"next",t)}function u(t){k(i,n,o,a,u,"throw",t)}a(void 0)}))});return function(t){return e.apply(this,arguments)}}()),function(t,c){return(0,n.wg)(),(0,n.iD)(n.HY,null,[(0,n.SU)(e).loading?((0,n.wg)(),(0,n.iD)("p",S,"Loading lineups...")):(0,n.kq)("v-if",!0),(0,n.SU)(e).error?((0,n.wg)(),(0,n.iD)("p",E,(0,n.zw)(t.error.message),1)):(0,n.kq)("v-if",!0),(0,n.SU)(e).loading?(0,n.kq)("v-if",!0):((0,n.wg)(),(0,n.iD)("div",P,[O,(0,n.Wm)((0,n.SU)(i.Ri),{class:"w-32",modelValue:l.value,"onUpdate:modelValue":c[0]||(c[0]=function(t){return l.value=t})},{default:(0,n.w5)((function(){return[(0,n._)("div",j,[(0,n.Wm)((0,n.SU)(i.Y4),{class:"relative w-full cursor-default py-2 pl-3 pr-10 text-left focus:outline-none focus-visible:border-indigo-500 focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75 focus-visible:ring-offset-2 focus-visible:ring-offset-orange-300 sm:text-sm"},{default:(0,n.w5)((function(){return[(0,n._)("span",U,(0,n.zw)(l.value.name),1),(0,n._)("span",H,[(0,n.Wm)((0,n.SU)(a.Z),{class:"h-5 w-5 text-gray-800","aria-hidden":"true"})])]})),_:1}),(0,n.Wm)(n.uT,{"leave-active-class":"transition duration-100 ease-in","leave-from-class":"opacity-100","leave-to-class":"opacity-0"},{default:(0,n.w5)((function(){return[(0,n.Wm)((0,n.SU)(i.O_),{class:"absolute bg-gray-100 mt-1 max-h-60 w-full overflow-auto py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"},{default:(0,n.w5)((function(){return[((0,n.wg)(),(0,n.iD)(n.HY,null,(0,n.Ko)(o,(function(t){return(0,n.Wm)((0,n.SU)(i.wt),{key:t.name,value:t,disabled:t.unavailable,as:"template"},{default:(0,n.w5)((function(e){var r=e.active,o=e.selected;return[(0,n._)("li",{class:(0,n.C_)([r?"bg-amber-100 text-amber-900":"text-gray-900","relative cursor-default select-none py-2 pl-10 pr-4"])},[(0,n._)("span",{class:(0,n.C_)([o?"font-medium":"font-normal","block truncate"])},(0,n.zw)(t.name),3),o?((0,n.wg)(),(0,n.iD)("span",T,[(0,n.Wm)((0,n.SU)(u.Z),{class:"h-5 w-5","aria-hidden":"true"})])):(0,n.kq)("v-if",!0)],2)]})),_:2},1032,["value","disabled"])})),64))]})),_:1})]})),_:1})])]})),_:1},8,["modelValue"]),(0,n._)("div",F,[(0,n._)("button",{onClick:c[1]||(c[1]=function(t){var n;11===(n={matchday:l.value.id,data:r.getPlayersOnPitchAsLineup()}).data.length?e.createOrUpdateLineup(n):alert("Du musst alle 11 Positionen aufstellen.")}),type:"button",class:"inline-flex items-center p-1 border border-transparent rounded-full shadow-sm text-white bg-white hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-300"},N)])]))],64)}}};var B=r(9161),D={class:"w-full"},C={key:0},Z={key:1},M={class:"flex flex-col w-full overflow-x-scroll"},z={class:"flex flex-row flex-grow-0 relative w-full"},W={role:"tablist","aria-orientation":"horizontal",class:"flex flex-row"},A=["onClick"],Y=["src","alt"],q={class:"flex flex-col m-1 absolute top-0"},I={class:"block text-xs font-medium text-white truncate pointer-events-none"};const V={__name:"Bench",setup:function(t){var e=x();e.hydrate();var r=(0,n.iH)({all:{getter:e.getPlayersOnBench,label:"Alle"},TW:{getter:e.getPlayersOnBench,label:"Torwart"},AB:{getter:e.getPlayersOnBench,label:"Abwehr"},MF:{getter:e.getPlayersOnBench,label:"Mittelfeld"},ST:{getter:e.getPlayersOnBench,label:"Sturm"}});return function(t,o){return(0,n.wg)(),(0,n.iD)("div",D,[(0,n.SU)(e).loading?((0,n.wg)(),(0,n.iD)("p",C,"Loading players...")):(0,n.kq)("v-if",!0),(0,n.SU)(e).error?((0,n.wg)(),(0,n.iD)("p",Z,(0,n.zw)(t.error.message),1)):(0,n.kq)("v-if",!0),(0,n.SU)(e).players?((0,n.wg)(),(0,n.j4)((0,n.SU)(B.v0),{key:2},{default:(0,n.w5)((function(){return[(0,n.Wm)((0,n.SU)(B.nP),{class:"border-t border-gray-300 bg-gray-100"},{default:(0,n.w5)((function(){return[((0,n.wg)(!0),(0,n.iD)(n.HY,null,(0,n.Ko)(r.value,(function(t,r){return(0,n.wg)(),(0,n.j4)((0,n.SU)(B.x4),{key:r,class:(0,n.C_)(["bg-gray-100 p-2","ring-white ring-opacity-60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2"])},{default:(0,n.w5)((function(){return[(0,n._)("div",M,[(0,n._)("div",z,[(0,n._)("div",W,[((0,n.wg)(!0),(0,n.iD)(n.HY,null,(0,n.Ko)((0,n.SU)(e).getPlayersOnBench,(function(t){return(0,n.wg)(),(0,n.iD)("div",{key:t.id,class:(0,n.C_)([["relative group block w-20 h-28 relative flex-shrink-0 mx-2 rounded-lg overflow-hidden cursor-pointer",(0,n.SU)(y)(t.position.shortcut)],""]),onClick:function(r){return(0,n.SU)(e).movePlayerToPitch(t)}},[(0,n._)("div",{class:"w-full h-full opacity-25",style:(0,n.j5)("background-image: url("+t.team.img+"); opacity: 0.1; background-size: cover;")},null,4),(0,n._)("img",{src:t.img,alt:t.name,class:"absolute bottom-0 w-full h-auto pointer-events-none group-hover:opacity-75"},null,8,Y),(0,n._)("div",q,[(0,n._)("p",I,(0,n.zw)(t.name),1)])],10,A)})),128))])])])]})),_:2},1024)})),128))]})),_:1}),(0,n.Wm)((0,n.SU)(B.td),{class:"flex space-x-0 bg-gray-200 py-0 px-4"},{default:(0,n.w5)((function(){return[((0,n.wg)(!0),(0,n.iD)(n.HY,null,(0,n.Ko)(r.value,(function(t,e){return(0,n.wg)(),(0,n.j4)((0,n.SU)(B.OK),{as:"template",key:e},{default:(0,n.w5)((function(e){var r=e.selected;return[(0,n._)("button",{class:(0,n.C_)(["w-full py-3 text-sm font-medium leading-5","ring-transparent ring-opacity-60 ring-offset-0 ring-offset-blue-400 focus:outline-none focus:ring-0",r?"bg-gray-100 text-sky-500":"text-gray-800 hover:bg-white/[0.12] hover:text-cyan"])},(0,n.zw)(t.label),3)]})),_:2},1024)})),128))]})),_:1})]})),_:1})):(0,n.kq)("v-if",!0)])}}};var K=r(7476),J={class:"w-full h-full flex items-center justify-center p-3 relative"},Q=(0,n.uE)('<svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 376 493" class="h-full w-auto absolute"><path d="M138.023 225.788h96.973S371.512 453.964 375.09 470.679c0 1.828-2.448 6.269-4.708 7.96-29.562 20.96-312.386 17.246-365.11 0-3.55-1.803-5.272-5.895-5.272-7.96 17.889-83.178 138.023-244.891 138.023-244.891Z" fill="#23432A"></path><path d="M26.738 7.562c75.037-9.295 247.183-10.84 321.614 0l26.738 463.781C327.074 488.589 35.212 486.997 0 470.812L26.738 7.562Z" fill="#117928"></path><g clip-path="url(#a)"><path fill-rule="evenodd" clip-rule="evenodd" d="m18.077 460.862 22.219-438.31H335.26l20.528 438.31H18.077Zm1.611-2.085.35-6.909c3.367.377 6.06 3.258 6.5 6.909h-6.85Zm8.293 0 66.71-.011 1.123-81.724 48.863-.021c1.224-12.719 19.948-22.818 42.868-22.818s41.644 10.099 42.868 22.818l48.863-.016 1.062 81.74 65.588-.005c.463-4.495 3.774-8.055 7.905-8.459L343.388 227.38H235.749c0 26.081-21.583 46.697-48.204 46.697-26.622 0-48.204-20.616-48.204-46.697H31.419L20.118 450.303c4.12.424 7.411 3.985 7.863 8.474Zm212.656-.026 38.202-.006-1.039-79.601H97.294l-1.473 79.622 38.24-.005.007-39.819h106.577l-.008 39.809Zm-1.51-.038-103.583.048.031-37.697h103.564l-.012 37.649Zm114.779-6.866.32 6.893h-6.857c.451-3.656 3.159-6.532 6.537-6.893Zm-207.711-74.826h82.704c-1.292-11.547-19.312-20.695-41.354-20.695-22.039 0-40.062 9.148-41.35 20.695Zm88.048-150.172c0 24.909-20.905 45.105-46.698 45.105-25.789 0-46.698-20.196-46.698-45.105 0-24.913 20.909-45.104 46.698-45.104 25.793 0 46.698 20.191 46.698 45.104Zm92.096-202.174h-51.721l.832 63.656-47.636.02c-.802 11.208-18.438 20.165-40.081 20.165-21.639 0-39.279-8.957-40.077-20.164H99.798l.832-63.677H49.251c-.467 4.52-3.815 8.087-7.984 8.453L31.53 225.257H139.34c0-26.086 21.582-45.635 48.204-45.635 26.621 0 48.204 19.549 48.204 45.635h107.537l-9-192.124c-4.154-.387-7.48-3.953-7.947-8.458ZM187.733 106.67c-20.833 0-37.821-8.13-38.665-18.318h77.334c-.844 10.188-17.836 18.318-38.669 18.318Zm-86.737-19.91.809-62.085h39.042V54.92h93.772V24.675h38.824l.809 62.085H100.996Zm41.357-33.961V24.675h90.76v28.124h-90.76Zm185.429-28.124h6.104l.324 6.877c-3.325-.409-5.98-3.264-6.428-6.877Zm-286.085 0h6.112c-.452 3.624-3.122 6.479-6.463 6.872l.35-6.872Z" fill="#fff"></path></g><defs><clipPath id="a"><path fill="#fff" transform="translate(18.077 3.714)" d="M0 0h337.807v475.986H0z"></path></clipPath></defs></svg>',1),R={class:"players absolute left-0 top-0 w-full h-full"},$=["onClick","set"],X=["src","alt"],tt=["textContent"],et={key:1,class:"w-14 h-14 p-1 rounded-full bg-black bg-opacity-10"},rt=[(0,n._)("div",{class:"w-full h-full flex items-center justify-center"},[(0,n._)("svg",{xmlns:"http://www.w3.org/2000/svg",class:"h-10 w-10 text-white opacity-75",viewBox:"0 0 20 20",fill:"currentColor"},[(0,n._)("path",{"fill-rule":"evenodd",d:"M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z","clip-rule":"evenodd"})])],-1)];const nt={__name:"Pitch",setup:function(t){var e=(0,K.Jk)(x()),r=(e.players,e.loading,e.error,x()),o=function(t){return r.isMarkedPosition(t)?"border-blue-400":"border-white"},i=d;return function(t,e){return(0,n.wg)(),(0,n.iD)("div",J,[Q,(0,n._)("div",R,[((0,n.wg)(!0),(0,n.iD)(n.HY,null,(0,n.Ko)((0,n.SU)(i),(function(e){return(0,n.wg)(),(0,n.iD)("div",{onClick:function(t){return(0,n.SU)(r).markPosition(e.num)},class:"player absolute w-16 h-16 -ml-7 flex items-center justify-center cursor-pointer",key:e.num,style:(0,n.j5)("left: "+e.x+"%; bottom: "+e.y+"%"),set:t.player=(0,n.SU)(r).getPlayerOnPitchByPosition(e.num)},[null!==t.player?((0,n.wg)(),(0,n.iD)("div",{key:0,class:(0,n.C_)(["bg-white flex h-full items-center justify-center rounded-full w-full border-4",o(e.num)])},[(0,n._)("div",{class:"absolute w-full h-full opacity-25",style:(0,n.j5)("background-image: url("+t.player.team.img+"); opacity: 0.1; background-size: cover;")},null,4),(0,n._)("img",{src:t.player.img,alt:t.player.name,class:"absolute h-full rounded-full w-auto"},null,8,X),(0,n._)("span",{textContent:(0,n.zw)(t.player.name),class:"text-white absolute block text-xs",style:{bottom:"-1rem","text-shadow":"1px 1px 2px black"}},null,8,tt)],2)):((0,n.wg)(),(0,n.iD)("div",et,[(0,n._)("div",{class:(0,n.C_)(["w-full h-full rounded-full border-4 border-opacity-75 hover:border-blue-300",o(e.num)])},rt,2)]))],12,$)})),128))])])}}};var ot={class:"lineup flex flex-col justify-between h-full max-w-lg m-auto"},it={class:"sub-header z-50 h-12 flex items-center justify-center w-full"},at={class:"pitch flex flex-grow bg-gray-50"},ut={class:"bench flex h-44"};const lt={__name:"LineUp",setup:function(t){var e=h();return x().hydrate(),e.hydrate(),function(t,e){return(0,n.wg)(),(0,n.iD)("div",ot,[(0,n._)("div",it,[(0,n.Wm)((0,n.SU)(G))]),(0,n._)("div",at,[(0,n.Wm)((0,n.SU)(nt))]),(0,n._)("div",ut,[(0,n.Wm)((0,n.SU)(V))])])}}},ct={__name:"App",setup:function(t){return function(t,e){return(0,n.wg)(),(0,n.j4)((0,n.SU)(lt))}}};var st=(0,n.ri)(ct);st.use((0,o.WB)()),st.mount("#app")}},t=>{t.O(0,[109,838],(()=>{return e=6667,t(t.s=e);var e}));t.O()}]);