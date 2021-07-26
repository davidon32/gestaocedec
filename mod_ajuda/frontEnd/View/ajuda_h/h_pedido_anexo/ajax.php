<?php 
$id_municipio = isset($_POST['id_municipio']) ? $_POST['id_municipio'] :"";

$opcao = isset($_POST['opcao']) ? $_POST['opcao'] :"";

//$h_pedido_pedid = new H_pedido_pedidajuda_hModel();

if($opcao == 'visualizafile') {
    
        
    
    $dados = $_POST;
     
    
        if (isset($dados['arquivo']) && file_exists($dados['path']."/".$dados['arquivo'])) {
            // faz o teste se a variavel não esta vazia e se o arquivo realmente existe
            switch (strtolower(substr(strrchr(basename($dados['arquivo']), "."), 1))) {
                // verifica a extensão do arquivo para pegar o tipo
                case "pdf": $tipo = "application/pdf";
                    break;
                case "exe": $tipo = "application/octet-stream";
                    break;
                case "zip": $tipo = "application/zip";
                    break;
                case "doc": $tipo = "application/msword";
                    break;
                case "xls": $tipo = "application/vnd.ms-excel";
                    break;
                case "ppt": $tipo = "application/vnd.ms-powerpoint";
                    break;
                case "gif": $tipo = "image/gif";
                    break;
                case "png": $tipo = "image/png";
                    break;
                case "jpg": $tipo = "image/jpg";
                    break;
                case "mp3": $tipo = "audio/mpeg";
                    break;
                case "php": // deixar vazio por seurança
                case "htm": // deixar vazio por seurança
                case "html": // deixar vazio por seurança
            }
            
          
        header('Content-Description: File Transfer');
        header("Content-Type: ".$tipo."");
        header("Content-Disposition: attachment; filename=\"" . basename($dados['path']."/".$dados['arquivo']) . "\"");
        header("Content-Transfer-Encoding: binary");
        header("Expires: 0");
        header("Pragma: public");
        header("Cache-Control: must-revalidate, post-check=1, pre-check=0");
        header('Content-Length: ' . filesize($dados['path']."/".$dados['arquivo'])); //Remove
        ob_flush(); 
        flush(); 
        readfile($dados['path']."/".$dados['arquivo']);
    
        }else {
            print "erro";
        }
}


