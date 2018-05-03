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

//dialog
var dialog = document.querySelector('dialog');
var dialogProfile = '';

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

//=====================================================
// EVENTOS
//=====================================================
//animation to curriculum archiving
document.querySelectorAll('.ev-archive').forEach(function (btn) {
    btn.addEventListener('click', function () {
        animate(this.parentNode.parentNode.parentNode);
    });
});

//dialog open button
document.querySelectorAll('.ev-open-dialog').forEach(function (btn) {
    btn.addEventListener('click', function () {
        var content = $('.mdl-dialog__content'); //seleciona a div de conteudo do modal

        var modalTitle = this.parentNode.parentNode.childNodes[1].childNodes[1].innerHTML + ' - TAGS'; //pega o nome do curriculo
        document.querySelector('.mdl-dialog__title').innerHTML = modalTitle; //coloca o nome capturado no modal

        showSpinner();

        dialogProfile = $(this).attr('data-profile-id');

        populateDialog(dialogProfile);

        dialog.showModal();
    });
});

//dialog close button
dialog.querySelector('.ev-close-dialog').addEventListener('click', function () {
    dialog.close();
});

//ação de enviar uma nova tag
$('.ev-submit-tag').submit(function (event) {
    event.preventDefault();

    showSpinner();

    var value = $(this).find('input[name="new-tag"]').val();
    var route = 'curriculum/' + dialogProfile + '/tag'; //monta a rota da requisição

    $.post(route, { tag: value }, function (data, status, xhr) {
        if (status === 'success') {
            $('.ev-submit-tag').find('input[name="new-tag"]').val('');
            populateDialog(dialogProfile);
        } else {
            console.log(xhr);
        }
    });
});

//==========================================================================
// FUNÇÕES AUXILIARES
//==========================================================================
//recupera as tags do perfil e coloca no dialog
function populateDialog(profile_id) {
    var route = 'curriculum/' + profile_id + '/tag'; //monta a rota da requisição

    $.get(route, function (data, status) {
        //requisita as tags do curriculo
        if (status === 'success') {
            renderData(data.tag);
        } else {
            console.loge(status);
        }
    });

    function renderData(tags) {
        var content = $('.mdl-dialog__content');
        content.empty();
        if (tags.length > 0) {
            tags.forEach(function (tag) {
                content.append('<span class= "mdl-chip mdl-chip--deletable mr-4"><span class="mdl-chip__text">' + tag + '</span><button type="button" class="mdl-chip__action ev-remove-tag"><i class="material-icons">cancel</i></button></span>');
            });
            updateTagBtn(profile_id);
        } else {
            content.html('<p>Nenhuma TAG encontrada.</p>');
        }
    }
}
//adiciona o listener aos botões de excluir tag
function updateTagBtn(profile_id) {
    var route = 'curriculum/' + profile_id + '/tag/delete'; //monta a rota da requisição
    document.querySelectorAll('.ev-remove-tag').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var value = btn.previousSibling.innerHTML;
            animate(btn.parentNode);
            $.post(route, { tag: value }, function (data, status, xhr) {
                if (status === 'success') {
                    populateDialog(dialogProfile);
                } else {
                    console.log(xhr);
                }
            });
        });
    });
}

//initialize rating selects
$('.rating').each(function (index, el) {
    var $El = $(el);
    var profile_id = $El.attr('data-profile-id');
    var route = '/curriculum/' + profile_id + '/rating';

    $El.barrating({
        theme: 'fontawesome-stars',
        initialRating: $El.attr('data-current-rating'),
        showSelectedRating: false,
        allowEmpty: true,
        onSelect: function onSelect(value, text, event) {
            if (typeof event !== 'undefined') {
                // rating was selected by a user
                if (!value) value = 0;

                $.post(route, { star: value }, function (data, status, xhr) {
                    if (status === "success") {
                        populateDialog(profile_id);
                    } else {
                        console.log(xhr);
                    }
                });
            } else {
                // rating was selected programmatically
                // by calling `set` method
            }
        }
    });
});

//anima o elemento com um fade-out
function animate(element) {
    element.classList.add('removed-item');
    setTimeout(function () {
        element.remove();
    }, 450);
}

function showSpinner() {
    $('.mdl-dialog__content').html('<div class="flex center"><div class="mdl-spinner mdl-js-spinner mdl-spinner--single-color is-active"></div></div>'); //mostra o loading
    componentHandler.upgradeElement($('.mdl-js-spinner')[0]); // atualiza o elemento para que o loading funcione
}

//to make required fields not red
$(window).on('load', function () {
    $('input[data-required=true]').attr("required", "");
});

// $(".mdl-layout__drawer-button").html('<i class="fa fa-bars" aria-hidden="true"></i>');
$(document).ready(function () {
    //to replace mdl-drawer sandwiche icon
    $(".mdl-layout__drawer-button").html('<i class="fa fa-bars" aria-hidden="true"></i>');
});

/***/ }),

/***/ 3:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__("./resources/assets/js/list.js");


/***/ })

/******/ });