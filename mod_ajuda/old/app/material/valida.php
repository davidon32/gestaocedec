<?php session_start();
print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
include_once PATH.'/include.php';

/* ****************************************************************************************
 *   Orgão 		 : Coordenadoria Estadual de Defesa Civil do Estado de Minas Gerais
*	Sistema      : Sistema de Gest�o de Ajuda Humanitária
*
*	Autor        :  Demetrio Silva Passos
*	Função       :  Validar Cadastro de Materiais
*
*******************************************************************************************/

$_conexao = new ConexaoMysql();

Login::Logado();

//FuncaoBase::vd($_SESSION);
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo TITULO; ?></title>
<link href="/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="/js/funcaobase.js"></script>
</head>

<body>

<?php

	//var_dump($_POST);

	$_id_produto     = isset($_POST['id_produto'])     ? $_POST['id_produto']     : "";
	$_txtDtEntrada   = isset($_POST['txtDtEntrada'])   ? $_POST['txtDtEntrada']   : "";
	$_txtOrigem      = isset($_POST['txtOrigem'])      ? $_POST['txtOrigem']: "";
	$_txtValidade    = isset($_POST['txtValidade'])    ? $_POST['txtValidade']    : "";
	$_txtQtd         = isset($_POST['txtQtd'])         ? $_POST['txtQtd']         : "";
	$_id_deposito    = isset($_POST['id_deposito'])    ? $_POST['id_deposito']    : "";
	$_txarObs        = isset($_POST['txarObs'])        ? utf8_decode($_POST['txarObs'])        : "";
	$_btnCadMaterial = isset($_POST['btnCadMaterial']) ? true 					  : "";


	$campos = array("Produto"        => $_id_produto,    
					"Data Entrada"   => $_txtDtEntrada,
					"Origem Material"=> $_txtOrigem,     
					"Quantidade"     => $_txtQtd,
					"Deposito"       => $_id_deposito);       
	
	if ($_btnCadMaterial){
		
			if(FuncaoBase::CampoBranco($campos)){
					
				if(Material::Cadastrar($_id_produto,
										Unidade::PegaNomeId($_id_produto),
										DataMysql::dataForm($_txtDtEntrada),
										$_txtOrigem,
										$_txarObs,
										$_txtQtd,
										Deposito::PegaNomeDeposito($_id_deposito),
										DataMysql::dataForm($_txtValidade))) {

					Material::atualizarSaldo($_id_produto,$_id_deposito,$_txtQtd);
                    
                    Log::GravaLog("Cadastro de material id_produto:".$_id_produto." qtd:".$_txtQtd." dataEntrada: ".$_txtDtEntrada." validade: ".$_txtValidade. " depDestino:".$_id_deposito, "aju_log");
							
					print "<script type=\"text/javascript\">";
					
					print "alert('Cadastro realizado com Sucesso !');";

					print "window.location.href = 'index.php?token=".hash('sha256', md5(VERSAO)."-".time())."&ac=&modulo=ajuda&secao=material&acao=cadastro';";
					
					print "</script>";
	
				}
	
			}
			
	}
?>