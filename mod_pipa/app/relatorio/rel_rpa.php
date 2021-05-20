<?php $id_session = session_id();
    if(empty($id_session)) session_start();
include_once PATH.'/include.php';


$_conexao = new ConexaoMysql();

$_login = new Login();

$_login->logado();

$_motorista = new Motorista();

$_calculo = new Calculo();
	
	$chave = 0;
	
	$_mod = isset($_GET['mod']) ? $_GET['mod'] : "";
	
	$_id_motorista = isset($_GET['id']) ? $_GET['id'] : "";
	
	$_placa = isset($_GET['pl']) ? $_GET['pl'] : "";
	
	$_mes = isset($_GET['mes']) ? $_GET['mes'] : "";
	
	$_num_rpa = isset($_GET['rpa']) ? $_GET['rpa'] : "";
	
	$id_motorista = isset($_GET['id_mot']) ? $_GET['id_mot']: "";

  $_nome_motorista = isset($_GET['id']) ? $_motorista->buscaMotoristaNome($_GET['id']) : "";


if($_mod != ""){
	

  #@ RPA Individual no Acerto de Contas
  if($_mod == 0) {
      
      $_volta = '../secao.php?secao=conta&acao=acertar';

      $dados = $_calculo->rpaIndividual($_num_rpa);
      
      //var_dump($dados);

      $tit = $dados[0]['motorista']."_".FuncaoBase::numTomes($_mes)."_Nr:".$_num_rpa;

  #@ RPA Lote no Relatório de RPA
	}elseif($_mod == 1) {

	  $tit = 'Defesa Civil';
    $dados = $_SESSION['rpa_lote'];
    $_volta = 'index.php?token='.hash('sha256', md5(VERSAO).date('dmY')).'&ac=&modulo=pipa&secao=conta&acao=filtro_rpa';
	
  #@ RPA Individual no Relatorio de RPA 
  }elseif($_mod == 2){
      
      $dados = $_calculo->rpaIndividual($_num_rpa);
      
      //var_dump($dados);

      $_volta = 'index.php?token='.hash('sha256', md5(VERSAO).date('dmY')).'&ac=&modulo=pipa&secao=conta&acao=filtro_rpa';

      $tit = $dados[0]['motorista']."_".FuncaoBase::numTomes($_mes)."_Nr:".$_num_rpa;    
  }

	    
}

//var_dump($_SESSION);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php print utf8_encode($tit);?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/mod_pipa/css/rpa.css" rel="stylesheet" type="text/css" />
<link href="/mod_pipa/css/rpa_print.css" rel="stylesheet" type="text/css" media="print"/>
<style type="text/css">
<!--
.style3 {
	font-size: 10px;
	text-transform: uppercase;
	font-weight: bold;
}
.style4 {text-transform: uppercase}
-->
</style>
</head>
<body bgcolor="#ffffff">
	
<?php 
	
	$_count = 0;
	
	for($chave = $chave; $chave < count($dados); $chave++){

	$tot_desconto = $dados[$chave]['irrf']+$dados[$chave]['inss']+$dados[$chave]['sestsenat'];
	
	$_liquido = round($dados[$chave]['valor'] - $tot_desconto, 2);

?>

<br />
	<div class="centro">
		<a class="btn btn-primary" href="javascript: window.print()">Imprimir</a>
	</div>	
<br />
	<div class="centro">
		<a href="<?php print $_volta; ?>">Voltar</a>
	</div>
<br />
<!-- ##########################################  1 VIA ############################################ -->

<table style="text-align: center;" border="0" cellpadding="0" cellspacing="0" width="595" align="center">
   
  <tr class="borda">
   <td class="campo1" rowspan="2" colspan="10">Recibo de Pagamento de Autônomo - RPA </td>
   <td width="14" class="coluna"></td>
   <td width="108" align="center" valign="middle" class="cpf_2">Nº Recibo/Nº Talão</td>
  </tr>
  <tr>
   <td class="coluna"></td>
   <td class="cpf_1"><?php print $dados[$chave]['id_conta'];?></td>
  </tr>
  <tr class="borda">
   <td colspan="9" class="linha"></td>
   <td width="80"></td>
   <td></td>
   <td></td>
  </tr>
  <tr>
    <td colspan="10" class="campoNome">Nome ou Razão Social da Empresa</td>
   <td rowspan="2"></td>
   <td class="cpf_2">CPF / CNPJ</span></td>
  </tr>
  <tr>
   <td class="camponome1" colspan="10">Gabinete Militar do Governador do Estado de Minas Gerais</td>
   <td class="cpf_4">18.715.565/0001-10</td>
  </tr>
  <tr>
   <td colspan="12" class="dado"><div align="justify">Recebi da empresa acima identificada, pela prestação de serviços de transporte e distribuição de água
    em caminhão pipa, a importância de <span style="font-weight:bold">R$ <?php print number_format($_liquido, 2, ',', '.'). ' '.Monetary::numberToExt($_liquido);?>.'</span>', conforme discriminado abaixo:
     referente ao mês : <span style="font-weight:bold"><?php print FuncaoBase::numTomes($dados[$chave]['mes'])."/".$dados[$chave]['ano'];?></span></div></td>
  </tr>
  <tr>
   <td colspan="12"></td>
  </tr>
  <tr>
   <td class="bordTotal">Salário Base</td>
   <td colspan="3" class="bord_botton">Taxa</td>
   <td width="100" class="bordTotal">Valor Máximo p/ Reembolso</td>
   <td width="5" rowspan="32">&nbsp;</td>
   <td colspan="6" class="quadr_1">Especificações :</td>
  </tr>
  <tr>
   <td align="center" valign="middle" class="bord_lat_bottom">
    <?php print $nrec = '-'; ?></td>
   <td colspan="3" align="center" valign="middle" class="bord_lat_bottom"><?php print $nrec; ?></td>
   <td align="center" valign="middle" class="bord_left_bot_rig"><?php print $nrec; ?></td>
   <td colspan="5" class="quadr_2">&nbsp;I-Valor do Serviço Prestado :</td>
   <td class="quadr_11" >R$ <?php print number_format($dados[$chave]['valor'], 2, ',', '.');?></td>
  </tr>
  <tr>
    <td class="linha"></td>
    <td colspan="3"></td>
    <td></td>
   <td rowspan="3" colspan="5" class="quadr_2">&nbsp;</td>
   <td rowspan="3" class="quadr_7">&nbsp;</td>
  </tr>
  <tr>
   <td colspan="5"></td>
  </tr>
  <tr>
   <td colspan="3" rowspan="2" class="bordTotal">Valor já Reembolsado Mês</td>
   <td width="25" rowspan="2" class="bord_botton">-</td>
   <td rowspan="2" class="bordTotal">Saldo</td>
  </tr>
  <tr>
    <td rowspan="2" colspan="5" class="quadr_2">&nbsp;Descontos</td>
   <td rowspan="2" class="quadr_7">&nbsp;</td>
  </tr>
  <tr>
   <td colspan="3" rowspan="2" class="bord_lat_bottom"><?php print $nrec; ?></td>
   <td width="25" rowspan="2" class="bord_lat_bottom">&nbsp;</td>
   <td class="bord_left_bot_rig" rowspan="2"><?php print $nrec; ?></td>
  </tr>
  <tr>
    <td width="137" rowspan="3" class="quadr_3">&nbsp;II - IRRF</td>
   <td colspan="4" rowspan="3" class="dado_1">R$ <?php print number_format($dados[$chave]['irrf'], 2, ',', '.'); ?></td>
   <td rowspan="3" class="quadr_7">&nbsp;</td>
  </tr>
  <tr>
   <td colspan="3" class="linha"></td>
   <td width="25"></td>
   <td class="dado"></td>
  </tr>
  
  <tr>
   <td colspan="5" rowspan="2" class="bordTotal">Carreteiro (Calculo do Valor do Reembolso</td>
  </tr>
  <tr>
   <td rowspan="2" class="quadr_3">&nbsp;III - INSS</td>
   <td colspan="4" rowspan="2" class="dado_1">R$ <?php print number_format($dados[$chave]['inss'], 2, ',', '.'); ?></td>
   <td rowspan="2" class="quadr_7">&nbsp;</td>
  </tr>
  <tr>
   <td rowspan="2" colspan="5" class="dado"><div align="justify" class="bord_left_bot_rig">Aplicar    % ao valor da mão-de-obra (11,75% do FRETE) O resultado
     corresponderá ao REEMBOLSO, respeitado como limite máximo o valor
    registrado no campo SALDO</div></td>
  </tr>
  <tr>
   <td rowspan="2" class="quadr_3">&nbsp;IV - SEST/ SENAT</td>
   <td colspan="4" rowspan="2" class="dado_1">R$ <?php print number_format($dados[$chave]['sestsenat'], 2, ',', '.'); ?></td>
   <td rowspan="2" class="quadr_7">&nbsp;</td>
  </tr>
  <tr>
   <td colspan="5" rowspan="2" class="linha"></td>
  </tr>
  <tr>
   <td rowspan="3" class="quadr_3">&nbsp;SubTotal</td>
   <td colspan="4" rowspan="3" class="dado_sub">R$ <?php print number_format($tot_desconto, 2, ',', '.'); ?></td>
   <td rowspan="3" class="quadr_7">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5" class="bordTotal">Nº de Inscrição</td>
  </tr>
  <tr>
    <td colspan="2" rowspan="2" class="bord_lat_bottom">PIS/PASEP:</td>
    <td colspan="3" rowspan="2" class="bord_left_bot_rig"><?php print $dados[$chave]['pis_pasep']; ?></td>
  </tr>
  <tr>
   <td colspan="6" rowspan="2" class="quadr_5">&nbsp;</td>
  </tr>
  <tr>
   <td colspan="2" rowspan="2" class="bord_lat_bottom">CPF:</td>
   <td colspan="3" rowspan="2" class="bord_left_bot_rig"><?php print $dados[$chave]['cpf_cnpj'];?></td>
  </tr>
  <tr>
   <td rowspan="5" colspan="5" class="quadr_9">&nbsp;Valor Líquido</td>
   <td rowspan="5" class="dado_sub_1">R$ <?php print number_format(($dados[$chave]['valor']- $tot_desconto), 2, ',', '.'); ?></td>
  </tr>
  <tr>
   <td colspan="5"></td>
  </tr>
  <tr>
   <td colspan="5" class="linha"></td>
  </tr>
  <tr>
    <td colspan="5" class="bordTotal">Documento de Identidade</td>
  </tr>
  <tr>
   <td colspan="2" rowspan="3" class="bord_lat_bottom">Número</td>
   <td colspan="3" rowspan="3" class="bord_left_bot_rig">Órgão Emissor</td>
  </tr>
  <tr>
   <td colspan="6"></td>
  </tr>
  <tr>
   <td colspan="6" rowspan="3">&nbsp;</td>
  </tr>
  <tr>
   <td class="bord_lat_bottom" colspan="2"><?php print $dados[$chave]['rg']; ?></td>
   <td class="bord_left_bot_rig" colspan="3"><?php print $dados[$chave]['orgao'] ?></td>
  </tr>
  <tr>
   <td colspan="5"></td>
  </tr>
  <tr>
   <td colspan="2" class="linha"></td>
   <td colspan="3"></td>
   <td colspan="6" rowspan="2" class="quadr_lin"><p>__________________________________________<br />
   </td>
  </tr>
  <tr>
    <td colspan="2" align="center" class="bord_c"><span style="font-weight:bold">Localidade</span>
    </td>
    <td colspan="3" align="center" class="bordTotal">Data</td>
  </tr>
  <tr>
   <td colspan="2" class="dado_bord_bot_left"><br /><?php #print 'Belo Horizonte'; ?></td>
   <td class="dado_bot_rig" colspan="3">__/___/_______<?php #print DataMysql::dataVisual($dados[0]['data']); ?></td>
   <td class="quadr_6" colspan="6"><?php print utf8_encode($dados[$chave]['motorista']); ?></td>
  </tr>
</table>
<br />
<!-- ################################################# 2ª VIA  #################################### -->

<table style="text-align: center;" border="0" cellpadding="0" cellspacing="0" width="595" align="center">
   
  <tr class="borda">
   <td class="campo1" rowspan="2" colspan="10">Recibo de Pagamento de Autônomo - RPA </td>
   <td width="14" class="coluna"></td>
   <td width="108" align="center" valign="middle" class="cpf_2">Nº Recibo/Nº Talão</td>
  </tr>
  <tr>
   <td class="coluna"></td>
   <td class="cpf_1"><?php print $dados[$chave]['id_conta'];?></td>
  </tr>
  <tr class="borda">
   <td colspan="9" class="linha"></td>
   <td width="80"></td>
   <td></td>
   <td></td>
  </tr>
  <tr>
    <td colspan="10" class="campoNome">Nome ou Razão Social da Empresa</td>
   <td rowspan="2"></td>
   <td class="cpf_2">CPF / CNPJ</span></td>
  </tr>
  <tr>
   <td class="camponome1" colspan="10">Gabinete Militar do Governador do Estado de Minas Gerais</td>
   <td class="cpf_4">18.715.565/0001-10</td>
  </tr>
  <tr>
   <td colspan="12" class="dado"><div align="justify">Recebi da empresa acima identificada, pela prestação de serviços de transporte e distribuição de água
    em caminhão pipa, a importância de <span style="font-weight:bold">R$ <?php print number_format($_liquido, 2, ',', '.'). ' '.Monetary::numberToExt($_liquido);?>.'</span>', conforme discriminado abaixo:
     referente ao mês : <span style="font-weight:bold"><?php print FuncaoBase::numTomes($dados[$chave]['mes'])."/".$dados[$chave]['ano'];?></span></div></td>
  </tr>
  <tr>
   <td colspan="12"></td>
  </tr>
  <tr>
   <td class="bordTotal">Salário Base</td>
   <td colspan="3" class="bord_botton">Taxa</td>
   <td width="100" class="bordTotal">Valor Máximo p/ Reembolso</td>
   <td width="5" rowspan="32">&nbsp;</td>
   <td colspan="6" class="quadr_1">Especificações :</td>
  </tr>
  <tr>
   <td align="center" valign="middle" class="bord_lat_bottom">
    <?php print $nrec = '-'; ?></td>
   <td colspan="3" align="center" valign="middle" class="bord_lat_bottom"><?php print $nrec; ?></td>
   <td align="center" valign="middle" class="bord_left_bot_rig"><?php print $nrec; ?></td>
   <td colspan="5" class="quadr_2">&nbsp;I-Valor do Serviço Prestado :</td>
   <td class="quadr_11" >R$ <?php print number_format($dados[$chave]['valor'], 2, ',', '.');?></td>
  </tr>
  <tr>
    <td class="linha"></td>
    <td colspan="3"></td>
    <td></td>
   <td rowspan="3" colspan="5" class="quadr_2">&nbsp;</td>
   <td rowspan="3" class="quadr_7">&nbsp;</td>
  </tr>
  <tr>
   <td colspan="5"></td>
  </tr>
  <tr>
   <td colspan="3" rowspan="2" class="bordTotal">Valor já Reembolsado Mês</td>
   <td width="25" rowspan="2" class="bord_botton">-</td>
   <td rowspan="2" class="bordTotal">Saldo</td>
  </tr>
  <tr>
    <td rowspan="2" colspan="5" class="quadr_2">&nbsp;Descontos</td>
   <td rowspan="2" class="quadr_7">&nbsp;</td>
  </tr>
  <tr>
   <td colspan="3" rowspan="2" class="bord_lat_bottom"><?php print $nrec; ?></td>
   <td width="25" rowspan="2" class="bord_lat_bottom">&nbsp;</td>
   <td class="bord_left_bot_rig" rowspan="2"><?php print $nrec; ?></td>
  </tr>
  <tr>
    <td width="137" rowspan="3" class="quadr_3">&nbsp;II - IRRF</td>
   <td colspan="4" rowspan="3" class="dado_1">R$ <?php print number_format($dados[$chave]['irrf'], 2, ',', '.'); ?></td>
   <td rowspan="3" class="quadr_7">&nbsp;</td>
  </tr>
  <tr>
   <td colspan="3" class="linha"></td>
   <td width="25"></td>
   <td class="dado"></td>
  </tr>
  
  <tr>
   <td colspan="5" rowspan="2" class="bordTotal">Carreteiro (Calculo do Valor do Reembolso</td>
  </tr>
  <tr>
   <td rowspan="2" class="quadr_3">&nbsp;III - INSS</td>
   <td colspan="4" rowspan="2" class="dado_1">R$ <?php print number_format($dados[$chave]['inss'], 2, ',', '.'); ?></td>
   <td rowspan="2" class="quadr_7">&nbsp;</td>
  </tr>
  <tr>
   <td rowspan="2" colspan="5" class="dado"><div align="justify" class="bord_left_bot_rig">Aplicar    % ao valor da mão-de-obra (11,75% do FRETE) O resultado
     corresponderá ao REEMBOLSO, respeitado como limite máximo o valor
    registrado no campo SALDO</div></td>
  </tr>
  <tr>
   <td rowspan="2" class="quadr_3">&nbsp;IV - SEST/ SENAT</td>
   <td colspan="4" rowspan="2" class="dado_1">R$ <?php print number_format($dados[$chave]['sestsenat'], 2, ',', '.'); ?></td>
   <td rowspan="2" class="quadr_7">&nbsp;</td>
  </tr>
  <tr>
   <td colspan="5" rowspan="2" class="linha"></td>
  </tr>
  <tr>
   <td rowspan="3" class="quadr_3">&nbsp;SubTotal</td>
   <td colspan="4" rowspan="3" class="dado_sub">R$ <?php print number_format($tot_desconto, 2, ',', '.'); ?></td>
   <td rowspan="3" class="quadr_7">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5" class="bordTotal">Nº de Inscrição</td>
  </tr>
  <tr>
    <td colspan="2" rowspan="2" class="bord_lat_bottom">PIS/PASEP:</td>
    <td colspan="3" rowspan="2" class="bord_left_bot_rig"><?php print $dados[$chave]['pis_pasep'] ?></td>
  </tr>
  <tr>
   <td colspan="6" rowspan="2" class="quadr_5">&nbsp;</td>
  </tr>
  <tr>
   <td colspan="2" rowspan="2" class="bord_lat_bottom">CPF:</td>
   <td colspan="3" rowspan="2" class="bord_left_bot_rig"><?php print $dados[$chave]['cpf_cnpj'];?></td>
  </tr>
  <tr>
   <td rowspan="5" colspan="5" class="quadr_9">&nbsp;Valor Líquido</td>
   <td rowspan="5" class="dado_sub_1">R$ <?php print number_format(($dados[$chave]['valor']- $tot_desconto), 2, ',', '.'); ?></td>
  </tr>
  <tr>
   <td colspan="5"></td>
  </tr>
  <tr>
   <td colspan="5" class="linha"></td>
  </tr>
  <tr>
    <td colspan="5" class="bordTotal">Documento de Identidade</td>
  </tr>
  <tr>
   <td colspan="2" rowspan="3" class="bord_lat_bottom">Número</td>
   <td colspan="3" rowspan="3" class="bord_left_bot_rig">Órgão Emissor</td>
  </tr>
  <tr>
   <td colspan="6"></td>
  </tr>
  <tr>
   <td colspan="6" rowspan="3">&nbsp;</td>
  </tr>
  <tr>
   <td class="bord_lat_bottom" colspan="2"><?php print $dados[$chave]['rg']; ?></td>
   <td class="bord_left_bot_rig" colspan="3"><?php print $dados[$chave]['orgao'] ?></td>
  </tr>
  <tr>
   <td colspan="5"></td>
  </tr>
  <tr>
   <td colspan="2" class="linha"></td>
   <td colspan="3"></td>
   <td colspan="6" rowspan="2" class="quadr_lin"><p>__________________________________________<br />
   </td>
  </tr>
  <tr>
    <td colspan="2" align="center" class="bord_c"><span style="font-weight:bold">Localidade</span>
    </td>
    <td colspan="3" align="center" class="bordTotal">Data</td>
  </tr>
  <tr>
   <td colspan="2" class="dado_bord_bot_left"><br /><?php #print 'Belo Horizonte'; ?></td>
   <td class="dado_bot_rig" colspan="3">__/___/_______<?php #print DataMysql::dataVisual($dados[0]['data']); ?></td>
   <td class="quadr_6" colspan="6"><?php print utf8_encode($dados[$chave]['motorista']); ?></td>
  </tr>
</table>

<?php

	// quebra de página
	$_count++;
	
	if(($_count == 1) && ($_mod == "1")){

		print '<div style="page-break-before: always"></div>';
		$_count = 0;
	}
	
	
	}
	
	$_SESSION['rpa_lote'] = null;
	
	?>
</body>
</html>
