<?php include_once('core/Controller/Controller.php');
    class IndexController extends Controller
    {

        public function Index(){
            include_once 'mod_cedec/backEnd/View/index/index.php';


        }
        
        public function vars() {
            include_once "mod_cedec/backEnd/View/index/vars.php";
        }
        
    }
    


?>