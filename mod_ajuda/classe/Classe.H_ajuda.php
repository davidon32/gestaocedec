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
    
    
    public static function ItemPedido($id_pedido, $tipo) {
        $dados = array();
        $con = Conexao::getInstance();
        
        $sql = "SELECT *FROM aju_h_pedido_itens
                WHERE id_pedido = ".$id_pedido." 
                and tp_item = '".$tipo."'";
        
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
    
    public static function BuscaPedidoMunicipio($_municipio) {
        
        $dados = array();
        $con = Conexao::getInstance();

        $sql = "SELECT  aju_h_pedido_pedid.id, 
			aju_h_pedido_pedid.data_entrada_sistema,
			aju_h_pedido_pedid.id_municipio,
			aju_h_pedido_pedid.status,
			aju_h_pedido_pedid.tramit,
                        aju_h_pedido_pedid.data_aprovacao,
			dec_cobrade.nome,
			cedec_municipio.nome,
                        aju_h_pedido_pedid.data_aprovacao,
                        aju_h_pedido_pedid.numero,
                        aju_h_pedido_pedid.id_cobrade,
                        aju_h_pedido_pedid.data_hora_envio
			from aju_h_pedido_pedid
			INNER JOIN dec_cobrade
			ON aju_h_pedido_pedid.ID_COBRADE = dec_cobrade.id_cobrade
			INNER JOIN cedec_municipio
			ON aju_h_pedido_pedid.id_municipio = cedec_municipio.id_municipio
                        WHERE cedec_municipio.nome LIKE :nome";
                
        $result = $con->prepare($sql);
            $result->bindValue(":nome", "%$_municipio%");
            $result->execute();
        
        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados[] = $linha;
        }
        
        return $dados;
        
    }
    
    
    

    
    
}