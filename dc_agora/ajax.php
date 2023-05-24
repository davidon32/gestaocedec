<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/core/include.php');

$agora = new DefesaCivilAgoraModel();

$post = $_POST;

    if ($post['opcao'] == 'view') {
        
        $agora->viewPost($post['id']);
        //var_dump($post);
    
}