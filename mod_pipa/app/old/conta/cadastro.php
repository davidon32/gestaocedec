<?php session_start();
	print "<!DOCTYPE html>";
	include_once PATH.'/include.php';
/**
 * Pesqui de pipeiro para realizar o acerto de contas
 * 01/03/2011
 * @author Demetrio Silva Passos
 * 
 */

$_conexao = new ConexaoMysql();

$_login = new Login();

$_login->Logado(CAD_ACERTO, $MODULO['mod_pipa']);

$_calculo = new Calculo();

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php print TITULO;?></title>
<link href="../css/bootstrap.css" rel="stylesheet" media="screen">
<link href="../css/bootstrap-responsive.css" rel="stylesheet" media="screen">

</head>
<body>
    <!-- TOPO /system/topo.php-->
    <?php include_once(PATH.'/system/topo.php'); ?>
    <div class="container">
     <!-- MENU-->
		<div class="row-fluid">
			<div class="span3">
			    <BR>
				<?php include_once PATH."/mod_".$modulo.'/app/elemento/'.$modulo.'.menu.php';?>
			</div>

			<div class="span3"><br /><br /><br />
				<label>Acerto Contas</label>
				<form action="#" method="POST" name="frm_acerto">
					<input type="text" name="ano" id="ano" class="" value="<?php print date('Y');?>" title="Ano para Acerto" readonly="readonly" maxlength="4" placeholder="Ano"/>
					<?php FuncaoBase::mes();?>
					<input type="text" name="cpf" id="cpf" data-mask="999.999.999-99" placeholder="CPF" title="CPF do Motorista"/>
					<input type="text" name="placa" id="placa" data-mask="aaa-9999" placeholder="Placa" title="Placa do Caminhão"/>
					<input class="btn btn-primary" type="submit" name="acerto" value="Acerto" title="Realiza o Cálculo para Acerto com o Pipeiro"/>
				</form>
			</div>

				<div class="span3"><br /><br /><br />
					<label>Correção de Acerto</label>
					<form method="POST" action="#" name="frm_correcao">
						<input type="text" name="ano" id="ano" class="" value="<?php print date('Y');?>" maxlength="4" title="Ano para Acerto" readonly="readonly"/>
						<?php FuncaoBase::mes();?>
						<input type="text" name="cpf" id="cpf" data-mask="999.999.999-99" placeholder="CPF" title="CPF do Motorista"/>
						<input type="text" name="placa" id="placa" data-mask="aaa-9999" placeholder="Placa" title="Placa do Caminhão"/>
						
						<input class="btn btn-primary" type="submit" name="acerto" value="Correcao" title="Faz Correção do Cálculo para Acerto com o Pipeiro" />

						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="ck_pessoa" value="PJ" title="Correção de Contas Pessoa Jurídica"/>PJ
					</form>
					<br><br><br>
				</div>
				<div class="span3"><br /><br /><br />
					<label>Importar Arquivo</label>
					<form method="POST" action="#" name="frm_import">
						<input type="text" name="ano" id="ano" class="" value="<?php print date('Y');?>" placeholder="Ano" maxlength="4" title="Ano para Acerto" readonly="readonly"/>
						<?php FuncaoBase::mes();?>
						<!-- <input type="file" name="arquivo" id="arquivo" value="Arquivo" class="" size="20" /> <br /> <br /> <br />-->
						<br /><br /><br /><br /><br />
						<input class="btn btn-primary" type="submit" name="acerto" value="Importar" title="Faz a importação de Arquivo !"/>
					</form>
				</div>
				<div class="row-fluid">
					<div class="span3"></div>
					<div class="span9 fdo_corpo">
						<!-- INICIO DO CORPO-->

	<?php

	$_mes = isset($_POST['mes']) ? $_POST['mes'] : false;

	$_cpf = isset($_POST['cpf']) ? $_POST['cpf'] : false;

	$_placa = isset($_POST['placa']) ? strtoupper($_POST['placa']) : false;

	$pj = isset($_POST['ck_pessoa']) ? strtoupper($_POST['ck_pessoa']) : "PF";

	#@ formulario de acerto de contas
	$_enviar = isset($_POST['acerto']) ? $_POST['acerto'] : "";

	#@ conversao de mes em formato numero
	$_mes_num = FuncaoBase::mesTonum($_mes);

	#@ ano de acerto
	$_ano = isset($_POST['ano']) ? $_POST['ano'] : false;
    
    //var_dump($_enviar);
    //var_dump($pj);
	
	#########################################   ACERTO   #################################
	if($_enviar == "Acerto"){
	        
	    // Validacao Campos 
	    if((!$_mes) || ($_mes == "") || ($_mes == 'Mes')) {

	        FuncaoBase::alert("O Campo MÊS está em Branco");

	    }else {
            if(($_cpf != false) && (strlen($_cpf) == 14) && ($_placa == "")){

	            $dados = $_calculo->AcertoPipeiro($_cpf, false);

	        }elseif (($_placa != false) && (strlen($_placa) == 8)){

	            $dados = $_calculo->AcertoPipeiro(false, $_placa);

	        }elseif (($_cpf == 'CPF') and ($_placa == 'Placa')) {

	            $dados = 0;
	        }
            
            // busca dados acerto PJ ou alerta acerto realizado
            if((isset($dados)) && ($dados['pessoa'] == 'PJ')){
                
                #@ Alerta sobre acerto realizado no mês 
                $acertoRealizado = $_calculo->buscaAcerto($_mes_num, $dados['placa'], $dados['id_motorista'], $_ano, $dados['pessoa']);
                 
                if(count($acertoRealizado) > 0){

                    for($i = 0; $i < count($acertoRealizado); $i++){

                        print "<div class=\"alert alert-error\" >Acerto realizados 
                                <br/>
                                <table class='table'>
                                    <tr>
                                        <td style='text-align:center; font-weight: bold' colspan='4'>".$_mes." / ".$_ano."</td>
                                    </tr>
                                    <tr>
                                        <td>Nome</td>
                                        <td>CPF</td>
                                        <td>Placa</td>
                                        <td>Valor</td>
                                    </tr>
                                    <tr>
                                        <td>".$acertoRealizado[$i]['nome']."</td>
                                        <td>".$acertoRealizado[$i]['cpf_cnpj']."</td>
                                        <td>".$acertoRealizado[$i]['placa']."</td>
                                        <td>".$acertoRealizado[$i]['valor']."</td>
                                    </tr>
                                </table>
                                </div>";
                    }
                
                // nao existe acerto realizado no mes informado
                }else {
                         
                     $_SESSION['acerto'] = array("id_caminhao"=>$dados['id_caminhao'],
                                                            "capacidade"=>$dados['capacidade'],
                                                            "placa"=>$dados['placa'],
                                                            "id_motorista"=>$dados['id_motorista'],
                                                            "mes"=>$_mes,
                                                            "ano"=>$_ano,
                                                            "momento"=>$dados['momento'],
                                                            "pessoa" =>$dados['pessoa']);

                     print '<table class="table">
                                <tr>
                                <td>Contrato</td>
                                <td>Nome</td>
                                <td>Placa</td>
                                <td colspan="3">Pessoa</td>
                                </tr>
                                <tr>
                                <td>'.$dados['num_contrato'].'</td>
                                <td>'.utf8_encode($dados['nome']).'</td>
                                <td>'.$dados['placa'].'</td>
                                <td>Pessoa Juridica</td>
                                <td><a class="btn btn-primary" href="?secao=conta&acao=cadContaPj"">Acerto</a></td>
                                </tr>';

                }
             
            // ACERTO PESSOA FISICA    
            }else if (isset($dados) && ($dados['pessoa'] == "PF")){
                 
               #@ Alerta sobre acerto realizado no mês Pessoa Física
                $acertoRealizado = $_calculo->buscaAcerto($_mes_num, $dados['placa'], $dados['id_motorista'], $_ano, $dados['pessoa']);
                 
                 if(count($acertoRealizado) > 0){
                     
                     //var_dump($acertoRealizado);

                    for($i = 0; $i < count($acertoRealizado); $i++){

                        print "<div class=\"alert alert-error\" >Acerto realizados 
                                <br/>
                                <table class='table'>
                                    <tr>
                                        <td style='text-align:center; font-weight: bold' colspan='4'>".$_mes." / ".$_ano."</td>
                                    </tr>
                                    <tr>
                                        <td>Nome</td>
                                        <td>CPF</td>
                                        <td>Placa</td>
                                        <td>km</td>
                                        <td>Valor</td>
                                    </tr>
                                    <tr>
                                        <td>".$acertoRealizado[$i]['nome']."</td>
                                        <td>".$acertoRealizado[$i]['cpf_cnpj']."</td>
                                        <td>".$acertoRealizado[$i]['placa']."</td>
                                         <td>".$acertoRealizado[$i]['km']."</td>
                                        <td>".$acertoRealizado[$i]['valor']."</td>
                                    </tr>
                                </table>
                                </div>";
                    }

                 }else {
                     // mostra acerto pessoa fisica
                 
             
                    $_SESSION['acerto'] = array("id_caminhao"=>$dados['id_caminhao'],
                                                    "capacidade"=>$dados['capacidade'],
                                                    "placa"=>$dados['placa'],
                                                    "id_motorista"=>$dados['id_motorista'],
                                                    "mes"=>$_mes,
                                                    "ano"=>$_ano,
                                                    "momento"=>$dados['momento'],
                                                    "pessoa" => $dados['pessoa']);

                        print '<table class="table table-striped">
                        <tr>
                        <td>Contrato</td>
                        <td>Nome</td>
                        <td>CPF</td>
                        <td>Placa</td>
                        <td>Capacidade</td>
                        <td>Momento</td>
                        <td>Municip./Rota</td>
                        <td>Adicionar</td>
                        </tr>';

                      print '<tr>
                        <td>'.$dados['num_contrato'].'</td>
                        <td>'.utf8_encode($dados['nome']).'</td>
                        <td>'.$dados['cpf_cnpj'].'</td>
                        <td>'.$dados['placa'].'</td>
                        <td>'.$dados['capacidade'].'</td>
                        <td>'.$dados['momento'].'</td>
                        <td>'.$dados['municipio'].'<br>'.$dados['num_rota'].'</td>
                        <td><a class="btn btn-primary" href="index.php?modulo=pipa&secao=conta&acao=gerar">Acerto</a>
                        </tr>';

                        //var_dump($_SESSION['acerto']);

                       
                        
                   }
             }print '</table>';
                    
        }


	
	################################  CORRECAO DE VALORES ####################################
	}elseif($_enviar == "Correcao")	{

        // Validacao Campos 
        if((!$_mes) || ($_mes == "") || ($_mes == 'Mes')) {

            FuncaoBase::alert("O Campo MÊS está em Branco");

        
        }else if(($_placa == "") && ($_cpf == "")){
        
        }else{
            
            if(($_cpf != false) && (strlen($_cpf) == 14) && ($_placa == "")){

                $dados = $_calculo->AcertoPipeiro($_cpf, false);

            }elseif (($_placa != false) && (strlen($_placa) == 8)){

                $dados = $_calculo->AcertoPipeiro(false, $_placa);

            }elseif (($_cpf == 'CPF') and ($_placa == 'Placa')) {

                $dados = 0;
            }
        

        //var_dump($pj);
        // correcao pessoa juridica
        if((isset($dados)) && ($dados['pessoa'] == "PJ")) {
            
            //var_dump($pj);
            
            $dados = $_calculo->buscaImposto(array("ano"    =>$_ano,
                                                   "mes"    =>$_mes,
                                                   "cpf"    =>$_cpf,
                                                   "placa"  =>$_placa,
                                                   "pessoa" =>$pj));
            //var_dump($dados);                                       
            print '<table class="table">
                <tr>
                <td>Contrato</td>
                <td>Nome</td>
                <td>Placa</td>
                <td>Mes</td>
                <td>Valor</td>
                <td>Ação</td>
                </tr>';
                
                for($i=0; $i < count($dados); $i++){
                
                    print '<tr>
                            <td>'.$dados[$i]['id_contrato'].'</td>
                            <td>'.$dados[$i]['nome'].'</td>
                            <td>'.$dados[$i]['placa'].'</td>
                            <td>'.FuncaoBase::numTomes($dados[$i]['mes']).'</td>
                            <td>'.$dados[$i]['valor'].'</td>
                            <td><a class="btn btn-primary" href="secao.php?secao=conta&acao=cadContaPj&id='.$dados[$i]['id_conta'].'">Alterar</a></td>
                            </tr>';
                }

        // correcao pessoa fisica
        }else {
            
            //var_dump($_REQUEST);
            
            $dados = $_calculo->buscaImposto(array("ano"     =>$_ano,
                                               "mes"    =>$_mes,
                                               "cpf"    =>$_cpf,
                                               "placa"  =>$_placa,
                                               "pessoa" =>$pj));

            //var_dump($dados);       //FuncaoBase::vd($dados);
    
                     print '<table class="table">
                     <tr>
                     <td>Nome</td>
                     <td>Placa</td>
                     <td>Mes</td>
                     <td>Ano</td>
                     <td>inss</td>
                     <td>irrf</td>
                     <td>sestsenat</td>
                     <td>Data</td>
                     <td>gfip</td>
                     <td>liquido</td>
                     <td>valor</td>
                     <td>Alterar</td>
                     </tr>';
    
                     for($i =0; $i < count($dados); $i++)
                     {
    
                         print '<tr>
                                 <td>'. utf8_encode($dados[$i]['nome']).'</td>
                                 <td>'.$dados[$i]['placa'].'</td>
                                 <td>'.FuncaoBase::numTomes($dados[$i]['mes']).'</td>
                                 <td>'.$dados[$i]['ano'].'</td>
                                 <td>'.$dados[$i]['inss'].'</td>
                                 <td>'.$dados[$i]['irrf'].'</td>
                                 <td>'.$dados[$i]['sestsenat'].'</td>
                                 <td>'.DataMysql::dataVisual($dados[$i]['data']).'</td>
                                 <td>'.$dados[$i]['gfip'].'</td>
                                 <td>'.$dados[$i]['liquido'].'</td>
                                 <td>'.$dados[$i]['valor'].'</td>
                                 <td><a class="btn btn-primary" href="?secao=conta&acao=recalcular&id='.$dados[$i]['id_conta'].'&pessoa='.$dados[$i]['pessoa'].'">Correção</a></td>
                                </tr>';
    
                     }

        }
            
            
        }
    			
    				 
    				 print '</table>';
           
	}elseif ($_enviar == 'Importar'){

	    print $_mes."<br />";

	    print 'importanto arquivo !';

	}

	print '<br />';


    //setcookie("MES", $_POST['mes']);
	?>

					</div>
				</div>
		</div>
	</div>
	
	<div class="row-fluid text-center">
	    <br><br><br>
		<x-small><?php print RODAPE;?></x-small>
	</div>

	<script src="<?php print SISTEMA;?>/js/jquery.js"></script>
	<script src="../js/bootstrap.js"></script>
	<script src="../js/jasny-bootstrap.js"></script>
	</body>
</html>
