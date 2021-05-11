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
					<div class="span6">
								<form>
								    <fieldset>
									    <legend>Montar Turma</legend>
									    
									    <label>Nome</label>
									    <input class="input-xlarge" type="text" placeholder="" name="nome">

									    <button type="button" class="btn btn-primary" name="addAluno">Adicionar</button>		
									    

									    <label>Total Alunos</label><label>40</label>
									    
																	    

									    <span class="help-block"></span>

									    <button type="submit" class="btn btn-primary">Fechar</button>
								    </fieldset>
								</form>	
					    
					</div>
					<div class="span6">
							<br />
							<ul>
								<li>Antônio</li>
								<li>Jose</li>
								<li>Maria</li>

							</ul>
							
							    

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