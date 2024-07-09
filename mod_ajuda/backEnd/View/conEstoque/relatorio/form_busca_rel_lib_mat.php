<?php include_once PATH . '/core/include.php'; ?>
<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_ajuda/Model/indexModel.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPageSimples.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";
?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";


$_deposito = new Deposito();

$_municipio = new Municipio();

//$unidade = RelatorioAju::itensUnidade();

$unidade = Unidade::ListUnidade();

$eventoModel = new EventoConEstoqueModel;
$eventos = $eventoModel->listaEvento();

?>

<p class="text-center">
    <legend>Relat&oacute;rio de Libera&ccedil;&otilde;es</legend>
</p>

<div class="col-md-1"></div>
<div class="col-md-5">
    <form method="POST" id="frmPesquisa" action="?token=<?= hash('sha256', md5(VERSAO) . date('dmY')); ?>&ac=itn&modulo=ajuda&controller=relatorio&action=rel_lib_mat" name="frm_rel_liberacao">
    
        <div class="col-md-12">
            <label>Dep&oacute;sito Origem Material:</label>
            <?php if ($_COOKIE['seguranca']['secao'] != "REDEC") {
                $_deposito->pegaDeposito();
            } else {
                print "<select class=\"form-control\" name='id_deposito' id='id_deposito'>
                            <option value=" . $_COOKIE['seguranca']['id_deposito'] . ">" . Deposito::PegaNomeDeposito($_COOKIE['seguranca']['id_deposito']) . "</option>
                            </select>";
            }
            ?>
        </div>
        <div class="col-md-12">
            <br>
            <label>Data Inicial:</label>
            <input class="form-control" type="text" name="txtDtInicial" id="txtDtInicial" data-mask="99/99/9999" title="Periodo Inicial de Liberações " required value="<?=date('d/m/Y')?>"/>
        </div>
        <div class="col-md-12">
            <br>
            <label>Data Final:</label>
            <input class="form-control" type="text" name="txtDtFinal" id="txtDtFinal" data-mask="99/99/9999" title="Periodo Final de Liberações" required value="<?=date('d/m/Y')?>"/>
        </div>
        <div class="col-md-12">
            <br>
            <label>Munic&iacute;pio:</label>
            <?php $_municipio->PegaMunicipio(); ?>
        </div>

        <div class="col-md-12">
            <br>
            <label for="listEvento">Evento</label>
            <select name="selEvento" id="selEvento" class="form form-control">
                <option value="">Todos</option>
                <?php
                foreach ($eventos as $evento) {
                    print "<option>" . $evento['nome'] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="col-md-12">
            <br>
            <!--<div class="form-group">
				<label for="ckListMat">Listagem por Materiais</label>
				<input type="checkbox" name="ckListMat" id="ckListMat">
		</div>-->
            <div class="form-group" id="lista">
                <label for="ckListMat">Material</label>
                <input class="form form-control" type="text" name="nome_material" id="nome_material">
                <input type="hidden" name="id_material" id="id_material">

                <!--<select class="form-control" name="id_material" id="id_material">
					<option value="">Todos</option>
					<?php

                    foreach ($unidade as $value) {
                        print "<option value='" . $value['id_unidade'] . "'>" . $value['nome'] . "/ " . $value['descricao'] . " </option>";
                    } ?>
				</select>-->

            </div>
        </div>
        <div class="col-md-12">
            <label>Região de Defesa Civil</label>
            <select class="form form-control" name="selRegiao" id="selRegiao">
                <option value="">Todas as Regiões</option>
                <?php
                for ($i = 1; $i <= 19; $i++) {
                    print "<option value='" . $i . "'>" . $i . " º Região DC</option>";
                }

                ?>
            </select>
            <br>
        </div>

</div>
<div class="col-md-5">

    <br>

    <label>Tipo</label><br>
    <input type="radio" id="" name="rbTipo" value="normal" checked="checked" />&nbsp; Normal<br>
    <input type="radio" id="" name="rbTipo" value="list" />&nbsp; Listagem<br>

    <br>

    <label>Ordenar por :</label><br>
    <input type="radio" id="" name="rbOrdem" value="1" checked="checked" />&nbsp; Data Liberação<br>
    <input type="radio" id="" name="rbOrdem" value="2" />&nbsp; Origem<br>
    <input type="radio" id="" name="rbOrdem" value="3" />&nbsp; Deposito Origem<br>
    <input type="radio" id="" name="rbOrdem" value="4" />&nbsp; Região DC<br><br>
</div>

<div class="col-md-12 text-center">
    <input class="btn btn-primary" type="submit" name="pesquisar" id="pesquisar" value="Pesquisar" />
    &nbsp;&nbsp;<a class="btn btn-success" href="?token=<?= hash('sha256', md5(VERSAO) . date('dmY')); ?>&ac=itn&modulo=ajuda&controller=conestoque&action=relIndex">Voltar</a>
</div>
</form>
<div class="col-md-1"></div>
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>
<script type="text/javascript">
    

        $("#frmPesquisa").on("submit", function (event) {
            event.preventDefault();

            var dt_inicio = $("#txtDtInicial").val().substr(6,4)+"-"+$("#txtDtInicial").val().substr(3,2)+"-"+$("#txtDtInicial").val().substr(0,2);
            var dt_final = $("#txtDtFinal").val().substr(6,4)+"-"+$("#txtDtFinal").val().substr(3,2)+"-"+$("#txtDtFinal").val().substr(0,2);


            var difms = new Date(dt_final) - new Date(dt_inicio);

            var difDias = (difms / (1000 * 60 * 60 * 24));

            if( ($("input[name=rbTipo]:checked").val() == 'list') && (difDias > 185)){
                swal.fire('Atenção\n Por motivos técnicos, \n Esse tipo de relatório tem um limite de 6 meses para o filtro das datas !');
            }else {
                event.currentTarget.submit();
            }

        });




    $("#txtDtInicial").datepicker({
        dateFormat: 'dd/mm/yy'
    });
    $("#txtDtFinal").datepicker({
        dateFormat: 'dd/mm/yy'
    });


    $("#ckListMat").attr("checked", false);
    $("#lista").hide();

    $("#ckListMat").click(function() {

        if ($("#ckListMat").is(":checked")) {

            if ($("#lista").is(":visible")) {

            } else {
                $("#lista").show(700);
            }
            $("#ckListMat").attr("checked", true);
        } else {
            $("#lista").hide(700);
            $("#ckListMat").attr("checked", false);
        }
    });

    var itemMaterial = {
        data: <?php print json_encode($unidade); ?>, // array com os dados
        getValue: "nome",
        /* alterar com nome do item BD */

        list: {
            match: {
                enabled: true,
            },
            onSelectItemEvent: function() {
                var nome = $("#nome_material").getSelectedItemData().nome;
                var id = $("#nome_material").getSelectedItemData().id_unidade;
                $("#id_material").val(id);


            }
        },
        template: {
            type: "custom",
            method: function(value, item) {
                return item.id_unidade + " - " + value;
            }
        },
    };
    /*********** autocomplete origem ***********/
    $("#nome_material").easyAutocomplete(itemMaterial);
</script>