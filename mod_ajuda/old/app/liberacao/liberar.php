<?php $id_session = session_id();
    if(empty($id_session)) session_start();
	print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
	include_once PATH.'/include.php';

	//$_conexao = new ConexaoMysql();

	$_login = new Login();

	$_login->logado();
	
	$_login->Sessao();

	$saldo = new ControleSaldo();

	$_municipio = new Municipio();
	
	# verifica se tem algum produto com vencimento de data limite
	//$saldo->DevolvePedido();
	//FuncaoBase::vd($_SESSION);
		
	/* ****************************************************************************************
	*  	Orgão Gestor : Coordenadoria Estadual de Defesa Civil do Estado de Minas Gerais
	*	Sistema      : Sistema de Gest�o de Ajuda Humanit�ria
	*	
	*	Autor        :  Demetrio Silva Passos
	*	Fun��o   : Tela de Executar Libera��o de Materiais
	*
	*******************************************************************************************/
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php echo TITULO;?></title>
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
				    <?php include_once PATH."/mod_".$modulo.'/app/elemento/'.$modulo.'.menu.php';?>    
                </div>
			
					<form method="POST" action="index.php?modulo=ajuda&secao=liberacao&acao=fechar_liberacao" name="flibera" />
						
						<!-- CORPO -->
						<div class="span5">
							<legend>Liberação de Materiais</legend>
							<label>Munic&iacute;pio </label>
							<div class="campo"><?php $_municipio->PegaMunicipio();?></div>
							<label>Benefici&aacute;rio:</label>
							<input type="text" class="campo" name="beneficiario" id="beneficiario" size="39" title="Nome do Benefici&aacute;rio ex. Prefeitura"/>
							<label>Fonte de Origem<br/></label>
							<select name="fonte" id="fonte">
							<option></option>
							<option>CEDEC</option>
							<option>Conab</option>
							<option>Ministério da Integração</option>
							<option>Servas</option>
							<option>Outros</option>
							</select>
												 
							<label>Evento</label>
							<select name="evento" id="evento">
							<option></option>
							<option>Chuva</option>
							<option>Seca</option>
							<option>Frio</option>
							<option>Outros</option>
							</select>
											
							<label>Data</label>
							<input type="text" name="dt_libera" size="15" class="mask-data" value="<?php print date('d/m/Y');?>"  />
							
							<label title="Observações gerais">Observação:</label>
							<textarea class="span12" name="obs" id="obs" rows="10">-</textarea>
							
							<label><input type="checkbox" name="entrega" title="Modo de entrega" checked="checked"/>
								Vir&aacute; Buscar</label>
							
							<label>Responsável pela Liberação</label>
							
							<?php 

							$_login = new Login();

							$dados = $_login->getFuncionario();

							print "<select name=\"responsavel\">";

                                print "<option value=''></<option>";
                            
							
							for ($i=0; $i < count($dados); $i++) { 
							
								print "<option value=".$dados[$i]['id_funcionario'].">".utf8_encode($dados[$i]['nome'])." ".$dados[$i]['posto']."</<option>";
							}
								
								print "</select>";


							?>
						</div>
						
						<div class="span3">
							<legend>Dados do Material</legend>
							<!-- Adicionar Materiais na Liberacao -->
							<a href="index.php?modulo=ajuda&secao=liberacao&acao=add_material" class="btn window" rel="1024x600" title="Adicionar Materiais no Pedido">Adicionar Material</a>
							<br /><br />
							<!-- Visualizar o Pedido com materiais Adicionados ou remover-los -->
							<a href="index.php?modulo=ajuda&secao=liberacao&acao=item_visualizar" class="btn window" rel="1024x600" title="Visualizar Materiais que estao no Pedido">Visualizar Itens no Pedido</a>
							<br /><br />
					           <legend> Cancelar de Libera&ccedil;&atilde;o</legend>
							<a class="btn btn-primary" href="index.php?modulo=ajuda&secao=liberacao&acao=cancelar" title="Cancelar / Alterar Liberacao">Cancelar</a>
						</div>
			</div>
			<div class="row-fluid">			
				<div class="span3"></div>
						
				<div class="span8 text-center">
					<input class="btn btn-primary" type="submit" value="Concluir" name="send" onClick="return confirm('Completar Liberacao ?');" title="Fechar Pedido" />
				</div>

					</form>
			</div>

		</div>

			<div class="span12 text-center">
				<small><?php print RODAPE;?></small>
			</div>			
		</div>
		<script src="/js/jquery.js"></script>
		<script src="/js/bootstrap.js"></script>
		<script src="/js/jasny-bootstrap.js"></script>
		<script type="text/javascript">
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
				});
		</script>
	</body>
</html>