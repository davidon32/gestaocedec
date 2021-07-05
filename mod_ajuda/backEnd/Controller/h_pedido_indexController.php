
<?php
include_once('core/Controller/Controller.php');
        
/* * *********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 	
 *      Gerado de Código : 1.0
 * 	Controller tabela aju_h_pedido_pedid										*
 * 																					*
 * 	Autor: Demetrio da Silva Passos	
 *      MASP: 1296844
 * 																					*
 * 	Criacao : 21/06/2021															*
 * ********************************************************************************** */

class h_pedido_indexController extends Controller {

    private $h_pedido_pedid;
    private $h_pedido_pedids;
    private $campos;
    public $numPage;
    
    public function __construct() {
        $this->h_pedido_pedid = new H_pedido_pedidajuda_hModel;
        $this->h_pedido_pedids = $this->h_pedido_pedid->lista();

    }

    # index h_pedido_pedid

    public function index() {
        $h_pedido_pedidModel = $this->h_pedido_pedid;
        include_once 'mod_ajuda/backEnd/View/ajuda_h/index.php';
    }

    /* paginacao */

    public function paginacao($page, $numPage) {
        
        $this->numPage = $numPage;

        $totalRegistro = count($this->h_pedido_pedids);
        $regPorPagina = $numPage;
        
        $totPag = ceil($totalRegistro / $numPage);

        $start = ($page - 1) * $regPorPagina;

        $paginacao = $this->h_pedido_pedid->paginacao($start, $regPorPagina);
       
        return [$paginacao, $totPag];
       
    }
        
    ################  EXPORTAR ##################    
    # Exportar dados excel
    public function exportar() {

        $h_pedido_pedid = new H_pedido_pedidajuda_hModel;
        
        $dados = $h_pedido_pedid->lista();
        
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
           
    # pesquisa registro
    public function pesquisa() {

            include_once 'mod_ajuda/backEnd/View/ajuda_h/h_pedido_pedid/pesquisa.php';
    }
}