<?php include_once "core/Model/indexModel.php"?>
<?php include_once "mod_pipa/Model/IndexModel.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php";?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php";?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";?>

<?php
$dados = Usuario::buscaUsuarioId($_GET['id']);
?>

<form class="form-horizontal" action="<?=FuncaoBase::geraLink("pipa", "pipa", "resetarSenha")?>" method="POST" id="cadUserEx" name="">
<fieldset>

<!-- Form Name -->
<legend>Cadastro Senha</legend>

  <label class="" for="textinput">Usuário</label>

    <input id="textUsuario" name="textUsuario" type="text" value="<?=$dados['usuario']?>" class="form-control " readonly="readonly">
    <input id="id_usuario" name="id_usuario" type="hidden" value="<?=$dados['id']?>" >
    <input id="reset" name="reset" type="hidden" value="">

	  <label class="" for="textinput">Email</label> <small>(email institucional ex. nomemunicipio@municipio.mg.gov.br)</small>
    <input id="email_rec" name="email_rec" type="email" value="<?=$dados['email_rec']; ?>" class="form-control">
		<br>
    <span class="alert alert-danger" style="font-size:12px;">* Email não pode ficar em branco, pois o mesmo é usado para a recuperação de senha </span>
		<br><br>

    <label class="" for="passwordinput">Ativar Cadastro</label>
    <select name="txtSituacao" id="txtSituacao" class="form-control">
    	<option><?=$dados['situacao'];?></option>
    	<option>ATIVADO</option>
    	<option>DESATIVADO</option>
    	<option>CADASTRO_RECUSADO</option>
    </select>    
<br>

<!-- Password input-->

    <input id="senha" name="senha" type="hidden" value="<?=$dados['senha'] ?>" class="form-control" readonly="readonly">
    <input id="trSenha" name="trSenha" type="hidden" value="0">
   
    <input type="checkbox" id="ckReset" name="ckReset" >
                      
                <label>Resetar Senha</label>
                <br>
                <br>
     
<div class="control-group">
    <table class="table table-bordered table-striped" width="60%">
    	<tr>
    		<th style="text-align: center;" colspan="3"><h4>Habilitação Módulo de Acesso</h4></th>
    	</tr>
    	<tr>
    		<th style="text-align: center;">
    			Módulo Compdec
    		</th>
    		<th style="text-align: center;">
    			Modulo TDAP (PMDA)
    		</th>
    		<th style="text-align: center;">
    			<span class="dev">Modulo Ajuda Homanitária</span>
    		</th>
    	</tr>
    	<tr>
    		<td style="text-align: center;">
    			<input type="checkbox" name="ck_compdec" id="ck_compdec" <?=($dados['mod_compdec']) == "1"? "checked='checked' value='1'" : ""?>>
    		</td>
    		<td style="text-align: center;">
    			<input type="checkbox" name="ck_pmda" id="ck_pmda" <?=($dados['mod_pipa']) == "1"? "checked='checked' value='1'" : ""?>>
    		</td>
    		<td style="text-align: center;">
    			<input type="checkbox" name="ck_ajuda" id="ck_ajuda" title="Em Desenvolvimento" disabled <?=($dados['mod_ajuda']) == "1"? "checked='checked' value='1'" : ""?>>
    		</td>
    	</tr>
    </table>
   </div>



<!-- Button -->
<div class="control-group">
  <label class="control-label" for="singlebutton"></label>
  <div class="controls">
    <button id="btnAtua" name="btnAtua" class="btn btn-primary" value="btnAtua">Salvar</button>
  </div>
</div>

</fieldset>
</form>

<br>
<div class="col-md-12 text-center">
    <?php 
        if(isset($_GET['volta']) == 'compdec'){
            print "<a class=\"btn btn-success\" href=\"".FuncaoBase::geraLink("pipa", "pipa", "pesquisaUsuario", array('volta'=>'compdec'))."\">Voltar</a></div>";
        }else {
            print "<a class=\"btn btn-success\" href=\"".FuncaoBase::geraLink("pipa", "pipa", "pesquisaUsuario")."\">Voltar</a></div>";      
        }
        ?>

</div>

</div>       
</div> 
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>

<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>

<?php include_once "template/page/barra_config_template.php";?>

<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>

<script type="text/javascript">

$(document).ready(function(){
    
    $("#senha").val("");
    
	$("#cadUserEx").validate();

	$("#email_rec").blur(function(){

		var email = $("#email_rec").val();
		
		if( 
			(email.indexOf('yahoo') > 0) ||
			(email.indexOf('live') > 0 ) || 
			(email.indexOf('bol') > 0)   || 
			(email.indexOf('hotmail') > 0)
		){
			$("#email_rec").css('background-color', 'red');
			$("#email_rec").css('color', 'white');
			$("#btnAtua").attr("disabled", true);
		}else {
			$("#email_rec").css('background-color', '#fff');
			$("#email_rec").css('color', 'black');
			$("#btnAtua").attr("disabled", false);
		}

	});

	$("#ck_compdec").click(function(){
		if($("#ck_compdec").is(':checked')){
			$("#ck_compdec").attr('value','1');
		}
	});
	$("#ck_pmda").click(function(){
		if($("#ck_pmda").is(':checked')){
			$("#ck_pmda").attr('value','1');
		}
	});
	$("#ck_ajuda").click(function(){
		if($("#ck_ajuda").is(':checked')){
			$("#ck_ajuda").attr('value','1');
		}
	});
	
	$("#spAviso").hide();
	
	$("#ckReset").click(function(){
            
            if($("#ckReset").is(":checked")){
                $("#senha").val("<?=md5('portal199');?>");
                $("#trSenha").val("1");
            }else {
                $("#senha").val("");
                $("#trSenha").val("1");
                alert('Você não resetou a senha, deseja continuar !');
            }

		
		
	});

	$("#btnAtua").hover(function(){
		if($("#email_rec").val() == ""){
			alert("O email nao pode ficar em branco");
			$("#btnAtua").attr("disabled", "true");
		};
                
	});
        

	$("#email_rec").blur(function (){
		if($("#email_rec").val() != ""){
			$("#btnAtua").removeProp("disabled", "disabled");
		}
	
	});

});

</script>
