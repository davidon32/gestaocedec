<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php print TITULO; ?></title>
<link href="<?php print SISTEMA; ?>/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="<?php print SISTEMA; ?>/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
</head>
<body>
    <div class="container">
        <div class="row-fluid text-center">
            <img src="../imagem/topo_pipa.png" />
            <hr>
        </div>
        <!-- BARRA -->
        <div class="row-fluid">
            <div class="span6 text-left">
                <small><?php print "Data :" . date("d/m/Y"); ?> </small>
            </div>
            <div class="span6 text-right">
                <small><?php print "Hora :" . date("H:i:s"); ?> </small>
            </div>
        </div>

        <!-- LOGOUT -->
        <div class="row-fluid">
            <div class="span12 text-right">
                <a class="btn btn-primary" href="<?php print SISTEMA; ?>/core/logout.php?logout=s" title="Logout do Sistema">Logout</a>
                <p>
                
                
                <hr>
            </div>
        </div>


	<select name="selNome">
		<option>Demetrio</option>	
		<option>Daniela</option>	
		<option>Ribeiro</option>	
	</select>
	<input type="button" name="btnAdicionar" value="Adicionar">

<form action="#" method="POST">

	<label>Lista</label>
	<textarea rows="5" cols="5"></textarea>
	

</form>


<!-- RODAPE -->
        <div class="row-fluid">
            <div class="span12 text-center">
                <small><?php print RODAPE; ?> </small>
            </div>
        </div>
    </div>

    <script src="<?php print SISTEMA; ?>/js/jquery.js"></script>
    <script src="<?php print SISTEMA; ?>/js/bootstrap.js"></script>
    <script src="<?php print SISTEMA; ?>/js/jasny-bootstrap.js"></script>
    <script src="<?php print SISTEMA; ?>/js/funcaobase.js"></script>
</body>
</html>    

    
    <?php

    require '../PHPMailerAutoload.php';

    $mail = new PHPMailer;

    $body = file_get_contents('contents.html');

    $mail -> isSMTP();
    $mail -> Host = 'smtp.example.com';
    $mail -> SMTPAuth = true;
    $mail -> SMTPKeepAlive = true;
    // SMTP connection will not close after each email sent, reduces SMTP overhead
    $mail -> Port = 25;
    $mail -> Username = 'yourname@example.com';
    $mail -> Password = 'yourpassword';
    $mail -> setFrom('list@example.com', 'List manager');
    $mail -> addReplyTo('list@example.com', 'List manager');

    $mail -> Subject = "PHPMailer Simple database mailing list test";

    //Same body for all messages, so set this before the sending loop
    //If you generate a different body for each recipient (e.g. you're using a templating system),
    //set it inside the loop
    $mail -> msgHTML($body);
    //msgHTML also sets AltBody, but if you want a custom one, set it afterwards
    $mail -> AltBody = 'To view the message, please use an HTML compatible email viewer!';

    //Connect to the database and select the recipients from your mailing list that have not yet been sent to
    //You'll need to alter this to match your database
    $mysql = mysqli_connect('localhost', 'username', 'password');
    mysqli_select_db($mysql, 'mydb');
    $result = mysqli_query($mysql, 'SELECT full_name, email, photo FROM mailinglist WHERE sent = false');

    foreach ($result as $row) {//This iterator syntax only works in PHP 5.4+
        $mail -> addAddress($row['email'], $row['full_name']);
        if (!empty($row['photo'])) {
            $mail -> addStringAttachment($row['photo'], 'YourPhoto.jpg');
            //Assumes the image data is stored in the DB
        }

        if (!$mail -> send()) {
            echo "Mailer Error (" . str_replace("@", "&#64;", $row["email"]) . ') ' . $mail -> ErrorInfo . '<br />';
            break;
            //Abandon sending
        } else {
            echo "Message sent to :" . $row['full_name'] . ' (' . str_replace("@", "&#64;", $row['email']) . ')<br />';
            //Mark it as sent in the DB
            mysqli_query($mysql, "UPDATE mailinglist SET sent = true WHERE email = '" . mysqli_real_escape_string($mysql, $row['email']) . "'");
        }
        // Clear all addresses and attachments for next loop
        $mail -> clearAddresses();
        $mail -> clearAttachments();
    }
