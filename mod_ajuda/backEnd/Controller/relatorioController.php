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
        
        
        
        ############### Resumo ######################

        /* Resumo de Liberação por municipio */
        public function resumo_por_municipio(){

            

        }





    }?>