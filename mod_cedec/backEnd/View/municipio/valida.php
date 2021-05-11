<?php session_start() ;
	include_once '/include.php';

	$_conexao = new ConexaoMysql();

	$_compdec = new Compdec();

	$_funcaoBase = new FuncaoBase();

$_id = isset($_GET['id']) ? (int)$_GET['id'] : ""; 


if($_id == "") {

	//var_dump($_POST);

    $_nome         = isset($_POST['txtNome'])               ? $_POST['txtNome']            : "";
    $_macrorregiao = isset($_POST['selSelMacrorregiao'])    ? $_POST['selSelMacrorregiao'] : "";
    $_latitufr     = isset($_POST['txtLatitude'])           ? $_POST['txtLatitude']        : "";
    $_longitude    = isset($_POST['txtLongitude'])          ? $_POST['txtLongitude']       : "";
    $_distancia    = isset($_POST['txtDistanciaBh'])        ? $_POST['txtDistanciaBh']     : "";
    $_populacao    = isset($_POST['txtPopulacao'])          ? $_POST['txtPopulacao']       : "";
    $_territorio   = isset($_POST['selSelTerritorioDesenv'])? $_POST['selSelTerritorioDesenv']: "";
    $_btnCadastrar = isset($_POST['btnCadastrar'])          ? $_POST['btnCadastrar']       : "";                 
  
  //var_dump($_POST);

  $_campos = array(	'Nome do Municipio'=>$_nome,        
                    'Macrorregião'=>$_macrorregiao,
                    'Latitude'=>$_latitude,
                    'Longitude'=>$_longitude,   
                    'Distancia'=>$_distancia,   
                    'População'=>$_populacao,   
                    'Território'=>$_territorio );

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
							$_txt_efetivo, 
							$_txt_email,    
							$_rdb_nudec,
							$_txt_rep1,      
							$_txt_func_rep1,
							$_txt_fone_res1,
							$_txt_cel1,  
							$_txt_rep2,
							$_txt_fun_rep2,
							$_txt_fone_res2,
							$_txt_cel2)){

  		print "<script type='text/javascript'>";

  		print "alert('Cadastro Realizado com Sucesso !');";

  		print "window.location = 'index.php?token=".hash('sha256', md5(VERSAO)."-".time())."&ac=&modulo=cedec&secao=municipio&acao=cadastro'";

  		print "</script>";


  	}

  }


# Alterar 
}elseif (is_int($_id)) {

  //var_dump($_POST);

  $_txt_id_municipio= isset($_POST['id_municipio'])     ? $_POST['id_municipio']              : ""; 
  $_sel_regiao      = isset($_POST['sel_regiao'])       ? $_POST['sel_regiao']                : ""; 
  $_sel_associacao  = isset($_POST['sel_associacao'])   ? $_POST['sel_associacao']            : ""; 
  $_txt_num_lei     = isset($_POST['txt_num_lei'])      ? $_POST['txt_num_lei']               : ""; 
  $_txt_dt_lei      = isset($_POST['txt_dt_lei'])       ? $_POST['txt_dt_lei']                : ""; 
  $_txt_num_decreto = isset($_POST['txt_num_decreto'])  ? $_POST['txt_num_decreto']           : ""; 
  $_txt_dt_decreto  = isset($_POST['txt_dt_decreto'])   ? $_POST['txt_dt_decreto']            : ""; 
  $_txt_num_portaria= isset($_POST['txt_num_portaria']) ? $_POST['txt_num_portaria']          : ""; 
  $_txt_dt_portaria = isset($_POST['txt_dt_portaria'])  ? $_POST['txt_dt_portaria']           : ""; 
  $_txt_endereco    = isset($_POST['txt_endereco'])     ? utf8_decode($_POST['txt_endereco']) : ""; 
  $_txt_comp_fone1  = isset($_POST['txt_comp_fone1'])   ? $_POST['txt_comp_fone1']            : ""; 
  $_txt_comp_fone2  = isset($_POST['txt_comp_fone2'])   ? $_POST['txt_comp_fone2']            : ""; 
  $_txt_efetivo     = isset($_POST['txt_efetivo'])      ? $_POST['txt_efetivo']               : ""; 
  $_txt_email       = isset($_POST['txt_email'])        ? $_POST['txt_email']                 : ""; 
  $_rdb_nudec       = isset($_POST['rdb_nudec'])        ? $_POST['rdb_nudec']                 : ""; 
  $_txt_rep1        = isset($_POST['txt_rep1'])         ? utf8_decode($_POST['txt_rep1'])     : ""; 
  $_txt_func_rep1   = isset($_POST['txt_func_rep1'])    ? utf8_decode($_POST['txt_func_rep1']): ""; 
  $_txt_fone_res1   = isset($_POST['txt_fone_res1'])    ? $_POST['txt_fone_res1']             : ""; 
  $_txt_cel1        = isset($_POST['txt_cel1'])         ? $_POST['txt_cel1']                  : ""; 
  $_txt_rep2        = isset($_POST['txt_rep2'])         ? utf8_decode($_POST['txt_rep2'])     : ""; 
  $_txt_fun_rep2    = isset($_POST['txt_fun_rep2'])     ? utf8_decode($_POST['txt_fun_rep2']) : ""; 
  $_txt_fone_res2   = isset($_POST['txt_fone_res2'])    ? $_POST['txt_fone_res2']             : ""; 
  $_txt_cel2        = isset($_POST['txt_cel2'])         ? $_POST['txt_cel2']                  : ""; 
  $_btn_enviar      = isset($_POST['btn_enviar'])       ? true 				                  : ""; 

  //var_dump($_POST);

  $_campos = array(	"Região"=> $_sel_regiao,      
					"Associação"=>$_sel_associacao);

	if($_funcaoBase->campoBranco($_campos)){

	  	if($_compdec->Alterar($_sel_regiao,
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
								$_txt_efetivo, 
								$_txt_email,    
								$_rdb_nudec,
								$_txt_rep1,      
								$_txt_func_rep1,
								$_txt_fone_res1,
								$_txt_cel1,  
								$_txt_rep2,
								$_txt_fun_rep2,
								$_txt_fone_res2,
								$_txt_cel2,
								$_txt_id_municipio)){

	  		print "<script type='text/javascript'>";

	  		print "alert('Cadastro Alterado com Sucesso !');";

	  		print "window.location = 'index.php?token=".hash('sha256', md5(VERSAO)."-".time())."&ac=&modulo=compdec&secao=compdec&acao=buscarAlterar'";

	  		print "</script>";
	  	}

	}

}?>