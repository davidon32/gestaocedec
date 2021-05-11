<?php session_start();
print "<!DOCTYPE html>";
include_once PATH.'/include.php';

$rota = new Rota();


$idRota = isset($_GET['idrota']) ? $_GET['idrota'] : "";

$dadosRota = $rota->PegaNome($idRota);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php print TITULO;?></title>
<link href="<?php print SISTEMA;?>/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="<?php print SISTEMA;?>/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
<script type="text/javascript">

	function esconde() {

		$("#erro").hide();

	}

</script>
</head>
<body>
	<div class="container">
		<div class="row-fluid text-center">
			<img src="../imagem/topo_pipa.png">
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
	        <p>
	        <hr>
	      </div>
	    </div>
		<div class="row-fluid">
			<!-- MENU -->
			<div class="span3">
				<?php include_once PATH."/mod_".$modulo.'/app/elemento/'.$modulo.'.menu.php';?>
			</div>

			<div class="span9">
				<legend>Adicionar Comunidade na Rota : <?=$dadosRota['nome'].' / '.$dadosRota['num_rota'].' - '.$dadosRota['ano'];?></legend>
				
				<form action="" method="POST" name="" id="" class="" />
					
					<div class="controls controls-row">
                        <label>Comunidade</label>
                        <input class="span3" type="text" name="comunidade" id="comunidade" ></td>
                    </div>
					
						<input class="btn btn-primary" type="submit" name="btnPesquisa" id="btnPesquisa" value="Pesquisar" />
				</form>
            <?php 
            
                $btn = isset($_POST['btnPesquisa']) ? $_POST['btnPesquisa'] : false;

                $nome = isset($_POST['comunidade']) ? $_POST['comunidade'] : false;
                
                $comunidade = new Comunidade();
            
                if($btn && strlen($nome) > 0){
                    
                    /* pesquisa de Comunidade */
                    print "<table class='table' span='6'>
        
                            <tr><th>Código</th>
                                <th>Comunidade</th>
                                <th>Rota</th>
                                <th>Ação</th></tr>";
                    

                    $dados = $comunidade->buscaComunidade($nome); 
                                       
                    foreach ($dados as $value){
                        
                        print "<tr><td>".$value['id_comunidade']."</td>
			                       <td>".$value['comunidade']."</td>
			                       <td>".$rota->PegaNome($value['id_rota'])['nome']."</td>
		                           <td><a href='?modulo=pipa&secao=comunidade&acao=addcomunidade&id=".$value['id_comunidade']."&r=".$idRota."' class='icon-plus-sign' title='Adicionar Comunidade na Rota '></a></td>
		                          </tr>";
                        
                    }
                    
                }
                
                ?>
                </table>
                <hr>
                <table class="table table-bordered">
				<tr>
					<th colspan="2" style='text-align:center;'>Comunidade da Rota <?=$dadosRota['nome'];?></th>
				</tr>
				<tr>
					<th width="10%">Codigo</th>
					<th>Nome</th>
				</tr>
				
				<?php 
				
				    /* comunidades */
				
				    $comunidade = new Comunidade();
				    
				    $dadosCom = $comunidade->buscaComunidadeRota($idRota);
				    			    
				    foreach ($dadosCom as $key=>$value){
				        
				        print "<tr><td>".$dadosCom[$key]['id_comunidade']."</td>
                              <td>".$dadosCom[$key]['comunidade']."</td></tr>";
				        
				    }
				
				
				
				?>
			
			</table>
			</div>
		</div>
		<div class="row-fluid fdo_corpo"></div>
		<div class="row-fluid text-center">
			<small><?php print RODAPE;?></small>
		</div>
	</div>
	
	<script src="<?php print SISTEMA;?>/js/jquery.js"></script>
	<script src="<?php print SISTEMA;?>/js/bootstrap.js"></script>
	<script src="<?php print SISTEMA;?>/js/jasny-bootstrap.js"></script>
	<script src="<?php print SISTEMA;?>/js/funcaobase.js"></script>
</body>
</html>


