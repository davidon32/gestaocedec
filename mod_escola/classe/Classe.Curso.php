<?php
    include_once 'Classe.Dao.php';

    class Curso extends Dao{
    
        public function CadastrarCurso($_campo, $_tabela){
        
      
            self::Cadastrar($_campo, $_tabela);
    
        }
    
        
        function Alterar(){
            
            
        }
        
        
    
}


?>