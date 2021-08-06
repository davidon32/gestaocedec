<?php include_once $_SERVER['DOCUMENT_ROOT'].'/core/include.php';?>
<?php
	
	$_compdec = new Compdec();

	$_funcaoBase = new FuncaoBase();
	
	$anexoFoto = new AnexoCompdec();

  $_id = isset($_GET['id']) ? (int)$_GET['id'] : ""; 
  
  $alteraImagem = isset($_POST['imagem']) ? true : false;
  
  $opcao = isset($_POST['opcao']) ? $_POST['opcao'] : "";
  
  $files = isset($_FILES) ? $_FILES : "";
  $post  = isset($_POST)  ? $_POST  : "";

  $_txt_id_municipio= isset($_POST['id_municipio'])     ? $_POST['id_municipio']               : ""; 
  $_sel_regiao      = isset($_POST['sel_regiao'])       ? $_POST['sel_regiao']                 : ""; 
  $_sel_associacao  = isset($_POST['sel_associacao'])   ? $_POST['sel_associacao']             : ""; 
  $_txt_num_lei     = isset($_POST['txt_num_lei'])      ? $_POST['txt_num_lei']                : ""; 
  $_txt_dt_lei      = isset($_POST['txt_dt_lei'])       ? $_POST['txt_dt_lei']                 : "1900-01-01"; 
  $_txt_num_decreto = isset($_POST['txt_num_decreto'])  ? $_POST['txt_num_decreto']            : ""; 
  $_txt_dt_decreto  = isset($_POST['txt_dt_decreto'])   ? $_POST['txt_dt_decreto']             : ""; 
  $_txt_num_portaria= isset($_POST['txt_num_portaria']) ? $_POST['txt_num_portaria']           : ""; 
  $_txt_dt_portaria = isset($_POST['txt_dt_portaria'])  ? $_POST['txt_dt_portaria']            : ""; 
  $_txt_endereco    = isset($_POST['txt_endereco'])     ? utf8_decode($_POST['txt_endereco'])  : ""; 
  $_txt_comp_fone1  = isset($_POST['txt_comp_fone1'])   ? $_POST['txt_comp_fone1']             : ""; 
  $_txt_comp_fone2  = isset($_POST['txt_comp_fone2'])   ? $_POST['txt_comp_fone2']             : ""; 
  $_rdb_efetivo     = isset($_POST['rdb_efetivo'])      ? $_POST['rdb_efetivo']                : ""; 
  $_txt_email       = isset($_POST['txt_email'])        ? $_POST['txt_email']                  : ""; 
  $_txt_email2      = isset($_POST['txt_email2'])       ? $_POST['txt_email2']                 : ""; 
  $_txt_email3      = isset($_POST['txt_email3'])       ? $_POST['txt_email3']                 : ""; 
  $_rdb_nudec       = isset($_POST['rdb_nudec'])        ? $_POST['rdb_nudec']                  : ""; 
  $_sel_territorio  = isset($_POST['selTerritorioDesenv'])    ? $_POST['selTerritorioDesenv']  : "";  
  $_sel_CompdecExist= isset($_POST['selCompdec'])       ? $_POST['selCompdec']  			   : "";  
  $_sel_Ativo       = isset($_POST['selAtivo'])    		? $_POST['selAtivo']  				   : "";  
  $_ckSemDecreto    = isset($_POST['ckSemDecreto'])		? $_POST['ckSemDecreto']  			   : "0";  
  $_ckSemPortaria   = isset($_POST['ckSemPortaria'])	? $_POST['ckSemPortaria']  			   : "0";  
  $_btn_enviar      = isset($_POST['btn_enviar'])       ? true                                 : "";
			

	/* dados parte 1 */
	if($opcao == "parte1"){
		if($_compdec->AtualizacaoParte1($post)){
			
			print "sucesso";
		}else {
			//print "erro post";
		}
	/* dados parte 2 */
	}elseif($opcao == "parte2"){
		if($_compdec->AtualizacaoParte2($post)){
			print "sucesso";
		}else{
			//print "erro parte 2";
		}

	 /*grava opcao sem decreto em anexo */
	}elseif($opcao == "semDecreto"){

		if($_compdec->GravaSemDecreto($post)){
			print "sucesso";
		}
	/*grava opcao sem portaria */
	}elseif($opcao == "semPortaria"){

		if($_compdec->GravaSemPortaria($post)){
			print "sucesso";
		}

  
/* Alterar Imagem compdec */
}elseif($opcao == 'alterarImagem'){
	
	$files = isset($_FILES) ? $_FILES : "";
	$post  = isset($_POST)  ? $_POST  : "";


	$anexoFoto->deletarFoto($post['txtIdMunicipio'], '/anexo/compdec');

	$hash = date('his');

	$anexoFoto->gravar($post, $files, PATH.'/anexo/compdec', 'fileAnexo', $hash);


/* ALTERACAO DE COMPDEC */
}elseif (is_int($_id) && ($opcao == "")) {

	$dados = $_POST;
	
		if(!isset($dados['ck_sede'])){
			
			$dados['ck_sede'] = '';
		}
		if(!isset($dados['ck_viatura'])){
			
			$dados['ck_viatura'] = '';
		}
		if(!isset($dados['ck_curso_gestao'])){
			
			$dados['ck_curso_gestao'] = '';
		}
		if(!isset($dados['ck_curso_sco'])){
			
			$dados['ck_curso_sco'] = '';
		}
		if(!isset($dados['ck_exp_dc'])){
			
			$dados['ck_exp_dc'] = '';
		}
		if(!isset($dados['ck_computador'])){
			
			$dados['ck_computador'] = '';
		}
		if(!isset($dados['ck_particip_workshop'])){
			
			$dados['ck_particip_workshop'] = '';
		}
		if(!isset($dados['qtd_nudec'])){
			
			$dados['qtd_nudec'] = null;
		}
		if(!isset($dados['ckSemDecreto'])){
			
			$dados['ckSemDecreto'] = null;
		}
		if(!isset($dados['ckSemPortaria'])){
			
			$dados['ckSemPortaria'] = null;
		}
		


		if($_compdec->Alterar1($dados)){
			
			
			// acesso externo
			if(isset($_SESSION['seguranca']['ex'])){
				
				print "<script type='text/javascript'>";
				
				print "alert('Cadastro Alterado com Sucesso !');";
				
				print "window.location = 'index.php?token=".hash('sha256', md5(VERSAO)."-".time())."&ac=&modulo=compdec&controller=compdec&action=alterar'";
				
				print "</script>";
				
				
			}else {

		  		print "<script type='text/javascript'>";
	
		  		print "alert('Cadastro Alterado com Sucesso !');";

		  		print "window.location = 'index.php?token=".hash('sha256', md5(VERSAO)."-".time())."&ac=&modulo=compdec&controller=compdec&action=buscarAlterar'";
	
		  		print "</script>";
	  		
			}
	  	}
/* novo Compdec */
}elseif(($_id == "") && ($opcao == ""))  {

  $_campos = array(	"Municipio"=> $_txt_id_municipio,
  					"Região"=> $_sel_regiao,      
					"Associação"=>$_sel_associacao,
                    "Territorio Desenvolvimento"=> $_sel_territorio);

  if($_funcaoBase->campoBranco($_campos)){

  	if($_compdec->Cadastrar($_txt_id_municipio,
  							$_sel_regiao,
							$_sel_associacao,
							$_txt_num_lei,
							DataMysql::dataForm($_txt_dt_lei),
							$_txt_num_decreto,
							DataMysql::dataForm($_txt_dt_decreto),
							$_txt_num_portaria,
							DataMysql::dataForm($_txt_dt_portaria),
							$_txt_endereco,
							$_txt_comp_fone1,
							$_txt_comp_fone2,
							$_rdb_efetivo, 
							$_txt_email,    
							$_rdb_nudec,
                            $_sel_territorio,
  							$_sel_CompdecExist,
  							$_sel_Ativo,
  							$_ckSemDecreto,
  							$_ckSemPortaria)){

  		print "<script type='text/javascript'>";

  		print "alert('Cadastro Realizado com Sucesso !');";

  		print "window.location = 'index.php?token=".hash('sha256', md5(VERSAO)."-".time())."&ac=&modulo=compdec&secao=compdec&acao=cadastro'";

  		print "</script>";

  	}

  }
  
}?>