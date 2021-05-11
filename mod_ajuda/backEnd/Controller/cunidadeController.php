<?php
include_once('core/Controller/Controller.php');
        
/* * *********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 	
 *      Gerado de Código : 1.0
 * 	Controller tabela aju_unidade										*
 * 																					*
 * 	Autor: Demetrio da Silva Passos	
 *      MASP: 1296844
 * 																					*
 * 	Criacao : 28/09/2020															*
 * ********************************************************************************** */

class cunidadeController extends Controller {

    private $unidade;
    private $unidades;
    private $campos;
    public $numPage;

    public function __construct() {
        $this->unidade = new UnidadeConEstoqueModel;
        $this->unidades = $this->unidade->lista();

    }

    # index unidade

    public function index() {
        $unidadeModel = $this->unidade;
        include_once 'mod_ajuda/backEnd/View/conEstoque/cunidade/index.php';
    }

    /* paginacao */

    public function paginacao($page, $numPage) {
        
        $this->numPage = $numPage;

        $totalRegistro = count($this->unidades);
        $regPorPagina = $numPage;
        
        $totPag = ceil($totalRegistro / $numPage);

        $start = ($page - 1) * $regPorPagina;

        $paginacao = $this->unidade->paginacao($start, $regPorPagina);
       
        return array($paginacao, $totPag);
       
    }
        
        
    # Exportar dados excel
    public function exportar() {

        $unidade = new UnidadeConEstoqueModel;
        
        $dados = $unidade->listaExportExcel();
        
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
        include_once 'mod_ajuda/backEnd/View/conEstoque/cunidade/cadastro.php';
    }

    # gravar registro

    public function gravar() {

        
        $unidade = new UnidadeConEstoqueModel;

        if ($unidade->gravar($_POST)) {
            FuncaoBase::alert("Registro Gravado com Sucesso !");
            $this->redirect("ajuda", "cunidade", "index");
        }
    }
            
    # pesquisa registro

    public function pesquisa() {

            include_once 'mod_ajuda/backEnd/View/conEstoque/cunidade/pesquisa.php';
    }
    

    #visualizar registro

    public function view() {
         $unidadeModel = $this->unidade;
        $view = $this->unidade->view($_GET['id']);
        include_once 'mod_ajuda/backEnd/View/conEstoque/cunidade/view.php';
    }

    # editar registro

    public function edit() {

        $unidadeModel = new UnidadeConEstoqueModel;
        
       
        if ($this->isPost()) { 
            $result = $unidadeModel->edit($_POST);

            if (!empty($result)) {
                FuncaoBase::alert("Registro Atualizado com Sucesso !");
                $view = $unidadeModel->view($_POST['id_unidade']);
                $param = array('id'=> $_POST['id_unidade']);
                
               
                $this->redirect("ajuda", "cunidade", "view", $param);
            }
        } else {

            $view = $unidadeModel->view($_GET['id']);
            include_once 'mod_ajuda/backEnd/View/conEstoque/cunidade/edit.php';
        }
    }
    
    /*  deletar registro */
    public function delete() {
        
       if($this->unidade->delete($_GET['id'])){
           FuncaoBase::alert("Registro Apagado com Sucesso !");
       }

            $this->redirect("ajuda", "cunidade", "index");
        
    }

}