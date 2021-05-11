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
class AcessoCedec {
	
    
        function menuCedec($_login){
            
			$con = Conexao::getInstance();
			
            $dados = array();
         
            $sql = 'SELECT login,
                           arquivo,
                           prefeitura,
                           cad_prefeitura,
                           alterar_prefeitura,
                           municipio,
                           cad_municipio,
                           alterar_municipio,
                           info_municipio,
                           relatorio 
                           FROM cedec_permissao
                           WHERE login = :login';
            
            	$result = $con->prepare($sql);
            	$result->bindParam(":login", $_login);
            	$result->execute();
            	
            	while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
            		$dados[] = $linha;
            	}
            return $dados;
        }	
}?>