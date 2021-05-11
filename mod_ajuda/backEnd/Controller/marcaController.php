<?php
include_once('core/Controller/Controller.php');
        
/* * *********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 	
 *      Gerado de Código : 1.0
 * 	Controller tabela aju_marca										*
 * 																					*
 * 	Autor: Demetrio da Silva Passos	
 *      MASP: 1296844
 * 																					*
 * 	Criacao : 29/09/2020															*
 * ********************************************************************************** */

class marcaController extends Controller {

    private $marca;
    private $marcas;
    private $campos;
    public $numPage;

    public function __construct() {
        $this->marca = new MarcaConEstoqueModel;
        $this->marcas = $this->marca->lista();

    }

    # index marca

    public function index() {
        $marcaModel = $this->marca;
        include_once 'mod_ajuda/backEnd/View/conEstoque/marca/index.php';
    }

    /* paginacao */

    public function paginacao($page, $numPage) {
        
        $this->numPage = $numPage;

        $totalRegistro = count($this->marcas);
        $regPorPagina = $numPage;
        
        $totPag = ceil($totalRegistro / $numPage);

        $start = ($page - 1) * $regPorPagina;

        $paginacao = $this->marca->paginacao($start, $regPorPagina);
       
        return array($paginacao, $totPag);
       
    }
        
    ################  EXPORTAR ##################    
    # Exportar dados excel
    public function exportar() {

        $marca = new MarcaConEstoqueModel;
        
        $dados = $marca->listaExportExcel();
        
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
        include_once 'mod_ajuda/backEnd/View/conEstoque/marca/cadastro.php';
    }

    ################  GRAVAR ##################    
    # gravar registro

    public function gravar() {

        $marca = new MarcaConEstoqueModel;

        if ($marca->gravar($_POST)) {
            FuncaoBase::alert("Registro Gravado com Sucesso !");
            if($_POST['embutido'] == 'embutido') {
                return "sucesso";
            }else {
               $this->redirect("ajuda", "marca", "index");
                
            }
        }
    }
            
    # pesquisa registro

    public function pesquisa() {

            include_once 'mod_ajuda/backEnd/View/conEstoque/marca/pesquisa.php';
    }
    

    #visualizar registro

    public function view() {
         $marcaModel = $this->marca;
        $view = $this->marca->view($_GET['id']);
        include_once 'mod_ajuda/backEnd/View/conEstoque/marca/view.php';
    }

    # editar registro

    public function edit() {

        $marcaModel = new MarcaConEstoqueModel;

        if ($this->isPost()) {

            $result = $marcaModel->edit($_POST);
            
            //var_dump($result);
            if (!empty($result)) {
                FuncaoBase::alert("Registro Atualizado com Sucesso !");
                $view = $marcaModel->view($_POST['id_marca']);
                $param = array('id'=> $_POST['id_marca']);
                $this->redirect("ajuda", "marca", "view", $param);
            }
        } else {

            $view = $marcaModel->view($_GET['id']);
            include_once 'mod_ajuda/backEnd/View/conEstoque/marca/edit.php';
        }
    }
    
    /*  deletar registro */
    public function delete() {
        
       if($this->marca->delete($_GET['id'])){
           FuncaoBase::alert("Registro Apagado com Sucesso !");
       }

            $this->redirect("ajuda", "marca", "index");
        
    }

}