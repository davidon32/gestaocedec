<?php

Class RelatorioComdec {

    function RelatorioInfoComdec($tabela) {

        $sql = 'SELECT column_name FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = "gestaocedec" AND TABLE_NAME = "' . $tabela . '"';

        print $sql;

        $query = mysql_query($sql) or die(mysql_error());

        var_dump(mysql_num_rows($query));

        if (mysql_num_rows($query) > 0) {

            $dados = array();

            while ($linha = mysql_fetch_array($query)) {

                $dados[] = $linha;
            }

            return $dados;
        } else {

            print 'erro na';
        }
    }

    /**
     *  Relatorios de Compdec por associacao 
     * 
     */
    function relCompdecAssociacao($_sel_associacao) {

        $con = Conexao::getInstance();

        $_dados = array();
        $_filtro = "";

        if ($_sel_associacao == "") {

            $_filtro = " ";
        } else {

            $_filtro = "AND com_comdec.associacao = " . $_sel_associacao;
        }

        $sql = "SELECT cedec_municipio.nome as nome,
                           com_regiao.nome as nom_regiao,
                           com_comdec.num_lei as num_lei,
                           com_comdec.dt_lei as dt_lei,
                           com_comdec.num_decreto as num_decreto,
                           com_comdec.dt_decreto as dt_decreto,
                           com_comdec.num_portaria as num_portaria,
                           com_comdec.dt_portaria as dt_portaria,
                           com_associacao.sigla as sigla,
                           com_comdec.id_comdec as id_comdec
                            FROM com_comdec
                            INNER JOIN cedec_municipio
                            ON com_comdec.id_municipio = cedec_municipio.id_municipio
                            INNER JOIN com_regiao
                            ON com_comdec.regiao = com_regiao.id_regiao
                            INNER JOIN com_associacao 
                            ON com_comdec.associacao = com_associacao.id_associacao
                            WHERE com_comdec.num_lei <> 0 " . $_filtro . "
                            ORDER BY com_associacao.sigla, cedec_municipio.nome";

        $result = $con->query($sql);

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

            $_dados[] = $linha;
        }

        return $_dados;
    }

    /**
     * Relatorio de compdec por endereco
     * 
     * 
     */
    function relCompdecEndereco() {

        $con = Conexao::getInstance();

        $dados = array();

        $sql = "SELECT cedec_municipio.nome AS nome,
            		cedec_municipio.id_municipio,
                    com_comdec.endereco,
                    com_comdec.fone_com1,
                    com_comdec.email,
                    com_comdec.id_comdec,
            		com_comdec.ultimo_atualiza
                    FROM com_comdec
                    INNER JOIN cedec_municipio
                    ON com_comdec.id_municipio = cedec_municipio.id_municipio
                    WHERE com_comdec.com_const = 1
                    ORDER BY cedec_municipio.nome";

        $result = $con->query($sql);

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

            $dados[] = $linha;
        }

        return $dados;
    }

    /**
     *  Relatorios de Compdec por Região 
     * 
     */
    function relCompdecRegiao($_sel_regiao) {

        $con = Conexao::getInstance();
        $_dados = array();
        $_filtro = "";

        if ($_sel_regiao == "") {

            $_filtro = " ";
        } else {

            $_filtro = "AND com_comdec.regiao = " . $_sel_regiao;
        }

        $sql = "SELECT cedec_municipio.nome as nome,
                           cedec_municipio.email as email_pref,
                           com_associacao.nome as nom_associacao,
                           com_comdec.num_lei as num_lei,
                           com_comdec.dt_lei as dt_lei,
                           com_comdec.num_decreto as num_decreto,
                           com_comdec.dt_decreto as dt_decreto,
                           com_comdec.num_portaria as num_portaria,
                           com_comdec.dt_portaria as dt_portaria,
                           com_comdec.email as email_compdec,
                           com_regiao.nome as regiao,
                           com_comdec.id_comdec
                            FROM com_comdec
                            INNER JOIN cedec_municipio
                            ON com_comdec.id_municipio = cedec_municipio.id_municipio
                            INNER JOIN com_associacao
                            ON com_comdec.associacao = com_associacao.id_associacao
                            INNER JOIN com_regiao 
                            ON com_comdec.regiao = com_regiao.id_regiao 
                            WHERE com_comdec.num_lei <> 0 " . $_filtro . "
                            ORDER BY com_comdec.regiao, cedec_municipio.nome";

        #print $sql;

        $result = $con->query($sql);

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

            $_dados[] = $linha;
        }

        return $_dados;
    }
    
    
    /**
     *  Relatorios de Compdec por Região de DEFESA CIVIL
     * 
     */
    function relCompdecRegiaoDC($_sel_regiao) {

        $con = Conexao::getInstance();
        $_dados = array();
        $_filtro = "";

        if ($_sel_regiao == "0") {

            $_filtro = " ";
        } else {

            $_filtro = " AND cedec_rpm_mun.id_rpm = " . $_sel_regiao;
        }

        $sql = "SELECT cedec_municipio.id_municipio,
                cedec_municipio.nome AS municipio,
                com_comdec.id_comdec,
                com_comdec.email AS email_compdec,
                com_comdec.com_const as compdec_existe,
                com_comdec.com_ativa as compdec_ativa,
                com_comdec.nudec as nupdec,
                cedec_prefeitura.email AS email_prefeito,
                cedec_rpm_mun.id_rpm,
                cedec_rpm_mun.nome AS regiaorpm,
                cedec_rpm_mun.nome_rdc as regiaodc
                FROM cedec_municipio
                INNER JOIN cedec_prefeitura
                ON cedec_municipio.id_municipio = cedec_prefeitura.id_municipio
                INNER JOIN com_comdec
                ON cedec_municipio.id_municipio = com_comdec.id_municipio
                INNER JOIN cedec_rpm_mun
                ON cedec_municipio.id_municipio = cedec_rpm_mun.id_municipio
                WHERE cedec_municipio.id_municipio <> '7221'". $_filtro." ORDER BY id_rpm";

//        print $sql;

        $result = $con->query($sql);

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

            $_dados[] = $linha;
        }

        return $_dados;
    }

    /**
     *  Relatorios de compdec existente
     * 
     */
    function relCompdec($ativo = 2) {
        
        $con = Conexao::getInstance();
        $_dados = array();
        
        $filtro = "";

        #todos
        if($ativo == ""){
            $filtro = "";
        #inativo
        }elseif ($ativo == '0') {
            $filtro = " and com_const = 0 ";
            
        #ativo
        } elseif ($ativo == '1') {
            $filtro = " and com_const = 1 ";
        }

        $sql = "SELECT r.nome as regiao, 
                           m.nome as municipio,
                           c.num_lei,
                           c.num_decreto,
                           c.num_portaria,
                           c.endereco,
                           c.fone_com1,
                           c.fone_com2,
                           c.email,
                           c.dt_lei,
                           c.dt_decreto,
                           c.dt_portaria,
                           c.id_comdec,
                           c.com_const,
                           c.nudec,
                           cedec_rpm_mun.nome as rpm,
                           aju_deposito.nome as da
                               FROM com_comdec c
                               INNER JOIN com_regiao r
                               ON c.regiao = r.id_regiao
                               INNER JOIN cedec_municipio m
                               ON c.id_municipio = m.id_municipio
                               inner join cedec_rpm_mun
                               on c.id_municipio = cedec_rpm_mun.id_municipio
                               inner join aju_deposito
                               on cedec_rpm_mun.id_rpm = aju_deposito.id_rpm
                               WHERE m.id_municipio != '7221' $filtro
                               ORDER BY c.com_const desc, m.nome, r.nome";
        
        $result = $con->query($sql);

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

            $_dados[] = $linha;
        }

        return $_dados;
    }

    /**
     *  Relatorios lista plano cont
     * 
     */
    function relGeralPlano() {

        $con = Conexao::getInstance();
        $_dados = array();

        $sql = "select distinct cedec_municipio.nome,
                    com_plano_upload.file_plano,
                    com_plano_upload.dt_upload,
                    count(com_plano_upload.file_plano) as qtd_plano
                        from cedec_municipio
                            LEFT join com_plano_upload
                            on cedec_municipio.id_municipio = com_plano_upload.id_municipio
                            where cedec_municipio.nome <> \"MUNICIPIO TESTE\"
                            group by cedec_municipio.nome
                            order by cedec_municipio.nome";

        $result = $con->query($sql);

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

            $_dados[] = $linha;
        }

        return $_dados;
    }

    /**
     *  Relatorios count plano
     * 
     */
    function countPlanoPorMunicipio() {

        $con = Conexao::getInstance();
        $_dados = array();

        $sql = "select cedec_municipio.nome,
                com_plano_upload.id_municipio, 
                count(com_plano_upload.file_plano) as qtd
                from com_plano_upload
                inner join cedec_municipio
                on com_plano_upload.id_municipio = cedec_municipio.id_municipio
                where com_plano_upload.id_municipio <> '7221'
                group by id_municipio
                order by cedec_municipio.nome";

        $result = $con->query($sql);

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            
            $_dados[] = $linha;
        }

        return $_dados;
    }
    
    /**
     *  Relatorios count plano
     * 
     */
    function countPlanoPorMunicipioIds($dados) {

        $con = Conexao::getInstance();
        $_dados = array();

        $sql = "select cedec_municipio.nome,
                com_plano_upload.id_municipio, 
                count(com_plano_upload.file_plano) as qtd
                
                from com_plano_upload
                inner join cedec_municipio
                on com_plano_upload.id_municipio = cedec_municipio.id_municipio
                where com_plano_upload.id_municipio <> '7221'
                and com_plano_upload.id_municipio in (".$dados.")
                group by id_municipio
                order by cedec_municipio.nome";
        

        $result = $con->query($sql);

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            
            $_dados[] = $linha;
        }

        return $_dados;
    }
    
    /**
     *  Lista o plano do municipio
     * 
     */
    function listPlano() {

        $con = Conexao::getInstance();
        $_dados = array();

        $sql = "select cedec_municipio.nome,
                    com_plano_upload.id_municipio,
                    com_plano_upload.file_plano,
                    com_plano_upload.dt_upload
                        from com_plano_upload
                        inner join cedec_municipio
                        on com_plano_upload.id_municipio = cedec_municipio.id_municipio
                        where com_plano_upload.id_municipio <> 7221
                            order by cedec_municipio.nome";
        
        $result = $con->query($sql);

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            
            $_dados[] = $linha;
        }

        return $_dados;
    }
    

    /**
     *  Relatorios lista municipio sem plano
     * 
     */
    function relSemPlano() {

        $con = Conexao::getInstance();
        $_dados = array();

        $sql = "select distinct cedec_municipio.id_municipio, cedec_municipio.nome,
                    com_plano_upload.file_plano,
                    com_plano_upload.dt_upload,
                    count(com_plano_upload.file_plano) as qtd_plano
                        from cedec_municipio
                            left join com_plano_upload
                            on cedec_municipio.id_municipio = com_plano_upload.id_municipio
                            where cedec_municipio.nome <> \"MUNICIPIO TESTE\"
                            and com_plano_upload.file_plano is null
                            group by cedec_municipio.nome
                            order by cedec_municipio.nome";

        $result = $con->query($sql);

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

            $_dados[] = $linha;
        }

        return $_dados;
    }

    /**
     * 
     * Relatório de Compeds por Território de Desenvolvimento
     * 
     */
    function relCompdecRegiaoDesenvolvimento() {

        $con = Conexao::getInstance();

        $_dados = array();

        $sql = "SELECT cedec_municipio.nome as municipio,
                           com_comdec.endereco,
                           com_comdec.fone_com1,
                           com_comdec.fone_com2,
                           com_comdec.num_lei,
                           com_comdec.id_territorio,
                           com_comdec.id_comdec,
            			   com_territ_desenv.nome as nomTerritorio
                               FROM com_comdec
                               INNER JOIN cedec_municipio
                               ON com_comdec.id_municipio = cedec_municipio.id_municipio
            				   INNER JOIN com_territ_desenv
            				   ON com_comdec.id_territorio = com_territ_desenv.id_territ
                                           where cedec_municipio.id_municipio != 7221
                               ORDER BY cedec_municipio.territorio_desenv";

        $result = $con->query($sql);

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

            $_dados[] = $linha;
        }

        return $_dados;
    }

    /**
     *  Relatorios de compdec por data criação 
     * 
     */
    function relCompdecDtCriacao($_dt_inicial) {

        $con = Conexao::getInstance();
        $_dados = array();

        $sql = "SELECT r.nome as regiao, 
                           m.nome as municipio,
                           c.num_lei,
                           c.num_decreto,
                           c.num_portaria,
                           c.endereco,
                           c.fone_com1,
                           c.fone_com2,
                           c.email,
                           c.dt_lei,
                           c.dt_decreto,
                           c.dt_portaria,
                           c.id_comdec
                               FROM com_comdec c
                               INNER JOIN com_regiao r
                               ON c.regiao = r.id_regiao
                               INNER JOIN cedec_municipio m
                               ON c.id_municipio = m.id_municipio
                               WHERE c.dt_lei >= :dt_inicial
                               AND c.num_lei <> 0
                               ORDER BY r.nome, c.dt_lei";

        $result = $con->prepare($sql);
        $result->bindParam(":dt_inicial", $_dt_inicial);
        $result->execute();

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

            $_dados[] = $linha;
        }

        return $_dados;
    }

    /* busca Coordenador COMPDEC */

    public function buscaCoordenador($id_municipio) {

        $dados = array();
        $con = Conexao::getInstance();

        $sql = "select *from com_eq_comdec where funcao = \"Coordenador\" and id_municipio = :id_municipio";

        $result = $con->prepare($sql);
        $result->bindParam(":id_municipio", $id_municipio);
        $result->execute();

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados = $linha;
        }

        return $dados;
    }

    /* email compdec existente */

    public static function emailCompExist($ativo = 1) {

        $con = Conexao::getInstance();
        $_dados = array();

        $filtro = "";

        if ($ativo == 0) {
            $filtro = " and com_const = 0 ";
        } elseif ($ativo == 1) {
            $filtro = "  and com_eq_comdec.funcao = \"Coordenador\" and com_const = 1 ";
        } else {
            $filtro = "";
        }

        $sql = "SELECT com_comdec.email,
                    cedec_municipio.nome as nome_municipio,
                    com_eq_comdec.nome as coordenador
                    FROM com_comdec
                    inner join cedec_municipio
                    on com_comdec.id_municipio = cedec_municipio.id_municipio
                    inner join com_eq_comdec
                    on com_comdec.id_municipio = com_eq_comdec.id_municipio
                    where com_comdec.id_comdec != \"7221\" " . $filtro . " 
                    order by com_comdec.id_comdec limit 3";

        $result = $con->query($sql);

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

            $dados[] = array('address' => $linha['email'],
                'name' => 'Municipio ' . $linha['nome_municipio'] . 'Coordenador ' . $linha['coordenador']);
        }

        return $_dados;
    }
    
    
    /**
     *  relacao simples de planos hospeados no sdc
     */
    public function listaTodosPlanos() {
        
        $con = Conexao::getInstance();

        $sql = "select DISTINCT com_plano_upload.id_municipio,  
                            cedec_municipio.nome                  
                            from com_plano_upload
                            INNER JOIN cedec_municipio
                            ON com_plano_upload.id_municipio = cedec_municipio.id_municipio
                            where com_plano_upload.id_municipio <> 7221";

        $result = $con->query($sql);

        return $result->fetchAll();
        
    }
}
