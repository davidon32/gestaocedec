<?php include_once 'core/system/config/config.inc.php';

include_once PATH.'/core/classe/Classe.Login.php';
include_once PATH.'/core/classe/Classe.LoginExterno.php';

$action = isset($_GET['ac']) ? $_GET['ac'] :"";

if($action == "logar") {

	$_usuario = isset($_POST['login'])? $_POST['login'] : null;
	
	$_senha = isset($_POST['senha'])? preg_replace('/[^[:alnum:]_]/', '',$_POST['senha']) : null;
	
	$_usuarioLog =null;
	
	if(preg_match('/@/', $_usuario) == 0){
		$_usuarioLog = preg_replace('/[^[:alnum:]_]/', '', $_usuario);
	}

	$_login = new Login();
	$_loginExterno = new LoginExterno();

	if($_login->logar($_usuario, md5($_senha))){
		
		print "<script style='text/javascript'>";

		print "<div class='modal fade' id='modal-default'>
				<div class='modal-dialog'>
				<div class='modal-content'>
					<div class='modal-header'>
					<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
						<span aria-hidden='true'>&times;</span></button>
					<h4 class='modal-title'>Default Modal</h4>
					</div>
					<div class='modal-body'>
					
					<!-- texto -->1212121212
					
					</div>
					<div class='modal-footer'>
					<button type='button' class='btn btn-success pull-left' data-dismiss='modal'>Close</button>
					</div>
				</div>
				<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
		</div>";
		die();
		//print "window.location = 'index.php?token=".hash('sha256', md5(VERSAO)."-".time())."&ac=&modulo=index&secao=cedec&acao=index'";
		print "</script>";

		
	}elseif($_loginExterno->logarExterno($_usuario, md5($_senha))){
		
		print "<script style='text/javascript'>";
		print "window.location = 'index.php?token=".hash('sha256', md5(VERSAO)."-".date("dmY"))."&ac=&modulo=index&secao=cedec&acao=index'";
		print "</script>";
		
	}else {

		Log::GravaLog($_usuario."-".$_senha, 'cedec_log');
	}
}
?>