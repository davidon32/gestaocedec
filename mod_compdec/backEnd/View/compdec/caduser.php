<?php $id_session = session_id();
    if(empty($id_session)) session_start(); 
	print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
	include_once PATH.'/include.php';
/**
 * Cadastro de usuário Externo
 * 13/07/2018
 * @author Demetrio S Passos - demetriosilvap@hotmail.com
 * 
 */

$_login = new Login();

$_login->Logado(CAD_ACERTO, $MODULO['mod_pipa']);


$_id = isset($_GET['id']) ? $_GET['id'] : "";

$usuario = new LoginExterno();

$dados = $usuario->getUsuario($_id);

var_dump($dados);

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php print TITULO;?></title>
<link href="../css/bootstrap.css" rel="stylesheet" media="screen">
<link href="../css/bootstrap-responsive.css" rel="stylesheet" media="screen">

</head>
<body>
    <!-- TOPO /system/topo.php-->
    <?php include_once(PATH.'/system/topo.php'); ?>
    <div class="container">
     <!-- MENU-->
		<div class="row-fluid">
			<div class="span3">
			    <BR>
				<?php include_once PATH."/mod_".$modulo.'/app/elemento/'.$modulo.'.menu.php';?>
			</div>
				<div class="row-fluid">
					<div class="span9 fdo_corpo">
					<form action="" method="POST" name="form">
						<table class="table table-bordered table-condensed span10">
							<tr>
								<td colspan="2" style="text-align:center"><h4>Cadastro Usuário</h4></td>
							</tr>
							<tr>
								<td>Municipio</td>
								<td>
									<?php $municipio = new Municipio();
										$dados = $municipio->dadosSelectMunicipio();
										
										//var_dump($dados);
									
										echo Html::inputSelect("txtMunicipio", "txtMunicipio", null, $dados, "");
										
									?>
								</td>
							</tr>
							<tr>
								<td class="span3">Nome Completo Usuario</td>
								<td class="span9"><input class="span10" type="text" name="txtNomeUsuario" id="txtNomeUsuario" >
								</td>
							</tr>
							<tr>
								<td class="span3">Usuario (max. 8 caract.)</td>
								<td class="span9"><input class="span10" type="text" name="txtUsuario" id="txtUsuario" maxlength="8">
													<button class="span2 btn pull-right" type="button" id="btnGerar">Gerar</button>
								</td>
							</tr>
							<tr>
								<td>Senha</td>
								<td><input type="text" name="txtSenha" id="txtSenha" value="portal199" class="span12" readonly="readonly"></td>
							</tr>
							<tr>
								<td>Email_rec</td>
								<td><input type="email" name="txtEmailRec" id="txtEmailRec" class="span12"></td>
							</tr>
							<tr>
								<td>Acesso Modulo Pipa/PMDA</td>
								<td><input type="checkbox" name="ckModPipa" id="ckModPipa" value="1"></td>
							</tr>
							<tr>
								<td>Acesso Modulo COMPDEC</td>
								<td><input type="checkbox" name="ckModCompdec" id="ckModCompdec" value="1"></td>
							</tr>
							<tr>
								<td>Acesso Modulo AJUDA HUMANITÁRIA</td>
								<td><input type="checkbox" name="ckModAjuda" id="ckModAjuda" value="1"></td>
							</tr>
							<tr>
								<td>Situacao</td>
								<td><?php 
								
										echo Html::inputSelect("selSituacao", "selSituacao", null, ATIVOINATIVO, "");
									?>
								</td>
							</tr>
							<tr>
								<td>validade</td>
								<td><input type="text" name="txtValidade" id="txtValidade" data-mask="99/99/9999"></td>
							</tr>
							<tr>
								<td>CPF</td>
								<td><input type="text" name="txtCPf." id="txtCpf" data-mask="999.999.999-99"></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td><input type="submit" name="btnEnviar" id="btnEnviar" value="Gravar"></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td><span id="msg" class=""></span></td>
							</tr>
						
						</table>
						</form>
						
					</div>
				</div>
		</div>
	</div>
	
	<div class="row-fluid text-center">
	    <br><br><br>
		<x-small><?php print RODAPE;?></x-small>
	</div>

	<script src="<?php print SISTEMA;?>/js/jquery.js"></script>
	<script src="../js/bootstrap.js"></script>
	<script src="../js/jasny-bootstrap.js"></script>
	<script src="../js/funcaobase.js"></script>
	<script type="text/javascript">

		$("#txtEmailRec").blur(function(){

			console.log(validaEmail($("#txtEmailRec").val()));
			if(validaEmail($("#txtEmailRec").val())){

				$("#btnEnviar").prop("disabled", false);
				$("#txtEmailRec").css("border-color", "#cccccc");

			}else {

				$("#btnEnviar").prop("disabled", true);
				$("#txtEmailRec").css("border-color", "#ff8566");
				$("#txtEmailRec").val("Email inválido !");
				
			}
			
		});

		$("#btnEnviar").hover(function(){

			if(
				($("#txtUsuario").val() == "") ||
				($("#txtSenha").val() == "") ||
				($("#txtEmailRec").val() == "") ||
				($("#txtValidade").val() == "") ||
				($("#txtCpf").val() == "")
			){

				$("#msg").text("Campos com Borda Vermelha são Obrigatórios !");
				$("#msg").addClass("alert alert-danger");	
				
				$("#txtUsuario").css("border-color", "#ff8566");	
				$("#txtSenha").css("border-color", "#ff8566");	
				$("#txtEmailRec").css("border-color", "#ff8566");	
				$("#txtValidade").css("border-color", "#ff8566");	
				$("#txtCpf").css("border-color", "#ff8566");
				$("#btnEnviar").prop("disabled", true);	

			}else {

				$("#msg").text("");
				$("#msg").removeClass("alert alert-danger");
				
				$("#txtUsuario").css("border-color", "#cccccc");	
				$("#txtSenha").css("border-color", "#cccccc");	
				$("#txtEmailRec").css("border-color", "#cccccc");	
				$("#txtValidade").css("border-color", "#cccccc");	
				$("#txtCpf").css("border-color", "#cccccc");	
				

			}


		});


		$("#btnGerar").click(function(){

			var usuario = "";
			
			usuario = $("#txtNomeUsuario").val();
			
			return usuario.substr(1,4)+ +usuario.substr(-1,4);
		});

	</script>
	</body>
</html>

<?php 

	$_POST['ckModPipa'] = isset($_POST['ckModPipa'])? $_POST['ckModPipa']: "0"; 
	$_POST['ckModCompdec'] = isset($_POST['ckModCompdec'])? $_POST['ckModCompdec']: "0"; 
	$_POST['ckModAjuda'] = isset($_POST['ckModAjuda'])? $_POST['ckModAjuda']: "0"; 
	
	
	//var_dump($_POST);
	
	try {
		
		$usuario = new Usuario();
		
		$usuario->CadastraUsuarioExterno($_POST['txtUsuario'],
											md5('portal199'),
											$_POST['txtEmailRec'],
											$_POST['selTxtMunicipio'],
											1, // troca senha
											$_POST['ckModPipa'],
											$_POST['ckModCompdec'],
											$_POST['ckModAjuda'],
											$_POST['selSituacao'],
											$_POST['txtCpf'],
											$_POST['txtValidade'],
											""); // anexo decreto nomeacao
		
	} catch (Exception $e) {
	
		print FuncaoBase::getError($e->getMessage(), 'Mensagem');
	
	}
	

?>
