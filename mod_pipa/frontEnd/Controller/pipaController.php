<?php include_once PATH."/core/Controller/Controller.php";
    include_once "core/Model/Model.php";
    class pipaController extends Controller
    {


        public function index()
        {
            include_once "mod_pipa/frontEnd/View/index/indexView.php";
        }

        # usuario index
        public function usuario(){

            include_once "mod_pipa/frontEnd/View/usuario/indexView.php";

        }

        #cadastro Usuario
        public function caduser(){

            include_once "mod_pipa/frontEnd/View/usuario/caduserView.php";

        }

        # pesquisa usuario
        public function pesquisaUsuario(){

            include_once "mod_pipa/frontEnd/View/usuario/pesquisaUsuarioView.php";

        }

        #altera Usuario
        public function cUserEx(){

            var_dump($_POST);
            include_once "mod_pipa/frontEnd/View/usuario/cExUserView.php";

        }

        #pmda index
        public function pmdaidx(){
            LoginExterno::ultimoAcesso($_COOKIE['seguranca']['id_municipio']);
            include_once "mod_pipa/frontEnd/View/pmda/indexView.php";
        }
        #pmda editar
        public function pmda(){
            include_once "mod_pipa/frontEnd/View/pmda/pmda.php";
        }

        #pesquisa pmda
        public function pesquisaPmda(){
            include_once "mod_pipa/frontEnd/View/pmda/pesquisaPmdaView.php";

        }

        #visualizar PMDA
        public function printView(){
            include_once "mod_pipa/frontEnd/View/pmda/printView.php";

        }

        #impressao PMDA
        public function printPmda(){
            include_once "mod_pipa/frontEnd/View/pmda/printPmdaView.php";

        }
        
        #visualizar MapaA
        public function printPmdaMapa(){
            include_once "mod_pipa/frontEnd/View/pmda/printPmdaMapa.php";

        }

        #historico mensagem 
        public function historicoMsg(){
            include_once "mod_pipa/frontEnd/View/pmda/mensagemView.php";

        }

        # comunidade 
        public function pmdaCom(){
            include_once "mod_pipa/frontEnd/View/comunidade/pmdaComView.php";

        }
        # cad Com 
        public function cadcom(){
            include_once "mod_pipa/frontEnd/View/comunidade/cadcom.php";

        }
        

        # alterar comunidade 
        public function alteraComunidade(){
            include_once "mod_pipa/frontEnd/View/comunidade/altera.php";

        }

        #mensagem
        public function mensagem(){
            include_once "mod_pipa/frontEnd/View/pmda/mensagemView.php";
            
        }
        
        #declaracao
        public function declaracao(){
            include_once "mod_pipa/frontEnd/View/pmda/declaracao.php";
        }

        # cadastro comunidade
        public function precadcom()
        {
            include_once "mod_pipa/frontEnd/View/comunidade/precadcom.php";
        }
        
        # termo compromisso
        public function termo()
        {
            include_once "mod_pipa/frontEnd/View/pmda/termo.php";
        }

        # termo compromisso
        public function declaracaoiss()
        {
            include_once "mod_pipa/frontEnd/View/pmda/declaracao.php";
        }
        
        
        # termo compromisso
        public function listaComunidadeParaPmda()
        {
            include_once "mod_pipa/classe/Classe.Comunidade.php";

            $comunidade = new Comunidade();
            $result = $comunidade->listaComunidadeParaPmda($_POST['municipio'], $_POST['comunidade']);
            return $result;

        }
        
        /* apagar pmda compdec */
    public function deletePmda(){

        $id_pmda = $_GET['param'];
        $id_municipio = $_GET['idmun'];
        if(Pmda::deletePmda($id_pmda)){
            
            print "<script>
	 		alert('Pmda deletado com Sucesso !');
                        window.location.href = '".FuncaoBase::geraLink("pipa", "pipa", "pmdaidx")."';
                    </script>";
       }
    }
    
    
    /*
    * Alterar as Comunidades do processo PMDA 
    * Após ser atendido status 7
    */
    public function alt_com_proc(){
            include_once "mod_pipa/frontEnd/View/pmda/altera_comunidade_processo.php";

        }
        
 
    
    }
    