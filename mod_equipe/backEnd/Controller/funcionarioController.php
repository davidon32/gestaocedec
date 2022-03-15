<?php include_once('core/Controller/Controller.php');

class FuncionarioController extends Controller {

    public function alterar(){
        # usuario master editando perfil
        $id_funcionario_get = isset($_GET['id_']) ? $_GET['id_'] :"";
        
        # proprio usuario editando perfil
        if(empty($id_funcionario_get)){
            $id_funcionario = $_COOKIE['seguranca']['id_funcionario'];
        }else {
            $id_funcionario = $id_funcionario_get;
        }
        
        var_dump($id_funcionario);

        $funcionario = new FuncionarioEquipeModel();
        $usuario = new Usuario();
        $dados = $funcionario->lista($id_funcionario);
        $dados_rpm = $funcionario->rpm();

        if($this->isPost()){
            $post = $_POST;
            
            $dadosEmailRec = array('txtEmail'=>$post['txtEmailRec'],
                                   'id_usuario'=>$_COOKIE['seguranca']['idUser'],
                                   'situacao' =>$dados['situacao']);

            $funcionario->edit($post);
            //$usuario->AtualizaEmail($dadosEmailRec);
            
            //$id_usuario = $usuario->dadosUsuarioIdFunc($id_funcionario);
            
            //$usuario::AtualizarNomeUsuario($id_usuario);
            var_dump($_POST);
            die();
            FuncaoBase::alert("Dados Atualizados com Sucesso !");
            if(isset($_GET['voltar']) && $_GET['voltar'] == 'pesquisa') {
                print "<script>
                    window.location.href='".FuncaoBase::geraLink('admin', 'adm', 'usuario')."'; 
                </script>";
            }else {
                print "<script>
                   window.location.href='".FuncaoBase::geraLink('index', 'index', 'index1')."'; 
                </script>";
                //include_once 'mod_index/backEnd/View/index/index.php';
            }
            
        }else {

            include_once 'mod_equipe/View/funcionario/alterar.php';
        }
  
    }

    
    
}