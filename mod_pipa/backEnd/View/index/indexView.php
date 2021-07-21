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
    
    <div class="col-md-4 text-center">
        <a href="<?= FuncaoBase::geraLink("pipa", "pipa", "pesquisaPmda", array('a'=>'adm'))?>"><img width="80" src='/core/imagem/adm_pmda.png' title='Administração dos PMDA´s'></a><br>Administração PMDA
        <br><br>
        </div>
    <div class="col-md-4 text-center">
        <a href="<?= FuncaoBase::geraLink("pipa","pipa", "usuario")?>"><img width="80" src='/core/imagem/avatar.png' title='Administração Usuarios Externos'></a><br>Cadastro Usuario Externo
    </div>
    <div class="col-md-4 text-center">
        <a class="btn btn-primary" href="<?= FuncaoBase::geraLink("pipa", "pipa", "pmdaCom", array('a'=>'adm'))?>">Validação Comunidade   
            <?= (count($alertaPreCadCom) > 0) ? "<img src='core/imagem/aviso.png' width='30px;' title='Existem Solicitações de Ativação de Comunidades !\nMunicipios:\n\n{$listCom}'>" : ""; ?>
        </a>
    </div>
<br>
    <br>
        <br>
        <br>
    </div>


    <div class="col-md-6">
        <table class="table table-bordered table-striped">
            <tr>
                <th colspan="7" style="text-align: center;">PMDA em Análise</th>
            </tr>
            <tr>
                <th>#</th>
                <th>Protocolo</th>
                <th>Municipio</th>
                <th>Data Criação</th>
                <th>Envio p/ Análise</th>
                <th>Data Última Alteração</th>
                <th>Opção</th>
            </tr>
            <?php
            $list = $pmda->listaPmdaAnalise();

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
            }
            ?>

        </table>
    </div>
    <div class="col-md-6">
        <table class="table table-bordered table-fonte-peq">
            <tr>
                <th colspan="5" style="text-align: center;">Histórico de alterações do PMDA</th>
            </tr>
            <tr>
                <th>Protocolo</th>
                <th>Municipio</th>
                <th>Data Evento</th>
                <th>Alterações</th>
                <th>Opção</th>
            </tr>
            <?php
            $list = $pmda->listaPmdaAlteracao();

            foreach ($list as $value) {

                $destaque = ($value['pedido_altera'] == 'SIM') ? "style='color:red;' title='Pedido de Alteração de PMDA'" : "";

                $protocolo = $value['id_pmda'] . str_replace("-", "", substr($value['data'], 0, 10));

                print "<tr>
		<td " . $destaque . ">" . $protocolo . "</td>";
                print "<td " . $destaque . ">" . $value['nome'] . "</td>";
                print "<td " . $destaque . ">" . $value['data'] . "</td>";
                print "<td " . $destaque . ">";

                print $pmda->buscaAlteracaoPmda($value['id_pmda']);

                print "</td>";

                print "<td " . $destaque . "><a href='?ac=itn&modulo=pipa&controller=pmda&action=index&param=" . $value['id_pmda'] . "&a=9978&p=" . $protocolo . "&mun=" . $value['id_municipio'] . "'><img width='30px;' src='core/imagem/notas.png' title='Visualizar Alterações'></a></td></tr>";
            }
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