<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php include_once '../include.php';

    //Login::logado();

    $_conexao = new ConexaoMysql();

          
    /* ****************************************************************************************
    *   Orgão Gestor : Coordenadoria Estadual de Defesa Civil do Estado de Minas Gerais
    *   Sistema      : Sistema de Gest�o de Ajuda Humanit�ria
    *   
    *   Autor        :  Demetrio Silva Passos
    *   Fun��o   : Tela de Executar Libera��o de Materiais
    *
    *******************************************************************************************/
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo TITULO;?></title>
        <link href="<?php print SISTEMA;?>/css/bootstrap.css" rel="stylesheet" media="screen">
        <link href="<?php print SISTEMA;?>/css/bootstrap-responsive.css" rel="stylesheet" media="screen">

    </head>
    <body>
        <div class="container">
            <!-- TOPO-->
            <div class="row-fluid text-center">
                <img src="../images/topo_ajuda.png" />
                <hr>
            </div>

            <!-- BARRA -->
            <div class="row-fluid">
                <div class="span6 text-left"><small><?php print "Data :".date("d/m/Y");?></small></div>
                <div class="span6 text-right"><small><?php print "Hora :".date("H:i:s");?></small></div>
            </div>
        
            <!-- LOGOUT -->
            <div class="row-fluid text-right">
                <a class="btn" href="<?php print SISTEMA;?>/core/logout.php?logout=s" title="Fazer logout do sistema">Logout</a>
                <p>
                <hr>
            </div>

            <!-- MENU -->
            <div class="row-fluid">
                <div class="span3"><?php include_once 'visao/sc.ajuda.menu.php';?></div>
            
                    
            </div>

        </div>

            <div class="span12 text-center">
                <small><?php print RODAPE;?></small>
            </div>          
        </div>
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="<?php print SISTEMA;?>/js/bootstrap.js"></script>
        <script src="<?php print SISTEMA;?>/js/jasny-bootstrap.js"></script>
        <script type="text/javascript">
            ﻿$(document).ready(function()
                {

                  /* Quando algum hyperlink com a classe "window" for clicado */

                  $('a.window').click(function()
                  {
                    var dimensions = (this.rel) 
                      ? this.rel
                      : '660x600';
                    dimensions = dimensions.split('x');
                    var width = dimensions[0];
                    var height = dimensions[1];
                    var bWindow = window.open(this.href, this.id, 'width=' + width + ',height=' + height + ',left=' + (((screen.width - width) / 2) - 20) + ',top=' + (((screen.height - height) / 2) - 20) + ',scrollbars=yes,resizable=yes,toolbars=no');
                    bWindow.focus();
                    return false; 
                  });
                });
        </script>
    </body>
</html>