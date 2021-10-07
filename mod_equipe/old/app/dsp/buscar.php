<?php session_start();
print "<!DOCTYPE html>";
include_once PATH.'/include.php';
/************************************************************************************+
 #	Secretária  : Gabinete Militar do Governado de Minas Gerais                      #
 #	Órgão       : Coordenadoria Estadual de Defesa Civil do Estado de Minas Gerais   #
 #  Autor       : Demetrio S. Passos     											 #
 #  Criação     : 00/00/0000														 #
 #	Descrição   : cadastro de DSP
 #
 +************************************************************************************/

$_conexao = new ConexaoMysql();

$_municipio = new Municipio();

$_funcionario = new EquipeFuncionario();

$_funcaoBase = new FuncaoBase();

$_dsp = new EquipeDSP();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php print TITULO; ?></title>
<link href="/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
</head>
<body>
	<div class="container">
		<div class="row-fluid text-center">
			<img src="../imagem/topo_pipa.png" />
			<hr>
		</div>
		<!-- BARRA -->
		<div class="row-fluid">
			<div class="span6 text-left">
				<small><?php print "Data :" . date("d/m/Y"); ?> </small>
			</div>
			<div class="span6 text-right">
				<small><?php print "Hora :" . date("H:i:s"); ?> </small>
			</div>
		</div>

		<!-- LOGOUT -->
		<div class="row-fluid">
			<div class="span12 text-right">
				<a class="btn btn-primary" href="<?php print SISTEMA; ?>/core/logout.php?logout=s" title="Logout do Sistema">Logout</a>
				<p>	
				<hr>
			</div>
		</div>

		<div class="row-fluid">

			<!-- MENU -->
			<div class="span3">
				<?php
                    include_once PATH."/mod_".$modulo.'/app/elemento/'.$modulo.'.menu.php';
                ?>
			</div>

			<!-- CORPO PAGINA  -->
			<div class="span7 fdo_corpo">
			 <table class="table">
			     <tr>
			         <td colspan="3"><legend>Pesquisa DSP</legend></td>
			     </tr>
			     <tr>
			         <td colspan="3">
			             <form action="index.php?modulo=equipe&secao=dsp&acao=buscar" method="POST" name="frm_cad_dsp">

                            <label>Data</label>
                            <input type="text" name="txtDtDsp" id="txtDtDsp" title="Data da DSP" class="" data-mask="99/99/9999">
        
                            <label>Número DSP</label>
                            <input type="text" name="txtNumDsp" id="txtNumDsp" title="Número da DSP" class="" >
                            <br>
                            <label>Ano</label>
                            <input type="text" name="txtAno" id="txtAno" title="Ano da DSP" class="" data-mask="9999">
                            <br>
                                                
                            <input type="submit" class="btn btn-primary" value="Pesquisar" name="btnEnviar" id="btnEnviar" >
                            
                         </form>
			         
			         </td>
			     </tr>
			 </table>
				
				
					<?php 
					
					   $numDsp = isset($_POST['txtNumDsp']) ? $_POST['txtNumDsp'] : "";
					   $dtDsp  = isset($_POST['txtDtDsp'])  ? $_POST['txtDtDsp']  : "";
					   $ano    = isset($_POST['txtAno'])    ? $_POST['txtAno']    : "";
					   $btnEnviar = isset($_POST['btnEnviar']) ? true : false;
					
					   if($btnEnviar) {
					       
                           $dados = $_dsp->buscaDspDados($numDsp, $ano, $dtDsp);
                           
                           
                           
                           //var_dump($dados);

                           print "<table class='table table-bordered'>
                                    <tr>
                                        <td>Num DSP</td>
                                        <td>Data DSP</td>
                                        <td>Comandante DSP</td>
                                        <td style='text-align:center'><i class='icon-print'></i></td>
                                        <td style='text-align:center'><i class='icon-pencil'></i></td>
                                    </tr>";
                                    
                           for ($i=0; $i < count($dados) ; $i++) {
                                   
                               $situacao = $dados[$i]['situacao'];
                               
                               $dspAberta = ($situacao == 2) ? "style='color:red'" : "";
                               $btnAlterar = ($situacao == 1) ? "Fechada" : "<a class='btn' title='Alterar DSP' href='index.php?token=".hash('sha256', md5(VERSAO).date('dmY'))."&ac=&modulo=equipe&secao=dsp&acao=alterar&id=".$dados[$i]['id_dsp']."'>Alterar</a>";

                               $cmdDSP = $_dsp->BuscaCmd($dados[$i]['id_dsp']);
                               
                               //var_dump($cmdDSP);
                               
                                print "<tr>
                                        <td ".$dspAberta.">".$dados[$i]['num_dsp']."</td>
                                        <td ".$dspAberta.">".DataMysql::dataVisual($dados[$i]['dt_dsp'])."</td>
                                        <td ".$dspAberta.">".utf8_encode($cmdDSP['nome'])."</td>
                                        <td><a title='Visualizar DSP' class='btn' href='index.php?token=".hash('sha256', md5(VERSAO).date('dmY'))."&ac=&modulo=equipe&secao=dsp&acao=impressao&id=".$dados[$i]['id_dsp']."&tp=".$dados[$i]['tipo']."&mod=vs'>Visualizar</a></td>
                                        <td ".$dspAberta.">".($btnAlterar)."</td>
                                    </tr>";
                                # <a class='btn' href='secao.php/dsp/alterar'>Alterar</a>
                               
                           }
                           
                           print "<table>";
    
					   }
					
					?>

			</div>

		<!-- RODAPE -->
		<div class="row-fluid">
			<div class="span12 text-center">
				<small><?php print RODAPE; ?> </small>
			</div>
		</div>
	</div>

	<script src="/js/jquery.js"></script>
	<script src="/js/bootstrap.js"></script>
	<script src="/js/jasny-bootstrap.js"></script>
	<script src="/js/funcaobase.js"></script>

	<script type="text/javascript">
		var nome = "";
		var id_dest = "";

		var func = "";
		var id_func = "";

		/* monta lista com os funcionarios da dsp */
		$(document).ready(function() {

			$("#btn_add_funcionario").click(function() {

				func += $("#sel_funcionario option:selected").text() + ",";
				id_func += $("#sel_funcionario").val() + ",";

				$("#txt_funcionario").val(func);
				$("#txt_lista_func").val(id_func);

			});

			$("#txt_funcionario").change(function() {

				func = $("#txt_funcionario").val();

				$("#txt_funcionario").val(func);
				$("#txt_lista_func").val(id_func);

			});

		});

		/* monta lista com os destinos da dsp */
		$(document).ready(function() {

			$("#btn_add_destino").click(function() {

				nome += $("#id_municipio option:selected").text() + ",";
				id_dest += $("#id_municipio").val() + ",";

				$("#txt_destino").val(nome);

			});

			$("#txt_destino").change(function() {

				nome = $("#txt_destino").val();

				$("#txt_destino").val(nome);

			});

		});

		/* limpa a lista com os funcionarios */
		$(document).ready(function() {

			$("#btn_limpar").click(function() {

				$("#txt_funcionario").val('');
				func = "";
				id_func = "";

			});

		});

		/* limpa a lista com os destinos */
		$(document).ready(function() {

			$("#btn_limparm").click(function() {

				$("#txt_destino").val('');
				nome = "";
				id_dest = "";

			});

		});
     </script>

</body>
</html>
