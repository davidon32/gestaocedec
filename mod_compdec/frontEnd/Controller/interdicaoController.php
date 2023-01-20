<?php

class interdicaoController extends Controller {
################# vistoria ##################

    public function index() {
        include_once "mod_compdec/frontEnd/View/interdicao/index.php";
    }

################# vistoria ##################

    public function novo() {
        include_once "mod_compdec/frontEnd/View/interdicao/interdicao.php";
    }

    public function gravar() {

        $dados = $_POST;

        $con = Conexao::getInstance();

        $sql = "INSERT INTO com_interdicao (numero,
                                                municipio_id,
                                                dt_registro,
                                                endereco,
                                                notificado,
                                                rg_notificado,
                                                endereco_not,
                                                cel_not,
                                                vistoriador,
                                                vistoriador_mat,
                                                ids_vistoria,
                                                obs) VALUES (:numero,
                                                                :municipio_id,
                                                                :dt_registro,
                                                                :endereco,
                                                                :notificado,
                                                                :rg_notificado,
                                                                :endereco_not,
                                                                :cel_not,
                                                                :vistoriador,
                                                                :vistoriador_mat,
                                                                :ids_vistoria,
                                                                :obs)";

        try {
            $result = $con->prepare($sql);

            $result->bindValue(':ids_vistoria', $dados['id_vistoria']);
            $result->bindValue(':numero', $dados['numero']);
            $result->bindValue(':municipio_id', $dados['municipio_id']);
            $result->bindValue(':endereco', $dados['endereco']);
            $result->bindValue(':dt_registro', $dados['dt_registro']);
            $result->bindValue(':notificado', $dados['nome_not']);
            $result->bindValue(':rg_notificado', $dados['rg_not']);
            $result->bindValue(':endereco_not', $dados['endereco_not']);
            $result->bindValue(':cel_not', $dados['cel_not']);
            $result->bindValue(':vistoriador', $dados['vistoriador']);
            $result->bindValue(':vistoriador_mat', $dados['vistoriador_mat']);
            $result->bindValue(':obs', $dados['obs']);


            if ($result->execute()) {

                print "<script>alert('Registro gravado com Sucesso');";
                print "window.location.href = '" . FuncaoBase::geraLink('compdec', 'interdicao', 'index') . "';</script>";
            }
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    public static function listagem_geral($municipio_id, $filtro = false) {

        $con = Conexao::getInstance();

        if (!empty($filtro)) {
            $sql = "SELECT *FROM com_interdicao WHERE
                        municipio_id = '{$municipio_id}' and
                        notificado LIKE '%{$filtro}%' OR
                        endereco LIKE '%{$filtro}%' OR
                        numero LIKE '%{$filtro}%'";
        } else {
            $sql = "select *from com_interdicao WHERE
                        municipio_id = '{$municipio_id}'";
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

        $sql = "select count(id) as numero from com_interdicao where municipio_id = {$id_municipio} 
                    and YEAR(dt_registro) = {$ano} group by municipio_id";

        $result = $con->query($sql);

        $numero = $result->fetch(PDO::FETCH_OBJ);


        return (!$numero) ? 1 : ++$numero->numero;
    }

    public static function visualizar() {
        $id_interdicao = isset($_GET['id']) ? (int)$_GET['id'] : "";
        
        $id = (int)$id_interdicao;

        $con = Conexao::getInstance();

        try {
            
            if($id_interdicao){

            $sql = "select *from com_interdicao where id = " . $id;

            $result = $con->query($sql);

            $dados = $result->fetch(PDO::FETCH_OBJ);
            include_once "mod_compdec/frontEnd/View/interdicao/visualizar.php";
            }else {
                header('Location:index.php');
            }
        } catch (Exception $e) {
            
            print $e->getMessage();
            
        }
    }

    public static function listagem_geral_Autocomplete($id_municipio) {

        $con = Conexao::getInstance();

        $sql = "SELECT id, numero, prop, endereco, dt_vistoria, tel, dt_vistoria, resp_vistoriador
                            FROM com_vistoria WHERE
                            municipio_id =" . $id_municipio;



        $result = $con->query($sql);

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function listagem_vistorias($ids) {

        $id_array = explode("|", $ids);

        $id_in = implode("','", $id_array);

        $con = Conexao::getInstance();


        $sql = "SELECT *FROM com_vistoria WHERE
                        id in('" . $id_in . "')";

        $result = $con->query($sql);

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
    

}
