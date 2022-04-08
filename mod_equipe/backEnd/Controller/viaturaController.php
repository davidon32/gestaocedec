<?php

include_once 'core/include.php';
include_once PATH . '/core/Controller/Controller.php';
include_once PATH . '/core/Model/UsuarioModel.php';

class viaturaController extends Controller {

    public function index(){
        include_once 'mod_equipe/backEnd/View/equipe/reg_dsp/viatura/index.php';
    }
    
    public function search(){
        include_once 'mod_equipe/backEnd/View/equipe/reg_dsp/viatura/search.php';
    }
    
    public function edit(){
        include_once 'mod_equipe/backEnd/View/equipe/reg_dsp/viatura/edit.php';
    }
    
    public function view(){
        include_once 'mod_equipe/backEnd/View/equipe/reg_dsp/viatura/view.php';
    }
    
    public function delete(){
        
    }
  
    
}
