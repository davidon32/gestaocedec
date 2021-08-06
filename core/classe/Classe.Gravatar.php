<?php
/**
 *
 */
class Gravatar {

    /**
     * Gera hash para Gravatar Uso: print Gravatar::GeraGravatar();
     * @param String $email
     * @return md5(email);
     */
    static function GeraGravatar($email = false) {
            
        if(($email == "naotememail@nada.com.br") || (!$email)){
            
            return "<img class=\"img-circle\" src=\"".SISTEMA."/imagem/avatar/nopic.png\" width=\"90\" height=\"90\">";
            //die();
               
        }else {

            $email = md5(strtolower(trim($email)));
        
            return "<img class=\"img-circle\" src=\"http://www.gravatar.com/avatar/" . $email . "?s=90\" />";
        
        }
    }
}
//print Gravatar::GeraGravatar();
?>