<?php include_once 'core/include.php'; ?>
<?php include_once 'core/Model/indexModel.php'; ?>
<?php include_once 'mod_compdec/Model/Model.php'; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menuExterno.php"; ?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>
<style>
  tr:hover {background-color: #FF8C00;}
  </style>
  
  
<?php
$id_municipio = isset($pageSession['session']['seguranca']['id_municipio']) ? $pageSession['session']['seguranca']['id_municipio'] : "";

if(empty($id_municipio)){
    
    print "Ocorreu um erro de inatividade do sistema, favor refazer o login !";
    die();
    
}

$dados = H_pedido_pedidajuda_hModel::listaPedidos($id_municipio);

$pedido_h = new H_pedido_pedidajuda_hModel();

$pedido_h_item = new H_pedido_itensajuda_hModel();


?>	
<div class="col-md-12 text-center">
    <a class="btn btn-success" href="?token=<?= hash('sha256', md5(VERSAO) . date('dmY')) ?>&ac=etn&modulo=index&controller=index&action=menue">Voltar</a>
</div>
<div class="col-md-12">
    
    <div class='col-md-6'>
    
    <?php
        if( !$pedido_h->buscaStatus($id_municipio) ) {
            print "<a class=\"btn btn-primary\" name='novo_pedido' data-destaque='false' href=\"".FuncaoBase::geraLink("ajuda", "h_pedido_pedid", "cadastro")."\">Novo Pedido</a>";
        }else {
            print "<a class='btn btn-warning' name='novo_pedido' data-destaque='true' href='#' title='Você não pode Criar um novo pedido pois, já existe um pedido em edição'>Novo Pedido</a>";
            
        }
            
    ?>
    <a class="btn btn-primary" href="<?= FuncaoBase::geraLink("ajuda", "h_pedido_pedid", "index") ?>">Pesquisa</a>
    </div>
    <div class="col-md-6">
        <div class='col-md-5'></div>
             
        <div class="col-md-7 text-left"><br>
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
                <br>
            </div>
    </div>
    <br><br>
    <table class="table ">
        <tr>
            <th colspan="7">Pedidos Recentes</th>
        </tr>
        <tbody>
            <tr>
                <th>Nr</th>
                <th>Data</th>
                <th>Tipo</th>
                <th>Analista</th>
                <th>Status</th>
                <th>Data Envio Analise</th>
                <th>Ações</th>

            </tr>
<?php

foreach ($dados as $key => $value) {
    $cor = $pedido_h->getCorStatus($value['status']);
    print "<tr style='background-color:" . $cor['fdo'] . "'>
            <td title='".$value['id']."'>" . $value['numero'] . "-" . substr($value['data_entrada_sistema'], 0, 4) . "</td>
            <td>" . DataMysql::dataCompletaVisual($value['data_entrada_sistema']) . "</td>
            <td>" . Decreto::getNomeCobrade($value['id_cobrade']) . "</td>
            <td>" . (($value['despachante_analista'] == "") ? "-   " : $value['despachante_analista']) . "</td>
            <td>" . $pedido_h->enumStatus($value['status']) . "</td>
            <td>" . $value['data_hora_envio'] . "</td>
            <td>";
    
    # editar pedido 
    if( $value['status'] == 0 ){
        print "<a href='" . FuncaoBase::geraLink('ajuda', 'h_pedido_pedid', 'edit', array('id' => $value['id'], 'voltar'=>'idx_recente')) . "' title='Editar Pedido'><img src='/core/imagem/editar.png'></a> |";
    }
    
    # envio para homologação status 0=edicao
    # envio para analise se nao existir processos em analise e pendente prestacao de contas
            if( $value['status'] == "0" ){
                if(( $pedido_h::compdecVerificaPedido($value['id_municipio'] ) ) && ( count($pedido_h_item::busca_item_pedido($value['id'])) >0 ) ){
                    print " <a name='envia_analise' data-id_pedido='".$value['id']."'><img src='/core/imagem/envio_pedido.png' title='Envio para Analise'></a>|";
                }else {
                    print "<img class='imgCinza' src='/core/imagem/envio_pedido.png' title='Este pedido não tem nenhum material, assim, não é possível envia-lo !'>";
                }
            }

    
    # Visualizar 
    print " <a href='" . FuncaoBase::geraLink("ajuda", "h_pedido_pedid", "view", array('id' => $value['id'], 'voltar'=> 'idx_recente')) . "' title='Visualiação e Impressa do Pedido'><img src='/core/imagem/view.png'></a> | ";
    

    # prestação de  contas somente status atendido
    if ($value['status'] == 6) {
        print " <a href='" . FuncaoBase::geraLink("ajuda", "h_pedido_prest", "index", array('id' => $value['id'], 'voltar'=> 'idx_recente')) . "' title='Presatação de contas'><img width='25' src='/core/imagem/relatorio.png'></a> |";
        
    }

    # deletar somente pedido status 0=edicao e 6=cancelado pode ser deletado
    if (( $value['status'] == 0 ) || ($value['status'] == 6 )) {
        print " <a href='" . FuncaoBase::geraLink("ajuda", "h_pedido_pedid", "delete", array('id' => $value['id'], 'voltar'=>'idx_recente')) . "' onclick=\"return confirm('Deseja Deletar esse Registro ?')\"><img src='/core/imagem/delete.png' title='Deletar Registro'></a>";
    }

    print "</td>";
    print "</tr>";
    
    
    
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

$(document).ready(function() {
    
    $("a[name=novo_pedido]").hover(function(){

        if($("a[name=novo_pedido]").data('destaque')){
            Swal.fire('Existe um pedido em fase de edição, \nvocê pode editar esete pedido, ou excluir para criar um novo  !');
            
        }
    });
   
   /* Enviar pedido para analise */
    $("a[name=envia_analise]").click(function(){

        var formData = new FormData();
        
        var id_pedido = $(this).data('id_pedido');
              
        formData.append('opcao', 'envia_pedido');
        formData.append('id_pedido', id_pedido);
        formData.append('data_hora_envio', '<?=date('Y-m-d H:i:s')?>');
        formData.append('tramit', 'analise_dlog');
        formData.append('status', '2');
        
        var result = confirm('Deseja enviar este pedido para Analise Dlog ?');
        
        if(result){
    
            $.ajax({
                url : '/mod_ajuda/frontEnd/View/ajuda_h/h_pedido_pedid/ajax.php',
                type : 'POST',
                data : formData,
                processData: false, // tell jQuery not to process the data
                contentType: false, // tell jQuery not to set contentType
                success : function(response) {

                    //console.log(response);
                    if(response.trim() == 'sucesso'){
                        Swal.fire('Pedido enviado para analise ! \n Aguarde o prazo e verifique o status do pedido').then(function() {
                                window.location.reload();
                        }); 

                    }else {
                        Swal.fire('Ocorreu um erro no sistema! \n gentileza enviar um \'print\' desta tela para o suporte')
                    }

                },
                error : function(e) {
                //console.log(JSON.stringify(e));
                }
            });
        }
    });


   
    });
    /* upload de plano de contingencia */
    (function($) {

    uploadModal = function(){
    $("#myModal").modal('show');
    }

    })(jQuery);
    /* Upload arquivo  */
    $('#btnUpload').on('click', function() {

    var file_data = $('#filePlano').prop('files')[0];
    var versao = $('#selVersao').val();
    var dt = $('#txtData').val();
    var id = $('#txtIdMunicipio').val();
    var form_data = new FormData();
    form_data.append('file', file_data);
    form_data.append('identificador', 'upload')
            form_data.append('id', id);
    form_data.append('dt_upload', dt);
    form_data.append('versao', versao);
    //alert(form_data);                             
    $.ajax({
    url: 'mod_compdec/View/plano/process.php?v=<?=md5(VERSAO)?>', // point to server-side PHP script 
            dataType: 'text', // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function(response){
            alert(response);
            $("#myModal").modal('hide');
            window.location.reload();
            }
    });
    });
    
    
    (function($) {
    /* Remover o plano de Contingencia */
    removerPlano = function(id_plano) {

    if (confirm("Deseja realmente deletar este Plano de Contingencia ?\nProcesso sem volta !")){

    $.ajax({
    url: 'mod_compdec/View/plano/process.php?v=<?=md5(VERSAO)?>',
            type: 'POST',
            data: {
            identificador : "removerPlano",
                    id_municipio: "<?= $id_municipio; ?>",
                    id_plano : id_plano,
            },
            success: function (response) {

            if (response == "sucesso"){
            alert("Plano de Contingencia Deletado com Sucesso !");
            window.location.reload();
            }
            },
            error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown, "-");
            }


    });
    }

    return false;
    }

    })(jQuery);

</script>
</body>
</html>

