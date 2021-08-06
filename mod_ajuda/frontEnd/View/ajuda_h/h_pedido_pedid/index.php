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

$pedido_pedid = new H_pedido_pedidajuda_hModel();

print "<legend>Pedidos de Ajuda Humanitária</legend>";

print "<div class=\"table-responsive\"><table class=\"table table-bordered table-striped\">
    <thead>
<tr>
<th>Código</th>
<th>numero</th>
<th>Data Entrada</th>
<th>Tramitação/ Status</th>
<th>id_cobrade</th>
<th>pop_atendida</th>
<th>data_hora_envio</th>
<th>Opções</th>
            </tr>
</thead>
<tbody>";

foreach ($paginacao[0] as $h_pedido_pedid) {

print "<tr>
       <td>".$h_pedido_pedid['id']."</td> 
<td>".$h_pedido_pedid['numero']."-".substr($h_pedido_pedid['data_entrada_sistema'], 0, 4)."</td>
<td>".DataMysql::dataCompletaVisual($h_pedido_pedid['data_entrada_sistema'])."</td>
<td>".$h_pedido_pedid['tramit']."/ ".$pedido_pedid->enumStatus($h_pedido_pedid['status'])."</td>
<td>".$h_pedido_pedidModel->getNomeIdFk('dec_cobrade','id_cobrade', $h_pedido_pedid['id_cobrade'])->nome."</td>
<td>".$h_pedido_pedid['pop_atendida']."</td>
<td>".DataMysql::dataCompletaVisual($h_pedido_pedid['data_hora_envio'])."</td>
";
                    
            print "<td>";
            
            # editar somente em fase status 0=edicao
            if($h_pedido_pedid['status'] == 0){
                print "<a href='" . FuncaoBase::geraLink("ajuda", "h_pedido_pedid", "edit", array('id' => $h_pedido_pedid['id'], 'voltar'=>'idx_index')) . "'><img src='/core/imagem/editar.png' title='Editar Registro'></a>|";
            }
            
            # envio para analise se nao existir processos em analise e pendente prestacao de contas
            if( ( $pedido_pedid::compdecVerificaPedido($h_pedido_pedid['id_municipio'] ) ) &&
                ( $h_pedido_pedid['status'] == "0" ) ){
                print "<a href='" . FuncaoBase::geraLink("ajuda", "h_pedido_pedid", "envio", array('id' => $h_pedido_pedid['id'], 'voltar'=>'idx_index')) . "'><img src='/core/imagem/envio_pedido.png' title='Enviar para Homologação'></a>|";
            }
            
            # Visualizar
            print "<a href='" . FuncaoBase::geraLink("ajuda", "h_pedido_pedid", "view", array('id' => $h_pedido_pedid['id'], 'voltar'=>'index')) . "'><img src='/core/imagem/view.png' title='Visualizar Registro'></a>|";
            
            
            
            # prestação de  contas somente status atendido
            if($h_pedido_pedid['status'] == 5){
                print "<a href='index.php".FuncaoBase::geraLink('ajuda', 'h_pedido_pedid', 'pcont')."' id='prestConta' title='Presatação de contas'><img width='25' src='/core/imagem/relatorio.png'></a>";
            }
            
            # deletar somente pedido status 0=edicao e 6=cancelado pode ser deletado
            if( ( $h_pedido_pedid['status'] == 0 ) || ($h_pedido_pedid['status'] == 6 ) ){
                print "<a href='" . FuncaoBase::geraLink("ajuda", "h_pedido_pedid", "delete", array('id' => $h_pedido_pedid['id'])) . "' onclick=\"return confirm('Deseja Deletar esse Registro ?')\"><img src='/core/imagem/delete.png' title='Deletar Registro'></a>";
            }

            print "</td>";
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
        
          $("#enviar_analise_drd").click(function(){
            var formData = new FormData();
		formData.append('id_pedido', $("#enviar_analise_drd").data('id_pedido')); 
           $.ajax({
		url : '<?= FuncaoBase::geraLink("ajuda", "h_pedido_pedid", "analise_drd")?>',
		type : 'POST',
		data : formData,
		processData: false,  // tell jQuery not to process the data
		contentType: false,  // tell jQuery not to set contentType
		success : function(response) {
                    
                    if(response.trim() == 'sucesso'){
                        Swal.fire('Pedido enviado para analise !')
                    }
		},
		error : function(e) {
		//console.log(JSON.stringify(e));
		}
            });
        });
        
        $("#prestConta").click(function(){

        var formData = new FormData();
        formData.append('id_pedido', $("#prestConta").data('id_pedido'));
    
        $.ajax({
            url : '<?="index.php".FuncaoBase::geraLink('ajuda', 'h_pedido_pedid', 'pcont');?>"',
            type : 'POST',
            data : formData,
            processData: false, // tell jQuery not to process the data
            contentType: false, // tell jQuery not to set contentType
            success : function(response) {
                console.log(response);
                //Swal.fire('Importação realizada com Sucesso !')
            },
            error : function(e) {
            //console.log(JSON.stringify(e));
            }
    });
    });
    });
</script>
        