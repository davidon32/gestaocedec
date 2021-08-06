<?php session_start();
include_once "../include.php";

$_conexao = new ConexaoMysql();

$_usuario = new Usuario();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php print TITULO; ?></title>
<link href="<?php print SISTEMA; ?>/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="<?php print SISTEMA; ?>/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
</head>
<body>
    <div class="container">
    <br>
    <form action="sc.reseta.senha.usuario.php" method="POST">
        <table>
            <tr>
                <td>Resetar Senha usuário</td>
            </tr>
            <tr>
                <td><?php $_usuario -> getNomeUsuarioRetId(); ?></td>
                <td><input class="btn btn-primary" type="submit" value="Resetar" name="btn_enviar"></td>
            </tr>
            
        </table>
    </form>
        <a class="btn btn-primary" href="../secao.php?secao=adm&acao=a">Voltar</a>
    
    </div>
    </body>
    </html>
    
<?php

        $_btn_enviar = isset($_POST['btn_enviar']) ? $_POST['btn_enviar'] : "";

        $_id_usuario = isset($_POST['login']) ? $_POST['login'] : "";

        if ($_btn_enviar != "") {

            $_resetar = $_usuario -> resetaSenha($_id_usuario);

            if ($_resetar) {

                print "<script type=\"text/javascript\">";

                print "alert('Senha resetada com Sucesso !');";

                print "window.location('core/sc.reseta.senha.usuario.php');";

                print "</script>";

            }
        }
    ?>