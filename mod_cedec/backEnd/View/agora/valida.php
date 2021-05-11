<?php include_once($_SERVER['DOCUMENT_ROOT'].'/core/include.php');

$post = isset($_POST) ? $_POST : "";
$files = isset($_FILES) ? $_FILES : "";

$anexoImagem = new Anexo();

$defesaAgora = new DefesaAgora();

if($post['opcao'] == 'cadastro'){
    
    $nomeImagem = date('dmYHis').'def_agora';
    
    $post['txtImagem'] = $nomeImagem.".png";
    
    $img = $_POST['imageData'];
    
    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    
    $data = base64_decode($img);
    
    $file = $_SERVER['DOCUMENT_ROOT']."/anexo/def_civil_agora/".$nomeImagem.".png";
    
    $success = file_put_contents($file, $data);

        if($success) {

            if($defesaAgora->cadastro($post)){
                print 'sucesso';
            }
        }
   

}elseif($post['opcao'] == 'editar') {

    $nomeImagem = date('dmYHis').'def_agora';
    
    if(isset($_FILES['txtImagem']['name'])){
        $post['nomeImagem'] = $nomeImagem.".".Anexo::getExtensao($_FILES['txtImagem']['name']);
        $anexoImagem->uploadSimple('txtImagem', "anexo/def_civil_agora", $nomeImagem );
    }
  
    print $defesaAgora->editar($post);
    print "sucesso";

}elseif($post['opcao'] == 'valida'){
    $defesaAgora->validar($post);
    
}elseif($post['opcao'] == 'deletarImagem'){
    $defesaAgora->deletarImagem($post);
    
}elseif($post['opcao'] == 'deletar'){
    
    $defesaAgora->deletar($post);
    $defesaAgora->deletarImagem($post);

}elseif($post['opcao'] == 'comentario'){
    
    $defesaAgora->comentario($post);

}



?>