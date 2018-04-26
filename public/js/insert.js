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
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/insert.js":
/***/ (function(module, exports) {

document.querySelector('input[name="upload-btn"]').onchange = function () {
    document.querySelector('input[name="upload-file"]').value = this.files[0].name;
};

document.addEventListener("DOMContentLoaded", function () {

    // Listening for input changes
    document.addEventListener("focus", function (e) {
        checkTextfieldInput(e.target);
    }, true);
    document.addEventListener("change", function (e) {
        checkTextfieldInput(e.target);
    }, true);
    document.addEventListener("input", function (e) {
        checkTextfieldInput(e.target);
    }, true);
    document.addEventListener("blur", function (e) {
        checkTextfieldInput(e.target);
    }, true);

    // Initializing inputs
    var inputs = document.getElementsByClassName("mdl-textfield__input");
    for (var i = 0; i < inputs.length; i++) {
        checkTextfieldInput(inputs[i]);
    }
});

function checkTextfieldInput(input) {
    // Getiing the input and the textfield
    if (input instanceof Element && input.matches(".mdl-textfield__input") === true) {
        var field = input.closest(".mdl-textfield"),
            hasValue = input.value.toString().length !== 0;
        // If textfield found
        if (field !== null) {
            // Modifying icons
            var icons = field.getElementsByClassName("mdl-textfield__icon");
            for (var i = 0; i < icons.length; i++) {
                // If no value
                if (hasValue === false && input.isActive() !== true) {
                    icons[i].classList.remove("mdl-color-text--primary");
                }
                // Else if focus or value
                else {
                        icons[i].classList.add("mdl-color-text--primary");
                        // console.log(hasValue, input.isActive())
                    }
            }
        }
    }
}

// Closest
Element.prototype.closest = function (selector) {
    // If is what we're looking for
    if (this.matches(selector) === true) {
        // Return element
        return this;
    }
    // Else
    else {
            // If parent is a valid element
            var parent = this.parentNode;
            if (parent instanceof Element) {
                // Checking parent node
                return parent.closest(selector);
            }
            // Else
            else {
                    // Nothing matches
                    parent = null;
                }
            return parent;
        }
};

// Is active
Element.prototype.isActive = function () {
    return this === document.activeElement;
};

//to make required fields not red
// window.onload = function () {
//     document.querySelectorAll('input[data-required=true]')
//         .forEach(function(input){
//             console.log(document.querySelectorAll('input[data-required=true]').length);
//             input.required = "true";
//     });
// };

//  push it to array and remove required attribute
var requiredComponents = document.querySelectorAll("[required]");
requiredComponents.forEach(function (e) {
    e.removeAttribute('required');
});
// // when submit button click, add required attribute back
document.querySelector(".submit-btn").addEventListener("click", function () {
    requiredComponents.forEach(function (e) {
        e.setAttribute('required', true);
    });
});
// // also when form submit event
document.querySelector(".curriculo-form").addEventListener("submit", function () {
    requiredComponents.forEach(function (e) {
        e.setAttribute('required', true);
    });
});
// you can also add required attribute back when any other event, like blur...etc.

$(document).ready(function ($) {
    //Mask for telephone number
    var SPMaskBehavior = function SPMaskBehavior(val) {
        return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
    },
        spOptions = {
        onKeyPress: function onKeyPress(val, e, field, options) {
            field.mask(SPMaskBehavior.apply({}, arguments), options);
        }
    };
    $('[name="tel"]').mask(SPMaskBehavior, spOptions);
});

/***/ }),

/***/ 2:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__("./resources/assets/js/insert.js");


/***/ })

/******/ });