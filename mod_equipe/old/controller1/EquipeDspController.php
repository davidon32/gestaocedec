<?php

require_once RAIZ . "model/Conexao.PDO.php";
require_once RAIZ . "model/dspModel.php";
require_once RAIZ . "model/GeraLog.php";

class DspDao {

    public static $instance;
    
    private function __construct() {

    }

    public static function getInstance() {

        if (!isset(self::$instance))

            self::$instance = new DspDao();

        return self::$instance;
    }

    public function Inserir(dspModel $dsp) {

        try {

            $sql = "INSERT INTO usuario ( nome, email, senha, ativo, cod_perfil) VALUES ( :nome, :email, :senha, :ativo, :cod_perfil)";

            $p_sql = Conexao::getInstance() -> prepare($sql);

            $p_sql -> bindValue(":nome", $usuario -> getNome());
            $p_sql -> bindValue(":email", $usuario -> getEmail());
            $p_sql -> bindValue(":senha", $usuario -> getSenha());
            $p_sql -> bindValue(":ativo", $usuario -> getAtivo());
            $p_sql -> bindValue(":cod_perfil", $usuario -> getPerfil() -> getCod_perfil());

            return $p_sql -> execute();
        
        } catch (Exception $e) {

            print "Ocorreu um erro ao tentar executar esta ação, foi gerado um LOG do mesmo, tente novamente mais tarde.";

            GeraLog::getInstance() -> inserirLog("Erro: Código: " . $e -> getCode() . " Mensagem: " . $e -> getMessage());
        }
    }

}
?>