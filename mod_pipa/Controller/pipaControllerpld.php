<?php include_once PATH."/core/Controller/Controller.php";
    include_once "core/Model/Model.php";
    class pipaController extends Controller
    {


        public function index()
        {
            include_once "mod_pipa/View/index/indexView.php";
            //var_dump($pageSession);
        }

        # usuario index
        public function usuario(){

            include_once "mod_pipa/View/usuario/indexView.php";

        }

        #cadastro Usuario
        public function caduser(){

            include_once "mod_pipa/View/usuario/caduserView.php";

        }

        # pesquisa usuario
        public function pesquisaUsuario(){

            include_once "mod_pipa/View/usuario/pesquisaUsuarioView.php";

        }

        #altera Usuario
        public function cUserEx(){

            include_once "mod_pipa/View/usuario/cExUserView.php";

        }

        #pmda
        public function pmda(){
            include_once "mod_pipa/View/pmda/indexView.php";


        }

        #pesquisa pmda
        public function pesquisaPmda(){
            include_once "mod_pipa/View/pmda/pesquisaPmdaView.php";

        }

        #visualizar PMDA
        public function printView(){
            include_once "mod_pipa/View/pmda/printView.php";

        }

        #impressao PMDA
        public function printPmda(){
            include_once "mod_pipa/View/pmda/printPmdaView.php";

        }
        
        #visualizar MapaA
        public function printPmdaMapa(){
            include_once "mod_pipa/View/pmda/printPmdaMapa.php";

        }

        #historico mensagem 
        public function historicoMsg(){
            include_once "mod_pipa/View/pmda/mensagemView.php";

        }

        # comunidade 
        public function pmdaCom(){
            include_once "mod_pipa/View/comunidade/pmdaComView.php";

        }
        # cad Com 
        public function cadcom(){
            include_once "mod_pipa/View/comunidade/cadcom.php";

        }
        # validar comunidade 
        public function valcom(){
            include_once "mod_pipa/View/comunidade/valcom.php";

        }

        # alterar comunidade 
        public function alteraComunidade(){
            include_once "mod_pipa/View/comunidade/altera.php";

        }

        #mensagem
        public function mensagem(){
            include_once "mod_pipa/View/pmda/mensagemView.php";
            
        }
        
        #declaracao
        public function declaracao(){
            include_once "mod_pipa/View/pmda/declaracao.php";
        }

        # cadastro comunidade
        public function precadcom()
        {
            include_once "mod_pipa/View/comunidade/precadcom.php";
        }
        
        # termo compromisso
        public function termo()
        {
            include_once "mod_pipa/View/pmda/termo.php";
        }

        # termo compromisso
        public function declaracaoiss()
        {
            include_once "mod_pipa/View/pmda/declaracao.php";
        }
        
        
        public function declaracaoiss()
        {
            include_once "mod_pipa/View/pmda/declaracao.php";
        }
        
        
        
        




        
    }
    