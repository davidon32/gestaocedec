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
<?php
$id_municipio = isset($pageSession['session']['seguranca']['id_municipio']) ? $pageSession['session']['seguranca']['id_municipio'] : "";


$pedido_h = new H_pedido_pedidajuda_hModel();

$id_usuario = $_COOKIE['seguranca']['idUser']
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
                <img width="25" src='/core/imagem/cedec.png'>     
                &nbsp; Permissão de Despacho DRD. <br>
                
                <img width="25" src='/core/imagem/dlog.png'>     
                &nbsp; Permissão de Despacho DLOG. <br>
                
                <img width="25" src='/core/imagem/boss.png'>     
                &nbsp; Permissão de Despacho do Coord. Adjunto. <br>
            </div>
            <div class="col-md-3 text-left"><br>
                <span style="background-color: #F3E2A9;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
                &nbsp; Em edição COMPDEC.<br>
                
                <span style="background-color: #D8D8D8;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
                &nbsp; Análise DRD.<br>
                
                <span style="background-color: #2E64FE;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
                &nbsp; Análise DLOG.<br>
                
                <span style="background-color: #FE642E">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
                &nbsp; Coord. Adjunto(a).<br>
                
                <span style="background-color: #4B8A08;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
                &nbsp; Atendido ( Aguardando Prestação de Contas ).<br>
                
                <span style="background-color: #B40404;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
                &nbsp; Cancelado / Nulo.<br>
                
            </div>
        </div>
    </div>
    <div class="row">
        <form action="#" method="POST" name="frmSearch" id="frmSearch">
        <label>Pesquisa</label>
        <input class='form form-control' type="text" name="txtSearch" id="txtSearch" ><br>
        <input class='btn btn-primary' type="submit" name="btnSearch" id="btnSearch" value="Pesquisar">
        <br>
        </form>
    </div>
    
    <?php
        $btn = isset($_POST['btnSearch']) ? $_POST['btnSearch'] : "";
        $municip = isset($_POST['txtSearch']) ? $_POST['txtSearch'] : "";

        /* Pesquisa */
        if($this->isPost()){

            $listaPedido = H_ajuda::BuscaPedidoMunicipio($municip);
            $tituloForm = "Resultado de Pesquisa";
        }else {
            /* listagem pedido recente */
            $listaPedido = $pedido_h->buscaPedidoH();
            $tituloForm = "Pedidos Enviados para Análise";

        }
       
    
    ?>
    <br>
    <legend><?=$tituloForm;?></legend>
    Total Registros : <span id='total_registro'></span>
    
    <table class="table table-condensed">
        
        
        <tbody>
            <tr>
                <th>Nr</th>
                <th>Municipio</th>
                <th>Data</th>
                <th>Tipo</th>
                <th>Status</th>
                <th>Fase do Processo</th>
                <th>Data Envio Analise</th>
                <th>Ações</th>

            </tr>
<?php
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

foreach ($listaPedido as $key => $pedid) {
    # get permissao
    
    $cor = $pedido_h->getCorStatus($pedid['status']);

    $percent = ( ( H_pedido_prestajuda_hModel::totalMaterialBeneficiarios($pedid['id']) * 100 ) != 0 ) ? (H_pedido_prestajuda_hModel::totalMaterialBeneficiarios($pedid['id']) * 100) /  H_pedido_prestajuda_hModel::totalMaterialPrestConta($pedid['id']) : 0 ;
    
    $prazo = $pedido_h->prazo_presta_conta($pedid['data_aprovacao']);
    if (strtotime(date('Y-m-d')) > strtotime($prazo) && $pedid['status'] != 6) {
        $cor = array('fonte'=> '#FFFFFF',
                     'fdo'=>'#FF0000',
                     'title'=> 'Prestação de Contas Vencido');
        //print $prazo;
    }
    
    if (($pedid['tramit'] == 'analise_drd' && $permissao[0]['analista_drd'] == '1') ||
            ($pedid['tramit'] == 'analise_dlog' && $permissao[0]['analista_dlog'] == '1') ||
            ($pedid['tramit'] == 'analise_coord' && $permissao[0]['analista_coord'] == '1') ||
            ($pedid['tramit'] == 'atendido')) {

        $total_reg++;
        

        print "<tr style='color:" . $cor['fonte'] . "; background-color:" . $cor['fdo'] . "'>
                <td title='".$cor['title']."'>" . $pedid['numero'] . "-" . substr($pedid['data_entrada_sistema'], 0, 4) . "</td>
                <td title='".$cor['title']."'>" . Municipio::PegaNomeMunicipio($pedid['id_municipio']) . "</td>
                <td title='".$cor['title']."'>" . DataMysql::dataCompletaVisual($pedid['data_entrada_sistema']) . "</td>
                <td title='".$cor['title']."'>" . Decreto::getNomeCobrade($pedid['id_cobrade']) . "</td>
                <td title='".$cor['title']."'>" . $pedido_h->enumStatus($pedid['status']) . "</td>
                <td title='".$cor['title']."'>" . $pedido_h->enumFase($pedid['tramit']) . ( ($pedid['status'] == 5) ? " <br>Prazo : " . ($prazo) : "") . "</td>
                <td title='".$cor['title']."'>" . DataMysql::dataCompletaVisual($pedid['data_hora_envio']) . "</td>
                <td>";

        # EDITAR
        if ($pedid['status'] < 5) {
            print "<a href='" . FuncaoBase::geraLink('ajuda', 'h_pedido_pedid', 'edit', array('id' => $pedid['id'], 'voltar'=>'idx_recente')) . "' title='Editar Pedido'><img src='/core/imagem/editar.png'></a> |";
        }

        # visualizar 
        print "<a href='" . FuncaoBase::geraLink("ajuda", "h_pedido_pedid", "view", array('id' => $pedid['id'], 'voltar'=>'idx_recente')) . "' title='Visualiação e Impressa do Pedido'><img width='25px' src='/core/imagem/view1.png'></a> |";

        #prestação de contas
        if ($pedid['status'] == 5) {
            
            print "<a href='index.php" . FuncaoBase::geraLink('ajuda', 'h_pedido_prest', 'index',array('id' => $pedid['id'])) . "' title='Presatação de contas'><img width='25' src='/core/imagem/relatorio.png'></a>|";
            print "&nbsp;&nbsp;<a href='' style='color:".$cor['fonte']."; font-size:14pt;' title='Percentual de Conclusão da Prestação de Contas do Pedido'>".$percent."%</a> |";
        }

        # analise DRD
        if ($permissao[0]['analista_drd'] == 1 
                && $pedid['status'] != 5
                && $pedid['status'] != 4) {

            print "<a href='index.php" . FuncaoBase::geraLink('ajuda', 'h_pedido_an_tec', 'cadastro', array('id' => $pedid['id'], 'voltar' => 'idx_recente', 'an' => 'analise_drd')) . "' title='Analise DRD'><img width='25' src='/core/imagem/cedec.png'></a>";
        }

        # analise_dlog
        if ($permissao[0]['analista_dlog'] == 1 
                && $pedid['status'] != 5
                && $pedid['status'] != 4) {

            print "<a href='index.php" . FuncaoBase::geraLink('ajuda', 'h_pedido_an_tec', 'cadastro', array('id' => $pedid['id'], 'voltar' => 'idx_recente', 'an' => 'analise_dlog')) . "' title='Despacho DLOG'><img width='25' src='/core/imagem/dlog.png'></a>";
        }

        # analise_coord
        if ($permissao[0]['analista_coord'] == 1) {

            print "<a href='index.php" . FuncaoBase::geraLink('ajuda', 'h_pedido_an_tec', 'cadastro', array('id' => $pedid['id'], 'voltar' => 'idx_recente', 'an' => 'analise_coord')) . "' title='Despacho Coordenador Adjunto'><img width='25' src='/core/imagem/boss.png'></a>";
        }
        
        # devolver para ediçao
        if ($pedid['status'] != 0 && $pedid['status'] != 5) {
            print "<button id='btnEdicao' name='btnEdicao' type='button' data-enviar_edicao=".$pedid['id']." class='btn btn-primart'>Enviar para Edição</button>";
            
        }

        print "</td>";
        print "</tr>";
    }else if($pedid['tramit'] == 'edicao_compdec') {
        print "<tr style='color:" . $cor['fonte'] . "; background-color:" . $cor['fdo'] . "'>
                <td title='".$cor['title']."'>" . $pedid['numero'] . "-" . substr($pedid['data_entrada_sistema'], 0, 4) . "</td>
                <td title='".$cor['title']."'>" . Municipio::PegaNomeMunicipio($pedid['id_municipio']) . "</td>
                <td title='".$cor['title']."'>" . DataMysql::dataCompletaVisual($pedid['data_entrada_sistema']) . "</td>
                <td title='".$cor['title']."'>" . Decreto::getNomeCobrade($pedid['id_cobrade']) . "</td>
                <td title='".$cor['title']."'>" . $pedido_h->enumStatus($pedid['status']) . "</td>
                <td title='".$cor['title']."'>" . $pedido_h->enumFase($pedid['tramit']) . ( ($pedid['status'] == 5) ? " <br>Prazo : " . ($prazo) : "") . "</td>
                <td title='".$cor['title']."'>" . DataMysql::dataCompletaVisual($pedid['data_hora_envio']) . "</td>
                <td>";
        print "</td>";
        print "</tr>";
        
    }
}


?>

        </tbody>
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
    
    $(document).ready(function(){
       
        $("#btnEdicao").click(function(){
            var result = confirm('Deseja enviar processo para COMPDEC ?');
            var id_pedido = $(this).data('enviar_edicao');
            if(result) {
                var formData = new FormData();
                formData.append('opcao', 'envia_edicao'); 
                formData.append('id_pedido', id_pedido); 
                $.ajax({
                        url : '/mod_ajuda/backEnd/View/ajuda_h/h_pedido_pedid/ajax.php',
                        type : 'POST',
                        data : formData,
                        processData: false,  // tell jQuery not to process the data
                        contentType: false,  // tell jQuery not to set contentType
                        success : function(response) {
                            if(response == 'sucesso'){
                                Swal.fire('Pedido enviado para Edição !');
                                window.location.reload();
                            }
                            
                        },
                        error : function(response) {
                        }
                    });
            }else {
                console.log(result);
            }
        });
    });

    /* Criar novo plano de contingencia */
    (function ($) {

        $("#total_registro").text(<?= $total_reg; ?>);
        
    })(jQuery);

</script>
</body>
</html>

