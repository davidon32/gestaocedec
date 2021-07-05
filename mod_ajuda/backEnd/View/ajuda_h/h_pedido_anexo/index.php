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

<a class="btn btn-success" href="<?= FuncaoBase::geraLink("ajuda", "h_pedido_anexo", "index") ?>">Voltar</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("ajuda", "h_pedido_anexo", "cadastro") ?>" title="Novo Registro">+ Novo</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("ajuda", "h_pedido_anexo", "pesquisa") ?>" title="Busca Registro">Pesquisa</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("ajuda", "h_pedido_anexo", "exportar") ?>" title="Exportar dados Excel">Exportar Excel</a>
   <br>
<br>

<?php


$page = (!isset($_GET['page'])) ? 1 : $_GET['page'];

$numRegPorPagina = 10;
$pag = new H_pedido_anexoController();
$paginacao= $pag->paginacao($page, $numRegPorPagina);

$no = ($page >1) ? 1: 1;

$nr = 0;

print "<legend>Cadastro H_pedido_anexo</legend>";

print "<div class=\"table-responsive\"><table class=\"table table-bordered table-striped\">
    <thead>
            <tr>
                <th>id</th>
<th>id_pedido</th>
<th>nome_arquivo</th>
<th>Opções</th>
            </tr>
</thead>
<tbody>";

foreach ($paginacao[0] as $h_pedido_anexo) {

            print "<tr>
                    <td>".$h_pedido_anexo['id']."</td>
<td>".$h_pedido_anexo['id_pedido']."</td>
<td>".$h_pedido_anexo['nome_arquivo']."</td>
";
                    
            print "<td>";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "h_pedido_anexo", "view", array('id' => $h_pedido_anexo['id'])) . "'><img src='/core/imagem/view.png' title='Visualizar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "h_pedido_anexo", "edit", array('id' => $h_pedido_anexo['id'])) . "'><img src='/core/imagem/editar.png' title='Editar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "h_pedido_anexo", "delete", array('id' => $h_pedido_anexo['id'])) . "' onclick=\"return confirm('Deseja Deletar esse Registro ?')\"><img src='/core/imagem/delete.png' title='Deletar Registro'></a>";

            print
                    "</td>";

            print "</tr>";
            $nr += $no;
        }
       

        print " </tbody></table></div>";
        
        print "<div class=\"col-md-12 text-center\">";

        print "<ul class=\"pagination\">";

        print "<li><a href=\"" . FuncaoBase::geraLink('ajuda', 'h_pedido_anexo', 'index', array('page' => '1')) . "\">Primeiro</a></li>";

        for ($p = 1; $p <= $paginacao[1]; $p++) {

            print "<li class=\"" . ($page == $p ? 'active' : '') . "\"><a href=\"" . FuncaoBase::geraLink('ajuda', 'h_pedido_anexo', 'index', array('page' => $p)) . "\">" . $p . "</a></li>";
            if(($p > 1) && ($p % 15 == 0)) {
            print "</ul>";
                print "<ul class=\"pagination\">";
            }
        }
        print "<li><a href=\"" . FuncaoBase::geraLink('ajuda', 'h_pedido_anexo', 'index', array('page' => $paginacao[1])) . "\">Último</a></li>";
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
        