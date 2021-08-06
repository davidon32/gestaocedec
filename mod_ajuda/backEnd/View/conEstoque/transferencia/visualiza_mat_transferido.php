<?php session_start();
include_once PATH.'/include.php';

$_conexao = new ConexaoMysql();

$_login = new Login();

$_login->logado();

?>
<html>
<title><?php print TITULO; ?></title>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
</head>
<body>
	<table border="0" id="" class="" cellspacing="0" cellpadding="0" align="center">
  
  <tr>
    <td valign="top" class="">
    	<?php 

		#@ id deposito Destino
		$_id_destino = isset($_GET['dest']) ? $_GET['dest'] : "";

		#@ id produto
		$_id_produto = isset($_GET['mat'])   ? $_GET['mat'] : "";
        
        #@ id Transferencia
        $idTransferencia = isset($_GET['id'])   ? $_GET['id'] : "";
    	
    	$_opcao = isset($_GET['tp']) ? $_GET['tp'] : "";
    	
		$_dt_inicial = false;

		$_dt_final = false;



	    	$_dados = RelatorioAju::RelatorioMaterialTransf($_id_produto, $_id_destino, $_dt_inicial, $_dt_final);

	    	//var_dump($_dados);

	    	print '<table style="width:500px" border="0" align="center">
						<tr>
							<td colspan="4" class="titulo"><legend>Informa&ccedil;&otilde;es Material em Tr&acirc;nsito</legend></td>
						</tr>
						<tr>
                            <td colspan="4" class="titulo"><legend>Nr Transferencia : '.$idTransferencia.'</legend></td>
                        </tr>
						<tr>
							<td class="titulo">
								<label>Origem</label>
							</td>
							<td>
							</td>
							<td align="center">
								<label>Destino</label>
							</td>
							<td rowspan="8"><!--<a href="../core/valida.cancela.transito.php?id=&idD=&qtd=&idP=" onclick="return confirm(\'Confirmar o Cancelamento?\')";>Cancelar</a>--></td>
						</tr>
						<tr>
							<td>
								
							</td>
							<td>
							</td>
							<td>
								'.Deposito::PegaNomeDeposito($_dados[0]['id_dep_destino']).'
							</td>
						</tr>
						<tr>
							<td class="titulo">
								Saída
							</td>
							<td>
							</td>
							<td class="titulo">
								Prev. Chegada
							</td>
						</tr>	
						<tr>
							<td>
								'.DataMysql::extraiData($_dados[0]['dt_saida']).'

							</td>
							<td>
							</td>
							<td>
								'.DataMysql::extraiData($_dados[0]['dt_saida']).'
							</td>
						</tr>
														
						<tr>
							<td>
								'.DataMysql::extraiHora($_dados[0]['dt_saida']).'	
							</td>
							<td>
							</td>
							<td>
								'.DataMysql::extraiHora($_dados[0]['dt_saida']).'
							</td>
						</tr>
						<tr><td colspan="4"><hr><br /></td></tr>';

	    	for ($i=0; $i < count($_dados) ; $i++) { 

	    		print '<tr>
							<td class="titulo">
								Produto
							</td>
							<td>
							</td>
							<td class="titulo">
								Quantidade
							</td>
						</tr>	
						<tr>
							<td>
								'.Produto::PegaNomeProduto($_dados[$i]['id_produto']).'
							</td>
							<td>
							</td>
							<td>
								'.$_dados[$i]['quantidade'].'
							</td>
						</tr>
						<tr>
							<td colspan="4"><hr></td>
						</tr>';
	    	}

		?>
    
    </td>
  </tr>
  <tr>
  	<td align="center">
  		
  		<?php
  	
  			if($_opcao == 'rel'){
  				
  				
  				FuncaoBase::vifs('volta').'<br>';
  				
  				FuncaoBase::vifs('imprimir');
  				
  	 		}else {
  	 					
  	 			
  	 		}
  	 		
  	 	?>
  	 </td>
  </tr>
</table>
<script src="/js/jquery.js"></script>
<script src="/js/bootstrap.js"></script>
<script src="/js/jasny-bootstrap.js"></script>
<script src="/js/funcaobase.js"></script>
		
	
	

</body>
</html>
