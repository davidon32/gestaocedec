
<?php
include_once('core/Controller/Controller.php');
        
/* * *********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 	
 *      Gerado de Código : 1.0
 * 	Controller tabela dec_processo										*
 * 																					*
 * 	Autor: Demetrio da Silva Passos	
 *      MASP: 1296844
 * 																					*
 * 	Criacao : 09/07/2021															*
 * ********************************************************************************** */

class processoController extends Controller {

    private $processo;
    private $processos;
    private $campos;
    public $numPage;
    
    public function __construct() {
        $this->processo = new ProcessodecretoModel;
        $this->processos = $this->processo->lista();

    }

    # index processo

    public function index() {
        $processoModel = $this->processo;
        include_once 'mod_decreto/backEnd/View/decreto/processo/index.php';
    }

    /* paginacao */

    public function paginacao($page, $numPage) {
        
        $this->numPage = $numPage;

        $totalRegistro = count($this->processos);
        $regPorPagina = $numPage;
        
        $totPag = ceil($totalRegistro / $numPage);

        $start = ($page - 1) * $regPorPagina;

        $paginacao = $this->processo->paginacao($start, $regPorPagina);
       
        return array($paginacao, $totPag);
       
    }
        
    ################  EXPORTAR ##################    
    # Exportar dados excel
    public function exportar() {

        $processo = new ProcessodecretoModel;
        
        $dados = $processo->lista();
        
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
        include_once 'mod_decreto/backEnd/View/decreto/processo/cadastro.php';
    }

    ################  GRAVAR ##################    
    # gravar registro

    public function gravar() {

        $processo = new ProcessodecretoModel;

        if ($processo->gravar($_POST)) {
            FuncaoBase::alert("Registro Gravado com Sucesso !");
            $this->redirect("decreto", "processo", "index");
        }
    }
            
    # pesquisa registro

    public function pesquisa() {

            include_once 'mod_decreto/backEnd/View/decreto/processo/pesquisa.php';
    }
    

    #visualizar registro

    public function view() {
         $processoModel = $this->processo;
        $view = $this->processo->view($_GET['id']);
        include_once 'mod_decreto/backEnd/View/decreto/processo/view.php';
    }

    # editar registro

    public function edit() {

        $processoModel = new ProcessodecretoModel;

        if ($this->isPost()) {

            $result = $processoModel->edit($_POST);
            
            //var_dump($result);
            if (!empty($result)) {
                FuncaoBase::alert("Registro Atualizado com Sucesso !");
                $view = $processoModel->view($_POST['id_processo']);
                $param = array('id'=> $_POST['id_processo']);
                $this->redirect("decreto", "processo", "view", $param);
            }
        } else {

            $view = $processoModel->view($_GET['id']);
            include_once 'mod_decreto/backEnd/View/decreto/processo/edit.php';
        }
    }
    
    /*  deletar registro */
    public function delete() {
        
       if($this->processo->delete($_GET['id'])){
           FuncaoBase::alert("Registro Apagado com Sucesso !");
       }

            $this->redirect("decreto", "processo", "index");
        
    }

}