<?php include_once('core/Controller/Controller.php');
    class AppController extends Controller
    {
        
        
        /*
     *
     *  Visualizar documento
     *  @param - array path+nome_arquivo, id_arquivo
     * 
     */

    public static function visualiza() {
        
        $dados = $_GET;
        
        # arquivo pedido ajuda humanitaria
        if(isset($dados['fl']) and ($dados['fl'] == 'pedido_h')){
            $path = "/anexo/pedido_ajuda_h";
        
        # defesa civil agora    
        }elseif(isset($dados['fl']) and ($dados['fl'] == 'def_agora')){
            $path = "/anexo/def_civil_agora";
        
        #plano de contingencia
        }elseif(isset($dados['fl']) and ($dados['fl'] == 'placon')){
            $path = "/anexo/planoCont";
        
        # pmda
        }elseif(isset($dados['fl']) and ($dados['fl'] == 'pmda')){
            $path = "/anexo/pmda";
        }
        
        
        if (isset($dados['file']) && file_exists(PATH.$path."/".$dados['file'])) {
            // faz o teste se a variavel não esta vazia e se o arquivo realmente existe
            switch (strtolower(substr(strrchr(basename($dados['file']), "."), 1))) {
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
        header("Content-Disposition: attachment; filename=\"" . basename($dados['file']) . "\"");
        header("Content-Transfer-Encoding: binary");
        header("Expires: 0");
        header("Pragma: public");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header('Content-Length: ' . filesize(PATH.$path."/".$dados['file'])); //Remove
        readfile(PATH.$path."/".$dados['file']);
     
        }
        
    }

        /**
         * Envio de email para suporte
         * 
         */

        /* public static function msgSuporte(array $msg){

            $enviaEmail = new Email();
            # envia o email para o usuario
            $resultado = $enviaEmail->emailIndividual('demetrio.passos@defesacivil.mg.gov.br', 
                                        utf8_decode("[Suporte SDC]"),
                                        $_COOKIE['seguranca'][]." Sua nova senha é :\n<b>".$_resultado[1]."</b> \nesta senha é temporária será preciso alterá-la.", "defesacivil@defesacivil.mg.gov.br");
               return true; 

        } */

        
    }
    


?>