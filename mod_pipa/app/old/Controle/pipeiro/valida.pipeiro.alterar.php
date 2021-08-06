<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais</title>
		<link href="../css/estilo.css" rel="stylesheet" type="text/css" />
	</head>
</html>
<?php

//FuncaoBase::vd($_POST);
	session_start();
	unset($_SESSION);

	include_once '../../include.php';
	
	$_conexao = new ConexaoMysql();

	$id_pipeiro = isset($_POST['id_pipeiro']) ? strtoupper(utf8_decode($_POST['id_pipeiro'])) : "";
	
	$nome  = isset($_POST['nome']) ? strtoupper(utf8_decode($_POST['nome'])) : "";
	
	$endereco  = isset($_POST['endereco']) ? strtoupper(utf8_decode($_POST['endereco'])): "";
	
	$bairro = isset($_POST['bairro']) ? strtoupper(utf8_decode($_POST['bairro'])): "";
	
	$cidade = isset($_POST['cidade']) ? strtoupper(utf8_decode($_POST['cidade'])): "";
  	
	$email = isset($_POST['email']) ? utf8_decode($_POST['email']): "";
  	
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
  	
	$inss = isset($_POST['inss']) ? strtoupper(utf8_decode($_POST['inss'])): "";
  	
	$inscr_mun = isset($_POST['inscr_mun']) ? strtoupper(utf8_decode($_POST['inscr_mun'])) : "";
  	
	$nit = isset($_POST['nit']) ? strtoupper(utf8_decode($_POST['nit'])) : "";
  	
	$mot = isset($_POST['repres']) ? utf8_decode($_POST['repres']) : "";
  	
	$nome_mot = isset($_POST['rep']) ? strtoupper(utf8_decode($_POST['rep'])) : "";
  	
	$nac_mot = isset($_POST['nac']) ? strtoupper(utf8_decode($_POST['nac'])) : "";
  	
	$est_mot = isset($_POST['est']) ? strtoupper(utf8_decode($_POST['est'])) : "";
  	
	$prof_mot = isset($_POST['profrep']) ? strtoupper(utf8_decode($_POST['profrep'])) : "";
  	
	$rg_mot = isset($_POST['rgrep']) ? strtoupper(utf8_decode($_POST['rgrep'])) : "";
  	
	$cpf_mot = isset($_POST['cpfrep']) ? strtoupper(utf8_decode($_POST['cpfrep'])) : "";
  	
	$placa = isset($_POST['placa']) ? strtoupper(utf8_decode($_POST['placa'])) : "";
  	
	$modelo = isset($_POST['renavam']) ? strtoupper(utf8_decode($_POST['renavam'])) : "";
  	
	$marca = isset($_POST['marca']) ? strtoupper(utf8_decode($_POST['marca'])): "";
  	
	$fabric = isset($_POST['fabric']) ? strtoupper(utf8_decode($_POST['fabric'])) : "";
  	
	$chassi = isset($_POST['chassi']) ? strtoupper(utf8_decode($_POST['chassi'])) : "";
  	
	$renavam = isset($_POST['renavam']) ? strtoupper(utf8_decode($_POST['renavam'])) : "";
  	
	$capacidade = isset($_POST['capacidade']) ? strtoupper(utf8_decode($_POST['capacidade'])) : "";
  	
	$rota = isset($_POST['rota']) ? strtoupper(utf8_decode($_POST['rota'])) : "";
  	
	$municipio_rota = isset($_POST['mrota']) ? strtoupper(utf8_decode($_POST['mrota'])) : "";
  	
	$banco = isset($_POST['banco']) ? strtoupper(utf8_decode($_POST['banco'])) : "";
  	
	$agencia = isset($_POST['agencia']) ? strtoupper(utf8_decode($_POST['agencia'])) : "";
  	
	$conta = isset($_POST['conta']) ? strtoupper(utf8_decode($_POST['conta'])) : "";
  	
	$tipo = isset($_POST['tipo']) ? strtoupper(utf8_decode($_POST['tipo'])) : "";
  	
	$cpf_cnpj_banco = isset($_POST['cpf_cnpj_banco']) ? strtoupper(utf8_decode($_POST['cpf_cnpj_banco'])) : "";
  	
	$tipo = isset($_POST['tipo']) ? strtoupper(utf8_decode($_POST['tipo'])) : ""; 
  	
	$_btn_enviar = isset($_POST['cadastrar']) ? strtoupper(utf8_decode($_POST['cadastrar'])) : "";
  	
  	/* numero carteira de habilitacao do pipeiro*/
	$_cnhp = isset($_POST['cnh_p']) ? strtoupper(utf8_decode($_POST['cnh_p'])) : "";
  	
  	/* municipio para domicilio bancario */
	$_mbanco = isset($_POST['mbanco']) ? strtoupper(utf8_decode($_POST['mbanco'])) : "";
  	
  	/* tipo de pessoa */
	$_pessoa = isset($_POST['pessoa']) ? utf8_decode($_POST['pessoa']) : "";
	
	# orgao expedor CI motorista
	$_orgao_mot = isset($_POST['orgao_mot']) ? strtoupper(utf8_decode($_POST['orgao_mot'])) : "";
	
	# numero contrato 
	$_n_contrato = isset($_POST['n_contrato']) ? strtoupper(utf8_decode($_POST['n_contrato'])) : "";
	
	
	
	
  	//if($_SESSION['modo']){
  		
  	//	FuncaoBase::vd($_POST);
  		
  //	}
  	
	
	function varre(){
		
		foreach ($_POST as $key => $value) {
			
			if($value == ""){
				
				return false;
							
			}else{
				
				return true;
			}
			
		}
	}
	
	if(varre()){
		
		$cadastro = Pipeiro::AlteraCadastroPipeiro($nome,
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
													 $mot,
													 $nome_mot,
													 $nac_mot,
													 $est_mot,
													 $prof_mot,
													 $rg_mot,
													 $cpf_mot,
													 $placa,
													 $modelo,
													 $marca,
													 $fabric,
													 $chassi,
													 $renavam,
													 $capacidade,
													 $rota,
													 $municipio_rota,
													 $banco,
													 $agencia,
													 $conta,
													 $tipo,
													 $cpf_cnpj_banco,
													 $id_pipeiro,
													 $_cnhp,
													 $_mbanco,
													 $_pessoa,
													 $_orgao_mot,
													 $_n_contrato);
			
			if(mysql_affected_rows() == 1) {
				
				
				print '	<script>
							alert("Alteração Realizada com Sucesso !");
			   		</script>';
			   			print '<div class="volta"><a href="sc.menu.php"> Voltar </a></div>';
			
			}else{
				print '	<script>
							alert("Erro ao Atualizar Cadastro !");
							history.back();
					   	</script>';
						
				
			}
	}
		
		
	
	
	
	
	

?>