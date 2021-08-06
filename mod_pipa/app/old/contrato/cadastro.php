<?php session_start();
print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
include_once PATH.'/include.php';
        
$_login = new Login();

$_login->VerificaBrowser();

$_login->logado(CAD_CONTRATO, $MODULO['mod_pipa']);

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
	<div class="container">
		<div class="row-fluid text-center">
			<img src="../imagem/topo_pipa.png">
			<hr>
		</div>
		<!-- BARRA -->
	    <div class="row-fluid">
	      <div class="span6 text-left"><small><?php print "Data :".date("d/m/Y");?></small></div>
	      <div class="span6 text-right"><small><?php print "Hora :".date("H:i:s");?></small></div>
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
				<?php include_once PATH."/mod_".$modulo.'/app/elemento/'.$modulo.'.menu.php';?>
			</div>
			<div class="span9">
				<legend>Cadastro de Contrato</legend>
				<form id="form1" name="form1" method="post" action="?modulo=pipa&secao=contrato&acao=validar">
					
					<!-- dados do contrato -->
					<div class="controls controls-row">
						<input class="span6" type="text" name="nome_mot" id="nome_mot" readonly="readonly"  placeholder="Nome Motorista" title="Clique em pesquisar para Adicionar o Motorista no Novo Contrato"/>
						<a href="?modulo=pipa&secao=motorista&acao=pesquisar" class="window btn" >Adicionar</a>
					</div>
					<div class="controls controls-row">
						<input class="span3" type="text" name="placa1" id="placa1" readonly="readonly" placeholder="Placa Caminhão" title="Clique em pesquisar para Adicionar o Caminhão no Novo Contrato"/>
						<a href="?modulo=pipa&secao=caminhao&acao=pesquisar" class="window btn" rel="500x400">Adicionar</a>
					</div>
					
					<div class="controls controls-row">
						<input class="span3" type="text" name="nome_rota" id="nome_rota" size="40" readonly="readonly"  placeholder="Rota" title="Clique em Pesquisar para Adicionar uma rota no Novo Contrato"/>
						<a href="?modulo=pipa&secao=rota&acao=pesquisar&op=cont" class="window btn" rel="500x400">Adicionar</a>
					</div>
					<div class="controls controls-row">
                        <input class="span3" type="text" name="num_rota" id="num_rota" size="40" readonly="readonly"  title="Número da Rota"/>
                        Número da Rota
                    </div>

					<div class="controls controls-row">
						<input class="span3 corVermelho" type="text" name="n_contrato" id="n_contrato" size="9"  placeholder="Número do Contrato" title="Número do Contrato"/>
						<input class="span3 corVermelho" type="text" name="dt_contrato" id="dt_contrato" placeholder="Data do Contrato" data-mask="99/99/9999" title="Data do Contrato"/>
						<select class="span3" name="situacao">
							<option value="A">Ativo</option>
							<option value="R">Rescindido</option>
						</select>
					</div>
					<div class="controls controls-row">
						<input class="span3" type="text" name="txt_ano" id="txt_ano" size="9" placeholder="Ano do Contrato" data-mask="9999" title="Ano do Contrato" value="<?php print date('Y');?>"/>
						<input class="span3" type="text" name="txt_num_empenho" id="txt_num_empenho" placeholder="Numero do Empenho" maxlength="10" title="Número do Empenho"/>
						<input class="span3" type="text" name="txt_dt_empenho" id="txt_dt_empenho" placeholder="Data do Empenho" data-mask="99/99/9999" title="Data do Empenho" value="01/01/2014" />
						
					</div>

					<input type="hidden" name="id_motorista" id="id_motorista" />
					
					<input type="hidden" name="id_caminhao" id="id_caminhao" />
					
					<input type="hidden" name="id_rota" id="id_rota" />
					
				    
					<textarea class="span9 field" rows="7" cols="30" name="obs" placeholder="Observação"></textarea><br />

					<input class="btn btn-primary" type="submit" id="cadastrar" name="cadastrar" value="Cadastrar" onclick="return confirm('Deseja Confirmar o cadastro !');">		        
				</form>
			</div>

			<!---->
		</div>
		<div class="row-fluid fdo_corpo"></div>
		<div class="row-fluid text-center">
			<small><?php print RODAPE;?></small>
		</div>
	</div>

	<script src="<?php print SISTEMA;?>/js/jquery.js"></script>
	<script src="<?php print SISTEMA;?>/js/bootstrap.js"></script>
	<script src="<?php print SISTEMA;?>/js/jasny-bootstrap.js"></script>
	<script src="<?php print SISTEMA;?>/js/funcaobase.js"></script>
	<script type="text/javascript">

    ﻿$(document).ready(function()
{

  /* Quando algum hyperlink com a classe "window" for clicado */

  $('a.window').click(function()
  {
    var dimensions = (this.rel) ? this.rel : '660x600';
    dimensions = dimensions.split('x');
    var width = dimensions[0];
    var height = dimensions[1];
    var bWindow = window.open(this.href, this.id, 'width=' + width + ',height=' + height + ',left=390,top=' + ((screen.height - height) / 2) + ',scrollbars=yes,resizable=yes,toolbars=no');
    bWindow.focus();


    console.log('h:' +width + 'sh:' + screen.width + 'total:' + ((screen.width - width) / 2));
    return false; 
  });
});

</script>

</body>
</html>
