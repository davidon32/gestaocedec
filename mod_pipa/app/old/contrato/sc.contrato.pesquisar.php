<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php 
include_once '../include.php';
$_conexao = new ConexaoMysql();
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

<body style="width: 310; height: 200">

	<form action="#" method="post" name="" id="" class="" />

	<table width="600" border="0">
		<tr>
			<td align="center"><br /> <span class="titulo">Pesquisa de Contrato</span><br /> <br />
			</td>
		</tr>
		<tr>
			<td>
				<table align="center" border="0">
					<tr>
						<td>PLACA</td>
						<td>:<input type="text" name="placa" id="placa" data-mask="aaa-9999">
						</td>
					</tr>
					<tr>
						<td></td>
						<td align="right"><input type="submit" class="btn btn-primary" name="pesquisar" id="pesquisar" value="Pesquisar" class="" /></td>
					</tr>
				</table>

			</td>
		</tr>
		<tr>
			<td align="center"><?php 

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
			                    <td align=\"center\"><a href=\"#\" onclick=\"levarcodigo('".$dados[$i]['id_contrato']."', '".$dados[$i]['num_contrato']."')\">".htmlentities($dados[$i]['placa'])."</a></td>
			                    <td align=\"center\">".utf8_encode($dados[$i]['nome'])."</td>
			                    <td align=\"center\">".$dados[$i]['nome_rota']."</td>
			                    <td align=\"center\">".$dados[$i]['num_rota']."</td>
			               </table>";
			                    
			        

			    }

			}

?></td>
		</tr>
		<tr align="center">
			<td><br /> <br /> <br /> <br />
			<?php 
			FuncaoBase::Fechar();
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



