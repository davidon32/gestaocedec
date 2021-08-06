<?php include_once '../../include.php';

    $_conexao = new ConexaoMysql();

    $_login = new Login();

    $_login->logado();
    

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>
<link rel="stylesheet" type="text/css" href="../css/estilo.css" media="" >
</head>
<body>

	<form action="#" method="POST" name="" id="" class="" />

	<table border="1" id="" class="" cellspacing="0" cellpadding="0" class="tabela">

		<tr>
			<td valign="top" class="">Situação</td>
			<td valign="top" class=""><select name="situacao" id="situacao" class="">
					<option name="tipo" value=" "></option>
					<option name="tipo" value="A">Ativo</option>
					<option name="tipo" value="R">Rescindido</option>
			</select>
			</td>
		</tr>
		
		
		<input class="btn btn-primary" type="text" placeholder="Numero do Contrato" name="num_contrato"></input>
		

	</table>
	<div style="width: 400px; text-align: center"><input type="submit" name="enviar" id="enviar" value="Pesquisar"/></div>

	</form>

</body>
</html>

<?php

	//var_dump($_POST);
	$situacao = isset($_POST['situacao']) ? $_POST['situacao'] : null;
	
	$num_contrato = isset($_POST['num_contrato']) ? $_POST['num_contrato'] : null;
	
	var_dump($_POST);
	
	#@ pesquisa por situação de contrato
	if($situacao == "A" || $situacao == "R") {
		
		print '<a href="rel.lista.contrato.php?tipo='.$contrato.'">Visualizar Relatórios</a>';

		#@ pesquisa por numero de contrato
	}elseif ($num_contrato != null){

	    $rel = Relatorio::RelatorioContratoPorNumContrato($num_contrato);

	    //var_dump($rel);
	    print "<table><tr><td></td><td></td>";
	    
	    foreach ($rel as $key => $value) {
	        
	        print "<tr><td>".$key."  :</td><td>".$value."</td></tr>";
	    }
	    
	   
	    
	}

//



?>