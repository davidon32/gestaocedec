<?php
include_once('core/Controller/Controller.php');
        
/* * *********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 	
 *      Gerado de Código : 1.0
 * 	Controller tabela aju_montagem										*
 * 																					*
 * 	Autor: Demetrio da Silva Passos	
 *      MASP: 1296844
 * 																					*
 * 	Criacao : 15/10/2020															*
 * ********************************************************************************** */

class transferencianController extends Controller {

    private $transferencia;
    private $transferencias;
    private $campos;
    public $numPage;
    
    public function __construct() {
        $this->transferencia = new TransferenciaConEstoqueModel;
        
        $this->transferencias = $this->transferencia->lista();

    }

    # index montagem

    public function index() {
        $transferenciaModel = $this->transferencia;
        include_once 'mod_ajuda/backEnd/View/conEstoque/transferencian/index.php';
    }

    /* paginacao */

    public function paginacao($page, $numPage) {
        
        $this->numPage = $numPage;

        $totalRegistro = count($this->transferencias);
        $regPorPagina = $numPage;
        
        $totPag = ceil($totalRegistro / $numPage);

        $start = ($page - 1) * $regPorPagina;

        $paginacao = $this->transferencia->paginacao($start, $regPorPagina);
       
        return array($paginacao, $totPag);
       
    }
        
    ################  EXPORTAR ##################    
    # Exportar dados excel
    public function exportar() {

        $transferencia = new TransferenciaConEstoqueModel;
        
        $dados = $transferencia->lista();
        
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
        
        
        include_once 'mod_ajuda/backEnd/View/conEstoque/transferencian/cadastro.php';
    }
    
    # formulario impressao
    public function impressao() {
        $transferenciaModel = $this->$transferencia;
        $view = $this->$transferencia->view($_GET['id']);
        $pedidos = $transferenciaModel->lstpedidomont($_GET['id']);
        include_once 'mod_ajuda/backEnd/View/conEstoque/transferencian/impressao.php';
    }

    ################  GRAVAR ##################    
    # gravar registro

    public function gravar() {
               
        $pedido = new PedidoConEstoqueModel;
        
        $transferencia = new TransferenciaConEstoqueModel;

        $item = array(  'id_pedido'         => null,
                        'data_registro'     => DataMysql::dataForm(substr($_POST['data_transferencia'], 0,10)),
                        'id_unidade'        => $_POST['id_unidade'],
                        'qtd'               => $_POST['qtd'],
                        'val_unitario'      => $_POST['val_unit'],
                        'val_total'         => ($_POST['val_unit'] * $_POST['qtd']),
                        'id_nota'           => $_POST['id_nota'],
                        'id_tp_pedido'      => $_POST['id_tp_pedido']);

        # gravar
        
        $res = $transferencia->gravar($_POST);

        if ($res['result']) {
            
            # debitar saldo origem
            $item['id_almoxarifado'] = $_POST['id_almoxarifado_ori']; 
            $item['historico'] = "Transferencia Nr ".$res['id_transferencia']." Débito de ". $pedido->getNomeIdFk('aju_calmoxarifado', 'id_almoxarifado', $_POST['id_almoxarifado_ori'])->nome;
            $item['tipo_lancamento'] = 'saida'; 
            $pedido->debitar($item); 

            #cretidar saldo destino
            $item['id_almoxarifado'] = $_POST['id_almoxarifado']; 
            $item['historico'] = "Transferencia Nr ".$res['id_transferencia']." Crédito para ". $pedido->getNomeIdFk('aju_calmoxarifado', 'id_almoxarifado', $_POST['id_almoxarifado'])->nome;
            $item['tipo_lancamento'] = 'entrada'; 
            $pedido->creditar($item); 

            ob_start();
                setcookie("transferencia[id_material]", null, -1, '/');
                setcookie("transferencia[id_almoxarifado]", null, -1, '/');
                setcookie("transferencia[id_tp_pedido]", null, -1, '/');
                setcookie("transferencia[saldo]", null, -1, '/');
            ob_end_clean(); 
            
            print "sucesso";
        }
    }
            
    # pesquisa registro

    public function pesquisa() {

            include_once 'mod_ajuda/backEnd/View/conEstoque/transferencian/pesquisa.php';
    }
    
    #visualizar registro

    public function view() {
        $transferenciaModel = $this->transferencia;
         
        $view = $this->transferencia->view($_GET['id']);
        include_once 'mod_ajuda/backEnd/View/conEstoque/transferencian/view.php';
    }

    # editar registro

    public function edit() {

        $transferenciaModel = new TransferenciaConEstoqueModel;

        if ($this->isPost()) {

            $result = $transferenciaModel->edit($_POST);
            
            //var_dump($result);
            if (!empty($result)) {
                FuncaoBase::alert("Registro Atualizado com Sucesso !");
                $view = $transferenciaModel->view($_POST['id_transferencia']);
                $param = array('id'=> $_POST['id_transferencia']);
                $this->redirect("ajuda", "transferencian", "view", $param);
            }
        } else {

            $view = $transferenciaModel->view($_GET['id']);
            include_once 'mod_ajuda/backEnd/View/conEstoque/transferencian/edit.php';
        }
    }
    
    /*  deletar registro */
    public function delete() {
        
       if($this->transferencia->delete($_GET['id'])){
           FuncaoBase::alert("Registro Apagado com Sucesso !");
       }

            $this->redirect("ajuda", "transferencia", "index");
        
    }

}