<?php

include_once PATH . "/core/Controller/Controller.php";
include_once PATH . "/core/Model/Model.php";

class msgController extends Controller {

    public function index() {

        include "template/page/login.php";
    }

    /**
     * gerenciamentos de mensagens
     */
    public static function mensagem(array $dados) {

        $con = Conexao::getInstance();
        
        $municipio_id = isset($dados['municipio_id']) ? $dados['municipio_id'] : "";
        $usuario      = isset($dados['id_user'])      ? $dados['id_user']      : "";
        $tipo         = isset($dados['tipo'])         ? $dados['tipo']         : "";
        
        
        # municipio
        if( !empty($municipio_id) && empty($usuario) && empty($tipo) ) {
        
            $filtro = " where municipio_id =".$municipio_id;
        
        # usuario
        }elseif ( empty($municipio_id) && !empty($usuario) && empty($tipo) ) {
            
            $filtro = " where id_user =".$usuario;
            
        # interno e externo
        }elseif ( empty($municipio_id) && empty($usuario) && !empty($tipo) ) {
            
            $filtro = " where tipo =".$tipo;
        }else {
            
        }
        
        
        

        $sql = "select *from cedec_mensagem ".$filtro;

        $result = $con->query($sql);

        return $result->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * gerenciamentos de notificações
     */
    public static function notificacao() {
        
    }

    /**
     * gerenciamentos de alertas
     */
    public static function alertas() {
        
    }

}
