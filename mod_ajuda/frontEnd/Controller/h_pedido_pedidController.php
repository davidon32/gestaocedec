
<?php

include_once('core/Controller/Controller.php');

/* * *********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 	
 *      Gerado de Código : 1.0
 * 	Controller tabela aju_h_pedido_pedid										*
 * 																					*
 * 	Autor: Demetrio da Silva Passos	
 *      MASP: 1296844
 * 																					*
 * 	Criacao : 21/06/2021															*
 * ********************************************************************************** */

class h_pedido_pedidController extends Controller {

    private $h_pedido_pedid;
    private $h_pedido_pedids;
    private $campos;
    public $numPage;

    public function __construct() {
        $this->h_pedido_pedid = new H_pedido_pedidajuda_hModel;
        $this->h_pedido_pedids = $this->h_pedido_pedid->lista();
    }

    # index h_pedido_pedid

    public function index() {
        $h_pedido_pedidModel = $this->h_pedido_pedid;
        include_once 'mod_ajuda/frontEnd/View/ajuda_h/h_pedido_pedid/index.php';
    }

    /* paginacao */

    public function paginacao($page, $numPage) {

        $this->numPage = $numPage;

        $totalRegistro = count($this->h_pedido_pedids);
        $regPorPagina = $numPage;

        $totPag = ceil($totalRegistro / $numPage);

        $start = ($page - 1) * $regPorPagina;

        $paginacao = $this->h_pedido_pedid->paginacao($start, $regPorPagina);

        return array($paginacao, $totPag);
    }

    ################  EXPORTAR ##################    
    # Exportar dados excel

    public function exportar() {

        $h_pedido_pedid = new H_pedido_pedidajuda_hModel;

        $dados = $h_pedido_pedid->lista();

        $coluna = array_keys($dados[0]);

        $data = array();

        array_push($data, $coluna);

        foreach ($dados as $key => $dado) {
            $data[] = $dado;
        }

        $nomeFileExcel = sys_get_temp_dir() . "/Cadastro" . ucfirst($_GET['controller']) . "_" . date("dmY_his") . ".xlsx";

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

    # formulario cadastro

    public function cadastro() {
        include_once 'mod_ajuda/frontEnd/View/ajuda_h/h_pedido_pedid/cadastro.php';
    }

    ################  GRAVAR ##################    
    # gravar registro

    public function gravar() {

        $h_pedido_pedid = new H_pedido_pedidajuda_hModel;

        $_POST['numero'] = $h_pedido_pedid->gerarNumero();
        $_POST['despachante_analista'] = "";
        $_POST['despachante_dlog'] = "";

        $result = $h_pedido_pedid->gravar($_POST);
        
        if($result['result']){
            FuncaoBase::alert("Registro Gravado com Sucesso !");
            print "<script>";
            print "window.location.href = '". FuncaoBase::geraLink("ajuda", "h_pedido_itens", "cadastro", array("id" => $result['id'], "voltar"=>"idx_recente"))."'";
            print "</script>";
        }else {
            FuncaoBase::alert("Ocorreu um erro ao gravar o Pedido !");
            $this->redirect("ajuda", "h_pedido_index", "index");
        }
    }

    # pesquisa registro

    public function pesquisa() {

        include_once 'mod_ajuda/frontEnd/View/ajuda_h/h_pedido_pedid/pesquisa.php';
    }

    #visualizar registro

    public function view() {
                $h_pedido_pedidModel = $this->h_pedido_pedid;
        $view = $this->h_pedido_pedid->view($_GET['id']);
        include_once 'mod_ajuda/frontEnd/View/ajuda_h/h_pedido_pedid/view.php';
    }

    # editar registro

    public function edit() {      

        $h_pedido_pedidModel = new H_pedido_pedidajuda_hModel;

        if ($this->isPost()) {

            $result = $h_pedido_pedidModel->edit($_POST);
            

            //var_dump($result);
            if (!empty($result)) {
                FuncaoBase::alert("Registro Atualizado com Sucesso !");
                $view = $h_pedido_pedidModel->view($_POST['id']);
                $param = array('id' => $_POST['id'] );
                if($_GET['voltar'] == 'idx_recente') {
                    $this->redirect("ajuda", "h_pedido_pedid", "index");
                }else {
                    $this->redirect("ajuda", "h_pedido_pedid", "view", array('id' => $_POST['id'],'voltar'=>'idx_recente'));
                }
            }
        } else {

            $view = $h_pedido_pedidModel->view($_GET['id']);
            include_once 'mod_ajuda/frontEnd/View/ajuda_h/h_pedido_pedid/edit.php';
        }
    }

    /*  deletar registro */

    public function delete() {
        
        
        $voltar = isset($_GET['voltar']) ? $_GET['voltar'] : "index";

        if ($this->h_pedido_pedid->delete($_GET['id'])) {
            FuncaoBase::alert("Registro Apagado com Sucesso !");
        }
       
        if ($voltar == "idx_recente") {
            $this->redirect("ajuda", "h_pedido_index", "index");
        }else if($voltar == "index") {
            $this->redirect("ajuda", "h_pedido_pedid", "index");
        }
    }

    /* add pedido sesssion */

    public function add_itens() {
        include_once 'mod_ajuda/frontEnd/View/ajuda_h/h_pedido_pedid/add_itens.php';
    }

    /**
     *  enviar Pedido para analise DRD
     */
    public function analise_drd() {

        if ($this->h_pedido_pedid->analiseDrd($_POST['id_pedido'])) {

            print 'sucesso';
        }
    }
    
    
    /* envia pedido para analise */
    public function envio() {
        
        if($this->h_pedido_pedid->envia_pedido($_POST)){
            print "sucesso";
        }
        
    }
    
           

}
