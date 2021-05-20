<?php include_once PATH.'/core/include.php';?>
<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_cce/Model/Model.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php";?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php";?>
<!-- =================== MENU  ============================ -->
<?php include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";?>
<?php

$_login = new Login();

//$_login -> logado();

$_usuario = new Usuario();

$_diario = new Diario();

$_id_usuario = $pageSession['session']['seguranca']['idUser'];

?>
					<form action="" method="POST" name="frm_boletim" enctype="multipart/form-data">
						
					   <legend>Lançamento de Boletim</legend>
					   <label>Anexo</label>
					   <input type="file" name="fileAnexo" id="fileAnexo" class="btn btn-primary form-control">
					   <span style="color: red; font-size: 10px;">Formatos permitidos  *.pdf *.odt</span>
					   <br><br>
					   <label>Número Boletim</label>
					   <input type="text" name="txtDescricao" id="txtDescricao" class="span12 form-control" required maxlength="5">   
					   <label>Horário </label>
					   <input type="text" name="txtComplemento" id="txtComplemento" class="span12 form-control" required maxlength="3" data-mask="99h">
					   <span style="color: red; font-size: 10px;">Ex. 16h</span>   
					   <br><br>
					   <label>Data</label>
					   <input class="form-control" type="text" name="txtData" id="txtData" value="<?=date("d/m/Y"); ?>">
					   <br><br>
					   <input type="hidden" name="txtIdUser" id="txtIdUser" value="<?=$pageSession['session']['seguranca']['idUser'];?>">
					   <input type="hidden" name="txtIdUser" id="txtIdUser" value="<?=$pageSession['session']['seguranca']['idUser'];?>">
					   <input type="submit" name="btnEnviar" id="btnEnviar" class="btn btn-info" value="Upload" title="Fazer upload do boletim">
					 </form>
					 
					 <br>      
					 <p style="text-align: center"> <a href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'))?>&ac=itn&modulo=cce&controller=cce&action=index" class="btn btn-success">Voltar</a></p>
				
					
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>
	<script type="text/javascript">
	
    $("#txtData").datepicker({ 
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
        dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
        dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
        monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
        monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
        nextText: 'Proximo',
        prevText: 'Anterior'
    });

		$("#btnEnviar").click(function(){
			var str = $("#txtComplemento").val();
			if(str != ""){
				$("#txtComplemento").val(str);
			}

		});
    </script>
  <?php
	$anexo = new AnexoCce();
	
	if(isset($_POST['btnEnviar'])){
	
		$post = isset($_POST) ? $_POST :"";
		$file = isset($_FILES)? $_FILES :"";
			
		if($anexo->AnexoBoletim($post, $file, 'anexo/boletim')){
			
			print "<script type='text/javascript'>";
			
		  print "alert('Boletim Publicado com Sucesso !');";
			
			//print "window.location = '?modulo=cce&controller=cce&action=index'";
			
			print "</script>";
			
		}else{
			
			echo "Erro";
		}
	
	}


?>