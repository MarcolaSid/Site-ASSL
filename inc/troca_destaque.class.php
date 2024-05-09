<?php
class TrocaDestaque{
	private $datadestaque = array();	
	public function __construct($rowdestaque) {
		$this->datadestaque = $rowdestaque;
}	
	public function html() {
		
		// Esse metodo retorna o codigo para os destaques dos projetos em HTML
		
		$d = &$this->datadestaque;
		$d['descricao'] = htmlspecialchars($d['descricao']);
		
		$id_projeto = $d['id_projeto'];
				
		return '
        	<div class="hover">
                <a href="images/projetos/'.$d['path'].'" data-rel="prettyPhoto" title="'.$d['nome'].'" >
                    <span class="zoom"></span>
                    <img src="images/projetos/'.$d['path'].'" width="275" height="183" alt="'.$d['nome'].'" />
                </a>
            </div>                         
			';
	}
}
?>