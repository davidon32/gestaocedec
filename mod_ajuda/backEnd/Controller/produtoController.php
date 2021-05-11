<?php
include_once('core/Controller/Controller.php');
        
/* * *********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 	
 *      Gerado de Código : 1.0
 * 	Controller tabela aju_produto										*
 * 																					*
 * 	Autor: Demetrio da Silva Passos	
 *      MASP: 1296844
 * 																					*
 * 	Criacao : 21/09/2020															*
 * ********************************************************************************** */

class produtoController extends Controller {

    private $produto;
    private $produtos;
    private $campos;
    public $numPage;

    public function __construct() {
        $this->produto = new ProdutoConEstoqueModel;
        $this->produtos = $this->produto->lista();

    }

    # index produto

    public function index() {

        include_once 'mod_ajuda/backEnd/View/conEstoque/produto/index.php';
    }

    /* paginacao */

    public function paginacao($page, $numPage) {
        
        $this->numPage = $numPage;

        $totalRegistro = $this->produtos->rowCount();
        $regPorPagina = $numPage;
        
        $totPag = ceil($totalRegistro / $numPage);

        $start = ($page - 1) * $regPorPagina;

        $paginacao = $this->produto->paginacao($start, $regPorPagina);
       
        return [$paginacao, $totPag];
       
    }

    # formulario cadastro

    public function cadastro() {
        include_once 'mod_ajuda/backEnd/View/conEstoque/produto/cadastro.php';
    }

    # gravar registro

    public function gravar() {

        $produto = new ProdutoConEstoqueModel;

        if ($produto->gravar($_POST)) {
            FuncaoBase::alert("Registro Gravado com Sucesso !");
            //$this->redirect("ajuda", "produto", "index");
        }
    }

    #visualizar registro

    public function view() {

        $view = $this->produto->view($_GET['id']);
        include_once 'mod_ajuda/backEnd/View/conEstoque/produto/view.php';
    }

    # editar registro

    public function edit() {

        $marca = new ProdutoConEstoqueModel;

        if ($this->isPost()) {

            $result = $produto->edit($_POST);
            
            //var_dump($result);
            if (!empty($result)) {
                FuncaoBase::alert("Registro Atualizado com Sucesso !");
                $view = $produto->view($_POST['id_marca']);
                $param = array('id'=> $_POST['id_marca']);
                $this->redirect("ajuda", "marca", "view", $param);
            }
        } else {

            $view = $marca->view($_GET['id']);
            include_once 'mod_ajuda/backEnd/View/conEstoque/marca/edit.php';
        }
    }
    
    /*  deletar registro */
    public function delete() {
        
       if($this->marca->delete($_GET['id'])){
           FuncaoBase::alert("Registro Apagado com Sucesso !");
       }

            $this->redirect("ajuda", "marca", "index");
        
    }

}