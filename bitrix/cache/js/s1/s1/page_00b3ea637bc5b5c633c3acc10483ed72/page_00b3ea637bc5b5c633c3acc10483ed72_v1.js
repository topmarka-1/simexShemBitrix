
; /* Start:"a:4:{s:4:"full";s:85:"/local/templates/s1/components/bitrix/news.list/hero_index/script.js?1778669341134912";s:6:"source";s:68:"/local/templates/s1/components/bitrix/news.list/hero_index/script.js";s:3:"min";s:0:"";s:3:"map";s:0:"";}"*/
// /******/ (function() { // webpackBootstrap
// /******/ 	var __webpack_modules__ = ({

// /***/ "../node_modules/ansi-html-community/index.js":
// /*!****************************************************!*\
//   !*** ../node_modules/ansi-html-community/index.js ***!
//   \****************************************************/
// /***/ (function(module) {

// "use strict";


// module.exports = ansiHTML

// // Reference to https://github.com/sindresorhus/ansi-regex
// var _regANSI = /(?:(?:\u001b\[)|\u009b)(?:(?:[0-9]{1,3})?(?:(?:;[0-9]{0,3})*)?[A-M|f-m])|\u001b[A-M]/

// var _defColors = {
//   reset: ['fff', '000'], // [FOREGROUD_COLOR, BACKGROUND_COLOR]
//   black: '000',
//   red: 'ff0000',
//   green: '209805',
//   yellow: 'e8bf03',
//   blue: '0000ff',
//   magenta: 'ff00ff',
//   cyan: '00ffee',
//   lightgrey: 'f0f0f0',
//   darkgrey: '888'
// }
// var _styles = {
//   30: 'black',
//   31: 'red',
//   32: 'green',
//   33: 'yellow',
//   34: 'blue',
//   35: 'magenta',
//   36: 'cyan',
//   37: 'lightgrey'
// }
// var _openTags = {
//   '1': 'font-weight:bold', // bold
//   '2': 'opacity:0.5', // dim
//   '3': '<i>', // italic
//   '4': '<u>', // underscore
//   '8': 'display:none', // hidden
//   '9': '<del>' // delete
// }
// var _closeTags = {
//   '23': '</i>', // reset italic
//   '24': '</u>', // reset underscore
//   '29': '</del>' // reset delete
// }

// ;[0, 21, 22, 27, 28, 39, 49].forEach(function (n) {
//   _closeTags[n] = '</span>'
// })

// /**
//  * Converts text with ANSI color codes to HTML markup.
//  * @param {String} text
//  * @returns {*}
//  */
// function ansiHTML (text) {
//   // Returns the text if the string has no ANSI escape code.
//   if (!_regANSI.test(text)) {
//     return text
//   }

//   // Cache opened sequence.
//   var ansiCodes = []
//   // Replace with markup.
//   var ret = text.replace(/\033\[(\d+)m/g, function (match, seq) {
//     var ot = _openTags[seq]
//     if (ot) {
//       // If current sequence has been opened, close it.
//       if (!!~ansiCodes.indexOf(seq)) { // eslint-disable-line no-extra-boolean-cast
//         ansiCodes.pop()
//         return '</span>'
//       }
//       // Open tag.
//       ansiCodes.push(seq)
//       return ot[0] === '<' ? ot : '<span style="' + ot + ';">'
//     }

//     var ct = _closeTags[seq]
//     if (ct) {
//       // Pop sequence
//       ansiCodes.pop()
//       return ct
//     }
//     return ''
//   })

//   // Make sure tags are closed.
//   var l = ansiCodes.length
//   ;(l > 0) && (ret += Array(l + 1).join('</span>'))

//   return ret
// }

// /**
//  * Customize colors.
//  * @param {Object} colors reference to _defColors
//  */
// ansiHTML.setColors = function (colors) {
//   if (typeof colors !== 'object') {
//     throw new Error('`colors` parameter must be an Object.')
//   }

//   var _finalColors = {}
//   for (var key in _defColors) {
//     var hex = colors.hasOwnProperty(key) ? colors[key] : null
//     if (!hex) {
//       _finalColors[key] = _defColors[key]
//       continue
//     }
//     if ('reset' === key) {
//       if (typeof hex === 'string') {
//         hex = [hex]
//       }
//       if (!Array.isArray(hex) || hex.length === 0 || hex.some(function (h) {
//         return typeof h !== 'string'
//       })) {
//         throw new Error('The value of `' + key + '` property must be an Array and each item could only be a hex string, e.g.: FF0000')
//       }
//       var defHexColor = _defColors[key]
//       if (!hex[0]) {
//         hex[0] = defHexColor[0]
//       }
//       if (hex.length === 1 || !hex[1]) {
//         hex = [hex[0]]
//         hex.push(defHexColor[1])
//       }

//       hex = hex.slice(0, 2)
//     } else if (typeof hex !== 'string') {
//       throw new Error('The value of `' + key + '` property must be a hex string, e.g.: FF0000')
//     }
//     _finalColors[key] = hex
//   }
//   _setTags(_finalColors)
// }

// /**
//  * Reset colors.
//  */
// ansiHTML.reset = function () {
//   _setTags(_defColors)
// }

// /**
//  * Expose tags, including open and close.
//  * @type {Object}
//  */
// ansiHTML.tags = {}

// if (Object.defineProperty) {
//   Object.defineProperty(ansiHTML.tags, 'open', {
//     get: function () { return _openTags }
//   })
//   Object.defineProperty(ansiHTML.tags, 'close', {
//     get: function () { return _closeTags }
//   })
// } else {
//   ansiHTML.tags.open = _openTags
//   ansiHTML.tags.close = _closeTags
// }

// function _setTags (colors) {
//   // reset all
//   _openTags['0'] = 'font-weight:normal;opacity:1;color:#' + colors.reset[0] + ';background:#' + colors.reset[1]
//   // inverse
//   _openTags['7'] = 'color:#' + colors.reset[1] + ';background:#' + colors.reset[0]
//   // dark grey
//   _openTags['90'] = 'color:#' + colors.darkgrey

//   for (var code in _styles) {
//     var color = _styles[code]
//     var oriColor = colors[color] || '000'
//     _openTags[code] = 'color:#' + oriColor
//     code = parseInt(code)
//     _openTags[(code + 10).toString()] = 'background:#' + oriColor
//   }
// }

// ansiHTML.reset()


// /***/ }),

// /***/ "../node_modules/events/events.js":
// /*!****************************************!*\
//   !*** ../node_modules/events/events.js ***!
//   \****************************************/
// /***/ (function(module) {

// "use strict";
// // Copyright Joyent, Inc. and other Node contributors.
// //
// // Permission is hereby granted, free of charge, to any person obtaining a
// // copy of this software and associated documentation files (the
// // "Software"), to deal in the Software without restriction, including
// // without limitation the rights to use, copy, modify, merge, publish,
// // distribute, sublicense, and/or sell copies of the Software, and to permit
// // persons to whom the Software is furnished to do so, subject to the
// // following conditions:
// //
// // The above copyright notice and this permission notice shall be included
// // in all copies or substantial portions of the Software.
// //
// // THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS
// // OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
// // MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN
// // NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM,
// // DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR
// // OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE
// // USE OR OTHER DEALINGS IN THE SOFTWARE.



// var R = typeof Reflect === 'object' ? Reflect : null
// var ReflectApply = R && typeof R.apply === 'function'
//   ? R.apply
//   : function ReflectApply(target, receiver, args) {
//     return Function.prototype.apply.call(target, receiver, args);
//   }

// var ReflectOwnKeys
// if (R && typeof R.ownKeys === 'function') {
//   ReflectOwnKeys = R.ownKeys
// } else if (Object.getOwnPropertySymbols) {
//   ReflectOwnKeys = function ReflectOwnKeys(target) {
//     return Object.getOwnPropertyNames(target)
//       .concat(Object.getOwnPropertySymbols(target));
//   };
// } else {
//   ReflectOwnKeys = function ReflectOwnKeys(target) {
//     return Object.getOwnPropertyNames(target);
//   };
// }

// function ProcessEmitWarning(warning) {
//   if (console && console.warn) console.warn(warning);
// }

// var NumberIsNaN = Number.isNaN || function NumberIsNaN(value) {
//   return value !== value;
// }

// function EventEmitter() {
//   EventEmitter.init.call(this);
// }
// module.exports = EventEmitter;
// module.exports.once = once;

// // Backwards-compat with node 0.10.x
// EventEmitter.EventEmitter = EventEmitter;

// EventEmitter.prototype._events = undefined;
// EventEmitter.prototype._eventsCount = 0;
// EventEmitter.prototype._maxListeners = undefined;

// // By default EventEmitters will print a warning if more than 10 listeners are
// // added to it. This is a useful default which helps finding memory leaks.
// var defaultMaxListeners = 10;

// function checkListener(listener) {
//   if (typeof listener !== 'function') {
//     throw new TypeError('The "listener" argument must be of type Function. Received type ' + typeof listener);
//   }
// }

// Object.defineProperty(EventEmitter, 'defaultMaxListeners', {
//   enumerable: true,
//   get: function() {
//     return defaultMaxListeners;
//   },
//   set: function(arg) {
//     if (typeof arg !== 'number' || arg < 0 || NumberIsNaN(arg)) {
//       throw new RangeError('The value of "defaultMaxListeners" is out of range. It must be a non-negative number. Received ' + arg + '.');
//     }
//     defaultMaxListeners = arg;
//   }
// });

// EventEmitter.init = function() {

//   if (this._events === undefined ||
//       this._events === Object.getPrototypeOf(this)._events) {
//     this._events = Object.create(null);
//     this._eventsCount = 0;
//   }

//   this._maxListeners = this._maxListeners || undefined;
// };

// // Obviously not all Emitters should be limited to 10. This function allows
// // that to be increased. Set to zero for unlimited.
// EventEmitter.prototype.setMaxListeners = function setMaxListeners(n) {
//   if (typeof n !== 'number' || n < 0 || NumberIsNaN(n)) {
//     throw new RangeError('The value of "n" is out of range. It must be a non-negative number. Received ' + n + '.');
//   }
//   this._maxListeners = n;
//   return this;
// };

// function _getMaxListeners(that) {
//   if (that._maxListeners === undefined)
//     return EventEmitter.defaultMaxListeners;
//   return that._maxListeners;
// }

// EventEmitter.prototype.getMaxListeners = function getMaxListeners() {
//   return _getMaxListeners(this);
// };

// EventEmitter.prototype.emit = function emit(type) {
//   var args = [];
//   for (var i = 1; i < arguments.length; i++) args.push(arguments[i]);
//   var doError = (type === 'error');

//   var events = this._events;
//   if (events !== undefined)
//     doError = (doError && events.error === undefined);
//   else if (!doError)
//     return false;

//   // If there is no 'error' event listener then throw.
//   if (doError) {
//     var er;
//     if (args.length > 0)
//       er = args[0];
//     if (er instanceof Error) {
//       // Note: The comments on the `throw` lines are intentional, they show
//       // up in Node's output if this results in an unhandled exception.
//       throw er; // Unhandled 'error' event
//     }
//     // At least give some kind of context to the user
//     var err = new Error('Unhandled error.' + (er ? ' (' + er.message + ')' : ''));
//     err.context = er;
//     throw err; // Unhandled 'error' event
//   }

//   var handler = events[type];

//   if (handler === undefined)
//     return false;

//   if (typeof handler === 'function') {
//     ReflectApply(handler, this, args);
//   } else {
//     var len = handler.length;
//     var listeners = arrayClone(handler, len);
//     for (var i = 0; i < len; ++i)
//       ReflectApply(listeners[i], this, args);
//   }

//   return true;
// };

// function _addListener(target, type, listener, prepend) {
//   var m;
//   var events;
//   var existing;

//   checkListener(listener);

//   events = target._events;
//   if (events === undefined) {
//     events = target._events = Object.create(null);
//     target._eventsCount = 0;
//   } else {
//     // To avoid recursion in the case that type === "newListener"! Before
//     // adding it to the listeners, first emit "newListener".
//     if (events.newListener !== undefined) {
//       target.emit('newListener', type,
//                   listener.listener ? listener.listener : listener);

//       // Re-assign `events` because a newListener handler could have caused the
//       // this._events to be assigned to a new object
//       events = target._events;
//     }
//     existing = events[type];
//   }

//   if (existing === undefined) {
//     // Optimize the case of one listener. Don't need the extra array object.
//     existing = events[type] = listener;
//     ++target._eventsCount;
//   } else {
//     if (typeof existing === 'function') {
//       // Adding the second element, need to change to array.
//       existing = events[type] =
//         prepend ? [listener, existing] : [existing, listener];
//       // If we've already got an array, just append.
//     } else if (prepend) {
//       existing.unshift(listener);
//     } else {
//       existing.push(listener);
//     }

//     // Check for listener leak
//     m = _getMaxListeners(target);
//     if (m > 0 && existing.length > m && !existing.warned) {
//       existing.warned = true;
//       // No error code for this since it is a Warning
//       // eslint-disable-next-line no-restricted-syntax
//       var w = new Error('Possible EventEmitter memory leak detected. ' +
//                           existing.length + ' ' + String(type) + ' listeners ' +
//                           'added. Use emitter.setMaxListeners() to ' +
//                           'increase limit');
//       w.name = 'MaxListenersExceededWarning';
//       w.emitter = target;
//       w.type = type;
//       w.count = existing.length;
//       ProcessEmitWarning(w);
//     }
//   }

//   return target;
// }

// EventEmitter.prototype.addListener = function addListener(type, listener) {
//   return _addListener(this, type, listener, false);
// };

// EventEmitter.prototype.on = EventEmitter.prototype.addListener;

// EventEmitter.prototype.prependListener =
//     function prependListener(type, listener) {
//       return _addListener(this, type, listener, true);
//     };

// function onceWrapper() {
//   if (!this.fired) {
//     this.target.removeListener(this.type, this.wrapFn);
//     this.fired = true;
//     if (arguments.length === 0)
//       return this.listener.call(this.target);
//     return this.listener.apply(this.target, arguments);
//   }
// }

// function _onceWrap(target, type, listener) {
//   var state = { fired: false, wrapFn: undefined, target: target, type: type, listener: listener };
//   var wrapped = onceWrapper.bind(state);
//   wrapped.listener = listener;
//   state.wrapFn = wrapped;
//   return wrapped;
// }

// EventEmitter.prototype.once = function once(type, listener) {
//   checkListener(listener);
//   this.on(type, _onceWrap(this, type, listener));
//   return this;
// };

// EventEmitter.prototype.prependOnceListener =
//     function prependOnceListener(type, listener) {
//       checkListener(listener);
//       this.prependListener(type, _onceWrap(this, type, listener));
//       return this;
//     };

// // Emits a 'removeListener' event if and only if the listener was removed.
// EventEmitter.prototype.removeListener =
//     function removeListener(type, listener) {
//       var list, events, position, i, originalListener;

//       checkListener(listener);

//       events = this._events;
//       if (events === undefined)
//         return this;

//       list = events[type];
//       if (list === undefined)
//         return this;

//       if (list === listener || list.listener === listener) {
//         if (--this._eventsCount === 0)
//           this._events = Object.create(null);
//         else {
//           delete events[type];
//           if (events.removeListener)
//             this.emit('removeListener', type, list.listener || listener);
//         }
//       } else if (typeof list !== 'function') {
//         position = -1;

//         for (i = list.length - 1; i >= 0; i--) {
//           if (list[i] === listener || list[i].listener === listener) {
//             originalListener = list[i].listener;
//             position = i;
//             break;
//           }
//         }

//         if (position < 0)
//           return this;

//         if (position === 0)
//           list.shift();
//         else {
//           spliceOne(list, position);
//         }

//         if (list.length === 1)
//           events[type] = list[0];

//         if (events.removeListener !== undefined)
//           this.emit('removeListener', type, originalListener || listener);
//       }

//       return this;
//     };

// EventEmitter.prototype.off = EventEmitter.prototype.removeListener;

// EventEmitter.prototype.removeAllListeners =
//     function removeAllListeners(type) {
//       var listeners, events, i;

//       events = this._events;
//       if (events === undefined)
//         return this;

//       // not listening for removeListener, no need to emit
//       if (events.removeListener === undefined) {
//         if (arguments.length === 0) {
//           this._events = Object.create(null);
//           this._eventsCount = 0;
//         } else if (events[type] !== undefined) {
//           if (--this._eventsCount === 0)
//             this._events = Object.create(null);
//           else
//             delete events[type];
//         }
//         return this;
//       }

//       // emit removeListener for all listeners on all events
//       if (arguments.length === 0) {
//         var keys = Object.keys(events);
//         var key;
//         for (i = 0; i < keys.length; ++i) {
//           key = keys[i];
//           if (key === 'removeListener') continue;
//           this.removeAllListeners(key);
//         }
//         this.removeAllListeners('removeListener');
//         this._events = Object.create(null);
//         this._eventsCount = 0;
//         return this;
//       }

//       listeners = events[type];

//       if (typeof listeners === 'function') {
//         this.removeListener(type, listeners);
//       } else if (listeners !== undefined) {
//         // LIFO order
//         for (i = listeners.length - 1; i >= 0; i--) {
//           this.removeListener(type, listeners[i]);
//         }
//       }

//       return this;
//     };

// function _listeners(target, type, unwrap) {
//   var events = target._events;

//   if (events === undefined)
//     return [];

//   var evlistener = events[type];
//   if (evlistener === undefined)
//     return [];

//   if (typeof evlistener === 'function')
//     return unwrap ? [evlistener.listener || evlistener] : [evlistener];

//   return unwrap ?
//     unwrapListeners(evlistener) : arrayClone(evlistener, evlistener.length);
// }

// EventEmitter.prototype.listeners = function listeners(type) {
//   return _listeners(this, type, true);
// };

// EventEmitter.prototype.rawListeners = function rawListeners(type) {
//   return _listeners(this, type, false);
// };

// EventEmitter.listenerCount = function(emitter, type) {
//   if (typeof emitter.listenerCount === 'function') {
//     return emitter.listenerCount(type);
//   } else {
//     return listenerCount.call(emitter, type);
//   }
// };

// EventEmitter.prototype.listenerCount = listenerCount;
// function listenerCount(type) {
//   var events = this._events;

//   if (events !== undefined) {
//     var evlistener = events[type];

//     if (typeof evlistener === 'function') {
//       return 1;
//     } else if (evlistener !== undefined) {
//       return evlistener.length;
//     }
//   }

//   return 0;
// }

// EventEmitter.prototype.eventNames = function eventNames() {
//   return this._eventsCount > 0 ? ReflectOwnKeys(this._events) : [];
// };

// function arrayClone(arr, n) {
//   var copy = new Array(n);
//   for (var i = 0; i < n; ++i)
//     copy[i] = arr[i];
//   return copy;
// }

// function spliceOne(list, index) {
//   for (; index + 1 < list.length; index++)
//     list[index] = list[index + 1];
//   list.pop();
// }

// function unwrapListeners(arr) {
//   var ret = new Array(arr.length);
//   for (var i = 0; i < ret.length; ++i) {
//     ret[i] = arr[i].listener || arr[i];
//   }
//   return ret;
// }

// function once(emitter, name) {
//   return new Promise(function (resolve, reject) {
//     function errorListener(err) {
//       emitter.removeListener(name, resolver);
//       reject(err);
//     }

//     function resolver() {
//       if (typeof emitter.removeListener === 'function') {
//         emitter.removeListener('error', errorListener);
//       }
//       resolve([].slice.call(arguments));
//     };

//     eventTargetAgnosticAddListener(emitter, name, resolver, { once: true });
//     if (name !== 'error') {
//       addErrorHandlerIfEventEmitter(emitter, errorListener, { once: true });
//     }
//   });
// }

// function addErrorHandlerIfEventEmitter(emitter, handler, flags) {
//   if (typeof emitter.on === 'function') {
//     eventTargetAgnosticAddListener(emitter, 'error', handler, flags);
//   }
// }

// function eventTargetAgnosticAddListener(emitter, name, listener, flags) {
//   if (typeof emitter.on === 'function') {
//     if (flags.once) {
//       emitter.once(name, listener);
//     } else {
//       emitter.on(name, listener);
//     }
//   } else if (typeof emitter.addEventListener === 'function') {
//     // EventTarget does not have `error` event semantics like Node
//     // EventEmitters, we do not listen for `error` events here.
//     emitter.addEventListener(name, function wrapListener(arg) {
//       // IE does not have builtin `{ once: true }` support so we
//       // have to do it manually.
//       if (flags.once) {
//         emitter.removeEventListener(name, wrapListener);
//       }
//       listener(arg);
//     });
//   } else {
//     throw new TypeError('The "emitter" argument must be of type EventEmitter. Received type ' + typeof emitter);
//   }
// }


// /***/ }),

// /***/ "../node_modules/webpack-dev-server/client/clients/WebSocketClient.js":
// /*!****************************************************************************!*\
//   !*** ../node_modules/webpack-dev-server/client/clients/WebSocketClient.js ***!
//   \****************************************************************************/
// /***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

// "use strict";
// __webpack_require__.r(__webpack_exports__);
// /* harmony export */ __webpack_require__.d(__webpack_exports__, {
// /* harmony export */   "default": function() { return /* binding */ WebSocketClient; }
// /* harmony export */ });
// /* harmony import */ var _utils_log_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../utils/log.js */ "../node_modules/webpack-dev-server/client/utils/log.js");
// function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
// function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
// function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
// function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
// function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
// function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }

// var WebSocketClient = /*#__PURE__*/function () {
//   /**
//    * @param {string} url
//    */
//   function WebSocketClient(url) {
//     _classCallCheck(this, WebSocketClient);
//     this.client = new WebSocket(url);
//     this.client.onerror = function (error) {
//       _utils_log_js__WEBPACK_IMPORTED_MODULE_0__.log.error(error);
//     };
//   }

//   /**
//    * @param {(...args: any[]) => void} f
//    */
//   return _createClass(WebSocketClient, [{
//     key: "onOpen",
//     value: function onOpen(f) {
//       this.client.onopen = f;
//     }

//     /**
//      * @param {(...args: any[]) => void} f
//      */
//   }, {
//     key: "onClose",
//     value: function onClose(f) {
//       this.client.onclose = f;
//     }

//     // call f with the message string as the first argument
//     /**
//      * @param {(...args: any[]) => void} f
//      */
//   }, {
//     key: "onMessage",
//     value: function onMessage(f) {
//       this.client.onmessage = function (e) {
//         f(e.data);
//       };
//     }
//   }]);
// }();


// /***/ }),

// /***/ "../node_modules/webpack-dev-server/client/modules/logger/index.js":
// /*!*************************************************************************!*\
//   !*** ../node_modules/webpack-dev-server/client/modules/logger/index.js ***!
//   \*************************************************************************/
// /***/ (function(__unused_webpack_module, exports) {

// /******/ (function() { // webpackBootstrap
// /******/ 	"use strict";
// /******/ 	var __webpack_modules__ = ({

// /***/ "./client-src/modules/logger/tapable.js":
// /*!**********************************************!*\
//   !*** ./client-src/modules/logger/tapable.js ***!
//   \**********************************************/
// /***/ (function(__unused_webpack_module, __nested_webpack_exports__, __webpack_require__) {

// __webpack_require__.r(__nested_webpack_exports__);
// /* harmony export */ __webpack_require__.d(__nested_webpack_exports__, {
// /* harmony export */   SyncBailHook: function() { return /* binding */ SyncBailHook; }
// /* harmony export */ });
// function SyncBailHook() {
//   return {
//     call: function call() {}
//   };
// }

// /**
//  * Client stub for tapable SyncBailHook
//  */
// // eslint-disable-next-line import/prefer-default-export


// /***/ }),

// /***/ "./node_modules/webpack/lib/logging/Logger.js":
// /*!****************************************************!*\
//   !*** ./node_modules/webpack/lib/logging/Logger.js ***!
//   \****************************************************/
// /***/ (function(module) {

// /*
// 	MIT License http://www.opensource.org/licenses/mit-license.php
// 	Author Tobias Koppers @sokra
// */



// function _typeof(o) {
//   "@babel/helpers - typeof";

//   return _typeof = "function" == typeof (typeof Symbol !== "undefined" ? Symbol : function (i) { return i; }) && "symbol" == typeof (typeof Symbol !== "undefined" ? Symbol : function (i) { return i; }).iterator ? function (o) {
//     return typeof o;
//   } : function (o) {
//     return o && "function" == typeof (typeof Symbol !== "undefined" ? Symbol : function (i) { return i; }) && o.constructor === (typeof Symbol !== "undefined" ? Symbol : function (i) { return i; }) && o !== (typeof Symbol !== "undefined" ? Symbol : function (i) { return i; }).prototype ? "symbol" : typeof o;
//   }, _typeof(o);
// }
// function _toConsumableArray(r) {
//   return _arrayWithoutHoles(r) || _iterableToArray(r) || _unsupportedIterableToArray(r) || _nonIterableSpread();
// }
// function _nonIterableSpread() {
//   throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.");
// }
// function _unsupportedIterableToArray(r, a) {
//   if (r) {
//     if ("string" == typeof r) return _arrayLikeToArray(r, a);
//     var t = {}.toString.call(r).slice(8, -1);
//     return "Object" === t && r.constructor && (t = r.constructor.name), "Map" === t || "Set" === t ? Array.from(r) : "Arguments" === t || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(t) ? _arrayLikeToArray(r, a) : void 0;
//   }
// }
// function _iterableToArray(r) {
//   if ("undefined" != typeof (typeof Symbol !== "undefined" ? Symbol : function (i) { return i; }) && null != r[(typeof Symbol !== "undefined" ? Symbol : function (i) { return i; }).iterator] || null != r["@@iterator"]) return Array.from(r);
// }
// function _arrayWithoutHoles(r) {
//   if (Array.isArray(r)) return _arrayLikeToArray(r);
// }
// function _arrayLikeToArray(r, a) {
//   (null == a || a > r.length) && (a = r.length);
//   for (var e = 0, n = Array(a); e < a; e++) n[e] = r[e];
//   return n;
// }
// function _classCallCheck(a, n) {
//   if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function");
// }
// function _defineProperties(e, r) {
//   for (var t = 0; t < r.length; t++) {
//     var o = r[t];
//     o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o);
//   }
// }
// function _createClass(e, r, t) {
//   return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", {
//     writable: !1
//   }), e;
// }
// function _toPropertyKey(t) {
//   var i = _toPrimitive(t, "string");
//   return "symbol" == _typeof(i) ? i : i + "";
// }
// function _toPrimitive(t, r) {
//   if ("object" != _typeof(t) || !t) return t;
//   var e = t[(typeof Symbol !== "undefined" ? Symbol : function (i) { return i; }).toPrimitive];
//   if (void 0 !== e) {
//     var i = e.call(t, r || "default");
//     if ("object" != _typeof(i)) return i;
//     throw new TypeError("@@toPrimitive must return a primitive value.");
//   }
//   return ("string" === r ? String : Number)(t);
// }
// var LogType = Object.freeze({
//   error: (/** @type {"error"} */"error"),
//   // message, c style arguments
//   warn: (/** @type {"warn"} */"warn"),
//   // message, c style arguments
//   info: (/** @type {"info"} */"info"),
//   // message, c style arguments
//   log: (/** @type {"log"} */"log"),
//   // message, c style arguments
//   debug: (/** @type {"debug"} */"debug"),
//   // message, c style arguments

//   trace: (/** @type {"trace"} */"trace"),
//   // no arguments

//   group: (/** @type {"group"} */"group"),
//   // [label]
//   groupCollapsed: (/** @type {"groupCollapsed"} */"groupCollapsed"),
//   // [label]
//   groupEnd: (/** @type {"groupEnd"} */"groupEnd"),
//   // [label]

//   profile: (/** @type {"profile"} */"profile"),
//   // [profileName]
//   profileEnd: (/** @type {"profileEnd"} */"profileEnd"),
//   // [profileName]

//   time: (/** @type {"time"} */"time"),
//   // name, time as [seconds, nanoseconds]

//   clear: (/** @type {"clear"} */"clear"),
//   // no arguments
//   status: (/** @type {"status"} */"status") // message, arguments
// });
// module.exports.LogType = LogType;

// /** @typedef {typeof LogType[keyof typeof LogType]} LogTypeEnum */

// var LOG_SYMBOL = (typeof Symbol !== "undefined" ? Symbol : function (i) { return i; })("webpack logger raw log method");
// var TIMERS_SYMBOL = (typeof Symbol !== "undefined" ? Symbol : function (i) { return i; })("webpack logger times");
// var TIMERS_AGGREGATES_SYMBOL = (typeof Symbol !== "undefined" ? Symbol : function (i) { return i; })("webpack logger aggregated times");
// var WebpackLogger = /*#__PURE__*/function () {
//   /**
//    * @param {(type: LogTypeEnum, args?: EXPECTED_ANY[]) => void} log log function
//    * @param {(name: string | (() => string)) => WebpackLogger} getChildLogger function to create child logger
//    */
//   function WebpackLogger(log, getChildLogger) {
//     _classCallCheck(this, WebpackLogger);
//     this[LOG_SYMBOL] = log;
//     this.getChildLogger = getChildLogger;
//   }

//   /**
//    * @param {...EXPECTED_ANY} args args
//    */
//   return _createClass(WebpackLogger, [{
//     key: "error",
//     value: function error() {
//       for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
//         args[_key] = arguments[_key];
//       }
//       this[LOG_SYMBOL](LogType.error, args);
//     }

//     /**
//      * @param {...EXPECTED_ANY} args args
//      */
//   }, {
//     key: "warn",
//     value: function warn() {
//       for (var _len2 = arguments.length, args = new Array(_len2), _key2 = 0; _key2 < _len2; _key2++) {
//         args[_key2] = arguments[_key2];
//       }
//       this[LOG_SYMBOL](LogType.warn, args);
//     }

//     /**
//      * @param {...EXPECTED_ANY} args args
//      */
//   }, {
//     key: "info",
//     value: function info() {
//       for (var _len3 = arguments.length, args = new Array(_len3), _key3 = 0; _key3 < _len3; _key3++) {
//         args[_key3] = arguments[_key3];
//       }
//       this[LOG_SYMBOL](LogType.info, args);
//     }

//     /**
//      * @param {...EXPECTED_ANY} args args
//      */
//   }, {
//     key: "log",
//     value: function log() {
//       for (var _len4 = arguments.length, args = new Array(_len4), _key4 = 0; _key4 < _len4; _key4++) {
//         args[_key4] = arguments[_key4];
//       }
//       this[LOG_SYMBOL](LogType.log, args);
//     }

//     /**
//      * @param {...EXPECTED_ANY} args args
//      */
//   }, {
//     key: "debug",
//     value: function debug() {
//       for (var _len5 = arguments.length, args = new Array(_len5), _key5 = 0; _key5 < _len5; _key5++) {
//         args[_key5] = arguments[_key5];
//       }
//       this[LOG_SYMBOL](LogType.debug, args);
//     }

//     /**
//      * @param {EXPECTED_ANY} assertion assertion
//      * @param {...EXPECTED_ANY} args args
//      */
//   }, {
//     key: "assert",
//     value: function assert(assertion) {
//       if (!assertion) {
//         for (var _len6 = arguments.length, args = new Array(_len6 > 1 ? _len6 - 1 : 0), _key6 = 1; _key6 < _len6; _key6++) {
//           args[_key6 - 1] = arguments[_key6];
//         }
//         this[LOG_SYMBOL](LogType.error, args);
//       }
//     }
//   }, {
//     key: "trace",
//     value: function trace() {
//       this[LOG_SYMBOL](LogType.trace, ["Trace"]);
//     }
//   }, {
//     key: "clear",
//     value: function clear() {
//       this[LOG_SYMBOL](LogType.clear);
//     }

//     /**
//      * @param {...EXPECTED_ANY} args args
//      */
//   }, {
//     key: "status",
//     value: function status() {
//       for (var _len7 = arguments.length, args = new Array(_len7), _key7 = 0; _key7 < _len7; _key7++) {
//         args[_key7] = arguments[_key7];
//       }
//       this[LOG_SYMBOL](LogType.status, args);
//     }

//     /**
//      * @param {...EXPECTED_ANY} args args
//      */
//   }, {
//     key: "group",
//     value: function group() {
//       for (var _len8 = arguments.length, args = new Array(_len8), _key8 = 0; _key8 < _len8; _key8++) {
//         args[_key8] = arguments[_key8];
//       }
//       this[LOG_SYMBOL](LogType.group, args);
//     }

//     /**
//      * @param {...EXPECTED_ANY} args args
//      */
//   }, {
//     key: "groupCollapsed",
//     value: function groupCollapsed() {
//       for (var _len9 = arguments.length, args = new Array(_len9), _key9 = 0; _key9 < _len9; _key9++) {
//         args[_key9] = arguments[_key9];
//       }
//       this[LOG_SYMBOL](LogType.groupCollapsed, args);
//     }
//   }, {
//     key: "groupEnd",
//     value: function groupEnd() {
//       this[LOG_SYMBOL](LogType.groupEnd);
//     }

//     /**
//      * @param {string=} label label
//      */
//   }, {
//     key: "profile",
//     value: function profile(label) {
//       this[LOG_SYMBOL](LogType.profile, [label]);
//     }

//     /**
//      * @param {string=} label label
//      */
//   }, {
//     key: "profileEnd",
//     value: function profileEnd(label) {
//       this[LOG_SYMBOL](LogType.profileEnd, [label]);
//     }

//     /**
//      * @param {string} label label
//      */
//   }, {
//     key: "time",
//     value: function time(label) {
//       /** @type {Map<string | undefined, [number, number]>} */
//       this[TIMERS_SYMBOL] = this[TIMERS_SYMBOL] || new Map();
//       this[TIMERS_SYMBOL].set(label, process.hrtime());
//     }

//     /**
//      * @param {string=} label label
//      */
//   }, {
//     key: "timeLog",
//     value: function timeLog(label) {
//       var prev = this[TIMERS_SYMBOL] && this[TIMERS_SYMBOL].get(label);
//       if (!prev) {
//         throw new Error("No such label '".concat(label, "' for WebpackLogger.timeLog()"));
//       }
//       var time = process.hrtime(prev);
//       this[LOG_SYMBOL](LogType.time, [label].concat(_toConsumableArray(time)));
//     }

//     /**
//      * @param {string=} label label
//      */
//   }, {
//     key: "timeEnd",
//     value: function timeEnd(label) {
//       var prev = this[TIMERS_SYMBOL] && this[TIMERS_SYMBOL].get(label);
//       if (!prev) {
//         throw new Error("No such label '".concat(label, "' for WebpackLogger.timeEnd()"));
//       }
//       var time = process.hrtime(prev);
//       /** @type {Map<string | undefined, [number, number]>} */
//       this[TIMERS_SYMBOL].delete(label);
//       this[LOG_SYMBOL](LogType.time, [label].concat(_toConsumableArray(time)));
//     }

//     /**
//      * @param {string=} label label
//      */
//   }, {
//     key: "timeAggregate",
//     value: function timeAggregate(label) {
//       var prev = this[TIMERS_SYMBOL] && this[TIMERS_SYMBOL].get(label);
//       if (!prev) {
//         throw new Error("No such label '".concat(label, "' for WebpackLogger.timeAggregate()"));
//       }
//       var time = process.hrtime(prev);
//       /** @type {Map<string | undefined, [number, number]>} */
//       this[TIMERS_SYMBOL].delete(label);
//       /** @type {Map<string | undefined, [number, number]>} */
//       this[TIMERS_AGGREGATES_SYMBOL] = this[TIMERS_AGGREGATES_SYMBOL] || new Map();
//       var current = this[TIMERS_AGGREGATES_SYMBOL].get(label);
//       if (current !== undefined) {
//         if (time[1] + current[1] > 1e9) {
//           time[0] += current[0] + 1;
//           time[1] = time[1] - 1e9 + current[1];
//         } else {
//           time[0] += current[0];
//           time[1] += current[1];
//         }
//       }
//       this[TIMERS_AGGREGATES_SYMBOL].set(label, time);
//     }

//     /**
//      * @param {string=} label label
//      */
//   }, {
//     key: "timeAggregateEnd",
//     value: function timeAggregateEnd(label) {
//       if (this[TIMERS_AGGREGATES_SYMBOL] === undefined) return;
//       var time = this[TIMERS_AGGREGATES_SYMBOL].get(label);
//       if (time === undefined) return;
//       this[TIMERS_AGGREGATES_SYMBOL].delete(label);
//       this[LOG_SYMBOL](LogType.time, [label].concat(_toConsumableArray(time)));
//     }
//   }]);
// }();
// module.exports.Logger = WebpackLogger;

// /***/ }),

// /***/ "./node_modules/webpack/lib/logging/createConsoleLogger.js":
// /*!*****************************************************************!*\
//   !*** ./node_modules/webpack/lib/logging/createConsoleLogger.js ***!
//   \*****************************************************************/
// /***/ (function(module, __unused_webpack_exports, __webpack_require__) {

// /*
// 	MIT License http://www.opensource.org/licenses/mit-license.php
// 	Author Tobias Koppers @sokra
// */



// function _slicedToArray(r, e) {
//   return _arrayWithHoles(r) || _iterableToArrayLimit(r, e) || _unsupportedIterableToArray(r, e) || _nonIterableRest();
// }
// function _nonIterableRest() {
//   throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.");
// }
// function _iterableToArrayLimit(r, l) {
//   var t = null == r ? null : "undefined" != typeof (typeof Symbol !== "undefined" ? Symbol : function (i) { return i; }) && r[(typeof Symbol !== "undefined" ? Symbol : function (i) { return i; }).iterator] || r["@@iterator"];
//   if (null != t) {
//     var e,
//       n,
//       i,
//       u,
//       a = [],
//       f = !0,
//       o = !1;
//     try {
//       if (i = (t = t.call(r)).next, 0 === l) {
//         if (Object(t) !== t) return;
//         f = !1;
//       } else for (; !(f = (e = i.call(t)).done) && (a.push(e.value), a.length !== l); f = !0);
//     } catch (r) {
//       o = !0, n = r;
//     } finally {
//       try {
//         if (!f && null != t.return && (u = t.return(), Object(u) !== u)) return;
//       } finally {
//         if (o) throw n;
//       }
//     }
//     return a;
//   }
// }
// function _arrayWithHoles(r) {
//   if (Array.isArray(r)) return r;
// }
// function _toConsumableArray(r) {
//   return _arrayWithoutHoles(r) || _iterableToArray(r) || _unsupportedIterableToArray(r) || _nonIterableSpread();
// }
// function _nonIterableSpread() {
//   throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.");
// }
// function _unsupportedIterableToArray(r, a) {
//   if (r) {
//     if ("string" == typeof r) return _arrayLikeToArray(r, a);
//     var t = {}.toString.call(r).slice(8, -1);
//     return "Object" === t && r.constructor && (t = r.constructor.name), "Map" === t || "Set" === t ? Array.from(r) : "Arguments" === t || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(t) ? _arrayLikeToArray(r, a) : void 0;
//   }
// }
// function _iterableToArray(r) {
//   if ("undefined" != typeof (typeof Symbol !== "undefined" ? Symbol : function (i) { return i; }) && null != r[(typeof Symbol !== "undefined" ? Symbol : function (i) { return i; }).iterator] || null != r["@@iterator"]) return Array.from(r);
// }
// function _arrayWithoutHoles(r) {
//   if (Array.isArray(r)) return _arrayLikeToArray(r);
// }
// function _arrayLikeToArray(r, a) {
//   (null == a || a > r.length) && (a = r.length);
//   for (var e = 0, n = Array(a); e < a; e++) n[e] = r[e];
//   return n;
// }
// function _typeof(o) {
//   "@babel/helpers - typeof";

//   return _typeof = "function" == typeof (typeof Symbol !== "undefined" ? Symbol : function (i) { return i; }) && "symbol" == typeof (typeof Symbol !== "undefined" ? Symbol : function (i) { return i; }).iterator ? function (o) {
//     return typeof o;
//   } : function (o) {
//     return o && "function" == typeof (typeof Symbol !== "undefined" ? Symbol : function (i) { return i; }) && o.constructor === (typeof Symbol !== "undefined" ? Symbol : function (i) { return i; }) && o !== (typeof Symbol !== "undefined" ? Symbol : function (i) { return i; }).prototype ? "symbol" : typeof o;
//   }, _typeof(o);
// }
// var _require = __webpack_require__(/*! ./Logger */ "./node_modules/webpack/lib/logging/Logger.js"),
//   LogType = _require.LogType;

// /** @typedef {import("../../declarations/WebpackOptions").FilterItemTypes} FilterItemTypes */
// /** @typedef {import("../../declarations/WebpackOptions").FilterTypes} FilterTypes */
// /** @typedef {import("./Logger").LogTypeEnum} LogTypeEnum */

// /** @typedef {(item: string) => boolean} FilterFunction */
// /** @typedef {(value: string, type: LogTypeEnum, args?: EXPECTED_ANY[]) => void} LoggingFunction */

// /**
//  * @typedef {object} LoggerConsole
//  * @property {() => void} clear
//  * @property {() => void} trace
//  * @property {(...args: EXPECTED_ANY[]) => void} info
//  * @property {(...args: EXPECTED_ANY[]) => void} log
//  * @property {(...args: EXPECTED_ANY[]) => void} warn
//  * @property {(...args: EXPECTED_ANY[]) => void} error
//  * @property {(...args: EXPECTED_ANY[]) => void=} debug
//  * @property {(...args: EXPECTED_ANY[]) => void=} group
//  * @property {(...args: EXPECTED_ANY[]) => void=} groupCollapsed
//  * @property {(...args: EXPECTED_ANY[]) => void=} groupEnd
//  * @property {(...args: EXPECTED_ANY[]) => void=} status
//  * @property {(...args: EXPECTED_ANY[]) => void=} profile
//  * @property {(...args: EXPECTED_ANY[]) => void=} profileEnd
//  * @property {(...args: EXPECTED_ANY[]) => void=} logTime
//  */

// /**
//  * @typedef {object} LoggerOptions
//  * @property {false|true|"none"|"error"|"warn"|"info"|"log"|"verbose"} level loglevel
//  * @property {FilterTypes|boolean} debug filter for debug logging
//  * @property {LoggerConsole} console the console to log to
//  */

// /**
//  * @param {FilterItemTypes} item an input item
//  * @returns {FilterFunction | undefined} filter function
//  */
// var filterToFunction = function filterToFunction(item) {
//   if (typeof item === "string") {
//     var regExp = new RegExp("[\\\\/]".concat(item.replace(/[-[\]{}()*+?.\\^$|]/g, "\\$&"), "([\\\\/]|$|!|\\?)"));
//     return function (ident) {
//       return regExp.test(ident);
//     };
//   }
//   if (item && _typeof(item) === "object" && typeof item.test === "function") {
//     return function (ident) {
//       return item.test(ident);
//     };
//   }
//   if (typeof item === "function") {
//     return item;
//   }
//   if (typeof item === "boolean") {
//     return function () {
//       return item;
//     };
//   }
// };

// /**
//  * @enum {number}
//  */
// var LogLevel = {
//   none: 6,
//   false: 6,
//   error: 5,
//   warn: 4,
//   info: 3,
//   log: 2,
//   true: 2,
//   verbose: 1
// };

// /**
//  * @param {LoggerOptions} options options object
//  * @returns {LoggingFunction} logging function
//  */
// module.exports = function (_ref) {
//   var _ref$level = _ref.level,
//     level = _ref$level === void 0 ? "info" : _ref$level,
//     _ref$debug = _ref.debug,
//     debug = _ref$debug === void 0 ? false : _ref$debug,
//     console = _ref.console;
//   var debugFilters = /** @type {FilterFunction[]} */

//   typeof debug === "boolean" ? [function () {
//     return debug;
//   }] : /** @type {FilterItemTypes[]} */[].concat(debug).map(filterToFunction);
//   var loglevel = LogLevel["".concat(level)] || 0;

//   /**
//    * @param {string} name name of the logger
//    * @param {LogTypeEnum} type type of the log entry
//    * @param {EXPECTED_ANY[]=} args arguments of the log entry
//    * @returns {void}
//    */
//   var logger = function logger(name, type, args) {
//     var labeledArgs = function labeledArgs() {
//       if (Array.isArray(args)) {
//         if (args.length > 0 && typeof args[0] === "string") {
//           return ["[".concat(name, "] ").concat(args[0])].concat(_toConsumableArray(args.slice(1)));
//         }
//         return ["[".concat(name, "]")].concat(_toConsumableArray(args));
//       }
//       return [];
//     };
//     var debug = debugFilters.some(function (f) {
//       return f(name);
//     });
//     switch (type) {
//       case LogType.debug:
//         if (!debug) return;
//         if (typeof console.debug === "function") {
//           console.debug.apply(console, _toConsumableArray(labeledArgs()));
//         } else {
//           console.log.apply(console, _toConsumableArray(labeledArgs()));
//         }
//         break;
//       case LogType.log:
//         if (!debug && loglevel > LogLevel.log) return;
//         console.log.apply(console, _toConsumableArray(labeledArgs()));
//         break;
//       case LogType.info:
//         if (!debug && loglevel > LogLevel.info) return;
//         console.info.apply(console, _toConsumableArray(labeledArgs()));
//         break;
//       case LogType.warn:
//         if (!debug && loglevel > LogLevel.warn) return;
//         console.warn.apply(console, _toConsumableArray(labeledArgs()));
//         break;
//       case LogType.error:
//         if (!debug && loglevel > LogLevel.error) return;
//         console.error.apply(console, _toConsumableArray(labeledArgs()));
//         break;
//       case LogType.trace:
//         if (!debug) return;
//         console.trace();
//         break;
//       case LogType.groupCollapsed:
//         if (!debug && loglevel > LogLevel.log) return;
//         if (!debug && loglevel > LogLevel.verbose) {
//           if (typeof console.groupCollapsed === "function") {
//             console.groupCollapsed.apply(console, _toConsumableArray(labeledArgs()));
//           } else {
//             console.log.apply(console, _toConsumableArray(labeledArgs()));
//           }
//           break;
//         }
//       // falls through
//       case LogType.group:
//         if (!debug && loglevel > LogLevel.log) return;
//         if (typeof console.group === "function") {
//           console.group.apply(console, _toConsumableArray(labeledArgs()));
//         } else {
//           console.log.apply(console, _toConsumableArray(labeledArgs()));
//         }
//         break;
//       case LogType.groupEnd:
//         if (!debug && loglevel > LogLevel.log) return;
//         if (typeof console.groupEnd === "function") {
//           console.groupEnd();
//         }
//         break;
//       case LogType.time:
//         {
//           if (!debug && loglevel > LogLevel.log) return;
//           var _args = _slicedToArray(/** @type {[string, number, number]} */
//             args, 3),
//             label = _args[0],
//             start = _args[1],
//             end = _args[2];
//           var ms = start * 1000 + end / 1000000;
//           var msg = "[".concat(name, "] ").concat(label, ": ").concat(ms, " ms");
//           if (typeof console.logTime === "function") {
//             console.logTime(msg);
//           } else {
//             console.log(msg);
//           }
//           break;
//         }
//       case LogType.profile:
//         if (typeof console.profile === "function") {
//           console.profile.apply(console, _toConsumableArray(labeledArgs()));
//         }
//         break;
//       case LogType.profileEnd:
//         if (typeof console.profileEnd === "function") {
//           console.profileEnd.apply(console, _toConsumableArray(labeledArgs()));
//         }
//         break;
//       case LogType.clear:
//         if (!debug && loglevel > LogLevel.log) return;
//         if (typeof console.clear === "function") {
//           console.clear();
//         }
//         break;
//       case LogType.status:
//         if (!debug && loglevel > LogLevel.info) return;
//         if (typeof console.status === "function") {
//           if (!args || args.length === 0) {
//             console.status();
//           } else {
//             console.status.apply(console, _toConsumableArray(labeledArgs()));
//           }
//         } else if (args && args.length !== 0) {
//           console.info.apply(console, _toConsumableArray(labeledArgs()));
//         }
//         break;
//       default:
//         throw new Error("Unexpected LogType ".concat(type));
//     }
//   };
//   return logger;
// };

// /***/ }),

// /***/ "./node_modules/webpack/lib/logging/runtime.js":
// /*!*****************************************************!*\
//   !*** ./node_modules/webpack/lib/logging/runtime.js ***!
//   \*****************************************************/
// /***/ (function(module, __unused_webpack_exports, __webpack_require__) {

// /*
// 	MIT License http://www.opensource.org/licenses/mit-license.php
// 	Author Tobias Koppers @sokra
// */



// function _extends() {
//   return _extends = Object.assign ? Object.assign.bind() : function (n) {
//     for (var e = 1; e < arguments.length; e++) {
//       var t = arguments[e];
//       for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]);
//     }
//     return n;
//   }, _extends.apply(null, arguments);
// }
// var _require = __webpack_require__(/*! tapable */ "./client-src/modules/logger/tapable.js"),
//   SyncBailHook = _require.SyncBailHook;
// var _require2 = __webpack_require__(/*! ./Logger */ "./node_modules/webpack/lib/logging/Logger.js"),
//   Logger = _require2.Logger;
// var createConsoleLogger = __webpack_require__(/*! ./createConsoleLogger */ "./node_modules/webpack/lib/logging/createConsoleLogger.js");

// /** @type {createConsoleLogger.LoggerOptions} */
// var currentDefaultLoggerOptions = {
//   level: "info",
//   debug: false,
//   console: console
// };
// var currentDefaultLogger = createConsoleLogger(currentDefaultLoggerOptions);

// /**
//  * @param {string} name name of the logger
//  * @returns {Logger} a logger
//  */
// module.exports.getLogger = function (name) {
//   return new Logger(function (type, args) {
//     if (module.exports.hooks.log.call(name, type, args) === undefined) {
//       currentDefaultLogger(name, type, args);
//     }
//   }, function (childName) {
//     return module.exports.getLogger("".concat(name, "/").concat(childName));
//   });
// };

// /**
//  * @param {createConsoleLogger.LoggerOptions} options new options, merge with old options
//  * @returns {void}
//  */
// module.exports.configureDefaultLogger = function (options) {
//   _extends(currentDefaultLoggerOptions, options);
//   currentDefaultLogger = createConsoleLogger(currentDefaultLoggerOptions);
// };
// module.exports.hooks = {
//   log: new SyncBailHook(["origin", "type", "args"])
// };

// /***/ })

// /******/ 	});
// /************************************************************************/
// /******/ 	// The module cache
// /******/ 	var __webpack_module_cache__ = {};
// /******/ 	
// /******/ 	// The require function
// /******/ 	function __nested_webpack_require_25855__(moduleId) {
// /******/ 		// Check if module is in cache
// /******/ 		var cachedModule = __webpack_module_cache__[moduleId];
// /******/ 		if (cachedModule !== undefined) {
// /******/ 			return cachedModule.exports;
// /******/ 		}
// /******/ 		// Create a new module (and put it into the cache)
// /******/ 		var module = __webpack_module_cache__[moduleId] = {
// /******/ 			// no module.id needed
// /******/ 			// no module.loaded needed
// /******/ 			exports: {}
// /******/ 		};
// /******/ 	
// /******/ 		// Execute the module function
// /******/ 		__webpack_modules__[moduleId](module, module.exports, __nested_webpack_require_25855__);
// /******/ 	
// /******/ 		// Return the exports of the module
// /******/ 		return module.exports;
// /******/ 	}
// /******/ 	
// /************************************************************************/
// /******/ 	/* webpack/runtime/define property getters */
// /******/ 	!function() {
// /******/ 		// define getter functions for harmony exports
// /******/ 		__nested_webpack_require_25855__.d = function(exports, definition) {
// /******/ 			for(var key in definition) {
// /******/ 				if(__nested_webpack_require_25855__.o(definition, key) && !__nested_webpack_require_25855__.o(exports, key)) {
// /******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
// /******/ 				}
// /******/ 			}
// /******/ 		};
// /******/ 	}();
// /******/ 	
// /******/ 	/* webpack/runtime/hasOwnProperty shorthand */
// /******/ 	!function() {
// /******/ 		__nested_webpack_require_25855__.o = function(obj, prop) { return Object.prototype.hasOwnProperty.call(obj, prop); }
// /******/ 	}();
// /******/ 	
// /******/ 	/* webpack/runtime/make namespace object */
// /******/ 	!function() {
// /******/ 		// define __esModule on exports
// /******/ 		__nested_webpack_require_25855__.r = function(exports) {
// /******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
// /******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
// /******/ 			}
// /******/ 			Object.defineProperty(exports, '__esModule', { value: true });
// /******/ 		};
// /******/ 	}();
// /******/ 	
// /************************************************************************/
// var __nested_webpack_exports__ = {};
// // This entry needs to be wrapped in an IIFE because it needs to be isolated against other modules in the chunk.
// !function() {
// /*!********************************************!*\
//   !*** ./client-src/modules/logger/index.js ***!
//   \********************************************/
// __nested_webpack_require_25855__.r(__nested_webpack_exports__);
// /* harmony export */ __nested_webpack_require_25855__.d(__nested_webpack_exports__, {
// /* harmony export */   "default": function() { return /* reexport default export from named module */ webpack_lib_logging_runtime_js__WEBPACK_IMPORTED_MODULE_0__; }
// /* harmony export */ });
// /* harmony import */ var webpack_lib_logging_runtime_js__WEBPACK_IMPORTED_MODULE_0__ = __nested_webpack_require_25855__(/*! webpack/lib/logging/runtime.js */ "./node_modules/webpack/lib/logging/runtime.js");

// }();
// var __webpack_export_target__ = exports;
// for(var __webpack_i__ in __nested_webpack_exports__) __webpack_export_target__[__webpack_i__] = __nested_webpack_exports__[__webpack_i__];
// if(__nested_webpack_exports__.__esModule) Object.defineProperty(__webpack_export_target__, "__esModule", { value: true });
// /******/ })()
// ;

// /***/ }),

// /***/ "../node_modules/webpack-dev-server/client/overlay.js":
// /*!************************************************************!*\
//   !*** ../node_modules/webpack-dev-server/client/overlay.js ***!
//   \************************************************************/
// /***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

// "use strict";
// __webpack_require__.r(__webpack_exports__);
// /* harmony export */ __webpack_require__.d(__webpack_exports__, {
// /* harmony export */   createOverlay: function() { return /* binding */ createOverlay; },
// /* harmony export */   formatProblem: function() { return /* binding */ formatProblem; }
// /* harmony export */ });
// /* harmony import */ var ansi_html_community__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ansi-html-community */ "../node_modules/ansi-html-community/index.js");
// /* harmony import */ var ansi_html_community__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(ansi_html_community__WEBPACK_IMPORTED_MODULE_0__);
// function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
// function ownKeys(e, r) { var t = Object.keys(e); if (Object.getOwnPropertySymbols) { var o = Object.getOwnPropertySymbols(e); r && (o = o.filter(function (r) { return Object.getOwnPropertyDescriptor(e, r).enumerable; })), t.push.apply(t, o); } return t; }
// function _objectSpread(e) { for (var r = 1; r < arguments.length; r++) { var t = null != arguments[r] ? arguments[r] : {}; r % 2 ? ownKeys(Object(t), !0).forEach(function (r) { _defineProperty(e, r, t[r]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(t)) : ownKeys(Object(t)).forEach(function (r) { Object.defineProperty(e, r, Object.getOwnPropertyDescriptor(t, r)); }); } return e; }
// function _defineProperty(e, r, t) { return (r = _toPropertyKey(r)) in e ? Object.defineProperty(e, r, { value: t, enumerable: !0, configurable: !0, writable: !0 }) : e[r] = t, e; }
// function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
// function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
// // The error overlay is inspired (and mostly copied) from Create React App (https://github.com/facebookincubator/create-react-app)
// // They, in turn, got inspired by webpack-hot-middleware (https://github.com/glenjamin/webpack-hot-middleware).



// /**
//  * @type {(input: string, position: number) => string}
//  */
// var getCodePoint = String.prototype.codePointAt ? function (input, position) {
//   return input.codePointAt(position);
// } : function (input, position) {
//   return (input.charCodeAt(position) - 0xd800) * 0x400 + input.charCodeAt(position + 1) - 0xdc00 + 0x10000;
// };

// /**
//  * @param {string} macroText
//  * @param {RegExp} macroRegExp
//  * @param {(input: string) => string} macroReplacer
//  * @returns {string}
//  */
// var replaceUsingRegExp = function replaceUsingRegExp(macroText, macroRegExp, macroReplacer) {
//   macroRegExp.lastIndex = 0;
//   var replaceMatch = macroRegExp.exec(macroText);
//   var replaceResult;
//   if (replaceMatch) {
//     replaceResult = "";
//     var replaceLastIndex = 0;
//     do {
//       if (replaceLastIndex !== replaceMatch.index) {
//         replaceResult += macroText.substring(replaceLastIndex, replaceMatch.index);
//       }
//       var replaceInput = replaceMatch[0];
//       replaceResult += macroReplacer(replaceInput);
//       replaceLastIndex = replaceMatch.index + replaceInput.length;
//       // eslint-disable-next-line no-cond-assign
//     } while (replaceMatch = macroRegExp.exec(macroText));
//     if (replaceLastIndex !== macroText.length) {
//       replaceResult += macroText.substring(replaceLastIndex);
//     }
//   } else {
//     replaceResult = macroText;
//   }
//   return replaceResult;
// };
// var references = {
//   "<": "&lt;",
//   ">": "&gt;",
//   '"': "&quot;",
//   "'": "&apos;",
//   "&": "&amp;"
// };

// /**
//  * @param {string} text text
//  * @returns {string}
//  */
// function encode(text) {
//   if (!text) {
//     return "";
//   }
//   return replaceUsingRegExp(text, /[<>'"&]/g, function (input) {
//     var result = references[input];
//     if (!result) {
//       var code = input.length > 1 ? getCodePoint(input, 0) : input.charCodeAt(0);
//       result = "&#".concat(code, ";");
//     }
//     return result;
//   });
// }

// /**
//  * @typedef {Object} StateDefinitions
//  * @property {{[event: string]: { target: string; actions?: Array<string> }}} [on]
//  */

// /**
//  * @typedef {Object} Options
//  * @property {{[state: string]: StateDefinitions}} states
//  * @property {object} context;
//  * @property {string} initial
//  */

// /**
//  * @typedef {Object} Implementation
//  * @property {{[actionName: string]: (ctx: object, event: any) => object}} actions
//  */

// /**
//  * A simplified `createMachine` from `@xstate/fsm` with the following differences:
//  *
//  *  - the returned machine is technically a "service". No `interpret(machine).start()` is needed.
//  *  - the state definition only support `on` and target must be declared with { target: 'nextState', actions: [] } explicitly.
//  *  - event passed to `send` must be an object with `type` property.
//  *  - actions implementation will be [assign action](https://xstate.js.org/docs/guides/context.html#assign-action) if you return any value.
//  *  Do not return anything if you just want to invoke side effect.
//  *
//  * The goal of this custom function is to avoid installing the entire `'xstate/fsm'` package, while enabling modeling using
//  * state machine. You can copy the first parameter into the editor at https://stately.ai/viz to visualize the state machine.
//  *
//  * @param {Options} options
//  * @param {Implementation} implementation
//  */
// function createMachine(_ref, _ref2) {
//   var states = _ref.states,
//     context = _ref.context,
//     initial = _ref.initial;
//   var actions = _ref2.actions;
//   var currentState = initial;
//   var currentContext = context;
//   return {
//     send: function send(event) {
//       var currentStateOn = states[currentState].on;
//       var transitionConfig = currentStateOn && currentStateOn[event.type];
//       if (transitionConfig) {
//         currentState = transitionConfig.target;
//         if (transitionConfig.actions) {
//           transitionConfig.actions.forEach(function (actName) {
//             var actionImpl = actions[actName];
//             var nextContextValue = actionImpl && actionImpl(currentContext, event);
//             if (nextContextValue) {
//               currentContext = _objectSpread(_objectSpread({}, currentContext), nextContextValue);
//             }
//           });
//         }
//       }
//     }
//   };
// }

// /**
//  * @typedef {Object} ShowOverlayData
//  * @property {'warning' | 'error'} level
//  * @property {Array<string  | { moduleIdentifier?: string, moduleName?: string, loc?: string, message?: string }>} messages
//  * @property {'build' | 'runtime'} messageSource
//  */

// /**
//  * @typedef {Object} CreateOverlayMachineOptions
//  * @property {(data: ShowOverlayData) => void} showOverlay
//  * @property {() => void} hideOverlay
//  */

// /**
//  * @param {CreateOverlayMachineOptions} options
//  */
// var createOverlayMachine = function createOverlayMachine(options) {
//   var hideOverlay = options.hideOverlay,
//     showOverlay = options.showOverlay;
//   return createMachine({
//     initial: "hidden",
//     context: {
//       level: "error",
//       messages: [],
//       messageSource: "build"
//     },
//     states: {
//       hidden: {
//         on: {
//           BUILD_ERROR: {
//             target: "displayBuildError",
//             actions: ["setMessages", "showOverlay"]
//           },
//           RUNTIME_ERROR: {
//             target: "displayRuntimeError",
//             actions: ["setMessages", "showOverlay"]
//           }
//         }
//       },
//       displayBuildError: {
//         on: {
//           DISMISS: {
//             target: "hidden",
//             actions: ["dismissMessages", "hideOverlay"]
//           },
//           BUILD_ERROR: {
//             target: "displayBuildError",
//             actions: ["appendMessages", "showOverlay"]
//           }
//         }
//       },
//       displayRuntimeError: {
//         on: {
//           DISMISS: {
//             target: "hidden",
//             actions: ["dismissMessages", "hideOverlay"]
//           },
//           RUNTIME_ERROR: {
//             target: "displayRuntimeError",
//             actions: ["appendMessages", "showOverlay"]
//           },
//           BUILD_ERROR: {
//             target: "displayBuildError",
//             actions: ["setMessages", "showOverlay"]
//           }
//         }
//       }
//     }
//   }, {
//     actions: {
//       dismissMessages: function dismissMessages() {
//         return {
//           messages: [],
//           level: "error",
//           messageSource: "build"
//         };
//       },
//       appendMessages: function appendMessages(context, event) {
//         return {
//           messages: context.messages.concat(event.messages),
//           level: event.level || context.level,
//           messageSource: event.type === "RUNTIME_ERROR" ? "runtime" : "build"
//         };
//       },
//       setMessages: function setMessages(context, event) {
//         return {
//           messages: event.messages,
//           level: event.level || context.level,
//           messageSource: event.type === "RUNTIME_ERROR" ? "runtime" : "build"
//         };
//       },
//       hideOverlay: hideOverlay,
//       showOverlay: showOverlay
//     }
//   });
// };

// /**
//  *
//  * @param {Error} error
//  */
// var parseErrorToStacks = function parseErrorToStacks(error) {
//   if (!error || !(error instanceof Error)) {
//     throw new Error("parseErrorToStacks expects Error object");
//   }
//   if (typeof error.stack === "string") {
//     return error.stack.split("\n").filter(function (stack) {
//       return stack !== "Error: ".concat(error.message);
//     });
//   }
// };

// /**
//  * @callback ErrorCallback
//  * @param {ErrorEvent} error
//  * @returns {void}
//  */

// /**
//  * @param {ErrorCallback} callback
//  */
// var listenToRuntimeError = function listenToRuntimeError(callback) {
//   window.addEventListener("error", callback);
//   return function cleanup() {
//     window.removeEventListener("error", callback);
//   };
// };

// /**
//  * @callback UnhandledRejectionCallback
//  * @param {PromiseRejectionEvent} rejectionEvent
//  * @returns {void}
//  */

// /**
//  * @param {UnhandledRejectionCallback} callback
//  */
// var listenToUnhandledRejection = function listenToUnhandledRejection(callback) {
//   window.addEventListener("unhandledrejection", callback);
//   return function cleanup() {
//     window.removeEventListener("unhandledrejection", callback);
//   };
// };

// // Styles are inspired by `react-error-overlay`

// var msgStyles = {
//   error: {
//     backgroundColor: "rgba(206, 17, 38, 0.1)",
//     color: "#fccfcf"
//   },
//   warning: {
//     backgroundColor: "rgba(251, 245, 180, 0.1)",
//     color: "#fbf5b4"
//   }
// };
// var iframeStyle = {
//   position: "fixed",
//   top: 0,
//   left: 0,
//   right: 0,
//   bottom: 0,
//   width: "100vw",
//   height: "100vh",
//   border: "none",
//   "z-index": 9999999999
// };
// var containerStyle = {
//   position: "fixed",
//   boxSizing: "border-box",
//   left: 0,
//   top: 0,
//   right: 0,
//   bottom: 0,
//   width: "100vw",
//   height: "100vh",
//   fontSize: "large",
//   padding: "2rem 2rem 4rem 2rem",
//   lineHeight: "1.2",
//   whiteSpace: "pre-wrap",
//   overflow: "auto",
//   backgroundColor: "rgba(0, 0, 0, 0.9)",
//   color: "white"
// };
// var headerStyle = {
//   color: "#e83b46",
//   fontSize: "2em",
//   whiteSpace: "pre-wrap",
//   fontFamily: "sans-serif",
//   margin: "0 2rem 2rem 0",
//   flex: "0 0 auto",
//   maxHeight: "50%",
//   overflow: "auto"
// };
// var dismissButtonStyle = {
//   color: "#ffffff",
//   lineHeight: "1rem",
//   fontSize: "1.5rem",
//   padding: "1rem",
//   cursor: "pointer",
//   position: "absolute",
//   right: 0,
//   top: 0,
//   backgroundColor: "transparent",
//   border: "none"
// };
// var msgTypeStyle = {
//   color: "#e83b46",
//   fontSize: "1.2em",
//   marginBottom: "1rem",
//   fontFamily: "sans-serif"
// };
// var msgTextStyle = {
//   lineHeight: "1.5",
//   fontSize: "1rem",
//   fontFamily: "Menlo, Consolas, monospace"
// };

// // ANSI HTML

// var colors = {
//   reset: ["transparent", "transparent"],
//   black: "181818",
//   red: "E36049",
//   green: "B3CB74",
//   yellow: "FFD080",
//   blue: "7CAFC2",
//   magenta: "7FACCA",
//   cyan: "C3C2EF",
//   lightgrey: "EBE7E3",
//   darkgrey: "6D7891"
// };
// ansi_html_community__WEBPACK_IMPORTED_MODULE_0___default().setColors(colors);

// /**
//  * @param {string} type
//  * @param {string  | { file?: string, moduleName?: string, loc?: string, message?: string; stack?: string[] }} item
//  * @returns {{ header: string, body: string }}
//  */
// var formatProblem = function formatProblem(type, item) {
//   var header = type === "warning" ? "WARNING" : "ERROR";
//   var body = "";
//   if (typeof item === "string") {
//     body += item;
//   } else {
//     var file = item.file || "";
//     // eslint-disable-next-line no-nested-ternary
//     var moduleName = item.moduleName ? item.moduleName.indexOf("!") !== -1 ? "".concat(item.moduleName.replace(/^(\s|\S)*!/, ""), " (").concat(item.moduleName, ")") : "".concat(item.moduleName) : "";
//     var loc = item.loc;
//     header += "".concat(moduleName || file ? " in ".concat(moduleName ? "".concat(moduleName).concat(file ? " (".concat(file, ")") : "") : file).concat(loc ? " ".concat(loc) : "") : "");
//     body += item.message || "";
//   }
//   if (Array.isArray(item.stack)) {
//     item.stack.forEach(function (stack) {
//       if (typeof stack === "string") {
//         body += "\r\n".concat(stack);
//       }
//     });
//   }
//   return {
//     header: header,
//     body: body
//   };
// };

// /**
//  * @typedef {Object} CreateOverlayOptions
//  * @property {string | null} trustedTypesPolicyName
//  * @property {boolean | (error: Error) => void} [catchRuntimeError]
//  */

// /**
//  *
//  * @param {CreateOverlayOptions} options
//  */
// var createOverlay = function createOverlay(options) {
//   /** @type {HTMLIFrameElement | null | undefined} */
//   var iframeContainerElement;
//   /** @type {HTMLDivElement | null | undefined} */
//   var containerElement;
//   /** @type {HTMLDivElement | null | undefined} */
//   var headerElement;
//   /** @type {Array<(element: HTMLDivElement) => void>} */
//   var onLoadQueue = [];
//   /** @type {TrustedTypePolicy | undefined} */
//   var overlayTrustedTypesPolicy;

//   /**
//    *
//    * @param {HTMLElement} element
//    * @param {CSSStyleDeclaration} style
//    */
//   function applyStyle(element, style) {
//     Object.keys(style).forEach(function (prop) {
//       element.style[prop] = style[prop];
//     });
//   }

//   /**
//    * @param {string | null} trustedTypesPolicyName
//    */
//   function createContainer(trustedTypesPolicyName) {
//     // Enable Trusted Types if they are available in the current browser.
//     if (window.trustedTypes) {
//       overlayTrustedTypesPolicy = window.trustedTypes.createPolicy(trustedTypesPolicyName || "webpack-dev-server#overlay", {
//         createHTML: function createHTML(value) {
//           return value;
//         }
//       });
//     }
//     iframeContainerElement = document.createElement("iframe");
//     iframeContainerElement.id = "webpack-dev-server-client-overlay";
//     iframeContainerElement.src = "about:blank";
//     applyStyle(iframeContainerElement, iframeStyle);
//     iframeContainerElement.onload = function () {
//       var contentElement = /** @type {Document} */
//       (/** @type {HTMLIFrameElement} */
//       iframeContainerElement.contentDocument).createElement("div");
//       containerElement = /** @type {Document} */
//       (/** @type {HTMLIFrameElement} */
//       iframeContainerElement.contentDocument).createElement("div");
//       contentElement.id = "webpack-dev-server-client-overlay-div";
//       applyStyle(contentElement, containerStyle);
//       headerElement = document.createElement("div");
//       headerElement.innerText = "Compiled with problems:";
//       applyStyle(headerElement, headerStyle);
//       var closeButtonElement = document.createElement("button");
//       applyStyle(closeButtonElement, dismissButtonStyle);
//       closeButtonElement.innerText = "×";
//       closeButtonElement.ariaLabel = "Dismiss";
//       closeButtonElement.addEventListener("click", function () {
//         // eslint-disable-next-line no-use-before-define
//         overlayService.send({
//           type: "DISMISS"
//         });
//       });
//       contentElement.appendChild(headerElement);
//       contentElement.appendChild(closeButtonElement);
//       contentElement.appendChild(containerElement);

//       /** @type {Document} */
//       (/** @type {HTMLIFrameElement} */
//       iframeContainerElement.contentDocument).body.appendChild(contentElement);
//       onLoadQueue.forEach(function (onLoad) {
//         onLoad(/** @type {HTMLDivElement} */contentElement);
//       });
//       onLoadQueue = [];

//       /** @type {HTMLIFrameElement} */
//       iframeContainerElement.onload = null;
//     };
//     document.body.appendChild(iframeContainerElement);
//   }

//   /**
//    * @param {(element: HTMLDivElement) => void} callback
//    * @param {string | null} trustedTypesPolicyName
//    */
//   function ensureOverlayExists(callback, trustedTypesPolicyName) {
//     if (containerElement) {
//       containerElement.innerHTML = overlayTrustedTypesPolicy ? overlayTrustedTypesPolicy.createHTML("") : "";
//       // Everything is ready, call the callback right away.
//       callback(containerElement);
//       return;
//     }
//     onLoadQueue.push(callback);
//     if (iframeContainerElement) {
//       return;
//     }
//     createContainer(trustedTypesPolicyName);
//   }

//   // Successful compilation.
//   function hide() {
//     if (!iframeContainerElement) {
//       return;
//     }

//     // Clean up and reset internal state.
//     document.body.removeChild(iframeContainerElement);
//     iframeContainerElement = null;
//     containerElement = null;
//   }

//   // Compilation with errors (e.g. syntax error or missing modules).
//   /**
//    * @param {string} type
//    * @param {Array<string  | { moduleIdentifier?: string, moduleName?: string, loc?: string, message?: string }>} messages
//    * @param {string | null} trustedTypesPolicyName
//    * @param {'build' | 'runtime'} messageSource
//    */
//   function show(type, messages, trustedTypesPolicyName, messageSource) {
//     ensureOverlayExists(function () {
//       headerElement.innerText = messageSource === "runtime" ? "Uncaught runtime errors:" : "Compiled with problems:";
//       messages.forEach(function (message) {
//         var entryElement = document.createElement("div");
//         var msgStyle = type === "warning" ? msgStyles.warning : msgStyles.error;
//         applyStyle(entryElement, _objectSpread(_objectSpread({}, msgStyle), {}, {
//           padding: "1rem 1rem 1.5rem 1rem"
//         }));
//         var typeElement = document.createElement("div");
//         var _formatProblem = formatProblem(type, message),
//           header = _formatProblem.header,
//           body = _formatProblem.body;
//         typeElement.innerText = header;
//         applyStyle(typeElement, msgTypeStyle);
//         if (message.moduleIdentifier) {
//           applyStyle(typeElement, {
//             cursor: "pointer"
//           });
//           // element.dataset not supported in IE
//           typeElement.setAttribute("data-can-open", true);
//           typeElement.addEventListener("click", function () {
//             fetch("/webpack-dev-server/open-editor?fileName=".concat(message.moduleIdentifier));
//           });
//         }

//         // Make it look similar to our terminal.
//         var text = ansi_html_community__WEBPACK_IMPORTED_MODULE_0___default()(encode(body));
//         var messageTextNode = document.createElement("div");
//         applyStyle(messageTextNode, msgTextStyle);
//         messageTextNode.innerHTML = overlayTrustedTypesPolicy ? overlayTrustedTypesPolicy.createHTML(text) : text;
//         entryElement.appendChild(typeElement);
//         entryElement.appendChild(messageTextNode);

//         /** @type {HTMLDivElement} */
//         containerElement.appendChild(entryElement);
//       });
//     }, trustedTypesPolicyName);
//   }
//   var overlayService = createOverlayMachine({
//     showOverlay: function showOverlay(_ref3) {
//       var _ref3$level = _ref3.level,
//         level = _ref3$level === void 0 ? "error" : _ref3$level,
//         messages = _ref3.messages,
//         messageSource = _ref3.messageSource;
//       return show(level, messages, options.trustedTypesPolicyName, messageSource);
//     },
//     hideOverlay: hide
//   });
//   if (options.catchRuntimeError) {
//     /**
//      * @param {Error | undefined} error
//      * @param {string} fallbackMessage
//      */
//     var handleError = function handleError(error, fallbackMessage) {
//       var errorObject = error instanceof Error ? error : new Error(error || fallbackMessage);
//       var shouldDisplay = typeof options.catchRuntimeError === "function" ? options.catchRuntimeError(errorObject) : true;
//       if (shouldDisplay) {
//         overlayService.send({
//           type: "RUNTIME_ERROR",
//           messages: [{
//             message: errorObject.message,
//             stack: parseErrorToStacks(errorObject)
//           }]
//         });
//       }
//     };
//     listenToRuntimeError(function (errorEvent) {
//       // error property may be empty in older browser like IE
//       var error = errorEvent.error,
//         message = errorEvent.message;
//       if (!error && !message) {
//         return;
//       }

//       // if error stack indicates a React error boundary caught the error, do not show overlay.
//       if (error && error.stack && error.stack.includes("invokeGuardedCallbackDev")) {
//         return;
//       }
//       handleError(error, message);
//     });
//     listenToUnhandledRejection(function (promiseRejectionEvent) {
//       var reason = promiseRejectionEvent.reason;
//       handleError(reason, "Unknown promise rejection reason");
//     });
//   }
//   return overlayService;
// };


// /***/ }),

// /***/ "../node_modules/webpack-dev-server/client/progress.js":
// /*!*************************************************************!*\
//   !*** ../node_modules/webpack-dev-server/client/progress.js ***!
//   \*************************************************************/
// /***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

// "use strict";
// __webpack_require__.r(__webpack_exports__);
// /* harmony export */ __webpack_require__.d(__webpack_exports__, {
// /* harmony export */   defineProgressElement: function() { return /* binding */ defineProgressElement; },
// /* harmony export */   isProgressSupported: function() { return /* binding */ isProgressSupported; }
// /* harmony export */ });
// function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
// function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
// function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
// function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
// function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
// function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
// function _callSuper(t, o, e) { return o = _getPrototypeOf(o), _possibleConstructorReturn(t, _isNativeReflectConstruct() ? Reflect.construct(o, e || [], _getPrototypeOf(t).constructor) : o.apply(t, e)); }
// function _possibleConstructorReturn(t, e) { if (e && ("object" == _typeof(e) || "function" == typeof e)) return e; if (void 0 !== e) throw new TypeError("Derived constructors may only return object or undefined"); return _assertThisInitialized(t); }
// function _assertThisInitialized(e) { if (void 0 === e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); return e; }
// function _inherits(t, e) { if ("function" != typeof e && null !== e) throw new TypeError("Super expression must either be null or a function"); t.prototype = Object.create(e && e.prototype, { constructor: { value: t, writable: !0, configurable: !0 } }), Object.defineProperty(t, "prototype", { writable: !1 }), e && _setPrototypeOf(t, e); }
// function _wrapNativeSuper(t) { var r = "function" == typeof Map ? new Map() : void 0; return _wrapNativeSuper = function _wrapNativeSuper(t) { if (null === t || !_isNativeFunction(t)) return t; if ("function" != typeof t) throw new TypeError("Super expression must either be null or a function"); if (void 0 !== r) { if (r.has(t)) return r.get(t); r.set(t, Wrapper); } function Wrapper() { return _construct(t, arguments, _getPrototypeOf(this).constructor); } return Wrapper.prototype = Object.create(t.prototype, { constructor: { value: Wrapper, enumerable: !1, writable: !0, configurable: !0 } }), _setPrototypeOf(Wrapper, t); }, _wrapNativeSuper(t); }
// function _construct(t, e, r) { if (_isNativeReflectConstruct()) return Reflect.construct.apply(null, arguments); var o = [null]; o.push.apply(o, e); var p = new (t.bind.apply(t, o))(); return r && _setPrototypeOf(p, r.prototype), p; }
// function _isNativeReflectConstruct() { try { var t = !Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {})); } catch (t) {} return (_isNativeReflectConstruct = function _isNativeReflectConstruct() { return !!t; })(); }
// function _isNativeFunction(t) { try { return -1 !== Function.toString.call(t).indexOf("[native code]"); } catch (n) { return "function" == typeof t; } }
// function _setPrototypeOf(t, e) { return _setPrototypeOf = Object.setPrototypeOf ? Object.setPrototypeOf.bind() : function (t, e) { return t.__proto__ = e, t; }, _setPrototypeOf(t, e); }
// function _getPrototypeOf(t) { return _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf.bind() : function (t) { return t.__proto__ || Object.getPrototypeOf(t); }, _getPrototypeOf(t); }
// function _classPrivateMethodInitSpec(e, a) { _checkPrivateRedeclaration(e, a), a.add(e); }
// function _checkPrivateRedeclaration(e, t) { if (t.has(e)) throw new TypeError("Cannot initialize the same private elements twice on an object"); }
// function _assertClassBrand(e, t, n) { if ("function" == typeof e ? e === t : e.has(t)) return arguments.length < 3 ? t : n; throw new TypeError("Private element is not present on this object"); }
// function isProgressSupported() {
//   return "customElements" in self && !!HTMLElement.prototype.attachShadow;
// }
// function defineProgressElement() {
//   var _WebpackDevServerProgress;
//   if (customElements.get("wds-progress")) {
//     return;
//   }
//   var _WebpackDevServerProgress_brand = /*#__PURE__*/new WeakSet();
//   var WebpackDevServerProgress = /*#__PURE__*/function (_HTMLElement) {
//     function WebpackDevServerProgress() {
//       var _this;
//       _classCallCheck(this, WebpackDevServerProgress);
//       _this = _callSuper(this, WebpackDevServerProgress);
//       _classPrivateMethodInitSpec(_this, _WebpackDevServerProgress_brand);
//       _this.attachShadow({
//         mode: "open"
//       });
//       _this.maxDashOffset = -219.99078369140625;
//       _this.animationTimer = null;
//       return _this;
//     }
//     _inherits(WebpackDevServerProgress, _HTMLElement);
//     return _createClass(WebpackDevServerProgress, [{
//       key: "connectedCallback",
//       value: function connectedCallback() {
//         _assertClassBrand(_WebpackDevServerProgress_brand, this, _reset).call(this);
//       }
//     }, {
//       key: "attributeChangedCallback",
//       value: function attributeChangedCallback(name, oldValue, newValue) {
//         if (name === "progress") {
//           _assertClassBrand(_WebpackDevServerProgress_brand, this, _update).call(this, Number(newValue));
//         } else if (name === "type") {
//           _assertClassBrand(_WebpackDevServerProgress_brand, this, _reset).call(this);
//         }
//       }
//     }], [{
//       key: "observedAttributes",
//       get: function get() {
//         return ["progress", "type"];
//       }
//     }]);
//   }(/*#__PURE__*/_wrapNativeSuper(HTMLElement));
//   _WebpackDevServerProgress = WebpackDevServerProgress;
//   function _reset() {
//     var _this$getAttribute, _Number;
//     clearTimeout(this.animationTimer);
//     this.animationTimer = null;
//     var typeAttr = (_this$getAttribute = this.getAttribute("type")) === null || _this$getAttribute === void 0 ? void 0 : _this$getAttribute.toLowerCase();
//     this.type = typeAttr === "circular" ? "circular" : "linear";
//     var innerHTML = this.type === "circular" ? _circularTemplate.call(_WebpackDevServerProgress) : _linearTemplate.call(_WebpackDevServerProgress);
//     this.shadowRoot.innerHTML = innerHTML;
//     this.initialProgress = (_Number = Number(this.getAttribute("progress"))) !== null && _Number !== void 0 ? _Number : 0;
//     _assertClassBrand(_WebpackDevServerProgress_brand, this, _update).call(this, this.initialProgress);
//   }
//   function _circularTemplate() {
//     return "\n        <style>\n        :host {\n            width: 200px;\n            height: 200px;\n            position: fixed;\n            right: 5%;\n            top: 5%;\n            transition: opacity .25s ease-in-out;\n            z-index: 2147483645;\n        }\n\n        circle {\n            fill: #282d35;\n        }\n\n        path {\n            fill: rgba(0, 0, 0, 0);\n            stroke: rgb(186, 223, 172);\n            stroke-dasharray: 219.99078369140625;\n            stroke-dashoffset: -219.99078369140625;\n            stroke-width: 10;\n            transform: rotate(90deg) translate(0px, -80px);\n        }\n\n        text {\n            font-family: 'Open Sans', sans-serif;\n            font-size: 18px;\n            fill: #ffffff;\n            dominant-baseline: middle;\n            text-anchor: middle;\n        }\n\n        tspan#percent-super {\n            fill: #bdc3c7;\n            font-size: 0.45em;\n            baseline-shift: 10%;\n        }\n\n        @keyframes fade {\n            0% { opacity: 1; transform: scale(1); }\n            100% { opacity: 0; transform: scale(0); }\n        }\n\n        .disappear {\n            animation: fade 0.3s;\n            animation-fill-mode: forwards;\n            animation-delay: 0.5s;\n        }\n\n        .hidden {\n            display: none;\n        }\n        </style>\n        <svg id=\"progress\" class=\"hidden noselect\" viewBox=\"0 0 80 80\">\n        <circle cx=\"50%\" cy=\"50%\" r=\"35\"></circle>\n        <path d=\"M5,40a35,35 0 1,0 70,0a35,35 0 1,0 -70,0\"></path>\n        <text x=\"50%\" y=\"51%\">\n            <tspan id=\"percent-value\">0</tspan>\n            <tspan id=\"percent-super\">%</tspan>\n        </text>\n        </svg>\n      ";
//   }
//   function _linearTemplate() {
//     return "\n        <style>\n        :host {\n            position: fixed;\n            top: 0;\n            left: 0;\n            height: 4px;\n            width: 100vw;\n            z-index: 2147483645;\n        }\n\n        #bar {\n            width: 0%;\n            height: 4px;\n            background-color: rgb(186, 223, 172);\n        }\n\n        @keyframes fade {\n            0% { opacity: 1; }\n            100% { opacity: 0; }\n        }\n\n        .disappear {\n            animation: fade 0.3s;\n            animation-fill-mode: forwards;\n            animation-delay: 0.5s;\n        }\n\n        .hidden {\n            display: none;\n        }\n        </style>\n        <div id=\"progress\"></div>\n        ";
//   }
//   function _update(percent) {
//     var element = this.shadowRoot.querySelector("#progress");
//     if (this.type === "circular") {
//       var path = this.shadowRoot.querySelector("path");
//       var value = this.shadowRoot.querySelector("#percent-value");
//       var offset = (100 - percent) / 100 * this.maxDashOffset;
//       path.style.strokeDashoffset = offset;
//       value.textContent = percent;
//     } else {
//       element.style.width = "".concat(percent, "%");
//     }
//     if (percent >= 100) {
//       _assertClassBrand(_WebpackDevServerProgress_brand, this, _hide).call(this);
//     } else if (percent > 0) {
//       _assertClassBrand(_WebpackDevServerProgress_brand, this, _show).call(this);
//     }
//   }
//   function _show() {
//     var element = this.shadowRoot.querySelector("#progress");
//     element.classList.remove("hidden");
//   }
//   function _hide() {
//     var _this2 = this;
//     var element = this.shadowRoot.querySelector("#progress");
//     if (this.type === "circular") {
//       element.classList.add("disappear");
//       element.addEventListener("animationend", function () {
//         element.classList.add("hidden");
//         _assertClassBrand(_WebpackDevServerProgress_brand, _this2, _update).call(_this2, 0);
//       }, {
//         once: true
//       });
//     } else if (this.type === "linear") {
//       element.classList.add("disappear");
//       this.animationTimer = setTimeout(function () {
//         element.classList.remove("disappear");
//         element.classList.add("hidden");
//         element.style.width = "0%";
//         _this2.animationTimer = null;
//       }, 800);
//     }
//   }
//   customElements.define("wds-progress", WebpackDevServerProgress);
// }

// /***/ }),

// /***/ "../node_modules/webpack-dev-server/client/socket.js":
// /*!***********************************************************!*\
//   !*** ../node_modules/webpack-dev-server/client/socket.js ***!
//   \***********************************************************/
// /***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

// "use strict";
// __webpack_require__.r(__webpack_exports__);
// /* harmony export */ __webpack_require__.d(__webpack_exports__, {
// /* harmony export */   client: function() { return /* binding */ client; }
// /* harmony export */ });
// /* harmony import */ var _clients_WebSocketClient_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./clients/WebSocketClient.js */ "../node_modules/webpack-dev-server/client/clients/WebSocketClient.js");
// /* harmony import */ var _utils_log_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./utils/log.js */ "../node_modules/webpack-dev-server/client/utils/log.js");
// /* provided dependency */ var __webpack_dev_server_client__ = __webpack_require__(/*! ../node_modules/webpack-dev-server/client/clients/WebSocketClient.js */ "../node_modules/webpack-dev-server/client/clients/WebSocketClient.js");
// /* global __webpack_dev_server_client__ */




// // this WebsocketClient is here as a default fallback, in case the client is not injected
// /* eslint-disable camelcase */
// var Client =
// // eslint-disable-next-line no-nested-ternary
// typeof __webpack_dev_server_client__ !== "undefined" ? typeof __webpack_dev_server_client__.default !== "undefined" ? __webpack_dev_server_client__.default : __webpack_dev_server_client__ : _clients_WebSocketClient_js__WEBPACK_IMPORTED_MODULE_0__["default"];
// /* eslint-enable camelcase */

// var retries = 0;
// var maxRetries = 10;

// // Initialized client is exported so external consumers can utilize the same instance
// // It is mutable to enforce singleton
// // eslint-disable-next-line import/no-mutable-exports
// var client = null;
// var timeout;

// /**
//  * @param {string} url
//  * @param {{ [handler: string]: (data?: any, params?: any) => any }} handlers
//  * @param {number} [reconnect]
//  */
// var socket = function initSocket(url, handlers, reconnect) {
//   client = new Client(url);
//   client.onOpen(function () {
//     retries = 0;
//     if (timeout) {
//       clearTimeout(timeout);
//     }
//     if (typeof reconnect !== "undefined") {
//       maxRetries = reconnect;
//     }
//   });
//   client.onClose(function () {
//     if (retries === 0) {
//       handlers.close();
//     }

//     // Try to reconnect.
//     client = null;

//     // After 10 retries stop trying, to prevent logspam.
//     if (retries < maxRetries) {
//       // Exponentially increase timeout to reconnect.
//       // Respectfully copied from the package `got`.
//       // eslint-disable-next-line no-restricted-properties
//       var retryInMs = 1000 * Math.pow(2, retries) + Math.random() * 100;
//       retries += 1;
//       _utils_log_js__WEBPACK_IMPORTED_MODULE_1__.log.info("Trying to reconnect...");
//       timeout = setTimeout(function () {
//         socket(url, handlers, reconnect);
//       }, retryInMs);
//     }
//   });
//   client.onMessage(
//   /**
//    * @param {any} data
//    */
//   function (data) {
//     var message = JSON.parse(data);
//     if (handlers[message.type]) {
//       handlers[message.type](message.data, message.params);
//     }
//   });
// };
// /* harmony default export */ __webpack_exports__["default"] = (socket);

// /***/ }),

// /***/ "../node_modules/webpack-dev-server/client/utils/log.js":
// /*!**************************************************************!*\
//   !*** ../node_modules/webpack-dev-server/client/utils/log.js ***!
//   \**************************************************************/
// /***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

// "use strict";
// __webpack_require__.r(__webpack_exports__);
// /* harmony export */ __webpack_require__.d(__webpack_exports__, {
// /* harmony export */   log: function() { return /* binding */ log; },
// /* harmony export */   setLogLevel: function() { return /* binding */ setLogLevel; }
// /* harmony export */ });
// /* harmony import */ var _modules_logger_index_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../modules/logger/index.js */ "../node_modules/webpack-dev-server/client/modules/logger/index.js");
// /* harmony import */ var _modules_logger_index_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_modules_logger_index_js__WEBPACK_IMPORTED_MODULE_0__);

// var name = "webpack-dev-server";
// // default level is set on the client side, so it does not need
// // to be set by the CLI or API
// var defaultLevel = "info";

// // options new options, merge with old options
// /**
//  * @param {false | true | "none" | "error" | "warn" | "info" | "log" | "verbose"} level
//  * @returns {void}
//  */
// function setLogLevel(level) {
//   _modules_logger_index_js__WEBPACK_IMPORTED_MODULE_0___default().configureDefaultLogger({
//     level: level
//   });
// }
// setLogLevel(defaultLevel);
// var log = _modules_logger_index_js__WEBPACK_IMPORTED_MODULE_0___default().getLogger(name);


// /***/ }),

// /***/ "../node_modules/webpack-dev-server/client/utils/sendMessage.js":
// /*!**********************************************************************!*\
//   !*** ../node_modules/webpack-dev-server/client/utils/sendMessage.js ***!
//   \**********************************************************************/
// /***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

// "use strict";
// __webpack_require__.r(__webpack_exports__);
// /* global __resourceQuery WorkerGlobalScope */

// // Send messages to the outside, so plugins can consume it.
// /**
//  * @param {string} type
//  * @param {any} [data]
//  */
// function sendMsg(type, data) {
//   if (typeof self !== "undefined" && (typeof WorkerGlobalScope === "undefined" || !(self instanceof WorkerGlobalScope))) {
//     self.postMessage({
//       type: "webpack".concat(type),
//       data: data
//     }, "*");
//   }
// }
// /* harmony default export */ __webpack_exports__["default"] = (sendMsg);

// /***/ }),

// /***/ "../node_modules/webpack/hot/emitter.js":
// /*!**********************************************!*\
//   !*** ../node_modules/webpack/hot/emitter.js ***!
//   \**********************************************/
// /***/ (function(module, __unused_webpack_exports, __webpack_require__) {

// var EventEmitter = __webpack_require__(/*! events */ "../node_modules/events/events.js");
// module.exports = new EventEmitter();


// /***/ }),

// /***/ "../node_modules/webpack/hot/log.js":
// /*!******************************************!*\
//   !*** ../node_modules/webpack/hot/log.js ***!
//   \******************************************/
// /***/ (function(module) {

// /** @typedef {"info" | "warning" | "error"} LogLevel */

// /** @type {LogLevel} */
// var logLevel = "info";

// function dummy() {}

// /**
//  * @param {LogLevel} level log level
//  * @returns {boolean} true, if should log
//  */
// function shouldLog(level) {
// 	var shouldLog =
// 		(logLevel === "info" && level === "info") ||
// 		(["info", "warning"].indexOf(logLevel) >= 0 && level === "warning") ||
// 		(["info", "warning", "error"].indexOf(logLevel) >= 0 && level === "error");
// 	return shouldLog;
// }

// /**
//  * @param {(msg?: string) => void} logFn log function
//  * @returns {(level: LogLevel, msg?: string) => void} function that logs when log level is sufficient
//  */
// function logGroup(logFn) {
// 	return function (level, msg) {
// 		if (shouldLog(level)) {
// 			logFn(msg);
// 		}
// 	};
// }

// /**
//  * @param {LogLevel} level log level
//  * @param {string|Error} msg message
//  */
// module.exports = function (level, msg) {
// 	if (shouldLog(level)) {
// 		if (level === "info") {
// 			console.log(msg);
// 		} else if (level === "warning") {
// 			console.warn(msg);
// 		} else if (level === "error") {
// 			console.error(msg);
// 		}
// 	}
// };

// /**
//  * @param {Error} err error
//  * @returns {string} formatted error
//  */
// module.exports.formatError = function (err) {
// 	var message = err.message;
// 	var stack = err.stack;
// 	if (!stack) {
// 		return message;
// 	} else if (stack.indexOf(message) < 0) {
// 		return message + "\n" + stack;
// 	}
// 	return stack;
// };

// var group = console.group || dummy;
// var groupCollapsed = console.groupCollapsed || dummy;
// var groupEnd = console.groupEnd || dummy;

// module.exports.group = logGroup(group);

// module.exports.groupCollapsed = logGroup(groupCollapsed);

// module.exports.groupEnd = logGroup(groupEnd);

// /**
//  * @param {LogLevel} level log level
//  */
// module.exports.setLogLevel = function (level) {
// 	logLevel = level;
// };


// /***/ }),

// /***/ "./sections/hero/hero.scss":
// /*!*********************************!*\
//   !*** ./sections/hero/hero.scss ***!
//   \*********************************/
// /***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

// "use strict";
// __webpack_require__.r(__webpack_exports__);
// // extracted by mini-css-extract-plugin


// /***/ })

// /******/ 	});
// /************************************************************************/
// /******/ 	// The module cache
// /******/ 	var __webpack_module_cache__ = {};
// /******/ 	
// /******/ 	// The require function
// /******/ 	function __webpack_require__(moduleId) {
// /******/ 		// Check if module is in cache
// /******/ 		var cachedModule = __webpack_module_cache__[moduleId];
// /******/ 		if (cachedModule !== undefined) {
// /******/ 			return cachedModule.exports;
// /******/ 		}
// /******/ 		// Create a new module (and put it into the cache)
// /******/ 		var module = __webpack_module_cache__[moduleId] = {
// /******/ 			// no module.id needed
// /******/ 			// no module.loaded needed
// /******/ 			exports: {}
// /******/ 		};
// /******/ 	
// /******/ 		// Execute the module function
// /******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
// /******/ 	
// /******/ 		// Return the exports of the module
// /******/ 		return module.exports;
// /******/ 	}
// /******/ 	
// /************************************************************************/
// /******/ 	/* webpack/runtime/compat get default export */
// /******/ 	!function() {
// /******/ 		// getDefaultExport function for compatibility with non-harmony modules
// /******/ 		__webpack_require__.n = function(module) {
// /******/ 			var getter = module && module.__esModule ?
// /******/ 				function() { return module['default']; } :
// /******/ 				function() { return module; };
// /******/ 			__webpack_require__.d(getter, { a: getter });
// /******/ 			return getter;
// /******/ 		};
// /******/ 	}();
// /******/ 	
// /******/ 	/* webpack/runtime/define property getters */
// /******/ 	!function() {
// /******/ 		// define getter functions for harmony exports
// /******/ 		__webpack_require__.d = function(exports, definition) {
// /******/ 			for(var key in definition) {
// /******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
// /******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
// /******/ 				}
// /******/ 			}
// /******/ 		};
// /******/ 	}();
// /******/ 	
// /******/ 	/* webpack/runtime/getFullHash */
// /******/ 	!function() {
// /******/ 		__webpack_require__.h = function() { return "3c06234df6f951f8f024"; }
// /******/ 	}();
// /******/ 	
// /******/ 	/* webpack/runtime/hasOwnProperty shorthand */
// /******/ 	!function() {
// /******/ 		__webpack_require__.o = function(obj, prop) { return Object.prototype.hasOwnProperty.call(obj, prop); }
// /******/ 	}();
// /******/ 	
// /******/ 	/* webpack/runtime/make namespace object */
// /******/ 	!function() {
// /******/ 		// define __esModule on exports
// /******/ 		__webpack_require__.r = function(exports) {
// /******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
// /******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
// /******/ 			}
// /******/ 			Object.defineProperty(exports, '__esModule', { value: true });
// /******/ 		};
// /******/ 	}();
// /******/ 	
// /************************************************************************/
// var __webpack_exports__ = {};
// // This entry needs to be wrapped in an IIFE because it needs to be in strict mode.
// !function() {
// "use strict";
// var __webpack_exports__ = {};
// /*!***************************************************************************************************************************************************************************************!*\
//   !*** ../node_modules/webpack-dev-server/client/index.js?protocol=ws%3A&hostname=localhost&port=3101&pathname=%2Fws&logging=info&overlay=true&reconnect=10&hot=false&live-reload=true ***!
//   \***************************************************************************************************************************************************************************************/
// var __resourceQuery = "?protocol=ws%3A&hostname=localhost&port=3101&pathname=%2Fws&logging=info&overlay=true&reconnect=10&hot=false&live-reload=true";
// __webpack_require__.r(__webpack_exports__);
// /* harmony export */ __webpack_require__.d(__webpack_exports__, {
// /* harmony export */   createSocketURL: function() { return /* binding */ createSocketURL; },
// /* harmony export */   getCurrentScriptSource: function() { return /* binding */ getCurrentScriptSource; },
// /* harmony export */   parseURL: function() { return /* binding */ parseURL; }
// /* harmony export */ });
// /* harmony import */ var webpack_hot_log_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! webpack/hot/log.js */ "../node_modules/webpack/hot/log.js");
// /* harmony import */ var webpack_hot_log_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(webpack_hot_log_js__WEBPACK_IMPORTED_MODULE_0__);
// /* harmony import */ var webpack_hot_emitter_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! webpack/hot/emitter.js */ "../node_modules/webpack/hot/emitter.js");
// /* harmony import */ var webpack_hot_emitter_js__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(webpack_hot_emitter_js__WEBPACK_IMPORTED_MODULE_1__);
// /* harmony import */ var _socket_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./socket.js */ "../node_modules/webpack-dev-server/client/socket.js");
// /* harmony import */ var _overlay_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./overlay.js */ "../node_modules/webpack-dev-server/client/overlay.js");
// /* harmony import */ var _utils_log_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./utils/log.js */ "../node_modules/webpack-dev-server/client/utils/log.js");
// /* harmony import */ var _utils_sendMessage_js__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./utils/sendMessage.js */ "../node_modules/webpack-dev-server/client/utils/sendMessage.js");
// /* harmony import */ var _progress_js__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./progress.js */ "../node_modules/webpack-dev-server/client/progress.js");
// function ownKeys(e, r) { var t = Object.keys(e); if (Object.getOwnPropertySymbols) { var o = Object.getOwnPropertySymbols(e); r && (o = o.filter(function (r) { return Object.getOwnPropertyDescriptor(e, r).enumerable; })), t.push.apply(t, o); } return t; }
// function _objectSpread(e) { for (var r = 1; r < arguments.length; r++) { var t = null != arguments[r] ? arguments[r] : {}; r % 2 ? ownKeys(Object(t), !0).forEach(function (r) { _defineProperty(e, r, t[r]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(t)) : ownKeys(Object(t)).forEach(function (r) { Object.defineProperty(e, r, Object.getOwnPropertyDescriptor(t, r)); }); } return e; }
// function _defineProperty(e, r, t) { return (r = _toPropertyKey(r)) in e ? Object.defineProperty(e, r, { value: t, enumerable: !0, configurable: !0, writable: !0 }) : e[r] = t, e; }
// function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
// function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
// function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
// /* global __resourceQuery, __webpack_hash__ */
// /// <reference types="webpack/module" />








// /**
//  * @typedef {Object} OverlayOptions
//  * @property {boolean | (error: Error) => boolean} [warnings]
//  * @property {boolean | (error: Error) => boolean} [errors]
//  * @property {boolean | (error: Error) => boolean} [runtimeErrors]
//  * @property {string} [trustedTypesPolicyName]
//  */

// /**
//  * @typedef {Object} Options
//  * @property {boolean} hot
//  * @property {boolean} liveReload
//  * @property {boolean} progress
//  * @property {boolean | OverlayOptions} overlay
//  * @property {string} [logging]
//  * @property {number} [reconnect]
//  */

// /**
//  * @typedef {Object} Status
//  * @property {boolean} isUnloading
//  * @property {string} currentHash
//  * @property {string} [previousHash]
//  */

// /**
//  * @param {boolean | { warnings?: boolean | string; errors?: boolean | string; runtimeErrors?: boolean | string; }} overlayOptions
//  */
// var decodeOverlayOptions = function decodeOverlayOptions(overlayOptions) {
//   if (_typeof(overlayOptions) === "object") {
//     ["warnings", "errors", "runtimeErrors"].forEach(function (property) {
//       if (typeof overlayOptions[property] === "string") {
//         var overlayFilterFunctionString = decodeURIComponent(overlayOptions[property]);

//         // eslint-disable-next-line no-new-func
//         overlayOptions[property] = new Function("message", "var callback = ".concat(overlayFilterFunctionString, "\n        return callback(message)"));
//       }
//     });
//   }
// };

// /**
//  * @type {Status}
//  */
// var status = {
//   isUnloading: false,
//   // eslint-disable-next-line camelcase
//   currentHash: __webpack_require__.h()
// };

// /**
//  * @returns {string}
//  */
// var getCurrentScriptSource = function getCurrentScriptSource() {
//   // `document.currentScript` is the most accurate way to find the current script,
//   // but is not supported in all browsers.
//   if (document.currentScript) {
//     return document.currentScript.getAttribute("src");
//   }

//   // Fallback to getting all scripts running in the document.
//   var scriptElements = document.scripts || [];
//   var scriptElementsWithSrc = Array.prototype.filter.call(scriptElements, function (element) {
//     return element.getAttribute("src");
//   });
//   if (scriptElementsWithSrc.length > 0) {
//     var currentScript = scriptElementsWithSrc[scriptElementsWithSrc.length - 1];
//     return currentScript.getAttribute("src");
//   }

//   // Fail as there was no script to use.
//   throw new Error("[webpack-dev-server] Failed to get current script source.");
// };

// /**
//  * @param {string} resourceQuery
//  * @returns {{ [key: string]: string | boolean }}
//  */
// var parseURL = function parseURL(resourceQuery) {
//   /** @type {{ [key: string]: string }} */
//   var result = {};
//   if (typeof resourceQuery === "string" && resourceQuery !== "") {
//     var searchParams = resourceQuery.slice(1).split("&");
//     for (var i = 0; i < searchParams.length; i++) {
//       var pair = searchParams[i].split("=");
//       result[pair[0]] = decodeURIComponent(pair[1]);
//     }
//   } else {
//     // Else, get the url from the <script> this file was called with.
//     var scriptSource = getCurrentScriptSource();
//     var scriptSourceURL;
//     try {
//       // The placeholder `baseURL` with `window.location.href`,
//       // is to allow parsing of path-relative or protocol-relative URLs,
//       // and will have no effect if `scriptSource` is a fully valid URL.
//       scriptSourceURL = new URL(scriptSource, self.location.href);
//     } catch (error) {
//       // URL parsing failed, do nothing.
//       // We will still proceed to see if we can recover using `resourceQuery`
//     }
//     if (scriptSourceURL) {
//       result = scriptSourceURL;
//       result.fromCurrentScript = true;
//     }
//   }
//   return result;
// };
// var parsedResourceQuery = parseURL(__resourceQuery);
// var enabledFeatures = {
//   "Hot Module Replacement": false,
//   "Live Reloading": false,
//   Progress: false,
//   Overlay: false
// };

// /** @type {Options} */
// var options = {
//   hot: false,
//   liveReload: false,
//   progress: false,
//   overlay: false
// };
// if (parsedResourceQuery.hot === "true") {
//   options.hot = true;
//   enabledFeatures["Hot Module Replacement"] = true;
// }
// if (parsedResourceQuery["live-reload"] === "true") {
//   options.liveReload = true;
//   enabledFeatures["Live Reloading"] = true;
// }
// if (parsedResourceQuery.progress === "true") {
//   options.progress = true;
//   enabledFeatures.Progress = true;
// }
// if (parsedResourceQuery.overlay) {
//   try {
//     options.overlay = JSON.parse(parsedResourceQuery.overlay);
//   } catch (e) {
//     _utils_log_js__WEBPACK_IMPORTED_MODULE_4__.log.error("Error parsing overlay options from resource query:", e);
//   }

//   // Fill in default "true" params for partially-specified objects.
//   if (_typeof(options.overlay) === "object") {
//     options.overlay = _objectSpread({
//       errors: true,
//       warnings: true,
//       runtimeErrors: true
//     }, options.overlay);
//     decodeOverlayOptions(options.overlay);
//   }
//   enabledFeatures.Overlay = options.overlay !== false;
// }
// if (parsedResourceQuery.logging) {
//   options.logging = parsedResourceQuery.logging;
// }
// if (typeof parsedResourceQuery.reconnect !== "undefined") {
//   options.reconnect = Number(parsedResourceQuery.reconnect);
// }

// /**
//  * @param {string} level
//  */
// var setAllLogLevel = function setAllLogLevel(level) {
//   // This is needed because the HMR logger operate separately from dev server logger
//   webpack_hot_log_js__WEBPACK_IMPORTED_MODULE_0___default().setLogLevel(level === "verbose" || level === "log" ? "info" : level);
//   (0,_utils_log_js__WEBPACK_IMPORTED_MODULE_4__.setLogLevel)(level);
// };
// if (options.logging) {
//   setAllLogLevel(options.logging);
// }
// var logEnabledFeatures = function logEnabledFeatures(features) {
//   var listEnabledFeatures = Object.keys(features);
//   if (!features || listEnabledFeatures.length === 0) {
//     return;
//   }
//   var logString = "Server started:";

//   // Server started: Hot Module Replacement enabled, Live Reloading enabled, Overlay disabled.
//   for (var i = 0; i < listEnabledFeatures.length; i++) {
//     var key = listEnabledFeatures[i];
//     logString += " ".concat(key, " ").concat(features[key] ? "enabled" : "disabled", ",");
//   }
//   // replace last comma with a period
//   logString = logString.slice(0, -1).concat(".");
//   _utils_log_js__WEBPACK_IMPORTED_MODULE_4__.log.info(logString);
// };
// logEnabledFeatures(enabledFeatures);
// self.addEventListener("beforeunload", function () {
//   status.isUnloading = true;
// });
// var overlay = typeof window !== "undefined" ? (0,_overlay_js__WEBPACK_IMPORTED_MODULE_3__.createOverlay)(_typeof(options.overlay) === "object" ? {
//   trustedTypesPolicyName: options.overlay.trustedTypesPolicyName,
//   catchRuntimeError: options.overlay.runtimeErrors
// } : {
//   trustedTypesPolicyName: false,
//   catchRuntimeError: options.overlay
// }) : {
//   send: function send() {}
// };

// /**
//  * @param {Options} options
//  * @param {Status} currentStatus
//  */
// var reloadApp = function reloadApp(_ref, currentStatus) {
//   var hot = _ref.hot,
//     liveReload = _ref.liveReload;
//   if (currentStatus.isUnloading) {
//     return;
//   }
//   var currentHash = currentStatus.currentHash,
//     previousHash = currentStatus.previousHash;
//   var isInitial = currentHash.indexOf(/** @type {string} */previousHash) >= 0;
//   if (isInitial) {
//     return;
//   }

//   /**
//    * @param {Window} rootWindow
//    * @param {number} intervalId
//    */
//   function applyReload(rootWindow, intervalId) {
//     clearInterval(intervalId);
//     _utils_log_js__WEBPACK_IMPORTED_MODULE_4__.log.info("App updated. Reloading...");
//     rootWindow.location.reload();
//   }
//   var search = self.location.search.toLowerCase();
//   var allowToHot = search.indexOf("webpack-dev-server-hot=false") === -1;
//   var allowToLiveReload = search.indexOf("webpack-dev-server-live-reload=false") === -1;
//   if (hot && allowToHot) {
//     _utils_log_js__WEBPACK_IMPORTED_MODULE_4__.log.info("App hot update...");
//     webpack_hot_emitter_js__WEBPACK_IMPORTED_MODULE_1___default().emit("webpackHotUpdate", currentStatus.currentHash);
//     if (typeof self !== "undefined" && self.window) {
//       // broadcast update to window
//       self.postMessage("webpackHotUpdate".concat(currentStatus.currentHash), "*");
//     }
//   }
//   // allow refreshing the page only if liveReload isn't disabled
//   else if (liveReload && allowToLiveReload) {
//     var rootWindow = self;

//     // use parent window for reload (in case we're in an iframe with no valid src)
//     var intervalId = self.setInterval(function () {
//       if (rootWindow.location.protocol !== "about:") {
//         // reload immediately if protocol is valid
//         applyReload(rootWindow, intervalId);
//       } else {
//         rootWindow = rootWindow.parent;
//         if (rootWindow.parent === rootWindow) {
//           // if parent equals current window we've reached the root which would continue forever, so trigger a reload anyways
//           applyReload(rootWindow, intervalId);
//         }
//       }
//     });
//   }
// };
// var ansiRegex = new RegExp(["[\\u001B\\u009B][[\\]()#;?]*(?:(?:(?:(?:;[-a-zA-Z\\d\\/#&.:=?%@~_]+)*|[a-zA-Z\\d]+(?:;[-a-zA-Z\\d\\/#&.:=?%@~_]*)*)?\\u0007)", "(?:(?:\\d{1,4}(?:;\\d{0,4})*)?[\\dA-PR-TZcf-nq-uy=><~]))"].join("|"), "g");

// /**
//  *
//  * Strip [ANSI escape codes](https://en.wikipedia.org/wiki/ANSI_escape_code) from a string.
//  * Adapted from code originally released by Sindre Sorhus
//  * Licensed the MIT License
//  *
//  * @param {string} string
//  * @return {string}
//  */
// var stripAnsi = function stripAnsi(string) {
//   if (typeof string !== "string") {
//     throw new TypeError("Expected a `string`, got `".concat(_typeof(string), "`"));
//   }
//   return string.replace(ansiRegex, "");
// };
// var onSocketMessage = {
//   hot: function hot() {
//     if (parsedResourceQuery.hot === "false") {
//       return;
//     }
//     options.hot = true;
//   },
//   liveReload: function liveReload() {
//     if (parsedResourceQuery["live-reload"] === "false") {
//       return;
//     }
//     options.liveReload = true;
//   },
//   invalid: function invalid() {
//     _utils_log_js__WEBPACK_IMPORTED_MODULE_4__.log.info("App updated. Recompiling...");

//     // Fixes #1042. overlay doesn't clear if errors are fixed but warnings remain.
//     if (options.overlay) {
//       overlay.send({
//         type: "DISMISS"
//       });
//     }
//     (0,_utils_sendMessage_js__WEBPACK_IMPORTED_MODULE_5__["default"])("Invalid");
//   },
//   /**
//    * @param {string} hash
//    */
//   hash: function hash(_hash) {
//     status.previousHash = status.currentHash;
//     status.currentHash = _hash;
//   },
//   logging: setAllLogLevel,
//   /**
//    * @param {boolean} value
//    */
//   overlay: function overlay(value) {
//     if (typeof document === "undefined") {
//       return;
//     }
//     options.overlay = value;
//     decodeOverlayOptions(options.overlay);
//   },
//   /**
//    * @param {number} value
//    */
//   reconnect: function reconnect(value) {
//     if (parsedResourceQuery.reconnect === "false") {
//       return;
//     }
//     options.reconnect = value;
//   },
//   /**
//    * @param {boolean} value
//    */
//   progress: function progress(value) {
//     options.progress = value;
//   },
//   /**
//    * @param {{ pluginName?: string, percent: number, msg: string }} data
//    */
//   "progress-update": function progressUpdate(data) {
//     if (options.progress) {
//       _utils_log_js__WEBPACK_IMPORTED_MODULE_4__.log.info("".concat(data.pluginName ? "[".concat(data.pluginName, "] ") : "").concat(data.percent, "% - ").concat(data.msg, "."));
//     }
//     if ((0,_progress_js__WEBPACK_IMPORTED_MODULE_6__.isProgressSupported)()) {
//       if (typeof options.progress === "string") {
//         var progress = document.querySelector("wds-progress");
//         if (!progress) {
//           (0,_progress_js__WEBPACK_IMPORTED_MODULE_6__.defineProgressElement)();
//           progress = document.createElement("wds-progress");
//           document.body.appendChild(progress);
//         }
//         progress.setAttribute("progress", data.percent);
//         progress.setAttribute("type", options.progress);
//       }
//     }
//     (0,_utils_sendMessage_js__WEBPACK_IMPORTED_MODULE_5__["default"])("Progress", data);
//   },
//   "still-ok": function stillOk() {
//     _utils_log_js__WEBPACK_IMPORTED_MODULE_4__.log.info("Nothing changed.");
//     if (options.overlay) {
//       overlay.send({
//         type: "DISMISS"
//       });
//     }
//     (0,_utils_sendMessage_js__WEBPACK_IMPORTED_MODULE_5__["default"])("StillOk");
//   },
//   ok: function ok() {
//     (0,_utils_sendMessage_js__WEBPACK_IMPORTED_MODULE_5__["default"])("Ok");
//     if (options.overlay) {
//       overlay.send({
//         type: "DISMISS"
//       });
//     }
//     reloadApp(options, status);
//   },
//   /**
//    * @param {string} file
//    */
//   "static-changed": function staticChanged(file) {
//     _utils_log_js__WEBPACK_IMPORTED_MODULE_4__.log.info("".concat(file ? "\"".concat(file, "\"") : "Content", " from static directory was changed. Reloading..."));
//     self.location.reload();
//   },
//   /**
//    * @param {Error[]} warnings
//    * @param {any} params
//    */
//   warnings: function warnings(_warnings, params) {
//     _utils_log_js__WEBPACK_IMPORTED_MODULE_4__.log.warn("Warnings while compiling.");
//     var printableWarnings = _warnings.map(function (error) {
//       var _formatProblem = (0,_overlay_js__WEBPACK_IMPORTED_MODULE_3__.formatProblem)("warning", error),
//         header = _formatProblem.header,
//         body = _formatProblem.body;
//       return "".concat(header, "\n").concat(stripAnsi(body));
//     });
//     (0,_utils_sendMessage_js__WEBPACK_IMPORTED_MODULE_5__["default"])("Warnings", printableWarnings);
//     for (var i = 0; i < printableWarnings.length; i++) {
//       _utils_log_js__WEBPACK_IMPORTED_MODULE_4__.log.warn(printableWarnings[i]);
//     }
//     var overlayWarningsSetting = typeof options.overlay === "boolean" ? options.overlay : options.overlay && options.overlay.warnings;
//     if (overlayWarningsSetting) {
//       var warningsToDisplay = typeof overlayWarningsSetting === "function" ? _warnings.filter(overlayWarningsSetting) : _warnings;
//       if (warningsToDisplay.length) {
//         overlay.send({
//           type: "BUILD_ERROR",
//           level: "warning",
//           messages: _warnings
//         });
//       }
//     }
//     if (params && params.preventReloading) {
//       return;
//     }
//     reloadApp(options, status);
//   },
//   /**
//    * @param {Error[]} errors
//    */
//   errors: function errors(_errors) {
//     _utils_log_js__WEBPACK_IMPORTED_MODULE_4__.log.error("Errors while compiling. Reload prevented.");
//     var printableErrors = _errors.map(function (error) {
//       var _formatProblem2 = (0,_overlay_js__WEBPACK_IMPORTED_MODULE_3__.formatProblem)("error", error),
//         header = _formatProblem2.header,
//         body = _formatProblem2.body;
//       return "".concat(header, "\n").concat(stripAnsi(body));
//     });
//     (0,_utils_sendMessage_js__WEBPACK_IMPORTED_MODULE_5__["default"])("Errors", printableErrors);
//     for (var i = 0; i < printableErrors.length; i++) {
//       _utils_log_js__WEBPACK_IMPORTED_MODULE_4__.log.error(printableErrors[i]);
//     }
//     var overlayErrorsSettings = typeof options.overlay === "boolean" ? options.overlay : options.overlay && options.overlay.errors;
//     if (overlayErrorsSettings) {
//       var errorsToDisplay = typeof overlayErrorsSettings === "function" ? _errors.filter(overlayErrorsSettings) : _errors;
//       if (errorsToDisplay.length) {
//         overlay.send({
//           type: "BUILD_ERROR",
//           level: "error",
//           messages: _errors
//         });
//       }
//     }
//   },
//   /**
//    * @param {Error} error
//    */
//   error: function error(_error) {
//     _utils_log_js__WEBPACK_IMPORTED_MODULE_4__.log.error(_error);
//   },
//   close: function close() {
//     _utils_log_js__WEBPACK_IMPORTED_MODULE_4__.log.info("Disconnected!");
//     if (options.overlay) {
//       overlay.send({
//         type: "DISMISS"
//       });
//     }
//     (0,_utils_sendMessage_js__WEBPACK_IMPORTED_MODULE_5__["default"])("Close");
//   }
// };

// /**
//  * @param {{ protocol?: string, auth?: string, hostname?: string, port?: string, pathname?: string, search?: string, hash?: string, slashes?: boolean }} objURL
//  * @returns {string}
//  */
// var formatURL = function formatURL(objURL) {
//   var protocol = objURL.protocol || "";
//   if (protocol && protocol.substr(-1) !== ":") {
//     protocol += ":";
//   }
//   var auth = objURL.auth || "";
//   if (auth) {
//     auth = encodeURIComponent(auth);
//     auth = auth.replace(/%3A/i, ":");
//     auth += "@";
//   }
//   var host = "";
//   if (objURL.hostname) {
//     host = auth + (objURL.hostname.indexOf(":") === -1 ? objURL.hostname : "[".concat(objURL.hostname, "]"));
//     if (objURL.port) {
//       host += ":".concat(objURL.port);
//     }
//   }
//   var pathname = objURL.pathname || "";
//   if (objURL.slashes) {
//     host = "//".concat(host || "");
//     if (pathname && pathname.charAt(0) !== "/") {
//       pathname = "/".concat(pathname);
//     }
//   } else if (!host) {
//     host = "";
//   }
//   var search = objURL.search || "";
//   if (search && search.charAt(0) !== "?") {
//     search = "?".concat(search);
//   }
//   var hash = objURL.hash || "";
//   if (hash && hash.charAt(0) !== "#") {
//     hash = "#".concat(hash);
//   }
//   pathname = pathname.replace(/[?#]/g,
//   /**
//    * @param {string} match
//    * @returns {string}
//    */
//   function (match) {
//     return encodeURIComponent(match);
//   });
//   search = search.replace("#", "%23");
//   return "".concat(protocol).concat(host).concat(pathname).concat(search).concat(hash);
// };

// /**
//  * @param {URL & { fromCurrentScript?: boolean }} parsedURL
//  * @returns {string}
//  */
// var createSocketURL = function createSocketURL(parsedURL) {
//   var hostname = parsedURL.hostname;

//   // Node.js module parses it as `::`
//   // `new URL(urlString, [baseURLString])` parses it as '[::]'
//   var isInAddrAny = hostname === "0.0.0.0" || hostname === "::" || hostname === "[::]";

//   // why do we need this check?
//   // hostname n/a for file protocol (example, when using electron, ionic)
//   // see: https://github.com/webpack/webpack-dev-server/pull/384
//   if (isInAddrAny && self.location.hostname && self.location.protocol.indexOf("http") === 0) {
//     hostname = self.location.hostname;
//   }
//   var socketURLProtocol = parsedURL.protocol || self.location.protocol;

//   // When https is used in the app, secure web sockets are always necessary because the browser doesn't accept non-secure web sockets.
//   if (socketURLProtocol === "auto:" || hostname && isInAddrAny && self.location.protocol === "https:") {
//     socketURLProtocol = self.location.protocol;
//   }
//   socketURLProtocol = socketURLProtocol.replace(/^(?:http|.+-extension|file)/i, "ws");
//   var socketURLAuth = "";

//   // `new URL(urlString, [baseURLstring])` doesn't have `auth` property
//   // Parse authentication credentials in case we need them
//   if (parsedURL.username) {
//     socketURLAuth = parsedURL.username;

//     // Since HTTP basic authentication does not allow empty username,
//     // we only include password if the username is not empty.
//     if (parsedURL.password) {
//       // Result: <username>:<password>
//       socketURLAuth = socketURLAuth.concat(":", parsedURL.password);
//     }
//   }

//   // In case the host is a raw IPv6 address, it can be enclosed in
//   // the brackets as the brackets are needed in the final URL string.
//   // Need to remove those as url.format blindly adds its own set of brackets
//   // if the host string contains colons. That would lead to non-working
//   // double brackets (e.g. [[::]]) host
//   //
//   // All of these web socket url params are optionally passed in through resourceQuery,
//   // so we need to fall back to the default if they are not provided
//   var socketURLHostname = (hostname || self.location.hostname || "localhost").replace(/^\[(.*)\]$/, "$1");
//   var socketURLPort = parsedURL.port;
//   if (!socketURLPort || socketURLPort === "0") {
//     socketURLPort = self.location.port;
//   }

//   // If path is provided it'll be passed in via the resourceQuery as a
//   // query param so it has to be parsed out of the querystring in order for the
//   // client to open the socket to the correct location.
//   var socketURLPathname = "/ws";
//   if (parsedURL.pathname && !parsedURL.fromCurrentScript) {
//     socketURLPathname = parsedURL.pathname;
//   }
//   return formatURL({
//     protocol: socketURLProtocol,
//     auth: socketURLAuth,
//     hostname: socketURLHostname,
//     port: socketURLPort,
//     pathname: socketURLPathname,
//     slashes: true
//   });
// };
// var socketURL = createSocketURL(parsedResourceQuery);
// (0,_socket_js__WEBPACK_IMPORTED_MODULE_2__["default"])(socketURL, onSocketMessage, options.reconnect);

// }();
// // This entry needs to be wrapped in an IIFE because it needs to be in strict mode.
// !function() {
// "use strict";
// /*!*******************************!*\
//   !*** ./sections/hero/hero.js ***!
//   \*******************************/
// __webpack_require__.r(__webpack_exports__);
// /* harmony import */ var _hero_scss__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./hero.scss */ "./sections/hero/hero.scss");

// }();
// /******/ })()
// ;
// //# sourceMappingURL=hero.js.map
/* End */
;
; /* Start:"a:4:{s:4:"full";s:85:"/local/templates/s1/components/bitrix/news.list/brands_index/script.js?17787557271242";s:6:"source";s:70:"/local/templates/s1/components/bitrix/news.list/brands_index/script.js";s:3:"min";s:0:"";s:3:"map";s:0:"";}"*/
document.addEventListener('DOMContentLoaded', ()=>{
    const brands = document.querySelectorAll('.brands__item')

    if (brands.length) {
        brands.forEach(brand => {
            brand.addEventListener('mouseover', (e) => {
                e.stopPropagation()
                // console.log('over');
                if (e.target.classList.contains('brands__item')){
                const image = brand.querySelector('img')
                image.style.opacity = '0'
                    const colorSrc = brand.dataset.srcColor
                setTimeout(() => {
                    image.src = colorSrc
                    image.style.opacity = '1';
                }, 300);
                }
            })
            brand.addEventListener('mouseout', (e) => {
                e.stopPropagation()
                if (e.target.classList.contains('brands__item')){
                const image = brand.querySelector('img')
                const src = brand.dataset.src
                image.style.opacity = '0';
                setTimeout(() => {
                  image.src = src  
                  image.style.opacity = '1';
                }, 300);
                }
            })
        })
    }
})
/* End */
;
; /* Start:"a:4:{s:4:"full";s:96:"/local/templates/s1/components/bitrix/catalog.top/top_index/slider/script.min.js?177875594032306";s:6:"source";s:76:"/local/templates/s1/components/bitrix/catalog.top/top_index/slider/script.js";s:3:"min";s:80:"/local/templates/s1/components/bitrix/catalog.top/top_index/slider/script.min.js";s:3:"map";s:80:"/local/templates/s1/components/bitrix/catalog.top/top_index/slider/script.map.js";}"*/
(function(t){if(!!t.JCCatalogTopSlider){return}var s=function(t){s.superclass.constructor.apply(this,arguments);this.nameNode=BX.create("span",{props:{className:"bx_medium bx_bt_button",id:this.id},style:typeof t.style==="object"?t.style:{},text:t.text});this.buttonNode=BX.create("span",{attrs:{className:t.ownerClass},style:{borderBottom:"0 none transparent",marginBottom:"0",position:"static"},children:[this.nameNode],events:this.contextEvents});if(BX.browser.IsIE()){this.buttonNode.setAttribute("hideFocus","hidefocus")}};BX.extend(s,BX.PopupWindowButton);t.JCCatalogTopSlider=function(t){this.productType=0;this.showQuantity=true;this.showAbsent=true;this.secondPict=false;this.showOldPrice=false;this.showPercent=false;this.showSkuProps=false;this.basketAction="ADD";this.showClosePopup=false;this.useCompare=false;this.visual={ID:"",PICT_ID:"",SECOND_PICT_ID:"",QUANTITY_ID:"",QUANTITY_UP_ID:"",QUANTITY_DOWN_ID:"",PRICE_ID:"",DSC_PERC:"",SECOND_DSC_PERC:"",DISPLAY_PROP_DIV:""};this.product={checkQuantity:false,maxQuantity:0,stepQuantity:1,isDblQuantity:false,canBuy:true,canSubscription:true,name:"",pict:{},id:0,addUrl:"",buyUrl:""};this.basketMode="";this.basketData={useProps:false,emptyProps:false,quantity:"quantity",props:"prop",basketUrl:"",sku_props:"",sku_props_var:"basket_props",add_url:"",buy_url:""};this.compareData={compareUrl:"",comparePath:""};this.defaultPict={pict:null,secondPict:null};this.checkQuantity=false;this.maxQuantity=0;this.stepQuantity=1;this.isDblQuantity=false;this.canBuy=true;this.currentBasisPrice={};this.canSubscription=true;this.precision=6;this.precisionFactor=Math.pow(10,this.precision);this.offers=[];this.offerNum=0;this.treeProps=[];this.obTreeRows=[];this.showCount=[];this.showStart=[];this.selectedValues={};this.obProduct=null;this.obQuantity=null;this.obQuantityUp=null;this.obQuantityDown=null;this.obPict=null;this.obSecondPict=null;this.obPrice=null;this.obTree=null;this.obBuyBtn=null;this.obBasketActions=null;this.obNotAvail=null;this.obDscPerc=null;this.obSecondDscPerc=null;this.obSkuProps=null;this.obMeasure=null;this.obCompare=null;this.treeRowShowSize=5;this.treeEnableArrow={display:"",cursor:"pointer",opacity:1};this.treeDisableArrow={display:"",cursor:"default",opacity:.2};this.lastElement=false;this.containerHeight=0;this.errorCode=0;if("object"===typeof t){this.productType=parseInt(t.PRODUCT_TYPE,10);this.showQuantity=t.SHOW_QUANTITY;this.showAbsent=t.SHOW_ABSENT;this.secondPict=!!t.SECOND_PICT;this.showOldPrice=!!t.SHOW_OLD_PRICE;this.showPercent=!!t.SHOW_DISCOUNT_PERCENT;this.showSkuProps=!!t.SHOW_SKU_PROPS;if(!!t.ADD_TO_BASKET_ACTION){this.basketAction=t.ADD_TO_BASKET_ACTION}this.showClosePopup=!!t.SHOW_CLOSE_POPUP;this.useCompare=!!t.DISPLAY_COMPARE;this.visual=t.VISUAL;switch(this.productType){case 0:case 1:case 2:if(!!t.PRODUCT&&"object"===typeof t.PRODUCT){if(this.showQuantity){this.product.checkQuantity=t.PRODUCT.CHECK_QUANTITY;this.product.isDblQuantity=t.PRODUCT.QUANTITY_FLOAT;if(this.product.checkQuantity){this.product.maxQuantity=this.product.isDblQuantity?parseFloat(t.PRODUCT.MAX_QUANTITY):parseInt(t.PRODUCT.MAX_QUANTITY,10)}this.product.stepQuantity=this.product.isDblQuantity?parseFloat(t.PRODUCT.STEP_QUANTITY):parseInt(t.PRODUCT.STEP_QUANTITY,10);this.checkQuantity=this.product.checkQuantity;this.isDblQuantity=this.product.isDblQuantity;this.maxQuantity=this.product.maxQuantity;this.stepQuantity=this.product.stepQuantity;if(this.isDblQuantity){this.stepQuantity=Math.round(this.stepQuantity*this.precisionFactor)/this.precisionFactor}}this.product.canBuy=t.PRODUCT.CAN_BUY;this.product.canSubscription=t.PRODUCT.SUBSCRIPTION;if(!!t.PRODUCT.BASIS_PRICE){this.currentBasisPrice=t.PRODUCT.BASIS_PRICE}this.canBuy=this.product.canBuy;this.canSubscription=this.product.canSubscription;this.product.name=t.PRODUCT.NAME;this.product.pict=t.PRODUCT.PICT;this.product.id=t.PRODUCT.ID;if(!!t.PRODUCT.ADD_URL){this.product.addUrl=t.PRODUCT.ADD_URL}if(!!t.PRODUCT.BUY_URL){this.product.buyUrl=t.PRODUCT.BUY_URL}if(!!t.BASKET&&"object"===typeof t.BASKET){this.basketData.useProps=!!t.BASKET.ADD_PROPS;this.basketData.emptyProps=!!t.BASKET.EMPTY_PROPS}}else{this.errorCode=-1}break;case 3:if(!!t.OFFERS&&BX.type.isArray(t.OFFERS)){this.product.name=t.PRODUCT.NAME;this.product.id=t.PRODUCT.ID;this.offers=t.OFFERS;this.offerNum=0;if(!!t.OFFER_SELECTED){this.offerNum=parseInt(t.OFFER_SELECTED,10)}if(isNaN(this.offerNum)){this.offerNum=0}if(!!t.TREE_PROPS){this.treeProps=t.TREE_PROPS}if(!!t.DEFAULT_PICTURE){this.defaultPict.pict=t.DEFAULT_PICTURE.PICTURE;this.defaultPict.secondPict=t.DEFAULT_PICTURE.PICTURE_SECOND}}break;default:this.errorCode=-1}if(!!t.BASKET&&"object"===typeof t.BASKET){if(!!t.BASKET.QUANTITY){this.basketData.quantity=t.BASKET.QUANTITY}if(!!t.BASKET.PROPS){this.basketData.props=t.BASKET.PROPS}if(!!t.BASKET.BASKET_URL){this.basketData.basketUrl=t.BASKET.BASKET_URL}if(3===this.productType){if(!!t.BASKET.SKU_PROPS){this.basketData.sku_props=t.BASKET.SKU_PROPS}}if(!!t.BASKET.ADD_URL_TEMPLATE){this.basketData.add_url=t.BASKET.ADD_URL_TEMPLATE}if(!!t.BASKET.BUY_URL_TEMPLATE){this.basketData.buy_url=t.BASKET.BUY_URL_TEMPLATE}if(this.basketData.add_url===""&&this.basketData.buy_url===""){this.errorCode=-1024}}if(this.useCompare){if(!!t.COMPARE&&typeof t.COMPARE==="object"){if(!!t.COMPARE.COMPARE_PATH){this.compareData.comparePath=t.COMPARE.COMPARE_PATH}if(!!t.COMPARE.COMPARE_URL_TEMPLATE){this.compareData.compareUrl=t.COMPARE.COMPARE_URL_TEMPLATE}else{this.useCompare=false}}else{this.useCompare=false}}this.lastElement=!!t.LAST_ELEMENT&&"Y"===t.LAST_ELEMENT}if(0===this.errorCode){BX.ready(BX.delegate(this.Init,this))}};t.JCCatalogTopSlider.prototype.Init=function(){var s=0,e="",i=null;this.obProduct=BX(this.visual.ID);if(!this.obProduct){this.errorCode=-1}this.obPict=BX(this.visual.PICT_ID);if(!this.obPict){this.errorCode=-2}if(this.secondPict&&!!this.visual.SECOND_PICT_ID){this.obSecondPict=BX(this.visual.SECOND_PICT_ID)}this.obPrice=BX(this.visual.PRICE_ID);if(!this.obPrice){this.errorCode=-16}if(this.showQuantity&&!!this.visual.QUANTITY_ID){this.obQuantity=BX(this.visual.QUANTITY_ID);if(!!this.visual.QUANTITY_UP_ID){this.obQuantityUp=BX(this.visual.QUANTITY_UP_ID)}if(!!this.visual.QUANTITY_DOWN_ID){this.obQuantityDown=BX(this.visual.QUANTITY_DOWN_ID)}}if(3===this.productType&&this.offers.length>0){if(!!this.visual.TREE_ID){this.obTree=BX(this.visual.TREE_ID);if(!this.obTree){this.errorCode=-256}e=this.visual.TREE_ITEM_ID;for(s=0;s<this.treeProps.length;s++){this.obTreeRows[s]={LEFT:BX(e+this.treeProps[s].ID+"_left"),RIGHT:BX(e+this.treeProps[s].ID+"_right"),LIST:BX(e+this.treeProps[s].ID+"_list"),CONT:BX(e+this.treeProps[s].ID+"_cont")};if(!this.obTreeRows[s].LEFT||!this.obTreeRows[s].RIGHT||!this.obTreeRows[s].LIST||!this.obTreeRows[s].CONT){this.errorCode=-512;break}}}if(!!this.visual.QUANTITY_MEASURE){this.obMeasure=BX(this.visual.QUANTITY_MEASURE)}}this.obBasketActions=BX(this.visual.BASKET_ACTIONS_ID);if(!!this.obBasketActions){if(!!this.visual.BUY_ID){this.obBuyBtn=BX(this.visual.BUY_ID)}}this.obNotAvail=BX(this.visual.NOT_AVAILABLE_MESS);if(this.showPercent){if(!!this.visual.DSC_PERC){this.obDscPerc=BX(this.visual.DSC_PERC)}if(this.secondPict&&!!this.visual.SECOND_DSC_PERC){this.obSecondDscPerc=BX(this.visual.SECOND_DSC_PERC)}}if(this.showSkuProps){if(!!this.visual.DISPLAY_PROP_DIV){this.obSkuProps=BX(this.visual.DISPLAY_PROP_DIV)}}if(0===this.errorCode){if(this.showQuantity){if(!!this.obQuantityUp){BX.bind(this.obQuantityUp,"click",BX.delegate(this.QuantityUp,this))}if(!!this.obQuantityDown){BX.bind(this.obQuantityDown,"click",BX.delegate(this.QuantityDown,this))}if(this.obQuantity){BX.bind(this.obQuantity,"change",BX.delegate(this.QuantityChange,this))}}switch(this.productType){case 1:break;case 3:if(this.offers.length>0){i=BX.findChildren(this.obTree,{tagName:"li"},true);if(!!i&&0<i.length){for(s=0;s<i.length;s++){BX.bind(i[s],"click",BX.delegate(this.SelectOfferProp,this))}}for(s=0;s<this.obTreeRows.length;s++){BX.bind(this.obTreeRows[s].LEFT,"click",BX.delegate(this.RowLeft,this));BX.bind(this.obTreeRows[s].RIGHT,"click",BX.delegate(this.RowRight,this))}this.SetCurrent()}break}if(!!this.obBuyBtn){if(this.basketAction==="ADD"){BX.bind(this.obBuyBtn,"click",BX.delegate(this.Add2Basket,this))}else{BX.bind(this.obBuyBtn,"click",BX.delegate(this.BuyBasket,this))}}if(this.lastElement){this.containerHeight=parseInt(this.obProduct.parentNode.offsetHeight,10);if(isNaN(this.containerHeight)){this.containerHeight=0}this.setHeight();BX.bind(t,"resize",BX.delegate(this.checkHeight,this));BX.bind(this.obProduct.parentNode,"mouseover",BX.delegate(this.setHeight,this));BX.bind(this.obProduct.parentNode,"mouseout",BX.delegate(this.clearHeight,this))}if(this.useCompare){this.obCompare=BX(this.visual.COMPARE_LINK_ID);if(!!this.obCompare){BX.bind(this.obCompare,"click",BX.proxy(this.Compare,this))}}}};t.JCCatalogTopSlider.prototype.checkHeight=function(){this.containerHeight=parseInt(this.obProduct.parentNode.offsetHeight,10);if(isNaN(this.containerHeight)){this.containerHeight=0}};t.JCCatalogTopSlider.prototype.setHeight=function(){if(0<this.containerHeight){BX.adjust(this.obProduct.parentNode,{style:{height:this.containerHeight+"px"}})}};t.JCCatalogTopSlider.prototype.clearHeight=function(){BX.adjust(this.obProduct.parentNode,{style:{height:"auto"}})};t.JCCatalogTopSlider.prototype.QuantityUp=function(){var t=0,s=true,e;if(0===this.errorCode&&this.showQuantity&&this.canBuy){t=this.isDblQuantity?parseFloat(this.obQuantity.value):parseInt(this.obQuantity.value,10);if(!isNaN(t)){t+=this.stepQuantity;if(this.checkQuantity){if(t>this.maxQuantity){s=false}}if(s){if(this.isDblQuantity){t=Math.round(t*this.precisionFactor)/this.precisionFactor}this.obQuantity.value=t;e={DISCOUNT_VALUE:this.currentBasisPrice.DISCOUNT_VALUE*t,VALUE:this.currentBasisPrice.VALUE*t,DISCOUNT_DIFF:this.currentBasisPrice.DISCOUNT_DIFF*t,DISCOUNT_DIFF_PERCENT:this.currentBasisPrice.DISCOUNT_DIFF_PERCENT,CURRENCY:this.currentBasisPrice.CURRENCY};this.setPrice(e)}}}};t.JCCatalogTopSlider.prototype.QuantityDown=function(){var t=0,s=true,e;if(0===this.errorCode&&this.showQuantity&&this.canBuy){t=this.isDblQuantity?parseFloat(this.obQuantity.value):parseInt(this.obQuantity.value,10);if(!isNaN(t)){t-=this.stepQuantity;if(t<this.stepQuantity){s=false}if(s){if(this.isDblQuantity){t=Math.round(t*this.precisionFactor)/this.precisionFactor}this.obQuantity.value=t;e={DISCOUNT_VALUE:this.currentBasisPrice.DISCOUNT_VALUE*t,VALUE:this.currentBasisPrice.VALUE*t,DISCOUNT_DIFF:this.currentBasisPrice.DISCOUNT_DIFF*t,DISCOUNT_DIFF_PERCENT:this.currentBasisPrice.DISCOUNT_DIFF_PERCENT,CURRENCY:this.currentBasisPrice.CURRENCY};this.setPrice(e)}}}};t.JCCatalogTopSlider.prototype.QuantityChange=function(){var t=0,s,e,i;if(0===this.errorCode&&this.showQuantity){if(this.canBuy){t=this.isDblQuantity?parseFloat(this.obQuantity.value):parseInt(this.obQuantity.value,10);if(!isNaN(t)){if(this.checkQuantity){if(t>this.maxQuantity){t=this.maxQuantity}}if(t<this.stepQuantity){t=this.stepQuantity}else{i=Math.round(t*this.precisionFactor/this.stepQuantity)/this.precisionFactor;e=parseInt(i,10);if(isNaN(e)){e=1;i=1.1}if(i>e){t=e<=1?this.stepQuantity:e*this.stepQuantity;t=Math.round(t*this.precisionFactor)/this.precisionFactor}}this.obQuantity.value=t}else{this.obQuantity.value=this.stepQuantity}}else{this.obQuantity.value=this.stepQuantity}s={DISCOUNT_VALUE:this.currentBasisPrice.DISCOUNT_VALUE*this.obQuantity.value,VALUE:this.currentBasisPrice.VALUE*this.obQuantity.value,DISCOUNT_DIFF:this.currentBasisPrice.DISCOUNT_DIFF*this.obQuantity.value,DISCOUNT_DIFF_PERCENT:this.currentBasisPrice.DISCOUNT_DIFF_PERCENT,CURRENCY:this.currentBasisPrice.CURRENCY};this.setPrice(s)}};t.JCCatalogTopSlider.prototype.QuantitySet=function(t){if(0===this.errorCode){this.canBuy=this.offers[t].CAN_BUY;if(this.canBuy){if(!!this.obBasketActions){BX.style(this.obBasketActions,"display","")}if(!!this.obNotAvail){BX.style(this.obNotAvail,"display","none")}}else{if(!!this.obBasketActions){BX.style(this.obBasketActions,"display","none")}if(!!this.obNotAvail){BX.style(this.obNotAvail,"display","")}}if(this.showQuantity){this.isDblQuantity=this.offers[t].QUANTITY_FLOAT;this.checkQuantity=this.offers[t].CHECK_QUANTITY;if(this.isDblQuantity){this.maxQuantity=parseFloat(this.offers[t].MAX_QUANTITY);this.stepQuantity=Math.round(parseFloat(this.offers[t].STEP_QUANTITY)*this.precisionFactor)/this.precisionFactor}else{this.maxQuantity=parseInt(this.offers[t].MAX_QUANTITY,10);this.stepQuantity=parseInt(this.offers[t].STEP_QUANTITY,10)}this.obQuantity.value=this.stepQuantity;this.obQuantity.disabled=!this.canBuy;if(!!this.obMeasure){if(!!this.offers[t].MEASURE){BX.adjust(this.obMeasure,{html:this.offers[t].MEASURE})}else{BX.adjust(this.obMeasure,{html:""})}}}this.currentBasisPrice=this.offers[t].BASIS_PRICE}};t.JCCatalogTopSlider.prototype.SelectOfferProp=function(){var t=0,s="",e="",i=[],a=null,o=BX.proxy_context;if(!!o&&o.hasAttribute("data-treevalue")){e=o.getAttribute("data-treevalue");i=e.split("_");if(this.SearchOfferPropIndex(i[0],i[1])){a=BX.findChildren(o.parentNode,{tagName:"li"},false);if(!!a&&0<a.length){for(t=0;t<a.length;t++){s=a[t].getAttribute("data-onevalue");if(s===i[1]){BX.addClass(a[t],"bx_active")}else{BX.removeClass(a[t],"bx_active")}}}}}};t.JCCatalogTopSlider.prototype.SearchOfferPropIndex=function(t,s){var e="",i=false,a,o,r=[],h=[],n=-1,l={},p=[];for(a=0;a<this.treeProps.length;a++){if(this.treeProps[a].ID===t){n=a;break}}if(-1<n){for(a=0;a<n;a++){e="PROP_"+this.treeProps[a].ID;l[e]=this.selectedValues[e]}e="PROP_"+this.treeProps[n].ID;i=this.GetRowValues(l,e);if(!i){return false}if(!BX.util.in_array(s,i)){return false}l[e]=s;for(a=n+1;a<this.treeProps.length;a++){e="PROP_"+this.treeProps[a].ID;i=this.GetRowValues(l,e);if(!i){return false}h=[];if(this.showAbsent){r=[];p=[];p=BX.clone(l,true);for(o=0;o<i.length;o++){p[e]=i[o];h[h.length]=i[o];if(this.GetCanBuy(p)){r[r.length]=i[o]}}}else{r=i}if(!!this.selectedValues[e]&&BX.util.in_array(this.selectedValues[e],r)){l[e]=this.selectedValues[e]}else{if(this.showAbsent)l[e]=r.length>0?r[0]:h[0];else l[e]=r[0]}this.UpdateRow(a,l[e],i,r)}this.selectedValues=l;this.ChangeInfo()}return true};t.JCCatalogTopSlider.prototype.RowLeft=function(){var t=0,s="",e=-1,i=BX.proxy_context;if(!!i&&i.hasAttribute("data-treevalue")){s=i.getAttribute("data-treevalue");for(t=0;t<this.treeProps.length;t++){if(this.treeProps[t].ID===s){e=t;break}}if(-1<e&&this.treeRowShowSize<this.showCount[e]){if(0>this.showStart[e]){this.showStart[e]++;BX.adjust(this.obTreeRows[e].LIST,{style:{marginLeft:this.showStart[e]*20+"%"}});BX.adjust(this.obTreeRows[e].RIGHT,{style:this.treeEnableArrow})}if(0<=this.showStart[e]){BX.adjust(this.obTreeRows[e].LEFT,{style:this.treeDisableArrow})}}}};t.JCCatalogTopSlider.prototype.RowRight=function(){var t=0,s="",e=-1,i=BX.proxy_context;if(!!i&&i.hasAttribute("data-treevalue")){s=i.getAttribute("data-treevalue");for(t=0;t<this.treeProps.length;t++){if(this.treeProps[t].ID===s){e=t;break}}if(-1<e&&this.treeRowShowSize<this.showCount[e]){if(this.treeRowShowSize-this.showStart[e]<this.showCount[e]){this.showStart[e]--;BX.adjust(this.obTreeRows[e].LIST,{style:{marginLeft:this.showStart[e]*20+"%"}});BX.adjust(this.obTreeRows[e].LEFT,{style:this.treeEnableArrow})}if(this.treeRowShowSize-this.showStart[e]>=this.showCount[e]){BX.adjust(this.obTreeRows[e].RIGHT,{style:this.treeDisableArrow})}}}};t.JCCatalogTopSlider.prototype.UpdateRow=function(t,s,e,i){var a=0,o=0,r="",h=0,n="",l={},p=false,u=false,c=false,d=0,f=this.treeEnableArrow,P=this.treeEnableArrow,T=0,b=null;if(-1<t&&t<this.obTreeRows.length){b=BX.findChildren(this.obTreeRows[t].LIST,{tagName:"li"},false);if(!!b&&0<b.length){p="PICT"===this.treeProps[t].SHOW_MODE;h=e.length;u=this.treeRowShowSize<h;n=u?100/h+"%":"20%";l={props:{className:""},style:{width:n}};if(p){l.style.paddingTop=n}for(a=0;a<b.length;a++){r=b[a].getAttribute("data-onevalue");c=r===s;if(BX.util.in_array(r,i)){l.props.className=c?"bx_active":""}else{l.props.className=c?"bx_active bx_missing":"bx_missing"}l.style.display="none";if(BX.util.in_array(r,e)){l.style.display="";if(c){d=o}o++}BX.adjust(b[a],l)}l={style:{width:(u?20*h:100)+"%",marginLeft:"0%"}};if(p){BX.adjust(this.obTreeRows[t].CONT,{props:{className:u?"bx_item_detail_scu full":"bx_item_detail_scu"}})}else{BX.adjust(this.obTreeRows[t].CONT,{props:{className:u?"bx_item_detail_size full":"bx_item_detail_size"}})}if(u){if(d+1===h){P=this.treeDisableArrow}if(this.treeRowShowSize<=d){T=this.treeRowShowSize-d-1;l.style.marginLeft=T*20+"%"}if(0===T){f=this.treeDisableArrow}BX.adjust(this.obTreeRows[t].LEFT,{style:f});BX.adjust(this.obTreeRows[t].RIGHT,{style:P})}else{BX.adjust(this.obTreeRows[t].LEFT,{style:{display:"none"}});BX.adjust(this.obTreeRows[t].RIGHT,{style:{display:"none"}})}BX.adjust(this.obTreeRows[t].LIST,l);this.showCount[t]=h;this.showStart[t]=T}}};t.JCCatalogTopSlider.prototype.GetRowValues=function(t,s){var e=0,i,a=[],o=false,r=true;if(0===t.length){for(e=0;e<this.offers.length;e++){if(!BX.util.in_array(this.offers[e].TREE[s],a)){a[a.length]=this.offers[e].TREE[s]}}o=true}else{for(e=0;e<this.offers.length;e++){r=true;for(i in t){if(t[i]!==this.offers[e].TREE[i]){r=false;break}}if(r){if(!BX.util.in_array(this.offers[e].TREE[s],a)){a[a.length]=this.offers[e].TREE[s]}o=true}}}return o?a:false};t.JCCatalogTopSlider.prototype.GetCanBuy=function(t){var s=0,e,i=false,a=true;for(s=0;s<this.offers.length;s++){a=true;for(e in t){if(t[e]!==this.offers[s].TREE[e]){a=false;break}}if(a){if(this.offers[s].CAN_BUY){i=true;break}}}return i};t.JCCatalogTopSlider.prototype.SetCurrent=function(){var t=0,s=0,e=[],i="",a=false,o={},r=[],h=this.offers[this.offerNum].TREE;for(t=0;t<this.treeProps.length;t++){i="PROP_"+this.treeProps[t].ID;a=this.GetRowValues(o,i);if(!a){break}if(BX.util.in_array(h[i],a)){o[i]=h[i]}else{o[i]=a[0];this.offerNum=0}if(this.showAbsent){e=[];r=[];r=BX.clone(o,true);for(s=0;s<a.length;s++){r[i]=a[s];if(this.GetCanBuy(r)){e[e.length]=a[s]}}}else{e=a}this.UpdateRow(t,o[i],a,e)}this.selectedValues=o;this.ChangeInfo()};t.JCCatalogTopSlider.prototype.ChangeInfo=function(){var t=0,s,e=-1,i={},a=true,o="";for(t=0;t<this.offers.length;t++){a=true;for(s in this.selectedValues){if(this.selectedValues[s]!==this.offers[t].TREE[s]){a=false;break}}if(a){e=t;break}}if(-1<e){if(!!this.obPict){if(!!this.offers[e].PREVIEW_PICTURE){BX.adjust(this.obPict,{style:{backgroundImage:"url("+this.offers[e].PREVIEW_PICTURE.SRC+")"}})}else{BX.adjust(this.obPict,{style:{backgroundImage:"url("+this.defaultPict.pict.SRC+")"}})}}if(this.secondPict&&!!this.obSecondPict){if(!!this.offers[e].PREVIEW_PICTURE_SECOND){BX.adjust(this.obSecondPict,{style:{backgroundImage:"url("+this.offers[e].PREVIEW_PICTURE_SECOND.SRC+")"}})}else if(!!this.offers[e].PREVIEW_PICTURE.SRC){BX.adjust(this.obSecondPict,{style:{backgroundImage:"url("+this.offers[e].PREVIEW_PICTURE.SRC+")"}})}else if(!!this.defaultPict.secondPict){BX.adjust(this.obSecondPict,{style:{backgroundImage:"url("+this.defaultPict.secondPict.SRC+")"}})}else{BX.adjust(this.obSecondPict,{style:{backgroundImage:"url("+this.defaultPict.pict.SRC+")"}})}}if(this.showSkuProps&&!!this.obSkuProps){if(0===this.offers[e].DISPLAY_PROPERTIES.length){BX.adjust(this.obSkuProps,{style:{display:"none"},html:""})}else{BX.adjust(this.obSkuProps,{style:{display:""},html:this.offers[e].DISPLAY_PROPERTIES})}}this.setPrice(this.offers[e].PRICE);this.offerNum=e;this.QuantitySet(this.offerNum)}};t.JCCatalogTopSlider.prototype.setPrice=function(t){var s,e;if(!!this.obPrice){s=BX.Currency.currencyFormat(t.DISCOUNT_VALUE,t.CURRENCY,true);if(this.showOldPrice&&t.DISCOUNT_VALUE!==t.VALUE){s+=" <span>"+BX.Currency.currencyFormat(t.VALUE,t.CURRENCY,true)+"</span>"}BX.adjust(this.obPrice,{html:s});if(this.showPercent){if(t.DISCOUNT_VALUE!==t.VALUE){e={style:{display:""},html:t.DISCOUNT_DIFF_PERCENT}}else{e={style:{display:"none"},html:""}}if(!!this.obDscPerc){BX.adjust(this.obDscPerc,e)}if(!!this.obSecondDscPerc){BX.adjust(this.obSecondDscPerc,e)}}}};t.JCCatalogTopSlider.prototype.Compare=function(){var t,s;if(!!this.compareData.compareUrl){switch(this.productType){case 0:case 1:case 2:s=this.compareData.compareUrl.replace("#ID#",this.product.id.toString());break;case 3:s=this.compareData.compareUrl.replace("#ID#",this.offers[this.offerNum].ID);break}t={ajax_action:"Y"};BX.ajax.loadJSON(s,t,BX.proxy(this.CompareResult,this))}};t.JCCatalogTopSlider.prototype.CompareResult=function(t){var e,i;if(!!this.obPopupWin)this.obPopupWin.close();if(!BX.type.isPlainObject(t))return;this.InitPopupWindow();if(t.STATUS==="OK"){BX.onCustomEvent("OnCompareChange");e='<div style="width: 100%; margin: 0; text-align: center;"><p>'+BX.message("COMPARE_MESSAGE_OK")+"</p></div>";if(this.showClosePopup){i=[new s({ownerClass:this.obProduct.parentNode.parentNode.parentNode.parentNode.className,text:BX.message("BTN_MESSAGE_COMPARE_REDIRECT"),events:{click:BX.delegate(this.CompareRedirect,this)},style:{marginRight:"10px"}}),new s({ownerClass:this.obProduct.parentNode.parentNode.parentNode.parentNode.className,text:BX.message("BTN_MESSAGE_CLOSE_POPUP"),events:{click:BX.delegate(this.obPopupWin.close,this.obPopupWin)}})]}else{i=[new s({ownerClass:this.obProduct.parentNode.parentNode.parentNode.parentNode.className,text:BX.message("BTN_MESSAGE_COMPARE_REDIRECT"),events:{click:BX.delegate(this.CompareRedirect,this)}})]}}else{e='<div style="width: 100%; margin: 0; text-align: center;"><p>'+(!!t.MESSAGE?t.MESSAGE:BX.message("COMPARE_UNKNOWN_ERROR"))+"</p></div>";i=[new s({ownerClass:this.obProduct.parentNode.parentNode.parentNode.parentNode.className,text:BX.message("BTN_MESSAGE_CLOSE"),events:{click:BX.delegate(this.obPopupWin.close,this.obPopupWin)}})]}this.obPopupWin.setTitleBar(BX.message("COMPARE_TITLE"));this.obPopupWin.setContent(e);this.obPopupWin.setButtons(i);this.obPopupWin.show()};t.JCCatalogTopSlider.prototype.CompareRedirect=function(){if(!!this.compareData.comparePath){location.href=this.compareData.comparePath}else{this.obPopupWin.close()}};t.JCCatalogTopSlider.prototype.InitBasketUrl=function(){this.basketUrl=this.basketMode==="ADD"?this.basketData.add_url:this.basketData.buy_url;switch(this.productType){case 1:case 2:this.basketUrl=this.basketUrl.replace("#ID#",this.product.id.toString());break;case 3:this.basketUrl=this.basketUrl.replace("#ID#",this.offers[this.offerNum].ID);break}this.basketParams={ajax_basket:"Y"};if(this.showQuantity){this.basketParams[this.basketData.quantity]=this.obQuantity.value}if(!!this.basketData.sku_props){this.basketParams[this.basketData.sku_props_var]=this.basketData.sku_props}};t.JCCatalogTopSlider.prototype.FillBasketProps=function(){if(!this.visual.BASKET_PROP_DIV){return}var t=0,s=null,e=false,i=null;if(this.basketData.useProps&&!this.basketData.emptyProps){if(!!this.obPopupWin&&!!this.obPopupWin.contentContainer){i=this.obPopupWin.contentContainer}}else{i=BX(this.visual.BASKET_PROP_DIV)}if(!!i){s=i.getElementsByTagName("select");if(!!s&&!!s.length){for(t=0;t<s.length;t++){if(!s[t].disabled){switch(s[t].type.toLowerCase()){case"select-one":this.basketParams[s[t].name]=s[t].value;e=true;break;default:break}}}}s=i.getElementsByTagName("input");if(!!s&&!!s.length){for(t=0;t<s.length;t++){if(!s[t].disabled){switch(s[t].type.toLowerCase()){case"hidden":this.basketParams[s[t].name]=s[t].value;e=true;break;case"radio":if(s[t].checked){this.basketParams[s[t].name]=s[t].value;e=true}break;default:break}}}}}if(!e){this.basketParams[this.basketData.props]=[];this.basketParams[this.basketData.props][0]=0}};t.JCCatalogTopSlider.prototype.Add2Basket=function(){this.basketMode="ADD";this.Basket()};t.JCCatalogTopSlider.prototype.BuyBasket=function(){this.basketMode="BUY";this.Basket()};t.JCCatalogTopSlider.prototype.SendToBasket=function(){if(!this.canBuy){return}this.InitBasketUrl();this.FillBasketProps();BX.ajax.loadJSON(this.basketUrl,this.basketParams,BX.delegate(this.BasketResult,this))};t.JCCatalogTopSlider.prototype.Basket=function(){var t="";if(!this.canBuy){return}switch(this.productType){case 1:case 2:if(this.basketData.useProps&&!this.basketData.emptyProps){this.InitPopupWindow();this.obPopupWin.setTitleBar(BX.message("TITLE_BASKET_PROPS"));if(BX(this.visual.BASKET_PROP_DIV)){t=BX(this.visual.BASKET_PROP_DIV).innerHTML}this.obPopupWin.setContent(t);this.obPopupWin.setButtons([new s({ownerClass:this.obProduct.parentNode.parentNode.parentNode.parentNode.className,text:BX.message("BTN_MESSAGE_SEND_PROPS"),events:{click:BX.delegate(this.SendToBasket,this)}})]);this.obPopupWin.show()}else{this.SendToBasket()}break;case 3:this.SendToBasket();break}};t.JCCatalogTopSlider.prototype.BasketResult=function(t){var e="",i="",a,o=[];if(!!this.obPopupWin)this.obPopupWin.close();if(!BX.type.isPlainObject(t))return;a=t.STATUS==="OK";if(a&&this.basketAction==="BUY"){this.BasketRedirect()}else{this.InitPopupWindow();if(a){BX.onCustomEvent("OnBasketChange");switch(this.productType){case 1:case 2:i=this.product.pict.SRC;break;case 3:i=!!this.offers[this.offerNum].PREVIEW_PICTURE?this.offers[this.offerNum].PREVIEW_PICTURE.SRC:this.defaultPict.pict.SRC;break}e='<div style="width: 100%; margin: 0; text-align: center;"><img src="'+i+'" height="130" style="max-height:130px"><p>'+this.product.name+"</p></div>";if(this.showClosePopup){o=[new s({ownerClass:this.obProduct.parentNode.parentNode.parentNode.parentNode.className,text:BX.message("BTN_MESSAGE_BASKET_REDIRECT"),events:{click:BX.delegate(this.BasketRedirect,this)},style:{marginRight:"10px"}}),new s({ownerClass:this.obProduct.parentNode.parentNode.parentNode.parentNode.className,text:BX.message("BTN_MESSAGE_CLOSE_POPUP"),events:{click:BX.delegate(this.obPopupWin.close,this.obPopupWin)}})]}else{o=[new s({ownerClass:this.obProduct.parentNode.parentNode.parentNode.parentNode.className,text:BX.message("BTN_MESSAGE_BASKET_REDIRECT"),events:{click:BX.delegate(this.BasketRedirect,this)}})]}}else{e='<div style="width: 100%; margin: 0; text-align: center;"><p>'+(!!t.MESSAGE?t.MESSAGE:BX.message("BASKET_UNKNOWN_ERROR"))+"</p></div>";o=[new s({ownerClass:this.obProduct.parentNode.parentNode.parentNode.parentNode.className,text:BX.message("BTN_MESSAGE_CLOSE"),events:{click:BX.delegate(this.obPopupWin.close,this.obPopupWin)}})]}this.obPopupWin.setTitleBar(a?BX.message("TITLE_SUCCESSFUL"):BX.message("TITLE_ERROR"));this.obPopupWin.setContent(e);this.obPopupWin.setButtons(o);this.obPopupWin.show()}};t.JCCatalogTopSlider.prototype.BasketRedirect=function(){location.href=!!this.basketData.basketUrl?this.basketData.basketUrl:BX.message("BASKET_URL")};t.JCCatalogTopSlider.prototype.InitPopupWindow=function(){if(!!this.obPopupWin)return;this.obPopupWin=BX.PopupWindowManager.create("CatalogSectionBasket_"+this.visual.ID,null,{autoHide:false,offsetLeft:0,offsetTop:0,overlay:true,closeByEsc:true,titleBar:true,closeIcon:true,contentColor:"white"})};if(!!t.JCCatalogTopSliderList){return}t.JCCatalogTopSliderList=function(t){this.params=null;this.currentIndex=0;this.size=0;this.rotate=false;this.rotateTimer=3e4;this.rotatePause=false;this.showPages=false;this.errorCode=0;this.slider={cont:null,rows:null,left:null,right:null,pagination:null,pages:null};if(!t||"object"!==typeof t){this.errorCode=-1}if(0===this.errorCode){this.params=t}if(!!this.params.rotate){this.rotate=this.params.rotate}if(!!this.params.rotateTimer){this.params.rotateTimer=parseInt(this.params.rotateTimer,10);if(!isNaN(this.params.rotateTimer)&&0<=this.params.rotateTimer){this.rotateTimer=this.params.rotateTimer}}if(0===this.errorCode){BX.ready(BX.delegate(this.Init,this))}};t.JCCatalogTopSliderList.prototype.Init=function(){if(0>this.errorCode){return}var t=0;if(!!this.params.cont){this.slider.cont=BX(this.params.cont)}if(!!this.params.rows&&BX.type.isArray(this.params.rows)){this.slider.rows=[];for(t=0;t<this.params.rows.length;t++){this.slider.rows[this.slider.rows.length]=BX(this.params.rows[t]);if(!this.slider.cont){this.slider.cont=this.slider.rows[this.slider.rows.length-1].parent}}this.size=this.slider.rows.length}if(!!this.params.left){if(BX.type.isDomNode(this.params.left)){this.slider.left=this.params.left}else if("object"===typeof this.params.left){this.slider.left=this.slider.cont.appendChild(BX.create("DIV",{props:{id:this.params.left.id,className:this.params.left.className}}))}else if(BX.type.isNotEmptyString(this.params.left)){this.slider.left=BX(this.params.left)}}if(!!this.params.right){if(BX.type.isDomNode(this.params.right)){this.slider.right=this.params.right}else if("object"===typeof this.params.right){this.slider.right=this.slider.cont.appendChild(BX.create("DIV",{props:{id:this.params.right.id,className:this.params.right.className}}))}else if(BX.type.isNotEmptyString(this.params.right)){this.slider.right=BX(this.params.right)}}if(!!this.params.pagination){if(BX.type.isDomNode(this.params.pagination)){this.slider.pagination=this.params.pagination}else if("object"===typeof this.params.pagination){this.slider.pagination=this.slider.cont.appendChild(BX.create("UL",{props:{id:this.params.pagination.id,className:this.params.pagination.className}}))}else if(BX.type.isNotEmptyString(this.params.pagination)){this.slider.pagination=BX(this.params.pagination)}}if(!!this.slider.pagination){this.showPages=true;this.slider.pages=[];for(t=0;t<this.slider.rows.length;t++){this.slider.pages[this.slider.pages.length]=this.slider.pagination.appendChild(BX.create("LI",{props:{className:0===t?"active":"notactive"},attrs:{"data-pagevalue":t.toString()},events:{click:BX.delegate(this.RowMove,this)},html:"<span></span>"}))}}if(0===this.errorCode){if(this.rotate&&!!this.slider.cont&&0<this.rotateTimer){BX.bind(this.slider.cont,"mouseover",BX.delegate(this.RotateStop,this));BX.bind(this.slider.cont,"mouseout",BX.delegate(this.RotateStart,this));setTimeout(BX.delegate(this.RowRotate,this),this.rotateTimer)}if(!!this.slider.left){BX.bind(this.slider.left,"click",BX.delegate(this.RowLeft,this))}if(!!this.slider.right){BX.bind(this.slider.right,"click",BX.delegate(this.RowRight,this))}}};t.JCCatalogTopSliderList.prototype.RowLeft=function(){if(0>this.errorCode){return}if(this.showPages){BX.adjust(this.slider.pages[this.currentIndex],{props:{className:"notactive"}})}BX.adjust(this.slider.rows[this.currentIndex],{props:{className:"bx_catalog_tile_slide notactive"}});this.currentIndex=(0===this.currentIndex?this.size:this.currentIndex)-1;if(this.showPages){BX.adjust(this.slider.pages[this.currentIndex],{props:{className:"active"}})}BX.adjust(this.slider.rows[this.currentIndex],{props:{className:"bx_catalog_tile_slide active"}})};t.JCCatalogTopSliderList.prototype.RowRight=function(){if(0>this.errorCode){return}if(this.showPages){BX.adjust(this.slider.pages[this.currentIndex],{props:{className:"notactive"}})}BX.adjust(this.slider.rows[this.currentIndex],{props:{className:"bx_catalog_tile_slide notactive"}});this.currentIndex++;if(this.currentIndex===this.size){this.currentIndex=0}if(this.showPages){BX.adjust(this.slider.pages[this.currentIndex],{props:{className:"active"}})}BX.adjust(this.slider.rows[this.currentIndex],{props:{className:"bx_catalog_tile_slide active"}})};t.JCCatalogTopSliderList.prototype.RowMove=function(){if(0>this.errorCode){return}var t=0,s=BX.proxy_context;if(!!s&&s.hasAttribute("data-pagevalue")){t=parseInt(s.getAttribute("data-pagevalue"),10);if(!isNaN(t)&&t<this.size){if(this.showPages){BX.adjust(this.slider.pages[this.currentIndex],{props:{className:"notactive"}})}BX.adjust(this.slider.rows[this.currentIndex],{props:{className:"bx_catalog_tile_slide notactive"}});this.currentIndex=t;if(this.showPages){BX.adjust(this.slider.pages[this.currentIndex],{props:{className:"active"}})}BX.adjust(this.slider.rows[this.currentIndex],{props:{className:"bx_catalog_tile_slide active"}})}}};t.JCCatalogTopSliderList.prototype.RowRotate=function(){if(0>this.errorCode){return}if(!this.rotatePause){this.RowRight()}setTimeout(BX.delegate(this.RowRotate,this),this.rotateTimer);

};t.JCCatalogTopSliderList.prototype.RotateStart=function(){if(0>this.errorCode){return}this.rotatePause=false};t.JCCatalogTopSliderList.prototype.RotateStop=function(){if(0>this.errorCode){return}this.rotatePause=true}})(window);
/* End */
;; /* /local/templates/s1/components/bitrix/news.list/hero_index/script.js?1778669341134912*/
; /* /local/templates/s1/components/bitrix/news.list/brands_index/script.js?17787557271242*/
; /* /local/templates/s1/components/bitrix/catalog.top/top_index/slider/script.min.js?177875594032306*/

//# sourceMappingURL=page_00b3ea637bc5b5c633c3acc10483ed72.map.js