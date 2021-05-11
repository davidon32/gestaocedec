<?php include_once('core/Controller/Controller.php');
    
    class MunicipioController extends Controller
    {

        public function buscar(){
            include_once 'mod_cedec/View/municipio/buscar.php';
        }

        public function cadastrar(){
            include_once 'mod_cedec/View/municipio/cadastrar.php';
        }
        
    }
    


?>