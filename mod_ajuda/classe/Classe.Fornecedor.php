<?php require_once(PATH.'/core/classe/Classe.Data.php');
/***********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
* 																					*
* 	Classe para manipulacao de liberacoes 											*
* 																					*
* 	Autor: Demetrio da Silva Passos													*
* 																					*
* 	Criacao : 01/08/2020															*
************************************************************************************/

class Fornecedor extends DataMysql{

	# @ adiciona a liberacao na tabela 'liberacao' do banco.
	public static function Cadastro(array $dados) {
            
                $con = Conexao::getInstance();
		
		$sql = "INSERT INTO pip_fornecedor (nome,
                                                cpfcnpj,
                                                tel,
                                                cel)
                                    		      VALUES (:nome,
                                                          :cpfcnpj,
                                                    	  :telefone,
                                                    	  :celular)";

            try {

                $result = $con->prepare($sql);

                $result->bindValue(":nome",  $dados['nome']);
                $result->bindValue(":cpfcnpj", $dados['cpfcnpj']);
                $result->bindValue(":telefone", $dados['tel']);
                $result->bindValue(":celular",  $dados['cel']);
                $result->execute();

                $ultimoId = $con->lastInsertId();
                
                Log::GravaLog("Cadastro de fornecedor: ".$dados['nome']." ".$_COOKIE['seguranca']['login'], "aju_log");

                print $ultimoId;

            } catch (Exception $e) {
                return $e->getMessage()."Erro ao inserir Fornecedor";
            }                                            		
	}
        
        # Atualizar dados fornecedor
	public static function Atualizar(array $dados) {
            
                $con = Conexao::getInstance();
		
		$sql = "UPDATE pip_fornecedor SET nome = :nome,
                                                cpfcnpj = :cpfcnpj,
                                                tel = :tel,
                                                cel = :cel
                                                WHERE id = :id";

            try {

                $result = $con->prepare($sql);

                $result->bindValue(":id",  $dados['id']);
                $result->bindValue(":nome",  $dados['nome']);
                $result->bindValue(":cpfcnpj", $dados['cpfcnpj']);
                $result->bindValue(":tel", $dados['tel']);
                $result->bindValue(":cel",  $dados['cel']);
                $result->execute();

                Log::GravaLog("Atualizar Cadastro de fornecedor: ".$dados['nome']." ".$_COOKIE['seguranca']['login'], "aju_log");
                
                return true;

            } catch (Exception $e) {
                return $e->getMessage()."Erro ao inserir Fornecedor";
            }                                            		
	}
        
	# @ adiciona a liberacao na tabela 'liberacao' do banco.
	public static function deleteCel($id) {
            
                $con = Conexao::getInstance();
		
		$sql = "DELETE FROM pip_dispositivo WHERE id = ".$id;

            try {

                $con->query($sql);
                
                return true;


            } catch (Exception $e) {
                return $e->getMessage()."Erro ao inserir Fornecedor";
            }                                            		
	}
        
        
        /**
         * Lista Fornecedoress
         */
        public function listaFornecedores() {
            
            $con = Conexao::getInstance();
            
            $dados = array();
            
            $sql = "SELECT pip_fornecedor.id,
                        pip_fornecedor.nome, 
                        pip_fornecedor.tel, 
                        pip_fornecedor.cel,
                         count(pip_dispositivo.id) as qtd
                              FROM pip_fornecedor
                              left JOIN pip_dispositivo
                              ON pip_fornecedor.id = pip_dispositivo.fornecedor_id
                              group BY pip_fornecedor.nome
                              ORDER BY pip_fornecedor.nome";

            try {

                $result = $con->query($sql);
                
                while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                    $dados[] = $linha;
                }

                return $dados;

            } catch (Exception $e) {
                return $e->getMessage()."Erro ao inserir Fornecedor";
            }                       
            
            
            
        }
        /**
         * Lista Fornecedoress
         */
        public static function listaFornecedor($id) {
            
            $con = Conexao::getInstance();
            
            $dados = array();
            
            $sql = "SELECT pip_fornecedor.id,
                        pip_fornecedor.nome,
                        pip_fornecedor.cpfcnpj,
                        pip_fornecedor.tel, 
                        pip_fornecedor.cel
                              FROM pip_fornecedor
                              WHERE id =".$id;

            try {

                $result = $con->query($sql);
                
                while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                    $dados = $linha;
                }

                return $dados;

            } catch (Exception $e) {
                return $e->getMessage()."Erro ao inserir Fornecedor";
            }                       
            
            
            
        }
        
        /**
         * Lista Dispositovos
         */
        public static function listaDisp($fornecedor_id) {
            
            $con = Conexao::getInstance();
            
            $dados = array();
            
            $sql = "SELECT pip_dispositivo.id,pip_dispositivo.cel
                              FROM pip_dispositivo
                              WHERE fornecedor_id = ".$fornecedor_id;

            try {

                $result = $con->query($sql);
                
                while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                    $dados[] = $linha;
                }

                return $dados;

            } catch (Exception $e) {
                return $e->getMessage()."Erro ao inserir Fornecedor";
            }                       
            
            
            
        }
        
        /**
         * Cadastro Dispositivos
         */
        public static function cDispositivo(array $dados) {
            
           
            $con = Conexao::getInstance(); 
            $sql = "INSERT INTO pip_dispositivo (cel,
                                                fornecedor_id)
                                    		      VALUES (:cel,
                                                    	  :fornecedor_id)";

            try {
                
                $result = $con->prepare($sql);
                $result->bindValue(":cel",  $dados['cel']);
                $result->bindValue(":fornecedor_id", $dados['fornecedor_id']);
                $result->execute();

                Log::GravaLog("Cadastro de Dispositivo: ".$dados['cel']." ".$_COOKIE['seguranca']['login'], "aju_log");

                return true;

            } catch (Exception $e) {
                return $e->getMessage()."Erro ao inserir Fornecedor";
            }                         
        }
        
        /**
         * Cadastro Dispositivos
         */
        public static function qrCode(array $dados) {
            
            
            $con = Conexao::getInstance(); 
            $sql = "INSERT INTO pip_dispositivo (telefone,
                                                fornecedor_id,
                                                hash,
                                                dt_leitura)
                                    		      VALUES (:telefone,
                                                    	  :fornecedor_id,
                                                    	  :hash,
                                                          :dt_leitura)";

            try {
                
                $result = $con->prepare($sql);
                $result->bindValue(":telefone",  $dados['telefone']);
                $result->bindValue(":fornecedor_id", $dados['fornecedor']);
                $result->bindValue(":hash",  $dados['hash']);
                $result->bindValue(":dt_leitura",  $dados['dt_leitura']);
                $result->execute();

                Log::GravaLog("Cadastro de Dispositivo: ".$dados['telefone']." ".$_COOKIE['seguranca']['login'], "aju_log");

                return true;

            } catch (Exception $e) {
                return $e->getMessage()."Erro ao inserir Fornecedor";
            }                         
        }
        
        /**
         * Get nome fornecedor
         */
        public static function getNome($id){
            
            $con = Conexao::getInstance();
            
            $dados = array();
            
            $sql = "SELECT nome"
                    . " FROM pip_fornecedor"
                    . " WHERE id = ".$id;

            try {

                $result = $con->query($sql);
                
                while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                    $dados = $linha['nome'];
                }

                return $dados;

            } catch (Exception $e) {
                return $e->getMessage()."Erro ao inserir Fornecedor";
            }                 
            
            
            
        }

	
}?>