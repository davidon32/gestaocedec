<?php $id_session = session_id();
    if(empty($id_session)) session_start();
    	include_once PATH . '/include.php';
    
    	$_funcaoBase = new FuncaoBase ();
    
    	$_municipio = new Municipio ();

    	$_compdec = new Compdec ();
    
    	$acessoEx = isset ( $_SESSION ['seguranca'] ['ex'] ) ? $_SESSION ['seguranca'] ['ex'] : "";
    
    	// acesso externo
    	if (isset ( $_SESSION ['seguranca'] ['ex'] )) {
    
    		$_loginEx = new LoginExterno ();
    
    		$_loginEx->logadoExterno ();
    
    		$_loginEx->Sessao ();
    
    		$id_municipio = $_SESSION ['seguranca'] ['id_municipio'];
    
    		$_dados = $_compdec->buscaCompdec ( $id_municipio );
    
    		$_op = "index.php?modulo=compdec&secao=compdec&acao=valida&id=" . $id_municipio;
    
    	} else if(isset ( $_SESSION ['seguranca'] ['adm'] )){
    
    		$_login = new Login ();
    
    		$_login->logado ();
    
    		// fitlro id_compdec
    		if (is_int ( $_id )) {
    
    			$_dados = $_compdec->buscaCompdec ( $_id );

    		} else {

    		}
    	}else {
    
    	}

    	$voltar = "<a class='btn' href='javascript:history.back();'>Voltar</a>";
    
    	$dadosMunicipio = $_municipio->dadosMunicipio($_dados[0]['id_municipio']);
    
?>
<!DOCTYPE html>
<html lang="pt-Br">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="css/bootstrap3.3.2.min.css" rel="stylesheet"/>
<link rel="stylesheet" href="js/lib/thickbox.css" rel="stylesheet"/>
<link rel="stylesheet" href="css/easy-autocomplete.css" rel="stylesheet"/>

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
	       
	       body{
	       	background-color: <?=$background;?>;
	       }
	       table, th {
	       		bg-color: <?=$background;?> !importante;
	       	}
	       	
	       	.list_comunidade{
	       	
	       		font-size: 11px;	
	       	
	       	}
	</style>
  </head>
  <body>
  		<?php include_once(PATH.'/ex/barra_usuario.php');?>
  	<div class="container-fluid">
  	
  	<!-- menu de ajuda -->
  	<?php include_once 'menu.ajuda.php';?>

			<div class="col-md-1 text-center"></div>
	  		<div class="col-md-8">
	  			<!-- corpo -->
	  				<a href="?modulo=ajuda&secao=liberacao&acao=index" class="btn btn-primary">Voltar</a><br><br>
	  				<form action="#" method="POST" name="frmBusca">
	  				<label class="form">Busca</label>
	  				<input class="form-control" type="text" name="txtNumPedido" id="txtNumPedido"><br>
	  				<input class="btn btn-primary" type="submit" name="btn" id="btn" value="Pesquisar">
	  				</form>
	  			<br>
	  			<table class="table table-bordered">
	  				<tr>
	  					<th>#</th>
	  					<th>Data</th>
	  					<th>Situação</th>
	  					<th>Ação</th>
	  				</tr>
	  				<tr>
	  					<td>#</td>
	  					<td>#</td>
	  					<td>#</td>
	  					<td><a href="?index.php&ac=&modulo=ajuda&secao=liberacao&acao=editpedido"><img src="/imagem/edit.png"</a></td>
	  				</tr>
	  			</table>
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