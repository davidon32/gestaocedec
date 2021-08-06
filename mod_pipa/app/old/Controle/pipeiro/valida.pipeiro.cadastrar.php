<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais</title>
		<link href="../css/estilo.css" rel="stylesheet" type="text/css" />
	</head>
</html>
<?php

//FuncaoBase::vd($_POST);

	include_once '../../include.php';
	
	$_conexao = new ConexaoMysql();
	
	
	/* nome do pipeiro */ 
	$nome  = isset($_POST['nome']) ? strtoupper(utf8_decode($_POST['nome'])) : "";
	/* endereco do pipeiro */
	$endereco  = isset($_POST['endereco']) ? strtoupper(utf8_decode($_POST['endereco'])) : "";
	/* bairro do pipeiro */
	$bairro = isset($_POST['bairro']) ? strtoupper(utf8_decode($_POST['bairro'])) : "";
	/* cidade do pipeiro */
	$cidade = isset($_POST['cidade']) ? strtoupper(utf8_decode($_POST['cidade'])) : "";
  	/* email do pipeiro */
	$email = isset($_POST['email']) ? utf8_decode($_POST['email']) : "";
  	/* cep do pipeiro */
	$cep  = isset($_POST['cep']) ? strtoupper(utf8_decode($_POST['cep'])) : "";
  	
	$uf = isset($_POST['uf']) ? strtoupper(utf8_decode($_POST['uf'])) : "";
  	
	$tel = isset($_POST['tel']) ? strtoupper(utf8_decode($_POST['tel'])) : "";
  	
	$cel = isset($_POST['cel']) ? strtoupper(utf8_decode($_POST['cel'])) : "";
  	
	$cpf_cnpj = isset($_POST['cpf_cnpj']) ? strtoupper(utf8_decode($_POST['cpf_cnpj'])) : "";
  	
	$rg = isset($_POST['rg']) ? strtoupper(utf8_decode($_POST['rg'])) : "";
  	
	$orgao = isset($_POST['orgao']) ? strtoupper(utf8_decode($_POST['orgao'])) : "";
	
	$inscr_est = isset($_POST['inscr_est']) ? strtoupper(utf8_decode($_POST['inscr_est'])) : "";
  	
	$pis_pasep = isset($_POST['pis_pasep']) ? strtoupper(utf8_decode($_POST['pis_pasep'])) : "";
  	
	$cnh = isset($_POST['cnh']) ? strtoupper(utf8_decode($_POST['cnh'])) : "";
  	
	$inss = isset($_POST['inss']) ? strtoupper(utf8_decode($_POST['inss'])) : "";
  	
  	$inscr_mun = isset($_POST['inscr_mun']) ? strtoupper(utf8_decode($_POST['inscr_mun'])): "";
  	
  	$nit = isset($_POST['nit']) ? strtoupper(utf8_decode($_POST['nit'])) : "";
  	
	$nome_rep = isset($_POST['nome_r']) ? strtoupper(utf8_decode($_POST['nome_r'])) : "";
	
	$cpf_rep = isset($_POST['cpf_r']) ? strtoupper(utf8_decode($_POST['cpf_r'])) : "";
	
	$rg_rep = isset($_POST['rg_r']) ? strtoupper(utf8_decode($_POST['rg_r'])) : "";
	
	$orgao_rep = isset($_POST['orgao_r']) ? strtoupper(utf8_decode($_POST['orgao_r'])) : "";
	
	$est_civil_rep = isset($_POST['est_r']) ? strtoupper(utf8_decode($_POST['est_r'])) : "";
	
	$natural_rep = isset($_POST['natural_r']) ? strtoupper(utf8_decode($_POST['natural_r'])) : ""; 
  	 	
  	$banco = isset($_POST['banco']) ? strtoupper(utf8_decode($_POST['banco'])) : "";
  	
  	$agencia = isset($_POST['agencia']) ? strtoupper(utf8_decode($_POST['agencia'])) : "";
  	
  	$conta = isset($_POST['conta']) ? strtoupper(utf8_decode($_POST['conta'])) : "";
  	
  	$pessoa = isset($_POST['pessoa']) ? utf8_decode($_POST['pessoa']) : "";
  	
  	$cpf_cnpj_banco = isset($_POST['cpf_cnpj_banco']) ? strtoupper(utf8_decode($_POST['cpf_cnpj_banco'])) : "";
  	
  	$tipo = isset($_POST['tipo']) ? strtoupper(utf8_decode($_POST['tipo'])) : ""; 
  	
  	$_btn_enviar = isset($_POST['cadastrar']) ? strtoupper(utf8_decode($_POST['cadastrar'])) : "";
  
  	/* municipio para domicilio bancario */
  	$_mbanco = isset($_POST['mbanco']) ? strtoupper(utf8_decode($_POST['mbanco'])) : "";
  	
  	#$_orgao_mot = isset($_POST['orgao_mot']) ? strtoupper(utf8_decode($_POST['orgao_mot'])) : "";
	
	FuncaoBase::vd($_POST);
	
	/*
	if($mot == 1) {
		
		$nome_mot = $nome;
		$rg_mot = $rg;
		$cpf_mot = $cpf_cnpj;

	}
	
	*/
	$campo = false;
	
	if($nome == ""){
		
		$campo = true;
		
	}/*elseif ($endereco == ""){
		
		$campo = true;
	}
	elseif ($bairro == ""){
	
		$campo = true;
	}
	elseif ($cidade == ""){
	
		$campo = true;
	}
	elseif ($email == ""){
	
		$campo = true;
	}
	elseif ($cep == ""){
	
		$campo = true;
	}

	elseif ($uf == ""){
	
		$campo = true;
	}
	elseif ($tel == ""){
	
		$campo = true;
	}
	elseif ($cel == ""){
	
		$campo = true;
	}*/
	elseif ($cpf_cnpj == ""){
	
		$campo = true;
	}/*
	elseif ($rg == ""){
	
		$campo = true;
	}
	elseif ($orgao == ""){
	
		$campo = true;
	}
	elseif ($inscr_est == ""){
	
		$campo = true;
	}
	elseif ($pis_pasep == ""){
	
		$campo = true;
	}
	elseif ($cnh == ""){
	
		$campo = true;
	}
	elseif ($inss == ""){
	
		$campo = true;
	}
	elseif ($inscr_mun == ""){
	
		$campo = true;
	}
	elseif ($nit == ""){
	
		$campo = true;
	}
	elseif ($mot == ""){
	
		$campo = true;
	}
	elseif ($nome_mot == ""){
	
		$campo = true;
	}
	elseif ($nac_mot == ""){
	
		$campo = true;
	}
	elseif ($est_mot == ""){
	
		$campo = true;
	}
	elseif ($prof_mot == ""){
	
		$campo = true;
	}
	elseif ($rg_mot == ""){
	
		$campo = true;
	}
	elseif ($cpf_mot == ""){
	
		$campo = true;
	}
	elseif ($placa == ""){
	
		$campo = true;
	}
	elseif ($modelo == ""){
	
		$campo = true;
	}
	elseif ($marca == ""){
	
		$campo = true;
	}
	elseif ($fabric == ""){
	
		$campo = true;
	}
	elseif ($chassi == ""){
	
		$campo = true;
	}
	elseif ($renavam == ""){
	
		$campo = true;
	}
	elseif ($capacidade == ""){
	
		$campo = true;
	}
	elseif ($rota == ""){
	
		$campo = true;
	}
	elseif ($municipio_rota == ""){
	
		$campo = true;
	}
	elseif ($banco == ""){
	
		$campo = true;
	}
	elseif ($agencia == ""){
	
		$campo = true;
	}
	elseif ($conta == ""){
	
		$campo = true;
	}
	elseif ($pessoa == ""){
	
		$campo = true;
	}
	elseif ($cpf_cnpj_banco == ""){
	
		$campo = true;
	}
	elseif ($tipo == ""){
	
		$campo = true;
	}
	elseif ($_cnhp == ""){
	
		$campo = true;
	}
	elseif ($_mbanco == ""){
	
		$campo = true;
	}
	elseif ($_orgao_mot == ""){
		
		$campo = true;
	}
	*/
	
	if(!$campo){
		
		$cadastro = Pipeiro::CadastroPipeiro($nome,
				 $endereco,
				 $bairro,
				 $cidade,
				 $email,
				 $cep,
				 $uf,
				 $tel,
				 $cel,
				 $cpf_cnpj,
				 $rg,
				 $orgao,
				 $inscr_est,
				 $pis_pasep,
				 $cnh,
				 $inss,
				 $inscr_mun,
				 $nit,
				 $banco,
				 $agencia,
				 $conta,
				 $tipo,
				 $cpf_cnpj_banco,
				 $_mbanco,
				 $pessoa,
				 $nome_rep,
				 $cpf_rep,
				 $rg_rep,
				 $orgao_rep,
				 $est_civil_rep,
				 $natural_rep);
			
			if($cadastro) {
		
				print '	<script>
							alert("Cadastro Realizado com Sucesso !");
			   		</script>';
			   		print '<div class="volta"><br /><br /><a href="sc.cadastro.pipeiro.php"><img src="../imagens/btn_volta.png"></a></div>'; //header("Location:sc.cadastro.pipeiro.php");
			}
	}else{
		print '	<script>
					alert("Erro ao Cadastrar ! \n Algun Campo pode estar em Branco !");
					history.back();
			   	</script>';
				
		
	}
		
		
	
	
	
	
	

?>