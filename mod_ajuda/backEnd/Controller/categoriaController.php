<?php
include_once('core/Controller/Controller.php');
        
/* * *********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 	
 *      Gerado de Código : 1.0
 * 	Controller tabela aju_categoria										*
 * 																					*
 * 	Autor: Demetrio da Silva Passos	
 *      MASP: 1296844
 * 																					*
 * 	Criacao : 29/09/2020															*
 * ********************************************************************************** */

class categoriaController extends Controller {

    private $categoria;
    private $categorias;
    private $campos;
    public $numPage;

    public function __construct() {
        $this->categoria = new CategoriaConEstoqueModel;
        $this->categorias = $this->categoria->lista();

    }

    # index categoria

    public function index() {
        $categoriaModel = $this->categoria;
        include_once 'mod_ajuda/backEnd/View/conEstoque/categoria/index.php';
    }

    /* paginacao */

    public function paginacao($page, $numPage) {
        
        $this->numPage = $numPage;

        $totalRegistro = count($this->categorias);
        $regPorPagina = $numPage;
        
        $totPag = ceil($totalRegistro / $numPage);

        $start = ($page - 1) * $regPorPagina;

        $paginacao = $this->categoria->paginacao($start, $regPorPagina);
       
        return array($paginacao, $totPag);
       
    }
        
    ################  EXPORTAR ##################    
    # Exportar dados excel
    public function exportar() {

        $categoria = new CategoriaConEstoqueModel;
        
        $dados = $categoria->lista();
        
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
        include_once 'mod_ajuda/backEnd/View/conEstoque/categoria/cadastro.php';
    }

    ################  GRAVAR ##################    
    # gravar registro

    public function gravar() {

        $categoria = new CategoriaConEstoqueModel;

        if ($categoria->gravar($_POST)) {
            FuncaoBase::alert("Registro Gravado com Sucesso !");
            $this->redirect("ajuda", "categoria", "index");
        }
    }
            
    # pesquisa registro

    public function pesquisa() {

            include_once 'mod_ajuda/backEnd/View/conEstoque/categoria/pesquisa.php';
    }
    

    #visualizar registro

    public function view() {
         $categoriaModel = $this->categoria;
        $view = $this->categoria->view($_GET['id']);
        include_once 'mod_ajuda/backEnd/View/conEstoque/categoria/view.php';
    }

    # editar registro

    public function edit() {

        $categoriaModel = new CategoriaConEstoqueModel;

        if ($this->isPost()) {

            $result = $categoriaModel->edit($_POST);

            if (!empty($result)) {
                FuncaoBase::alert("Registro Atualizado com Sucesso !");
                $view = $categoriaModel->view($_POST['id_categoria']);
                $param = array('id'=> $_POST['id_categoria']);
                $this->redirect("ajuda", "categoria", "view", $param);
            }
        } else {

            $view = $categoriaModel->view($_GET['id']);
            include_once 'mod_ajuda/backEnd/View/conEstoque/categoria/edit.php';
        }
    }
    
    /*  deletar registro */
    public function delete() {
        
       if($this->categoria->delete($_GET['id'])){
           FuncaoBase::alert("Registro Apagado com Sucesso !");
       }

            $this->redirect("ajuda", "categoria", "index");
        
    }

}