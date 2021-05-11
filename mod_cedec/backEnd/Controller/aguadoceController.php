<?php include_once('core/Controller/Controller.php');
    class AguaDoceController extends Controller
    {
        /* Index */
        public function index(){
            include_once 'mod_cedec/View/aguadoce/index.php';
        }
        
        /* Cadastro */
        public function cadadm(){
            include_once 'mod_cedec/View/aguadoce/cadadm.php';
        }

        /* Cadastro */
        public function editar(){
            include_once 'mod_cedec/View/aguadoce/editar.php';
        }

        /* Cadastro */
        public function cadastro(){
            include_once 'mod_cedec/View/aguadoce/cadastro.php';
        }
        /* validar */
        public function valida(){
            include_once 'mod_cedec/View/aguadoce/valida.php';
        }
        /* lista */
        public function lista(){
            include_once 'mod_cedec/View/aguadoce/lista.php';
        }
        /* lista */
        public function listasite(){
            include_once 'mod_cedec/View/aguadoce/listasite.php';
        }
        /* lista */
        public function view(){
            include_once 'mod_cedec/View/aguadoce/view.php';
        }
        /* BUSCA */
        public function busca(){
            include_once 'mod_cedec/View/aguadoce/busca.php';
        }
        
    }
    


?>