<?php
//require_once(PATH . '/core/classe/Classe.Data.php');
/* * *********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 	
 *    Gerador de código : 1.0
 *
 * 	Classe para manipulacao da tabela aju_entrada_nota										*
 * 																					*
 * 	Autor: Demetrio da Silva Passos	
 *      MASP: 1296844
 * 																					*
 * 	Criacao : 29/09/2020															*
 * ********************************************************************************** */

class Entrada_notaConEstoqueModel extends Model {

    
    private $table = "aju_centrada_nota";
    public static $model;
    private static $mod;
    private $marca;
    private static $con;
    
    
    private $id_entrada_nota = null;
private $id_fornecedor = null;
private $data_emissao = null;
private $data_entrega = null;
private $id_natureza = null;
private $id_itens_nota = null;
private $id_almoxarifado = null;


    
    
 public function getId_almoxarifado(){
        return $this->id_almoxarifado;
    }

            
    public function setId_almoxarifado($id_almoxarifado){
            $this->id_almoxarifado = $id_almoxarifado;
    }
    

    #################  CONSTRUTOR ##################
     function __construct() {

         self::$model = $this->Tabela('aju_centrada_nota');

         self::$mod = "aju";
         
         self::$con = Conexao::getInstance();
     }
   
    #################  LISTA  ##################
   # lista {$model}
  
    public static function lista($id = null) {
         
         $dados = array();
 
        $sql = "SELECT";
        $sql .= " ".implode(", ",self::$model['dados']['campos'])."";
        
        if (empty($id)) {

            $sql .= " FROM ".self::$model['tabela']->TABLE_NAME." ORDER By ".self::$model['dados']['id'];

            $result =  self::$con->query($sql);
        } else {

            $sql .= " FROM ".self::$model['tabela']."  
                            WHERE ".self::$model['campos'][0]." = :id
                            ORDER BY nome";
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
    
    public static function listaExportar() {
         
         $dados = array();

           $sql = " SELECT aju_centrada_nota.id_entrada_nota,
    aju_centrada_nota.id_fornecedor,
    aju_cfornecedor.nome as fornecedor,
    aju_centrada_nota.data_emissao,
    aju_centrada_nota.data_entrega,
    aju_centrada_nota.id_almoxarifado as id_armazem,
    aju_calmoxarifado.nome as armazem,
    aju_centrada_nota.id_evento,
    aju_cevento.nome as evento,
    aju_centrada_nota.id_tp_pedido as almoxarifado,
    aju_ctp_pedido.nome as almoxarifado,
    aju_citens_nota.id_unidade as id_produto,
    aju_citens_nota.qtd,
     aju_citens_nota.val_unid,
      aju_citens_nota.val_total,
       aju_citens_nota.data_validade
FROM gestaocedec.aju_centrada_nota
inner join aju_cfornecedor
on aju_centrada_nota.id_fornecedor = aju_cfornecedor.id_fornecedor
inner join aju_calmoxarifado
on aju_centrada_nota.id_almoxarifado = aju_calmoxarifado.id_almoxarifado
left join aju_cevento
on aju_centrada_nota.id_evento = aju_cevento.id_evento
inner join aju_ctp_pedido
on aju_centrada_nota.id_tp_pedido = aju_ctp_pedido.id_tp_pedido
inner join aju_citens_nota
on aju_centrada_nota.id_entrada_nota = aju_citens_nota.id_nota";

            $result =  self::$con->query($sql);

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
        $sql = "INSERT INTO aju_centrada_nota (id_fornecedor,
data_emissao,
data_entrega,
id_natureza,
id_almoxarifado,
id_tp_pedido
) VALUES (:id_fornecedor,
:data_emissao,
:data_entrega,
:id_natureza,
:id_almoxarifado,
:id_tp_pedido
)";

        try {

            $result = self::$con->prepare($sql);

            $result->bindValue(":id_fornecedor", $dados['id_fornecedor']);
$result->bindValue(":data_emissao", DataMysql::dataForm($dados['data_emissao']));
$result->bindValue(":data_entrega", DataMysql::dataForm($dados['data_entrega']));
$result->bindValue(":id_natureza", 1);
$result->bindValue(":id_almoxarifado", $dados['id_almoxarifado']);
$result->bindValue(":id_tp_pedido", $dados['id_tp_pedido']);

            $result->execute();
            
            $id_nota = self::$con->lastInsertID();
            //var_dump($id_nota);
            
        ################## adiciona itens de nota     ##################
            $itens_post = str_replace("\\", "", $dados['itens']);
                
        $dadosItens['itens'] = json_decode($itens_post);    

        
       
        $dadosItens['id_nota'] = $id_nota;    

        #add itens nota    
        self::addItensNota($dadosItens);
        
        # adicionar saldo
        $dados_entrada = array(
                        'data_reg'=> date('Y-m-d'),
                        'historico' => "Entrada de nota",
                        'tipo'=> "entrada",
                        'id_pedido'=> null,
                        'id_almoxarifado'=> $dados['id_almoxarifado'],
                        'id_nota' => $id_nota,
                        'id_tp_pedido' =>$dados['id_tp_pedido'],
                        );

                        self::entrada_estoque($dados_entrada, $dadosItens['itens']);
        #Log::GravaLog("Cadastro de marca : " . $dados['nome'] . " " . $_COOKIE['seguranca']['login'], "aju_log");

            print "sucesso";
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir marca";
        }
    }
    
    
    #############  ADICIONAR ITENS DE PRODUTOS NA NOTA ###########
    private static function addItensNota(array $dados) {

        try {
            foreach ($dados['itens'] as $key => $value) {

                if($value->data_validade == "--"){
                        $value->data_validade = null;
                }
                $sql = "INSERT INTO aju_citens_nota (id_unidade,"
                            . "qtd,"
                            . "val_unid,"
                            . "val_total,"
                            . "data_validade,"
                            . "id_nota)"
                            . " VALUES (:id_unidade, :qtd, :val_unid, :val_total, :data_validade, :id_nota)";

                $result = self::$con->prepare($sql);

                $result->bindValue(":id_unidade", $value->id_unidade);
                $result->bindValue(":qtd", $value->qtd);
                $result->bindValue(":val_unid", $value->val_unid);
                $result->bindValue(":val_total", $value->val_total);
                $result->bindValue(":data_validade", $value->data_validade);
                $result->bindValue(":id_nota", $dados['id_nota']);
                $result->execute();
            }
        } catch (Exception $e) {

        }
    }
    
    #################  ENTRADA NO ESTOQUE  ##################
    # @ grava {$model} em banco

    private static function entrada_estoque(array $dados_entrada, $dados_itens) {
        //var_dump($dados_entrada);
        //print "<br>=================<br>";
        //var_dump($dados_itens);
         try {
            
        foreach ($dados_itens as $key => $value) {
              $sql = "INSERT INTO aju_ccc
                    (data_reg,
                    id_unidade,
                    historico,
                    origem,
                    destino,
                    tipo,
                    qtd,
                    id_pedido,
                    val_unit,
                    val_total,
                    id_almoxarifado,
                    id_nota,
                    id_tp_pedido)
                        VALUES
                        (:data_reg,
                        :id_unidade,
                        :historico,
                        :origem,
                        :destino,
                        :tipo,
                        :qtd,
                        :id_pedido,
                        :val_unit,
                        :val_total,
                        :id_almoxarifado,
                        :id_nota,
                        :id_tp_pedido)";

            $result = self::$con->prepare($sql);

                $result->bindValue(":data_reg", $dados_entrada['data_reg']);
                $result->bindValue(":id_unidade", $value->id_unidade);
                $result->bindValue(":historico", $dados_entrada['historico']);
                $result->bindValue(":origem", null);
                $result->bindValue(":destino", null);
                $result->bindValue(":tipo", $dados_entrada['tipo']);
                $result->bindValue(":qtd", $value->qtd);
                $result->bindValue(":id_pedido", $dados_entrada['id_pedido']);
                $result->bindValue(":val_unit", $value->val_unid);
                $result->bindValue(":val_total", $value->val_total);
                $result->bindValue(":id_almoxarifado", $dados_entrada['id_almoxarifado']);
                $result->bindValue(":id_nota", $dados_entrada['id_nota']);
                $result->bindValue(":id_tp_pedido", $dados_entrada['id_tp_pedido']);

                $result->execute();
        }

            #Log::GravaLog("Cadastro de marca : " . $dados['nome'] . " " . $_COOKIE['seguranca']['login'], "aju_log");

            //print "sucesso";
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir saldo";
        }
    }

    #################  EDIT ##################
            
            
    ################  Atualizar dados entrada_nota  ###################

    public static function edit(array $dados) {
        
 

        $con = Conexao::getInstance();

        $sql = "UPDATE aju_centrada_nota SET 
        id_fornecedor= :id_fornecedor,
data_emissao= :data_emissao,
data_entrega= :data_entrega,
id_natureza= :id_natureza,
id_itens_nota= :id_itens_nota,
id_almoxarifado= :id_almoxarifado
            WHERE id_entrada_nota = :id_entrada_nota";

        try {

            $result = $con->prepare($sql);
            
            $result->bindValue(":id_entrada_nota", $dados['id_entrada_nota']);
            $result->bindValue(":id_fornecedor", $dados['id_fornecedor']);
$result->bindValue(":data_emissao", DataMysql::dataForm($dados['data_emissao']));
$result->bindValue(":data_entrega", DataMysql::dataForm($dados['data_entrega']));
$result->bindValue(":id_natureza", $dados['id_natureza']);
$result->bindValue(":id_itens_nota", $dados['id_itens_nota']);
$result->bindValue(":id_almoxarifado", $dados['id_almoxarifado']);

            
            $result->execute();

            #Log::GravaLog("Atualizar Cadastro de Entrada_nota : " . $dados['nome'] . " " . $_COOKIE['seguranca']['login'], "aju_log");

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao Atualizar Marca";
        }
    }

    #################  VIEW  ##################
    /**
     * View Marca
     */
    public static function view($id_entrada_nota) {

        $con = Conexao::getInstance();

        $fornecedor = "";

        $sql = "SELECT aju_centrada_nota.id_entrada_nota,
aju_centrada_nota.id_fornecedor,
aju_cfornecedor.nome as nome_aju_fornecedor,
aju_centrada_nota.data_emissao,
aju_centrada_nota.data_entrega,
aju_centrada_nota.id_natureza,
aju_cnatureza.nome as nome_aju_natureza,
aju_centrada_nota.id_almoxarifado,
aju_calmoxarifado.nome as nome_aju_almoxarifado,
aju_centrada_nota.id_tp_pedido,
aju_ctp_pedido.nome as nome_aju_ctp_pedido
                              FROM aju_centrada_nota
                              LEFT JOIN aju_cfornecedor
ON aju_centrada_nota.id_fornecedor = aju_cfornecedor.id_fornecedor
LEFT JOIN aju_cnatureza
ON aju_centrada_nota.id_natureza = aju_cnatureza.id_natureza
LEFT JOIN aju_calmoxarifado
ON aju_centrada_nota.id_almoxarifado = aju_calmoxarifado.id_almoxarifado
inner join aju_ctp_pedido
on aju_centrada_nota.id_tp_pedido = aju_ctp_pedido.id_tp_pedido

                              WHERE id_entrada_nota = " . $id_entrada_nota;

        try {

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $entrada_nota = $linha;
            }

           $model = self::$model;
            return array($entrada_nota, $model);
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir Entrada_nota";
        }
    }
    
    #################  PAGINACAO  ##################
    /* paginacao*/
    public function paginacao($start, $regPorPagina){
        $con = Conexao::getInstance();

            $stmt = $con->prepare("SELECT aju_centrada_nota.id_entrada_nota,
aju_centrada_nota.id_fornecedor,
aju_cfornecedor.nome as nome_aju_fornecedor,
aju_centrada_nota.data_emissao,
aju_centrada_nota.data_entrega,
aju_centrada_nota.id_natureza,
aju_cnatureza.nome as nome_aju_natureza,
aju_centrada_nota.id_almoxarifado,
aju_calmoxarifado.nome as nome_aju_almoxarifado,
aju_centrada_nota.id_tp_pedido,
aju_ctp_pedido.nome as nome_tp_pedido
                                FROM aju_centrada_nota
                                LEFT JOIN aju_cfornecedor
ON aju_centrada_nota.id_fornecedor = aju_cfornecedor.id_fornecedor
LEFT JOIN aju_cnatureza
ON aju_centrada_nota.id_natureza = aju_cnatureza.id_natureza
LEFT JOIN aju_calmoxarifado
ON aju_centrada_nota.id_almoxarifado = aju_calmoxarifado.id_almoxarifado
LEFT JOIN aju_ctp_pedido
on aju_centrada_nota.id_tp_pedido = aju_ctp_pedido.id_tp_pedido

                                ORDER By id_entrada_nota DESC LIMIT $start, $regPorPagina");
            $stmt->execute();

            $result = $stmt->fetchAll();
            
            return $result;
            
    }

    #################  DELETAR  ##################
    # @ deletar o entrada_nota

    public static function delete($id) {

        $con = Conexao::getInstance();

        $sql = "DELETE FROM aju_centrada_nota WHERE id_entrada_nota = " . $id;

        try {

            $con->query($sql);

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro Deletar Entrada_nota !";
        }
    }
    
    
    # @ deletar CCC da  entrada_nota

    public static function deleteCCCEntradaNota($id) {

        $con = Conexao::getInstance();

        $sql = "DELETE FROM aju_ccc WHERE id_nota = " . $id;

        try {

            $con->query($sql);

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro Deletar CCC de Entrada_nota !";
        }
    }
            
     


     #####################  lista autocomplete ######################
       
     /** lista autocomplete 
     * 
     */ 

    public function listaid_fornecedorAutocomplete() {

        $con = Conexao::getInstance();

        $dados = array();

        $sql = "SELECT id_fornecedor, nome
                              FROM aju_cfornecedor";

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

    #####################  lista autocomplete tp_pedido ( ALMOXARIFADO )######################
       
     /** lista autocomplete 
     * 
     */ 

    public function listaid_tp_pedidoAutocomplete() {

        $con = Conexao::getInstance();

        $dados = array();

        $sql = "SELECT id_tp_pedido, nome
                              FROM aju_ctp_pedido";

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
    
    #####################  lista autocomplete ######################
       
     /** lista autocomplete 

     * 

     */ 

    public function listaid_naturezaAutocomplete() {

        
        $con = Conexao::getInstance();

        $dados = array();

        $sql = "SELECT id_natureza, nome
                              FROM aju_cnatureza";

        try {

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados[] = $linha;
            }

            return $dados;
        } catch (Exception $e) {
            return $e->getMessage();
        }
        
    }#####################  lista autocomplete ######################
       
     /** lista autocomplete 

     * 

     */ 

    public function listaid_itens_notaAutocomplete() {

        
        $con = Conexao::getInstance();

        $dados = array();

        $sql = "SELECT id_itens_nota, nome
                              FROM aju_itens_nota";

        try {

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados[] = $linha;
            }

            return $dados;
        } catch (Exception $e) {
            return $e->getMessage();
        }
        
    }#####################  lista autocomplete ######################
       
     /** lista autocomplete 

     * 

     */ 

    public function listaid_almoxarifadoAutocomplete() {

        
        $con = Conexao::getInstance();

        $dados = array();

        $sql = "SELECT id_almoxarifado, nome
                              FROM aju_calmoxarifado";

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
     
    
    /***
     * ####################### LISTA PRODUTOS DA NOTA DE ENTRADA #################
     * 
     */
    public function lista_produto_nota($id_nota){
        
        $con = Conexao::getInstance();

        $dados = array();

        $sql = "SELECT aju_citens_nota.id_itens_nota,
                        aju_citens_nota.id_unidade,
                        aju_cunidade.nome,
                        aju_cunidade.descricao,
                        aju_citens_nota.qtd,
                        aju_citens_nota.val_unid,
                        aju_citens_nota.val_total,
                        aju_citens_nota.data_validade,
                        aju_citens_nota.id_nota
                              FROM aju_citens_nota
                              left JOIN aju_cunidade
                              ON aju_citens_nota.id_unidade = aju_cunidade.id_unidade
                              WHERE aju_citens_nota.id_nota = {$id_nota}";

        try {

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados[] = $linha;
            }

            return $dados;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro";
        }
        
        
    }


    /**
     * Lista entrada_nota
     */
    public function listaentrada_notas() {

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
