<?php
include_once('core/Controller/Controller.php');
        
/* * *********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 	
 *      Gerado de Código : 1.0
 * 	Controller tabela aju_unidade_med										*
 * 																					*
 * 	Autor: Demetrio da Silva Passos	
 *      MASP: 1296844
 * 																					*
 * 	Criacao : 29/09/2020															*
 * ********************************************************************************** */

class unidade_medController extends Controller {

    private $unidade_med;
    private $unidade_meds;
    private $campos;
    public $numPage;
    
    public $tableModel;

    public function __construct() {
        $this->unidade_med = new Unidade_medConEstoqueModel;
        $this->unidade_meds = $this->unidade_med->lista();
        
    }

    # index unidade_med

    public function index() {
        $unidade_medModel = $this->unidade_med;
        include_once 'mod_ajuda/backEnd/View/conEstoque/unidade_med/index.php';
    }

    /* paginacao */

    public function paginacao($page, $numPage) {
        
        $this->numPage = $numPage;

        $totalRegistro = count($this->unidade_meds);
        $regPorPagina = $numPage;
        
        $totPag = ceil($totalRegistro / $numPage);

        $start = ($page - 1) * $regPorPagina;

        $paginacao = $this->unidade_med->paginacao($start, $regPorPagina);
       
        return array($paginacao, $totPag);
       
    }
        
    ################  EXPORTAR ##################    
    # Exportar dados excel
    public function exportar() {

        $unidade_med = new Unidade_medConEstoqueModel;
        
        $dados = $unidade_med->lista();
        
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
        include_once 'mod_ajuda/backEnd/View/conEstoque/unidade_med/cadastro.php';
    }

    ################  GRAVAR ##################    
    # gravar registro

    public function gravar() {

        $unidade_med = new Unidade_medConEstoqueModel;

        if ($unidade_med->gravar($_POST)) {
            FuncaoBase::alert("Registro Gravado com Sucesso !");
            $this->redirect("ajuda", "unidade_med", "index");
        }
    }
            
    # pesquisa registro

    public function pesquisa() {

            include_once 'mod_ajuda/backEnd/View/conEstoque/unidade_med/pesquisa.php';
    }
    

    #visualizar registro

    public function view() {
         $unidade_medModel = $this->unidade_med;
        $view = $this->unidade_med->view($_GET['id']);
        include_once 'mod_ajuda/backEnd/View/conEstoque/unidade_med/view.php';
    }

    # editar registro

    public function edit() {

        $unidade_medModel = new Unidade_medConEstoqueModel;

        if ($this->isPost()) {

            $result = $unidade_medModel->edit($_POST);
            
            //var_dump($result);
            if (!empty($result)) {
                FuncaoBase::alert("Registro Atualizado com Sucesso !");
                $view = $unidade_medModel->view($_POST['id_unidade_med']);
                $param = array('id'=> $_POST['id_unidade_med']);
                $this->redirect("ajuda", "unidade_med", "view", $param);
            }
        } else {

            $view = $unidade_medModel->view($_GET['id']);
            include_once 'mod_ajuda/backEnd/View/conEstoque/unidade_med/edit.php';
        }
    }
    
    /*  deletar registro */
    public function delete() {
        
       if($this->unidade_med->delete($_GET['id'])){
           FuncaoBase::alert("Registro Apagado com Sucesso !");
       }

            $this->redirect("ajuda", "unidade_med", "index");
        
    }

}