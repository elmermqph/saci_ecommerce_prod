(function ($) {

Drupal.behaviors.initModalFormsPassword = {
  attach: function (context, settings) {
    $("a[href*='/user/password'], a[href*='?q=user/password']", context).once('init-modal-forms-password', function () {
      this.href = this.href.replace(/user\/password/,'modal_forms/nojs/password');
    }).addClass('ctools-use-modal ctools-modal-modal-popup-small');
	
	$('#edit-name--2').keydown(function(event){
			if((event.keyCode == 50 && event.shiftKey === true) || event.keyCode == 8){
				return;
			}
			else{
				if(	(event.keyCode == 48 && event.shiftKey === true) || 
					(event.keyCode == 49 && event.shiftKey === true) || 
					((event.keyCode >= 51 && event.shiftKey === true && (event.keyCode <= 57 && event.shiftKey === true))) ||
					(event.keyCode == 107) || 
					(event.keyCode == 107 && event.shiftKey === true) || 
					(event.keyCode == 192 && event.shiftKey === true) ||
					(event.keyCode == 192) || 
					event.keyCode == 188 || 
					event.keyCode == 109 || 
					event.keyCode == 59 || 
					event.keyCode == 220 || 
					event.keyCode == 191 || 
					(event.keyCode == 190 && event.shiftKey === true) || 
					event.keyCode == 222 ||
					event.which == 221 ||
					event.which == 187 ||
					event.which == 219 || 
					event.which == 221 ||
					event.which == 186 ||
					event.which == 106 ||
					event.which == 111
				){
					event.preventDefault();
				}
			}
		});
  }
};

})(jQuery);
