<?php include_once PATH.'/core/include.php';?>
<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_ajuda/Model/indexModel.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPageSimples.php";
$tipoLibera = 'Doa&ccedil;&atilde;o';

$id_liberacao = isset($_GET['id']) ? $_GET['id'] :"";


$result = Liberacao::comprovanteLiberacao($id_liberacao);

if(empty($result)){
	print "<br><br><p class='text-center'><span class='alert alert-danger'>Não foi possivel gerar esse recibo</span><br><br>";
	print "<a class=\"btn btn-success\" href=\"index.php?token=".hash('sha256', md5(VERSAO))."&ac=itn&modulo=ajuda&controller=conestoque&action=idxpagamento\">voltar</a></p>";
	die();
}

?>
<style type="text/css">
<!--
body {
	margin: auto !important;
}

.tbl tr {
 line-height: 30px;
}

@media print {
	.btn, btn-succes {
		display: none;
	}

	.imprimir {
		display: none;
	}
}
-->
</style>
</head>

<body>
	<div class="container">
		<div class="col-md-12 text-center">
		<?php if(isset($_GET['m'])){?>
			<a class="btn btn-success" href="index.php?token=<?=hash('sha256', md5(VERSAO))?>&ac=itn&modulo=ajuda&controller=conestoque&action=idxliberacao">Voltar</a>
		<?php }else { ?>
			<a class="btn btn-success" href="index.php?token=<?=hash('sha256', md5(VERSAO))?>&ac=itn&modulo=ajuda&controller=conestoque&action=comprov_lib&id=<?=$id_liberacao?>">Voltar</a>
		<?php } ?>
		
		</div>

		<div class="layout">

			<table align="center" border="0" width="600" class="tbl">
				<tr>
					<td width="20%" align="center">
						<img src="mod_ajuda/imagem/brasaoMG_80x77.png">
					</td>
					<td colspan="3" align="center">
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
					<td></td>
					<td>
						<h4>Recibo n&#186; :__________</h4>

					</td>
					<td><div style="min-width: 60%">&nbsp;</div></td>
					<td align="right">
					<h4>
						Libera&ccedil;&atilde;o n&#186; <br>:<?php print $result['id_liberacao'];?></h4>
					</td>
					<td>
					</td>

				</tr>
				<tr>
					<td></td>
					<td colspan="3">
						Receb&iacute; da Coordenadoria Estadual de Defesa civil - CEDEC/MG, os seguintes materiais por :
						
						<?php print $tipoLibera;?>
					</td>
					<td></td>

				</tr>
				<tr>
				<td></td>
					<td colspan="3" style="text-align: center;">
						<div class="col-md-12 text-center">
						<?php 
						
							$dados =Liberacao::listaProdutos($result['id_liberacao']);

							print "<table class=\"table table-condensed\">";
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
					<td colspan="5" align="center">DADOS DO DESTINATÁRIO</td>
				</tr>


				<tr>
					<td></td>
					<td colspan="2">Beneficiário</td>
					<td>
						: <b><?=Municipio::PegaNomeMunicipio($result['id_municipio'])?>&nbsp;&nbsp; / &nbsp;&nbsp; <?=$result['beneficiario']?></b>
					</td>
					<td></td>
					
	
				</tr>
				<tr>
					<td></td>
					<td colspan="2"	>CPF/CNPJ</td>
					<td>
						:_______________________________________________
					</td>
					<td></td>
				</tr>

				<tr>
					<td></td>
					<td colspan="2">Endereço</td>
					<td>
						:_______________________________________________
						
					</td>
					<td></td>
				</tr>

				<tr>
					<td></td>
					<td colspan="3" align="center">Celular : ______________________  &nbsp;&nbsp;&nbsp;Telefone :____________________</td>
					</td>
					<td></td>
				</tr>
				<tr>
					<td colspan="5" align="center">RESPONSÁVEL PELA RETIRADA DO MATERIAL</td>
				</tr>
				<tr>
					<td></td>
					<td colspan="2">Responsável</td>
					<td>
						:_______________________________________________
					</td>
					<td></td>

				</tr>
				<tr>
					<td></td>
					<td colspan="3" align="center">	RG: ____________________________ &nbsp;&nbsp;&nbsp; CPF : _______________________</td>
					<td></td>
					
				</tr>
				
				<tr>
					<td></td>
					<td colspan="3" align="center"> Veículo:______________________ &nbsp;&nbsp;&nbsp;Placa:_____________________</td>
					
					<td></td>
				</tr>
				<tr>

					<td></td>
					<td align="right" colspan="3">
						________________________, _____ de _______________ de _____.
					</td>
					<td>
						<br />
					</td>
				</tr>
				<tr>
					<td align="center" colspan="5">
						____________________________________________________
						<br>
						<small>Assinatura:</small>
					</td>

				</tr>
				<tr>
					<td>
						<br />
						<br />
					</td>
					<td style="font-size: 10px;" colspan="4">
						Respons&aacute;vel pelo Preenchimento :
						_______________________________________________

					</td>
				</tr>
                                <tr>
                                    <td>
						<br />
						<br />
					</td>
                                    <td style="font-size: 10px;" colspan="4">
						Obs :<?=$result['id_liberacao']?>

					</td>
				</tr>
			</table>			
		</div>

	</div>
</body>
</html>
