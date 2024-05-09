/*-- Image Hover Function --*/

	(function($){
		jQuery.noConflict()(function($){
		jQuery(document).ready(function () {

			$('.hover').mouseenter(function(e) {
	
				$(this).children('a').not('.active').children('span').fadeIn(300);
			}).mouseleave(function(e) {
	
				$(this).children('a').not('.active').children('span').fadeOut(200);
			
			});
		});	
				
	})
	})(jQuery);

/*-- Slider and Testimonial --*/
	
	(function($){
		jQuery.noConflict()(function($){
		jQuery(document).ready(function () {
			
		$('#slides').slides({
			preload: false,
			preloadImage: 'images/loading.gif',
			effect: 'slide',
			slideSpeed: 700,
			preload: false,
			play: 5000,
			pause: 1000,
			hoverPause: true,
		});	
		
			$('.testimonial-wrapper').slides({
			effect: 'fade',
			fadeSpeed: 700,
			play: 6000,
			pause: 1000,
			hoverPause: true,
			generateNextPrev: false,
			generatePagination: false,
			pagination: false,
			autoHeight: true,
		});	
				
		});
		
	})
    })(jQuery);	

/*-- Twitter Function --*/

    (function($){
		jQuery.noConflict()(function($){
			jQuery(document).ready(function () {
				// start jqtweet!
				JQTWEET.loadTweets();
			});
			
	})
	})(jQuery);
	
/*-- Tabs (Coda-Slider 2.0) Function--*/

    (function($){    	
    	$(document).ready(function() {
        	$('#tab1').codaSlider();
        	$('#tab2').codaSlider();
    	});
	})(jQuery);

/*-- prettyPhoto Function--*/

    (function($){
      
      	$(document).ready(function(){
        	$("a[rel^='prettyPhoto']").prettyPhoto();
      	});

        $('a[data-rel]').each(function() {
            $(this).attr('rel', $(this).data('rel'));
        });

        /*-- hack so both rel and data-rel tags work for to ensure HTML5 --*/
    	(function($){
        	$("a[data-rel^='prettyPhoto']").prettyPhoto({hook: 'data-rel'    	
    	});
     
 	});
    })(jQuery);



/*-- Isotope Function--*/
	(function($){
      
      var $container = $('#folio-container');
      
      $container.isotope({
        itemSelector : '.element',
        masonry : {
          columnWidth : 120,
        },
 
      });	
	  
	  
	var $optionSets = $('#options .option-set'),
          $optionLinks = $optionSets.find('a');

      $optionLinks.click(function(){
        var $this = $(this);
        // don't proceed if already selected
        if ( $this.hasClass('selected') ) {
          return false;
        }
        var $optionSet = $this.parents('.option-set');
        $optionSet.find('.selected').removeClass('selected');
        $this.addClass('selected');
  
        // make option object dynamically, i.e. { filter: '.my-filter-class' }
        var options = {},
            key = $optionSet.attr('data-option-key'),
            value = $this.attr('data-option-value');
        // parse 'false' as false boolean
        value = value === 'false' ? false : value;
        options[ key ] = value;
        if ( key === 'layoutMode' && typeof changeLayoutMode === 'function' ) {
          // changes in layout modes need extra logic
          changeLayoutMode( $this, options )
        } else {
          // otherwise, apply new options
          $container.isotope( options );
        }
        
        return false;
      });
	    
	})(jQuery);



/*-- DEMO --*/

    (function($){   
        $('a.switch_color').click(function() {
            var stylesheet = $(this).data('file');
            $('link#theme').attr('href', 'css/' + stylesheet + '.css');
        });
	})(jQuery);

    (function($){   
        $('a.switch_pattern').click(function() {
            var bg = $(this).data('file');
            $('div#pageheader-background, div#footer-wrapper').attr('style', 'background-image: url(images/topbackgrounds/' + bg + ');' );
        });
	})(jQuery);