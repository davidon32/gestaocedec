<?php include_once('core/Controller/Controller.php');

class docController extends Controller
{

    # index ajuda geral
    public function index(){
        include_once "mod_doc/frontEnd/View/index.php";

    }

    # manual ajuda humanitaria
    public function ajuda(){
        include_once "mod_doc/frontEnd/View/ajuda.php";
    } 
   
    # plano de contingencia
    public function plano(){
        include_once "mod_doc/frontEnd/View/plano.php";
    }

    # manual Compdec
    public function compdec(){
        include_once "mod_doc/frontEnd/View/compdec.php";
    }
    
    ################# download ##################
        public function download(){
            return FuncaoBase::download($_GET['arquivo']);
        }
    
}



?>