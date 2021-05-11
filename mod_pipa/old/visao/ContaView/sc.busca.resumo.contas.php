<?php session_start();
  include_once "../include.php";

defined("FUNC") or die;

$_conexao = new ConexaoMysql();

$_login = new Login();

$_login->logado();

$_login->Sessao();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php print TITULO;?></title>
<link href="../css/bootstrap.css" rel="stylesheet" media="screen">
<link href="../css/bootstrap-responsive.css" rel="stylesheet" media="screen">
</head>
<body>
  <body>
  <div class="container">
    <div class="row-fluid text-center">
      <img src="<?php print SISTEMA."/";?>imagem/topo_pipa.png" />
      <hr>
    </div>
    
    <!-- BARRA -->
    <div class="row-fluid">
      <div class="span6 text-left"><small><?php print "Data :".date("d/m/Y");?></small></div>
      <div class="span6 text-right"><small><?php print "Hora :".date("H:i:s");?></small></div>
    </div>

    <!-- LOGOUT -->
    <div class="row-fluid">
      <div class="span12 text-right">
        <a class="btn btn-primary" href="<?php print SISTEMA;?>/core/logout.php?logout=s" title="Logout do Sistema">Logout</a>
        <p>
        <hr>
      </div>
    </div>

      <!-- MENU -->
        <div class="row-fluid">
          <div class="span3">
            <!-- MENU -->
                <?php include_once 'visao/pipa.menu.php';?>
                <!-- FIM MENU -->
          </div>
          
          <!-- CONTEUDO -->
          <div class="span9">
              
              <form action="#">
                  
                  
                  
              </form>
 
          </div>
        </div>
          <div class="row-fluid text-center">
            <small class="rodape"><?php print RODAPE;?></small>
          </div>
  </div>    
<script src="<?php print SISTEMA;?>/js/jquery.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/jasny-bootstrap.js"></script>
</body>
</html>