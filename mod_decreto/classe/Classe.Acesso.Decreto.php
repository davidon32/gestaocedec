<?php

class AcessoDecreto {

	#@ filtro de acesso ao menu principal do site
	function acessoMenu($_login) {

		$dados =array();
		try {
			
			$con = conexao::getInstance();
			
			$sql ='SELECT login,
		              nivel,
		              cad_decreto,
		              relatorio,
		              rel_resumo
		              FROM dec_permissao where login = :login';
			
			
			
			$result = $con->prepare($sql);
			 
			$result->bindValue(":login", $_login);
			
			$result->execute();
			
			while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
				
				$dados[] = $linha; 
			}
			
			//var_dump($dados);
			#@ decreto
			if($dados[0]['cad_decreto'] == 1){
			
				print 	"<li class=\"dropdown\">
						<a class=\"dropdown-toggle\" data-toggle=\"\" href=\"index.php?modulo=decreto&secao=decreto&acao=processodec\" title=\"Processo de Decretação\">Decreto</a>
							<ul class=\"dropdown-menu\">
								<!--<li><a href=\"index.php?modulo=decreto&secao=decreto&acao=processodec\" title=\"Novo Processo\">&nbsp;&nbsp;Novo</a></li>
								<li><a href=\"index.php?modulo=decreto&secao=decreto&acao=buscaAlterar\" title=\"Consulta Processo\">&nbsp;&nbsp;Consulta Alteração</a></li>-->
							</ul>
					</li>";
			
			}
			
			
			#@ decreto
			if($dados[0]['relatorio'] == 1){
			
				print   "<li class=\"dropdown-submenu\">
                        <a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\" title=\"Relatóros\">Relatório</a>";
			
				if($linha['rel_resumo'] == 1) {
					print "<ul class=\"dropdown-menu\">
                                <li><a href=\"secao.php?secao=decreto&acao=resumo\" title=\"Resumo de Processos\">Resumo de Processos</a></li>
                            </ul>";
				}
				print "</li>";
			
			}
			
			print "</ul></li>";
			
		}catch (Exception $e){
    	    
    	    return $e->getMessage()."";
    	}
		

		
	}

	
}?>