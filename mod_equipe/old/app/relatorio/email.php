<?php session_start();
print "<!DOCTYPE html>";
include_once PATH.'/include.php';

$_conexao = new ConexaoMysql();

//Login::logado();


$dados = EquipeFuncionario::ListaEmail();

?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo TITULO; ?></title>
	<link href="<?php print SISTEMA;?>/css/bootstrap.css" rel="stylesheet" media="screen">
	<link href="<?php print SISTEMA;?>/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
	<style type="text/css">

	@media print {

		.imprimir {

			display: none;

		}

	}

	</style>
</head>
<body>
	<div class="container">
		<div class="span12 text-center imprimir"><br /><?php FuncaoBase::voltar();?></div>
		<div class="span12 text-center"><br />
			<legend>Lista de Email de Funcionarios</legend>
		</div>

		<div class="span12">

			<label><b>OBS: por uma limitação do email da CA, será dividida a lista em blocos de 45 emails.</b></label><br />


		</div>


		<div class="span12 texto"><p>

						<?php 
							for ($i=0; $i < count($dados); $i++) { 

								if($i == 45) {

								 	print '<hr><br /><br />';

								}


								if($dados[$i][2] != 'naotememail@nada.com.br'){


									print $dados[$i][2]."; ";
									
										
								}
							}
						?>
					</p>
			</div>
			<div class="span2"></div>

		</div>

		<script src="<?php print SISTEMA;?>/js/jquery.js"></script>
		<script src="<?php print SISTEMA;?>/js/bootstrap.js"></script>
		<script src="<?php print SISTEMA;?>/js/jasny-bootstrap.js"></script>
	</body>
	</html>
