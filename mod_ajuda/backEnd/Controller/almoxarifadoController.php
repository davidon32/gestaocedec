<?php
include_once('core/Controller/Controller.php');
        
/* * *********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 	
 *      Gerado de Código : 1.0
 * 	Controller tabela aju_almoxarifado ( Armazem )										*
 * 																					*
 * 	Autor: Demetrio da Silva Passos	
 *      MASP: 1296844
 * 																					*
 * 	Criacao : 29/09/2020															*
 * ********************************************************************************** */


# Armazem
class almoxarifadoController extends Controller {

    private $almoxarifado;
    private $almoxarifados;
    private $campos;
    public $numPage;

    public function __construct() {
        $this->almoxarifado = new AlmoxarifadoConEstoqueModel;
        $this->almoxarifados = $this->almoxarifado->lista();

    }

    # index almoxarifado

    public function index() {
        $almoxarifadoModel = $this->almoxarifado;
        include_once 'mod_ajuda/backEnd/View/conEstoque/almoxarifado/index.php';
    }

    /* paginacao */

    public function paginacao($page, $numPage) {
        
        $this->numPage = $numPage;

        $totalRegistro = count($this->almoxarifados);
        $regPorPagina = $numPage;
        
        $totPag = ceil($totalRegistro / $numPage);

        $start = ($page - 1) * $regPorPagina;

        $paginacao = $this->almoxarifado->paginacao($start, $regPorPagina);
       
        return array($paginacao, $totPag);
       
    }
        
    ################  EXPORTAR ##################    
    # Exportar dados excel
    public function exportar() {

        $almoxarifado = new AlmoxarifadoConEstoqueModel;
        
        $dados = $almoxarifado->lista();
        
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
        include_once 'mod_ajuda/backEnd/View/conEstoque/almoxarifado/cadastro.php';
    }

    ################  GRAVAR ##################    
    # gravar registro

    public function gravar() {

        $almoxarifado = new AlmoxarifadoConEstoqueModel;

        if ($almoxarifado->gravar($_POST)) {
            FuncaoBase::alert("Registro Gravado com Sucesso !");
            $this->redirect("ajuda", "almoxarifado", "index");
        }
    }
            
    # pesquisa registro

    public function pesquisa() {

            include_once 'mod_ajuda/backEnd/View/conEstoque/almoxarifado/pesquisa.php';
    }
    

    #visualizar registro

    public function view() {
         $almoxarifadoModel = $this->almoxarifado;
        $view = $this->almoxarifado->view($_GET['id']);
        include_once 'mod_ajuda/backEnd/View/conEstoque/almoxarifado/view.php';
    }

    # editar registro

    public function edit() {

        $almoxarifadoModel = new AlmoxarifadoConEstoqueModel;

        if ($this->isPost()) {

            $result = $almoxarifadoModel->edit($_POST);
            
            //var_dump($result);
            if (!empty($result)) {
                FuncaoBase::alert("Registro Atualizado com Sucesso !");
                $view = $almoxarifadoModel->view($_POST['id_almoxarifado']);
                $param = array('id'=> $_POST['id_almoxarifado']);
                $this->redirect("ajuda", "almoxarifado", "view", $param);
            }
        } else {

            $view = $almoxarifadoModel->view($_GET['id']);
            include_once 'mod_ajuda/backEnd/View/conEstoque/almoxarifado/edit.php';
        }
    }
    
    /*  deletar registro */
    public function delete() {
        
       if($this->almoxarifado->delete($_GET['id'])){
           FuncaoBase::alert("Registro Apagado com Sucesso !");
       }

            $this->redirect("ajuda", "almoxarifado", "index");
        
    }

}