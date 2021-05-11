<?php
require_once(PATH . '/core/classe/Classe.Data.php');
/* * *********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 	
 *    Gerador de código : 1.0
 *
 * 	Classe para manipulacao da tabela aju_montagem										*
 * 																					*
 * 	Autor: Demetrio da Silva Passos	
 *      MASP: 1296844
 * 																					*
 * 	Criacao : 15/10/2020															*
 * ********************************************************************************** */

class MontagemConEstoqueModel extends Model {

    
    private $table = "aju_montagem";
    public static $model;
    private static $mod;
    private $marca;
    private static $con;
    
    
    private $id_montagem = null;
private $data_montagem = null;
private $motorista = null;
private $placa = null;
private $id_transportadora = null;


    
    
 public function getId_transportadora(){
        return $this->id_transportadora;
    }

            
    public function setId_transportadora($id_transportadora){
            $this->id_transportadora = $id_transportadora;
    }
    

    #################  CONSTRUTOR ##################
     function __construct() {

         self::$model = $this->Tabela('aju_cmontagem');

         self::$mod = "aju";
         
         self::$con = Conexao::getInstance();
     }
   
    #################  LISTA  ##################
   # lista {$model}
  
    public static function lista($id = null) {
         
         $dados = "";
 
        $sql = "SELECT";
        $sql .= " ".implode(", ",self::$model['dados']['campos'])."";
        
        if (empty($id)) {

            $sql .= " FROM ".self::$model['tabela']->TABLE_NAME." ORDER By ".self::$model['dados']['id'];
            
                $result =  self::$con->query($sql);
        } else {

            $sql .= " FROM ".self::$model['tabela']->table_name."  
                            WHERE ".self::$model['dados']['id']." = :id
                            ORDER BY id_montagem";
            $result = self::$con->prepare($sql);
            $result->bindValue(":id", $id);
            $result->execute();
        }

        try {
         
            while($linha = $result->fetch(PDO::FETCH_ASSOC)){
         
                $dados[] = $linha;
            }

            return $dados;

        } catch (Exception $e) {
            return $e->getMessage() . "Erro lista registros";
        }
    }
         
         
    #####################  Busca nome do ID do Fk  ######################
       
     /** Busca nome do ID Fk 

     * 

     */ 

    public function getNomeIdFk($nome_tabela, $id_tabela, $id) {

    

        if(!is_null($id)){
        
            $con = Conexao::getInstance();

            $dados = "";

            $sql = "SELECT nome
                                  FROM {$nome_tabela}
                                  WHERE {$id_tabela} = $id";

            try {

                $result = $con->query($sql);

                while ($linha = $result->fetch(PDO::FETCH_OBJ)) {
                    $dados = $linha;
                }

                return $dados;
            
        
        
            } catch (Exception $e) {
                return $e->getMessage();
            }
        }else {
            $dados = new \stdClass();
            $dados->nome = '-';
            return $dados;
        }
        
    }
    
       
    #################  LISTA NOME ##################
    # lista nome {$model}
  
    public static function listaNome($nome = null) {
         
         try {
         
         $dados = array();
 
        $sql = "SELECT";
        $sql .= " ".self::$model['dados']['id'].", ";
        $sql .= " ".implode(", ",self::$model['dados']['campos'])."";
        
        if (empty($nome)) {

            $sql .= " FROM ".self::$model['tabela']->TABLE_NAME." ORDER By ".self::$model['dados']['id'];

            $result =  self::$con->query($sql);
        } else {

            $sql .= " FROM ".self::$model['tabela']->TABLE_NAME."  
                            WHERE ".self::$model['dados']['campos'][0]." LIKE :nome
                            ORDER BY nome";
            $result = self::$con->prepare($sql);
            $result->bindValue(":nome", '%'.$nome.'%');
            $result->execute();
        }
         
         while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
                $dados[] = $linha;
            }

        

            return $dados;

        } catch (Exception $e) {
            return $e->getMessage() . "Erro lista registros";
        }
    }

    #################  GRAVAR  ##################
    # @ grava {$model} em banco

    public static function gravar(array $dados) {

        $sql = "INSERT INTO aju_cmontagem (data_montagem,
motorista,
placa,
id_transportadora 
) VALUES (:data_montagem,
:motorista,
:placa,
:id_transportadora 
)";

        try {

            $result = self::$con->prepare($sql);

            $result->bindValue(":data_montagem", DataMysql::dataForm($dados['data_montagem']));
$result->bindValue(":motorista", $dados['motorista']);
$result->bindValue(":placa", $dados['placa']);
$result->bindValue(":id_transportadora", $dados['id_transportadora']);

 
            $result->execute();
            
            /* INSERIR PEDIDOS */
            $id_montagem = self::$con->lastInsertID();
            //var_dump($id_pedido);
            # adiciona itens de nota
            $dadosItens = json_decode($dados['itens']);

            //var_dump($dadosItens);

            foreach ($dadosItens as $key => $value) {

                $sql = "INSERT INTO aju_citem_montagem (id_montagem, id_pedido) VALUES (:id_montagem, :id_pedido)";


                $result = self::$con->prepare($sql);

                $result->bindValue(":id_pedido", $value->id_pedido);
                $result->bindValue(":id_montagem", $id_montagem);
  
                $result->execute();
            }

            #Log::GravaLog("Cadastro de marca : " . $dados['nome'] . " " . $_COOKIE['seguranca']['login'], "aju_log");

            print "sucesso";
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir marca";
        }
    }

    #################  EDIT ##################
            
            
    ################  Atualizar dados montagem  ###################

    public static function edit(array $dados) {
        
 

        $con = Conexao::getInstance();

        $sql = "UPDATE aju_cmontagem SET 
        data_montagem= :data_montagem,
motorista= :motorista,
placa= :placa,
id_transportadora= :id_transportadora
            WHERE id_montagem = :id_montagem";

        try {

            $result = $con->prepare($sql);
            
            $result->bindValue(":id_montagem", $dados['id_montagem']);
            $result->bindValue(":data_montagem", DataMysql::dataForm($dados['data_montagem']));
$result->bindValue(":motorista", $dados['motorista']);
$result->bindValue(":placa", $dados['placa']);
$result->bindValue(":id_transportadora", $dados['id_transportadora']);

            
            $result->execute();

            #Log::GravaLog("Atualizar Cadastro de Montagem : " . $dados['nome'] . " " . $_COOKIE['seguranca']['login'], "aju_log");

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao Atualizar Marca";
        }
    }

    #################  VIEW  ##################
    /**
     * View Marca
     */
    public static function view($id_montagem) {

        $con = Conexao::getInstance();

        $montagem = "";

        $sql = "SELECT aju_cmontagem.id_montagem,
aju_cmontagem.data_montagem,
aju_cmontagem.motorista,
aju_cmontagem.placa,
aju_cmontagem.id_transportadora,
aju_ctransportadora.nome as nome_aju_transportadora
                              FROM aju_cmontagem
                              LEFT JOIN aju_ctransportadora
ON aju_cmontagem.id_transportadora = aju_ctransportadora.id_transportadora

                              WHERE id_montagem = " . $id_montagem;

        try {

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $montagem = $linha;
            }

           $model = self::$model;
            return array($montagem, $model);
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir Montagem";
        }
    }
    
    #################  PAGINACAO  ##################
    /* paginacao*/
    public function paginacao($start, $regPorPagina){
        $con = Conexao::getInstance();

            $stmt = $con->prepare("SELECT aju_cmontagem.id_montagem,
aju_cmontagem.data_montagem,
aju_cmontagem.motorista,
aju_cmontagem.placa,
aju_cmontagem.id_transportadora,
aju_ctransportadora.nome as nome_aju_transportadora,
count(aju_citem_montagem.id_item_montagem) as num_carga
                                FROM aju_cmontagem
                                INNER JOIN aju_ctransportadora
ON aju_cmontagem.id_transportadora = aju_ctransportadora.id_transportadora
INNER JOIN aju_citem_montagem
ON aju_cmontagem.id_montagem = aju_citem_montagem.id_montagem
group by aju_cmontagem.id_transportadora
                                ORDER By id_montagem DESC LIMIT $start, $regPorPagina");
            $stmt->execute();

            $result = $stmt->fetchAll();
            
            return $result;
            
    }

    #################  DELETAR  ##################
    # @ deletar o montagem

    public static function delete($id) {

        $con = Conexao::getInstance();

        $sql = "DELETE FROM aju_cmontagem WHERE id_montagem = " . $id;

        try {

            $con->query($sql);

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro Deletar Montagem !";
        }
    }
            
     


     #####################  lista autocomplete ######################
       
     /** lista autocomplete 

     * 

     */ 

    public function listaid_transportadoraAutocomplete() {

        
        $con = Conexao::getInstance();

        $dados = array();

        $sql = "SELECT id_transportadora, nome
                              FROM aju_ctransportadora";

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
     



    /**
     * Lista pedidos da montagem de carga
     */
    public function lstpedidomont($id_montagem) {

        $con = Conexao::getInstance();

        $dados = array();

        $sql = "select aju_cdestinatario.nome as destinatario,
aju_cdestinatario_final.nome,
aju_cpedido.data_emissao,
aju_citem_montagem.id_pedido,
aju_cpedido.data_emissao,
aju_cpedido.data_entrega,
aju_cdestinatario.endereco,
aju_cdestinatario.municipio,
aju_cdestinatario.estado,
aju_cdestinatario.cep,
sum(aju_citens_pedido.qtd) as qtd,
sum(aju_citens_pedido.val_total) as val_total
from aju_cmontagem
inner join aju_citem_montagem
on aju_cmontagem.id_montagem = aju_citem_montagem.id_montagem
inner join aju_cpedido
on aju_citem_montagem.id_pedido = aju_cpedido.id_pedido
inner join aju_citens_pedido
on aju_cpedido.id_pedido = aju_citens_pedido.id_pedido
inner join aju_cdestinatario
on aju_cpedido.id_destinatario = aju_cdestinatario.id_destinatario
inner join aju_cdestinatario_final
on aju_cpedido.id_destinatario_final = aju_cdestinatario_final.id_destinatario_final
where aju_cmontagem.id_montagem = ".$id_montagem." group by aju_cpedido.id_pedido";

        try {

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados[] = $linha;
            }

            return $dados;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir Fornecedor";
        }
    }

     /**
     * Lista item pedido
     */
    public function item_pedido($id_pedido) {

        $con = Conexao::getInstance();

        $dados = array();
        
        $sql = "select aju_citens_pedido.id_unidade,
                aju_cunidade.nome,
                aju_citens_pedido.qtd,
                aju_cmarca.nome as marca
                from aju_citens_pedido
                inner join
                aju_cunidade
                on aju_citens_pedido.id_unidade = aju_cunidade.id_unidade
                inner join aju_cmarca
                on aju_cunidade.id_marca = aju_cmarca.id_marca 
                where aju_citens_pedido.id_pedido =".$id_pedido;

        try {

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_OBJ)) {
                $dados[] = $linha;
            }

            return $dados;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir Fornecedor";
        }
    }
    
    
    /**
     * Lista item pedido
     */
    public function item_carga($id_montagem) {

        $con = Conexao::getInstance();

        $dados = array();
        
        $sql = "select aju_citem_montagem.id_pedido,
                aju_cpedido.data_emissao,
                aju_cpedido.nome_destinatario_final,
                aju_cpedido.volume,
                aju_cdestinatario.nome
                from aju_citem_montagem
                inner join aju_cpedido
                on aju_citem_montagem.id_pedido = aju_cpedido.id_pedido
                inner join aju_cdestinatario
                on aju_cpedido.id_destinatario = aju_cdestinatario.id_destinatario
                where aju_citem_montagem.id_montagem = ".$id_montagem;

        try {

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_OBJ)) {
                $dados[] = $linha;
            }

            return $dados;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir Fornecedor";
        }
    }
    
    /**
     * lista de todos os itens da montagem de carga
     */
    public function item_pedido_por_montagem($id_montagem) {

        $con = Conexao::getInstance();

        $dados = array();
    
    $sql ="select aju_citens_pedido.id_unidade, aju_cunidade.nome, sum(aju_citens_pedido.qtd) as qtd
from aju_citens_pedido
inner join aju_cpedido
on aju_cpedido.id_pedido = aju_citens_pedido.id_pedido
inner join aju_citem_montagem
on aju_citens_pedido.id_pedido = aju_citem_montagem.id_pedido
inner join aju_cunidade
on aju_citens_pedido.id_unidade = aju_cunidade.id_unidade
where aju_citem_montagem.id_montagem = ".$id_montagem." group by aju_cunidade.id_unidade";

            try {

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_OBJ)) {
                $dados[] = $linha;
            }

            return $dados;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir Fornecedor";
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
                              WHERE id =" . $id;

        try {

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados = $linha;
            }

            return $dados;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir Fornecedor";
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
            $result->bindValue(":cel", $dados['cel']);
            $result->bindValue(":fornecedor_id", $dados['fornecedor_id']);
            $result->execute();

            Log::GravaLog("Cadastro de Dispositivo: " . $dados['cel'] . " " . $_COOKIE['seguranca']['login'], "aju_log");

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir Fornecedor";
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
            $result->bindValue(":telefone", $dados['telefone']);
            $result->bindValue(":fornecedor_id", $dados['fornecedor']);
            $result->bindValue(":hash", $dados['hash']);
            $result->bindValue(":dt_leitura", $dados['dt_leitura']);
            $result->execute();

            Log::GravaLog("Cadastro de Dispositivo: " . $dados['telefone'] . " " . $_COOKIE['seguranca']['login'], "aju_log");

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir Fornecedor";
        }
    }

    /**
     * Get nome fornecedor
     */
    public static function getFornecedorNome($id) {

        $con = Conexao::getInstance();

        $dados = array();

        $sql = "SELECT nome"
                . " FROM pip_fornecedor"
                . " WHERE id = " . $id;

        try {

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados = $linha['nome'];
            }

            return $dados;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir Fornecedor";
        }
    }

}
