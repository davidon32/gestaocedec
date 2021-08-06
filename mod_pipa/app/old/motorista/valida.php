<?php session_start();

include_once PATH.'/include.php';

?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais</title>
		<link href="<?php print SISTEMA;?>/css/bootstrap.css" rel="stylesheet" media="screen">
        <link href="<?php print SISTEMA;?>/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
	</head>
	<body>
	</body>
</html>
<?php

	
	$_funcaoBase = new FuncaoBase();
    
    $_id        = isset($_POST['id_mot']) ? $_POST['id_mot'] : "";
	
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
	
	$dtNasc		= isset($_POST['dt_nasc']) ? strtoupper(utf8_decode(DataMysql::dataForm($_POST['dt_nasc']))) : "";

	$btnEnviar = isset($_POST['cadastrar']) ? true : false;
    
    # grava novo registro
if($_id == "") {
    
 //var_dump($_POST);
	$campo = array("Nome" =>$nome,
					"CPF"=>$cpf_cnpj,
                    "Data Nascimento"=>$dtNasc);
    
	if($btnEnviar) {
   
       if($_funcaoBase->campoBranco($campo)){
           
           
           if(!Motorista::verificaMotoristaCadastrado($cpf_cnpj, $placa)) {

                $cadastro = Motorista::cadastroMotorista($nome, $endereco, $bairro, $cidade, $email, $cep, $uf, $tel, $cel,
                            $cpf_cnpj, $rg, $orgao, $inscr_est, $pis_pasep, $cnh, $inscr_mun, $banco, $agencia,
                            $conta, $tipo, $mbanco, $pessoa, $nome_rep, $cpf_rep, $rg_rep, $orgao_rep, $est_civil_rep, $natural_rep,
                            $pai, $mae, $placa, $dtNasc);
                
                    if($cadastro) {
        
                        print "<script type='text/javascript'>";
                        
                        print "alert('Cadastro Realizado com Sucesso !');";
                        
                        print "window.location.href='index.php?token=".hash('sha256', md5(VERSAO)."-".time())."&ac=&modulo=pipa&secao=motorista&acao=cadastro';";
                        
                        print "</script>";
                        
                    }else {
                     
                        print "erro";
                        
                    }
            }else {
                
                print "<script type='text/javascript'>";
                        
                print "alert('Motorista já Cadastrado !');";
                        
                print "window.location.href='index.php?token=".hash('sha256', md5(VERSAO)."-".time())."&ac=&modulo=pipa&secao=motorista&acao=cadastro';";
                        
                print "</script>";
            
                        
                    
            }
            
             
        
        }
	
	
	}else{
		
		print "<script type='text/javascript'>";
		
		print "alert('Erro ao Cadastrar ! \n Algun Campo Obrigaório esta em Branco !');";
		
		print "history.back();";
		
		print "</script>";
				
		
	}
	
# alterar registro 
}else if(is_numeric($_id)){
    
    print "<span class='alert alert-error'>em Construção !</span>";
    
    
}
		
	
	
	
	
	

?>