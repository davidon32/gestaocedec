<?php

class Ajuda{


    /** pega quantidade de materias liberados e ja pagos */
    public static function  getMateriaisLiberadosEpagos($post){

        $_campoData = "";
		$_campoDeposito = "";
		$_campoMunicipio = "";

		/* filtro por Data */
		if((strlen($post['txtDtInicial']) >0) && (strlen($post['txtDtFinal']) >0)) {
			$_campoData = " AND dataLibera >= '".DataMysql::dataForm($post['txtDtInicial'])."' AND dataLibera <= '".DataMysql::dataForm($post['txtDtFinal'])."' ";
		}

		/* filtro por deposito */
		if(strlen($post['id_deposito']) >0) {
			$_campoDeposito = " AND aju_liberacao.depDestino = ".$post['id_deposito']." ";
		}

		/* filtro por municipio */
		if(strlen($post['id_municipio']) >0) {
			$_campoMunicipio = " AND aju_liberacao.id_municipio = ".$post['id_municipio']." ";
		}

        $con = Conexao::getInstance();
        $dados = array();

        $sql = "SELECT count(id_liberacao) as numLibera FROM aju_liberacao
                WHERE situacao = '1' ".$_campoData.$_campoDeposito.$_campoMunicipio."
                 ORDER BY dataLibera";
        
        $result = $con->query($sql);
		
        while($linha = $result->fetch(PDO::FETCH_ASSOC)){
            $dados = $linha['numLibera'];
        }

        return $dados;
        
    }
    
    /* pega a quantidade de materiais pagos  */
    public static function getMateriaisPagos($post){

        $_campoData = "";
		$_campoDeposito = "";
		$_campoMunicipio = "";

		/* filtro por Data */
		if((!empty($post['txtDtInicial'])) && (!empty($post['txtDtFinal']))) {
			$_campoData = " AND aju_pagamento.dataLibera >= '".DataMysql::dataForm($post['txtDtInicial'])."' AND aju_pagamento.dataLibera <= '".DataMysql::dataForm($post['txtDtFinal'])."' ";
		}

		/* filtro por deposito */
		if(!empty($post['id_deposito'])) {
			$_campoDeposito = " AND aju_liberacao.depDestino = ".$post['id_deposito']." ";
		}

		/* filtro por municipio */
		if(strlen($post['id_municipio']) > 0) {
			$_campoMunicipio = " AND aju_pagamento.municipio = '".Municipio::PegaNomeMunicipio($post['id_municipio'])."'";
		}
        
        
        $con = Conexao::getInstance();
        $dados = array();

        
        $sql = "SELECT count(aju_pagamento.id_pagamento) as numPgto FROM aju_pagamento
		inner join aju_liberacao
		on aju_pagamento.id_liberacao = aju_liberacao.id_liberacao
        WHERE aju_pagamento.id_liberacao IN (SELECT id_liberacao FROM aju_liberacao
                        WHERE situacao = 1) ".$_campoData.$_campoDeposito.$_campoMunicipio."";
        
        $result = $con->query($sql);
        
        while($linha = $result->fetch(PDO::FETCH_ASSOC)){
            $dados = $linha['numPgto'];
        }

        return $dados;
        
    }
    
    /* pega a quantidade liberaoes */
    public static function getLiberacao($post){

        $_campoData = "";
		$_campoDeposito = "";
		$_campoMunicipio = "";

		/* filtro por Data */
		if((!empty($post['txtDtInicial'])) && (!empty($post['txtDtFinal']))) {
			$_campoData = " AND dataLibera >= '".DataMysql::dataForm($post['txtDtInicial'])."' AND dataLibera <= '".DataMysql::dataForm($post['txtDtFinal'])."' ";
		}

		/* filtro por deposito */
		if(!empty($post['id_deposito'])) {
			$_campoDeposito = " AND aju_liberacao.depDestino = ".$post['id_deposito']." ";
		}

		/* filtro por municipio */
		if(!empty($post['id_municipio'])) {
			$_campoMunicipio = " AND aju_liberacao.id_municipio = ".$post['id_municipio']." ";
		}
        
        $con = Conexao::getInstance();
        $dados = array();

       

        $sql = "SELECT count(id_liberacao) as numLibera FROM aju_liberacao
                WHERE situacao = 0 ".$_campoData.$_campoDeposito.$_campoMunicipio."
                ORDER BY dataLibera";
        
        $result = $con->query($sql);
        
        while($linha = $result->fetch(PDO::FETCH_ASSOC)){
            $dados = $linha['numLibera'];
        }

        return $dados;
    }
    
    /* pega quantidade de materiais esperando pagamento */
    public static function getMaterialEsperaPagto(){
        
        return 0;
    }
    
    /* pega quantidade de transferencias em transito */
    public static function getMaterialTransito($post, $situacao){
        
        $_campoData = "";
		$_campoDeposito = "";

		/* filtro por Data */
		if((!empty($post['txtDtInicial'])) && (!empty($post['txtDtFinal']))) {
            $_campoData = " AND dt_transferencia >= '".DataMysql::dataForm($post['txtDtInicial'])."' AND dt_transferencia <= '".DataMysql::dataForm($post['txtDtFinal'])."' ";
		}

		/* filtro por deposito */
		if(!empty($post['id_deposito'])) {
			$_campoDeposito = " AND id_dep_destino = ".$post['id_deposito']." ";
		}
        
        $con = Conexao::getInstance();
        $dados = array();

       


        $sql = "SELECT count(id_transferencia) as numTransf FROM aju_transferencia
                WHERE situacao = ".$situacao." ".$_campoData.$_campoDeposito."
                ORDER BY dt_transferencia";
        
        $result = $con->query($sql);
        
        while($linha = $result->fetch(PDO::FETCH_ASSOC)){
            $dados = $linha['numTransf'];
        }

        return $dados;
    }


    /** pega dados municipios, dados das liberacoes
	 *  int situacao
	 */

	public static function dadosMunicipioMapaLiberacoes($situacao = 1){

		try {
       		 
			$con = Conexao::getInstance();
			$dados = array();

			$sql = "select count(aju_liberacao.id_municipio) as qtd, cedec_municipio.nome from aju_liberacao
					inner join cedec_municipio
					on aju_liberacao.id_municipio = cedec_municipio.id_municipio
					where aju_liberacao.situacao = ".$situacao."
					group by aju_liberacao.id_municipio;";

			$result = $con->query($sql);

			while($linha = $result->fetch(PDO::FETCH_ASSOC)){
				$dados[] = $linha;
			}
		}catch (Exception $e){
			print $e->getMessage();
		}

		return $dados;

    }
    
    /* Materiais liberador por municipios */

 
    



}?>