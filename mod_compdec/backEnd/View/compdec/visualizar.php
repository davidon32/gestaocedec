<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_compdec/Model/Model.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php";?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php";?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";?>

<?php

$_funcaoBase = new FuncaoBase ();
$_municipio = new Municipio ();
$_associacao = new Associacao ();
$_regiao = new Regiao ();
$_territorio = new Territorio ();
$_compdec = new Compdec ();

$acessoEx = isset ( $pageSession['session']['seguranca']['externo']) ? $pageSession['session']['seguranca']['externo'] : "";

$_dados = array();

$_id = isset($_GET['mun']) ? (int)$_GET['mun'] :"";

// acesso externo 
if (isset ( $pageSession['session']['seguranca']['externo'])) {
	
	$_loginEx = new LoginExterno ();
	
	$id_municipio = $pageSession['session']['seguranca']['id_municipio'];
	
	$_dados = $_compdec->buscaCompdec ( $id_municipio );
	
	$_op = "index.php?modulo=compdec&secao=compdec&acao=valida&id=" . $id_municipio;
	
} else if(isset ( $_COOKIE ['seguranca'] ['adm'] )){
	
	$_login = new Login ();

	if (is_int ( $_id )) {
		
		$_dados = $_compdec->buscaCompdec ( $_id );
		
		$leitura = ($_dados[0]['com_const'] == 0) ? "disabled = 'disabled'" : "";
			
		$_op = "index.php?modulo=compdec&controller=compdec&action=valida&id=" . $_id;
		$coordCompdec = "";

	} else {
		
		$_id = "";
		$_op = "index.php?modulo=compdec&controller=compdec&action=valida";
	}
}else {
	
}

$voltar = "<a class='btn' href='javascript:history.back();'>Voltar</a>";


$dadosMunicipio = $_municipio->dadosMunicipio($_dados[0]['id_municipio']);
?>
	<h4>
	<p style="text-align: center"><?php print $_municipio->PegaNomeMunicipio($_dados[0]['id_municipio']);?></p></h4>

	<?=($_dados[0]['com_ativa'] == 0) ? "<div class='alert alert-danger'>ESTE COMPDEC ESTÁ COM A SITUAÇÃO DE <b>'INATIVO' </b> NA GUIA DADOS GERAIS opção \"Situação do COMPDEC \". <BR>  FAVOR VERIFICAR ANTES DE ALTERAR OS DADOS </div>" : "";?>

<p><a class="btn btn-success" href="<?= FuncaoBase::geraLink('compdec', 'compdec', 'buscarAlterar')?>">Voltar</a></p>

	<!-- DADOS GERAIS -->
	<div class="col-md-12">
		<legend>Dados Gerais</legend>

		<table class="table table-bordered">
				<tr>
					<td width="20%">
						&nbsp;&nbsp;<img class="img-circle" src="/core/imagem/prefeito/<?=AnexoPref::Foto($_dados[0]['id_municipio']);?>" width="115px;"><br><br>
						&nbsp;&nbsp;
						<a class="btn" onClick="uploadModal('prefeito')" title="Anexar Foto Prefeito" id="btnAlterarFotoPrefeito" name="btnAlterarFotoPrefeito">Alterar</a>
					</td>
					<td>
						<b>Prefeito:&nbsp;&nbsp;</b><?=$dadosMunicipio['prefeito'];?><br>
						<b>Endereço:&nbsp;&nbsp;</b><?=$dadosMunicipio['endereco'];?><br>
						<b>Bairro:&nbsp;&nbsp;</b><?=$dadosMunicipio['bairro'];?><br>
						<b>Cep:&nbsp;&nbsp;</b><?=$dadosMunicipio['cep'];?><br>
					</td>					
				</tr>
				</table>

					<label>Nome Município :</label>
						<span class="form-control"><?php print $_municipio->PegaNomeMunicipio($_dados[0]['id_municipio']);?></span>
						<br />
						

					<div class="row">
						<div class="col-md-3">
							<label>Possui Compdec :</label>
							<span class='form-control'>
							<?=($_dados[0]['com_const'] == '1' ? 'Sim' : 'Não');
							?></span>
						</div>
						<div class="col-md-6">
							<!--possui efetivo -->
							<label>Possui Efetivo ? <span> Caso exista somente o Coordenador responda "sim"</span></label>
							<span class="form-control"><?=($_dados[0]['efetivo'] == 0) ? "Sim" : "Não";?></span>
						</div>
						<div class="col-md-3">
							<label>Situacao Compdec</label>
							<span class="form-control">
						<?php 
							print ($_dados[0]['com_ativa'] == '1') ? 'Ativo' : 'Inativo';
						?>
						</span>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-4">
							<!--regioes de desenvolvimento do governo estadual -->
							<label>Região Desenvolvimento :</label>
							<span class="form-control">
							<?php $nomTerritorio = $_territorio->pegaNomeTerritorio ( $_dados [0] ['id_territorio'] );
								print $nomTerritorio ['nome'];
								?>
							</span>
							
						</div>
						<div class="col-md-3">
							<!--regioes de planejamento do governo estadual -->
							<label>Região :</label>
							<span class="form-control">
								<?php print $_regiao->PegaNomeRegiao($_dados[0]['regiao'], "");?>
							</span>
						</div>
						<div class="col-md-5">
							<label>Associação</label>
							<span class="form-control">
								<?php print $_associacao->PegaNomeAssociacao($_dados[0]['associacao'], "");?>
							</span>
						</div>
					</div>

						<br>
						<div class="row">				
							<div class="col-md-3">
								<label>Número Lei :</label>
								<span class="form-control">
									<?php print $_dados[0]['num_lei'];?>
								</span>
							</div>
							<div class="col-md-3">
					 			<label>Data Lei:</label>
								<span class="form-control">
								 	<?php print DataMysql::dataVisual($_dados[0]['dt_lei']);?>
								</span>
							</div>

									
							<div class="col-md-3">
								<label>Número Decreto:</label> 
								<span class="form-control">
									<?php print $_dados[0]['num_decreto'];?>
								</span>
							</div>
							<div class="col-md-3">
								<label>Data Decreto :</label>
								<span class="form-control">
									<?php print DataMysql::dataVisual($_dados[0]['dt_decreto']);?>
								</span>
							</div>
						</div>

						<div class="row">				
							<div class="col-md-6">
								<label>Número Portaia:</label>
								<span class="form-control">
									<?php print $_dados[0]['num_portaria'];?>
								</span>
							</div>
							<div class="col-md-6">
								<label>Data Portaria:</label>
								<span class="form-control">
									 <?php print DataMysql::dataVisual($_dados[0]['dt_portaria']);?>
								</span>
							</div>
						</div>
						<div class="row">	

							<div class="col-md-12">
								<label>Endereço :</label>
								<span class="form-control">
									<?php print $_dados[0]['endereco'];?> 
								</span>
							</div>
						</div>
					
						<div class="row">
							<div class="col-md-6">
								<label>Telefone</label>
								<span class="form-control">
									<?php print $_dados[0]['fone_com1'];?>
								</span>
							</div>
							<div class="col-md-6">
								<label>Telefone2</label>
								<span class="form-control">
									<?php print $_dados[0]['fone_com2'];?>
								</span>
							</div>
						</div>

						<div class="row">
							<div class="col-md-4">
								<label>Possui Nupdec ?</label>
								<span class="form-control">
									<?=($_dados[0]['nudec'] == 0) ? "Sim" : "Não";?></option>
								</span>
							</div>
							<div class="col-md-4">	
								<label>Quantos nupdec's ?</label>
								<span class="form-control">
									<?php print $_dados[0]['qtd_nudec'];?>
								</span>
							
							</div>
							<div class="col-md-4">
								<label>Quantos integrantes ?</label>
								<span class="form-control">
									<?php print $_dados[0]['qtd_efetivo'];?>
								</span>
							</div>		
						</div>

						<div class="row">
							<div class="col-md-4">
								<label>Qual a capacitação dos Membros ?</label>
								<span class="form-control"> 
									<?php print $_dados[0]['capacitacao_nupdec']?>
								</span>
							</div>

								<div class="col-md-8">
									<label>Email :</label>
									<span class="form-control">
										<?php print $_dados[0]['email'];?>">
									</span>
								</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<label>Possui Plano de Contingência ?</label>
								<span class="form-control">
									<?php print ($_dados[0]['plano_cont'] == 0) ? 'Não' : 'Sim';?>
								</span>
							</div>
							<div class="col-md-6">
								<div class="col-md-6">
									<label>Possui Capacitação em Proteção e DC ?</label>
									<span class="form-control">
									<?php print ($_dados[0]['capacitacao'] == 0) ? 'Não' : 'Sim';?>
									</span>
								</div>
								<div class="col-md-6">
									<label>Data do Curso :</label>
									<span class="form-control">
									<?php print DataMysql::dataVisual($_dados[0]['dt_curso_capac']);?>
								</span>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-4">
								<label>Possui Cartão de Proteção e Defesa Civil ?</label>
								<span class="form-control">
									<?php print ($_dados[0]['cartao_pdc'] == 0) ? 'Não"' : 'Sim';?> 
								</span>
							</div>
							<div class="col-md-4">
								<label>Realiza Simulados </label>
								<span class="form-control">
								<?php print ($_dados[0]['simulado'] == 0) ? 'Não' : 'Sim';?>
								</span>
							</div>
							<div class="col-md-4">
								<label>Possui mapeamento de área de risco ?</label>
								<span class="form-control">
								<?php print ($_dados[0]['mapeamento'] == 0) ? 'Não' : 'Sim';?> 
								</span>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<label>Possui Sede Propria ?</label><br>
								<span class="form-control">
									<?php print ($_dados[0]['sede_propria'] == 1) ? 'Sim' : 'Não';?>
								</span>
							</div>
							<div class="col-md-4">
								<label>Possui Viatura</label><br>
								<span class="form-control">
									<?php print ($_dados[0]['viatura'] == 1) ? 'Sim' : 'Não';?>
								</span>
							</div>
							<div class="col-md-4">
								<label>Possui Computador ?</label>
								<span class="form-control">
									<?php print ($_dados[0]['computador'] == 1) ? 'Sim' : 'Não';?> 
								</span>		
							</div>
						</div>

						<div class="row">
							
							<div class="col-md-4">
								<div class="col-md-6">
									<label title="Possui Curso de Gestão em Proteção e Defesa Civil e Mudanças Climáticas">Possui Curso GPDCMC</label>
									<span class="form-control">
									<?php print ($_dados[0]['curso_gestao'] == 1) ? 'Sim' : 'Não';?>
									</span>
								</div>
								<div class="col-md-6">
									<label>Data Curso </label>
									<span class="form-control">
									<?php print DataMysql::dataVisual($_dados[0]['dt_curso_gestao'])?>">
									</span>
								</div>
							</div>
							<div class="col-md-4">
								<div class="col-md-6">
								<label>Possui Curso de SCO</label>
									<span class="form-control">
									<?php print ($_dados[0]['curso_sco'] == 1) ? 'Sim' : 'Não';?>
									</span>
								</div>
								<div class="col-md-6">
									<label>Data Curso </label>
									<span class="form-control">
									<?php print DataMysql::dataVisual($_dados[0]['dt_curso_sco']);?>
									</span>
								</div>
							</div>
						</div>


						<div class="row">
							<div class="col-md-4">
								<div class="col-md-6">
									<label>Part. de WorkShop</label>
									<span class="form-control">
									<?php print ($_dados[0]['particip_workshop'] == 1) ? 'Sim' : 'Não';?>
									</span>
								</div>
								<div class="col-md-6">
									<label>Data WorkShopt</label>
										<span class="form-control">
										<?php print DataMysql::dataVisual($_dados[0]['dt_partic_workshop']);?>
										</span>
								</div>
							</div>
							<div class="col-md-4">
								<div class="col-md-6">
									<label>Possui exp. na área</label>								
									<span class="form-control">
									<?php print ($_dados[0]['exp_dc'] == 1) ? 'Sim' : 'Não';?> 
									</span>
								</div>
								<div class="col-md-6">
									<label>Tempo</label>
										<span class="form-control">
										<?php print $_dados[0]['tp_ex_dc'];?>
										</span>
								</div>
							</div>
							<div class="col-md-4">
							</div>
						</div>

						<div class="row">
							<div class="col-md-4">
							</div>
							<div class="col-md-4">
							</div>
							<div class="col-md-4">
							</div>
						</div>
						
			

	</div>
	
	

	<!-- EQUIPES COMPDECS -->
	<div class="col-md-12">
		<br>
		<legend>Equipe Compdec</legend>
		<div class="span11" id="tblMembroEquipe">
			Coordenador Municipal de Proteção e Defesa Civil<br>
			<img class="img-polaroid" src="/core/imagem/compdec/<?=AnexoCompdec::Foto($_dados[0]['id_municipio']);?>" width="115px;">
			<?php 
			
				$compdec = new MembroEqCompdec();
				$membros = $compdec->listaMembro($_dados[0]['id_municipio']);

				foreach ($membros as $value){
					if(($value['funcao'] == 'Coordenador') || ($value['funcao'] == 'COORDENADOR')){
						print $value['nome'];
					}
				}
						
				print '<h4><p style="text-align:center;">EQUIPE COMPDEC</p></h4>';
				$pageSession['session']['seguranca']['id_municipio'] = $_dados [0] ['id_municipio'];

				include_once PATH . '/mod_pipa/backEnd/View/pmda/membroEquipe.php';
			?>
									 		
	</div>

	<!-- ANEXOS DOCUMENTOS -->
	<div class="col-md-12">
		<legend>Anexos Documentos</legend>
		<h4><p style="text-align:center;">LEIS E DECRETOS</p></h4>
			<table class="table table-bordered table-striped table-condensed tbl">
				<tr>
					<td><?=($_dados[0]['sem_decreto']) == "1" ? "Não possui Decreto" : "-";?></td>
					<td><?=($_dados[0]['sem_portaria']) == "1" ? "Não possui Portaria" : "";?></td>
				</tr>
			</table>
			<?php include_once PATH . '/mod_compdec/backEnd/View/compdec/anexo.php';?>
				
	</div>

				
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>
	<script type="text/javascript">


	function anexoView(url){
		window.location.href = url;
	}

	</script>