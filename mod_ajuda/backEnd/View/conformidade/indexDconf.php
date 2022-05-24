<?php include_once "core/Model/indexModel.php" ?>
<?php include_once "mod_pipa/Model/IndexModel.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>

<?php
$pmda = new Pmda();
// icone aviso pre cadastro comunidade
$alertaPreCadCom = $pmda->buscaPreCadComun();
$listCom = "";
foreach ($alertaPreCadCom as $value) {
    $listCom .= "* " . $value['nome'] . "\n";
}
?>

<div class="col-md-12 text-right">
    <a href="?token=<?= hash('sha256', md5(VERSAO) . date('dmY')); ?>&ac=itn&modulo=index&controller=index&action=menu" class="btn btn-success">Voltar</a>
    <br>
    <br>
</div>

<div class="col-md-12">
    
        <a class='btn btn-primary' href="<?= FuncaoBase::geraLink("pipa","pipa", "novoDconf")?>" title='Gerar Nova Declaração'>Nova Declaração</a>
        <a class='btn btn-primary' href="<?= FuncaoBase::geraLink("pipa","pipa", "buscaDconf")?>" title='Pesquisar Declaração'>Busca</a>
<br><br>
</div>        
  

    <div class="col-md-12">
        <table class="table table-bordered table-striped">
            <tr>
                <th colspan="7" style="text-align: center;"></th>
            </tr>
            <tr>
                <th>#</th>
                <th>Data</th>
                <th>-</th>
                <th>-</th>
                <th>-</th>
                <th>-</th>
                <th>Opção</th>
            </tr>
            <?php
            /*$list = $pmda->listaPmdaAnalise();

            foreach ($list as $key => $value) {

                $pmdaLegado = $pmda->pmdaLegado($value['id_pmda']);

                $protocolo = $value['id_pmda'] . str_replace("-", "", substr($value['data'], 0, 10));

                print "<tr><td>" . ($key + 1) . "</td>";
                print "<td>" . $protocolo . "</td>";
                print "<td>" . $value['nome'] . "</td>";
                print "<td>" . DataMysql::extraiData($value['data']) . "</td>";
                print "<td>" . DataMysql::dataCompletaVisual($value['dt_analise']) . "</td>";
                print "<td>" . DataMysql::dataCompletaVisual($value['dt_ultima_alteracao']) . "</td>";
                print "<td>" . ( ($pmdaLegado) ? "<a href='?ac=itn&modulo=pipa&controller=pipa&action=pmda&param=" . $value['id_pmda'] . "&a=9978&p=" . $protocolo . "&mun=" . $value['id_municipio'] . "'><img width='30px;' src='core/imagem/editar.png' title='Editar PMDA'></a></td></tr>" : "");
            }*/
            ?>

        </table>
    </div>
   

    <!-- =================== RODAPE CORPO ==================== -->
    <?php include_once "template/page/corpoRodape.php"; ?>
    <!-- =================== RODAPE  ======================== -->
    <?php include_once "template/page/rodape.php" ?>
    <?php include_once "template/page/barra_config_template.php"; ?>
    <!-- =============== HEADER HTML PAGE ================= -->
    <?php include_once "template/page/rodapePage.php"; ?>