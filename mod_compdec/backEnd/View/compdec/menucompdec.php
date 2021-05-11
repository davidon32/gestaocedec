<?php $id_session = session_id();
    if(empty($id_session)) session_start();

	include_once 'include.php';

    	$_loginEx = new LoginExterno();
    	
    	$_loginEx->logadoExterno(); 	
    	
    	$_loginEx->Sessao();
    	   	
	    $id_pmda = isset($_GET['param']) ? $_GET['param'] :"";
	
	    if(!empty($id_pmda)){
	    	
	    	$_SESSION['seguranca']['id_pmda'] = $id_pmda;
	    }
	    
	    $id_municipio = isset($_SESSION['seguranca']['id_municipio']) ? $_SESSION['seguranca']['id_municipio'] :"";
	    
?>	
	
	<!DOCTYPE html>
	<html lang="pt-Br">
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="/css/bootstrap3.3.2.min.css" rel="stylesheet"/>
	
	<style type="text/css">
		table {
			margin: auto;
			width: 80%;
			width: 300px;
		}
		a.itemMenu {
			font-size: 10px;
			text-decoration: none;
		}

	</style>
	  </head>
	  <body>
	  		<?php include_once(PATH.'/ex/barra_usuario.php');?>
	  		
	  	<div class="container-fluid">

	  		<div class="col-md-2">
				<br>
		  		<br>
		  		<br>
	  			<a class="btn btn-primary col-md-12" href='/index2.php?secao=menu&t=<?=HASH;?>' title='Menu Principal'>Principal</a><br>
	  			<a class="btn btn-primary col-md-12" href='/index.php?modulo=compdec&secao=compdec&acao=alterar&t=<?=HASH;?>' title='Alterar Dados do Compdec'>Dados Cadastrais</a><br>
	  			<a class="btn btn-primary col-md-12" href='/index.php?modulo=compdec&secao=compdec&acao=consulta&t=<?=HASH;?>' title='Impressao da Ficha de Cadastro'>Impressão</a><br>
			</div>
				
	  		<div class="col-md-10 img-responsive">
	  			<!-- corpo -->
					<div class="col-md-2 pull-left text-center">
					</div>
					<div class="col-md-2 text-center">
						<label for="">
							<a href=""><img src="imagem/cadastro.png" width='100px'></a>
							Cadastro
						</label>
					</div>
					
					<div class="col-md-2 pull-left text-center">
						<label for="">
							<a href=""><img src="imagem/upload.png" width='100px'></a>
								Documentos
						</label>
					</div>
					<div class="col-md-2 pull-left text-center">
						<label for="">
							<a href=""><img src="imagem/print.png" width='100px'></a>
								Relatórios
						</label>
					</div>
	  			<div class="col-md-2 pull-left text-center">
						<label for="">
						<a href=""><img src="imagem/avatar.png" width='100px'></a>
							Perfil
						</label>
					</div>
		  		
	  		</div>
	  		
	  	</div>
<script src="js/jquery-1.12.1.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/bootstrap3.3.2.min.js"></script>
<script src="js/jasny-bootstrap_bs3.js"></script>
<script src="js/jquery.easy-autocomplete.js"></script>
<script src="js/lib/thickbox.js"></script>
<script src="js/funcaobase.js"></script>
</body>
</html>
	  	
	