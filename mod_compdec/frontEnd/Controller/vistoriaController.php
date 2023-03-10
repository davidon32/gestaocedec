<?php

class vistoriaController extends Controller {
    ################# vistoria ##################

    public function index() {
        include_once "mod_compdec/frontEnd/View/vistoria/index.php";
    }

    ################# vistoria ##################

    public function novo() {
        include_once "mod_compdec/frontEnd/View/vistoria/vistoria.php";
    }

    public function gravar() {

        $dados = $_POST;

        $con = Conexao::getInstance();

        $sql = "INSERT INTO com_vistoria (prop,
                                                            dt_vistoria,
                                                            endereco,
                                                            municipio_id, 
                                                            tel,
                                                            tp_ocorrencia,
                                                            tp_imovel, 
                                                            tr_pilar, 
                                                            tr_viga,
                                                            tr_laje,
                                                            parede, 
                                                            piso,
                                                            muro, 
                                                            r_col_estrutural,
                                                            r_col_construtivo, 
                                                            r_externo, 
                                                            r_vazamento,
                                                            ae_muro, 
                                                            ae_rede_hidraulica, 
                                                            ae_deslizamento,
                                                            ae_inundacao, 
                                                            ae_outros, 
                                                            ae_outros_txt,
                                                            caracterizacao, 
                                                            parecer, 
                                                            rec_prov_imediata,
                                                            rec_medidas_recuperacao,
                                                            considera_finais,
                                                            resp_vistoriador,
                                                            numero) VALUES (:prop, 
                                                                                        :dt_vistoria, 
                                                                                        :endereco, 
                                                                                        :municipio_id,
                                                                                        :tel, 
                                                                                        :tp_ocorrencia, 
                                                                                        :tp_imovel, 
                                                                                        :tr_pilar,
                                                                                        :tr_viga, 
                                                                                        :tr_laje, 
                                                                                        :parede, 
                                                                                        :piso, 
                                                                                        :muro,
                                                                                        :r_col_estrutural, 
                                                                                        :r_col_construtivo, 
                                                                                        :r_externo,
                                                                                        :r_vazamento, 
                                                                                        :ae_muro, 
                                                                                        :ae_rede_hidraulica, 
                                                                                        :ae_deslizamento,
                                                                                        :ae_inundacao, 
                                                                                        :ae_outros, 
                                                                                        :ae_outros_txt, 
                                                                                        :caracterizacao,
                                                                                        :parecer, 
                                                                                        :rec_prov_imediata, 
                                                                                        :rec_medidas_recuperacao,
                                                                                        :considera_finais, 
                                                                                        :resp_vistoriador,
                                                                                        :numero)";

        try {
            $result = $con->prepare($sql);

            $result->bindValue(':prop', $dados['prop']);
            $result->bindValue(':endereco', $dados['endereco']);
            $result->bindValue(':tel', $dados['cel']);
            $result->bindValue(':dt_vistoria', $dados['dt_vistoria']);
            $result->bindValue(':tp_ocorrencia', $dados['tp_ocorrencia']);
            $result->bindValue(':tp_imovel', $dados['tp_imovel']);
            $result->bindValue(':tr_pilar', $dados['tr_pilar']);
            $result->bindValue(':tr_viga', $dados['tr_viga']);
            $result->bindValue(':tr_laje', $dados['tr_laje']);
            $result->bindValue(':parede', $dados['parede']);
            $result->bindValue(':piso', $dados['piso']);
            $result->bindValue(':muro', $dados['muro']);
            $result->bindValue(':r_col_estrutural', $dados['r_col_estrutural']);
            $result->bindValue(':r_col_construtivo', $dados['r_col_construtivo']);
            $result->bindValue(':r_externo', $dados['r_externo']);
            $result->bindValue(':r_vazamento', $dados['r_vazamento']);
            $result->bindValue(':ae_muro', $dados['ae_muro']);
            $result->bindValue(':ae_rede_hidraulica', $dados['ae_rede_hidraulica']);
            $result->bindValue(':ae_deslizamento', $dados['ae_deslizamento']);
            $result->bindValue(':ae_inundacao', $dados['ae_inundacao']);
            $result->bindValue(':ae_outros', $dados['ae_outros']);
            $result->bindValue(':ae_outros_txt', $dados['ae_outros_txt']);
            $result->bindValue(':caracterizacao', $dados['caracterizacao']);
            $result->bindValue(':parecer', $dados['parecer']);
            $result->bindValue(':rec_prov_imediata', $dados['rec_prov_imediata']);
            $result->bindValue(':rec_medidas_recuperacao', $dados['rec_medidas_recuperacao']);
            $result->bindValue(':considera_finais', $dados['considera_finais']);
            $result->bindValue(':resp_vistoriador', $dados['resp_vistoriador']);
            $result->bindValue(':municipio_id', $dados['municipio_id']);
            $result->bindValue(':numero', $dados['numero']);


            if ($result->execute()) {

                print "<script>alert('Registro gravado com Sucesso');";
                print "window.location.href = '" . FuncaoBase::geraLink('compdec', 'vistoria', 'novo') . "';</script>";
            }
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    public static function listagem_geral($filtro = false) {
        
        $con = Conexao::getInstance();

        if (!empty($filtro)) {
            if (is_array($filtro)) {
                $sql = "SELECT *FROM com_vistoria WHERE
                        municipio_id = '{$filtro['id_municipio']}' order by id desc";
                
            } else {
               
            $sql = "SELECT *FROM com_vistoria WHERE
                        prop LIKE '%{$filtro}%' OR
                        endereco LIKE '%{$filtro}%' OR
                        numero LIKE '%{$filtro}%' order by id desc";
            }
        } 

        $result = $con->query($sql);

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * busca laudo
     */
    public function busca() {
        
    }

    public static function geraNumero($id_municipio, $ano) {
        $con = Conexao::getInstance();

        $sql = "select count(id) as numero from com_vistoria where municipio_id = {$id_municipio} 
                    and YEAR(dt_vistoria) = {$ano} group by municipio_id";

        $result = $con->query($sql);

        $numero = $result->fetch(PDO::FETCH_OBJ);


        return (!$numero) ? 1 : ++$numero->numero;
    }

    public static function visualizar() {
        $id_vistoria = isset($_GET['id']) ? $_GET['id'] : "";
        $con = Conexao::getInstance();

        $sql = "select *from com_vistoria where id = " . $id_vistoria;

        $result = $con->query($sql);

        $dados = $result->fetch(PDO::FETCH_OBJ);
        include_once "mod_compdec/frontEnd/View/vistoria/visualizar.php";
    }

}
