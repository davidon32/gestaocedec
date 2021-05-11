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
<?php include_once "template/page/corpoHeader.php"; 

?>



<a class="btn btn-success" href="<?= FuncaoBase::geraLink("ajuda", "conestoque", "movimentacao") ?>">Voltar</a>
<?php
    if(Usuario::getPermissao("aju_permissao", "entrada_nota") == 1){
        print ' <a class="btn btn-info" href="'.FuncaoBase::geraLink("ajuda", "entrada_nota", "cadastro").'" title="Novo Registro">+ Novo</a> ';
    }else {
        print ' <a class="btn btn-info" disabled>+ Novo</a> ';
    }
?>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("ajuda", "entrada_nota", "pesquisa") ?>" title="Busca Registro">Pesquisa</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("ajuda", "entrada_nota", "exportar") ?>" title="Exportar dados Excel">Exportar Excel</a>
   <br>
<br>

<?php


$page = (!isset($_GET['page'])) ? 1 : $_GET['page'];

$numRegPorPagina = 10;
$pag = new Entrada_notaController();
$paginacao= $pag->paginacao($page, $numRegPorPagina);

$no = ($page >1) ? 1: 1;
$nr = 0;

//$entrada_notaModel = new Entrada_notaConEstoqueModel();

print "<legend>Entrada Nota</legend>";

print "<div class=\"table-responsive\"><table class=\"table table-bordered table-striped\">
    <thead>
            <tr>
                <th>Nr Nota</th>
<th>Fornecedor</th>
<th>Data Emissão Nota</th>
<th>Data Entrega</th>
<th>Armazem</th>
<th>Almoxarifado</th>
<th>Opções</th>
            </tr>
</thead>
<tbody>";

foreach ($paginacao[0] as $entrada_nota) {
    
    
            print "<tr>
                    <td>".$entrada_nota['id_entrada_nota']."</td>
<td>".$entrada_notaModel->getNomeIdFk('aju_cfornecedor','id_fornecedor', $entrada_nota['id_fornecedor'])->nome."</td>
<td>".DataMysql::dataVisual($entrada_nota['data_emissao'])."</td>
<td>".DataMysql::dataVisual($entrada_nota['data_entrega'])."</td>
<td>".$entrada_notaModel->getNomeIdFk('aju_calmoxarifado','id_almoxarifado', $entrada_nota['id_almoxarifado'])->nome."</td>
<!--<td>".$entrada_notaModel->getNomeIdFk('aju_cnatureza','id_natureza', $entrada_nota['id_natureza'])->nome."</td>-->
<td>".$entrada_notaModel->getNomeIdFk('aju_ctp_pedido','id_tp_pedido', $entrada_nota['id_tp_pedido'])->nome."</td>
";
                    
            print "<td>";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "entrada_nota", "view", array('id' => $entrada_nota['id_entrada_nota'])) . "'><img src='/core/imagem/view.png' title='Visualizar Registro'></a>|";
            //print "<a href='" . FuncaoBase::geraLink("ajuda", "entrada_nota", "edit", array('id' => $entrada_nota['id_entrada_nota'])) . "'><img src='/core/imagem/editar.png' title='Editar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "entrada_nota", "delete", array('id' => $entrada_nota['id_entrada_nota'])) . "' onclick=\"return confirm('Deseja Deletar esse Registro ?')\"><img src='/core/imagem/delete.png' title='Deletar Registro'></a>";

            print
                    "</td>";

            print "</tr>";
            $nr += $no;
        }
       

        print " </tbody></table></div>";
        
        print "<div class=\"col-md-12 text-center\">";

        print "<ul class=\"pagination\">";

        print "<li><a href=\"" . FuncaoBase::geraLink('ajuda', 'entrada_nota', 'index', array('page' => '1')) . "\">Primeiro</a></li>";

        for ($p = 1; $p <= $paginacao[1]; $p++) {

            print "<li class=\"" . ($page == $p ? 'active' : '') . "\"><a href=\"" . FuncaoBase::geraLink('ajuda', 'entrada_nota', 'index', array('page' => $p)) . "\">" . $p . "</a></li>";
        }
        print "<li><a href=\"" . FuncaoBase::geraLink('ajuda', 'entrada_nota', 'index', array('page' => $paginacao[1])) . "\">Último</a></li>";
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
        