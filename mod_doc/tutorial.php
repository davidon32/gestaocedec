<?php session_start();
print "<!DOCTYPE html>";

include_once 'include.php';
/************************************************************************************+
 #  Secretária  : Gabinete Militar do Governado de Minas Gerais                      #
 #  Órgão       : Coordenadoria Estadual de Defesa Civil do Estado de Minas Gerais   #
 #  Autor       : Demetrio S. Passos                                                 #
 #  Criação     : 00/00/0000                                                         #
 #  Descrição   :
 #
 +************************************************************************************/

$_conexao = new ConexaoMysql();

$_funcaoBase = new FuncaoBase();

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php print TITULO; ?></title>
<link href="<?php print SISTEMA; ?>/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="<?php print SISTEMA; ?>/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
</head>
<body>
    <div class="container">
        <div class="row-fluid text-center">
            <img src="../imagem/topo_apoio.png" />
            <hr>
        </div>
        <!-- BARRA -->
        <div class="row-fluid">
          <div class="span6 text-left"><small><?php print "Data :" . date("d/m/Y"); ?></small></div>
          <div class="span6 text-right"><small><?php print "Hora :" . date("H:i:s"); ?></small></div>
        </div>

        <!-- OPÇOES USUÁRIO -->
        <div class="row-fluid text-right"> 
           <?php
            include 'core/sc.menu.usuario.php';
        ?>
           <br><br>
           <hr>
         </div> 

        <div class="row-fluid">

            <!-- MENU -->
            <div class="span3">
                <?php
                    
                ?>
                
            </div>

            <!-- CORPO PAGINA  -->
            <div class="span9">
            
            <!-- ESPAÇO CORPO -->
            <div class="row-fluid fdo_corpo">
                <legend>Tutoriais para Uso da InfraEstrutura da Cidade Administrativa</legend>
                
                <?php
                
                    $dir = opendir('doc/tutorial');

                $_num = 1;
                
                while (false !== ($file = readdir($dir))) {
                        
                    $_form = substr($file, -3, 3);

                    if ($_form == "pdf") {
                        print $_num++.") <a href='tutorial/" . utf8_encode($file) . "'>" . utf8_encode($file) . "</a><br><br>";
                    }
                }
                
                $_funcaoBase::vifs("volta", 'index2.php');
                ?>
                
                
            </div>
            </div>
            
            <!-- RODAPE -->
            <div class="row-fluid">
                <div class="span12 text-center">
                    <small><?php print RODAPE; ?></small>
                </div>  
            </div>
        </div>
            
    <script src="<?php print SISTEMA; ?>/js/jquery.js"></script>
    <script src="<?php print SISTEMA; ?>/js/bootstrap.js"></script>
    <script src="<?php print SISTEMA; ?>/js/jasny-bootstrap.js"></script>
    <script src="<?php print SISTEMA; ?>/js/funcaobase.js"></script>
</body>
</html>