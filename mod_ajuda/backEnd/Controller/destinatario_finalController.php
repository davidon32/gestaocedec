<?php
include_once('core/Controller/Controller.php');
        
/* * *********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 	
 *      Gerado de Código : 1.0
 * 	Controller tabela aju_destinatario_final										*
 * 																					*
 * 	Autor: Demetrio da Silva Passos	
 *      MASP: 1296844
 * 																					*
 * 	Criacao : 05/10/2020															*
 * ********************************************************************************** */

class destinatario_finalController extends Controller {

    private $destinatario_final;
    private $destinatario_finals;
    private $campos;
    public $numPage;
    
    public function __construct() {
        $this->destinatario_final = new Destinatario_finalConEstoqueModel;
        $this->destinatario_finals = $this->destinatario_final->lista();

    }

    # index destinatario_final

    public function index() {
        $destinatario_finalModel = $this->destinatario_final;
        include_once 'mod_ajuda/backEnd/View/conEstoque/destinatario_final/index.php';
    }

    /* paginacao */

    public function paginacao($page, $numPage) {
        
        $this->numPage = $numPage;

        $totalRegistro = count($this->destinatario_finals);
        $regPorPagina = $numPage;
        
        $totPag = ceil($totalRegistro / $numPage);

        $start = ($page - 1) * $regPorPagina;

        $paginacao = $this->destinatario_final->paginacao($start, $regPorPagina);
       
        return array($paginacao, $totPag);
       
    }
        
    ################  EXPORTAR ##################    
    # Exportar dados excel
    public function exportar() {

        $destinatario_final = new Destinatario_finalConEstoqueModel;
        
        $dados = $destinatario_final->lista();
        
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
        include_once 'mod_ajuda/backEnd/View/conEstoque/destinatario_final/cadastro.php';
    }

    ################  GRAVAR ##################    
    # gravar registro

    public function gravar() {

        $destinatario_final = new Destinatario_finalConEstoqueModel;

        if ($destinatario_final->gravar($_POST)) {
            FuncaoBase::alert("Registro Gravado com Sucesso !");
            $this->redirect("ajuda", "destinatario_final", "index");
        }
    }
            
    # pesquisa registro

    public function pesquisa() {

            include_once 'mod_ajuda/backEnd/View/conEstoque/destinatario_final/pesquisa.php';
    }
    

    #visualizar registro

    public function view() {
         $destinatario_finalModel = $this->destinatario_final;
        $view = $this->destinatario_final->view($_GET['id']);
        include_once 'mod_ajuda/backEnd/View/conEstoque/destinatario_final/view.php';
    }

    # editar registro

    public function edit() {

        $destinatario_finalModel = new Destinatario_finalConEstoqueModel;

        if ($this->isPost()) {

            $result = $destinatario_finalModel->edit($_POST);
            
            //var_dump($result);
            if (!empty($result)) {
                FuncaoBase::alert("Registro Atualizado com Sucesso !");
                $view = $destinatario_finalModel->view($_POST['id_destinatario_final']);
                $param = array('id'=> $_POST['id_destinatario_final']);
                $this->redirect("ajuda", "destinatario_final", "view", $param);
            }
        } else {

            $view = $destinatario_finalModel->view($_GET['id']);
            include_once 'mod_ajuda/backEnd/View/conEstoque/destinatario_final/edit.php';
        }
    }
    
    /*  deletar registro */
    public function delete() {
        
       if($this->destinatario_final->delete($_GET['id'])){
           FuncaoBase::alert("Registro Apagado com Sucesso !");
       }

            $this->redirect("ajuda", "destinatario_final", "index");
        
    }

}