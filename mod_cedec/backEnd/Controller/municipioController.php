<?php include_once('core/Controller/Controller.php');
    
    class MunicipioController extends Controller
    {

        public function buscar(){
            include_once 'mod_cedec/backEnd/View/municipio/buscar.php';
        }

        public function cadastrar(){
            include_once 'mod_cedec/backEnd/View/municipio/cadastrar.php';
        }
        
    }
    


?>