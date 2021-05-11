<?php

			
		# caminho da pasta classe
		define("CLASSE", "classe");
		
		define("RAIZ", $_SERVER['DOCUMENT_ROOT']);
		
		define("SITE", RAIZ.'proj.sgah/'); #
	
		
			$path = SITE.CLASSE;
				
			$abre = opendir($path);
			
			while ($nome_itens = readdir($abre))
				
				{
					 $itens[] = $nome_itens;
						 
				}
				
			for($i=0; $i< count($itens); $i++){
					
				if(($itens[$i] != ".") and($itens[$i] != "..")){
					
					include_once SITE.'classe/'.$itens[$i];
					
					
					
				}
					
			}
		
			


?>
