<?php session_start();
    header("Cache-Control: no-cache, must-revalidate");
    include_once PATH.'/include.php';

    $_conexao = new ConexaoMysql();

    $_login = new Login();

    $_login->logado();
    
    $_liberacao = new Liberacao();

$_opcao = isset($_GET['opcao']) ? $_GET['opcao'] : "";
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Cancelamento de Liberacao <?php print TITULO;?></title>
        <link href="/css/bootstrap.css" rel="stylesheet" media="screen">
        <link href="/css/bootstrap-responsive.css" rel="stylesheet" media="screen">

    </head>
    <body>
        <div class="container">
            <div class="span12 text-center">
                <br>
<?php


if($_opcao == 'cancela'){

    //var_dump($_POST);

    $_txt_id_libera = isset($_POST['txt_id_libera']) ? $_POST['txt_id_libera'] : ""; 
    $_txt_motivo    = isset($_POST['txt_motivo'])    ? $_POST['txt_motivo']    : ""; 
    $_btn_cancela   = isset($_POST['btn_cancela'])   ? true                    : "";

        if($_btn_cancela && !empty($_txt_id_libera)){

            $_liberacao->cancelaLiberacao($_txt_id_libera, $_txt_motivo);
            
            Log::GravaLog("Cancelamento liberacao Nr : ".$_txt_id_libera, "aju_log");

        }
        
}
        
        
?>
</div>
</div>