<?php session_start();
print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
include_once PATH.'/include.php';

/* ****************************************************************************************
*  	Org�o 		 : Coordenadoria Estadual de Defesa Civil do Estado de Minas Gerais
*	Sistema      : Sistema de Gest�o de Ajuda Humanit�ria
*
*	Autor        :  Demetrio Silva Passos
*	Função       : Tela para Transfer�ncia de Materiais entre Dep�sitos Avan�ados
*
*******************************************************************************************/
$_conexao = new ConexaoMysql();

$_login = new Login();

$_login->logado();

$_login->Sessao();

//var_dump($_SESSION);
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo TITULO; ?></title>
<link href="/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="<?php print SISTEMA;?>/js/funcaobase.js"></script>
</head>

<body>
    <!-- TOPO /system/topo.php-->
    <?php include_once(PATH.'/system/topo.php'); ?>
    
	<div class="container">
		
		<!-- MENU -->
		<div class="row-fluid">
			<div class="span3">
			    <?php include_once PATH."/mod_".$modulo.'/app/elemento/'.$modulo.'.menu.php';?>
			</div>
			<div class="span9"><legend>Transfer&ecirc;ncia de Materiais</legend></div>
				<div class="span3 fdo_corpo">
					<form action="index.php?modulo=ajuda&secao=transferencia&acao=valida&opcao=transferir" method="POST" name="frm_cesta">

						<label>Data:</label>
						<input name="txt_dt_transferencia" type="text" id="txt_dt_transferencia" data-mask="99/99/9999" value="<?php print date('d/m/Y');?>" />
						
						<label>Motorista</label>
						<input type="text" name="txt_motorista" />

						<label>Ve&iacute;culo</label>
						<input type="text" name="txt_veiculo" />
						
						<label>Placa</label>
							<input type="text" name="txt_placa" data-mask="aaa-9999" />
				</div>
				<div class="span3">
					<label>Data Saida</label>
					<input type="text" name="txt_saida" data-mask="99/99/9999" value="<?php print date('d/m/Y');?>"/>
					
					<label>Hora Saída</label>
					<input type="text" name="txt_hora_saida" data-mask="99:99" />

					<label>Dep&oacute;sito Transferido <b>para</b>:</label>
					<?php Deposito::PegaDeposito();?>
					
					<label>Previs&atilde;o Chegada Data</label>
					<input type="text" name="txt_chegada" data-mask="99/99/9999" />
					
					<label>Previs&atilde;o Chegada Hora</label>
					<input type="text" name="txt_hora_chegada" data-mask="99:99" />
				</div>
				<div class="span3">
					<br />
					<a href="index.php?modulo=ajuda&secao=transferencia&acao=add_material" class="btn window" title="">Adicionar Material</a>
					<br />
					<br />
					<a href="index.php?modulo=ajuda&secao=transferencia&acao=cancela" class="btn window" title="">Cancelar Transferência</a>

				</div>
				<div class="span3 tex-center">
				</div>
				<div class="span9 text-center">	
					<input class="btn btn-primary" type="submit" onclick="return confirm('Deseja Realmente fazer a Transferencia de Materiais ?');" name="btn_enviar" value="Transferir" /> 
				</div>

				
		<div class="row-fluid text-center">
			<div class="span12"><hr><small><?php print RODAPE;?></small></div>	
		</div>

	</div>
	<script src="/js/jquery.js"></script>
	<script src="/js/bootstrap.js"></script>
	<script src="/js/jasny-bootstrap.js"></script>
	<script type="text/javascript">
			﻿$(document).ready(function()
				{

				  /* Quando algum hyperlink com a classe "window" for clicado */

				  $('a.window').click(function()
				  {
				    var dimensions = (this.rel) 
				      ? this.rel
				      : '1000x600';
				    dimensions = dimensions.split('x');
				    var width = dimensions[0];
				    var height = dimensions[1];
				    var bWindow = window.open(this.href, this.id, 'width=' + width + ',height=' + height + ',left=' + (((screen.width - width) / 2) - 20) + ',top=' + (((screen.height - height) / 2) - 20) + ',scrollbars=yes,resizable=yes,toolbars=no');
				    bWindow.focus();
				    return false; 
				  });
				});
		</script>
	

</body>
</html>
