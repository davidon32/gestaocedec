
<?php
include_once('core/Controller/Controller.php');
        
/* * *********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 	
 *      Gerado de Código : 1.0
 * 	Controller tabela aju_h_pedido_prest										*
 * 																					*
 * 	Autor: Demetrio da Silva Passos	
 *      MASP: 1296844
 * 																					*
 * 	Criacao : 21/06/2021															*
 * ********************************************************************************** */

class h_pedido_prestController extends Controller {

    private $h_pedido_prest;
    private $h_pedido_prests;
    private $campos;
    public $numPage;
    
    public function __construct() {
        $this->h_pedido_prest = new H_pedido_prestajuda_hModel;
        $this->h_pedido_prests = $this->h_pedido_prest->lista();

    }

    # index h_pedido_prest

    public function index() {
        $h_pedido_prestModel = $this->h_pedido_prest;
        include_once 'mod_ajuda/frontEnd/View/ajuda_h/h_pedido_prest/index.php';
    }

    /* paginacao */

    public function paginacao($page, $numPage) {
        
        $this->numPage = $numPage;

        $totalRegistro = count($this->h_pedido_prests);
        $regPorPagina = $numPage;
        
        $totPag = ceil($totalRegistro / $numPage);

        $start = ($page - 1) * $regPorPagina;

        $paginacao = $this->h_pedido_prest->paginacao($start, $regPorPagina);
       
        return [$paginacao, $totPag];
       
    }
        
    ################  EXPORTAR ##################    
    # Exportar dados excel
    public function exportar() {

        $h_pedido_prest = new H_pedido_prestajuda_hModel;
        
        $dados = $h_pedido_prest->lista();
        
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
        include_once 'mod_ajuda/frontEnd/View/ajuda_h/h_pedido_prest/cadastro.php';
    }

    ################  GRAVAR ##################    
    # gravar registro

    public function gravar() {

        $h_pedido_prest = new H_pedido_prestajuda_hModel;

        if ($h_pedido_prest->gravar($_POST)) {
            FuncaoBase::alert("Registro Gravado com Sucesso !");
            $this->redirect("ajuda", "h_pedido_prest", "index");
        }
    }
            
    # pesquisa registro

    public function pesquisa() {

            include_once 'mod_ajuda/frontEnd/View/ajuda_h/h_pedido_prest/pesquisa.php';
    }
    

    #visualizar registro

    public function view() {
         $h_pedido_prestModel = $this->h_pedido_prest;
        $view = $this->h_pedido_prest->view($_GET['id']);
        include_once 'mod_ajuda/frontEnd/View/ajuda_h/h_pedido_prest/view.php';
    }

    # editar registro

    public function edit() {

        $h_pedido_prestModel = new H_pedido_prestajuda_hModel;

        if ($this->isPost()) {

            $result = $h_pedido_prestModel->edit($_POST);
            
            //var_dump($result);
            if (!empty($result)) {
                FuncaoBase::alert("Registro Atualizado com Sucesso !");
                $view = $h_pedido_prestModel->view($_POST['id_h_pedido_prest']);
                $param = array('id'=> $_POST['id_h_pedido_prest']);
                $this->redirect("ajuda", "h_pedido_prest", "view", $param);
            }
        } else {

            $view = $h_pedido_prestModel->view($_GET['id']);
            include_once 'mod_ajuda/frontEnd/View/ajuda_h/h_pedido_prest/edit.php';
        }
    }
    
    /*  deletar registro */
    public function delete() {
        
       if($this->h_pedido_prest->delete($_GET['id'])){
           FuncaoBase::alert("Registro Apagado com Sucesso !");
       }

            $this->redirect("ajuda", "h_pedido_prest", "index");
        
    }

}