var dialog = document.querySelector('dialog');

document.querySelectorAll('.ev-open-dialog')
    .forEach(function (btn) {
        btn.addEventListener('click', function () {
            // dialogPolyfill.registerDialog(dialog);
            // Now dialog acts like a native <dialog>.
            dialog.showModal();
            let modalTitle = this.parentNode.parentNode.childNodes[1].childNodes[1].innerHTML + ' - TAGS';
            document.querySelector('.mdl-dialog__title').innerHTML = modalTitle;
        });
    });


dialog.querySelector('.close').addEventListener('click', function () {
    dialog.close();
});


document.querySelectorAll('.ev-archive')
    .forEach(function (btn) {
        btn.addEventListener('click', function () {
            var parent = this.parentNode.parentNode.parentNode;
            parent.classList.add('removed-item');
            setTimeout(function(){ 
                parent.remove();
            }, 450);
        });
    });

$('.rating').barrating({
    theme: 'fontawesome-stars',
    showSelectedRating: false,
    onSelect: function(value, text, event) {
        if (typeof(event) !== 'undefined') {
          // rating was selected by a user
          console.log(event.target);
        } else {
          // rating was selected programmatically
          // by calling `set` method
        }
      }
  });

  $( document ).ready(function() {
    $(".mdl-layout__drawer-button").html('<i class="fa fa-bars" aria-hidden="true"></i>');
  });