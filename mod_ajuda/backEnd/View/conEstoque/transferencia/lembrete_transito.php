<?php include_once PATH.'/core/include.php';?>
<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_ajuda/Model/indexModel.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPageSimples.php";


/* ****************************************************************************************
 *   Org�o 		 : Coordenadoria Estadual de Defesa Civil do Estado de Minas Gerais
*	Sistema      : Sistema de Gest�o de Ajuda Humanit�ria
*
*	Autor        : Demetrio Silva Passos
*	Fun��o       : Tela menu mostra materiais em transito
*
*******************************************************************************************/

$_transferencia = new TransferenciaMaterial();

?>

	<div class="col-md-12">
		<h4><p class="text-center"><?php print 'Material em Trânsito';?></p></h4>
	</div>
	<div class="col-md-12">
		<?php 
		
		$id_transferencia = isset($_GET['id']) ? $_GET['id'] :"";

		$_transferencia->MaterialTransito($_COOKIE['seguranca']['id_deposito'],
		                                  $_COOKIE['seguranca']['nivel'],
		                                  $id_transferencia);

		?>
	</div>