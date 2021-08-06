<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title></title>
		<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>
		<script type="text/javascript" src="../js/jquery.maskedinput-1.3.min.js"></script>
		<script type="text/javascript" src="../js/mascara.js"></script>
		<!--<link href="../css/estilo.css" rel="stylesheet" type="text/css" />-->
	</head>
	<body>
		
		<div class="corpo"><br />
		<!-- corpo -->
			<div class="titulo"> Impressão Cadastro Pipeiro</div>
  		
  			<fieldset class="busca">
  				<legend>Pesquisa de Pipeiro</legend>
	  			
		  			
					<form name="buscaPipeiro" action="#" method="post">
			
						<br />
						CPF/CNPJ: <input type="text" name="busca" id="busca" size="20"/><span class="exemplo">Formato 999.999.999-99 - 99.999.999/9999-99</span><br /><br />
						<div class="btn_pesquisa">
							<input type="submit" name="enviar" id="enviar" value="Pesquisar" />
						</div>
							
					</form>

			</fieldset>
				
					<?php
					 
						include_once '../../include.php';
						
						$_conexao = new ConexaoMysql();
		
						$cpf = isset($_POST['busca']) ? $_POST['busca'] : "";
						$enviar = isset($_POST['enviar']) ? $_POST['enviar'] : "";
						
						//FuncaoBase::vd($_POST);
						
							if($enviar != "") {
									
								if($cpf != ""){
									
									$relatorio = Pipeiro::BuscaPipeiro(false, $cpf);
						
									print '<div class="busca"><table border="0">';
					
										for($i=0; $i < count($relatorio); $i++) {
							
											print ' <tr>
								
											<td><a href="rel.cadastro.pipeiro.php?id='.htmlentities($relatorio[$i][10]).'" title="Clique aqui para alterar o Cadastro">'.htmlentities($relatorio[$i][1])." / ".htmlentities($relatorio[$i][2]).'</td></a></td>
											</tr>';
					
										}
							
										print '</table></div>';
									
									}else {
											
									}	
							}
					?>
				
		</div>	
	</body>	
</html>