<?php

include_once 'core/include.php';

#@ nome do usuario 
$_nome = isset($_POST['nome']) ? $_POST['nome'] : null;

#@ Geracao de login de usuario
//$_login = Login::GeraLogin();
#@ senha 
$_senha = isset($_POST['senha']) ? md5($_POST['senha']) : null;

#@ email
$_email = isset($_POST['email']) ? $_POST['email'] : "";

#@ identificador do deposito
$_id_deposito = isset($_POST['id_deposito']) ? $_POST['id_deposito'] : "";

#@ nivel de acesso usuario
$_nivel = isset($_POST['nivel']) ? $_POST['nivel'] : 0;

#@ situacao do usuario
$_situacao = isset($_POST['situacao']) ? $_POST['situacao'] : 0;

#@ modulos
$_m_deposito = isset($_POST['ajuda']) ? $_POST['ajuda'] : 0;
$_m_pipa = isset($_POST['pipa']) ? $_POST['pipa'] : 0;
$_m_cce = isset($_POST['cce']) ? $_POST['cce'] : 0;
$_m_decretacao = isset($_POST['decretacao']) ? $_POST['decretacao'] : 0;
$_m_comdec = isset($_POST['comdec']) ? $_POST['comdec'] : 0;
$_m_apoio = isset($_POST['apoio']) ? $_POST['apoio'] : 0;
$_m_poco = isset($_POST['poco']) ? $_POST['poco'] : 0;
$_m_escola = isset($_POST['escola']) ? $_POST['escola'] : 0;

$id = isset($_POST['id_usuario']) ? $_POST['id_usuario'] : "";

if (($_COOKIE['seguranca']['adm']) && (!empty($id))) {

    if (Usuario::AtualizarUsuario($_POST)) {
        print "<script type=\"text/javascript\">";
        print "alert('Dados atualizados com Sucesso !');";
        print "history.back();";
        print "</script>";
    }
} else {

    if ($_nome != null && $_senha != null) {

        $_cad_usuario_cedec = Usuario::CadastraUsuarioCedec($_id_deposito,
                        $_nome,
                        $_senha,
                        $_email,
                        $_nivel,
                        $_situacao,
                        $_login,
                        $_m_deposito,
                        $_m_pipa,
                        $_m_cce,
                        $_m_decretacao,
                        $_m_comdec,
                        $_m_apoio,
                        $_m_poco,
                        $_m_escola);


        if ($_cad_usuario_cedec) {

            FuncaoBase::alert('Cadastro Realizado Com Sucesso !!');

            print "<script type=\"text/javascript\">";

            print "window.location('core/valida.cadastro.usuario.php');";

            print "</script>";
        } else {

            print "<script type=\"text/javascript\">";

            print "alert('Erro ao Cadastrar Usuários !')";

            print "</script>";
        }
    }
}
?>