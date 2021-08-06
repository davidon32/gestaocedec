<?php
//require_once(PATH . '/core/classe/Classe.Data.php');
/* * *********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 	
 *    Gerador de código : 1.0
 *
 * 	Classe para manipulacao da tabela dec_processo										*
 * 																					*
 * 	Autor: Demetrio da Silva Passos	
 *      MASP: 1296844
 * 																					*
 * 	Criacao : 09/07/2021															*
 * ********************************************************************************** */

class ProcessodecretoModel extends Model {

    
    private $table = "dec_processo";
    public static $model;
    private static $mod;
    private $marca;
    private static $con;
    
    
    private $id_processo = null;
private $ano = null;
private $data_entrada = null;
private $num_processo = null;
private $id_municipio = null;
private $num_dec_mun = null;
private $data_dec_mun = null;
private $dec_vigencia = null;
private $id_cobrade = null;
private $data_vencimento = null;
private $status = null;
private $id_funcionario = null;
private $num_dec_homo = null;
private $data_pub_dec_homo = null;
private $num_dt_port_dec_rec = null;
private $num_dt_dou = null;
private $populacao = null;
private $val_pib = null;
private $val_orcamento = null;
private $val_arrecadacao = null;
private $val_rec_anual = null;
private $val_rec_mensal = null;
private $tel_municipio = null;
private $email = null;
private $val_total = null;
private $morto = null;
private $ferido = null;
private $enfermo = null;
private $desabrigado = null;
private $desalojado = null;
private $outro = null;
private $afetado = null;
private $mat_pub_saude_destr = null;
private $mat_pub_saude_danif = null;
private $val_mat_pub_saude = null;
private $mat_pub_ensino_destr = null;
private $mat_pub_ensino_danif = null;
private $val_mat_pub_ensino = null;
private $mat_pub_outro_destr = null;
private $mat_pub_outro_danif = null;
private $val_mat_pub_outro = null;
private $mat_pub_com_destr = null;
private $mat_pub_com_danif = null;
private $val_mat_pub_com = null;
private $mat_unid_hab_destr = null;
private $mat_unid_hab_danif = null;
private $val_mat_unid_hab = null;
private $mat_obr_infr_pub_destr = null;
private $mat_obr_infr_pub_danif = null;
private $val_mat_obr_infr_pub = null;
private $agua_pop_atingida = null;
private $solo_pop_atingida = null;
private $ar_pop_atingida = null;
private $incendio_pop_atingida = null;
private $val_eco_pub_saude = null;
private $val_eco_pub_agua = null;
private $val_eco_pub_esgoto = null;
private $val_eco_pub_lixo = null;
private $val_eco_pub_praga = null;
private $val_eco_pub_energia = null;
private $val_eco_pub_telec = null;
private $val_eco_pub_transp = null;
private $val_eco_pub_comb = null;
private $val_eco_pub_segur = null;
private $val_eco_pub_ensino = null;
private $val_eco_pub = null;
private $val_eco_priv_agricul = null;
private $val_eco_priv_pecuaria = null;
private $val_eco_priv_industria = null;
private $val_eco_priv_servico = null;
private $val_eco_priv = null;
private $ck_stat_reconhecido = null;
private $ck_stat_arquivo = null;
private $ck_stat_homologa = null;
private $ck_stat_analise = null;


    
    
 public function getCk_stat_analise(){
        return $this->ck_stat_analise;
    }

            
    public function setCk_stat_analise($ck_stat_analise){
            $this->ck_stat_analise = $ck_stat_analise;
    }
    

    #################  CONSTRUTOR ##################
     function __construct() {

         self::$model = $this->Tabela('dec_processo');

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


        var_dump(self::$model);
        $sql = "INSERT INTO dec_processo (ano,
data_entrada,
num_processo,
id_municipio,
num_dec_mun,
data_dec_mun,
dec_vigencia,
id_cobrade,
data_vencimento,
status,
id_funcionario,
num_dec_homo,
data_pub_dec_homo,
num_dt_port_dec_rec,
num_dt_dou,
populacao,
val_pib,
val_orcamento,
val_arrecadacao,
val_rec_anual,
val_rec_mensal,
tel_municipio,
email,
val_total,
morto,
ferido,
enfermo,
desabrigado,
desalojado,
outro,
afetado,
mat_pub_saude_destr,
mat_pub_saude_danif,
val_mat_pub_saude,
mat_pub_ensino_destr,
mat_pub_ensino_danif,
val_mat_pub_ensino,
mat_pub_outro_destr,
mat_pub_outro_danif,
val_mat_pub_outro,
mat_pub_com_destr,
mat_pub_com_danif,
val_mat_pub_com,
mat_unid_hab_destr,
mat_unid_hab_danif,
val_mat_unid_hab,
mat_obr_infr_pub_destr,
mat_obr_infr_pub_danif,
val_mat_obr_infr_pub,
agua_pop_atingida,
solo_pop_atingida,
ar_pop_atingida,
incendio_pop_atingida,
val_eco_pub_saude,
val_eco_pub_agua,
val_eco_pub_esgoto,
val_eco_pub_lixo,
val_eco_pub_praga,
val_eco_pub_energia,
val_eco_pub_telec,
val_eco_pub_transp,
val_eco_pub_comb,
val_eco_pub_segur,
val_eco_pub_ensino,
val_eco_pub,
val_eco_priv_agricul,
val_eco_priv_pecuaria,
val_eco_priv_industria,
val_eco_priv_servico,
val_eco_priv,
ck_stat_reconhecido,
ck_stat_arquivo,
ck_stat_homologa,
ck_stat_analise 
) VALUES (:ano,
:data_entrada,
:num_processo,
:id_municipio,
:num_dec_mun,
:data_dec_mun,
:dec_vigencia,
:id_cobrade,
:data_vencimento,
:status,
:id_funcionario,
:num_dec_homo,
:data_pub_dec_homo,
:num_dt_port_dec_rec,
:num_dt_dou,
:populacao,
:val_pib,
:val_orcamento,
:val_arrecadacao,
:val_rec_anual,
:val_rec_mensal,
:tel_municipio,
:email,
:val_total,
:morto,
:ferido,
:enfermo,
:desabrigado,
:desalojado,
:outro,
:afetado,
:mat_pub_saude_destr,
:mat_pub_saude_danif,
:val_mat_pub_saude,
:mat_pub_ensino_destr,
:mat_pub_ensino_danif,
:val_mat_pub_ensino,
:mat_pub_outro_destr,
:mat_pub_outro_danif,
:val_mat_pub_outro,
:mat_pub_com_destr,
:mat_pub_com_danif,
:val_mat_pub_com,
:mat_unid_hab_destr,
:mat_unid_hab_danif,
:val_mat_unid_hab,
:mat_obr_infr_pub_destr,
:mat_obr_infr_pub_danif,
:val_mat_obr_infr_pub,
:agua_pop_atingida,
:solo_pop_atingida,
:ar_pop_atingida,
:incendio_pop_atingida,
:val_eco_pub_saude,
:val_eco_pub_agua,
:val_eco_pub_esgoto,
:val_eco_pub_lixo,
:val_eco_pub_praga,
:val_eco_pub_energia,
:val_eco_pub_telec,
:val_eco_pub_transp,
:val_eco_pub_comb,
:val_eco_pub_segur,
:val_eco_pub_ensino,
:val_eco_pub,
:val_eco_priv_agricul,
:val_eco_priv_pecuaria,
:val_eco_priv_industria,
:val_eco_priv_servico,
:val_eco_priv,
:ck_stat_reconhecido,
:ck_stat_arquivo,
:ck_stat_homologa,
:ck_stat_analise 
)";

        try {

            $result = self::$con->prepare($sql);

            $result->bindValue(":ano", $dados['ano']);
$result->bindValue(":data_entrada", DataMysql::dataForm($dados['data_entrada']));
$result->bindValue(":num_processo", $dados['num_processo']);
$result->bindValue(":id_municipio", $dados['id_municipio']);
$result->bindValue(":num_dec_mun", $dados['num_dec_mun']);
$result->bindValue(":data_dec_mun", DataMysql::dataForm($dados['data_dec_mun']));
$result->bindValue(":dec_vigencia", $dados['dec_vigencia']);
$result->bindValue(":id_cobrade", $dados['id_cobrade']);
$result->bindValue(":data_vencimento", DataMysql::dataForm($dados['data_vencimento']));
$result->bindValue(":status", $dados['status']);
$result->bindValue(":id_funcionario", $dados['id_funcionario']);
$result->bindValue(":num_dec_homo", $dados['num_dec_homo']);
$result->bindValue(":data_pub_dec_homo", DataMysql::dataForm($dados['data_pub_dec_homo']));
$result->bindValue(":num_dt_port_dec_rec", $dados['num_dt_port_dec_rec']);
$result->bindValue(":num_dt_dou", $dados['num_dt_dou']);
$result->bindValue(":populacao", $dados['populacao']);
$result->bindValue(":val_pib", $dados['val_pib']);
$result->bindValue(":val_orcamento", $dados['val_orcamento']);
$result->bindValue(":val_arrecadacao", $dados['val_arrecadacao']);
$result->bindValue(":val_rec_anual", $dados['val_rec_anual']);
$result->bindValue(":val_rec_mensal", $dados['val_rec_mensal']);
$result->bindValue(":tel_municipio", $dados['tel_municipio']);
$result->bindValue(":email", $dados['email']);
$result->bindValue(":val_total", $dados['val_total']);
$result->bindValue(":morto", $dados['morto']);
$result->bindValue(":ferido", $dados['ferido']);
$result->bindValue(":enfermo", $dados['enfermo']);
$result->bindValue(":desabrigado", $dados['desabrigado']);
$result->bindValue(":desalojado", $dados['desalojado']);
$result->bindValue(":outro", $dados['outro']);
$result->bindValue(":afetado", $dados['afetado']);
$result->bindValue(":mat_pub_saude_destr", $dados['mat_pub_saude_destr']);
$result->bindValue(":mat_pub_saude_danif", $dados['mat_pub_saude_danif']);
$result->bindValue(":val_mat_pub_saude", $dados['val_mat_pub_saude']);
$result->bindValue(":mat_pub_ensino_destr", $dados['mat_pub_ensino_destr']);
$result->bindValue(":mat_pub_ensino_danif", $dados['mat_pub_ensino_danif']);
$result->bindValue(":val_mat_pub_ensino", $dados['val_mat_pub_ensino']);
$result->bindValue(":mat_pub_outro_destr", $dados['mat_pub_outro_destr']);
$result->bindValue(":mat_pub_outro_danif", $dados['mat_pub_outro_danif']);
$result->bindValue(":val_mat_pub_outro", $dados['val_mat_pub_outro']);
$result->bindValue(":mat_pub_com_destr", $dados['mat_pub_com_destr']);
$result->bindValue(":mat_pub_com_danif", $dados['mat_pub_com_danif']);
$result->bindValue(":val_mat_pub_com", $dados['val_mat_pub_com']);
$result->bindValue(":mat_unid_hab_destr", $dados['mat_unid_hab_destr']);
$result->bindValue(":mat_unid_hab_danif", $dados['mat_unid_hab_danif']);
$result->bindValue(":val_mat_unid_hab", $dados['val_mat_unid_hab']);
$result->bindValue(":mat_obr_infr_pub_destr", $dados['mat_obr_infr_pub_destr']);
$result->bindValue(":mat_obr_infr_pub_danif", $dados['mat_obr_infr_pub_danif']);
$result->bindValue(":val_mat_obr_infr_pub", $dados['val_mat_obr_infr_pub']);
$result->bindValue(":agua_pop_atingida", $dados['agua_pop_atingida']);
$result->bindValue(":solo_pop_atingida", $dados['solo_pop_atingida']);
$result->bindValue(":ar_pop_atingida", $dados['ar_pop_atingida']);
$result->bindValue(":incendio_pop_atingida", $dados['incendio_pop_atingida']);
$result->bindValue(":val_eco_pub_saude", $dados['val_eco_pub_saude']);
$result->bindValue(":val_eco_pub_agua", $dados['val_eco_pub_agua']);
$result->bindValue(":val_eco_pub_esgoto", $dados['val_eco_pub_esgoto']);
$result->bindValue(":val_eco_pub_lixo", $dados['val_eco_pub_lixo']);
$result->bindValue(":val_eco_pub_praga", $dados['val_eco_pub_praga']);
$result->bindValue(":val_eco_pub_energia", $dados['val_eco_pub_energia']);
$result->bindValue(":val_eco_pub_telec", $dados['val_eco_pub_telec']);
$result->bindValue(":val_eco_pub_transp", $dados['val_eco_pub_transp']);
$result->bindValue(":val_eco_pub_comb", $dados['val_eco_pub_comb']);
$result->bindValue(":val_eco_pub_segur", $dados['val_eco_pub_segur']);
$result->bindValue(":val_eco_pub_ensino", $dados['val_eco_pub_ensino']);
$result->bindValue(":val_eco_pub", $dados['val_eco_pub']);
$result->bindValue(":val_eco_priv_agricul", $dados['val_eco_priv_agricul']);
$result->bindValue(":val_eco_priv_pecuaria", $dados['val_eco_priv_pecuaria']);
$result->bindValue(":val_eco_priv_industria", $dados['val_eco_priv_industria']);
$result->bindValue(":val_eco_priv_servico", $dados['val_eco_priv_servico']);
$result->bindValue(":val_eco_priv", $dados['val_eco_priv']);
$result->bindValue(":ck_stat_reconhecido", isset($dados['ck_stat_reconhecido']) ? 1 : 0);
$result->bindValue(":ck_stat_arquivo", isset($dados['ck_stat_arquivo']) ? 1 : 0);
$result->bindValue(":ck_stat_homologa", isset($dados['ck_stat_homologa']) ? 1 : 0);
$result->bindValue(":ck_stat_analise", isset($dados['ck_stat_analise']) ? 1 : 0);

 
            $result->execute();

            #Log::GravaLog("Cadastro de marca : " . $dados['nome'] . " " . $_COOKIE['seguranca']['login'], "aju_log");

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir marca";
        }
    }

    #################  EDIT ##################
            
            
    ################  Atualizar dados processo  ###################

    public static function edit(array $dados) {
        
 

        $con = Conexao::getInstance();

        $sql = "UPDATE dec_processo SET 
        ano= :ano,
data_entrada= :data_entrada,
num_processo= :num_processo,
id_municipio= :id_municipio,
num_dec_mun= :num_dec_mun,
data_dec_mun= :data_dec_mun,
dec_vigencia= :dec_vigencia,
id_cobrade= :id_cobrade,
data_vencimento= :data_vencimento,
status= :status,
id_funcionario= :id_funcionario,
num_dec_homo= :num_dec_homo,
data_pub_dec_homo= :data_pub_dec_homo,
num_dt_port_dec_rec= :num_dt_port_dec_rec,
num_dt_dou= :num_dt_dou,
populacao= :populacao,
val_pib= :val_pib,
val_orcamento= :val_orcamento,
val_arrecadacao= :val_arrecadacao,
val_rec_anual= :val_rec_anual,
val_rec_mensal= :val_rec_mensal,
tel_municipio= :tel_municipio,
email= :email,
val_total= :val_total,
morto= :morto,
ferido= :ferido,
enfermo= :enfermo,
desabrigado= :desabrigado,
desalojado= :desalojado,
outro= :outro,
afetado= :afetado,
mat_pub_saude_destr= :mat_pub_saude_destr,
mat_pub_saude_danif= :mat_pub_saude_danif,
val_mat_pub_saude= :val_mat_pub_saude,
mat_pub_ensino_destr= :mat_pub_ensino_destr,
mat_pub_ensino_danif= :mat_pub_ensino_danif,
val_mat_pub_ensino= :val_mat_pub_ensino,
mat_pub_outro_destr= :mat_pub_outro_destr,
mat_pub_outro_danif= :mat_pub_outro_danif,
val_mat_pub_outro= :val_mat_pub_outro,
mat_pub_com_destr= :mat_pub_com_destr,
mat_pub_com_danif= :mat_pub_com_danif,
val_mat_pub_com= :val_mat_pub_com,
mat_unid_hab_destr= :mat_unid_hab_destr,
mat_unid_hab_danif= :mat_unid_hab_danif,
val_mat_unid_hab= :val_mat_unid_hab,
mat_obr_infr_pub_destr= :mat_obr_infr_pub_destr,
mat_obr_infr_pub_danif= :mat_obr_infr_pub_danif,
val_mat_obr_infr_pub= :val_mat_obr_infr_pub,
agua_pop_atingida= :agua_pop_atingida,
solo_pop_atingida= :solo_pop_atingida,
ar_pop_atingida= :ar_pop_atingida,
incendio_pop_atingida= :incendio_pop_atingida,
val_eco_pub_saude= :val_eco_pub_saude,
val_eco_pub_agua= :val_eco_pub_agua,
val_eco_pub_esgoto= :val_eco_pub_esgoto,
val_eco_pub_lixo= :val_eco_pub_lixo,
val_eco_pub_praga= :val_eco_pub_praga,
val_eco_pub_energia= :val_eco_pub_energia,
val_eco_pub_telec= :val_eco_pub_telec,
val_eco_pub_transp= :val_eco_pub_transp,
val_eco_pub_comb= :val_eco_pub_comb,
val_eco_pub_segur= :val_eco_pub_segur,
val_eco_pub_ensino= :val_eco_pub_ensino,
val_eco_pub= :val_eco_pub,
val_eco_priv_agricul= :val_eco_priv_agricul,
val_eco_priv_pecuaria= :val_eco_priv_pecuaria,
val_eco_priv_industria= :val_eco_priv_industria,
val_eco_priv_servico= :val_eco_priv_servico,
val_eco_priv= :val_eco_priv,
ck_stat_reconhecido= :ck_stat_reconhecido,
ck_stat_arquivo= :ck_stat_arquivo,
ck_stat_homologa= :ck_stat_homologa,
ck_stat_analise= :ck_stat_analise
            WHERE id_processo = :id_processo";

        try {

            $result = $con->prepare($sql);
            
            $result->bindValue(":id_processo", $dados['id_processo']);
            $result->bindValue(":ano", $dados['ano']);
$result->bindValue(":data_entrada", DataMysql::dataForm($dados['data_entrada']));
$result->bindValue(":num_processo", $dados['num_processo']);
$result->bindValue(":id_municipio", $dados['id_municipio']);
$result->bindValue(":num_dec_mun", $dados['num_dec_mun']);
$result->bindValue(":data_dec_mun", DataMysql::dataForm($dados['data_dec_mun']));
$result->bindValue(":dec_vigencia", $dados['dec_vigencia']);
$result->bindValue(":id_cobrade", $dados['id_cobrade']);
$result->bindValue(":data_vencimento", DataMysql::dataForm($dados['data_vencimento']));
$result->bindValue(":status", $dados['status']);
$result->bindValue(":id_funcionario", $dados['id_funcionario']);
$result->bindValue(":num_dec_homo", $dados['num_dec_homo']);
$result->bindValue(":data_pub_dec_homo", DataMysql::dataForm($dados['data_pub_dec_homo']));
$result->bindValue(":num_dt_port_dec_rec", $dados['num_dt_port_dec_rec']);
$result->bindValue(":num_dt_dou", $dados['num_dt_dou']);
$result->bindValue(":populacao", $dados['populacao']);
$result->bindValue(":val_pib", $dados['val_pib']);
$result->bindValue(":val_orcamento", $dados['val_orcamento']);
$result->bindValue(":val_arrecadacao", $dados['val_arrecadacao']);
$result->bindValue(":val_rec_anual", $dados['val_rec_anual']);
$result->bindValue(":val_rec_mensal", $dados['val_rec_mensal']);
$result->bindValue(":tel_municipio", $dados['tel_municipio']);
$result->bindValue(":email", $dados['email']);
$result->bindValue(":val_total", $dados['val_total']);
$result->bindValue(":morto", $dados['morto']);
$result->bindValue(":ferido", $dados['ferido']);
$result->bindValue(":enfermo", $dados['enfermo']);
$result->bindValue(":desabrigado", $dados['desabrigado']);
$result->bindValue(":desalojado", $dados['desalojado']);
$result->bindValue(":outro", $dados['outro']);
$result->bindValue(":afetado", $dados['afetado']);
$result->bindValue(":mat_pub_saude_destr", $dados['mat_pub_saude_destr']);
$result->bindValue(":mat_pub_saude_danif", $dados['mat_pub_saude_danif']);
$result->bindValue(":val_mat_pub_saude", $dados['val_mat_pub_saude']);
$result->bindValue(":mat_pub_ensino_destr", $dados['mat_pub_ensino_destr']);
$result->bindValue(":mat_pub_ensino_danif", $dados['mat_pub_ensino_danif']);
$result->bindValue(":val_mat_pub_ensino", $dados['val_mat_pub_ensino']);
$result->bindValue(":mat_pub_outro_destr", $dados['mat_pub_outro_destr']);
$result->bindValue(":mat_pub_outro_danif", $dados['mat_pub_outro_danif']);
$result->bindValue(":val_mat_pub_outro", $dados['val_mat_pub_outro']);
$result->bindValue(":mat_pub_com_destr", $dados['mat_pub_com_destr']);
$result->bindValue(":mat_pub_com_danif", $dados['mat_pub_com_danif']);
$result->bindValue(":val_mat_pub_com", $dados['val_mat_pub_com']);
$result->bindValue(":mat_unid_hab_destr", $dados['mat_unid_hab_destr']);
$result->bindValue(":mat_unid_hab_danif", $dados['mat_unid_hab_danif']);
$result->bindValue(":val_mat_unid_hab", $dados['val_mat_unid_hab']);
$result->bindValue(":mat_obr_infr_pub_destr", $dados['mat_obr_infr_pub_destr']);
$result->bindValue(":mat_obr_infr_pub_danif", $dados['mat_obr_infr_pub_danif']);
$result->bindValue(":val_mat_obr_infr_pub", $dados['val_mat_obr_infr_pub']);
$result->bindValue(":agua_pop_atingida", $dados['agua_pop_atingida']);
$result->bindValue(":solo_pop_atingida", $dados['solo_pop_atingida']);
$result->bindValue(":ar_pop_atingida", $dados['ar_pop_atingida']);
$result->bindValue(":incendio_pop_atingida", $dados['incendio_pop_atingida']);
$result->bindValue(":val_eco_pub_saude", $dados['val_eco_pub_saude']);
$result->bindValue(":val_eco_pub_agua", $dados['val_eco_pub_agua']);
$result->bindValue(":val_eco_pub_esgoto", $dados['val_eco_pub_esgoto']);
$result->bindValue(":val_eco_pub_lixo", $dados['val_eco_pub_lixo']);
$result->bindValue(":val_eco_pub_praga", $dados['val_eco_pub_praga']);
$result->bindValue(":val_eco_pub_energia", $dados['val_eco_pub_energia']);
$result->bindValue(":val_eco_pub_telec", $dados['val_eco_pub_telec']);
$result->bindValue(":val_eco_pub_transp", $dados['val_eco_pub_transp']);
$result->bindValue(":val_eco_pub_comb", $dados['val_eco_pub_comb']);
$result->bindValue(":val_eco_pub_segur", $dados['val_eco_pub_segur']);
$result->bindValue(":val_eco_pub_ensino", $dados['val_eco_pub_ensino']);
$result->bindValue(":val_eco_pub", $dados['val_eco_pub']);
$result->bindValue(":val_eco_priv_agricul", $dados['val_eco_priv_agricul']);
$result->bindValue(":val_eco_priv_pecuaria", $dados['val_eco_priv_pecuaria']);
$result->bindValue(":val_eco_priv_industria", $dados['val_eco_priv_industria']);
$result->bindValue(":val_eco_priv_servico", $dados['val_eco_priv_servico']);
$result->bindValue(":val_eco_priv", $dados['val_eco_priv']);
$result->bindValue(":ck_stat_reconhecido", isset($dados['ck_stat_reconhecido']) ? 1 : 0);
$result->bindValue(":ck_stat_arquivo", isset($dados['ck_stat_arquivo']) ? 1 : 0);
$result->bindValue(":ck_stat_homologa", isset($dados['ck_stat_homologa']) ? 1 : 0);
$result->bindValue(":ck_stat_analise", isset($dados['ck_stat_analise']) ? 1 : 0);

            
            $result->execute();

            #Log::GravaLog("Atualizar Cadastro de Processo : " . $dados['nome'] . " " . $_COOKIE['seguranca']['login'], "aju_log");

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao Atualizar Marca";
        }
    }

    #################  VIEW  ##################
    /**
     * View Marca
     */
    public static function view($id_processo) {

        $con = Conexao::getInstance();

        $fornecedor = "";

        $sql = "SELECT dec_processo.id_processo,
dec_processo.ano,
dec_processo.data_entrada,
dec_processo.num_processo,
dec_processo.id_municipio,
dec_processo.num_dec_mun,
dec_processo.data_dec_mun,
dec_processo.dec_vigencia,
dec_processo.id_cobrade,
dec_cobrade.nome as nome_dec_cobrade,
dec_processo.data_vencimento,
dec_processo.status,
dec_processo.id_funcionario,
dec_processo.num_dec_homo,
dec_processo.data_pub_dec_homo,
dec_processo.num_dt_port_dec_rec,
dec_processo.num_dt_dou,
dec_processo.populacao,
dec_processo.val_pib,
dec_processo.val_orcamento,
dec_processo.val_arrecadacao,
dec_processo.val_rec_anual,
dec_processo.val_rec_mensal,
dec_processo.tel_municipio,
dec_processo.email,
dec_processo.val_total,
dec_processo.morto,
dec_processo.ferido,
dec_processo.enfermo,
dec_processo.desabrigado,
dec_processo.desalojado,
dec_processo.outro,
dec_processo.afetado,
dec_processo.mat_pub_saude_destr,
dec_processo.mat_pub_saude_danif,
dec_processo.val_mat_pub_saude,
dec_processo.mat_pub_ensino_destr,
dec_processo.mat_pub_ensino_danif,
dec_processo.val_mat_pub_ensino,
dec_processo.mat_pub_outro_destr,
dec_processo.mat_pub_outro_danif,
dec_processo.val_mat_pub_outro,
dec_processo.mat_pub_com_destr,
dec_processo.mat_pub_com_danif,
dec_processo.val_mat_pub_com,
dec_processo.mat_unid_hab_destr,
dec_processo.mat_unid_hab_danif,
dec_processo.val_mat_unid_hab,
dec_processo.mat_obr_infr_pub_destr,
dec_processo.mat_obr_infr_pub_danif,
dec_processo.val_mat_obr_infr_pub,
dec_processo.agua_pop_atingida,
dec_processo.solo_pop_atingida,
dec_processo.ar_pop_atingida,
dec_processo.incendio_pop_atingida,
dec_processo.val_eco_pub_saude,
dec_processo.val_eco_pub_agua,
dec_processo.val_eco_pub_esgoto,
dec_processo.val_eco_pub_lixo,
dec_processo.val_eco_pub_praga,
dec_processo.val_eco_pub_energia,
dec_processo.val_eco_pub_telec,
dec_processo.val_eco_pub_transp,
dec_processo.val_eco_pub_comb,
dec_processo.val_eco_pub_segur,
dec_processo.val_eco_pub_ensino,
dec_processo.val_eco_pub,
dec_processo.val_eco_priv_agricul,
dec_processo.val_eco_priv_pecuaria,
dec_processo.val_eco_priv_industria,
dec_processo.val_eco_priv_servico,
dec_processo.val_eco_priv,
dec_processo.ck_stat_reconhecido,
dec_processo.ck_stat_arquivo,
dec_processo.ck_stat_homologa,
dec_processo.ck_stat_analise
                              FROM dec_processo
                              LEFT JOIN dec_cobrade
ON dec_processo.id_cobrade = dec_cobrade.id_cobrade

                              WHERE id_processo = " . $id_processo;

        try {

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $processo = $linha;
            }

           $model = self::$model;
            return array($processo, $model);
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir Processo";
        }
    }
    
    #################  PAGINACAO  ##################
    /* paginacao*/
    public function paginacao($start, $regPorPagina){
        $con = Conexao::getInstance();

            $stmt = $con->prepare("SELECT dec_processo.id_processo,
dec_processo.ano,
dec_processo.data_entrada,
dec_processo.num_processo,
dec_processo.id_municipio,
dec_processo.num_dec_mun,
dec_processo.data_dec_mun,
dec_processo.dec_vigencia,
dec_processo.id_cobrade,
dec_cobrade.nome as nome_dec_cobrade,
dec_processo.data_vencimento,
dec_processo.status,
dec_processo.id_funcionario,
dec_processo.num_dec_homo,
dec_processo.data_pub_dec_homo,
dec_processo.num_dt_port_dec_rec,
dec_processo.num_dt_dou,
dec_processo.populacao,
dec_processo.val_pib,
dec_processo.val_orcamento,
dec_processo.val_arrecadacao,
dec_processo.val_rec_anual,
dec_processo.val_rec_mensal,
dec_processo.tel_municipio,
dec_processo.email,
dec_processo.val_total,
dec_processo.morto,
dec_processo.ferido,
dec_processo.enfermo,
dec_processo.desabrigado,
dec_processo.desalojado,
dec_processo.outro,
dec_processo.afetado,
dec_processo.mat_pub_saude_destr,
dec_processo.mat_pub_saude_danif,
dec_processo.val_mat_pub_saude,
dec_processo.mat_pub_ensino_destr,
dec_processo.mat_pub_ensino_danif,
dec_processo.val_mat_pub_ensino,
dec_processo.mat_pub_outro_destr,
dec_processo.mat_pub_outro_danif,
dec_processo.val_mat_pub_outro,
dec_processo.mat_pub_com_destr,
dec_processo.mat_pub_com_danif,
dec_processo.val_mat_pub_com,
dec_processo.mat_unid_hab_destr,
dec_processo.mat_unid_hab_danif,
dec_processo.val_mat_unid_hab,
dec_processo.mat_obr_infr_pub_destr,
dec_processo.mat_obr_infr_pub_danif,
dec_processo.val_mat_obr_infr_pub,
dec_processo.agua_pop_atingida,
dec_processo.solo_pop_atingida,
dec_processo.ar_pop_atingida,
dec_processo.incendio_pop_atingida,
dec_processo.val_eco_pub_saude,
dec_processo.val_eco_pub_agua,
dec_processo.val_eco_pub_esgoto,
dec_processo.val_eco_pub_lixo,
dec_processo.val_eco_pub_praga,
dec_processo.val_eco_pub_energia,
dec_processo.val_eco_pub_telec,
dec_processo.val_eco_pub_transp,
dec_processo.val_eco_pub_comb,
dec_processo.val_eco_pub_segur,
dec_processo.val_eco_pub_ensino,
dec_processo.val_eco_pub,
dec_processo.val_eco_priv_agricul,
dec_processo.val_eco_priv_pecuaria,
dec_processo.val_eco_priv_industria,
dec_processo.val_eco_priv_servico,
dec_processo.val_eco_priv,
dec_processo.ck_stat_reconhecido,
dec_processo.ck_stat_arquivo,
dec_processo.ck_stat_homologa,
dec_processo.ck_stat_analise
                                FROM dec_processo
                                LEFT JOIN dec_cobrade
ON dec_processo.id_cobrade = dec_cobrade.id_cobrade

                                ORDER By id_processo DESC LIMIT $start, $regPorPagina");
            $stmt->execute();

            $result = $stmt->fetchAll();
            
            return $result;
            
    }

    #################  DELETAR  ##################
    # @ deletar o processo

    public static function delete($id) {

        $con = Conexao::getInstance();

        $sql = "DELETE FROM dec_processo WHERE id_processo = " . $id;

        try {

            $con->query($sql);

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro Deletar Processo !";
        }
    }
            
     


     #####################  lista autocomplete ######################
       
     /** lista autocomplete 

     * 

     */ 

    public function listaid_cobradeAutocomplete() {

        
        $con = Conexao::getInstance();

        $dados = array();

        $sql = "SELECT id_cobrade, nome
                              FROM dec_cobrade";

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
     * Lista processo
     */
    public function listaprocessos() {

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
