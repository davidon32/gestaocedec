<!DOCTYPE html>
<?php include_once '../include.php';

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php print TITULO;?></title>
<script src="<?php print SISTEMA;?>/js/jquery.js"></script>
<link href="../../css/bootstrap.css" rel="stylesheet" media="screen">
<link href="../../css/bootstrap-responsive.css" rel="stylesheet" media="screen">
<script src="../../js/bootstrap.js"></script>
<!--<link rel="stylesheet" type="text/css" href="../../css/estilo.css" />
 <script type="text/javascript" src="../../js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="../../js/jquery.maskedinput-1.3.min.js"></script>
<script type="text/javascript" src="../../js/mascara.js"></script>-->
</head>
<body>
	<div class="container-fluid">
		<!-- TOPO -->
		<div class="row-fluid text-center">
			<?php include_once 'sc.pagina.cabecalho.php';?>
		</div>
		<div class="row-fluid">
			<?php print VERSAO;?>
		</div>
		<br />
		<!-- MENU -->
			<div class="row-fluid">
				<div class="span3">
					<!--EXEMPLO MENU -->
					<?php include_once 'cce.menu.php';?>                       
				</div>
                <!-- CONTEUDO -->
				<div class="span6 fdo_corpo">
					<form>
						<legend>Pesquisa de Ocorrência de Eventos</legend>

					<label>Data Inicial</label>
					<input type="text" name="dt_inicial" data-mask="99/99/9999">
					
					<label>Data Final</label>
					<input type="text" name="dt_inicial">

					<label>Município</label>
					<?php Municipio::PegaMunicipio();?>
					<br />
					<input type="submit" name="enviar" id="" size="" value="Pesquisar">

				</form>
				</div>
				<div class="span3"></div>
			</div>
			<div class="row-fluid">
					<div class="span12 text-center">
						<small><?php print RODAPE;?></small>
					</div>
			</div>
	</div>    
<script src="<?php print SISTEMA;?>/js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/jasny-bootstrap.js"></script>
</body>
</html> 
<?php 

FuncaoBase::vd($_POST);

#@ botao enviar 
$pesquisa = isset($_POST['enviar']) ? $_POST['enviar'] : false;

#@ campo data inicial de filtro
$dt_inicial = isset($_POST['dt_inicial']) ? $_POST['dt_inicial'] : false;

#@ campo de data final 
$dt_final = isset($_POST['dt_final']) ? $_POST['dt_final'] : false;

#@ nome do municipio para filtro do relatório
$_municipio = isset($_POST['nMunicipio']) ? $_POST['nMunicipio'] : "";

#@ id do municipio
//$_id_municipio = Municipio::pegaIdMunicipio($_municipio);

//var_dump($_POST);

if ($pesquisa) {

$_evento = Evento::BuscaEvento($_id_municipio, $dt_inicial, $dt_final);


//var_dump($_evento);

if($_evento > 0){

	for ($i =0; $i < count($_evento); $i++){
		?>
	
	<table align="center" width="900" border="1" cellpadding="0" cellspacing="0">
	
			<tr>
				<td colspan="6">Cod. Município : <?php print $_evento[$i]['id_municipio'];?></td>
				<td colspan="6">Nome : <?php print $_evento[$i]['nome'];?></td>
			</tr>
			<tr>
				<td colspan="12">Número do Processo : <?php print $_evento[$i]['num_processo'];?></td>
			</tr>
			<tr>
				<td width="150">Dt.Registro 	</td><td width="130">: <?php print $_evento[$i]['data'];?></td>
				<td width="120">Dt.Ocorrência   </td><td>: <?php print $_evento[$i]['dt_ocorrencia'];?></td>
				<td>Hr.Ocorrência	</td><td>: <?php print $_evento[$i]['hr_ocorrencia'];?></td>
				<td>Tipo 			</td><td>: <?php print $_evento[$i]['tipo_evento'];?></td>
				<td>Codar			</td><td>: <?php print $_evento[$i]['codar'];?></td>
				
			</tr>
			<tr>
				<td>Tem Comdec 		</td><td>: <?php print $_evento[$i]['existe_comdec'];?></td>
				<td>Desalojados 	</td><td>: <?php print $_evento[$i]['desalojado'];?></td>
				<td>Desabrigados 	</td><td>: <?php print $_evento[$i]['desabrigado'];?></td>
				<td>Deslocados 		</td><td>: <?php print $_evento[$i]['deslocados'];?></td>
				<td>Desaparecidos 	</td><td>: <?php print $_evento[$i]['desaparecido'];?></td>
				
			</tr>
			<tr>
				<td>Mortos 			</td><td>: <?php print $_evento[$i]['morto'];?></td>
				<td>Enfermos 		</td><td>: <?php print $_evento[$i]['enfermo'];?></td>
				<td>Feridos Levemente 		 </td><td>: <?php print $_evento[$i]['ferido_leve'];?></td>
				<td>Feridos Gravemente 		 </td><td>: <?php print $_evento[$i]['ferido_grave'];?></td>
				<td>Afetados 				 </td><td>: <?php print $_evento[$i]['afetado'];?></td>
			</tr>
				
			</tr>
			<tr>
				<td>Residências Danificadas  </td><td>: <?php print $_evento[$i]['residencia_danificada'];?></td>
				<td>Residências Destruidas   </td><td>: <?php print $_evento[$i]['residencia_destruida'];?></td>
				<td>Imóvel Público Danificado</td><td>: <?php print $_evento[$i]['publica_danificada'];?></td>
				<td>Imóvel Público Destruido</td><td>: <?php print $_evento[$i]['publica_destruida'];?></td>
				<td>Imóvel Comunitário 			</td><td>: <?php print $_evento[$i]['comunitaria'];?></td>
			</tr>
				
			</tr>
			
			<tr>
				<td>Imovel Comunitário Destruído</td><td>: <?php print $_evento[$i]['comunitaria_destruida'];?></td>
				<td>Imóvel Paricular Danificado </td><td>: <?php print $_evento[$i]['particular_danificada'];?></td>
				<td>Imóvel Particular Destruído </td><td>: <?php print $_evento[$i]['particular_destruida'];?></td>
				<td>Pontes Desctruídas			</td><td>: <?php print $_evento[$i]['ponte'];?></td>
				<td>Estrada</td><td><?php print $_evento[$i]['estrada'];?></td>
			</tr>
				<td>Dano Ambiental</td><td><?php print utf8_decode($_evento[$i]['dano_ambiental']);?></td>
				<td>Documento Enviado</td><td><?php print $_evento[$i]['documento_enviado'];?></td>
				<td>Decreto</td><td><?php print $_evento[$i]['decreto'];?></td>
				<td>Num.Decreto</td><td><?php print $_evento[$i]['num_decreto'];?></td>
				<td>Dt Decreto</td><td><?php print $_evento[$i]['dt_decreto'];?></td>
			</tr>
			<tr>
				<td>Respons.Municipio</td><td><?php print utf8_decode($_evento[$i]['resp_mun']);?></td>
				<td>Necessita</td><td><?php print utf8_decode($_evento[$i]['necessita']);?></td>
				<td>Órgão Acionado</td><td><?php print $_evento[$i]['orgao_acionado'];?></td>
				<td>Resp.Preenchimento</td><td><?php print $_evento[$i]['resp_preenchimento'];?></td>
				<td>Dt.Homologação</td><td><?php print $_evento[$i]['dt_homologacao'];?></td>
			</tr>
				
			</tr>
						
			<tr>
				<td colspan="12">Local Atingido :</td>
			</tr>
			<tr>
				<td colspan="12" height="100" >
				&nbsp;
				<br />
				<?php print utf8_decode($_evento[$i]['localidade_atingida']);?>
				</td>
			</tr>
			<tr>
			</tr>
			<tr>
				<td colspan="5">Descrição Desastre :</td>
			</tr>
			<tr>
				<td valign="top" colspan="5" height="200">
					&nbsp;<br />
					<?php print utf8_decode($_evento[$i]['descricao']);?></td>
			</tr>
	</table>
	
<?php

	}

}else {
	
	print '<div>Pesquisa não obteve resultados !<div>';
	
	
}
	
}
?>


<!-- 


		
	
	<tr>
		
		
		
	</tr>
</table>
-->


</body>
</html>