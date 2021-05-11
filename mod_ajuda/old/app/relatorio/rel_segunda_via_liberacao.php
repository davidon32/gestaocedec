<?php session_start();
print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
include_once PATH.'/include.php';

/* ****************************************************************************************
 *   Orgão 		 : Coordenadoria Estadual de Defesa Civil do Estado de Minas Gerais
*	Sistema      : Sistema de Gest�o de Ajuda Humanitária
*
*	Autor        :  Demetrio Silva Passos
*	Função       :  Tela para Pagamento de Materiais Liberados
*
*******************************************************************************************/

$_conexao = new ConexaoMysql();

$_login = new Login();

$_login->Logado();

$_login->Sessao();

$_liberacao = new Liberacao();


//FuncaoBase::vd($_SESSION);
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo TITULO; ?></title>
<link href="/css/bootstrap.css" rel="stylesheet" media="screen">
	<link href="/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
</head>

<body>
    <!-- TOPO /system/topo.php-->
    <?php include_once(PATH.'/system/topo.php'); ?>
    
	<div class="container">
		
		<!-- MENU -->
		<div class="row-fluid">
			<div class="span3">
				<?php include_once PATH."/mod_".$modulo.'/app/elemento/'.$modulo.'.menu.php';?>
			</div>
			<div class="span9 fdo_corpo">
			
				<legend>2º Via Recibo Liberação</legend>
				<form action="#" method="post" name="pesquisa_recibo">

					Número Liberacao :
					<input type="text" name="numLiberacao" value="" id="" />

					<input class="btn" type="submit" name="enviar" value="Pesquisar" />

				</form>
				
				<div class="span6">
				
					<?php
	
					$envia = isset($_POST['enviar']) ? $_POST['enviar'] : "";
		
					$_numLiberacao = isset($_POST['numLiberacao']) ? $_POST['numLiberacao'] : "";
		
					if($_numLiberacao != "" && $envia == "Pesquisar"){

						$dados = $_liberacao->comprovanteLiberacao($_numLiberacao);
                        
                        if(count($dados) > 0) {
						
						print "<table class=\"table\">
								<tr>
									<td>Nº Liberação</td>
									<td>Município</td>
									<td>Situacao</td>
									<td>Ação</td>
								</tr>
		
								<tr>
									<td>".$dados['id_liberacao']."</td>
									<td>".Municipio::PegaNomeMunicipio($dados['id_municipio'])."</td>
									<td>".$_liberacao->enumSitLiberacao($dados['situacao'])."</td>
									<td><a href=\"index.php?modulo=ajuda&secao=relatorio&acao=rel_liberacao_recibo&id=".$_numLiberacao."\" title=\"Segunda Via do Recibo de Liberacao\"><i class=\"icon-print\"></i></a></td>
								</tr>";
                        }else {
                           
                           print "<table class=\"table\">"; 
                            
                        }
							
					}
					print "</table>";
	
				?>
				</div>
			</div>
		</div>
		<div class="row-fluid">
			<div class="spa12 text-center">
				<small><?php print RODAPE;?></small>
			</div>
		</div>

	</div>
	<script src="/js/jquery.js"></script>
	<script src="/js/bootstrap.js"></script>
	<script src="/js/jasny-bootstrap.js"></script>
	<script src="/js/funcaobase.js"></script>

</body>
</html>

