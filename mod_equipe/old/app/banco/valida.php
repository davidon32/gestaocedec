<?php session_start();
print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
include_once '/include.php';

$_conexao = new ConexaoMysql();

$_funcaoBase = new FuncaoBase();

$_equipeFunc = new EquipeFuncionario();

?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo TITULO; ?></title>
<link href="<?php print SISTEMA;?>/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="<?php print SISTEMA;?>/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="<?php print SISTEMA;?>/js/funcaobase.js"></script>
</head>

<body>
    
<?php

$_id = isset($_GET['id']) ? (int)$_GET['id'] : "";

//var_dump($_POST);

$nomBanco     = isset($_POST['txt_non_banco']) ? FuncaoBase::noSqlInjection(strtoupper($_POST['txt_non_banco'])) : "";
$numBanco     = isset($_POST['txt_num_banco']) ? FuncaoBase::noSqlInjection($_POST['txt_num_banco']) : "";
$conta        = isset($_POST['txt_conta'])     ? FuncaoBase::noSqlInjection($_POST['txt_conta'])     : "";
$tpConta      = isset($_POST['txt_tp_conta'])  ? FuncaoBase::noSqlInjection(strtoupper($_POST['txt_tp_conta']))  : "";
$idFuncionario= isset($_POST['selIdFuncionario'])? FuncaoBase::noSqlInjection($_POST['selIdFuncionario']): "";
$agencia      = isset($_POST['txt_agencia'])   ? FuncaoBase::noSqlInjection($_POST['txt_agencia'])   : "";
$contaPrinc   = isset($_POST['ck_princ'])      ? FuncaoBase::noSqlInjection($_POST['ck_princ'])      : "0";
$btnEnviar    = isset($_POST['btn_enviar'])    ? true  : "";     

/* registro novo */
if(!$_id) {
                                        

$campos = array('Nome do Banco'   => $nomBanco,
                'Número do Banco' => $numBanco,
                'Número da Conta' => $conta,
                'Agencia'         => $agencia);

if($btnEnviar){
    
    if($_funcaoBase->campoBranco($campos)){
        
        if($contaPrinc == "on") {
                
            $contaPrinc = 1;
        
            // normaliza os dados bancários do funcionario setando todas as que estão cadastradas como PRINC = 0
            $_equipeFunc->ContaPrincipal($idFuncionario);
        }
        
        if($_equipeFunc->CadastroBanco($idFuncionario,
                                $nomBanco,
                                $numBanco,
                                $conta,
                                $tpConta,
                                $agencia,
                                $contaPrinc)){
                                    
            print "<script type=\"text/javascript\">";

            print "alert('Cadastro Realizado Com Sucesso !');";
            
            print "window.location.href = 'index.php?token=".hash('sha256', md5(VERSAO)."-".time())."&ac=&modulo=equipe&secao=banco&acao=cadastro';";
            
            print "</script>"; 
            
        }
    }
    
}


/* alterar registro */
}else if(is_int($_id)){

    //var_dump($_POST);
 
 $campos = array('Nome do Banco'   => $nomBanco,
                'Número do Banco' => $numBanco,
                'Número da Conta' => $conta,
                'Agencia'         => $agencia,
                'id_banco'        => $_id);

if($btnEnviar){
    
    if($_funcaoBase->campoBranco($campos)){
        
        if($contaPrinc == "on") {
                
            $contaPrinc = 1;
        
            // normaliza os dados bancários do funcionario setando todas as que estão cadastradas como PRINC = 0
            $_equipeFunc->ContaPrincipal($idFuncionario);
        }
        
        if($_equipeFunc->alterarBanco($_id,
                                        $nomBanco,
                                        $numBanco,
                                        $conta,
                                        $tpConta,
                                        $agencia,
                                        $contaPrinc)){
                                    
            print "<script type=\"text/javascript\">";

            print "alert('Cadastro Realizado Com Sucesso !');";
            
            print "window.location.href = 'index.php?token=".hash('sha256', md5(VERSAO)."-".time())."&ac=&modulo=equipe&secao=banco&acao=buscar';";
            
            print "</script>"; 
            
        }
    }
    
}   
    
}

?>
