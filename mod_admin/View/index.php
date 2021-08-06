<?php $id_session = session_id();
    if(empty($id_session)) session_start();
    
print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
include_once '../include.php';?>
 

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
<style type="text/css">
    hr {
        margin:0px;
        padding:0px;
        height: 0px;
    }
</style>
</head>
<body>
	<table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
			<td width="150" height="150">&nbsp;</td>
			<td width="150">&nbsp;</td>
			<td width="250" align="center"><img src="../imagem/topo_rel2.jpg"></td>
			<td width="150">&nbsp;</td>
			<td width="150">&nbsp;</td>
		</tr>
		<tr>
			<td height="50">&nbsp;</td>
			<td>&nbsp;</td>
			<td align="center">Acesso Administrativo</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>
			 <!--action="../secao.php?secao=login&acao=administrador"-->
				<form method="POST" action="index.php?secao=adm&acao=logar" name="log_adm">
					Login
					<input type="text" name="login" id="login" size="10" value="" />
					<br />
					Senha
					<input type="password" name="senha" id="senha" size="10" value="" />
					<input class="btn" type="submit" name="input" id="input" value="Entrar" />
				</form>
			</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
	</table>
	<script src="/js/jquery.js"></script>
	<script src="/js/bootstrap.js"></script>
	<script src="/js/jasny-bootstrap.js"></script>

</body>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/jasny-bootstrap.js"></script>
<script type="text/javascript">

var currentLocation = window.location;

if(currentLocation['host'] == 'desenvolvimento.sgecedec.com'){

	$("#login").val('m1296844');
	$("#senha").val('cedec199');


}


</script>
</html>




