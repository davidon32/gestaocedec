<?php

include_once('core/Controller/Controller.php');

class ConEstoqueController extends Controller {

    public function index() {
        include_once 'mod_ajuda/backEnd/View/conEstoque/index.php';
    }

    # controle estoque novo

    public function indexn() {
        include_once 'mod_ajuda/backEnd/View/conEstoque/indexn.php';
    }

    public function cadgeral() {
        include_once 'mod_ajuda/backEnd/View/conEstoque/cadastro.php';
    }

    public function movimentacao() {
        include_once 'mod_ajuda/backEnd/View/conEstoque/movimentacao.php';
    }

    public function relgeral() {
        include_once 'mod_ajuda/backEnd/View/conEstoque/relatorio.php';
    }

    ################ Material #####################
    /* material */

    public function material() {
        include_once 'mod_ajuda/backEnd/View/conEstoque/material/index.php';
    }

    /* entrada de material no estoque */

    public function cadastro() {
        include_once 'mod_ajuda/backEnd/View/conEstoque/material/cadastro.php';
    }

    /* editar entrada de material no estoque */

    public function edEntMat() {
        $id_entrada = isset($_GET['id']) ? $_GET['id'] : "";
        include_once 'mod_ajuda/backEnd/View/conEstoque/material/editar.php';
    }

    /* editar item liberacao  */

    public function editItLibera() {
        $id_entrada = isset($_GET['id']) ? $_GET['id'] : "";
        include_once 'mod_ajuda/backEnd/View/conEstoque/liberacao/editarItem.php';
    }

    /* Cadastro de Produto */

    public function cad_prod() {
        include_once 'mod_ajuda/backEnd/View/conEstoque/material/cad_prod.php';
    }

    /* Cadastro de origem de entrada de material */

    public function origem() {
        include_once 'mod_ajuda/backEnd/View/conEstoque/material/cad_fonte.php';
    }

    /* index saldo materiais */

    public function salindex() {
        include_once 'mod_ajuda/backEnd/View/conEstoque/estoque/index.php';
    }

    /* saldo materiais */

    public function saldo() {
        include_once 'mod_ajuda/backEnd/View/conEstoque/estoque/saldo_geral.php';
    }

    /* Ajuste saldo Material */

    public function ajuste() {
        include_once 'mod_ajuda/backEnd/View/conEstoque/material/ajuste_saldo.php';
    }

    /* saldo resumo  */

    public function saldoResumo() {
        include_once 'mod_ajuda/backEnd/View/conEstoque/estoque/saldo_resumo.php';
    }

    /* Lembrete Liberacao */

    public function lembrete_liberacao() {
        include_once 'mod_ajuda/backEnd/View/conEstoque/liberacao/lembrete_liberacao.php';
    }

    /* Lembrete TRansito */

    public function lembrete_transito() {
        include_once 'mod_ajuda/backEnd/View/conEstoque/transferencia/lembrete_transito.php';
    }

    /* Evento  */

    public function evento() {
        include_once 'mod_ajuda/backEnd/View/conEstoque/material/evento.php';
    }

    ################# liberacao de Materiais #####################
    /* index liberacao de materiais */

    public function idxLiberacao() {
        include_once 'mod_ajuda/backEnd/View/conEstoque/liberacao/index.php';
    }

    /* liberacao de materiais */

    public function liberacao() {
        include_once 'mod_ajuda/backEnd/View/conEstoque/liberacao/liberar.php';
    }

    /* Fechar liberacao de materiais */

    public function fechar_liberacao() {
        include_once 'mod_ajuda/backEnd/View/conEstoque/liberacao/fechar_liberacao.php';
    }

    /* cancelar liberacao de materiais */

    public function cancelar() {
        include_once 'mod_ajuda/backEnd/View/conEstoque/liberacao/cancelar.php';
    }

    /* Cancelar liberacao validar */

    public function lcancela() {
        include_once 'mod_ajuda/backEnd/View/conEstoque/liberacao/valida.php';
    }

    /* Visualizar materiais de liberacao */

    public function vmateriallib() {
        include_once 'mod_ajuda/backEnd/View/conEstoque/liberacao/v_material_liberacao.php';
    }

    /* add material liberacao */

    public function add_material() {
        include_once 'mod_ajuda/backEnd/View/conEstoque/liberacao/add_material.php';
    }

    /* remover materiais da liberacao */

    public function remove_item() {
        include_once 'mod_ajuda/backEnd/View/conEstoque/liberacao/remove_item.php';
    }

    /* recibo liberacao */

    public function comprov_lib() {
        $id_liberacao = $_GET['id'];
        include_once 'mod_ajuda/backEnd/View/conEstoque/liberacao/comprov_lib.php';
    }

    /* Salvar Comprovante Liberacao PDF */

    public function libpdf() {
        $id_liberacao = $_GET['id'];
        include_once 'mod_ajuda/backEnd/View/conEstoque/relatorio/rec_liberacao_pdf.php';
    }

    #################  Pagamento Materiais #####################

    /**
     * 
     *  Index pagamento de materiais
     */
    public function idxpagamento() {
        include_once 'mod_ajuda/backEnd/View/conEstoque/pagamento/index.php';
    }

    /**
     * 
     *  formulario pagamento de materiais
     */
    public function pagar() {
        include_once 'mod_ajuda/backEnd/View/conEstoque/pagamento/pagar.php';
    }

    /**
     * 
     *  valida pagamento
     */
    public function valida() {
        include_once 'mod_ajuda/backEnd/View/conEstoque/pagamento/valida.php';
    }

    /**
     * 
     *  Recibo pagamento materiais salvar pdf / imprimir
     */
    public function recibopg() {
        include_once 'mod_ajuda/backEnd/View/conEstoque/pagamento/rec_pg.php';
    }

    /**
     * 
     *  Impressao recibo pgto
     */
    public function imprecibopg() {
        include_once 'mod_ajuda/backEnd/View/conEstoque/relatorio/rel_recibo_pgto.php';
    }

    /**
     * 
     *  Gerar Pdf recibo pgtol
     */
    public function imprecibopgpdf() {
        include_once 'mod_ajuda/backEnd/View/conEstoque/relatorio/rel_recibo_pgto_pdf.php';
    }

    /**
     * 
     *  upload recibo pagamento         */
    public function uprecpgto() {
        include_once 'mod_ajuda/backEnd/View/conEstoque/pagamento/form_upload_rec_pgto.php';
    }

    ####################  Transferencia de Materiais #####################

    /**
     * 
     *  Index Transferencia de Materiais
     */
    public function idxtransf() {
        include_once 'mod_ajuda/backEnd/View/conEstoque/transferencia/index.php';
    }

    /**
     * 
     *  Transferencia de Materiais
     */
    public function transf() {
        include_once 'mod_ajuda/backEnd/View/conEstoque/transferencia/transferencia.php';
    }

    /**
     * 
     *  gravar Transferencia de Materiais
     */
    public function transfgravar() {
        include_once 'mod_ajuda/backEnd/View/conEstoque/transferencia/valida.php';
    }

    /**
     * 
     *  form cancelar transferencia
     */
    public function transfcancela() {
        include_once 'mod_ajuda/backEnd/View/conEstoque/transferencia/cancela.php';
    }

    /**
     * 
     *  validar cancelar transferencia
     */
    public function vtransfcancela() {
        include_once 'mod_ajuda/backEnd/View/conEstoque/transferencia/valida.php';
    }

    /* add material liberacao */

    public function add_mat_transf() {
        include_once 'mod_ajuda/backEnd/View/conEstoque/transferencia/add_material.php';
    }

    ################  receber materiais transferidos #################

    /**
     * 
     *  form receber materiais transferencia
     */
    public function receber() {
        include_once 'mod_ajuda/backEnd/View/conEstoque/recebimento/receber.php';
    }

    /**
     * 
     *  validar receber materiais transferencia
     */
    public function vreceber() {
        include_once 'mod_ajuda/backEnd/View/conEstoque/recebimento/valida.php';
    }

    /**
     * 
     *  validar receber materiais transferencia
     */
    public function recebmat() {
        include_once 'mod_ajuda/backEnd/View/conEstoque/recebimento/recibo_mat.php';
    }

    ####################  Relatorios  #####################

    /**
     * index Relatorios
     */
    function relIndex() {
        include_once 'mod_ajuda/backEnd/View/conEstoque/relatorio/index.php';
    }

    /**
     * index correcao liberacao
     */
    function correcao() {
        include_once 'mod_ajuda/backEnd/View/conEstoque/liberacao/correcao.php';
    }

    /**
     * diario controle estoque
     */
    function diario1() {
        include_once 'mod_ajuda/backEnd/View/conEstoque/relatorio/diario.php';
    }
    
    
    /**
     * Visualização Entrada de material
     */
    function entrada_mat() {
        include_once 'mod_ajuda/backEnd/View/conEstoque/relatorio/entrada_mat.php';
    }

    
}

?>