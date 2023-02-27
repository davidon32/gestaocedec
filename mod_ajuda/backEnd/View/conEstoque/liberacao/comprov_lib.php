<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_ajuda/Model/indexModel.php";?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/headerPageSimples.php";?>
<!-- =================== MENU  ============================ -->
<?php

$_id = isset($_REQUEST['id']) ? $_REQUEST['id'] : "";

if(!empty($_id)) {


	print "<div class='cent text-center'>
			<br />
			<br />
<!--			<a class=\"btn\" href=\"?token=".hash('sha256', md5(VERSAO).date('dmY'))."&ac=itn&modulo=ajuda&controller=conestoque&action=libpdf&id=".$_id."\"><img width='30' src='core/imagem/view1.png'>Salvar Libera&ccedil;&atilde;o em pdf</a>;-->
			<br /><br>
			<a class=\"btn\" href=\"?token=".hash('sha256', md5(VERSAO).date('dmY'))."&ac=itn&modulo=ajuda&controller=relatorio&action=rel_liberacao_recibo&id=".$_id."\";><img width='30' src='core/imagem/view1.png'>Impressao Recibo de Liberação</a>
			<br /><br>
			<a class=\"btn\" href=\"?token=".hash('sha256', md5(VERSAO).date('dmY'))."&ac=itn&modulo=ajuda&controller=relatorio&action=rec_pgto&id=".$_id."\";><img width='30' src='core/imagem/view1.png'>Recibo Pagamento em Branco</a>
			<br /><br>
			<a class=\"btn btn-success\" href=\"?token=".hash('sha256', md5(VERSAO).date('dmY'))."&ac=itn&modulo=ajuda&controller=conestoque&action=liberacao\">Voltar</a>
	</div>";	
}