<?php

class dspModel {

    private $dtDsp = null;
    private $numDsp = null;
    private $missao = null;
    private $idDestino = null;
    private $idCodDsp = null;
    private $dtPartida = null;
    private $dtChegada = null;
    private $idMembros = null;
    private $idChefia = null;

    public function getDtDsp() {
        return $this -> dtDsp;
    }

    public function setDtDsp($dtDsp) {
        $this -> dtDsp = $dtDsp;
    }

    public function getNumDsp() {
        return $this -> numDsp;
    }

    public function setNumDsp($numDsp) {
        $this -> numDsp = $numDsp;
    }

    public function getMissao() {
        return $this -> missao;
    }

    public function setMissao($missao) {
        $this -> missao = $missao;
    }

    public function getIdDestino() {
        return $this -> idDestino;
    }

    public function setIdDestino($idDestino) {
        $this -> idDestino = $idDestino;
    }

    public function getIdCodDsp() {
        return $this -> idCodDsp;
    }

    public function setIdCodDsp($idCodDsp) {
        $this -> idCodDsp = $idCodDsp;
    }

    public function getDtPartida() {
        return $this -> dtPartida;
    }

    public function setDtPartida($dtPartida) {
        $this -> dtPartida = $dtPartida;
    }

    public function getDtChegada() {
        return $this -> dtChegada;
    }

    public function setDtChegada($dtChegada) {
        $this -> dtChegada = $dtChegada;
    }

    public function getIdMembros() {
        return $this -> idMembros;
    }

    public function setIdMembros($idMembros) {
        $this -> idMembros = $idMembros;
    }

    public function getIdChefia() {
        return $this -> idChefia;
    }

    public function setIdChefia($idChefia) {
        $this -> idChefia = $idChefia;
    }

}
