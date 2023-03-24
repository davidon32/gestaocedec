<?php include_once PATH.'/core/include.php';?>
<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_ajuda/Model/indexModel.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPageSimples.php";?>
<!-- =================== HEADER ============================ -->
<?php


$_liberacao = new Liberacao();
$_txt_dt_inicial = isset($_POST['txt_dt_inicial']) ? DataMysql::dataForm(htmlentities(htmlspecialchars($_POST['txt_dt_inicial']))) : "";
$_txt_dt_final   = isset($_POST['txt_dt_final'])   ? DataMysql::dataForm(htmlentities(htmlspecialchars($_POST['txt_dt_final']))) : "" ;
$_txt_municipio  = isset($_POST['id_municipio'])   ? $_POST['id_municipio'] : "";
$_txt_deposito   = isset($_POST['id_deposito'])    ? $_POST['id_deposito'] : "" ;
$_txt_material   = isset($_POST['id_produto'])     ? $_POST['id_produto'] : "";
$_txt_nivel      = $_COOKIE['seguranca']['nivel'];
$_btn_enviar     = isset($_POST['btn_enviar'])     ? true : "";


if($_btn_enviar) {
	
	$_mat_pago = RelatorioAju::MaterialPago($_txt_nivel,
        $_txt_dt_inicial,
	$_txt_dt_final,
	$_txt_municipio,
	$_txt_deposito,
	$_txt_material);
        
        $export_param = array();
        
        $export_param['txt_nivel'] = $_txt_nivel;
        
        if(!is_null($_txt_dt_inicial)){
            $export_param['txt_dt_inicial'] = $_txt_dt_inicial;
        }
        if(!is_null($_txt_dt_final)){
            $export_param['txt_dt_final'] = $_txt_dt_final;
        }
        if(!is_null($_txt_municipio)){
            $export_param['txt_municipio'] = $_txt_municipio;
        }
        if(!is_null($_txt_deposito)){
            $export_param['txt_deposito'] = $_txt_deposito;
        }
        if(!is_null($_txt_material)){
            $export_param['txt_material'] = $_txt_material;
        }
        if(!is_null($_txt_material)){
            $export_param['txt_material'] = $_txt_material;
        }

}
?>
<style>
	@media print {
		.imprimir {
			display: none;
		}
	}

	.tbl_sge.table th,tr,td {
		border:0.1em solid !important;
		border-color: #D8D8D8 !important;
	}
</style>

<?php

if(count($_mat_pago) > 0) { ?>


<div class="col-md-12 text-center">
	<br>
        <a href='<?= FuncaoBase::geraLink('ajuda', 'relatorio', 'exp_mat_pago', $export_param);?>' class='btn btn-success imprimir'>Exportar Excel </a>
	<a href='?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=ajuda&controller=relatorio&action=fbusca_pag_mat' class='btn btn-primary imprimir'>Voltar</a>
</div>
<div class="col-md-12">
	<div class="col-md-12 text-left">
		<small>Data:<?php print date("d/m/Y");?></small>
		<small> / <?php print date("H:s:m");?></small>
	</div>
		<div class="col-md-12 text-center">
				<img src="/imagem/logo_novo.png" alt="" class=""/><br>
				<legend>Relatório de Materais Pagos</legend>
				Período : <?=($_txt_dt_inicial != "") ? $_txt_dt_inicial : "__/__/____"; ?> à <?=($_txt_dt_final != "") ? $_txt_dt_final : date('d/m/Y'); ?>
				&nbsp;&nbsp;&nbsp;&nbsp;Dep.Origem: <?=($_txt_deposito != "") ? "<i>".Deposito::pegaNomeDeposito($_txt_deposito)."</i>" : "<i>Todos</i>";?>
				&nbsp;&nbsp;&nbsp;&nbsp;Municipio : <?=($_txt_municipio != "") ? "<i>".Municipio::PegaNomeMunicipio($_txt_municipio)."</i>" : "<i>Todos</i>"?>
				<hr>
		</div>
	<table class="table table-bordered table-striped table-condensed tbl_sge">
		<tr>
			<th style="text-align: center;">Nº</th>
			<th style="text-align: center;">Dt.Liberação</th>
			<th style="text-align: center;">Dt.Pagto</th>
			<th style="text-align: center;">Beneficiário</th>
			<th style="text-align: center;">Dep.Origem</th>
			<th style="text-align: center;">Destino</th>
			<th style="text-align: center;">Responsável</th>
			<!-- <th style="text-align: center;">CPF/CI</th> -->
			<th style="text-align: center;">Veículo</th>
			<th style="text-align: center;">Material</th>
			<th style="text-align: center;">Situação</th>
			<th style="text-align: center;">Motivo</th>
			<th style="text-align: center;">Ações</th>
		</tr>

		<?php
		for ($i =0; $i < count($_mat_pago); $i++) {

			$produtos = Liberacao::listaProdutos($_mat_pago[$i]['id_liberacao']);
		    
		    print "<tr>
        			<td style='font-size: 10px; text-align: center;'>".$_mat_pago[$i]['id_liberacao']."</td>";
        	print "<td style='font-size: 10px; text-align: center;'>".DataMysql::dataVisual($_mat_pago[$i]['dataLibera'])."</td>";
            print "<td style='font-size: 10px; text-align: center;'>".DataMysql::dataVisual($_mat_pago[$i]['dtPagto'])."</td>";
            print "<td style='font-size: 10px; text-align: center;'>".$_mat_pago[$i]['beneficiario']."</td>";
            print "<td style='font-size: 10px; text-align: center;'>".Deposito::pegaNomeDeposito($_mat_pago[$i]['depDestino'])."</td>";
            print "<td style='font-size: 10px; text-align: center;'>".Municipio::PegaNomeMunicipio($_mat_pago[$i]['id_municipio'])."</td>";
            print "<td style='font-size: 10px; text-align: center;'>".$_mat_pago[$i]['responsavel']."</td>";
            #print "<td style='font-size: 10px; text-align: center;'>".$_mat_pago[$i]['cpf_resp']."<br>".$_mat_pago[$i]['nDocumento']."</td>";
		    print "<td style='font-size: 10px; text-align: center;'>".$_mat_pago[$i]['veiculo']. "<br>". $_mat_pago[$i]['placa'].!"</td>";
			print "<td style='font-size: 10px; text-align: left;'>";
			
			print "<table>";
			foreach ($produtos as $key => $value) {
				print "<tr><td>".$value['evento']."&nbsp;&nbsp;</td>";
				print "<td>".$value['nome']."</td>";
				print "<td>".$value['descricao']."</td>";
				print "<td>".$value['quantidade']."</td>";
			}
			print "</tr></table>";
			print "<td style='font-size: 10px; text-align: center;'>".$_mat_pago[$i]['situacao']."</td>";
			print "<td style='font-size: 10px; text-align: center;'>".$_mat_pago[$i]['motivo']."</td>";
			
            print "</td>";
			print "<td style='font-size: 10px; text-align: center;'>
				<a data-id_liberacao='".$_mat_pago[$i]['id_liberacao']."' class='btn btn-info imprimir' title='2º Via comprovante de Pagamento de Materiais Liberados' name='lk_recibo'>2ª Via C.Pgto</a>
				<a href=\"?token=".hash('sha256', md5(VERSAO).date('dmY'))."&ac=itn&modulo=ajuda&controller=relatorio&action=visualizarRec&id=".$_mat_pago[$i]['id_liberacao']."&m=12872\" title='Visualizar recibo Digitalizado de Pagamento' class='imprimir'><img width='25' src='core/imagem/recibo.png'></a>
			</td>";
			
            print "</tr>";
       }
?>

	</table>
</div>

<?php } else {
    
    print "<br><br><br><h4><p class='alert alert-danger text-center'>Sua consulta não retornou resultados para exibição ! <br> verifique os parametros de pesquisa ! </p></h4>";
    
    print "<p class='text-center'><a class='btn btn-success' href='".FuncaoBase::geraLink('ajuda', 'relatorio', 'fbusca_pag_mat')."'>Voltar</a>";
}

?>

<?php include_once "template/page/rodapePage.php"; ?>
<script>
    
    $(document).ready(function () {
        
        $("a[name=lk_recibo]").click(function(event){
            var result = confirm('Deseja Visualizar o nome no Recibo ?');
            event.preventDefault();
            if(result) {
                window.location.href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'))?>&ac=itn&modulo=ajuda&controller=conestoque&action=imprecibopg&nlib="+$(this).data('id_liberacao')+"&m=12872&nom=s";
            }else {
                window.location.href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'))?>&ac=itn&modulo=ajuda&controller=conestoque&action=imprecibopg&nlib="+$(this).data('id_liberacao')+"&m=12872";
            }
        });
    
    });
</script>
    