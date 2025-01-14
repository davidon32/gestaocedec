<?php

require_once PATH . '/core/Model/UsuarioModel.php';

class Usuario extends UsuarioModel {

    static public $_dLog;

    /**
     *  Cadastro de Usuario faz insert na tabela CEDEC_USUARIO
     *  @param integer $_id_deposito
     *  @param String  $_nome
     *  @param integer $_id_deposito,
     *  @param String  $_nome,
     *  @param String  $_senha, 
     *  @param String  $_email, 
     *  @param integer $_nivel, 
     *  @param integer $_situacao, 
     *  @param String  $_login, 
     *  @param integer $_m_deposito, 
     *  @param integer $_m_pipa, 
     *  @param integer $_m_cce, 
     *  @param integer $_m_decretacao, 
     *  @param integer $_m_comdec, 
     *  @param integer $_m_apoio, 
     *  @param integer $_m_poco, 
     *  @param integer $_m_escola, 
     *  @param integer $_trsenha, 
     *  @param String  $_cpf, 
     *  @param integer $_id_funcionario
     *  @param integer $usuarioAdmin
     *  @return true;
     */
    function CadastraUsuarioCedec($_id_deposito, $_nome, $_senha, $_email, $_nivel, $_situacao, $_login, $_m_deposito, $_m_pipa, $_m_cce, $_m_decretacao, $_m_comdec, $_m_apoio, $_m_poco, $_m_escola, $_trsenha, $_cpf, $_id_funcionario, $usuarioAdmin) {

        try {

            $con = Conexao::getInstance();

            $sql = 'INSERT INTO cedec_usuario (id_deposito,
												nome,
												senha,
												email,
												nivel,
												situacao,
												login,
												m_deposito,
												m_pipa,
												m_cce,
												m_decretacao,
												m_comdec,
												m_apoio,
												m_poco,
												m_escola,
												trsenha,
												cpf,
                                                id_funcionario,
                                                cedec_admin) VALUES (:id_deposito,
																		:nome,
																		:senha,
																		:email,
																		:nivel,
																		:situacao,
																		:login,
																		:m_deposito,
																		:m_pipa,
																		:m_cce,
																		:m_decretacao,
																		:m_comdec,
																		:m_apoio,
																		:m_poco,
																		:m_escola,
																		:trsenha,
																		:cpf,
																		:id_funcionario,
																		:usuarioAdmin)';
            $result = $con->prepare($sql);

            $result->bindParam(":id_deposito", $_id_deposito, PDO::PARAM_STR);
            $result->bindParam(":nome", $_nome, PDO::PARAM_STR);
            $result->bindParam(":senha", $_senha, PDO::PARAM_STR);
            $result->bindParam(":email", $_email, PDO::PARAM_STR);
            $result->bindParam(":nivel", $_nivel, PDO::PARAM_STR);
            $result->bindParam(":situacao", $_situacao, PDO::PARAM_STR);
            $result->bindParam(":login", $_login, PDO::PARAM_STR);
            $result->bindParam(":m_deposito", $_m_deposito, PDO::PARAM_STR);
            $result->bindParam(":m_pipa", $_m_pipa, PDO::PARAM_STR);
            $result->bindParam(":m_cce", $_m_cce, PDO::PARAM_STR);
            $result->bindParam(":m_decretacao", $_m_decretacao, PDO::PARAM_STR);
            $result->bindParam(":m_comdec", $_m_comdec, PDO::PARAM_STR);
            $result->bindParam(":m_apoio", $_m_apoio, PDO::PARAM_STR);
            $result->bindParam(":m_poco", $_m_poco, PDO::PARAM_STR);
            $result->bindParam(":m_escola", $_m_escola, PDO::PARAM_STR);
            $result->bindParam(":trsenha", $_trsenha, PDO::PARAM_STR);
            $result->bindParam(":cpf", $_cpf, PDO::PARAM_STR);
            $result->bindParam(":id_funcionario", $_id_funcionario, PDO::PARAM_STR);
            $result->bindParam(":usuarioAdmin", $usuarioAdmin, PDO::PARAM_STR);

            $result->execute();

            return true;
        } catch (Exception $e) {

            print $result->debugDumpParams();

            print FuncaoBase::getError($e->getMessage(), 'Mensagem');
        }
    }

    /**

     * @param unknown $_usuario
     * @param unknown $_senha
     * @param unknown $_email_rec
     * @param unknown $_id_municipio
     * @param unknown $_trsenha
     * @param unknown $_mod_pipa
     * @param unknown $_mod_compdec
     * @param unknown $_mod_ajuda
     * @param unknown $_cpf
     * 
     */
    function CadastraUsuarioExterno($_usuario, $_senha, $_email_rec, $_id_municipio, $_trsenha, $_mod_pipa, $_mod_compdec, $_mod_ajuda, $_situacao, $_cpf, $_validade, $_tmpAnexo) {

        try {

            $con = Conexao::getInstance();

            $sql = 'INSERT INTO cedec_user_ex (usuario,
													senha,
													email_rec,
													id_municipio,
													trsenha,
													mod_pipa,
													mod_compdec,
													mod_ajuda,
													situacao,
													cpf,
													validade,
													tmpAnexo) VALUES (:usuario,
																		:senha,
																		:email_rec,
																		:id_municipio,
																		:trsenha,
																		:mod_pipa,
																		:mod_compdec,
																		:mod_ajuda,
																		:situacao,
																		:cpf,
																		:validade,
																		:tmpAnexo)';
            $result = $con->prepare($sql);

            $result->bindParam(":usuario", $_usuario, PDO::PARAM_STR);
            $result->bindParam(":senha", $_senha, PDO::PARAM_STR);
            $result->bindParam(":email_rec", $_email_rec, PDO::PARAM_STR);
            $result->bindParam(":id_municipio", $_id_municipio, PDO::PARAM_STR);
            $result->bindParam(":trsenha", $_trsenha, PDO::PARAM_STR);
            $result->bindParam(":mod_pipa", $_mod_pipa, PDO::PARAM_STR);
            $result->bindParam(":mod_compdec", $_mod_compdec, PDO::PARAM_STR);
            $result->bindParam(":mod_ajuda", $_mod_ajuda, PDO::PARAM_STR);
            $result->bindParam(":situacao", $_situacao, PDO::PARAM_STR);
            $result->bindParam(":cpf", $_cpf, PDO::PARAM_STR);
            $result->bindParam(":validade", $_validade, PDO::PARAM_STR);
            $result->bindParam(":tmpAnexo", $_tmpAnexo, PDO::PARAM_STR);

            $result->execute();

            return true;
        } catch (Exception $e) {

            //print $result->debugDumpParams();

            print FuncaoBase::getError($e->getMessage(), 'Mensagem');
        }
    }

    /**
     * Atualizacao usuario externo
     * 
     */
    public static function atuaUsuarioExterno($dados) {

        try {

            $cpf1 = str_replace(['.', '-'], "", $dados['cpf']);

            $con = Conexao::getInstance();

            $sql = "UPDATE cedec_user_ex SET 
						email_rec = :email,
						senha     = :senha,
						situacao  = :situacao,
						mod_pipa  = :mod_pipa,
						mod_compdec = :mod_compdec,
						mod_ajuda  = :mod_ajuda,
						trSenha = :trSenha,
                        cpf = :cpf,
                        reset =   :reset
						WHERE id = :id";

            $result = $con->prepare($sql);
            $result->bindParam(":email", $dados['email_rec']);
            $result->bindParam(":senha", $dados['senha']);
            $result->bindParam(":id", $dados['id_usuario']);
            $result->bindParam(":situacao", $dados['txtSituacao']);
            $result->bindParam(":mod_pipa", $dados['ck_pmda']);
            $result->bindParam(":mod_compdec", $dados['ck_compdec']);
            $result->bindParam(":mod_ajuda", $dados['ck_ajuda']);
            $result->bindParam(":trSenha", $dados['trSenha']);
            $result->bindParam(":cpf", $cpf1);
            $result->bindParam(":reset", $dados['reset']);
            $result->execute();

            return true;
            //return Log::Log_reg("email_rec ".$dados['email_rec']." id_user_ex ".$dados['id_usuario']." reset senha");
        } catch (Exception $e) {
            print FuncaoBase::getError($e->getMessage(), 'Mensagem');
        }
    }

    /**
     * Atualizacao usuario externo
     *
     */
    public function desabilitarUsuario($id_municipio) {

        try {

            $con = Conexao::getInstance();

            $sql = "UPDATE cedec_user_ex SET
						situacao  = 'DESATIVADO'
							WHERE id_municipio = " . $id_municipio . " 
								and situacao != 'CADASTRO_RECUSADO'";

            $result = $con->query($sql);
            //$result->execute();

            return true;
        } catch (Exception $e) {
            print FuncaoBase::getError($e->getMessage(), 'Mensagem');
        }
    }

    /**
     * desativa registro tabela funcionario 
     *
     */
    public function desabilitarFuncionario($dados) {

        try {

            $con = Conexao::getInstance();

            $sql = "UPDATE cedec_funcionario SET
			situacao  = " . $dados['situacao'] . "
                            WHERE id_funcionario = " . $dados['id_funcionario'];

            $result = $con->query($sql);
            //$result->execute();

            return true;
        } catch (Exception $e) {
            print FuncaoBase::getError($e->getMessage(), 'Mensagem');
        }
    }

    /**
     * Cadastro de permissao módulo pipa
     * 
     * * @param integer $_login
     * @param integer $_cad_pipeiro
     * @param integer $_cad_motorista
     * @param integer $_cad_caminhao
     * @param integer $_cad_contrato
     * @param integer $_cad_acerto
     * @param integer $_rel_rpa
     * @param integer $_rel_bb
     * @param integer $_rel_imposto
     * @param integer $_rel_cadastro
     * @param integer $_rel_contrato
     * @param integer $_cad_rota
     * @param integer $_rel
     * @param integer $_rel_conf
     * @param integer $_rel_conf_pg
     * @param integer $_rel_falt_pg
     * @param integer $_rel_pg
     * @param integer $_rel_cons
     * @param integer $_cad_conta
     * @param integer $_sub_cadastro
     * @param integer $_sub_relatorio
     * @param integer $_rel_resumo
     * @param integer $_pmda
     * @return true 
     */
    function CadastrarPermissaoPipa($_login, $_cad_pipeiro, $_cad_motorista, $_cad_caminhao, $_cad_contrato, $_cad_acerto, $_rel_rpa, $_rel_bb, $_rel_imposto, $_rel_cadastro, $_rel_contrato, $_cad_rota, $_rel_conf, $_rel_conf_pg, $_rel_falt_pg, $_rel_pg, $_rel_cons, $_cad_conta, $_sub_cadastro, $_sub_relatorio, $_rel_resumo, $_pmda) {

        try {

            $con = Conexao::getInstance();

            $sql = 'INSERT INTO pip_permissao (login,
												cad_pipeiro,
												cad_motorista,
												cad_caminhao,
												cad_contrato,
												acerto,
												rel_rpa,
												rel_bb,
												rel_imposto,
												rel_cadastro,
												rel_contrato,
												cad_rota,
												rel_conf,
												rel_conf_pg,
												rel_falta_pg,
												rel_pg,
												rel_cons,
												cad_conta,
												sub_cadastro,
												sub_relatorio,
												rel_resumo,
												pmda)
												VALUES (:login,
														:cad_pipeiro,
														:cad_motorista,
														:cad_caminhao,
														:cad_contrato,
														:acerto,
														:rel_rpa,
														:rel_bb,
														:rel_imposto,
														:rel_cadastro,
														:rel_contrato,
														:cad_rota,
														:rel_conf,
														:rel_conf_pg,
														:rel_falt_pg,
														:rel_pg,
														:rel_cons,
														:cad_conta,
														:sub_cadastro,
														:sub_relatorio,
														:rel_resumo,
														:pmda)';
            $result = $con->prepare($sql);
            $result->bindValue(":login", $_login);
            $result->bindValue(":cad_pipeiro", $_cad_pipeiro);
            $result->bindValue(":cad_motorista", $_cad_motorista);
            $result->bindValue(":cad_caminhao", $_cad_caminhao);
            $result->bindValue(":cad_contrato", $_cad_contrato);
            $result->bindValue(":acerto", $_cad_acerto);
            $result->bindValue(":rel_rpa", $_rel_rpa);
            $result->bindValue(":rel_bb", $_rel_bb);
            $result->bindValue(":rel_imposto", $_rel_imposto);
            $result->bindValue(":rel_cadastro", $_rel_cadastro);
            $result->bindValue(":rel_contrato", $_rel_contrato);
            $result->bindValue(":cad_rota", $_cad_rota);
            $result->bindValue(":rel_conf", $_rel_conf);
            $result->bindValue(":rel_conf_pg", $_rel_conf_pg);
            $result->bindValue(":rel_falt_pg", $_rel_falt_pg);
            $result->bindValue(":rel_pg", $_rel_pg);
            $result->bindValue(":rel_cons", $_rel_cons);
            $result->bindValue(":cad_conta", $_cad_conta);
            $result->bindValue(":sub_cadastro", $_sub_cadastro);
            $result->bindValue(":sub_relatorio", $_sub_relatorio);
            $result->bindValue(":rel_resumo", $_rel_resumo);
            $result->bindValue(":pmda", $_pmda);

            $result->execute();

            //return true;
        } catch (Exception $e) {

            print $e->getMessage();
            die();
        }
    }

    /**
     * Cadastro de permissao módulo CCE
     * 
     * @param integer $_login
     * @param integer $_cad_evento
     * @param integer $_cad_consulta
     * @param integer $_cad_rel
     * @param integer $_rel_resumo
     * @param integer $_rel_tp_evento
     * @param integer $_cad_diario
     * @return true 
     */
    function CadastrarPermissaoCce($_login, $_cad_evento, $_cad_consulta, $_cad_rel, $_rel_resumo, $_rel_tp_evento, $_cad_diario) {

        try {

            $con = Conexao::getInstance();

            $sql = 'INSERT INTO cce_permissao (login,
	                                                cad_evento,
	                                                cad_consulta,
	                                                cad_rel,
	                                                rel_resumo,
	                                                rel_tp_evento,
	                                                cad_diario)
	                                                VALUES (:login,
	                                                        :cad_evento,
	                                                        :cad_consulta,
	                                                        :cad_rel,
	                                                        :rel_resumo,
	                                                        :rel_tp_evento,
	                                                        :cad_diario)';

            $result = $con->prepare($sql);

            $result->bindParam(":login", $_login);
            $result->bindParam(":cad_evento", $_cad_evento);
            $result->bindParam(":cad_consulta", $_cad_consulta);
            $result->bindParam(":cad_rel", $_cad_rel);
            $result->bindParam(":rel_resumo", $_rel_resumo);
            $result->bindParam(":rel_tp_evento", $_rel_tp_evento);
            $result->bindParam(":cad_diario", $_cad_diario);

            $result->execute();

            return true;
        } catch (Exception $e) {

            print $e->getMessage();
        }
    }

    /**
     * Cadastro de permissao módulo Ajuda Humanitária
     * @param integer $_usuario,
     * @param integer $_sel_nivel,
     * @param integer $_ck_cad_material,
     * @param integer $_ck_cad_pagamento,
     * @param integer $_ck_cad_transferencia,
     * @param integer $_ck_cad_liberacao,
     * @param integer $_ck_cad_ajuda_suporte,
     * @param integer $_ck_cad_usuario,
     * @param integer $_ck_cad_conf_ger,
     * @param integer $_ck_relatorio,
     * @param integer $_ck_rel_saldo_geral,
     * @param integer $_ck_rel_saldo_p_deposito,
     * @param integer $_ck_liberacao,
     * @param integer $_ck_rel_comp_liberacao,
     * @param integer $_ck_rel_mat_liberado,
     * @param integer $_ck_rel_mat_pago,
     * @param integer $_ck_rel_comp_mat_pago,
     * @param integer $_ck_transferencia,
     * @param integer $_ck_rel_mat_transferido,
     * @param integer $_ck_rel_mat_transito,
     * @param integer $_ck_lembrete_libera,
     * @param integer $_ck_lembrete_transito,
     * @param integer $_ck_inicial,
     * @param integer $_ck_cad_deposito
     * @return boolean
     */
    function CadastrarPermissaoAjuda($_usuario, $_sel_nivel, $_ck_cad_material, $_ck_cad_pagamento, $_ck_cad_transferencia, $_ck_cad_liberacao, $_ck_cad_ajuda_suporte, $_ck_cad_usuario, $_ck_cad_conf_ger, $_ck_relatorio, $_ck_rel_saldo_geral, $_ck_rel_saldo_p_deposito, $_ck_liberacao, $_ck_rel_comp_liberacao, $_ck_rel_mat_liberado, $_ck_rel_mat_pago, $_ck_rel_comp_mat_pago, $_ck_transferencia, $_ck_rel_mat_transferido, $_ck_rel_mat_transito, $_ck_lembrete_libera, $_ck_lembrete_transito, $_ck_inicial, $_ck_cad_deposito) {

        try {

            $con = Conexao::getInstance();

            $sql = 'INSERT INTO aju_permissao (login,
												nivel,
												cad_material,
												cad_pagamento,
												cad_transferencia,
												cad_liberacao,
												cad_ajuda_suporte,
												cad_usuario,
												cad_conf_ger,
												relatorio,
												rel_saldo_geral,
												rel_saldo_p_deposito,
												liberacao,
												rel_comp_liberacao,
												rel_mat_liberado,
												rel_mat_pago,
												rel_comp_mat_pago,
												transferencia,
												rel_mat_transferido,
												rel_mat_transito,												
												lembrete_libera,
												lembrete_transito,
												inicial,
												cad_deposito)
												VALUES (' . $_usuario . ',
														' . $_sel_nivel . ',
														' . $_ck_cad_material . ',
														' . $_ck_cad_pagamento . ',
														' . $_ck_cad_transferencia . ',
														' . $_ck_cad_liberacao . ',
														' . $_ck_cad_ajuda_suporte . ',
														' . $_ck_cad_usuario . ',
														' . $_ck_cad_conf_ger . ',
														' . $_ck_relatorio . ',
														' . $_ck_rel_saldo_geral . ',
														' . $_ck_rel_saldo_p_deposito . ',
														' . $_ck_liberacao . ',
														' . $_ck_rel_comp_liberacao . ',
														' . $_ck_rel_mat_liberado . ',
														' . $_ck_rel_mat_pago . ',
														' . $_ck_rel_comp_mat_pago . ',
														' . $_ck_transferencia . ',
														' . $_ck_rel_mat_transferido . ',
														' . $_ck_rel_mat_transito . ',
														' . $_ck_lembrete_libera . ',
														' . $_ck_lembrete_transito . ',
														' . $_ck_inicial . ',
														' . $_ck_cad_deposito . ')';

            $result = $con->query($sql);

            return true;
        } catch (Exception $e) {
            
        }
    }

    /**
     * Monta um dropbox com nome dos usuarios
     * @param
     * @return void
     * 
     */
    function buscaNomeUsuario() {

        try {

            $con = Conexao::getInstance();

            $sql = 'select nome, login 
				from cedec_usuario
				order by nome';

            $result = $con->query($sql);

            print '<select name="login" id="login">';

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

                print '<option>' . $linha['nome'] . '</option>';
            }
            print '</select>';
        } catch (Exception $e) {
            
        }
    }

    /**
     * Monta um dropbox com nome dos usuarios e retorna o id do usuario
     * @param 
     * @return combo com lista de usuario
     * 
     */
    function getNomeUsuarioRetId() {

        try {

            $con = Conexao::getInstance();

            $sql = 'select id_usuario, nome
			from cedec_usuario
			order by nome';

            $result = $con->query($sql);

            print '<select name="login" id="login">';
            print '<option value="0">Escolha o Usuario</option>';

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                print '<option value="' . $linha['0'] . '" name="id_usuario">' . $linha[1] . '</option>';
            }

            print '</select>';
        } catch (Exception $e) {
            
        }
    }

    /**
     * Monta um dropbox com nome dos usuarios e retorna o id do usuario
     * @param 
     * @return combo com lista de usuario
     * 
     */
    function getIdNome($situacao = "") {

        $filtro = ($situacao != "") ? "'" . $situacao . "'" : "";
        $dados = array();
        try {

            $con = Conexao::getInstance();

            $sql = 'select id_usuario, nome, login
                    from cedec_usuario 
                    where situacao = ' . $filtro . ' order by nome';

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados[] = $linha;
            }

            return $dados;
        } catch (Exception $e) {
            
        }
    }

    /**
     * funcao busca o log do usuario
     * @param String $_login
     * @return array $dados 
     * 
     */
    function buscaLog($_login) {

        $usuarioModel = new UsuarioModel();

        $usuarioModel->setLogin($_login);

        $_dados = array();

        try {

            $con = Conexao::getInstance();

            $sql = 'select login,
						dt_user,
						acao
						from pip_log
						where login = "' . $usuarioModel->getLogin() . '"
						order by dt_user';

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $_dados[] = $linha;
            }

            $usuarioModel->setDadosLog($_dados);

            return $usuarioModel->getDadosLog();
        } catch (Exception $e) {
            
        }
    }

    /**
     *  funcao retorna o nome baseado no login
     *  @param String $_login
     *  @return String nome
     */
    function getNome($_login) {

        $linha = array();

        $sql = 'select nome
				from cedec_usuario
				where login = :login';

        $result = Conexao::getInstance()->prepare($sql);

        $result->bindValue(":login", $_login);

        $result->execute();

        while ($dados = $result->fetch(PDO::FETCH_ASSOC)) {

            $linha = $dados;
        }

        return $linha['nome'];
    }

    /**
     * Retorna o nome do usuario baseado no identificador
     * @param integer $id_user - Identificador do Usuario
     * @return String $nome
     * 
     * */
    static function getNomeId($id_user) {

        $con = Conexao::getInstance();

        $linha = array();

        $sql = "select nome
		from cedec_usuario
		where id_usuario = :id_user";

        $result = $con->prepare($sql);
        $result->bindParam(":id_user", $id_user);
        $result->execute();

        while ($dados = $result->fetch(PDO::FETCH_ASSOC)) {

            $linha = $dados;
        }

        return count($linha) > 0 ? $linha['nome'] : "";
    }
    
    
    /**
     * Retorna o nome do usuario baseado no identificador
     * @param integer $id_user - Identificador do Usuario
     * @return String $nome
     * 
     * */
    static function getUserExNomeId($id_user) {

        $con = Conexao::getInstance();

        $linha = array();

        $sql = "select cedec_user_ex.usuario,
                cedec_municipio.nome as nome_municipio,
                cedec_rpm_mun.nome as rpm
		from cedec_user_ex
                inner join cedec_municipio
                on cedec_user_ex.id_municipio = cedec_municipio.id_municipio
                inner join cedec_rpm_mun
                on cedec_municipio.id_municipio = cedec_rpm_mun.id_municipio
		where cedec_user_ex.id = :id_user";

        $result = $con->prepare($sql);
        $result->bindParam(":id_user", $id_user);
        $result->execute();

        while ($dados = $result->fetch(PDO::FETCH_ASSOC)) {

            $linha = $dados;
        }

        return $linha;
    }
    
    
    /**
     * Função para retornar o login com base no nome
     * @param  String $_nome - nome do usuario
     * @return String $login
     * */
    function buscaLoginUsuario($_nome) {

        try {

            $dados = array();

            $con = Conexao::getInstance();

            $sql = 'select login
			from cedec_usuario
			where nome = "' . $_nome . '"';

            $result = $con->query($sql);

            while ($linha = $con->fetch(PDO::FETCH_BOTH)) {

                $dados = $linha;
            }

            return $linha[0];
        } catch (Exception $e) {
            
        }
    }

    /**
     * Função para retornar o Id do Usuário
     *  
     * @param $login - login de usuario
     * @return id_usuario
     * */
    public static function getIdUsuario($login) {

        try {

            $con = Conexao::getInstance();

            $dados = array();

            $sql = 'SELECT id_usuario
					FROM cedec_usuario
					WHERE login = "' . $login . '"';

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados = $linha;
            }

            return $dados['id_usuario'];
        } catch (Exception $e) {
            
        }
    }

    /**
     * Função para retornar o Id do Funcionario (que esta cadastrado no CEDEC_USUARIO )
     *  
     * @param $login - login de usuario
     * @return $idfuncionario
     * */
    static function getIdFuncionario($login) {

        try {

            $dados = array();

            $con = Conexao::getInstance();

            $sql = 'SELECT id_funcionario
	                FROM cedec_usuario
	                WHERE login = :login';

            $result = $con->prepare($sql);
            $result->bindParam(":login", $login);
            $result->execute();

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

                $dados = $linha;
            }

            return $dados['id_funcionario'];
        } catch (Exception $e) {

            print $e->getMessage();
        }
    }

    /**
     * Função para retornar o Id do Funcionario (que esta cadastrado no CEDEC_USUARIO )
     *  
     * @param $login - login de usuario
     * @return $idfuncionario
     * */
    static function idFuncionario($maspNumPol) {

        try {

            $dados = array();

            $con = Conexao::getInstance();

            $sql = 'SELECT id_funcionario
	                FROM cedec_funcionario
	                WHERE num_masp = :login';

            $result = $con->prepare($sql);
            $result->bindParam(":login", $maspNumPol);
            $result->execute();

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

                $dados = $linha;
            }

            return $dados['id_funcionario'];
        } catch (Exception $e) {

            print $e->getMessage();
        }
    }

    /**
     * Função para retornar o Id do Usuario Externo
     *
     * @param $login - login de usuario
     * @return $idfuncionario
     * */
    static function getIdUserEx($login) {

        $dados = array();
        try {


            $con = Conexao::getInstance();

            $sql = 'SELECT id
	                FROM cedec_user_ex
	                WHERE usuario = :login';

            $result = $con->prepare($sql);
            $result->bindValue(":login", $login);
            $result->execute();

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                if (empty($linha)) {
                    return null;
                } else {
                    $dados = $linha;
                    return $dados['id'];
                }
            }
        } catch (Exception $e) {

            print $e->getMessage();
        }
    }

    #@ funcao para pegar o id do usuario do deposito destino

    function PegaIdDepositoUsuario($depDestino) {

        try {

            $con = Conexao::getInstance();

            $sql = 'select id_usuario from cedec_usuario where id_deposito = ' . $depDestino . ' limit 1';

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados = $linha;
            }

            return $dados;
        } catch (Exception $e) {
            
        }
    }

    #@ funcao retorna dados do usuario para alteracao

    static function getDadoUsuario($id_usuario) {

        $dados = array();
        $con = Conexao::getInstance();

        $sql = 'SELECT cedec_usuario.id_usuario,
                    cedec_usuario.id_deposito,
                    cedec_usuario.nome as nome,
                    cedec_usuario.senha,
                    cedec_usuario.email_rec,
                    cedec_usuario.nivel,
                    cedec_usuario.situacao,
                    cedec_usuario.login,
                    cedec_usuario.it_m_deposito,
                    cedec_usuario.it_m_pipa,
                    cedec_usuario.it_m_cce,
                    cedec_usuario.it_m_decretacao,
                    cedec_usuario.it_m_comdec,
                    cedec_usuario.it_m_apoio,
                    cedec_usuario.it_m_poco,
                    cedec_usuario.it_m_escola,
                    cedec_usuario.id_funcionario,
                    cedec_funcionario.email as email_info1,
                    cedec_funcionario.email2 as email_info2,
                    cedec_funcionario.num_masp,
                    cedec_funcionario.secao as secao
                        FROM cedec_usuario
                            inner join cedec_funcionario
                            on cedec_usuario.id_funcionario = cedec_funcionario.id_funcionario
                                WHERE cedec_usuario.id_usuario = :id_func';

        $result = $con->prepare($sql);
        $result->bindValue(":id_func", $id_usuario);
        $result->execute();

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados = $linha;
        }


        return $dados;
    }

    #@ CPF e email usuario

    static function getCpfEmail($id_usuario) {

        $con = Conexao::getInstance();

        $sql = 'SELECT cedec_usuario.cpf,
                    cedec_usuario.email_rec as email,
                    cedec_usuario.token
                        FROM cedec_usuario
                            WHERE cedec_usuario.id_usuario = :id_func';

        $result = $con->prepare($sql);
        $result->bindValue(":id_func", $id_usuario);
        $result->execute();

        return $result->fetch();
    }

    #@ funcao retorna dados do usuario para alteracao

    public static function dadosUsuarioIdFunc($id_funcionario) {

        $con = Conexao::getInstance();

        $dados = array();

        try {

            $sql = 'SELECT id_usuario,
							id_deposito,
							nome,
							senha,
							email_rec,
							nivel,
							situacao,
							login,
							it_m_deposito,
							it_m_pipa,
							it_m_cce,
							it_m_decretacao,
							it_m_comdec,
							it_m_apoio,
							it_m_poco,
							it_m_escola
							FROM cedec_usuario
							WHERE id_funcionario = :id_funcionario';

            $result = $con->prepare($sql);
            $result->bindValue(":id_funcionario", $id_funcionario);
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
     * 
     * Dados Tabela Funcionario
     * @param int $id_usuario
     * @return array
     */
    public static function dadosFuncionario($id_funcionario) {

        $dados = array();

        $con = Conexao::getInstance();

        $sql = 'SELECT id_funcionario,
						num_masp,
						nome
						FROM cedec_funcionario
						WHERE id_funcionario = :id_funcionario';

        $result = $con->prepare($sql);
        $result->bindValue(":id_funcionario", $id_funcionario);
        $result->execute();

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados[] = $linha;
        }

        return $dados;
    }

    /**
     * Busca login Permissao existente
     * 
     */
    function buscaLogin($_login, $_modulo) {

        try {
            $con = Conexao::getInstance();

            $sql = "select login from " . $_modulo . " where login = " . $_login;

            $result = $con->query($sql);

            return ($result->rowCont() == 1) ? true : false;
        } catch (Exception $e) {
            
        }
    }

    #@ atualiza a tabela de permissao adicionando o módulo 

    function CadastraModulo($_login, $_modulo, $_permissao) {

        try {
            $con = Conexao::getInstance();

            $sql = "UPDATE cedec_usuario
					SET " . $_modulo . " = " . $_permissao . "
					WHERE login = " . $_login;

            $result = $con->query($sql);

            return true;
        } catch (Exception $e) {
            
        }
    }

    /**
     * Buscar email funcionario
     * @param identificador Tabela Funcionario
     * @return $email 
     */
    static function getEmailFuncionario($idFuncionario) {

        try {

            $dados = "";

            $con = Conexao::getInstance();

            $sql = "SELECT email FROM cedec_funcionario WHERE id_funcionario = :id_funcionario";

            $result = $con->prepare($sql);
            $result->bindParam(":id_funcionario", $idFuncionario);
            $result->execute();

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

                $dados = $linha;
            }

            return $dados['email'];
        } catch (Exception $e) {

            print $e->getMessage();
        }
    }

    /**
     * Buscar email funcionario
     * @param email
     * @return $email 
     */
    static function getEmailFuncEmail($email) {

        $dados = array();

        $email_low = strtolower($email);

        try {


            $con = Conexao::getInstance();

            $sql = "SELECT email_rec,
                            id_usuario,
                            login
                            FROM cedec_usuario
                            WHERE email_rec = :email_rec";

            $result = $con->prepare($sql);
            $result->bindParam(":email_rec", $email_low);
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
     * Buscar email usuario externo
     * @param email
     * @return $email
     */
    static function getEmailExternEmail($email) {

        $dados = "";

        try {


            $con = Conexao::getInstance();

            $sql = "SELECT email_rec, id, usuario FROM cedec_user_ex WHERE email_rec = :email";

            $result = $con->prepare($sql);
            $result->bindParam(":email", $email);
            $result->execute();

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

                $dados = $linha;
            }

            return $dados;
        } catch (Exception $e) {

            print $e->getMessage();
        }
    }

    public function reset_senha($login) {

        $con = Conexao::getInstance();

        $sql = "UPDATE cedec_usuario
                       SET senha = '32efe320d4a241dec1268bf3a8a0557d', #//gmgcedec199
                           trsenha = '1',
                           reset = null
                           WHERE login = '" . $login . "'";

        try {

            $result = $con->query($sql);

            if ($result->execute()) {

                return true;
            }
        } catch (Exception $e) {
            print FuncaoBase::getError($e->getMessage(), 'Mensagem');
        }
    }

    /**
     * Resetar Senha usuário, interno
     */
    function resetaSenha($idFuncionario = false, $email = false) {

        $con = Conexao::getInstance();

        # busca pelo email 
        if ((!empty($email)) && (empty($idFuncionario))) {

            // busca usuario interno
            $emailCad = Usuario::getEmailFuncEmail($email);

            // busca email cadastrado no sistema
            if ($email === $emailCad[0]['email_rec']) {

                $reset = strtotime(date('Y-m-d H:i:s'));

                $sql = "UPDATE cedec_usuario
		                     SET reset = '" . $reset . "',
                                         hash = '" . md5($email . $reset) . "'
		                     WHERE id_usuario = '" . $emailCad[0]['id_usuario'] . "'";

                $result = $con->query($sql);

                return ($result->execute()) ? array(true, md5($emailCad[0]['email_rec'] . $reset)) : array(false, "");
            }

            // administrador reseta senha para usuário   
        } else if ($email == false) {

            $sql = "UPDATE cedec_usuario
                           SET senha = '32efe320d4a241dec1268bf3a8a0557d', #//gmgcedec199
                               trsenha = '1'
                               WHERE id_funcionario = '" . $idFuncionario . "'";

            $result = $con->query($sql);
            return $result->execute();
        }
    }

    /**
     *  # busca email rec por municipio do usuario externo
     * @param String nome municipio
     */
    public function buscaEmailRecMunicipioUserExterno($nomeMunicipio) {
        try {

            $dados = array();
            $con = Conexao::getInstance();

            $sql = "select cedec_user_ex.email_rec, cedec_user_ex.id, cedec_user_ex.usuario,
                    cedec_municipio.nome as nome_municipio
				from cedec_user_ex
				inner join cedec_municipio
				on cedec_municipio.id_municipio = cedec_user_ex.id_municipio
				where cedec_municipio.nome ='" . $nomeMunicipio . "' limit 1";

            $result = $con->query($sql);
            //$result->bindParam(":id", $id);
            //$result->execute();

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados[] = $linha;
            }

            return $dados;
        } catch (Exception $e) {

            print $e->getMessage();
        }
    }

    /**
     *  # busca email rec por email usuario externo
     * @param String email
     */
    public function buscaEmailRecUserExterno($email) {

        try {

            $dados = array();
            $con = Conexao::getInstance();

            $sql = "select email_rec
				from cedec_user_ex
				where email_rec = '" . $email . "' limit 1";

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
     *  # busca email rec por municipio usuario interno
     * @param String email
     */
    public function buscaEmailRecUser($email) {

        try {

            $dados = array();
            $con = Conexao::getInstance();

            $sql = "select email_rec,
                            nome
				from cedec_usuario
				where email_rec = '" . $email . "' limit 1";

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
     * Buscar email Usuario Externo
     * @param identificador Tabela Funcionario
     * @return $email
     */
    static function getEmailUsuarioExterno($id) {

        try {

            $dados = "";

            $con = Conexao::getInstance();

            $sql = "SELECT email_rec,
                           usuario
                            FROM cedec_user_ex WHERE id = :id";

            $result = $con->prepare($sql);
            $result->bindParam(":id", $id);
            $result->execute();

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

                $dados = $linha;
            }

            return $dados;
        } catch (Exception $e) {

            print $e->getMessage();
        }
    }

    # dados para select nome de municipios

    function dadosSelectUsuario() {

        $con = Conexao::getInstance();

        $_dados = array();

        $sql = "SELECT id_usuario,
                       nome,
                       email_rec
                       FROM cedec_usuario
                       WHERE situacao = 1
                       ORDER BY nome";

        $result = $con->query($sql);
        $result->execute();

        while ($linha = $result->fetch(PDO::FETCH_BOTH)) {

            $_dados[] = $linha;
        }

        return $_dados;
    }

    /**
     * Resetar Senha usuário Externo
     */
    function resetaSenhaUsuarioEx(array $param) {

        $con = Conexao::getInstance();
        $retorno = array();

        $sql = "";

        if ($param['email']) {

            // busca email cadastrado no sistema
            $emailCad = Usuario::getEmailUsuarioExterno($param['id']);

            if ($param['email'] == $emailCad['email_rec']) {

                $reset = strtotime(date('Y-m-d H:i:s'));

                $sql = "UPDATE cedec_user_ex
                     SET reset = '" . $reset . "',
                     hash = '" . md5($param['email'] . $reset) . "'
                     WHERE id = '{$param['id']}'";
            }
        }

        try {

            $result = $con->query($sql);

            if ($result->execute()) {

                return array(true, md5($emailCad['email_rec'] . $reset));
            } else {
                return array(false, "");
            }
        } catch (Exception $e) {
            print FuncaoBase::getError($e->getMessage(), 'Mensagem');
        }
    }

    /**
     * Gerador de senha temporaria 
     * @return $senha
     * @param letras maiuscula e minuscula
     * 
     */
    public static function gerarSenha($case = false) {

        $lower = "";
        $upper = implode('', range('A', 'Z')); // ABCDEFGHIJKLMNOPQRSTUVWXYZ
        $nums = implode('', range(0, 9)); // 0123456789

        if ($case) {
            $lower = implode('', range('a', 'z')); // abcdefghijklmnopqrstuvwxyzy
        }

        $alphaNumeric = $upper . $nums; // ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789
        $senha = '';
        $len = 7; // numero de chars
        for ($i = 0; $i < $len; $i++) {
            $senha .= $alphaNumeric[rand(0, strlen($alphaNumeric) - 1)];
        }

        return $senha;
    }

    /**
     * Pega colunas e comentarios da tabela para montagem de formulario
     * @author Demetrio da Silva Passos
     * @param String $tabela
     * @return array $dados
     * 
     * */
    function pegaPermissao($tabela) {

        $dados = array();

        $con = Conexao::getInstance();

        $sql = "SELECT COLUMN_NAME,
                                    COLUMN_COMMENT
                                    FROM information_schema.COLUMNS
                                    WHERE TABLE_SCHEMA = 'gestaocedec'
                                    AND TABLE_NAME = '" . $tabela . "'";

        $result = $con->query($sql);

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

            $dados[] = $linha;
        }

        return $dados;
    }

    /* Busca dados do usuário
     * 
     */

    public function buscaUsuario($usuario) {
        $dados = array();

        $con = Conexao::getInstance();

        $sql = "Select id, usuario, senha, email_rec, id_municipio, trsenha, situacao, acesso
    					FROM cedec_user_ex
    						WHERE usuario like :usuario
    						or email_rec like :email_rec LIMIT 15";

        $result = $con->prepare($sql);
        $result->bindValue(":usuario", '%' . $usuario . '%');
        $result->bindValue(":email_rec", '%' . $usuario . '%');
        $result->execute();

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados[] = $linha;
        }

        return $dados;
    }

    /* Busca dados do usuário Email
     *
     */

    public function buscaUsuarioEmail($email) {
        $dados = array();

        $con = Conexao::getInstance();

        $sql = "Select id, usuario, senha, email_rec, id_municipio, trsenha, situacao, acesso
    					FROM cedec_user_ex
    						WHERE email_rec like :email LIMIT 15";

        $result = $con->prepare($sql);
        $result->bindValue(":email", '%' . $email . '%');
        $result->execute();

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados[] = $linha;
        }

        return $dados;
    }

    /* Busca dados do usuário CPF
     *
     *
     *
     */

    public static function buscaUsuarioCpf($cpf) {

        $dados = array();

        $con = Conexao::getInstance();

        $sql = "Select id, usuario, senha, email_rec, id_municipio, trsenha, situacao, acesso, cpf FROM cedec_user_ex WHERE cpf = :cpf";

        $result = $con->prepare($sql);
        $result->bindValue(":cpf", $cpf);
        $result->execute();
        
        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados = $linha;
        }

        return $dados;
    }

    /* Busca dados do usuário pelo municipio
     *
     *
     *
     */

    public function buscaUsuarioMunicipio($municipio) {

        $dados = array();

        $con = Conexao::getInstance();

        $sql = "Select cedec_user_ex.id,
    					cedec_user_ex.usuario,
    					cedec_user_ex.senha,
    					cedec_user_ex.email_rec,
    					cedec_user_ex.id_municipio,
    					cedec_user_ex.trsenha,
    					cedec_user_ex.situacao,
    					cedec_user_ex.acesso
    					FROM cedec_user_ex
    						inner join cedec_municipio
    						on cedec_user_ex.id_municipio = cedec_municipio.id_municipio
    							WHERE cedec_municipio.nome like :municipio LIMIT 15";

        $result = $con->prepare($sql);
        $result->bindValue(":municipio", '%' . $municipio . '%');
        $result->execute();

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados[] = $linha;
        }

        return $dados;
    }

    /* Busca dados Id
     *
     *
     *
     */

    static public function buscaUsuarioId($id) {
        $dados = array();

        $con = Conexao::getInstance();

        $sql = "Select id, usuario, senha, email_rec, id_municipio, trsenha, tmpAnexo, situacao,
                        cpf, mod_pipa, mod_ajuda, mod_compdec
    					FROM cedec_user_ex
    						WHERE id = :id";

        $result = $con->prepare($sql);
        $result->bindValue(":id", $id);
        $result->execute();

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados = $linha;
        }

        return $dados;
    }

    /* Busca dados Id
     *
     *
     *
     */

    public function buscaUsuarioPendente() {

        $dados = array();

        $con = Conexao::getInstance();

        $sqlUserPendente = "Select id, id_municipio, usuario, email_rec, situacao
    							FROM cedec_user_ex
    								WHERE situacao = 'PENDENTE'";

        $result = $con->query($sqlUserPendente);
        //$result->execute();

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados[] = $linha;
        }

        return $dados;
    }

    /**
     * Busca usuarios do municipio que tenham pendencia de cadastro
     * 
     */
    /* public function buscaUsuMunPendente($array){

      $dados = array();

      $sql = "Select id, usuario, senha, email_rec, id_municipio, trsenha, tmpAnexo, situacao
      FROM cedec_user_ex
      WHERE id_municipio in ".$id_municipio;

      $resultUser = $con->query($sqlUserPendente);


      while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
      $id_municipio[] = $linha;
      }

      return $dados;

      } */

    /**
     *  Lista Dados da tabela funcionarios
     *  @return array
     *  
     * */
    public function listFuncionario() {

        $dados = array();

        $con = Conexao::getInstance();

        $sql = "SELECT id_funcionario, nome
     				FROM  cedec_funcionario
     					ORDER BY nome";

        $result = $con->query($sql);
        $result->execute();

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados[] = $linha;
        }

        return $dados;
    }

    /**
     * @param string tabela
     * @param string campo
     * @param string valor
     * @return boolean
     * 
     */
    public function atualizaPermissao($tabela, $campo, $valor, $id_funcionario) {

        $con = Conexao::getInstance();

        $sql = "UPDATE " . $tabela . " SET " . $campo . " = " . $valor . "
     						WHERE id_funcionario = " . $id_funcionario;

        //var_dump($sql);

        $result = $con->query($sql);
        $result->bindValue(":tabela", $tabela);
        $result->bindValue(":campo", $campo);
        $result->bindValue(":valor", $valor);
        $result->bindValue(":id_funcionario", $id_funcionario);

        $result->execute();

        return true;
    }

    /**
     * 
     * 
     */
    public static function AtualizarUsuario($dados) {

        $con = Conexao::getInstance();

        if (isset($dados['senha'])) {
            $sql = "UPDATE cedec_usuario SET nome = :nome,
					senha = :senha,
					email_rec = :email,
					nivel = :nivel
					WHERE id_usuario = :id";
            $result = $con->prepare($sql);
            $result->bindValue(":nome", $dados['nome']);
            $result->bindValue(":senha", $dados['senha']);
            $result->bindValue(":email", $dados['email_rec']);
            $result->bindValue(":nivel", $dados['nivel']);
            $result->bindValue(":id", $dados['id_usuario']);
        } else {

            $sql = "UPDATE cedec_usuario SET nome = :nome,
					email_rec = :email,
					nivel = :nivel
					WHERE id_usuario = :id";
            $result = $con->prepare($sql);
            $result->bindValue(":nome", $dados['nome']);
            $result->bindValue(":email", $dados['email_rec']);
            $result->bindValue(":nivel", $dados['nivel']);
            $result->bindValue(":id", $dados['id_usuario']);
        }


        $result->execute();

        return true;
    }

    /**
     * atualiza nome
     * 
     */
    public static function AtualizarNomeUsuario($dados) {

        $con = Conexao::getInstance();

        $sql = "UPDATE cedec_usuario SET nome = :nome
					WHERE id_usuario = :id";

        $result = $con->prepare($sql);
        $result->bindValue(":nome", $dados['nome']);
        $result->bindValue(":id", $dados['id_usuario']);

        $result->execute();

        return true;
    }

    /**
     * Atualiza email recuperação de senha 
     * 
     */
    public function AtualizaEmail($dados) {
        $con = Conexao::getInstance();
        $sql = "UPDATE cedec_usuario SET email_rec = :email,
                                        situacao = :situacao
						WHERE id_usuario = :id";

        $result = $con->prepare($sql);
        $result->bindValue(":email", $dados['txtEmail']);
        $result->bindValue(":situacao", $dados['situacao']);
        $result->bindValue(":id", $dados['id_usuario']);
        $result->execute();

        return true;
    }

    /**
     * Atualiza email1 informacao, email2 informação, situacao
     * 
     */
    public static function AtualizaEmailInfo($dados) {

        $con = Conexao::getInstance();
        $sql = "UPDATE cedec_funcionario SET email = :email,
                                            email2 = :email2,
                                            situacao = :situacao
						WHERE id_funcionario = :id";

        $result = $con->prepare($sql);
        $result->bindValue(":email", $dados['email_info1']);
        $result->bindValue(":email2", $dados['email_info2']);
        $result->bindValue(":situacao", $dados['situacao']);
        $result->bindValue(":id", $dados['id_funcionario']);
        $result->execute();

        return true;
    }

    /**
     * 
     * @param type $usuario nome do usuario do sistema
     * @return boolean
     * 
     */
    public static function normAcesso($usuario) {

        $con = Conexao::getInstance();
        $sql = "UPDATE cedec_user_ex SET reset = '',
                    hash = ''
                    where usuario = :usuario";

        $result = $con->prepare($sql);
        $result->bindValue(":usuario", $usuario);
        $result->execute();

        return true;
    }

    /**
     *  Mensagem do Suporte do menu usuario
     *  $dados
     * gravatar	
     * id_usuario (opcional)
     * adm
     */
    static public function mensagemSuporte($dados) {

        $sql = "select ";
        $gravataremail = "";

        print "<li>";
        print "<a href='#'>";
        print "<div class='pull-left'>";
        print "<img src='.$gravataremail.' class='img-circle' alt='User Image'>";
        print "</div>";
        print "<h4>";
        print "Mensagem do Suporte";
        print "<small><i class='fa fa-clock-o'></i> 0 mins</small>";
        print "</h4>";
        print "<p>Dica: não grave sua senha nos navegadores!</p>";
        print "</a>";
        print "</li>";
    }

    /** cadastro de funcionario */
    function cadFuncionario($numPolicia, $nomeComp, $usuario, $setor, $email, $email2, $posto, $id_rpm, $secao) {

        $con = Conexao::getInstance();

        $sql = 'INSERT INTO cedec_funcionario (num_masp,
						nome,
						orgao,
						email,
                                                email2,
                                                posto,
                                                id_rpm,
                                                secao)
						VALUES("' . $numPolicia . '",
							"' . $nomeComp . '",
							"' . $setor . '",
							"' . $email . '",
							"' . $email2 . '",
                                                        "' . $posto . '",
                                                        "' . $id_rpm . '",
                                                        "' . $secao . '")';
        try {
            $result = $con->query($sql);
            return true;
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    /**
     * Busca usuario
     */
    public function getUsuario($nome) {

        $dados = array();

        $con = Conexao::getInstance();

        $sql = "Select * from cedec_usuario 
			where nome like '%" . $nome . "%'";

        $result = $con->query($sql);

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados[] = $linha;
        }
        return $dados;
    }

    /**
     *  Verifica permissao acesso
     * @param $modulo
     * @param $action
     * @param $id_usuario
     * @param $link
     */
    public static function getPermissao($modulo, $controller) {

        $usuario = isset($_COOKIE['seguranca']['login']) ? $_COOKIE['seguranca']['login'] : null;

        $dados = "";

        if (is_null($usuario)) {
            header('location: index.php');
        } else {
            $con = Conexao::getInstance();
            $sql = "select " . $controller . " from " . $modulo . " where login = '" . $usuario . "'";
        }

        $result = $con->query($sql);

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados = $linha[$controller];
        }

        $icone = "";

        return $dados;
    }

    /**
     *  Verifica permissao action
     * @param $tabela
     * @param $permissao

     */
    public static function getPermissaoAction($tabela, $permissao) {

        $usuario = isset($_COOKIE['seguranca']['login']) ? $_COOKIE['seguranca']['login'] : null;

        $dados = "";

        if (is_null($usuario)) {
            header('location: index.php');
        } else {
            $con = Conexao::getInstance();
            $sql = "select " . $permissao . " from " . $tabela . " where login = '" . $usuario . "'";
        }

        $result = $con->query($sql);

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados = $linha[$permissao];
        }

        return $dados;
    }

    /**
     *  Controle acesso funcao 
     */
    public static function Acesso($tabela, $permissao, $imagem, $link, $texto, $div = "") {

        if (self::getPermissaoAction($tabela, $permissao)) {

            print "<div " . $div . ">";

            print "<a href=\"?token=" . hash('sha256', md5(VERSAO) . date('dmY')) . $link . "\" title=\"" . $texto . "\">
                <img src=\"/core/imagem/" . $imagem . "\" width=\"80px\"><br>Entrada de Materiais
            </a>";
        } else {
            print "<div " . $div . ">";
            print "<img class=\"imgCinza\" src=\"core/imagem/" . $imagem . "\" width=\"80px\" title=\"" . $texto . "\">";
            print "<br> " . $texto;
        }
        print "</div>";
    }

    /**
     * get permissao Modulos
     * 
     */
    public static function getPermissaoModulo($login) {

        $con = Conexao::getInstance();

        $dados = "";

        $sql = "SELECT id_usuario,
		id_deposito,
		nome,
		senha,
		email_rec,
		nivel,
		situacao,
		login,
		it_m_deposito,
		it_m_pipa,
		it_m_cce,
		it_m_decretacao,
		it_m_comdec,
		it_m_apoio,
		it_m_poco,
		it_m_escola,
		trsenha,
		cpf,
		qtd_acesso,
		dias_acesso,
		id_funcionario,
		cedec_admin
			FROM cedec_usuario
			WHERE login = '" . $login . "'";

        $result = $con->query($sql);

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados = $linha;
        }


        return $dados;
    }

    /**
     * get permissao ajuda humanitaria
     * 
     */
    public static function getPermissaoAjudaH($login) {

        $con = Conexao::getInstance();

        $dados = "";

        $sql = "SELECT login,
        cad_material,
        cad_pagamento,
        cad_transferencia,
        cad_liberacao,
        cad_ajuda_suporte,
        cad_usuario,
        cad_conf_ger,
        relatorio,
        rel_saldo_geral,
        rel_saldo_p_deposito,
        liberacao,
        rel_comp_liberacao,
        rel_mat_liberado,
        rel_mat_pago,
        rel_comp_mat_pago,
        transferencia,
        rel_mat_transferido,
        rel_mat_transito,
        lembrete_libera,
        lembrete_transito,
        inicial,
        cad_deposito,
        rel_cad_mat,
        rel_resumo_liberacao,
        pedido_ajuda,
        controle_estoque,
        cancLibPaga,
        cancela_transf,
        entrada_nota,
        tdap
		FROM aju_permissao
		WHERE login = '" . $login . "'";

        $result = $con->query($sql);

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados = $linha;
        }


        return $dados;
    }

    /**
     * get permissao ajuda humanitaria
     * 
     */
    public static function getPermissaoPip($login) {

        $con = Conexao::getInstance();

        $dados = "";

        $sql = "SELECT login,
        pmda,
        pmda_operador
		FROM pip_permissao
		WHERE login = '" . $login . "'";

        $result = $con->query($sql);

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados = $linha;
        }


        return $dados;
    }

    /**
     * get permissao ajuda estoque novo
     * 
     */
    public static function getPermissaoEstoque($login) {

        $con = Conexao::getInstance();

        $dados = "";

        $sql = "SELECT id_permissao,
                login,
                nivel,
                re_inventario,
                id_usuario,
                entrada_nota,
                cancela_entrada_nota,
                pedido,
                cancela_pedido,
                montagem_carga,
                cancela_mont_carga,
                modulo,
                cad_principal,
                movimentacao,
                relatorios,
                separar,
                transferencia
                FROM aju_cpermissao
		WHERE login = '" . $login . "'";

        $result = $con->query($sql);

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados = $linha;
        }


        return $dados;
    }

    /**
     * get permissao estoque  cedec
     * 
     */
    public static function getPermissaoCedec($login) {

        $con = Conexao::getInstance();

        $dados = "";

        $sql = "SELECT id_permissao,
                        login,
                        arquivo,
                        prefeitura,
                        cad_prefeitura,
                        alterar_prefeitura,
                        municipio,
                        cad_municipio,
                        alterar_municipio,
                        info_municipio,
                        relatorio,
                        permissao_usuario,
                        defesa_agora,
                        ger_demanda
                            FROM cedec_permissao
                            WHERE login = '" . $login . "'";

        $result = $con->query($sql);

        print($sql);

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados = $linha;
        }


        return $dados;
    }

    /**
     * get permissao Compdec
     * 
     */
    public static function getPermissaoCompdec($login) {

        $con = Conexao::getInstance();

        $dados = "";

        $sql = "SELECT login,
                    nivel,
                    cad_comdec,
                    cad_consulta,
                    cad_rel,
                    alt_comdec,
                    admuser,
                    adduser
                FROM com_permissao
		WHERE login = '" . $login . "'";

        $result = $con->query($sql);

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados = $linha;
        }


        return $dados;
    }

    /* permissao ajuda */

    public function castroPermissaoAjuda($login) {
        $con = Conexao::getInstance();
        $sql = "insert into aju_permisssao login = " . $login;
        $result = $con->query($sql);
        $result->execute();
    }

    /* permissao emergencia */

    /* permissao decreto */

    /* permissao compdec */

    /* permissao equipe */

    /* permissao escola */

    /* permissao poco */

    /* get usuario com opcao reset */

    public function getResetUsuario($reset) {

        $con = Conexao::getInstance();

        $dados = null;

        $sql = "select id_usuario, 
                login,
                reset
                from cedec_usuario
                where reset = '" . $reset . "'";

        $result = $con->query($sql);

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados = $linha;
        }

        return $dados;
    }

    public function getResetUsuarioEx($reset) {

        $con = Conexao::getInstance();

        $dados = null;

        $sql = "select id, 
                usuario,
                reset
                from cedec_user_ex
                where reset = '" . $reset . "'";

        $result = $con->query($sql);

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados = $linha;
        }

        return $dados;
    }

    public function getDadosUsuarioEx($id_usuario) {

        $con = Conexao::getInstance();

        $dados = null;

        $sql = "select id, 
                usuario
                from cedec_user_ex
                where id = '" . $id_usuario . "'";

        $result = $con->query($sql);

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados = $linha;
        }

        return $dados;
    }

    /**
     * Dados usuario
     * 
     */
    public static function dadosUsuarios($agente = false) {

        $con = Conexao::getInstance();

        $dados = array();

        $filtro = ($agente) ? " and cedec_funcionario.funcao = 'REDEC'" : "";

        $sql = "SELECT cedec_usuario.nome,
cedec_usuario.email_rec,
cedec_usuario.login,
cedec_usuario.situacao,
cedec_usuario.ultimo_acesso,
cedec_usuario.nivel,
cedec_usuario.cedec_admin,
cedec_funcionario.secao,
cedec_funcionario.posto,
cedec_funcionario.funcao,
cedec_funcionario.desc_funcao
from cedec_usuario
inner join cedec_funcionario
on cedec_usuario.id_funcionario = cedec_funcionario.id_funcionario
where cedec_usuario.situacao = 1 
and cedec_usuario.nome not in('SUPORTE') " . $filtro . " 
 order by cedec_admin desc ";

        $result = $con->query($sql);

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados[] = $linha;
        }

        return $dados;
    }

    /*
     *
     */

    public static function gravarLogin($dados) {


        $con = Conexao::getInstance();

        $sql = "insert into com_log (login,
                                     dt_user,
                                     acao,
                                     ip) values ( '" . $dados['login'] . "',
                                                  '" . date("Y-m-d H:i:s") . "',
                                                  '" . $dados['acao'] . "',
                                                  '" . $_SERVER['REMOTE_ADDR'] . "')";

        $result = $con->query($sql);
    }

    /**
     * lista tentativa usuarios
     * 
     */
    public static function listaTentativaAcesso($limite = 20) {

        $con = Conexao::getInstance();

        $dados = array();

        $sql = "SELECT * from com_log
            order by id_log desc limit " . $limite;

        $result = $con->query($sql);

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados[] = $linha;
        }

        return $dados;
    }

    /*
      Pega o login do usuario usando o hash de reset senha
     */

    public static function getUsuarioHash($hash) {

        $con = Conexao::getInstance();

        $dados = array();

        $sql = "SELECT login from cedec_usuario
            where reset = '" . $hash . "'";

        $result = $con->query($sql);

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados = $linha;
        }

        return $dados['login'];
    }

    /**
     * Lista de informações de usuarios 
     */
    public static function listaUsuario($param = false) {

        $con = Conexao::getInstance();

        $dados = array();

        $id_func_chefe_gm = self::getChefeGMG();
        $id_chefe = "";
        if($id_func_chefe_gm) {
            $id_chefe = " field(cedec_usuario.id_funcionario,$id_func_chefe_gm) desc, ";
        }
        
        //var_dump($id_func_chefe_gm);

        $filtro = (!empty($_GET['tipo'])) ? " and desc_funcao = 'Agente Regional de DC' order by cedec_rpm.id " : " and desc_funcao not like 'Agente Regional de DC%' order by $id_chefe cedec_usuario.nome";
        $sql = "select 
cedec_usuario.id_usuario,
cedec_usuario.nome,
cedec_usuario.email_rec,
cedec_usuario.login,
cedec_usuario.it_m_deposito as estoque,
cedec_usuario.it_m_pipa as pmda,
cedec_usuario.it_m_cce as plantao,
cedec_usuario.it_m_decretacao as decretacao,
cedec_usuario.it_m_comdec as compdec,
cedec_usuario.it_m_poco as prefeitura,
cedec_usuario.it_m_escola as escola,
cedec_usuario.ultimo_acesso,
cedec_funcionario.orgao,
cedec_funcionario.desc_funcao,
cedec_funcionario.telefone,
cedec_funcionario.celular,
cedec_funcionario.id_rpm,
cedec_funcionario.posto,
cedec_funcionario.num_masp,
cedec_funcionario.email2,
cedec_rpm.nome as rpm,
cedec_usuario.cpf,
aju_deposito.nome as dep_avancado
from cedec_usuario
inner join cedec_funcionario
on cedec_usuario.id_funcionario = cedec_funcionario.id_funcionario
inner join cedec_rpm
on cedec_funcionario.id_rpm = cedec_rpm.id
inner join aju_deposito
on cedec_rpm.id = aju_deposito.id_rpm
where cedec_usuario.situacao = 1
and cedec_usuario.id_usuario != 79
" . $filtro;

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
    public static function listaid_funcionarioAutocomplete() {

        $con = Conexao::getInstance();

        $dados = array();

        $sql = "SELECT id_funcionario, num_masp, posto, nome
                    FROM cedec_funcionario where situacao = 1";
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

    public static function getChefeGMG() {
        $con = Conexao::getInstance();

        $sql = "SELECT id_funcionario from cedec_funcionario
                WHERE situacao = 1 and funcao = 'CHEFE GMG' ";

        $result = $con->query($sql);

        return $result->fetchColumn();
    }

    /**
     * 
     */
    public static function buscaTrSenha($email, $hash) {


        $con = Conexao::getInstance();

        $sql = "select email_rec, reset
                    from cedec_user_ex where
                    email_rec = :email
                    and hash = :hash";

        $result = $con->prepare($sql);

        $result->bindParam(":email", $email, PDO::PARAM_STR);
        $result->bindParam(":hash", $hash, PDO::PARAM_STR);

        $result->execute();

        $troca = $result->rowCount();

        $dados = $result->fetch(PDO::FETCH_ASSOC);

        if ($troca) {
            $dados['troca'] = $troca;
        }

        return $dados;
    }

    /**
     * 
     */
    public static function buscaTrSenhaCedec($email, $hash) {


        $con = Conexao::getInstance();

        $sql = "select email_rec, reset
                    from cedec_usuario where
                    email_rec = :email
                    and hash = :hash";

        $result = $con->prepare($sql);

        $result->bindParam(":email", $email, PDO::PARAM_STR);
        $result->bindParam(":hash", $hash, PDO::PARAM_STR);

        $result->execute();

        $troca = $result->rowCount();

        $dados = $result->fetch(PDO::FETCH_ASSOC);

        if ($troca) {
            $dados['troca'] = $troca;
        }

        return $dados;
    }

    /**
     * Atualizacao usuario externo
     *
     */
    public static function updateToken($id_usuario) {

        $dados = self::getCpfEmail($id_usuario);

        try {

            $con = Conexao::getInstance();

            $sql = "UPDATE cedec_usuario SET
			token = '" . hash('sha256', $dados['cpf'] . $dados['email']) . "'
			WHERE id_usuario = " . $id_usuario;

            $result = $con->query($sql);
            
            return true;
        } catch (Exception $e) {
            print FuncaoBase::getError($e->getMessage(), 'Mensagem');
        }
    }

    /**
     * Atualizacao usuario externo
     *
     */
    public static function updateCpf($post) {

        try {

            $con = Conexao::getInstance();
            
            $sql = "";
            
            if($post['tipo'] == "i" ) {

                $sql = "UPDATE cedec_usuario SET
                            cpf = '" . $post['cpf'] . "'
                            WHERE id_usuario = " . $post['id_usuario'];
            }elseif($post['tipo'] == "e") {
                $sql = "UPDATE cedec_user_ex SET
			cpf = '" . $post['cpf'] . "'
			WHERE id = " . $post['id_usuario'];
                
            }

            $result = $con->query($sql);

            return true;
        } catch (Exception $e) {
            print FuncaoBase::getError($e->getMessage(), 'Mensagem');
        }
    }

    /**
     * Atualizacao token
     *
     */
    public static function updateGeralToken() {

        $dados = array();
        
        $con = Conexao::getInstance();

        try {

            $sql = "select id_usuario, email_rec, cpf from cedec_usuario";

            $result = $con->query($sql);
            
            $result->execute();

            $dados = $result->fetchAll(PDO::FETCH_ASSOC);
            
           var_dump($dados);
            
            foreach ($dados as $key => $value) {
                self::updateToken($value['id_usuario']);
                
            }

        } catch (Exception $e) {
            print FuncaoBase::getError($e->getMessage(), 'Mensagem');
        }
    }
    
    
    /* busca usuarios internos e externos */
    public static function getUserData(array $dados) {
              
        $con = Conexao::getInstance();
        
        $sql = "";

        try {

            $sqlUserExterno = "select * from cedec_user_ex where id = ".$dados['idUser'];
            
            $sqlUserInterno = "select *from cedec_usuario where id_usuario = ".$dados['idUser'];
            
            if($dados['tipo'] == "e") {
                
                $sql = $sqlUserExterno;
                
            }elseif ($dados['tipo'] == "i") {
                $sql = $sqlUserInterno;
            }

            $result = $con->query($sql);
            
            $result->execute();
            
           
            return $result->fetch(PDO::FETCH_ASSOC);
            

        } catch (Exception $e) {
            print FuncaoBase::getError($e->getMessage(), 'Mensagem');
        }
          
        
    }
    
    
    /**
     * uSUARIOS CEDEC
     * @return type
     */
    static function UsuarioCedecDados() {

        $dados = array();
        $con = Conexao::getInstance();

        $sql = 'SELECT cedec_usuario.id_usuario,
                    cedec_usuario.id_deposito,
                    cedec_usuario.nome as nome,
                    cedec_usuario.senha,
                    cedec_usuario.email_rec,
                    cedec_usuario.nivel,
                    cedec_usuario.situacao,
                    cedec_usuario.login,
                    cedec_usuario.it_m_deposito,
                    cedec_usuario.it_m_pipa,
                    cedec_usuario.it_m_cce,
                    cedec_usuario.it_m_decretacao,
                    cedec_usuario.it_m_comdec,
                    cedec_usuario.it_m_apoio,
                    cedec_usuario.it_m_poco,
                    cedec_usuario.it_m_escola,
                    cedec_usuario.cpf,
                    cedec_usuario.id_funcionario,
                    cedec_funcionario.email as email_info1,
                    cedec_funcionario.email2 as email_info2,
                    cedec_funcionario.num_masp,
                    cedec_funcionario.secao as secao,
                    cedec_funcionario.id_funcionario
                        FROM cedec_usuario
                            inner join cedec_funcionario
                            on cedec_usuario.id_funcionario = cedec_funcionario.id_funcionario
                            WHERE cedec_usuario.situacao = 1';

        $result = $con->query($sql);
       

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
    /**
     * uSUARIOS eXTERNOS compdec
     * @return type
     */
    static function UsuariocomdecDados() {

        $dados = array();
        $con = Conexao::getInstance();

        $sql = "SELECT cedec_user_ex.id,
                        cedec_user_ex.usuario,
                        cedec_user_ex.email_rec,
                        cedec_user_ex.id_municipio,
                        cedec_user_ex.cpf,
                        cedec_rpm_mun.nome,
                        cedec_user_ex.situacao
                        FROM cedec_user_ex
                        inner join cedec_rpm_mun
                        on cedec_user_ex.id_municipio = cedec_rpm_mun.id_municipio                        
                            WHERE cedec_user_ex.situacao = 'ATIVADO'
                            Order by cedec_rpm_mun.id_rpm";

        $result = $con->query($sql);
       

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
    public static function busca($status = null, $tipo = null, $cpf = null) {
        
        $paramStatus = (!is_null($status)) ? "and situacao = '".$status."'" : "";
        
        $paramTipo = (!is_null($tipo)) ? "and modulo = '".$tipo."'" : "";
        
        $paramCpf = (!is_null($cpf)) ? "and cpf = '".$cpf."'" : "";
        
        
        $con = Conexao::getInstance();
        
        $sql = "Select *from cedec_user_ex where id > 0 ".$paramStatus.$paramTipo.$paramCpf;
        
        $result = $con->query($sql);
        
        //var_dump($sql, $status);
        
        return $result->fetchAll(PDO::FETCH_ASSOC);
        
        
    }


}