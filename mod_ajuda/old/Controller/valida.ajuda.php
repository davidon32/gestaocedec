<?php session_start();
	header("Cache-Control: no-cache, must-revalidate");
	include_once '../../include.php';

	$_conexao = new ConexaoMysql();

	$_login = new Login();

	$_login->logado();
	
	$_pagamento = new Pagamento();

	$_transferencia = new TransferenciaMaterial();

	$_funcaBase = new FuncaoBase();

	$_saldo = new ControleSaldo();
    
    $_liberacao = new Liberacao();
    

	if(isset($_SESSION['cesta'])){

		$_material = $_SESSION['cesta'];

	}

	
	if(true){

	###################################################  Receber   ############################################
	}elseif((isset($_GET['secao'])) && ($_GET['secao'] == 'receber')){

        
		
	###################################################  Cancelar Transferencia   ############################################
 	}elseif((isset($_GET['secao'])) && ($_GET['secao'] == "transferencia") && (isset($_GET['acao'])) && ($_GET['acao'] == "cancela")) {

 		

  		
  		
 	######################################################### cancelar liberacao ######################################	
  	
 	}elseif((isset($_GET['secao'])) && ($_GET['secao'] == "liberacao") && (isset($_GET['acao'])) && ($_GET['acao'] == "cancelar")) {


 	
 	}


 ?>