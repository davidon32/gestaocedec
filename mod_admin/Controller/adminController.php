<?php

class adminController extends Controller {
    # recuperar senha usuario via esqueci a senha

    public function esqueci_senha() {
        include_once 'mod_admin/View/usuario/esqueci_senha.php';
    }
    
    /* novo usuário */
    public function novo_cadastro() {
        include_once 'mod_admin/View/usuario/novo_cadastro.php';
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

                    $_resultado = $usuario->resetaSenha(false, $email_rec[0]['email_rec'],);

                    if (!is_null($_resultado)) {

                        if ($_resultado[0] == true) {

                            $quebraEmail = substr($email_rec[0]['email_rec'], 0, 4) . "******" . substr($email_rec[0]['email_rec'], strpos($email_rec[0]['email_rec'], "@"));

                            $link = "http://sistema.defesacivil.mg.gov.br/index.php/{$_resultado[1]}&email=".$email_rec[0]['email_rec'];

                            $mensagem = <<<MSG
                                    <p style='font-size:15pt'>Prezado membro da CEDEC,</p>

<p style='font-size:15pt'>Foi registrado um pedido de alteração de senha para acesso ao Sistema de Defesa Civil (SDC). 
    Caso o senhor {$email_rec[0]['nome']}, não tenha solicitado a recuperação da senha no sistema, pedimos que desconsidere 
        este e-mail. No entanto, se o pedido foi feito por si, solicitamos que clique no link abaixo:</p>

<p style='font-size:15pt'>1)    Clique aqui para efetuar a alteração da senha: <a href='{$link}'>Trocar Senha</a></p>

<p style='font-size:15pt'>2)	Insira seu nome de usuário :  <span style='color:blue'>{$email_rec[0]['email_rec']}</span></p>

<p style='font-size:15pt'> Ao clicar no link, o usuário será redirecionado para uma página onde poderá efetuar a troca de senha.</p>
        
<p style='font-size:15pt'> 
    Observação: O seu nome de usuário para acesso ao sistema é: 
        <br>
        <span style='color:blue'>{$email_rec[0]['email_rec']}</span>.
</p>

<p style='font-size:15pt'> 
    Caso você não tenha solicitado a alteração de senha, pedimos que desconsidere este e-mail.
</p>
        
<p style='font-size:15pt'> Att.</p>
<p style='font-size:15pt'> Equipe de Suporte ADS.</p>
<div>
    SDC - Sistema de Defesa Civil<br>
Administrador | Suporte e Desenvolvimento<br>
Coordenadoria Estadual de Defesa Civil<br>
sdc@defesacivil.mg.gov.br<br>
http://www.defesacivil.mg.gov.br
MSG;

                            $dados_envio = [
                                'para' => $email_rec[0]['email_rec'],
                                'nomePara' => $email_rec[0]['nome'],
                                'assunto' => utf8_decode("SDC - Recuperação de Senha")." ".date('H:i')."hs",
                                'corpo' => utf8_decode($mensagem),
                                'alt' => 'Mensagem de recuperação de senha'
                            ];


                            $resultado = $enviaEmail->newMail($dados_envio);

                            if ($resultado) {
                                $msgReset = "<p>Senha Resetada com Sucesso !</p>
                                            <p>Foi enviado um email para : ". $quebraEmail .".</p>
                                            <p>Consulte sua sua caixa de entrada e siga as instruçoes ! </p>
                                            <p>Por questões de segurança parte do seu email de recuperação de senha foi <u><b>ocultado</b></u>.
                                            <p>Se voçê reconhece parte do email mostrado acima :
                                                    <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Aguarde alguns minutos.</li>
                                                    <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Consulte sua sua caixa de entrada e siga as instruçoes para alterar a senha !</li>
                                                    <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style='color:red'>Verifique também sua caixa de spam (Lixo Eletrônico), pois seu provedor pode ter direcionado para a caixa de Spam.</span></li>
                                                    <br>Caso não receba o email, nos envie uma mensagem com pedido de recuperação de senha contendo o nome do usuário e email para:<br><br> 
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;sdc@defesacivil.mg.gov.br</p>";
                                
                                print FuncaoBase::mensagem(FuncaoBase::geraLink("index", "index", "index"), 'alert', $msgReset);
                            } else {
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
