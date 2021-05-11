<?php

    $secao = (isset($_GET['secao']) ? $_GET['secao'] : "index");

    $acao = (isset($_GET['acao']) ? $_GET['acao'] : "index");
    
    $p = isset($_GET['param']) ? $_GET['param'] : "";
    
    $param = explode("&", "$p");
    
    $controller = isset($secao) ? $secao : "index";
    
    $action = isset($acao) ? $acao : "index";
      
    require_once (__DIR__.'/controller'.'/'.$controller."Controller.php");
    
    $app = new $controller();

    $app->$action();
?>