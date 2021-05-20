<?php include_once PATH . '/core/include.php'; ?>
<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_ajuda/Model/indexModel.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php include_once "template/page/menu.php"; ?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>
<?php

/* ****************************************************************************************
*   Org�o Gestor : CEDEC - MG
*	Sistema      : Sistema de Defesa de Civil Decretacao
*
*	Autor        :  Demetrio Silva Passos
*	Funcao       :  busca processos para controle de decretacao
	Data         :  21/05/2020
*
*******************************************************************************************/
$_municipio = new Municipio();

$_processo = new Decretacao();

$_desastre = new Desastre();

?>

<div class='col-md-12 text-center'>
    <a class="btn btn-success"
        href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=decreto&controller=index&action=index">Voltar</a><br>
    <br>
</div>
<div class="col-md-6">

    <form action="" method="POST" name="frm_pesquisa" id="frm_pesquisa" novalidate>

        <label>Municipio</label>
        <?php $_municipio->PegaMunicipio(); ?>
        <!-- <input type="text" name="txt_dt_processo" id="txt_dt_processo">-->
        <label>Ano</label>
        <input class="form-control" type="text" name="txt_ano" id="txt_ano" data-mask="9999" value="" />

        <label>Desastre</label>
        <?php print Decretacao::comboCobrade(); ?>
        <br>
        <input class="btn btn-primary" type="submit" name="btn_enviar" id="btn_enviar" value="Pesquisar" />

    </form>
    <br>
</div>
<br>

<?php

//var_dump($_POST);

$_id_municipio = isset($_POST['id_municipio']) ? $_POST['id_municipio'] : "";
$_txt_ano      = isset($_POST['txt_ano'])      ? $_POST['txt_ano']      : "";
$_sel_desastre = isset($_POST['sel_desastre']) ? $_POST['sel_desastre'] : "";
$_btn_enviar   = isset($_POST['btn_enviar'])   ? true 	    	        : "";

if ($_btn_enviar) {

	$_dados = $_processo->pesquisaProcesso($_id_municipio, $_txt_ano, $_sel_desastre);
	
	if (!empty($_dados)) {

		print "<div class='col-md-12'>";
		print "<table class=\"table table-bordered table-condensed table-striped\">
											<tr>
												<th>Cod</th>
												<th>Municipio</th>
												<th>Data Entrada</th>
												<th>Ano</th>
												<th>Vigência</th>
												<th>Desastre</th>
												<th>Ação</th>
											</tr>";

		foreach ($_dados as $value) {

			$dias_venc = Decretacao::RestanteDecreto($value['id_processo']);

			if($dias_venc == "Vencido"){
				$dec_venc = "style='background-color:#B22222;color:#ffffff' title='Decreto Vencido'";
			}else {
				//$dec_venc = "style='background-color:#FF8C00' title='Decretos Vencidos'";
				$dec_venc = "title=' Restan : ".$dias_venc." dia(s) para vencer o decreto !'";
			}

			print "<tr>
				<td ".$dec_venc.">" . $value['id_processo'] . "</td>
				<td ".$dec_venc.">" . $_municipio->PegaNomeMunicipio($value['id_municipio']) . "</td>
				<td ".$dec_venc.">" . DataMysql::dataVisual($value['data_entrada']) . "</td>
				<td ".$dec_venc.">" . $value['ano_processo'] . "</td>
				<td ".$dec_venc.">" . DataMysql::dataVisual($value['data_venc_process']) . "</td>
				<td ".$dec_venc.">" . $_desastre->idToNome($value['cod_desastre_cobr']) . "</td>
				<td ".$dec_venc."><a href=\"index.php?modulo=decreto&controller=decreto&action=processo.dados&id=" . $value['id_processo'] . "\"><img src=\"/core/imagem/delete.png\" title=\"Alterar Processo\"></i></a>&nbsp;&nbsp;&nbsp;
					<a href=\"index.php?modulo=decreto&controller=decreto&action=processo.consulta&id=" . $value['id_processo'] . "\"><img src=\"/core/imagem/view.png\" title=\"Consulta Processo\"></i></a>
				</td>
				</tr>";
		}
		print "</table>";
	} else {
		print "<div class=\"col-md-12\"><p class=\"alert alert-danger\">Não existe Processo para o Filtro escolhido</p></div>";
	}

	print "</div>";
}

?>



<script src="/js/jquery.js"></script>
<script src="/js/bootstrap.js"></script>
<script src="/js/jasny-bootstrap.js"></script>

</body>

</html>