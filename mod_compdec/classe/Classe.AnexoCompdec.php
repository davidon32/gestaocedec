<?php

class AnexoCompdec extends Anexo {

    /**
     * Grava foto compdec
     * @param unknown $array
     */
    public static function gravar($dados, $arquivo, $caminho, $campo) {

        try {

            /* 1.7mb = 1762762 */
            if (
                    ($arquivo[$campo]['error'] == '0') &&
                    $arquivo[$campo]['size'] > '10' &&
                    ($arquivo[$campo]['size'] <= '2000000' )
            ) {

                $sql = "update com_comdec
						set fotoCompdec = :fotoCompdec
						where id_municipio = :id_municipio";


                $con = Conexao::getInstance();

                $result = $con->prepare($sql);

                $nomeArquivo = str_replace(" ", "_", $arquivo[$campo]['name']);

                $nomeFoto = $dados['txtIdMunicipio'] . "_" . $nomeArquivo;

                $result->bindParam(":id_municipio", $dados['txtIdMunicipio']);
                $result->bindParam(":fotoCompdec", $nomeFoto);
                $result->execute();

                
                if (Anexo::upload($caminho, $arquivo, $campo, $dados['txtIdMunicipio'])) {

                    return true;
                }
            } else {

                print "<script>";
                print "alert('Tamanho do arquivo máximo permitido 2Mb !');";
                print "</script>";
            }
        } catch (PDOException $e) {

            print $e . "Erro ao Inserir Registro";
            return false;
        }
    }

    /**
     * Grava Anexo Leis e Decretos Compdec
     * @param $dados para gravar no banco a informacao do arquio
     * @param $arquivo - $_FILES
     */
    public static function gravarLeisCompdec($dados, $arquivo) {

        try {

            /* 1.7mb = 1762762 */
            if (
                    ($arquivo['fileAnexoLeis']['error'] == '0') &&
                    //(strlen($arquivo['fileAnexoLeis']['name']) <="60") &&
                    ($arquivo['fileAnexoLeis']['size'] > '0') &&
                    ($arquivo['fileAnexoLeis']['size'] <= '2000000' )
            ) {

                $sql = "insert into com_anexo (id_municipio,
												arquivo,
												dt_anexo,
												descricao,
												tipo)
													values (:id_municipio,
															:arquivo,
															:dt_anexo,
															:descricao,
															:tipo)";

                $con = Conexao::getInstance();
                $result = $con->prepare($sql);

                # remove espacos e adiciona underline
                $nomeArquivo = str_replace(" ", "_", $arquivo['fileAnexoLeis']['name']);
                $nomeArquivo = FuncaoBase::tirarAcentos($nomeArquivo);
                $nomeArquivo = strtoupper(substr($nomeArquivo, 0, 10));
                #identificador unico
                $hash = date('his');
                $nomeFoto = $dados['txtIdMunicipio'] . "_" . $hash . "_" . $nomeArquivo;

                $result->bindParam(":id_municipio", $dados['txtIdMunicipio']);
                $result->bindParam(":arquivo", $nomeFoto);
                $result->bindParam(":dt_anexo", $dados['txtDtAnexo']);
                $result->bindParam(":descricao", $dados['txtDescricao']);
                $result->bindParam(":tipo", $dados['selTipo']);
                $result->execute();

                if (Anexo::uploadRen($_SERVER['DOCUMENT_ROOT'] . "/anexo/anexo_leis", $arquivo, "fileAnexoLeis", $nomeFoto)) {

                    return true;
                }
            } else {
                return false;
            }
        } catch (PDOException $e) {

            print $e . "Erro ao Inserir Registro";
            return false;
        }
    }

    /**
     * 
     * 
     * 
     */
    public function deletar($id) {

        try {

            $con = Conexao::getInstance();

            $sql = "delete from com_anexo where id = :id_anexo";

            $result = $con->prepare($sql);
            $result->bindParam(":id_anexo", $id);
            $result->execute();

            return true;
        } catch (Exception $e) {

            $e . " Erro ao deletar arquivo";
        }
    }

    /* busca imagem compdec */

    public static function foto($id_municipio) {

        $foto = "";

        try {

            $con = Conexao::getInstance();

            $sql = "select fotoCompdec from com_comdec where id_municipio = :id_municipio";

            $result = $con->prepare($sql);
            $result->bindParam(":id_municipio", $id_municipio);
            $result->execute();

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

                $foto = $linha['fotoCompdec'];
                if ($linha['fotoCompdec'] == "") {

                    $foto = "padrao.png";
                }
            }

            return $foto;
        } catch (Exception $e) {

            print $e . "-";
        }
    }
    
    /* busca imagem compdec */

    public static function foto3x4($id_municipio) {

        $foto = "padrao.png";
        try {
            
            


            return $foto;
        } catch (Exception $e) {

            print $e . "-";
        }
    }

    /* busca arquivo foto */

    public static function deletarFoto($id_municipio, $caminho) {

        chdir(PATH . '/' . $caminho);
        $dirAnexo = getcwd();

        /* lista de arquivos do diretorio */
        $arquivos = scandir($dirAnexo);
        $foto = '';
        foreach ($arquivos as $value) {

            if (substr($value, 0, strpos($value, "_")) == $id_municipio) {
                $foto = $value;
            }
        }

        /* remove foto */
        //unlink($dirAnexo.'/'.$caminho.'/'.$foto);
        if ($foto != "") {
            /* remover arquivo */
            chdir(PATH . '/' . $caminho);
            $dirAnexo = getcwd();
            unlink($dirAnexo . '/' . $foto);
        }
    }

    /* listagem anexo leis e decretos */

    static function listaAnexo($id_municipio = null) {

        $dados = array();
        $con = Conexao::getInstance();

        $sql = "SELECT id, id_municipio, arquivo, dt_anexo, 
						descricao, tipo, validade
						FROM com_anexo
						WHERE id_municipio = :id_municipio";

        $result = $con->prepare($sql);
        $result->bindParam(":id_municipio", $id_municipio);
        $result->execute();


        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados[] = $linha;
        }

        return $dados;
    }

    /**
     *
     *
     *
     */
    public function previewAnexo($id) {

        $dados = array();

        $con = Conexao::getInstance();

        $sql = "SELECT id, id_municipio, arquivo FROM com_anexo WHERE id= :id";

        $result = $con->prepare($sql);
        $result->bindParam(":id", $id);
        $result->execute();

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

            $dados = $linha;
        }

        $existe = file_exists('anexo/anexo_leis/' . $dados['arquivo']);
        $dados['existe'] = $existe;
        return $dados;
    }

    /**
     * Tipo documento Anexo
     * @param integer
     * @return 
     * 0 - Decreto
     * 1 - Lei Criação
     * 2 - Portaria Nomeação
     * 
     */
    public function enumTipo($tipo) {

        switch ($tipo) {
            case "0":
                return "Decreto Regulamentação Lei de Criação COMPDEC";
                break;
            case "1":
                return "Lei Criação da COMPDEC";
                break;
            case "2":
                return "Portaria de Nomeação do Coordenador Defesa Civil";
                break;
            default:
                return "Opção Inválida!";
                break;
        }
    }

    public static function validaAnexo($id_anexo, $id_municipio) {
        try {

            $con = Conexao::getInstance();
            $data_validade = date("Y/m/d", strtotime("1 Year"));
            $sql = "update com_anexo
                    set validade = :validade
                    where id_municipio = :id_municipio
                    and id = :id_anexo
                    or validade is not null";

            $result = $con->prepare($sql);

            $result->bindParam(":id_anexo", $id_anexo);
            $result->bindParam(":id_municipio", $id_municipio);
            $result->bindParam(":validade", $data_validade);
            $result->execute();

            return true;
        } catch (Exception $e) {

            print $e . " ";
        }
    }
    
    /* validar documentação homologar */
    public static function homologar_document($id_municipio, $valor) {
        try {

            $con = Conexao::getInstance();
            
            $sql = "update com_comdec
                    set doc_aprov = :valor
                    where id_municipio = :id_municipio";

            $result = $con->prepare($sql);

            $result->bindParam(":id_municipio", $id_municipio);
            $result->bindParam(":valor", $valor);
            $result->execute();

            return true;
        } catch (Exception $e) {

            print $e . " ";
        }
    }

}

?>