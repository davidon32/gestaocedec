<?php include_once "core/Controller/Controller.php";
    include_once "core/Model/Model.php";

Class planoController extends Controller
    {


        public function index()
        {
            include_once "mod_compdec/backEnd/View/index/indexView.php";
        }

        # usuario index
        public function planoBusca(){

            include_once "mod_compdec/backEnd/View/plano/planobusca.php";

        }
        # usuario visualizar anexo
        public function vupload(){

            include_once "mod_compdec/backEnd/View/plano/vupload.php";

        }

        # usuario visualizar anexo
        public function indexplano(){
            include_once "mod_compdec/backEnd/View/plano/indexplano.php";
        }
        
        # Lista de planos
        public function listacomplano(){
            
            $opcao = "lista_com_plano";
            include_once "mod_compdec/backEnd/View/relatorio/lista_plano.php";
        }
        # Lista de planos
        public function listasemplano(){
            $opcao = "lista_sem_plano";
            include_once "mod_compdec/backEnd/View/relatorio/lista_plano.php";
        }
        # Lista de planos
        public function listageral(){
            $opcao = "lista_geral";
            include_once "mod_compdec/backEnd/View/relatorio/lista_plano.php";
        }
        # Lista de planos
        public function listakit(){
            $opcao = "listakit";
            include_once "mod_compdec/backEnd/View/relatorio/lista_plano.php";
        }

           




        
    }

    ?>
    