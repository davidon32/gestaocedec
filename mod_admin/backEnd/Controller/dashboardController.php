<?php include_once PATH.'/core/include.php';
include_once "core/Controller/Controller.php";

    class dashboardController extends Controller{

        /* Cadastrar Usuario */
        public function dashboard(){
            $dashboard = new dashboardModel();
            
            $dados['atualizado'] = $dashboard->atualizados();
            $dados['desatualizados'] = $dashboard->desatualizados();
            include_once('mod_admin/backEnd/View/dashboard/dashboard.php');

        }
        
    
}