
<?php
include_once('core/Controller/Controller.php');
        
/* * *********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 	
 *      Gerado de Código : 1.0
 * 	Controller tabela aju_h_pedido_benef										*
 * 																					*
 * 	Autor: Demetrio da Silva Passos	
 *      MASP: 1296844
 * 																					*
 * 	Criacao : 21/06/2021															*
 * ********************************************************************************** */

class h_pedido_benefController extends Controller {

    private $h_pedido_benef;
    private $h_pedido_benefs;
    private $campos;
    public $numPage;
    
    public function __construct() {
        $this->h_pedido_benef = new H_pedido_benefajuda_hModel;
        $this->h_pedido_benefs = $this->h_pedido_benef->lista();

    }

    # index h_pedido_benef

    public function index() {
        $h_pedido_benefModel = $this->h_pedido_benef;
        include_once 'mod_ajuda/frontEnd/View/ajuda_h/h_pedido_benef/index.php';
    }

    /* paginacao */

    public function paginacao($page, $numPage) {
        
        $this->numPage = $numPage;

        $totalRegistro = count($this->h_pedido_benefs);
        $regPorPagina = $numPage;
        
        $totPag = ceil($totalRegistro / $numPage);

        $start = ($page - 1) * $regPorPagina;

        $paginacao = $this->h_pedido_benef->paginacao($start, $regPorPagina);
       
        return array($paginacao, $totPag);
       
    }
        
    ################  EXPORTAR ##################    
    # Exportar dados excel
    public function exportar() {

        $h_pedido_benef = new H_pedido_benefajuda_hModel;
        
        $dados = $h_pedido_benef->lista();
        
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
        include_once 'mod_ajuda/frontEnd/View/ajuda_h/h_pedido_benef/cadastro.php';
    }

    ################  GRAVAR ##################    
    # gravar registro

    public function gravar() {
              
        $h_pedido_benef = new H_pedido_benefajuda_hModel;

        # quantidade restante de lancamento
        if($_POST['qtd'] <= $h_pedido_benef->verificaRestanteBenef($_POST['id_prest_conta'])) {

            //var_dump($h_pedido_benef->gravar($_POST));
            //die();
            if ($h_pedido_benef->gravar($_POST)) {
                //FuncaoBase::alert("Registro Gravado com Sucesso !");
                //$this->redirect("ajuda", "h_pedido_benef", "cadastro", array('id'=>$_POST['id_prest_conta'], 'id_pedido'=>$_POST['id_pedido']));
            }
        }else {
            //FuncaoBase::alert("Quantidade de Material excede o limite esperado para prestar contas !\\n\\nVerifique o material restante para prestar Contas !");
            //$this->redirect("ajuda", "h_pedido_benef", "cadastro", array('id'=>$_POST['id_prest_conta'], 'id_pedido'=>$_POST['id_pedido']));
        }
    }
            
    # pesquisa registro

    public function pesquisa() {

            include_once 'mod_ajuda/frontEnd/View/ajuda_h/h_pedido_benef/pesquisa.php';
    }
    

    #visualizar registro

    public function view() {
         $h_pedido_benefModel = $this->h_pedido_benef;
        $view = $this->h_pedido_benef->view($_GET['id']);
        include_once 'mod_ajuda/frontEnd/View/ajuda_h/h_pedido_benef/view.php';
    }

    # editar registro

    public function edit() {

        $h_pedido_benefModel = new H_pedido_benefajuda_hModel;

        if ($this->isPost()) {

            $result = $h_pedido_benefModel->edit($_POST);
            
            //var_dump($result);
            if (!empty($result)) {
                FuncaoBase::alert("Registro Atualizado com Sucesso !");
                $view = $h_pedido_benefModel->view($_POST['id_h_pedido_benef']);
                $param = array('id'=> $_POST['id_h_pedido_benef']);
                $this->redirect("ajuda", "h_pedido_benef", "view", $param);
            }
        } else {

            $view = $h_pedido_benefModel->view($_GET['id']);
            include_once 'mod_ajuda/frontEnd/View/ajuda_h/h_pedido_benef/edit.php';
        }
    }
    
    /*  deletar registro */
    public function delete() {

       if($this->h_pedido_benef->delete($_GET['id'])){
           FuncaoBase::alert("Registro Apagado com Sucesso !");
       }

            $this->redirect("ajuda", "h_pedido_prest", "view", array('id'=>$_GET['id_prest_conta']));
        
    }

}