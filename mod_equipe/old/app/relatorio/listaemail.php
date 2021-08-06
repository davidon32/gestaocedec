<?php session_start();
print "<!DOCTYPE html>";
include_once PATH.'/include.php';

$_conexao = new ConexaoMysql();

$_login = new Login();

$_login->logado();

$_funcionario = new EquipeFuncionario();

$_dados = $_funcionario->ListagemEmail();

?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo TITULO; ?></title>
	<link href="<?php print SISTEMA; ?>/css/bootstrap.css" rel="stylesheet">
	<link href="<?php print SISTEMA; ?>/css/bootstrap-responsive.css" rel="stylesheet">
	<style type="text/css">
		@media print {
		    
		    *{
		        
		        font-size: 9px;
		    }

			.imprimir {

				display: none;
			}

		}

	</style>
</head>
<body>
	<div class="container">
		<div class="span12 text-center imprimir"><br /><?php FuncaoBase::voltar(); ?></div>
		<div class="span12 text-center"><br />
			<legend>Lista de Email de Funcionarios</legend>
		</div>
		<div class="span12">
		    <table class="table table-condensed">
		        <tr>
		            <th>Num.Pol/Masp</th>
		            <th>Nome</th>
		            <th>Seção</th>
		            <th>email</th>
		            <th>email2</th>
		        </tr>
		        
		        <?php 
		        
		          for ($i=0; $i < count($_dados); $i++) { 
					  
                      print "<tr><td>".$_dados[$i]['num_masp']."</td>
                                 <td>".$_dados[$i]['posto']." ".utf8_encode($_dados[$i]['nome'])."</td>
                                <td>".$_dados[$i]['secao']."</td>
                                <td>".$_dados[$i]['email']."</td>
                                <td>".$_dados[$i]['email2']."</td>
                      
                      </tr>";
                      
				  }
		        
		        
		        ?>
		        
		        
		    </table>

		
		</div>

		
	</div>

		<script src="<?php print SISTEMA; ?>/js/jquery.js"></script>
		<script src="<?php print SISTEMA; ?>/js/bootstrap.js"></script>
		<script src="<?php print SISTEMA; ?>/js/jasny-bootstrap.js"></script>
	</body>
	</html>
