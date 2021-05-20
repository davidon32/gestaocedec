<?php include_once PATH.'/core/include.php';?>
<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_ajuda/Model/indexModel.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php";?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php";?>
<!-- =================== MENU  ============================ -->
<?php include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";?>
<?php
	$saldo = new ControleSaldo();

	$_municipio = new Municipio();
	
	# verifica se tem algum produto com vencimento de data limite
	//$saldo->DevolvePedido();
		
	/* ****************************************************************************************
	*  	Orgão Gestor : Coordenadoria Estadual de Defesa Civil do Estado de Minas Gerais
	*	Sistema      : Sistema de Gest�o de Ajuda Humanit�ria
	*	
	*	Autor        :  Demetrio Silva Passos
	*	Fun��o   : Tela de Executar Libera��o de Materiais
	*
	*******************************************************************************************/
?>

<div class="col-md-6">
	<div class="col-md-12">
		<p style="text-align:center"><legend>Lista de Materiais a Liberar</legend></p>
				
		<!-- Adicionar Materiais na Liberacao -->
		<div class="col-md-12 text-center">
			<a href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=ajuda&controller=conestoque&action=add_material" class="btn btn-info" rel="1024x600" title="Adicionar Materiais no Pedido">Adicionar Material</a>
			<br /><br />
		
			<?php
				if(isset($_SESSION['cesta']) && (!empty($_SESSION['cesta']))){
					print Pedido::MostraPedido($_SESSION['cesta']);
				}else {
					print "<span class=\"alert alert-danger\">Não foi Adicionado Material para Liberaração</span>";
				}
				?>
		</div>
		</div>	
</div>


	<div class="col-md-6">
		<form method="POST" action="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=ajuda&controller=conestoque&action=fechar_liberacao" name="flibera" style="background: #F2F2F2;"/>

			<legend>Liberação de Materiais</legend>
								
			<div class="col-md-12">
				<label>Munic&iacute;pio Destino</label>
				<?php $_municipio->PegaMunicipio();?>
			</div>
								
			<div class="col-md-6">
				<label>Benefici&aacute;rio:</label>
				<input type="text" class="form-control" name="beneficiario" id="beneficiario" maxlength="50" title="Nome do Benefici&aacute;rio ex. Prefeitura" required />
			</div>

			<div class="col-md-6">
				<label>Fonte de Origem<br/></label>
				<select name="fonte" id="fonte" class="form-control" required>
				<option value="">Selecione a Origem</option>
						<?php
							print Material::Fonte();
						?>
				</select>
			</div>
					
			<div class="col-md-6">
				<label>Evento</label>
				<select name="evento" id="evento" class="form-control" required>
				<option value="">Selecione o Evento</option>
					<?php
						print Material::Evento();
					?>
				</select>
			</div>

			<div class="col-md-12">
				<label>Responsável pela Liberação</label>
								
				<?php 

				$_login = new Login();

								$dados = $_login->getFuncionario();

								print "<select name=\"responsavel\" id=\"responsavel\" class=\"form-control\" required>";
									print "<option value=''></<option>";
								for ($i=0; $i < count($dados); $i++) { 
									print "<option value=".$dados[$i]['id_funcionario'].">".utf8_encode($dados[$i]['nome'])." ".$dados[$i]['posto']."</<option>";
								}
									print "</select>";
								?>
						</div>
								
			<div class="col-md-6">	
				<label>Data</label>
				<input type="text" name="dt_libera" id="dt_libera" size="15" class="mask-data form-control" value="<?php print date('d/m/Y');?>"  />
			</div>
				
			<div class="col-md-12">
				<label title="Observações gerais">Observação:</label>
				<textarea class="col-md-5 form-control" name="obs" id="obs" rows="6">-</textarea>
			</div>
				
			<div class="col-md-6">
				<br>
				<label>Vir&aacute; Buscar</label>
				<input type="checkbox" name="entrega" title="Modo de entrega" checked="checked"/>
			</div>

		<div class="col-md-12 text-center">
			<input class="btn btn-info" type="submit" value="Gravar Liberação" name="send" title="Fechar Pedido" />
		</div>

		
	</form>
</div>
<div class="col-md-12 text-center">
	<br>
		<a class="btn btn-success" href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=ajuda&controller=conestoque&action=idxliberacao">Voltar</a>
</div>
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>
		<script type="text/javascript">
			$(document).ready(function(){

				
				$("#dt_libera").datepicker({ dateFormat: 'dd/mm/yy' });

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
			});
		</script>
