<?php include_once PATH . '/core/include.php'; ?>
<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_ajuda/Model/indexModel.php"; ?>

<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>

<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php
include_once "template/page/corpoHeader.php";

$municipios = Municipio::listaid_municipioAutocomplete();
?>

<br>

<div class="row">
    <div class="col col-md-12">
        <!-- Pedido Cesta -->
        <div class="row">
            <div class="col-md-6">

                <!--####################### PEDIDO DE AJUDA HUMANITARIO ###########################-->
                <?php
                $permissao = Usuario::getPermissao('cedec_usuario', 'it_m_registro');
                if ($permissao == "1") {
                    ?>

                    <form action="<?= FuncaoBase::geraLink('registro', 'index', 'desabrigado') ?>" method="POST" name="frmRegistra" id='frmRegistro'>
                        <label>Data de Lancamento</label>
                        <input class='form form-control' type="date" name="dt_registro" id="dt_registro" required value="<?= date('Y-m-d') ?>" max="<?= date('Y-m-d') ?>">

                        <label>Números de Desabrigados :</label><br>
                        <span>
                            <b>Desabrigado</b>: Pessoa cuja habitação foi afetada por dano ou ameaça de dano que necessita
                            de abrigo custeado pela prefeitura, ou seja, pessoa que saiu da sua residência
                            afetada para ser mantida em um abrigo temporário, ou sob aluguel social,
                            ou hospedagem custeados pela prefeitura.
                        </span>
                        <input class='form form-control' type="number" name="desabrigado" id="desabrigado" required >
                        <br>
                        <label>Números de Desalojados :</label><br>
                        <span>
                            <b>Desalojado</b>: Pessoa que foi obrigada a abandonar temporariamente ou definitivamente sua
                            habitação, em função de evacuações preventivas, destruição ou avaria grave, decorrentes
                            do desastre, que não carece de abrigo custeado pela prefeitura, ou seja, pessoa que saiu
                            da sua residência afetada e se instalou na casa de amigos ou parentes.
                        </span>
                        <input class='form form-control' type="number" name="desalojado" id="desalojado" required >
                        <br>
                        <label>Município :</label><br>
                        <input class='form form-control' type="text" name="municipio" id="municipio" required >
                        <input class='form form-control' type="hidden" name="id_municipio" id="id_municipio" >
                        <!-- gravar registro pela cedec -->
                        <input class='form form-control' type="hidden" name="cedec" id="cedec" value="1" >
                        <br>
                        <input class='btn btn-primary' type="submit" name="btnGravar" id="btnGravar" value="Gravar">

                    </form>
                    <?php
                }
                ?>
            </div>


            <div class="col-md-6 text-center">
                <legend>Últimos Registros</legend>
                <?php
                $registro = new Registro;

                $registros = $registro->listaPorMunicipio();

                print "<table class='table table-condensed table-responsive'>";
                print "<tr>";
                print "<th>Município</th>";
                print "<th>Data Registro</th>";
                print "<th>Desabrigados</th>";
                print "<th>Desalojados</th>";
                print "</tr>";

                foreach ($registros as $key => $registro) {

                    print "<tr>";
                    print "<th>" . Municipio::PegaNomeMunicipio($registro['municipio_id']) . "</th>";
                    print "<th>" . date("d/m/Y", strtotime($registro['dt'])) . "</th>";
                    print "<th>{$registro['desabrigado']}</th>";
                    print "<th>{$registro['desalojado']}</th>";
                    print "</tr>";
                }
                print "</table>";
                ?>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">


            </div>
        </div>
        <div class="col-md-12 text-center">
            <a class='btn btn-success' href='<?= FuncaoBase::geraLink('registro', 'index', 'index') ?>'>Voltar</a>
        </div>



    </div>

</div>

<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>
<script>
    var itens = {
        data:
<?php print json_encode($municipios); ?>, // array com os dados

        getValue: "nome",
        list: {
            maxNumberOfElements: 15,
            match: {
                enabled: true
            },
            onSelectItemEvent: function () {
                var value = $("#municipio").getSelectedItemData().id_municipio;
                $("#id_municipio").val(value);
            }
        }
    };
    $("#municipio").easyAutocomplete(itens);
</script>