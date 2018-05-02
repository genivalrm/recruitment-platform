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
document.querySelectorAll('.ev-archive')
    .forEach(function (btn) {
        btn.addEventListener('click', function () {
            animate(this.parentNode.parentNode.parentNode);
        });
    });

//dialog open button
document.querySelectorAll('.ev-open-dialog')
    .forEach(function (btn) {
        btn.addEventListener('click', function () {
            let content = $('.mdl-dialog__content'); //seleciona a div de conteudo do modal

            let modalTitle = this.parentNode.parentNode.childNodes[1].childNodes[1].innerHTML + ' - TAGS'; //pega o nome do curriculo
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

    let value = $(this).find('input[name="new-tag"]').val();
    let route = 'curriculum/' + dialogProfile + '/tag' //monta a rota da requisição

    $.post(route, { tag: value }, function (data, status, xhr) {
        if (status === 'success') {
            $('.ev-submit-tag').find('input[name="new-tag"]').val('');
            populateDialog(dialogProfile);
        }
        else {
            console.log(xhr);
        }
    });
});

//==========================================================================
// FUNÇÕES AUXILIARES
//==========================================================================
//recupera as tags do perfil e coloca no dialog
function populateDialog(profile_id) {
    let route = 'curriculum/' + profile_id + '/tag' //monta a rota da requisição

    $.get(route, function (data, status) {  //requisita as tags do curriculo
        if (status === 'success') {
            renderData(data.tag)
        }
        else {
            console.loge(status);
        }
    });

    function renderData(tags) {
        let content = $('.mdl-dialog__content');
        content.empty();
        if (tags.length > 0) {
            tags.forEach(function (tag) {
                content.append('<span class= "mdl-chip mdl-chip--deletable mr-4"><span class="mdl-chip__text">' + tag + '</span><button type="button" class="mdl-chip__action ev-remove-tag"><i class="material-icons">cancel</i></button></span>');
            });
            updateTagBtn(profile_id);
        }
        else {
            content.html('<p>Nenhuma TAG encontrada.</p>');
        }
    }
}
//adiciona o listener aos botões de excluir tag
function updateTagBtn(profile_id) {
    let route = 'curriculum/' + profile_id + '/tag/delete' //monta a rota da requisição
    document.querySelectorAll('.ev-remove-tag')
        .forEach(function (btn) {
            btn.addEventListener('click', function () {
                let value = btn.previousSibling.innerHTML;
                animate(btn.parentNode);
                $.post(route, { tag: value }, function (data, status, xhr) {
                    if (status === 'success') {
                        populateDialog(dialogProfile);
                    }
                    else {
                        console.log(xhr);
                    }
                });
            });
        });
}

//initialize rating selects
$('.rating').each(function (index, el) {
    let $El = $(el);
    let profile_id = $El.attr('data-profile-id');
    let route = '/curriculum/' + profile_id + '/rating';

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

                $.post(route, { star: value }, function (data, status, xhr) {
                    if (status === "success") {
                        populateDialog(profile_id);
                    }
                    else {
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

function showSpinner(){
    $('.mdl-dialog__content').html('<div class="flex center"><div class="mdl-spinner mdl-js-spinner mdl-spinner--single-color is-active"></div></div>'); //mostra o loading
    componentHandler.upgradeElement($('.mdl-js-spinner')[0]); // atualiza o elemento para que o loading funcione
}

//to make required fields not red
$(window).on('load', function () {
    $('input[data-required=true]').attr("required", "");
});

$(".mdl-layout__drawer-button").html('<i class="fa fa-bars" aria-hidden="true"></i>');
$(document).ready(function () {
    //to replace mdl-drawer sandwiche icon
    $(".mdl-layout__drawer-button").html('<i class="fa fa-bars" aria-hidden="true"></i>');
});
