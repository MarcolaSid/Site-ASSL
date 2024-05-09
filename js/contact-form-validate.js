
/* Contact Page Comment Validation */
(function($){
	jQuery(document).ready(function($){
		$('form#contact-form').submit(function() {
			$('form#contact-form .contact-error').remove();
			var hasError = false;
			$('form#contact-form .requiredField').each(function() {
				if(jQuery.trim($(this).val()) == '') {
	            	var labelText = $(this).prev('label').text();
	            	$(this).parent().append('<span class="contact-error">Obrigatório</span>');
	            	$(this).addClass('inputError');
	            	hasError = true;
	            } else if($(this).hasClass('email')) {
	            	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	            	if(!emailReg.test(jQuery.trim($(this).val()))) {
	            		var labelText = $(this).prev('label').text();
	            		$(this).parent().append('<span class="contact-error">Inválido</span>');
	            		$(this).addClass('inputError');
	            		hasError = true;
	            	}
	            }
			});
			if(!hasError) {
				var formInput = $(this).serialize();
				$.post($(this).attr('action'),formInput, function(data){
					$("form#contact-form").before('<div class="contact-success"><strong>Obrigado!</strong><p>Sua mensagem foi enviada com sucesso. Entraremos em contato o mais rapidamente possível.</p></div>');
					
					$('form#contact-form').fadeOut('slow', function() {
	    			// Animation complete.	
					});			
				});
			}


			return false;

		});
	});
})(jQuery);


/* Post Page Comment Validation */
(function($){
	jQuery(document).ready(function($){
		$('form#comment-form').submit(function() {
			$('form#comment-form .contact-error').remove();
			var hasError = false;
			$('form#comment-form .requiredField').each(function() {
				if(jQuery.trim($(this).val()) == '') {
	            	var labelText = $(this).prev('label').text();
	            	$(this).parent().append('<span class="contact-error">Obrigatório</span>');
	            	$(this).addClass('inputError');
	            	hasError = true;
	            } else if($(this).hasClass('email')) {
	            	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	            	if(!emailReg.test(jQuery.trim($(this).val()))) {
	            		var labelText = $(this).prev('label').text();
	            		$(this).parent().append('<span class="contact-error">Inválido</span>');
	            		$(this).addClass('inputError');
	            		hasError = true;
	            	}
	            }
			});
			if(!hasError) {
				var formInput = $(this).serialize();
				$.post($(this).attr('action'),formInput, function(data){
					$("form#comment-form").before('<div class="contact-success"><strong>Obrigado!</strong><p>Seu comentário foi enviado com sucesso.</p></div>');
					
					$('form#comment-form').fadeOut('slow', function() {
	    			// Animation complete.	
					});			
				});
			}


			return false;

		});
	});
})(jQuery);