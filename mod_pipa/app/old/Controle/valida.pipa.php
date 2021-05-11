<?php session_start();
	include_once '../../include.php';

	$_conexao = new ConexaoMysql();
	
$_funcaoBase = new FuncaoBase();

$_caminhao = new Caminhao();

$_operacao = isset($_GET['secao']) ? $_GET['secao'] : "";


if($_operacao == 'alterarCaminhao'){

	//var_dump($_POST);

	$_txt_id_caminhao = isset($_POST['txt_id_caminhao']) ? $_POST['txt_id_caminhao'] : "";
	$_txt_placa       = isset($_POST['txt_placa'])       ? $_POST['txt_placa']       : "";
	$_txt_modelo      = isset($_POST['txt_modelo'])      ? $_POST['txt_modelo']      : "";
	$_txt_marca       = isset($_POST['txt_marca'])       ? $_POST['txt_marca']       : "";
	$_txt_fabricacao  = isset($_POST['txt_fabricacao'])  ? $_POST['txt_fabricacao']  : "";
	$_txt_chassi      = isset($_POST['txt_chassi'])      ? $_POST['txt_chassi']      : "";
	$_txt_renavam     = isset($_POST['txt_renavam'])     ? $_POST['txt_renavam']     : "";
	$_txt_capacidade  = isset($_POST['txt_capacidade'])  ? $_POST['txt_capacidade']  : "";
	$_btn_enviar      = isset($_POST['btn_enviar'])      ? $_POST['btn_enviar']      : "";

	$campos = array("Placa"  =>$_txt_placa,
			"Modelo"    =>$_txt_modelo,
			"Marca"     =>$_txt_marca,
			"Ano"       =>$_txt_fabricacao,
			"Chassi"    =>$_txt_chassi,
			"Renavam"   =>$_txt_renavam,
			"Capacidade"=>$_txt_capacidade);
	
	if($_funcaoBase->campoBranco($campos)){
		
		if($_caminhao->AlteraCaminhao($_txt_id_caminhao,
									  $_txt_placa,
									  $_txt_modelo,
									  $_txt_marca,
									  $_txt_fabricacao,
									  $_txt_chassi,
									  $_txt_renavam,
									  $_txt_capacidade)){
			
			print "<script type='text/javascript'>";
			
			print "alert('Atualizacao Realizada com Sucesso !');";
			
			print "window.location.href='../secao.php?secao=caminhao&acao=buscar';";
			
			print "</script>";
			
			
		}
		
	}

}?>