<?php session_start();
print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
include_once '../include.php';

$_conexao = new ConexaoMysql();

$_login = new Login();

$_login->VerificaBrowser();

$_login->logado(CAD_ACERTO, $MODULO['mod_pipa']);

$_login->Sessao();

$calculo = new Calculo();

$funcaoBase = new FuncaoBase();

if(isset($_SESSION['dadosConta'])){
 
    //* Dados para alteração */
    $dados = $_SESSION['dadosConta'];
    //unset($_SESSION['dadosConta']);

    //var_dump($dados);
}else {
    
    print "<script type=\"text/javascript\">";

    //print "window.location = 'index.php';";

    print "</script>";

    
}

?>
<html>
<head>
<title>Pesquisa de Contrato</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="<?php print SISTEMA;?>/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="<?php print SISTEMA;?>/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
</head>
<body>
	<div class="container">
		<div class="row-fluid text-center">
			<img src="../imagem/topo_pipa.png">
				<hr>
		</div>
		<!-- BARRA -->
		<div class="row-fluid">
			<div class="span6 text-left">
				<small><?php print "Data :".date("d/m/Y");?> </small>
			</div>
			<div class="span6 text-right">
				<small><?php print "Hora :".date("H:i:s");?> </small>
			</div>
		</div>

		<!-- LOGOUT -->
		<div class="row-fluid">
			<div class="span12 text-right">
				<a class="btn btn-primary" href="<?php print SISTEMA;?>/core/logout.php?logout=s" title="Logout do Sistema">Logout</a>
				<p>
					<hr>
			
			</div>
		</div>
		<div class="row-fluid">
			<!-- MENU -->
			<div class="span3">
				<?php include_once 'visao/pipa.menu.php';?>
			</div>
			<div class="span9">

				<form action="secao.php?secao=conta&acao=alterarConta" method="POST" name="" id="" class="" />
                <!-- <form action="secao.php?secao=conta&acao=validaCorrecao" method="POST" name="" id="" class="" /> -->

				<table class="table table-bordered" cellspacing="0" border="0" >
                    <tr>
                       <td colspan="4" align="center"><legend>Alterar dados Conta</legend></td>
                    </tr>
                    <tr>
                       <td algin="center"><b>Motorista</b></td>
                       <td align="center"><?php print $dados['nome'];?></td>
                       <td align="center"><b>Placa</b></td>
                       <td align="center"><?php print $dados['placa'];?></td>
                    </tr>
                    <tr>
                       <td algin="center"><b>Mes</b></td>
                       <td align="center"><?php print $funcaoBase->numTomes($dados['mes']);?></td>
                       <td align="center"><b>Ano</b></td>
                       <td align="center"><?php print $dados['ano'];?></td>
                    </tr>
                    </table>
                    
                    <table class="table-hover" cellspacing="0" >
                        
                        <tr>
                            <td>
                            Inss<br>
                            <input type='text' name='txtInss' id='txtInss' value="<?php print $dados['inss'];?>">
                            <input type='hidden' name='txtIdConta' id='txtIdConta' value="<?php print $dados['id_conta'];?>">
                            </td>
                                
                        </tr>
                            <tr>
                                <td>
                                KM</br>
                                <input type='text' name='txtKm' id='txtKm' value="<?php print $dados['km'];?>" readonly="readonly">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                SestSenat</br>
                                <input type='text' name='txtSestSenat' id='txtSestSenat' value="<?php print $dados['sestsenat'];?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                Gfip</br>
                                <input type='text' name='txtGfip' id='txtGfip' value="<?php print $dados['gfip'];?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                Lote</br>
                                <input type='text' name='txtLote' id='txtLote' value="<?php print $dados['lote'];?>" readonly="readonly">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                Obs</br>
                                <textarea name='txtObs' id='txtObs' cols='60' rows='7' class="span12" ><?php print $dados['obs'];?></textarea>
                                </td>
                            </tr>
                    
                        </table>
				

				
				<br>
				<input type="submit" class="btn btn-primary" name="btnCorrecao" id="btnCorrecao" value="Correção" class="" />

				
				</td>
				</tr>

				</table>
				</form>
</div>
</div>
<?php 

    $inss      = isset($_POST['txtInss']) ? $_POST['txtInss']   : "";
    $sestSenat = isset($_POST['txtSestSenat']) ? $_POST['txtSestSenat'] : "";
    $gfip      = isset($_POST['txtGfip']) ? $_POST['txtGfip']   : "";
    $lote      = isset($_POST['txtLote']) ? $_POST['txtLote']   : "";
    $obs       = isset($_POST['txtObs'])  ? $_POST['txtObs']    : "";
    $idConta   = isset($_POST['txtIdConta'])  ? $_POST['txtIdConta'] : "";
    $btnEnviar = isset($_POST['btnCorrecao']) ? true : false;
    
    if($btnEnviar) {
        
        $campos = array("Inss"=>$inss,
                        "SestSenat"=>$sestSenat,
                        "Gfip"=>$gfip,
                        "Lote"=>$lote,
                        "Campo Interno"=>$idConta);
        
        if($funcaoBase->campoBranco($campos)) {
                
            if($calculo->AlterarConta($inss, $sestSenat, $gfip, $lote, $obs, $idConta)){

                print "<script type=\"text/javascript\">";
    
                print "alert('Correção realizada com Sucesso !');";
    
                print "window.location = 'secao.php?secao=conta&acao=buscarAlterar';";
    
                print "</script>";
                
            }else {
                
                print "<script type=\"text/javascript\">";
    
                print "alert('Conta não atualizada !');";
    
                print "window.location = 'secao.php?secao=conta&acao=buscarAlterar';";
    
                print "</script>";
                
            }
            
            
        }        
        
    }
?>


				<script src="<?php print SISTEMA;?>/js/jquery.js"></script>
				<script src="<?php print SISTEMA;?>/js/bootstrap.js"></script>
				<script src="<?php print SISTEMA;?>/js/jasny-bootstrap.js"></script>

</body>
</html>



