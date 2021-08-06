<!DOCTYPE html>
<?php include_once 'config.inc.php';?>
<html>
<head>
    <title><?php print TITULO." - Montar Turma";?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
</head>
<body>
	<div class="container-fluid">
		<div class="row-fluid">
			<?php include_once 'cabecalho_.php';?>
			</div>
			<div class="row-fluid">
				<?php print VERSAO;?>
			</div>
			<br />

			<!-- MENU -->
				<div class="row-fluid">
					<div class="span3">
						<?php
							include_once 'menu.php';
						?>
					    
					</div>
					<div class="span9">
							<br />
							    <form>
								    <fieldset>
									    <legend>Consultas / Relatórios</legend>
									    <label>Nome</label>
									    <input class="input-xlarge" type="text" placeholder="">
									    <span class="help-block"></span>

									    
									    <button type="submit" class="btn btn-primary">Cadastrar</button>
								    </fieldset>
								</form>

					</div>
				</div>
					<div class="row-fluid">
						<?php include_once 'rodape.php';?>
					</div>
	</div>    
<script src="<?php print SISTEMA;?>/js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html> 