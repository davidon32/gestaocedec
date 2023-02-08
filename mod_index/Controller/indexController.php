<?php

include_once PATH . "/core/Controller/Controller.php";
include_once PATH . "/core/Model/Model.php";

class indexController extends Controller {

    public function index() {

        include_once "template/page/login.php";
    }

    public function logar() {

        $login = new Login();
        $loginExterno = new LoginExterno();

        $usuarioLogin = trim($_POST['login']);
        $senha = md5(trim($_POST['senha']));
        $str_senha = $_POST['senha'];

        $logar = $login->logar($usuarioLogin, $senha);

        if ($logar == "indexAdm") {

            print "<script style='text/javascript'>";
            print "window.location = 'index.php?token=" . hash('sha256', md5(VERSAO) . date('dmY')) . "&ac=itn&ac=&modulo=index&controller=index&action=index1'";
            print "</script>";

            # troca senha se necessario    
        } else if ($logar == "trsenha") {

            print "<script type='text/javascript'>";
            print "window.location = 'index.php?token=" . hash('sha256', md5(VERSAO) . date('dmY')) . "&ac=itn&ac=&modulo=admin&controller=admin&action=troca_senha_cedec_esqueci';";
            print "</script>";
        } else {

            $logarExterno = $loginExterno->logarExterno($usuarioLogin, $str_senha);
                
            /** login frontend */
            if ($logarExterno['page'] == "index") {
                

                /* atualizar o cpf */
                if ($loginExterno::buscaCPF($logarExterno['id_municipio']) >0) {
                    print "<script style='text/javascript'>";
                    print "window.location = 'index.php?token=" . hash('sha256', md5(VERSAO) . date('dmY')) . "&ac=etn&modulo=compdec&controller=compdec&action=compdec'";
                    print "</script>";
                    
                } else {
                    print "<script style='text/javascript'>";
                    print "window.location = 'index.php?token=" . hash('sha256', md5(VERSAO) . date('dmY')) . "&ac=etn&modulo=index&controller=index&action=index1e'";
                    print "</script>";
                }

                # troca de senha externo
            } else if ($logarExterno['acesso'] == "trsenha") {
                $param = md5('use70');
                $usuario = new Usuario();


                if (empty($logarExterno['reset'])) {
                    print "<script type='text/javascript'>";
                    print "window.location = 'index.php?token=" . hash('sha256', md5(VERSAO) . date('dmY')) . "&modulo=equipe&controller=usuario&action=trsenha_compdec&has=" . $param . "';";
                    print "</script>";
                } else { # 
                    $usuario->getResetUsuarioEx($logarExterno['reset']);
                    print "<script type='text/javascript'>";
                    print "window.location = 'index.php?token=" . hash('sha256', md5(VERSAO) . date('dmY')) . "&modulo=equipe&controller=usuario&action=trsenha_compdec&has=" . $param . "&res=" . $logarExterno['reset'] . "';";
                    print "</script>";
                }
                /* alterar dados usuario */
            } else if ($logarExterno == "perfil") {
                print "<script style='text/javascript'>";
                print "window.location = 'index.php?token=" . hash('sha256', md5(VERSAO) . date('dmY')) . "&ac=etn&modulo=equipe&controller=usuario&action=editar'";
                print "</script>";
            } else if ($logarExterno == "mozila") {
                print "<script type='text/javascript'>";
                print "alert(\"Navegador não Homologado !\");";
                print "history.back();";
                print "</script>";
            } else {

                print "<script type='text/javascript'>";
                print "alert(\"Usuario ou Senha invalida !-\");";
                print "history.back();";
                print "</script>";
                //Log::GravaLog($_POST['login']."-".$_POST['senha'], 'cedec_log');
            }
        }
    }

    public function index1() {

        $id_usuario = $_COOKIE['seguranca']['idUser'];

        $numAcesso = Login::pegaQtdAcesso($id_usuario);

        if ($numAcesso[0]['qtd_acesso'] >= 20) {
            Login::atualizaAcesso($id_usuario, 0);
            print "<script style='text/javascript'>";
            print "window.location = '" . FuncaoBase::geraLink("equipe", "funcionario", "alterar") . "'";
            print "</script>";
        } else {
            Login::atualizaAcesso($id_usuario, 1);
            include_once 'mod_index/backEnd/View/index/index.php';
        }
    }

    public function menu() {
        include_once 'mod_index/backEnd/View/index/index2.php';
    }

    #########################    acesso externo  ####################

    /* painel inicial notificacoes */

    public function index1e() {
        include_once 'mod_index/frontEnd/View/index/index.php';
    }

    /** menu de acesso modulos  */
    public function menue() {
        include_once 'mod_index/frontEnd/View/index/index2.php';
    }

    # editar

    public function logout() {

        if (!isset($_COOKIE['seguranca']['externo'])) {
            Login::UnsetCookieAdm();
        } else {
            LoginExterno::UnsetCookieExterno();
        }
        print '<script>
		window.location = "index.php";
            </script>';
    }

    public function buscalogin() {

        include_once 'mod_index/View/busca_login.php';
    }

    /* informações gerais */

    public function info() {
        include_once 'mod_index/backEnd/View/info/info.php';
    }

    /* informações Usuarios */

    public function usuarioCedec() {

        if (isset($param['tipo'])) {
            $dados = Usuario::listaUsuario($param['tipo']);
        } else {
            $dados = Usuario::listaUsuario();
        }
        include_once 'mod_index/backEnd/View/info/lista_usuario.php';
    }

    /* informações Usuarios Regionais */

    public function usuarioRegionaisSite() {

        $_GET['tipo'] = 'regional';

        $dados = Usuario::listaUsuario();

        include_once 'mod_index/backEnd/View/info/lista_regionais_site.php';
    }

    /* lista de municipios pertencentes ao redec */

    public function lista_munic_reg_site() {

        try {

            $id = (int) $_GET['id_rpm'];


            $dados = Municipio::listaMunicipioRegional($id);
        } catch (Exception $e) {
            
        }
        include_once 'mod_index/backEnd/View/info/lista_municipio_reg_site.php';
    }

    public function lista_munic_reg() {

        $dados = array();

        $id = $_GET['id_rpm'];


        try {

            if (filter_var($id, FILTER_VALIDATE_INT)) {

                $dados = Municipio::listaMunicipioRegional($id);
            } else {
                throw new Exception();
                FuncaoBase::BloqueioIP($e->getMessage());
            }
        } catch (Exception $e) {

            FuncaoBase::BloqueioIP($e->getMessage());
        }

        include_once 'mod_index/backEnd/View/info/lista_municipio_reg.php';
    }

}
