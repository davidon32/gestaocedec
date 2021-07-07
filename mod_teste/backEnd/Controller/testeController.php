
<?php
include_once('core/Controller/Controller.php');
        
/* * *********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 	
 *      Gerado de Código : 1.0
 * 	Controller tabela teste										*
 * 																					*
 * 	Autor: Demetrio da Silva Passos	
 *      MASP: 1296844
 * 																					*
 * 	Criacao : 07/07/2021															*
 * ********************************************************************************** */

class testeController extends Controller {

    private $teste;
    private $testes;
    private $campos;
    public $numPage;
    
    public function __construct() {
        $this->teste = new TesteModel;
        $this->testes = $this->teste->lista();

    }

    # index teste

    public function index() {
        $testeModel = $this->teste;
        include_once 'mod_teste/backEnd/View/teste/index.php';
    }

    /* paginacao */

    public function paginacao($page, $numPage) {
        
        $this->numPage = $numPage;

        $totalRegistro = count($this->testes);
        $regPorPagina = $numPage;
        
        $totPag = ceil($totalRegistro / $numPage);

        $start = ($page - 1) * $regPorPagina;

        $paginacao = $this->teste->paginacao($start, $regPorPagina);
       
        return [$paginacao, $totPag];
       
    }
        
    ################  EXPORTAR ##################    
    # Exportar dados excel
    public function exportar() {

        $teste = new TesteModel;
        
        $dados = $teste->lista();
        
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
        include_once 'mod_teste/backEnd/View/teste/cadastro.php';
    }

    ################  GRAVAR ##################    
    # gravar registro

    public function gravar() {

        $teste = new TesteModel;

        if ($teste->gravar($_POST)) {
            FuncaoBase::alert("Registro Gravado com Sucesso !");
            $this->redirect("teste", "teste", "index");
        }
    }
            
    # pesquisa registro

    public function pesquisa() {

            include_once 'mod_teste/backEnd/View/teste/pesquisa.php';
    }
    

    #visualizar registro

    public function view() {
         $testeModel = $this->teste;
        $view = $this->teste->view($_GET['id']);
        include_once 'mod_teste/backEnd/View/teste/view.php';
    }

    # editar registro

    public function edit() {

        $testeModel = new TesteModel;

        if ($this->isPost()) {

            $result = $testeModel->edit($_POST);
            
            //var_dump($result);
            if (!empty($result)) {
                FuncaoBase::alert("Registro Atualizado com Sucesso !");
                $view = $testeModel->view($_POST['id_teste']);
                $param = array('id'=> $_POST['id_teste']);
                $this->redirect("teste", "teste", "view", $param);
            }
        } else {

            $view = $testeModel->view($_GET['id']);
            include_once 'mod_teste/backEnd/View/teste/edit.php';
        }
    }
    
    /*  deletar registro */
    public function delete() {
        
       if($this->teste->delete($_GET['id'])){
           FuncaoBase::alert("Registro Apagado com Sucesso !");
       }

            $this->redirect("teste", "teste", "index");
        
    }

}