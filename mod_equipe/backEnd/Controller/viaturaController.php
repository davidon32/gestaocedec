<?php

include_once 'core/include.php';
include_once PATH . '/core/Controller/Controller.php';
include_once PATH . '/core/Model/UsuarioModel.php';

class viaturaController extends Controller {

    public function index(){
        
        
        include_once 'mod_equipe/backEnd/View/equipe/reg_dsp/viatura/index.php';
    }
    
    public function novo(){
        include_once 'mod_equipe/backEnd/View/equipe/reg_dsp/viatura/novo.php';
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
    
    # gravar cadatro viatura
    public function gravar(){
        
        $post = isset($_POST) ? $_POST: "";
        
        $id_viatura = isset($post['id_viatura']) ? $post['id_viatura'] : "";
        
        # editar 
        if(!empty($id_viatura)){
            if(RegDspViatura::GravarEdicao($post)){
                print "<script>alert('Registro Alterado com Sucesso !');</script>";
                print "<script>window.location.href = '".FuncaoBase::geraLink("equipe", "viatura", "edit", array('id'=>$id_viatura))."'</script>";
            }
          
        #novo
        }else {
            if(RegDspViatura::Gravar($post)){
                print "<script>alert('Registro gravado com Sucesso !');</script>";
                print "<script>window.location.href = '".FuncaoBase::geraLink("equipe", "viatura", "novo")."'</script>";
            }
        }
//die();
        
    }
    
    
  
    
}
