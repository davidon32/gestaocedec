<?php
include_once('core/Controller/Controller.php');
        
/* * *********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 	
 *      Gerado de Código : 1.0
 * 	Controller tabela aju_montagem										*
 * 																					*
 * 	Autor: Demetrio da Silva Passos	
 *      MASP: 1296844
 * 																					*
 * 	Criacao : 15/10/2020															*
 * ********************************************************************************** */

class montagemController extends Controller {

    private $montagem;
    private $montagems;
    private $campos;
    public $numPage;
    
    public function __construct() {
        $this->montagem = new MontagemConEstoqueModel;
        $this->montagems = $this->montagem->lista();

    }

    # index montagem

    public function index() {
        $montagemModel = $this->montagem;
        include_once 'mod_ajuda/backEnd/View/conEstoque/montagem/index.php';
    }

    /* paginacao */

    public function paginacao($page, $numPage) {
        
        $this->numPage = $numPage;

        $totalRegistro = count($this->montagems);
        $regPorPagina = $numPage;
        
        $totPag = ceil($totalRegistro / $numPage);

        $start = ($page - 1) * $regPorPagina;

        $paginacao = $this->montagem->paginacao($start, $regPorPagina);
       
        return array($paginacao, $totPag);
       
    }
        
    ################  EXPORTAR ##################    
    # Exportar dados excel
    public function exportar() {

        $montagem = new MontagemConEstoqueModel;
        
        $dados = $montagem->lista();
        
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
        include_once 'mod_ajuda/backEnd/View/conEstoque/montagem/cadastro.php';
    }
    
    # formulario impressao
    public function impressao() {
        $montagemModel = $this->montagem;
        $view = $this->montagem->view($_GET['id']);
        $pedidos = $montagemModel->lstpedidomont($_GET['id']);
        include_once 'mod_ajuda/backEnd/View/conEstoque/montagem/impressao.php';
    }

    ################  GRAVAR ##################    
    # gravar registro

    public function gravar() {

        $montagem = new MontagemConEstoqueModel;
        
        

        if ($montagem->gravar($_POST)) {
            FuncaoBase::alert("Registro Gravado com Sucesso !");
            $this->redirect("ajuda", "montagem", "index");
        }
    }
            
    # pesquisa registro

    public function pesquisa() {

            include_once 'mod_ajuda/backEnd/View/conEstoque/montagem/pesquisa.php';
    }
    

    #visualizar registro

    public function view() {
         $montagemModel = $this->montagem;
         $montagens = $montagemModel->lstpedidomont($_GET['id']);
         
        $view = $this->montagem->view($_GET['id']);
        include_once 'mod_ajuda/backEnd/View/conEstoque/montagem/view.php';
    }

    # editar registro

    public function edit() {

        $montagemModel = new MontagemConEstoqueModel;

        if ($this->isPost()) {

            $result = $montagemModel->edit($_POST);
            
            //var_dump($result);
            if (!empty($result)) {
                FuncaoBase::alert("Registro Atualizado com Sucesso !");
                $view = $montagemModel->view($_POST['id_montagem']);
                $param = array('id'=> $_POST['id_montagem']);
                $this->redirect("ajuda", "montagem", "view", $param);
            }
        } else {

            $view = $montagemModel->view($_GET['id']);
            include_once 'mod_ajuda/backEnd/View/conEstoque/montagem/edit.php';
        }
    }
    
    /*  deletar registro */
    public function delete() {
        
       if($this->montagem->delete($_GET['id'])){
           FuncaoBase::alert("Registro Apagado com Sucesso !");
       }

            $this->redirect("ajuda", "montagem", "index");
        
    }

}