/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/custom.js":
/*!********************************!*\
  !*** ./resources/js/custom.js ***!
  \********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


$('document').ready(function () {
  var prev = '';
  $('.userDetail').click(function () {
    var divs = document.getElementsByClassName('userDetail');
    var infoId = 'infos';
    [].slice.call(divs).forEach(function (div) {
      div.innerHTML = '<i class="fas fa-plus"></i>';
      document.getElementById(infoId.concat(div.id)).style.display = "none";
    });

    if (prev == this.id) {
      document.getElementById(infoId.concat(this.id)).style.display = "none";
      document.getElementById(this.id).innerHTML = '<i class="fas fa-plus"></i>';
      prev = '';
    } else {
      document.getElementById(infoId.concat(this.id)).style.display = "flex";
      document.getElementById(this.id).innerHTML = '<i class="fas fa-minus"></i>';
      prev = this.id;
    }
  });
  var prev2 = '';
  $('.quizDetail').click(function () {
    var divs2 = document.getElementsByClassName('quizDetail');
    var info2Id = 'infosQ';
    [].slice.call(divs2).forEach(function (div) {
      div.innerHTML = '<i class="fas fa-plus"></i>';
      document.getElementById(info2Id.concat(div.id)).style.display = "none";
    });

    if (prev2 == this.id) {
      document.getElementById(info2Id.concat(this.id)).style.display = "none";
      document.getElementById(this.id).innerHTML = '<i class="fas fa-plus"></i>';
      prev2 = '';
    } else {
      document.getElementById(info2Id.concat(this.id)).style.display = "flex";
      document.getElementById(this.id).innerHTML = '<i class="fas fa-minus"></i>';
      prev2 = this.id;
    }
  });
  $('#searchInput').keyup(function () {
    // Declare variables
    var input, filter, div, li, a, i, txtValue;
    input = document.getElementById('searchInput');
    filter = input.value.toUpperCase();
    div = document.getElementById("searchResult");
    li = div.getElementsByClassName('searchElement');
    var totalHide = 0; // Loop through all list items, and hide those who don't match the search query

    for (i = 0; i < li.length; i++) {
      a = li[i].getElementsByClassName("quizTitre")[0];
      txtValue = a.textContent || a.innerText;

      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        li[i].style.display = "";
      } else {
        li[i].style.display = "none";
      }
    }
  });
  var prevSearch = "";
  $('.searchSort').click(function () {
    var active = document.getElementsByClassName('btn-primary');
    active[0].classList.add('btn-secondary');
    active[0].classList.remove('btn-primary');
    var self = this;
    var quizBucket = new Array();
    var quizList = $$('div.searchElement');

    for (var i = 0; i < quizList.length; i++) {
      var obj = {
        created_at: quizList[i].getElementsByClassName('created_at')[0].textContent,
        titre: quizList[i].getElementsByClassName('quizTitre')[0].textContent,
        Creator: quizList[i].getElementsByClassName('creator')[0].textContent,
        compteur: quizList[i].getElementsByClassName('compteur')[0].textContent,
        noteAvg: quizList[i].getElementsByClassName('noteAvg')[0].textContent
      };
      quizBucket[i] = new Array();
      quizBucket[i][0] = obj;
      quizBucket[i][1] = quizList[i].dispose();
    }

    self.classList.remove('btn-secondary');
    self.classList.add('btn-primary');

    if (self.id == prevSearch) {
      switch (self.id) {
        case 'compteur':
        case 'noteAvg':
          quizBucket.sort(function (a, b) {
            return b[0][self.id] - a[0][self.id];
          });
          break;

        default:
          quizBucket.sort(function (a, b) {
            if (a[0][self.id].toLowerCase() === b[0][self.id].toLowerCase()) {
              return 0;
            }

            if (a[0][self.id].toLowerCase() > b[0][self.id].toLowerCase()) {
              return -1;
            } else {
              return 1;
            }
          });
          break;
      }

      prevSearch = "";
    } else {
      switch (self.id) {
        case 'compteur':
        case 'noteAvg':
          quizBucket.sort(function (a, b) {
            return a[0][self.id] - b[0][self.id];
          });
          break;

        default:
          quizBucket.sort(function (a, b) {
            if (a[0][self.id].toLowerCase() === b[0][self.id].toLowerCase()) {
              return 0;
            }

            if (a[0][self.id].toLowerCase() > b[0][self.id].toLowerCase()) {
              return 1;
            } else {
              return -1;
            }
          });
          break;
      }

      prevSearch = self.id;
    } // re-inject sorted divs into page


    for (var _i = 0; _i < quizList.length; _i++) {
      quizBucket[_i][1].inject(document.getElementById('searchResult'));
    }
  });
});

/***/ }),

/***/ 1:
/*!**************************************!*\
  !*** multi ./resources/js/custom.js ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! D:\Workspace\B2\ProjetWeb-LaReponseD_-_v2\LaReponseD\resources\js\custom.js */"./resources/js/custom.js");


/***/ })

/******/ });