<?php $id_session = session_id();
    if(empty($id_session)) session_start();
	print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
	include_once PATH.'/core/include.php';

//$_conexao = new ConexaoMysql();

$_login = new Login();

$_login->logado();

$_login->Sessao();

$_funcaoBase = new FuncaoBase();

//$_usuario


?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo TITULO; ?></title>
<link href="/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
</head>

<body>
     <!-- TOPO /system/topo.php-->
    <?php include_once(PATH.'/system/topo.php'); ?>
    
	<div class="container-fluid">

		<!-- MENU -->
		<div class="row-fluid fdo_corpo">
			<div class="span3">
			     <?php include_once PATH."/mod_".$modulo.'/app/elemento/'.$modulo.'.menu.php';?>   
			</div>


		<!-- MENSAGEM -->

			<div class="span5 text-center fdo_corpo">
				<label><b>Mensagens e Avisos</b></label> <br /> <br />
				<?php $_funcaoBase->mostraMensagem();?>
			</div>


		<!-- LIBERACAO -->

			<div class="span4">
			     <label class="text-center"><b>Legenda</b></label>
			     <br>
                    <span style='font-size:10px; color: #999999'>
                        <img src="/mod_ajuda/imagem/user-available.png">&nbsp;Liberação realizada<br>
                        <img src="/mod_ajuda/imagem/alerta-prazo.png">&nbsp;Prazo pagamento expirando<br>
                        <img src="/mod_ajuda/imagem/transito.png">&nbsp;Material em Transito
                    </span>
                <hr>
			    
				<label class="text-center"><b>Lembrete de Libera&ccedil;&otilde;es</b></label>
<?php
					$_login1 = $_SESSION['seguranca']['login'];
					$_dep = $_SESSION['seguranca']['id_deposito'];
					$_login = new Login();

				 $_login->acessoLembrete($_login1, $_dep);?>
				<hr>
				<label class="text-center"><b>Lembrete de Material em Tr&acirc;nsito-</b></label>
				<?php
					// usuario comum
					if($_SESSION['seguranca']['nivel'] == 0 || $_SESSION['seguranca']['nivel'] == 4) {
						
						$_id_deposito = (int) $_SESSION['seguranca']['id_deposito'];
						$_id_usuario = $_SESSION['seguranca']['login'];
						
						/* lembrete transferencia para deposito avancados
						 * mostra o material somente para usuario do respectivo deposito */ 
						
						$_login->acessoLembreteTransito($_id_usuario, $_id_deposito);
						
					
					}else {
						/* lembrete transferencia 
						 * mostra o material transferido de todos os depositos */
						$_login->acessoLembreteTransito($_SESSION['seguranca']['login'], true);
                        

						
					}
				?>
				
			</div>
		</div>
        <div class="row-fluid">
            <div class="span12">
	       	    
            </div>
        </div>

		<!-- RODAPE -->
		<div class="row-fluid">
		    
			<div class="span12 text-center">
				<hr>
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
