<?php include_once 'core/include.php';
	
	$municipio = new Municipio();
	
	$compdec = new Compdec();
	
	//$id_municipio = $_SESSION['seguranca']['id_municipio'];
	
	$adm = isset($_GET['a']) ? $_GET['a'] : null;
			 
		$id_pmda = isset($_GET['param']) ? $_GET['param'] : "";
	
		$id_municipio = isset($_GET['mun']) ? $_GET['mun'] : "";
		
	$dadosPref = $municipio->dadosMunicipio($id_municipio);
	
	$dadosCompdec = $compdec->dadosCompdec($id_municipio);
	
	
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

  		<div class="col-md-12 text-center" id="btnVoltar">
  			<?php
  			
  				$voltarCompdec = '<a href="javascript:history.back();" class="btn btn-primary">Voltar</a>';
  				
  				$voltarAdm = '<a href="index.php?modulo=pipa&secao=pmda&acao=pesquisaPmda" class="btn btn-primary">Voltar</a>';
  			
  				print isset($_GET['a']) ? $voltarAdm : $voltarCompdec;
  			
  			?>
  		</div>
  		<div class="col-md-12 text-center">
  			
  		</div>
  		
  		<!--  CORPO -->
  		<div class="col-md-3">
  		</div>
  		<div class="col-md-6">
  		
	  		<p style="line-height: normal; tab-stops: 372.0pt;">&nbsp;</p>
	<p style="line-height: normal; tab-stops: 372.0pt;">&nbsp;</p>
	<p style="line-height: normal; tab-stops: 372.0pt;">&nbsp;</p>
	<p style="line-height: normal; tab-stops: 372.0pt; text-align: center;"><strong><em><u><span style="font-family: 'Arial','sans-serif'; color: red;">MODELO</span></u></em></strong><strong><em><span style="font-family: 'Arial','sans-serif'; color: red;"> <u>DE</u> <u>DECLARA&Ccedil;&Atilde;O COM COBRANCA DE ISS</u></span></em></strong></p>
	<p style="text-align: justify; line-height: normal; tab-stops: 68.0pt 217.0pt 260.0pt decimal 416.0pt;"><strong><em><span style="font-family: 'Arial','sans-serif';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></em></strong></p>
	<p style="margin-top: 6.0pt; tab-stops: 68.0pt 217.0pt 260.0pt decimal 416.0pt;"><em><span style="font-size: 12.0pt; font-family: 'Arial','sans-serif';">&nbsp;</span></em></p>
	<p style="text-align: justify; line-height: normal; margin: 12.0pt 0cm .0001pt 0cm;"><span style="font-family: 'Arial','sans-serif';">&nbsp;</span></p>
	<p style="text-align: justify; line-height: 200%; margin: 12.0pt 0cm .0001pt 0cm;"><span style="line-height: 200%; font-family: 'Arial','sans-serif';">Declaro, para os devidos fins, que a al&iacute;quota do ISSQN OU ISS relativa a servi&ccedil;os de transporte de &aacute;gua prestados no munic&iacute;pio de <strong><u><?=$dadosPref['nome'];?></u></strong>, conforme C&oacute;digo Tribut&aacute;rio Municipal, Lei n&ordm; ______________&nbsp; &eacute; de .........% (______________________ por cento), e a responsabilidade do <u>pagamento</u> &eacute; :<br><br> <p style='color:red; font-weight: bold;'>Marcar apenas uma opção.</p> <br>(&nbsp;&nbsp;&nbsp;&nbsp;) <b>Prestador / Pipeiro.</b><br><br> (&nbsp;&nbsp;&nbsp;&nbsp;) <b>Contratante / CEDEC</b>.</span></p>
	<p style="margin-top: 12.0pt; text-align: center; line-height: normal; tab-stops: 68.0pt 288.0pt 329.0pt decimal 441.0pt;"><span style="font-family: 'Arial','sans-serif';">&nbsp;</span></p>
	<p style="margin-top: 12.0pt; text-align: center; line-height: normal; tab-stops: 68.0pt 288.0pt 329.0pt decimal 441.0pt;"><span style="font-family: 'Arial','sans-serif';">&nbsp;</span></p>
	<p style="margin-top: 12.0pt; text-align: center; line-height: normal; tab-stops: 68.0pt 288.0pt 329.0pt decimal 441.0pt;"><span style="font-family: 'Arial','sans-serif';">Prefeitura Municipal de, <strong><u><?=$dadosPref['nome'];?></u></strong>, <?=DataMysql::dataExtensoDocumento(date('d/m/Y'));?></span></p>
	<p style="text-align: justify; line-height: 200%; margin: 12.0pt 0cm .0001pt 0cm;"><span style="line-height: 200%; font-family: 'Arial','sans-serif';">&nbsp;</span></p>
	<p style="text-align: justify; line-height: 200%; margin: 12.0pt 0cm .0001pt 0cm;"><span style="line-height: 200%; font-family: 'Arial','sans-serif';">&nbsp;</span></p>
	<p style="text-align: justify; line-height: 200%; margin: 12.0pt 0cm .0001pt 0cm;"><span style="line-height: 200%; font-family: 'Arial','sans-serif';">&nbsp;</span></p>
	<p style="margin-top: 12.0pt; line-height: normal; tab-stops: 68.0pt 288.0pt 329.0pt decimal 441.0pt; text-align: center"><strong><u><span style="font-family: 'Arial','sans-serif';"><?=$dadosPref['prefeito'];?><br /> </span></u></strong><span style="font-family: 'Arial','sans-serif';">Prefeito Municipal</span></p>
	<p style="margin-top: 12.0pt; line-height: normal; tab-stops: 68.0pt 288.0pt 329.0pt decimal 441.0pt;"><span style="font-family: 'Arial','sans-serif';">&nbsp;</span></p>
	<p style="text-align: justify; line-height: 200%; margin: 12.0pt 0cm .0001pt 0cm;">&nbsp;</p>
	<p style="margin-top: 12.0pt; text-align: justify; line-height: normal; tab-stops: 68.0pt 288.0pt 329.0pt decimal 441.0pt;"><span style="font-family: 'Arial','sans-serif';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></p>
	<p style="margin-top: 12.0pt; text-align: justify; line-height: normal; tab-stops: 68.0pt 288.0pt 329.0pt decimal 441.0pt;"><span style="font-family: 'Arial','sans-serif';">&nbsp;</span></p>
	<p style="margin-top: 12.0pt; text-align: justify; line-height: normal; tab-stops: 68.0pt 288.0pt 329.0pt decimal 441.0pt;"><span style="font-family: 'Arial','sans-serif';">&nbsp;</span></p>
	<p style="margin-top: 12.0pt; text-align: justify; line-height: normal; tab-stops: 68.0pt 288.0pt 329.0pt decimal 441.0pt;"><span style="font-family: 'Arial','sans-serif';">&nbsp;</span></p>
	<p style="margin-top: 12.0pt; text-align: justify; line-height: normal; tab-stops: 68.0pt 288.0pt 329.0pt decimal 441.0pt;"><span style="font-family: 'Arial','sans-serif';">&nbsp;</span></p>
	<p style="text-align: justify; line-height: normal; tab-stops: 68.0pt 217.0pt 260.0pt decimal 416.0pt;"><strong><em><span style="font-family: 'Arial','sans-serif';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></em></strong></p>
	<p style="text-align: justify; text-indent: 3.0cm; line-height: normal; tab-stops: 68.0pt 217.0pt 260.0pt decimal 416.0pt;"><em><span style="font-family: 'Arial','sans-serif';">&nbsp;</span></em></p>
	<p style="line-height: normal; tab-stops: 372.0pt;"><strong><em><u><span style="font-family: 'Arial','sans-serif'; color: red;">MODELO</span></u></em></strong><strong><em><span style="font-family: 'Arial','sans-serif'; color: red;"> <u>DE</u> <u>DECLARA&Ccedil;&Atilde;O SEM COBRANCA DE ISS</u></span></em></strong></p>
	<p style="margin-top: 6.0pt; tab-stops: 68.0pt 217.0pt 260.0pt decimal 416.0pt;"><em><span style="font-size: 12.0pt; font-family: 'Arial','sans-serif';">&nbsp;</span></em></p>
	<p style="margin-top: 6.0pt; tab-stops: 68.0pt 217.0pt 260.0pt decimal 416.0pt;"><em><span style="font-size: 12.0pt; font-family: 'Arial','sans-serif';">&nbsp;</span></em></p>
	<p style="margin-top: 12.0pt; text-align: justify; text-indent: 63.8pt; line-height: 200%; tab-stops: 68.0pt 288.0pt 329.0pt decimal 441.0pt;"><span style="line-height: 200%; font-family: 'Arial','sans-serif';">Declaro, para os devidos fins, que a n&atilde;o h&aacute; previs&atilde;o de cobran&ccedil;a de al&iacute;quota do ISSQN OU ISS relativa a servi&ccedil;os de transporte de &aacute;gua prestados no munic&iacute;pio de <strong><u><?=$dadosPref['nome'];?></u></strong> conforme C&oacute;digo Tribut&aacute;rio Municipal, Lei n&ordm; ____________________.&nbsp; </span></p>
	<p style="margin-top: 12.0pt; text-align: justify; line-height: 200%; tab-stops: 68.0pt 288.0pt 329.0pt decimal 441.0pt;"><span style="line-height: 200%; font-family: 'Arial','sans-serif';">&nbsp;</span></p>
	<p style="margin-top: 12.0pt; text-align: justify; line-height: normal; tab-stops: 68.0pt 288.0pt 329.0pt decimal 441.0pt;"><span style="font-family: 'Arial','sans-serif';">&nbsp;</span></p>
	<p style="margin-top: 12.0pt; text-align: center; line-height: normal; tab-stops: 68.0pt 288.0pt 329.0pt decimal 441.0pt;"><span style="font-family: 'Arial','sans-serif';">Prefeitura Municipal de, <strong><u><?=$dadosPref['nome'];?></u></strong>, <?=DataMysql::dataExtensoDocumento(date('d/m/Y'));?>.</span></p>
	<p style="margin-top: 12.0pt; line-height: normal; tab-stops: 68.0pt 288.0pt 329.0pt decimal 441.0pt;"><span style="font-family: 'Arial','sans-serif';">&nbsp;</span></p>
	<p style="margin-top: 12.0pt; line-height: normal; tab-stops: 68.0pt 288.0pt 329.0pt decimal 441.0pt;"><span style="font-family: 'Arial','sans-serif';">&nbsp;</span></p>
	<p style="margin-top: 12.0pt; line-height: normal; tab-stops: 68.0pt 288.0pt 329.0pt decimal 441.0pt;"><span style="font-family: 'Arial','sans-serif';">&nbsp;</span></p>
	<p style="margin-top: 12.0pt; line-height: normal; tab-stops: 68.0pt 288.0pt 329.0pt decimal 441.0pt; text-align:center;"><strong><u><span style="font-family: 'Arial','sans-serif';">Nome<br /> </span></u></strong><span style="font-family: 'Arial','sans-serif';"><?=$dadosPref['prefeito'];?></span></p>
	<p style="margin-top: 12.0pt; line-height: normal; tab-stops: 68.0pt 288.0pt 329.0pt decimal 441.0pt;"><span style="font-family: 'Arial','sans-serif';">&nbsp;</span></p>
	<p><span style="font-size: 12.0pt;">&nbsp;</span></p>
	</div>
	<div class="col-md-3"></div>
  		
  		<!-- ROdape -->
  		<div class="col-md-12 text-center">
			  	
  		</div>
  		<div class="col-md-12 text-center">
  			<span><?php include_once('ex/rodape.php');?></span>
  		</div>
  	</div>