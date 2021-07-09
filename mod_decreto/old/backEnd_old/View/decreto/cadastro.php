<?php $id_session = session_id();
    if(empty($id_session)) session_start(); 
	print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
	include_once PATH.'/include.php';
    
	$con = Conexao::getInstance();
	
	$_login = new Login();
	
	$_login->logado();
	
	$decret = new Decretacao();
	$decret->listaDec_processo(array("teste", "teste2"));

     
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
        <link href="/css/bootstrap.css" rel="stylesheet" media="screen">
        <link href="/css/bootstrap-responsive.css" rel="stylesheet" media="screen">

    </head>
    <body>
        <!-- TOPO /system/topo.php-->
    <?php include_once(PATH.'/system/topo.php'); ?>
    
    <div class="container">

        <!-- MENU -->
        <div class="row-fluid fdo_corpo">
            <div class="span2">
                 <?php include_once PATH."/mod_".$modulo.'/app/elemento/'.$modulo.'.menu.php';?>
                
            </div>
                <div class="span10 fdo_corpo">
                    <?php require_once PATH."/mod_decreto/app/decreto/processo.menu.php";?>

                </div>

            </div>


        </div>
        <div class="row">
            <div class="span3"></div>
            <div class="span9 text-center">
                <small><?php print RODAPE;?></small>
            </div>          
        </div>
</body>
</html>
        <script src="<?php print SISTEMA;?>/js/jquery.js"></script>
        <script src="<?php print SISTEMA;?>/js/bootstrap.js"></script>
        <script src="<?php print SISTEMA;?>/js/jasny-bootstrap.js"></script>
        
  