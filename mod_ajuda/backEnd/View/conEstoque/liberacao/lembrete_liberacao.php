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
			<table border="0" width="600px" align="center">
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
                                            $material_lib = $_liberacao->ListaProdutos($_id_liberacao);
					  
					
                                                print "<table class='table table-condensed table-bordered'>";
                                                print "<tr>";
                                                print "<th>cod</th>";
                                                print "<th title='Codigo da Entrada do Material'>Id Entr.</th>";
                                                print "<th>Nome</th>";
                                                print "<th>Descricao</th>";
                                                print "<th>Evento</th>";
                                                print "<th>Qtd</th>";
                                                print "</tr>";
                                                foreach ($material_lib as $key => $value) {
                                                
                                                print "<tr>";
                                                print "<td>".$value['cod']."</td>";
                                                print "<td title='Codigo da Entrada do Material'><a href='".FuncaoBase::geraLink("ajuda", "conestoque", "entrada_mat", array('id'=>$value['id_entrada']))."'>".$value['id_entrada']."</a></td>";
                                                print "<td>".$value['nome']."</td>";
                                                print "<td>".$value['descricao']."</td>";
                                                print "<td>".$value['evento']."</td>";
                                                print "<td>".$value['quantidade']."</td>";
                                                print "<tr>";
                                                
                                            }
                                                print "</table>";
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

