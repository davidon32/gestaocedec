<?php include_once $_SERVER['DOCUMENT_ROOT'] .'/core/include.php';

$pmda = new Pmda();

$opcao = isset($_POST['btnEnviar']) ? $_POST['btnEnviar'] : "";
$post = isset($_POST) ? $_POST : "";

if($opcao == "duplicar") {  
    $pmda->copiaPmda($post['id_pmda']);
}

?>
