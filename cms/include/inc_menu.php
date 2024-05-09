<?php
//alterar para cada projeto
include 'include/parametros.php';
?>
<h1 id="sidebar-title"><a href="./index.html#"><?=$pr['SITE_NOME'];?></a></h1>
<a href="./index.php"><img src="./img/logo.png" alt="<?=$pr['SITE_NOME'];?>" name="logo" id="logo"></a>

<!-- Perfil e barra lateral -->
<div id="profile-links">
	<?php include 'include/saudacao.php';?> <a href="index.php" title="Editar seu perfil"><?=$LoginUsuario;?></a><br>
	<?php include 'include/data.php';?>
	<br>
	<a href="<?=$pr['URL_SITE'];?>" title="Visualizar o website" target="_blank">Visualizar o website</a> | 
	<a href="./sair.php" title="Sair do CMS">Sair</a>
</div>

<?php $paginaAtual = basename($_SERVER['SCRIPT_NAME']); ?>

<ul id="main-nav">  
	<!-- Accordion Menu -->			
			<li>
				<a href="./" class="nav-top-item current no-submenu" style="padding-right: 15px; ">In&iacute;cio</a>       
			</li>
			
			<li> 
				<a href="./empresa.php" <?php if($paginaAtual == 'empresa.php' || $paginaAtual == 'slides.php' || $paginaAtual == 'slidesInserir.php' || $paginaAtual == 'slidesEditar.php' || $paginaAtual == 'empresaEditar.php') {echo 'class="nav-top-item current current"';} ?> class="nav-top-item">Website</a>
				<ul style="display: none; ">			
					<li><a href="./empresa.php" <?php if($paginaAtual == 'empresa.php' || $paginaAtual == 'empresaEditar.php') {echo 'class="current"';} ?>>Empresa</a></li>
					<li><a href="./slides.php" <?php if($paginaAtual == 'slides.php' || $paginaAtual == 'slidesEditar.php' || $paginaAtual == 'slidesEditar.php?id=1') {echo 'class="nav-top-item current current"';} ?>>Slides</a></li>
					<li><a href="./slidesInserir.php" <?php if($paginaAtual == 'slidesInserir.php') {echo 'class="nav-top-item current current"';} ?>>Inserir Slide</a></li>					
				</ul>
			</li>

			<li>
				<a href="./projetosVisualizar.php?pagina=1" <?php if($paginaAtual == 'projetosInserir.php' || $paginaAtual == 'projetosVisualizar.php' || $paginaAtual == 'projetosEditar.php') {echo 'class="nav-top-item current current"';} ?> class="nav-top-item">Projetos</a>
				<ul style="display: none; ">
					<li><a href="./projetosInserir.php" <?php if($paginaAtual == 'projetosInserir.php') {echo 'class="nav-top-item current current"';} ?>>Inserir</a></li>
					<li><a href="./projetosVisualizar.php?pagina=1" <?php if($paginaAtual == 'projetosVisualizar.php') {echo 'class="nav-top-item current"';} ?>>Visualizar</a></li>
				</ul>
			</li>

			<li>
				<a href="./servicosVisualizar.php?pagina=1" <?php if($paginaAtual == 'servicosInserir.php' || $paginaAtual == 'servicosVisualizar.php' || $paginaAtual == 'servicosEditar.php') {echo 'class="nav-top-item current current"';} ?> class="nav-top-item">Serviços</a>
				<ul style="display: none; ">
					<li><a href="./servicosInserir.php" <?php if($paginaAtual == 'servicosInserir.php') {echo 'class="nav-top-item current current"';} ?>>Inserir</a></li>
					<li><a href="./servicosVisualizar.php?pagina=1" <?php if($paginaAtual == 'servicosVisualizar.php') {echo 'class="nav-top-item current"';} ?>>Visualizar</a></li>
				</ul>
			</li>

			<li>
				<a href="./categorias.php?pagina=1" <?php if($paginaAtual == 'categorias.php' || $paginaAtual == 'subcategorias.php' || $paginaAtual == 'categorias.php?pagina=1' || $paginaAtual == 'subcategorias.php?pagina=1') {echo 'class="nav-top-item current current"';} ?> class="nav-top-item">Categorias</a>
				<ul style="display: none; ">
					<li><a href="./categorias.php?pagina=1" <?php if($paginaAtual == 'categorias.php' || $paginaAtual == 'categorias.php?pagina=1') {echo 'class="current"';} ?>>Categorias</a></li>
					<li><a href="./subcategorias.php?pagina=1" <?php if($paginaAtual == 'subcategorias.php' || $paginaAtual == 'subcategorias.php?pagina=1') {echo 'class="current"';} ?>>Subcategorias</a></li>					
				</ul>
			</li>

			<li>
				<a href="./usuariosE.php" <?php if($paginaAtual == 'usuariosE.php' || $paginaAtual == 'usuariosI.php') {echo 'class="nav-top-item current current"';} ?> class="nav-top-item">Usu&aacute;rios</a>
				<ul style="display: none; ">
					<li><a href="./usuariosI.php" <?php if($paginaAtual == 'usuariosI.php') {echo 'class="current"';} ?>>Inserir</a></li>				
					<li><a href="./usuariosE.php" <?php if($paginaAtual == 'usuariosE.php'  || $paginaAtual == 'usuariosEditar.php') {echo 'class="current"';} ?>>Visualizar e Editar</a></li>
				</ul>
			</li>

</ul> <!-- End #main-nav -->

<div id="footer"><small>&copy; Copyright 1996 - <?php echo date('Y'); ?> Agência Organize</small></div> <!-- End #footer -->
