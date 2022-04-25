<?php

include_once PATH . '/core/include.php';

class H_ajuda extends DataMysql {
    
    
    public static function Pedido($id_pedido) {
        $dados = array();
        $con = Conexao::getInstance();
        
        $sql = "SELECT *FROM aju_h_pedido_pedid
                WHERE id = ".$id_pedido;
        
        $result = $con->query($sql);
        
        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados = $linha;
        }
        
        return $dados;
    }
    
    
    public static function ItemPedido($id_pedido) {
        $dados = array();
        $con = Conexao::getInstance();
        
        $sql = "SELECT *FROM aju_h_pedido_itens
                WHERE id_pedido = ".$id_pedido;
        
        $result = $con->query($sql);
        
        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados[] = $linha;
        }
        
        return $dados;
        
    }
    
    public static function Beneficiario($id_item) {
        
        $dados = array();
        $con = Conexao::getInstance();

        $sql = "SELECT *FROM aju_h_pedido_benef
                WHERE id_prest_conta = ".$id_item;
        
        $result = $con->query($sql);
        
        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados[] = $linha;
        }
        
        return $dados;
        
    }
    
    
    

    
    
}