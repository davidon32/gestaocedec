<?php

/***********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 																					*
 * 	Classe Conexao com o banco de dados mysql										*
 * 																					*
 * 	Autor: Demetrio da Silva Passos													*
 * 																					*
 * 	Criacao : 01/02/2012															*
 ************************************************************************************/

class ConexaoMysql {

    private $_host = HOST;

    private $_usuario = 'usuario';

    private $_senha = 'usuario';

    private $_banco = 'gestaocedec';
    
    static $conexao = null;

    /**
     * Construtor para conexao com o Banco de dados
     * @param null
     * @return resource
     * 
     */
    function __construct() {

        $host = $this -> _host;
        $usuario = $this -> _usuario;
        $senha = $this -> _senha;

        try {

        	//var_dump($_path);
        	
            $_conexao = mysqli_connect($host, $usuario, $senha, $this ->_banco);

            mysqli_select_db($_conexao, $this ->_banco) or die(mysqli_error() . 'Código : 01');

        } catch (Exception $e) {

            print "Erro" . $e -> getMessage();

        }

    }

}
?>