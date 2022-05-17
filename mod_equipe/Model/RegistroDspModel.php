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
    
     /* lista de integrantes da dsp */
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
    
    
     /* lista de integrantes da dsp */
    public static function listaDsp($limit = 0){
        
        $registros = ($limit > 0) ? $limit : "";
        
        
        $con = Conexao::getInstance();
        
        $dados = array();
        
        $sql = "select id_reg_dsp, 
            data_hora,
            objetivo,
            ids_evento,
            data_hora_inicio,
            data_hora_fim,
            historico,
            obs,
            ids_municipio,
            ids_viatura, 
            ids_integrante
                from equ_reg_dsp                                        
                    ORDER BY id_reg_dsp DESC
                    limit ".$registros;
                
        $result = $con->query($sql);
        
        while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
            $dados[] = $linha;
        }
        return $dados;
        
    }
     /* lista de integrantes da dsp */
    public static function SearchDsp($id_dsp){
        
        $con = Conexao::getInstance();
        
        $dados = "";
        
        $sql = "select id_reg_dsp, 
            data_hora,
            objetivo,
            ids_evento,
            data_hora_inicio,
            data_hora_fim,
            historico,
            obs,
            ids_municipio,
            ids_viatura, 
            ids_integrante
                from equ_reg_dsp
                    WHERE id_reg_dsp = ".$id_dsp;
                
        $result = $con->query($sql);
        
        while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
            $dados = $linha;
        }
        return $dados;
        
    }
    
    
     /* lista de Anexo  */
    public static function listAnexo($id_dsp){
        
        $con = Conexao::getInstance();
        
        $dados = array();
        
        $sql = "select id_doc, 
                    nome,
                    data_hora
                from equ_reg_dsp_doc
                    WHERE id_dsp = ".$id_dsp;
                
        $result = $con->query($sql);
        
        while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
            $dados[] = $linha;
        }
        return $dados;
        
    }
 


################  Atualizar dados dps  ###################

    public static function edit(array $dados) {
        
 
        $con = Conexao::getInstance();

        $sql = "UPDATE equ_reg_dsp
                        SET data_hora = :data_hora,
                            objetivo = :objetivo,
                            ids_evento = :ids_evento,
                            data_hora_inicio = :data_hora_inicio,
                            data_hora_fim = :data_hora_fim,
                            historico = :historico,
                            obs = :obs,
                            ids_municipio = :ids_municipio,
                            ids_viatura = :ids_viatura,
                            ids_integrante = :ids_integrante
                            WHERE id_reg_dsp = :id_reg_dsp";

        try {

            $result = $con->prepare($sql);
            
            $result->bindValue(":data_hora"        ,DataMysql::dataForm($dados["data_hora"]));
            $result->bindValue(":objetivo"         ,$dados["txtObj"]);
            $result->bindValue(":ids_evento"       ,implode("|",$dados["evento"]));
            $result->bindValue(":data_hora_inicio" ,DataMysql::dataCompletaForm($dados["datetime_inicio"]));
            $result->bindValue(":data_hora_fim"    ,DataMysql::dataCompletaForm($dados["datetime_final"]));
            $result->bindValue(":historico"        ,$dados["txtHist"]);
            $result->bindValue(":obs"              ,$dados["txtObs"]);
            $result->bindValue(":ids_municipio"    ,implode("|",$dados["states"]));
            $result->bindValue(":ids_viatura"      ,implode("|",$dados["viatura"]));
            $result->bindValue(":ids_integrante"   ,implode("|",$dados["integrante"]));
            $result->bindValue(":id_reg_dsp"       ,$dados["id_reg_dsp"]);

            
            $result->execute();

            #Log::GravaLog("Atualizar Cadastro de Categoria : " . $dados['nome'] . " " . $_COOKIE['seguranca']['login'], "aju_log");

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao Atualizar dados DSP !";
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
    
    
     /**
     * Busca por registro
     * @param type $text
     * @return type
     * 
     */
    public static function search($text){
        
        $con = Conexao::getInstance();
        $dados = array();
        
        
        $ids_evento = FuncaoBase::buscaIds('dec_cobrade', 'id_cobrade', 'descricao', $text);
        $ids_viatura = FuncaoBase::buscaIds('equ_reg_dsp_viatura', 'id_viatura', 'placa', $text);
        $ids_municipio = FuncaoBase::buscaIds('cedec_municipio', 'id_municipio', 'nome', $text);
        
        if(!empty($ids_viatura)) {
            $viatura = "OR ids_viatura in (".$ids_viatura.")";
        }
        var_dump(implode(",", $ids_viatura));
        
        $sql = "SELECT * FROM equ_reg_dsp
                        WHERE data_hora LIKE '%".$text."%' 
                        OR objetivo LIKE '%".$text."%'
                        OR historico LIKE '%".$text."%'
                        OR obs LIKE '%".$text."%'
                        OR ids_evento in (".$ids_evento.")
                        OR ids_municipio in (".$ids_municipio.")
                        ".$viatura."";
        
        var_dump($sql);

        $result = $con->query($sql);
        
        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados[] = $linha;            
        }

        return $dados;
 
    }
    
    
    /* upload de documentos  */
    
    public static function upload_doc() {
            
        $dados = isset($_POST) ? $_POST :"";

         try { 
             
            if( isset($_FILES['fl_doc_dsp']) && ($_FILES['fl_doc_dsp']['error'] == 0) ) {
                #upload
                var_dump(Upload2mb::upload("/anexo/reg_dsp"));
                
            }
                
            $con = Conexao::getInstance();

            $sql = "insert into equ_reg_dsp_doc (nome,
                                             data_hora,
                                             id_dsp) values (:nome,
                                                            :data_hora,
                                                            :id_dsp)" ;
                $result = $con->prepare($sql);

                $result->bindValue(":nome",        $dados['notNormalizaLinkGoogle']);
                $result->bindValue(":data_hora",   $dados['data_hora']." ".date('H:i:s'));
                $result->bindValue(":id_dsp",         $dados['id_dsp']);

                $result->execute();
                
                
            
            return true;
        } catch (Exception $e){
            return false;
        }

        
        
    }
    
    
    
}
