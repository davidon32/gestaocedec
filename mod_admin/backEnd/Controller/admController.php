<?php include_once PATH.'/core/include.php';
include_once "core/Controller/Controller.php";

    class admController extends Controller{

        /* Cadastrar Usuario */
        public function caduser(){

            include_once('mod_admin/backEnd/View/config/cad_user.php');

        }
        
        /* alterar Usuario */
        public function alterar(){

            include_once('mod_admin/backEnd/View/config/alterar.php');

        }
        
        /* Visualizar dados */
        public function visualizar(){

            include_once('mod_admin/backEnd/View/config/cad_user.php');

        }

        public function usuario(){
            
            include_once "mod_admin/backEnd/View/config/usuario.php";
            
        }

        /** valida cadatro usuario */
        public function cad_user_valida(){
            
            $usuario = new Usuario();

            $numPolicia = isset($_POST['txtNumPol']) ? $_POST['txtNumPol']  : false;
            $nomeComp   = isset($_POST['txtNome'])   ? $_POST['txtNome']    : false;
            $username   = isset($_POST['txtUsuario'])? $_POST['txtUsuario'] : false;
            $setor      = isset($_POST['selSetor'])  ? $_POST['selSetor']   : false; 
            $email      = isset($_POST['txtEmail'])  ? $_POST['txtEmail']   : false;
            $id_usuario = isset($_POST['id_usuario'])? $_POST['id_usuario'] : false;

            $opcao = isset($_POST['opcao'])  ? $_POST['opcao']   : false;

            if($opcao == "caduser"){
                
                if($usuario->cadFuncionario($numPolicia, $nomeComp, $username, $setor, $email)){
                    
                /* inserir usuario "cedec_usuario" */
                SqlGenerics::Inserir('cedec_usuario',
                        array('id_deposito'=>1,
                            'nome'=> $nomeComp,
                            'senha'=>md5('cedec199'),
                            'email_rec'=>$email,
                            'nivel'=>0,
                            'situacao'=>1,
                            'login'=>$username,
                            'id_funcionario'=>Usuario::idFuncionario($numPolicia)));
                
                /* inserir permissoes AJUDA */
                SqlGenerics::Inserir('aju_permissao', array('login'=>$username,
                                                            'nivel'=>0,
                                                            'id_usuario'=> Usuario::getIdUsuario($username)));
                
                /* inserir permissoes CCE */
                SqlGenerics::Inserir('cce_permissao', array('login'=>$username));
                
                /* inserir permissoes DECRETAÇÂO */
                SqlGenerics::Inserir('dec_permissao', array('login'=>$username));
                
                /* inserir permissoes COMPDEC */
                SqlGenerics::Inserir('com_permissao', array('login'=>$username,
                                                            'nivel'=>0));
                
                /* inserir permissoes EQUIPE */
                SqlGenerics::Inserir('equ_permissao', array('login'=>$username));
                
                /* inserir permissoes ESCOLA */
                SqlGenerics::Inserir('esc_permissao', array('login'=>$username));
                
                /* inserir permissoes PIPA */
                SqlGenerics::Inserir('pip_permissao', array('login'=>$username));
                
                /* inserir permissoes CONTROLE ESTOQUE */
                SqlGenerics::Inserir('pip_cpermissao', array('login'=>$username,
                                                             'nivel'=>0,
                                                             'id_usuario'=> Usuario::getIdUsuario($username)));
                
                    print "<script>
                                alert('Registro Gravado com Sucesso');
                                window.location.href = 'index.php?token=".hash('sha256', md5(VERSAO))."&ac=&modulo=admin&controller=index&action=index';
                        </script>";
                }
            }elseif($opcao == "atualiza") {
                    if($usuario->AtualizaEmail(array('txtEmail'=> $email, 'id_usuario'=>$id_usuario))){
                        print "<script>
                                    alert('Registro Atualizado com Sucesso');
                                    window.location.href = 'index.php?token=".hash('sha256', md5(VERSAO))."&ac=&modulo=admin&controller=adm&action=usuario';
                            </script>";
                    }
            }
            
        }
        
        public function index(){
            $index = new admModel();
            $index->index();
        }
        
        public function usuarioex(){
        	$aux = "usu";
        	$usuarioex = new admModel();
        	$usuarioex->usuarioexView();
	
        }
        
        public function busca(){
        	$usuarioex = new admModel();
        	$usuarioex->buscausuex();
        }
        
        public function ativaCad(){
        	$usuarioex = new admModel();
        	$usuarioex->ativaCad();
        }
        
        public function buscausuex(){
        	$usuarioex = new admModel();
        	$usuarioex->buscausuex();
        }
        
        
        
        public function logar() {
            $usuario = new UsuarioAdmModel();
            $usuario->setLogin($_POST['login']);
            $usuario->setSenha(md5($_POST['senha']));
            
            $con = Conexao::getInstance();
            $statement = $con->prepare("SELECT login FROM cedec_usuario WHERE login = :login and senha = :senha and cedec_admin = 1");
            $statement->bindValue(':login', $usuario->getLogin(), PDO::PARAM_STR);
            $statement->bindValue(':senha', $usuario->getSenha(), PDO::PARAM_STR);
            
            try {
            	
            	$dados = array();
                $statement->execute();
                
                while ($linha = $statement->fetch(PDO::FETCH_ASSOC)) {
                	$dados = $linha;
                }
                $rowCount = $statement->rowCount();
                
                if($rowCount > 0){
                
	                $linha = $statement->fetch(PDO::FETCH_ASSOC);
	                
	                $_SESSION['seguranca'] = array('login'=> $linha['login'],
	                'nivel'=> $linha['nivel'],
	                'acesso'=> '0',
	                'idUser'=> $linha['id_usuario'],
	                'id_deposito'=>$linha['id_deposito'],
	                'id_funcionario'=>$linha['id_funcionario']) ;
	                
	                print "<script type=\"text/javascript\">
	                      //alert(\"Cadastro realizado com Sucesso !\");
	                      window.location = '?index.php&secao=adm&acao=index';
	                    </script>";  
                }else {
                	print "<script type=\"text/javascript\">
	                      //alert(\"Cadastro realizado com Sucesso !\");
	                      window.location = '/administrator';
	                    </script>";  
                }
            
            }catch(PDOException $e) {
                print $e->getMessage();
                print "<br><a href='javascript:history.back();'>Voltar</a>";
            }
        } 
        
    /* gravar a permissao uisuario*/
    /**
     * 
     * @param array {$tabela, $funcao, $opcao, $usuario}
     * 
     */
    public function gravaPermissao(){
        
        if(isset($_POST)){
            $con = Conexao::getInstance();
            $statement = $con->query("UPDATE ".$_POST['tabela']." set ".$_POST['funcao']." = \"".$_POST['opcao']."\" where login = \"".$_POST['usuario']."\" and ".$_POST['chave']." > 0");
            $statement->execute();
            return true;
        }
    }
    
    
    public function resetarSenhaInterno() {
   
    }
    
    /*
     * configurações do sistema
     * 
     */
    public function config(){
        
        include_once('mod_admin/backEnd/View/config/index.php');
        
    }
    
    /*
     * release
     * 
     */
    public function release(){
        var_dump($this);
        include_once('mod_admin/backEnd/View/release/index.php');
        
    }
    
    
    
}