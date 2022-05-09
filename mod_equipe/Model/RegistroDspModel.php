<?php
//require_once(PATH . '/core/classe/Classe.Data.php');
/* * *********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 	
 *    Gerador de código : 1.0
 *
 * 	Classe para manipulacao da tabela aju_categoria										*
 * 																					*
 * 	Autor: Demetrio da Silva Passos	
 *      MASP: 1296844
 * 																					*
 * 	Criacao : 29/09/2020															*
 * ********************************************************************************** */

class RegistroDspEquipeModel extends Model {
    
     public static function Gravar($dados){
         
        try {        
        $con = Conexao::getInstance();
    
        $sql = "insert into equ_reg_dsp (data_hora,
                                         objetivo,
                                         ids_evento,
                                         data_hora_inicio,
                                         data_hora_fim,
                                         historico,
                                         obs,
                                         ids_municipio,
                                         ids_viatura,
                                         ids_integrante) values (:data_hora,
                                                                    :objetivo,
                                                                    :ids_evento,
                                                                    :data_hora_inicio,
                                                                    :data_hora_fim,
                                                                    :historico,
                                                                    :obs,
                                                                    :ids_municipio,
                                                                    :ids_viatura,
                                                                    :ids_integrante)" ;
            $result = $con->prepare($sql);
            
            $result->bindValue(":data_hora",        DataMysql::dataForm($dados['data_hora'])." ".date('H:i:s'));
            $result->bindValue(":objetivo",         $dados['txtObj']);
            $result->bindValue(":ids_evento",       implode("|",$dados['evento']));
            $result->bindValue(":data_hora_inicio", DataMysql::dataForm($dados['data_inicio']));
            $result->bindValue(":data_hora_fim",    DataMysql::dataForm($dados['data_final']));
            $result->bindValue(":historico",        $dados['txtHist']);
            $result->bindValue(":obs",              $dados['txtObs']);
            $result->bindValue(":ids_municipio",    implode("|",$dados['states']));
            $result->bindValue(":ids_viatura",      implode("|",$dados['viatura']));
            $result->bindValue(":ids_integrante",   implode("|",$dados['integrante']));

            $result->execute();
            
            return true;
        } catch (Exception $e){
            return false;
        }

     }
    
    public static function lista($id_funcionario){
        
        $con = Conexao::getInstance();
        
        $dados = "";
        
        $sql = "SELECT cedec_funcionario.id_funcionario,
                cedec_funcionario.num_masp,
                cedec_funcionario.nome,
                cedec_funcionario.endereco,
                cedec_funcionario.bairro,
                cedec_funcionario.cidade,
                cedec_funcionario.telefone,
                cedec_funcionario.celular,
                cedec_funcionario.posto,
                cedec_funcionario.secao,
                cedec_funcionario.funcao,
                cedec_funcionario.desc_funcao,
                cedec_funcionario.quinquenio,
                cedec_funcionario.dt_nasc,
                cedec_funcionario.curso,
                cedec_funcionario.email,
                cedec_funcionario.libera,
                cedec_funcionario.email2,
                cedec_funcionario.situacao,
                cedec_funcionario.cpf,
                cedec_funcionario.orgao,
                cedec_funcionario.cargo,
                cedec_funcionario.ci,
                cedec_funcionario.tipo_abono,
                cedec_funcionario.ramal,
                cedec_funcionario.num_mesa,
                cedec_funcionario.ponto_rede,
                cedec_rpm.id as id_rpm,
                cedec_rpm.nome as rpm,
                cedec_usuario.id_usuario
                    FROM cedec_funcionario
                    inner join cedec_rpm
                    on cedec_funcionario.id_rpm = cedec_rpm.id
                    inner join cedec_usuario
                    on cedec_funcionario.id_funcionario = cedec_usuario.id_funcionario
                    WHERE cedec_funcionario.id_funcionario =".$id_funcionario;
        
        $result = $con->query($sql);
        
        while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
            $dados= $linha;
        }
        return $dados;
        
    }
    
    


################  Atualizar dados categoria  ###################

    public static function edit(array $dados) {
        
 
        $con = Conexao::getInstance();

        $sql = "UPDATE cedec_funcionario
                        SET
                        num_masp = :num_masp,
                        nome = :nome,
                        endereco = :endereco,
                        bairro = :bairro,
                        cidade = :cidade,
                        telefone = :telefone,
                        celular = :celular,
                        posto = :posto,
                        secao = :secao,
                        funcao = :funcao,
                        desc_funcao = :desc_funcao,
                        dt_nasc = :dt_nasc,
                        curso = :curso,
                        email = :email,
                        email2 = :email2,
                        cpf = :cpf,
                        orgao = :orgao,
                        ci = :ci,
                        ramal = :ramal,
                        num_mesa = :num_mesa,
                        ponto_rede = :ponto_rede,
                        id_rpm = :id_rpm
                        WHERE id_funcionario = :id_funcionario";

        try {

            $result = $con->prepare($sql);
            
            $result->bindValue(":id_funcionario",$dados['txt_id_funcionario']);
            $result->bindValue(":num_masp",      $dados['txt_masp']);
            $result->bindValue(":nome",          $dados['txt_nome']);
            $result->bindValue(":endereco",      $dados['txt_endereco']);
            $result->bindValue(":bairro",        $dados['txt_bairro']);
            $result->bindValue(":cidade",        $dados['id_municipio']);
            $result->bindValue(":telefone",      $dados['txt_tel']);
            $result->bindValue(":celular",       $dados['txt_cel']);
            $result->bindValue(":posto",         $dados['txt_posto']);
            $result->bindValue(":secao",         $dados['txt_secao']);
            $result->bindValue(":funcao",        $dados['txt_funcao']);
            $result->bindValue(":desc_funcao",   $dados['txt_descr_funcao']);
            $result->bindValue(":dt_nasc",       DataMysql::dataForm($dados['txt_dt_nascimento']));
            $result->bindValue(":curso",         $dados['txt_curso']);
            $result->bindValue(":email",         $dados['txt_email']);
            $result->bindValue(":email2",        $dados['txt_email2']);
            $result->bindValue(":cpf",           $dados['txt_cpf']);
            $result->bindValue(":orgao",         $dados['txt_orgao']);
            $result->bindValue(":ci",            $dados['txt_ci']);
            $result->bindValue(":ramal",         $dados['txtTel_mesa']);
            $result->bindValue(":num_mesa",      $dados['txtNum_mesa']);
            $result->bindValue(":ponto_rede",    $dados['txtPonto']);
            $result->bindValue(":id_rpm",    $dados['sel_rpm']);

            
            $result->execute();

            #Log::GravaLog("Atualizar Cadastro de Categoria : " . $dados['nome'] . " " . $_COOKIE['seguranca']['login'], "aju_log");

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao Atualizar dados Funcionario !";
        }
    }
    
    
    /**
     * Lista RPM
     */
    public static function rpm(){
        
        $con = Conexao::getInstance();
        
        $dados = array();
        
        $sql = "select id, nome from cedec_rpm order by nome;";
        
        $result = $con->query($sql);
        
        while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
            $dados[]= $linha;
        }
        return $dados;
    }
    
}
