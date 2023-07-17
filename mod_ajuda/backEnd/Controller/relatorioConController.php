<?php
include_once('core/Controller/Controller.php');
        
/* * *********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 	
 *      Gerado de Código : 1.0
 * 	Controller relatorios										*
 * 																					*
 * 	Autor: Demetrio da Silva Passos	
 *      MASP: 1296844
 * 																					*
 * 	Criacao : 15/10/2020															*
 * ********************************************************************************** */

class relatorioConController extends Controller {

    private $relatorio;
       
    public function __construct() {
        $this->relatorio = new RelatorioConEstoqueModel();
    }

    /* form filtro relatorio */
    public function inventario() {
        $relatorio = $this->relatorio;
        include_once 'mod_ajuda/backEnd/View/conEstoque/relatorio/form_inventario_busca.php';
    }
    
    /* relatorio inventario */
    public function rel_inventario() {
         
        if($this->isPost()){
       
        $relatorio = $this->relatorio;
        
        $dados = $relatorio->inventario($_POST);

            include_once 'mod_ajuda/backEnd/View/conEstoque/relatorio/rel_inventario.php';  
        }else {
          include_once 'mod_ajuda/backEnd/View/conEstoque/relatorio/form_inventario_busca.php';  
        }
    }
    
    /* form filtro relatorio */
    public function pedidos() {
        $relatorio = $this->relatorio;
        include_once 'mod_ajuda/backEnd/View/conEstoque/relatorio/form_pedido_busca.php';
    }
    
    /* relatorio inventario */
    public function rel_pedido() {
       
        if($this->isPost()){
            $relatorio = $this->relatorio;
            $dados = $relatorio->rel_pedidoModel($_POST);
            include_once 'mod_ajuda/backEnd/View/conEstoque/relatorio/rel_pedido.php';  
            
        }else {
          include_once 'mod_ajuda/backEnd/View/conEstoque/relatorio/form_pedido_busca.php';  
        }
    }

        
    ################  EXPORTAR ##################    
    # Exportar dados excel
    public function exportar() {

        $montagem = new MontagemConEstoqueModel;
        
        $dados = $montagem->lista();
        
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
    
     
    
    
    
    

}