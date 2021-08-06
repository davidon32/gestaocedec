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
<?php include_once "template/page/corpoHeader.php"; ?>

<a class="btn btn-success" href="<?= FuncaoBase::geraLink("ajuda", "conestoque", "cadgeral") ?>">Voltar</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("ajuda", "produto", "cadastro") ?>" title="Cadastrar Novo Fornecedor">+ Novo</a>
<br>
<br>

<?php

$page = (!isset($_GET['page'])) ? 1 : $_GET['page'];

        $numRegPorPagina = 10;
$pag = new ProdutoController();
$paginacao= $pag->paginacao($page, $numRegPorPagina);

$no = ($page >1) ? 1: 1;

$nr = 0;

print "<table class=\"table table-condensed table-striped\">
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Categoria</th>
                <th>Valor</th>
                <th>Fornecedor</th>
                <th>Unidade Med.</th>
                <th>Almoxarifado</th>
            </tr>";

foreach ($paginacao[0] as $produto) {

            print "<tr>"
                    . "<td>" . ($nr+1) . "</td>"
                    . "<td>" . $produto['nome'] . "</td>"
                    . "<td>" . $produto['descricao'] . "</td>"
                    . "<td>" . $produto['id_categoria'] . "</td>"
                    . "<td>" . $produto['valor'] . "</td>"
                    . "<td>" . $produto['id_fornecedor'] . "</td>"
                    . "<td>" . $produto['id_unidade_med'] . "</td>"
            . "<td>" . $produto['id_almoxarifado'] . "</td>";
            print "<td>";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "produto", "view", array('id' => $produto['id_unidade'])) . "'><img src='/core/imagem/view.png' title='Visualizar Registro'</a>|";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "produto", "edit", array('id' => $produto['id_unidade'])) . "'><img src='/core/imagem/editar.png' title='Editar Registro'</a></a>|";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "produto", "delete", array('id' => $produto['id_unidade'])) . "' onclick=\"return confirm('Deseja Deletar esse Registro ?')\"><img src='/core/imagem/delete.png' title='Deletar Registro'</a></a>";

            print
                    "</td>";

            print "</tr>";
            $nr += $no;
        }

        print "</table>";
        
        print "<div class=\"col-md-12 text-center\">";

        print "<ul class=\"pagination\">";

        print "<li><a href=\"" . FuncaoBase::geraLink('ajuda', 'produto', 'index', array('page' => '1')) . "\">Primeiro</a></li>";

        for ($p = 1; $p <= $paginacao[1]; $p++) {

            print "<li class=\"" . ($page == $p ? 'active' : '') . "\"><a href=\"" . FuncaoBase::geraLink('ajuda', 'produto', 'index', array('page' => $p)) . "\">" . $p . "</a></li>";
        }
        print "<li><a href=\"" . FuncaoBase::geraLink('ajuda', 'produto', 'index', array('page' => $paginacao[1])) . "\">Último</a></li>";
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


