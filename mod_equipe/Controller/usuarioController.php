<?php

include_once 'core/include.php';
include_once PATH . '/core/Controller/Controller.php';
include_once PATH . '/core/Model/UsuarioModel.php';

class usuarioController extends Controller {

    public function perfil() {
        include_once 'mod_equipe/View/usuario/view.php';
    }

    # editar

    public function editar() {
        include_once 'mod_equipe/View/usuario/editar.php';
    }

    # recuperar senha separa usuario

    public function recsenha() {
        include_once 'mod_equipe/View/usuario/recsenha_user.php';
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

                    $_resultado = $usuario->resetaSenhaUsuarioEx($email_rec[0]['id'], $email_rec[0]['email_rec']);

                    if (!is_null($_resultado)) {

                        if ($_resultado[0] == true) {

                            $quebraEmail = substr($email_rec[0]['email_rec'], 0, 4) . "******" . substr($email_rec[0]['email_rec'], strpos($email_rec[0]['email_rec'], "@"));

                            $us_hash = "&" . md5('use70') . "=" . $_resultado[4]."&res=".date('His');
                            $link = FuncaoBase::geraLink('equipe', 'usuario', 'trsenha_compdec') . $us_hash;

                            $mensagem = <<<MSG
                                    <p style='font-size:15pt'>Prezado Coordenador Municipal de Proteção e Defesa Civil,</p>

<p style='font-size:15pt'>Foi iniciado um pedido de alteração de senha para acesso ao SDC – Sistema de Defesa Civil, para continuar siga os seguintes passos:</p>

<p style='font-size:15pt'>1)    Clique para trocar a Senha : <a href='http://sistema.defesacivil.mg.gov.br/index.php{$link}'>Trocar Senha</a></p>

<p style='font-size:15pt'> O usuário será redirecionado para uma pagina de troca de senha, onde deverá fazer a troca de senha</p>

<p style='font-size:15pt'>Obs: Seu usuario de acesso ao sistema é: <br> <span style='color:blue'>{$email_rec[0]['email_rec']}</span>.</p>

<p style='font-size:15pt'> Se você, não requisitou alteração de senha favor desconsiderar esse email.</p>
        
<p style='font-size:15pt'> Att.</p>
<p style='font-size:15pt'> Equipe de Suporte ADS.</p>
MSG;


                            $resultado = $enviaEmail->emailIndividual($email_rec[0]['email_rec'], utf8_decode("SGECEDEC - Recuperação de Senha"), $mensagem, "defesacivil@defesacivil.mg.gov.br");

                            if ($resultado) {

                                print FuncaoBase::mensagem(FuncaoBase::geraLink("index", "index", "index"), "alert alert-success", "Senha Resetada com Sucesso !<br><br> Foi enviado um email para : <span style='font-weight:bolder; font-size:18pt;'>" . $quebraEmail . " 
                                        <p>Por questões de segurança parte do seu email de recuperação de senha foi <u><b>ocultado</b></u>.<p>
                                        Se voçê reconhece o inicio e o final do email mostrado acima :
                                        <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Aguarde alguns minutos</li>
                                        <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Consulte sua sua caixa de entrada e siga as instruçoes para alterar a senha !</li>
                                        <br>Caso não reconheça, envie um email para:<br><br> 
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;sdc@defesacivil.mg.gov.br");
                            }else {
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
            include_once 'mod_equipe/View/usuario/recsenha_compdec.php';
        }
    }

    # recuperar senha

    public function recsenha_cedec() {

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

                    var_dump($_resultado = $usuario->resetaSenha(false, $email_rec[0]['email_rec']));
                    die();

                    if (!is_null($_resultado)) {

                        if ($_resultado[0] == true) {

                            $quebraEmail = substr($email_rec[0]['email_rec'], 0, 4) . "******" . substr($email_rec[0]['email_rec'], strpos($email_rec[0]['email_rec'], "@"));

                            //$usuario = isset($_resultado[2]) ? utf8_decode("Seu usuário é : <br> " . $_resultado[2] . "<br> ou <br>" . $_resultado[3]) . "<br>" : "";

                            $us_hash = "&" . md5('use70') . "=" . $_resultado[4];
                            $link = FuncaoBase::geraLink('equipe', 'usuario', 'trsenha') . $us_hash;

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
                                #@ redirecionar em case de erro de senha e usuario
                                $msgReset = '<p>Senha Resetada com Sucesso !</p> <p>Foi enviado um email para : ' . $quebraEmail . '.<p> consulte sua sua caixa de entrada e siga as instruçoes ! </p>';
                                FuncaoBase::mensagem(FuncaoBase::geraLink("index", "index", "index"), 'alert', $msgReset);
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

    # trocar senha interno

    public function trsenha_cedec() {
        include_once 'mod_equipe/View/usuario/trsenha.php';
    }

    # trocar senha interno

    public function trsenha_compdec() {
        include_once 'mod_equipe/View/usuario/trsenha_compdec.php';
    }

    # salvar dados usuario

    public function salvar() {
        include_once 'mod_equipe/View/usuario/valida.php';
    }
    

}
