<?php
include_once('core/Controller/Controller.php');
        
/* * *********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 	
 *      Gerado de Código : 1.0
 * 	Controller tabela aju_entrada_nota										*
 * 																					*
 * 	Autor: Demetrio da Silva Passos	
 *      MASP: 1296844
 * 																					*
 * 	Criacao : 29/09/2020															*
 * ********************************************************************************** */

class entrada_notaController extends Controller {

    private $entrada_nota;
    private $entrada_notas;
    private $campos;
    public $numPage;
    
    public function __construct() {
        $this->entrada_nota = new Entrada_notaConEstoqueModel;
        $this->entrada_notas = $this->entrada_nota->lista();
        
       

    }

    # index entrada_nota

    public function index() {
        $entrada_notaModel = $this->entrada_nota;
        
        include_once 'mod_ajuda/backEnd/View/conEstoque/entrada_nota/index.php';
    }

    /* paginacao */

    public function paginacao($page, $numPage) {
        
        $this->numPage = $numPage;

        $totalRegistro = count($this->entrada_notas);
        $regPorPagina = $numPage;
        
        $totPag = ceil($totalRegistro / $numPage);

        $start = ($page - 1) * $regPorPagina;

        $paginacao = $this->entrada_nota->paginacao($start, $regPorPagina);
       
        return array($paginacao, $totPag);
       
    }
        
    ################  EXPORTAR ##################    
    # Exportar dados excel
    public function exportar() {

        $entrada_nota = new Entrada_notaConEstoqueModel;
        $dados = $entrada_nota->listaExportar();
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
        include_once 'mod_ajuda/backEnd/View/conEstoque/entrada_nota/cadastro.php';
    }

    ################  GRAVAR ##################    
    # gravar registro

    public function gravar() {

        $entrada_nota = new Entrada_notaConEstoqueModel;

        $entrada_nota->gravar($_POST);
        //die();
        //$entrada_nota->gravar($_POST);
                       
            //FuncaoBase::alert("Registro Gravado com Sucesso !");
            //$this->redirect("ajuda", "entrada_nota", "index");
        
    }
            
    # pesquisa registro

    public function pesquisa() {

            include_once 'mod_ajuda/backEnd/View/conEstoque/entrada_nota/pesquisa.php';
    }
    

    #visualizar registro

    public function view() {
         $entrada_notaModel = $this->entrada_nota;
        $view = $this->entrada_nota->view($_GET['id']);
        include_once 'mod_ajuda/backEnd/View/conEstoque/entrada_nota/view.php';
    }

    # editar registro

    public function edit() {

        $entrada_notaModel = new Entrada_notaConEstoqueModel;

        if ($this->isPost()) {

            $result = $entrada_notaModel->edit($_POST);
            
            //var_dump($result);
            if (!empty($result)) {
                FuncaoBase::alert("Registro Atualizado com Sucesso !");
                $view = $entrada_notaModel->view($_POST['id_entrada_nota']);
                $param = array('id'=> $_POST['id_entrada_nota']);
                $this->redirect("ajuda", "entrada_nota", "view", $param);
            }
        } else {

            $view = $entrada_notaModel->view($_GET['id']);
            include_once 'mod_ajuda/backEnd/View/conEstoque/entrada_nota/edit.php';
        }
    }
    
    /*  deletar registro */
    public function delete() {
        
        $id_entrada = isset($_GET['id']) ? $_GET['id'] : "";

       # verifica liberação / transferencia com a entrada
       if(!Pedido::existePedido($id_entrada) && !TransferenciaConMaterialModel::existeTransferencia($id_entrada)) {
           $this->entrada_nota->delete($_GET['id']);
           $this->entrada_nota->deleteCCCEntradaNota($_GET['id']);
           FuncaoBase::alert("Registro Apagado com Sucesso !");
           $this->redirect("ajuda", "entrada_nota", "index");
       }else {
           print "<script>";
           print "alert('Existe pedidos ja realizados para essa entrada de nota !');";
           print "</script>";
           $this->redirect("ajuda", "entrada_nota", "index");
       }

            
        
    }

}