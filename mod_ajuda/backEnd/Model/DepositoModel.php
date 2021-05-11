<?php

/**
 *
 */
class DepositoModel {

    private $id_deposito;
    private $nome;
    private $endereco;

    protected $nomeDeposito;

    /* Construtor */
    function __construct() {

    }

    public function getIdDeposito() {
        return $this -> idDeposito;
    }

    public function setIdDeposito($idDeposito) {
        $this -> idDeposito = $idDeposito;
    }

    public function getNome() {
        return $this -> nome;
    }

    public function setNome($nome) {
        $this -> nome = $nome;
    }
    
    /**
     * Cadastrar Deposito
     * @param id_deposito
     * @param nome
     * @param endereco
     */
    public function cadastrar($nome, $endereco){
        
        
        return true;
    }
    
    public function alterar($id_deposito){
        
        return true;
        
    }
    
    public function listarTodos(){
        
        $lista = array();
        
        
        
        return $lista;
    }

}
?>
