<?php include_once PATH."/core/Controller/Controller.php";
    include_once PATH."/core/Model/Model.php";

class indexController extends Controller
{

    public function index()
    {  

        include_once "template/page/login.php";
    }

    public function logar(){

        $login = new Login();
        $loginExterno = new LoginExterno();

        $usuarioLogin = trim($_POST['login']);
        $senha = md5(trim($_POST['senha']));
        
        $logar = $login->logar($usuarioLogin, $senha);

       if($logar == "indexAdm"){
            
            print "<script style='text/javascript'>";
			print "window.location = 'index.php?token=".hash('sha256', md5(VERSAO)."-".time()."-".time())."&ac=itn&ac=&modulo=index&controller=index&action=index1'";
            print "</script>";
       }else if($logar == "trsenha"){

            print "<script type='text/javascript'>";
		    print "window.location = 'index.php?token=".hash('sha256', md5(VERSAO)."-".time())."&ac=itn&ac=&modulo=equipe&controller=usuario&action=trsenha_cedec';";
			print "</script>";
       }else {
           
        $logarExterno = $loginExterno->logarExterno($usuarioLogin, $senha);

            /** login frontend */
            if($logarExterno == "index"){
                    print "<script style='text/javascript'>";
                    print "window.location = 'index.php?token=".hash('sha256', md5(VERSAO)."-".time())."&ac=etn&modulo=index&controller=index&action=index1e'";
                    print "</script>";
            
            # troca de senha externo
            }else if($logarExterno['acesso'] == "trsenha"){
                $param = md5('use70');
                $usuario = new Usuario();
                
                
                if(empty($logarExterno['reset'])){
                    print "<script type='text/javascript'>";
                            print "window.location = 'index.php?token=".hash('sha256', md5(VERSAO)."-".time())."&modulo=equipe&controller=usuario&action=trsenha_compdec&has=".$param."';";
                                print "</script>";
                    
                }else { # 
                    $usuario->getResetUsuarioEx($logarExterno['reset']);
                    print "<script type='text/javascript'>";
                            print "window.location = 'index.php?token=".hash('sha256', md5(VERSAO)."-".time())."&modulo=equipe&controller=usuario&action=trsenha_compdec&has=".$param."&res=".$logarExterno['reset']."';";
                                print "</script>";
                }
            /*alterar dados usuario */
            }else if($logarExterno == "perfil"){
                print "<script style='text/javascript'>";
                print "window.location = 'index.php?token=".hash('sha256', md5(VERSAO)."-".time())."&ac=etn&modulo=equipe&controller=usuario&action=editar'";
                print "</script>";
           }else if($logarExterno == "mozila") {
                    print "<script type='text/javascript'>";
                    print "alert(\"Navegador não Homologado !\");";
                    print "history.back();";
                    print "</script>";
           }else {

                    print "<script type='text/javascript'>";
                    print "alert(\"Usuario ou Senha invalida !-\");";
                    print "history.back();";
                    print "</script>";
                    //Log::GravaLog($_POST['login']."-".$_POST['senha'], 'cedec_log');
            }
       }
               
    }

    
    public function  index1(){
        
        $id_usuario = $_COOKIE['seguranca']['idUser'];
        
        $numAcesso = Login::pegaQtdAcesso($id_usuario);
        
        if($numAcesso[0]['qtd_acesso'] >= 3){
            Login::atualizaAcesso($id_usuario, 0);
            print "<script style='text/javascript'>";
                    print "window.location = '".FuncaoBase::geraLink("equipe", "funcionario", "alterar")."'";
                    print "</script>";
        }else {
            Login::atualizaAcesso($id_usuario, 1);
            include_once 'mod_index/backEnd/View/index/index.php';
        }
        
    }
    
    

    public function menu(){
        include_once 'mod_index/backEnd/View/index/index2.php';
    }

    #########################    acesso externo  ####################

    /* painel inicial notificacoes */
    public function index1e(){
        include_once 'mod_index/frontEnd/View/index/index.php';
    }

    /** menu de acesso modulos  */
    public function menue(){
        include_once 'mod_index/frontEnd/View/index/index2.php';
    }

    # editar
    public function logout(){

        if(!isset($_COOKIE['seguranca']['externo'])){
            Login::UnsetCookieAdm();
        }else {
            LoginExterno::UnsetCookieExterno();

        }
        print '<script>
		window.location = "index.php";
            </script>';
    }
    
}



