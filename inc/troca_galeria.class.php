<?php
class TrocaGaleria{
	private $datagaleria = array();	
	public function __construct($rowgaleria) {
		$this->datagaleria = $rowgaleria;
}	
	public function html() {
		
		// Esse metodo retorna o codigo para os itens da galeria
		
		$d = &$this->datagaleria;
		$d['nome'] = htmlspecialchars($d['nome']);
		
		$id_galeria = $d['id'];
				
		return '
			<a href="./images/projetos/'.$d['imagem'].'" data-gal="prettyPhoto[pp_gallery2]">
				<img src="thumb.php?img=images/projetos/'.$d['imagem'].'&amp;w=100" width="100" height="66" alt="'.utf8_encode($d['nome']).'" title="'.utf8_encode($d['nome']).'" >
			</a>			';
	}
}
?>