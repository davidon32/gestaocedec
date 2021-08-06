<?php session_start();
print "<!DOCTYPE html>";
include_once PATH.'/include.php';

$_login = new Login();

$_login->VerificaBrowser();

$_login->logado(CAD_CAMINHAO, $MODULO['mod_pipa']);

$_login->Sessao();

$placa = isset($_GET['placa']) ? $_GET['placa'] : false;

if($placa != false)
{

	$dados = Caminhao::buscaCaminhao($placa);

}

//var_dump($dados);

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php print TITULO;?></title>
<link href="<?php print SISTEMA;?>/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="<?php print SISTEMA;?>/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
</head>
<body>
	<div class="container">
		<div class="row-fluid text-center">
			<img src="../imagem/topo_pipa.png" />
			<hr>
		</div>
		<!-- BARRA -->
		<div class="row-fluid">
			<div class="span6 text-left">
				<small><?php print "Data :".date("d/m/Y");?> </small>
			</div>
			<div class="span6 text-right">
				<small><?php print "Hora :".date("H:i:s");?> </small>
			</div>
		</div>

		<!-- LOGOUT -->
		<div class="row-fluid">
			<div class="span12 text-right">
				<a class="btn btn-primary" href="<?php print SISTEMA;?>/core/logout.php?logout=s" title="Logout do Sistema">Logout</a>
				<p>
				
				
				<hr>
			</div>
		</div>
		<div class="row-fluid">
			<div class="span3">
				<?php include_once PATH."/mod_".$modulo.'/app/elemento/'.$modulo.'.menu.php';?>
			</div>
			<div class="span9">
				<legend>Alteração dos Dados do Veículo</legend>
				<form id="form1" name="frm_alterar_caminhao" method="POST" action="?modulo=pipa&secao=caminhao&acao=validar">

					<br />
					<input type="hidden" name="txt_id_caminhao" id="txt_id_caminhao" value="<?php print $dados[0]['id_caminhao'];?>">
					<label>Placa</label>
					<input type="text" name="txt_placa" id="txt_placa" value="<?php print $dados[0]['placa'];?>" readonly="readonly">
					<span title="Preenchimento Obrigatório !" class="asterisco">&nbsp;&nbsp;*&nbsp;&nbsp;</span><br />
					
					<label>Modelo</label>
					<input type="text" name="txt_modelo" id="txt_modelo" value="<?php print $dados[0]['modelo'];?>" />
					<span title="Preenchimento Obrigatório !" class="asterisco">&nbsp;&nbsp;*&nbsp;&nbsp;</span><br />
					
					<label>Marca</label>
					<input type="text" name="txt_marca" id="txt_marca" value="<?php print $dados[0]['marca'];?>" />
					<span title="Preenchimento Obrigatório !" class="asterisco">&nbsp;&nbsp;*&nbsp;&nbsp;</span><br />
					
					<label>Ano Fabricação</label>
					<input type="text" name="txt_fabricacao" id="txt_fabricacao" value="<?php print $dados[0]['ano'];?>" data-mask="9999"/>
					<span title="Preenchimento Obrigatório !" class="asterisco">&nbsp;&nbsp;*&nbsp;&nbsp;</span><br />
					
					<label>Chassi</label>
					<input type="text" name="txt_chassi" id="txt_chassi" value="<?php print $dados[0]['chassi'];?>" />
					
					<label>Número Renavam</label>
					<input type="text" name="txt_renavam" id="txt_renavam" value="<?php print $dados[0]['renavam'];?>" />
					
					<label>Capacidade M&sup3;</label>
					<input type="text" name="txt_capacidade" id="txt_capacidade" value="<?php print $dados[0]['capacidade'];?>" data-mask="99" />
					<span title="Preenchimento Obrigatório !" class="asterisco">&nbsp;&nbsp;*&nbsp;&nbsp;</span><br />
					
					<input type="submit" name="btn_enviar" id="btn_enviar" value="Alterar">
					
				</form>
			</div>

		</div>
		<script src="<?php print SISTEMA;?>/js/jquery.js"></script>
		<script src="<?php print SISTEMA;?>/js/bootstrap.js"></script>
		<script src="<?php print SISTEMA;?>/js/jasny-bootstrap.js"></script>
		<script src="<?php print SISTEMA;?>/js/funcaobase.js"></script>

</body>
</html>
