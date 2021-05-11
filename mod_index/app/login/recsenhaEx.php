<?php $id_session = session_id();
    if(empty($id_session)) session_start(); 
print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
include 'include.php';


$sistema = isset($_SESSION['seguranca']['id_municipio'])? true : false;

if($sistema) {
	$_login = new LoginExterno();
	//$index = 'index2.php';
}else{
	$_login = new Login();
	//$index = 'index.php';
}

$usuario = new Usuario();

$_funcaoBase = new FuncaoBase();

$helper = new Html();

$enviaEmail = new Email();

$_funcionario = new EquipeFuncionario();

?>

<html><!--########################    RECUPERAR SENHA #####################-->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php print TITULO; ?></title>
<link href="/css/bootstrap.css" rel="stylesheet" media="">
<link href="/css/bootstrap-responsive.css" rel="stylesheet" media="">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="span12 text-center">
            <?php //print $_fun?>
        </div>
    </div>
    
    <div class="row">
        <div class="span3"></div>
        <div class="span6">
            <?php
            
                $helper->form("#", "POST", "resSenha", "-Recuperação de Senha");
                
                $helper->input("text", "login");
                
                $helper->input("text", "email", "email"); 
                 
                $helper->span("Coloque o email que está Cadastro no sistema !");
                
                $helper->formEnd("Resetar");

            ?>
          
        </div>
        <div class="span3"></div>
        <div class="span12 text-center">
            <br>
            <br><br>
            <span class="alert">Obs: O Sistema enviará um email com a senha temporária que deverá ser trocada. </span>
            <br><br><?php print FuncaoBase::voltar();?>
            <br>
            

<?php



$btnEnviar = isset($_POST['btnResetar']) ? true : false;


if ($btnEnviar) {
	
	if($_POST['txtLogin'] == ""){ 
		
		print '<br><span class="alert alert-error">O campo "Usuario" não podem ficar em branco !';
		
	}else if($_POST['txtEmail'] == ""){
		
		print '<br><span class="alert alert-error">O campo  "Email" não podem ficar em branco !';
	
	}else {
	
		$login = Usuario::getIdUserEx($_POST['txtLogin']);
		$email = $_POST['txtEmail'];
		
			if(is_null($login)){
				print '<br><span class="alert alert-error">"Usuário não existe no sistema !"';
			}else {
			
			        /* retorna array booleano e a senha temporaria */    
			        $_resultado = $usuario -> resetaSenhaUsuarioEx($login, $email);   
			
			        if ($_resultado[0] == true) {
			                
			            /* envia o email para o usuario */
                        $resultado = $enviaEmail->emailIndividual($email, utf8_decode("SGECEDEC - Recuperação de Senha"),
                         "Sua nova senha é :".$_resultado[1]." \nesta senha é temporária será preciso alterá-la.");
			            
			            #@ redirecionar em case de erro de senha e usuario
			            print '<script> alert("Senha resetada com Sucesso! Consulte sua sua caixa de email para alterar a senha !");';
			    
			            print '</script>';
			    
			            print "<script style='text/javascript'>";
			    
			            print "window.location = 'index2.php'";
			    
			            print "</script>";
			    
			        }
			}

	}
}

?>
</div>
    </div>
    <div class="row">
        <div class="span12 text-center">
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <small><?php print RODAPE;?></small>
        </div>
        
    </div>