<?php
include_once('core/Controller/Controller.php');
        
/* * *********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 	
 *      Gerado de Código : 1.0
 * 	Controller tabela aju_itens_nota										*
 * 																					*
 * 	Autor: Demetrio da Silva Passos	
 *      MASP: 1296844
 * 																					*
 * 	Criacao : 30/09/2020															*
 * ********************************************************************************** */

class itens_notaController extends Controller {

    private $itens_nota;
    private $itens_notas;
    private $campos;
    public $numPage;
    
    public function __construct() {
        $this->itens_nota = new Itens_notaConEstoqueModel;
        $this->itens_notas = $this->itens_nota->lista();

    }

    # index itens_nota

    public function index() {
        $itens_notaModel = $this->itens_nota;
        include_once 'mod_ajuda/backEnd/View/conEstoque/itens_nota/index.php';
    }

    /* paginacao */

    public function paginacao($page, $numPage) {
        
        $this->numPage = $numPage;

        $totalRegistro = count($this->itens_notas);
        $regPorPagina = $numPage;
        
        $totPag = ceil($totalRegistro / $numPage);

        $start = ($page - 1) * $regPorPagina;

        $paginacao = $this->itens_nota->paginacao($start, $regPorPagina);
       
        return array($paginacao, $totPag);
       
    }
        
    ################  EXPORTAR ##################    
    # Exportar dados excel
    public function exportar() {

        $itens_nota = new Itens_notaConEstoqueModel;
        
        $dados = $itens_nota->lista();
        
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
        include_once 'mod_ajuda/backEnd/View/conEstoque/itens_nota/cadastro.php';
    }

    ################  GRAVAR ##################    
    # gravar registro

    public function gravar() {

        $itens_nota = new Itens_notaConEstoqueModel;

        if ($itens_nota->gravar($_POST)) {
            FuncaoBase::alert("Registro Gravado com Sucesso !");
            $this->redirect("ajuda", "itens_nota", "index");
        }
    }
            
    # pesquisa registro

    public function pesquisa() {

            include_once 'mod_ajuda/backEnd/View/conEstoque/itens_nota/pesquisa.php';
    }
    

    #visualizar registro

    public function view() {
         $itens_notaModel = $this->itens_nota;
        $view = $this->itens_nota->view($_GET['id']);
        include_once 'mod_ajuda/backEnd/View/conEstoque/itens_nota/view.php';
    }

    # editar registro

    public function edit() {

        $itens_notaModel = new Itens_notaConEstoqueModel;

        if ($this->isPost()) {

            $result = $itens_notaModel->edit($_POST);
            
            //var_dump($result);
            if (!empty($result)) {
                FuncaoBase::alert("Registro Atualizado com Sucesso !");
                $view = $itens_notaModel->view($_POST['id_itens_nota']);
                $param = array('id'=> $_POST['id_itens_nota']);
                $this->redirect("ajuda", "itens_nota", "view", $param);
            }
        } else {

            $view = $itens_notaModel->view($_GET['id']);
            include_once 'mod_ajuda/backEnd/View/conEstoque/itens_nota/edit.php';
        }
    }
    
    /*  deletar registro */
    public function delete() {
        
       if($this->itens_nota->delete($_GET['id'])){
           FuncaoBase::alert("Registro Apagado com Sucesso !");
       }

            $this->redirect("ajuda", "itens_nota", "index");
        
    }

}