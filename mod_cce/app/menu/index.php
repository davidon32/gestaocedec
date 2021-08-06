<?php //session_start();
print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
include_once PATH.'/include.php';
	
//$_conexao = new ConexaoMysql();

$_login = new Login();

$_login->logado();

$_login->Sessao();

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php print TITULO;?></title>
<link href="../css/bootstrap.css" rel="stylesheet" media="screen">
<link href="../css/bootstrap-responsive.css" rel="stylesheet" media="screen">

<!-- <script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="../js/jquery.maskedinput-1.3.min.js"></script>
<script type="text/javascript" src="../js/mascara.js"></script>-->
</head>
<body>
    
    <!-- TOPO /system/topo.php-->
    <?php include_once(PATH.'/system/topo.php'); ?>

    <div class="container">
 
        <div class="row-fluid">

            <!-- MENU -->
            <div class="span3">
                <?php include_once PATH."/mod_".$modulo.'/app/elemento/'.$modulo.'.menu.php';?>
            </div>
            
            <!-- CORPO -->
            <div class="span9 fdo_corpo_imagen"></div>
        </div>
        
        <!-- RODAPE -->
        <div class="row-fluid text-center">
            <small><?php print RODAPE;?></small>
        </div>
    </div>

    <script src="<?php print SISTEMA;?>/js/jquery.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/jasny-bootstrap.js"></script>
    <script src="../js/funcaobase.js"></script>
</body>
</html>