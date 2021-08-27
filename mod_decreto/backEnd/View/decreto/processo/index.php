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

<a class="btn btn-success" href="<?= FuncaoBase::geraLink("decreto", "processo", "index") ?>">Voltar</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("decreto", "processo", "cadastro") ?>" title="Novo Registro">+ Novo</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("decreto", "processo", "pesquisa") ?>" title="Busca Registro">Pesquisa</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("decreto", "processo", "exportar") ?>" title="Exportar dados Excel">Exportar Excel</a>
   <br>
<br>

<?php


$page = (!isset($_GET['page'])) ? 1 : $_GET['page'];

$numRegPorPagina = 10;
$pag = new ProcessoController();
$paginacao= $pag->paginacao($page, $numRegPorPagina);

$no = ($page >1) ? 1: 1;

$nr = 0;

print "<legend>Cadastro Processo</legend>";

print "<div class=\"table-responsive\"><table class=\"table table-bordered table-striped\">
    <thead>
            <tr>
<th>ano</th>
<th title='Data de Entrada'>Dt Entrada</th>
<th title='Número do Processo'>Num. Processo</th>
<th title='Nome do Município'>Municipio</th>
<th title='Número Decreto Municipal'>Nr Dec Mun</th>
<th title='Data do Decreto Municipal'>Dt Dec Mun</th>
<th title='Vigência do Processo'>Vigencia(Dias)</th>
<th title='Desastre'>Desastre</th>
<th title='Data do Vencimento do Proceso'>Data Venc</th>
<th title='Status do Processo'>Status</th>
<th title='Email do Município'>Email</th>
<th title='Ações para este Processo'>Opções</th>
            </tr>
</thead>
<tbody>";

foreach ($paginacao[0] as $processo) {

            print "<tr>
<td>".$processo['ano']."</td>
<td>". DataMysql::dataVisual($processo['dt_entrada'])."</td>
<td>".$processo['num_processo']."</td>
<td>".Municipio::PegaNomeMunicipio($processo['id_municipio'])."</td>
<td>".$processo['num_dec_mun']."</td>
<td>". DataMysql::dataVisual($processo['dt_dec_mun'])."</td>
<td>".$processo['dec_vigencia']."</td>
<td>".$processoModel->getNomeIdFk('dec_cobrade','id_cobrade', $processo['desastre'])->nome."</td>
<td>".DataMysql::dataVisual($processo['dt_vencimento'])."</td>
<td>".Decreto::getStatus($processo['status'])."</td>
<td>".$processo['email']."</td>

";
                    
            print "<td>";
            print "<a href='" . FuncaoBase::geraLink("decreto", "processo", "view", array('id' => $processo['id_processo'])) . "'><img src='/core/imagem/view.png' title='Visualizar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("decreto", "processo", "edit", array('id' => $processo['id_processo'])) . "'><img src='/core/imagem/editar.png' title='Editar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("decreto", "processo", "delete", array('id' => $processo['id_processo'])) . "' onclick=\"return confirm('Deseja Deletar esse Registro ?')\"><img src='/core/imagem/delete.png' title='Deletar Registro'></a>";

            print
                    "</td>";

            print "</tr>";
            $nr += $no;
        }
       

        print " </tbody></table></div>";
        
        print "<div class=\"col-md-12 text-center\">";

        print "<ul class=\"pagination\">";

        print "<li><a href=\"" . FuncaoBase::geraLink('decreto', 'processo', 'index', array('page' => '1')) . "\">Primeiro</a></li>";

        for ($p = 1; $p <= $paginacao[1]; $p++) {

            print "<li class=\"" . ($page == $p ? 'active' : '') . "\"><a href=\"" . FuncaoBase::geraLink('decreto', 'processo', 'index', array('page' => $p)) . "\">" . $p . "</a></li>";
            if(($p > 1) && ($p % 15 == 0)) {
            print "</ul>";
                print "<ul class=\"pagination\">";
            }
        }
        print "<li><a href=\"" . FuncaoBase::geraLink('decreto', 'processo', 'index', array('page' => $paginacao[1])) . "\">Último</a></li>";
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
        