<?php

$conexao = mysql_connect('localhost', 'root', '123456') or die(mysql_error());
$base = mysql_select_db('gestaocedec');

$query = 'select id_municipio from cedec_municipio';

$result = mysql_query($query) or die (mysql_error());

#@ numero total de registros 
$num_registro = mysql_num_rows($result);

#@ numero de registros por pagina
$num_reg_pagina = 10;

#@ numero de paginas
$num_pagina = ceil($num_registro / $num_reg_pagina);

$inicio = 0;
$fim = $num_reg_pagina;


		
		//print '<tr><td>'.$dados[$i]['id_municipio'].'</td></tr>';

	
$inicio = isset($_GET['inicio']) ? $_GET['inicio'] : '0';

$fim = isset($_GET['fim']) ? $_GET['fim'] : '0';

if(($inicio != '') && ($fim != '')) {

	$tabela = 'cedec_municipio';

	$campos = 'id_municipio, nome, distancia_bh, populacao';

	$sql = 'select '.$campos.' from '.$tabela.' limit '.$inicio.', '.$num_reg_pagina;

	print '<table><tr><td>Codigo</td><td>Nome</td><td>Distancia</td><td>Populacao</td></tr>';

	$result_rel = mysql_query($sql) or die (mysql_error()."ola");


	while ($linha = mysql_fetch_assoc($result_rel)) {
		
		//var_dump($linha);
		print '<tr><td>'.$linha['id_municipio'].'</td><td>'.$linha['nome'].'</td><td>'.$linha['distancia_bh'].'</td><td>'.$linha['populacao'].'</td></tr>';	
	}

	for ($i=1; $i <= $num_pagina; $i++) { 
		
		
		print '<a href="?inicio='.$inicio.'&fim='.$num_reg_pagina.'">'.$i.' </a>';

			$inicio = $fim+1;
			if($fim+$num_reg_pagina >= $num_registro)  {
				$fim = $num_registro;
				//print $inicio;
				//$num_reg_pagina = $fim - $inicio;
			}else {
			
				$fim = $fim+$num_reg_pagina;
			}

		}
}

?>



<html>
<head>
	<title></title>
</head>
<body>

	<div class="container">
		<div class="row">
			<div class="span12">
				<form action="#" method="GET" name="frm_rel">
					<input type="text" name="">

				</form>
				


			</div>
		</div>

	</div>



</body>
</html>