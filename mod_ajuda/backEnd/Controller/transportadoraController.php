<?php
include_once('core/Controller/Controller.php');
        
/* * *********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 	
 *      Gerado de Código : 1.0
 * 	Controller tabela aju_transportadora										*
 * 																					*
 * 	Autor: Demetrio da Silva Passos	
 *      MASP: 1296844
 * 																					*
 * 	Criacao : 29/09/2020															*
 * ********************************************************************************** */

class transportadoraController extends Controller {

    private $transportadora;
    private $transportadoras;
    private $campos;
    public $numPage;
    
    public function __construct() {
        $this->transportadora = new TransportadoraConEstoqueModel;
        $this->transportadoras = $this->transportadora->lista();

    }

    # index transportadora

    public function index() {
        $transportadoraModel = $this->transportadora;
        include_once 'mod_ajuda/backEnd/View/conEstoque/transportadora/index.php';
    }

    /* paginacao */

    public function paginacao($page, $numPage) {
        
        $this->numPage = $numPage;

        $totalRegistro = count($this->transportadoras);
        $regPorPagina = $numPage;
        
        $totPag = ceil($totalRegistro / $numPage);

        $start = ($page - 1) * $regPorPagina;

        $paginacao = $this->transportadora->paginacao($start, $regPorPagina);
       
        return array($paginacao, $totPag);
       
    }
        
    ################  EXPORTAR ##################    
    # Exportar dados excel
    public function exportar() {

        $transportadora = new TransportadoraConEstoqueModel;
        
        $dados = $transportadora->lista();
        
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
        include_once 'mod_ajuda/backEnd/View/conEstoque/transportadora/cadastro.php';
    }

    ################  GRAVAR ##################    
    # gravar registro

    public function gravar() {

        $transportadora = new TransportadoraConEstoqueModel;

        if ($transportadora->gravar($_POST)) {
            FuncaoBase::alert("Registro Gravado com Sucesso !");
            $this->redirect("ajuda", "transportadora", "index");
        }
    }
            
    # pesquisa registro

    public function pesquisa() {

            include_once 'mod_ajuda/backEnd/View/conEstoque/transportadora/pesquisa.php';
    }
    

    #visualizar registro

    public function view() {
         $transportadoraModel = $this->transportadora;
        $view = $this->transportadora->view($_GET['id']);
        include_once 'mod_ajuda/backEnd/View/conEstoque/transportadora/view.php';
    }

    # editar registro

    public function edit() {

        $transportadoraModel = new TransportadoraConEstoqueModel;

        if ($this->isPost()) {

            $result = $transportadoraModel->edit($_POST);
            
            //var_dump($result);
            if (!empty($result)) {
                FuncaoBase::alert("Registro Atualizado com Sucesso !");
                $view = $transportadoraModel->view($_POST['id_transportadora']);
                $param = array('id'=> $_POST['id_transportadora']);
                $this->redirect("ajuda", "transportadora", "view", $param);
            }
        } else {

            $view = $transportadoraModel->view($_GET['id']);
            include_once 'mod_ajuda/backEnd/View/conEstoque/transportadora/edit.php';
        }
    }
    
    /*  deletar registro */
    public function delete() {
        
       if($this->transportadora->delete($_GET['id'])){
           FuncaoBase::alert("Registro Apagado com Sucesso !");
       }

            $this->redirect("ajuda", "transportadora", "index");
        
    }

}