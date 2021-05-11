<?php session_start();
print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
include_once PATH.'/include.php';

$_id = isset($_GET['id']) ? $_GET['id'] : "";

//FuncaoBase::vd($_cpf);

if(($_id != "") && (is_numeric($_id)))
{

	$dados = Motorista::buscaDadosMotoristaId($_id);

}

/* var_dump($dados); */

if($dados[0]['pessoa'] == 'pf')
{
	$_pf = 'checked="checked"';
	$_pj = '';

}
else
{

	$_pj = 'checked="checked"';
	$_pf = '';

}

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php print TITULO;?></title>
<link href="<?php print SISTEMA;?>/css/bootstrap.css" rel="stylesheet" media="screen">
	<link href="<?php print SISTEMA;?>/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
		<script type="text/javascript">
			
			function esconde_rep() {
				$("#moto").hide();
			}

			function mostra_rep() {
				$("#moto").show();
			}

			function pf() {
				$("#cpf_cnpj").mask("999.999.999-99");
				$("#cpf_cnpj_banco").mask("999.999.999-99");
				$(".repre").hide();
				
				$("#nome_r").val("-");
				$("#cpf_r").val("-");
				$("#rg_r").val("-");
				$("#orgao_r").val("-");
				$("#natural_r").val("-");

			}

			function pj() {
				$("#cpf_cnpj").mask("99.999.999/9999-99");
				$("#cpf_cnpj_banco").mask("99.999.999/9999-99");
				$(".repre").show();
			}

			function placa() {
				$("#placa").mask("999-9999");

			}

			function upperCase() {
				var x = document.getElementById("fname");
				x.value = x.value.toUpperCase();
			}
		</script>
</head>
<body>
	<!-- TOPO /system/topo.php-->
    <?php include_once(PATH.'/system/topo.php'); ?>
    <div class="container">
        <!-- MENU -->
        <div class="row-fluid">
            <div class="span3">
                <!-- MENU -->
                <?php include_once PATH."/mod_".$modulo.'/app/elemento/'.$modulo.'.menu.php';?>
                <!-- FIM MENU -->
            </div>
			<div class="span9">
				<legend>Alterar Dados</legend>

				<form id="form1" name="form1" method="post" action="index.php?modulo=pipa&secao=motorista&acao=valida">
					<!-- dados do pipeiro -->

					<input type="hidden" name="id_mot" id="id_mot" value="<?php print $dados[0]['id_motorista'];?>" />

					<div align="center">
						Pessoa F&iacute;sica
						<input type="radio" name="pessoa" value="pf" onclick="javascript:pf();" checked="checked" />
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						Pessoa Jur&iacute;dica
						<input type="radio" name="pessoa" value="pj" onclick="javascript:pj();">
							<br /> <br />
					</div>
					<label>Nome/Razão Social</label>
					<input name="nome" type="text" id="nome" size="60" onclick="javascript:pf();"
						value="<?php print utf8_encode($dados[0]['nome']);?>" readonly="readonly" />
					<label>CPF/CNPJ</label>
					<input type="text" name="cpf_cnpj" id="cpf_cnpj" value="<?php print $dados[0]['cpf_cnpj'];?>" readonly="readonly"/>
					<label>Endereço </label>
					<input name="endereco" type="text" id="endereco" size="60" value="<?php print utf8_encode($dados[0]['endereco']);?>" />
					<label>Bairro </label>
					<input name="bairro" type="text" id="bairro" size="60" value="<?php print utf8_encode($dados[0]['bairro']);?>" />
					<label>Cidade</label>
					<input name="cidade" type="text" id="cidade" size="60" value="<?php print utf8_encode($dados[0]['cidade']);?>" />
					<label>e-mail </label>
					<input name="email" type="text" id="email" size="60" value="<?php print utf8_encode($dados[0]['email']);?>" />
					<label>Cep </label>
					<input type="text" name="cep" id="cep" size="60" data-mask="99/99/9999" value="<?php print $dados[0]['cep'];?>" />
					<label>UF </label>
					<input type="text" name="uf" id="uf" size="60" maxlength="2" value="<?php print $dados[0]['uf'];?>" />
					<label>Data Nasc </label>
					<input type="text" name="dt_nasc" id="dt_nasc" data-mask="99/99/9999" size="60" value="<?php print DataMysql::dataVisual($dados[0]['dt_nasc']);?>" />
					<label>Telefone </label>
					<input type="text" name="tel" id="tel" data-mask="(99)9999-9999" size="60" value="<?php print $dados[0]['tel'];?>" />
					<label>Celular</label>
					<input type="text" name="cel" id="cel" data-mask="(99)9999-9999" size="60" value="<?php print $dados[0]['cel'];?>" />
					<label>RG </label>
					<input type="text" name="rg" id="rg" size="60" value="<?php print $dados[0]['rg'];?>" />
					<label>Órgão Expedidor</label>
					<input type="text" name="orgao" id="orgao" size="60" value="<?php print $dados[0]['orgao'];?>" />
					<label>Inscr. Estadual </label>
					<input type="text" name="inscr_est" id="inscr_est" size="60" value="<?php print $dados[0]['inscr_est'];?>" />
					
					<label>PIS/PASEP/NIT/INSS </label>
					<input type="text" name="pis_pasep" id="pis_pasep" data-mask="9.999.999.999-9" size="60" value="<?php print $dados[0]['pis_pasep'];?>" />
					<label>Nº CNH </label>
					<input type="text" name="cnh" id="cnh" size="60" value="<?php print $dados[0]['cnh'];?>" />
					<label>Inscr. Municipal </label>
					<input type="text" name="inscr_mun" id="inscr_mun" size="60" value="<?php print $dados[0]['inscr_mun'];?>" />
					<label>Pai </label>
					<input type="text" name="pai" id="pai" size="60" value="<?php print utf8_encode($dados[0]['pai']);?>" />
					<label>Mãe</label>
					<input type="text" name="mae" id="mae" size="60" value="<?php print utf8_encode($dados[0]['mae']);?>" />
					<label>Placa </label>
					<input type="text" name="placa" id="placa" size="60" value="<?php print $dados[0]['placa'];?>" />
					<input type="hidden" name="nome_rep" id="nome_rep" value="-" />
					<!--<br />-->
					<!--<div>CPF</div>:-->
					<input type="hidden" name="cpf_rep" id="cpf_rep" class="cpf" value="0" />
					<!--<br />-->
					<!--<div class="label">RG</div>:-->
					<input type="hidden" name="rg_rep" id="rg_rep" value="0" />
					<!--<br />-->
					<!--<div class="label">Órgão Emissor</div>:-->
					<input type="hidden" name="orgao_rep" id="orgao_rep" value="-" />
					<!--<br />-->
					<!--<div class="label">Est. Civil</div>:-->
					<input type="hidden" name="est_civil_rep" id="est_civil_rep" value="-" />
					<label>Naturalidade</label>
					<input type="text" name="natural_rep" id="natural_rep" size="60" value="<?php print $dados[0]['natural_rep'];?>" />
					<label>Banco do Brasi</label>
					<input type="text" name="banco" id="banco" size="60" value="<?php print $dados[0]['banco'];?>" />
					<label>Agencia</label>
					<input type="text" name="agencia" id="agencia" size="60" value="<?php print $dados[0]['agencia'];?>" />
					<input type="hidden" name="conta" id="conta" value="-" />
					<!-- <div>Tipo da Conta</div>:-->
					<input type="hidden" name="tipo" id="tipo" value="-" />
					<label>Município</label>
					<input type="text" name="mbanco" id="mbanco" size="60" value="<?php print utf8_encode($dados[0]['mbanco']);?>" />
					<input type="submit" id="cadastrar" name="cadastrar" value="Confirmar"
						onclick="return confirm('Deseja Confirmar o cadastro !');" />
				</form>
			</div>
		</div>

	</div>

	<script src="<?php print SISTEMA;?>/js/jquery.js"></script>
	<script src="<?php print SISTEMA;?>/js/bootstrap.js"></script>
	<script src="<?php print SISTEMA;?>/js/jasny-bootstrap.js"></script>
	<script src="<?php print SISTEMA;?>/js/funcaobase.js"></script>

</body>
</html>
