<?php $id_session = session_id();
    if(empty($id_session)) session_start();

print "<!DOCTYPE html>";
	include_once $_SERVER['DOCUMENT_ROOT'].'/include.php';
/**
 * 
 * 
 * @author Demetrio Silva Passos
 * 
 */

$_login = new Login();
$_login->logado();


$usuEx = new LoginExterno();
$dados = $usuEx->ListUsuarioEx();

$municipio = new Municipio();

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
						<table class='table'>
							<tr>
								<form action='#' method="POST" name='frmBuscaUserEx' id='frmBuscaUserEx'>
									<label>Pesquisa por Município</label>
									<input type="text" name="txtMunicipio" id="txtMunicipio" >
									<input class='btn' type="submit" name='btnEnviar' id='btnEnviar' value="Pesquisar">
									<input type="hidden" name="txtIdMunicipio" id="txtIdMunicipio" />
									 
								</form>
							</tr>
						</table>
						
						<!-- REGISTROS PARA ATIVAÇÃO -->
						<?php 
							$btn = isset($_POST['btnEnviar']) ? $_POST['btnEnviar'] :'';
							
							if(empty($btn)){
								print "<table class='table' style='background:#F2F2F2'>
									<tr>
										<td colspan='5'>REGISTROS PENDENTES PARA ATIVAÇÃO</td>
									</tr>
									<tr>
										<th>Código</th>
										<th>Usuário</th>
										<th>Município</th>
										<th>Situação</th>
										<th>Ação</th>
									</tr>";
							
							
							
								$dAtivar = $usuEx->lisUsuarioAtivar();
								
								foreach ($dAtivar as $value) {
									print "<tr>
											<td>".$value['id']."</td>
											<td>".$value['usuario']."</td>
											<td>".$value['nome']."</td>
											<td>".$value['situacao']."</td>
											<td>
												<a href='?secao=adm&acao=ativaCad' title='Ativar Cadastro'><img src='/imagem/ok.jpg'></a>
												<a href='#' title='Visualizar Anexo'><img src='/imagem/pdf.png'></a>
											</td>
										</tr>";
									}
									
									print "</table>
									<hr>";
									
							
							}else {

							# BUSCA USUARIO PARA MODIFICAÇÃO 				
							$id_municipio = isset($_POST['txtIdMunicipio']) ? $_POST['txtIdMunicipio'] : "";
						
							$dadosUsuario = $usuEx->dadosUsu($id_municipio);

								print "<table class='table'>";
								print "<tr>";
								print "<th>Código</th>";
								print "<th>Usuario</th>";
								print "<th>Municipio</th>";
								print "<th>Situação</th>";
								print "<th>Opções</th>";
 								print "</tr>";
							
							foreach ($dadosUsuario as $value) {
								
								print "<tr>";
								print "<td>".$value['id']."</td>";
								print "<td>".$value['usuario']."</td>";
								print "<td>".$value['nome']."</td>";
								print "<td>".$value['situacao']."</td>";
								print "<td>
										<a href='#' title='Alterar Dados'><img src='/imagem/editar.png'></a>
										<a href='#' title='Visualizar Anexo'><img src='/imagem/view.png'></a>
		
								</td>";
								print "</tr>";
								
							}
								print "</table>";
								
							}
						
						?>
						
						<p style='text-align: center;'><a class='btn' href=''>Voltar</a>
					</div>
			</div>
	</div>
	
	<div class="row-fluid text-center">
	    <br><br><br>
		<x-small><?php print RODAPE;?></x-small>
	</div>

	<script src="../../js/jquery-1.11.2.js"></script>
	<script src="../../js/bootstrap.js"></script>
	<script src="../../js/jasny-bootstrap.js"></script>
	<script src="../../js/jquery.easy-autocomplete.js"></script>
	<script type="text/javascript">

		var itens = {
				data: 
						<?php print json_encode($dados);?>, // array com os dados
					
					getValue: "nome",
	
						list: {
						match: {
							enabled: true
						},
		
							onSelectItemEvent: function() {
								var value = $("#txtMunicipio").getSelectedItemData().id_municipio;
		
								$("#txtIdMunicipio").val(value);
								//$("#txtIdComunidadeSearch").val(value).trigger("change");
		
							}
	
					}
	
			};
		
		$("#txtMunicipio").easyAutocomplete(itens);


	</script>
	