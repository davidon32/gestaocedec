<?php

include_once(PATH . '/core/Controller/Controller.php');

class DefesaCivilAgoraModel {

    public function listaCategoria() {

        $dados = array();

        $con = Conexao::getInstance();

        $sql = "select categoria,
                    count(categoria) as qtd
                    from cedec_def_agora
                    group by categoria
                    order by categoria";

        $result = $con->query($sql);

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados[] = $linha;
        }

        return $dados;
    }

    public function listaPostagem($limit = 0) {

        $opcao = ($limit > 0) ? " limit 3 " : "";

        $dados = array();

        $con = Conexao::getInstance();

        $sql = "select id,
                        autor,
                        orgao,
                        imagem1,
                        texto,
                        categoria,
                        status1,
                        data_hora,
                        views
                        from cedec_def_agora
                        where status1 = 1 
                        order by data_hora desc " . $opcao;

        $result = $con->query($sql);

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados[] = $linha;
        }

        return $dados;
    }

    public static function listaRestantePostagem($retira = null) {

        $opcao = isset($retira) ? " and id not in('" . implode("','", $retira) . "')" : " ";

        $dados = array();

        $con = Conexao::getInstance();

        $sql = "select id,
                        autor,
                        orgao,
                        imagem1,
                        texto,
                        categoria,
                        status1,
                        data_hora,
                        views
                        from cedec_def_agora
                        where status1 = 1
                        " . $opcao . "
                        order by data_hora desc";

        $result = $con->query($sql);

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados[] = $linha;
        }

        return $dados;
    }

    /* paginacao */

    public function paginacao($page, $numPage) {

        $this->numPage = $numPage;

        $totalRegistro = count($this->listaRestantePostagem(null));

        $regPorPagina = $numPage;

        $totPag = ceil($totalRegistro / $numPage);

        $start = ($page - 1) * $regPorPagina;

        $paginacao = $this->paginacaoDados($start, $regPorPagina);

        return array($paginacao, $totPag);
    }

#################  PAGINACAO  ##################
    /* paginacao */

    public function paginacaoDados($start, $regPorPagina) {
        $con = Conexao::getInstance();

        $stmt = $con->prepare("select id,
                        autor,
                        orgao,
                        imagem1,
                        texto,
                        categoria,
                        status1,
                        data_hora,
                        views
                        from cedec_def_agora
                        where status1 = 1
                        order by data_hora desc LIMIT $start, $regPorPagina");
        $stmt->execute();

        $result = $stmt->fetchAll();

        return $result;
    }

    public static function select($sql) {

        $conexao = Conexao::getInstance()->query($sql);
        $dados = array();

        while ($linha = $conexao->fetch(PDO::FETCH_ASSOC)) {
            $dados[] = $linha;
        }

        return $dados;
    }

    public static function count($sql) {

        $conexao = Conexao::getInstance()->query($sql);

        $dados = $conexao->rowCount();

        return $dados;
    }

    public static function paginacao_dc_agora(array $dados) {

        $conexao = Conexao::getInstance();

        $result = new stdClass;
        $registro_por_pagina = $dados['qtd_registro'];
        $pagina_atual = isset($_GET['pag']) ? $_GET['pag'] : 1;
        $comeco_registro = ($pagina_atual == 1) ? 0 : ($pagina_atual * $registro_por_pagina) - $registro_por_pagina + 1;
        $limit = " limit " . $comeco_registro . ", " . $registro_por_pagina;

        if (!empty($dados['dados'])) {
            $result->dados = $dados['dados'];
            $registros = count($dados['dados']);
        } else {
            $tabela = $dados['tabela'];
            $registros = self::count("select *from " . $tabela);
            $sql = "select *from " . $tabela . " order by data_hora desc" . $limit;
            $result->dados = self::select($sql);
        }

        $total_registro = $registros;
        $total_pagina = ceil($total_registro / $registro_por_pagina);

        $pagina_anterior = ($pagina_atual > 1) ? ($pagina_atual - 1) : 1;

        $pagina_proxima = ($pagina_atual < $total_pagina) ? ($pagina_atual + 1) : $total_pagina;

######
        $rodape = ' <li class="page-item"><a class="page-link" href="?pag=1" title="Primeira Página">Primeira</a></li>&nbsp;
                    <li class="page-item"><a class="page-link"  href="?pag=' . $pagina_anterior . '" title="Página Anterior">Anterior</a>&nbsp;
                    <li class="page-item"><a class="page-link"  href="?pag=' . $pagina_proxima . '" title="Página Posterior">Proxima</a>&nbsp;
                    <li class="page-item"><a class="page-link"  href="?pag=' . $total_pagina . '" title="Última Página">Última</a>&nbsp;';


        $result->rodape = $rodape;

        return $result;
    }

    /* postagem com ID */

    public function postagem($id) {

        $dados = "";

        $con = Conexao::getInstance();

        $sql = "select id,
                        autor,
                        orgao,
                        imagem1,
                        texto,
                        categoria,
                        status1,
                        data_hora,
                        views,
                        nota
                        from cedec_def_agora
                        where id = " . $id;

        $result = $con->query($sql);

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados = $linha;
        }

        return $dados;
    }

    /* postagem com ID */

    public function postagemTermo($termo) {

        $dados = array();

        $con = Conexao::getInstance();

        $sql = "select id,
                        autor,
                        orgao,
                        imagem1,
                        texto,
                        categoria,
                        status1,
                        data_hora,
                        views
                        from cedec_def_agora
                        where texto like '%" . $termo . "%'";

        $result = $con->query($sql);

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

            $dados[] = $linha;
        }

        return $dados;
    }

    /* postagens recentes
      apos a lista mostrada */

    public static function post_recente() {

        $dados = array();

        $con = Conexao::getInstance();

        $sql = "select id,
                        autor,
                        orgao,
                        imagem1,
                        texto,
                        categoria,
                        status1,
                        data_hora,
                        views
                        from cedec_def_agora
                         order by rand() limit 5";

        $result = $con->query($sql);

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados[] = $linha;
        }

        return $dados;
    }

    public static function enumCategoria($cat) {

        switch ($cat) {
            case "ajuda_humanitaria":
                return "Ajuda Humanitaria";
                break;
            case "cedec-mg":
                return "CEDEC-MG";
                break;
            case "diligencia":
                return "Diligência";
                break;
            case "elogios_sugestoes":
                return "Elogios/Sugestões";
                break;
            case "mapeamento_de_area_de_risco":
                return "Mapeamento De Área De Risco";
                break;
            case "outros_descrever_no_texto_":
                return "Outros(Descrever No Texto)";
                break;
            case "programa_agua_doce":
                return "Programa Agua Doce";
                break;
            case "reuniao":
                return "Reunião";
                break;
            case "treinamento_capacitacao":
                return "Treinamento Capacitação";
                break;
            case "vistoria":
                return "Vistoria";
                break;
            default:
                break;
        }
    }

    /* postagem com ID */

    public function post_por_categoria($categoria) {

        $cat = self::enumCategoria($categoria);

        $dados = array();

        $con = Conexao::getInstance();

        $sql = "select id,
                        autor,
                        orgao,
                        imagem1,
                        texto,
                        categoria,
                        status1,
                        data_hora,
                        views
                        from cedec_def_agora
                        where categoria = '" . $cat . "' "
                . "order by rand() limit 30";

        $result = $con->query($sql);

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados[] = $linha;
        }

        return $dados;
    }

    # lista duas postagens aleatorias

    public function listaAleatorio() {

        $dados = array();

        $con = Conexao::getInstance();

        $sql = "SELECT DISTINCT texto,
                        id, autor,
                        orgao,
                        imagem1,
                        categoria,
                        status1,
                        data_hora,
                        views
                        from cedec_def_agora
                        order by rand() limit 100";

        $result = $con->query($sql);

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados[] = $linha;
        }

        return $dados;
    }

    # Pega os comentarios 

    public function getComentarios($id_post) {

        $dados = array();

        $con = Conexao::getInstance();

        $sql = "SELECT  id_coment,
                        data_coment,
                        nome,
                        texto
                        from cedec_def_coment
                        where id_post =" . $id_post . "
                        order by id_coment desc";


        $result = $con->query($sql);

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados[] = $linha;
        }

        return $dados;
    }

    /**
     * 
     * 
     */
    public function gravarPost($dados) {
        
        var_dump($dados);

        $con = Conexao::getInstance();

        $sql = "INSERT INTO cedec_def_agora(autor,
                                            orgao,
                                            imagem1,
                                            texto,
                                            categoria,
                                            status1,
                                            data_hora,
                                            nota,
                                            titulo)
                                                VALUES
                                                (:autor,
                                                :orgao,
                                                :imagem1,
                                                :texto,
                                                :categoria,
                                                :status1,
                                                :data_hora,
                                                :nota,
                                                :titulo)";

        try {

            $result = $con->prepare($sql);

            $result->bindValue(":autor",     $dados['nome']);
            $result->bindValue(":orgao",     $dados['orgao']);
            $result->bindValue(":imagem1",   $dados['imagem1']);
            $result->bindValue(":texto",     $dados['texto']);
            $result->bindValue(":categoria", $dados['categoria']);
            $result->bindValue(":status1",   $dados['status1']);
            $result->bindValue(":data_hora", $dados['data_hora']);
            $result->bindValue(":nota",      $dados['nota']);
            $result->bindValue(":titulo",    $dados['titulo']);

            $result->execute();
        } catch (Exception $e) {
            
            var_dump($e);
            
        }
    }
    
    /* incrementar visualizacao de post*/
    public function viewPost($id) {
        
        $con = Conexao::getInstance();

        $sql = "update cedec_def_agora
                    set views = views+1
                    where id = ".$id;
        $result = $con->query($sql);
        
    }

}
