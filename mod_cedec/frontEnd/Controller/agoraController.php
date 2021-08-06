<?php include_once('core/Controller/Controller.php');
    class AgoraController extends Controller
    {
        /* Index */
        public function index(){
            include_once 'mod_cedec/View/agora/index.php';
        }
        
        /* Cadastro */
        public function cadadm(){
            include_once 'mod_cedec/View/agora/cadadm.php';
        }

        /* Cadastro */
        public function editar(){
            include_once 'mod_cedec/View/agora/editar.php';
        }

        /* Cadastro */
        public function cadastro(){
            include_once 'mod_cedec/View/agora/cadastro.php';
        }
        /* validar */
        public function valida(){
            include_once 'mod_cedec/View/agora/valida.php';
        }
        /* lista */
        public function lista(){
            include_once 'mod_cedec/View/agora/lista.php';
        }
        /* lista */
        public function listasite(){
            include_once 'mod_cedec/View/agora/listasite.php';
        }
        /* lista */
        public function view(){
            include_once 'mod_cedec/View/agora/view.php';
        }
        /* BUSCA */
        public function busca(){
            include_once 'mod_cedec/View/agora/busca.php';
        }
        
        
        
    
    
}?>