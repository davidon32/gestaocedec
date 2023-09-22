<?php

$id_session = session_id();
if (empty($id_session))
    session_start();

include_once $_SERVER['DOCUMENT_ROOT'] . '/core/include.php';


$usuario = new Usuario();

$_usuario = isset($_POST['txtNome']) ? $_POST['txtNome'] : "";
$_nomeUsuario = isset($_POST['txtNome']) ? $_POST['txtNome'] : "";
$_senha = md5("portal199");
$_email_rec = isset($_POST['email']) ? $_POST['email'] : "";
$_id_municipio = isset($_POST['id_municipio']) ? $_POST['id_municipio'] : "";
$_trsenha = "1";
$_mod_pipa = "0";
$_mod_compdec = "1";
$_mod_ajuda = "0";
$_cpf = isset($_POST['cpf']) ? $_POST['cpf'] : "";
$id_arquivo = isset($_POST['id_tmp']) ? $_POST['id_tmp'] : "";

$btn = isset($_POST['btnCadastrar']) ? $_POST['btnCadastrar'] : "";


$opcao = isset($_POST['opcao']) ? $_POST['opcao'] : "";

# upload arquivo renomeado com o id
$anexo = new Anexo();

if ($opcao == 'cadastro') {

    # gravar usuario cedec_user_ex
    if ($btn == 'Enviar') {
        # se nao exisitir o usuario grava no banco
        if ($usuario->CadastraUsuarioExterno($_usuario,
                        $_senha,
                        $_email_rec,
                        $_id_municipio,
                        $_trsenha,
                        $_mod_pipa,
                        $_mod_compdec,
                        $_mod_ajuda,
                        "PENDENTE",
                        $_cpf,
                        VALIDADECOMPDEC,
                        $id_arquivo . ".pdf")) {

            # envia arquivo para a pasta tmp
            $files = isset($_FILES) ? $_FILES : "";

            if (!empty($files)) {
                try {

                    /* 1.7mb = 1762762 */
                    if (($files['filePortaria']['error'] == '0') && ($files['filePortaria']['size'] <= '2000000' )) {

                        $nomeArquivo = $id_arquivo . "_PORTARIA.pdf";

                        $anexo->uploadRen($_SERVER['DOCUMENT_ROOT'] . "/tmp", $files, "filePortaria", $nomeArquivo);

                        //$anexo->removerAnexo($nomeArquivo, "/tmp");
                    } else {

                        print "<script>";
                        print "alert('Tamanho do arquivo máximo permitido 2Mb !');";
                        print "</script>";
                    }
                } catch (PDOException $e) {

                    $e . "Erro ao Inserir Registro";
                    return false;
                }
            }
        } else {

            # verifica usuario ativo, validade
            $dados = $usuario->buscaUsuarioCpf($_cpf);

            if ($dados['situacao'] == 'ATIVADO') {

                print "<script>";
                print "alert('Este usuário já está cadastrado no sistema \n favor realizar o procedimento de recuperação de senha !');";
                print "</script>";
            } elseif ($dados['situacao'] == 'DESATIVADO') {

                print "<script>";
                print "alert('Este usuário não é mais o Coordenador Municipal de Proteção e Defesa Civil!');";
                print "</script>";
            } elseif ($dados['situacao'] == 'PENDENTE') {

                print "<script>";
                print "alert('Cadastro em Análise, \nFavor Aguardar a Liberação do Usuário por email !');";
                print "</script>";
            } elseif ($dados['situacao'] == 'CADASTRO_RECUSADO') {

                print "<script>";
                print "alert('Cadastro já enviado \n Favor contatar a DEFESA CIVIL DE MG');";
                print "</script>";
            } elseif ($dados['situacao'] == 'EXPIRADO') {

                print "<script>";
                print "alert('Validade do Usuário para acesso ao Portal de Serviços Vencido !\n
						Favor entrar em contato com a Defesa Civil de MG');";
                print "</script>";
            }
        }

        # atualiza email
        # enviar para validação senha
    }

    /* envio solicitação de cadastro */
} elseif ($opcao == "upload") {

    $files = isset($_FILES) ? $_FILES : "";
    $post = isset($_POST) ? $_POST : "";

    if (!empty($files)) {
        try {

            /* 1.7mb = 1762762 */
            if (($files['fileAnexo']['error'] == '0') && ($files['fileAnexo']['size'] <= '2000000' )) {

                $nomeArquivo = $id_arquivo . ".pdf";

                $anexo->uploadRen($_SERVER['DOCUMENT_ROOT'] . "/tmp", $files, "fileAnexo", $nomeArquivo);
            } else {

                print "<script>";
                print "alert('Tamanho do arquivo máximo permitido 2Mb !');";
                print "</script>";
            }
        } catch (PDOException $e) {

            $e . "Erro ao Inserir Registro";
            return false;
        }
    }
} elseif ($opcao == 'updateToken') {
    
    return Usuario::updateToken($id_usuario);  
    
} elseif ($opcao == 'updateCPF') {
    $post = isset($_POST) ? $_POST : "";
    
    print 'er';
    var_dump(Usuario::updateCpf($post));
    die();
    if ((Usuario::updateCpf($post)) && (Usuario::updateToken($post['id_usuario']))) {
        return true;
    }else {
        return false;
    }
}