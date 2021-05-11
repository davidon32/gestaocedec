<?php include_once PATH.'/core/include.php';?>
<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_ajuda/Model/indexModel.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPageSimples.php";?>

<?php

/* ****************************************************************************************
 *  	Org�o Gestor : Coordenadoria Estadual de Defesa Civil do Estado de Minas Gerais
*	Sistema      : Sistema de Gest�o de Ajuda Humanit�ria
*
*	Autor        :  Demetrio Silva Passos
*	Função       :  imprimir recibo pagamento de materais
*
*******************************************************************************************/

		print "<div class=\"col-md-12 text-center\"><br>";

		print "<a class=\"btn btn-info\" href=\"?token=".hash('sha256', md5(VERSAO))."&ac=itn&modulo=ajuda&controller=conestoque&action=imprecibopg&nlib=".$_GET['id']."\">Impressão Recibo</a>&nbsp;&nbsp;";
	
			print "<a class=\"btn btn-info\" href=\"?token=".hash('sha256', md5(VERSAO))."&ac=itn&modulo=ajuda&controller=conestoque&action=imprecibopgpdf&nlib=".$_GET['id']."\">Salvar PDF</a>&nbsp;&nbsp;";
			
			print "<a class=\"btn btn-success\" href=\"?token=".hash('sha256', md5(VERSAO))."&ac=itn&modulo=ajuda&controller=conestoque&action=idxpagamento\">Voltar</a>";

	print "</div>";
		?>
