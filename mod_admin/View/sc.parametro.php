<?php session_start(); 
    include_once '../../include.php';
    print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";

#************************************************************************************
#  Secretária  : Gabinete Militar do Governado de Minas Gerais                      #
#  Órgão       : Coordenadoria Estadual de Defesa Civil do Estado de Minas Gerais   #
#  Autor       : Demetrio S. Passos                                                 #
#  Criação     : 00/00/0000                                                         #
#  Descrição   :
#
#************************************************************************************
$_conexao = new ConexaoMysql();

$_login = new Login();

$_login->logado();

$_login->Sessao();
    
$_login->VerificaBrowser();


?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php print TITULO;?></title>
<link href="<?php print SISTEMA;?>/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="<?php print SISTEMA;?>/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
</head>
<body>
    <div class="container">
        <div class="row-fluid text-center">
            <img src="<?php print SISTEMA;?>/imagem/topo_gestao.png" />
            <hr>
        </div>
        <!-- BARRA -->
        <div class="row-fluid">
          <div class="span6 text-left"><small><?php print "Data :".date("d/m/Y");?></small></div>
          <div class="span6 text-right"><small><?php print "Hora :".date("H:i:s");?></small></div>
        </div>
        
        <!-- OPÇOES USUÁRIO -->
        <div class="row-fluid text-right"> 
           <?php include '../../core/sc.menu.usuario.php';?>
         </div> 

        <div class="row-fluid">

            <!-- MENU -->
            <div class="span3">
                <?php //include_once 'pipa.menu.php';?>
            </div>

            <!-- CORPO PAGINA  -->
            <div class="span9">
                <legend>Parâmetros do Sistema </legend>
                <?php Html::form("#", "POST", "frmCadParam", "fromCadParam");
                
                        Html::input("text", "txtOfResp", "txtRespExec", array());
                        
                        Html::input("submit", "btnEnviar", "btnEnviar", array("class"=>"btn", "value"=>"Salvar"));
                
                    Html::endForm();
                ?>
            </div>
            
            <!-- ESPAÇO CORPO -->
            <div class="row-fluid fdo_corpo"></div>
            
            <!-- RODAPE -->
            <div class="row-fluid">
                <div class="span12 text-center">
                    <small><?php print RODAPE;?></small>
                </div>  
            </div>
        </div>
            
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="<?php print SISTEMA;?>/js/bootstrap.js"></script>
    <script src="<?php print SISTEMA;?>/js/jasny-bootstrap.js"></script>
    <script src="<?php print SISTEMA;?>/js/funcaobase.js"></script>
</body>
</html>
