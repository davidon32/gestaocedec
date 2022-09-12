<?php include_once 'core/include.php'; ?>
<?php include_once 'core/Model/indexModel.php'; ?>
<?php include_once 'mod_compdec/Model/Model.php'; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menuExterno.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>
<link rel="stylesheet" href="template/bower_components/datatables.net-bs/css/dataTables.bootstrap.css">
<?php
$id_municipio = isset($pageSession['session']['seguranca']['id_municipio']) ? $pageSession['session']['seguranca']['id_municipio'] : "";


$pedido_h = new H_pedido_pedidajuda_hModel();

$id_usuario = $_COOKIE['seguranca']['idUser'];

//$listaPedido = $pedido_h->lista();


$listaPedido1 = $pedido_h->listaPedidosTodos();

$data = array();

foreach ($listaPedido1 as $key => $pedido) {
    $data[] = $pedido;
    
    $percent = number_format(((H_pedido_prestajuda_hModel::totalMaterialBeneficiarios($pedid['id']) * 100 ) != 0 ) ? (H_pedido_prestajuda_hModel::totalMaterialBeneficiarios($pedid['id']) * 100) / H_pedido_prestajuda_hModel::totalMaterialPrestConta($pedid['id']) : 0, '2', '.', ' ');
}


//$data = array('data'=> $data);
$response = json_encode($data);
?>	
<div class="col-md-12 text-center">
    <a class="btn btn-success" href="?token=<?= hash('sha256', md5(VERSAO) . date('dmY')) ?>&modulo=ajuda&controller=index&action=index">Voltar</a>
</div>
<div class="col-md-12">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-6">
                <!--<a class="btn btn-primary" href="<?= FuncaoBase::geraLink("ajuda", "h_pedido_pedid", "cadastro") ?>">Novo Pedido</a>-->
                <!--<a class="btn btn-primary" href="<?= FuncaoBase::geraLink("ajuda", "h_pedido_pedid", "index") ?>">Pesquisa</a>-->
                <a class="btn btn-primary" href="<?= FuncaoBase::geraLink("ajuda", "h_pedido_pedid", "config_ajuda") ?>" title="Cadastro Analistas">Configurações</a>
            </div>
            <div class="col-md-3">
                <h3>Legenda</h3>
<!--                <img width="25" src='/core/imagem/cedec.png'>     
                    &nbsp; Permissão de Despacho DRD. <br>-->

                <img width="25" src='/core/imagem/dlog.png'>     
                &nbsp; Permissão de Despacho DLOG. <br>

<!--                <img width="25" src='/core/imagem/boss.png'>     
&nbsp; Permissão de Despacho do Coord. Adjunto. <br>-->
            </div>
            <div class="col-md-3 text-left"><br>
                <span style="background-color: #F3E2A9;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
                &nbsp; Em edição COMPDEC.<br>

<!--                <span style="background-color: #D8D8D8;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
&nbsp; Análise DRD.<br>-->

                <span style="background-color: #2E64FE;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
                &nbsp; Análise DLOG.<br>

                <span style="background-color: #FE642E">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
                &nbsp; Diretor DLOG.<br>

                <span style="background-color: #9F81F7;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
                &nbsp; Aguardando Disponibilidade Material.<br>

                <span style="background-color: #FFD700;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
                &nbsp; Aguardando Retirada  .<br>

                <span style="background-color: #4B8A08;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
                &nbsp; Atendido ( Aguardando Prestação de Contas ).<br>

                <span style="background-color: #B40404;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
                &nbsp; Cancelado / Nulo.<br>

            </div>
        </div>
        <hr>
    </div>
    <div class="row">
        <hr>
        <br>
        <div class="col-md-12 table-responsive">
            <table id="pedidos" class="table table-bordered table-condensed table-responsive dataTable" >
                <thead>
                    <tr>
                        <th>Número</th>
                        <th>Município</th>
                        <th>Data Criação</th>
                        <th>Tipo</th>
                        <th>Fase do Processo</th>
                        <th>Data Envio Análise</th>
                        <th>-</th>
                    </tr>
                </thead>
                <tbody>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Número</th>
                        <th>Município</th>
                        <th>Data Criação</th>
                        <th>Tipo</th>
                        <th>Fase do Processo</th>
                        <th>Data Envio Análise</th>
                        <th>-</th>
                    </tr>
                </tfoot>

            </table>
        </div>
    </div>

    <!--<?php
    /*
      $dadosConfig = Config::getConfig();

      $permissao[] = array('analista_drd' => 0, 'analista_dlog' => 0, 'analista_coord' => 0);

      if ($dadosConfig['aju_h_alta_perf'] == 1) {

      $permissao[0]['analista_drd'] = '1';
      $permissao[0]['analista_dlog'] = '1';
      $permissao[0]['analista_coord'] = '1';
      } else {
      $permissao = $pedido_h->buscaAnalista($id_usuario);
      }

      $total_reg = 0;

      if(false){
      foreach ($listaPedido as $key => $pedid) {
      # get permissao

      $cor = $pedido_h->getCorStatus($pedid['status']);
      $percent = number_format(((H_pedido_prestajuda_hModel::totalMaterialBeneficiarios($pedid['id']) * 100 ) != 0 ) ? (H_pedido_prestajuda_hModel::totalMaterialBeneficiarios($pedid['id']) * 100) / H_pedido_prestajuda_hModel::totalMaterialPrestConta($pedid['id']) : 0, '2', '.', ' ');

      if ($pedid['status'] == 6) {
      $prazo = $pedido_h->prazo_presta_conta($pedid['data_aprovacao']);
      if (strtotime(date('Y-m-d')) > strtotime($prazo) && $pedid['status'] == 6) {
      $cor = array('fonte' => '#FFFFFF',
      'fdo' => '#FF0000',
      'title' => 'Prestação de Contas Vencido');
      }
      } else {
      $prazo = "";
      $cor['title'] = "";
      }

      if (($pedid['tramit'] == 'analise_drd' && $permissao[0]['analista_drd'] == '1') ||
      ($pedid['tramit'] == 'analise_dlog' && $permissao[0]['analista_dlog'] == '1') ||
      ($pedid['tramit'] == 'analise_coord' && $permissao[0]['analista_coord'] == '1') ||
      ($pedid['tramit'] == 'atendido') ||
      ($pedid['tramit'] == 'aguard_disp') ||
      ($pedid['tramit'] == 'aguard_ret') ||
      ($pedid['tramit'] == 'atendido') ||
      ($pedid['tramit'] == 'cancelado')
      ) {

      $total_reg++;

      print "<tr style='color:" . $cor['fonte'] . "; background-color:" . $cor['fdo'] . "'>
      <td title='id " . $pedid['id'] . "'>" . $pedid['numero'] . "-" . substr($pedid['data_entrada_sistema'], 0, 4) . "</td>
      <td title='" . $cor['title'] . "'>" . Municipio::PegaNomeMunicipio($pedid['id_municipio']) . "</td>
      <td title='" . $cor['title'] . "'>" . DataMysql::dataCompletaVisual($pedid['data_entrada_sistema']) . "</td>
      <td title='" . $cor['title'] . "'>" . Decreto::getNomeCobrade($pedid['id_cobrade']) . "</td>
      <td title='" . $cor['title'] . "'>" . $pedido_h->enumStatus($pedid['status']) . "</td>
      <td title='" . $cor['title'] . "'>" . $pedido_h->enumFase($pedid['tramit']) . ( ($pedid['status'] == 6) ? " <br>Prazo : " . ($prazo) : "") . "</td>
      <td title='" . $cor['title'] . "'>" . DataMysql::dataCompletaVisual($pedid['data_hora_envio']) . "</td>
      <td title='" . $cor['title'] . "'>" . DataMysql::dataCompletaVisual($pedid['data_aprovacao']) . "</td>
      <td>";

      # EDITAR
      if ($pedid['status'] < 4) {
      print "<a href='" . FuncaoBase::geraLink('ajuda', 'h_pedido_pedid', 'edit', array('id' => $pedid['id'], 'voltar' => 'idx_recente')) . "' title='Editar Pedido'><img src='/core/imagem/editar.png'></a> |";

      # devolver para ediçao
      print "<button id='btnEdicao' name='btnEdicao' type='button' data-enviar_edicao=" . $pedid['id'] . " class='btn btn-primart'>Enviar para Edição</button>";
      }

      # visualizar
      print "<a href='" . FuncaoBase::geraLink("ajuda", "h_pedido_pedid", "view", array('id' => $pedid['id'], 'voltar' => 'idx_recente')) . "' title='Visualiação e Impressão do Pedido'><img width='25px' src='/core/imagem/view1.png'></a> |";

      # prestação de contas
      if ($pedid['status'] == 6) {

      print "<a href='index.php" . FuncaoBase::geraLink('ajuda', 'h_pedido_prest', 'index', array('id' => $pedid['id'])) . "' title='Presatação de contas'><img width='25' src='/core/imagem/relatorio.png'></a>|";
      print "&nbsp;&nbsp;<a href='' style='color:" . $cor['fonte'] . "; font-size:14pt;' title='Percentual de Conclusão da Prestação de Contas do Pedido'>" . $percent . "%</a> |";
      }

      # analise DRD
      #if ($permissao[0]['analista_drd'] == 1
      #  && $pedid['status'] <= 3) {

      #  print "<a href='index.php" . FuncaoBase::geraLink('ajuda', 'h_pedido_an_tec', 'cadastro', array('id' => $pedid['id'], 'voltar' => 'idx_recente', 'an' => 'analise_drd')) . "' title='Analise DRD'><img width='25' src='/core/imagem/cedec.png'></a>";
      #  }

      # analise_dlog
      if ($permissao[0]['analista_dlog'] == 1 && $pedid['status'] < 3) {

      print "<a href='index.php" . FuncaoBase::geraLink('ajuda', 'h_pedido_an_tec', 'cadastro', array('id' => $pedid['id'], 'voltar' => 'idx_recente', 'an' => 'analise_dlog')) . "' title='Despacho DLOG'><img width='25' src='/core/imagem/dlog.png'></a>";
      }

      # analise_coord
      if (($permissao[0]['analista_coord'] == 1) && ($pedid['status'] == 3 )) {
      print "<a href='index.php" . FuncaoBase::geraLink('ajuda', 'h_pedido_an_tec', 'cadastro', array('id' => $pedid['id'], 'voltar' => 'idx_recente', 'an' => 'analise_coord')) . "' title='Despacho Coordenador Adjunto'><img width='25' src='/core/imagem/boss.png'></a>";
      }

      # Apos despacho do Chefe Dlog
      if (($pedid['status'] >= 4 ) && ($pedid['status'] <= 5 )) {
      print "<a href='index.php" . FuncaoBase::geraLink('ajuda', 'h_pedido_an_tec', 'cadastro', array('id' => $pedid['id'], 'voltar' => 'idx_recente', 'an' => 'analise_coord')) . "' title='Despacho Dlog'><img width='25' src='/core/imagem/dlog.png'></a>";
      }



      print "</td>";
      print "</tr>";
      } else if ($pedid['tramit'] == 'edicao_compdec') {
      $total_reg++;
      print "<tr style='color:" . $cor['fonte'] . "; background-color:" . $cor['fdo'] . "'>
      <td title='id " . $pedid['id'] . "'>" . $pedid['numero'] . "-" . substr($pedid['data_entrada_sistema'], 0, 4) . "</td>
      <td title='" . $cor['title'] . "'>" . Municipio::PegaNomeMunicipio($pedid['id_municipio']) . "</td>
      <td title='" . $cor['title'] . "'>" . DataMysql::dataCompletaVisual($pedid['data_entrada_sistema']) . "</td>
      <td title='" . $cor['title'] . "'>" . Decreto::getNomeCobrade($pedid['id_cobrade']) . "</td>
      <td title='" . $cor['title'] . "'>" . $pedido_h->enumStatus($pedid['status']) . "</td>
      <td title='" . $cor['title'] . "'>" . $pedido_h->enumFase($pedid['tramit']) . ( ($pedid['status'] == 6) ? " <br>Prazo : " . ($prazo) : "") . "</td>
      <td title='" . $cor['title'] . "'>" . DataMysql::dataCompletaVisual($pedid['data_hora_envio']) . "</td>
      <td title='" . $cor['title'] . "'>" . DataMysql::dataCompletaVisual($pedid['data_aprovacao']) . "</td>
      <td>";
      print "</td>";
      print "</tr>";
      }
      }
      }

     */
    ?>-->




</table>

</div>

<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>
<script>

    $(document).ready(function () {
               
    var data1 = <?= $response ?>;
    $('#pedidos thead tr')
            .clone(true)
            .addClass('filters')
            .appendTo('#pedidos thead');
    var table = $('#pedidos').DataTable({
    orderCellsTop: true,
            fixedHeader: true,
            bFilter: true,
            responsive: true,
            data: data1,
            initComplete: function () {
            var api = this.api();
            // For each column
            api.columns()
                    .eq(0)
                    .each(function (colIdx) {
                    // Set the header cell to contain the input element
                    var cell = $('.filters th').eq(
                            $(api.column(colIdx).header()).index()
                            );
                    var title = $(cell).text();
                    //$(cell).html('<input type="text" placeholder="' + title + '" />');
                    if ($(api.column(colIdx).header()).index() >= 0) {
                        if(colIdx <= 5){
                           $(cell).html('<input type="text" name="notNormaliza" placeholder="' + title + '"/>');
                        }
                    }

                    // On every keypress in this input
                    $(
                            'input',
                            $('.filters th').eq($(api.column(colIdx).header()).index())
                            )
                            .off('keyup change')
                            .on('change', function (e) {
                            // Get the search value
                            $(this).attr('title', $(this).val());
                            var regexr = '({search})'; //$(this).parents('th').find('select').val();

                            //var cursorPosition = this.selectionStart;
                            // Search the column for that value
                            api
                                    .column(colIdx)
                                    .search(
                                            this.value != ''
                                            ? regexr.replace('{search}', '(((' + this.value + ')))')
                                            : '',
                                            this.value != '',
                                            this.value == ''
                                            )
                                    .draw();
                            })
                            .on('keyup', function (e) {
                            e.stopPropagation();
                            $(this).trigger('change');
                            $(this)
                                    .focus()[0];
                            //.setSelectionRange(cursorPosition, cursorPosition);
                            });
                    });
            },
            'columns': [
            {data: 'numero'},
            {data: 'nome'},
            {data: 'data_entrada_sistema'},
            {data: 'tipo_decreto'},
            {data: 'tramit'},
            {data: 'data_hora_envio'},
            {
            'className':      '',
                    orderable:      false,
                    data:           null,
                    defaultContent: '',
                    render: function (data, type, row) {

                        var links_opcoes = '<a href=\''+geraLink('ajuda', 'h_pedido_pedid', 'view', '<?=VERSAO?>', {id :data.id, voltar :'idx_recente'})+'\' title=\'Visualiação e Impressão do Pedido\'><img width=\'25px\' src=\'/core/imagem/view1.png\'></a>|';
                         //return '-'+geraLink('ajuda', 'pedido', 'view', '123', {offset: 5, limit: 10 });
                        
                         /*##### EDITAR */
                            if (data.status > 0 && data.status <= 4) {
                                links_opcoes += '<a href=\''+geraLink('ajuda', 'h_pedido_pedid', 'edit', '<?=VERSAO?>', {id:data.id, voltar:'idx_recente'})+'\' title=\'Editar Pedido\'><img src=\'/core/imagem/editar.png\'></a>';
                                //links_opcoes +='<button id=\'btnEdicao\' name=\'btnEdicao\' type=\'button\' data-enviar_edicao='+data.id+' class=\'btn btn-primart\'>Enviar Edição</button>';
                            }
                        
                        /*    ##### prestação de contas */
                        if(data.status == 6 ) {
                            links_opcoes += '<a href=\''+geraLink('ajuda', 'h_pedido_prest', 'index', '<?=VERSAO?>', {id: data.id}])+'\' title=\'Presatação de contas\'><img width=\'25\' src=\'/core/imagem/relatorio.png\'></a>|';
                            links_opcoes += '&nbsp;&nbsp;<a href=\'\' style=\'color:#ffffff; font-size:14pt\' title=\'Percentual de Conclusão da Prestação de Contas do Pedido\'>".$percent."%</a> |";
                        }
                       
                        
                               

                        ##### analise DRD
                                #if ($permissao[0]['analista_drd'] == 1
                                        # && $pedid['status'] <= 3) {

                        #  print "<a href='index.php".FuncaoBase::geraLink('ajuda', 'h_pedido_an_tec', 'cadastro', array('id' => $pedid['id'], 'voltar' => 'idx_recente', 'an' => 'analise_drd'))."' title='Analise DRD'><img width='25' src='/core/imagem/cedec.png'></a>";
                        #  }

                        ##### analise_dlog
                                if ($permissao[0]['analista_dlog'] == 1 && $pedid['status'] < 3) {

                        print "<a href='index.php".FuncaoBase::geraLink('ajuda', 'h_pedido_an_tec', 'cadastro', array('id' => $pedid['id'], 'voltar' => 'idx_recente', 'an' => 'analise_dlog'))."' title='Despacho DLOG'><img width='25' src='/core/imagem/dlog.png'></a>";
                        }

                        # analise_coord
                                if (($permissao[0]['analista_coord'] == 1) && ($pedid['status'] == 3)) {
                        print "<a href='index.php".FuncaoBase::geraLink('ajuda', 'h_pedido_an_tec', 'cadastro', array('id' => $pedid['id'], 'voltar' => 'idx_recente', 'an' => 'analise_coord'))."' title='Despacho Coordenador Adjunto'><img width='25' src='/core/imagem/boss.png'></a>";
                        }

                        # Apos despacho do Chefe Dlog
                                if (($pedid['status'] >= 4) && ($pedid['status'] <= 5)) {
                        print "<a href='index.php".FuncaoBase::geraLink('ajuda', 'h_pedido_an_tec', 'cadastro', array('id' => $pedid['id'], 'voltar' => 'idx_recente', 'an' => 'analise_coord'))."' title='Despacho Dlog'><img width='25' src='/core/imagem/dlog.png'></a>";
                        }*/
                        
                        return links_opcoes;
                    },
                    width: "15px"
            }
            ],
    });
    $("#btnEdicao").click(function () {
        var result = confirm('Deseja enviar processo para COMPDEC ?');
        var id_pedido = $(this).data('enviar_edicao');
        if (result) {
        var formData = new FormData();
        formData.append('opcao', 'envia_edicao');
        formData.append('id_pedido', id_pedido);
        $.ajax({
        url: '/mod_ajuda/backEnd/View/ajuda_h/h_pedido_pedid/ajax.php',
                type: 'POST',
                data: formData,
                processData: false, // tell jQuery not to process the data
                contentType: false, // tell jQuery not to set contentType
                success: function (response) {
                if (response == 'sucesso') {
                Swal.fire('Pedido enviado para Edição !');
                    window.location.reload();
                }

                },
                error: function (response) {
                }
        });
        } else {
        console.log(result);
        }
    });
    });

</script>
</body>
</html>

