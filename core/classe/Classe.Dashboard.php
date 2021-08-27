<?php include_once PATH.'/core/include.php';
include_once "core/Controller/Controller.php";

    class Dashboard extends Controller{

        public function dashboard(){
            
        }
        
        /* Cadastros Compdec Atualizados */
        public function atualizado(){
            $dashboard = new dashboardModel();      
            $dados['atualizado'] = $dashboard->CompdecAtualizados();
            $dados['desatualizados'] = $dashboard->CompdecDesatualizados();
            $dados['possuiCompdec'] = $dashboard->Possuicompdec();
            include_once('mod_admin/backEnd/View/dashboard/cadastro_compdec.php');
        }
        
        /* Ajuda Humanitaria */
        public function ajudaHumanitaria(){
            $dashboard = new dashboardModel();      
            //$dados['possuiCompdec'] = $dashboard->CompdecAtualizados();
            include_once('mod_admin/backEnd/View/dashboard/ajuda_humanitaria.php');
        }

        /* Qtd PMDA */
        public static function qtdPmda($ano = ''){
            $dashboard = new dashboardModel();
            $pmdaQtdPorAno = $dashboard->QtdPmdaAno($ano);
            include_once('mod_admin/backEnd/View/dashboard/ano.php');
        }
        
        /* Pmda Ano */
        public static function pmdaAno($ano = ""){
            $dashboard = new dashboardModel();
            $pmdaPorAno = $dashboard->PmdaPorAno($ano);
            //include_once('mod_admin/backEnd/View/dashboard/ano.php');
        }
        
        public static function qtdPmdaPorMes($ano){
            $dashboard = new dashboardModel();
            $pmdaPorAnoMes = $dashboard->qtdPmdaMes($ano);
            include_once('mod_admin/backEnd/View/dashboard/anomes.php');
        }
        
            //$pmdaPorAnoMes = $dashboard->PmdaPorAnoMes();
        /* Decretação */
        public function decreto(){
            $dashboard = new dashboardModel();      
            //$dados['possuiCompdec'] = $dashboard->CompdecAtualizados();
            include_once('mod_admin/backEnd/View/dashboard/decretacao.php');
        }
        
        
}