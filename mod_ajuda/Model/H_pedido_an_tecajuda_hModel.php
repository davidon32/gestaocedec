<?php
//require_once(PATH . '/core/classe/Classe.Data.php');
/* * *********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 	
 *    Gerador de código : 1.0
 *
 * 	Classe para manipulacao da tabela aju_h_pedido_an_tec										*
 * 																					*
 * 	Autor: Demetrio da Silva Passos	
 *      MASP: 1296844
 * 																					*
 * 	Criacao : 12/07/2021															*
 * ********************************************************************************** */

class H_pedido_an_tecajuda_hModel extends Model {

    
    private $table = "aju_h_pedido_an_tec";
    public static $model;
    private static $mod;
    private $marca;
    private static $con;
    
    
    private $id_analise = null;
private $id_usuario = null;
private $id_pedido = null;
private $data_parecer = null;
private $parecer = null;
private $tramit_parecer = null;


    
    
 public function getTramit_parecer(){
        return $this->tramit_parecer;
    }

            
    public function setTramit_parecer($tramit_parecer){
            $this->tramit_parecer = $tramit_parecer;
    }
    

    #################  CONSTRUTOR ##################
     function __construct() {

         self::$model = $this->Tabela('aju_h_pedido_an_tec');

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
        
        $con = Conexao::getInstance();


        $sql = "INSERT INTO aju_h_pedido_an_tec (id_usuario,
id_pedido,
data_parecer,
parecer,
parecer_sit,
tramit_parecer
) VALUES (:id_usuario,
:id_pedido,
:data_parecer,
:parecer,
:parecer_sit,
:tramit_parecer
)";

        try {

            $result = $con->prepare($sql);

            $result->bindValue(":id_usuario", $dados['id_usuario']);
            $result->bindValue(":id_pedido", $dados['id_pedido']);
            $result->bindValue(":data_parecer", DataMysql::dataCompletaForm($dados['data_parecer']));
            $result->bindValue(":parecer", nl2br($dados['parecer']));
            $result->bindValue(":parecer_sit", $dados['parecer_sit']);
            $result->bindValue(":tramit_parecer", $dados['tramit_parecer']);
            $result->execute();

            #Log::GravaLog("Cadastro de marca : " . $dados['nome'] . " " . $_COOKIE['seguranca']['login'], "aju_log");

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir marca";
        }
    }

    #################  EDIT ##################
            
            
    ################  Atualizar dados h_pedido_an_tec  ###################

    public static function edit(array $dados) {
        
 

        $con = Conexao::getInstance();

        $sql = "UPDATE aju_h_pedido_an_tec SET 
                            id_usuario= :id_usuario,
                            id_pedido= :id_pedido,
                            data_parecer= :data_parecer,
                            parecer= :parecer,
                            tramit_parecer= :tramit_parecer
                            WHERE id_analise = :id_analise";

        try {

            $result = $con->prepare($sql);
            
            $result->bindValue(":id_analise", $dados['id_analise']);
            $result->bindValue(":id_usuario", $dados['id_usuario']);
$result->bindValue(":id_pedido", $dados['id_pedido']);
$result->bindValue(":data_parecer", DataMysql::dataForm($dados['data_parecer']));
$result->bindValue(":parecer", $dados['parecer']);
$result->bindValue(":tramit_parecer", $dados['tramit_parecer']);

            
            $result->execute();

            #Log::GravaLog("Atualizar Cadastro de H_pedido_an_tec : " . $dados['nome'] . " " . $_COOKIE['seguranca']['login'], "aju_log");

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao Atualizar Marca";
        }
    }

    #################  VIEW  ##################
    /**
     * View Marca
     */
    public static function view($id_h_pedido_an_tec) {

        $con = Conexao::getInstance();

        $fornecedor = "";

        $sql = "SELECT aju_h_pedido_an_tec.id_analise,
aju_h_pedido_an_tec.id_usuario,
aju_h_pedido_an_tec.id_pedido,
aju_h_pedido_an_tec.data_parecer,
aju_h_pedido_an_tec.parecer,
aju_h_pedido_an_tec.tramit_parecer
                              FROM aju_h_pedido_an_tec
                              
                              WHERE id_analise = " . $id_h_pedido_an_tec;

        try {

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $h_pedido_an_tec = $linha;
            }

           $model = self::$model;
            return array($h_pedido_an_tec, $model);
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir H_pedido_an_tec";
        }
    }
    
    #################  PAGINACAO  ##################
    /* paginacao*/
    public function paginacao($start, $regPorPagina){
        $con = Conexao::getInstance();

            $stmt = $con->prepare("SELECT aju_h_pedido_an_tec.id_analise,
aju_h_pedido_an_tec.id_usuario,
aju_h_pedido_an_tec.id_pedido,
aju_h_pedido_an_tec.data_parecer,
aju_h_pedido_an_tec.parecer,
aju_h_pedido_an_tec.tramit_parecer
                                FROM aju_h_pedido_an_tec
                                
                                ORDER By id_h_pedido_an_tec DESC LIMIT $start, $regPorPagina");
            $stmt->execute();

            $result = $stmt->fetchAll();
            
            return $result;
            
    }

    #################  DELETAR  ##################
    # @ deletar o h_pedido_an_tec

    public static function delete($id) {

        $con = Conexao::getInstance();

        $sql = "DELETE FROM aju_h_pedido_an_tec WHERE id_analise = " . $id;

        try {

            $con->query($sql);

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro Deletar H_pedido_an_tec !";
        }
    }
            
     


     
     



    /**
     * Lista h_pedido_an_tec
     */
    public function listah_pedido_an_tecs() {

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
    public static function listaDespacho($id_pedido) {

        $con = Conexao::getInstance();

        $sql = "SELECT *FROM aju_h_pedido_an_tec 
                    WHERE id_pedido =" . $id_pedido;

        try {

            $result = $con->query($sql);

            return $result->fetchAll(PDO::FETCH_ASSOC);
             

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
    
    
         
/**
*
* Lista de pareceer tecnido dos pedidos 
*/
    public static function listAnalise($id_pedido, $secao = null){
       
        $con = Conexao::getInstance();
        
        $dado = array();
        $sql = "SELECT id_analise,
                id_usuario,
                id_pedido,
                data_parecer,
                parecer,
                tramit_parecer
                FROM aju_h_pedido_an_tec
                where id_pedido =".$id_pedido;
        try {

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dado[] = $linha;
            }
            
            return $dado;
            
        } catch (Exception $e) {
            return $e->getMessage() . "erro ao selecionar as Analise tecnica !";
        }
        
    }
    
    
    /**
     * tramitar pedido
     */
    public static function tramitar(array $dados) {
        
        $con = Conexao::getInstance();
        $sql = "update aju_h_pedido_pedid set tramit = :tramit,
            status = :status,
            data_aprovacao = :data_aprovacao
                            where id = :id_pedido";

        try {

            $result = $con->prepare($sql);
            $result->bindValue(":id_pedido", $dados['id_pedido']);
            $result->bindValue(":tramit", $dados['tramit']);
            $result->bindValue(":status", $dados['status']);
            $result->bindValue(":data_aprovacao", (!empty($dados['data_aprovacao'])) ? $dados['data_aprovacao']: null );
            $result->execute();
            
            # gravar tramitação 
            self::tramit_historico(array('data_tramit'=>date('Y-m-d'),
                                            'id_pedido'=>$dados['id_pedido'],
                                            'id_usuario'=> $_COOKIE['seguranca']['idUser'],
                                            'tipo'=> 'orig: '.$dados['origem'].' dest: '.$dados['tramit']." status: ".$dados['status'])
                                    );

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao tramitar pedido !";
        }
    }
    
    /**
     * Gravar historico tramitação
     * @param data_tramit - 
     * @param id_pedido   -
     * @param id_usuario  -
     * @param tipo        -
     */
    public static function tramit_historico(array $_dados){
    
        $con = Conexao::getInstance();
        $sql = "INSERT INTO aju_h_tramita_pedido
                            (data_tramit,
                            id_pedido,
                            id_usuario,
                            tipo)
                            VALUES (:data_tramit,
                                    :id_pedido,
                                    :id_usuario,
                                    :tipo)";

            try {

                $result = $con->prepare($sql);
                $result->bindValue(":data_tramit", $_dados['data_tramit']);
                $result->bindValue(":id_pedido", $_dados['id_pedido']);
                $result->bindValue(":id_usuario", $_dados['id_usuario']);
                $result->bindValue(":tipo", $_dados['tipo']);
                $result->execute();

                return true;
            } catch (Exception $e) {
                return $e->getMessage() . "Erro lancamento de historico de tramit !";
            }
    
    
    }
    
    
    /**
     * BUSCAR SECAO DE USUARIO DO PARECER
     * @param data_tramit - 
     * @param id_pedido   -
     * @param id_usuario  -
     * @param tipo        -
     */
    public static function getSecaoUser($id_usuario){
    
        $con = Conexao::getInstance();
        
        $sql = "select cedec_funcionario.secao from
                    cedec_funcionario 
                    inner join cedec_usuario
                    on cedec_funcionario.id = cedec_usuario.id_funcionario
                    and cedec_usuario.id_usuario = {$id_usuario}";

            try {

                $result = $con->query($sql);
                
                return $result->fecthAll();
            } catch (Exception $e) {
                return $e->getMessage() . "Erro lancamento de historico de tramit !";
            }
    
    
    }
    

}
