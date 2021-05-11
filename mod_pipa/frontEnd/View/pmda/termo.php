<?php include_once 'core/include.php';
	
	$municipio = new Municipio();
	
	$compdec = new Compdec();
	
	//$id_municipio = $_SESSION['seguranca']['id_municipio'];
	
	$adm = isset($_GET['a']) ? $_GET['a'] : null;
	
	$background = '';
	
			 
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


	<style type="text/css">
	
			*{
				font-size: 12pt;
			}
	                  
           @media print {
           
           			.btnVoltar {
           				display:none;
           			}
           
           }  
	
	</style>
  </head>
  <body>
  	<table style="text-align: right;">
  		<tr>
  		<td width="50px;"></td>
  		<td align="justify" width="650px">
			<p style="text-align: justify;"><strong>&nbsp;</strong></p>
			<p style="text-align: center;" class="btnVoltar"><button class="btn" onclick="javascript:history.back();">Voltar</button></p>
			<p style="text-align: justify;">&nbsp;</p>
			<p style="text-align: justify;">&nbsp;</p>
			<p style="text-align: center;"><strong>TERMO DE COMPROMISSO</strong></p>
			<p style="text-align: justify;">Considerando o disposto no artigo 4&ordm;, inciso I, e artigo 8&ordm;, incisos XII e XIV da Lei
			 Nacional n&ordm; 12.608/2012 (Pol&iacute;tica Nacional de Prote&ccedil;&atilde;o e Defesa Civil), eu, <strong>
			 <em><u><?=$dadosPref['prefeito'];?></u></em></strong>, Carteira de Identidade n&ordm; <strong><em><u>_____________________</u></em></strong>, 
			 CPF n&ordm; <strong><em><u>________________________</u></em></strong>, Prefeito Municipal de <em><strong><u><?=$dadosPref['nome']?></u></strong>
			 </em>, inscrito no CNPJ sob o n&ordm; &shy;&shy;&shy;&shy;&shy;____________________________, com sede na <strong>
			 <em><?=$dadosPref['endereco'];?></em></strong>, bairro <strong><em><?=$dadosPref['bairro']?></em></strong>&nbsp;e 
			 CEP <strong><em><?=$dadosPref['cep']?></em></strong>, tendo em vista a necessidade de receber atendimento emergencial
			  por meio da opera&ccedil;&atilde;o de transporte e distribui&ccedil;&atilde;o de &aacute;gua pot&aacute;vel
			   (Opera&ccedil;&atilde;o TDAP), realizada pela Coordenadoria Estadual de Defesa Civil (Cedec), <strong>ASSUMO</strong>
			    durante o per&iacute;odo de realiza&ccedil;&atilde;o da Opera&ccedil;&atilde;o TDAP, O <strong>COMPROMISSO</strong> de:</p>
			<ol style="text-align: justify;">
			<li><u>apresentar</u> ao Gabinete Militar do Governador (GMG)/Cedec, o Plano Municipal de Distribui&ccedil;&atilde;o de
			 &Aacute;gua (PMDA) conforme modelo disponibilizado no s&iacute;tio eletr&ocirc;nico do GMG/Cedec;</li>
			<li><u>publicar</u> no Di&aacute;rio Oficial do Munic&iacute;pio (DOM), ou em outro meio de publicidade dos atos oficiais
			 da Prefeitura, os nomes dos agentes comunit&aacute;rios de prote&ccedil;&atilde;o e defesa civil, com a devida 
			 men&ccedil;&atilde;o da sua atua&ccedil;&atilde;o como fiscalizadores volunt&aacute;rios da entrega de &aacute;gua
			  pot&aacute;vel;</li>
			<li><u>indicar</u> um respons&aacute;vel, pertencente ao quadro de agentes da Prefeitura, para tratar de quaisquer
			 assuntos afetos a Opera&ccedil;&atilde;o TDAP, enviando a respectiva identifica&ccedil;&atilde;o e os meios para 
			 contato por escrito ao <strong>GMG/Cedec;</strong></li>
			<li><u>designar</u> servidores da Prefeitura, preferencialmente os da Coordenadoria Municipal de Prote&ccedil;&atilde;o
			 e Defesa Civil (Compdec), para instruir os moradores, acompanhar e fiscalizar a presta&ccedil;&atilde;o de servi&ccedil;o
			  juntamente com representantes das comunidades, bem como apoiar na solu&ccedil;&atilde;o dos problemas que poder&atilde;o
			   surgir;</li>
			<li>responsabilizar-me integralmente pela contrata&ccedil;&atilde;o e pagamento do pessoal que, de acordo com o 
			<strong>MUNIC&Iacute;PIO</strong>, seja necess&aacute;rio para exercer as atividades inerentes &agrave; execu&ccedil;&atilde;o
			 da Opera&ccedil;&atilde;o TDAP, inclusive pelos encargos sociais e obriga&ccedil;&otilde;es trabalhistas decorrentes,
			  bem como pelas responsabilidades advindas do ajuizamento de eventuais demandas judiciais e pelos &ocirc;nus tribut&aacute;rios
			   ou extraordin&aacute;rios;</li>
			<li><u>disponibilizar e custear</u> o fornecimento de &aacute;gua adequada e necess&aacute;ria ao abastecimento dos 
			caminh&otilde;es pipa, quando o munic&iacute;pio for o administrador do Servi&ccedil;o Aut&ocirc;nomo de &Aacute;gua e
			 Esgoto (SAAE) ou semelhante;</li>
			<li>quando o munic&iacute;pio for o administrador do SAAE ou semelhante, <u>controlar</u> atrav&eacute;s de planilha
			 disponibilizada pelo GMG/Cedec a quantidade de &aacute;gua entregue ao prestador de servi&ccedil;o contratado pelo
			  GMG/Cedec e <u>encaminh&aacute;-la</u> ao GMG/Cedec at&eacute; o quinto dia &uacute;til do m&ecirc;s subsequente;</li>
			<li><u>zelar</u> pela qualidade da &aacute;gua disponibilizada com fornecimento mensal de relat&oacute;rio de potabilidade
			 da &aacute;gua quando esta for captada diretamente de fonte n&atilde;o tratada, ou seja, quando a capta&ccedil;&atilde;o 
			 ocorrer em po&ccedil;o artesiano n&atilde;o administrado por COPASA ou COPANOR, um laudo que ateste a qualidade da &aacute;gua
			  para consumo humano, com renova&ccedil;&atilde;o mensal, sob pena de suspens&atilde;o do atendimento;</li>
			<li><u>cientificar</u> imediatamente o <strong>GMG/Cedec</strong>, no caso de constatada qualquer irregularidade na 
			presta&ccedil;&atilde;o de servi&ccedil;o de caminh&otilde;es-pipa ou modifica&ccedil;&atilde;o da localiza&ccedil;&atilde;o
			 do manancial.</li>
			<li><u>observar</u>, durante todo o per&iacute;odo das atividades da Opera&ccedil;&atilde;o TDAP, as orienta&ccedil;&otilde;es
			 emanadas pelo GMG/Cedec e a legisla&ccedil;&atilde;o pertinente ao transporte e distribui&ccedil;&atilde;o de &aacute;gua
			  pot&aacute;vel;</li>
			<li>encaminhar para o GMG/Cedec, ap&oacute;s a conclus&atilde;o do servi&ccedil;o de transporte e distribui&ccedil;&atilde;o
			 de &aacute;gua para o consumo humano definido em Ordem de Servi&ccedil;o, a &ldquo;Declara&ccedil;&atilde;o de Conformidade
			  de Presta&ccedil;&atilde;o de Servi&ccedil;o&rdquo;, conforme previsto na Resolu&ccedil;&atilde;o 03/2016 - GMG. Afirmo que
			   o documento ser&aacute; remitido por via postal (atrav&eacute;s de servi&ccedil;o de encomenda expressa), devidamente
			    assinado, em at&eacute; 24 (vinte e quatro) horas ap&oacute;s a conclus&atilde;o do atendimento determinado na Ordem 
			    de Servi&ccedil;o.</li>
			</ol>
			<p style="text-align: justify;">&nbsp;</p>
			<p style="text-align: justify;">Declaro ainda n&atilde;o estar recebendo apoio de projeto similar promovido pelo Minist&eacute;rio
			 da Integra&ccedil;&atilde;o ou Ex&eacute;rcito Brasileiro, bem como de outro &oacute;rg&atilde;o do Governo Federal ou Estadual.</p>
			<p style="text-align: justify;">&nbsp;</p>
			<p style="text-align: right;"><?=$dadosPref['nome'].", ".DataMysql::dataExtensoDocumento(date('d/m/Y'))?>. &nbsp; &nbsp; &nbsp; 
			&nbsp; &nbsp; &nbsp;</p>
			<p style="text-align: justify;">&nbsp;</p>
			<p style="text-align: center;">___________________________________<br /><strong><em><?=$dadosPref['prefeito'];?></em></strong>
			<br /><span style="font-size: 10pt;">Prefeito Municipal</p>
			<p style="text-align: justify;">&nbsp;</p>
	  	</td>
	  	</tr>

  	</table>