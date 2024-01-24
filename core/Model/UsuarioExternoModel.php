<?php

Class UsuarioExternoModel {
    /* Gerador Automatico de Getters e Setters para nosso Amigo PHP 
      Chora !! Autor: Demetrio S. Passos
      Data : 05/11/2014 */

    private $id;
    private $usuario;
    private $senha;
    private $email_rec;
    private $acesso;
    private $id_municipio;
    private $trsenha;
    private $mod_pipa;
    private $mod_compdec;
    private $mod_ajuda;
    private $situacao;
    private $validade;
    private $cpf;
    private $tmpAnexo;
    private $obs;
    private $qtd_acesso;

    function setId($id) {
        $this->id = $id;
    }

    function getId() {
        return $this->id;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }

    function getSenha() {
        return $this->senha;
    }

    function setEmail_rec($email_rec) {
        $this->email_rec = $email_rec;
    }

    function getEmail_rec() {
        return $this->email_rec;
    }

    function setAcesso($acesso) {
        $this->acesso = $acesso;
    }

    function getAcesso() {
        return $this->acesso;
    }

    function setId_municipio($id_municipio) {
        $this->id_municipio = $id_municipio;
    }

    function getId_municipio() {
        return $this->id_municipio;
    }

    function setTrsenha($trsenha) {
        $this->trsenha = $trsenha;
    }

    function getTrsenha() {
        return $this->trsenha;
    }

    function setMod_pipa($mod_pipa) {
        $this->mod_pipa = $mod_pipa;
    }

    function getMod_pipa() {
        return $this->mod_pipa;
    }

    function setMod_compdec($mod_compdec) {
        $this->mod_compdec = $mod_compdec;
    }

    function getMod_compdec() {
        return $this->mod_compdec;
    }

    function setMod_ajuda($mod_ajuda) {
        $this->mod_ajuda = $mod_ajuda;
    }

    function getMod_ajuda() {
        return $this->mod_ajuda;
    }

    function setSituacao($situacao) {
        $this->situacao = $situacao;
    }

    function getSituacao() {
        return $this->situacao;
    }

    function setValidade($validade) {
        $this->validade = $validade;
    }

    function getValidade() {
        return $this->validade;
    }

    function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    function getCpf() {
        return $this->cpf;
    }

    function setTmpAnexo($tmpAnexo) {
        $this->tmpAnexo = $tmpAnexo;
    }

    function getTmpAnexo() {
        return $this->tmpAnexo;
    }

    function setObs($obs) {
        $this->obs = $obs;
    }

    function getObs() {
        return $this->obs;
    }

    function setQtd_acesso($qtd_acesso) {
        $this->qtd_acesso = $qtd_acesso;
    }

    function getQtd_acesso() {
        return $this->qtd_acesso;
    }

    public static function store($data, $nome_oficio) {

        $con = Conexao::getInstance();


        # gmgcedec199
        $senha = "32efe320d4a241dec1268bf3a8a0557d";


        $sql = "INSERT INTO cedec_user_ex (usuario,
                                            senha,
                                            email_rec,
                                            id_municipio,
                                            trsenha,
                                            situacao,
                                            cpf,
                                            tmpAnexo,
                                            cel,
                                            ci,
                                            profissao,
                                            cargo,
                                            mod_pipa,
                                            mod_compdec,
                                            mod_ajuda,
                                            mod_plano)
                                                VALUES(:usuario,
                                                        :senha,
                                                        :email_rec,
                                                        :id_municipio,
                                                        :trsenha,
                                                        :situacao,
                                                        :cpf,
                                                        :tmpAnexo,
                                                        :cel,
                                                        :ci,
                                                        :profissao,
                                                        :cargo,
                                                        :mod_pipa,
                                                        :mod_compdec,
                                                        :mod_ajuda,
                                                        :mod_plano)";

        $result = $con->prepare($sql);

        $result->bindParam(':usuario', $data['nome']);
        $result->bindParam(':senha', $senha);
        $result->bindParam(':email_rec', $data['email']);
        $result->bindParam(':id_municipio', $data['municipio']);
        $result->bindValue(':trsenha', '0');
        $result->bindValue(':situacao', "DESATIVADO");
        $result->bindParam(':cpf', $data['cpf']);
        $result->bindParam(':tmpAnexo', $nome_oficio);
        $result->bindParam(':cel', $data['cel']);
        $result->bindParam(':ci', $data['ci']);
        $result->bindParam(':profissao', $data['profissao']);
        $result->bindParam(':cargo', $data['cargo']);
        $result->bindValue(':mod_pipa', "1");
        $result->bindValue(':mod_compdec', "1");
        $result->bindValue(':mod_ajuda', "1");
        $result->bindValue(':mod_plano', "1");


        try {


            return $result->execute();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

}
