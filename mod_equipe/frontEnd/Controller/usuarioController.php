<?php include_once 'core/include.php';
include_once PATH.'/core/Controller/Controller.php';
include_once PATH.'/core/Model/UsuarioModel.php';

class usuarioController extends Controller {

    public function perfil(){
        include_once 'mod_equipe/View/usuario/view.php';
    }

    # editar
    public function editar(){
        include_once 'mod_equipe/View/usuario/editar.php';
    }


    # recuperar senha separa usuario
    public function recsenha(){
        include_once 'mod_equipe/View/usuario/recsenha_user.php';
    }
    
    # recuperar senha
    public function recsenha_busca(){
        if($_POST['selUser'] == 0){
        include_once 'mod_equipe/View/usuario/recsenha_compdec.php';
        }else {
            include_once 'mod_equipe/View/usuario/recsenha_cedec.php';
        }
    }

    # trocar senha
    public function trsenha(){
        include_once 'mod_equipe/View/usuario/trsenha.php';
    }
    
    # salvar dados usuario
    public function salvar(){
        include_once 'mod_equipe/View/usuario/valida.php';
    }
    
}