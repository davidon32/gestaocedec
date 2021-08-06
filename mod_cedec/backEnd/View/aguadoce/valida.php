<?php include_once($_SERVER['DOCUMENT_ROOT'].'/core/include.php');

$post = isset($_POST) ? $_POST : "";
$files = isset($_FILES) ? $_FILES : "";


$anexoImagem = new Anexo();

$aguaDoce = new AguaDoce();

if($post['opcao'] == 'cadastro'){

    $nomeImagem = date('dmYHis').'def_agora';
    $post['txtImagem'] = $nomeImagem.".".Anexo::getExtensao($_FILES['txtImagem']['name']);
    $anexoImagem->uploadSimple('txtImagem', "anexo/aguadoce", $nomeImagem );
    $aguaDoce->cadastro($post);

}elseif($post['opcao'] == 'editar') {

    $nomeImagem = date('dmYHis').'def_agora';
    
    if(isset($_FILES['txtImagem']['name'])){
        $post['nomeImagem'] = $nomeImagem.".".Anexo::getExtensao($_FILES['txtImagem']['name']);
        $anexoImagem->uploadSimple('txtImagem', "anexo/aguadoce", $nomeImagem );
    }
  
    print $aguaDoce->editar($post);
    print "sucesso";

}elseif($post['opcao'] == 'valida'){
    $aguaDoce->validar($post);
    
}elseif($post['opcao'] == 'deletarImagem'){
    $aguaDoce->deletarImagem($post);
    
}elseif($post['opcao'] == 'deletar'){
    $aguaDoce->deletar($post);
    $aguaDoce->deletarImagem($post);
    var_dump($post);
}



?>