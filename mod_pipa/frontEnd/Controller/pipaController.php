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

            include_once "mod_pipa/frontEnd/View/usuario/cExUserView.php";

        }

        #pmda index
        public function pmdaidx(){
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
        
        
        /**
         *  Duplicar pmda
         */
        public function duplicarPmda($param) {
            
            $dados['id_pmda'];
            $dados['pmda'];
            $dados['comun_pmda'];
            $dados['representante'];
            
            # pmda
            $sql_pmda = "select data, status, id_municipio, acoes, qtd_caminhão, pop_at_municipio from pip_pmda where id_pmda = ".$dados['id_pmda'];
            
            $result_pmda = $con->query($sql_pmda);
            $dados_pmda = array();
            while ($linha_pmda = $result){
                $dados_pmda[] = $linha_pmda;
            }
            $generics = new SqlGenerics();
            $generics->insert('pip_pmda', $dados_pmda);
            
            #pega id do pmda inserido
            

            /*# comunidades do pmda
            $sql_comun_pmda = "select id_pmda, id_comunidade, id_municipio, id_ponto, latitude, longitude, trecho_pav, trecho_n_pav, pop_atendida from pip_pmda_comun where id_pmda = ".$dados['id_pmda'];
            
            $result_comun_pmda = $con->query($sql_comun_pmda);
            $dados_pmda = array();
            
            # id do pmda novo
            array_push();
            while ($linha_comun_pmda = $result){
                $dados_comun_pmda[] = $linha_comun_pmda;

            $generics = new SqlGenerics();
            $generics->insert('pip_pmda_comun', $dados_comun_pmda);
            
            # representante 
            $sql_representante = "select id, id_comunidade, nome, tel, edndereco, bairro, email, cpf, watsapp id_pmda from pip_representante where id_pmda = ".$dados['id_pmda'];
            
            $result_comun_pmda = $con->query($sql_comun_pmda);
            $dados_pmda = array();
            while ($linha_comun_pmda = $result){
                $dados_comun_pmda[] = $linha_comun_pmda;

            $generics = new SqlGenerics();
            $generics->insert('pip_pmda', $dados_comun_pmda);
            
             */
            
            
        }
        
        




        
    }
    