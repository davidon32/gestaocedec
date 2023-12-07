<?php

include_once 'Classe.Comunidade.php';

class Pmda extends Comunidade {

    function novo($dados) {

        $con = Conexao::getInstance();
        try {

            $sql = "INSERT INTO pip_pmda (data,
                								status,
                								id_municipio,
                								acoes,
                								qtd_caminhao,
                								pop_at_municipio,
                								pedido_altera,
                								em_analise)
                                        VALUES (:data,
                                                :status,
                                                :id_municipio,
                								:acoes,
                								:qtd_caminhao,
                								:pop_at_municipio,
                								:pedido_altera,
                								:em_analise)";

            $result = $con->prepare($sql);
            $result->bindValue(":data", $dados['data']);
            $result->bindValue(":status", $dados['status'], PDO::PARAM_INT);
            $result->bindValue(":id_municipio", $dados['id_municipio'], PDO::PARAM_INT);
            $result->bindValue(":acoes", $dados['acoes']);
            $result->bindValue(":qtd_caminhao", $dados['qtd_caminhao']);
            $result->bindValue(":pop_at_municipio", $dados['pop_at_municipio']);
            $result->bindValue(":pedido_altera", $dados['pedido_altera']);
            $result->bindValue(":em_analise", $dados['em_analise']);
            $result->execute();

            return true;
        } catch (Exception $e) {

            $result->debugDumpParams();
            print FuncaoBase::getError($e->getMessage(), 'Mensagem');
        }
    }

    public function deleteComPmda($id_pmda_comun, $id_comunidade, $id_municipio, $id_pmda) {

        $con = Conexao::getInstance();

        try {

            $sql = "DELETE FROM pip_pmda_comun
                            WHERE id_com_pmda = :id_com_pmda";

            $result = $con->prepare($sql);
            $result->bindValue(":id_com_pmda", $id_pmda_comun);
            $result->execute();

            $sql1 = "DELETE FROM pip_representante 
        						WHERE id_comunidade = :id_comunidade";

            $result1 = $con->prepare($sql1);
            $result1->bindValue(":id_comunidade", $id_comunidade);
            $result1->execute();

            //$comunidade = empty($id_comunidade) ? "" : Comunidade::buscaComunidadeId($id_comunidade);
            //Log::GravaLogUserEx("Exclusao de Comunidade :".$comunidade['comunidade'], "cedec_user_ex_log", $id_pmda);

            return true;
        } catch (Exception $e) {

            print FuncaoBase::getError($e->getMessage(), 'Mensagem');
        }
    }

    /**
     * 
     * @param int $_id_municipio
     * 
     * @return mixed[]
     */
    function listaPmda($_id_municipio) {

        $dados = array();

        $con = Conexao::getInstance();

        try {

            $sql = "SELECT id_pmda,
                               data,
                               status,
                               id_municipio,
                				resp_homolog,
                                                dt_analise,
                                                data_aprov,
                                                estado,
                                                alterar_com
                               FROM pip_pmda
							   WHERE id_municipio = :id_municipio
                                                           
							   order by status";

            $result = $con->prepare($sql);

            $result->bindValue(":id_municipio", $_id_municipio);

            $result->execute();

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

                $dados[] = $linha;
            }

            return $dados;
        } catch (Exception $e) {

            print FuncaoBase::getError($e->getMessage(), 'Mensagem');
        }
    }

    /**
     * 
     * Verifica status PMDA
     * 
     */
    public function opcao($id_pmda) {

        $con = Conexao::getInstance();

        try {

            $sql = "SELECT status
                        FROM pip_pmda
                            WHERE id_pmda = :id_pmda";

            $result = $con->prepare($sql);

            $result->bindValue(":id_pmda", $id_pmda);

            $result->execute();

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

                $dados = $linha['status'];
            }

            return $dados;
        } catch (Exception $e) {

            print FuncaoBase::getError($e->getMessage(), 'Mensagem');
        }
    }

    /**
     * Tradução do status
     * 0 - em Edição
     * 1 - completo
     * 2 - Em análise
     * 3 - arquivado
     * 4 - Homologado
     * 5 - Anulado
     * @param $status int
     */
    public static function status($status) {

        switch ($status) {
            case 0:
                return "Em Edição";
                break;
            case 1:
                return "Completo";
                break;
            case 2:
                return "Em Análise";
                break;
            case 3:
                return "Arquivado";
                break;
            case 4:
                return "Aprovado";
                break;
            case 5:
                return "Anulado";
                break;
            case 9:
                return "Encerrado";
                break;
            case 6:
                return "nulo";
                break;
            case 7:
                return "Atendido";
                break;
            case 8:
                return "Cancelado";
                break;
            default:
                return "opção Inválida !";
                break;
        }
    }

    /**
     * Relacionamento pmda comunidade
     * Lista as comunidades do respectivo pmda
     * @param $id_pmda - id do Pmda
     * 
     */
    public function listaComunidadePmda($_id_pmda) {


        //var_dump('verificar os pmda legado');

        $dados = array();

        $con = Conexao::getInstance();

        try {

            $sql = "SELECT pip_comunidade.id_comunidade,
			pip_comunidade.comunidade,
			pip_pmda_comun.latitude,
			pip_pmda_comun.longitude,
                        pip_pmda_comun.id_pmda,
			pip_pmda_comun.id_com_pmda,
			pip_pmda_comun.trecho_pav,
			pip_pmda_comun.trecho_n_pav,
			pip_pmda_comun.pop_atendida,
			
                			pip_pmda_comun.id_municipio,
                			pip_ponto_cap.latitude as lat_ponto,
                			pip_ponto_cap.longitude as long_ponto,
                			pip_ponto_cap.nome,
                			pip_ponto_cap.id_ponto,
                			pip_ponto_cap.tipo
								FROM pip_comunidade
									INNER JOIN pip_pmda_comun
										ON pip_pmda_comun.id_comunidade = pip_comunidade.id_comunidade
                							INNER JOIN pip_ponto_cap
                								ON pip_pmda_comun.id_ponto = pip_ponto_cap.id_ponto
											WHERE pip_pmda_comun.id_pmda =:id_pmda
                								ORDER BY pip_comunidade.comunidade";
            /*                 $sql = "SELECT pip_comunidade.id_comunidade,
              pip_comunidade.comunidade,
              pip_comunidade.latitude,
              pip_comunidade.longitude,
              pip_comunidade.id_ponto,
              pip_comunidade.trecho_pav,
              pip_comunidade.trecho_n_pav,
              pip_comunidade.pop_atendida,
              pip_comunidade.id_comunidade,
              pip_pmda_comun.id_pmda,
              pip_pmda_comun.id_com_pmda,
              pip_ponto_cap.latitude as lat_ponto,
              pip_ponto_cap.longitude as long_ponto,
              pip_ponto_cap.nome
              FROM pip_comunidade
              INNER JOIN pip_pmda_comun
              ON pip_pmda_comun.id_comunidade = pip_comunidade.id_comunidade
              LEFT OUTER JOIN pip_ponto_cap
              ON pip_comunidade.id_ponto = pip_ponto_cap.id_ponto
              WHERE pip_pmda_comun.id_pmda =:id_pmda
              ORDER BY pip_comunidade.comunidade"; */

            $result = $con->prepare($sql);

            $result->bindParam(":id_pmda", $_id_pmda, PDO::PARAM_INT);

            $result->execute();

            //var_dump($result->debugDumpParams());

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

                $dados[] = $linha;
            }

            return $dados;
        } catch (Exception $e) {

            print FuncaoBase::getError($e->getMessage(), 'Mensagem ');
        }
    }

    /**
     * Relacionamento pmda comunidade
     * Lista as comunidades do respectivo pmda
     * @param $id_pmda - id do Pmda
     * 
     */
    public function listaComunidadePmdaLegado($_id_pmda) {

        $dados = array();

        $con = Conexao::getInstance();

        try {


            $sql = "SELECT pip_comunidade.id_comunidade,
              pip_comunidade.comunidade,
              pip_comunidade.latitude,
              pip_comunidade.longitude,
              pip_comunidade.id_ponto,
              pip_comunidade.trecho_pav,
              pip_comunidade.trecho_n_pav,
              pip_comunidade.pop_atendida,
              pip_comunidade.id_comunidade,
              pip_pmda_comun.id_pmda,
              pip_pmda_comun.id_com_pmda,
              pip_ponto_cap.latitude as lat_ponto,
              pip_ponto_cap.longitude as long_ponto,
              pip_ponto_cap.nome,
              pip_ponto_cap.id_ponto,
              pip_ponto_cap.tipo
              FROM pip_comunidade
              INNER JOIN pip_pmda_comun
              ON pip_pmda_comun.id_comunidade = pip_comunidade.id_comunidade
              LEFT OUTER JOIN pip_ponto_cap
              ON pip_comunidade.id_ponto = pip_ponto_cap.id_ponto
              WHERE pip_pmda_comun.id_pmda =:id_pmda
              ORDER BY pip_comunidade.comunidade";

            $result = $con->prepare($sql);

            $result->bindParam(":id_pmda", $_id_pmda, PDO::PARAM_INT);

            $result->execute();

            //var_dump($result->debugDumpParams());

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

                $dados[] = $linha;
            }

            return $dados;
        } catch (Exception $e) {

            print FuncaoBase::getError($e->getMessage(), 'Mensagem');
        }
    }

    /**
     * 
     * Lista de Representante para impressao PMDA
     * 
     * 
     */
    public function listaImpressaoPmda($id_pmda) {

        $con = Conexao::getInstance();

        $dados = array();

        $sql = "select pip_comunidade.comunidade,
			    	pip_representante.nome,
			    	pip_representante.tel,
			    	pip_representante.cpf
			    	from pip_representante
			    	inner join pip_comunidade
			    	on pip_comunidade.id_comunidade = pip_representante.id_comunidade
			    	where pip_representante.id_comunidade in (select pip_comunidade.id_comunidade
			    			from pip_comunidade
			    			inner join pip_pmda_comun
			    			on pip_comunidade.id_comunidade = pip_pmda_comun.id_comunidade
			    			where pip_pmda_comun.id_pmda = :id_pmda)
    						and pip_representante.id_pmda = :id_pmda
    							order by pip_comunidade.comunidade, pip_representante.nome";

        $result = $con->prepare($sql);
        $result->bindParam(":id_pmda", $id_pmda);
        $result->execute();

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados[] = $linha;
        }

        return $dados;
    }

    /**
     * 
     * Pmda Legado 
     */
    public static function pmdaLegado($param) {

        $dataCriacao = date('Y/m/d', strtotime($param));
        $dataLimite = date('Y/m/d', strtotime(date('2021/03/04')));
        return ($dataCriacao > $dataLimite ? true : false);
    }

    /**
     * Lista de Comentario PMDA
     *
     */
    public function listaComentario($id_pmda) {

        $con = Conexao::getInstance();

        $dados = array();

        $sql = "select texto, id_pmda
    				from pip_pmda_coment
			    	where id_pmda = :id_pmda";

        $result = $con->prepare($sql);
        $result->bindParam(":id_pmda", $id_pmda);
        $result->execute();

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados[] = $linha;
        }

        return $dados;
    }

    /**
     * 
     * Adicionar comunidade no Pmda
     * 
     * @param unknown $dados
     * @return boolean
     */
    function novoComPmda($dados) {

        $con = Conexao::getInstance();

        try {

            # verifica se existe esta comunidade em algum pmda com status
            # em edição
            # atendimento
            # completo
            # em analise
            if (self::buscaComunidaPmda($dados)) {

                print "existe_";
            } else {

                $sql = "INSERT INTO pip_pmda_comun (id_pmda,
                                                        id_comunidade,
                                                        id_municipio,
                                                        id_ponto,
                                                        latitude,
                                                        longitude,
                                                        trecho_pav,
                                                        trecho_n_pav,
                                                        pop_atendida)
                                                        VALUES (:id_pmda,
                                                                :id_comunidade,
                                                                :id_municipio,
                                                                :id_ponto,
                                                                :latitude,
                                                                :longitude,
                                                                :trecho_pav,
                                                                :trecho_n_pav,
                                                                :pop_atendida)";

                $result = $con->prepare($sql);
                $result->bindValue(":id_pmda", $dados['id_pmda']);
                $result->bindValue(":id_comunidade", $dados['id_comunidade'], PDO::PARAM_INT);
                $result->bindValue(":id_municipio", $dados['txtIdMunAddCom'], PDO::PARAM_INT);
                $result->bindValue(":id_ponto", $dados['selPontoCapCom'], PDO::PARAM_INT);
                $result->bindValue(":latitude", $dados['txtLatComunidade'], PDO::PARAM_STR);
                $result->bindValue(":longitude", $dados['txtLongComunidade'], PDO::PARAM_STR);
                $result->bindValue(":trecho_pav", $dados['txtTrecPavComunidade'], PDO::PARAM_STR);
                $result->bindValue(":trecho_n_pav", $dados['txtTrecNPavComunidade'], PDO::PARAM_STR);
                $result->bindValue(":pop_atendida", $dados['txtPopAtComunidade'], PDO::PARAM_INT);
                $result->execute();

                /* $sql1 = "UPDATE pip_comunidade
                  SET latitude = :latitude,
                  longitude = :longitude,
                  trecho_pav = :trecho_pav,
                  trecho_n_pav = :trecho_n_pav,
                  pop_atendida = :pop_atendida
                  WHERE id_comunidade = " . $dados['id_comunidade'];

                  $result1 = $con->prepare($sql1);
                  $result1->bindValue(":latitude", $dados['txtLatComunidade']);
                  $result1->bindValue(":longitude", $dados['txtLongComunidade']);
                  $result1->bindValue(":trecho_pav", $dados['txtTrecPavComunidade']);
                  $result1->bindValue(":trecho_n_pav", $dados['txtTrecNPavComunidade']);
                  $result1->bindValue(":pop_atendida", $dados['txtPopAtComunidade']);
                  $result1->execute(); */

                $comunidade = empty($dados['id_comunidade']) ? "" : Comunidade::buscaComunidadeId($dados['id_comunidade']);

                //Log::GravaLogUserEx("Adicão Comunidade :".$comunidade['comunidade'], "cedec_user_ex_log", $dados['id_pmda']);

                print "sucesso";
            }
        } catch (Exception $e) {

            //$result1->debugDumpParams();
            print FuncaoBase::getError($e->getMessage(), 'Mensagem');
            print "erro";
        }
    }

    /**
     * Alterar Comunidade
     * 
     * 
     */
    public static function alterarComunidade($dados) {
        
        $con = Conexao::getInstance();

        try {

            /* alterar dados comunidade */
            $sql = "UPDATE pip_pmda_comun
			SET latitude = :latitude,
			longitude =    :longitude,
			id_ponto =     :id_ponto,
			trecho_pav =   :trecho_pav,
			trecho_n_pav = :trecho_n_pav,
			pop_atendida = :pop_atendida
                            WHERE id_comunidade = :id_comunidade
                            AND id_pmda = :id_pmda";

            $result = $con->prepare($sql);

            $result->bindValue(":latitude",     $dados['txtLatComunidade']);
            $result->bindValue(":longitude",    $dados['txtLongComunidade']);
            $result->bindValue(":trecho_pav",   $dados['txtTrecPavComunidade']);
            $result->bindValue(":trecho_n_pav", $dados['txtTrecNPavComunidade']);
            $result->bindValue(":pop_atendida", $dados['txtPopAtComunidade']);
            $result->bindValue(":id_ponto",     $dados['selPontoCapCom']);
            $result->bindValue(":id_comunidade",$dados['id_comunidade']);
            $result->bindValue(":id_pmda",      $dados['id_pmda']);

            $result->execute();

            //$comunidade = empty($dados['id_comunidade']) ? "" : Comunidade::buscaComunidadeId($dados['id_comunidade']);
            //Log::GravaLogUserEx("Alteração dados da Comunidade :".$comunidade['comunidade']."\n", "cedec_user_ex_log", $dados['id_pmda']);

            return true;
        } catch (Exception $e) {

            print FuncaoBase::getError($e->getMessage(), 'Mensagem');
        }
    }

    /**
     * Alterar Comunidade
     * 
     * 
     */
    public static function alterarComunidadePmda($dados) {

        $con = Conexao::getInstance();

        try {

            /* alterar dados comunidade */
            $sql = "UPDATE pip_pmda_comun
						SET latitude = :latitude,
							longitude = :longitude,
							id_ponto = :id_ponto,
							trecho_pav = :trecho_pav,
							trecho_n_pav = :trecho_n_pav,
							pop_atendida = :pop_atendida
								WHERE id_comunidade = :id_comunidade;";

            $result = $con->prepare($sql);

            $result->bindValue(":latitude", $dados['txtLatComunidade']);
            $result->bindValue(":longitude", $dados['txtLongComunidade']);
            $result->bindValue(":trecho_pav", $dados['txtTrecPavComunidade']);
            $result->bindValue(":trecho_n_pav", $dados['txtTrecNPavComunidade']);
            $result->bindValue(":pop_atendida", $dados['txtPopAtComunidade']);
            $result->bindValue(":id_ponto", $dados['selPontoCapCom']);
            $result->bindValue(":id_comunidade", $dados['id_comunidade']);

            $result->execute();

            /* alterar dados relacionamento comunidade pmda */
            /* $sql1 = "UPDATE pip_pmda_comun
              SET id_ponto = :id_ponto
              WHERE id_comunidade = :id_comunidade";

              $result1 = $con->prepare($sql1);
              $result1->bindValue(":id_ponto", $dados['selPontoCapCom']);
              $result1->bindValue(":id_comunidade", $dados['id_comunidade']);
              $result1->execute(); */


            $comunidade = empty($dados['id_comunidade']) ? "" : Comunidade::buscaComunidadeId($dados['id_comunidade']);

            //Log::GravaLogUserEx("Alteração dados da Comunidade :".$comunidade['comunidade']."\n", "cedec_user_ex_log", $dados['id_pmda']);

            return true;
        } catch (Exception $e) {

            print FuncaoBase::getError($e->getMessage(), 'Mensagem');
        }
    }

    /**
     * 
     * 
     * 
     */
    public function contaRep($id_comunidade, $id_pmda) {

        $con = Conexao::getInstance();

        $dados = array();

        try {

            $sql = "SELECT COUNT(id) FROM pip_representante
								WHERE id_comunidade = :id_comunidade
            						AND id_pmda = :id_pmda";

            $result = $con->prepare($sql);

            $result->bindValue(":id_comunidade", $id_comunidade);
            $result->bindValue(":id_pmda", $id_pmda);

            $result->execute();

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

                $dados = $linha['COUNT(id)'];
            }

            return $dados;
        } catch (Exception $e) {

            print FuncaoBase::getError($e->getMessage(), 'Mensagem');
        }
    }

    /**
     * Busca pmda
     * 
     * 
     */
    public function buscaPmda($id_pmda) {

        $dados = array();

        $con = Conexao::getInstance();

        $sql = "SELECT id_pmda,
        			data,
        			status,
        			id_municipio,
        				acoes,
        				qtd_caminhao,
        				pop_at_municipio,
        				pedido_altera,
        				em_analise,
        				resp_homolog,
                                        dt_analise,
                                        estado
        				FROM pip_pmda
        					WHERE id_pmda = :id_pmda";

        $result = $con->prepare($sql);
        $result->bindParam(":id_pmda", $id_pmda);
        $result->execute();

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados[] = $linha;
        }
        return $dados;
    }

    /**
     *  Extrair pmda do Protoclo
     * 
     */
    public function extraiPmda($protocolo) {
        $data = substr(substr($protocolo, -8), 0, 4) . '-' . substr(substr($protocolo, -8), 4, 2) . '-' . substr(substr($protocolo, -8), 6, 2);
        return array('id_pmda' => substr($protocolo, 0, -8), 'data' => $data);
    }

    /**
     * Dados pmda
     * 
     */
    public function dadosPmda($id_pmda) {

        $dados = array();

        $con = Conexao::getInstance();

        $sql = "SELECT id_pmda,
        				data,
        				status,
        				id_municipio,
        				acoes,
        				qtd_caminhao,
        				pop_at_municipio
	                    FROM pip_pmda
	                        WHERE id_pmda = :id_pmda";

        $result = $con->prepare($sql);
        $result->bindParam(":id_pmda", $id_pmda);
        $result->execute();

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

            $dados = $linha;
        }

        return $dados;
    }

    /**
     * Dados pmda
     *
     */
    public function atualizaAcoes($array) {

        $dados = array();

        $con = Conexao::getInstance();

        $sql = "UPDATE pip_pmda
    				SET acoes = :acoes,
    					qtd_caminhao = :qtd_caminhao,
    					pop_at_municipio = :pop_at_municipio
	                        WHERE id_pmda = :id_pmda";

        $result = $con->prepare($sql);
        $result->bindParam(":id_pmda", $array['id_pmda']);
        $result->bindValue(":acoes", strtoupper(FuncaoBase::tirarAcentos($array['txtDescrAcoes'])));
        $result->bindParam(":qtd_caminhao", $array['txtQtdContratado']);
        $result->bindParam(":pop_at_municipio", $array['txtPopAtMunicipio']);
        $result->execute();

        //Log::GravaLogUserEx("Ações de Resposta Alterado: ", "cedec_user_ex_log", $array['id_pmda']);

        return true;
    }

    /**
     * 
     * 
     * 
     */
    public function previewAnexo($id) {

        $dados = array();

        $con = Conexao::getInstance();

        $sql = "SELECT id, arquivo FROM pip_anexo WHERE id= :id";

        $result = $con->prepare($sql);
        $result->bindParam(":id", $id);
        $result->execute();

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

            $dados = $linha;
        }
        $existeArquivo = file_exists(PATH . "/anexo/pmda/" . $dados['id'] . "_" . $dados['arquivo']);

        $_result['file'] = $dados['id'] . "_" . $dados['arquivo'];
        $_result['existe'] = $existeArquivo;

        return $_result;
    }

    /**
     * Muda os status do PMDA
     * $array['id_pmda']
      $array['resp']
      $array['status']
      $dt_atual - hoje
      $array['data']
     *
     */
    public static function atualizaStatus($array) {

        $dt_atual = date('Y-m-d H:i:s');

        if ($array['status'] == 4) {
            $data = isset($array['data']) ? $array['data'] : null;
        } else {
            $array['data'] = null;
        }

        $con = Conexao::getInstance();

        $sql = "UPDATE pip_pmda
	    				SET status = :status,
    						resp_homolog = :resp_homolog,
						dt_analise = :dt_analise,
                                                data_aprov = :data_aprov
		                        WHERE id_pmda = :id_pmda";

        $result = $con->prepare($sql);
        $result->bindParam(":id_pmda", $array['id_pmda']);
        $result->bindParam(":resp_homolog", $array['resp']);
        $result->bindParam(":status", $array['status']);
        $result->bindParam(":dt_analise", $dt_atual);
        $result->bindParam(":data_aprov", $array['data']);
        $result->execute();

        return true;
    }

    /**
     * Muda os ESTADO do PMDA
     *
     */
    public static function atualizaEstado($array) {

        if ($array['estado'] == 7) {
            $data = isset($array['data']) ? $array['data'] : null;
        } else {
            $array['data'] = null;
        }

        $con = Conexao::getInstance();

        $data_agora = date('Y-m-d H:i:s');

        $sql = "UPDATE pip_pmda
	    				SET estado = :estado,
    						resp_estado = :resp_estado,
						dt_estado = :dt_estado
		                        WHERE id_pmda = :id_pmda";

        $result = $con->prepare($sql);
        $result->bindParam(":id_pmda", $array['id_pmda']);
        $result->bindParam(":resp_estado", $array['resp']);
        $result->bindParam(":estado", $array['estado']);
        $result->bindParam(":dt_estado", $data_agora);
        $result->execute();

        return true;
    }

    /**
     * Liberar pmda para alteraçoes de comunidades
     *
     */
    public static function liberarAtualizar($array) {

        $con = Conexao::getInstance();

        $sql = "UPDATE pip_pmda
	    				SET alterar_com = 1
		                        WHERE id_pmda = :id_pmda";

        $result = $con->prepare($sql);
        $result->bindParam(":id_pmda", $array['id_pmda']);
        $result->execute();

        return true;
    }

    /**
     * Grava Comentario / Nota
     *
     */
    public static function gravarNota($array) {

        $con = Conexao::getInstance();

        $sql = "INSERT INTO pip_pmda_coment (id_pmda, texto)
    				VALUES (:id_pmda, :texto)";

        $result = $con->prepare($sql);
        $result->bindParam(":id_pmda", $array['id_pmda']);
        $result->bindParam(":texto", $array['texto']);
        $result->execute();

        return true;
    }

    /**
     * Grava Mensagem PMDA
     *
     */
    public static function gravarMensagem($array) {

        $con = Conexao::getInstance();

        $sql = "INSERT INTO pip_pmda_msg (id_usuario, id_municipio, 
							msg, status, id_pmda, dt_envio, protocolo, tp_mensagem)
    				VALUES (:id_usuario, :id_municipio, :msg, :status, :id_pmda,
    						:dt_envio, :protocolo, :tp_mensagem)";

        $result = $con->prepare($sql);
        $result->bindParam(":id_usuario", $array['id_usuario']);
        $result->bindParam(":id_municipio", $array['id_municipio']);
        $result->bindParam(":msg", $array['msg'], PDO::PARAM_STR);
        $result->bindParam(":status", $array['status']);
        $result->bindParam(":id_pmda", $array['id_pmda']);
        $result->bindParam(":dt_envio", $array['dt_envio']);
        $result->bindParam(":protocolo", $array['protocolo']);
        $result->bindParam(":tp_mensagem", $array['tp_mensagem']);
        $result->execute();

        return true;
    }

    /**
     * Verifica os parametro basicos de preenchimento do pmda
     * 
     * 0 - incompleto
     * 1 - completo
     * 2 - homologação
     * 3 - arquivado
     * 4 - Homologado
     */
    public static function verificaStatus($array) {

        $status = null;

        $con = Conexao::getInstance();

        // conta o total de comunidades do PMDA
        $tot_comunidade = (int) Pmda::totComunidade($array['id_pmda']) * 3;

        // total de representantes das comunidades
        $tot_representante = (int) Pmda::totRepresentante($array['id_pmda']);


        /* var_dump($tot_comunidade);
          var_dump($tot_representante); */

        $valStatus = Pmda::buscaStatus($array['id_pmda']);

        $dt_analise = null;

        # verifica se existem comunidades no pmda e se o total dos representantes é 3x o numero das comunidades
        if (($tot_comunidade == 0) || ($tot_representante < $tot_comunidade)) {

            $status = "0";
            // verifica se o status esta em homologação	
        } elseif (($valStatus != 2)) {

            $dt_analise = date('Y/m/d H:i:s');
            $status = "1";
        }

        //var_dump($status);
        /* atualiza o status */
        $sql = "UPDATE pip_pmda
	    				SET status = :status,
						dt_analise = :dt_analise
		                        WHERE id_pmda = :id_pmda";

        $result = $con->prepare($sql);
        $result->bindParam(":id_pmda", $array['id_pmda']);
        $result->bindParam(":dt_analise", $dt_analise);
        $result->bindParam(":status", $status);
        $result->execute();

        return $status;
    }

    /**
     * 
     * Busca Status PMDA
     * 
     */
    public static function buscaStatus($id_pmda) {

        $dados = array();

        $con = Conexao::getInstance();

        $sql = "select status from pip_pmda where id_pmda = :id_pmda";

        $result = $con->prepare($sql);
        $result->bindParam(":id_pmda", $id_pmda);
        $result->execute();

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

            $dados = $linha;
        }

        return $dados['status'];
    }

    /**
     * 
     * Busca pmda em edicao
     * 
     */
    public static function existeEdicao($id_municipio) {

        $dados = array();

        $con = Conexao::getInstance();

        $sql = "select status
                    from pip_pmda
                    where id_municipio = :id_municipio
                    and status = 0";

        $result = $con->prepare($sql);
        $result->bindParam(":id_municipio", $id_municipio);
        $result->execute();

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

            $dados[] = $linha;
        }


        return (count($dados) > 0) ? true : false;
    }

    /**
     * 
     * @return Total Comundiade
     * 
     */
    public static function totComunidade($id_pmda) {
        $dados = array();
        try {
            $con = Conexao::getInstance();
            # total de comunidades
            $sql = "SELECT COUNT(pip_pmda_comun.id_com_pmda) as tot_comunidade
						FROM pip_pmda_comun
						WHERE pip_pmda_comun.id_pmda = :id_pmda";
            $result = $con->prepare($sql);
            $result->bindParam(":id_pmda", $id_pmda);
            $result->execute();
            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados = $linha;
            }
            return $dados['tot_comunidade'];
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    /**
     *
     * @return Total Representantes
     *
     */
    public static function totRepresentante($id_pmda) {
        $dados = array();
        try {
            $con = Conexao::getInstance();
            # total de comunidades
            $sql = "select count(pip_representante.id_comunidade) as tot_representante
					from pip_representante
					Where pip_representante.id_comunidade in
					(select pip_pmda_comun.id_comunidade as comunidade
						from pip_pmda_comun
						WHERE pip_pmda_comun.id_pmda = :id_pmda)
    				and pip_representante.id_pmda = :id_pmda";
            $result = $con->prepare($sql);
            $result->bindParam(":id_pmda", $id_pmda);
            $result->execute();
            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados = $linha;
            }
            return $dados['tot_representante'];
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    /**
     * Lista Mensagem para Compdec
     * status
     *  0 - 
     *
     */
    public function listaMensagem($id_pmda, $status = null) {

        $dados = array();

        try {

            $con = Conexao::getInstance();

            $query = ($status == "0") ? "and status = " . $status : "";

            $sql = "select id, id_usuario, id_municipio, msg, id_pmda, protocolo, status, dt_envio
					from pip_pmda_msg
					where id_pmda = " . $id_pmda . " " . $query . " order by dt_envio desc";

            $result = $con->query($sql);
            $result->execute();


            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados[] = $linha;
            }

            return $dados;
        } catch (Exception $e) {

            print $e->getMessage();
        }
    }

    /**
     * Lista geral Mensagem Municipio
     *
     */
    public function listaMsgMunicipio($id_municipio) {

        $dados = array();

        try {

            $con = Conexao::getInstance();

            $sql = "select id, id_usuario, id_municipio, msg, id_pmda,
    					dt_envio, status, protocolo
					from pip_pmda_msg
					where id_municipio = :id_municipio";

            $result = $con->prepare($sql);
            $result->bindParam(":id_municipio", $id_municipio);
            $result->execute();

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados[] = $linha;
            }

            return $dados;
        } catch (Exception $e) {

            print $e->getMessage();
        }
    }

    /* marcar mensagem lida */

    public static function ler_mensagem($id) {

        $dt_leitura = date("Y-m-d H:i:s");

        $con = Conexao::getInstance();

        try {

            $sql = "UPDATE pip_pmda_msg
	    				SET status = '1',
    					dt_leitura = :dt_leitura
		                        WHERE id = :id";

            $result = $con->prepare($sql);
            $result->bindParam(":id", $id);
            $result->bindParam(":dt_leitura", $dt_leitura);
            $result->execute();

            return true;
        } catch (Exception $e) {

            print $e->getMessage();
        }
    }

    /**
     * Mensagem de Pmda 
     *
     */
    public function mensagem($id) {

        $dados = array();

        try {

            $con = Conexao::getInstance();

            $sql = "select msg
					from pip_pmda_msg
					where id = :id";

            $result = $con->prepare($sql);
            $result->bindParam(":id", $id, PDO::PARAM_INT);
            $result->execute();

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados = $linha;
            }

            return $dados;
        } catch (Exception $e) {

            print $e->getMessage();
        }
    }

    /**
     * Lista Pmda em analise
     * 
     * 
     */
    public function listaPmdaAnalise() {

        $dados = array();

        try {

            $con = Conexao::getInstance();

            $sql = "select pip_pmda.id_pmda,
							pip_pmda.data, pip_pmda.status,
							pip_pmda.id_municipio,
							cedec_municipio.nome as nome,
							pip_pmda.dt_analise,
							pip_pmda.dt_ultima_alteracao							
	    				from pip_pmda
	    				inner join cedec_municipio 
	    				on cedec_municipio.id_municipio = pip_pmda.id_municipio
						where status = 2
						order by pip_pmda.dt_analise desc";

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados[] = $linha;
            }

            return $dados;
        } catch (Exception $e) {

            print $e->getMessage();
        }
    }

    /**
     * Lista Pmda em com pedido e alterados
     *
     *
     */
    public function listaPmdaAlteracao() {

        $dados = array();

        try {

            $con = Conexao::getInstance();

            $sql = "select pip_pmda.id_pmda, pip_pmda.data, pip_pmda.id_municipio,
	    				cedec_municipio.nome as nome,
	    				pip_pmda.pedido_altera
	    				from pip_pmda
	    				inner join cedec_municipio
	    				on cedec_municipio.id_municipio = pip_pmda.id_municipio
	    				where pip_pmda.em_analise = 'SIM'
						 order by pip_pmda.pedido_altera desc;";

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados[] = $linha;
            }

            return $dados;
        } catch (Exception $e) {

            print $e->getMessage();
        }
    }

    /**
     * Lista as alteracoes do PMDA
     *
     *
     */
    public function buscaAlteracaoPmda($id_pmda) {

        $dados = "";

        try {

            $con = Conexao::getInstance();

            $sql = "select id_pmda_altera, id_pmda, editor, alteracao, dt_alteracao
							from pip_pmda_alteracao
							where id_pmda = :id_pmda
							order by dt_alteracao";

            $result = $con->prepare($sql);
            $result->bindParam(":id_pmda", $id_pmda);
            $result->execute();

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados .= "<a href='?modulo=pipa&secao=pmda&acao=valt&pmda=" . $linha['id_pmda'] . "&p=" . $linha['id_pmda_altera'] . "'><img src='core/imagem/view.png'></a><br>";
            }

            return $dados;
        } catch (Exception $e) {

            print $e->getMessage();
        }
    }

    /*
     * lembrete pre cadastro comunidade
     * */

    public function buscaPreCadComun() {

        $dados = array();

        $con = Conexao::getInstance();

        $sql = "select cedec_municipio.nome, pip_comunidade.id_municipio, count(pip_comunidade.id_municipio) as total_com 
    					from pip_comunidade
						inner join cedec_municipio
						on pip_comunidade.id_municipio = cedec_municipio.id_municipio
						where tipo_cad = 'pre'
						group by id_municipio";

        $result = $con->query($sql);

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

            $dados[] = $linha;
        }

        return $dados;
    }

    /**
     * 
     * Resumo situacao geral PMDA
     * 
     */
    public function buscaSituacaoPmda($situacao) {

        $con = Conexao::getInstance();

        $dados = array();

        if ($situacao == "8") {

            $situacao = "in('0','1','4','3')";
        } else {

            $situacao = "=" . $situacao;
        }
        $sql = "select pip_pmda.id_pmda,
    		pip_pmda.id_municipio,
		pip_pmda.data as data,
		pip_pmda.status as status,
    		pip_pmda.resp_homolog as resp_homolog,
                pip_pmda.data_aprov as data_aprov,
                pip_pmda.dt_analise as dt_analise,
                pip_pmda.estado as estado
		from pip_pmda
		where pip_pmda.status " . $situacao . "
    		order by pip_pmda.status desc, pip_pmda.id_municipio";

        $result = $con->query($sql);
        $result->execute();

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

            $dados[] = $linha;
        }

        return $dados;
    }

    /**
     *
     * Verifica disponibilidade para criar novo PMDA
     * Tradução do status
     * 0 - em Edição
     * 1 - completo
     * 2 - Em análise
     * 3 - arquivado
     * 4 - Homologado
     * 5 - Anulado
     * @param $id_municipio 
     */
    public function verificaCriarPmda($id_municipio) {

        $dataCriacao = date('Y/m/d', strtotime(date('2021/03/04')));

        try {

            if (!empty($id_municipio)) {

                $con = Conexao::getInstance();

                $dados = "";

                $sql = "select count(id_pmda) as num_pmda
                            from pip_pmda
                            where id_municipio = :id_municipio
                            and status in ('0','2')
                            and data > '" . $dataCriacao . "'";

                $result = $con->prepare($sql);
                $result->bindParam(":id_municipio", $id_municipio);
                $result->execute();

                while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

                    $dados = $linha['num_pmda'];
                }

                return $dados;
            } else {
                return null;
            }
        } catch (Exception $e) {
            
        }
    }

    /**
     *
     * Verifica disponibilidade para Duplicar PMDA
     * Tradução do status
     * @return numero de registros
     * @param $id_municipio 
     */
    public function verificaDuplicar($id_pmda) {

        $dataCriacao = date('Y/m/d', strtotime(date('2021/03/04')));

        try {

            $con = Conexao::getInstance();

            $dados = "";

            $sql = "select count(id_pmda) as num_pmda
                            from pip_pmda
                            where id_pmda = :id_pmda
                            and status not in ('1','0','2','4')
                            and data > '" . $dataCriacao . "'";

            $result = $con->prepare($sql);
            $result->bindParam(":id_pmda", $id_pmda);
            $result->execute();

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

                $dados = $linha['num_pmda'];
            }

            return $dados;
        } catch (Exception $e) {
            
        }
    }

    /**
     *  atualiza ultima alteração pmda
     */
    public static function ultimaAlteracao($id_pmda) {

        $con = Conexao::getInstance();

        $sql = "UPDATE pip_pmda
	    				SET dt_ultima_alteracao = :dt_ultima_alteracao,
		                    WHERE id_pmda = :id_pmda";

        $result = $con->prepare($sql);
        $result->bindParam(":id_pmda", $id_pmda);
        $result->bindParam(":dt_ultima_alteracao", date('Y-m-d H:i:s'));
        $result->execute();

        return true;
    }

    /**
     *
     * Duplicar PMDA 
     * @param $id_municipio
     * @param $id_pmda
     * 
     */
    public function copiaPmda($id_pmda) {

        $dados = "";

        /* pmda */
        $id_pmda_novo = $this->duplicaPmda($id_pmda);

        /* comunidades */
        $this->duplicaComunidades($id_pmda, $id_pmda_novo);

        /* representante */
        $this->duplicaRepresentantes($id_pmda, $id_pmda_novo);

        print "sucesso";
    }

    /* duplica PMDA */

    public function duplicaPmda($id_pmda) {

        $con = Conexao::getInstance();

        $dadosPmda = $this->buscaPmda($id_pmda);
        $id_municipio = $dadosPmda[0]['id_municipio'];

        $sql = "INSERT INTO pip_pmda (data,
                                    status,
                                    id_municipio,
                                    acoes,
                                    qtd_caminhao,
                                    pop_at_municipio,
                                    pedido_altera,
                                    em_analise,
                                    resp_homolog,
                                    dt_analise,
                                    dt_ultima_alteracao) VALUES (:data,
								:status,
								:id_municipio,
								:acoes,
								:qtd_caminhao,
								:pop_at_municipio,
								:pedido_altera,
								:em_analise,
								:resp_homolog,
								:dt_analise,
								:dt_ultima_alteracao);";
        $result = $con->prepare($sql);
        $dataHoje = date("Y-m-d H:i:s");
        $status = 0;
        $result->bindParam("data", $dataHoje);
        $result->bindParam("status", $status);
        $result->bindParam("id_municipio", $dadosPmda[0]['id_municipio']);
        $result->bindParam("acoes", $dadosPmda[0]['acoes']);
        $result->bindParam("qtd_caminhao", $dadosPmda[0]['qtd_caminhao']);
        $result->bindParam("pop_at_municipio", $dadosPmda[0]['pop_at_municipio']);
        $result->bindParam("pedido_altera", $dadosPmda[0]['pedido_altera']);
        $result->bindParam("em_analise", $dadosPmda[0]['em_analise']);
        $result->bindParam("resp_homolog", $dadosPmda[0]['resp_homolog']);
        $result->bindParam("dt_analise", $dadosPmda[0]['dt_analise']);
        $result->bindParam("dt_ultima_alteracao", $dadosPmda[0]['dt_ultima_alteracao']);
        $result->execute();

        return $con->lastInsertId();
    }

    /**
     * 
     * busca comunudades do pmda
     */
    public function buscaComunidades($id_pmda) {

        $con = Conexao::getInstance();

        $dados = array();

        $sql = "SELECT id_com_pmda,
                        id_pmda,
                        id_comunidade,
                        id_municipio,
                        id_ponto,
                        latitude,
                        longitude,
                        trecho_pav,
                        trecho_n_pav,
                        pop_atendida
                        FROM pip_pmda_comun
                        where id_pmda = " . $id_pmda;

        $result = $con->query($sql);
        //$result->execute();

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

            $dados[] = $linha;
        }

        return $dados;
    }

    /**
     * 
     * busca comunudades do pmda
     */
    public function buscaComunidadesAltera($id_pmda) {

        $con = Conexao::getInstance();

        $dados = array();

        $sql = "SELECT id_com_pmda,
                        id_pmda,
                        id_comunidade,
                        id_municipio,
                        id_ponto,
                        latitude,
                        longitude,
                        trecho_pav,
                        trecho_n_pav,
                        pop_atendida
                        FROM pip_pmda_comun_altera
                        where id_pmda = " . $id_pmda;

        $result = $con->query($sql);
        //$result->execute();

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

            $dados[] = $linha;
        }

        return $dados;
    }

    /**
     * 
     * busca representantes
     */
    public function buscaComunidadeAlteracao($id_comunidade) {

        $con = Conexao::getInstance();

        $dados = array();

        $sql = "SELECT id_pmda,
                        id_comunidade
                        FROM pip_pmda_comun_altera
                        where id_comunidade = " . $id_comunidade;

        $result = $con->query($sql);

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

            $dados[] = $linha;
        }

        return $dados;
    }

    /* duplica Comunidades */

    public function duplicaComunidades($id_pmda, $id_pmda_novo) {

        $con = Conexao::getInstance();

        $dadosComnidades = $this->buscaComunidades($id_pmda);

        $sql = "INSERT INTO pip_pmda_comun (id_pmda,
			id_comunidade,
			id_municipio,
			id_ponto,
			latitude,
			longitude,
			trecho_pav,
			trecho_n_pav,
			pop_atendida) VALUES (:id_pmda,
                                                    :id_comunidade,
                                                    :id_municipio,
                                                    :id_ponto,
                                                    :latitude,
                                                    :longitude,
                                                    :trecho_pav,
                                                    :trecho_n_pav,
                                                    :pop_atendida)";

        $result = $con->prepare($sql);

        foreach ($dadosComnidades as $key => $dados) {

            $result->bindParam("id_pmda", $id_pmda_novo);
            $result->bindParam("id_comunidade", $dados["id_comunidade"]);
            $result->bindParam("id_municipio", $dados["id_municipio"]);
            $result->bindParam("id_ponto", $dados["id_ponto"]);
            $result->bindParam("latitude", $dados["latitude"]);
            $result->bindParam("longitude", $dados["longitude"]);
            $result->bindParam("trecho_pav", $dados["trecho_pav"]);
            $result->bindParam("trecho_n_pav", $dados["trecho_n_pav"]);
            $result->bindParam("pop_atendida", $dados["pop_atendida"]);
            $result->execute();
        }

        return true;
    }

    /**
     * 
     * busca representantes
     */
    public function buscaRepresentates($id_pmda) {

        $con = Conexao::getInstance();

        $dados = array();

        $sql = "SELECT id,
                        id_comunidade,
                        nome,
                        tel,
                        endereco,
                        bairro,
                        email,
                        cpf,
                        watsapp,
                        id_pmda
                        FROM pip_representante
                        where id_pmda = " . $id_pmda;

        $result = $con->query($sql);

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

            $dados[] = $linha;
        }

        return $dados;
    }

    /* duplica Representantes */

    public function duplicaRepresentantes($id_pmda, $id_pmda_novo) {

        $con = Conexao::getInstance();

        $dadosRepresentantes = $this->buscaRepresentates($id_pmda);

        $sql = "INSERT INTO pip_representante (id_comunidade,
                                                            nome,
                                                            tel,
                                                            endereco,
                                                            bairro,
                                                            email,
                                                            cpf,
                                                            watsapp,
                                                            id_pmda)
                                                            VALUES(:id_comunidade,
                                                                        :nome,
                                                                        :tel,
                                                                        :endereco,
                                                                        :bairro,
                                                                        :email,
                                                                        :cpf,
                                                                        :watsapp,
                                                                        :id_pmda)";
        $result = $con->prepare($sql);

        foreach ($dadosRepresentantes as $key => $dados) {

            $result->bindParam("id_comunidade", $dados['id_comunidade']);
            $result->bindParam("nome", $dados['nome']);
            $result->bindParam("tel", $dados['tel']);
            $result->bindParam("endereco", $dados['endereco']);
            $result->bindParam("bairro", $dados['bairro']);
            $result->bindParam("email", $dados['email']);
            $result->bindParam("cpf", $dados['cpf']);
            $result->bindParam("watsapp", $dados['watsapp']);
            $result->bindParam("id_pmda", $id_pmda_novo);
            $result->execute();
        }

        return true;
    }

    public static function AprovaPMDA() {

        $con = Conexao::getInstance();

        $sql = "update pip_pmda set status = 7
                    where pip_pmda.data_aprov <= DATE_SUB(curdate(), INTERVAL 10 DAY)";

        $result = $con->query($sql);
        print "ok";
    }

    /* Deletar PMDA */

    public static function deletePmda($id_pmda) {

        $con = Conexao::getInstance();

        $sql = "delete from pip_pmda where id_pmda = " . $id_pmda . ";
                delete from pip_pmda_comun where id_pmda = " . $id_pmda . " and id_com_pmda > 0;
                delete from pip_anexo where id_pmda = " . $id_pmda . " and id > 0;
                delete from pip_pmda_alteracao where id_pmda = " . $id_pmda . " and id_pmda_altera > 0;
                delete from pip_pmda_coment where id_pmda = " . $id_pmda . " and id_coment > 0;
                delete from pip_pmda_msg where id_pmda = " . $id_pmda . " and id > 0;";

        $result = $con->query($sql);
        return true;
    }

    /* total de processos */

    public static function processos() {

        $con = Conexao::getInstance();

        $res = array();

        $sql = "SELECT year(DATA), status, COUNT(distinct(id_municipio)) as total 
                    FROM pip_pmda
                    WHERE year(DATA)= year(NOW())
                    and status in(0,2,4,5)
                    GROUP BY year(DATA), status";

        $sql1 = "SELECT year(DATA), estado, COUNT(estado) as total 
                    FROM pip_pmda
                    WHERE year(DATA)= year(NOW())
                    and status in(0,2,4,5)
                    GROUP BY year(DATA), estado";

        $sql2 = "SELECT year(DATA), STATUS, COUNT(id_municipio) as total FROM pip_pmda
                    GROUP BY year(DATA)";

        $result = $con->query($sql);
        $result1 = $con->query($sql1);
        $result2 = $con->query($sql2);


        $dados = $result->fetchAll(PDO::FETCH_ASSOC);
        $dados1 = $result1->fetchAll(PDO::FETCH_ASSOC);
        $dados2 = $result2->fetchAll(PDO::FETCH_ASSOC);

        foreach ($dados as $key => $value) {
            if ($value['status'] == 0) {
                $res[0]['emEdicao'] = $value['total'];
            } elseif ($value['status'] == 2) {
                $res[0]['emAnalise'] = $value['total'];
            } elseif ($value['status'] == 4) {
                $res[0]['aprovado'] = $value['total'];
            } elseif ($value['status'] == 5) {
                //$res['atendido'][0] = $value['total'];
            }
        }


        foreach ($dados1 as $key => $value) {
            if ($value['estado'] == 'Em Atendimento') {
                $res[1]['emAtendimento'] = $value['total'];
            }
        }

        return $res;
    }

    /* lista por status */

    public static function listaprocessosporstatus(array $param) {
        
       
        $ano    = isset($param['ano'])    ? " AND YEAR(DATA) = '".$param['ano']."' "  : '';
        $status = isset($param['status']) ? " AND pip_pmda.status = ".$param['status']." " : '';
        
        if(isset($param['estado'])) {
            $status = "";
            $estado = " AND pip_pmda.estado = 'Em Atendimento' ";
        }else {
            $estado = '';
        }
                
        
        $con = Conexao::getInstance();

        $sql = "SELECT pip_pmda.id_pmda,
                pip_pmda.data,
                pip_pmda.id_municipio,
                cedec_municipio.nome,
                pip_pmda.status,
                pip_pmda.estado,
                pip_pmda.dt_analise,
                pip_pmda.data_aprov
                FROM pip_pmda
                INNER JOIN
                cedec_municipio
                ON pip_pmda.id_municipio = cedec_municipio.id_municipio
                WHERE pip_pmda.id_municipio <> '7221' ".$status.$ano.$estado." 
                    order by cedec_municipio.nome";
       
        $result = $con->query($sql);

        $dados = $result->fetchAll(PDO::FETCH_ASSOC);
        
        return $dados;
    }

}

?>
