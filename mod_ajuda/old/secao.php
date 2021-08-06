<?php include_once '../include.php'; 
	#@ ############################## Liberação #############################
	
	

	#@ Cancelar Liberação
	if ((isset($_GET['secao'])) && ($_GET['secao'] == "liberacao") && (isset($_GET['acao'])) && ($_GET['acao'] == "cancelar")) {
	    
	    include 'visao/sc.liberacao.cancelar.php';
	    exit();

	}


	#@############################################ pagamento #######################################################

	
	#@ recebimento de materiais transferidos
	if ((isset($_GET['secao'])) && ($_GET['secao'] == "pagamento") && (isset($_GET['acao'])) && ($_GET['acao'] == "receber")) {
	    
	    include 'visao/sc.material.receber.php';
	    exit();

	}

	#@ efetivar recebimento materiais transferidos
	if ((isset($_GET['secao'])) && ($_GET['secao'] == "deposito") && (isset($_GET['acao'])) && ($_GET['acao'] == "receber")) {
	    
	    include 'visao/sc.transferencia.efetivar.receber.php';
	    exit();

	}

	

	############################################# material ###################################################

	#@ cadastro de material
	if ((isset($_GET['secao'])) && ($_GET['secao'] == "material") && (isset($_GET['acao'])) && ($_GET['acao'] == "cadastrar")) {
	    
	    include 'visao/ViewMaterial/sc.material.cadastrar.php';
	    exit();

	}


	################################################ Tranferência #############################################

	#@ formulario para transferencia de material entre depositos
	if ((isset($_GET['secao'])) && ($_GET['secao'] == "material") && (isset($_GET['acao'])) && ($_GET['acao'] == "transferencia")) {
	    
	    include 'visao/sc.transferencia.material.php';
	    exit();

	}

	#@ Adicionar Material para Transferencia
	if ((isset($_GET['secao'])) && ($_GET['secao'] == "transferencia") && (isset($_GET['acao'])) && ($_GET['acao'] == "adicionar")) {
	    
	    include 'visao/sc.transferencia.material.adicionar.php';
	    exit();

	}

	#@ Cancelar Transferencia de Materiais
	if ((isset($_GET['secao'])) && ($_GET['secao'] == "transferencia") && (isset($_GET['acao'])) && ($_GET['acao'] == "cancelar")) {
	    
	    include 'visao/sc.transferencia.material.cancelar.php';
	    exit();

	}
	
	
	



	################################################ Recebimento #############################################

	#@ receber materiais
	if ((isset($_GET['secao'])) && ($_GET['secao'] == "material") && (isset($_GET['acao'])) && ($_GET['acao'] == "receberEfetivar")) {
	    
	    $id_transferencia = $_GET['id'];
	    include 'visao/sc.material.receber.efetivar.php';

	    exit();

	}
	
	#@ recibo recebimento de materiais transferido
	if ((isset($_GET['secao'])) && ($_GET['secao'] == "receb") && (isset($_GET['acao'])) && ($_GET['acao'] == "recibo")) {
		 
		$id_transferencia = $_GET['id'];
		
		
		print "<div style=\"text-align:center\"><br>";
		
		print FuncaoBase::vifs('volta', 'secao.php?secao=pagamento&acao=receber')."<br><br>";
		
		print "<a class=\"btn\" href=\"../mod_ajuda/secao.php?secao=recibo&acao=matreceb&id=".$id_transferencia."\">Recibo</a>";
		
		print "</div>";
		exit();
	
	}
	
	#@ impressao recibo transferencia de materiais
	if ((isset($_GET['secao'])) && ($_GET['secao'] == "recibo") && (isset($_GET['acao'])) && ($_GET['acao'] == "matreceb")) {
			
		include 'rel/rel.material.recibo.recebe.transf.php';
		
		exit();
	
	}

	#@ adicionar material cesta transferencia
	if ((isset($_GET['secao'])) && ($_GET['secao'] == "material") && (isset($_GET['acao'])) && ($_GET['acao'] == "adicionar")) {

	    include 'visao/sc.material.adicionar.cesta.transferir.php';
	    exit();

	}