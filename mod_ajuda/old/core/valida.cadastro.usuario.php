<?php
/* ****************************************************************************************
*   Org�o 		 : Coordenadoria Estadual de Defesa Civil do Estado de Minas Gerais
*	Sistema      : Sistema de Gest�o de Ajuda Humanit�ria
*
*	Autor        :  Demetrio Silva Passos
*	Fun��o       :  Script de Valida��o de cadastro de usuario
*
*******************************************************************************************/

	include_once $_SERVER['DOCUMENT_ROOT'].'/proj.sgah/include.php';
	
	$login = new Login();
	
	$login->logado();
	
	ConexaoMysql::ConexaoAjuda();
	
	$id_deposito = new Deposito();
	
	$cad_user = new ControleAcesso();
	
	#@ gera login de usuario
	$login = Login::GeraLogin();
		
	#@ dados do formulario
	$nome = $_POST['txtUsuario'];
	$senha = md5($_POST['txtSenha']);
	$nivel = $_POST['txtNivel'];
	$status = $_POST['txtStatus']; # status do usuario
	$deposito = $_POST['nDeposito']; # nome do deposito
	$id_dep = $id_deposito->PegaIdDeposito($deposito); # id baseado no nome do deposito
	
	#@ checa os chekbox
	$ch_cad_mat = isset($_POST['ch_cad_mat']) ? ((bool)$_POST['ch_cad_mat']) : 0;
	$ch_lib_mat = isset($_POST['ch_lib_mat']) ? ((bool)$_POST['ch_lib_mat']) : 0;
	$ch_pg_mat =  isset($_POST['ch_pg_mat']) ? ((bool)$_POST['ch_pg_mat']) : 0;
	$ch_transf_mat =  isset($_POST['ch_transf_mat']) ? ((bool)$_POST['ch_transf_mat']) :0;
	$ch_cons_rel =    isset($_POST['ch_cons_rel']) ? ((bool)$_POST['ch_cons_rel']) :0;
	$ch_cad_usuario = isset($_POST['ch_cad_usuario']) ? ((bool)$_POST['ch_cad_usuario']) : 0;
	$ch_ajuda =       isset($_POST['ch_ajuda']) ? ((bool)$_POST['ch_ajuda']) :0;
	$ch_pos_estoque_g = isset($_POST['ch_pos_estoque_g']) ? ((bool)$_POST['ch_pos_estoque_g']):0;
	$ch_pos_estoque_d = isset($_POST['ch_pos_estoque_d']) ? ((bool)$_POST['ch_pos_estoque_d']):0;
	$ch_cons_pgto_mat = isset($_POST['ch_cons_pgto_mat']) ? ((bool)$_POST['ch_cons_pgto_mat']) :0;
	$ch_cons_mat_lib =  isset($_POST['ch_cons_mat_lib']) ? ((bool)$_POST['ch_cons_mat_lib']) :0;
	$ch_cons_espera_pg = isset($_POST['ch_cons_espera_pg']) ? ((bool)$_POST['ch_cons_espera_pg']) :0;
	$ch_cons_tranf_mat = isset($_POST['ch_cons_tranf_mat']) ? ((bool)$_POST['ch_cons_tranf_mat']):0;
	$ch_cons_mat_transito = isset($_POST['ch_cons_mat_transito']) ? ((bool)$_POST['ch_cons_mat_transito']) : 0;
	$ch_cons_lib = isset($_POST['ch_cons_lib']) ? ((bool)$_POST['ch_cons_lib']):0;
	$ch_conf_ger = isset($_POST['ch_conf_ger']) ? ((bool)$_POST['ch_conf_ger']):0;
	$ch_lembrete_libera = isset($_POST['lembrete_lib']) ? ((bool)$_POST['lembrete_lib']):0;
	$ch_lembrete_transito = isset($_POST['lembrete_Transito']) ? ((bool)$_POST['lembrete_Transito']):0;
	
	$cad_user->CadastroUsuario($id_dep, $nome, $senha, $nivel, $status, $login);
	
	if($cad_user->CadastroPermissao($cad_user->pega_id_usuario(),
										 $cad_user->pega_nivel(),
										 $ch_cad_mat,
										 $ch_pg_mat,
										 $ch_transf_mat,
										 $ch_lib_mat,
										 $ch_ajuda,
			 							 $ch_cad_usuario,
										 $ch_cons_rel,
										 $ch_pos_estoque_g,
										 $ch_pos_estoque_d,
										 $ch_pg_mat,
										 $ch_transf_mat,
										 $ch_cons_mat_transito,
										 $ch_cons_lib,
										 $ch_cons_mat_lib,
										 $ch_cons_espera_pg,
										 $ch_conf_ger,
										 $ch_lembrete_libera,
										 $ch_lembrete_transito)){
		
		echo "<script LANGUAGE=\"Javascript\">
							alert(\"Cadastro Realizado com Sucesso !\");
							history.back();
							history.back();  
							</SCRIPT>";
				
		
	}else 
	
	

?>