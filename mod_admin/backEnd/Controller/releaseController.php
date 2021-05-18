<?php
include_once('core/Controller/Controller.php');
        
/* * *********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 	
 *      Gerado de Código : 1.0
 * 	Controller tabela cedec_release										*
 * 																					*
 * 	Autor: Demetrio da Silva Passos	
 *      MASP: 1296844
 * 																					*
 * 	Criacao : 18/05/2021															*
 * ********************************************************************************** */

class releaseController extends Controller {

    private $release;
    private $releases;
    private $campos;
    public $numPage;
    
    public function __construct() {
        $this->release = new ReleaseModel;
        $this->releases = $this->release->lista();

    }

    # index release

    public function index() {
        $releaseModel = $this->release;
        include_once 'mod_admin/backEnd/View/release/index.php';
    }

    /* paginacao */

    public function paginacao($page, $numPage) {
        
        $this->numPage = $numPage;

        $totalRegistro = count($this->releases);
        $regPorPagina = $numPage;
        
        $totPag = ceil($totalRegistro / $numPage);

        $start = ($page - 1) * $regPorPagina;

        $paginacao = $this->release->paginacao($start, $regPorPagina);
       
        return array($paginacao, $totPag);
       
    }
        
    ################  EXPORTAR ##################    
    # Exportar dados excel
    public function exportar() {

        $release = new ReleaseConEstoqueModel;
        
        $dados = $release->lista();
        
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
        include_once 'mod_admin/backEnd/View/release/cadastro.php';
    }

    ################  GRAVAR ##################    
    # gravar registro

    public function gravar() {

        $release = new ReleaseModel;

        if ($release->gravar($_POST)) {
            FuncaoBase::alert("Registro Gravado com Sucesso !");
            $this->redirect("admin", "release", "index");
        }
    }
            
    # pesquisa registro

    public function pesquisa() {

            include_once 'mod_admin/backEnd/View/release/pesquisa.php';
    }
    

    #visualizar registro

    public function view() {
         $releaseModel = $this->release;
        $view = $this->release->view($_GET['id']);
        include_once 'mod_admin/backEnd/View/release/view.php';
    }

    # editar registro

    public function edit() {

        $releaseModel = new ReleaseModel  ;

        if ($this->isPost()) {

            $result = $releaseModel->edit($_POST);
            
            //var_dump($result);
            if (!empty($result)) {
                FuncaoBase::alert("Registro Atualizado com Sucesso !");
                $view = $releaseModel->view($_POST['id_release']);
                $param = array('id'=> $_POST['id_release']);
                $this->redirect("admin", "release", "view", $param);
            }
        } else {

            $view = $releaseModel->view($_GET['id']);
            include_once 'mod_admin/backEnd/View/release/edit.php';
        }
    }
    
    /*  deletar registro */
    public function delete() {
        
       if($this->release->delete($_GET['id'])){
           FuncaoBase::alert("Registro Apagado com Sucesso !");
       }

            $this->redirect("admin", "release", "index");
    }
    
    /**
     * 
     *  
     */
    public function rel(){
        
        $dados_rel = $this->release->relRelease();

        print "<style>*{ font-family: Consolas, monaco, monospace;font-size: 15pt;}"
        . "table{ width:100%; padding:10px;} tr:nth-child(even) {background-color: #f2f2f2;} th{background-color:#999999}</style>";
        print "<div style='overflow-x:auto;'>";
        print "<p align='center'><a href='".FuncaoBase::geraLink("index", "index", "index")."'><img src='/core/imagem/voltar.png'></a></p>";
        print "<table>";
        print "<tr><th style='width:10%'>Data </th><th>Release</th></tr>";
        
        foreach ($dados_rel as $key => $value) {
        print "<tr>";
        print "<td>". DataMysql::dataVisual($value['data_release'])."</td>";
        print "<td>".$value['texto']."</td>";
        print "</tr>";
        
        
        }
        
        print "</table>";
        print "</div>";
        
        
    }

}