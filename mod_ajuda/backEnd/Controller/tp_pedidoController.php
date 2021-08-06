<?php
include_once('core/Controller/Controller.php');
        
/* * *********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 	
 *      Gerado de Código : 1.0
 * 	Controller tabela aju_tp_pedido										*
 * 																					*
 * 	Autor: Demetrio da Silva Passos	
 *      MASP: 1296844
 * 																					*
 * 	Criacao : 05/10/2020															*
 * ********************************************************************************** */

class tp_pedidoController extends Controller {

    private $tp_pedido;
    private $tp_pedidos;
    private $campos;
    public $numPage;
    
    public function __construct() {
        $this->tp_pedido = new Tp_pedidoConEstoqueModel;
        $this->tp_pedidos = $this->tp_pedido->lista();

    }

    # index tp_pedido

    public function index() {
        $tp_pedidoModel = $this->tp_pedido;
        include_once 'mod_ajuda/backEnd/View/conEstoque/tp_pedido/index.php';
    }

    /* paginacao */

    public function paginacao($page, $numPage) {
        
        $this->numPage = $numPage;

        $totalRegistro = count($this->tp_pedidos);
        $regPorPagina = $numPage;
        
        $totPag = ceil($totalRegistro / $numPage);

        $start = ($page - 1) * $regPorPagina;

        $paginacao = $this->tp_pedido->paginacao($start, $regPorPagina);
       
        return array($paginacao, $totPag);
       
    }
        
    ################  EXPORTAR ##################    
    # Exportar dados excel
    public function exportar() {

        $tp_pedido = new Tp_pedidoConEstoqueModel;
        
        $dados = $tp_pedido->lista();
        
        $coluna = array_keys($dados[0]);
        
        $data = array();
        
        array_push($data, $coluna);
        
        foreach ($dados as $key => $dado) {
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
        

    # formulario cadastro
    public function cadastro() {
        include_once 'mod_ajuda/backEnd/View/conEstoque/tp_pedido/cadastro.php';
    }

    ################  GRAVAR ##################    
    # gravar registro

    public function gravar() {

        $tp_pedido = new Tp_pedidoConEstoqueModel;

        if ($tp_pedido->gravar($_POST)) {
            FuncaoBase::alert("Registro Gravado com Sucesso !");
            $this->redirect("ajuda", "tp_pedido", "index");
        }
    }
            
    # pesquisa registro

    public function pesquisa() {

            include_once 'mod_ajuda/backEnd/View/conEstoque/tp_pedido/pesquisa.php';
    }
    

    #visualizar registro

    public function view() {
         $tp_pedidoModel = $this->tp_pedido;
        $view = $this->tp_pedido->view($_GET['id']);
        include_once 'mod_ajuda/backEnd/View/conEstoque/tp_pedido/view.php';
    }

    # editar registro

    public function edit() {

        $tp_pedidoModel = new Tp_pedidoConEstoqueModel;

        if ($this->isPost()) {

            $result = $tp_pedidoModel->edit($_POST);
            
            //var_dump($result);
            if (!empty($result)) {
                FuncaoBase::alert("Registro Atualizado com Sucesso !");
                $view = $tp_pedidoModel->view($_POST['id_tp_pedido']);
                $param = array('id'=> $_POST['id_tp_pedido']);
                $this->redirect("ajuda", "tp_pedido", "view", $param);
            }
        } else {

            $view = $tp_pedidoModel->view($_GET['id']);
            include_once 'mod_ajuda/backEnd/View/conEstoque/tp_pedido/edit.php';
        }
    }
    
    /*  deletar registro */
    public function delete() {
        
       if($this->tp_pedido->delete($_GET['id'])){
           FuncaoBase::alert("Registro Apagado com Sucesso !");
       }

            $this->redirect("ajuda", "tp_pedido", "index");
        
    }

}