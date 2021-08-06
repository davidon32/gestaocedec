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

class FuncionarioEquipeModel extends Model {
    
    
    public static function lista($id_funcionario){
        
        $con = Conexao::getInstance();
        
        $dados = "";
        
        $sql = "SELECT id_funcionario,
                num_masp,
                nome,
                endereco,
                bairro,
                cidade,
                telefone,
                celular,
                posto,
                secao,
                funcao,
                desc_funcao,
                quinquenio,
                dt_nasc,
                curso,
                email,
                libera,
                email2,
                situacao,
                cpf,
                orgao,
                cargo,
                ci,
                tipo_abono,
                ramal,
                num_mesa,
                ponto_rede
                    FROM cedec_funcionario
                    WHERE id_funcionario =".$id_funcionario;
        
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
                        ponto_rede = :ponto_rede
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

            
            $result->execute();

            #Log::GravaLog("Atualizar Cadastro de Categoria : " . $dados['nome'] . " " . $_COOKIE['seguranca']['login'], "aju_log");

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao Atualizar dados Funcionario !";
        }
    }
    
}
