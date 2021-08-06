<?php $id_session = session_id();
    if(empty($id_session)) session_start();

print "<!DOCTYPE html>";
	include_once $_SERVER['DOCUMENT_ROOT'].'/include.php';
/**
 * Pesqui de pipeiro para realizar o acerto de contas
 * 01/03/2011
 * @author Demetrio Silva Passos
 * 
 */

//$_conexao = new ConexaoMysql();

$_login = new Login();

$_login->Logado();

$municipio = new Municipio();

$id_comunidade = isset($_GET['id']) ? ($_GET['id']) :"";

$comunidade = new Comunidade();

$dados = $comunidade->buscaComunidadeId($id_comunidade);

$municipio = "a";

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php print TITULO;?></title>
<link href="/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="/css/bootstrap-responsive.css" rel="stylesheet" media="screen">

</head>
<body>
    <!-- TOPO /system/topo.php-->
    <?php include_once(PATH.'/system/topo.php'); ?>
    <div class="container">
     <!-- MENU-->
		<div class="row-fluid">
			<div class="span3">
			    <BR>
				
			</div>
				<div class="row-fluid">
					<div class="span9 fdo_corpo">
						<p style="text-align: center"><?=$municipio; ?></p>
						<table class='table table-bordered'>
							<tr>
								<td title='Habilita o acesso do Modulo TDAP para o Municipio'><img src='/imagem/pipa.png' width='50px'>&nbsp; TDAP &nbsp; <input type="checkbox" id='ckTdap' name='ckTdap'></td>
								<td title='Habilita o acesso do Modulo COMDEC para o Municipio'><img src='/imagem/comdec.png' width='30px'>&nbsp; COMPDEC &nbsp; <input type="checkbox" id='ckCompdec' name='ckCompdec'></td>
								<td title='Habilita o acesso do Modulo Ajuda Humanitária para o Municipio'><img src='/imagem/ajuda.png' width='30px'>&nbsp; Ajuda Humanitária &nbsp; <input type="checkbox" id='ckAjuda' name='ckAjuda'></td>
							</tr>
						
						</table>
						<p style='text-align: center;'><a class='btn' href=''>Voltar</a>
					</div>
			</div>
	</div>
	
	<div class="row-fluid text-center">
	    <br><br><br>
		<x-small><?php print RODAPE;?></x-small>
	</div>

	<script src="../js/jquery.js"></script>
	<script src="../js/bootstrap.js"></script>
	<script src="../js/jasny-bootstrap.js"></script>