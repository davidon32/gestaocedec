<?php session_start();
print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
include_once PATH.'/include.php';

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php print TITULO;?></title>
<link href="<?php print SISTEMA;?>/css/bootstrap.css" rel="stylesheet" media="screen">
	<link href="<?php print SISTEMA;?>/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
</head>
<body>
	<!-- TOPO /system/topo.php-->
    <?php include_once(PATH.'/system/topo.php'); ?>
    <div class="container">
        <!-- MENU -->
        <div class="row-fluid">
            <div class="span3">
                <!-- MENU -->
                <?php include_once PATH."/mod_".$modulo.'/app/elemento/'.$modulo.'.menu.php';?>
                <!-- FIM MENU -->
            </div>
			<div class="span9 fdo_corpo">
				<legend>Pesquisa</legend>
				<form name="buscaPipeiro" action="#" method="post">

					<label>CPF/CNPJ</label>
					<

					<input type="text" name="busca" data-mask="999.999.999-99" id="busca" size="20" class="mask-cpf" />
					<br />
					<input type="submit" class="btn btn-primary" name="enviar" id="enviar" value="Pesquisar" />


					<br />

				</form>

				<?php
		
					
				$_n_contrato = isset($_POST['n_contrato']) ? $_POST['n_contrato'] : "";

				$_cpf = isset($_POST['busca']) ? $_POST['busca'] : "";

				$enviar = isset($_POST['enviar']) ? $_POST['enviar'] : "";

				//FuncaoBase::vd($_POST);

					
				if($enviar != "") {

					if($_cpf == ""){

						print '	<script>
						alert("Campos em branco !");
						history.back();
						</script>';

					}elseif ($_cpf != ""){
							
						$relatorio = Motorista::buscaMotorista($_cpf);

						print '<table class="table">
							
						<tr>
						<td align="center">Nome</td>
						<td align="center">CPF</td>
						<td>Alteração</td>
						</tr>';
							

						for($i=0; $i < count($relatorio); $i++) {

							print ' <tr>

							<td align="center">
							<a href="index.php?modulo=pipa&secao=motorista&acao=alterar&id='.$relatorio[$i]['id_motorista'].'" title="Clique aqui para alterar o Cadastro">'.utf8_encode($relatorio[$i]['nome']).'</a>
							</td>
							<td>'.htmlentities($relatorio[$i]['cpf_cnpj']).'</td><td><a href="index.php?modulo=pipa&secao=motorista&acao=alterar&id='.htmlentities($relatorio[$i]['id_motorista']).'" title="Clique aqui para alterar o Cadastro"><i class="icon-ok"></i></a></td>
							</tr>
							';
						}

						print '</table>';


					}
				}




				?>

			</div>
			<div class="row-fluid text-center">
				<small><?php print RODAPE;?> </small>
			</div>
		</div>

		<script src="<?php print SISTEMA;?>/js/jquery.js"></script>
		<script src="../../js/bootstrap.js"></script>
		<script src="<?php print SISTEMA;?>/js/jasny-bootstrap.js"></script>
		<script src="<?php print SISTEMA;?>/js/funcaobase.js"></script>

</body>
</html>
