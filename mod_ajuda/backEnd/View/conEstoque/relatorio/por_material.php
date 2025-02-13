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
<?php include_once "template/page/corpoHeader.php"; ?>
<style>
    @media print {

        * {
            background-color: #836FFF;
        }

        #cabecalho {
            display: none;
        }


        .rodape {
            background-color: #C0C0C0;
        }

        hr.linha {
            border: 1px solid blue;
        }

        #div-icon {
            display: none;
        }

    }
</style>

<?php 

$todos_liberados = isset($_POST['todos_liberados']) ? $_POST['todos_liberados'] : "";
$evento = isset($_POST['sel_evento']) ? $_POST['sel_evento'] : "";

?>

<!-- Resumo de liberacoes -->
<div class="row">
    <div class="col-md-12 text-center">
        <a class='btn btn-info' href='index.php?token=<?= hash('sha256', md5(VERSAO) . date('dmY')); ?>&ac=itn&modulo=ajuda&controller=relatorio&action=busca_resumog'>Voltar</a><br><br>
        <br>
        <p style="text-align:text-center">
        <h3>Relatorio de Liberações por Municípios - <?= $evento ?></h3>
        </p>
    </div>


    <?php

    //var_dump($_POST);

    if ($todos_liberados == 1) {
        print "<div class='row'>";
        print "<div class='col-md-12'>";
        print "<h3><p class=\"text-danger font-weight-bold text-center\">";
        print "Obs: Este relatório está contabilizando os Materiais que por ventura estão Liberados, porém não foram retirados no Depósito.";
        print "</p></h3></div></div>";
    }

    $dados_municipio = Ajuda::relPorMaterial($_POST);

    //var_dump($_POST);

    //var_dump($dados_municipio);

    $dad = Ajuda::selProduto("Transferencia%");

    $dados1 = Ajuda::gravaOrigem($dad);

    //Ajuda::gravaOrigem1($dados1);

    ?>

    <div class="row">
        <div class="col-md-12 text-center">
            <br>
            <p class="">Periodo
                <?php if (empty($_POST['txtDtInicial'])) {
                    print "01/01/2020";
                } else {
                    print $_POST['txtDtInicial'];
                }
                ?>
                a
                <?php if (empty($_POST['txtDtFinal'])) {
                    print date('d/m/Y');
                } else {
                    print $_POST['txtDtFinal'];
                }
                ?>
            </p>
            <br>
            <br>
        </div>
    </div>

    <div class="row">

        <div class="col-md-2"></div>
        <div class="col-md-8">

            <?php
            if(count($dados_municipio) > 0) {
            ?>
            <table class="table table-bordered table-striped table-condensed">
                <tr>
                    <th colspan="3" class="text-center alert alert-success">
                        <h3><?= $dados_municipio[0]->singular ?></h3>
                    </th>

                </tr>
                <tr>
                    <th>#</th>
                    <th>Município</th>
                    <th>Quantidade</th>
                </tr>

                <?php
                $total_materiais = 0;
                foreach ($dados_municipio as $key => $value) {
                    $total_materiais += $value->quantidade;

                    print "<tr>
                    <td>" . ($key + 1) . "</td>
                    <td>" . $value->nome . "</td>
                    <td class='text-right'>" . $value->quantidade . "</td>
                    </tr>";
                }
                ?>
                <tr>
                    <td>
                        <h3>Total</h3>
                    </td>
                    <td colspan="2" class="text-right bolder">
                        <h3><?= $total_materiais ?></h3>
                    </td>
                </tr>
            </table>
            <?php
            }else {

                print "<p class='text-center'><h3 class='text-danger'>Não foi encontrado registros para o filtro selecionado !</h3></p>";

            }
            ?>
        </div>
        <div class="col-md-2"></div>
    </div>


</div>

<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>

<script type="text/javascript">
    $(document).ready(function() {



    });
</script>