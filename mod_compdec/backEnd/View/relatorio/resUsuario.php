<?php include_once PATH.'/core/include.php';


    $usuExterno = new LoginExterno();
    
    $dados = $usuExterno->dadosUsu();
    
    $totAtivo = 0;
    
    foreach ($dados as $value) {
    	if($value['situacao'] == "ATIVADO"){
    		$totAtivo++;
    	}
    }
    
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo TITULO; ?></title>
<link href="/css/bootstrap.css" rel="stylesheet" >
<link href="/css/bootstrap-responsive.css" rel="stylesheet" >
<style>
 
</style>
</head>
<body>
    <div class="container">
    	<br><br>
    	<div class="span12 text-center">
	    	<h4>Resumo Atividades Usuários (COMPDEC)</h4>
		</div>
    	<table class="table table-condensed table-bordered tblcedec">
    		<tr>
    			<th colspan="2"><span>Relatório Usuarios Compdec</span></th>
    			
    		</tr>
    		<tr>
    			<td>Total Usuários Ativos</td>
    			<td><?=$totAtivo;?></td>
    		</tr>
    	</table>
    	<table class="table table-condensed table-bordered tblcedec">
    		<tr>
    			<th colspan="3"><span>Ultima atividade Usuários</span></th>
    			
    		</tr>
    		<tr>
    			<td>Município</td>
    			<td>Usuário</td>
    			<td>Data Acesso</td>
    		</tr>
    		<?php 
    		
    			foreach ($dados as $value) {
    				if(!empty($value['acesso'])){
    					
    					print "<td>".$value['nome']."</td>";
    					print "<td>".$value['usuario']." / ".$value['email_rec']."</td>";
    					print "<td>".DataMysql::dataCompletaVisual($value['acesso'])."</td>";
    					
    				}
    			}
    		
    		?>
    	</table>
    	
		
		
		
			            
	</div>
    	<div class="span12 text-center">
    	<span><a href="?modulo=compdec&secao=menu" class="btn btn-primary">Voltar</a></span>
		</div>
	
</body>
</html>