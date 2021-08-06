<?php
include_once('core/Controller/Controller.php');
        
/* * *********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 	
 *      Gerado de Código : 1.0
 * 	Controller tabela aju_destinatario										*
 * 																					*
 * 	Autor: Demetrio da Silva Passos	
 *      MASP: 1296844
 * 																					*
 * 	Criacao : 29/09/2020															*
 * ********************************************************************************** */

class destinatarioController extends Controller {

    private $destinatario;
    private $destinatarios;
    private $campos;
    public $numPage;

    public function __construct() {
        $this->destinatario = new DestinatarioConEstoqueModel;
        $this->destinatarios = $this->destinatario->lista();

    }

    # index destinatario

    public function index() {
        $destinatarioModel = $this->destinatario;
        include_once 'mod_ajuda/backEnd/View/conEstoque/destinatario/index.php';
    }

    /* paginacao */

    public function paginacao($page, $numPage) {
        
        $this->numPage = $numPage;

        $totalRegistro = count($this->destinatarios);
        $regPorPagina = $numPage;
        
        $totPag = ceil($totalRegistro / $numPage);

        $start = ($page - 1) * $regPorPagina;

        $paginacao = $this->destinatario->paginacao($start, $regPorPagina);
       
        return array($paginacao, $totPag);
       
    }
        
    ################  EXPORTAR ##################    
    # Exportar dados excel
    public function exportar() {

        $destinatario = new DestinatarioConEstoqueModel;
        
        $dados = $destinatario->lista();
        
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
        include_once 'mod_ajuda/backEnd/View/conEstoque/destinatario/cadastro.php';
    }

    ################  GRAVAR ##################    
    # gravar registro

    public function gravar() {

        $destinatario = new DestinatarioConEstoqueModel;

        if ($destinatario->gravar($_POST)) {
            FuncaoBase::alert("Registro Gravado com Sucesso !");
            $this->redirect("ajuda", "destinatario", "index");
        }
    }
            
    # pesquisa registro

    public function pesquisa() {

            include_once 'mod_ajuda/backEnd/View/conEstoque/destinatario/pesquisa.php';
    }
    

    #visualizar registro

    public function view() {
         $destinatarioModel = $this->destinatario;
        $view = $this->destinatario->view($_GET['id']);
        include_once 'mod_ajuda/backEnd/View/conEstoque/destinatario/view.php';
    }

    # editar registro

    public function edit() {

        $destinatarioModel = new DestinatarioConEstoqueModel;

        if ($this->isPost()) {

            $result = $destinatarioModel->edit($_POST);
            
            //var_dump($result);
            if (!empty($result)) {
                FuncaoBase::alert("Registro Atualizado com Sucesso !");
                $view = $destinatarioModel->view($_POST['id_destinatario']);
                $param = array('id'=> $_POST['id_destinatario']);
                $this->redirect("ajuda", "destinatario", "view", $param);
            }
        } else {

            $view = $destinatarioModel->view($_GET['id']);
            include_once 'mod_ajuda/backEnd/View/conEstoque/destinatario/edit.php';
        }
    }
    
    /*  deletar registro */
    public function delete() {
        
       if($this->destinatario->delete($_GET['id'])){
           FuncaoBase::alert("Registro Apagado com Sucesso !");
       }

            $this->redirect("ajuda", "destinatario", "index");
        
    }

}