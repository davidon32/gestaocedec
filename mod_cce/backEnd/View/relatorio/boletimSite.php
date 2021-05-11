<?php include_once PATH.'/core/include.php';

$_usuario = new Usuario();

$_diario = new Diario();

$boletim = new Boletim();

$dados = $boletim->relatoriosite();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
<style type="text/css">

	body{	
		 background-color: #F6F6F8;
	}
	
	*{
		 color: #F00;
		 font-weight: bold
		 		 
	}
	table th{
		color: #444;
	}
	
	table, tr, td{
		background-color: #ffffff;
	}
</style>
</head>
<body>
	<br>
	<div class="container">
	<?php if(isset($_COOKIE['seguranca']['tipo'])) { ?>

		<div class="col-md-12 text-center">
			<a href="?token=<?=hash('sha256', md5(VERSAO))?>&ac=itn&modulo=cce&controller=cce&action=index"class="btn btn-success">Voltar</a>
		</div>

		<?php	}
	?>
<br>
		<!-- CORPO -->
			<div class="row-fluid fdo_corpo">
                <!-- CONTEUDO -->
				<div class="span12">
					   <table class="table table-bordered table-striped table-condensed">
					   	<thead>
					       <tr>
						   		<th>#</th>
                               <th style="text-align:center;" width="80%">Documento</th>
                               <th style="text-align:center;" width="10%">Tipo</th>
                               <th style="text-align:center;" width="10%">Tamanho</th>
                           </tr>
                           </thead>
                           <?php 
                           		foreach ($dados as $key=>$value) {
                           			
                           		$extensao = substr($value['nome'], -3, 3);
									print "<tr>";
									print "<td>".$key."</td>";
									print "<td>";
									print "<a href='anexo/boletim/".$value['nome']."' style='text-decoration:none; color:#F00;' title='Clique para fazer download do documento !' download>";
									print ($extensao == "pdf") ? "<img src='core/imagem/pdf.png' width='25'> " : "<img src='core/imagem/odt.png' width='25'>";
									print "Boletim nº ". $value['descricao']. " de ".DataMysql::dataExtensoDocumento(DataMysql::dataVisual($value['data']));
									print (!empty($value['complemento'])) ? " (<span style='font-style:italic'>".$value['complemento']."</span> )" : $value['complemento'];
									print "</a></td>";
								    print "<td>".$extensao."</td>";
									print "<td><span style='font-size:10px; color:#A4A4A4;'>".round($value['tamanho'], 2)." Kb</span></td>";
                           		}
                           ?>
					   </table>
				</div>
			</div>
	</div>    
    <script src="/js/jquery.js"></script>
    <script src="/js/bootstrap.js"></script>
    <script src="/js/jasny-bootstrap.js"></script>
</body>
</html> 