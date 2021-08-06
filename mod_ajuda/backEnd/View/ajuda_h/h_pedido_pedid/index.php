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

<a class="btn btn-success" href="<?= FuncaoBase::geraLink("ajuda", "h_pedido_index", "index") ?>">Voltar</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("ajuda", "h_pedido_pedid", "cadastro") ?>" title="Novo Registro">+ Novo</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("ajuda", "h_pedido_pedid", "pesquisa") ?>" title="Busca Registro">Pesquisa</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("ajuda", "h_pedido_pedid", "exportar") ?>" title="Exportar dados Excel">Exportar Excel</a>
   <br>
<br>

<?php


$page = (!isset($_GET['page'])) ? 1 : $_GET['page'];

$numRegPorPagina = 10;
$pag = new H_pedido_pedidController();
$paginacao= $pag->paginacao($page, $numRegPorPagina);

$no = ($page >1) ? 1: 1;

$nr = 0;

print "<legend>Cadastro H_pedido_pedid</legend>";

print "<div class=\"table-responsive\"><table class=\"table table-bordered table-striped\">
    <thead>
            <tr>
                <th>id</th>
<th>numero</th>
<th>data_entrada_sistema</th>
<th>despachante_analista</th>
<th>despachante_dlog</th>
<th>id_municipio</th>
<th>id_regiao</th>
<th>nome_coordenador</th>
<th>tel_coordenador</th>
<th>cel_coordenador</th>
<th>email_coordenador</th>
<th>nome_prefeito</th>
<th>tel_prefeito</th>
<th>cel_prefeito</th>
<th>email_prefeito</th>
<th>id_cobrade</th>
<th>pop_atendida</th>
<th>decreto_se_ecp_vig</th>
<th>numero_decreto</th>
<th>data_vigencia</th>
<th>tipo_decreto</th>
<th>esforcos_realizados</th>
<th>data_hora_envio</th>
<th>Opções</th>
            </tr>
</thead>
<tbody>";

foreach ($paginacao[0] as $h_pedido_pedid) {

            print "<tr>
                    <td>".$h_pedido_pedid['id']."</td>
<td>".$h_pedido_pedid['numero']."</td>
<td>".$h_pedido_pedid['data_entrada_sistema']."</td>
<td>".$h_pedido_pedid['despachante_analista']."</td>
<td>".$h_pedido_pedid['despachante_dlog']."</td>
<td>".$h_pedido_pedidModel->getNomeIdFk('cedec_municipio','id_municipio', $h_pedido_pedid['id_municipio'])->nome."</td>
<td>".$h_pedido_pedidModel->getNomeIdFk('com_regiao','id_regiao', $h_pedido_pedid['id_regiao'])->nome."</td>
<td>".$h_pedido_pedid['nome_coordenador']."</td>
<td>".$h_pedido_pedid['tel_coordenador']."</td>
<td>".$h_pedido_pedid['cel_coordenador']."</td>
<td>".$h_pedido_pedid['email_coordenador']."</td>
<td>".$h_pedido_pedid['nome_prefeito']."</td>
<td>".$h_pedido_pedid['tel_prefeito']."</td>
<td>".$h_pedido_pedid['cel_prefeito']."</td>
<td>".$h_pedido_pedid['email_prefeito']."</td>
<td>".$h_pedido_pedidModel->getNomeIdFk('dec_cobrade','id_cobrade', $h_pedido_pedid['id_cobrade'])->nome."</td>
<td>".$h_pedido_pedid['pop_atendida']."</td>
<td>".$h_pedido_pedid['decreto_se_ecp_vig']."</td>
<td>".$h_pedido_pedid['numero_decreto']."</td>
<td>".$h_pedido_pedid['data_vigencia']."</td>
<td>".$h_pedido_pedid['tipo_decreto']."</td>
<td>".$h_pedido_pedid['esforcos_realizados']."</td>
<td>".$h_pedido_pedid['data_hora_envio']."</td>
";
                    
            print "<td>";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "h_pedido_pedid", "view", array('id' => $h_pedido_pedid['id'])) . "'><img src='/core/imagem/view.png' title='Visualizar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "h_pedido_pedid", "edit", array('id' => $h_pedido_pedid['id'])) . "'><img src='/core/imagem/editar.png' title='Editar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "h_pedido_pedid", "delete", array('id' => $h_pedido_pedid['id'])) . "' onclick=\"return confirm('Deseja Deletar esse Registro ?')\"><img src='/core/imagem/delete.png' title='Deletar Registro'></a>";

            print
                    "</td>";

            print "</tr>";
            $nr += $no;
        }
       

        print " </tbody></table></div>";
        
        print "<div class=\"col-md-12 text-center\">";

        print "<ul class=\"pagination\">";

        print "<li><a href=\"" . FuncaoBase::geraLink('ajuda', 'h_pedido_pedid', 'index', array('page' => '1')) . "\">Primeiro</a></li>";

        for ($p = 1; $p <= $paginacao[1]; $p++) {

            print "<li class=\"" . ($page == $p ? 'active' : '') . "\"><a href=\"" . FuncaoBase::geraLink('ajuda', 'h_pedido_pedid', 'index', array('page' => $p)) . "\">" . $p . "</a></li>";
            if(($p > 1) && ($p % 15 == 0)) {
            print "</ul>";
                print "<ul class=\"pagination\">";
            }
        }
        print "<li><a href=\"" . FuncaoBase::geraLink('ajuda', 'h_pedido_pedid', 'index', array('page' => $paginacao[1])) . "\">Último</a></li>";
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
        