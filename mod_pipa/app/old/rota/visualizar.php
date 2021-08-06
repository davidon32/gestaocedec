<?php session_start();
include_once PATH.'/include.php';
print "<!DOCTYPE html>";

$id_rota = (int) isset($_GET['id']) ? $_GET['id'] : 0;


$dados = Rota::visualizarRota($id_rota);

?>

<html>
<head>
<title>Pesquisa de Rota</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="<?php print SISTEMA; ?>/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="<?php print SISTEMA; ?>/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
</head>
<body>
    <div class="container">
    <div class="row-fluid">
    <img src="../imagem/topo_pipa.png">
			<hr>
		</div>
		<!-- BARRA -->
	    <div class="row-fluid">
	      <div class="span6 text-left"><small><?php print "Data :".date("d/m/Y");?></small></div>
	      <div class="span6 text-right"><small><?php print "Hora :".date("H:i:s");?></small></div>
	    </div>

	    <!-- LOGOUT -->
	    <div class="row-fluid">
	      <div class="span12 text-right">
	        <a class="btn btn-primary" href="<?php print SISTEMA;?>/core/logout.php?logout=s" title="Logout do Sistema">Logout</a>
	        <p>
	        <hr>
	      </div>
	    </div>
		<div class="row-fluid">
			<!-- MENU -->
			<div class="span3">
				<?php include_once PATH."/mod_".$modulo.'/app/elemento/'.$modulo.'.menu.php';?>
			</div>
		<div class="span9">

	

<fieldset>
		<legend>Comunidades da Rota</legend>
			<br />
			<table class="table">
				<th>Codigo</th>
				<th>Nome</th>
				<th>Num Rota</th>
				<th>Momento</th>
				<th>Ano</th>
				
				<?php
							
						print '<tr>
								<td>'.$dados['id_rota'].'</td>
                                <td>'.$dados['nome'].'</td>
	                            <td>'.$dados['num_rota'].'</td>
								<td>'.$dados['momento'].'</td>
								<td>'.$dados['ano'].'</td>
																
							</tr>';			
				?>
			</table>
			
			<table class="table">
				<tr>
					<th colspan="2" style='text-align:center;'>Comunidades</th>
				</tr>
				<tr>
					<td>Codigo</td>
					<td>Nome</td>
				</tr>
				
				<?php 
				
				    /* comunidades */
				
				    $comunidade = new Comunidade();
				    
				    $dadosCom = $comunidade->buscaComunidadeRota($id_rota);
				    			    
				    foreach ($dadosCom as $key=>$value){
				        
				        print "<tr><td>".$dadosCom[$key]['id_comunidade']."</td>
                              <td>".$dadosCom[$key]['comunidade']."</td></tr>";
				        
				    }
				
				
				
				?>
			
			</table>
			
		
	</fieldset>
	


<a class="btn btn-primary" href="?modulo=pipa&secao=rota&acao=pesquisar">Voltar</a>
<br />

</div>
