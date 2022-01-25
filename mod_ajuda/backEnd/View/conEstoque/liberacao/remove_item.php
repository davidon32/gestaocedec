<?php
/* ****************************************************************************************
 *  	Org�o Gestor : Coordenadoria Estadual de Defesa Civil do Estado de Minas Gerais
*	Sistema      : Sistema de Gest�o de Ajuda Humanit�ria
*
*	Autor        :  Demetrio Silva Passos
*	Fun��o       : script para remocao de item no pedido
*
*******************************************************************************************/


$remove = isset($_GET['r']) ? $_GET['r']: null;
	$item = isset($_GET['item']) ? $_GET['item'] : null;

	if($remove == true){
	
		unset($_SESSION['cesta'][$item]);

		print "<script type='text/javascript'>";

		print "alert('Item Removido com Sucesso !');";

		print "</script>";	

	}

		$_SESSION['cesta'] = array_values($_SESSION['cesta']);

		print "<script type='text/javascript'>";
                print "history.back();";

		print "</script>";	
		
		?>