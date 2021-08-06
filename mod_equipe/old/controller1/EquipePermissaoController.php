<?php require_once 'AppEquipeController.php';

/**
 * 
 */
class EquipePermissaoController extends AppEquipeController {
	
	

function selectPermissaoAjuda() {
                
        $con = Conexao::getInstance();
        
            try {
                      
                $statement = $con->prepare("SELECT COLUMN_NAME,
                                            COLUMN_TYPE,
                                            column_comment
                                            FROM INFORMATION_SCHEMA.COLUMNS
                                            WHERE TABLE_SCHEMA='gestaocedec'
                                            AND TABLE_NAME='aju_permissao'");
    
                $statement->execute();
                
                $linha = $statement->fetchAll(PDO::FETCH_ASSOC);
                
                return $linha;
                //return print_r($statement);
            
            }catch(PDOException $e) {
                
                print $e->getMessage()."1";
                print "<br><a href='javascript:history.back();'>Voltar</a>";
                
            } 
                        
}

function buscaPermissaoAjuda($login, $coluna){
    
    $con = Conexao::getInstance();
    
        //var_dump($login);
        //var_dump($coluna);
        
            try {
                      
                $statement = $con->prepare("select ".$coluna." from aju_permissao
                                            where login = :login");
                                            
             
           
                     
                $statement->bindValue(':login', $login, PDO::PARAM_STR);                         
    
                $statement->execute();
                
                $linha = $statement->fetch(PDO::FETCH_BOTH);
                
                return $linha[0];
                //return print_r($statement);
            
            }catch(PDOException $e) {
                
                print $e->getMessage()."1";
                print "<br><a href='javascript:history.back();'>Voltar</a>";
                
            } 
                        
    
    
}

}?>

