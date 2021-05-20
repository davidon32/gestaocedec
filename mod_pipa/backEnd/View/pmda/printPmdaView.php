<?php include_once 'core/include.php';
	include_once 'core/Model/indexModel.php';
	include_once 'mod_pipa/Model/IndexModel.php';
	$municipio = new Municipio();
	
	$compdec = new Compdec();
	
	$adm = isset($pageSession['session']['seguranca']['adm']) ? $pageSession['session']['seguranca']['adm'] : null;
	$id_pmda = isset($_GET['param']) ? $_GET['param'] : "";
	$id_municipio = isset($_GET['mun']) ? $_GET['mun'] : "";
	$background = '';
	
	
	$dadosPref = $municipio->dadosMunicipio($id_municipio);
	
	$dadosCompdec = $compdec->dadosCompdec($id_municipio);
	
	$pmda = new Pmda();
	
	$pontoCap = new PontoCap();
	
?>

<!DOCTYPE html>
<html lang="pt-Br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link href="css/bootstrap3.3.2.min.css" rel="stylesheet"/>
<link rel="stylesheet" href="js/lib/thickbox.css" rel="stylesheet"/>
<link rel="stylesheet" href="css/easy-autocomplete.css" rel="stylesheet"/>


	<style type="text/css">
	       table {
	       
	           width: 300px;
	       
	       }
	       
	       .container {
            display: table;
            }
        
          .row  {
            display: table-row;
            width: 100%
            }
        
          .cell {
            display: table-cell;
           } 
           
           .row.colspan{
           
            display: block;
           }
           
           @media print {
           
           			#btnVoltar {
           				display:none;
           			}
           
           }  
	
	</style>
  </head>
  <body>
  	<div class="container-fluid">
  	
  		<!-- CABEÇALHO -->
  		<div class="col-md-12 text-center">
  			<img alt="Logo CEDEC" src="/core/imagem/logo_novo.png">
  			<img alt="Logo CEDEC" src="/core/imagem/logo_gab.png">
  		</div>
  		<div class="col-md-3"></div>
  		<div class="col-md-3 text-right" id="btnVoltar">
  			<?php
  					
  				$voltarCompdec = '<a href="javascript:history.back();" class="btn btn-primary">Voltar</a>';
  				
  				$voltarAdm = "<a href=\"?token=".hash('sha256', md5(VERSAO).date('dmY'))."&ac=itn&modulo=pipa&controller=pipa&action=pesquisaPmda&idmun=".$id_municipio."\" class=\"btn btn-primary\">Voltar</a>";
  			
  				print isset($_GET['a']) ? $voltarAdm : $voltarCompdec;
  			
  			?>
  		</div>
  		<div class="col-md-3"></div>
  		<div class="col-md-3"></div>
  		<div class="col-md-12 text-center">
  			<h3>PMDA<br>Plano Municipal de Distribuição de Àgua Potável - <?=$dadosPref['nome'];?></h3>
  			<br>
  		</div>
  		
  		<!--  CORPO -->
  		<div class="col-md-12">
  			<table class="table table-bordered">
  				
  				<tr>	
  					<td colspan="3" style="text-align:center"><h4>Dados Prefeitura</h4></td>
  				</tr>
  				<tr>
  					<td><b>Nome Prefeito :</b> <?=$dadosPref['prefeito'];?></td>
  					<td><b>Tel Gab. :<b><?=$dadosPref['tel_pref'];?></td>
  					<td><b>Tel Celular :</b><?=$dadosPref['cel_pref'];?></td>
  					
  				</tr>
  				<tr>
  					<td colspan="3"><b>Endereço Prefeitura :</b> <?=$dadosPref['endereco'];?></td>
  				</tr>
  				<tr>
  					<td><b>Telefone Pref.:</b> <?=$dadosPref['tel_pref'];?></td>
  					<td><b>Fax :</b> <?=$dadosPref['fax'];?></td>
  					<td><b>Email :</b> <?=$dadosPref['email'];?></td>
  				</tr>
  				<tr>
  					<td><b>População Urbana :</b> <?=$dadosPref['populacao']?></td>
  					<td><b>População Rural :</b> <?=$dadosPref['pop_rural']?></td>
  					<td></td>
  				</tr>
  				<tr>
  					<td><b>Área Território:</b> <?=$dadosPref['area'];?></td>
  					<td><b><!-- Qtd Caminhões pipa pertencentes e ou contratados pelo Município :</b> <?=$dadosPref['qtd_pipa'];?>--></b></td>
  					<td></td>
  				</tr>
  			</table> 
  			
  			<!-- **************  DADOS COMPDEC ***************-->
  			<table class="table table-bordered">
  				<tr>	
  					<td colspan="5" style="text-align:center"><h4>Informações Compdec</h4></td>
  				</tr>
  				<tr>
  					<td colspan="5"><b>Endereço Compdec:</b> <?=$dadosCompdec['endereco'];?></td>
  				</tr>
  				<tr>
      				<th><b>Nome</b></th>
      				<th><b>Função</b></th>
      				<th><b>Tel. Celular</b></th>
      				<th><b>Tel. Fixo</b></th>
      				<th><b>Email</b></th>
  				</tr>
  				<?php
  				
  				  /* lista dos membros */
  					$compdec = new MembroEqCompdec();
  					$dadosCompdec = $compdec->listaMembro($id_municipio);
  					
	  					foreach ($dadosCompdec as $value) {
	  						print "<tr>";
	  						print "<td>".$value['nome']."</td>"; 
	  						print "<td>".$value['funcao']."</td>"; 
	  						print "<td>".$value['celular']."</td>"; 
	  						print "<td>".$value['telefone']."</td>"; 
	  						print "<td>".$value['email']."</td>"; 
	  						
	  					}
  				
  				?>
  			</table>
  			
  			<!-- *************** DADOS COMUNIDADES   *************** -->		
  			<table class="table table-bordered">
  				<tr>	
  					<td colspan="10" style="text-align:center"><h4>Informações sobre Comunidades</h4></td>
  				</tr>
  				<tr>
  					<th>Comunidade Atendida</th>
  					<th>Latitude</th>
  					<th>Longitude</th>
  					<th>Ponto Captação</th>
  					<th>Lat.Ponto Cap.</th>
  					<th>Long.Ponto Cap.</th>
  					<th>Trecho Pav.(Km)</th>
  					<th>Trecho N.Pav.(Km)</th>
  					<th>Distância. Tot.(Km)</th>
  					<th>População Atend.</th>
  				</tr>
  				
  				<?php
                                
                                $dataCriacao = $pmda->dadosPmda($id_pmda); 
                                
  				/* lista de comunidades do Pmda*/
                                if(Pmda::pmdaLegado($dataCriacao['data'])){
                                    $dadosComunidade = $pmda->listaComunidadePmda($id_pmda);
                                    //var_dump($dadosComunidade);
                                }else {
                                    $dadosComunidade = $pmda->listaComunidadePmdaLegado($id_pmda);    
                                }
;
  				$totTrechoPav = 0;
  				$totTrechoNPav = 0;
  				$totDistancia = 0;
  				$totPopAt = 0;
  					
  				foreach ($dadosComunidade as $value) {

  					$totTrechoPav += $value['trecho_pav'];
  					$totTrechoNPav += $value['trecho_n_pav'];
  					$totDistancia += ($value['trecho_n_pav']+$value['trecho_pav']);
  					$totPopAt += $value['pop_atendida'];
  					
  					print "<tr>";
  					print "<td>".$value['comunidade']."</td>";
  					print "<td>".$value['latitude']."</td>";
  					print "<td>".$value['longitude']."</td>";
  					print "<td>".$value['nome']." / ".$pontoCap->enumTipoCap($value['tipo'])."</td>";
  					print "<td>".$value['lat_ponto']."</td>";
  					print "<td>".$value['long_ponto']."</td>";
  					print "<td>".$value['trecho_pav']."</td>";
  					print "<td>".$value['trecho_n_pav']."</td>";
  					print "<td>".($value['trecho_n_pav']+$value['trecho_pav'])."</td>";
  					print "<td>".$value['pop_atendida']."</td>";
  				}
  				
  				print "<tr><td style='font-weight:bold;' colspan='6'>Total Comunidades:</td>";
				print "<td style='font-weight:bold;'>Tot. Trecho Pavimentado (km):</td>";
				print "<td style='font-weight:bold;'>Tot. Trecho Não Pavimentado (km):</td>";
				print "<td style='font-weight:bold;'>Tot. Distancia (km):</td>";
				print "<td style='font-weight:bold;'>Tot. População Atendida:</td>";
				print "</tr>";
				print "<tr><td style='font-weight:bold;' colspan='6'>".count($dadosComunidade)."</td>";
				print "<td style='font-weight:bold;'>".$totTrechoPav."</td>";
				print "<td style='font-weight:bold;'>".$totTrechoNPav."</td>";
				print "<td style='font-weight:bold;'>".$totDistancia."</td>";
				print "<td style='font-weight:bold;'>".$totPopAt."</td>";
				print "</tr>";
  				
  				?>
  			
  			</table>
  			
  			<!-- ****************** DADOS REPRESENTANTE ************** -->
  			
  			<?php 
  			
  			   $dadosRep = $pmda->listaImpressaoPmda($id_pmda);

  			?>
  			
  			<table class="table table-bordered">
  			
  				<tr>	
  					<td colspan="4" style="text-align:center"><h4>Informações sobre Representantes da Comunidades</h4></td>
  				</tr>
  				<tr>
  					<th>Comunidade</th>
  					<th>Nome Representante</th>
  					<th>Telefone / CPF</th>
  				</tr>
  				
  				<?php foreach ($dadosRep as $key => $value) {
  					
  					if(($key % 3) == 0 ){
  						
		  				print "<tr>
		  						  <td rowspan=\"4\" style=\"vertical-align: middle; text-align: center;border-bottom: solid;border-width: 2px;\">".$value['comunidade']."</td>
		  					  </tr>";
  					}
  						
  						print "<tr>
		  							<td><i>".$value['nome']."</i></td>
		  							<td><i>".$value['tel']."</i> &nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;<i>".$value['cpf']."</i></td>
		  						</tr>";

  				}
  				
  					$dadosPmda = $pmda->dadosPmda($id_pmda);
	  				?>
	  				
	  			</table>
	  			<table class="table table-bordered">
	  				
	  			<tr>
	  				<td colspan="4" style="text-align:center"><h4>Ações de Resposta no Enfrentamento da Seca</h4></b></td>
	  			</tr>
	  			<tr>
	  				<td colspan="4"><b>Acoes de Resposta:</b> <br><?=$dadosPmda['acoes'];?></td>
	  			</tr>
	  			<tr>
	  				<td><b>População atendida pelo próprio Município:</b> <?=$dadosPmda['pop_at_municipio'];?></td>
	  				<td><b>Quantidade caminhões pipa pertencentes e ou contratados	pelo município: </b><?=$dadosPmda['qtd_caminhao'];?></td>
	  			</tr>	
  			</table>
  			
  		</div>
  		
  		<!-- ROdape -->
  		<div class="col-md-12 text-center">
			  	Prefeitura Municipal de <?php print $dadosPref['nome']. ", ".DataMysql::dataExtensoDocumento(date('d/m/Y'));?>.
			  	<br><br><br><br>
			  	<hr>
  		</div>
  		
  		<div class="col-md-12">
  				<p style="text-align:center;"><h4>Notas / Comentários </h4></p>
			  	<?php
			  		
			  		$coment = $pmda->listaComentario($id_pmda);
			  		
			  		foreach ($coment as $value) {
			  			print $value['texto']."<br>";
			  		}
			  		
			  	?>
  		<hr>
  		</div>
  		<div class="col-md-12">
  			<p style="text-align:center;">Anexos</p>
  		</div>
  		
  		<?php $anexo = new AnexoPmda(); 
  		
  		$listAnexo = $anexo->listaAnexo($id_pmda);
  		
  		foreach ($listAnexo as $value) {
  			
			  $arquivo = $pmda->previewAnexo($value['id']);
			  
			  if($arquivo['existe'] != false){
				$extensao = substr($arquivo['file'], -3);
				if($extensao != "pdf" || $extensao != "PDF"){
				
				print "<div class='col-md-12 text-center'><img style='width:900px;' src='anexo/".$arquivo['file']."'><br></div>";
			  }
  			}
  			//print "<iframe src=\"".$pmda->previewAnexo($value['id'])."\"&embedded=true\" width=\"700\" height=\"780\" style=\"border: none;\"></iframe>";
  		} 
  		?>
  		<div class="col-md-12 text-center">
  			<span><?php include_once('ex/rodape.php');?></span>
  		</div>
  	</div>
  	
  	