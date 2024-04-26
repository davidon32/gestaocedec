<?php include_once "core/Controller/Controller.php";
    include_once "core/Model/Model.php";
    class cceController extends Controller
    {

        #index
        public function index()
        {
            include_once "mod_cce/backEnd/View/index/indexView.php";
        }

        #diario
        public function diario()
        {
            include_once "mod_cce/backEnd/View/diario/diario.php";
        }
        
        # filtro diario relatorio
        public function filtroRelDiario()
        {
            include_once "mod_cce/backEnd/View/relatorio/filtroRelDiario.php";
        }
        # diario relatorio
        public function relDiario()
        {
            include_once "mod_cce/backEnd/View/relatorio/relDiario.php";
        }
        #historico
        public function historicoView()
        {
            include_once "mod_cce/backEnd/View/diario/historicoView.php";
        }

        # lanca Diario
        public function lancDiario()
        {
            include_once "mod_cce/backEnd/View/diario/lancDiario.php";
        }

        # alterar Historico
        public function alterarHist()
        {
            include_once "mod_cce/backEnd/View/diario/alterarHist.php";
        }
       
        # boletim
        public function boletim()
        {
            include_once "mod_cce/backEnd/View/boletim/index.php";
        }

        # novo
        public function novo()
        {
            include_once "mod_cce/backEnd/View/boletim/novo.php";
        }
        # boletim Site
        public function boletimsite()
        {
            $anos = Boletim::getBoletimAno();
            include_once "mod_cce/backEnd/View/relatorio/boletimSite.php";
        }



        




        
    }
    