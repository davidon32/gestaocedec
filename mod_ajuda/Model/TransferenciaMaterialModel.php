<?php include_once("AjudaModel.php");

    /**
     * 
     */
class TransferenciaMaterialModel extends AjudaModel {
        
        /*Gerador Automatico de Getters e Setters para nosso Amigo PHP 
         Chora !! Autor: Demetrio S. Passos
         Data : 05/11/2014 */
        
        private $id_transferencia = null;
        private $dt_transferencia = null;
        private $motorista = null;
        private $veiculo = null;
        private $placa = null;
        private $origem = null;
        private $destino = null;
        private $saida = null;
        private $prev_chegada = null;
        private $hora_saida = null;
        private $prev_hora_chegada = null;
        private $material = null;
        
        function setId_transferencia($id_transferencia) {
            $this->id_transferencia = $id_transferencia;
         }
        
        function getId_transferencia(){ 
            return $this->id_transferencia; 
        }
        
        function setDt_transferencia($dt_transferencia) {
            $this->dt_transferencia = $dt_transferencia;
         }
        
        function getDt_transferencia(){ 
            return $this->dt_transferencia; 
        }
        
        function setMotorista($motorista) {
            $this->motorista = $motorista;
         }
        
        function getMotorista(){ 
            return $this->motorista; 
        }
        
        function setVeiculo($veiculo) {
            $this->veiculo = $veiculo;
         }
        
        function getVeiculo(){ 
            return $this->veiculo; 
        }
        
        function setPlaca($placa) {
            $this->placa = $placa;
         }
        
        function getPlaca(){ 
            return $this->placa; 
        }
        
        function setOrigem($origem) {
            $this->origem = $origem;
         }
        
        function getOrigem(){ 
            return $this->origem; 
        }
        
        function setDestino($destino) {
            $this->destino = $destino;
         }
        
        function getDestino(){ 
            return $this->destino; 
        }
        
        function setSaida($saida) {
            $this->saida = $saida;
         }
        
        function getSaida(){ 
            return $this->saida; 
        }
        
        function setPrev_chegada($prev_chegada) {
            $this->prev_chegada = $prev_chegada;
         }
        
        function getPrev_chegada(){ 
            return $this->prev_chegada; 
        }
        
        function setHora_saida($hora_saida) {
            $this->hora_saida = $hora_saida;
         }
        
        function getHora_saida(){ 
            return $this->hora_saida; 
        }
        
        function setPrev_hora_chegada($prev_hora_chegada) {
            $this->prev_hora_chegada = $prev_hora_chegada;
         }
        
        function getPrev_hora_chegada(){ 
            return $this->prev_hora_chegada; 
        }
        
        function setMaterial($material) {
            $this->material = $material;
         }
        
        function getMaterial(){ 
            return $this->material; 
        }
       
}?>