/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};

/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {

/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;

/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			exports: {},
/******/ 			id: moduleId,
/******/ 			loaded: false
/******/ 		};

/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);

/******/ 		// Flag the module as loaded
/******/ 		module.loaded = true;

/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}


/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;

/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;

/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";

/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ function(module, exports, __webpack_require__) {

	  __webpack_require__(1);




	  __webpack_require__(5);

	  __webpack_require__(6);
	  __webpack_require__(7);
	  __webpack_require__(8);

	  __webpack_require__(9);

	  __webpack_require__(10);
	  __webpack_require__(13);
	  __webpack_require__(14);


/***/ },
/* 1 */
/***/ function(module, exports, __webpack_require__) {

	// style-loader: Adds some css to the DOM by adding a <style> tag

	// load the styles
	var content = __webpack_require__(2);
	if(typeof content === 'string') content = [[module.id, content, '']];
	// add the styles to the DOM
	var update = __webpack_require__(4)(content, {});
	if(content.locals) module.exports = content.locals;
	// Hot Module Replacement
	if(false) {
		// When the styles change, update the <style> tags
		if(!content.locals) {
			module.hot.accept("!!./../../node_modules/css-loader/index.js!./../../node_modules/sass-loader/index.js!./discordapp.scss", function() {
				var newContent = require("!!./../../node_modules/css-loader/index.js!./../../node_modules/sass-loader/index.js!./discordapp.scss");
				if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
				update(newContent);
			});
		}
		// When the module is disposed, remove the <style> tags
		module.hot.dispose(function() { update(); });
	}

/***/ },
/* 2 */
/***/ function(module, exports, __webpack_require__) {

	exports = module.exports = __webpack_require__(3)();
	// imports


	// module
	exports.push([module.id, ".discord-main {\n  height: 100vh;\n  margin-top: -100px;\n  padding-top: 150px;\n  position: relative; }\n  .discord-main:before {\n    content: '';\n    background: url(/../wp-content/plugins/SCFR-Discord/app/images/olisar.jpg);\n    background-size: cover;\n    width: 100%;\n    height: 100%;\n    opacity: 0.2;\n    position: absolute;\n    top: 0px;\n    left: 0px; }\n  .discord-main .md-toolbar-tools {\n    font-family: \"Electrolize\";\n    font-weight: bold; }\n  .discord-main .discord-user-avatar {\n    border-radius: 50%; }\n", ""]);

	// exports


/***/ },
/* 3 */
/***/ function(module, exports) {

	/*
		MIT License http://www.opensource.org/licenses/mit-license.php
		Author Tobias Koppers @sokra
	*/
	// css base code, injected by the css-loader
	module.exports = function() {
		var list = [];

		// return the list of modules as css string
		list.toString = function toString() {
			var result = [];
			for(var i = 0; i < this.length; i++) {
				var item = this[i];
				if(item[2]) {
					result.push("@media " + item[2] + "{" + item[1] + "}");
				} else {
					result.push(item[1]);
				}
			}
			return result.join("");
		};

		// import a list of modules into the list
		list.i = function(modules, mediaQuery) {
			if(typeof modules === "string")
				modules = [[null, modules, ""]];
			var alreadyImportedModules = {};
			for(var i = 0; i < this.length; i++) {
				var id = this[i][0];
				if(typeof id === "number")
					alreadyImportedModules[id] = true;
			}
			for(i = 0; i < modules.length; i++) {
				var item = modules[i];
				// skip already imported module
				// this implementation is not 100% perfect for weird media query combinations
				//  when a module is imported multiple times with different media queries.
				//  I hope this will never occur (Hey this way we have smaller bundles)
				if(typeof item[0] !== "number" || !alreadyImportedModules[item[0]]) {
					if(mediaQuery && !item[2]) {
						item[2] = mediaQuery;
					} else if(mediaQuery) {
						item[2] = "(" + item[2] + ") and (" + mediaQuery + ")";
					}
					list.push(item);
				}
			}
		};
		return list;
	};


/***/ },
/* 4 */
/***/ function(module, exports, __webpack_require__) {

	/*
		MIT License http://www.opensource.org/licenses/mit-license.php
		Author Tobias Koppers @sokra
	*/
	var stylesInDom = {},
		memoize = function(fn) {
			var memo;
			return function () {
				if (typeof memo === "undefined") memo = fn.apply(this, arguments);
				return memo;
			};
		},
		isOldIE = memoize(function() {
			return /msie [6-9]\b/.test(window.navigator.userAgent.toLowerCase());
		}),
		getHeadElement = memoize(function () {
			return document.head || document.getElementsByTagName("head")[0];
		}),
		singletonElement = null,
		singletonCounter = 0,
		styleElementsInsertedAtTop = [];

	module.exports = function(list, options) {
		if(false) {
			if(typeof document !== "object") throw new Error("The style-loader cannot be used in a non-browser environment");
		}

		options = options || {};
		// Force single-tag solution on IE6-9, which has a hard limit on the # of <style>
		// tags it will allow on a page
		if (typeof options.singleton === "undefined") options.singleton = isOldIE();

		// By default, add <style> tags to the bottom of <head>.
		if (typeof options.insertAt === "undefined") options.insertAt = "bottom";

		var styles = listToStyles(list);
		addStylesToDom(styles, options);

		return function update(newList) {
			var mayRemove = [];
			for(var i = 0; i < styles.length; i++) {
				var item = styles[i];
				var domStyle = stylesInDom[item.id];
				domStyle.refs--;
				mayRemove.push(domStyle);
			}
			if(newList) {
				var newStyles = listToStyles(newList);
				addStylesToDom(newStyles, options);
			}
			for(var i = 0; i < mayRemove.length; i++) {
				var domStyle = mayRemove[i];
				if(domStyle.refs === 0) {
					for(var j = 0; j < domStyle.parts.length; j++)
						domStyle.parts[j]();
					delete stylesInDom[domStyle.id];
				}
			}
		};
	}

	function addStylesToDom(styles, options) {
		for(var i = 0; i < styles.length; i++) {
			var item = styles[i];
			var domStyle = stylesInDom[item.id];
			if(domStyle) {
				domStyle.refs++;
				for(var j = 0; j < domStyle.parts.length; j++) {
					domStyle.parts[j](item.parts[j]);
				}
				for(; j < item.parts.length; j++) {
					domStyle.parts.push(addStyle(item.parts[j], options));
				}
			} else {
				var parts = [];
				for(var j = 0; j < item.parts.length; j++) {
					parts.push(addStyle(item.parts[j], options));
				}
				stylesInDom[item.id] = {id: item.id, refs: 1, parts: parts};
			}
		}
	}

	function listToStyles(list) {
		var styles = [];
		var newStyles = {};
		for(var i = 0; i < list.length; i++) {
			var item = list[i];
			var id = item[0];
			var css = item[1];
			var media = item[2];
			var sourceMap = item[3];
			var part = {css: css, media: media, sourceMap: sourceMap};
			if(!newStyles[id])
				styles.push(newStyles[id] = {id: id, parts: [part]});
			else
				newStyles[id].parts.push(part);
		}
		return styles;
	}

	function insertStyleElement(options, styleElement) {
		var head = getHeadElement();
		var lastStyleElementInsertedAtTop = styleElementsInsertedAtTop[styleElementsInsertedAtTop.length - 1];
		if (options.insertAt === "top") {
			if(!lastStyleElementInsertedAtTop) {
				head.insertBefore(styleElement, head.firstChild);
			} else if(lastStyleElementInsertedAtTop.nextSibling) {
				head.insertBefore(styleElement, lastStyleElementInsertedAtTop.nextSibling);
			} else {
				head.appendChild(styleElement);
			}
			styleElementsInsertedAtTop.push(styleElement);
		} else if (options.insertAt === "bottom") {
			head.appendChild(styleElement);
		} else {
			throw new Error("Invalid value for parameter 'insertAt'. Must be 'top' or 'bottom'.");
		}
	}

	function removeStyleElement(styleElement) {
		styleElement.parentNode.removeChild(styleElement);
		var idx = styleElementsInsertedAtTop.indexOf(styleElement);
		if(idx >= 0) {
			styleElementsInsertedAtTop.splice(idx, 1);
		}
	}

	function createStyleElement(options) {
		var styleElement = document.createElement("style");
		styleElement.type = "text/css";
		insertStyleElement(options, styleElement);
		return styleElement;
	}

	function createLinkElement(options) {
		var linkElement = document.createElement("link");
		linkElement.rel = "stylesheet";
		insertStyleElement(options, linkElement);
		return linkElement;
	}

	function addStyle(obj, options) {
		var styleElement, update, remove;

		if (options.singleton) {
			var styleIndex = singletonCounter++;
			styleElement = singletonElement || (singletonElement = createStyleElement(options));
			update = applyToSingletonTag.bind(null, styleElement, styleIndex, false);
			remove = applyToSingletonTag.bind(null, styleElement, styleIndex, true);
		} else if(obj.sourceMap &&
			typeof URL === "function" &&
			typeof URL.createObjectURL === "function" &&
			typeof URL.revokeObjectURL === "function" &&
			typeof Blob === "function" &&
			typeof btoa === "function") {
			styleElement = createLinkElement(options);
			update = updateLink.bind(null, styleElement);
			remove = function() {
				removeStyleElement(styleElement);
				if(styleElement.href)
					URL.revokeObjectURL(styleElement.href);
			};
		} else {
			styleElement = createStyleElement(options);
			update = applyToTag.bind(null, styleElement);
			remove = function() {
				removeStyleElement(styleElement);
			};
		}

		update(obj);

		return function updateStyle(newObj) {
			if(newObj) {
				if(newObj.css === obj.css && newObj.media === obj.media && newObj.sourceMap === obj.sourceMap)
					return;
				update(obj = newObj);
			} else {
				remove();
			}
		};
	}

	var replaceText = (function () {
		var textStore = [];

		return function (index, replacement) {
			textStore[index] = replacement;
			return textStore.filter(Boolean).join('\n');
		};
	})();

	function applyToSingletonTag(styleElement, index, remove, obj) {
		var css = remove ? "" : obj.css;

		if (styleElement.styleSheet) {
			styleElement.styleSheet.cssText = replaceText(index, css);
		} else {
			var cssNode = document.createTextNode(css);
			var childNodes = styleElement.childNodes;
			if (childNodes[index]) styleElement.removeChild(childNodes[index]);
			if (childNodes.length) {
				styleElement.insertBefore(cssNode, childNodes[index]);
			} else {
				styleElement.appendChild(cssNode);
			}
		}
	}

	function applyToTag(styleElement, obj) {
		var css = obj.css;
		var media = obj.media;

		if(media) {
			styleElement.setAttribute("media", media)
		}

		if(styleElement.styleSheet) {
			styleElement.styleSheet.cssText = css;
		} else {
			while(styleElement.firstChild) {
				styleElement.removeChild(styleElement.firstChild);
			}
			styleElement.appendChild(document.createTextNode(css));
		}
	}

	function updateLink(linkElement, obj) {
		var css = obj.css;
		var sourceMap = obj.sourceMap;

		if(sourceMap) {
			// http://stackoverflow.com/a/26603875
			css += "\n/*# sourceMappingURL=data:application/json;base64," + btoa(unescape(encodeURIComponent(JSON.stringify(sourceMap)))) + " */";
		}

		var blob = new Blob([css], { type: "text/css" });

		var oldSrc = linkElement.href;

		linkElement.href = URL.createObjectURL(blob);

		if(oldSrc)
			URL.revokeObjectURL(oldSrc);
	}


/***/ },
/* 5 */
/***/ function(module, exports) {

	app.service("discord.service.user", ["$http", "$q",  function($http, $q) {
	  var service = {
	    userStatus: "USER_NOT_LOGGED_IN",
	    discord: false,
	  };

	  service.getUserData = function() {
	    var p = $http.get(DISCORD_API_URL+"RefreshDiscord").then(function(data) {
	      service.discord = data.data;

	      return service.user;
	    });

	    return p;
	  };

	  service.getUserStatus = function() {
	    var p = $http.get(DISCORD_API_URL+"OAuthStatus").then(function(data) {
	      service.userStatus = data.data;
	      if(service.userStatus === "USER_OKAY") service.getUserData();
	      return service.userStatus;
	    });

	    return p;
	  };

	  service.authorizeCode = function(code) {
	    var p = $http.get(DISCORD_API_URL+"Authorize", {params: {code: code}}).then(function(data) {
	      if(data.data.id) {
	        service.discord = data.data;
	        service.userStatus = "USER_OKAY";
	        return true;
	      }
	      return false;
	    });

	    return p;
	  };

	  init = function() {
	    service.getUserStatus();
	  };

	  init();


	  return service;
	}]);


/***/ },
/* 6 */
/***/ function(module, exports) {

	app.controller("DiscordMain", ["$scope", "$state", function($scope, $state) {
	  console.log($state.params);

	  $scope.appURL = DISCORD_APP_URL;
	  //ngMaterial
	}]);


/***/ },
/* 7 */
/***/ function(module, exports) {

	app.controller("DiscordAuthorize", ["$scope", "$state",  function($scope, $state) {
	  console.log($state);
	}]);


/***/ },
/* 8 */
/***/ function(module, exports) {

	app.controller("DiscordUserCard", ["$scope", "$state", "discord.service.user", "$stateParams", function($scope, $state, user, $stateParams) {
	  $scope.user = user;


	  $scope.status = function() {
	    if(user.userStatus === "USER_OKAY") return "Votre compte discord est connecté à votre compte SC.FR. Vous pouvez profiter pleinement de nos services et plugins.";
	    else if($stateParams.code) return "Traitement en cours...";
	    else if(user.userStatus === "USER_NO_TOKEN") return "Clickez sur le bouton discord pour connecter votre compte Discord à SC.FR";
	    return "Veuillez vous connectez.";
	  };

	  $scope.getDiscordCode = function() {
	    document.location.href = DISCORD_API_URL+"Connect";
	  };

	  handleCode = function() {
	    $scope.busy = true;
	    user.authorizeCode($stateParams.code).then(function(ok) {
	      if(ok) {
	        $stateParams.code = false;
	        $scope.busy = false;
	      }
	    });
	  };

	  if($stateParams.code) handleCode();

	}]);


/***/ },
/* 9 */
/***/ function(module, exports) {

	app.directive("discordMainUserCard", function() {
	  return {
	    templateUrl: DISCORD_APP_URL+"template/common/user-card.html",
	    restrict:'E',
	    controller:'DiscordUserCard',
	    replace: true,
	  };
	});


/***/ },
/* 10 */
/***/ function(module, exports, __webpack_require__) {

	__webpack_require__(11)(__webpack_require__(12))

/***/ },
/* 11 */
/***/ function(module, exports) {

	/*
		MIT License http://www.opensource.org/licenses/mit-license.php
		Author Tobias Koppers @sokra
	*/
	module.exports = function(src) {
		if (typeof execScript !== "undefined")
			execScript(src);
		else
			eval.call(null, src);
	}


/***/ },
/* 12 */
/***/ function(module, exports) {

	module.exports = "if (typeof location.origin === 'undefined') location.origin = location.protocol + '//' + location.host;\r\nvar DISCORD_API_URL = location.origin + \"/wp-json/Discord/\";\r\nvar DISCORD_APP_URL = location.origin + \"/wp-content/plugins/SCFR-Discord/app/\";\r\n"

/***/ },
/* 13 */
/***/ function(module, exports) {

	app.config(["$stateProvider", "$locationProvider", "$urlRouterProvider", function($stateProvider, $locationProvider, $urlRouterProvider) {

	  var LOCAL_PATH = HUBPATH+"../../../plugins/SCFR-Discord/app/template/";

	  //$locationProvider.html5Mode(true);


	  $stateProvider.state('Discord', {
	    url:'',
	    abstract:true,
	    controller: "DiscordMain",
	    templateUrl: LOCAL_PATH+"/main.html",
	  });

	  $stateProvider.state('Discord.index', {
	    url: '/Discord/',
	    templateUrl: LOCAL_PATH+"/accueil.html",
	  });

	  $stateProvider.state('Discord.authorize', {
	    url: '/Discord/Authorize/?code',
	    templateUrl: LOCAL_PATH+"/authorize.html",
	    controller: "DiscordAuthorize",
	  });

	  $urlRouterProvider.otherwise('/Discord/');
	}]);


/***/ },
/* 14 */
/***/ function(module, exports) {

	angular.module("starCitizen").requires.push('ngMaterial');

	app.config(["$stateProvider", "$locationProvider", "$mdThemingProvider", function($stateProvider, $locationProvider, $mdThemingProvider) {
	  $('a').each(function(){
	    $a = $(this);
	    if ($a.is('[target]') || $a.is('[ng-href]')){
	    } else {
	      $a.attr('target', '_self');
	    }
	  });

	  $locationProvider.html5Mode(true);

	  var customPrimary = {
	         '50': '#8eb7c3',
	         '100': '#7eacba',
	         '200': '#6da1b1',
	         '300': '#5d97a8',
	         '400': '#52899a',
	         '500': '#497A89',
	         '600': '#406b78',
	         '700': '#375c68',
	         '800': '#2e4e57',
	         '900': '#263f46',
	         'A100': '#9fc1cc',
	         'A200': '#b0ccd5',
	         'A400': '#c0d7de',
	         'A700': '#1d3036'
	     };
	    $mdThemingProvider
	        .definePalette('customPrimary',
	                        customPrimary);

	    var customAccent = {
	        '50': '#142125',
	        '100': '#1d3036',
	        '200': '#263f46',
	        '300': '#2e4e57',
	        '400': '#375c68',
	        '500': '#406b78',
	        '600': '#52899a',
	        '700': '#5d97a8',
	        '800': '#6da1b1',
	        '900': '#7eacba',
	        'A100': '#52899a',
	        'A200': '#497a89',
	        'A400': '#406b78',
	        'A700': '#8eb7c3'
	    };
	    $mdThemingProvider
	        .definePalette('customAccent',
	                        customAccent);

	    var customWarn = {
	        '50': '#ffb280',
	        '100': '#ffa266',
	        '200': '#ff934d',
	        '300': '#ff8333',
	        '400': '#ff741a',
	        '500': '#ff6400',
	        '600': '#e65a00',
	        '700': '#cc5000',
	        '800': '#b34600',
	        '900': '#993c00',
	        'A100': '#ffc199',
	        'A200': '#ffd1b3',
	        'A400': '#ffe0cc',
	        'A700': '#803200'
	    };
	    $mdThemingProvider
	        .definePalette('customWarn',
	                        customWarn);

	    var customBackground = {
	        '50': '#587487',
	        '100': '#4e6778',
	        '200': '#445a68',
	        '300': '#3a4d59',
	        '400': '#303f49',
	        '500': '#26323a',
	        '600': '#1c252b',
	        '700': '#12171b',
	        '800': '#282e31',
	        '900': '#000000',
	        'A100': '#638296',
	        'A200': '#718ea2',
	        'A400': '#26323a',
	        'A700': '#000000'
	    };
	     $mdThemingProvider
	         .definePalette('customBackground',
	                         customBackground);

	    $mdThemingProvider.theme('default')
	        .primaryPalette('customPrimary')
	        .accentPalette('customAccent')
	        .warnPalette('customWarn')
	        .backgroundPalette('customBackground').dark();


	}]);


/***/ }
/******/ ]);