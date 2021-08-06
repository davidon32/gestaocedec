<?php include_once '../include.php';

$_conexao = new ConexaoMysql();

$_professor = new Professor();

//var_dump($_request);

$_nome          = FuncaoBase::noSqlInjection(utf8_decode($_REQUEST['nome']));
$_num_policia   = FuncaoBase::noSqlInjection($_REQUEST['num_policia']);
$_profissao     = FuncaoBase::noSqlInjection(utf8_decode($_REQUEST['profissao']));
$_posto         = FuncaoBase::noSqlInjection(utf8_decode($_REQUEST['posto']));
$_obs           = FuncaoBase::noSqlInjection(utf8_decode($_REQUEST['obs']));
$_btn_cadastrar = (FuncaoBase::noSqlInjection($_REQUEST['btn_cadastrar']) == "btn_cadastrar") ? true : false ;


$campos = array("nome"       =>$_nome,
                "num_policia"=>$_num_policia,
                "profissao"  =>$_profissao);
                
    if($_btn_cadastrar) {
        if(FuncaoBase::campoBranco($campos)) {
        
            if($_professor->cadastrar($_nome, $_num_policia, $_profissao, $_posto, $_obs)){
                
                FuncaoBase::vifs('sucesso', 'secao.php?secao=professor&acao=cadastrar');
      
            }
        
           
        
        }
    }




?>

