<?php include_once "core/Model/indexModel.php"?>
<?php include_once "mod_pipa/Model/IndexModel.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php";?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php";?>
<!-- =================== MENU  ============================ -->
<?php include_once "template/page/menuExterno.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";?>

    <?php
        $pmda = new Pmda();
        // icone aviso pre cadastro comunidade
        $alertaPreCadCom = $pmda->buscaPreCadComun();
        $listCom = "";
        foreach ($alertaPreCadCom as $value) {
            $listCom .= "* ".$value['nome']."\n";
        }
    ?>

            <a class="btn btn-primary" href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=&modulo=pipa&controller=pipa&action=usuario">Cadastro Usuario Externo</a><br> <br>  
            <a class="btn btn-primary" href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=&modulo=pipa&controller=pipa&action=pesquisaPmda&a=adm">Administração PMDA</a><br><br>   
            <a class="btn btn-primary" href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=&modulo=pipa&controller=pipa&action=pmdaCom&a=adm">Validação Comunidade   
                      <?=(count($alertaPreCadCom) > 0) ? "<img src='core/imagem/aviso.png' width='30px;' title='Existem Solicitações de Ativação de Comunidades !\nMunicipios:\n\n{$listCom}'>" :""; ?>
            </a>
            <br>
            <br>


            <div class="span6 pull-left">
							<table class="table table-bordered table-striped">
								<tr>
									<th colspan="5" style="text-align: center;">PMDA em Análise</th>
								</tr>
								<tr>
									<td>#</td>
									<td>Protocolo</td>
									<td>Municipio</td>
									<td>Data Criação</td>
									<td>Envio p/ Análise</td>
									<td>Data Última Alteração</td>
									<td>Opção</td>
								</tr>
								<?php 
								
									
									$list = $pmda->listaPmdaAnalise();
								
									foreach ($list as $key => $value) {
										
										$protocolo = $value['id_pmda'].str_replace("-", "", substr($value['data'], 0, 10));
										
										print "<tr><td>".($key+1)."</td>";
										print "<td>".$protocolo."</td>";
										print "<td>".$value['nome']."</td>";
										print "<td>".DataMysql::extraiData($value['data'])."</td>";
										print "<td>".DataMysql::dataCompletaVisual($value['dt_analise'])."</td>";
										print "<td>".DataMysql::dataCompletaVisual($value['dt_ultima_alteracao'])."</td>";
										print "<td><a href='?modulo=pipa&controller=pipa&action=pmda&param=".$value['id_pmda']."&a=9978&p=".$protocolo."&mun=".$value['id_municipio']."'><img width='30px;' src='core/imagem/editar.png' title='Editar PMDA'></a></td></tr>";
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
										
										print "<td ".$destaque."><a href='?modulo=pipa&controller=pmda&action=index&param=".$value['id_pmda']."&a=9978&p=".$protocolo."&mun=".$value['id_municipio']."'><img width='30px;' src='core/imagem/notas.png' title='Visualizar Alterações'></a></td></tr>";
									}
								
								?>
							
							</table>
						</div>                                     
                    

<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>