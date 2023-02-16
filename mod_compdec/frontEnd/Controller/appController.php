<?php include_once $_SERVER['DOCUMENT_ROOT'].'/core/include.php';
include_once "core/Controller/Controller.php";
    include_once "core/Model/Model.php";
    class AppController extends Controller
    {

        public function gravarleis(){
            
            $anexoFoto = new AnexoCompdec();
            
            $files = isset($_FILES) ? $_FILES : "";
            $post  = isset($_POST)  ? $_POST  : "";

            //var_dump($_POST);
            //die();
            
            if($anexoFoto->gravarLeis($post, $files, "anexo/anexo_leis", "anexo_compde")){
                
                print "sucesso";
                //include_once $_SERVER['DOCUMENT_ROOT'].'/mod_compdec/View/compdec/anexo.php';
            }                
            
            
        }
        public function deletarleis(){
            
            $anexoFoto = new AnexoCompdec();

            $anexoFoto->deletar($_POST['id_anexo']);
            chdir(PATH.'/anexo/anexo_leis');
            $dirAnexo = getcwd();
            unlink($dirAnexo.'/'.$_POST['arquivo']);

            print "sucesso";
            
            //include_once $_SERVER['DOCUMENT_ROOT'].'/mod_compdec/View/compdec/anexo.php';


        }

        # usuario visualizar anexo
        public function vupload(){

            include_once "mod_compdec/View/plano/vupload.php";

        }




       
    }
    