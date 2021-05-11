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

<a class="btn btn-success" href="<?= FuncaoBase::geraLink("ajuda", "conestoque", "movimentacao") ?>">Voltar</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("ajuda", "pedido", "cadastro") ?>" title="Novo Registro">+ Novo</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("ajuda", "pedido", "pesquisa") ?>" title="Busca Registro">Pesquisa</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("ajuda", "pedido", "exportar") ?>" title="Exportar dados Excel">Exportar Excel</a>
<br>
<br>

<?php
$page = (!isset($_GET['page'])) ? 1 : $_GET['page'];

$numRegPorPagina = 10;
$pag = new PedidoController();
$paginacao = $pag->paginacao($page, $numRegPorPagina);


$no = ($page > 1) ? 1 : 1;

$nr = 0;

print "<legend>Cadastro Pedido</legend>";

print "<div class=\"table-responsive\"><table class=\"table table-bordered table-striped\">
    <thead>
       <tr>
        <th>Nº Pedido</th>
        <th>Almoxarifado</th><!--tp pedido-->
        <th>Data Emissao</th>
        <th>Armazém</th><!-- Almoxarifado-->
        <th>Destinatario</th>
        <th>Situacao</th>
        <th>Opções</th>
       </tr>
</thead>
<tbody>";

foreach ($paginacao[0] as $pedido) {

    print "<tr>
                    <td>" . $pedido['id_pedido'] . "</td>
<td>" . $pedidoModel->getNomeIdFk('aju_ctp_pedido', 'id_tp_pedido', $pedido['id_tp_pedido'])->nome . "</td>
<td>" . DataMysql::dataVisual($pedido['data_emissao']) . "</td>
<td>" . $pedidoModel->getNomeIdFk('aju_calmoxarifado', 'id_almoxarifado', $pedido['id_almoxarifado'])->nome . "</td>
<td>" . $pedidoModel->getNomeIdFk('aju_cdestinatario', 'id_destinatario', $pedido['id_destinatario'])->nome . "</td>
<td>". $pedidoModel->getSituacao($pedido['situacao'])."</td>";

    print "<td>";
    print "<a href='" . FuncaoBase::geraLink("ajuda", "pedido", "view", array('id' => $pedido['id_pedido'])) . "'><img src='/core/imagem/view.png' title='Visualizar Registro'></a>&nbsp;&nbsp;";
    print ($pedido['situacao'] == 0) ? "<a href='" . FuncaoBase::geraLink("ajuda", "pedido", "edit", array('id' => $pedido['id_pedido'])) . "'><img src='/core/imagem/editar.png' title='Editar Registro'></a>&nbsp;&nbsp;" : "";
    print ($pedido['situacao'] == 0) ? "<a href='" . FuncaoBase::geraLink("ajuda", "pedido", "delete", array('id' => $pedido['id_pedido'])) . "' onclick=\"return confirm('Deseja Deletar esse Registro ?')\"><img src='/core/imagem/delete.png' title='Deletar Registro'></a>&nbsp;&nbsp;" : "";
    print ($pedido['situacao'] == 1) ? "<a href='" . FuncaoBase::geraLink("ajuda", "pedido", "notapedido", array('id' => $pedido['id_pedido'], 'volta' => 'index')) . "'>   <img src='/core/imagem/nota.png' title='Gerar Nota'></a>&nbsp;&nbsp;" : "";
    
    if(Usuario::getPermissao("aju_permissao", "cancela_pedido") == 1){ # permissao diretor
        print ($pedido['situacao'] == 1) ? "<a href='" . FuncaoBase::geraLink("ajuda", "pedido", "cancela", array('id' => $pedido['id_pedido'])) . "'><img width='25' src='/core/imagem/cancela.png' title='Cancelar pedido'></a>&nbsp;&nbsp;" : "";
    }
    print
            "</td>";

    print "</tr>";
    $nr += $no;
}


print " </tbody></table></div>";

print "<div class=\"col-md-12 text-center\">";

print "<ul class=\"pagination\">";

print "<li><a href=\"" . FuncaoBase::geraLink('ajuda', 'pedido', 'index', array('page' => '1')) . "\">Primeiro</a></li>";

for ($p = 1; $p <= $paginacao[1]; $p++) {

    print "<li class=\"" . ($page == $p ? 'active' : '') . "\"><a href=\"" . FuncaoBase::geraLink('ajuda', 'pedido', 'index', array('page' => $p)) . "\">" . $p . "</a></li>";
}
print "<li><a href=\"" . FuncaoBase::geraLink('ajuda', 'pedido', 'index', array('page' => $paginacao[1])) . "\">Último</a></li>";
print "</ul>";
print "</div>";
?>


<br>
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>
<script>

    $(document).ready(function () {

       
    });
</script>
