
<?php
include_once('core/Controller/Controller.php');
        
/* * *********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 	
 *      Gerado de Código : 1.0
 * 	Controller tabela dec_cobrade										*
 * 																					*
 * 	Autor: Demetrio da Silva Passos	
 *      MASP: 1296844
 * 																					*
 * 	Criacao : 09/07/2021															*
 * ********************************************************************************** */

class cobradeController extends Controller {

    private $cobrade;
    private $cobrades;
    private $campos;
    public $numPage;
    
    public function __construct() {
        $this->cobrade = new CobradeModel;
        $this->cobrades = $this->cobrade->lista();

    }

    # index cobrade

    public function index() {
        $cobradeModel = $this->cobrade;
        include_once 'mod_decreto/backEnd/View/cobrade/index.php';
    }

    /* paginacao */

    public function paginacao($page, $numPage) {
        
        $this->numPage = $numPage;

        $totalRegistro = count($this->cobrades);
        $regPorPagina = $numPage;
        
        $totPag = ceil($totalRegistro / $numPage);

        $start = ($page - 1) * $regPorPagina;

        $paginacao = $this->cobrade->paginacao($start, $regPorPagina);
       
        return array($paginacao, $totPag);
       
    }
        
    ################  EXPORTAR ##################    
    # Exportar dados excel
    public function exportar() {

        $cobrade = new CobradeModel;
        
        $dados = $cobrade->lista();
        
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
        include_once 'mod_decreto/backEnd/View/cobrade/cadastro.php';
    }

    ################  GRAVAR ##################    
    # gravar registro

    public function gravar() {

        $cobrade = new CobradeModel;

        if ($cobrade->gravar($_POST)) {
            FuncaoBase::alert("Registro Gravado com Sucesso !");
            $this->redirect("decreto", "cobrade", "index");
        }
    }
            
    # pesquisa registro

    public function pesquisa() {

            include_once 'mod_decreto/backEnd/View/cobrade/pesquisa.php';
    }
    

    #visualizar registro

    public function view() {
         $cobradeModel = $this->cobrade;
        $view = $this->cobrade->view($_GET['id']);
        include_once 'mod_decreto/backEnd/View/cobrade/view.php';
    }

    # editar registro

    public function edit() {

        $cobradeModel = new CobradeModel;

        if ($this->isPost()) {

            $result = $cobradeModel->edit($_POST);
            
            //var_dump($result);
            if (!empty($result)) {
                FuncaoBase::alert("Registro Atualizado com Sucesso !");
                $view = $cobradeModel->view($_POST['id_cobrade']);
                $param = array('id'=> $_POST['id_cobrade']);
                $this->redirect("decreto", "cobrade", "view", $param);
            }
        } else {

            $view = $cobradeModel->view($_GET['id']);
            include_once 'mod_decreto/backEnd/View/cobrade/edit.php';
        }
    }
    
    /*  deletar registro */
    public function delete() {
        
       if($this->cobrade->delete($_GET['id'])){
           FuncaoBase::alert("Registro Apagado com Sucesso !");
       }

            $this->redirect("decreto", "cobrade", "index");
        
    }

}