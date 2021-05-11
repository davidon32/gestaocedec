<?php include_once "core/Controller/Controller.php";
    include_once "core/Model/Model.php";

Class planoController extends Controller
    {


        public function index()
        {
            include_once "mod_compdec/frontEnd/View/plano/index.php";
        }

        # usuario index
        public function planoBusca1(){

            include_once "mod_compdec/View/plano/planobusca.php";

        }
        
        # usuario visualizar anexo
        public function indexplano(){
            include_once "mod_compdec/View/plano/indexplano.php";
        }

           




        
    }

    ?>
    