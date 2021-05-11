<html>

<label>cpf</label>:

	<form action="#" method="post">
		
		<input type="text" name="cpf" id="cpf" class="cpf" size="30" />
		<input type="submit" name="enviar" id="enviar" value="Pesquisar" />
		
	</form>


<?php

	include_once '../../include.php';
	
	session_start();

	$con = new ConexaoMysql();
	$_cpf = isset($_POST['cpf']) ? $_POST['cpf'] : "";
	$_enviar = isset($_POST['enviar']) ? $_POST['enviar'] : "";
	
	
	if($_enviar != ""){
		
		$dadosMotorista = Motorista::buscaMotorista($_cpf);
	
		print '<table border="1">
				<tr>
					<td>Nome</td><td>Habilitacao</td><td>CPF</td><td>Adicionar</td>
				</tr>
				<tr>
					<td>'.$dadosMotorista[0]['nome'].'</td><td>'.$dadosMotorista[0]['cnh'].'</td><td>'.$dadosMotorista[0]['cpf'].'</td><td><a href="sc.add.session.mot.php?id='.$dadosMotorista[0]['cpf'].'">Add</a></td>
				</tr>
			</table>';
			
			FuncaoBase::vd($dadosMotorista);
			
	}
		
		
		
		
	
	
	




?>