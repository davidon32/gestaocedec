<?php session_start();
print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
include_once PATH."/include.php";

$_conexao = new ConexaoMysql();

$_login = new Login();

$_login->logado();


$tipoLibera = 'Doa&ccedil;&atilde;o';

//$result = Pagamento::RelPgto($_GET['id']);
$result = Pagamento::RelPgto($_GET['nlib']);

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php print TITULO; ?></title>
<link href="/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
<link rel="stylesheet" type="text/css" href="css/print.css" media="print" />
<style type="text/css">
<!--
body {
	margin: auto !important;
}
-->
</style>
</head>

<body>
	<div class="container">
		<table align="center" border="0">
			<tr>
				<td>
					<?php FuncaoBase::vifs('volta', 'index.php?token='.hash('sha256', md5(VERSAO).date('dmY')).'&ac=&modulo=ajuda&secao=pagamento&acao=pagamento');?>
				</td>
			</tr>
			<tr>
				<td>
					<?php "<a href=\"../core/sc.recibo.pagamento.php?id_lib={$_GET['nlib']}\">Voltar</a><br />";?>
				</td>
			</tr>

		</table>

		<div class="layout">

			<br />
			<br />
			<table align="center" border="0" width="600">
				<tr>
					<td width="20%" align="center">
						<img src="mod_ajuda/imagem/brasaoMG_80x77.png">
					</td>
					<td colspan="2" align="center">
						Estado de Minas Gerais
						<br />
						Gabinete Militar do Governador
						<br />
						Coordenadoria Estadual de Defesa Civil
					</td>
					<td width="20%" align="center">
						<img src="mod_ajuda/imagem/logodefesacivilpng80x77.png">
					</td>

				</tr>
				<tr>
					<td>
						<br />
					</td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td>

						Recibo n&#186; :
						<?php print $result['id_pagamento'];?>

					</td>
					<td class="t_trecho" align="right">
						Libera&ccedil;&atilde;o n&#186; :
						<?php print $result['id_liberacao'];?>
					</td>
					<td>
						<br />
					</td>

				</tr>
				<tr>
					<td></td>
					<td colspan="4">
						Receb&iacute; da Coordenadoria Estadual de Defesa civil - CEDEC/MG, os seguintes materiais por :
						<br />
						<?php print $tipoLibera;?>
					</td>

				</tr>
				<tr>
					<td colspan="4" align="center">
						<br />
						<?php Liberacao::listaProdutos($result['id_liberacao']);?>
					</td>
				</tr>
				<tr>
					<td colspan="4" align="center"><hr></td>

				</tr>
				<tr>
					<td colspan="4" align="center">DADOS DO DESTINATÁRIO</td>
				</tr>


				<tr>
					<td></td>
					<td>Beneficiário</td>
					<td>
						:
						<?php print $result['beneficiario'];?>
					</td>
					<td>
						<?php print $result['municipio']; ?>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>CPF/CNPJ</td>
					<td colspan="3">
						:
						<?php print $result['cpf_benef'];?>
					</td>
				</tr>

				<tr>
					<td></td>
					<td>Endereço</td>
					<td colspan="2">
						:
						<?php print $result['endereco'] ;?>
					</td>
				</tr>

				<tr>
					<td></td>
					<td>Telefone</td>
					<td colspan="2">
						:
						<?php print $result['tel_dest']; ?>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>Celular</td>
					<td colspan="2">
						:
						<?php print $result['cel_dest'];?>
					</td>
				</tr>


				<tr>
					<td colspan="4" align="center"><hr></td>
				</tr>

				<tr>
					<td colspan="4" align="center">RESPONSÁVEL PELA RETIRADA DO MATERIAL</td>

				</tr>
				<tr>
					<td></td>
					<td>Responsável</td>
					<td colspan="2">
						:
						<?php print $result['responsavel'];?>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>RG</td>
					<td colspan="2">
						:
						<?php print $result['nDocumento'];?>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>CPF</td>
					<td colspan="2">
						:
						<?php print $result['cpf_resp'];?>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>Veículo</td>
					<td colspan="2">
						:
						<?php print $result['veiculo'];?>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>Placa</td>
					<td colspan="2">
						:
						<?php print $result['placa'];?>
					</td>
				</tr>

				<tr>

					<td align="right" colspan="3">
						<br />
						<br />
						<?php print $result['municipio'].", ".DataMysql::dataExtensoDocumento(DataMysql::dataVisual($result['dtPagto']));?>
					</td>
					<td>
						<br />
					</td>
				</tr>
				<tr>
					<td colspan="4">
						<br />
					</td>
				</tr>
				<tr>
					<td align="center" colspan="4">
						<br />
						--------------------------------------------------------
						<br />
						Assinatura:
						<?php print $result['responsavel'];?>
					</td>

				</tr>
				<tr>
					<td>
						<br />
						<br />
						<br />
						<br />
					</td>
					<td style="font-size: 8px;" colspan="4">
						Respons&aacute;vel pelo Preenchimento :
						<?php print Usuario::getNomeId($_SESSION['seguranca']['idUser'])."</span>";?>
					</td>
				</tr>


			</table>
			<?php //FuncaoBase::vd($_SESSION);?>
		</div>

	</div>
</body>
</html>
