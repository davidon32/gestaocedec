<html>
	<head><title></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
		<script type="text/javascript" src="js/jquery.maskedinput-1.3.min.js"></script>
		<script type="text/javascript" src="js/mascara.js"></script>
		<link href="../css/estilo.css" rel="stylesheet" type="text/css" />
		<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
		<link href="../SpryAssets/SpryMenuBarVertical.css" rel="stylesheet" type="text/css" />
		
	</head>
		<body>
			<div class="topo"><img src="../imagens/topo.png" /></div><br />
				<div class="menu"><?php include_once 'menu.php';?></div>
			<div class="corpo"><br />
				<div class="titulo">Gerador Contratos </div>

				<fieldset class="busca">
					<legend>Pesquisa de Pipeiro</legend>
					
					<form name="buscaPipeiro" action="#" method="post">
					<br />
						
						<div class="label">N Contrato</div>:
						<input type="text" name="n_contrato" id="n_contrato" size="10"/>
						<br />
						ou
						<br />
						<br />
						
						<div class="label">CPF/CNPJ</div>: <input type="text" name="busca" id="busca" size="20"/><span class="exemplo">Formato 999.999.999-99 - 99.999.999/9999-99</span><br /><br />
						<div class="btn_pesquisa">
							<input type="submit" name="enviar" id="enviar" value="Pesquisar" />	
						</div>
						
					</form>
				
				
				</fieldset>
					
					
					<?php
				 
					include_once '../../include.php';

					$_conexao = new ConexaoMysql();
	
					$_cpf = isset($_POST['busca']) ? $_POST['busca'] : "";
					
					$_n_contrato = isset($_POST['n_contrato']) ? $_POST['n_contrato'] : "";
					
					$enviar = isset($_POST['enviar']) ? $_POST['enviar'] : "";
					
					//FuncaoBase::vd($_POST);
					
						if($enviar != "") {
								
							
						if(($_n_contrato == "") && ($_cpf == "")){
								
									print '	<script>
											alert("Campos em branco !");
											history.back();
									   		</script>';
								
								}elseif ($_cpf != ""){
									
									$relatorio = Pipeiro::BuscaPipeiroAltera($_cpf);
								
									//FuncaoBase::vd($relatorio);
					
									print '<div class="busca"><table border="1">
									
											<tr>
												<td>N Contrato</td>
												<td>Nome</td>
												<td>Municipio Rota</td>
												<td>N Rota</td>
											</tr>';
											
				
										for($i=0; $i < count($relatorio); $i++) {
						
											print ' <tr>
							
												<td align="center"><a href="rel.gera.contrato.php?cpf='.htmlentities($relatorio[$i][10]).'&id='.htmlentities($relatorio[$i]['id_pipeiro']).'&n_contrato='.htmlentities($relatorio[$i]['n_contrato']).'" title="Clique aqui para alterar o Cadastro"><div style="width:30";>'.htmlentities($relatorio[$i]['n_contrato']).'</div></a></td>
												<td>'.htmlentities($relatorio[$i]['nome']).'</td>
												<td>'.htmlentities($relatorio[$i]['municipio_rota']).'</td>
												<td>'.htmlentities($relatorio[$i]['rota']).'</td>
											</tr>';
										}
						
										print '</table></div>';
								
								
								}elseif ($_n_contrato != ""){
									
									$relatorio = Pipeiro::BuscaPipeiroAlteraNumeroContrato($_n_contrato);
								
									//FuncaoBase::vd($relatorio);
					
									print '<div class="busca"><table border="1">
											<tr>
												<td>N Contrato</td>
												<td>Nome</td>
												<td>Municipio Rota</td>
												<td>N Rota</td>
											</tr>';
				
										for($i=0; $i < count($relatorio); $i++) {
						
											print ' <tr>
							
												<td align="center"><a href="rel.gera.contrato.php?cpf='.htmlentities($relatorio[$i][10]).'&id='.htmlentities($relatorio[$i]['id_pipeiro']).'&n_contrato='.htmlentities($relatorio[$i]['n_contrato']).'" title="Clique aqui para alterar o Cadastro"><div style="width:30";>'.htmlentities($relatorio[$i]['n_contrato']).'</div></a></td>
												<td>'.htmlentities($relatorio[$i]['nome']).'</td>
												<td>'.htmlentities($relatorio[$i]['municipio_rota']).'</td>
												<td>'.htmlentities($relatorio[$i]['rota']).'</td>
											</tr>';
										}
						
										print '</table></div>';
								}
						}
				?>
			</div>
				<div class="rodape"><?php include_once 'rodape.php';?></div>			
		</body>
	
	
</html>



