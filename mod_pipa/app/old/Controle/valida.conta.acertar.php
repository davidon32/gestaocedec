<?php session_start();

include_once '../../include.php';

	$_conexao = new ConexaoMysql();

	$_login = new Login();

	$_login->logado();

	$_contrato = new Contrato();

	$_calculo = new Calculo();
	
	
	
	//$dados = $_SESSION['calculo'];
	
	$inss         = (isset($_GET['inss'])) ? $_GET['inss'] : "";
	$dt_acerto    = $_GET['dt_acerto'];
	$mes          = $_GET['mes'];
	$km           = $_GET['km'];
	$id_motorista = $_GET['id_motorista'];
	$irrf         = (isset($_GET['irrf'])) ? $_GET['irrf'] : "";
	$sestsenat    = (isset($_GET['sestsenat'])) ? $_GET['sestsenat'] :"";
	$gfip         = (isset($_GET['gfip'])) ? $_GET['gfip'] : "";
	$placa        = $_GET['placa'];
	$situacao     = $_GET['situacao'];
	$liquido      = (isset($_GET['liquido'])) ? $_GET['liquido'] : "";
	$valor_rec    = $_GET['valor_rec'];
	$id_conta     = $_GET['id_conta'];
	$lote         = isset($_GET['lote']) ? $_GET['lote'] : "0";
	$obs          = $_GET['obs'];
	$ano          = $_GET['ano'];
	$capacidade   = $_GET['cap'];
	$momento      = $_GET['mom'];
    $pessoa       = $_GET['pessoa'];
	
	
	//var_dump($_REQUEST);
    
    //var_dump($lote);
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php print TITULO;?></title>
		<link href="<?php print SISTEMA;?>/css/bootstrap.css" rel="stylesheet" media="screen">
		<link href="<?php print SISTEMA;?>/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
		
	</head>
	<body>
		
		<?php 

			$id_contrato = $_contrato->idContratoid_motorista($id_motorista);
            
            if($pessoa == "PF") {
                
                #@ para o lamcamento de impostos no banco se for um lancamento novo o id não existe
                if($id_conta == "") {
                
                    if($_calculo->lancaImposto($id_pipeiro = null,
                                                $inss,
                                                DataMysql::dataForm($dt_acerto),
                                                $mes,
                                                $km,
                                                $id_motorista,
                                                $irrf,
                                                $sestsenat,
                                                $gfip,
                                                $placa,
                                                $situacao,
                                                $liquido,
                                                $valor_rec,
                                                $lote,
                                                $obs,
                                                $ano,
                                                $id_contrato,
                                                $capacidade,
                                                $momento)){
                        
                        $num_rpa = Rpa::BuscaNumRpa($id_motorista, $placa, $mes, $ano);
    
                        print "<script type=\"text/javascript\">";
    
                        print "alert('Lancamento com Sucesso !');";
    
                        print "window.location = '../visao/voltar.php?&cod=2&rpa=".$num_rpa."';";
    
                        print "</script>";
    
                        //print "<a href=\"rpa1.php?&id_mot='.$_id_motorista.'&pl='.$placa.'&mes='.$mes.'\">RPA - Recibo de Pagamento Autônomo</a><br /><br />
                        //      <a href=\"sc.busca.acerto.conta.php\">Voltar</a>";
                        
                        
                                        
                    }else {
                            
                        print '<script> alert("Erro no Lancamento do Acerto !");<script>    
                                <a href="#">Voltar</a>';
                        
                    }
                }else {
                    
                    //print "oi";
                    #@ correção de lançamento de impostos no banco PF
                    if($_calculo->CorrecaoImposto($id_conta,
                                            $_id_pipeiro =0,
                                            $inss,
                                            DataMysql::dataForm($dt_acerto),
                                            $mes,
                                            $km,
                                            $id_motorista,
                                            $irrf,
                                            $sestsenat,
                                            $gfip,
                                            $placa,
                                            $situacao,
                                            $liquido,
                                            $valor_rec,
                                            $ano,
                                            $id_contrato,
                                            $capacidade,
                                            $momento)){
                                            
                        $num_rpa = Rpa::BuscaNumRpa($id_motorista, $placa, $mes, $ano);
    
                        
                        print "<script type=\"text/javascript\">";
    
                        print "window.location = '../visao/voltar.php?&cod=2&rpa=".$num_rpa."';";
    
                        print "</script>";
                        
                    }else{
                    
                        print '<script> alert("Erro na Atualizacao do Acerto !");<script>    
                                <a href="#">Voltar</a>';
                        
                    }
                    
                }
                
            /* Pessoa juridica */    
            }else if($pessoa == "PJ"){
                
                #@ para o lamcamento de impostos no banco se for um lancamento novo o id não existe
                if($id_conta == "") {
                    
                    if($_calculo->lancaImpostoPj($valor_rec,
                                                 DataMysql::dataForm($dt_acerto),
                                                 $placa,
                                                 $mes,
                                                 $ano,
                                                 $id_contrato,
                                                 $km,
                                                 $id_motorista,
                                                 $situacao,
                                                 $lote,
                                                 $obs,
                                                 $capacidade,
                                                 $momento)){
                            
                        print "<script type=\"text/javascript\">";
    
                        print "alert('Lancamento com Sucesso !');";
    
                        print "window.location = '../secao.php?secao=conta&acao=acertar';";
    
                        print "</script>";
                                                 
                     }else {
                         
                         /* erro no lancamento Conta PJ !*/
                         
                         
                     }
                    
                    
                    
                    
                /* correção da conta PJ */    
                }else {
                    
                    #@ correção de lançamento de impostos no banco PJ
                    if($_calculo->CorrecaoContaPj($id_conta,
                                            DataMysql::dataForm($dt_acerto),
                                            $mes,
                                            $km,
                                            $id_motorista,
                                            $placa,
                                            $valor_rec,
                                            $capacidade,
                                            $momento)){
                                                
                        print "<script type=\"text/javascript\">";
    
                        print "alert('Correcao Realizada com Sucesso !');";
    
                        print "window.location = '../secao.php?secao=conta&acao=acertar';";
    
                        print "</script>";
                                                
                    }else{
                    
                        print '<script> alert("Erro na Correcao da Conta !");<script>    
                                <a href="#">Voltar</a>';    
                    }    

                }
   
            }
            

    			
			
			?>
	<script src="<?php print SISTEMA;?>/js/jquery.js"></script>
	<script src="<?php print SISTEMA;?>/js/bootstrap.js"></script>
	<script src="<?php print SISTEMA;?>/js/jasny-bootstrap.js"></script>				
	<script src="<?php print SISTEMA;?>/js/jasny-bootstrap.js"></script>
	</body>
</html>