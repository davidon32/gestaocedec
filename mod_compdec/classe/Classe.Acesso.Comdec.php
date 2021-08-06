<?php

/*
 * 	Classe de acesso ao menu do modulo comdec
* 	Data : 28/11/2012
* 	Author : Demetrio da Silva Passos
*
*/

class AcessoCompdec {

	#@ filtro de acesso ao menu do modulo comdecte
	function acessoMenu($_login) {

	
    	try {
    	    
    	    
    	   $con = conexao::getInstance();
    	   
    	   $sql ='SELECT login,
    	              nivel,
    	              cad_comdec,
    	              cad_rel,
    	   			  admuser,
    	   			  adduser
    	              FROM com_permissao
    	              WHERE login = :login';
    	
    	
    	   $result = $con->prepare($sql);
    	
    	   $result->bindValue(":login", $_login);
    	   
    	   $result->execute();
    
        	   while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
        	       
                	#@  Comdec
                	if(true){
                
                		print "<li class=\"dropdown-submenu\">
                				<a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\" title=\"Compdec\">Compdec &nbsp;&nbsp;</a>
                				<ul class=\"dropdown-menu\">";
                    				#@ cadastro Comdec
                        /* if($linha['cad_comdec'] == 1){
                            
                                print "<li><a href=\"index.php?modulo=compdec&secao=compdec&acao=cadastro\" title=\"Cadastro de Compdec\">Cadastro Comdec</a></li>";
                        } */
                        
                        
                        
                				print "<li><a href=\"index.php?modulo=compdec&secao=compdec&acao=buscarAlterar\" title=\"Alteração de Dados de Compdec\">Alteração/Consulta</a></li>
                				</ul>
                			</li>";
                
                	}
                    
                    #@ cadastro Comdec
                    if($linha['cad_rel'] == 1){
                
                        print "<li class=\"dropdown-submenu\">
                                <a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\" title=\"Compdec\">Relatórios &nbsp;&nbsp;</a>
                                <ul class=\"dropdown-menu\">
                                    <li><a href=\"index.php?modulo=compdec&secao=compdec&acao=filtroRelatorio\" title=\"Consulta Compdec /Relatorios\">Consulta Compdec</a></li>
                                    <li><!--<a href=\"index.php?modulo=compdec&secao=compdec&acao=relCompdecbuscarAlterar\" title=\"Alteração de Dados de Compdec\">Alteração/Consulta</a>--></li>
                                </ul>
                            </li>";
                
                    }
                    #@ Manutencao Usuarios Externos
                    if($linha['admuser'] == 1){
                
                        print "<li class=\"dropdown-submenu\">
                                <a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\" title=\"Compdec\">Adm. Usuarios &nbsp;&nbsp;</a>
                                <ul class=\"dropdown-menu\">
                                    <li><a href=\"index.php?modulo=compdec&secao=compdec&acao=pesquisaUsuario\" title=\"Cadastro Usuario Externos/Ativação/Reset Senha\">Ativar Cadastro/ Alterar</a></li>
                                    <li><a href=\"index.php?modulo=compdec&secao=relatorio&acao=resUsuario\" title=\"Listagem de usuários Ativos\">Lista usuários</a></li>
                                </ul>
                            </li>";
                
                    }
                    #@ Manutencao Usuarios Externos
                    if($linha['adduser'] == 1){
                    
                    	print "<li class=\"dropdown-submenu\">
                                <a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\" title=\"Compdec\">Adicionar Usuario&nbsp;&nbsp;</a>
                                <ul class=\"dropdown-menu\">
                                    <li><a href=\"index.php?modulo=compdec&secao=compdec&acao=caduser\" title=\"Cadastro Usuario Externos\">Adicionar Usuarios Externos</a></li>
                                    
                                </ul>
                            </li>";
                    
                    }
        	   }
        	   
    	}catch (Exception $e) {
    	    
    	    return $e->getMessage()."";
    	}
    
	}   

}?>