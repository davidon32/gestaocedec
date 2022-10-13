<?php

class indexController extends Controller {
    
    # index
    public function index() {
        include_once 'mod_registro/backEnd/View/danos/index.php';
    } 
    
    
    # gravar
    public function desabrigado() {
        
        $registro = new Registro;
        
        $result = $registro->reg_danos_humanos($_POST);
        if(is_bool($result) ) {
            FuncaoBase::alert('Registro gravado com Sucesso !');
            $this->redirect('registro', 'index', 'index');
        }elseif($result == 'duplicado') {
            FuncaoBase::alert('Registro duplicado ! Favor Verificar');
            $this->redirect('registro', 'index', 'index');
        }else {
            FuncaoBase::alert('Ocorreu um erro !'.$result);
            $this->redirect('registro', 'index', 'index');
        }
    }    
    
  
}

?>

