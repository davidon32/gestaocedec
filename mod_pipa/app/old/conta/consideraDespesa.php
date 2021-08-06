<?php session_start();
print "<!DOCTYPE html>";
include_once PATH.'/include.php';
/************************************************************************************+
 #	Secretária  : Gabinete Militar do Governado de Minas Gerais                      #
 #	Órgão       : Coordenadoria Estadual de Defesa Civil do Estado de Minas Gerais   #
 #  Autor       : Demetrio S. Passos     											 #
 #  Criação     : 03/12/2013														 #
 #	Descrição   : Filtro para Relatório de Consideração de Despesas do pagamento de  #
 #				  Pipeiro 															 #
 +***********************************************************************************/

$_conexao = new ConexaoMysql();

$_mes = isset($_POST['mes']) ? $_POST['mes'] : ""; 
$_ano = isset($_POST['ano']) ? $_POST['ano'] : "";
$cpf = isset($_POST['txtCpf']) ? $_POST['txtCpf'] : "";  

$_funcionario = new EquipeFuncionario();

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
    <!-- TOPO /system/topo.php-->
    <?php include_once('/system/topo.php'); ?>
    <div class="container">
	<div class="container">
		
		<div class="row-fluid">

			<!-- MENU -->
			<div class="span3">
				<?php
                    include_once "mod_".$modulo.'/app/elemento/'.$modulo.'.menu.php';
                ?>
			</div>

			<!-- CORPO PAGINA  -->
			<div class="span9">
			    <legend>Impressão de Consideração de Despesa</legend>
				<form action="#" method="POST">
					<div class="span3">
						<label>Mês</label>
						<?php Funcaobase::Mes();?>
						
						<label>CPF</label><h style="color:red;" id="h01"></h>
						<div><input type="text" name="txtCpf" id="txtCpf" data-mask="999.999.999-99" / >

						<label>Ano</label>
						<input type="text" name="ano" placeholder="Ano" value="<?php print date("Y")?>" data-mask="9999" maxlength="4" >
						<br />
						<!--<label>Responsável Execução</label>
                        <?php $_funcionario->ComboFuncionario(); ?>
                        <br />-->
                        <label>Oficial Responsável</label>
                        <?php  $_funcionario->getNomeDiretoria(false); ?>
						
						<button class="btn btn-primary" type="submit">Pesquisar <i class="icon-search"></i> </button>

					</div>
				</form>
			</div>
				<?php

			     //$_SESSION['responsavel_consideracao'] = $_POST['selNomeFuncionario'];
			     $_SESSION['oficial_responsavel'] = isset($_POST['sel_nDiretoria']) ? $_POST['sel_nDiretoria'] : false;
	
	//var_dump($_mes);
	//var_dump($_POST);

    /* opçao { mes, ano } */
	if(($_mes != "") && ($_mes != "Mes") && ($_ano != "") && $cpf ==""){

		print '<div class="row-fluid">
				<div class="span3"></div>
				<div class="span9 text-center">
					<br />
					<a class="btn btn-primary" href="index.php?modulo=pipa&secao=relatorio&acao=rel_considera_desp&ano='.$_ano.'&mes='.Funcaobase::mesToNum($_mes).'">Relatório <i class="icon-list-alt"></i></a>
				</div>';
	
    /* opção : cpf, mes, ano */
    }else if(($_mes != "") && ($_mes != "Mes") && ($cpf !="") && ($_ano !="")){
       
        print '<div class="row-fluid">
                <div class="span3"></div>
                <div class="span9 text-center">
                    <br />
                    <a class="btn btn-primary" href="rel/rel.considera.despesa.php?ano='.$_ano.'&cpf='.$cpf.'&mes='.Funcaobase::mesToNum($_mes).'">Relatório <i class="icon-list-alt"></i></a>
                </div>';
        
        
	}

?>


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
	<script type="text/javascript">
	
	   function erro() {
	       
	       var cpf = $("#txtCpf").val();
	       
	       cpf = cpf.replace(/[\.-]/g, "");
	       
	       var tamanho = cpf.length;

	       if(!TestaCPF(cpf)){
	       
             $("#h01").html("Inválido");
             
            }else {
                
                $("#h01").html("");
                
            }
       }

	   if(tamanho = 11) {
	 
	       $("#txtCpf").blur(erro);
	   
	   }else {
	       
	      $("#h01").html(""); 
	       
	   }
	    
        
        </script>
	
</body>
</html>


