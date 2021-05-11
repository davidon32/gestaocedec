<?php session_start();
	include_once '../include.php';

$_conexao = new ConexaoMysql();

$_contrato = new Contrato();

$_funcaoBase = new FuncaoBase();

$_id_contrato  = isset($_POST['id_contrato']) ? $_POST['id_contrato'] : null;
$_num_contrato = isset($_POST['num_contrato']) ? $_POST['num_contrato'] : null;
$_dt_rescisao  = isset($_POST['dt_rescisao']) ? $_POST['dt_rescisao'] : null;

$_dados = $_contrato->buscaContratoID($_id_contrato);

$_id_motorista = $_dados['id_motorista'];
$_id_caminhao  = $_dados['id_caminhao'];
$_id_rota      = $_dados['id_rota'];

if(Contrato::rescisaoContrato($_id_contrato,
							  $_id_motorista,
							  $_id_caminhao,
							  $_id_rota,
							  DataMysql::dataForm($_dt_rescisao))) {
	
									$_funcaoBase->vifs('sucesso', 'secao.php?secao=contrato&acao=rescindir');
	 
					  		  }

?>

