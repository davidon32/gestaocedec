<?php include_once('core/Controller/Controller.php');
include_once(MODEL_AJUDA_BACKEND.'/AjudaRelatorioModel.php');
    class RelatorioController extends Controller
    {

        public function Index(){
            include_once 'mod_ajuda/backEnd/View/relatorio/index.php';
        }
        
        ################ Material #####################
        /* form busca relatrio cad. material */
        public function fbusca_cad_mat(){
            include_once 'mod_ajuda/backEnd/View/conEstoque/relatorio/form_busca_rel_cad_mat.php';
        }
        /* relatorio Cadastro material */
        public function rel_cad_mat(){
            include_once 'mod_ajuda/backEnd/View/conEstoque/relatorio/rel_cad_mat.php';
        }
        
        /* FILTRO INVENTARIO DE MATERIAIS */
        public function form_busca_invet_libera(){
            include_once 'mod_ajuda/backEnd/View/conEstoque/relatorio/form_busca_invet_libera.php';
        }
        /* INVENTARIO DE MATERIAIS */
        public function inventario(){
            include_once 'mod_ajuda/backEnd/View/conEstoque/relatorio/inventario.php';
        }
        
        /* INVENTARIO DE MATERIAIS ZERADO */
        public function inventariozerado(){
            include_once 'mod_ajuda/backEnd/View/conEstoque/relatorio/inventario.php';
        }


        ################ LIBERACOES  #####################
        
        /* form busca liberacoes */
        public function fbusca_liberacao(){
            include_once 'mod_ajuda/backEnd/View/conEstoque/relatorio/form_busca_rel_lib_mat.php';
        }
        /* relatrio busca liberacoes */
        public function rel_lib_mat(){
            include_once 'mod_ajuda/backEnd/View/conEstoque/relatorio/rel_lib_mat.php';
        }
        
        ############### transeferencia material ######################
        /* recibo transferencia materiais */
        public function rec_transf_mat(){
            include_once 'mod_ajuda/backEnd/View/conEstoque/relatorio/rec_transf_mat.php';
        }
        /**
         * form busca  Transferencia de materiais
         */
        function rel_material_tranf(){
            include_once 'mod_ajuda/backEnd/View/conEstoque/relatorio/form_busca_rel_trans_mat.php';
        }
        /**
         * relatorio transferencia de materiais
         */
        function rmattransf(){
            include_once 'mod_ajuda/backEnd/View/conEstoque/relatorio/rel_mat_transf.php';
        }

        /**
         *  form busca relatorio transferencia de materiais
         */
        function relatorio(){

            include_once 'mod_ajuda/backEnd/View/conEstoque/relatorio/relatorios.php';
        }

        /**
         *  form busca relatorio transferencia de materiais
         */
        function busca_resumog(){

            include_once 'mod_ajuda/backEnd/View/conEstoque/relatorio/form_busca_rel_resumo.php';
        }

        

        /**
         *  form busca relatorio transferencia de materiais
         */
        function resumo(){

            include_once 'mod_ajuda/backEnd/View/conEstoque/relatorio/resumo_geral.php';
        }
        /**
         *  mapa com dados 
         */
        function buscamapa(){

            include_once 'mod_ajuda/backEnd/View/conEstoque/relatorio/form_busca_rel_mapa.php';
        }
        /**
         *  mapa com dados 
         */
        function mapa(){

            include_once 'mod_ajuda/backEnd/View/conEstoque/relatorio/mapa.php';
        }


        

        ############### PAGAMENTO material ######################
        /**
         * busca Relatorio pagamento de materiais
         */
        function fbusca_pag_mat(){
            include_once 'mod_ajuda/backEnd/View/conEstoque/relatorio/form_busca_rel_pg_mat.php';
        }
        /**
         * Relatorio pagamento de materiais
         */
        function rel_material_pago(){
            include_once 'mod_ajuda/backEnd/View/conEstoque/relatorio/rel_material_pago.php';
            
        }

        /* Impressao Comprovante Liberacao PDF */
        public function rel_liberacao_recibo(){
            $id_liberacao = $_GET['id'];
            include_once 'mod_ajuda/backEnd/View/conEstoque/relatorio/rec_liberacao_recibo.php';
        }

        /* Impressao Recibo Pagamento em Branco  */
        public function rec_pgto(){
            $id_liberacao = $_GET['id'];
            include_once 'mod_ajuda/backEnd/View/conEstoque/relatorio/rel_recibo_pgto_branco.php';
        }

        /**
         *  visualizar arquivo digitalizado */
        public function visualizarRec(){
            $id = $_GET['id'];
            include_once 'mod_ajuda/backEnd/View/conEstoque/relatorio/rel_vis_rec_pgto.php';

        }
        
        /**
         *  form busca posicao prestacao de contas */
        public function form_busca_pos_prest_contas(){

            include_once 'mod_ajuda/backEnd/View/conEstoque/relatorio/form_busca_pos_prest_contas.php';

        }
        /**
         *  relaotrio posicao prestacao de contas */
        public function rel_pos_prest_conta(){

            include_once 'mod_ajuda/backEnd/View/conEstoque/relatorio/rel_pos_prest_conta.php';

        }
        /**
         *  form busca prestacao de contas */
        public function form_prest_contas(){

            include_once 'mod_ajuda/backEnd/View/conEstoque/relatorio/form_prest_contas.php';

        }
        /**
         *  form busca prestacao de contas */
        public function form_busca_prest_contas(){

            include_once 'mod_ajuda/backEnd/View/conEstoque/relatorio/form_busca_rel_prest_contas.php';

        }
        /**
         *  relatorio prestacao de contas */
        public function rel_prest_conta(){

            include_once 'mod_ajuda/backEnd/View/conEstoque/relatorio/rel_prest_conta.php';

        }
        
        
        
        
        ############### Resumo ######################

        /* Resumo de Liberação por municipio */
        public function resumo_por_municipio(){
        }


        ################  EXPORTAR ##################    
    # Exportar dados excel
    public function exp_mat_pago() {

        $_txt_dt_inicial = isset($_GET['txt_dt_inicial']) ? htmlentities(htmlspecialchars($_GET['txt_dt_inicial'])) : "";
        $_txt_dt_final   = isset($_GET['txt_dt_final'])   ? htmlentities(htmlspecialchars($_GET['txt_dt_final'])) : "" ;
        $_txt_municipio  = isset($_GET['txt_municipio'])   ? $_GET['txt_municipio'] : "";
        $_txt_deposito   = isset($_GET['txt_deposito'])    ? $_GET['txt_deposito'] : "" ;
        $_txt_nivel   = isset($_GET['txt_nivel'])     ? $_GET['txt_nivel'] : "";
        $_txt_material   = isset($_GET['txt_material'])     ? $_GET['txt_material'] : "";
        
       
        /* ultimo parametro true, agrega os materiais*/
        $dados = RelatorioAju::MaterialPago($_txt_dt_inicial,
                $_txt_dt_final,
                $_txt_municipio,
                $_txt_deposito,
                $_txt_nivel,
                $_txt_material,
                true);
        
        $coluna = array_map('strtoupper', array_keys($dados[0]));
 
        $data = array();
        
        array_push($data, $coluna);
               
        foreach ($dados as $key => $dado) {
            $dado['dataLibera'] = DataMysql::dataVisual($dado['dataLibera']);
            $dado['dtPagto'] = DataMysql::dataVisual($dado['dtPagto']);
            $dado['depDestino'] = Deposito::PegaNomeDeposito($dado['depDestino']);
            $dado['id_municipio'] = Municipio::PegaNomeMunicipio($dado['id_municipio']);
            $data[] = $dado; 
        }

        $nomeFileExcel = sys_get_temp_dir()."/Cadastro".ucfirst($_GET['controller'])."_".date("dmY_his").".xlsx";

        $writer = new XLSXWriter();
        $writer->writeSheet($data);
        $writer->writeToFile($nomeFileExcel);

        header('Content-Description: File Transfer');
        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header("Content-Disposition: attachment; filename=\"" . basename($nomeFileExcel) . "\"");
        header("Content-Transfer-Encoding: binary");
        header("Expires: 0");
        header("Pragma: public");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header('Content-Length: ' . filesize($nomeFileExcel)); //Remove
        ob_clean();
        flush();
        readfile($nomeFileExcel);
    }



    }?>