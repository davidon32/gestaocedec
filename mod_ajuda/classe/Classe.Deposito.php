<?php

/***********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 																					*
 * 	Classe manipulacao de dados dos depositos										*
 * 																					*
 * 	Autor: Demetrio da Silva Passos													*
 * 																					*
 * 	Criacao : 01/02/2012															*
 ************************************************************************************/

class Deposito {

     protected $nomeDeposito;

    /**
     * Cadastra depósito avancado
     * @param $nome String
     * @param $endereco String
     * @return boolean
     */
    function CadastraDeposito($nome, $endereco) {

        $sql = 'insert into aju_deposito (nome, endereco)
                values(:nome,
                       :endereco)';

        try {

            $result = Conexao::getInstance()->prepare($sql);
            $result->bindValue(":nome", $nome);
            $result->bindValue(":endereco", $endereco);
            $result->execute();
            
            return true;
            
        } catch (Exception $e) {
            
            return $e->getMessage();
        }
        

    }

    /**
     * Monta elemento HTML "select" com os dados da tabela 'Deposito'
     * @param null atributo html
     * @return elemento HTML 
     */ 
    static function pegaDeposito($attr =null) {

        $sql = "SELECT id_deposito,
					   nome,
					   endereco
				       FROM aju_deposito
				       ORDER BY nome";
        
        $result = Conexao::getInstance()->query($sql);
        
        
        print "<select class=\"form-control\" name='id_deposito' id='id_deposito' class=\"imprimir\" ".$attr.">";
        print "<option value=''>Todos</option>";

        while ($linha = $result->fetch(PDO::FETCH_NUM)) {

            echo "<option value=" . $linha["0"] . ">" . $linha["1"] . "</option>";

        }

        echo "</select>";
    }
    
    
    

    /**
     * Faz um select na base de dados e mostra em um <select> HTML os dados da tabela 'Deposito'
     * e retorna o dado que tem na base como  selected
     * @param integer $idDeposito 
     * @return elemento HTML
     * 
     */
     
    function pegaDepositoSelected($idDeposito) {

        $dados1 = array();
        
        $sql = ('SELECT d.id_deposito, d.nome, d.endereco FROM aju_deposito d');
        
        #@ impressao do selected
        $sql1 = ('SELECT nome FROM aju_deposito WHERE id_deposito =' . $idDeposito);
        
        $result = Conexao::getInstance()->query($sql);
        
        $result1 = Conexao::getInstance()->query($sql1);

        print "<select name=\"nDeposito\">";


        while ($linha1 = $result1->fetch(PDO::FETCH_NUM)) {
            
            $dados1[] = $linha1;
        }
        

        print "<option selected>" . $dados1['nome'] . "</option>";

        while ($linha = $result->fetch(PDO::FETCH_NUM)) {

            echo "<option>" . $linha["1"] . "</option>";

        }

        echo "</select>";

    }

    /**
     * Retorna o id do deposito baseado no nome
     * @param string $nomeDep
     * @return integer
     * 
     */
    static function PegaIdDeposito($nomeDeposito) {

        $dados = array();
        
        $sql = "SELECT d.id_deposito,
                       d.nome 
                       FROM aju_deposito d
                       WHERE d.nome = :nomeDeposito";

        //print $sql;
        
        try {

            $result = Conexao::getInstance()->prepare($sql);
            $result->bindValue(":nomeDeposito", $nomeDeposito);
            $result->execute();

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            
                $dados = $linha;
            }

            return $dados['id_deposito'];
            
        } catch (Exception $e) {
        
            return $e->getMessage();
        
        }
        
    }

    /**
     * Retorna o nome do Deposito baseado no id
     * @param integer $idDeposito
     * @return string nomeDeposito
     */
    static function PegaNomeDeposito($idDeposito) {

        $dados = array();
        
        $sql = "SELECT nome FROM aju_deposito
                WHERE id_deposito = {$idDeposito}";

        //print $sql;
        
        try {
        
            $result = Conexao::getInstance()->prepare($sql);
            $result->bindValue(":idDeposito", $idDeposito);
            $result->execute();
        
            while ($linha = $result->fetch(PDO::FETCH_NUM)) {
        
                $dados = $linha;
            }
        
            return $dados[0];
        
        } catch (Exception $e) {
        
            return $e->getMessage();
        
        }

    }

    /**
     * Vetor com os id's dos produtos
     * @param null
     * @return array identificador produtos
     * 
     */
    function Vet_id_produto() {

        $vetor = array();
        
        $sql = 'select id_unidade FROM aju_unidade';
        
        try {
            
            $result = Conexao::getInstance()->query($sql);
    
            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
    
                $vetor[] = $linha['id_unidade'];
            }
    
            return $vetor;
            
        } catch (Exception $e) {
        
            return $e->getMessage();
        
        }
        

    }

    /**
     * Insere saldo zero para o deposito cadastrado
     * @param integer $idDeposito
     * @return void
     */
    function LancaSaldoZerado($idDeposito) {

        $idProduto = Deposito::Vet_id_produto();
        
        try {
            
            foreach ($idProduto as $chave) {
    
                $sql = 'insert into aju_estoque (id_produto, id_deposito, saldo) values(' . $chave . ', ' . $idDeposito . ', 0)';
    
                $result = Conexao::getInstance()->query($sql);
    
            }
            
        } catch (Exception $e) {
        
            return $e->getMessage();
        
        }


    }

}
?>