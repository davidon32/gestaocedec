<?php session_start();
print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
include_once '../include.php';

$con = Conexao::getInstance();

$_funcionario = new EquipeFuncionario();

?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php print TITULO; ?></title>
		<link href="/css/bootstrap.css" rel="stylesheet" media="">
    <link href="/css/bootstrap-responsive.css" rel="stylesheet" media="">
	</head>
	<body>
	<div class="container">

		<!-- TOPO -->
		<div class="row-fluid text-center">
			<img src="../imagem/topo_gestao.png" alt="Topo" />
			<hr>
		</div>

		<!-- BARRA -->
		<div class="row-fluid">
			<div class="span6 text-left">
				<small><?php print "Data :" . date("d/m/Y"); ?></small>
			</div>
			<div class="span6 text-right">
				<small><?php print "Hora :" . date("H:i:s"); ?></small>
			</div>
		</div>

		<!-- OPÇOES USUÁRIO -->
		<div class="row-fluid text-right"> 
           <?php
            //require_once('view/menu.adm.php');
            ?>
		 </div>
		 
		 Ordenador de Despesas<br>
        <form action="#" method="POST">
                    
            <?php
                        
                //$_parametro = FuncaoBase::pegaParametro();
                // var_dump($_parametro); 
                //$_funcionario->getNomeDiretoria(false, "6", $_parametro['ordDespesa']) ?>
                //<input class="btn" type="submit" name="btnEnviar" id="btnEnviar" />
        </form>
            <?php 
                //var_dump($_POST);
                $id_ordenador = isset($_POST['sel_nDiretoria']) ? $_POST['sel_nDiretoria'] : "";
                 $enviar = isset($_POST['btnEnviar']) ? $_POST['btnEnviar'] : "";  
                                
                if($enviar) {
                     $result = $_funcionario->alterarOrdenador($id_ordenador);
                        if($result) {
                            print "<script type=\"text/javascript\">";
                            print "alert('Alteração realizada com Sucesso !');";
                            print "window.location.href = 'adm';";
                            print "</script>"; 
                        }
                }
            ?>
	 </div>
	 
	  <!-- MENSAGEM DO SISTEMA-->
	  <div class="tab-pane" id="tab4">
                    <form action="/index.php?modulo=administrator&secao=mensagem&acao=valida" method="POST" name="cad_msg">
    
                        <table align="center" border="0">
                            <tr>
                                <th colspan="3">Mensagens e Avisos do Sistema</th>
                            </tr>
                            <tr><td colspan="2">&nbsp;</td></tr>
                            <tr>
                                <td>Titulo</td><td>:</td><td><input type="text" name="titulomsg" id="" size="74" value="" /></td>
                                
                            </tr>
                            
                            <tr>
                                <td valign="top">Mensagem</td>
                                <td valign="top">:</td>
                                <td valign="top"><textarea cols="45" id="msg" name="msg" rows="5" maxlength="255" onkeyup="mostrarResultado(this.value,254,'spcontando');contarCaracteres(this.value,254,'sprestante')"></textarea><br />
                                                    <span id="spcontando" >Ainda não temos nada digitado..</span><br />
                                                    <span id="sprestante" style="font-family:Georgia;"></span></td>
                            </tr>
                            <tr>
                                <td align="center" colspan="3"><input class="btn" type="submit" name="enviar" id="enviar" value="Cadastrar" /></td>
                            </tr>
                        </table>
                    </form>
                </div>


		<div class="row-fluid">
			<!-- MENU -->
			<div class="span2">
            <?php include_once 'view/menuadm.php';?>
          </div>

			<!-- CORPO -->
			<div class="span10"></div>
			<br>
			<br>
			<div class="span12 text-center">
            <?php print RODAPE;?>
        </div>
		</div>

	</div>

	<script src="/js/jquery.js"></script>
<script src="/js/bootstrap.js"></script>
<script src="/js/jasny-bootstrap.js"></script>
<script src="/js/funcaobase.js"></script>

</body>
</html>