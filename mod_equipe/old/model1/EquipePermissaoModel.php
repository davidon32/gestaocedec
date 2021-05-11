<?php require_once 'AppEquipeModel.php';


/**
 * 
 */
class EquipePermissaoModel extends AppEquipeModel{
    
    /*Gerador Automatico de Getters e Setters para nosso Amigo PHP 
 Chora !! Autor: Demetrio S. Passos
 Data : 05/11/2014 */

private $login = null;
private $coluna = null;

function setLogin($login) {
    $this->login = $login;
 }

function getLogin(){ 
    return $this->login; 
}

function setColuna($coluna) {
    $this->coluna = $coluna;
 }

function getColuna(){ 
    return $this->coluna; 
}
    
	
	
}
