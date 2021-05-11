<?php session_start();
print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
include_once PATH.'/include.php';

$_conexao = new ConexaoMysql();

$_login = new Login();

$_login->logado();

$_login->Sessao();

$_pagamento = new Pagamento();


/* ****************************************************************************************
 *  	Org�o Gestor : Coordenadoria Estadual de Defesa Civil do Estado de Minas Gerais
*	Sistema      : Sistema de Gest�o de Ajuda Humanit�ria
*
*	Autor        :  Demetrio Silva Passos
*	Fun��o       : Tela de Executar Libera��o de Materiais
*
*******************************************************************************************/

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php print TITULO; ?>
</title>
<link href="/css/bootstrap.css" rel="stylesheet" media="screen">
	<link href="/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
</head>
<!-- Mascara CPF CNPF -->
<body onload="maskCPFCNPJ();">
	<?php 

	$dtArruma = new dataMysql();

	$id_libera = $_GET['id'] ? $_GET['id'] : null;

	if((int)$id_libera){

		$dado = $_pagamento->EfetPgto($id_libera);

		//$pgto -> MosLibInd($_SESSION['seguranca']['idUser'], $_GET['idLibera']);

		?>
		
	<!-- TOPO /system/topo.php-->
    <?php include_once(PATH.'/system/topo.php'); ?>
		
	<div class="container">
		
		<!-- MENU -->
		<div class="row-fluid">
			<div class="span3">
				<?php include_once PATH."/mod_".$modulo.'/app/elemento/'.$modulo.'.menu.php';?>
			</div>
			<div class="span9 fdo_corpo">
				<legend>Efetivar Pagamento</legend>
				<form method="post" name="efetPag" action="index.php?modulo=ajuda&secao=pagamento&acao=valida&id=<?php print $dado[0]; ?>">
					<!--   dados da liberacao -->
					<legend>Dados da Libera&ccedil;&atilde;o</legend>
					<table>
						<tr>
							<td>
								<label>N&uacute;mero Libera&ccedil;&atilde;o:</label>
								<input type="text" name="nLibera" value="<?php print $dado[0];?>" readonly="readonly" />
							</td>
							<td>
								<label>Data Libera&ccedil;&atilde;o:</label>
								<input name="dtLibera" type="text" id="dtLibera" value="<?php print DataMysql::dataVisual($dado[2])?>" readonly="readonly" />
								</span>
							</td>
						</tr>
						<tr>
							<td>
								<label>Data Pagamento:</label>
								<input name="dtPgto" type="text" id="dtPgto" data-mask="99/99/9999" />
								<span class="info">*</span></span>
							</td>
						</tr>
					</table>

					<!-- dados do destinatario -->
					<legend> Dados do Destinat&aacute;rio</legend>

					<table>
						<tr>
							<td>
								<label>
									Pessoa Física
									<input type="radio" name="ck_pessoa" id="ck_pf" class="ck_pessoa" value="pf" onchange="maskCPFCNPJ();" checked="checked" />
								</label>

								<label>
									Pessoa Jurídica
									<input type="radio" name="ck_pessoa" id="ck_pj" class="ck_pessoa" value="pj" onclick="maskCPFCNPJ();" />
								</label>
							</td>
						</tr>
						<tr>
							<td>
								<label>Destino:</label>
								<input name="beneficiario" type="text" id="beneficiario" size="40" value="<?php print $dado[3];?>" readonly="readonly" />
							</td>
							<td>
								<label>CNPJ/CPF:</label>
								<input name="cpf" id="cpf" type="text" size="40" class="" data-mask="999.999.999-99">
									<input name="cnpj" id="cnpj" type="text" size="40" class="" data-mask="99.999.999/9999-99">
										
										
										
										<span class="info">*</span>
								
							
							
							
							</td>

							</tr>
							<tr>
								<td>
									<label>Endere&ccedil;o:</label>
									<input name="endereco" type="text" size="40">
									
									
									
									<span class="info">*</span>
								
							
							
							
							</td>
								<td>
									<label>N&uacute;mero:</label>
									<input name="numero" type="text" value="" size="40">
									
									
									
									<span class="info">*</span>
								
							
							
							
							</td>
							</tr>
							<tr>
								<td>
									<label>Munic&iacute;pio:</label>
									<input name="municipio" type="text" id="municipio" size="40"
									value="<?php print Municipio::PegaNomeMunicipio($dado[1]);?>" readonly="readonly" />
								</td>
														
								<td>
									<label>Bairro:</label>
									<input name="bairro" type="text" size="40">
									
									
									
									<span class="info">*</span>
								
							
							
							
							</td>
							</tr>
							<tr>
								<td>
									<label>Telefone:</label>
									<input name="tel_dest" type="text" data-mask="(99)9999-9999" size="40">
									
									
									
									<span class="info">*</span>
								
							
							
							
							</td>
								<td>
									<label>Celular:</label>
									<input name="cel_dest" type="text" data-mask="(99)9999-9999" size="40">
									
									
									
									<span class="info">*</span>
								
							
							
							
							</td>
							</tr>

						</table>
	
						<!-- dados do responsavel pela liberacao-->
						
						<legend>Respons&aacute;vel pela Retirada do Material</legend>
														
						<table>
							<tr>
								<td>
									<label>Respons&aacute;vel:</label>
									<input name="responsavel" type="text" id="responsavel" size="40" />
								
								
								
								<span class="info">*</span>
								</td>
								<td>
									<label>Identidade:</label>
									<input name="nDoc" type="text" id="nDoc" size="40" />
								
								
								
								<span class="info">*</span>
									
									<!-- campo oculto para pegar a data limite de pagamento-->
									<input type="hidden" name="dtLimite" value="<?php print DataMysql::dataVisual($dado[4]);?>" />
								</td>
							</tr>
							<tr>
								<td>
									<label>CPF:</label>
									<input name="cpfResp" type="text" data-mask="999.999.999-99" size="40">
									
									
									
									<span class="info">*</span>
								
							
							
							
							</td>
								<td>
									<label>Ve&iacute;culo:</label>
									<input name="veiculo" type="text" size="40">
									
									
									
									<span class="info">*</span>
								
							
							
							
							</td>
							</tr>
							<tr>
								<td style="vertical-align: text-top;">
									<label>Placa:</label>
									<input name="placa" type="text" size="40" data-mask="aaa-9999">
									
									
									
									<span class="info">*</span>
								
							
							
							
							</td>
								<td>
									<label>Obs:</label>
									<textarea name="obs" cols="40" rows="4"></textarea>
								</td>
							</tr>
						</table>
						
						<label>
						
						
						
						<input type="submit" class="btn btn-primary" name="btnPag" id="btnPag" value="Realizar Pagamento"
							onclick="return confirm('Deseja Confirmar o Pagamento ?');" />
					
					
					
					</label>
						
					</form>
						
			</div>
		</div>
		<?php }else {

			print 'erro';
				
		}
		?>

	<script src="/js/jquery.js"></script>
	<script src="/js/bootstrap.js"></script>
	<script src="/js/jasny-bootstrap.js"></script>
	<script type="text/javascript">

		function maskCPFCNPJ(){

			$("#cnpj").hide();

			if($("#ck_pf").is(":checked")){

				$("#cpf").show();
				$("#cnpj").hide();

			}else if($("#ck_pj").is(":checked")){

				$("#cnpj").show();
				$("#cpf").hide();
			}



		}

	</script>
	



</body>
</html>

