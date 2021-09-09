<?php

/**
 *  Grava o log de atividades de usuario
 * @param $_acao String (instrução SQL, informativo personalisado rastreavel de usuario)
 * @Param $_modulo, String nome no referido módulo.
 * ex: Log::GravaLog("Cadastro do contrato No: 001", "pip_log");
 */
class Log {

    /**
     * Log de Acções
     * 
     * 
     * @param string $_acao
     * @param string $_modulo
     * @example ("usuario Fulano gravou os dados", mod_cedec)
     */
    public static function Log_reg($_acao) {

        $con = Conexao::getInstance();

        $_login = $_COOKIE['seguranca']['login'];

        $_data = date('Y/m/d H:i:s');

        $_ip = $_SERVER['REMOTE_ADDR'];

        $sql = "INSERT INTO cedec_log_senha (login, dt_user, texto, ip) VALUES ('" . $_login . "', '" . $_data . "', '" . $_acao . "', '" . $_ip . "')";

        try {

            return $result = $con->query($sql);
            
        } catch (Exception $e) {

            $e->getMessage() . 'Código : 10 erro ao gravar log' . $_acao;
        }
    }

    /**
     * Log de Acções
     * 
     * 
     * @param string $_acao
     * @param string $_modulo
     * @example ("usuario Fulano gravou os dados", mod_cedec)
     */
    static function GravaLog($_acao, $_modulo) {

        $con = Conexao::getInstance();

        $_login = $_COOKIE['seguranca']['login'];

        $_data = date('Y/m/d H:i:s');

        $_ip = $_SERVER['REMOTE_ADDR'];

        $sql = "INSERT INTO " . $_modulo . " (login, dt_user, acao, ip) VALUES ('" . $_login . "', '" . $_data . "', '" . $_acao . "', '" . $_ip . "')";
        //$sql = "";

        try {

            $result = $con->query($sql);
            //$result->execute();
        } catch (Exception $e) {

            $e->getMessage() . 'Código : 10 erro ao gravar log' . $_modulo;
        }
    }

    static function GravaLogUserEx($_acao, $_modulo, $id_pmda = false) {

        $con = Conexao::getInstance();

        try {

            $id_municipio = $_COOKIE['seguranca']['id_municipio'];

            $_data = date('Y/m/d H:i:s');

            $_ip = $_SERVER['REMOTE_ADDR'];

            $sql = "INSERT INTO " . $_modulo . " (login, dt_user, acao, ip, id_municipio, id_pmda) VALUES ('" . $_login . "','" . $_data . "','" . $_acao . "','" . $_ip . "','" . $id_municipio . "','" . $id_pmda . "')";

            $result = $con->query($sql);

            return true;
        } catch (Exception $e) {
            $e->getMessage() . 'Código : 10 erro ao gravar log' . $_modulo;
        }
    }

    static function buscaultimoAcesso($id_municipio) {

        $con = Conexao::getInstance();

        $dados = array();

        try {

            $sql = "select dt_user
    				from cedec_user_ex_log
    				where id_municipio = " . $id_municipio . "
					order by id_log	desc
    				limit 1";

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

                $dados = $linha;
            }

            return $dados;
        } catch (Exception $e) {
            $e->getMessage() . 'Código : 10 erro ao gravar log' . $_modulo;
        }
    }
    
    /**
     * 
     */
    public static function LogSdc($texto){
        
        $nome = date('d-m-Y').".log";
        
        $arquivo = fopen(PATH.'/log/'.$nome,'a');
        
        if ($arquivo == false) die('Não foi possível criar o arquivo.');
        
        $log = date('d/m/Y H:i:s'). " | ". $_COOKIE['seguranca']['nome_usuario']." | ".$texto;
        fwrite($arquivo, $log);
        fclose($arquivo);
        
    }
    
    
    /* gravar log txt */
    public static function LogTxt(){
        $file = 'log/'.date('d-m-Y h-i-s')."txt";
        $arquivo = fopen($file,'w');
        if ($arquivo == false)
            die('Não foi possível criar o arquivo.');
    }
    

}?>