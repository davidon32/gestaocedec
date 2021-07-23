<?php $id_session = session_id();
    if(empty($id_session)) session_start(); 
include_once PATH.'/include.php';
    

$_conexao = new ConexaoMysql();

$_login = new Login();

$_login->logado();

$usuario = new Usuario();

$id_funcionario = isset($_GET['id']) ? $_GET['id'] : "";

$permissaoFunc = $usuario->dadosUsuarioIdFunc($id_funcionario);



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php print TITULO;?></title>
<link href="<?php print SISTEMA;?>/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="/css/easy-autocomplete.css" rel="stylesheet" media="screen">
<link href="<?php print SISTEMA;?>/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
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

			<div class="span9 fdo_corpo">
				
					<p><?=$permissaoFunc['nome'];?></p>
					<input type="hidden" name="txtIdFuncionario" id="txtIdFuncionario" value="<?=$id_funcionario;?>"/>
		 			<hr></hr>
					<p><b>Permissões Módulos</b></p>
		 			
		 			<label>Ajuda Humanitária &nbsp;<input type="checkbox" name="ckAjuda" id="ckAjuda" <?=($permissaoFunc['m_deposito'] == "1") ? ' checked' : "";?>></label>
		 			<label>TDAP &nbsp;<input type="checkbox" name="ckPipa" id="ckPipa" <?=($permissaoFunc['m_pipa'] == "1") ? ' checked' : "";?>></label>
		 			<label>Decretos &nbsp;<input type="checkbox" name="ckDecretacao" id="ckDecretacao" <?=($permissaoFunc['m_decretacao'] == "1") ? ' checked' : "";?>></label>
		 			<label>Equipe de Apoio &nbsp; <input type="checkbox" name="ckApoio" id="ckApoio" <?=($permissaoFunc['m_apoio'] == "1") ? ' checked' : "";?>></label>
		 			<label>Escola de Defesa Civil &nbsp;<input type="checkbox" name="ckEscola" id="ckEscola" <?=($permissaoFunc['m_escola'] == "1") ? ' checked' : "";?>></label>
		 			<label>Comdec &nbsp;<input type="checkbox" name="ckCompdec" id="ckCompdec" <?=($permissaoFunc['m_comdec'] == "1") ? ' checked' : "";?>></label>
		 			<label>CCE &nbsp;<input type="checkbox" name="ckCce" id="ckCce" <?=($permissaoFunc['m_cce'] == "1") ? ' checked' : "";?>></label>
		 			<hr></hr>
		 			<p><b>Funcionalidades Módulo Pipa</b></p>
		 			<div id="permissaoPipa" name="permissaoPipa">
		 			<?php 
		 			
		 			$perAjuda = $usuario->pegaPermissao('aju_permissao');
		 			$perPip = $usuario->pegaPermissao('pip_permissao');
		 			$perDecreto = $usuario->pegaPermissao('dec_permissao');
		 			$perEquipe = $usuario->pegaPermissao('equ_permissao');
		 			$perEscola = $usuario->pegaPermissao('esc_permissao');	 			
		 			$perCcompdec = $usuario->pegaPermissao('com_permissao');
		 			$perCce = $usuario->pegaPermissao('cce_permissao');
		 				
		 				// permissoes pipa 
		 				foreach ($perPip as $value) {
		 					
		 					if(($value['COLUMN_NAME'] !='id_permissao') && ($value['COLUMN_NAME'] !='login')){
		 					
		 						print "<label>".$value['COLUMN_COMMENT']."&nbsp;";
		 						print "<input type='checkbox' id='ck_".$value['COLUMN_NAME']."' name='ck_".$value['COLUMN_NAME']."' value=''>";
		 						print "</label>";
		 					}
		 				}
		 			
		 			?>
		 			</div>
		 			<!-- <table class="table">
		 				<tr>
		 					<td colspan="3">TDAP</td>
		 				</tr>
		 				
		 				
		 				<tr>
		 					<td>
		 						<label>id_permissao &nbsp; <input type='checkbox' name='ck_id_permissao'  id='ck_id_permissao'           value='<?=$perPip['id_permissao'];?>'/></label>
								<label>login &nbsp;        <input type='checkbox' name='ck_login'         id='ck_login'                  value='<?=$perPip['login'];?>'/></label>
								<label>cad_pipeiro &nbsp;  <input type='checkbox' name='ck_cad_pipeiro'   id='ck_cad_pipeiro'            value='<?=$perPip['cad_pipeiro'];?>'/></label>
								<label>cad_motorista &nbsp;<input type='checkbox' name='ck_cad_motorista' id='ck_cad_motorista'          value='<?=$perPip['cad_motorista'];?>'/></label>
								<label>cad_caminhao &nbsp; <input type='checkbox' name='ck_cad_caminhao'  id='ck_cad_caminhao'           value='<?=$perPip['cad_caminhao'];?>'/></label>
								<label>cad_contrato &nbsp; <input type='checkbox' name='ck_cad_contrato'  id='ck_cad_contrato'           value='<?=$perPip['cad_contrato'];?>'/></label>
								<label>sub_relatorio &nbsp;<input type='checkbox' name='ck_sub_relatorio' id='ck_sub_relatorio'          value='<?=$perPip['sub_relatorio'];?>'/></label>
								<label>rel_resumo &nbsp;   <input type='checkbox' name='ck_rel_resumo'    id='ck_rel_resumo'             value='<?=$perPip['rel_resumo'];?>'/></label>
							</td>
		 					<td>
		 						<label>acerto &nbsp;       <input type='checkbox' name='ck_acerto'        id='ck_acerto'                 value='<?=$perPip['acerto'];?>'/></label>
								<label>rel_rpa &nbsp;      <input type='checkbox' name='ck_rel_rpa'       id='ck_rel_rpa'                value='<?=$perPip['rel_rpa'];?>'/></label>
								<label>rel_bb &nbsp;       <input type='checkbox' name='ck_rel_bb'        id='ck_rel_bb'                 value='<?=$perPip['rel_bb'];?>'/></label>
								<label>rel_imposto &nbsp;  <input type='checkbox' name='ck_rel_imposto'   id='ck_rel_imposto'            value='<?=$perPip['rel_imposto'];?>'/></label>
								<label>rel_cadastro &nbsp; <input type='checkbox' name='ck_rel_cadastro'  id='ck_rel_cadastro'           value='<?=$perPip['rel_cadastro'];?>'/></label>
								<label>rel_contrato &nbsp; <input type='checkbox' name='ck_rel_contrato'  id='ck_rel_contrato'           value='<?=$perPip['rel_contrato'];?>'/></label>
								<label>cad_rota &nbsp;     <input type='checkbox' name='ck_cad_rota'      id='ck_cad_rota'               value='<?=$perPip['cad_rota'];?>'/></label>
							</td>
								<label>rel_conf &nbsp;     <input type='checkbox' name='ck_rel_conf'      id='ck_rel_conf'               value='<?=$perPip['rel_conf'];?>'/></label>
								<label>rel_conf_pg &nbsp;  <input type='checkbox' name='ck_rel_conf_pg'   id='ck_rel_conf_pg'            value='<?=$perPip['rel_conf_pg'];?>'/></label>
								<label>rel_falta_pg &nbsp; <input type='checkbox' name='ck_rel_falta_pg'  id='ck_rel_falta_pg'           value='<?=$perPip['rel_falta_pg'];?>'/></label>
								<label>rel_pg &nbsp;       <input type='checkbox' name='ck_rel_pg'        id='ck_rel_pg'                 value='<?=$perPip['rel_pg'];?>'/></label>
								<label>rel_cons &nbsp;     <input type='checkbox' name='ck_rel_cons'      id='ck_rel_cons'               value='<?=$perPip['rel_cons'];?>'/></label>
								<label>cad_conta &nbsp;    <input type='checkbox' name='ck_cad_conta'     id='ck_cad_conta'              value='<?=$perPip['cad_conta'];?>'/></label>
								<label>sub_cadastro &nbsp; <input type='checkbox' name='ck_sub_cadastro'  id='ck_sub_cadastro'           value='<?=$perPip['sub_cadastro'];?>'/></label>
								<label>pmda &nbsp;         <input type='checkbox' name='ck_pmda'          id='ck_pmda'                   value='<?=$perPip['pmda'];?>'/></label>
		 					<td>

		 				</tr>
		 			</table>-->
			</div>
		</div>
	</div>
</body>
<script src="/js/jquery-1.11.2.js"></script>
<script>

	/* Permissao Ajuda */
	$('#ckAjuda').click(function(){
		if($('#ckAjuda').is(':checked')){
			$('#ckAjuda').val('1');
		}else {
			$('#ckAjuda').val('0');
		}
		var dados = {
				"tabela" : 'cedec_usuario',
				"campo" : 'm_deposito',
				"valor" : $('#ckAjuda').val(),
				"id_funcionario" : $('#txtIdFuncionario').val(),
			};
		$.ajax({
	        type: 'POST',
	        url: 'mod_equipe/app/usuario/usuario.php?v=<?=md5(VERSAO)?>',
	        data: dados,
	        success: function(response) {
	            console.log(response);
	        }
	    });

	});
	
	/* Permissao Pipa */
	$('#ckPipa').click(function(){
		if($('#ckPipa').is(':checked')){
			$('#ckPipa').val('1');
		}else {
			$('#ckPipa').val('0');
		}
		var dados = {
				"tabela" : 'cedec_usuario',
				"campo" : 'm_pipa',
				"valor" : $('#ckPipa').val(),
				"id_funcionario" : $('#txtIdFuncionario').val(),
			};
		$.ajax({
	        type: 'POST',
	        url: 'mod_equipe/app/usuario/usuario.php?v=<?=md5(VERSAO)?>',
	        data: dados,
	        success: function(response) {
	            console.log(response);
	        }
	    });

	});

	/* Permissao CCE */
	$('#ckCce').click(function(){
		if($('#ckCce').is(':checked')){
			$('#ckCce').val('1');
		}else {
			$('#ckCce').val('0');
		}
		var dados = {
				"tabela" : 'cedec_usuario',
				"campo" : 'm_cce',
				"valor" : $('#ckCce').val(),
				"id_funcionario" : $('#txtIdFuncionario').val(),
			};
		$.ajax({
	        type: 'POST',
	        url: 'mod_equipe/app/usuario/usuario.php?v=<?=md5(VERSAO)?>',
	        data: dados,
	        success: function(response) {
	            console.log(response);
	        }
	    });

	});

	/* Permissao Decretacao */
	$('#ckDecretacao').click(function(){
		if($('#ckDecretacao').is(':checked')){
			$('#ckDecretacao').val('1');
		}else {
			$('#ckDecretacao').val('0');
		}
		var dados = {
				"tabela" : 'cedec_usuario',
				"campo" : 'm_decretacao',
				"valor" : $('#ckDecretacao').val(),
				"id_funcionario" : $('#txtIdFuncionario').val(),
			};
		$.ajax({
	        type: 'POST',
	        url: 'mod_equipe/app/usuario/usuario.php?v=<?=md5(VERSAO)?>',
	        data: dados,
	        success: function(response) {
	            console.log(response);
	        }
	    });

	});
	
	/* Permissao Equipe Apoio */
	$('#ckApoio').click(function(){
		if($('#ckApoio').is(':checked')){
			$('#ckApoio').val('1');
		}else {
			$('#ckApoio').val('0');
		}
		var dados = {
				"tabela" : 'cedec_usuario',
				"campo" : 'm_apoio',
				"valor" : $('#ckApoio').val(),
				"id_funcionario" : $('#txtIdFuncionario').val(),
			};
		$.ajax({
	        type: 'POST',
	        url: 'mod_equipe/app/usuario/usuario.php?v=<?=md5(VERSAO)?>',
	        data: dados,
	        success: function(response) {
	            console.log(response);
	        }
	    });

	});
	
	/* Permissao Poco */
	$('#ckPoco').click(function(){
		if($('#ckPoco').is(':checked')){
			$('#ckPoco').val('1');
		}else {
			$('#ckPoco').val('0');
		}
		var dados = {
				"tabela" : 'cedec_usuario',
				"campo" : 'm_poco',
				"valor" : $('#ckPoco').val(),
				"id_funcionario" : $('#txtIdFuncionario').val(),
			};
		$.ajax({
	        type: 'POST',
	        url: 'mod_equipe/app/usuario/usuario.php?v=<?=md5(VERSAO)?>',
	        data: dados,
	        success: function(response) {
	            console.log(response);
	        }
	    });

	});

	/* Permissao Escola */
	$('#ckEscola').click(function(){
		if($('#ckEscola').is(':checked')){
			$('#ckEscola').val('1');
		}else {
			$('#ckEscola').val('0');
		}
		var dados = {
				"tabela" : 'cedec_usuario',
				"campo" : 'm_escola',
				"valor" : $('#ckEscola').val(),
				"id_funcionario" : $('#txtIdFuncionario').val(),
			};
		$.ajax({
	        type: 'POST',
	        url: 'mod_equipe/app/usuario/usuario.php?v=<?=md5(VERSAO)?>',
	        data: dados,
	        success: function(response) {
	            console.log(response);
	        }
	    });

	});


	/* Permissao Compdec */
	$('#ckCompdec').click(function(){
		if($('#ckCompdec').is(':checked')){
			$('#ckCompdec').val('1');
		}else {
			$('#ckCompdec').val('0');
		}
		var dados = {
				"tabela" : 'cedec_usuario',
				"campo" : 'm_comdec',
				"valor" : $('#ckCompdec').val(),
				"id_funcionario" : $('#txtIdFuncionario').val(),
			};
		$.ajax({
	        type: 'POST',
	        url: 'mod_equipe/app/usuario/usuario.php?v=<?=md5(VERSAO)?>',
	        data: dados,
	        success: function(response) {
	            console.log(response);
	        }
	    });

	});
	


</script>

</html>