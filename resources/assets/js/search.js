$("[name='search']").keyup( function() {
	var value = $(this).val().toLowerCase().split(" ");
    $(".ev-search-card").each(function(i, card) {
    	var texto = '';
    	var cont = 0;
    	$(card).find(".ev-search-text").each(function(){
    		texto += ' ' + $(this).text().toLowerCase();
    	});
    	value.forEach(function (item) {
    		if (item != '' && (texto.indexOf(item)) != -1) {
    			cont++;
    		}
		});
		if (cont == value.length || value == '') {
			$(card).show();
		}else{
			$(card).hide();
		}
    });
});