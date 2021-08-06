<?php session_start();
    print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
    include_once '../../include.php';
    
    $_conexao = new ConexaoMysql();
    
    
    
    $usuario = "m1296844";
    
    
        
        //var_dump($dados);
        
    
        for($i =0; $i <count($dados); $i++){
                
                
            if(substr($dados[$i][0], 0, 2) == "m_" ){
                    
                    print "<input type='checkbox' name='ch_".$dados[$i][0]."'> ".$dados[$i][1]."<br>";        
                }
        }
    
    
    
    
    
    
?>