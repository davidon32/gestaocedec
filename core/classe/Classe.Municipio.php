<?php
/* * *********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 																					*
 * 	Classe para manipulacao de municipios											*
 * 																					*
 * 	Autor: Demetrio da Silva Passos													*
 * 																					*
 * 	Criacao : 01/02/2012															*
 * ********************************************************************************** */

class Municipio extends DataMysql {

    /**
     *  faz um select na base e monta um "select" html com a tabela cedec_municipio
     *  @param id_municipio (opcional), para retornar um valor ja existente no banco
     *  para alteracao de dados 
     *  
     */
    static function PegaMunicipio($_id_municipio = false, $_arrayEstado = false, $attr = false) {

        $con = Conexao::getInstance();

        $sql = ('SELECT id_municipio, nome FROM cedec_municipio');

        $result = $con->query($sql);
        $result->execute();


        print "<select name=\"id_municipio\" id=\"id_municipio\" class=\"form-control\" " . $attr . ">";

        if ($_id_municipio == false) {

            print "<option value=\"\">Todos</option>";
        } else {


            $sql1 = "SELECT id_municipio,
								 nome
								 FROM cedec_municipio
								 WHERE id_municipio = :id_municipio";

            $result1 = $con->prepare($sql1);

            $result1->bindValue(':id_municipio', $_id_municipio, PDO::PARAM_STR);

            $result1->execute();

            while ($linha1 = $result1->fetch(PDO::FETCH_ASSOC)) {

                $_option = "<option value=" . $linha1['id_municipio'] . ">" . $linha1['nome'] . "</option>";
            }

            print $_option;
        }


        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

            echo "<option name=\"id\" value=" . $row['id_municipio'] . ">" . $row['nome'] . "</option>";
        }

        if ($_arrayEstado != false) {

            foreach ($_arrayEstado as $key => $value) {

                echo "<option>" . $value . "</option>";
            }
        }

        echo "</select>";
    }

    /**
     * Retorna o nome do municipio baseado no id
     * @param id_municipio
     * return (getNome)
     * 
     * */
    static function PegaNomeMunicipio($id) {

        $dados = array();

        $con = Conexao::getInstance();

        $sql = "SELECT nome
					FROM cedec_municipio
					WHERE id_municipio = :id";

        $result = $con->prepare($sql);
        $result->bindParam(':id', $id);
        $result->execute();

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

            $dados = $linha;
        }

        return $dados['nome'];
    }

    function PegaIdMunicipio($nomeMun) { # retorna o id do Municipio
        $con = Conexao::getInstance();

        $dados = array();

        $sql = "SELECT nome, id_municipio FROM cedec_municipio WHERE nome like :nome_municipio";

        $result = $con->prepare($sql);
        $result->bindValue(":nome_municipio", '%' . $nomeMun . '%', PDO::PARAM_STR);
        $result->execute();


        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados[] = $linha;
        }

        return $dados;
    }

    /**
     * 
     * Busca nome do município com input box
     * @param Nome ou parte do nome do Município
     * @return nomes semelhante a busca 
     * 
     */
    function BuscaMunicipio($_nome) {

        try {
            $con = Conexao::getInstance();

            $_dados = array();

            $sql = "SELECT nome, id_municipio 
	            			FROM cedec_municipio
	            				WHERE nome LIKE :nome
	            					LIMIT 15";

            $result = $con->prepare($sql);
            $result->bindValue(":nome", '%' . $_nome . '%');
            $result->execute();

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

                $_dados[] = $linha;
            }

            return $_dados;
        } catch (Exception $e) {
            //print $e;
        }
    }

    # dados para select nome de municipios
    function dadosSelectMunicipio($rpm = "") {
        
        if(!empty($rpm) && ($rpm != 1)) {
            $sql = "select cedec_municipio.id_municipio, 
                    cedec_municipio.nome
                    from cedec_municipio
                    inner join cedec_rpm_mun
                    on cedec_municipio.id_municipio = cedec_rpm_mun.id_municipio
                    where cedec_rpm_mun.id_rpm = ".$rpm;
        }else {
            $sql = "SELECT id_municipio, nome  FROM cedec_municipio ORDER BY nome";
        }

        $con = Conexao::getInstance();
        
        $_dados = array();


        $result = $con->query($sql);
        $result->execute();

        while ($linha = $result->fetch(PDO::FETCH_BOTH)) {

            $_dados[] = $linha;
        }

        return $_dados;
    }

    public static function dadosMunicipio($id) {

        $dados = array();

        $con = Conexao::getInstance();

        $sql = "SELECT cedec_municipio.id_municipio,
   cedec_municipio.nome as nome,
   cedec_municipio.macroregiao,
   cedec_municipio.latitude,
   cedec_municipio.longitude,
   cedec_municipio.latitude_dec,
   cedec_municipio.longitude_dec,
   cedec_municipio.distancia_bh,
   cedec_municipio.populacao,
   cedec_municipio.territorio_desenv,
   cedec_municipio.tel,
   cedec_municipio.fax,
   cedec_municipio.endereco,
   cedec_municipio.bairro,
   cedec_municipio.cep,
   cedec_municipio.email,
   cedec_municipio.tel_pref,
   cedec_municipio.cel_pref,
   cedec_municipio.pop_rural,
   cedec_municipio.qtd_pipa,
   cedec_municipio.prefeito,
   cedec_municipio.area,
   cedec_municipio.aliquota_iss,
   cedec_municipio.resp_cob_iss,
   cedec_municipio.num_lei_iss,
   cedec_municipio.cobra_iss,
   cedec_municipio.CodUf,
   cedec_municipio.Codmundv,
   cedec_municipio.Codmun,
   cedec_municipio.id_meso,
   cedec_municipio.id_micro,
   cedec_meso.nome as mesorregiao,
   cedec_micro.nome as microrregiao
    FROM gestaocedec.cedec_municipio
    inner join cedec_meso
    on cedec_municipio.id_meso = cedec_meso.id_meso
    inner join cedec_micro
    on cedec_municipio.id_micro = cedec_micro.id_micro
    where cedec_municipio.id_municipio = :id_municipio";

        $result = $con->prepare($sql);

        $result->bindParam(':id_municipio', $id);
        $result->execute();

        try{
            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

                $dados = $linha;
            }
            return $dados;
        } catch (Exception $e){
            print "error".$e;
        }

    }

    /**
     * 
     * Alterar Municipio dados completos
     * 
     */
    public function alterar($dados) {


        try {

            $con = Conexao::getInstance();

            $sql = "UPDATE cedec_municipio
	           				SET prefeito    = :prefeito,
	           					endereco    = :endereco,
	           					bairro      = :bairro,
	           					cep         = :cep,
	           					latitude    = :latitude,
	           					longitude   = :longitude,
	           					distancia_bh= :distancia, 
	           					email       = :email,
	           					tel_pref    = :tel_pref,
	           					cel_pref    = :cel_pref,
	           					tel         = :tel,
	           					fax         = :fax,
	           					macroregiao = :macroregiao,
	           					populacao   = :populacao,
	           					territorio_desenv = :terr_desenv, 
	           					pop_rural   = :pop_rural,
	           					area        = :area
	           						WHERE id_municipio = :id_municipio";

            $result = $con->prepare($sql);
            $result->bindParam(':id_municipio', $dados['id_municipio']);
            $result->bindParam(':prefeito', $dados['txtPrefeito']);
            $result->bindParam(':endereco', $dados['txtEndereco']);
            $result->bindParam(':bairro', $dados['txtBairro']);
            $result->bindParam(':cep', $dados['txtCep']);
            $result->bindParam(':latitude', $dados['txtLatitude']);
            $result->bindParam(':longitude', $dados['txtLongitude']);
            $result->bindParam(':distancia', $dados['txtDistanciaBh']);
            $result->bindParam(':email', $dados['txtEmail']);
            $result->bindParam(':tel_pref', $dados['txtTel_pref']);
            $result->bindParam(':cel_pref', $dados['txtCel_pref']);
            $result->bindParam(':tel', $dados['txtTel']);
            $result->bindParam(':fax', $dados['txtFax']);
            $result->bindParam(':macroregiao', $dados['selMacroregiao']);
            $result->bindParam(':populacao', $dados['txtPopulacao']);
            $result->bindParam(':terr_desenv', $dados['selTerritorio']);
            $result->bindParam(':pop_rural', $dados['txtPop_rural']);
            $result->bindParam(':area', $dados['txtArea']);
            $result->execute();

            return true;
        } catch (Exception $e) {

            echo $e->getMessage();
        }
    }

    /**
     *
     * Alterar Municipio dados do PMDA
     *
     */
    public function alterarMunPmda($dados) {

        try {

            $con = Conexao::getInstance();

            $sql = "UPDATE cedec_municipio
	           				SET prefeito     = :txtPrefeito,
	           					tel_pref     = :txtTelPref,
	           					cel_pref     = :txtCelPref,
							tel          = :txtTel,
							fax          = :txtFax, 
	           					endereco     = :txtEndereco,
	           					bairro       = :txtBairro,
	           					cep          = :txtCep,
	           					email        = :txtEmail,
       							cobra_iss    = :selCobraIss,
       							aliquota_iss = :txtAliquota,
       							resp_cob_iss = :selResp,
       							num_lei_iss  = :txtNumLei,
                                                        populacao    = :txtPopUrbana,
                                                        pop_rural    = :txtPopRural,
                                                        area         = :txtAreaTerr
	           				WHERE id_municipio = :id_municipio";

            $result = $con->prepare($sql);
            $result->bindValue(":txtPrefeito", strtoupper(FuncaoBase::tirarAcentos($dados['txtPrefeito'])));
            $result->bindParam(":txtTelPref", $dados['txtTelPref']);
            $result->bindParam(":txtCelPref", $dados['txtCelPref']);
            $result->bindParam(":txtTel", $dados['txtTel']);
            $result->bindParam(":txtFax", $dados['txtFax']);
            $result->bindValue(":txtEndereco", strtoupper(FuncaoBase::tirarAcentos($dados['txtEndereco'])));
            $result->bindValue(":txtBairro", $dados['txtBairro']);
            $result->bindParam(":txtCep", $dados['txtCep']);
            $result->bindParam(":txtEmail", $dados['txtEmail']);
            $result->bindParam(":selCobraIss", $dados['selCobraIss']);
            $result->bindParam(":txtAliquota", $dados['txtAliquota']);
            $result->bindParam(":selResp", $dados['selResp']);
            $result->bindParam(":txtNumLei", $dados['txtNumLei']);
            $result->bindParam(":id_municipio", $dados['id_municipio']);
            $result->bindParam(":txtPopUrbana", $dados['txtPopUrbana']);
            $result->bindParam(":txtPopRural", $dados['txtPopRural']);
            $result->bindParam(":txtAreaTerr", $dados['txtAreaTerr']);
            $result->execute();

            return true;
        } catch (Exception $e) {

            echo $e->getMessage();
        }
    }
    
    public static function rel_email($param = 'todos') {
        
        $con = Conexao::getInstance();
        
        $dados = array();
        
        
        $sql = "select id_municipio, nome, email from cedec_municipio "
                . "where id_municipio != 7221";
        
        $result = $con->query($sql);
        
        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            if($param == 'existente'){
                if(strlen($linha['email']) > 0){
                    $dados[] = $linha;            
                }
            }else {
                $dados[] = $linha;            
            }
        }

        return $dados;
    }
    
    public static function listaMunicipioRegional($id_rpm){
        
        $con = Conexao::getInstance();
        
        $dados = array();
        
        $sql = "select cedec_rpm_mun.id_municipio, cedec_municipio.nome,
                com_comdec.com_const,
                cedec_user_ex.situacao
                from cedec_rpm_mun
                inner join cedec_municipio
                on cedec_rpm_mun.id_municipio = cedec_municipio.id_municipio
                inner join com_comdec
                on cedec_municipio.id_municipio = com_comdec.id_municipio 
                inner join cedec_user_ex
                on cedec_municipio.id_municipio = cedec_user_ex.id_municipio
                where cedec_rpm_mun.id_rpm = ".$id_rpm;

        $result = $con->query($sql);
        
        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados[] = $linha;            
        }

        return $dados;
        
    }
    
    
    public static function listaRDC(){
        
        $con = Conexao::getInstance();
        
        $dados = array();
        
        $sql = "select id, nome
                from cedec_rpm";

        $result = $con->query($sql);
        
        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados[] = $linha;            
        }

        return $dados;
        
    }
    
    /**
     * 
     *  Lista municipio para busca id
     */
    public function listaid_municipioAutocomplete() {

        
        $con = Conexao::getInstance();

        $dados = array();

        $sql = "SELECT id_municipio, nome
                              FROM cedec_municipio";

        try {

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados[] = $linha;
            }

            return $dados;
        } catch (Exception $e) {
            return $e->getMessage();
        }
        
    }
    
    
    
    
    
    
}?>