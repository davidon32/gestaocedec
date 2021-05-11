<?php
	include_once '../../include.php';



?>


<form action="rel.banco.brasil.php" method="post" name="frm_envia">



	<?php 
		FuncaoBase::mes();
	?>
	
	
	<input type="submit" name="enviar" value="Gerar" >
	
</form>
<br />
<br />
<?php 
	FuncaoBase::Fechar();
?>

	