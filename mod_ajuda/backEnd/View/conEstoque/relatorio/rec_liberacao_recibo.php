<?php include_once PATH.'/core/include.php';?>
<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_ajuda/Model/indexModel.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPageSimples.php";?>
<style type="text/css">

	@media print {
  		.imprimir {
  			display: none;
		}
	}
	
	*{
		font-family: Tahoma, Geneva, sans-serif;
		font-size: 13px;
		color:#666666;
		vertical-align:text-top;
	}

	body {
		margin: auto;
	}

	table {
		border-collapse: collapse;
	}

	.cabecalho {
		background:#CCCCCC;
		text-align:center;	
	}

	.rodape {
		font-size: 10px;
		text-align: center;
	}

	#bg img { 
        height:100%; 
        opacity:.5; 
        z-index: -1;
        position: absolute;
        margin-left: 10%;
        width: 300px;
        height: 300px;         
	}
</style>
    
<?php 

	$_libera = new Liberacao();
		
	$deposito = new Deposito();
				
	$municipio = new Municipio();
                              
	$idLiberacao = isset($_GET['id']) ? $_GET['id'] : "";
	
	if((is_numeric($idLiberacao)) || ($idLiberacao != null)) {
		$dados = $_libera->comprovanteLiberacao($idLiberacao);

?>         
		<br><br>			    
	    <table border="0" align="center" width="600">
	    	<tr>
	    		<td>
			    	<div class="rTopoImagem1">
						<img src="/mod_ajuda/imagem/brasaoMG_80x77.png" />
					</div>
				</td>
				<td class="text-center">
					Estado de Minas Gerais<br />
			        Gabinete Militar do Governador<br />
			        Coordenadoria Estadual de Defesa Civil
			    </td>
				<td>
					<img src="/mod_ajuda/imagem/logodefesacivilpng80x77.png" />
				</td>
			<tr>
				<td colspan="3">
					<div class="rcorpo" id="bg">
					<br />
					<br />
					<br />
					<?=Liberacao::marcaDagua($dados['situacao']);?>
							     
					<table width="100%" border="0">
					    <tr>
							<td width="100"></td>	
							<td style="text-align:left;">Em:</td>
							<td style="text-align:left;"><?php print DataMysql::DataVisual($dados['dataLibera'])?></td>
							<td style="text-align:left;">Libera&ccedil;&atilde;o : <?php print $dados["id_liberacao"];?></td>
						</tr>
						<tr>
							<td width="100"></td>
							<td width="100" style="text-align:left;">Ao dep&oacute;sito:</td>
							<td style="text-align:left;font-style: italic;"><?php print Deposito::PegaNomeDeposito($dados['depDestino']);?></td>
						</tr>
						<tr>
							<td width="100"></td>
							<td width="100" style="text-align:left;">Munic&iacute;pio: </td>
							<td style="text-align:left;font-style: italic;"><?php print Municipio::PegaNomeMunicipio($dados['id_municipio']);?></td>
						</tr>
						<tr>
							<td width="100"></td>
							<td width="100" style="text-align:left;">Beneficiario: </td>
							<td style="text-align:left;font-style: italic;"><?php print $dados['beneficiario'];?></td>
						</tr>
						<tr>
							<td width="100"></td>
							<td width="100" style="text-align:left;">Processo n&ordm;: </td>
							<td style="text-align:left;font-style: italic;"> Doação</td>
						</tr>
						<tr>
							<br />                	
							<td colspan="4"><br />
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									Proceder a libera&ccedil;&atilde;o dos seguintes materiais:</td>
						 </tr>
						<tr>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<!-- Listagem de produtos  -->
							<td colspan="4" align="center">
							
							<table border="1" style="width: 50%">
								<tr>
									<td>Codigo</td>
									<td>Nome</td>
									<td>Evento</td>
									<td>Descricao</td>
									<td>Quantidade</td>

								</tr>
								<?php 
									$itens = $_libera->ListaProdutos($idLiberacao);

									foreach ($itens as $key => $value) {
										print "<tr>";
										print "<td>".$value['cod']."</td>";
										print "<td>".Unidade::PegaNomeId($value['cod'])."</td>";
										print "<td>".$value['evento']."</td>";
										print "<td>".$value['descricao']."</td>";
										print "<td>".$value['quantidade']."</td>";
										# code...
									}

								?>
							</table>
							<br>
								
							</td>
						</tr>
						 <tr>
							<td width="100"></td>
							<td width="100" style="text-align:left;">Observa&ccedil;&atilde;o:</td>
							<td style="text-align:left;font-style: italic;"><?php print utf8_encode($dados['observacao']);?></td>
						</tr>
						 <tr>
							<td width="50"></td>
							<td width="100" style="text-align:left;">Modo Entrega:</td>
							<td style="text-align:left; font-style: italic;"><?php print $dados['entrega'];?></td>
						</tr>
					</table>
					<br />
					<br />
					<table width="100%" border="0">
						<tr>
							<td align="center">_______________________________________</td>
						 </tr>
						<tr>
							<td align="center"><?php print Oficial::PegaNomeOficial($dados['responsavel'])."<br />".Oficial::PegaCargoIdOficial($dados['responsavel']);?></td>
						</tr>
						<tr>
							<td align="center"><!--Secret&aacuterio Executivo CEDEC-MG--><br /><br /><br /></td>
						</tr>
					</table>
		</table>						    
			

	<?php
		}

	?>
		<table border="0" align="center">
			<tr>
				<td align="center">
					<?php 
						print "<div class=\"imprimir\" style=\"text-align: center;\">";
									
							# segunda via da liberacao 
							if(isset($_GET['secao']) == 'svia'){
										
								print "<a class=\"btn btn-success\" href=\"rel.php?secao=liberacao\">Voltar</a>";				
							}else {
                                    # impressao de comprovante
									print "<a class=\"btn btn-success\" href=\"index.php?ac=itn&modulo=ajuda&controller=conestoque&action=comprov_lib&id=".$dados["id_liberacao"]."\">Voltar</a>";
							}
									print "</div>";
					?>
				</td>
			</tr>
		</table>
