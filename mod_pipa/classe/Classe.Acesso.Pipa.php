<?php
    
/*********************************************************************************
 *  Órgão : Coordenadoria Estadual de Defesa Civil de MG - CEDEC/MG
 *  Autor : Demetrio da Silva Passos
 *  Descrição : Busca credenciais do usuário
 *  Data: 
 *  Versão 1.3
 *  Data:13/01/2015
 *
 * *******************************************************************************/
class AcessoPipa {
    
        function menuPipa($_login){
            
            $con = Conexao::getInstance();
            
            $dados = array();
         
            $sql = 'SELECT login, it_sub_cadastro, it_cad_pipeiro, it_cad_motorista,
            		it_cad_caminhao, it_cad_contrato, it_acerto, it_cad_rota, it_sub_relatorio,
            		it_rel_rpa, it_rel_bb, it_rel_imposto, it_rel_cadastro, it_rel_contrato, it_rel_conf,
            		it_rel_conf_pg, it_rel_falta_pg, it_rel_pg, it_rel_cons, it_cad_conta, it_rel_resumo, 
            		it_pmda
                    from pip_permissao where login = :login';
            
            $result = $con->prepare($sql);
            
            $result->bindValue("login", $_login);
            
            $result->execute();
                    
            while($linha = $result->fetch(PDO::FETCH_ASSOC)){
             
                $dados[] = $linha;
                
            }
            
            return $dados;
            
        }	
}?>