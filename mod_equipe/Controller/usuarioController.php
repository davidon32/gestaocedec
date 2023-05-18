<?php

include_once 'core/include.php';
include_once PATH . '/core/Controller/Controller.php';
include_once PATH . '/core/Model/UsuarioModel.php';

class usuarioController extends Controller {

    public function index() {
        print "opa";
    }

    # recuperar senha compdec

    public function recsenha_compdec() {

        $usuario = new Usuario();

        $enviaEmail = new Email();

        $quebraEmail = '';

        if (isset($_POST['btnResetar'])) {

            # campos em branco
            if (empty($_POST['txtMunicipio'])) {
                print "<script>";
                print "alert('Preencha o Municipio !');";
                print "</script>";
            } else {

                # busca por municipio (compdec)     
                $email_rec = $usuario->buscaEmailRecMunicipioUserExterno($_POST['txtMunicipio']);
                if (isset($email_rec[0]['email_rec'])) {
                    
                    //atualiza o campo reset do usuario com date now
                    // retorna hash email_usuario+date_now
                    // envia o link http://sistema.defesacivil.mg.gov.br/index.php/{$hash}
                    $_resultado = $usuario->resetaSenhaUsuarioEx($email_rec[0]['id'], $email_rec[0]['email_rec']);
                    
                    //var_dump($_resultado);

                    if (!is_null($_resultado)) {

                        if ($_resultado[0] == true) {

                            $quebraEmail = substr($email_rec[0]['email_rec'], 0, 4) . "******" . substr($email_rec[0]['email_rec'], strpos($email_rec[0]['email_rec'], "@"));

                            $link = "http://sistema.defesacivil.mg.gov.br/index.php/{$_resultado[1]}";

                            $mensagem = <<<MSG
                                    <p style='font-size:15pt'>Prezado Coordenador Municipal de Proteção e Defesa Civil,</p>

<p style='font-size:15pt'>Foi iniciado um pedido de alteração de senha para acesso ao SDC – Sistema de Defesa Civil, para continuar siga os seguintes passos:</p>
<br>
<p style='font-size:17pt; font-weight: bold'>1)    Clique para trocar a Senha : <a href='{$link}'>Trocar Senha</a></p>
<br>

<p style='font-size:15pt'> O usuário será redirecionado para uma pagina de troca de senha, onde deverá fazer a troca de senha</p>

<p style='font-size:15pt'>Obs: Seu usuario de acesso ao sistema é: <br> <span style='color:blue'>{$email_rec[0]['email_rec']}</span>.</p>

<p style='font-size:15pt'> Se você, não requisitou alteração de senha favor desconsiderar esse email.</p>
        
<p style='font-size:15pt'> Att.</p>
<p style='font-size:15pt'> Equipe de Suporte ADS.</p>
<div>
    SDC - Sistema de Defesa Civil<br>
Administrador | Suporte e Desenvolvimento<br>
Coordenadoria Estadual de Defesa Civil<br>
sdc@defesacivil.mg.gov.br<br>
http://www.defesacivil.mg.gov.br
</div>

MSG;
                        

    $resultado = $enviaEmail->newMail(['para'=> $email_rec[0]['email_rec'],
     'nomePara'=> 'Municipio de '.$email_rec[0]['nome_municipio']."'",
     'assunto'=> utf8_decode('Recuperação de Senha do SDC - '.$email_rec[0]['nome_municipio']),
     'corpo'=> utf8_decode($mensagem),
     'alt' => 'Email com Instruções para recuperação de senha']);

                            if ($resultado) {

                                print FuncaoBase::mensagem(FuncaoBase::geraLink("index", "index", "index"), "alert alert-success", "Senha Resetada com Sucesso !<br><br> Foi enviado um email para : <span style='font-weight:bolder; font-size:18pt;'>" . $quebraEmail . " 
                                        <p>Por questões de segurança parte do seu email de recuperação de senha foi <u><b>ocultado</b></u>.<p>
                                        Se voçê reconhece o inicio e o final do email mostrado acima :
                                        <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Aguarde alguns minutos.</li>
                                        <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Consulte sua sua caixa de entrada e siga as instruçoes para alterar a senha !</li>
                                        <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style='color:red'>Verifique também sua caixa de spam (Lixo Eletrônico), pois seu provedor pode direcionado para a caixa de Spam.</span></li>
                                        <br>Caso não reconheça, envie um email para:<br><br> 
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;sdc@defesacivil.mg.gov.br");
                            } else {
                                print FuncaoBase::mensagem(FuncaoBase::geraLink("index", "index", "index"), "alert alert-error", "Ocorreu um erro ao enviar o email, gentileza tente mais tarde !");
                            }
                        }
                    }
                } else {
                    print FuncaoBase::mensagem(FuncaoBase::geraLink("index", "index", "index"), "alert alert-error", "O sistema não encontrou um email para envio da senha temporária, favor entrar em contato pelo email \"defesacivil@defesacivil.mg.gov.br\" contendo :<br><BR>
                                - ASSUNTO: SENHA PARA ACESSO AO SDC <br>- NOME DO MUNICÍPIO<br> - EMAIL PARA RECUPERAÇÃO DE SENHA <BR> - NOME DO COORDENADOR DE DEFESA CIVIL <BR> - TELEFONE CONTATO <BR> - ANEXAR PORTARIA DE NOMEAÇÃO DO COORDENADOR");
                }
            }
        } else {
            # view cadastro
            include_once 'mod_equipe/View/usuario/recsenha_compdec.php';
        }
    }

    # trocar senha interno

    public function trsenha_compdec() {
        include_once 'mod_equipe/View/usuario/trsenha_compdec.php';
    }

}
