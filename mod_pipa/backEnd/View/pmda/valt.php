<?php $id_session = session_id();
    if(empty($id_session)) session_start();

	include_once 'include.php';
	
	$municipio = new Municipio();
	
	$compdec = new Compdec();
	$pmda = new Pmda();
	
	//$id_municipio = $_SESSION['seguranca']['id_municipio'];
	
 
		$id_pmda = isset($_GET['pmda']) ? $_GET['pmda'] : "";
	
		$id_municipio = isset($_GET['mun']) ? $_GET['mun'] : "";
			 
		$_SESSION['seguranca']['id_municipio'] = $id_municipio;
	
  		$dados = $pmda->buscaAlteracaoPmda($id_pmda);
?>

<!DOCTYPE html>
<html lang="pt-Br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link href="css/bootstrap3.3.2.min.css" rel="stylesheet"/>


	<style type="text/css">
	
			*{
				font-size: 12pt;
			}
	                  
           @media print {
           
           			.btnVoltar {
           				display:none;
           			}
           
           }  
	
	</style>
  </head>
  <body>
  	<div class="container-fluid">
  	
  		<!-- CABEÇALHO -->
  		<div class="col-md-12 text-center">
  			<img alt="Logo CEDEC" src="imagem/logo_novo.png">
  			<img alt="Logo CEDEC" src="imagem/logo_gab.png">
  		</div>
  		
  		<div class="col-md-12 text-center" id="btnVoltar">
  			<a href="index.php?modulo=pipa&secao=pmda&acao=adm" class="btn btn-primary btnVoltar">Voltar</a>
  		</div>
  		<div class="col-md-12 text-center">
		<br><br>
  		<table class="table table-bordered">
  			<tr>
  				<td colspan="2"><p class="text-center">Alterações PMDA - <?=$dados[0]['nome'];?></p></td>
  			</tr>
  			
  			<?php 
  			
  				var_dump($dados);
  				foreach ($dados as $value) {
  					print "<tr>";
  					print "<td>".$value['id_pmda_alteracao']."</td>";
					print "<td>".$value['id_pmda']."</td>";
					print "</tr>";
  				}
  			
  			?>

  		</table>
  	</div>
  	</div>
  
  </body>
  	</html>