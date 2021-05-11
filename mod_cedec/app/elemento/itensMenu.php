<?php 

$_acessoMenu = new AcessoCedec();

if($_SESSION) {

$dadosMenu = $_acessoMenu->menuCedec($_SESSION['seguranca']['login']); 
    

/* Menu inicial do SIstema */
    $_item1 = array("permissao"=> 1,
                     "nome"     =>"Menu Principal",
                     "link"     =>"index.php?secao=cedec&acao=index",
                     "title"    =>"Menu Inicial do Sistema",
                     "divisor" => false,
                     "opcoes"   =>"");
    
    /* Página inicial do módulo */
    $_item2 = array("permissao"=> 1,
                   "nome"     =>utf8_encode("Página Inicial"),
                   "link"     =>"index.php?modulo=cedec&secao=menu",
                   "title"    =>"Página Inicial do Módulo",
                   "divisor" => false,
                   "opcoes"   =>"");
                   
    /* Cadastros menu de 3 niveis  arquivamento e consulta */
    $_item3 = array(array("permissao"=> $dadosMenu[0]['arquivo'],
                            "nome"    =>"Arquivo Oficio",    
                            "title"         =>"Arquivamento de Ofício"),
                   
                    array("permissao" =>$dadosMenu[0]['arquivo'],
                         "nome"      =>"Arquivar",
                         "link"      =>"index.php?modulo=cedec&secao=arquivo&acao=cadastrar",
                         "title" =>"Arquivamento de Ofícios",
                         "divisor" => true,
                         "opcoes"    =>""),
                    
                    array("permissao" =>$dadosMenu[0]['arquivo'],
                         "nome"      =>"Consulta",
                         "link"      =>"index.php?modulo=cedec&secao=arquivo&acao=buscar",
                         "title" =>"Consulta de Oficio",
                         "divisor" => false,
                         "opcoes"    =>""));
                         
    /* Dados Prefeitura */
    $_item4 = array(array("permissao"=> $dadosMenu[0]['prefeitura'],
                   "nome"     =>utf8_encode("Prefeitura"),
                   "title"    =>"Dados Prefeitura"),
                  
                   array("permissao" =>$dadosMenu[0]['cad_prefeitura'],
                         "nome"      =>"Cadastrar",
                         "link"      =>"index.php?modulo=cedec&secao=prefeitura&acao=cadastro",
                         "title" =>"Dados da Prefeitura",
                         "divisor" => true,
                         "opcoes"    =>""),
                    
                    array("permissao" =>$dadosMenu[0]['alterar_prefeitura'],
                         "nome"      =>"Alterar",
                         "link"      =>"index.php?modulo=cedec&secao=prefeitura&acao=buscar",
                         "title" =>"Alterar Cadastro Prefeitura",
                         "divisor" => false,
                         "opcoes"    =>""));
                         
    /* Dados Municipios */
    $_item5 = array(array("permissao"=> $dadosMenu[0]['municipio'],
                   "nome"     =>utf8_encode("Municipio"),
                   "title"    =>"Dados do Municipio"),
                  
                   array("permissao" =>$dadosMenu[0]['cad_municipio'],
                         "nome"      =>"Cadastrar",
                         "link"      =>"index.php?modulo=cedec&secao=municipio&acao=cadastrar",
                         "title" =>"Cadastro de Municipios",
                         "divisor" => true,
                         "opcoes"    =>""),
                    
                    array("permissao" =>$dadosMenu[0]['alterar_municipio'],
                         "nome"      =>"Alterar",
                         "link"      =>"index.php?modulo=cedec&secao=municipio&acao=buscar",
                         "title" =>"Alterar Cadastro Municipio",
                         "divisor" => false,
                         "opcoes"    =>""));
                         
     /* RELATORIOS  */
    $_item6 = array(array("permissao"=> $dadosMenu[0]['relatorio'],
                   "nome"     =>utf8_encode("Relatorios"),
                   "title"    =>"Relatórios Gerenciais"),
                  
                   array("permissao" =>$dadosMenu[0]['info_municipio'],
                         "nome"      =>"Informações do Municípios",
                         "link"      =>"index.php?modulo=cedec&secao=municipio&acao=filtro_info_municipio",
                         "title" =>"Informações do Municípios",
                         "divisor" => true,
                         "opcoes"    =>""),
                    
                    );
                   
    
}                              
                                 
?>
