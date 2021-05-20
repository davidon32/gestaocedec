<?php include_once PATH.'/core/include.php';?>
<?php include_once 'core/Model/indexModel.php';?>
<?php include_once "mod_compdec/Model/Model.php";?>
	<!-- =============== HEADER HTML PAGE ================= -->
	<?php include_once "template/page/headerPage.php";?>
	<!-- =================== HEADER ============================ -->
	<?php include_once "template/page/header.php";?>
	<!-- =================== MENU  ============================ -->
	<?php include_once "template/page/menu.php";?>
	<!-- =================== CORPO  ============================ -->
	<?php include_once "template/page/corpoHeader.php";?>
<?php

$_login = new Login();

$_funcaoBase = new FuncaoBase();

$_municipio = new Municipio();

$_compdec = new Compdec();

$_regiao = new Regiao();

$_associacao = new Associacao();

$_territorio = new Territorio();

	$municipios = $_municipio->dadosSelectMunicipio();

?>
		<form action="index.php?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=compdec&controller=compdec&action=buscarAlterar" method="POST" accept-charset="utf-8">

				<label>Município</label>
				<input type="text" name="txtMunicipio" id="txtMunicipio">
				<input type="hidden" name="txtIdMunicipio" id="txtIdMunicipio">
	 
			 	<br />
				 	<input class="btn btn-primary" type="submit" name="btn_enviar" id="btn_enviar" value="Buscar">
				</form>
				<br>
				<?php

			$_btn_enviar = isset($_POST['btn_enviar']) ? $_POST['btn_enviar'] : ""; 
			
			$_id_municipio = isset($_POST['txtIdMunicipio']) ? $_POST['txtIdMunicipio'] : ""; 

				$permissao = $_login->verificaPermissao("alt_comdec", "com_permissao", $pageSession['session']['seguranca']['login']);

			if($_btn_enviar && !empty($_id_municipio)){
            
				 $_dados = $_compdec->buscaCompdec($_id_municipio);
                              
				$alteracao = ($permissao == '1') ? "<a href='index.php?token=".hash('sha256', md5(VERSAO)."-".time())."&ac=itn&modulo=compdec&controller=compdec&action=alterarCompdec&mun=".$_dados[0]['id_municipio']."'><img src='/core/imagem/editar.png' title='Alterar Informações'></a>" :
					 "<a href='index.php?token=".hash('sha256', md5(VERSAO)."-".time())."&ac=itn&modulo=compdec&controller=compdec&action=visualizar&mun=".$_dados[0]['id_municipio']."'><img src='/core/imagem/view.png' title='Visualizar Informações'></a>";
	
                $_territorio_desenv = $_territorio->pegaNomeTerritorio($_dados[0]['id_territorio']);
                               
				print "<table class=\"table table-bordered\">
						<tr>
							<th width=''>Município</th>
							<th width=''>Sit.Usuario</th>
							<th width=''>Possui Compdec</th>
							<th width=''>Cadastro COMPDEC</th>
							<th width='' title='Acesso ao Módulo PMDA'>Módulo PMDA</th>
							<th width='' title='Acesso ao Módulo Ajuda Humanitária'>Módulo Ajuda Humanitária</th>
							<th width='' title='Plano Contingencia'>Plano de Contingëncia</th>
						</tr>
						<tr>
							
							<td>
								<input type='hidden' value='".$_dados[0]['id_municipio']."' name='txtId_municipio' id='txtId_municipio'>";
								print $_municipio->PegaNomeMunicipio($_dados[0]['id_municipio']);
					print "</td>
							<td>".$_dados[0]['situacao']."</td>";
					print "<td>";
					
								$opcao = array(array(isset($_dados[0]['com_const']) ? $_dados[0]['com_const'] : '0', ($_dados[0]['com_const']=='1') ? 'Sim': 'Nao'));
								$simnao = array(array('1','Sim'), array('0','Nao')); 
								print Html::inputSelect("compdec", "compdec", null, Config::$SIMNAO, $opcao, "class='pull-left'");
					print "</td>
							<td>".$alteracao."</td>
							<td><input type='checkbox' name='ck_PMDA' id='ck_PMDA'></td>
							<td><input type='checkbox' name='ck_Ajuda' id='ck_Ajuda'></td>
							<td><a href='?modulo=compdec&controller=compdec&action=plano&id=".$_dados[0]['id_municipio']."'>Visualizar</a></td>

						</tr>
						<tr>
							<td colspan='7'>
								<table class='table'>
									<tr>
										<th>
											Telefone Compdec
										</th>
										<th>
											Telefone Outros Agentes
										</th>
										<th>
											Email Compdec
										</th>
										<th>
											Telefone Prefeitura
										</th>
										<th>
											Email Prefeitura
										</th>
									</tr>
									<tr>
										<td></td>
										<td></td>
										<td></td>
										<td>".$_dados[0]['fone_com1']."<br>".$_dados[0]['fone_com2']."</td>
										<td>".$_dados[0]['email']."</td>
									</tr>
								</table>

							</td>
							
						</tr>
						</table>";

			}
			
			?>	
			<div class='col-md-12 text-center'>
			<a class="btn btn-success" href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=compdec&controller=compdec&action=index">Voltar</a><br> <br> 
			</div>

<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>	
	<script type="text/javascript">
		var itens = {
				data: 
						<?php print json_encode($municipios);?>, // array com os dados
					
					getValue: "nome",
	
						list: {
							maxNumberOfElements: 15,
						match: {
							
							enabled: true
						},
		
							onSelectItemEvent: function() {
								var value = $("#txtMunicipio").getSelectedItemData().id_municipio;
		
								$("#txtIdMunicipio").val(value);
								//$("#txtIdComunidadeSearch").val(value).trigger("change");
		
							}
	
					}
	
			};
		
		$("#txtMunicipio").easyAutocomplete(itens);

		$("#selCompdec").change(function(){

					var dados = {
						"btnEnviar": "gravar",
						"status" : $("#selCompdec").val(),
						"id_municipio" : $("#txtId_municipio").val(),
					};

			$.ajax({
				url : 'mod_compdec/backEnd/View/compdec/status.php',
			    type : 'POST',
			    data : dados,
			    success : function(response) {
					console.log(response);
				    if(response == true){
				    	//console.log(dados);	
						alert("Procedimento realizado com Sucesso !");
				    }
			    }
			});

		});


		$("#ck_PMDA").click(function(){

			if($("#ck_PMDA").is(':checked')){
						var dados = {
								
						"id_municipio" : $("#txtId_municipio").val(),
					};
		
			$.ajax({
				url : 'mod_compdec/backEnd/View/compdec/status.php',
			    type : 'POST',
			    data : dados,
			    success : function(response) {
					console.log(response);
				    if(response == true){
				    	//console.log(dados);	
						alert("Procedimento realizado com Sucesso !");
				 	}
			    }
			});

			};

		});

	</script>