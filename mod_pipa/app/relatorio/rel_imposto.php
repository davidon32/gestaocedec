<?php $id_session = session_id();
    if(empty($id_session)) session_start();
include_once PATH.'/include.php';

?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php print TITULO;?></title>
		<link href="<?php print SISTEMA;?>/css/bootstrap.css" rel="stylesheet" media="screen">
		<link href="<?php print SISTEMA;?>/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
		<link href="<?php print SISTEMA;?>/mod_pipa/css/print_rel_imposto.css" rel="stylesheet" type="text/css" media="print"/>
		

	</head>
	<body>
		<div class="container">
			<table align="center" width="970" >
			<tr>
				<td align="center">
					<a href="../secao.php?secao=relatorio&acao=imposto" class="btn btn-primary" title="Voltar página">Voltar</a>
					<a class="btn btn-primary" href="javascript: window.print();" title="Imprimir página">Imprimir</a>
				</td>
			</tr>
		</table>


<?php

//	$_conexao = new ConexaoMysql();

	$_relatorio = new Relatorio();

	//var_dump($_POST);
	
	#@ tipo do relatorio contabilidade e normal
	$_tipo_rel = isset($_POST['tipo_rel']) ? $_POST['tipo_rel'] : null;
		
	#@ data do fechamento de rota
	$_dt_acerto = isset($_POST['dt_acerto']) ? DataMysql::dataform($_POST['dt_acerto']) : false;
	
	#@ mes em formato de numero via post
	$_mes = isset($_POST['mes']) ? FuncaoBase::mesTonum($_POST['mes']) : false;
	
	#@ tipo de relatorio 0 aberto 1 fechado
	$_tipo = isset($_POST['tp']) ? $_POST['tp'] : false;
	
	#@ resumo de relatorio 
	$_resumo = isset($_POST['resumo']) ? $_POST['resumo'] : false;
	
	#@ data Inicial
	$_dt_inicial = isset($_POST['dt_inicial']) ? DataMysql::dataForm($_POST['dt_inicial']) : "";
	
	#@ data Final
	$_dt_final = isset($_POST['dt_final']) ? DataMysql::dataForm($_POST['dt_final']) : "";
	
	#@ lote de fechamento
	$lote = isset($_POST['lote']) ? $_POST['lote'] : "";
	
	$_ano =  isset($_POST['ano']) ? $_POST['ano'] : "";
    
    /* pessoa juridica individual */
    $_individual = isset($_POST['ckIndividual']) ? $_POST['ckIndividual'] : "";


	if($_resumo == 'on'){
		
		$dados = Relatorio::resumoContas($_dt_inicial, $_dt_final);
		
		$_tot_valor = number_format($dados[0]['sum(valor)'], 2, ',', '.');
		
		$_tot_ir = number_format($dados[0]['sum(irrf)'], 2, ',', '.');
		
		$_tot_sest = number_format($dados[0]['sum(sestsenat)'], 2, ',', '.');
		
		$_tot_gfip = number_format($dados[0]['sum(gfip)'], 2, ',', '.');
		
		$_tot_inss = number_format($dados[0]['sum(inss)'], 2, ',', '.');
		
		$_tot_liquido =  number_format($dados[0]['sum(liquido)'], 2, ',', '.');
		
		
		//FuncaoBase::vd($dados);	
	
	
	?>

	<table align="center" border="1" cellspacing="0">
		<tr>
			<td align="center" colspan="6">Resumo de Pagamentos e Impostos</td>
		</tr>
	  <tr>
	    <td class="dado2">Somatório Valor Bruto</td>
	    <td class="dado2">Somatório IRRF</td>
	    <td class="dado2"> Somatório SestSenat</td>
	    <td class="dado2"> Somatório Gfip</td>
	    <td class="dado2"> Somatório INSS</td>
	    <td class="dado2"> Somatório Líqudo</td>
	  </tr>
	  <tr>
	    <td class="dado2"> <?php print $_tot_valor;?></td>
	    <td class="dado2"> <?php print $_tot_ir;?></td>
	    <td class="dado2"> <?php print $_tot_sest;?></td>
	    <td class="dado2"> <?php print $_tot_gfip;?></td>
	    <td class="dado2"> <?php print $_tot_inss;?></td>
	    <td class="dado2"> <?php print $_tot_liquido;?></td>
	  </tr>
	</table>

<?php 
	}
?>

	
	<?php 
	
	
		

		
	
	#@ modo debug	
	//FuncaoBase::vd($dados);
	
	
	# modelo normal	
	if($_tipo_rel == "0"){
		
		// mes em branco
		if($_mes == "") {
			
			print "<script type='text/javascript'>";
			print "alert('Escolha o mês do relatório !');";
			print "history.back();";
			print "</script>";
	
		} 
        
        //var_dump($_POST);

		print "<script type='text/javascript'>";
		print "window.location = 'index.php?token=".hash('sha256', md5(VERSAO)."-".time())."&ac=&modulo=pipa&secao=relatorio&acao=rel_acerto&ano=".$_ano."&mes=".$_mes."&dt=".$_dt_acerto."&lote=".$lote."';";
		print "</script>";
		
	#@ tipo do relatorio para contabilidade (manoel e vinicius)
	}elseif ($_tipo_rel == "1"){

		print "<script type='text/javascript'>";
		print "window.location = 'index.php?token=".hash('sha256', md5(VERSAO)."-".time())."&ac=&modulo=pipa&secao=relatorio&acao=rel_contabilidade&ano=".$_ano."&mes=".$_mes."';";
		print "</script>";

	#@ relatorio para dpca (cap Andre)
	}elseif ($_tipo_rel == '2'){
		
		print "<script type='text/javascript'>";
		print "window.location = 'index.php?token=".hash('sha256', md5(VERSAO)."-".time())."&ac=&modulo=pipa&secao=relatorio&acao=rel_imposto_dirf&ano=".$_ano."';";
		print "</script>";
	
	#@ relatorio paca dpca modelo 2 
	}elseif ($_tipo_rel == '3'){

		print "<script type='text/javascript'>";
		print "window.location = 'index.php?token=".hash('sha256', md5(VERSAO)."-".time())."&ac=&modulo=pipa&secao=relatorio&acao=rel_dpca2&mes=".$_mes."';";
        print "</script>";
			
	#@ relatorio DADM Sub nilton
	}elseif ($_tipo_rel == '4'){

		print "<script type='text/javascript'>";
		print "window.location = 'index.php?token=".hash('sha256', md5(VERSAO)."-".time())."&ac=&modulo=pipa&secao=relatorio&acao=rel_modelo_dadm&mes=".$_mes."&ano=".$_ano."';";
		print "</script>";
		
	#@ relatorio DADM PRESTAÇâo DE CONTAS
	}elseif ($_tipo_rel == '5'){

		print "<script type='text/javascript'>";
        print "window.location = 'index.php?token=".hash('sha256', md5(VERSAO)."-".time())."&ac=&modulo=pipa&secao=relatorio&acao=rel_dadm_prestacao_conta&ano=".$_ano."';";
        print "</script>";
    
      
     /* relatorio para montar a pasta para a dpca 3 */
	}elseif ($_tipo_rel == '6') {
	    print "<script type='text/javascript'>";
        print "window.location = 'index.php?token=".hash('sha256', md5(VERSAO)."-".time())."&ac=&modulo=pipa&secao=relatorio&acao=rel_dpca3&ano=".$_ano."&mes=".$_mes."&dt=".$_dt_acerto."&lote=".$lote."';";
        print "</script>";
	    
	
    // relatorio pessoa juridica 
    }elseif ($_tipo_rel == '7') {
        
        if($_individual == '1') {
            
            print "<script type='text/javascript'>";
            print "window.location = 'index.php?token=".hash('sha256', md5(VERSAO)."-".time())."&ac=&modulo=pipa&secao=relatorio&acao=rel_acerto_pj&ano=".$_ano."&mes=".$_mes."&dt=".$_dt_acerto."&lote=".$lote."&tp=i';";
            print "</script>";
        }else {
            print "<script type='text/javascript'>";
            print "window.location = 'index.php?token=".hash('sha256', md5(VERSAO)."-".time())."&ac=&modulo=pipa&secao=relatorio&acao=rel_acerto_pj&ano=".$_ano."&mes=".$_mes."&dt=".$_dt_acerto."&lote=".$lote."';";
            print "</script>";
        }
        
        
        
    }
	
	print '<br />';
	
?>		
	</div>
	</body>
</html>