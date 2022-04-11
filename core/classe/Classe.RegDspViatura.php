<?php 

class RegDspViatura {
    
   static function Gravar($post) {
        $con = Conexao::getInstance();

        $sql = "INSERT INTO equ_reg_dsp_viatura (placa,
                                                    placa_seguranca,
                                                    modelo,
                                                    marca,
                                                    ano,
                                                    nome,
                                                    obs) VALUES (:placa,
                                                                    :placa_seguranca,
                                                                    :modelo,
                                                                    :marca,
                                                                    :ano,
                                                                    :nome,
                                                                    :obs)";

        $result = $con->prepare($sql);
        $result->bindParam(":placa", $_POST['txtPlaca']);
        $result->bindParam(":placa_seguranca",$_POST['txtPlacaSeg']);
        $result->bindParam(":modelo",$_POST['txtModelo']);
        $result->bindParam(":marca",$_POST['txtMarca']);
        $result->bindParam(":ano",$_POST['txtAno']);
        $result->bindParam(":nome",$_POST['txtNome']);
        $result->bindParam(":obs",$_POST['txtObs']);
        $result->execute();

        return true;
    } 
    
    static function GravarEdicao($post) {
        $con = Conexao::getInstance();

        $sql = "UPDATE equ_reg_dsp_viatura set placa = :placa,
                                                placa_seguranca = :placa_seguranca,
                                                modelo = :modelo,
                                                marca = :marca,
                                                ano = :ano,
                                                nome = :nome,
                                                obs = :obs) VALUES (:placa,
                                                                    :placa_seguranca,
                                                                    :modelo,
                                                                    :marca,
                                                                    :ano,
                                                                    :nome,
                                                                    :obs)";

        $result = $con->prepare($sql);
        $result->bindParam(":placa", $_POST['txtPlaca']);
        $result->bindParam(":placa_seguranca",$_POST['txtPlacaSeg']);
        $result->bindParam(":modelo",$_POST['txtModelo']);
        $result->bindParam(":marca",$_POST['txtMarca']);
        $result->bindParam(":ano",$_POST['txtAno']);
        $result->bindParam(":nome",$_POST['txtNome']);
        $result->bindParam(":obs",$_POST['txtObs']);
        $result->execute();

        return true;
    } 
    
    public static function search($text){
        
        $con = Conexao::getInstance();
        $dados = array();
        
        $sql = "SELECT * FROM equ_reg_dsp_viatura
                        WHERE nome LIKE '%".$text."%' 
                        OR placa LIKE '%".$text."%'
                        OR placa_seguranca LIKE '%".$text."%'
                        OR modelo LIKE '%".$text."%'
                        OR marca LIKE '%".$text."%'
                        OR ano LIKE '%".$text."%'
                        OR obs LIKE '%".$text."%'";

        $result = $con->query($sql);
        
        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados[] = $linha;            
        }

        return $dados;
 
    }
    
    
    public static function searchId($id){
        
        $con = Conexao::getInstance();
        $dados = array();
        
        $sql = "SELECT * FROM equ_reg_dsp_viatura
                        WHERE id_viatura = ".$id;

        $result = $con->query($sql);
        
        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados = $linha;            
        }

        return $dados;
 
    }
    
    
    
    
}?>