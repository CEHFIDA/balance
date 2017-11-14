$(document).ready(function() {
	$(document).on('click', '.loaded_balance', function(e){
		e.preventDefault();
		var _this = $(this);
		$(this).html('загрузка...');
		$.get(routeLoadedBalance+'/'+_this.data('id'), function(data){
			_this.parent().html(data);
		},'html');		
	});

	$(document).on('click', '.show_all_balance', function(e){
		e.preventDefault();
		$('.loaded_balance').trigger('click');
		$(this).hide();
	});
});