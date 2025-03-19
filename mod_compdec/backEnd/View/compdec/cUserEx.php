<?php print "<!DOCTYPE html>";
	include_once PATH.'/include.php';
/**
 * Pesqui de pipeiro para realizar o acerto de contas
 * 01/03/2011
 * @author Demetrio S Passos - demetriosilp@hotmail.com
 * 
 */

$_login = new Login();

$_login->Logado(CAD_ACERTO, $MODULO['mod_pipa']);

$id_usuario = isset($_GET['id']) ? $_GET['id']: "";

$usuario = new Usuario();

$dados = $usuario->buscaUsuarioId($id_usuario);

$anexo = new Anexo();

if(!empty($dados['tmpAnexo'])){
	
	$anexoCad = "<a "."id='anexoAtivacao' title='Visualizar dos Documentos enviados para ativação do Cadastro'><img src='imagem/pdf.png'>Clique aqui, para visualizar Anexo Ativação Cadastro</a>";
	$tmpAnexo = $dados['tmpAnexo'];
	
}else {
	
	$anexoCad ="";
}
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
<form class="form-horizontal" action="#" method="POST">
<fieldset>

<!-- Form Name -->
<legend>Cadastro Senha</legend>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="textinput">Usuário</label>
  <div class="controls">
    <input id="textUsuario" name="textUsuario" type="text"   value="<?=$dados['usuario']?>" class="input-xlarge" readonly="readonly">
    <input id="id_usuario"  name="id_usuario"  type="hidden" value="<?=$dados['id']?>" >
    
    <input id="mod_compdec" name="mod_compdec" type="hidden" value="<?=$dados['mod_compdec']?>" >
    <input id="mod_pipa"    name="mod_pipa"    type="hidden" value="<?=$dados['mod_pipa']?>" >
    <input id="mod_ajuda"   name="mod_ajuda"   type="hidden" value="<?=$dados['mod_ajuda']?>" >
    
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="textinput">Email/Login</label>
  <div class="controls">
    <input id="email_rec" name="email_rec" type="text" value="<?=$dados['email_rec']; ?>" class="input-xlarge">
    
  </div>
</div>

<!-- Password input-->
<div class="control-group">
  <h><label class="control-label" for="passwordinput">Conf. Senha</label>
  <div class="controls">
    <input id="senha" name="senha" type="password" value="<?=$dados['senha'] ?>" class="input-xlarge" readonly="readonly">
    <span>Senha Padrao : "portal199"</span>&nbsp;<span id="btnResetar" class="btn btn-primary">Resetar Senha</span>
    <input type="hidden" name="txtIdMunicipio" id="txtIdMunicipio" value="<?=$dados['id_municipio'];?>">
    <br>
   </div>
</div>
<div class="control-group">
    <label class="control-label" for="passwordinput">Ativar Cadastro</label>
    <div class="controls">
    <select name="txtSituacao" id="txtSituacao">
    	<option><?=$dados['situacao'];?></option>
    	<option>ATIVADO</option>
    	<option>DESATIVADO</option>
    	<option>CADASTRO_RECUSADO</option>
    </select>
    <br><br>
    <p><?php print $anexoCad;?></p>
    <br>
    <span id="spAviso" class="alert alert-error">Senha Alterada para <b>portal199</b> !, clique em salvar para Gravar as Alterações </span>
</div>
</div>

<!-- Button -->
<div class="control-group">
  <label class="control-label" for="singlebutton"></label>
  <div class="controls">
    <button id="btnAtua" name="btnAtua" class="btn btn-primary" value="btnAtua">Salvar</button>
  </div>
</div>

</fieldset>
</form>

<?php 

$btn = isset($_POST['btnAtua']) ? $_POST['btnAtua'] : "" ;

$enviaEmail = new Email();

if($btn == 'btnAtua'){
	
	$usuario->desabilitarUsuario($_POST['txtIdMunicipio']);
	
	if($usuario->atuaUsuarioExterno($_POST)){

		print "<script>
	 			alert('Usuario atualizado com Sucesso !');
				window.location.href='?modulo=compdec&secao=compdec&acao=pesquisaUsuario';
	 		</script>";
		# enviar email com aviso de efetivação
		/* envia o email para o usuario */
				
		$resultado = $enviaEmail->emailIndividual($_POST['email_rec'], utf8_decode("CADASTRO PARA ACESSO AO PORTAL DE SERVIÇOS"), "Prezado Coordenador\n
			Para Acesso ao portal de servicos acesse:
			http://www.defesacivil.mg.gov.br -> Portal de Serviços -> Serviços para o município 
			
			Usuario: ".$_POST['email_rec']."
			Senha  : portal199 
			
			Obs: 
			O email : ".$_POST['email_rec']." será usado para recuperação de senha e fazer o login no sistema.
			Quaisquer dúvidas é necessário envio de email para : ".EMAILSUPORTECOMPDEC);
		
		/* nome do arquivo */
		$arquivoTmpAnexo = substr($dados['tmpAnexo'],0, strpos($dados['tmpAnexo'], ".pdf"));
		
		# mover o documento solicitação pasta cadUsuario
		$anexo->copiarArquivo($dados['tmpAnexo'], "tmp", "anexo/cadUsuario/", $dados['id_municipio']."_".$arquivoTmpAnexo."_solicitacao.pdf");
		
		# mover portaria de nomeação
		$anexo->copiarArquivo($arquivoTmpAnexo."_PORTARIA.PDF", "tmp", "anexo/cadUsuario/", $dados['id_municipio']."_".$arquivoTmpAnexo."_portaria.pdf");
		
		# deletar da pasta tmp 
		$anexo->removerAnexo($dados['tmpAnexo'], "tmp");

		# deletar da pasta tmp
		$anexo->removerAnexo($arquivoTmpAnexo."_portaria.pdf", "tmp");
		
		# log de alteração usuario
		//$_acao = $_SESSION['seguranca'][] 
		$_acao = "alteração usuario COMPDEC ";
		$_acao .= implode("dados: ", $_POST); 
		
		Log::GravaLog($_acao, "pip_log");
	}else{
		
		//print "oi";
	}
}


?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript">

$(document).ready(function(){

	$("#email_rec").blur(function(){
		alert('teste');

	});

	$("#spAviso").hide();
	
	$("#btnResetar").click(function(){

		$("#senha").val("<?=md5('portal199');?>");
		$("#senha").css('background-color','#FF6347');

		$("#spAviso").fadeIn("slow");
	});

	$("#anexoAtivacao").click(function(){

		window.location = '<?php print 'tmp/'.$tmpAnexo; ?>';

	});

});

</script>
