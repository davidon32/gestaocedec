<?php include_once PATH."/core/Controller/Controller.php";
include_once PATH."/core/Model/Model.php";

class dashboardModel {
    
    /* compdec atualizados */
    public static function CompdecAtualizados() {
        
        $con = Conexao::getInstance();
        
        $dados = 0;
        
        $sql = "select count(id_comdec) as atualizado
                from com_comdec 
                where id_municipio != 7221 and ultimo_atualiza >= (select now() - interval 1 year)
                and ultimo_atualiza != '2021-08-13 08:37:45'";
        
        $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados = $linha['atualizado'];
            }
            
            return $dados;
        
    }
    
    /* compdec desatualizados */
    public function CompdecDesatualizados() {
        
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
    public function Possuicompdec() {
        
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
    
    
    /* PMDA por Ano*/
    public function PmdaPorAno($ano = "") {
        
        $filtro = empty($ano) ? "" : " and year(pip_pmda.data) = '".$ano."'";
        
        $con = Conexao::getInstance();
        
        $dados = array();
        
        $sql = "select year(pip_pmda.data) as ano,
                        count(pip_pmda.id_pmda) as id_pmda from pip_pmda
                        where status = 7 ".$filtro."
                        group by year(pip_pmda.data)";
        
        $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados[] = $linha;
            }
            return $dados;
    }
    
    /* PMDA por Ano/ por mEs*/
    public function PmdaPorAnoMes($ano) {
        
        $filtro = empty($ano) ? "" : " and year(pip_pmda.data) = '".$ano."'";
        
        $con = Conexao::getInstance();
        
        $dados = array();
        
        $sql = "select year(pip_pmda.data) as ano,
                    month(pip_pmda.data) as mes,
                        count(pip_pmda.id_pmda) as qtd from pip_pmda
                        where status = 7  ".$filtro."
                        group by year(pip_pmda.data), month(pip_pmda.data)
                        order by year(pip_pmda.data), month(pip_pmda.data)";
        
        $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados[] = $linha;
            }
            return $dados;
    }
    
    
    
    
    /* Pmda Status */
    public function PmdaPorStatus() {
        
        $con = Conexao::getInstance();
        
        $dados = array();
        
        $sql = "select pip_pmda.status as status, count(pip_pmda.status) as qtd, 
                    CASE
                        WHEN pip_pmda.status = 0 THEN 'Em Edição'
                        WHEN pip_pmda.status = 1 THEN 'Completo'
                        WHEN pip_pmda.status = 2 THEN 'Em Análise'
                        WHEN pip_pmda.status = 3 THEN 'Arquivado'
                        WHEN pip_pmda.status = 4 THEN 'Aprovado'
                        WHEN pip_pmda.status = 5 THEN 'Anulado'
                        WHEN pip_pmda.status = 6 THEN 'nulo'
                        WHEN pip_pmda.status = 7 THEN 'Atendido'
                        WHEN pip_pmda.status = 9 THEN 'Encerrado'
                        ELSE '-'
                    END as status
                    from pip_pmda
                    group by pip_pmda.status";
        
        $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados[] = $linha;
            }
            return $dados;
    }
    
    /* qtd pmda provados por ano  */
    public static function QtdPmdaAno($ano = "") {
        
        $con = Conexao::getInstance();
        
        $filtro = (!empty($ano)) ? "  and year(pip_pmda.data) = '".$ano."' " : "";
        
        $dados = array();
        
        $sql = "select year(pip_pmda.data) as ano,
                        count(pip_pmda.id_pmda) as qtd from pip_pmda
                        where status = 7
                        group by year(pip_pmda.data);";
        
        $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados[] = $linha;
            }
            return $dados;
    }
    
    /* qtd pmda provados por mes  */
    public static function qtdPmdaMes($ano ="", $mes = "") {
               
        $con = Conexao::getInstance();
        $filtroAno = (!empty($ano)) ? "  and year(pip_pmda.data) = '".$ano."' " : "";
        $filtroMes = (!empty($mes)) ? "  and month(pip_pmda.data) = '".$mes."' " : "";
        
        $dados = array();
        
        
        $sql = "select month(pip_pmda.data) as numMes, count(pip_pmda.id_pmda) as qtd,
                    CASE
                        WHEN month(pip_pmda.data) = '1' THEN 'Janeiro'
                        WHEN month(pip_pmda.data) = '2' THEN 'Fevereiro'
                        WHEN month(pip_pmda.data) = '3' THEN 'Março'
                        WHEN month(pip_pmda.data) = '4' THEN 'Abril'
                        WHEN month(pip_pmda.data) = '5' THEN 'Maio'
                        WHEN month(pip_pmda.data) = '6' THEN 'Junho'
                        WHEN month(pip_pmda.data) = '7' THEN 'Julho'
                        WHEN month(pip_pmda.data) = '8' THEN 'Agosto'
                        WHEN month(pip_pmda.data) = '9' THEN 'Setembro'
                        WHEN month(pip_pmda.data) = '10' THEN 'Outubro'
                        WHEN month(pip_pmda.data) = '11' THEN 'Novembro'
                        WHEN month(pip_pmda.data) = '12' THEN 'Dezembro'
                        ELSE 'Mes Inválido'
                    END as mes
                     from pip_pmda
                        where status = 7 ".$filtroAno." ".$filtroMes."
                            group by month(pip_pmda.data);";
        $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados[] = $linha;
            }
            return $dados;
    }
      

    
}

