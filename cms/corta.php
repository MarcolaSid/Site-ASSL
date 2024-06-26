<html>
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8">
		<title>Recorte da imagem</title>
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/jquery.Jcrop.js"></script>
		<link rel="stylesheet" href="css/crop.css" type="text/css" />
		<link rel="stylesheet" href="css/jquery.Jcrop.css" type="text/css" />
	</head>
	<body>
		<?php
		
			// memory limit (nem todo server aceita)
			ini_set("memory_limit","50M");
			set_time_limit(0);
			
			// processa arquivo
			$imagem		= isset( $_FILES['imagem'] ) ? $_FILES['imagem'] : NULL;
			$tem_crop	= false;
			$img		= '';
			if( $imagem['tmp_name'] )
			{
				$imagesize = getimagesize( $imagem['tmp_name'] );
				if( $imagesize !== false )
				{
					if( move_uploaded_file( $imagem['tmp_name'], $imagem['name'] ) )
					{
						include( 'm2brimagem.class.php' );
						$oImg = new m2brimagem( $imagem['name'] );
						if( $oImg->valida() == 'OK' )
						{
							$oImg->redimensiona( '400', '', '' );
							$oImg->grava( $imagem['name'] );
							
							$imagesize 	= getimagesize( $imagem['name'] );
							$img		= '<img src="'.$imagem['name'].'" id="jcrop" '.$imagesize[3].' />';
							$preview	= '<img src="'.$imagem['name'].'" id="preview" '.$imagesize[3].' />';
							$tem_crop 	= true;	
						}
					}
				}
			}
		?>
		
		<?php if( $tem_crop === true ): ?>

			<div id="div-jcrop">

				<form class="dimensoes">
				<p><strong>X (Horizontal)</strong><br /> <input type="text" id="x" size="5" disabled /> x <input type="text" id="x2" size="5" disabled /> </p>
				<p><strong>Y (Vertical)</strong><br /> <input type="text" id="y" size="5" disabled /> x <input type="text" id="y2" size="5" disabled /> </p>
				<p><strong>Dimensões</strong><br /> <input type="text" id="h" size="5" disabled /> x <input type="text" id="w" size="5" disabled /></p>
				</form>
				
				<div id="div-preview">
					<?php echo $preview; ?>
				</div>
				
				<?php echo $img; ?>
				
				<input type="button" value="Salvar" id="btn-crop" />




			</div>


			<script type="text/javascript">
				var img = '<?php echo $imagem['name']; ?>';
			
				$(function(){
					$('#jcrop').Jcrop({
						onChange: exibePreview,
						onSelect: exibePreview,
						aspectRatio: 1
					});
					$('#btn-crop').click(function(){
						$.post( 'crop.php', {
							img:img, 
							x: $('#x').val(), 
							y: $('#y').val(), 
							w: $('#w').val(), 
							h: $('#h').val()
						}, function(){
							$('#div-jcrop').html( '<img src="' + img + '?' + Math.random() + '" width="'+$('#w').val()+'" height="'+$('#h').val()+'" />' );
							$('#debug').hide();
							$('#tit-jcrop').html('Feito!<br /><a href="corta.php">enviar outra imagem</a>');
						});
						return false;
					});
				});
				
				function exibePreview(c)
				{
					var rx = 100 / c.w;
					var ry = 100 / c.h;
				
					$('#preview').css({
						width: Math.round(rx * <?php echo $imagesize[0]; ?>) + 'px',
						height: Math.round(ry * <?php echo $imagesize[1]; ?>) + 'px',
						marginLeft: '-' + Math.round(rx * c.x) + 'px',
						marginTop: '-' + Math.round(ry * c.y) + 'px'
					});
					
					$('#x').val(c.x);
					$('#y').val(c.y);
					$('#x2').val(c.x2);
					$('#y2').val(c.y2);
					$('#w').val(c.w);
					$('#h').val(c.h);
					
				}
			</script>
		<?php else: ?>
			<form class="enviar" name="frm-jcrop" id="frm-jcrop" method="post" action="corta.php" enctype="multipart/form-data">
				<p>
					<label>Envie uma imagem:</label>
					<input type="file" name="imagem" id="imagem" />
					<input type="submit" value="Enviar" />
				</p>
			</form>
		<?php endif; ?>
		
	</body>
</html>
