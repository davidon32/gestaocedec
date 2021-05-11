<?php session_start();
print "<!DOCTYPE html>";
include_once '/include.php';
/************************************************************************************+
 #	Secretária  : Gabinete Militar do Governado de Minas Gerais                      #
 #	Órgão       : Coordenadoria Estadual de Defesa Civil do Estado de Minas Gerais   #
 #  Autor       : Demetrio S. Passos     											 #
 #  Criação     : 00/00/0000														 #
 #	Descrição   :
 #
 +************************************************************************************/


$_conexao = new ConexaoMysql();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php print TITULO;?></title>
<link href="<?php print SISTEMA;?>/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="<?php print SISTEMA;?>/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
</head>
<body>
	<div class="container">
		<div class="row-fluid text-center">
			<img src="../imagem/topo_pipa.png" />
			<hr>
		</div>
		<!-- BARRA -->
	    <div class="row-fluid">
	      <div class="span6 text-left"><small><?php print "Data :".date("d/m/Y");?></small></div>
	      <div class="span6 text-right"><small><?php print "Hora :".date("H:i:s");?></small></div>
	    </div>

	    <!-- LOGOUT -->
	    <div class="row-fluid">
	      <div class="span12 text-right">
	        <a class="btn btn-primary" href="<?php print SISTEMA;?>/core/logout.php?logout=s" title="Logout do Sistema">Logout</a>
	        <p><hr>
	      </div>
	    </div>

		<div class="row-fluid">

			<!-- MENU -->
			<div class="span3">
				<?php
				    include_once "/mod_".$modulo.'/app/elemento/'.$modulo.'.menu.php';
				?>
			</div>

			<!-- CORPO PAGINA  -->
			<div class="span7">
				<legend>Pesquisa Conta Bancária</legend>
				<form action="#" method="POST" name="frm_cad_funcionario">
					
					<div class="controls controls-row">
							<input class="span9" type="text" title="Nome do Funcionario" name="txt_nome" placeholder="Digite parte do Nome do Funcionário">
					</div>
					
					<button class="btn btn-primary" type="submit" title="Pesquisar Conta bancária" name="btn_envia">Pesquisar &nbsp;&nbsp;<i class="icon-search"></i></button>
				</form>
				<br>

				<?php
					
					$_nome = isset($_POST['txt_nome']) ? $_POST['txt_nome'] : "";
					$btn_envia = isset($_POST['btn_envia']) ? true : "";
				 
				 	if($btn_envia && $_nome != "") {
				 		    
				 		$dados = EquipeFuncionario::buscaBancoFuncionario($_nome);
                        
                        print "<table class='table'>
                                <tr>
                                    <td>Nome</td>
                                    <td>Conta</td>
                                    <td>Agencia</td>
                                    <td>Tipo</td>
                                    <td>Conta Principal</td>
                                    <td>Ação</td>
                                </tr>";
                        for ($i=0; $i < count($dados); $i++) { 
                            print "<tr>
                                    <td>".$dados[$i]['nome']."</td>
                                    <td>".$dados[$i]['conta']."</td>
                                    <td>".$dados[$i]['agencia']."</td>
                                    <td>".(($dados[$i]['tipo'] == '1') ? 'C/C' : "")."</td>
                                    <td>".(($dados[$i]['principal']) == "0" ? "-" : "Sim")."</td>
                                    
                                    <td><a class='btn' href='index.php?token=".hash('sha256', md5(VERSAO)."-".time())."&ac=&modulo=equipe&secao=banco&acao=alterar&id=".$dados[$i]['id_banco']."'>Alterar</a></td>
                                    </tr>";
                        }
                        print "</table>";

				 	}

				 	?>
			</div>
			<div class="span2"></div>
			
			<!-- ESPAÇO CORPO -->
			<div class="row-fluid fdo_corpo"></div>
			
			<!-- RODAPE -->
			<div class="row-fluid">
				<div class="span12 text-center">
					<small><?php print RODAPE;?></small>
				</div>	
			</div>
		</div>
			
	<script src="<?php print SISTEMA;?>/js/jquery.js"></script>
	<script src="<?php print SISTEMA;?>/js/bootstrap.js"></script>
	<script src="<?php print SISTEMA;?>/js/jasny-bootstrap.js"></script>
	<script src="<?php print SISTEMA;?>/js/funcaobase.js"></script>
</body>
</html>