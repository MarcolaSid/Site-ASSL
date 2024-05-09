<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script>!window.jQuery && document.write('<script src="js/jquery-1.7.1.min.js"><\/script>')</script>
<script type="text/javascript" src="js/modernizr.js"></script>

<script type="text/javascript" src="//maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="js/gmap3.min.js"></script>
<script>

    (function($){
        $(document).ready(function(){

        $('#googlemap').gmap3(

          {
            action: 'addMarker',
            address: "Av. Marechal Rondon, 3582 Gravatai Brasil",
            map:{
              center: true,
              zoom: 16
            },
          },

          {action: 'setOptions', args:[{scrollwheel:true}]}
        );
        });
    })(jQuery);

    (function($){
        $(document).ready(function(){

        $('#googlemapfooter').gmap3(

          {
            action: 'addMarker',
            address: "Av. Marechal Rondon, 3582 Gravatai Brasil",
            map:{
              center: true,
              zoom: 16
            },
          },

          {action: 'setOptions', args:[{scrollwheel:true}]}
        );
        });
    })(jQuery);

</script>

<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="js/ddsmoothmenu.js"></script>
<script type="text/javascript" src="js/slides.jquery.js"></script>
<script type="text/javascript" src="js/jquery.prettyPhoto.js"></script>
<script type="text/javascript" src="js/scrolltopcontrol.js"></script>
<script type="text/javascript" src="js/jquery.isotope.min.js"></script>
<script type="text/javascript" src="js/contact-form-validate.js"></script>
<script type="text/javascript" src="js/jquery.coda-slider-2.0.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<script type="text/javascript" src="js/twitter.js"></script>

<?php include ("google-analytics.php");?>
