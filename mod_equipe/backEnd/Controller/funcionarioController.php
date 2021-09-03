<?php include_once('core/Controller/Controller.php');

class FuncionarioController extends Controller {

    public function alterar(){
                
        $funcionario = new FuncionarioEquipeModel();
        $usuario = new Usuario();
        $dados = $funcionario->lista($_COOKIE['seguranca']['id_funcionario']);
        $dados_rpm = $funcionario->rpm();

        if($this->isPost()){
            $post = $_POST;
            
            $dadosEmailRec = array('txtEmail'=>$post['txtEmailRec'], 'id_usuario'=>$_COOKIE['seguranca']['idUser']);

            $funcionario->edit($post);
            $usuario->AtualizaEmail($dadosEmailRec);
            FuncaoBase::alert("Dados Atualizados com Sucesso !");
            include_once 'mod_index/backEnd/View/index/index.php';
            
        }else {

            include_once 'mod_equipe/View/funcionario/alterar.php';
        }
        
        
        
    }

    
    
}