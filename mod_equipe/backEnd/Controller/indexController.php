<?php include_once('core/Controller/Controller.php');
    class IndexController extends Controller
    {

        public function Index(){
            
            $listdsp = new RegistroDspEquipeModel();
            $dsp = $listdsp->listaDsp(50);
            include_once 'mod_equipe/backEnd/View/equipe/index.php';
        }
        
        

    }
    


?>