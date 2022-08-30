<?php

class Registro {
    
    
    protected $id;
    protected $desalojado;
    protected $dt_desalojado;
    protected $desabrigado;
    protected $dt_desabrigado;
    
    private $desalojados;


    /**
     * Gravar Registro de danos Humanos
    */
    public function reg_danos_humanos($registro) {
        
        $con = Conexao::getInstance();
        
        $registro['id_municipio'] = $_COOKIE['seguranca']['id_municipio'];
        
        
        try {

            $sql = "INSERT INTO reg_danos_humanos (desalojado, dt_desalojado, desabrigado, municipio_id)
                     value (:desalojado, :dt_desalojado, :desabrigado, :id_municipio)";
            
            $result = $con->prepare($sql);
            $result->bindValue(":desalojado", $registro['desalojado']);
            $result->bindValue(":dt_desalojado", $registro['dt_registro']);
            $result->bindValue(":desabrigado", $registro['desabrigado']);
            $result->bindValue(":id_municipio", $registro['id_municipio']);
            
            return $result->execute();
            
        } catch (Exception $e) {    
            
            if( strpos($e->getMessage(), 'Duplicate') ) {
                return 'duplicado';
                
            }else {
                return $e->getMessage();
            }
        }

    }
    
    public function listaGeral($id_municipio = 0) {
        
        $con = Conexao::getInstance();
        
        try {
            if($id_municipio == 0) {
                $sql = "Select *from reg_danos_humanos order by dt_desalojado desc";
            }elseif((int)$id_municipio){
                $sql = "Select *from reg_danos_humanos where municipio_id = {$id_municipio} order by dt_desalojado desc";  
            }
            
            $result = $con->query($sql);
            $result->execute();
                      
            return $result->fetchAll();
            
        } catch (Exception $e) {     
            print $e->getMessage();    
        }

    }
    
    
    /**
     * 
     * Lista grafico
     */
    public function grafico($dados) {
        
        $con = Conexao::getInstance();
        
        try {
            
                $sql = "SELECT cedec_municipio.nome,
                            max(reg_danos_humanos.desabrigado) AS desabrigado,
                            max(reg_danos_humanos.desalojado) AS desabrigado
                            FROM reg_danos_humanos
                            INNER JOIN cedec_municipio
                            ON reg_danos_humanos.municipio_id = cedec_municipio.id_municipio
                            GROUP BY reg_danos_humanos.municipio_id
                            ORDER BY cedec_municipio.id_municipio";  
           
            
            $result = $con->query($sql);
            $result->execute();
                      
            return $result->fetchAll();
            
        } catch (Exception $e) {     
            print $e->getMessage();    
        }
        
    }
    
    
    
    
    
}

