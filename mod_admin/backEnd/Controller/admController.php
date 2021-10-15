<?php

    class admController extends Controller{

        /* Cadastrar Usuario */
        public function caduser(){

            include_once('mod_admin/backEnd/View/usuario_cedec/cad_user.php');

        }
        
        /* alterar Usuario */
        public function alterar(){

            include_once('mod_admin/backEnd/View/usuario_cedec/alterar.php');

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
            $situacao   = isset($_POST['selSituacao'])? $_POST['selSituacao'] : false;

            $opcao = isset($_POST['opcao'])  ? $_POST['opcao']   : false;

            if($opcao == "caduser"){
                
                # cadastro "cedec_funcionario"
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
                
                /* inserir permissoes CEDEC PERMISSAO */
                SqlGenerics::Inserir('cedec_permissao', array('login'=>$username));
                
                /* inserir permissoes AJUDA */
                SqlGenerics::Inserir('aju_cpermissao', array('login'=>$username,
                                                            'nivel'=>0,
                                                            'id_usuario'=> Usuario::getIdUsuario($username)));
                
                /* inserir permissoes AJUDA Humanitaria */
                SqlGenerics::Inserir('aju_h_permissao', array('login'=>$username,
                                                            'id_usuario'=> Usuario::getIdUsuario($username)));
                
                
                /* inserir permissoes CCE */
                SqlGenerics::Inserir('cce_permissao', array('login'=>$username));
                
                /* inserir permissoes DECRETAÇÂO */
                SqlGenerics::Inserir('dec_permissao', array('login'=>$username,
                                                            'nivel'=>0,
                                                            'id_usuario'=> Usuario::getIdUsuario($username)));
                
                /* inserir permissoes COMPDEC */
                SqlGenerics::Inserir('com_permissao', array('login'=>$username,
                                                            'nivel'=>0));
                
                /* inserir permissoes EQUIPE */
                SqlGenerics::Inserir('equ_permissao', array('login'=>$username));
                
                
                /* inserir permissoes PIPA */
                SqlGenerics::Inserir('pip_permissao', array('login'=>$username));
                
                               
                    print "<script>
                                alert('Registro Gravado com Sucesso');
                                window.location.href = 'index.php?token=".hash('sha256', md5(VERSAO).date('dmY'))."&ac=&modulo=admin&controller=index&action=index';
                        </script>";
                }
            }elseif($opcao == "atualiza") {
                var_dump($id_funcionario = $usuario->getIdFuncionario($username));
                    if($situacao == 0) {
                        $usuario->desabilitarFuncionario(array('situacao'=>$situacao, 'id_funcionario'=>$id_funcionario));
                    }
                    if($usuario->AtualizaEmail(array('txtEmail'=> $email, 'id_usuario'=>$id_usuario, 'situacao'=>$situacao))){
                        print "<script>
                                    alert('Registro Atualizado com Sucesso !');
                                    window.location.href = 'index.php?token=".hash('sha256', md5(VERSAO).date('dmY'))."&ac=&modulo=admin&controller=adm&action=usuario';
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
    
    
    /*
     * relatorios
     * 
     */
    public function relatorio(){
        include_once('mod_admin/backEnd/View/relatorio/index.php');
        
    }
    /*
     * relatorio usuarios
     * 
     */
    public function rel_agente(){
        $agente = true;
        include_once('mod_admin/backEnd/View/relatorio/rel_user.php');
        
    }
    
    /*
     * relatorio usuarios
     * 
     */
    public function rel_user(){
        include_once('mod_admin/backEnd/View/relatorio/rel_user.php');
        
    }
    
    
    # resetar senha usuario cedec, envio de email para mudança
    public function resetar_user_cedec() {

        $usuario = new Usuario();

        $enviaEmail = new Email();

        if (isset($_POST['btnResetar'])) {

            # campos em branco
            if (empty($_POST['txtUsuario'])) {
                print "<script>";
                print "alert('Preencha nome do Usuario !');";
                print "</script>";
            } else {

                $email_rec = $usuario->buscaEmailRecUser($_POST['txtEmail']);

                if (isset($email_rec[0]['email_rec'])) {

                    //var_dump(count($email_rec) > 0);

                    $_resultado = $usuario->resetaSenha(false, $email_rec[0]['email_rec']);

                    if (!is_null($_resultado)) {

                        if ($_resultado[0] == true) {

                            $quebraEmail = substr($email_rec[0]['email_rec'], 0, 4) . "******" . substr($email_rec[0]['email_rec'], strpos($email_rec[0]['email_rec'], "@"));

                            //$usuario = isset($_resultado[2]) ? utf8_decode("Seu usuário é : <br> " . $_resultado[2] . "<br> ou <br>" . $_resultado[3]) . "<br>" : "";

                            $us_hash = "&" . md5('use70') . "=" . $_resultado[4];
                            $link = FuncaoBase::geraLink('admin', 'admin', 'trsenha_cedec') . $us_hash;

                            $mensagem = <<<MSG
                                    <p style='font-size:15pt'>Prezado Integrante da CEDEC,</p>

<p style='font-size:15pt'>Foi iniciado um pedido de alteração de senha para acesso ao SDC – Sistema de Defesa Civil, se você {$email_rec[0]['nome']}, não requisitou a recuperação de senha no sistema, favor desconsiderar esse email, caso contrário clique no link abaixo:</p>

<p style='font-size:15pt'>1)    Clique para trocar a Senha : <a href='http://sistema.defesacivil.mg.gov.br/index.php{$link}'>Trocar Senha</a></p>

<p style='font-size:15pt'>2)	Entre com seu usuário :  <span style='color:blue'>{$_resultado[3]}</span>  ou email : <span style='color:blue'>{$email_rec[0]['email_rec']}</span>.</p>

<p style='font-size:15pt'> O usuário será redirecionado para uma pagina de troca de senha, onde deverá fazer a troca de senha</p>
        
<p style='font-size:15pt'> Att.</p>
<p style='font-size:15pt'> Equipe de Suporte ADS.</p>
MSG;
                            $resultado = $enviaEmail->emailIndividual($email_rec[0]['email_rec'], utf8_decode("SGECEDEC - Recuperação de Senha"), $mensagem, "defesacivil@defesacivil.mg.gov.br");
                            if ($resultado) {
                                if($_POST['ajax']){
                                    print 'sucesso';  
                                }else{
                                    #@ redirecionar em case de erro de senha e usuario
                                    $msgReset = '<p>Senha Resetada com Sucesso !</p> <p>Foi enviado um email para : ' . $quebraEmail . '.<p> consulte sua sua caixa de entrada e siga as instruçoes ! </p>';
                                    print FuncaoBase::mensagem(FuncaoBase::geraLink("index", "index", "index"), 'alert', $msgReset);
                                }
                            }else {
                                print FuncaoBase::mensagem(FuncaoBase::geraLink("index", "index", "index"), "alert alert-error", "Ocorreu um erro ao enviar o email, gentileza tente mais tarde !");  
                            }
                        }
                    }
                } else {
                    print FuncaoBase::mensagem(FuncaoBase::geraLink("index", "index", "index"), "alert alert-error", "O sistema não encontrou um email recuperacao de senha, favor entrar em contato com equipe de suporte do GM ou pelo email \"demetrio.passos@defesacivil.mg.gov.br\" contendo :<br><BR>
                                - ASSUNTO: EMAIL PARA RECUPERAÇÃO DE SENHA <br>- NOME DO USUARIO<br> - EMAIL PARA RECUPERAÇÃO DE SENHA");
                }
            }
        } else {

            include_once 'mod_equipe/View/usuario/recsenha_cedec.php';
        }
    }
    
    
    public function perfil() {
        include_once 'mod_admin/backEnd/View/usuario_cedec/perfil.php';
    }

    # editar

    public function editar() {
        include_once 'mod_admin/backEnd/View/usuario_cedec/editar.php';
    }
    
    
    # salvar dados usuario

    public function salvar() {
        include_once 'mod_admin/backEnd/View/usuario_cedec/valida.php';
    }
    
    
    

    
}