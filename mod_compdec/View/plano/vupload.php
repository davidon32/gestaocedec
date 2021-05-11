<?php include_once 'core/include.php';?>
<?php include_once "core/Model/indexModel.php";?>
<?php include_once 'mod_compdec/Model/Model.php';?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php";?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php";?>
<!-- =================== MENU  ============================ -->
<?php include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";?>
<?php

$tp_acesso = $_COOKIE['seguranca']['tipo'] ;
	
if($tp_acesso == "e"){
	$id_municipio = $pageSession['session']['seguranca']['id_municipio'];
}elseif($tp_acesso == "i"){
	$id_municipio = isset($_GET['id']) ? $_GET['id'] : "";
}
		
// id plano
$id = isset($_GET['id']) ? $_GET['id'] : "";

	$plano = new Plano();
	$anexo = new Anexo();

?>	

	  	<div class="container iframe">
		  <?php 
		  	if($tp_acesso == "e"){
				  print "<p style='text-align:center'><a href='?token=".hash('sha256', md5(VERSAO))."&ac=etn&modulo=compdec&controller=plano&action=index' class='btn btn-success'>Voltar</a></p>";
			}  else {
				print "<p style='text-align:center'><a href='#' onclick='history.back();' class='btn btn-primary'>Voltar</a></p>";
			}
		  	if($anexo->getExtensao($_GET['id']) == "pdf"){
				  print "<iframe name=\"myiframe\" id=\"myiframe\" style=\"width:100%; height:750px;\" src=\"/anexo/planoCont/".$plano->visualizarDoc($_GET['id'])."\"></iframe>";
			}else {
				print "<br><br><span class=\"alert alert-success\"><b>Fazendo download do Documento Aguarde...</b></span><br><br>";
				print "<span class=\"glyphicon glyphicon-arrow-down\" aria-hidden=\"true\"></span>";
				print "<object name=\"myiframe\" id=\"myiframe\" style=\"width:100%; height:750px;\" data=\"/anexo/planoCont/".$plano->visualizarDoc($_GET['id'])."\"</object>";
				
			}
			?>
	  	</div>
		  <!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>
