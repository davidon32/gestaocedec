<?php include_once('core/Controller/Controller.php');

class docController extends Controller
{

    # index ajuda geral
    public function index(){
        include_once "mod_doc/backEnd/View/index.php";

    }

     # manual ajuda humanitaria
    public function ajuda(){
        include_once "mod_doc/backEnd/View/ajuda.php";
    }
    
     # manual html
    public function ajudahtml(){
        include_once "mod_doc/backEnd/View/ajuda_html.php";
    }

   
    # manual Centro de Emergencia (DRD)
    public function drd(){
        include_once "mod_doc/backEnd/View/cce.php";
    }

    # manual Compdec
    public function compdec(){
        include_once "mod_doc/backEnd/View/compdec.php";
    }

    # manual Decreto
    public function decreto(){
        include_once "mod_doc/View/decreto.php";
    }

     # manual Escola
    public function escola(){
        include_once "mod_doc/View/escola.php";
    }

    # manual CEDEC
    public function cedec(){
        include_once "mod_doc/backEnd/View/cedec.php";
    }

    # manual Equipe Apoio
    public function equipe(){
        include_once "mod_doc/backEnd/View/equipe.php";
    }

    # manual infra
    public function infra(){
        include_once "mod_doc/backEnd/View/infra.php";
    }
    # manual infra
    public function link(){
        include_once "mod_doc/backEnd/View/link.php";
    }

    # boas praticas
    public function dicas(){
        include_once "mod_doc/backEnd/View/dicas.php";
    }
  


    
}



?>