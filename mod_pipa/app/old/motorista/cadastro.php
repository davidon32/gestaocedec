<?php session_start();
print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
include_once PATH.'/include.php';

$_login = new Login();

$_login->logado();

$_login->Sessao();


?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php print TITULO;?></title>
<link href="/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
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

			<!--  corpo do formulario     -->
			<div class="span9">
				<br />
				<form id="form1" name="form1" method="POST" action="index.php?modulo=pipa&secao=motorista&acao=valida">

					<legend>Cadastro de Motorista</legend>
					<div class="controls controls-row">
						<div class="span4">
							Pessoa Física
							<input type="radio" name="pessoa" id="pessoaPf" value="pf" onclick="javascript:pf();"/>
						</div>
						<div class="span4">
							Pessoa Jurídica
							<input type="radio" name="pessoa" id="pessoaPj" value="pj" onc />
						</div>
					</div>

					<div class="controls controls-row">
						<input class="span9 pula" name="nome" type="text" id="nome" placeholder="Nome do Motorista" />
						&nbsp;<a class="btn window" href="index.php?modulo=pipa&secao=motorista&acao=pesquisar" class="window" rel="960x600">Pesquisar</a>
					</div>
					<div class="controls controls-row">
						<input class="span4" type="text" name="cpf_cnpj" id="cpf_cnpj" placeholder="CPF/CNPJ" title="Campo Obrigatorio !" />
						<span class="span1"><i class='icon-info-sign'></i></span>
						<input class="span7" name="endereco" type="text" id="endereco" placeholder="Endereço" title="Campo Obrigatório !" />
					</div>

					<div class="controls controls-row">
						<input class="span3" name="bairro" type="text" id="bairro" placeholder="Bairro" title="Campo Obrigatório !" />
						<input class="span3" name="cidade" type="text" id="cidade" placeholder="Cidade" title="Campo Obrigatório !" />
						<input class="span6" name="email" type="text" id="email" placeholder="e-mail" title="Email" />
					</div>


					<div class="controls controls-row">
						<input class="span3" type="text" name="cep" id="cep" data-mask="99999-999" placeholder="cep" title="Cep" />
						<input class="span2" type="text" name="uf" id="uf" value="MG" placeholder="UF" title="Estado" />
						<input class="span3" type="text" name="dt_nasc" id="dt_nasc" data-mask="99/99/9999" placeholder="Data Nascimento"
							title="Data de Nascimento" />
						<input class="span4" type="text" name="tel" id="tel" data-mask="(99)9999-9999" placeholder="Telefone" title="Telefone" />
					</div>

					<div class="controls controls-row">
						<input class="span3" type="text" name="cel" id="cel" data-mask="(99)9999-9999" placeholder="Celular" title="Celular" />
						<input class="span3" type="text" name="rg" id="rg" placeholder="Carteira de Identidade" title="Carteira de Identidade" />
						<input class="span3" type="text" name="orgao" id="orgao" placeholder="Órgão Expedidor" title="Órgão Expedidor" />
						<input class="span3" type="text" name="inscr_est" id="inscr_est" placeholder="Inscrição Estadual" title="Inscrição Estadual" />
					</div>

					<div class="controls controls-row">
						<input class="span4" type="text" name="pis_pasep" id="pis_pasep" data-mask="9.999.999.999-9" placeholder="PIS/PASEP/INSS" title="PIS/PASEP/NIT" />
						<input class="span4" type="text" name="cnh" id="cnh" placeholder="Nº CNH" title="Carteira de Habilitação" />
						<input class="span4" type="text" name="inscr_mun" id="inscr_mun" placeholder="Inscrição Municipal" title="Inscrição Municipal" />
					</div>

					<div class="controls controls-row">
						<input class="span4" type="text" name="pai" id="pai" placeholder="Pai" title="Nome do Pai" />
						<input class="span4" type="text" name="mae" id="mae" placeholder="Mãe" title="Nome da Mãe" />
						<input class="span4" type="text" name="placa" id="placa" placeholder="Placa" data-mask="aaa-9999" title="Placa do Veículo" />
					</div>

					
					<!--<fieldset class="repre">
	    		<legend>Representante da Empresa</legend>
	    		<!--<div class="label">Nome</div>:-->
					<input type="hidden" name="nome_rep" id="nome_rep" value="-" title="" />
					<!--<br title=""/>-->
					<!--<div class="label">CPF</div>:-->
					<input type="hidden" name="cpf_rep" id="cpf_rep" class="cpf" value="0" title="" />
					<!--<br title=""/>-->
					<!--<div class="label">RG</div>:-->
					<input type="hidden" name="rg_rep" id="rg_rep" value="0" title="" />
					<!--<br title=""/>-->
					<!--<div class="label">Órgão Emissor</div>:-->
					<input type="hidden" name="orgao_rep" id="orgao_rep" value="-" title="" />
					<!--<br title=""/>-->
					<!--<div class="label">Est. Civil</div>:-->
					<input type="hidden" name="est_civil_rep" id="est_civil_rep" value="-" title="" />
					<!--<select name="est_civil_rep" id="est_civil_rep">
	    		<option>-</option>
	    		<option>Solteiro</option>
	    		<option>Casado</option>
	    		<option>Divorciado</option>
	    		<option>Desquitado</option>
	    		<option>Viúvo</option>
	    		<option>Separado</option>
	    		</select>-->
					<div class="controls controls-row">
						<input class="span3" type="text" name="natural_rep" id="natural_rep" placeholder="Naturalidade" title="Naturalidade" />
						<input class="span3" type="text" name="banco" id="banco" value="001" placeholder="Número do Banco" title="Domicílio Bancário" readonly="readonly" />
					</div>

					<div class="controls controls-row">
						<input class="span3" type="text" name="agencia" id="agencia" placeholder="Agência Bancária" title="Agência Bancária" />
						<input class="span3" type="text" name="mbanco" id="mbanco" placeholder="Município Bancário" title="Município do Banco" />
					</div>
					<input type="hidden" name="conta" id="conta" value="-" placeholder="Conta" title="Nº da Conta" />
					<input type="hidden" name="tipo" id="tipo" value="-" title="" />
					<input type="submit" class="btn btn-primary" name="cadastrar" id="cadastrar" value="cadastrar" onclick="return confirm('Deseja Confirmar o cadastro !');" />
				</form>
				<div class="row-fluid fdo_corpo"></div>
			</div>
			<!-- RODAPE -->
			<div class="row-fluid text-center">
				<small><?php print RODAPE;?> </small>
			</div>

		</div>
		<script src="/js/jquery.js"></script>
		<script src="/js/bootstrap.js"></script>
		<script src="/js/jasny-bootstrap.js"></script>
		<script src="/js/funcaobase.js"></script>
		<script type="text/javascript">

	/* */
	﻿$(document).ready(function()
{


  /* Quando algum hyperlink com a classe "window" for clicado */
  $('a.window').click(function()
  {
    var dimensions = (this.rel) 
      ? this.rel
      : '660x600';
    dimensions = dimensions.split('x');
    var width = dimensions[0];
    var height = dimensions[1];
    var bWindow = window.open(this.href, this.id, 'width=' + width + ',height=' + height + ',left=' + (((screen.width - width) / 2) - 20) + ',top=' + (((screen.height - height) / 2) - 20) + ',scrollbars=yes,resizable=yes,toolbars=no');
    bWindow.focus();
    return false; 
  });


  function pf() {
		$("#cpf_cnpj").mask("999.999.999-99");

  }


  /* $("#pessoaPf").click(function(){

	         $("#cpf_cnpj").attr("data-mask", "999.999.999-99");
	         $("#pis_pasep").prop( "disabled", false);
	         $("#cpf_cnpj").prop("disabled", false); 
  }); 
	         
  $("#pessoaPj").click(function(){
	  	         
	         $("#cpf_cnpj").attr("data-mask", "99.999.999/9999-99");
	         $("#pis_pasep").val("0.000.000.000-0");
	         $("#pis_pasep").prop( "disabled", true );
	         $("#cpf_cnpj").prop("disabled", false);  


  });*/
  
 /* mudança de pessoa fisica */
 /*$("#nome").focus(function()
 {
     
     var pessoa = $("input[name=pessoa]:checked").val();

     
     if(pessoa == "pf") {
         
         //alert("pessoa Fisica");
         $("#cpf_cnpj").attr("data-mask", "999.999.999-99");
         $("#pis_pasep").prop( "disabled", false);
         $("#cpf_cnpj").prop("disabled", false);  
         
     }else {
         
         //alert("pessoa Juridica")
         $("#cpf_cnpj").attr("data-mask", "99.999.999/9999-99");
         $("#pis_pasep").val("0.000.000.000-0");
         $("#pis_pasep").prop( "disabled", true );
         $("#cpf_cnpj").prop("disabled", false);  

     }

 });  */
  
});

</script>

</body>
</html>
