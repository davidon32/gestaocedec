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
}
?>