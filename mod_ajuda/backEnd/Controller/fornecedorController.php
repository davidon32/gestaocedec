<?php
include_once('core/Controller/Controller.php');
        
/* * *********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 	
 *      Gerado de Código : 1.0
 * 	Controller tabela aju_fornecedor										*
 * 																					*
 * 	Autor: Demetrio da Silva Passos	
 *      MASP: 1296844
 * 																					*
 * 	Criacao : 29/09/2020															*
 * ********************************************************************************** */

class fornecedorController extends Controller {

    private $fornecedor;
    private $fornecedors;
    private $campos;
    public $numPage;

    public function __construct() {
        $this->fornecedor = new FornecedorConEstoqueModel;
        $this->fornecedors = $this->fornecedor->lista();

    }

    # index fornecedor

    public function index() {
        $fornecedorModel = $this->fornecedor;
        include_once 'mod_ajuda/backEnd/View/conEstoque/fornecedor/index.php';
    }

    /* paginacao */

    public function paginacao($page, $numPage) {
        
        $this->numPage = $numPage;

        $totalRegistro = count($this->fornecedors);
        $regPorPagina = $numPage;
        
        $totPag = ceil($totalRegistro / $numPage);

        $start = ($page - 1) * $regPorPagina;

        $paginacao = $this->fornecedor->paginacao($start, $regPorPagina);
       
        return array($paginacao, $totPag);
       
    }
        
    ################  EXPORTAR ##################    
    # Exportar dados excel
    public function exportar() {

        $fornecedor = new FornecedorConEstoqueModel;
        
        $dados = $fornecedor->lista();
        
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
        include_once 'mod_ajuda/backEnd/View/conEstoque/fornecedor/cadastro.php';
    }

    ################  GRAVAR ##################    
    # gravar registro

    public function gravar() {

        $fornecedor = new FornecedorConEstoqueModel;

        if ($fornecedor->gravar($_POST)) {
            FuncaoBase::alert("Registro Gravado com Sucesso !");
            $this->redirect("ajuda", "fornecedor", "index");
        }
    }
            
    # pesquisa registro

    public function pesquisa() {

            include_once 'mod_ajuda/backEnd/View/conEstoque/fornecedor/pesquisa.php';
    }
    

    #visualizar registro

    public function view() {
         $fornecedorModel = $this->fornecedor;
        $view = $this->fornecedor->view($_GET['id']);
        include_once 'mod_ajuda/backEnd/View/conEstoque/fornecedor/view.php';
    }

    # editar registro

    public function edit() {

        $fornecedorModel = new FornecedorConEstoqueModel;

        if ($this->isPost()) {

            $result = $fornecedorModel->edit($_POST);
            
            //var_dump($result);
            if (!empty($result)) {
                FuncaoBase::alert("Registro Atualizado com Sucesso !");
                $view = $fornecedorModel->view($_POST['id_fornecedor']);
                $param = array('id'=> $_POST['id_fornecedor']);
                $this->redirect("ajuda", "fornecedor", "view", $param);
            }
        } else {

            $view = $fornecedorModel->view($_GET['id']);
            include_once 'mod_ajuda/backEnd/View/conEstoque/fornecedor/edit.php';
        }
    }
    
    /*  deletar registro */
    public function delete() {
        
       if($this->fornecedor->delete($_GET['id'])){
           FuncaoBase::alert("Registro Apagado com Sucesso !");
       }

            $this->redirect("ajuda", "fornecedor", "index");
        
    }

}