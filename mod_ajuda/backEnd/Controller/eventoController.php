<?php
include_once('core/Controller/Controller.php');
        
/* * *********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 	
 *      Gerado de Código : 1.0
 * 	Controller tabela aju_evento										*
 * 																					*
 * 	Autor: Demetrio da Silva Passos	
 *      MASP: 1296844
 * 																					*
 * 	Criacao : 23/10/2020															*
 * ********************************************************************************** */

class eventoController extends Controller {

    private $evento;
    private $eventos;
    private $campos;
    public $numPage;
    
    public function __construct() {
        $this->evento = new EventoConEstoqueModel;
        $this->eventos = $this->evento->lista();

    }

    # index evento

    public function index() {
        $eventoModel = $this->evento;
        include_once 'mod_ajuda/backEnd/View/conEstoque/evento/index.php';
    }

    /* paginacao */

    public function paginacao($page, $numPage) {
        
        $this->numPage = $numPage;

        $totalRegistro = count($this->eventos);
        $regPorPagina = $numPage;
        
        $totPag = ceil($totalRegistro / $numPage);

        $start = ($page - 1) * $regPorPagina;

        $paginacao = $this->evento->paginacao($start, $regPorPagina);
       
        return array($paginacao, $totPag);
       
    }
        
    ################  EXPORTAR ##################    
    # Exportar dados excel
    public function exportar() {

        $evento = new EventoConEstoqueModel;
        
        $dados = $evento->lista();
        
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
        include_once 'mod_ajuda/backEnd/View/conEstoque/evento/cadastro.php';
    }

    ################  GRAVAR ##################    
    # gravar registro

    public function gravar() {

        $evento = new EventoConEstoqueModel;

        if ($evento->gravar($_POST)) {
            FuncaoBase::alert("Registro Gravado com Sucesso !");
            $this->redirect("ajuda", "evento", "index");
        }
    }
            
    # pesquisa registro

    public function pesquisa() {

            include_once 'mod_ajuda/backEnd/View/conEstoque/evento/pesquisa.php';
    }
    

    #visualizar registro

    public function view() {
         $eventoModel = $this->evento;
        $view = $this->evento->view($_GET['id']);
        include_once 'mod_ajuda/backEnd/View/conEstoque/evento/view.php';
    }

    # editar registro

    public function edit() {

        $eventoModel = new EventoConEstoqueModel;

        if ($this->isPost()) {

            $result = $eventoModel->edit($_POST);
            
            //var_dump($result);
            if (!empty($result)) {
                FuncaoBase::alert("Registro Atualizado com Sucesso !");
                $view = $eventoModel->view($_POST['id_evento']);
                $param = array('id'=> $_POST['id_evento']);
                $this->redirect("ajuda", "evento", "view", $param);
            }
        } else {

            $view = $eventoModel->view($_GET['id']);
            include_once 'mod_ajuda/backEnd/View/conEstoque/evento/edit.php';
        }
    }
    
    /*  deletar registro */
    public function delete() {
        
       if($this->evento->delete($_GET['id'])){
           FuncaoBase::alert("Registro Apagado com Sucesso !");
       }

            $this->redirect("ajuda", "evento", "index");
        
    }

}