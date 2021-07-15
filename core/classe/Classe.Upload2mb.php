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

    public function __construct(){
    }

    protected static function removerAcentoEspaco($var) {
        
        $result = preg_replace('/[^a-zA-Z0-9]/', "_", $var); 
        $result = strtoupper($result);     
        
        return $result;
    }

    public static function get_extension($_file) {
        $ext = explode(".", $_file);
        $ext= end($ext);
        return $ext ? $ext : false;
    }
    
/**
 *
 * @param string $path    - caminho para arquivo
 * @param string $nome    - nome alternativo "será concatenado com data/hora envio"
 * @param array $extensao - restrição de tipos aceitos ex. array(pdf) 
 * @return void
 */
    public static function upload($path, $nome=null, array $extensao = null){ 



        if(!empty($_FILES)){

            $arquivo = isset($_FILES) ? $_FILES : null;
            $input = key($arquivo); #nomeImput
            
            # extensao
            $ext = Upload2mb::get_extension($arquivo[$input]['name']);
            
            # tamanho arquivo
            $tamanho = $arquivo[$input]['size'];

            # verifica tamanho arquivo
            if($tamanho <= "2097152") {

                #retricao tipo arquivo
                if(is_null($extensao)) {

                    $ext_permitido = "true";
                
                # caso haja restriçao faz o filtro
                }else {
                
                    $ext_permitido = in_array($ext, $extensao, false);
                }
                
                if($ext_permitido){

                    $nome_arquivo = "";
                    
                    # sem passar o nome do arquivo, nome do arquivo conterá "_Upload_file_dia mes ano segundo"
                    if(is_null($nome)){
                        
                        $nome_arquivo = $_FILES[$input]['name'];
                        $nome_arquivo = self::removerAcentoEspaco($nome_arquivo);
                        $nome_arquivo = substr($nome_arquivo, 0, 15);
                    
                    # remomeando, , nome do arquivo conterá "_Upload_file_dia mes ano segundo"
                    }else {
                    
                        $nome_arquivo = $nome;
                        $nome_arquivo = self::removerAcentoEspaco($nome_arquivo);
                        $nome_arquivo = substr($nome_arquivo, 0, 15);
                    
                    }
                    
                    $result = move_uploaded_file($arquivo[$input]['tmp_name'], $path."/".$nome_arquivo."_Upload_file_".date('dmys').".".$ext);
                    
                    return $result;
                }else{
                    
                    return "Extensões permitidas são : ".strtoupper(implode(", ", $extensao));
                }
            # exedido o tamanho
            }else {

                return "Tamanho arquivo Excedido ! <br>O arquivo não pode ser maior que : 2MB ou 2000 Kb.";
            
            }

        # nao escolheu o arquivo    
        }else {

            return "Arquivo muito Grande ou ! <br>O arquivo não pode ser maior que : 2MB ou 2000 Kb.";

        }
    }

}

?>