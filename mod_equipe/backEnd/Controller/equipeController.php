<?php

include_once 'core/include.php';
include_once PATH . '/core/Controller/Controller.php';
include_once PATH . '/core/Model/UsuarioModel.php';

class equipeController extends Controller {

    public function reg_dsp(){
        /* municipio */
        $municipio = Municipio::listaid_municipioAutocomplete();
        $lista = "";
            foreach ($municipio as $key => $value) {
                $lista .= "<option value=".$value['id_municipio'].">".$value['nome']."</option>";   
            }
        /* Evento */     
        $evento = CobradeModel::listaid_CobradeAutocomplete();
        $listaEvento = "";
            foreach ($evento as $key => $value) {
                $listaEvento .= "<option value=".$value['id_cobrade'].">".$value['codigo']." - ".$value['descricao']."</option>";   
            }
        /* Viatura */     
        $viaturas = RegDspViatura::listaid_ViaturaAutocomplete();
        $listaViatura = "";
            foreach ($viaturas as $key => $value) {
                $listaViatura .= "<option value=".$value['id_viatura'].">".$value['placa']." - ".$value['nome']."</option>";   
            }
            
        /* Integrantes */     
        $integrantes = Usuario::listaid_funcionarioAutocomplete();
        
        //var_dump($integrantes);
        $listaInteg = "";
            foreach ($integrantes as $key => $value) {
                $listaInteg .= "<option value=".$value['id_funcionario'].">".$value['num_masp']." - ".$value['posto']."-".$value['nome']."</option>";   
            }
        
        include_once 'mod_equipe/backEnd/View/equipe/reg_dsp/dsp/reg_dsp.php';
        
    }
    
    public function reg_dsp_viatura(){
        
        include_once 'mod_equipe/backEnd/View/equipe/reg_dsp_viatura.php';
        
    }
    
    /* gravar DSP*/
    public function gravar_dsp(){
        
        if($this->isPost()){
            $registroDsp = new RegistroDspEquipeModel();
            if($registroDsp->Gravar($_POST)){
                FuncaoBase::alert("Registro Gravado com Sucesso !");
                $this->redirect('equipe', "equipe", 'reg_dsp');
                
                
            }
        }
        
    var_dump($_POST);
    }
    
      
    
}
