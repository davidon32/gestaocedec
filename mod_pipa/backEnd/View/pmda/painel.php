<?php if(!isset($_SESSION)){
	session_start();
} 
print "<!DOCTYPE html>";
	include_once PATH.'/core/include.php';
/**
 * Pesqui de pipeiro para realizar o acerto de contas
 * 01/03/2011
 * @author Demetrio Silva Passos
 * 
 */

?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php";?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php";?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";?>
 <div class="container">
     <!-- MENU-->
		<div class="row-fluid">
			<div class="span2">
			    <BR>
				<?php include_once PATH."/mod_".$modulo.'/app/elemento/'.$modulo.'.menu.php';?>
			</div>
				<div class="row-fluid">
					<div class="span10 fdo_corpo">
						<!-- INICIO DO CORPO-->
		
						<div class="span12">		
    						<br>
    						<i class="fa fa"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="?modulo=pipa&secao=pmda&acao=usuario" class="btn">Cadastrar / Alterar Usuários(Compdec)</a>
    						<br><br>
    						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp
    						<a href="?modulo=pipa&secao=pmda&acao=pesquisaPmda" class="btn">PMDA</a>
    						<br><br>
    						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp
    						<a href="?modulo=pipa&secao=comunidade&acao=pmdacom" class="btn">Comunidade</a>
    						<?php
    						
    							$pmda = new Pmda();
    						
    							// icone aviso pre cadastro comunidade
    							
    							$alertaPreCadCom = ($pmda->buscaPreCadComun() > 1) ? $pmda->buscaPreCadComun() :"";
    							$listCom = "";
    							foreach ($alertaPreCadCom as $value) {
    								$listCom .= "* ".$value['nome']."\n";
    							}
    							
    							print (count($alertaPreCadCom) > 0) ? "<img src='core/imagem\aviso.png' width='30px;' title='Existem Solicitações de Ativação de Comunidades !\nMunicipios:\n\n{$listCom}'>" :""; 
    						?>
    						<br><br>
    						<!-- <li><a href="#">Alterações (LOG)</a></li>
    						<br>
    						<li><a href="#">Relatórios</a></li> -->
    						<br>
    						<br>
						</div>
						
						<div class="span6 pull-left">
							<table class="table table-bordered table-fonte-peq">
								<tr>
									<th colspan="4" style="text-align: center;">PMDA em Análise</th>
								</tr>
								<tr>
									<td>Protocolo</td>
									<td>Municipio</td>
									<td>Data Criação</td>
									<td>Opção</td>
								</tr>
								<?php 
								
									
									$list = $pmda->listaPmdaAnalise();
								
									foreach ($list as $value) {
										
										$protocolo = $value['id_pmda'].str_replace("-", "", substr($value['data'], 0, 10));
										
										print "<tr><td>".$protocolo."</td>";
										print "<td>".$value['nome']."</td>";
										print "<td>".DataMysql::extraiData($value['data'])."</td>";
										print "<td><a href='?modulo=pipa&secao=pmda&acao=index&param=".$value['id_pmda']."&a=9978&p=".$protocolo."&mun=".$value['id_municipio']."'><img width='30px;' src='imagem/editar.png' title='Editar PMDA'></a></td></tr>";
									}
								
								?>
							
							</table>
						</div>
						<div class="span5 pull-right">
							<table class="table table-bordered table-fonte-peq">
								<tr>
									<th colspan="4" style="text-align: center;">Histórico de alterações do PMDA</th>
								</tr>
								<tr>
									<td>Protocolo</td>
									<td>Municipio</td>
									<td>Data Evento</td>
									<td>Alterações</td>
									<td>Opção</td>
								</tr>
								<?php 
									
									$list = $pmda->listaPmdaAlteracao();
								
									foreach ($list as $value) {
										
										$destaque = ($value['pedido_altera'] == 'SIM') ? "style='color:red;' title='Pedido de Alteração de PMDA'":"" ;
										
										$protocolo = $value['id_pmda'].str_replace("-", "", substr($value['data'], 0, 10));
										
										print "<tr>
												<td ".$destaque.">".$protocolo."</td>";
										print "<td ".$destaque.">".$value['nome']."</td>";
										print "<td ".$destaque.">".$value['data']."</td>";
										print "<td ".$destaque.">";
											
										print $pmda->buscaAlteracaoPmda($value['id_pmda']);
										
										print "</td>";
										
										print "<td ".$destaque."><a href='?modulo=pipa&secao=pmda&acao=index&param=".$value['id_pmda']."&a=9978&p=".$protocolo."&mun=".$value['id_municipio']."'><img width='30px;' src='imagem/notas.png' title='Visualizar Alterações'></a></td></tr>";
									}
								
								?>
							
							</table>
						</div>
						
						

					</div>
				</div>
		</div>
	</div>
	
	<div class="row-fluid text-center">
	    <br><br><br>
		<x-small><?php print RODAPE;?></x-small>
	</div>
	<script src="../js/jasny-bootstrap.js"></script>
	<script src="../js/funcAdm.js"></script>
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>
