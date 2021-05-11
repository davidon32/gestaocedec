<?php session_start(); 
include_once PATH.'/include.php';
require_once MODEL_EQUIPE.'/EquipePermissaoModel.php';
require_once CONTROLLER_EQUIPE.'/EquipePermissaoController.php';

$equipePermissaoController = new EquipePermissaoController();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php print TITULO;?></title>
<link href="/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
</head>

<body>

<form action="" method="post" name="" id="">
<div class="container">    
<?php
    
//var_dump($_SESSION);

        $dados = $equipePermissaoController->selectPermissaoAjuda();

            print "<table class='table table-bordered'>";
           
                for ($i=0; $i < count($dados) ; $i++) {
                    
                    
                    

                    //var_dump($permissao);
                        
                    if($dados[$i]['COLUMN_NAME'] != 'id_permissao' &&
                        $dados[$i]['COLUMN_NAME'] != 'login' &&
                        $dados[$i]['COLUMN_NAME'] != 'nivel'){
                            
                        $permissao = ($equipePermissaoController->buscaPermissaoAjuda($_SESSION['seguranca']['login'], $dados[$i]['COLUMN_NAME']) == '1') ? "checked='checked'" :"";     
                        
                        //var_dump($permissao);
                        
                        $campo = $dados[$i]['COLUMN_NAME'];
                        //var_dump($campo);
                        print "<td>".$dados[$i]['column_comment']."
                               <input type='checkbox' id='ck".$campo."' name='ck".$campo."' value='1' ".$permissao.">
                               </td>";
                        
                        if(($i % 5) == 0){
                            
                            print "</tr>";
                        }
                        
                    }
                              
                
                }
            print "<tr><td colspan='5' style='text-align:center'>";
            print "<button class='btn' type='submit' id='btnEnvar' name='btnEnviar' value='btnGravar'>Gravar</button>";   
            print "</td>";
            print "</table>";
    
            print "</div>";

    
//var_dump($dados);


    

    
    ?>


 
 </form>
</div> 
</body>
<script src="/js/jquery.js"></script>
<script src="/js/bootstrap.js"></script>
<script src="/js/jasny-bootstrap.js"></script>
<script src="/js/funcaobase.js"></script>
<script type="text/javascript">

    
     
     
     
 </script>
</html>

<?php

var_dump($_POST);

    print "(";
    foreach ($_POST as $key => $value) {  
        print substr($key, 2)."=".$value.",";
    }

?>