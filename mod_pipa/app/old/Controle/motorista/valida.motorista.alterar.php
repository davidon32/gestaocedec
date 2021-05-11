<?php session_start();
print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
include_once '../include.php';

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais</title>
<link href="../../css/estilo.css" rel="stylesheet" type="text/css" />
</head>
<body style="width: 400px; height: 400px;">
	<?php

	//FuncaoBase::vd($_POST);




	$_conexao = new ConexaoMysql();

	$nome		= isset($_POST['nome']) ? strtoupper(utf8_decode($_POST['nome'])) : "";

	$endereco	= isset($_POST['endereco']) ? strtoupper(utf8_decode($_POST['endereco'])) : "";

	$bairro		= isset($_POST['bairro']) ? strtoupper(utf8_decode($_POST['bairro'])) : "";

	$cidade		= isset($_POST['cidade']) ? strtoupper(utf8_decode($_POST['cidade'])) : "";

	$email		= isset($_POST['email']) ? strtoupper(utf8_decode($_POST['email'])) : "";

	$cep		= isset($_POST['cep']) ? strtoupper(utf8_decode($_POST['cep'])) : "";

	$uf			= isset($_POST['uf']) ? strtoupper(utf8_decode($_POST['uf'])) : "";

	$tel		= isset($_POST['tel']) ? strtoupper(utf8_decode($_POST['tel'])) : "";

	$cel		= isset($_POST['cel']) ? strtoupper(utf8_decode($_POST['cel'])) : "";

	$cpf_cnpj	= isset($_POST['cpf_cnpj']) ? strtoupper(utf8_decode($_POST['cpf_cnpj'])) : "";

	$rg			= isset($_POST['rg']) ? strtoupper(utf8_decode($_POST['rg'])) : "";

	$orgao		= isset($_POST['orgao']) ? strtoupper(utf8_decode($_POST['orgao'])) : "";

	$inscr_est  = isset($_POST['inscr_est']) ? strtoupper(utf8_decode($_POST['inscr_est'])) : "";

	$pis_pasep  = isset($_POST['pis_pasep']) ? strtoupper(utf8_decode($_POST['pis_pasep'])) : "";

	$cnh		= isset($_POST['cnh']) ? strtoupper(utf8_decode($_POST['cnh'])) : "";

	$inscr_mun  = isset($_POST['inscr_mun']) ? strtoupper(utf8_decode($_POST['inscr_mun'])) : "";

	$banco		= isset($_POST['banco']) ? strtoupper(utf8_decode($_POST['banco'])) : "";

	$agencia	= isset($_POST['agencia']) ? strtoupper(utf8_decode($_POST['agencia'])) : "";

	$conta		= isset($_POST['conta']) ? strtoupper(utf8_decode($_POST['conta'])) : "";

	$tipo		= isset($_POST['tipo']) ? strtoupper(utf8_decode($_POST['tipo'])) : "";

	$mbanco		= isset($_POST['mbanco']) ? strtoupper(utf8_decode($_POST['mbanco'])) : "";

	$pessoa		= isset($_POST['pessoa']) ? strtoupper(utf8_decode($_POST['pessoa'])) : "";

	$nome_rep	= isset($_POST['nome_rep']) ? strtoupper(utf8_decode($_POST['nome_rep'])) : "";

	$cpf_rep	= isset($_POST['cpf_rep']) ? strtoupper(utf8_decode($_POST['cpf_rep'])) : "";

	$rg_rep		= isset($_POST['rg_rep']) ? strtoupper(utf8_decode($_POST['rg_rep'])) : "";

	$orgao_rep	= isset($_POST['orgao_rep']) ? strtoupper(utf8_decode($_POST['orgao_rep'])) : "";

	$est_civil_rep= isset($_POST['est_civil_rep']) ? strtoupper(utf8_decode($_POST['est_civil_rep'])) : "";

	$natural_rep= isset($_POST['natural_rep']) ? strtoupper(utf8_decode($_POST['natural_rep'])) : "";

	$pai		= isset($_POST['pai']) ? strtoupper(utf8_decode($_POST['pai'])) : "";

	$mae		= isset($_POST['mae']) ? strtoupper(utf8_decode($_POST['mae'])) : "";

	$placa		= isset($_POST['placa']) ? strtoupper(utf8_decode($_POST['placa'])) : "";

	#@ id do motorista
	$_id_motorista	= isset($_POST['id_mot']) ? strtoupper(utf8_decode($_POST['id_mot'])) : "";

	#@ data de nascimento
	$_dt_nasc	= isset($_POST['dt_nasc']) ? strtoupper(utf8_decode(DataMysql::dataForm($_POST['dt_nasc']))) : "";

	$_btn_enviar = isset($_POST['cadastrar']) ? strtoupper(utf8_decode($_POST['cadastrar'])) : "";


	//FuncaoBase::vd($_POST);

	$campo = false;

	if($nome == ""){

		$campo = true;

	}


	if(!$campo){

		$cadastro = Motorista::AlteraCadastroMotorista($nome, $endereco, $bairro, $cidade, $email, $cep, $uf, $tel, $cel,
				$cpf_cnpj, $rg, $orgao, $inscr_est, $pis_pasep, $cnh, $inscr_mun, $banco, $agencia,
				$conta, $tipo, $mbanco, $pessoa, $nome_rep, $cpf_rep, $rg_rep, $orgao_rep, $est_civil_rep, $natural_rep,
				$pai, $mae, $placa, $_id_motorista, $_dt_nasc);
			
		if($cadastro) {

			print "<script type='text/javascript'>";

			print "alert('Atualização Realizada com Sucesso !');";

			print "window.location.href = 'secao.php?secao=motorista&acao=buscar';";

			print "</script>";

		}
	}else{
		print "<script type='text/javascript'>";

		print "alert('Erro ao Cadastrar ! \n Algun Campo pode estar em Branco !');";

		print "history.back();";

		print "</script>";


	}
	?>


</body>
</html>
