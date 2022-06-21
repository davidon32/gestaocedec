<?php include_once PATH.'/core/include.php';?>
<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_ajuda/Model/indexModel.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPageSimples.php";
$tipoLibera = 'Doa&ccedil;&atilde;o';

$id_liberacao = isset($_GET['nlib']) ? $_GET['nlib'] :"";


$result = Pagamento::RelPgto($id_liberacao);

if(empty($result)){
	print "<br><br><p class='text-center'><span class='alert alert-danger'>Não foi possivel gerar esse recibo</span><br><br>";
	print "<a class=\"btn btn-success\" href=\"index.php?token=".hash('sha256', md5(VERSAO).date('dmY'))."&ac=itn&modulo=ajuda&controller=conestoque&action=idxpagamento\">voltar</a></p>";
	die();
}

?>
<style type="text/css">
<!--
body {
	margin: auto !important;
}

@media print {
	.btn, btn-succes {
		display: none;
	}
}
-->
</style>
</head>

<body>
	<div class="container">
		<table align="center" border="0">
			<tr>
				<td><br>
					<?php if(isset($_GET['m'])){?>
						<!--<a class="btn btn-success" href="index.php?token=<?=hash('sha256', md5(VERSAO).date('dmY'))?>&ac=itn&modulo=ajuda&controller=relatorio&action=fbusca_pag_mat">Voltar</a>-->
						<a class="btn btn-success" onclick='history.back();'>Voltar</a>
					<?php }else { ?>
						<a class="btn btn-success" href="index.php?token=<?=hash('sha256', md5(VERSAO).date('dmY'))?>&ac=itn&modulo=ajuda&controller=conestoque&action=recibopg&id=<?=$id_liberacao?>">Voltar</a>
					<?php } ?>
					</td>
			</tr>
			<tr>
				<td>

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

						<legend>Recibo n&#186; :
						<?php print $result['id_pagamento'];?></legend>

					</td>
					<td class="t_trecho" align="right">
					<legend>
						Libera&ccedil;&atilde;o n&#186; :
						<?php print $result['id_liberacao'];?></legend>
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
				<td></td>
					<td colspan="2" style="text-align: center;">
						<br />
						<div class="col-md-12 text-center">
						<?php 
						
							$dados =Liberacao::listaProdutos($result['id_liberacao']);

							print "<table class=\"table\">";
							print "<tr>";
							print "<th>Código</th>";
							print "<th>Material</th>";
							print "<th>Descrição</th>";
							print "<th>Quantidade</th>";
							print "</tr>"; 

							foreach ($dados as $key => $value) {
								print "<tr>"; 
								print "<td>".$value['cod']."</td>";
								print "<td>".Produto::PegaNomeProduto($value['cod'])."</td>";
								print "<td>".$value['descricao']."</td>";
								print "<td>".$value['quantidade']."</td>";
								print "</tr>"; 
							}
							print "</table>";

						
						?>
						</div>
					</td>
					<td></td>
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
						<?php if(isset($_GET['nom']) == 's'){
                                                    print $result['responsavel'];
                                                }
                                                    ?>
					</td>

				</tr>
                                <tr>
					<td>
						<br />
						<br />
						<br />
						<br />
					</td>
					<td style="font-size: 10px;" colspan="4">
						Obs :
						<?=$result['obs']?>

					</td>
				</tr>
				<tr>
					<td>
						<br />
						<br />
						<br />
						<br />
					</td>
					<td style="font-size: 10px;" colspan="4">
						Respons&aacute;vel pelo Preenchimento :
						<?php print Usuario::getNomeId($_COOKIE['seguranca']['idUser'])."<br> Matricula :  ".$_COOKIE['seguranca']['matricula']."</span>";?>

					</td>
				</tr>
                                


			</table>
			<?php //FuncaoBase::vd($_SESSION);?>
		</div>

	</div>
</body>
</html>
