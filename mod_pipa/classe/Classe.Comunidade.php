<?php

class Comunidade extends Log {

    function cadastroComunidade($nome, $id_rota) {

        try {

            $con = Conexao::getInstance();

            $sql = 'INSERT INTO pip_comunidade (comunidade, id_rota) VALUES (:nome, :idRota)';

            $result = $con->prepare($sql);

            $result->bindValue(":placa", $_placa);
            $result->bindValue(":placa", $id_rota);

            $result->execute();

            #@ grava Log
            Log::GravaLog($sql, "pip_log");

            return true;
        } catch (Exception $e) {

            print FuncaoBase::getError($e->getMessage(), 'Mensagem');
        }
    }

    #@ Alterar Cadastro Caminhao

    function AlteraComunidade($_nome,
            $id_rota,
            $_id_comunidade) {

        $con = Conexao::getInstance();

        try {

            $sql = "UPDATE pip_comunidade SET 
                                comunidade        = :comunidade,
                                id_rota       = :id_rota
                                WHERE id_comunidade = :id_comunidade";

            $result = $con->prepare($sql);

            $result->bindValue(":comunidade", $_nome);
            $result->bindValue(":id_rota", $id_rota);
            $result->bindValue(":id_comunidade", $_id_comunidade);

            $result->execute();

            #@ grava Log
            //Log::GravaLog($sql, "pip_log");	

            return true;
        } catch (Exception $e) {

            print FuncaoBase::getError($e->getMessage(), 'Mensagem');
        }
    }

    #@ Adicionar comunidade em uma rota

    function AddComunidade($_id_comunidade, $_id_rota = false) {

        $con = Conexao::getInstance();

        try {

            $sql = "UPDATE pip_comunidade SET
                                id_rota        = :id_rota
                                WHERE id_comunidade = :id_comunidade";

            $result = $con->prepare($sql);

            $result->bindValue(":id_rota", $_id_rota);
            $result->bindValue(":id_comunidade", $_id_comunidade);

            $result->execute();

            #@ grava Log
            Log::GravaLog($sql, "pip_log");

            return true;
        } catch (Exception $e) {

            print FuncaoBase::getError($e->getMessage(), 'Mensagem');
        }
    }

    #@ busca comunidade 

    function buscaComunidade($_comunidade) {

        $dados = array();

        $con = Conexao::getInstance();

        try {

            $sql = "SELECT id_comunidade,
    							comunidade,
    							id_rota
    							FROM pip_comunidade
    							WHERE comunidade like :comunidade";

            $result = $con->prepare($sql);

            $result->bindValue(":comunidade", '%' . $_comunidade . '%');

            $result->execute();

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

                $dados[] = $linha;
            }

            return $dados;
        } catch (Exception $e) {

            print FuncaoBase::getError($e->getMessage(), 'Mensagem');
        }
    }

    #@ busca comunidade nome extato.

    function buscaComunidadeExato($_comunidade) {

        $dados = array();

        $con = Conexao::getInstance();

        try {

            $sql = "SELECT id_comunidade,
    							comunidade,
    							id_rota
    							FROM pip_comunidade
    							WHERE comunidade = :comunidade";

            $result = $con->prepare($sql);
            $result->bindParam(":comunidade", $_comunidade, PDO::PARAM_STR);
            $result->execute();

            $row = $result->rowCount();

            if ($row > 0) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {

            print FuncaoBase::getError($e->getMessage(), 'Mensagem');
        }
    }

    #@ busca comunidade ID

    public static function buscaComunidadeId($_id) {

        $dados = array();

        $con = Conexao::getInstance();

        try {

            $sql = "SELECT id_comunidade,
    							comunidade,
    							id_rota
    							FROM pip_comunidade
    							WHERE id_comunidade = :id_comunidade";

            $result = $con->prepare($sql);

            $result->bindValue(":id_comunidade", $_id);

            $result->execute();

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

                $dados = $linha;
            }

            return $dados;
        } catch (Exception $e) {

            print FuncaoBase::getError($e->getMessage(), 'Mensagem');
        }
    }

    #@ busca comunidade já cadastrada no PMDA.

    function buscaComunidaPmda($dados) {

        $con = Conexao::getInstance();

        try {
            
            $sql = 'SELECT pip_pmda_comun.id_com_pmda
                        from pip_pmda_comun
                            inner join pip_pmda
                            on pip_pmda_comun.id_pmda = pip_pmda.id_pmda
                                    WHERE pip_pmda.status in ("0","1","2","4")
                                    AND pip_pmda_comun.id_comunidade = :id_comunidade';

//            $sql = "SELECT id_com_pmda
//                from pip_pmda_comun
//		WHERE id_pmda = :id_pmda
//		AND id_comunidade = :id_comunidade";

            $result = $con->prepare($sql);
            $result->bindValue(":id_comunidade", $dados['id_comunidade']);
            $result->execute();

            $row = $result->rowCount();

            if ($row > 0) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {

            print FuncaoBase::getError($e->getMessage(), 'Mensagem');
        }
    }

    #@ busca comunidade já cadastrada para Deletar

    function buscaComunidadeDelete($id_comunidade) {

        $con = Conexao::getInstance();

        try {

            $sql = "SELECT id_com_pmda from pip_pmda_comun
							WHERE id_comunidade = :id_comunidade";

            $result = $con->prepare($sql);
            $result->bindValue(":id_comunidade", $id_comunidade);
            $result->execute();

            $row = $result->rowCount();

            //var_dump($row);

            if ($row > 0) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {

            print FuncaoBase::getError($e->getMessage(), 'Mensagem');
        }
    }

    /**
     * Busca comunidades de Rota
     * @param unknown $_comunidade
     * @return mixed[]
     */
    function buscaComunidadeRota($id_rota) {

        $dados = array();

        $con = Conexao::getInstance();

        try {

            $sql = "SELECT id_comunidade,
    							comunidade,
    							id_rota
    							FROM pip_comunidade
    							WHERE id_rota = :id_rota";

            $result = $con->prepare($sql);

            $result->bindValue(":id_rota", $id_rota);

            $result->execute();

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

                $dados[] = $linha;
            }

            return $dados;
        } catch (Exception $e) {

            print FuncaoBase::getError($e->getMessage(), 'Mensagem');
        }
    }

    #@ busca caminhao com base no id

    function buscaCaminhao_id($_id) {

        $dados = array();

        $con = Conexao::getInstance();

        try {

            $sql = 'SELECT * FROM pip_caminhao WHERE id_caminhao = :id';

            $result = $con->prepare($sql);

            $result->bindValue(":id", $_id);

            $result->execute();

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

                $dados[] = $linha;
            }

            return $dados;
        } catch (Exception $e) {

            print FuncaoBase::getError($e->getMessage(), 'Mensagem');
        }
    }

    #@ busca dos caminhoes dos pipeiros baseado no cpf

    function buscaCaminhaoPipeiro($_cpf = false, $_placa = false) {

        if ($_cpf != false) {

            $opcao = 'm.cpf_cnpj = "' . $_cpf . '"';
        } elseif ($_placa != false) {

            $opcao = 'c.placa = "' . $_placa . '"';
        }

        $dados = array();

        $con = Conexao::getInstance();

        try {

            $sql = 'select c.placa, c.capacidade, m.nome, m.cpf_cnpj, c.id_caminhao, m.id_motorista
    						from pip_motorista m
    						inner join pip_caminhao c
    						on m.id_motorista = c.id_motorista
    						where ' . $opcao;

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

                $dados[] = $linha;
            }

            return $dados;
        } catch (Exception $e) {

            print FuncaoBase::getError($e->getMessage(), 'Mensagem');
        }
    }

    #@ retorna um select com as placas do caminhoes

    function PegaCaminhao() {

        $con = Conexao::getInstance();

        try {

            $sql = 'SELECT placa FROM pip_caminhao';

            $result = $con->query($sql);

            print '<select name="placa" id="placa">
    					<option></option>';

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

                print '<option>' . $linha['placa'] . '</option>';
            }

            print '</select>';
        } catch (Exception $e) {

            print FuncaoBase::getError($e->getMessage(), 'Ocorreu um erro !');
        }
    }

    #@ retorna o id dos caminhoes baseado no id_motorista

    function buscaIdCaminhaoIdPipeiro($id_pipeiro) {

        $dados = array();

        $con = Conexao::getInstance();

        try {

            $sql = "select id_caminhao 
    					from pip_caminhao 
    					where id_motorista = :id_pipeiro";

            $result = $con->prepare($sql);

            $result->bindValue(":id_pipeiro", $id_pipeiro);

            $result->execute();

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

                $dados = $linha['id_caminhao'];
            }

            return $dados;
        } catch (Exception $e) {

            print FuncaoBase::getError($e->getMessage(), 'Mensagem');
        }
    }

    /**
     * Update situacao do caminhao
     * @param $id_caminhao
     * 
     * 
     */
    public static function updateStatusCaminhao($id_camimhao) {

        $con = Conexao::getInstance();

        try {

            $sql = "UPDATE pip_caminhao SET situacao = 'A' WHERE id_caminhao = :id_caminhao";

            $result = $con->prepare($sql);

            $result->bindValue(":id_caminhao", $id_camimhao);

            $result->execute();

            return true;
        } catch (Exception $e) {

            print FuncaoBase::getError($e->getMessage(), 'Mensagem');
        }
    }

    /**
     *  
     * 
     * @param string $id_pmda
     */
    public function dadosComunidade($id_pmda = null) {

        $con = Conexao::getInstance();

        try {

//             if(is_null($id_municipio))

            /* $sql = "SELECT comunidade from pip_comunidade";

              $result = $con->prepare($sql);

              $result->bindValue(":id_caminhao", $id_camimhao);

              $result->execute(); */

            return true;
        } catch (Exception $e) {

            print FuncaoBase::getError($e->getMessage(), 'Mensagem');
        }
    }

    /**
     * 
     * Lista as comunidades do municipio
     * @param $id_municipio int
     * 
     */
    public function buscaComunidadeMunicipio($id_municipio) {

        $con = Conexao::getInstance();

        $dados = array();

        try {

//    		$sql = "SELECT id_comunidade,
//							 comunidade
//								 FROM pip_comunidade
//									WHERE id_municipio = :id_municipio
//    									AND tipo_cad = 'Ativo'";

            $sql = "select pip_pmda.id_pmda,
                    pip_pmda.status,
                    pip_pmda_comun.id_comunidade,
                    pip_comunidade.comunidade
                    from pip_pmda
                    inner join pip_pmda_comun
                    on pip_pmda_comun.id_pmda = pip_pmda.id_pmda
                    inner join pip_comunidade
                    on pip_pmda_comun.id_comunidade = pip_comunidade.id_comunidade
                    where pip_pmda_comun.id_municipio = '" . $id_municipio . "'
                    order by pip_pmda.id_pmda";

            $result = $con->prepare($sql);

            $result->bindParam(":id_municipio", $id_municipio, PDO::PARAM_INT);

            $result->execute();

            //var_dump($result->rowCount());

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
     * Lista as comunidades do municipio disponiveis para adicionar no pmda
     * @param $id_municipio int
     * 
     */
    public function listaComunidadeParaPmda($id_municipio, $comunidade) {

        $con = Conexao::getInstance();

        $dadosComMun = array();

        try {

            # seleciona as comuidades do municipio com base no municipio e nome
            $sqlComMun = "select pip_comunidade.id_comunidade,
                            pip_comunidade.comunidade as nome
                            from pip_comunidade
                            where pip_comunidade.comunidade like '%" . $comunidade . "%'
                            and pip_comunidade.tipo_cad = 'Ativo'
                            and pip_comunidade.id_municipio = " . $id_municipio . ";";

            $resultComMun = $con->query($sqlComMun);
            while ($linha = $resultComMun->fetch(PDO::FETCH_ASSOC)) {
                $dadosComMun[] = $linha;
            }

            print json_encode($dadosComMun);
            
        } catch (Exception $e) {

            print FuncaoBase::getError($e->getMessage(), 'Mensagem');
        }
    }

    /**
     * Cadastra de comunidade 
     * @param array
     * @param [0] = nome Comunidade
     * @param [1] = id_municipio
     * 
     * 
     */
    public function cadComunidade($dados) {

        try {

            $con = Conexao::getInstance();

            $sql = "insert into pip_comunidade (comunidade,
												id_municipio,
												tipo_cad,
												origem_cad)
													values (:comunidade,
															:id_municipio,
															:tipo_cad,
															:origem_cad)";

            $result = $con->prepare($sql);
            $result->bindValue(":comunidade", strtoupper(FuncaoBase::tirarAcentos($dados['txtComunidade'])), PDO::PARAM_STR);
            $result->bindParam(":id_municipio", $dados['id_municipio'], PDO::PARAM_INT);
            $result->bindParam(":tipo_cad", $dados['tipo_cad']);
            $result->bindParam(":origem_cad", $dados['origem_cad']);
            $result->execute();

            return true;
        } catch (Exception $e) {

            print $e->getMessage() . 'erro insert';
        }
    }

    /**
     * Cadastra de comunidade
     *
     *
     */
    public function delete($id_comunidade) {

        try {

            $con = Conexao::getInstance();

            $sql = "DELETE FROM pip_comunidade WHERE id_comunidade = :id_comunidade";

            $result = $con->prepare($sql);
            $result->bindParam(":id_comunidade", $id_comunidade);
            $result->execute();

            return true;
        } catch (Exception $e) {

            print $e->getMessage();
        }
    }

    /**
     * 
     * 
     * 
     */
    public function listaComunidadePreCadastro($id_municipio) {


        $dados = array();

        try {

            $con = Conexao::getInstance();

            $filtro = ($id_municipio == null) ? "" : "where pip_comunidade.id_municipio = " . $id_municipio . "";

            $sql = "select pip_comunidade.id_comunidade as id_comunidade,
							pip_comunidade.comunidade as comunidade,
							pip_comunidade.tipo_cad as tipo_cad,
							cedec_municipio.nome as municipio,
							pip_comunidade.id_user_validador
								from pip_comunidade
									inner join cedec_municipio
										on pip_comunidade.id_municipio = cedec_municipio.id_municipio
											" . $filtro . "
												order by cedec_municipio.nome, pip_comunidade.comunidade desc";

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

                $dados[] = $linha;
            }

            return $dados;
        } catch (Exception $e) {

            print $e->getMessage() . "erro lista pre-cadastro";
        }
    }

    /*
     * 
     * 
     */

    public function efetivaCom($id_comunidade, $id_usuario) {

        $con = Conexao::getInstance();

        $sql = "update pip_comunidade 
					set tipo_cad = 'Ativo',
					id_user_validador = :id_usuario
						where id_comunidade = :id_comunidade";

        $result = $con->prepare($sql);
        $result->bindParam(":id_comunidade", $id_comunidade);
        $result->bindParam(":id_usuario", $id_usuario);
        $result->execute();

        return true;
    }

}

?>