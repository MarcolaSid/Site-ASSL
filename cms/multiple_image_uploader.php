<?php
/**
* Smart Image Uploader by @cafewebmaster.com
* Free for private use
* Please support us with donations or backlink
*/

$upload_image_limit = 10; // How many images you want to upload at once?
$upload_dir			= "/home/henrique/public_html/cms/"; // default script location, use relative or absolute path
$caminho = "../images/teste/";

################################# UPLOAD IMAGES
	
		foreach($_FILES as $k => $v){ 

			$img_type = "";

			### $htmo .= "$k => $v<hr />"; 	### print_r($_FILES);

			if( !$_FILES[$k]['error'] && preg_match("#^image/#i", $_FILES[$k]['type']) && $_FILES[$k]['size'] < 1000000){

				$img_type = ($_FILES[$k]['type'] == "image/jpeg") ? ".jpg" : $img_type ;
				$img_type = ($_FILES[$k]['type'] == "image/gif") ? ".gif" : $img_type ;
				$img_type = ($_FILES[$k]['type'] == "image/png") ? ".png" : $img_type ;

				$img_rname = $_FILES[$k]['name'];
				$img_path = $upload_dir.$img_rname;

				copy( $_FILES[$k]['tmp_name'], $img_path ); 
				$feedback .= "Image and thumbnail created $img_rname<br />";

			}
		}
############################### HTML FORM
	while($i++ < $upload_image_limit){
		$form_img .= '<label>Imagem '.$i.': </label> <input type="file" name="uplimg'.$i.'"><br />';
	}

	$htmo .= '
		<p>'.$feedback.'</p>
		<form method="post" enctype="multipart/form-data">
			'.$form_img.' <br />
			<input type="submit" value="Upload das Imagens!" style="margin-left: 50px;" />
		</form>
		';	

	echo $htmo;
?>