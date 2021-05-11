<?php session_start();
print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
include_once '../include.php';

$_conexao = new ConexaoMysql();

$_login = new Login();

$_login->VerificaBrowser();

$_login->logado(CAD_CONTRATO, $MODULO['mod_pipa']);

$_login->Sessao();

$_contrato = new Contrato();

$_id_contrato = isset($_GET['id']) ? $_GET['id'] : false;

$_dados = $_contrato->buscaContratoId($_id_contrato);

//var_dump($_dados);

//FuncaoBase::vd($_GET);
?>
<html>
<head>
<title><?php print TITULO; ?>
</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php print SISTEMA;?>/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="<?php print SISTEMA;?>/css/bootstrap-responsive.css" rel="stylesheet" media="screen">

</head>
<body>
	<div class="container">
		<div class="row-fluid text-center">
			<img src="../imagem/topo_pipa.png">
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
			<!-- MENU -->
			<div class="span3">
				<?php include_once 'visao/pipa.menu.php';?>
			</div>
			<div class="span9">

				<legend>Alterar Contrato</legend>

				<form method="post" action="secao.php?secao=contrato&acao=validarAlterar" name="frm_alterar">

					<label>Número Contrato</label>
					<input type="text" name="num_contrato" id="num_contrato" size="7" value="<?php print $_dados['num_contrato'];?>" readonly="readonly">

					<label>Data Assinatura</label>
					<input type="text" name="dt_assinatura" id="dt_assinatura" size="9" class="mask-data"
						value="<?php print DataMysql::dataVisual($_dados['data_contrato']);?>">

					<label>Nome Motorista</label>
					<input type="text" name="motorista" id="motorista" size="50"
						value="<?php print Motorista::buscaMotoristaNome($_dados['id_motorista']);?>" readonly="readonly" />
						
					<label>Caminhao</label>
					<input type="text" name="txt_placa" id="txt_placa" value="<?php print $_dados['id_caminhao'];?>">
					<input type="button" value="Pesquisar" class="btn btn-primary" onclick="NovaJanela('secao.php?secao=caminhao&acao=pesquisar', 500, 400);">

					<label>Situação</label>
					<select name="situacao">
						<option value="<?php print $_dados['situacao']?>">
							<?php print ($_dados['situacao'] == 'A') ? 'Ativo' : 'Rescindido';?>
						</option>
						<option>Ativo</option>
						<option value="R">Rescindido</option>
					</select>

					<label>Data Rescisão</label>
					<input type="text" name="dt_rescisao" id="dt_rescisao" data-mask="99/99/9999"
						value="<?php print ($_dados['dt_rescisao'] != "null") ? DataMysql::dataVisual($_dados['dt_rescisao']) : "" ;?>">

                    <label>Num Empenho</label>
                    <input type="text" name="num_empenho" id="num_empenho" value="<?php print $_dados['num_empenho'];?>">

                    <label>Data Empenho</label>
                    <input type="text" name="dt_empenho" id="dt_empenho" data-mask="99/99/9999"
                        value="<?php print ($_dados['dt_empenho'] != "null") ? DataMysql::dataVisual($_dados['dt_empenho']) : "" ;?>">


					<label>Obs</label>
					<textarea rows="7" cols="20" name="obs">
						<?php print trim($_dados['obs']);?>
					</textarea>

					<br />
					<input type="hidden" name="id_motorista" id="id_motorista" value="<?php print $_dados['id_motorista']?>">

					<input type="hidden" name="id_contrato" id="id_contrato" value="<?php print $_dados['id_contrato']?>">
					<br />
					<input type="submit" name="btn_enviar" id="btn_enviar" value="enviar" class="btn btn-primary" onclick="return confirm('Confirma a Alteração do Contrato')">

				</form>
			</div>
			<div class="span12 text-center">
			
				<small><?php print RODAPE;?></small>
			
			</div>

				<script src="<?php print SISTEMA;?>/js/jquery.js"></script>
				<script src="<?php print SISTEMA;?>/js/bootstrap.js"></script>
				<script src="<?php print SISTEMA;?>/js/jasny-bootstrap.js"></script>
				<script src="<?php print SISTEMA;?>/js/funcaobase.js"></script>

</body>
</html>

