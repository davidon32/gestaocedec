<?php 

$_acessoMenu = new AcessoPipa();

if($_SESSION) {

$dadosMenu = $_acessoMenu->menuPipa($_SESSION['seguranca']['login']); 
    

/* Menu inicial do SIstema */
    $_item1 = array("permissao"=> 1,
                     "nome"     =>"Menu Principal",
                     "link"     =>"/index.php?secao=cedec&acao=index",
                     "title"    =>"Menu Inicial do Sistema",
                     "divisor" => false,
                     "opcoes"   =>"");
    
    /* Página inicial do módulo */
    $_item2 = array("permissao"=> 1,
                   "nome"     =>utf8_encode("Página Inicial"),
                   "link"     =>"index.php?modulo=pipa&secao=menu",
                   "title"    =>"Página Inicial do Módulo",
                   "divisor" => false,
                   "opcoes"   =>"");
                   
    /* Cadastros menu de 3 niveis */
    $_item3 = array(array("permissao"=> $dadosMenu[0]['it_sub_cadastro'],
                            "nome"    =>"Cadastro Geral",    
                            "title"         =>"Cadastro Geral"),
                   
                    array("permissao" =>$dadosMenu[0]['it_cad_pipeiro'],
                         "nome"      =>"Cadastro Pipeiro",
                         "link"      =>"#",
                         "title" =>"Cadastro de Pipeiro",
                         "divisor" => false,
                         "opcoes"    =>""),
                    
                    array("permissao" =>$dadosMenu[0]['it_cad_pipeiro'],
                         "nome"      =>"Alterar Pipeiro",
                         "link"      =>"#",
                         "title" =>"Alterar Cadastro Pipeiro",
                         "divisor" => true,
                         "opcoes"    =>""),
                         
                    array("permissao" =>$dadosMenu[0]['it_cad_motorista'],
                         "nome"      =>"Cadastro Motorista",
                         "link"      =>"index.php?modulo=pipa&secao=motorista&acao=cadastro",
                         "title" =>"Cadastro de Motorista",
                         "divisor" => false,
                         "opcoes"    =>""),
                    
                    array("permissao" =>$dadosMenu[0]['it_cad_motorista'],
                         "nome"      =>"Alterar Motorista",
                         "link"      =>"index.php?modulo=pipa&secao=motorista&acao=busca_alterar",
                         "title" =>"Alterar Cadastro Motorista",
                         "divisor" => true,
                         "opcoes"    =>""),
                         
                    array("permissao" =>$dadosMenu[0]['it_cad_caminhao'],
                         "nome"      =>"Cadastro Caminhão",
                         "link"      =>"index.php?modulo=pipa&secao=caminhao&acao=cadastro",
                         "title" =>"Cadastro de Caminhão",
                         "divisor" => false,
                         "opcoes"    =>""),
                    
                    array("permissao" =>$dadosMenu[0]['it_cad_caminhao'],
                         "nome"      =>"Alterar Caminhao",
                         "link"      =>"index.php?modulo=pipa&secao=caminhao&acao=busca_alterar",
                         "title" =>"Alterar Cadastro Caminhao",
                         "divisor" => true,
                         "opcoes"    =>""),
                         
                    array("permissao" =>$dadosMenu[0]['it_cad_rota'],
                         "nome"      =>"Cadastro Rota",
                         "link"      =>"index.php?modulo=pipa&secao=rota&acao=pesquisar",
                         "title" =>"Cadastro de Rota",
                         "divisor" => false,
                         "opcoes"    =>""),
                    
                    array("permissao" =>$dadosMenu[0]['it_cad_rota'],
                         "nome"      =>"Alterar Rota",
                         "link"      =>"index.php?modulo=pipa&secao=rota&acao=busca_alterar",
                         "title" =>"Alterar Cadastro de Rota",
                         "divisor" => true,
                         "opcoes"    =>""),
                   
                    array("permissao" =>$dadosMenu[0]['it_cad_contrato'],
                         "nome"      =>"Cadastro Contrato",
                         "link"      =>"index.php?modulo=pipa&secao=contrato&acao=cadastro",
                         "title" =>"Cadastro de Contrato",
                         "divisor" => false,
                         "opcoes"    =>""),
                        
                    array("permissao" =>$dadosMenu[0]['it_cad_contrato'],
                         "nome"      =>"Alterar Contrato",
                         "link"      =>"index.php?modulo=pipa&secao=contrato&acao=busca_alterar",
                         "title" =>"Alterar Cadastro de Contrato",
                         "divisor" => false,
                         "opcoes"    =>"")
                         );
                         
    /* Acerto de Contas */
    $_item4 = array("permissao"=> $dadosMenu[0]['it_acerto'],
                   "nome"     =>utf8_encode("Acerto de Contas"),
                   "link"     =>"index.php?modulo=pipa&secao=conta&acao=cadastro",
                   "title"    =>"Acerto de Contas, Gerar Pagto",
                   "divisor" => false,
                   "opcoes"   =>"");
    
    /************* Acesso PMDA *****************/
    $_item5 = array("permissao" =>$dadosMenu[0]['it_pmda'],
                "nome"      =>"Adm PMDA",
                "link"      =>"index.php?modulo=pipa&secao=pmda&acao=adm",
                "title" =>"Administração PMDA",
                "divisor" => false,
                "opcoes"    =>"");
                   
    /* Relatorios Gerenciais menu de 3 niveis */
    $_item6 = array(array("permissao"=> $dadosMenu[0]['it_sub_relatorio'],
                            "nome"    =>"Rel. Gerenciais",    
                            "title"         =>"Relatórios Gerenciais"),
                   
                    array("permissao" =>$dadosMenu[0]['it_rel_rpa'],
                         "nome"      =>"Impressao RPA",
                         "link"      =>"index.php?modulo=pipa&secao=conta&acao=filtro_rpa",
                         "title" =>"Impressão de RPA",
                         "divisor" => false,
                         "opcoes"    =>""),
                    
                    array("permissao" =>$dadosMenu[0]['it_rel_imposto'],
                         "nome"      =>"Relatório Impostos",
                         "link"      =>"index.php?modulo=pipa&secao=conta&acao=filtroimpressimposto",
                         "title" =>"Relatório de Impostos",
                         "divisor" => false,
                         "opcoes"    =>""),
                    
                    array("permissao" =>$dadosMenu[0]['it_rel_cons'],
                         "nome"      =>"Consideração Desp.",
                         "link"      =>"index.php?modulo=pipa&secao=conta&acao=consideraDespesa",
                         "title" =>"Relatório de Consideração de Despesas",
                         "divisor" => false,
                         "opcoes"    =>""),
                    
                    array("permissao" =>$dadosMenu[0]['it_rel_contrato'],
                         "nome"      =>"Rel.Geral Contrato",
                         "link"      =>"secao.php?secao=relatorio&acao=contrato",
                         "title" =>"Relatório Geral de Contratos",
                         "divisor" => false,
                         "opcoes"    =>""),
                    
                    array("permissao" =>$dadosMenu[0]['it_rel_conf'],
                         "nome"      =>"Rel.Conf. Valores",
                         "link"      =>"secao.php?secao=relatorio&acao=conferencia",
                         "title" =>"Relatório de Conferência de Valores",
                         "divisor" => false,
                         "opcoes"    =>""),
                    
                    array("permissao" =>$dadosMenu[0]['it_rel_conf_pg'],
                         "nome"      =>"Conferência Calculo",
                         "link"      =>"#",
                         "title" =>"Relatório de Conferência de Calculo",
                         "divisor" => false,
                         "opcoes"    =>""),
                         
                    array("permissao" =>$dadosMenu[0]['it_rel_pg'],
                         "nome"      =>"Pipeiro a Pagar",
                         "link"      =>"#",
                         "title" =>"Relatório de Pipeiros a Pagar",
                         "divisor" => false,
                         "opcoes"    =>""),
                         
                    array("permissao" =>$dadosMenu[0]['it_rel_pg'],
                         "nome"      =>"Pagamento de Pipeiro",
                         "link"      =>"#",
                         "title" =>"Relatório de Pagamento de Pipeiros",
                         "divisor" => false,
                         "opcoes"    =>""),
                       
                   array("permissao" =>$dadosMenu[0]['it_rel_pg'],
                         "nome"      =>"Pagto Anual Pipeiro",
                         "link"      =>"#",
                         "title" =>"Relatório de Pagamento Anual de Pipeiros",
                         "divisor" => false,
                         "opcoes"    =>""),
                         
                   array("permissao" =>$dadosMenu[0]['it_rel_resumo'],
                         "nome"      =>"Resumo de Contas",
                         "link"      =>"secao.php?secao=relatorio&acao=filtroResumo",
                         "title" =>"Resumo de lancamento",
                         "divisor" => false,
                         "opcoes"    =>""));
                         
        # Relatorios cadastrais
        $_item7 = array(array("permissao" =>$dadosMenu[0]['it_rel_cadastro'],
                         "nome"      =>"Impressão Cadastros",
                         "title" =>"Impressão de Cadastro Gerais"),
                         
                          array("permissao" =>$dadosMenu[0]['it_rel_cadastro'],
                                 "nome"      =>"Impressão Cad.Pipeiro",
                                 "link"      =>"#",
                                 "title" =>"Impressão de Cadastro de Pipeiro",
                                 "divisor" => false,
                                 "opcoes"    =>""),
                          
                          array("permissao" =>$dadosMenu[0]['it_rel_cadastro'],
                                 "nome"      =>"Impressão Cad. Motorista",
                                 "link"      =>"#",
                                 "title" =>"Impressão Cadastro de Motorista",
                                 "divisor" => false,
                                 "opcoes"    =>""),
                          
                          array("permissao" =>$dadosMenu[0]['it_rel_cadastro'],
                                 "nome"      =>"Impressão Cad. Rota",
                                 "link"      =>"#",
                                 "title" =>"Impressão Cadastro de Rota",
                                 "divisor" => false,
                                 "opcoes"    =>""),
                                 
                          array("permissao" =>$dadosMenu[0]['it_rel_cadastro'],
                                 "nome"      =>"Impressão Cad. Caminhão",
                                 "link"      =>"#",
                                 "title" =>"Impressão Cadastro de Caminhão",
                                 "divisor" => false,
                                 "opcoes"    =>""),
                                 
                          array("permissao" =>$dadosMenu[0]['it_rel_cadastro'],
                                 "nome"      =>"Impressão Cad. Contrato",
                                 "link"      =>"#",
                                 "title" =>"Impressão Cadastro de Contrato",
                                 "divisor" => false,
                                 "opcoes"    =>""));

}                              
                                 
?>
