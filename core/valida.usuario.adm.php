<?php session_start();
include_once 'include.php';

$_conexao = new ConexaoMysql();

$_login = new Login();

$usuario = isset($_POST['login']) ? $_POST['login'] : null;

$senha = isset($_POST['senha']) ? $_POST['senha'] : null;

$dados = $_login -> logarAdm($usuario, md5($senha), $redireciona = true);

var_dump($_POST);

if ((($usuario != "") && ($usuario != null)) && (($senha != "") && ($senha != null))) {

    if (count($dados) == 0) {

        #@ redirecionar em case de erro de senha e usuario
        print '<script> alert("Usuario ou Senha invalida !");';
        
        print 'history.back();';
        
        print '</script>';

        print "<script style='text/javascript'>";

        print "window.location = 'index.php'";

        print "</script>";

    } else {

        #@ se o usuario existir inicia sessao e adiciona os dados nela

        /* $_SESSION['seguranca'] = array('login' => $dados['login'],
                                       'nivel' => $dados['nivel'],
                                       'idUsuario' => $dados['id_usuario'],
                                       'id_funcionario' => $dados['id_funcionario']); */

        if ($redireciona) {

            Log::GravaLog('Acesso ao Painel Administrativo', 'cedec_log');
            
            #@ se redirecionar for necessario
            print "<script style='text/javascript'>";

            print "window.location = 'secao.php?secao=adm&acao=menu'";

            print "</script>";

        }
    }

} else {

    print '<script> alert("Usuario ou Senha em Branco !");
        history.back();</script>';
}?>