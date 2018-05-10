//dialog
var dialog = document.querySelector('dialog');
var dialog_profile = '';

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

//==========================================================================
// FUNÇÕES AUXILIARES
//==========================================================================
//adiciona o listener aos botões de excluir tag
function updateTagBtn(profile_id) {
    let route = '../curriculum/' + profile_id + '/tag/delete' //monta a rota da requisição
    document.querySelectorAll('.ev-remove-tag')
        .forEach(function (btn) {
            btn.addEventListener('click', function () {
                let value = btn.previousSibling.innerHTML;
                animate(btn.parentNode);
                $.post(route, { tag: value }, function (data, status, xhr) {
                    if (status === 'success') {
                        populateDialog(dialog_profile);
                    }
                    else {
                        console.log(xhr);
                    }
                });
            });
        });
}
//recupera as tags do perfil e coloca no dialog
function populateDialog(profile_id) {
    const route = '../curriculum/' + profile_id + '/tag' //monta a rota da requisição

    function renderData(tags) {
        const content = $('.mdl-dialog__content');
        let text = '';
        let searchText = $( 'div.ev-search-text[data-profile-id="' + profile_id + '"]' );
        
        content.empty();
        searchText.empty();

        if (tags.length > 0) {
            tags.forEach(function (tag) {
                content.append('<span class= "mdl-chip mdl-chip--deletable mr-4"><span class="mdl-chip__text">' + tag + '</span><button type="button" class="mdl-chip__action ev-remove-tag"><i class="material-icons">cancel</i></button></span>');
                text += `${tag} `;
            });
            searchText.text(text);
            updateTagBtn(profile_id);
        }
        else {
            content.html('<p>Nenhuma TAG encontrada.</p>');
        }
    }

    $.get(route, function (data, status) {  //requisita as tags do curriculo
        if (status === 'success') {
            renderData(data.tag);
        }
        else {
            console.log(status);
        }
    });
}

function ratingFilter(value) {
    let elements = [];
    $('select.rating').not('.ev-filter-rating').each(function (index, el) {
        if ($(el).attr('data-current-rating') < value) {
            elements.push($(el).parents('.mdl-cell'));
        }
    });

    $('.mdl-cell').show();

    verifyBondFilter();

    elements.forEach(function (element) {
        $(element).hide();
    });

}

function initializeRating() {
    //initialize rating selects
    $('.rating').each(function (index, el) {
        const $El = $(el);
        const profile_id = $El.attr('data-profile-id');
        let route = '../curriculum/' + profile_id + '/rating';

        $El.barrating({
            theme: 'fontawesome-stars',
            initialRating: $El.attr('data-current-rating'),
            showSelectedRating: false,
            allowEmpty: true,
            onSelect: function (value, text, event) {
                if (typeof (event) !== 'undefined') {
                    // rating was selected by a user
                    if (!value)
                        value = 0;

                    if ($El.hasClass('ev-filter-rating')) {
                        $El.attr('data-current-rating', value);
                        ratingFilter(value);
                    }
                    else {
                        $.post(route, { star: value }, function (data, status, xhr) {
                            if (status === 'success') {
                                console.log('rating updated: ' + value);
                                $El.attr('data-current-rating', value);
                            }
                            else {
                                console.log(xhr);
                            }
                        });
                    }
                } else {
                    // rating was selected programmatically
                    // by calling `set` method
                }
            }
        });
    });
}
//anima o elemento com um fade-out
function animate(element) {
    element.classList.add('removed-item');
    setTimeout(function () {
        element.remove();
    }, 450);
}

//mostra o spinner no dialog
function showSpinner() {
    $('.mdl-dialog__content').html('<div class="flex center"><div class="mdl-spinner mdl-js-spinner mdl-spinner--single-color is-active"></div></div>'); //mostra o loading
    componentHandler.upgradeElement($('.mdl-js-spinner')[0]); // atualiza o elemento para que o loading funcione
}

//atualiza o html da view e o rating widget
function renderSection(data, section) {
    const element = $(section);
    element.empty();
    element.append(data);
    initializeRating();
    verifyBondFilter();
}

//requisita para o back a view com os cards atuais
function cardSectionUpdater(type, section) {
    let route = '../curriculum?archived=true';

    if (type === 'notarchived') {
        route = '../curriculum?not_archived=true';
    }
    $.get(route, function (data, status) {  //requisita as tags do curriculo
        if (status === 'success') {
            renderSection(data, section);
        }
        else {
            console.log(status);
        }
    });
}

//realiza a requisição de mudança de estado
function curriculumStateChanger(route, nextState, section) {
    $.post(route, {}, function (data, status, xhr) {
        if (status === 'success') {
            console.log('State changed');
            cardSectionUpdater(nextState, section);
        }
        else {
            console.log(xhr);
        }
    });
}
function selectBondElements(bondClass) {
    const currentRating = $('.ev-filter-rating').attr('data-current-rating');
    console.log(currentRating);
    let elements = [];

    const el = $(bondClass);

    el.each(function () {

        if ($(this).parent()
            .siblings('div.rating-div').children('div.br-wrapper').children('select.rating').attr('data-current-rating') >= currentRating) {
            elements.push($(this));
        }

    });

    return elements;
}
//bond filters 
function updateBondFilter(type, state) {
    let elements = [];
    switch (type) {
        case 'contract':
            if (state) {
                elements = selectBondElements('.chip-contrato');
                elements.forEach(function (el) {
                    el.parents('.mdl-cell').show();
                });
            }
            else {
                elements = selectBondElements('.chip-contrato');
                elements.forEach(function (el) {
                    el.parents('.mdl-cell').hide();
                });
            }
            break;
        case 'internship':
            if (state) {
                elements = selectBondElements('.chip-estagio');
                elements.forEach(function (el) {
                    el.parents('.mdl-cell').show();
                });
            }
            else {
                elements = selectBondElements('.chip-estagio');
                elements.forEach(function (el) {
                    el.parents('.mdl-cell').hide();
                });
            }
            break;
    }
}
function verifyBondFilter(bondFilter) {
    if (bondFilter === 'contract') {
        if ($('.ev-contract-filter').prop('checked')) {
            updateBondFilter('contract', true);
        }
        else {
            updateBondFilter('contract', false);
        }
    }
    else if (bondFilter === 'internship') {
        if ($('.ev-internship-filter').prop('checked')) {
            updateBondFilter('internship', true);
        }
        else {
            updateBondFilter('internship', false);
        }
    }
    else {
        if ($('.ev-contract-filter').prop('checked')) {
            updateBondFilter('contract', true);
        }
        else {
            updateBondFilter('contract', false);
        }

        if ($('.ev-internship-filter').prop('checked')) {
            updateBondFilter('internship', true);
        }
        else {
            updateBondFilter('internship', false);
        }
    }
}
//=====================================================
// EVENTOS
//=====================================================
$(window).on('load', function () {
    //to make required fields not red
    $('input[data-required=true]').attr("required", "");

    //to replace mdl-drawer sandwiche icon
    $(".mdl-layout__drawer-button").html('<i class="material-icons color-white icon-responsive">filter_list</i>');

    //rating widget
    initializeRating();
});

//curriculum archiving
$(document).on('click', '.ev-archive', function () {
    animate(this.parentNode.parentNode.parentNode);

    const profile_id = $(this).attr('data-profile-id');
    const route = '../curriculum/' + profile_id + '/archive'

    curriculumStateChanger(route, 'archived', '.archived-section');
});

//curriculum restore
$(document).on('click', '.ev-restore', function () {

    animate(this.parentNode.parentNode.parentNode);

    const profile_id = $(this).attr('data-profile-id');
    const route = '../curriculum/' + profile_id + '/restore'

    curriculumStateChanger(route, 'notarchived', '.not-archived-section');
});

//dialog open button
$(document).on('click', '.ev-open-dialog', function (btn) {
    const content = $('.mdl-dialog__content'); //seleciona a div de conteudo do modal
    dialogPolyfill.registerDialog(dialog);

    const modalTitle = this.parentNode.parentNode.childNodes[1].childNodes[1].innerHTML + ' - TAGS'; //pega o nome do curriculo
    document.querySelector('.mdl-dialog__title').innerHTML = modalTitle; //coloca o nome capturado no modal

    showSpinner();

    dialog_profile = $(this).attr('data-profile-id'); //pega o id do btn

    populateDialog(dialog_profile);


    dialog.showModal();
});

//dialog close button
$(document).on('click', '.ev-close-dialog', function () {
    dialog.close();
});



//ação de enviar uma nova tag
$(document).on('submit', '.ev-submit-tag', function (event) {
    event.preventDefault();

    showSpinner();

    const value = $(this).find('input[name="new-tag"]').val();
    const route = '../curriculum/' + dialog_profile + '/tag' //monta a rota da requisição

    $.post(route, { tag: value }, function (data, status, xhr) {
        if (status === 'success') {
            $('.ev-submit-tag').find('input[name="new-tag"]').val('');
+            populateDialog(dialog_profile);
        }
        else {
            console.log(xhr);
        }
    });
});

$(document).on('click', '.ev-internship-filter', function () {
    verifyBondFilter('internship');
});

$(document).on('click', '.ev-contract-filter', function () {
    verifyBondFilter('contract');
});

$('.ev-reset-filter').on('click', function () {
    $('.mdl-cell').show();
    $('select.ev-filter-rating').barrating('clear');
    $('.ev-contract-filter').parents('.mdl-switch').addClass('is-checked');
    $('.ev-internship-filter').parents('.mdl-switch').addClass('is-checked');
});