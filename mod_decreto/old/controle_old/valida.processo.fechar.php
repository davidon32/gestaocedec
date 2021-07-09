<?php session_start();
	include_once '../include.php';

$_conexao = new ConexaoMysql();

$_funcaoBase = new FuncaoBase();

$_processo = new Decretacao();

/* acao para um novo registro */
$_grava = isset($_GET['acao']) ? $_GET['acao'] : "";

/* preenchido com o id do processo, se for alteracao de recibo */; 
$_altera = isset($_GET['id']) ? $_GET['id'] : "";
        
$_SESSION['processo'] = array_merge($_SESSION['processo'], $_POST);

/* dados da sessao para gravar ou alterar dados */
$_dados = isset($_SESSION['processo']) ? $_SESSION['processo'] : "";

/* controle de campos em branco  */
$_campos = array("Municipio"                 => $_dados['id_municipio'],
                     "Num Decreto Municipal" => $_dados['txt_num_dec_mun'],
                     "Data Decreto Municipal"=> $_dados['txt_dt_dec_mun'],
                     "Vigência Decreto"      => $_dados['txt_dec_vigencia'],
                     "Desastre"              => $_dados['sel_desastre']);

//var_dump($_dados);
    
/* status do processo */
$_rdb_analise     = isset($_dados['rdb_analise'])  ? $_dados['rdb_analise']  : 0;
$_rdb_homologacao = isset($_dados['rdb_homologacao']) ? $_dados['rdb_homologacao'] : 0;
$_rdb_arquivado   = isset($_dados['rdb_arquivado'])  ? $_dados['rdb_arquivado']  : 0;
$_rdb_reconhecido = isset($_dados['rdb_reconhecido'])  ? $_dados['rdb_reconhecido']  : 0;

$_txt_dt_pub_decreto = ($_dados['txt_dt_pub_decreto'] == '') ? '2000-01-01' : DataMysql::dataForm($_dados['txt_dt_pub_decreto']);


/* gravar novo processo */
if($_grava == "novo") {
         
     //var_dump($_txt_dt_pub_decreto);
      
      if($_funcaoBase->campoBranco($_campos)){
    
        
         if($_processo->Cadastro($_dados['txt_ano'],
                                DataMysql::dataForm($_dados['txt_dt_entrada']),
                                $_processo->numProcesso(),
                                $_dados['id_municipio'],
                                $_dados['txt_num_dec_mun'],
                                DataMysql::dataForm($_dados['txt_dt_dec_mun']),
                                $_dados['txt_dec_vigencia'],
                                $_dados['sel_desastre'],
                                DataMysql::dataForm($_dados['txt_dt_vencimento']),
                                $_rdb_analise,
                                $_dados['txt_analista'],
                                $_dados['txt_num_decreto'],
                                $_txt_dt_pub_decreto,
                                $_dados['txt_num_dt_portaria'],
                                $_dados['txt_num_dou'],
                                $_rdb_homologacao,
                                $_rdb_arquivado,
                                $_rdb_reconhecido)){ 

                
               //var_dump($_processo->numProcesso());
                
                print "<script type='text/javascript'>";
                
                print "alert('Cadastro Realizado com Sucesso !');";
                
                print "window.location.href = 'secao.php?secao=decreto&acao=novo';";
                
                print "</script>";
        }
                                
      }

/* alteracao de processo */    
}else {
    
	
    	// Valor total do Prejuízo
    	$_total_processo = $_dados['txt_psaude_valor'] +
    	$_dados['txt_pensino_valor'] +
    	$_dados['txt_poutro_valor'] +
    	$_dados['txt_pcomuni_valor'] +
    	$_dados['txt_uhabita_valor'] +
    	$_dados['txt_oinfra_valor'] +
    	$_dados['txt_total_prej_publico'] +
    	$_dados['txt_total_eprivado'];
    
    	// cadastro novo
    	if($_altera == ""){
    	    
            //Duplicate entry '0' for key 'num_processo_UNIQUE'
    	
    	     var_dump($_processo->numProcesso());
    		
    		
    		
    	}else {
    	
    		$_processo->AlteraCadastro($_dados['txt_ano'],
    								DataMysql::dataForm($_dados['txt_dt_entrada']),
    								$_dados['txt_num_processo'],
    								$_dados['id_municipio'],
    								$_dados['txt_num_dec_mun'],
    								DataMysql::dataForm($_dados['txt_dt_dec_mun']),
    								$_dados['txt_dec_vigencia'],
    								$_dados['sel_desastre'],
    								DataMysql::dataForm($_dados['txt_dt_vencimento']),
    								$_rdb_analise,
    								$_dados['txt_analista'],
    								$_dados['txt_num_decreto'],
    								DataMysql::dataForm($_dados['txt_dt_pub_decreto']),
    								$_dados['txt_num_dt_portaria'],
    								$_dados['txt_num_dou'],
    								$_dados['txt_populacao'],
    								$_dados['txt_pib'],
    								$_dados['txt_orcamento'],
    								$_dados['txt_arrecadacao'],
    								$_dados['txt_receita_anual'],
    								$_dados['txt_receita_mensal'],
    								$_dados['txt_telefone'],
    								$_dados['txt_email'],
    								$_total_processo,
    								$_dados['txt_morto'],
    								$_dados['txt_ferido'],
    								$_dados['txt_enfermo'],
    								$_dados['txt_desabrigado'],
    								$_dados['txt_desalojado'],
    								$_dados['txt_outro'],
    								$_dados['txt_afetado'],
    								$_dados['txt_psaude_destruida'],
    								$_dados['txt_psaude_danificada'],
    								$_dados['txt_psaude_valor'],
    								$_dados['txt_pensino_destruida'],
    								$_dados['txt_pensino_danificada'],
    								$_dados['txt_pensino_valor'],
    								$_dados['txt_poutro_destruida'],
    								$_dados['txt_poutro_danificada'],
    								$_dados['txt_poutro_valor'],
    								$_dados['txt_pcomuni_destruida'],
    								$_dados['txt_pcomuni_danificada'],
    								$_dados['txt_pcomuni_valor'],
    								$_dados['txt_uhabita_destruida'],
    								$_dados['txt_uhabita_danificada'],
    								$_dados['txt_uhabita_valor'],
    								$_dados['txt_oinfra_destruida'],
    								$_dados['txt_oinfra_danificada'],
    								$_dados['txt_oinfra_valor'],
    								$_dados['txt_agua_pop_atingida'],
    								$_dados['txt_solo_pop_atingida'],
    								$_dados['txt_ar_pop_atingida'],
    								$_dados['txt_incendio_pop_atingida'],
    								$_dados['txt_saude_prej_publico'],
    								$_dados['txt_agua_prej_publico'],
    								$_dados['txt_esgoto_prej_publico'],
    								$_dados['txt_lixo_prej_publico'],
    								$_dados['txt_praga_prej_publico'],
    								$_dados['txt_energia_prej_publico'],
    								$_dados['txt_tele_prej_publico'],
    								$_dados['txt_trans_prej_publico'],
    								$_dados['txt_comb_prej_publico'],
    								$_dados['txt_seg_prej_publico'],
    								$_dados['txt_ensino_prej_publico'],
    								$_dados['txt_total_prej_publico'],
    								$_dados['txt_agricultura_prej_privado'],
    								$_dados['txt_pecuaria_prej_privado'],
    								$_dados['txt_industria_prej_privado'],
    								$_dados['txt_servico_prej_privado'],
    								$_dados['txt_total_eprivado'],
    								$_rdb_homologacao,
    								$_rdb_arquivado,
    								$_rdb_reconhecido,
    								$_altera);
    		
    	print "<script type='text/javascript'>";
    	
    	print "alert('Cadastro Alterado com Sucesso !');";
    	
    	print "window.location.href = 'index2.php?secao=menu';";
    	
    	print "</script>";
    	
    	
    	}
}
	
	unset($_SESSION['processo']);
	
	
	
?>