<?php
include_once('core/Controller/Controller.php');
        
/* * *********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 	
 *      Gerado de Código : 1.0
 * 	Controller tabela aju_natureza										*
 * 																					*
 * 	Autor: Demetrio da Silva Passos	
 *      MASP: 1296844
 * 																					*
 * 	Criacao : 29/09/2020															*
 * ********************************************************************************** */

class naturezaController extends Controller {

    private $natureza;
    private $naturezas;
    private $campos;
    public $numPage;
    
    public function __construct() {
        $this->natureza = new NaturezaConEstoqueModel;
        $this->naturezas = $this->natureza->lista();

    }

    # index natureza

    public function index() {
        $naturezaModel = $this->natureza;
        include_once 'mod_ajuda/backEnd/View/conEstoque/natureza/index.php';
    }

    /* paginacao */

    public function paginacao($page, $numPage) {
        
        $this->numPage = $numPage;

        $totalRegistro = count($this->naturezas);
        $regPorPagina = $numPage;
        
        $totPag = ceil($totalRegistro / $numPage);

        $start = ($page - 1) * $regPorPagina;

        $paginacao = $this->natureza->paginacao($start, $regPorPagina);
       
        return [$paginacao, $totPag];
       
    }
        
    ################  EXPORTAR ##################    
    # Exportar dados excel
    public function exportar() {

        $natureza = new NaturezaConEstoqueModel;
        
        $dados = $natureza->lista();
        
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
        include_once 'mod_ajuda/backEnd/View/conEstoque/natureza/cadastro.php';
    }

    ################  GRAVAR ##################    
    # gravar registro

    public function gravar() {

        $natureza = new NaturezaConEstoqueModel;

        if ($natureza->gravar($_POST)) {
            FuncaoBase::alert("Registro Gravado com Sucesso !");
            $this->redirect("ajuda", "natureza", "index");
        }
    }
            
    # pesquisa registro

    public function pesquisa() {

            include_once 'mod_ajuda/backEnd/View/conEstoque/natureza/pesquisa.php';
    }
    

    #visualizar registro

    public function view() {
         $naturezaModel = $this->natureza;
        $view = $this->natureza->view($_GET['id']);
        include_once 'mod_ajuda/backEnd/View/conEstoque/natureza/view.php';
    }

    # editar registro

    public function edit() {

        $naturezaModel = new NaturezaConEstoqueModel;

        if ($this->isPost()) {

            $result = $naturezaModel->edit($_POST);
            
            //var_dump($result);
            if (!empty($result)) {
                FuncaoBase::alert("Registro Atualizado com Sucesso !");
                $view = $naturezaModel->view($_POST['id_natureza']);
                $param = array('id'=> $_POST['id_natureza']);
                $this->redirect("ajuda", "natureza", "view", $param);
            }
        } else {

            $view = $naturezaModel->view($_GET['id']);
            include_once 'mod_ajuda/backEnd/View/conEstoque/natureza/edit.php';
        }
    }
    
    /*  deletar registro */
    public function delete() {
        
       if($this->natureza->delete($_GET['id'])){
           FuncaoBase::alert("Registro Apagado com Sucesso !");
       }

            $this->redirect("ajuda", "natureza", "index");
        
    }

}