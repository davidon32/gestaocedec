<?php include_once "core/Controller/Controller.php";
    include_once "core/Model/Model.php";
    class compdecController extends Controller
    {


        public function index() {
            
            include_once "mod_compdec/frontEnd/View/compdec/index.php";
        }
        
        public function compdec() {
            
            include_once "mod_compdec/frontEnd/View/compdec/alterarCompdec.php";
        }

        #salvar compdec
        public function valida(){
            include_once "mod_compdec/frontEnd/View/compdec/valida.php";
        }
        
        /* Visualizar dados compdec */
        public function visualizar(){
            include_once "mod_compdec/frontEnd/View/compdec/visualizar.php";
        }

        
        # visualiza plano de Contigência
        public function plano(){
            include_once "mod_compdec/frontEnd/View/plano/plancont.php";
        }
        
        
        
        
        ################# download ##################
        public function download(){
            return FuncaoBase::download($_GET['arquivo']);
        }

   
    }
    