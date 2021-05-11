<?php $id_session = session_id();
    if(empty($id_session)) session_start(); 
	print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
	include_once PATH.'/include.php';

$con = Conexao::getInstance();

$_login = new Login();

$_login->logado();

$_funcaoBase = new FuncaoBase();

$_municipio = new Municipio();

$_associacao = new Associacao();

$_regiao = new Regiao();

$_territorio = new Territorio();

$_helper = new Html();

//FuncaoBase::vd($_SESSION);
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
    
	<div class="container">
		
		<!-- MENU -->
		<div class="row-fluid">
			<div class="span2">
			    <?php include_once PATH."/mod_".$modulo.'/app/elemento/'.$modulo.'.menu.php';?>
			</div>

		<form action="index.php?modulo=compdec&secao=compdec&acao=valida" method="POST" accept-charset="utf-8">
		
		<div class="span5">

				<label>Município</label>
			 	<?php $_municipio->pegaMunicipio();?>

			 	<label>Região</label><!--regioes de planejamento do governo estadual -->
			 	<?php $_regiao->ComboRegiao();?>


				<label>Associação</label>
				<?php $_associacao->ComboAssociacao();
				
				
                $_helper->input('select',
                                'territorio',
                                'Territorio de Desenvolvimento',
                                array('class'=>'span12'),
                                $_territorio->dadosCombo());
				?>
                <br><br><br><br>
                <hr>
			 	<label><b>Lei</b></label>
			 	Número:<input class="span4" type="text" name="txt_num_lei" id="txt_num_lei">
			 	Data:<input class="span4" type="text" name="txt_dt_lei" id="txt_dt_lei" data-mask="99/99/9999">
				
				<hr>
			 	<label><b>Decreto</b></label>
			 	Número:<input class="span4" type="text" name="txt_num_decreto" id="txt_num_decreto">
			 	Data:<input class="span4" type="text" name="txt_dt_decreto" id="txt_dt_decreto" data-mask="99/99/9999">

			 </div>
			 <div class="span5">

                <hr>
			 	<label><b>Portaria</b></label>
			 	Número:<input class="span4" type="text" name="txt_num_portaria" id="txt_num_portaria">
			 	Data:<input class="span4" type="text" name="txt_dt_portaria" id="txt_dt_portaria" data-mask="99/99/9999">
			  	<label>Endereço</label>
			 	<input class="span12" type="text" name="txt_endereco" id="txt_endereco">

			 	<label>Fone 1</label>
			 	<input class="" type="text" name="txt_comp_fone1" id="txt_comp_fone1" data-mask="(99)9999-9999">

			 	<label>Fone 2</label>
			 	<input class="" type="text" name="txt_comp_fone2" id="txt_comp_fone2" data-mask="(99)9999-9999">
			 	<label>Efetivo</label>
			 	Não:<input class="" type="radio" name="rdb_efetivo" id="rdb_efetivo" value="0" checked="checked" />
                Sim:<input class="" type="radio" name="rdb_efetivo" id="rdb_efetivo" value="1" />
			 	<label>Email</label>
			 	<input class="span12" type="text" name="txt_email" id="txt_email">
                
			 	<label><b>Possui Nudec</b></label>
			 	Sim:<input class="" type="radio" name="rdb_nudec" id="rdb_nudec" value="0">
			 	Não:<input class="" type="radio" name="rdb_nudec" id="rdb_nudec" value="1">
			 	<br /><br />
			 </div>
			 
			 <div class="span12 text-center">
			 	<br />
			 	<input class="btn btn-primary" type="submit" name="btn_enviar" id="btn_enviar" value="Cadastrar">
			</div>
			 </form>

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