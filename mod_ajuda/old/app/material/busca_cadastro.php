<?php session_start();
print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
include_once PATH.'/include.php';

$_conexao = new ConexaoMysql();

$_login = new Login();

$_login->logado();



?>
<html>
<title><?php print TITULO; ?></title>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
</head>
<body>
     <!-- TOPO /system/topo.php-->
    <?php include_once(PATH.'/system/topo.php'); ?>
    
    <div class="container">

        <!-- MENU -->
        <div class="row-fluid fdo_corpo">
            <div class="span3">
                 <?php include_once PATH."/mod_".$modulo.'/app/elemento/'.$modulo.'.menu.php';?>
                
            </div>
            <div class="span9">

                <legend>Filtro Relatorio Cadastro Materiais</legend>
                <form action="index.php?modulo=ajuda&secao=relatorio&acao=rel_material_cadastro" method="POST">
                    <label>Data Inicial de Entrada no Sistema</label>
                    <input type="text" id="txtDtInicio" name="txtDtInicio" data-mask="99/99/9999"/>
                    <br>
                    <label>Data Final de Entrada no Sistema</label>
                    <input type="text" id="txtDtFinal" name="txtDtFinal" data-mask="99/99/9999"/>
                    <br>
                        <label>Ordem</label>
                            <input type="radio" id="" name="rbOrdem" value="0" checked="checked"/>&nbsp; Nome<br>
                            <input type="radio" id="" name="rbOrdem" value="1" />&nbsp; Data Entrada<br>
                            <input type="radio" id="" name="rbOrdem" value="2" />&nbsp; Origem<br>
                            <input type="radio" id="" name="rbOrdem" value="3" />&nbsp; Deposito Destino<br>
                            <input type="radio" id="" name="rbOrdem" value="4" />&nbsp; Validade<br><br>
                                   
                            <input type="submit" class="btn" id="" name="" value="Pesquisar"/>
                </form>
    </div>
    </div>
    </div>
    <div class="row-fluid text-center">
            <div class="span12">
                <small><?php print RODAPE;?></small>
            </div>
        </div>
    </div>
    <script src="/js/jquery.js"></script>
    <script src="/js/bootstrap.js"></script>
    <script src="/js/jasny-bootstrap.js"></script>
    </body>
    </html>
