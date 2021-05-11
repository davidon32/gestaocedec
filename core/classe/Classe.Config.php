<?php

class Config {
	
	public static $SIMNAO = array(array('1','Sim'), array('0','Nao'));
	
	public static $ATIVOINATIVO = array(array('1','Ativo'), array('0','Inativo'));

    function buscaModoAtualizacao($_tipo) {

        $_sql = "SELECT qtd_acesso, dias_acesso
                     FROM cedec_config
                     WHERE tp_acesso = " . $_tipo;
    }

}
?>