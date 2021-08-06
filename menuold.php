<?php //include_once 'configuracao.php';
      include_once 'include.php';
      
      $_conexao = new ConexaoMysql();
      
       ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <title></title>
    </head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="css/bootstrap-responsive.css" rel="stylesheet" media="screen">
    <body>
<?php

    function permissao($_modulo, $_login) {

        $sql ="select *from ".$_modulo."
               where login = '".$_login."'";
               
        $result = mysql_query($sql) or die (mysql_error());
        
        $linha = mysql_fetch_array($result);
        
        print $sql;
        return $linha;
        
    }
    
    function contaColuna($_modulo) {
        
        $sql = "call contaColunas('".$_modulo."');";
        
        $result = mysql_query($sql);
        
        $linha = mysql_fetch_array($result);
        
        return $linha[0];
    }
    
    
    print contaColuna('aju_permissao');
    
    $_item = array();
    
    $_permissao = permissao($MODULO['mod_pipa'], "m1296844");
    
    //print $_permissao[1];
    
    // for ($i=0; $i < $_permissao; $i++) {
//         
//         
         // $_item[] = array("nivel"=> 1,
                   // "permissao"=> $_permissao[$i],
                   // "nome"=>"Menu Principal",
                   // "link"=>"index.php",
                   // "title"=>"Página Inicial",
                   // "opcoes"=>"");
//         
    // }
    
    //var_dump($_permissao);

    $_item[] = array("nivel"=> 1,
                   "permissao"=> 1,
                   "nome"=>"Menu Principal",
                   "link"=>"index.php",
                   "title"=>"Página Inicial",
                   "opcoes"=>"");
    
    $_item[] = array("nivel"=> 1,
                   "permissao"=> 1,
                   "nome"=>"Página Inicial",
                   "link"=>"index2.php?secao=menu",
                   "title"=>"Página Inicial do Módulo",
                   "opcoes"=>"");
    
    $_item[] = array("nivel"=> 2,
                   "permissaoNivel"=> 1,
                   "nomeFuncao"=>"Cliente",
                   "title"=>"Cadastro Cliente",
                   array("permissao"=>1,
                         "nome"=>"Cadastro Cliente",
                         "link"=>"secao.php?secao=cliente&acao=cadastrar",
                         "titleFunc"=>"Cadastro de Clientes",
                         "opcoes"=>""),
                   array("permissao"=>1,
                         "nome"=>"Cadastro Fornecedor",
                         "link"=>"secao.php?secao=fornecedor&acao=cadastrar",
                         "titleFunc"=>"Cadastro de Fornecedor",
                         "opcoes"=>""));
                         
print "<div class=\"span3\">
    <div class=\"dropdown clearfix\">
    <ul class=\"dropdown-menu\" role=\"menu\" aria-labelledby=\"dropdownMenu\" style=\"display: block; position: static; margin-bottom: 5px; *width: 180px;\">";
    
                for ($i=0; $i < count($_item); $i++) { 
                
                if(($_item[$i]['nivel'] == 1) && ($_item[$i]['permissao'] == 1)){
                    
                    print "<li><a href=\"".$_item[$i]['link']."\" title=\"".utf8_decode($_item[$i]['title'])."\">".utf8_decode($_item[$i]['nome'])."</a></li>";  
                }
            
                /* Item de menu de dois niveis exemplo 
                 * "Lançamento"->Cadastro 
                 *              ->Alteração */
                if(($_item[$i]['nivel'] == 2) && ($_item[$i]['permissaoNivel'] == 1)) {
                    
                   print "<li class=\"dropdown-submenu\"> 
                            <a href=\"#\" title=\"".$_item[$i]['title']."\">".$_item[$i]['nomeFuncao']."</a>
                                <ul class=\"dropdown-menu\">";
                                
                                    for ($j=0; $j < count($_item[$i])-4; $j++) {
                                        
                                        if($_item[$i][$j]['permissao'] == 1){
                                        
                                            print "<li><a href=\"".$_item[$i][$j]['link']."\" title=\"".$_item[$i][$j]['titleFunc']."\">".$_item[$i][$j]['nome']."</a></li>";
                                        }
                                    }
                         print "</ul>
                          </li>"; 
                }
            }
print "</ul>
    </div>
</div>";
?>
</body>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/jasny-bootstrap.js"></script>
<script src="js/funcaobase.js"></script>
</html>


