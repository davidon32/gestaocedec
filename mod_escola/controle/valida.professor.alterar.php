<?php include_once '../include.php';

$_conexao = new ConexaoMysql();

$_professor = new Professor();

//var_dump($_request);

$_nome          = FuncaoBase::noSqlInjection(utf8_decode($_REQUEST['nome']));
$_num_policia   = FuncaoBase::noSqlInjection($_REQUEST['num_policia']);
$_profissao     = FuncaoBase::noSqlInjection(utf8_decode($_REQUEST['profissao']));
$_posto         = FuncaoBase::noSqlInjection(utf8_decode($_REQUEST['posto']));
$_obs           = FuncaoBase::noSqlInjection(utf8_decode($_REQUEST['obs']));
$_btn_alterar   = (FuncaoBase::noSqlInjection($_REQUEST['btn_cadastrar']) == "btn_cadastrar") ? true : false ;
$_id_professor  = FuncaoBase::noSqlInjection($_REQUEST['id_professor']);
$_cpf           = FuncaoBase::noSqlInjection(utf8_decode($_REQUEST['txt_cpf']));


$campos = array("nome"       =>$_nome,
                "num_policia"=>$_num_policia,
                "profissao"  =>$_profissao,
                "cpf"  =>$_cpf);
                
    if($_btn_alterar) {
        if(FuncaoBase::campoBranco($campos)) {
        
            if($_professor->alterarProfessor($_nome, $_num_policia, $_profissao, $_posto, $_obs, $_id_professor, $_cpf)){
                
                FuncaoBase::vifs('sucesso', 'index2.php?secao=menu');
      
            }
        
           
        
        }
    }




?>

