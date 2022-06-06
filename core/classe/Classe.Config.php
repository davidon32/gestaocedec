<?php

class Config {
	
	public static $SIMNAO = array(array('1','Sim'), array('0','Nao'));
	
	public static $ATIVOINATIVO = array(array('1','Ativo'), array('0','Inativo'));

    function buscaModoAtualizacao($_tipo) {

        $_sql = "SELECT qtd_acesso, dias_acesso
                     FROM cedec_config
                     WHERE tp_acesso = " . $_tipo;
    }
    
    
    
    /***
     * 
     * Tradução Controller
     */
    public static function traducaoController($controller) {
        
        $result['h_pedido_pedid'] = 'MÓDULO AJUDA HUMANITARIA';
        $result['admin'] = 'MÓDULO CEDEC ADMINISTRATIVO';
        $result['ajuda'] = 'MÓDULO DLOG - CONTROLE DE MATERIAIS';
        $result['cce'] = 'MÓDULO DRD';
        $result['h_pedido_index'] = 'MÓDULO AJUDA HUMANITARIA';
        $result['index'] = 'MÓDULOS PARA ACESSO';
        $result['h_pedido_itens'] = 'MÓDULO AJUDA HUMANITARIA';
        $result['h_pedido_prest'] = 'MÓDULO AJUDA HUMANITARIA';
        $result['h_pedido_benef'] = 'MÓDULO AJUDA HUMANITARIA';
        $result['h_pedido_anexo'] = 'MÓDULO AJUDA HUMANITARIA';
        $result['h_pedido_an_tec'] = 'MÓDULO AJUDA HUMANITARIA';

        
        
        return isset($result[$controller]) ? $result[$controller] : $controller;
    }
    
    
    /***
     * 
     * Tradução Controller
     */
    public static function traducaobreadcrumb($controller) {
        
        $result['h_pedido_index'] = 'Pagina Inicial';
        $result['index'] = 'Pagina Inicial';
        $result['h_pedido_prest'] = "Prestação de de Contas";

        
        return isset($result[$controller]) ? $result[$controller] : $controller;
    }
    
    
    /**
     * Marca checkbox Alta performance
     * 
     */
    public static function AtualizaConfig($campo, $valor) {
        
        $con = Conexao::getInstance();
        $sql = "update cedec_config set ".$campo." = :campo
                                               where id_config = 1";
        try {
            $result = $con->prepare($sql);
            $result->bindValue(":campo", $valor);
            
            $result->execute();

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "-";
        }      
        
    }
    
    
    /**
     * Busca dados Config
     * 
     */
    public static function getConfig() {
        
        $con = Conexao::getInstance();
        
        $dado = "";
        
        $sql = "select *from cedec_config limit 1";
        
        
        try {

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dado = $linha;
            }
            
            return $dado;
            
        } catch (Exception $e) {
            return $e->getMessage() . "Erro get Config!";
        }
        
               
        
    }
       
}?>