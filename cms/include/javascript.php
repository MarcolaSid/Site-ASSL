<!-- Javascripts -->
<!-- jQuery -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script>!window.jQuery && document.write('<script src="assets/js/jquery-1.7.1.min.js"><\/script>')</script>

<script src="js/upload.js"></script>

<!-- input file -->
<script type="text/javascript" src="js/si.files.js"></script>
<script type="text/javascript" language="javascript">
// <![CDATA[

SI.Files.stylizeAll();

/*
--------------------------------
Known to work in:
--------------------------------
- IE 5.5+
- Firefox 1.5+
- Safari 2+
                          
--------------------------------
Known to degrade gracefully in:
--------------------------------
- Opera
- IE 5.01

--------------------------------
Optional configuration:

Change before making method calls.
--------------------------------
SI.Files.htmlClass = 'SI-FILES-STYLIZED';
SI.Files.fileClass = 'file';
SI.Files.wrapClass = 'cabinet';

--------------------------------
Alternate methods:
--------------------------------
SI.Files.stylizeById('input-id');
SI.Files.stylize(HTMLInputNode);

--------------------------------
*/
// ]]>
</script>

<!-- Custom jquery scripts -->
<script src="js/jquery/custom_jquery.js" type="text/javascript"></script>
 
<!-- Tooltips -->
<script src="js/jquery/jquery.tooltip.js" type="text/javascript"></script>
<script src="js/jquery/jquery.dimensions.js" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
	$('a.info-tooltip ').tooltip({
		track: true,
		delay: 0,
		fixPNG: true, 
		showURL: false,
		showBody: " - ",
		top: -35,
		left: 5
	});
});
</script> 

<!-- Configuracao para o jQuery -->
<script type="text/javascript" src="./js/jquery.configuration.js"></script>
<!-- jQuery Facebox Plugin -->
<script type="text/javascript" src="./js/facebox.js"></script>
<!-- jQuery WYSIWYG plugin -->
<script type="text/javascript" src="./js/jquery.wysiwyg.js"></script>
<!-- Fancybox -->
<script type="text/javascript" src="./js/jquery.fancybox-1.3.1.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$("a#fancyimg").fancybox({
				'titleShow'		: false
			});
		});
</script>

<!-- MUST BE THE LAST SCRIPT IN <HEAD></HEAD></HEAD> png fix -->
<script src="js/jquery/jquery.pngFix.pack.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
$(document).pngFix( );
});
</script>

<!-- Internet Explorer .png-fix -->
<!--[if IE 6]>
	<script type="text/javascript" src="./js/DD_belatedpNG_0.0.7a.js"></script>
	<script type="text/javascript">
		DD_belatedpNG.fix('.png_bg, img, li');
	</script>
<![endif]-->

<!-- Contador de Caracteres -->
<script>
function wordcounter(this_field) {
	show_word_count = true;
	show_char_count = true;
	var char_count = this_field.value.length;
	var fullStr = this_field.value + " ";
	var initial_whitespace_rExp = /^[^A-Za-z0-9]+/gi;
	var left_trimmedStr = fullStr.replace(initial_whitespace_rExp, "");
	var non_alphanumerics_rExp = rExp = /[^A-Za-z0-9']+/gi;
	var cleanedStr = left_trimmedStr.replace(non_alphanumerics_rExp, " ");
	var splitString = cleanedStr.split(" ");
	var word_count = splitString.length -1;
	if (fullStr.length <2) {
	word_count = 0;
	}
	if (word_count == 1) {
	wordOrWords = " palavra";
	}
	else {
	wordOrWords = " palavras";
	}
	if (char_count == 1) {
	charOrChars = " caracter";
	} else {
	charOrChars = " caracteres";
	}
document.getElementById('counted').innerHTML = "    " + word_count + wordOrWords + "\n" + "    " + char_count + charOrChars;
}
</script>