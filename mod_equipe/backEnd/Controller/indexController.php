<?php include_once('core/Controller/Controller.php');
    class IndexController extends Controller
    {

        public function Index(){
            
            $dsp = RegistroDspEquipeModel::listaDsp(50);
            include_once 'mod_equipe/backEnd/View/equipe/index.php';
        }
        
        

    }
    


?>