<?php

class UsuarioModel {
	
	

    private $login;
    private $dadosLog;
    
    #function __construct(){

    #}

    function setLogin($login) {
        $this -> login = $login;
    }

    function getLogin() {
        return $this -> login;
    }

    function setDadosLog($dadosLog) {
        $this -> dadosLog = $dadosLog;
    }

    function getDadosLog() {
        return $this -> dadosLog;
    }

}
?>