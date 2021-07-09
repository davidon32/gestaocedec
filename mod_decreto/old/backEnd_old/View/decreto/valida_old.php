<?php $id_session = session_id();
    if(empty($id_session)) session_start(); 
	print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
	include_once $_SERVER['DOCUMENT_ROOT'].'/include.php';

$_login = new Login ();

$_login->logado ();

$_municipio = new Municipio ();

$_processo = new Decretacao ();

$_post = isset($_POST) ? $_POST :"";



# pagina dados processo
if($_post['pagina'] == "dados.processo"){

	# novo processo
	if($_post['opcao'] == "Salvar") { 
		
		$dados['num_processo'] = $_processo->getNumProcesso();
		$dados['id_municipio'] = $_post['id_municipio'];
		$dados['txt_dt_entrada'] = DataMysql::dataForm($_post['txt_dt_entrada']);
		$dados['txt_ano'] = $_post['txt_ano'];
		$dados['txt_num_dec_mun'] = $_post['txt_num_dec_mun'];
		$dados['txt_dt_dec_mun'] = DataMysql::dataForm($_post['txt_dt_dec_mun']);
		$dados['txt_dec_vigencia'] = $_post['txt_dec_vigencia'];
		$dados['txt_dt_vencimento'] = DataMysql::dataForm($_post['txt_dt_vencimento']);
		$dados['sel_desastre'] = $_post['sel_desastre'];
		$dados['txt_analista'] = $_post['txt_analista'];
		$dados['rdb_stat_analis_estado']   = isset($_post['rdb_stat_analis_estado']) ? $_post['rdb_stat_analis_estado'] :"";
		$dados['rdb_stat_hom_estado']      = isset($_post['rdb_stat_hom_estado']) ? $_post['rdb_stat_hom_estado'] :"";
		$dados['rdb_stat_arq_estado']      = isset($_post['rdb_stat_arq_estado']) ? $_post['rdb_stat_arq_estado'] :"";
		$dados['rdb_stat_rec_uniao']       = isset($_post['rdb_stat_rec_uniao']) ? $_post['rdb_stat_rec_uniao'] :"";
		$dados['rdb_stat_nrec_uniao']      = isset($_post['rdb_stat_nrec_uniao']) ? $_post['rdb_stat_nrec_uniao'] :"";
		$dados['rdb_aprovado_pmda']        = isset($_post['rdb_aprovado_pmda']) ? $_post['rdb_aprovado_pmda'] :"";
		$dados['rdb_em_analise_pmda']      = isset($_post['rdb_em_analise_pmda']) ? $_post['rdb_em_analise_pmda'] :"";
		$dados['txt_num_decreto_homo']     = $_post['txt_num_decreto_homo'];
		$dados['txt_dt_pub_decreto_homo']  = $_post['txt_dt_pub_decreto_homo'];
		$dados['txt_num_dt_portaria_homo'] = $_post['txt_num_dt_portaria_homo'];
		$dados['txt_num_dou_homo']         = $_post['txt_num_dou_homo'];
		
		$camposBanco = array($_post['txt_dt_entrada'],
							$_post['txt_ano'],
							$_post['txt_num_dec_mun'],
							$_post['txt_dt_dec_mun'],
							$_post['txt_dec_vigencia'],
							$_post['txt_dt_vencimento'],
							$_post['sel_desastre'],
							$_post['txt_analista']);
		
	
		if(($_post['id_municipio'] != 0) && ($camposBanco)){
			
			$_processo->dadosProcesso($dados);	
		}
					
				
		
	# atualiza dados processo
	}elseif($_post['opcao'] == "Alterar") {
		
		$dados['num_processo'] = $_post['txt_num_processo'];
		$dados['id_municipio'] = $_post['id_municipio'];
		$dados['txt_dt_entrada'] = DataMysql::dataForm($_post['txt_dt_entrada']);
		$dados['txt_ano'] = $_post['txt_ano'];
		$dados['txt_num_dec_mun'] = $_post['txt_num_dec_mun'];
		$dados['txt_dt_dec_mun'] = DataMysql::dataForm($_post['txt_dt_dec_mun']);
		$dados['txt_dec_vigencia'] = $_post['txt_dec_vigencia'];
		$dados['txt_dt_vencimento'] = DataMysql::dataForm($_post['txt_dt_vencimento']);
		$dados['sel_desastre'] = $_post['sel_desastre'];
		$dados['txt_analista'] = $_post['txt_analista'];
		$dados['rdb_stat_analis_estado']   = isset($_post['rdb_stat_analis_estado']) ? $_post['rdb_stat_analis_estado'] :"";
		$dados['rdb_stat_hom_estado']      = isset($_post['rdb_stat_hom_estado']) ? $_post['rdb_stat_hom_estado'] :"";
		$dados['rdb_stat_arq_estado']      = isset($_post['rdb_stat_arq_estado']) ? $_post['rdb_stat_arq_estado'] :"";
		$dados['rdb_stat_rec_uniao']       = isset($_post['rdb_stat_rec_uniao']) ? $_post['rdb_stat_rec_uniao'] :"";
		$dados['rdb_stat_nrec_uniao']      = isset($_post['rdb_stat_nrec_uniao']) ? $_post['rdb_stat_nrec_uniao'] :"";
		$dados['rdb_aprovado_pmda']        = isset($_post['rdb_aprovado_pmda']) ? $_post['rdb_aprovado_pmda'] :"";
		$dados['rdb_em_analise_pmda']      = isset($_post['rdb_em_analise_pmda']) ? $_post['rdb_em_analise_pmda'] :"";
		$dados['txt_num_decreto_homo']     = $_post['txt_num_decreto_homo'];
		$dados['txt_dt_pub_decreto_homo']  = $_post['txt_dt_pub_decreto_homo'];
		$dados['txt_num_dt_portaria_homo'] = $_post['txt_num_dt_portaria_homo'];
		$dados['txt_num_dou_homo']         = $_post['txt_num_dou_homo'];
		
		$camposBanco = array($_post['txt_dt_entrada'],
							$_post['txt_ano'],
							$_post['txt_num_dec_mun'],
							$_post['txt_dt_dec_mun'],
							$_post['txt_dec_vigencia'],
							$_post['txt_dt_vencimento'],
							$_post['sel_desastre'],
							$_post['txt_analista']);
		
	
		$_processo->updateDadosProcesso($dados);

	
	}elseif (true){
	
	
	
	}

}
//var_dump($_POST);

/* Arranjo para alimentar os campos com dados para alteração de processo */
$_alterar = isset ( $_GET ['id'] ) ? $_GET ['id'] : "";

/* if ($_alterar != "") {

	$_dados = $_processo->BuscaProcessoDados ( $_alterar );


	$_rdb_analise         = $_dados [0] ['stat_analise'];
	$_rdb_homologacao     = $_dados [0] ['stat_homologa'];
	$_rdb_arquivado       = $_dados [0] ['stat_arquivo'];
	$_rdb_reconhecido     = $_dados [0] ['stat_reconhecido'];

	$_txt_dt_entrada      = "value='" . DataMysql::dataVisual ( $_dados [0] ['dt_entrada'] ) . "'";
	$_txt_num_processo    = "value='" . $_dados [0] ['num_processo'] . "'";
	$_txt_ano             = "value='" . $_dados [0] ['ano'] . "'";
	$_id_municipio        = $_dados [0] ['id_municipio'];
	$_txt_num_dec_mun     = "value='" . $_dados [0] ['num_dec_mun'] . "'";
	$_txt_dt_dec_mun      = "value='" . DataMysql::dataVisual ( $_dados [0] ['dt_dec_mun'] ) . "'";
	$_txt_dec_vigencia    = "value='" . $_dados [0] ['dec_vigencia'] . "'";
	$_sel_desastre        = $_dados [0] ['desastre'];
	$_txt_dt_vencimento   = "value='" . DataMysql::dataVisual ( $_dados [0] ['dt_vencimento'] ) . "'";

	$_txt_analista 		  = "value='" . $_dados [0] ['id_funcionario'] . "'";
	$_txt_num_decreto 	  = "value='" . $_dados [0] ['num_dec_mun'] . "'";
	$_txt_dt_pub_decreto  = "value='" . DataMysql::dataVisual ( $_dados [0] ['dt_pub_dec_homo'] ) . "'";
	$_txt_num_dt_portaria = "value='" . $_dados [0] ['num_dt_port_dec_rec'] . "'";
	$_txt_num_dou 		  = "value='" . $_dados [0] ['num_dt_dou'] . "'";
	$_txt_val_total 	  = "value='" . $_dados [0] ['vl_total'] . "'";


	$_parametro 		  = "&id=";

} else {

	$_txt_dt_entrada 	  = "value=\"" . date ( "d/m/Y" ) . "\"";
	$_txt_num_processo 	  = "";
	$_txt_ano 			  = "value=\"" . date ( "Y" ) . "\"";
	$_id_municipio 		  = "";
	$_txt_num_dec_mun 	  = "";
	$_txt_dt_dec_mun 	  = "";
	$_txt_dec_vigencia	  = "";
	$_sel_desastre 		  = "";
	$_txt_dt_vencimento   = "";
	$_rdb_analise 		  = "value=\"1\"";
	$_txt_analista        = "";
	$_txt_num_decreto     = "";
	$_txt_dt_pub_decreto  = "";
	$_txt_num_dt_portaria = "";
	$_txt_num_dou 		  = "";
	$_txt_val_total 	  = "";
	$_rdb_homologacao 	  = "";
	$_rdb_arquivado 	  = "";
	$_rdb_reconhecido 	  = "";

	$_parametro = "";


}
 */
?>