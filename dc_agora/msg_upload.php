<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/core/include.php');

$agora = new DefesaCivilAgoraModel();

$_POST['opcao'] = $opcao;

var_dump($_POST);
var_dump($_FILES);
die();

# upload arquivos
if($opcao == 'upload') {

$destino = "/anexo/def_civil_agora";
$id = rand(999999, 999999999) . date("iss");

if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
    $file_name = $_FILES['file']['name'];
    $file_type = $_FILES['file']['type'];
    $file_size = $_FILES['file']['size'];
    $file_tmp_name = $_FILES['file']['tmp_name'];


    if ($file_size >= "1887436") {
        #gravar nome arquivo
        var_dump($agora->gravarPost($_POST));
        move_uploaded_file($file_tmp_name, $destino . "_" . $id . "_" . $file_name);
    }else {
        print "arquivo";
    }
}

# cadastro
}else if($opcao == 'cadastro'){
    
    print "ok";

}



