<?php include_once('core/Controller/Controller.php');
    
    class MunicipioController extends Controller
    {

        public function index(){
            include_once 'mod_cedec/backEnd/View/municipio/index.php';
        }
        public function buscar(){
            include_once 'mod_cedec/backEnd/View/municipio/buscar.php';
        }

        public function cadastrar(){
            include_once 'mod_cedec/backEnd/View/municipio/cadastrar.php';
        }
        
        # index relatorio
        public function rel(){
            include_once 'mod_cedec/backEnd/View/municipio/relatorio/relbusca.php';
        }
        
        # relatorio de email
        public function rel_email(){
            $dados = Municipio::rel_email();
            include_once 'mod_cedec/backEnd/View/municipio/relatorio/rel_email.php';
        }
        
        # relatorio de email outlook CA
        public function rel_email_ca(){
            $total = 0;
            $dados = Municipio::rel_email('existente');
            foreach ($dados as $value) {
                if(strlen($value['email']) > 0){
                    $total++;
                }
            }
            include_once 'mod_cedec/backEnd/View/municipio/relatorio/rel_email_ca.php';
        }
        
    }
    


?>