<?php require_once("AppModel.php");


/**
 * 
 */
class AjudaRelatorioModel extends AppModel {
	
	/*Gerador Automatico de Getters e Setters para nosso Amigo PHP 
 Chora !! Autor: Demetrio S. Passos
 Data : 05/11/2014 */

private $dt_inicial = null;
private $dt_final = null;
private $deposito = null;
private $material = null;
private $regiao = null;
private $id_transferencia = null;
private $ordem = null;

function setOrdem($ordem) {
    $this->ordem = $ordem;
 }

function getOrdem(){ 
    return $this->ordem; 
}


function setId_transferencia($id_transferencia) {
    $this->id_transferencia = $id_transferencia;
 }

function getId_transferencia(){ 
    return $this->id_transferencia; 
}

function setDt_inicial($dt_inicial) {
    $this->dt_inicial = $dt_inicial;
 }

function getDt_inicial(){ 
    return $this->dt_inicial; 
}

function setDt_final($dt_final) {
    $this->dt_final = $dt_final;
 }

function getDt_final(){ 
    return $this->dt_final; 
}

function setDeposito($deposito) {
    $this->deposito = $deposito;
 }

function getDeposito(){ 
    return $this->deposito; 
}

function setMaterial($material) {
    $this->material = $material;
 }

function getMaterial(){ 
    return $this->material; 
}

function setRegiao($regiao) {
    $this->regiao = $regiao;
 }

function getRegiao(){ 
    return $this->regiao; 
}


}


?>