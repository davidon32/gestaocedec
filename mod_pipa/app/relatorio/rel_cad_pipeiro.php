<html>
<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title></title>
		<script type="text/javascript" src="/proj.portal_cedec/js/jquery-1.7.1.min.js"></script>
		<script type="text/javascript" src="/proj.portal_cedec/js/jquery.maskedinput-1.3.min.js"></script>
		<script type="text/javascript" src="/proj.portal_cedec/js/mascara.js"></script>
		<link href="../css/estilo.css" rel="stylesheet" type="text/css" />

</head>
</html>
<?php


include_once '../../include.php';


	$_conexao = new ConexaoMysql();



	$dados = Pipeiro::BuscaPipeiro(false, $_GET['id']);

	FuncaoBase::vd($dados);


?>

<table align="center" border="1" width="800">
	<tr></tr>
	<tr>
		<td>Código</td><td colspan="3"><?php print htmlentities($dados[0]['id_pipeiro']);?> </td> 
	</tr>
	<tr>
	  <td>&nbsp;</td>
      <td>&nbsp;</td>
  </tr>
	<tr>
		<td>Nome</td><td><?php print htmlentities($dados[0]['nome']);?></td>
	</tr>
	<tr>
		<td>Endereço</td><td><?php print htmlentities($dados[0]['endereco']);?></td>
	</tr>
	<tr>
		<td>Bairro</td><td><?php print htmlentities($dados[0]['bairro']);?></td><td>Cep</td><td><?php print htmlentities($dados[0]['cep']);?></td>
	</tr>
	<tr>
		<td>Cidade</td><td><?php print htmlentities($dados[0]['cidade']). " - MG";?></td><td>Data Nasc.</td><td></td>
	</tr>
	<tr>
		<td>Natural</td><td><?php //print $dados[0]['nac'];?></td><td>Telefone</td><td><?php print htmlentities($dados[0]['tel'])."/".htmlentities($dados[0]['cel']);?>
	</tr>
	<tr>
		<td>Estado Civil</td><td><?php //print $dados[0]['est'];?></td><td><!--Profissão--></td><td><?php //print $dados[0]['profissao'];?>
	</tr>
	<tr>
		<td>Filiacão</td><td>Pai :<?php print htmlentities($dados[0]['pai']);?><br />Mãe :<?php print htmlentities($dados[0]['mae']);?></td>
	</tr>
	<tr>
		<td>email</td><td><?php print htmlentities($dados[0]['email']);?></td>
	</tr>
	<tr>
	  <td>&nbsp;</td>
      <td>&nbsp;</td>
  </tr>
	<tr>
	  <td>&nbsp;</td>
      <td>&nbsp;</td>
  </tr>
	<tr>
	  <td>&nbsp;</td>
      <td>&nbsp;</td>
  </tr>
	<tr>
	  <td>&nbsp;</td>
      <td>&nbsp;</td>
  </tr>
	<tr>
		<td></td><td></td>
	</tr>
	<tr>
		<td></td><td></td>
	</tr>
	<tr>
		<td></td><td></td>
	</tr>
	<tr>
		<td></td><td></td>
	</tr>
	<tr>
		<td></td><td></td>
	</tr>
	<tr>
		<td></td><td></td>
	</tr>
</table>