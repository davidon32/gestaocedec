<?php

include_once 'core/include.php';
include_once PATH . '/core/Controller/Controller.php';
include_once PATH . '/core/Model/UsuarioModel.php';

class equipeController extends Controller {

    public function reg_dsp(){
        
        include_once 'mod_equipe/backEnd/View/equipe/reg_dsp.php';
        
    }
    
    public function reg_dsp_viatura(){
        
        include_once 'mod_equipe/backEnd/View/equipe/reg_dsp_viatura.php';
        
    }
}
