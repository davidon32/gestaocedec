<?php include_once PATH.'/core/include.php';?>
<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_ajuda/Model/indexModel.php";?>
<?php include_once "template/page/headerPageSimples.php";
$_deposito = new Deposito();

if(isset($_GET['id'])){

	$_id_liberacao = (int)$_GET['id'];
	
	$_liberacao = new Liberacao();
	

	$_dados = $_liberacao->buscaLiberacao($_id_liberacao);

}
?>

<legend class="text-center">Materiais Liberados</legend>

	<div class="container">
		<div class="span12"></div>
		<div class="span12 ">
			<br />
			<table border="0" width="500px" align="center">
				<tr>
					<td>Nº</td><td><?php print $_dados[0]['id_liberacao']?></td>
				</tr>
				<tr>
					<td>Beneficiário</td><td><?php print $_dados[0]['beneficiario']?></td>
				</tr>
				<tr>
					<td>Data Liberação</td><td><?php print DataMysql::dataVisual($_dados[0]['dataLibera']);?></td>
				</tr>
				<tr>
					<td>Destino</td><td><?php print $_deposito->PegaNomeDeposito($_dados[0]['depDestino']);?></td>
				</tr>
				<tr>
					<td>Beneficiário</td><td><?php print $_dados[0]['beneficiario']?></td>
				</tr>
				
				<tr>
					<td colspan="2" align="center">Materiais</td>
				</tr>
				<tr>
					<td colspan="2" align="center">
					<br />
						<?php 
						
							$_liberacao->ListaProdutos($_id_liberacao);
											
						?>
					</td>
				</tr>
				<tr>
					<td colspan="2" class="text-center">
					<br />
						<?php FuncaoBase::vifs('fechar');?>
						
					</td>
				</tr>
							
			</table>
			
		
		
		</div>
	
	
	</div>

