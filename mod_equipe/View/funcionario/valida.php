<?php $id_session = session_id();
    if(empty($id_session)) session_start(); 
print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
include_once PATH.'/include.php';

$con = Conexao::getInstance();

//Login::logado();

$_base = new FuncaoBase();

?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php print TITULO;?></title>
<link href="<?php print SISTEMA;?>/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="<?php print SISTEMA;?>/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
</head>
<body>

<?php

$_id = isset($_GET['id']) ? (int)$_GET['id'] : false;

    $_masp         = isset($_POST['txt_masp'])          ? $_POST['txt_masp']                               : "";
    $_nome         = isset($_POST['txt_nome'])          ? FuncaoBase::maiusculoAcento($_POST['txt_nome'])  : "";
    $_posto        = isset($_POST['txt_posto'])         ? FuncaoBase::maiusculoAcento($_POST['txt_posto']) : "";
    $_secao        = isset($_POST['txt_secao'])         ? $_POST['txt_secao']                              : "";
    $_quinquenio   = isset($_POST['txt_quinquenio'])    ? $_POST['txt_quinquenio']                         : "";
    $_funcao       = isset($_POST['txt_funcao'])        ? FuncaoBase::maiusculoAcento($_POST['txt_funcao']): "";
    $_desc_funcao  = isset($_POST['txt_descr_funcao'])  ? FuncaoBase::maiusculoAcento($_POST['txt_descr_funcao']) : "";
    $_endereco     = isset($_POST['txt_endereco'])      ? FuncaoBase::maiusculoAcento($_POST['txt_endereco'])     : "";
    $_bairro       = isset($_POST['txt_bairro'])        ? FuncaoBase::maiusculoAcento($_POST['txt_bairro'])       : "";
    $_id_municipio = isset($_POST['id_municipio'])      ? $_POST['id_municipio']                        : "";
    $_telefone     = isset($_POST['txt_tel'])           ? $_POST['txt_tel']                             : "";
    $_celular      = isset($_POST['txt_cel'])           ? $_POST['txt_cel']                             : "";
    $_dt_nascimento= isset($_POST['txt_dt_nascimento']) ? $_POST['txt_dt_nascimento']                   : "";
    $_curso        = isset($_POST['txt_curso'])         ? FuncaoBase::maiusculoAcento($_POST['txt_curso'])              : "";
    $_email        = isset($_POST['txt_email'])         ? strtolower($_POST['txt_email'])               : "";
    $_email2       = isset($_POST['txt_email2'])        ? strtolower($_POST['txt_email2'])              : "-";
    $_cpf          = isset($_POST['txt_cpf'])           ? $_POST['txt_cpf']                 : "-";
    $_orgao        = isset($_POST['txt_orgao'])         ? $_POST['txt_orgao']                           : "";
    $_btn_envia    = isset($_POST['btn_envia'])         ? true                                          : "";
    $_adt          = isset($_POST['ck_adt'])            ? $_POST['ck_adt']                              : "";
    $_ade          = isset($_POST['ck_ade'])            ? $_POST['ck_ade']                              : "";
    $_dad          = isset($_POST['ck_dad'])            ? $_POST['ck_dad']                              : "";
    $_ci           = isset($_POST['txt_ci'])            ? $_POST['txt_ci']                              : "";
    $_situacao     = isset($_POST['selSituacao'])       ? $_POST['selSituacao']                         : "";
    $_upCad        = isset($_POST['txtOpcaoAtualizarLogin'])? $_POST['txtOpcaoAtualizarLogin']          : "";
    $_usuCa        = isset($_POST['txt_usu_ca'])        ? FuncaoBase::maiusculoAcento($_POST['txt_usu_ca'])	: "";
     
    /* trata abono */
    
    
    $tipoAbono = "";
    
       if(($_adt == "") && ($_ade == "") && ($_dad == "")){
           
         $tipoAbono = "-";
    
       } else if(($_adt == "") && ($_ade == "")){
           
          $tipoAbono = $_dad; 
           
       }else if(($_adt == "") && ($_dad == "")){
          
          $tipoAbono = $_ade;
           
       }else if(($_ade == "") && ($_dad == "")) {
          $tipoAbono = $_adt;
           
       }

if($_btn_envia){

	# cadastro de funcionario
	if(!$_id) {
	
		if(strlen($_email) == 0) {
	
	    	$_email = 'naotememail@nada.com.br';	
			
			} 
	
			/*if(FuncaoBase::validarEmail($_email)) {*/
			if(true) {
	
	            $campos = array('Matricula'=> $_masp,
	                            'Nome'=> $_nome,
	                            'Endereco'=> $_endereco,
	                            'Bairro'=> $_bairro,
	                            'Municipio'=> $_id_municipio,
	                            'Telefone'=> $_telefone,
	                            'Celular'=> $_celular,
	                            'Posto'=> $_posto,
	                            'Secao'=> $_secao,
	                            'Funcao'=> $_funcao,
	                            'Descricao Funcao'=> utf8_decode($_desc_funcao),
	                            'Quinquenio'=> $_quinquenio,
	                            'Data Nascimento'=> DataMysql::dataForm($_dt_nascimento),
	                            'Curso'=> $_curso,
	                            'Email'=> $_email,
	                            'Email2'=> $_email2,
	                            'Orgão'=> $_orgao,
	                            'CPF'=> $_cpf, 
	                            'CI'=> $_ci,
	            				'Usuario CA'=>$_usuCa);  
	            
				if(FuncaoBase::campoBranco($campos)){
					
					//var_dump($campos);
	
					$result = EquipeFuncionario::CadastrarFuncionario($_masp,
							$_nome,
							$_endereco,
							$_bairro,
							$_id_municipio,
							$_telefone,
							$_celular,
							$_posto,
							$_secao,
							$_funcao,
							$_desc_funcao,
							$_quinquenio,
							DataMysql::dataForm($_dt_nascimento),
							$_curso,
							$_email,
							$_email2,
							$_orgao,
							$_cpf,
							$tipoAbono,
							$_ci);
					
					 if($result['result']) {
	                                                    	
	                   // Adicionar permissão para Padrão 
						$_usuario_classe = new Usuario();
						
						$_usuario_classe->CadastraUsuarioCedec("1",
																$_nome,
																"1a9686a9a911d36609e50c31e79d0e0e",
																$_email,
																"3",
																"1",
																$_usuCa,
																"0",
																"1",
																"0",
																"0",
																"1",
																"0",
																"0",
																"0",
																"1",
																$_cpf,
																$result['lastId'],
																"0");
						
	
						$_usuario_classe->CadastrarPermissaoPipa($_usuCa, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

						$_usuario_classe->CadastrarPermissaoCce($_usuCa, 0, 0, 0, 0, 0, 1, 1); 
						
						// permissao Modulo cedec
						//$_usuario_classe->CadastrarPermissaoCedec($_upCad, 0, 1, 0, 0, 1, 0, 1, 0, 0);
	                                                    	

						print "<script type='text/javascript'>";
	
						print "alert('Cadastro Realizado com Sucesso !');";
						
						print "window.location.href ='index.php?token=".hash('sha256', md5(VERSAO)."-".time())."&ac=&modulo=equipe&secao=funcionario&acao=cadastro';";
	
						print "</script>";
	
	
					    }else {
					    	
					    	
					    } 
				}
			}else {
	
				print "<script type='text/javascript'>";
	
				print "alert('email invalido !');";
	
				print "history.back();";
	
				print "</script>";
	
	
			}
	# alterar functionario 
	} else if(is_int($_id)) {
	    
	    //echo 'alterar';
	    
	    $_id_funcionario = isset($_POST['txt_id_funcionario'])? $_POST['txt_id_funcionario']: ""; 
	    
	        
	    
	            $campos = array('Masp'=>$_masp,
	                            'Nome' => $_nome,
	                            'Endereco' => $_endereco,
	                            'Bairro' => $_bairro,
	                            'Municipio' => $_id_municipio,
	                            'Telefone' => $_telefone,
	                            'Celular' => $_celular,
	                            'Posto' => $_posto,
	                            'Secao' => $_secao,
	                            'Funcao' => $_funcao,
	                            'Descricao Funcao' => utf8_decode($_desc_funcao),
	                            'Data Nasc' =>DataMysql::dataForm($_dt_nascimento),
	                            'Curso' => $_curso,
	                            'Email 1' => $_email,
	                            'Email 2' => $_email2,
	                            'Órgao' => $_orgao,
	                            'CPF' => $_cpf,
	                            'CI' => $_ci);    
	
	    if(FuncaoBase::campoBranco($campos)){
	
	        if(EquipeFuncionario::AlterarCadastrarFuncionario($_id,
	                                                    $_masp,
	                                                    $_nome,
	                                                    utf8_decode($_endereco),
	                                                    $_bairro,
	                                                    utf8_decode($_id_municipio),
	                                                    $_telefone,
	                                                    $_celular,
	                                                    $_posto,
	                                                    $_secao,
	                                                    utf8_decode($_funcao),
	                                                    utf8_decode($_desc_funcao),
	                                                    $_quinquenio,
	                                                    DataMysql::dataForm($_dt_nascimento),
	                                                    $_curso,
	                                                    $_email,
	                                                    $_email2,
	                                                    $_situacao,
	                                                    $_orgao,
	                                                    $_cpf,
	                                                    $tipoAbono,
	                                                    $_ci)) {
	            
	            if($_upCad == "u") {
	            
	                print "<script type='text/javascript'>";
	
	                print "alert('Cadastro Atualizado com Sucesso !');";
	                    
	                print "window.location.href = '/index.php?secao=cedec';";              
	                
	                print "</script>";
	                
	            }else {
	                
	                print "<script type='text/javascript'>";
	
	                print "alert('Cadastro Atualizado com Sucesso !');";
	                    
	                print "window.location.href = 'index.php?token=".hash('sha256', md5(VERSAO)."-".time())."&ac=&modulo=equipe&secao=funcionario&acao=buscar';";  
	                
	                print "</script>";
	                
	            }
	
	        }
	    }
	  
	}
}?>

<script src="<?php print SISTEMA;?>/js/jquery.js"></script>
<script src="<?php print SISTEMA;?>/js/bootstrap.js"></script>
<script src="<?php print SISTEMA;?>/js/jasny-bootstrap.js"></script>
<script src="<?php print SISTEMA;?>/js/funcaobase.js"></script>
</body>
</html>