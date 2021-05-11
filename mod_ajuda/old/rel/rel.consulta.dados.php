<?php 

include_once $_SERVER['DOCUMENT_ROOT'].'/proj.sgah/include.php';

	$login = new Login();
	
	$login->acessarPagRel($_SESSION['n']);
?>


<!--
<a href="filtroSaldoEstoque.html">- Posicao Geral do Estoque</a>
<!-- sem filtro
<br />
<a href="rel/cons.sc.liberacao.material.php">- Consulta Material Liberado</a>
<!-- 
	* filtro de liberacao por materiais
	* filtro de libera��o por munic�pio
	* filtro de libera��o por por evento
	* filtro de libera��o por benefici�rio

<br />
<a href="rel/rel.consulta.Liberacao.espera.php">- Consulta Material Esperando Pagamento </a>
<!--
	* filtro de liberacao por materiais
	* filtro de libera��o por munic�pio
	* filtro de libera��o por por evento
	* filtro de libera��o por benefici�rio

<br />
<a href="rel/consulta.sc.pagamento.material.php">- Consulta Material Pago </a>
<!--
	* filtro de pagamento por numero de libera��o
	* filtro de pagamento por munic�pio
	* filtro de pagamento po data de pagamento
	* filtro data limite de pagamento



<br />
<!--<a href="rel/consulta.material.transferido.php">- Consulta Material Transferido</a>-->
<!--
	* filtro por data de tranferencia
	* flltro por dep�sito origem
	* filtro por dep�sito destino


<br />
<!--<a href="rel/informacoes.municipios.php">- Informacoes sobre Municipios </a>
	
<br />-->
