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
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
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
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 3);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/list.js":
/***/ (function(module, exports) {

var dialog = document.querySelector('dialog');

document.querySelectorAll('.ev-open-dialog').forEach(function (btn) {
    btn.addEventListener('click', function () {
        // dialogPolyfill.registerDialog(dialog);
        // Now dialog acts like a native <dialog>.
        dialog.showModal();
        var modalTitle = this.parentNode.parentNode.childNodes[1].childNodes[1].innerHTML + ' - TAGS';
        document.querySelector('.mdl-dialog__title').innerHTML = modalTitle;
    });
});

dialog.querySelector('.close').addEventListener('click', function () {
    dialog.close();
});

document.querySelectorAll('.ev-archive').forEach(function (btn) {
    btn.addEventListener('click', function () {
        var parent = this.parentNode.parentNode.parentNode;
        parent.classList.add('removed-item');
        setTimeout(function () {
            parent.remove();
        }, 450);
    });
});

$('.rating').barrating({
    theme: 'fontawesome-stars',
    showSelectedRating: false,
    onSelect: function onSelect(value, text, event) {
        if (typeof event !== 'undefined') {
            // rating was selected by a user
            console.log(event.target);
        } else {
            // rating was selected programmatically
            // by calling `set` method
        }
    }
});

$(document).ready(function () {
    $(".mdl-layout__drawer-button").html('<i class="fa fa-bars" aria-hidden="true"></i>');
});

/***/ }),

/***/ 3:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__("./resources/assets/js/list.js");


/***/ })

/******/ });