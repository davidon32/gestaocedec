<?php include_once "core/Controller/Controller.php";
include_once "core/Model/Model.php";

class dashboardModel {
    
    /* compdec atualizados */
    public function atualizados() {
        
        $con = Conexao::getInstance();
        
        $dados = 0;
        
        $sql = "select count(id_comdec) as atualizado
                from com_comdec 
                where id_municipio != 7221 and ultimo_atualiza >= (select now() - interval 1 year)";
        
        $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados = $linha['atualizado'];
            }
            
            return $dados;
        
    }
    
    /* compdec desatualizados */
    public function desatualizados() {
        
        $con = Conexao::getInstance();
        
        $dados = 0;
        
        $sql = "select count(id_comdec) as atualizado
                from com_comdec 
                where id_municipio != 7221 and ultimo_atualiza <= (select now() - interval 1 year)";
        
        $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados = $linha['atualizado'];
            }
            return $dados;
    }
    
    /* possui compdec */
    public function possuicompdec() {
        
        $con = Conexao::getInstance();
        
        $dados = 0;
        
        $sql = "select count(id_comdec) as atualizado
                from com_comdec 
                where id_municipio != 7221 and ultimo_atualiza <= (select now() - interval 1 year)";
        
        $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados = $linha['atualizado'];
            }
            return $dados;
    }
    
    
    
}

