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

        if (!isset($registro['cedec'])) {
            $registro['id_municipio'] = $_COOKIE['seguranca']['id_municipio'];
        }


        try {

            /* nao existir registro ja lancado */
            if (self::buscaLancamento($registro)) {

                $sql = "INSERT INTO reg_danos_humanos (desalojado, dt_desalojado, desabrigado, municipio_id)
                         value (:desalojado, :dt_desalojado, :desabrigado, :id_municipio)";

                $result = $con->prepare($sql);
                $result->bindValue(":desalojado", $registro['desalojado']);
                $result->bindValue(":dt_desalojado", $registro['dt_registro']);
                $result->bindValue(":desabrigado", $registro['desabrigado']);
                $result->bindValue(":id_municipio", $registro['id_municipio']);

                return $result->execute();
            } else {
                return 'duplicado';
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Busca registro ja lancado
     * @param type $id_municipio
     * @return type
     */
    public static function buscaLancamento($registro) {
        $con = Conexao::getInstance();
        $sql = "SELECT count(*) FROM reg_danos_humanos
               WHERE dt_desalojado = '{$registro['dt_registro']}'
                AND municipio_id = {$registro['id_municipio']}";

        $result = $con->query($sql);
        return ($result->fetchColumn() == 0) ? true : false;
    }

    public function listaGeral($id_municipio = 0) {

        $con = Conexao::getInstance();

        try {
            if ($id_municipio == 0) {
                $sql = "Select *from reg_danos_humanos order by dt_desalojado desc";
            } elseif ((int) $id_municipio) {
                $sql = "Select *from reg_danos_humanos where municipio_id = {$id_municipio} order by dt_desalojado desc";
            }

            $result = $con->query($sql);
            $result->execute();

            return $result->fetchAll();
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }
    
    public function listaPorMunicipio_data($id_municipio = 0, $data =null) {

        $con = Conexao::getInstance();

        try {
            
                $sql = "SELECT cedec_municipio.nome, dt_desalojado, municipio_id, desalojado, desabrigado
                            FROM reg_danos_humanos
                            INNER JOIN cedec_municipio
                            ON reg_danos_humanos.municipio_id = cedec_municipio.id_municipio
                            where reg_danos_humanos.municipio_id = {$id_municipio}
                            AND reg_danos_humanos.dt_desalojado = '{$data}'
                            GROUP BY municipio_id
                            ORDER BY cedec_municipio.nome";


            $result = $con->query($sql);
            $result->execute();

            return $result->fetchAll();
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }


    /**
     * Lista de ultima posição dos afetados por municipio
     * @param type $id_municipio
     * @return type
     */
    public function listaPorMunicipio($id_municipio = 0) {

        $con = Conexao::getInstance();

        try {
            if ($id_municipio == 0) {
                $sql = "SELECT cedec_municipio.nome, max(dt_desalojado) as dt, municipio_id, desalojado, desabrigado
                        FROM reg_danos_humanos
                        INNER JOIN cedec_municipio
                        ON reg_danos_humanos.municipio_id = cedec_municipio.id_municipio
                        GROUP BY municipio_id
                        ORDER BY cedec_municipio.nome";
            } elseif ((int) $id_municipio) {
                $sql = "SELECT cedec_municipio.nome, max(dt_desalojado), municipio_id, desalojado, desabrigado
                            FROM reg_danos_humanos
                            INNER JOIN cedec_municipio
                            ON reg_danos_humanos.municipio_id = cedec_municipio.id_municipio
                            where reg_danos_humanos = {$id_municipio}
                            GROUP BY municipio_id
                            ORDER BY cedec_municipio.nome";
            }

            $result = $con->query($sql);
            $result->execute();

            return $result->fetchAll();
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    /**
     * Lista por ano
     * @param type $id_municipio
     * @return type
     */
    public function listaPorAno($id_municipio, $ano = null) {

        try {

            $con = Conexao::getInstance();

            $sql = "Select *from reg_danos_humanos
                      where municipio_id = {$id_municipio}
                      and year(dt_desalojado) = {$ano}
                      order by dt_desalojado desc";


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

    public function grafGeral() {

        $con = Conexao::getInstance();
        /* geral por ano */
        $sql = "SELECT year(dt_desalojado) AS ano, sum(desalojado) AS desalojado,
                SUM(desabrigado) AS desabrigado FROM reg_danos_humanos
                    group BY year(dt_desalojado)";

        $result = $con->query($sql);
        $result->execute();

        return $result->fetchAll();
    }

}
