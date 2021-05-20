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
<style>

    table th, td{
        text-align: center;
    }

</style>

<div class="row">
    <div class="col-md-12">

        <form action="#" method="POST" name="frmBusca">
            <label>Nr. Liberacao</label>
            <input class="form form-control" type="text" name="txt_id_liberacao" id="txt_id_liberacao">
            <br>
            <button class="btn btn-primary" type="submit" name="btnBusca" id="btnBusca">Buscar</button>



        </form>

    </div>
</div>
<div class="col-md-12">
    <br>
    <?php
    $liberacao = new Liberacao();

    if (isset($_POST['txt_id_liberacao'])) {

        $dados = $liberacao->buscaLiberacao($_POST['txt_id_liberacao']);

        if (count($dados) > 0) {

            print "<table class=\"table table-bordered table-striped table-responsive\">";
            print "<tr>";
            print "<th>Nr. Liberacao</th>";
            print "<th>Data</th>";
            print "<th>Munic. Destino</th>";
            print "</tr>";
            foreach ($dados as $key => $value) {
                print "<tr>";
                print "<td>" . $value['id_liberacao'] . "</td>";
                print "<td>" . DataMysql::dataVisual($value['dataLibera']) . "</td>";
                print "<td>" . Municipio::PegaNomeMunicipio($value['id_municipio'])." </td>";
                
                print "</tr>";
            }
            
                
                print "<tr>";
                print "<td></td>";
                print "<td colspan='2'>";
                print "<table class='table'>";
                    print "<tr>";
                    print "<td>Cod</td>";
                    print "<td>Nome</td>";
                    print "<td>Almoxarifado</td>";
                    print "<tr>";
                    print "</table>" ;
                print "</td>";
                print "</tr>";
            print "</table>";
        }
    }
    ?>

</div>


<div class="col-md-12 text-center">
    <br>
    <a class="btn btn-success" href="?token=<?= hash('sha256', md5(VERSAO).date('dmY')); ?>&ac=itn&modulo=ajuda&controller=conestoque&action=index">Voltar</a>
</div>
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>
