<?php session_start();
print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
include_once '../include.php';

$_login = new Login();

$_login->logado();

$_conexao = new ConexaoMysql();

$_funcaoBase = new FuncaoBase();

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais</title>
<link href="../css/estilo.css" rel="stylesheet" type="text/css" />
</head>
</html>
<?php

//FuncaoBase::vd($_POST);

$_id_motorista   = isset($_POST['id_motorista'])    ? $_POST['id_motorista'] : "";

$_id_caminhao    = isset($_POST['id_caminhao'])     ? $_POST['id_caminhao'] : "";

$_id_rota        = isset($_POST['id_rota'])         ? $_POST['id_rota'] : "";

$_num_contrato   = isset($_POST['n_contrato'])      ? strtoupper(utf8_decode($_POST['n_contrato'])) : "";

$_data_contrato  = isset($_POST['dt_contrato'])     ? strtoupper(utf8_decode($_POST['dt_contrato'])) : "";

$_situacao       = isset($_POST['situacao'])        ? strtoupper(utf8_decode($_POST['situacao'])) : "";

$_obs            = isset($_POST['obs'])             ? strtoupper(utf8_decode($_POST['obs'])) : "";

$_txt_ano        = isset($_POST['txt_ano'])         ? strtoupper(utf8_decode($_POST['txt_ano'])) : "";

$_txt_num_empenho= isset($_POST['txt_num_empenho']) ? strtoupper(utf8_decode($_POST['txt_num_empenho'])) : "";

$_txt_dt_empenho = isset($_POST['txt_dt_empenho'])  ? $_POST['txt_dt_empenho'] : "00-00-0000";

//print $_POST['txt_dt_empenho'];

if($_POST['txt_dt_empenho'] == "") {
    
$_txt_dt_empenho = NULL;     
    
}

$campos = array("Motorista"      =>$_id_motorista,
				"Caminhao"       =>$_id_caminhao,
				"Rota"           =>$_id_rota,
				"Numero Contrato"=>$_num_contrato,
				"Data Contrato"  =>$_data_contrato,
				"Situação"       =>$_situacao);

if($_funcaoBase->campoBranco($campos)){

	if(Contrato::cadastraContrato($_num_contrato,
								  $_id_motorista,
								  DataMysql::dataForm($_data_contrato),
								  $_situacao,
								  $_obs,
								  $_id_caminhao,
								  $_id_rota,
								  $_txt_ano,
								  DataMysql::dataForm($_txt_dt_empenho),
								  $_txt_num_empenho)){
		
		
		//$_funcaoBase->vifs('volta', '../secao.php?secao=contrato&acao=cadastrar');
		
		//$_funcaoBase->vifs('imprimir');
		
		//$_funcaoBase->vifs('fechar');
		
		$_funcaoBase->vifs('sucesso', 'secao.php?secao=contrato&acao=cadastrar');
		

	}

}

?>
