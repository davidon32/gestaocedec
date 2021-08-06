<?php include_once $_SERVER['DOCUMENT_ROOT']."/core/include.php";

$post = isset($_POST) ? $_POST : "";

$tipo = isset($_COOKIE['seguranca']['tipo']) ? $_COOKIE['seguranca']['tipo'] : "";

if($post['logout'] == "logout"){

    if($tipo == "i"){
        Login::UnsetCookieAdm();
    }else if($tipo == "e"){
        LoginExterno::UnsetCookieExterno();
    }
    
    return 'sucesso';
}

?>