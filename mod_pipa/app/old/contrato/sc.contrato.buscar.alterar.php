<?php session_start();
print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
include_once '../include.php';

$_conexao = new ConexaoMysql();

$_login = new Login();

$_login->VerificaBrowser();

$_login->logado(CAD_ACERTO, $MODULO['mod_pipa']);

$_login->Sessao();

?>
<html>
<head>
<title>Pesquisa de Contrato</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="<?php print SISTEMA;?>/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="<?php print SISTEMA;?>/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
	<script type="text/javascript">

function levarcodigo( id_contrato, num_contrato, id_motorista, id_caminhao, id_rota )
{
   /** O "segredo" está aqui nessas duas linhas, onde é passado o codigo para o <input>
   *    e a descricao para o <label>
   */
   top.opener.document.getElementById("id_contrato").value = id_contrato;
   top.opener.document.getElementById("num_contrato").value = num_contrato;
   window.close();
}
    
</script>
</head>
<body>
	<div class="container">
		<div class="row-fluid text-center">
			<img src="../imagem/topo_pipa.png">
				<hr>
		</div>
		<!-- BARRA -->
		<div class="row-fluid">
			<div class="span6 text-left">
				<small><?php print "Data :".date("d/m/Y");?> </small>
			</div>
			<div class="span6 text-right">
				<small><?php print "Hora :".date("H:i:s");?> </small>
			</div>
		</div>

		<!-- LOGOUT -->
		<div class="row-fluid">
			<div class="span12 text-right">
				<a class="btn btn-primary" href="<?php print SISTEMA;?>/core/logout.php?logout=s" title="Logout do Sistema">Logout</a>
				<p>
					<hr>
			
			</div>
		</div>
		<div class="row-fluid">
			<!-- MENU -->
			<div class="span3">
				<?php include_once 'visao/pipa.menu.php';?>
			</div>
			<div class="span9">

				<form action="#" method="POST" name="" id="" class="" />

				<legend>Pesquisa de Contrato</legend>

				<label>Placa</label>
				<input type="text" name="placa" id="placa" data-mask="aaa-9999">
				<br />
				<input type="submit" class="btn btn-primary" name="pesquisar" id="pesquisar" value="Pesquisar" class="" />

				<?php 

				$_placa = isset($_POST['placa']) ? $_POST['placa'] : null;

				if($_placa != null)
				{

					$dados = Contrato::buscaContrato(false, $_placa);

					//var_dump($dados);


					print "<table class=\"table\" cellspacing=\"0\" border=\"0\" >
					<tr>
					<td align=\"center\">Contrato</td>
					<td algin=\"center\">Placa</td>
					<td align=\"center\">Nome</td>
					<td align=\"center\">Nome Rota</td>
					<td align=\"center\">Rota</td>
					</tr>";

					for ($i = 0; $i < count($dados); $i++)
					{


						print "<tr>
						<td align=\"center\">".$dados[$i]['num_contrato']."</td>
						<td align=\"center\"><a href=\"secao.php?secao=contrato&acao=alterar&id=".$dados[$i]['id_contrato']."\">".htmlentities($dados[$i]['placa'])."</a></td>
						<td align=\"center\">".utf8_encode($dados[$i]['nome'])."</td>
						<td align=\"center\">".$dados[$i]['nome_rota']."</td>
						<td align=\"center\">".$dados[$i]['num_rota']."</td>
						</table>";



					}

				}

				?>
				</td>
				</tr>

				</table>
				</form>
				<script src="<?php print SISTEMA;?>/js/jquery.js"></script>
				<script src="<?php print SISTEMA;?>/js/bootstrap.js"></script>
				<script src="<?php print SISTEMA;?>/js/jasny-bootstrap.js"></script>

</body>
</html>



