<?php 

	Class Voltar {
		
		
		function Volt($voltar) {
			

				switch ($voltar) {
					case 0:
					    #@ voltar cadastro de motorista
						$volta = '../secao.php?secao=motorista&acao=cadastro';
						break;
					case 1:
					    #@ volvar cadastro caminhao
						$volta = '../secao.php?secao=caminhao&acao=cadastro';
						break;
					case 2:
					    #@ voltar cadastro rota
						$volta = '../secao.php?secao=rota&acao=cadastro';
						break;
					case 3:
					    #@ voltar cadastro contrato
					    $volta = '../secao.php?secao=contrato&acao=cadastro';
					    break;
					case 4:
					    #@ voltar cadastro conta acerto
					    $volta = '../secao.php?secao=conta&acao=acerto';
					    break;
					default:
						;
					break;
				}
				
				return $volta;
				
		}



}?>