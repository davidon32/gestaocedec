<!DOCTYPE html>
<?php include_once 'config.inc.php';?>
<html>
<head>
    <title><?php print TITULO;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
</head>
<body>

	<!-- TOPO -->
	<div class="container-fluid">
		<div class="row-fluid">
			<?php include_once 'cabecalho_php';?>
		</div>
		<div class="row-fluid">
				<?php print VERSAO;?>
			</div>
		<br />

			<div class="row-fluid">
				<div class="span4"><!-- COLUNA 1 --><div style="height:800px;"></div></div>
				<div class="span4"><!-- COLUNA 2 -->
						<!-- FORMULARIO LOGIN -->
						<br /><br />
						<fieldset>
							<legend>Autenticação</legend>
						    <form class="form-horizontal" action="index2.php">
							    <div class="control-group">
							    <label class="control-label" for="inputEmail">Usuário</label>
							    <div class="controls">
							    <input type="text" id="inputEmail" placeholder="Usuário">
							    </div>
							    </div>
							    <div class="control-group">
							    <label class="control-label" for="inputPassword">Senha</label>
							    <div class="controls">
							    <input type="password" id="inputPassword" placeholder="Password">
							    </div>
							    </div>
							    <div class="control-group">
							    <div class="controls">
							    <button type="submit" class="btn">Entrar</button>
							    </div>
							    </div>
						    </form>
						</fieldset>


				</div>
				<div class="span4"><!-- COLUNA 3 --></div>
			</div>
				<!-- RODAPE -->
				<div class="row-fluid">
					<?php include_once 'rodape';?>
				</div>
	</div>    
		<script src="<?php print SISTEMA;?>/js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html> 