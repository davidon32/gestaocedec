<?php session_start();
print "<!DOCTYPE html>";
include_once PATH.'/include.php';
/*
	@
	@Assunto   : Busca de contratos cadastrados no sistema para gerar valores
	@Autor     : Demetrio Passos
	@Data      : 01/03/2011
	@Informação:
*/
$_conexao = new ConexaoMysql();

$_relatorio = new Relatorio();

$_funcionario = new EquipeFuncionario();

$_mes = isset($_GET['mes']) ? $_GET['mes'] : ""; 

$_ano = isset($_GET['ano']) ? $_GET['ano'] : "";

$cpf  = isset($_GET['cpf']) ? $_GET['cpf'] : "";

if(is_numeric($_mes) && is_numeric($_ano) && ($cpf =="") && (isset($_SESSION['oficial_responsavel']))){

	$dados = $_relatorio->ConsideracaoDespesa($_mes, $_ano, false);

}else if(is_numeric($_mes) && is_numeric($_ano) && ($cpf != "") && (isset($_SESSION['oficial_responsavel']))){
    
    $dados = $_relatorio->ConsideracaoDespesa($_mes, $_ano, $cpf);
 
}else {

	print "<script type='text/javascript'>";

	print "alert('Dados Não Disponíveis para Gerar relatório !');";

	print "history.back();";

	print "</script>";

}

//var_dump($dados);

//var_dump($_GET);

//var_dump($_SESSION);

$_count = 0;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php print TITULO;?></title>
<style type="text/css">
	body {

		width: 750px;
		font-family: tahoma;
	}

	table {

		border-collapse: separate;
		border-collapse: collapse;
	}
	.quadro2 {

		height: 120px;

	}
	.rodape {

		font-size: 8px;

	}

	.text-center {

		text-align: center;
	}

	.assina {

		font-size: 12px;
	}

	@media print {

		.imprimir {

			display: none;
		}

	}


</style>
</head>
<body>
<div class="container">
	<div class="span12 text-center imprimir">
		<a class="btn btn-primary" href="index.php?modulo=pipa&secao=conta&acao=consideraDespesa">Voltar</a>
	</div>
	<?php for ($i=0; $i < count($dados); $i++) { 
		?>
	<div class="row-fluid">
		
		<div class="span12">
			<br />
			<table align="center" border="0" width="700px" height="990px" cellspacing="0" cellpading="0">
				<tr>
					<td align="center" colspan="10" width="150px" height="80px">
						<b>GABINETE MILITAR DO GOVERNADOR<br />
						COORDENADORIA ESTADUAL DE DEFESA CIVIL
					</td>
				</tr>
				<tr>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					<td colspan="6" align="center">
						SUPERINTEDENCIA ADMINISTRATIVA
						<br />
						DIRETORIA ADMINISTRATIVA<p>
						<u>CONSIDERAÇÃO DE DESPESA</u>
						<br />
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td colspan="6" align="justify">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						Solicito considerar a despesa  no valor de 
						<?php print "R$".number_format($dados[$i]['valor'], 2, ',', '.')." (".Monetary::numberToExt($dados[$i]['valor']);?>), 
						em favor de <b><u><?php print utf8_encode($dados[$i]['nome']);?></u></b>, conforme dados
						descritos abaixo e no Recibo de Pagamento de Autônomo (RPA) nº <?php print $dados[$i]['num_rpa']. " de <b>".FuncaoBase::numTomes($_mes)."/".$_ano;?></b><br />
						Dotação orçamentária : 1071 06 182 741 4 262 0001 3 3 90 36 26 10 1 0
					</td>
				</tr>
				<tr>
				    
					<td>&nbsp;</td>
					<td colspan="2">CNPJ/CPF :</td>
					<td colspan="2" align="left"><?php print $dados[$i]['cpf_cnpj'];?></td>
					<td colspan="2">&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td colspan="6">
						<table border="1" align="center" width="80%" style="font-size:12px;">
						    <tr>
						        <td colspan="3" align="center">Valor líquido</td>
                                <td colspan="3" align="center">R$ <?php print number_format($dados[$i]['liquido'], 2, ',', '.');?></td>
						        
						    </tr>
						    
							<tr>
								<td colspan="6" align="center"><b>RETENÇÕES FISCAIS</b></td>
							</tr>
							<tr>
								<td colspan="3" align="center">Tributo</td>
								<td colspan="3" align="center">VALOR (R$)</td>
							</tr>
							<tr>
								<td colspan="3" align="center">INSS</td>
								<td colspan="3" align="center">R$ <?php print number_format($dados[$i]['inss'], 2, ',', '.');?></td>
							</tr>
							<tr>
								<td colspan="3" align="center">SEST/SENAT</td>
								<td colspan="3" align="center">R$ <?php print number_format($dados[$i]['sestsenat'], 2, ',', '.');?></td>
							</tr>
							<tr>
								<td colspan="3" align="center" bgcolor="silver"><b>Total do INSS + SEST/SENAT</b></td>
								<td colspan="3" align="center" bgcolor="silver"><b>R$ <?php print number_format($dados[$i]['inss']+$dados[$i]['sestsenat'], 2, ',', '.');?></b></td>
							</tr>
							<tr>
								<td colspan="3" align="center">IRRF</td>
								<td colspan="3" align="center">R$ <?php print number_format($dados[$i]['irrf'], 2, ',', '.');?></td>
							</tr>
							<tr>
								<td colspan="3" align="center">Valor líquido</td>
								<td colspan="3" align="center">R$ <?php print number_format($dados[$i]['liquido'], 2, ',', '.');?></td>
							</tr>
							<tr>
								<td colspan="6"><hr class="hr"></td>
							</tr>
							
							<tr>
								<td colspan="2" align="center"><b>EMPENHO Nº</b></td>
								<td colspan="2" align="center"><b>PROCESSO Nº</b></td>
								<td colspan="2" align="center"><b>CONTRATO Nº</b></td>
							</tr>
							<tr>
								<td colspan="2" align="center"><?php //print $dados[$i]['num_empenho'];?> <!--/ <?php print substr($dados[$i]['dt_empenho'],0,4);?>--></td>
								<td colspan="2" align="center">-</td>
								<td colspan="2" align="center"><?php print $dados[$i]['num_contrato']."/".$dados[$i]['ano'];?></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td colspan="6">
						Obs.: Nota de empenho fundamentada na Portaria 156/2015 do Ministério da 
						Integração Nacional e no Registro do SIAF/MG sob o nº 9041425.
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td colspan="3">Em _____/_____/_______.</td>
					<td colspan="3"></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td align="center" colspan="6">
						<table border="0" width="90%">
							<tr>
								<td align="center" width="50%"><br />
                                    <?php print $_funcionario->getFuncionarioId($_SESSION['seguranca']['id_funcionario']); ?>
									<br />
									<label class="assina">Responsável pela execução</label>
								</td>
								<td  align="center" width="50%"><br />
                                    <?php print $_funcionario->getFuncionarioId($_SESSION['oficial_responsavel']); ?>
									<br />
									<label class="assina"><?php $posto = $_funcionario->pegaDadosFuncionario($_SESSION['oficial_responsavel']); print utf8_encode($posto['desc_funcao']) ; ?></label>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td colspan="3">De acordo</td>
					<td colspan="3">&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td colspan="3">Em _____/_____/_______.</td>
					<td colspan="3">&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td colspan="6" align="center" font-size="5px"><br /><b>
						<?php $ordenador = FuncaoBase::pegaParametro(); print EquipeFuncionario::getFuncionarioId($ordenador['ordDespesa']); ?></b><br />
						<label class="assina">Ordenador de Despesa</label>
						<br /><br />

					</td>
				</tr>
				<tr>
					<td height=""></td>
					<td colspan="2"></td>
					<td colspan="4">
						<div class="quadro2">
							<!-- <table border="1" style="font-size:15px;width:70%;" cellspacing="0" cellpading="0" align="right">
								<tr>
									<td colspan="3" align="center">
										GABINETE MILITAR DO GOVERNADOR<br />
										DIRETORIA ADMINISTRATIVA 
									</td>
								</tr>
								<tr>
									<td colspan="2" align="center">DADOS DO PROCESSO</td>
									
									<td align="center">DATA</td>
								</tr>
								<tr>
									<td>PROCESSO Nº</td>
									<td>Não se aplica&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
									<td>___/___/___</td>
								</tr>
								<tr>
									<td>EMPENHO Nº</td>
									<td><?php print $dados[$i]['num_empenho'];?>/<?php print substr($dados[$i]['dt_empenho'],0,4);?></td>
									<td><?php //print DataMysql::dataVisual($dados[$i]['dt_empenho']);?></td>
								</tr>
								<tr>
									<td>SEQ. LIQ Nº</td>
									<td></td>
									<td>___/___/___</td>
								</tr>
								<tr>
									<td>Q. F. E.  Nº</td>
									<td></td>
									<td>___/___/___</td>
								</tr>
							</table> -->
						</div>
						
					</td>
				</tr>

			</table>
		</div>

	</div>
	<!-- RODAPE -->
	<div class="row-fluid text-center">
		
	</div>
	<?php

		// quebra de página
		$_count++;
	
		if($_count == 1){

			print '<div style="page-break-before: always"></div>';
			$_count = 0;
		}
	}
	?>
</div>
	<script src="<?php print SISTEMA;?>/js/jquery.js"></script>
	<script src="<?php print SISTEMA;?>/js/bootstrap.js"></script>
	<script src="<?php print SISTEMA;?>/js/jasny-bootstrap.js"></script>
	</body>
</html>
