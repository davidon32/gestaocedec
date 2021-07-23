<?php

/**
 * Classe: Upload de Arquivos ate 2mb
 * Autor : Demetrio da Silva Passos
 * Data  : 04/06/2020
 * 
 * ex: print Upload2mb::upload("anexo/", "municipio teste", array("pdf", "jpg"));
 *
 */
/* <form action="#" method="POST" name="frm" enctype="multipart/form-data">
  <input type="file" name="fileToUpload1" id="fileToUpload1">
  <input type="submit" value="enviar" name="enviar">
  </form> */


class Upload2mb {

    public function __construct() {
        
    }

    protected static function removerAcentoEspaco($var) {

        $result = preg_replace('/[^a-zA-Z0-9]/', "_", $var);
        $result = strtoupper($result);

        return $result;
    }

    public static function get_extension($_file) {
        $ext = explode(".", $_file);
        $ext = end($ext);
        return $ext ? $ext : false;
    }

    /**
     * normalização nome do arquivo
     */
    public static function normalizacao($nome_arquivo) {

        $result = self::removerAcentoEspaco($nome_arquivo);
        $result = substr($result, 0, 15);

        return $result;
    }

    /**
     *
     * @param string $path    - caminho para arquivo
     * @param string $nome    - nome alternativo "será concatenado com data/hora envio"
     * @param array $extensao - restrição de tipos aceitos ex. array(pdf) 
     * @return void
     */
    public static function upload($path, $nome = null, array $extensao = null) {

        $result = array('result' => '',
            'nome_arquivo' => '',
            'msg' => '');

        if (!empty($_FILES)) {

            $arquivo = isset($_FILES) ? $_FILES : null;
            $input = key($arquivo); #nomeImput
            # extensao
            $ext = Upload2mb::get_extension($arquivo[$input]['name']);

            # tamanho arquivo
            $tamanho = $arquivo[$input]['size'];

            # verifica tamanho arquivo
            if ($tamanho <= "2097152") {

                #retricao tipo arquivo
                if (is_null($extensao)) {
                    $ext_permitido = "true";
                    # caso haja restriçao faz o filtro
                } else {
                    $ext_permitido = in_array($ext, $extensao, false);
                }

                if ($ext_permitido) {

                    $nome_arquivo = "";

                    # sem passar o nome do arquivo, nome do arquivo conterá "_Upload_file_dia mes ano segundo"
                    if (is_null($nome)) {

                        $nome_arquivo = self::normalizacao($_FILES[$input]['name']);

                        # remomeando, , nome do arquivo conterá "_Upload_file_dia mes ano segundo"
                    } else {
                        $nome_arquivo = self::normalizacao($nome);
                    }

                    $nome_arquivo = $nome_arquivo . "_Upload_file_" . date('dmys') . "." . $ext;

                    # sucesso no upload
                    if (move_uploaded_file($arquivo[$input]['tmp_name'], PATH . "/" . $path . "/" . $nome_arquivo)) {
                        $result = array('result' => true,
                            'nome_arquivo' => $nome_arquivo,
                            'msg' => "Upload de arquivo ralizado com sucesso");

                        # erro de sistema
                    } else {
                        $result = array('result' => false,
                            'nome_arquivo' => '',
                            'msg' => "Ocorreu um erro ao realizar esta operação, tente mais tarde !");
                    }

                    return $result;

                    # extensao não permitida    
                } else {
                    $result = array('result' => false,
                        'nome_arquivo' => '',
                        'msg' => "Extensões permitidas : " . strtoupper(implode(", ", $extensao)));
                }
                # exedido o tamanho
            } else {
                $result = array('result' => false,
                    'nome_arquivo' => "",
                    'msg' => "Tamanho arquivo Excedido ! \nO arquivo não pode ser maior que : 2MB ou 2000 Kb.");
            }

            # nao escolheu o arquivo  / ou muito grande  
        } else {
            $result = array('result' => false,
                'nome_arquivo' => '',
                'msg' => 'Arquivo muito Grande ou ! não foi Escolhido \nO arquivo não pode ser maior que : 2MB ou 2000 Kb.');
        }

        return $result;
    }

    /*
     *
     *  Visualizar documento
     *  @param - array path+nome_arquivo, id_arquivo
     * 
     */

    public static function visualizaFile(array $dados) {
        
        if (isset($dados['arquivo']) && file_exists($dados['arquivo'])) {
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
        header("Content-Disposition: attachment; filename=\"" . basename($dados['arquivo']) . "\"");
        header("Content-Transfer-Encoding: binary");
        header("Expires: 0");
        header("Pragma: public");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header('Content-Length: ' . filesize($dados['arquivo'])); //Remove
        ob_clean();
        flush();
        readfile($dados['arquivo']);
                     
        }else {
            print "erro";
        }
    }

    
            }?>