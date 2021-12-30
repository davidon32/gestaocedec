<?php

class adminController extends Controller {


    # recuperar senha usuario via esqueci a senha
    public function esqueci_senha() {
        include_once 'mod_admin/View/usuario/esqueci_senha.php';
    }    

    # trocar senha via esqueci a senha
    public function troca_senha_cedec_esqueci() {
        include_once 'mod_admin/View/usuario/troca_senha_cedec_esqueci.php';
    }
    
    
    # recuperar senha via esqueci a senha
    public function recSenhaEsqueci() {

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
                            $link = FuncaoBase::geraLink('admin', 'admin', 'troca_senha_cedec_esqueci', array('externo'=>md5('externo'))) . $us_hash;

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
                                if(isset($_POST['ajax'])){
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

            include_once 'mod_admin/View/usuario/recsenha_cedec.php';
        }
    }
    
    
}