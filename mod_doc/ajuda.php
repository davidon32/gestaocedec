<?php session_start();
include_once 'include.php';

$_conexao = new ConexaoMysql();

$_login = new Login();

    $_login->logado();

    $_login->Sessao();
    
    $_login->VerificaBrowser();

$_funcaoBase = new FuncaoBase();

 
?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php print TITULO;?></title>
        <link href="css/bootstrap.css" rel="stylesheet" media="screen">
        <link href="css/bootstrap-responsive.css" rel="stylesheet" media="screen">

<html>
    <head>
        <title></title>
    </head>
    <body>
        
        <div class="container">
            <div class="row">
                <br>
                <div class="span12 text-center">
                    <?php $_funcaoBase::vifs('volta','index2.php') ?>
                </div>
            </div>
            <div class="row">
                <div class="span12">
                    <br>
                    <legend>Manual do Sistema de Gestão Estratégica da Defesa Civil de Minas Gerais</legend>
                    <br>
                
            
                    <a href="doc/secao.php?op=ajuda">Módulo Ajuda Humanitária</a>
                    <br>
                    <a href="doc/secao.php?op=pipa">Módulo Pipa</a>
                    <br>
                    <a href="doc/secao.php?op=dce">Módulo Centro de Emergência</a>
                    <br>
                    <a href="doc/secao.php?op=compdec">Módulo Compdec</a>
                    <br>
                    <a href="doc/secao.php?op=dtec">Módulo Decreto</a>
                    <br>
                    <a href="doc/secao.php?op=escola">Módulo Escola</a>
                    <br>
                    <a href="doc/secao.php?op=cedec">Módulo CEDEC</a>
                    <br>
                    <a href="doc/secao.php?op=equipe">Módulo Equipe de Apoio</a>
                </div>
            </div>
        </div>
    </body>
    
</html>

