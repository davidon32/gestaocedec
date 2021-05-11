<?php include_once $_SERVER['DOCUMENT_ROOT'].'/core/include.php';
include_once "core/Controller/Controller.php";
    include_once "core/Model/Model.php";
    class AppController extends Controller
    {

        public function gravarleis(){  
            include_once "mod_compdec/backEnd/View/compdec/valida.php";   
        }


        public function deletarleis(){
            
            $anexoFoto = new AnexoCompdec();

            $anexoFoto->deletar($_POST['id_anexo']);
            chdir(PATH.'/anexo/anexo_leis');
            $dirAnexo = getcwd();
            try{
                unlink($dirAnexo.'/'.$_POST['arquivo']);
            }catch (Exception $e){

            }

            print "sucesso";
            
            //include_once $_SERVER['DOCUMENT_ROOT'].'/mod_compdec/backEnd/View/compdec/anexo.php';
        }

        # usuario visualizar anexo
        public function vupload(){

            include_once "mod_compdec/View/plano/vupload.php";

        }




       
    }
    