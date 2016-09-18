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

	__webpack_require__(2);


/***/ },
/* 1 */
/***/ function(module, exports) {

	app.controller("DiscordMain", ["$scope", "$state", function($scope, $state) {
	  console.log($state.params);
	}]);


/***/ },
/* 2 */
/***/ function(module, exports, __webpack_require__) {

	__webpack_require__(3);

	app.config(["$stateProvider", "$locationProvider", function($stateProvider, $locationProvider) {
	  $('a').each(function(){
	    $a = $(this);
	    if ($a.is('[target]') || $a.is('[ng-href]')){
	    } else {
	      $a.attr('target', '_self');
	    }
	  });
	  
	  $locationProvider.html5Mode(true);
	}]);


/***/ },
/* 3 */
/***/ function(module, exports) {

	app.config(["$stateProvider", "$locationProvider", function($stateProvider, $locationProvider) {

	  var LOCAL_PATH = HUBPATH+"../../../plugins/SCFR-Discord/app/template/";

	  //$locationProvider.html5Mode(true);

	  $stateProvider.state('Discord', {
	    url: '/Discord/',
	    templateUrl: LOCAL_PATH+"/main.html",
	    controller: "DiscordMain",
	  });

	  $stateProvider.state('Discord.bn', {
	    url: 'bn',
	    templateUrl: LOCAL_PATH+"/main.html",
	    controller: "DiscordMain",
	  });

	  $stateProvider.state('Discord.authorize', {
	    url: 'Authorize/?code',
	    templateUrl: LOCAL_PATH+"/main.html",
	    controller: "DiscordAuthorize",
	  });

	}]);


/***/ }
/******/ ]);