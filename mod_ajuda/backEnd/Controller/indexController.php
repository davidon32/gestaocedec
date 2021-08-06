<?php include_once('core/Controller/Controller.php');
    class IndexController extends Controller
    {

        public function Index(){
            include_once 'mod_ajuda/backEnd/View/index/index.php';
        }
        
        public function ComEstoque(){
            include_once 'mod_ajuda/backEnd/View/conEstoque/index.php';
        }

    }
    


?>