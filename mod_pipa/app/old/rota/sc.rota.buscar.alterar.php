<?php session_start();
	print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
	include_once '../include.php'; 

	$_conexao = new ConexaoMysql();

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php print TITULO;?></title>
<link href="<?php print SISTEMA;?>/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="<?php print SISTEMA;?>/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
</head>
<body>
	<div class="container">

		<!-- TOPO -->
		<div class="row-fluid text-center">
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

	    <!-- MENU -->
        <div class="row-fluid">
          	<div class="span3">
            <!-- MENU -->
                <?php include_once 'visao/pipa.menu.php';?>
                <!-- FIM MENU -->
        	</div>
	    	<div class="span9 fdo_corpo">
	    		<legend>Pesquisa</legend>
				
					<form action="#" method="POST" name="buscaPipeiro">
						
						<label>Nome Rota</label>
						<input type="text" name="txt_nome_rota" id="txt_nome_rota">

						<br />
						<input type="submit" class="btn btn-primary" name="btn_enviar" id="btn_enviar" value="Pesquisar" />
						<br />
											
					</form>
			
					<?php

						$_nome_rota = isset($_POST['txt_nome_rota']) ? $_POST['txt_nome_rota'] : "";
						
						$enviar = isset($_POST['btn_enviar']) ? $_POST['btn_enviar'] : "";
													
							if($enviar != "") {
									
								if($_nome_rota == ""){
								
									print "<script type='text/javascript'>";
									
									print "alert('Escolha uma Rota !');";
									
									print "window.location.href = 'secao.php?secao=rota&acao=buscar';";
									   		
									print "</script>";
								
								}elseif ($_nome_rota != ""){
									
									$dados = Rota::buscaRota($_nome_rota);
									
									print '<table class="table">
												<tr>
										      		<td align="center">Nome Rota</td>
													<td align="center">Número Rota</td>
													<td align="center">Momento</td>
												  	<td>Alteração</td>
												</tr>';
									
									for($i =0; $i < count($dados); $i++){

										print '<tr>
													<td align="center">'.htmlentities($dados[$i]['nome']).'</td>
													<td>'.htmlentities($dados[$i]['num_rota']).'</td>
													<td>'.htmlentities($dados[$i]['momento']).'</td>
													<td><a href="?secao=rota&acao=alterar&id='.htmlentities($dados[$i]['id_rota']).'" title="Clique aqui para alterar o Cadastro"><i class="icon-ok"></i></a></td>												
												 </tr>';
											
										}
								
									print '</table>';	
								
								}
								
							}
								
					?>
				
		</div>
		<div class="row-fluid text-center">
			<small><?php print RODAPE;?></small>
		</div>
	</div>

	<script src="<?php print SISTEMA;?>/js/jquery.js"></script>
	<script src="<?php print SISTEMA;?>/js/bootstrap.js"></script>
	<script src="<?php print SISTEMA;?>/js/jasny-bootstrap.js"></script>
	<script src="<?php print SISTEMA;?>/js/funcaobase.js"></script>		
	</body>	
</html>