<?php $id_session = session_id();
    if(empty($id_session)) {
        session_start();
    }

	include_once 'include.php';

    	$_loginEx = new LoginExterno();
    	
    	$_loginEx->logadoExterno(); 	
    	
		$_loginEx->Sessao();
				
		$id_municipio = isset($_GET['id']) ? $_GET['id'] : "";
		
			if(!empty($id_municipio)) {
				
				$id = isset($_SESSION['seguranca']['id_plano']) ? "&id=".$_SESSION['seguranca']['id_plano'] : "";

			}

?>	
	
	<!DOCTYPE html>
	<html lang="pt-Br">
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="/css/bootstrap3.3.2.min.css" rel="stylesheet"/>
	
	<style type="text/css">
		table {
			margin: auto;
			width: 80%;
			width: 300px;
		}
		a.itemMenu {
			font-size: 10px;
			text-decoration: none;
		}

        .versao{
            background:#e6e6ff;
            min-height: 600px;
            border-radius:6px;
            font-weight: bold;

        }
        .versao span {
            text-align:center !important;

        }
        .versao a{
                font-size: 12px;
            }



	</style>
	  </head>
	  <body>
	  		<?php include_once(PATH.'/ex/barra_usuario.php');?>
	  		
	  	<div class="container-fluid">

	  		<!-- <div class="col-md-2">
				<br>
		  		<br>
		  		<br>
	  			<a class="btn btn-primary col-md-12" href='/index2.php?secao=menu&t=<?=HASH;?>' title='Menu Principal'>Principal</a><br>
	  			<a class="btn btn-primary col-md-12" href='/index.php?modulo=compdec&secao=compdec&acao=alterar&t=<?=HASH;?>' title='Alterar Dados do Compdec'>Dados Cadastrais</a><br>
	  			<a class="btn btn-primary col-md-12" href='/index.php?modulo=compdec&secao=compdec&acao=consulta&t=<?=HASH;?>' title='Impressao da Ficha de Cadastro'>Impressão</a><br>
			</div> -->
				
	  		<div class="col-md-9 img-responsive">
	  			<!-- corpo -->
					<div class="col-md-2 pull-left text-center">
					</div>
					<div class="col-md-2 text-center">
						<label for="">
							<a href="?modulo=compdec&secao=plano&acao=conhecimento<?=$id;?>"><img src="imagem/conhecimento.png" width='150px'></a>
							<br>
						</label>
					</div>
					
					<div class="col-md-2 pull-left text-center">
						<label for="">
							<a href=""><img src="imagem/cenario.png" width='150px'></a>
                            <br>
						</label>
					</div>
					<div class="col-md-2 pull-left text-center">
						<label for="">
							<a href=""><img src="imagem/enfrentamento.png" width='150px'></a>
                            <br>
						</label>
					</div>
	  			<div class="col-md-2 text-center">
						<label for="">
							<a href=""><img src="imagem/upload.png"  width='150px'></a>
							<br>
						</label>
				</div>

	  		</div>
			<!-- VERSOES PLANO CONTINGENCIA -->
            <div class="col-md-3 pull-rigth versao">
                <span class="alert alert-info">Versões</span>
                <br><br>

                    <i class="glyphicon glyphicon-asterisk"></i>                
                    <a href="#">Plano versao 1 -  Data: 01/01/2019</a>

            </div>
	  		
	  	</div>
        
<script src="js/jquery-1.12.1.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/bootstrap3.3.2.min.js"></script>
<script src="js/jasny-bootstrap_bs3.js"></script>
<script src="js/jquery.easy-autocomplete.js"></script>
<script src="js/lib/thickbox.js"></script>
<script src="js/funcaobase.js"></script>
</body>
</html>
	  	
	