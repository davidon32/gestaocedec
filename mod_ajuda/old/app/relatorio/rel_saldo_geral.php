<?php session_start();
	include_once PATH.'/include.php';

	$_conexao = new ConexaoMysql();

	$_login = new Login();

	$_login->logado();
	
	$_login->Sessao();
	
/* ****************************************************************************************
*   Org�o Gestor : Coordenadoria Estadual de Defesa Civil do Estado de Minas Gerais
*	Sistema      : Sistema de Gest�o de Ajuda Humanit�ria
*
*	Autor        :  Demetrio Silva Passos
*	Fun��o       :  Tela de consulta de Saldo Geral dos Dep�sitos
*
*******************************************************************************************/
		
	$saldo = new ControleSaldo();
	

?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php echo TITULO; ?></title>
		<link href="/css/bootstrap.css" rel="stylesheet">
		<link href="/css/bootstrap-responsive.css" rel="stylesheet">
		<style type="text/css">

			@media print {
			    
			    *{
			        
			        margin: 0;
                    padding: 0;
			    }
			    
			    table tr th {
			        
			        font-size: 9px;
  
			    }
			    
			    table tr td {
                    
                    font-size: 9px; 
                    white-space: nowrap;
                    
                    
                }

				.imprimir{
					display: none;
			 

				}
				
				img {
				    width: 50%;
				}

			}

		</style>
</head>
<body>
	
	    <div class="span12 text-center imprimir"><a class='btn btn-primary' href='index.php?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=&modulo=ajuda&secao=menu'>Voltar</a></div>
		
			<legend>Posicao Geral dos Depositos</lagend>
			
						<?php $saldo->VisualizarSaldoGeral();?>
					

		<div class="span12 text-center imprimir">
			<?php
					FuncaoBase::Imprimir();
			 	?>
		</div>



<script src="/js/jquery.js"></script>
<script src="/js/bootstrap.js"></script>
<script src="/js/jasny-bootstrap.js"></script>
<script src="/js/funcaobase.js"></script>
</body>
</html>

