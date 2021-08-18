<?php

include_once "core/Controller/Controller.php";
include_once "core/Model/Model.php";

class compdecController extends Controller {

    public function index() {
        include_once "mod_compdec/backEnd/View/index/indexView.php";
    }

    # usuario index

    public function buscarAlterar() {

        include_once "mod_compdec/backEnd/View/compdec/buscarAlterar.php";
    }

    #cadastro Usuario

    public function alterarCompdec() {

        include_once "mod_compdec/backEnd/View/compdec/alterarCompdec.php";
    }

    #salvar compdec

    public function valida() {

        include_once "mod_compdec/backEnd/View/compdec/valida.php";
    }

    # menu relatorio 

    public function filtroRelatorio() {

        include_once "mod_compdec/backEnd/View/compdec/filtroRelatorio.php";
    }

    /* Visualizar dados compdec */

    public function visualizar() {
        include_once "mod_compdec/backEnd/View/compdec/visualizar.php";
    }

    # Relatorio

    public function relatorio() {

        include_once "mod_compdec/backEnd/View/relatorio/relatorios.php";
        $opcao = $_POST['rb_filtro'];
    }

    # visualiza plano de Contigência

    public function plano() {

        include_once "mod_compdec/backEnd/View/plano/plancont.php";
        //$opcao = $_POST['rb_filtro'];
    }

    # mapa compdec

    public function mapa() {

        include_once "mod_compdec/backEnd/View/compdec/mapaCompdec.php";
        //$opcao = $_POST['rb_filtro'];
    }

    # mapa compdec

    public function lista_email() {

        include_once "mod_compdec/backEnd/View/relatorio/lista_email.php";
        //$opcao = $_POST['rb_filtro'];
    }

    public function relatoriomanual() {
        include_once "mod_compdec/backEnd/View/relatorio/relatorioManual.php";
    }

    /* lista compdec ativa site */

    public function listacompdecativa() {
        include_once "mod_compdec/backEnd/View/relatorio/listaCompdecAtiva.php";
    }

    /* filtro envio de email */

    public function email() {
        include_once "mod_compdec/backEnd/View/compdec/filtroEmail.php";
    }

    /* envio de email */

    public function enviaEmail() {
        if ($this->isPost()) {
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'tls';
            $mail->Username = 'gestaocedecmg@gmail.com';
            $mail->Password = 'gestao2019';
            $mail->Port = 587;
            
            $mail->setFrom('demetrios.passos@gmail.com.br');
$mail->addReplyTo('no-reply@email.com.br');
$mail->addAddress('email@email.com.br', 'Nome');
$mail->addAddress('email@email.com.br', 'Contato');
$mail->addCC('email@email.com.br', 'Cópia');
$mail->addBCC('email@email.com.br', 'Cópia Oculta');

$mail->isHTML(true);
$mail->Subject = 'Assunto do email';
$mail->Body    = 'Este é o conteúdo da mensagem em <b>HTML!</b>';
$mail->AltBody = 'Para visualizar essa mensagem acesse http://site.com.br/mail';
$mail->addAttachment('/tmp/image.jpg', 'nome.jpg');
     
if(!$mail->send()) {
    echo 'Não foi possível enviar a mensagem.<br>';
    echo 'Erro: ' . $mail->ErrorInfo;
} else {
    echo 'Mensagem enviada.';
}
            
        } else {

            include_once "mod_compdec/backEnd/View/relatorio/email.php";
        }
    }

}
