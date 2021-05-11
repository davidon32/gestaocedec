<?php session_start();
      include_once PATH.'/include.php';
$_conexao = new ConexaoMysql();

$_login = new Login();
      
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php TITULO;?></title>
		<link href="css/bootstrap.css" rel="stylesheet" media="screen">
        <link href="css/bootstrap-responsive.css" rel="stylesheet" media="screen">
	</head>
	<body onload="pf()">
	    
	    <!-- TOPO /system/topo.php-->
        <?php include_once(PATH.'/system/topo.php'); ?>
        <div class="container">
        <!-- MENU-->
        <div class="row-fluid">
            <div class="span3">
                <BR>
                <?php include_once PATH."/mod_".$modulo.'/app/elemento/'.$modulo.'.menu.php';?>
            </div>
            
		
		<?php
		
		?>
		<div>
			<br />
			<div class="titulo">
				Cadastro de Motorista
			</div>
			<form id="form1" name="form1" method="post" action="valida.cadastro.pipeiro.php">
				<!-- dados do pipeiro -->
				<fieldset>
					<legend>
						Dados do Motorista
					</legend>
					<p>
						
						
						
						<div align="center">
							Pessoa F&iacute;sica
							<input type="radio" name="pessoa" value="pf" onclick="javascript:pf();" checked="checked" />
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							Pessoa Jur&iacute;dica
							<input type="radio" name="pessoa" value="pj" onclick="javascript:pj();">
							<br />
						</div>
						<br />
						<div class="label">
							Nome/Razão Social
						</div>
						:
						<input name="nome" type="text" id="nome" size="60" onclick="javascript:pf();"/>
						<span title="Preenchimento Obrigatório !" class="asterisco">&nbsp;&nbsp;*&nbsp;&nbsp;</span>
						<br />
						<div class="label">
							CPF/CNPJ
						</div>
						:
						<input type="text" name="cpf_cnpj" id="cpf_cnpj" />
						<span title="Preenchimento Obrigatório !" class="asterisco">&nbsp;&nbsp;*&nbsp;&nbsp;</span>
						<br />
						<div class="label">
							Endereço
						</div>
						:
						<input name="endereco" type="text" id="endereco" size="60" />
						<span title="Preenchimento Obrigatório !" class="asterisco">&nbsp;&nbsp;*&nbsp;&nbsp;</span>
						<br />
						<div class="label">
							Bairro
						</div>
						:
						<input name="bairro" type="text" id="bairro" size="40" />
						<span title="Preenchimento Obrigatório !" class="asterisco">&nbsp;&nbsp;*&nbsp;&nbsp;</span>
						<br />
						<div class="label">
							Cidade
						</div>
						:
						<input name="cidade" type="text" id="cidade" size="40" />
						<span title="Preenchimento Obrigatório !" class="asterisco">&nbsp;&nbsp;*&nbsp;&nbsp;</span>
						<br />
						<div class="label">
							e-mail
						</div>
						:
						<input name="email" type="text" id="email" size="40" />
						<br />
						<div class="label">
							Cep
						</div>
						:
						<input type="text" name="cep" id="cep" class="cep" />
						<br />
						<div class="label">
							UF
						</div>
						:
						<input type="text" name="uf" id="uf" value="MG" />
						<br />
						<div class="label">
							Telefone
						</div>
						:
						<input type="text" name="tel" id="tel" class="mask-fone" />
						<br />
						<div class="label">
							Celular
						</div>
						:
						<input type="text" name="cel" id="cel" class="mask-fone" />
						<br />
						<div class="label">
							RG
						</div>
						:
						<input type="text" name="rg" id="rg" />
						<br />
						<div class="label">
							Órgão Expedidor
						</div>
						:
						<input type="text" name="orgao" id="orgao" />
						<br />
						<div class="label">
							Inscr. Estadual
						</div>
						:
						<input type="text" name="inscr_est" id="inscr_est" />
						<br />
						<div class="label">
							PIS/PASEP
						</div>
						:
						<input type="text" name="pis_pasep" id="pis_pasep" />
						<br />
						<div class="label">
							Nº CNH
						</div>
						:
						<input type="text" name="cnh" id="cnh" />
						<br />
						<div class="label">
							Inscr. INSS
						</div>
						:
						<input type="text" name="inss" id="inss" />
						<br />
						<div class="label">
							Inscr. Municipal
						</div>
						:
						<input type="text" name="inscr_mun" id="inscr_mun" />
						<br />
						<div class="label">
							NIT
						</div>
						:
						<input type="text" name="nit" id="nit" />
						<br />
						<div class="label">
							Pai
						</div>
						:
						<input type="text" name="pai" id="pai" />
						<br />
						<div class="label">
							Mãe
						</div>
						:
						<input type="text" name="mae" id="mae" />
						<br />
						<div class="label">
							Placa
						</div>
						:
						<input type="text" name="placa" id="placa" />
						<br />
						
						<br />
 
				 
						
					<!--<fieldset class="repre">
							<legend>Representante da Empresa</legend>
								<!--<div class="label">Nome</div>:-->
								<input type="hidden" name="nome_rep" id="nome_rep" value="-"/>
								<!--<br />-->
								<!--<div class="label">CPF</div>:-->
								<input type="hidden" name="cpf_rep" id="cpf_rep" class="cpf" value="0"/>
								<!--<br />-->
								<!--<div class="label">RG</div>:-->
								<input type="hidden" name="rg_rep" id="rg_rep" value="0"/>
								<!--<br />-->
								<!--<div class="label">Órgão Emissor</div>:-->
								<input type="hidden" name="orgao_rep" id="orgao_rep" value="-"/>
								<!--<br />-->
								<!--<div class="label">Est. Civil</div>:-->
								<input type="hidden" name="est_civil_rep" id="est_civil_rep" value="-"/>
								<!--<select name="est_civil_rep" id="est_civil_rep">
										<option>-</option>
										<option>Solteiro</option>
										<option>Casado</option>
										<option>Divorciado</option>
										<option>Desquitado</option>
										<option>Viúvo</option>
										<option>Separado</option>
									</select>-->
								<br />
								<div class="label">Naturalidade</div>:
								<input type="text" name="natural_rep" id="natural_rep" />
								<br />
					<!--</fieldset>-->
						
						
						
						
				</fieldset>
				<br />
				<fieldset>
					<legend>
						Domicílio Bancáro
					</legend>
					<div class="label">
						Banco do Brasil
					</div>
					:
					<input type="text" name="banco" id="banco" value="001"/>
					<br />
					<div class="label">
						Agencia:
					</div>
					:
					<input type="text" name="agencia" id="agencia" />
					<br />
					<!-- <div class="label">Nº da Conta</div>:-->
					<input type="hidden" name="conta" id="conta" value="-" />
					
					<!-- <div class="label">Tipo da Conta</div>:-->
					<input type="hidden" name="tipo" id="tipo" value="-" />
					
					<div class="label">
						Município:
					</div>
					:
					<input type="text" name="mbanco" id="mbanco" />
					<br />
					<div class="label">
						Placa:
					</div>
					:
					<input type="text" name="placa" id="placa" />
					<br />
					
				</fieldset>
				<fieldset style="text-align:center;">
					<div class="confirma_click">
						<input type="submit" id="cadastrar" name="cadastrar" value="Cadastrar" onclick="return confirm('Deseja Confirmar o cadastro !');">
					</div>
				</fieldset>
			</form>
		</div>
		<div class="rodape">
			<?php include_once 'rodape.php';
			?>
		</div>
		
	</body>
	<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
        <script type="text/javascript" src="/js/jquery.maskedinput-1.3.min.js"></script>
        <script type="text/javascript" src="/js/mascara.js"></script>
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
</html>