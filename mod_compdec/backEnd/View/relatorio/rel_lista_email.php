	<br><br>
<?php
	$dados = $_relatorioCompdec->relCompdec();
	
	$_semCompdec = array();
	$_compdecExistente = array();
	
	for ($i=0; $i < count($dados); $i++) {
		
		if($dados[$i]['com_const'] == "0"){
			
			$_semCompdec[] = array('id_municipio'=> $dados[$i]['id_comdec'], 'municipio'=>$dados[$i]['municipio'], 'email' =>$dados[$i]['email']);

		}else {
			$_compdecExistente[] = array('id_municipio'=> $dados[$i]['id_comdec'], 'municipio'=>$dados[$i]['municipio'], 'email' =>$dados[$i]['email']);	
		}
	}

	# todos
	if($_POST['selEmail'] == 0){
			print "<table class='table'>";
				print "<tr><td colspan='3' style='text-align:center;'>Todos</td></tr>";
				$i= 1;
				foreach ($dados as $value){
					print "<tr>";
					print "<td>".$i."</td>";
					print "<td>".$value['municipio']."</td>";
					print "<td>".$value['email']."</td>";
					print "</tr>";
					$i++;
				}
			print "</table>";
	
	# Compdec Existente
	}else if($_POST['selEmail'] == 1){
		print "<table class='table' >";
		print "<tr><td colspan='3'  style='text-align:center;'>Compdec Existentes</td></tr>";
		$i= 1;
		foreach ($_compdecExistente as $value){
			print "<tr>";
			print "<td>".$i."</td>";
			print "<td>".$value['municipio']."</td>";
			print "<td>".$value['email']."</td>";
			print "</tr>";
			$i++;
		}
		print "</table>";
		
	# sem Compdec
	}else if($_POST['selEmail'] == 2){
		print "<table class='table'>";
		print "<tr><td colspan='3'  style='text-align:center;'>Sem Compdec</td></tr>";
		$i= 1;
		foreach ($_semCompdec as $value){
			print "<tr>";
			print "<td>".$i."</td>";
			print "<td>".$value['municipio']."</td>";
			print "<td>".$value['email']."</td>";
			print "</tr>";
			$i++;
		}
		print "</table>";

	}

            

            

?>