<?php session_start();
print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
include_once '../include.php';
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php print TITULO;?></title>
<script src="<?php print SISTEMA;?>/js/jquery.js"></script>
<link href="<?php print SISTEMA;?>/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="<?php print SISTEMA;?>/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
<script src="<?php print SISTEMA;?>/js/bootstrap.js"></script>
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
				<div class="span2">
					<!--EXEMPLO MENU -->
					<?php include_once 'cce.menu.php';?>                       
				</div>
                <!-- CONTEUDO -->
				<div class="span8 fdo_corpo">
					<form action="#" method="POST" name="cadastra_evento">
					    
					    <legend>Cadastro de Ocorrencia de Eventos</legend>
					    
					    <table align="center">
					        <tr>
					            <td>Número Processo :</td>
					            <td><input type="text" name="nr_processo" placeholder=""></td>
					            
					            <td>Código Município :</td>
					            <td><input type="text" name="cod_mun" placeholder=""></td>
					        </tr>
					         <tr>
                                <td>Dt Entrada :</td>
                                <td><input type="text" name="dt_cad" placeholder=""></td>
                                
                                <td>Tipo de Evento :</td>
                                <td><input type="text" name="tipo_evento" placeholder=""></td>
                            </tr>
                            <tr>
                                <td>Codar</td>
                                <td><input type="text" name="codar" placeholder=""></td>
                                
                                <td>Data Ocorrência</td>
                                <td><input type="text" name="data_ocor" placeholder=""></td>
                            </tr>
                            <tr>
                                <td>Hora Ocorrência</td>
                                <td><input type="text" name="hora_ocor" placeholder=""></td>
                                
                                <td>Local Atingido</td>
                                <td><input type="text" name="local_ating" placeholder=""></td>
                            </tr>
                            <tr>
                                <td>Compdec</td>
                                <td><input type="text" name="comdec" placeholder=""></td>
                                
                                <td></td>
                                <td></td>
                            </tr>
                             <tr>
                                <td>Descrição</td>
                                <td colspan="3"><textarea class="field span12" name="descreve" placeholder="" cols="50" rows="11"></textarea></td>
                            </tr>
                             <tr>
                                <td>Desalojados</td>
                                <td><input type="text" name="desaloja" placeholder=""></td>
                                
                                <td>Desabrigados</td>
                                <td><input type="text" name="desabriga" placeholder=""></td>
                            </tr>
                             <tr>
                                <td>Deslocados</td>
                                <td><input class="btn btn-primary" type="text" name="desloca" placeholder=""></td>
                                
                                <td>Desaparecidos</td>
                                <td><input class="btn btn-primary" type="text" name="desaparece" placeholder=""></td>
                            </tr>
                             <tr>
                                <td>Mortos</td>
                                <td><input class="btn btn-primary" type="text" name="morto" placeholder=""></td>
                                
                                <td></td>
                                <td></td>
                            </tr>
                             <tr>
                                <td></td>
                                <td></td>
                                
                                <td></td>
                                <td></td>
                            </tr>
                             <tr>
                                <td></td>
                                <td></td>
                                
                                <td></td>
                                <td></td>
                            </tr>
					    </table>
						
						
						
						
						
						
						<input class="btn btn-primary" type="text" name="Enfermo" placeholder="">,
						<input class="btn btn-primary" type="text" name="fere_leve" placeholder="">,
						<input class="btn btn-primary" type="text" name="fere_grave" placeholder="">,
						<input class="btn btn-primary" type="text" name="afeta" placeholder="">,
						<input class="btn btn-primary" type="text" name="reside_dan" placeholder="">,
						<input class="btn btn-primary" type="text" name="reside_des" placeholder="">,
						<input class="btn btn-primary" type="text" name="pub_dan" placeholder="">,
						<input class="btn btn-primary" type="text" name="pub_des" placeholder="">,
						<input class="btn btn-primary" type="text" name="comum_dan" placeholder="">,
						<input class="btn btn-primary" type="text" name="comum_des" placeholder="">,
						<input class="btn btn-primary" type="text" name="part_dan" placeholder="">,
						<input class="btn btn-primary" type="text" name="part_des" placeholder="">,
						<input class="btn btn-primary" type="text" name="pontes" placeholder="">,
						<input class="btn btn-primary" type="text" name="estradas" placeholder="">,
						<input class="btn btn-primary" type="text" name="ambiente" placeholder="">,
						<input class="btn btn-primary" type="text" name="providencia" placeholder="">,
						<input class="btn btn-primary" type="text" name="decreta" placeholder="">,
						<input class="btn btn-primary" type="text" name="nr_dec" placeholder="">,
						<input class="btn btn-primary" type="text" name="data_dec" placeholder="">,
						<input class="btn btn-primary" type="text" name="resp_mun" placeholder="">,
						<input class="btn btn-primary" type="text" name="necessita" placeholder="">,
						<input class="btn btn-primary" type="text" name="orgao_acio" placeholder="">,
						<input class="btn btn-primary" type="text" name="resp" placeholder="">,
						<input class="btn btn-primary" type="text" name="homologa" placeholder="">

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
<script src="<?php print SISTEMA;?>/js/bootstrap.js"></script>
<script src="<?php print SISTEMA;?>/js/jasny-bootstrap.js"></script>
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