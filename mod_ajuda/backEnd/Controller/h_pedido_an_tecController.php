
<?php
include_once('core/Controller/Controller.php');
        
/* * *********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 	
 *      Gerado de Código : 1.0
 * 	Controller tabela aju_h_pedido_an_tec										*
 * 																					*
 * 	Autor: Demetrio da Silva Passos	
 *      MASP: 1296844
 * 																					*
 * 	Criacao : 12/07/2021															*
 * ********************************************************************************** */

class h_pedido_an_tecController extends Controller {

    private $h_pedido_an_tec;
    private $h_pedido_an_tecs;
    private $campos;
    public $numPage;
    
    public function __construct() {
        $this->h_pedido_an_tec = new H_pedido_an_tecajuda_hModel;
        $this->h_pedido_an_tecs = $this->h_pedido_an_tec->lista();

    }

    # index h_pedido_an_tec

    public function index() {
        $h_pedido_an_tecModel = $this->h_pedido_an_tec;
        include_once 'mod_ajuda/backEnd/View/ajuda_h/h_pedido_an_tec/index.php';
    }

    /* paginacao */

    public function paginacao($page, $numPage) {
        
        $this->numPage = $numPage;

        $totalRegistro = count($this->h_pedido_an_tecs);
        $regPorPagina = $numPage;
        
        $totPag = ceil($totalRegistro / $numPage);

        $start = ($page - 1) * $regPorPagina;

        $paginacao = $this->h_pedido_an_tec->paginacao($start, $regPorPagina);
       
        return [$paginacao, $totPag];
       
    }
        
    ################  EXPORTAR ##################    
    # Exportar dados excel
    public function exportar() {

        $h_pedido_an_tec = new H_pedido_an_tecajuda_hModel;
        
        $dados = $h_pedido_an_tec->lista();
        
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

            include_once 'mod_ajuda/backEnd/View/ajuda_h/h_pedido_an_tec/cadastro.php';
        
    }

    ################  GRAVAR ##################    
    # gravar registro

    public function gravar() {
        
        
        
        $_POST['id_usuario'] = $_COOKIE['seguranca']['idUser'];
        
        $h_pedido_an_tec = new H_pedido_an_tecajuda_hModel;

        if (var_dump($h_pedido_an_tec->gravar($_POST))) {
            FuncaoBase::alert("Registro Gravado com Sucesso !");
            $this->redirect("ajuda", "h_pedido_an_tec", "index");
        }
    }
            
    # pesquisa registro

    public function pesquisa() {

            include_once 'mod_ajuda/backEnd/View/ajuda_h/h_pedido_an_tec/pesquisa.php';
    }
    

    #visualizar registro

    public function view() {
         $h_pedido_an_tecModel = $this->h_pedido_an_tec;
        $view = $this->h_pedido_an_tec->view($_GET['id']);
        include_once 'mod_ajuda/backEnd/View/ajuda_h/h_pedido_an_tec/view.php';
    }

    # editar registro

    public function edit() {

        $h_pedido_an_tecModel = new H_pedido_an_tecajuda_hModel;

        if ($this->isPost()) {

            $result = $h_pedido_an_tecModel->edit($_POST);
            
            //var_dump($result);
            if (!empty($result)) {
                FuncaoBase::alert("Registro Atualizado com Sucesso !");
                $view = $h_pedido_an_tecModel->view($_POST['id_h_pedido_an_tec']);
                $param = array('id'=> $_POST['id_h_pedido_an_tec']);
                $this->redirect("ajuda", "h_pedido_an_tec", "view", $param);
            }
        } else {

            $view = $h_pedido_an_tecModel->view($_GET['id']);
            include_once 'mod_ajuda/backEnd/View/ajuda_h/h_pedido_an_tec/edit.php';
        }
    }
    
    /*  deletar registro */
    public function delete() {
        
       if($this->h_pedido_an_tec->delete($_GET['id'])){
           FuncaoBase::alert("Registro Apagado com Sucesso !");
       }

            $this->redirect("ajuda", "h_pedido_an_tec", "index");
        
    }

}