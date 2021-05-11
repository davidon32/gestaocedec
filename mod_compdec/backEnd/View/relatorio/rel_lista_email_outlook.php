<?php
	
	# todos
	if($_POST['selEmail'] == 0){
		
		$dados = $_relatorioCompdec->relCompdec();

		$lista = "";
		foreach ($dados as $key=>$value){
			if(($value['email'] != "-") && ($value['email'] != " ") && (!empty($value['email']))){ 
				
				$email = str_replace("", " ", strtolower($value['email']));
						
				$remover = array(",", "/", "-");
				$lista .=  str_replace($remover, ";", $email).";";
			}
		}

		$array = explode(";", $lista);

		foreach($array as $email1){
			if(strpos($email1, "@")){
			$emailArray[] = $email1;
			}else {
				$emailErrado[] = $value['email'];
			}
		}		

			print "<table class='table'>";
				print "<tr>
						<td colspan='3' style='text-align:center;'>Todos</td>
					</tr>";
					

			print "<tr><td>";
			foreach($emailArray as $key=>$lista1){

				print $lista1."; ";
				if(((($key % 50) == 0)) && ($key !=0)){
					print "<hr><br><br>"	;
				}

			}
			print "</td></tr><tr><td>";
			print "</table>";
			print "<br><br>";
			//var_dump($emailErrado);
			//var_dump($array);
	
	# Compdec Existente
	}else if($_POST['selEmail'] == 1){
			#compdec existente

			$dados = $_relatorioCompdec->relCompdec(1);
			$lista = "";
			foreach ($dados as $key=>$value){
				if(($value['email'] != "-") && ($value['email'] != " ") && (!empty($value['email']))){ 
					
					$email = str_replace("", " ", strtolower($value['email']));
							
					$remover = array(",", "/", "-");
					$lista .=  str_replace($remover, ";", $email).";";
				}
			}
	
			$array = explode(";", $lista);
	
			foreach($array as $email1){
				if(strpos($email1, "@")){
				$emailArray[] = $email1;
				}else {
					$emailErrado[] = $value['email'];
				}
			}		
	
				print "<table class='table'>";
					print "<tr>
							<td colspan='3' style='text-align:center;'>Existente</td>
						</tr>";
						
	
				print "<tr><td>";
				foreach($emailArray as $key=>$lista1){
	
					print $lista1."; ";
					if(((($key % 50) == 0)) && ($key !=0)){
						print "<hr><br><br>"	;
					}
	
				}
				print "</td></tr><tr><td>";
				print "</table>";
				print "<br><br>";
				//var_dump($emailErrado);
				//var_dump($array);


		
	# sem Compdec
	}else if($_POST['selEmail'] == 2){
		#compdec inexixtente

		$dados = $_relatorioCompdec->relCompdec(0);
			$lista = "";
			foreach ($dados as $key=>$value){
				if(($value['email'] != "-") && ($value['email'] != " ") && (!empty($value['email']))){ 
					
					$email = str_replace("", " ", strtolower($value['email']));
							
					$remover = array(",", "/", "-");
					$lista .=  str_replace($remover, ";", $email).";";
				}
			}
	
			$array = explode(";", $lista);
	
			foreach($array as $email1){
				if(strpos($email1, "@")){
				$emailArray[] = $email1;
				}else {
					$emailErrado[] = $value['email'];
				}
			}		
	
				print "<table class='table'>";
					print "<tr>
							<td colspan='3' style='text-align:center;'>Sem Compdec</td>
						</tr>";
						
	
				print "<tr><td>";
				foreach($emailArray as $key=>$lista1){
	
					print $lista1."; ";
					if(((($key % 50) == 0)) && ($key !=0)){
						print "<hr><br><br>"	;
					}
	
				}
				print "</td></tr><tr><td>";
				print "</table>";
				print "<br><br>";
				//var_dump($emailErrado);
				//var_dump($array);

	}

            

            

?>