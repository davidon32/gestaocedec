<?php session_start();
print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
include_once '../include.php';

$_conexao = new ConexaoMysql();

$_login = new Login();

$_login->VerificaBrowser();

$_login->logado(CAD_ACERTO, $MODULO['mod_pipa']);

$_login->Sessao();

$_calculo = new Calculo();

?>
<html>
<head>
<title>Pesquisa de Contrato</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="<?php print SISTEMA;?>/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="<?php print SISTEMA;?>/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
	<script type="text/javascript">

function levarcodigo( id_contrato, num_contrato, id_motorista, id_caminhao, id_rota )
{
   /** O "segredo" está aqui nessas duas linhas, onde é passado o codigo para o <input>
   *    e a descricao para o <label>
   */
   top.opener.document.getElementById("id_contrato").value = id_contrato;
   top.opener.document.getElementById("num_contrato").value = num_contrato;
   window.close();
}
    
</script>
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
			<div class="span9 fdo_corpo">

				<form action="#" method="POST" name="" id="" class="" />

				<label>Placa</label>
				<input type="text" name="placa" id="placa" data-mask="aaa-9999" >
				<br />
				<?php FuncaoBase::mes();
				

				?>
				<br>
				<input type="submit" class="btn btn-primary" name="pesquisar" id="pesquisar" value="Pesquisar" class="" />
                <br>
                <br>
				<?php 

    				$placa = isset($_POST['placa']) ? $_POST['placa'] : null;
    				$mes   = isset($_POST['mes']) ? $_POST['mes'] : null;
    
    				if($placa != null && $mes != 'Mes'){
      
    					$dados = $_calculo->buscaContaAlterar(FuncaoBase::mesTonum($mes), $placa);
    
    					$_SESSION['dadosConta'] = $dados;
    					
    					//var_dump($dados);
                        
                     print "<table class=\"table table-bordered\" cellspacing=\"0\" border=\"0\" >
                            <tr>
                               <td align=\"center\"><legend>Alterar dados Conta</legend></td>
                            </tr>
                            <tr bgcolor=\"#FF7F24\">
                               <td algin=\"center\"><b>Motorista</b></td>
                               <td algin=\"center\"><b>CPF</b></td>
                               <td algin=\"center\"><b>Mes</b></td>
                               <td align=\"center\"><b>Placa</b></td>
                               <td align=\"center\"><b>Ano</b></td>
                               <td align=\"center\"><b>Alterar</b></td>
                            </tr>";
                     
                                             
                     
                         print "<tr>
                                   <td align=\"center\">".utf8_encode($dados['nome'])."</td>
                                   <td align=\"center\">".$dados['cpf_cnpj']."</td>
                                   <td align=\"center\">".$dados['mes']."</td>
                                   <td align=\"center\">".$dados['placa']."</td>
                                   <td align=\"center\">".$dados['ano']."</td>
                                   <td align=\"center\"><a href=\"secao.php?secao=conta&acao=alterarConta\"><i class='icon-edit' title='Clique aqui para alterar a conta'></a></i></td>
                                </tr>";

                     print "</table>";
	
				    }
                    
                    

				?>
				
				</form>

				<script src="<?php print SISTEMA;?>/js/jquery.js"></script>
				<script src="<?php print SISTEMA;?>/js/bootstrap.js"></script>
				<script src="<?php print SISTEMA;?>/js/jasny-bootstrap.js"></script>

</body>
</html>



