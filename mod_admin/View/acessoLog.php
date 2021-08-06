<?php session_start();
include_once '../include.php';

	$_conexao = new ConexaoMysql();
	
	$_login = new Login();

    //$_login->logado();

    $_login->Sessao();
    
    $_usuario = new Usuario();

	

?>
<div class="span12 text-center">
    <?php FuncaoBase::vifs("volta"); ?>
    <br>
    <br>
</div>


<form method="post" action="#" name="">

	<?php $_usuario->buscaNomeUsuario();?>
	
	<input type="submit" name="" id="" size="" value="Buscar" >

</form>

<?php 

	$_nome_login = isset($_POST['login']) ? $_POST['login'] : "";

	//var_dump($_POST);
	
	$_login = $_usuario->buscaLoginUsuario($_nome_login);
	
	//var_dump($_login);
	
	
	$_dados = $_usuario->buscaLog($_login);
	
	
	//var_dump($_dados);
	
	print '<table border="0" cellspacing="0" style="font-size:10px;">
			<tr>
			 <td colspan="2" style="text-align:center; font-size:15px;">'.$_nome_login.'&nbsp;</td>
			</tr>
			<td>Usuario</td>
			<td>Data / Hora</td>
			<td>Açao</td>
			</tr>';
	
	for ($i = 0; $i < count($_dados); $i++) {
        
		print '<tr>
		        
				<td style="border-bottom:0.1em solid;border-right:0.1em solid;width:50px">'.$_dados[$i][0].'</td>
				<td style="border-bottom:0.1em solid;border-right:0.1em solid;width:80px">'.$_dados[$i][1].'</td>
				<td style="border-bottom:0.1em solid;border-right:0.1em solid;">'.$_dados[$i][2].'</td>
				
				</tr>';
		
	}
	
	print '</table>';

?>







