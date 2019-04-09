(function() {
	'use strict';
	var dialogButton = document.querySelectorAll('.dialog-button');
	var dialog = document.querySelector('#dialog');
	if (! dialog.showModal) {
		dialogPolyfill.registerDialog(dialog);
	}
	for(var i = 0; i < dialogButton.length; i++){
		dialogButton[i].addEventListener('click', function(ev) {
			document.querySelector('#dialog [name=id]').value = ev.currentTarget.getAttribute('data');
			dialog.showModal();
	 });
	}
	dialog.querySelector('.bnt-cancel')
	.addEventListener('click', function() {
		dialog.close();
	});
}());