<?php include_once PATH.'/core/include.php';?>
<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_cedec/Model/indexModel.php";?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistema CEDEC - versão - 3.0 - 26.04.2019</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="template/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="template/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="template/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="template/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="template/plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <!--removido Google Fontes-->
</head>
<?php

$usuario = new Usuario();

$_funcaoBase = new FuncaoBase();

$helper = new Html();

$enviaEmail = new Email();

$_funcionario = new EquipeFuncionario();

                $helper->form("#", "POST", "cadUsuario", "Recuperar senha usuario");
                               
                $helper->input("text", "login", "Usuario / Email"); 
                
                $helper->input("text", "email", "Email para recuperação de senha"); 
                                
                $helper->formEnd("Resetar");

            ?>
       
            <br>
            <br><br>
            <span class="alert">Obs: O email é usado para recuperação de senha do sistema </span>
            <br><br><?php print FuncaoBase::voltar();?>
            <br>
            

<?php

$login = isset($_POST['txtLogin']) ? $_POST['txtLogin'] : false;

$email = isset($_POST['txtEmail']) ? $_POST['txtEmail'] : false;

$btnEnviar = isset($_POST['btnGravar']) ? true : false;


if ($btnEnviar) {
    
	$dados = array("email_rec" => $email);

    if($login != "" && $email != "") {
           
        if($usuario->atuaUsuarioExterno($dados)){
            
            print "<script>";
			print "alert('Dados Atualizados com Sucesso ! ');";
            print "window.location.href='/index2.php?secao=menu'";
            print "</script>";
        }
    }
    
    
}

?>
<!-- jQuery 3 -->
<script src="template/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="template/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>