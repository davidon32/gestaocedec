<?php 


class Regiao
{
	
	#@ combobox Regiao
	function ComboRegiao($_id_regiao = false, $opcoes=null){

	    $dados = array();
	    
		try {
	    
    	    $con = Conexao::getInstance();

    		$sql = "SELECT
    				id_regiao,
    				nome
    				FROM com_regiao";
    		
    		$result = $con->query($sql);
    		
    		$result->execute();
       
    		print "<select class=\"form-control\" name=\"sel_regiao\" id=\"sel_regiao\" ".$opcoes.">";
    
    		if($_id_regiao == false){
    
    				print "<option value=\"\">Selecione a Regiao</option>";
    			
    		}else {
    			               
                try{
                    
    				$sql1 = "SELECT id_regiao,
    								 nome
    								 FROM com_regiao
    								 WHERE id_regiao = :id_regiao";
    				
    			    $result1 = $con->prepare($sql1);
    			    
    			    
    			    $result1->bindValue(":id_regiao", $_id_regiao);
    			    
    			    $result1->execute();

    			    while ($linha1 = $result1->fetch(PDO::FETCH_ASSOC)){
    
    					print "<option value=".utf8_encode($linha1['id_regiao'].">".$linha1['nome'])."</option>";
    			    }
    			    
                }catch (Exception $e){
                    
                    print $e;
                }
    
    		}
    				

    		while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
    
    			print "<option value=".$linha['id_regiao'].">".utf8_encode($linha['nome'])."</option>";
    			
    		}
    
    		print "</select>";
    		
		}catch (Exception $e){
		    
		    return $e->getMessage()."";
		}
	}

	#@ get sigla/nome regiao
	function PegaNomeRegiao($_id_regiao){

        $dado = '';
        
        try{
        
            $con = Conexao::getInstance();

    		$sql = "SELECT
    				nome
    				FROM com_regiao
    				WHERE id_regiao = :id_regiao";
    		
    		$result = $con->prepare($sql);
    		$result->bindValue(":id_regiao", $_id_regiao);
    		$result->execute();
    		
    		while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
    
    			$dado = utf8_encode($linha['nome']);
    			
    		}
    
    		return $dado;
    		
        }catch (Exception $e){
            
            return $e->getMessage()."";
        }

	}

    /**
     * Resumo compdec por Regiao
     * @return lista quantidade compdec por regiao
     */
     function qtdCompdecRegiao(){
     	
     	$con = Conexao::getInstance();
             
         $_dados = array();
         
         $sql = "SELECT r.id_regiao as id_regiao,
                 r.nome as nome,
                 count(c.id_comdec) as num_compdec
                 FROM com_comdec c
                 INNER JOIN com_regiao r
                 ON c.regiao = r.id_regiao
         		 where c.id_comdec <> '854' 
                 GROUP BY regiao
                 ORDER BY r.nome;";
         
		$result = $con->query($sql);
         
         while($linha = $result->fetch(PDO::FETCH_ASSOC)){
             
             $_dados[] = $linha;    
             
         }
         return $_dados; 

     }
     
     /**
     * Resumo compdec por Regiao de Desenvolvimento
     * @return lista quantidade compdec por regiao de desenvolvimento
     */
     function qtdCompdecRegiaoDesenv(){
             
     		$con = Conexao::getInstance();
         
     		$_dados = array();
         
         $sql = "SELECT com_territ_desenv.id_territ,
                 com_territ_desenv.nome,
                 count(com_comdec.id_comdec) as num_compdec
                 FROM com_comdec
                 INNER JOIN com_territ_desenv
                 ON com_comdec.id_territorio = com_territ_desenv.id_territ
         		 where com_comdec.id_comdec <> '854' 
                 GROUP BY com_territ_desenv.nome
                 ORDER BY com_territ_desenv.nome;";
         
         $result = $con->query($sql);
         
         while($linha = $result->fetch(PDO::FETCH_ASSOC)){
             
             $_dados[] = $linha;    
             
         }
         return $_dados; 

     }
     
     
     #@ combobox Regiao de DEFEsa Civil

    function comboRegiaoDC($opcoes = null) {

        $dados = array();
        
        
        $filtro = "";//"AND cedec_municipio.id_municipio = 7221";

        try {

            $con = Conexao::getInstance();
            
            $sql = "select id, nome from cedec_rpm";

//            $sql = "SELECT cedec_municipio.nome,
//                        com_comdec.id_comdec,
//                        cedec_rpm_mun.id_rpm,
//                        cedec_rpm_mun.nome as rpm,
//                        com_eq_comdec.nome
//                        FROM cedec_municipio
//                        INNER JOIN com_comdec
//                        ON cedec_municipio.id_municipio = com_comdec.id_municipio
//                        INNER JOIN cedec_rpm_mun
//                        ON cedec_municipio.id_municipio = cedec_rpm_mun.id_municipio
//                        INNER JOIN com_eq_comdec
//                        ON cedec_municipio.id_municipio = com_eq_comdec.id_municipio
//                        WHERE com_eq_comdec.funcao = \"Coordenador\"
//                        ".$filtro;;

            $result = $con->query($sql);

            $result->execute();


            print "<select class=\"form-control\" name=\"sel_regiaoDC\" id=\"sel_regiaoDC\">";
            print "<option value=\"0\">Todas</option>";

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

                print "<option value=" . $linha['id'] . ">" . $linha['nome'] . "</option>";
            }

            print "</select>";
        } catch (Exception $e) {
            
        }
    }

}?>