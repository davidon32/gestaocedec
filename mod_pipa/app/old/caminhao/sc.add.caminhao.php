<?php session_start();
print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
include_once '../../include.php';
  
$_conexao = new ConexaoMysql();

$_login = new Login();

    $_login->VerificaBrowser();

    $_login->logado(CAD_CAMINHAO, $MODULO['mod_pipa']);

    $_login->Sessao();

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php print TITULO;?></title>
<link href="<?php print SISTEMA;?>/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="<?php print SISTEMA;?>/css/bootstrap-responsive.css" rel="stylesheet" media="screen">

</head>
<body>
<label>Placa</label>:

	<form action="#" method="post">
		
		<input type="text" name="placa" id="placa" class="placa" size="30" />
		<input type="submit" name="enviar" id="enviar" value="Pesquisar" />
		
	</form>
<?php

	$_placa = isset($_POST['placa']) ? $_POST['placa'] : "";
	$_enviar = isset($_POST['enviar']) ? $_POST['enviar'] : "";
	
	
	if($_enviar != ""){
		
		$dados = Caminhao::buscaCaminhao($_placa);
	
		print '<table border="1">
				<tr>
					<td>Placa</td><td>Modelo</td><td>Ano</td><td>Capacidade</td><td>Add</td>
				</tr>
				<tr>
					<td>'.$dados[0]['placa'].'</td><td>'.$dados[0]['modelo'].'</td><td>'.$dados[0]['ano'].'</td><td>'.$dados[0]['capacidade'].'</td> <td><a href="sc.add.session.php?id='.$dados[0]['id_caminhao'].'">Add</a></td>
				</tr>
			</table>';FuncaoBase::vd($dados);
			
	}

?>
</body>
<script src="<?php print SISTEMA;?>/js/jquery.js"></script>
<script src="<?php print SISTEMA;?>/js/bootstrap.js"></script>
<script src="<?php print SISTEMA;?>/js/jasny-bootstrap.js"></script>
<script src="<?php print SISTEMA;?>/js/funcaobase.js"></script>
<script type="text/javascript">

function esconde_rep(){
    $("#moto").hide();
}
function mostra_rep(){
    $("#moto").show();
}

function pf() {
    $("#cpf_cnpj").mask("999.999.999-99");
    $("#cpf_cnpj_banco").mask("999.999.999-99");
    
        
}

function pj(){
    $("#cpf_cnpj").mask("99.999.999/9999-99");
    $("#cpf_cnpj_banco").mask("99.999.999/9999-99");
}

function placa(){
    $("#placa").mask("999-9999");
    
}

function upperCase()
{
var x=document.getElementById("fname");
x.value=x.value.toUpperCase();
}

</script>

</html>