
<?php
include_once('core/Controller/Controller.php');
        
/* * *********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 	
 *      Gerado de Código : 1.0
 * 	Controller tabela aju_h_pedido_itens										*
 * 																					*
 * 	Autor: Demetrio da Silva Passos	
 *      MASP: 1296844
 * 																					*
 * 	Criacao : 21/06/2021															*
 * ********************************************************************************** */

class h_pedido_itensController extends Controller {

    private $h_pedido_itens;
    private $h_pedido_itenss;
    private $campos;
    public $numPage;
    
    public function __construct() {
        $this->h_pedido_itens = new H_pedido_itensajuda_hModel;
        $this->h_pedido_itenss = $this->h_pedido_itens->lista();

    }

    # index h_pedido_itens

    public function index() {
        $h_pedido_itensModel = $this->h_pedido_itens;
        include_once 'mod_ajuda/frontEnd/View/ajuda_h/h_pedido_itens/index.php';
    }

    /* paginacao */

    public function paginacao($page, $numPage) {
        
        $this->numPage = $numPage;

        $totalRegistro = count($this->h_pedido_itenss);
        $regPorPagina = $numPage;
        
        $totPag = ceil($totalRegistro / $numPage);

        $start = ($page - 1) * $regPorPagina;

        $paginacao = $this->h_pedido_itens->paginacao($start, $regPorPagina);
       
        return array($paginacao, $totPag);
       
    }
        
    ################  EXPORTAR ##################    
    # Exportar dados excel
    public function exportar() {

        $h_pedido_itens = new H_pedido_itensajuda_hModel;
        
        $dados = $h_pedido_itens->lista();
        
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
        include_once 'mod_ajuda/frontEnd/View/ajuda_h/h_pedido_itens/cadastro.php';
    }

    ################  GRAVAR ##################    
    # gravar registro

    public function gravar() {     
        
        $h_pedido_itens = new H_pedido_itensajuda_hModel;
        
        if ($h_pedido_itens->gravar($_POST)) {
            FuncaoBase::alert("Produto Adicionado ao Pedido !");
            
            if($_GET['voltar']== 'idx_recente'){
                $this->redirect("ajuda", "h_pedido_pedid", "add_itens", array('id_pedido'=>$_POST['id_pedido'], 'voltar'=>'idx_recente'));
            }else {
                //$this->redirect("ajuda", "h_pedido_itens", "cadastro", array('id'=>$_POST['id']));
            }
        }
    }
            
    # pesquisa registro

    public function pesquisa() {

            include_once 'mod_ajuda/frontEnd/View/ajuda_h/h_pedido_itens/pesquisa.php';
    }
    

    #visualizar registro

    public function view() {
         $h_pedido_itensModel = $this->h_pedido_itens;
        $view = $this->h_pedido_itens->view($_GET['id']);
        include_once 'mod_ajuda/frontEnd/View/ajuda_h/h_pedido_itens/view.php';
    }

    # editar registro

    public function edit() {

        $h_pedido_itensModel = new H_pedido_itensajuda_hModel;

        if ($this->isPost()) {

            $result = $h_pedido_itensModel->edit($_POST);

                FuncaoBase::alert("Registro Atualizado com Sucesso !");
                $view = $h_pedido_itensModel->view($_POST['id']);
                $param = array('id'=> $_POST['id_pedido'], 'voltar'=>'idx_recente');
                $this->redirect("ajuda", "h_pedido_itens", "cadastro", $param);
                
            
        } else {

            $view = $h_pedido_itensModel->view($_GET['id']);
            include_once 'mod_ajuda/frontEnd/View/ajuda_h/h_pedido_itens/edit.php';
        }
    }
    
    /*  deletar registro */
    public function delete() {
        
       if($this->h_pedido_itens->delete($_GET['id'])){
           FuncaoBase::alert("Registro Apagado com Sucesso !");
       }
       
       if($_GET['voltar'] == 'idx_recente'){
            $this->redirect("ajuda", "h_pedido_pedid", "add_itens", array('id_pedido'=>$_GET['id_pedido'], 'voltar'=>'idx_recente'));
       }elseif($_GET['voltar']== 'edit_ped') {
            $this->redirect("ajuda", "h_pedido_pedid", "edit", array('id'=>$_GET['id_pedido'], 'voltar'=> 'idx_recente'));
       }   
    }
    
    
    /* lista itens */
    public static function listItens($_id_pedido){
        
        
    }

}