<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php	include_once '../include.php';

$_conexao = new ConexaoMysql();

$_login = new Login();

$_login->logado();

$_login->Sessao();

/* ****************************************************************************************
 *   Org�o Gestor : Coordenadoria Estadual de Defesa Civil do Estado de Minas Gerais
*	Sistema      : Sistema de Gest�o de Ajuda Humanit�ria
*
*	Autor        : Demetrio Silva Passos
*	Fun��o       : Tela para EFETIVAR a transfer�ncia de materiais entre dep�sitos
*
*******************************************************************************************/
	
	// id deposito origem
	$_id_deposito_origem = isset($_GET['dep']) ? $_GET['dep'] : "";

	// id produto
	$_id_produto  = isset($_GET['idp']) ? $_GET['idp'] : "";
	$_saldo       = isset($_GET['sal']) ? $_GET['sal'] : "";
		
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo TITULO; ?></title>
<link href="<?php print SISTEMA;?>/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="<?php print SISTEMA;?>/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="<?php print SISTEMA;?>/js/funcaobase.js"></script>
</head>

<body>
	<div class="container">
		<div class="row-fluid text-center">
			<img src="../imagem/topo_ajuda.png" />
			<hr>
		</div>
		
		<!-- BARRA -->
		<div class="row-fluid">
			<div class="span6 text-left"><small><?php print "Data :".date("d/m/Y");?></small></div>
			<div class="span6 text-right"><small><?php print "Hora :".date("H:i:s");?></small></div>
		</div>
		
		<!-- LOGOUT -->
		<div class="row-fluid text-right">
			<a class="btn btn-primary" href="<?php print SISTEMA;?>/core/logout.php?logout=s" title="Fazer logout do sistema">Logout</a>
			<p>
			<hr>
		</div>
		<!-- MENU -->
		<div class="row-fluid">
			<div class="span3"><?php include_once 'visao/sc.ajuda.menu.php';?></div>
				<div class="span9">
	
					<legend>Transferência de Materiais</legend>
						<form method="post" action="controle/valida.material.transferencia.php" name="frm_valida_transferencia">
					
							<input type="hidden" name="txt_saldo" value="<?php print $_saldo; ?>" />
							<input type="hidden" name="txt_id_produto" value="<?php print $_id_produto; ?>" />
							<input type="hidden" name="txt_id_dep_origem" value="<?php print $_id_deposito_origem; ?>" />

							<div class="span4">

								<label>Produto</label>
								<input type="text" value="<?php print $_id_produto; ?>" readonly="readonly"/>

								<label>Quantidade:</label>
								<input name="txt_quantidade" type="text" id="txt_quantidade" />

								<label>Data:</label>
								<input name="txt_dt_transferencia" type="text" id="txt_dt_transferencia" data-mask="99/99/9999" value="<?php print date('d/m/Y');?>" />
								
								<label>Motorista</label>
								<input type="text" name="txt_motorista" />

								<label>Ve&iacute;culo</label>
								<input type="text" name="txt_veiculo" />
							
								<label>Placa</label>
								<input type="text" name="txt_placa" data-mask="aaa-9999"/>
							</div>
							<div class="span1"></div>

							<div class="span4">
								<label>Dep&oacute;sito Origem</label>
								<input type="text" value="<?php print Deposito::PegaNomeDeposito($_id_deposito_origem);?>" readonly="readonly" />
								
								<label>Data Saida</label>
								<input type="text" name="txt_saida" data-mask="99/99/9999" />
								
								<label>Hora Saída</label>
								<input type="text" name="txt_hora_saida" data-mask="99:99"/>

								<label>Dep&oacute;sito Destino:</label>
								<?php Deposito::PegaDeposito();	?>
								
								<label>Previs&atilde;o Chegada Data</label>
								<input type="text" name="txt_chegada" data-mask="99/99/9999" />
								
								<label>Previs&atilde;o Chegada Hora</label>
							 	<input type="text" name="txt_hora_chegada" data-mask="99:99" />
							</div>
							<div class="span9">
								<input type="submit" onclick="return confirm('Deseja Realmente fazer a Transferencia de Materiais ?');"
									name="btn_enviar" value="Transferir" /> 
							</div>
						</form>
				</div>
		</div>
		<div class="row-fluid">
			<div class="span12 text-center"><hr>
				<small><?php print RODAPE;?></small>
			</div>
		</div>
	</div>

		<script src="<?php print SISTEMA;?>/js/jquery.js"></script>
	<script src="<?php print SISTEMA;?>/js/bootstrap.js"></script>
	<script src="<?php print SISTEMA;?>/js/jasny-bootstrap.js"></script>

</body>
</html>
