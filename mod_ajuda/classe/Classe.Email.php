<?php

/* * *********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 																					*
 * 	Classe manipulacao de mensagens eletronicas emails								*
 * 																					*
 * 	Autor: Demetrio da Silva Passos													*
 * 																					*
 * 	Criacao : 01/02/2012															*
 * ********************************************************************************** */

#@ email da DADM
$dadm = 'demetrio.passos@defesacivil.mg.gov.br,
			 zinhoflag1@gmail.com';

#@ email da DTEC
$dtec = 'demetrio.passos@defesacivil.mg.gov.br,
			 zinhoflag1@gmail.com';

class Email {

    function AvisoLibera() {

        # email aviso liberacao de materiais 

        $avisoLiberacao = 'demetrio.passos@defesacivil.mg.gov.br, zinhoflag1@gmail.com';

        /* $avisoLiberacao = array('emerson.ribeiro@defesacivil.mg.gov.br',
          'edylan.arruda@gmail.com',
          'arnaldo.affonso@defesacivil.mg.gov.br',
          'fabiano.villasBoas@defesacivil.mg.gov.br'); */

        $envia = mail($avisoLiberacao, 'Aviso de Liberacao de Materiais', 'foi liberado material');

        return $envia;
    }

    function AvisoPagamento() {

        # email aviso pagamento efetuado de materiais

        $avisoPagamento = '';

        $envia = mail($avisoPagamento, 'Liberacao de Materiais', 'foi liberado material');

        return $envia;
    }

    function AvisoCadastro() {

        # email aviso cadastro de materiais

        $avisoCadastro = array('');

        $envia = mail($avisoPagamento, 'Liberacao de Materiais', 'foi liberado material');

        return $envia;
    }

    function AvisoSaldo() {

        # email aviso estoqu baixo

        $avisoSaldo = array();

        $envia = mail($avisoPagamento, 'Liberacao de Materiais', 'foi liberado material');

        return $envia;
    }

    /**
     * Envio de email individual generico 
     * @param destinatario
     * @param assunto
     * @param mensagem
     * 
     * */
    function emailIndividual($destinatario, $assunto, $mensagem, $de = false) {

        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= (!$de) ? 'From : defesacivil@defesacivil.mg.gov.br' : 'From: ' . $de . ' <' . $de . '>';

        
        $envia = mail($destinatario, $assunto, $mensagem, $headers);

        return $envia;
    }

    /**
     * Envio de email individual generico 
     * @param destinatario
     * @param assunto
     * @param mensagem
     * 
     * */
    public static function emailLote($destinatario, $assunto, $mensagem, $de = false) {      
        
        //$anexo = $_FILES;
        
        $from_name="defesacivil@defesacivil.mg.gov.br";
	$from_address="defesacivil@defesacivil.mg.gov.br";
	$reply_name=$from_name;
	$reply_address=$from_address;
	$reply_address=$from_address;
	$error_delivery_name=$from_name;
	$error_delivery_address=$from_address;

	/* Define recipient personalization data. Change it before testing. */
	$to=$destinatario;

	$subject=$assunto;

	$email_message=new email_message_class;

	/*
	 *  For faster queueing use qmail...
	 *
	 *  require_once("qmail_message.php");
	 *  $email_message=new qmail_message_class;
	 *
	 *  or sendmail in queue only delivery mode
	 *
	 *  require_once("sendmail_message.php");
	 *  $email_message=new sendmail_message_class;
	 *  $email_message->delivery_mode=SENDMAIL_DELIVERY_QUEUE;
	 *
	 *  Always call the SetBulkMail function to hint the class to optimize
	 *  its behaviour to make deliveries to many users more efficient.
	 */

	$email_message->SetBulkMail(1);

	$email_message->SetEncodedEmailHeader("From",$from_address,$from_name);
	$email_message->SetEncodedEmailHeader("Reply-To",$reply_address,$reply_name);
	/*
	 *  Set the Return-Path header to define the envelope sender address to which bounced messages are delivered.
	 *  If you are using Windows, you need to use the smtp_message_class to set the return-path address.
	 */
	if(defined("PHP_OS")
	&& strcmp(substr(PHP_OS,0,3),"WIN"))
		$email_message->SetHeader("Return-Path",$error_delivery_address);
	$email_message->SetEncodedEmailHeader("Errors-To",$error_delivery_address,$error_delivery_name);
	$email_message->SetEncodedHeader("Subject",$subject);

	/* If you are not going to personalize the message body for each recipient,
	 * set the cache_body flag to 1 to reduce the time that the class will take
	 * to regenerate the message to send to each recipient */
	$email_message->cache_body=0;

	$message=$mensagem;
	/* Create empty parts for the parts that will be personalized for each recipient. */
	$email_message->CreateQuotedPrintableTextPart($message,"",$text_part);
        
        /*if($anexo['fileAnexo']['error'] == 0){
            //print "ok";
            //die();
            $image_attachment=array(
                    "FileName"=>$anexo['fileAnexo']['name'],
                    "Content-Type"=>"automatic/name",
                    "Disposition"=>"attachment"
            );
            $email_message->AddFilePart($image_attachment);
        }*/

	/* Add the empty part wherever it belongs in the message. */
	$email_message->AddPart($text_part);

	/* Iterate personalization for each recipient. */
	for($recipient=0;$recipient<count($to);$recipient++)
	{

		/* Personalize the recipient address. */
		$to_address=$to[$recipient]["address"];
		$to_name=$to[$recipient]["name"];
		$email_message->SetEncodedEmailHeader("To",$to_address,$to_name);

		/* Do we really need to personalize the message body?
		 * If not, let the class reuse the message body defined for the first recipient above.
		 */
		if(!$email_message->cache_body)
		{
			/* Create a personalized body part. */
			$message="Hello ".strtok($to_name," ").",\n\nThis message is just to let you know that Manuel Lemos' e-mail sending class is working as expected for sending personalized messages.\n\nThank you,\n$from_name";
			$email_message->CreateQuotedPrintableTextPart($email_message->WrapText($message),"",$recipient_text_part);

			/* Make the personalized replace the initially empty part */
			$email_message->ReplacePart($text_part,$recipient_text_part);
		}

		/* Send the message checking for eventually acumulated errors */
		$error=$email_message->Send();
		if(strlen($error))
			break;
	}

	/* When you are done with bulk mailing call the SetBulkMail function
	 * again passing 0 to tell the all deliveries were done.
	 */
	$email_message->SetBulkMail(0);

	if(strlen($error))
		echo "Error: $error\n";

	echo "Done!\n";
                
    }

}

?>