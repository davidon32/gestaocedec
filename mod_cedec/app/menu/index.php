<?php include_once 'include.php';
    print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
    
     //$_conexao = new ConexaoMysql();
 
    // $_login = new Login();
// 
    // $_login->logado();
// 
    // $_login->Sessao();
//     
    // $_login->VerificaBrowser(); 
    
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php print TITULO;?></title>
<link href="/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
</head>
<body>
    
    <!-- BARRA DE USUARIO-->
    <div class="barra_usuario">
        <?php require_once(PATH.'/app/elemento/menu.usuario.php');?>    
    </div>
    
    <!-- PAGINA -->
    <div class="container">
        
        <!-- TOPO -->
        <div class="row-fluid text-left">
            <!--<img src="imagem/topo_gestao.png" alt="Topo" />-->
            <img src="imagem/logo_novo.png" alt="Topo" width="150px"/>
            <legend>Módulo - <?=FuncaoBase::getModulo($_GET['modulo']);?></legend>
            <br><br>
        </div>

        <div class="row-fluid">

            <!-- MENU -->
            <div class="span3">
               <!-- menu -->
                <?php include_once PATH."/mod_".$modulo.'/app/elemento/cedec.menu.php';?>
            </div>

            <!--CORPO PAGINA-->
            <div class="span9">
               
               
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
    <script src="/js/bootstrap.js"></script>
    <script src="/js/jasny-bootstrap.js"></script>
    <script src="/js/funcaobase.js"></script>
</body>
</html>