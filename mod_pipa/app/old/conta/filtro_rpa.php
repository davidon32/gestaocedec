<?php $id_session = session_id();
    if(empty($id_session)) session_start();
	print "<!DOCTYPE html>";
	include_once PATH.'/include.php';

//$_conexao = new ConexaoMysql();

$_calculo = new Calculo();

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php print TITULO;?></title>
<link href="/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
</head>
<body>
    <!-- TOPO /system/topo.php-->
    <?php include_once(SISTEMA.'/system/topo.php'); ?>
	<div class="container">
		
		<div class="row-fluid">
			<div class="span3">
                <?php
                    include_once "mod_".$modulo.'/app/elemento/'.$modulo.'.menu.php';
                ?>
            </div>
			<div class="span9">
				<legend>Impressão de RPA</legend>
			</div>
			<div class="span4">
				<form action="#" method="POST" id="frmFiltroRpa">

					<label>Mes</label>
					<?php
						FuncaoBase::mes();
					?>
					<label>&nbsp;Ano</label>
					<input type="text" name="ano" data-mask="9999" value="<?php print date('Y');?>" maxlength="4">
						
					<label>CPF</label>
					<input type="text" name="cpf" id="cpf" data-mask="999.999.999-99" size="40" />

					<label>Placa</label>
					<input type="text" name="txt_placa" id="txt_placa" data-mask="aaa-9999" size="40" />

					<label>Lista</label>
					<textarea class="field" rows="5" name="txtLista" id="txtLista"></textarea>


			</div>
			<div class="span3">
				<table class="table">
					<tr><td>Individual</td>
						<td><input type="radio" name="rel" value="0" checked="checked"></td>
					</tr>
					<tr><td>Geral</td>
						<td><input type="radio" name="rel" value="1"></td>
					</tr>
					<tr><td>PDF Geral</td>
						<td><input type="radio" name="rel" value="2"></td>
					</tr>
					<tr><td>Outro</td>
						<td><input type="radio" name="rel" value="3" onclick="javascript:list();"></td>
					</tr>

				</table>
							
			</div>

		</div>
		<div class="row-fluid">
			<div class="span3">
			</div>
			<div class="span9">
				<input class="btn btn-primary" type="submit" name="enviar" id="enviar" value="Pesquisar" />
			</div>
		</div>
				
		</form>
	

	<?php

	$_cpf = isset($_POST['cpf']) ? $_POST['cpf'] : false;

	$_mes = isset($_POST['mes']) ? $_POST['mes'] : false;

	$_tipo = isset($_POST['rel']) ? $_POST['rel'] : false;
	
	$_ano = isset($_POST['ano']) ? $_POST['ano'] : false;
	
	$_lista = isset($_POST['lista']) ? $_POST['lista'] : false;

	$_enviar = isset($_POST['enviar']) ? $_POST['enviar'] : "";

	$_placa = isset($_POST['txt_placa']) ? $_POST['txt_placa'] : "";

	//FuncaoBase::vd($_enviar);

	//FuncaoBase::vd($_cpf);

	//FuncaoBase::vd($_tipo);

	//FuncaoBase::vd($_mes);

	//var_dump($_POST);

	if($_enviar != ""){

        $dados = array();

		/* rpa individual */
		if ($_tipo == 0){
			    
			if($_cpf != "" && $_placa == "") {    

			 $dados = $_calculo->relRpa($_cpf, FuncaoBase::mesTonum($_mes), $_tipo, $_ano);
            
            }else if($_placa != "" && $_cpf == "") {
                
                $dados = $_calculo->relRpa(false, FuncaoBase::mesTonum($_mes), $_tipo, $_ano, $_placa);
                
            }

			//var_dump($dados);
            
                if(!empty($dados)){
    
        			print '<div class="row-fluid">
        			         <div class="span3">
        			             </div><div class="span9">
        			                 <table class="table">
        					           <br />
        					               <tr>
        					                   <td>Motorista</td>
        					                   <td>CPF</td>
        						              <td>Placa</td>
        						              <td>Valor R$</td>
        						              <td>2 via</td>
        					               </tr>';
        
        			
        				
        					
        				print '<tr>
        					    <td>'.utf8_encode($dados[0]['motorista']).'</td>
        					    <td>'.$dados[0]['cpf_cnpj'].'</td>
        						<td>'.$dados[0]['placa'].'</td>
        						<td>R$ '.$dados[0]['valor'].'</td>
        					
        					
        						<td><a class="btn btn-primary" href="index.php?modulo=pipa&secao=relatorio&acao=rel_rpa&mod=2&rpa='.$dados[0]['id_conta'].'&id='.$dados[0]['id_motorista'].'&mes='.$dados[0]['mes'].'">Imprimir RPA</a></td>
        						</tr>';
        					
        			
        			print '</table></div>';
    
                }
		// rpa em lote
		}elseif ($_tipo == 1) {

			$dados = $_calculo->relRpa(false, FuncaoBase::mesTonum($_mes), $_tipo, $_ano);

			$_SESSION['rpa_lote'] = $dados;

			print '<div class="row-fluid"><div class="span3"></div>
					<div class="span9 text-center"><a class="btn btn-primary" href="index.php?modulo=pipa&secao=relatorio&acao=rel_rpa&mod=1">Rpa em Lote</a></div></div>';

		}elseif ($_tipo == 2){

			$dados = $_calculo->relRpa(false, FuncaoBase::mesTonum($_mes), $_tipo, $_ano);

			//FuncaoBase::vd($_SESSION);

			//$_SESSION['rpa_lote'] = $dados;


		}elseif($_tipo == 3)
		{
			
			$dados = RPA::rpaLista($_lista);
			
		}


	}

	print '</div>
			<div class="fdo_corpo"></div>';

	?>
	</div>
	<script src="/js/jquery.js"></script>
	<script src="/js/bootstrap.js"></script>
	<script src="/js/jasny-bootstrap.js"></script>
	<script src="/js/funcaobase.js"></script>
	<script type="text/javascript">

        $(function(){
        
            $("#txtLista").prop('disabled', false);
        
        });
        
	</script>
</body>
</html>
