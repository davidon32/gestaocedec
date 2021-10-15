<?php include_once "core/Model/indexModel.php" ?>
<?php include_once "mod_pipa/Model/IndexModel.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";
?>

<p style="text-align:center;" id="titulo"><h4>Listagem Posição PMDA</h4></p>

<!-- INICIO DO CORPO-->
<h3>PMDA - Busca</h3>
<form action="#" method="post" id="form">
    <div class="radio">
        <input type="hidden" name="txtId_user" id="txtId_user" value="<?= $pageSession['session']['seguranca']['idUser']; ?>">

        <div class="radio">
            <label>
                <input type="radio" name="rbOpcao" id="rbOpcaoMun" value="municipio" checked="checked">
                Por Município
            </label>
        </div>
    </div>

    <div class="radio">
        <label>
            <input type="radio" name="rbOpcao" id="rbOpcaoPmda" value="pmda">
            Por PMDA
        </label>
    </div>

    <div class="radio">
        <label>
            <input type="radio" name="rbOpcao" id="rbOpcaoGeral" value="geral">
            Geral
        </label>
    </div>
    <br>
    <div class="">					
        <label>Pesquisa<br>
            <input class="form-control" type="text" id="lbPesquisa" name="txtPesquisa" id="txtPesquisa" style="height: 32px;"/>
            <select id="selSituacao" name="selSituacao">
                <option value="4">Aprovado</option>
                <option value="0">Em Edição</option>
                <option value="3">Arquivado</option>
                <option value="8">Todos</option>
                <option value="9">Encerrado</option>
            </select>
        </label>
        <input type="submit" name="btnPesquisa" id="btnPesquisa" class="btn btn-primary" value="Pesquisar"/>
    </div>

</form>

<a class="btn btn-primary" href="?ac=itn&modulo=pipa&controller=pipa&action=index">Voltar</a>
<?php
$pmda = new Pmda();
$municipio = new Municipio();

$busca = isset($_POST['txtPesquisa']) ? $_POST['txtPesquisa'] : "";

$opcao = isset($_POST['rbOpcao']) ? $_POST['rbOpcao'] : "";
$btn = isset($_POST['btnPesquisa']) ? $_POST['btnPesquisa'] : "";
$situacao = isset($_POST['selSituacao']) ? $_POST['selSituacao'] : "";

$idmun = isset($_GET['idmun']) ? $_GET['idmun'] : false;

$dados = array();

$listagem = false;
$alteraStatus = "";

if ($btn == 'Pesquisar') {
    $param = $pmda->extraiPmda($busca);

    // busca municipio
    if ($opcao == "municipio") {
        $dadosMun = $municipio->BuscaMunicipio($busca);

        print "<br><br><table class='table' style='width:70%;'>";
        print "<tr>
		<th style='text-align:center;background-color:#BDBDBD;'>MUNICÍPIO</th>
		<th style='text-align:center;background-color:#BDBDBD;'>Quantidades de PMDA's</th>
		<tr>";

        foreach ($dadosMun as $value) {
            $existePmda = $pmda->listaPmda($value['id_municipio']);
            if (count($existePmda) > 0) {
                print "<tr>
			<td style='background-color:#01DF3A;text-align:center; color:#000000; font-size:15pt;'><a class='btn btn-primary' style='text-decoration:none;' href='?token=" . hash('sha256', md5(VERSAO) . date('dmY')) . "&ac=itn&modulo=pipa&controller=pipa&action=pesquisaPmda&idmun=" . $value['id_municipio'] . "'>" . $value['nome'] . "</a></td>
			<td style='background-color:#01DF3A;text-align:center; color:#000000; font-size:15pt;'>" . count($existePmda) . "</td>
			</tr>";
            } else {
                print "<tr><td style='background-color:#FA5858;text-align:center; color:#ffffff;'>" . $value['nome'] . "</td>
			<td style='background-color:#FA5858;text-align:center; color:#ffffff;'> Não existe pmda para este município !</td>";
            }
        }
        print "</table>";
    } elseif ($opcao == "pmda") { //busca protocolo
        $dados = $pmda->buscaPmda($param['id_pmda']);
    } elseif ($opcao == "geral") { /* geral */

        $dados = $pmda->buscaSituacaoPmda($situacao);
        $listagem = true;
    }
} elseif (!empty($idmun)) {

    // busca por municipio
    $dados = $pmda->listaPmda($idmun);
}

if (!empty($dados)) {

    //var_dump($dados);

    $homolog = 0;
    $edicao = 0;
    $anulado = 0;

    foreach ($dados as $value) {
        if ($value['status'] == '4') {
            $homolog++;
        } elseif ($value['status'] == '0') {
            $edicao++;
        } elseif ($value['status'] == '5') {
            $anulado++;
        }
    }

    print "<table class='table table-condensed table-striped tblcedec' style='width:100%; font-size:9pt;'>";
    print "<tr>
									<td colspan='2'>Total Registros: " . count($dados) . "</td>
									<td colspan='2'>Total Homologado: " . $homolog . "</td>
									<td colspan='2'>Total em Edição: " . $edicao . "</td>
									<td colspan='2'>Total Anulado: " . $anulado . "</td>
									</tr>";
    print "
									<th colspan='2'>Protocolo</th>
									<th>Data Criação</th>
									<th>Municipio</th>
									<th width='150'>Status</th>";

    print "<th>Opções</th>";
    print "<th>Último Acesso</th>";
    print "<th>Data Aprovação</th>";
    print "<th>Homologado Por</th>";
    print "<th>Dt Analise</th>";


    if ($opcao == "geral") {
        
    }
    
    /* lista de registros */
    foreach ($dados as $key => $value) {

        $dataCriacao = date('Y/m/d', strtotime($value['data']));

        $dataLimite = date('Y/m/d', strtotime(date('2021/03/04')));

        $pmdaLegado = ($dataCriacao > $dataLimite ? true : false);


        $val = Log::buscaultimoAcesso($value['id_municipio']);

        $ultimoAcesso = isset($val['dt_user']) ? DataMysql::dataCompletaVisual($val['dt_user']) : "";

        $protocolo = $value['id_pmda'] . str_replace("-", "", substr($value['data'], 0, 10));

        if (($value['status'] == 4) && (!$listagem)) {
            $homologado = " style='background-color:#BCF5A9; color:#A4A4A4' title='PMDA Vigente' ";
        } elseif ($value['status'] == 3) {
            $homologado = " style='background-color:#F5A9A9; color:#0B243B' title='PMDA Vigente' ";
        } elseif ($value['status'] == 9) {
            $homologado = " style='background-color:#FA5858; color:#FFFFFF' title='PMDA Encerrado' ";
        } else {
            $homologado = "";
        }

        print "<tr>";
        print "<td><img src='core\imagem\add1.png' width='30' id='versoesPmda' name='versoesPmda' title='versões PMDA'></td>";
        print "<td " . $homologado . ">" . $protocolo . "</td>";
        print "<td " . $homologado . ">" . DataMysql::dataCompletaVisual($value['data']) . "</td>";
        print "<td " . $homologado . ">" . Municipio::PegaNomeMunicipio($value['id_municipio']) . "
											<input type='hidden' id='txtIdPmda' value='" . $value['id_pmda'] . "'>
											</td>";

        # opção alteração status somente em pesquisa indig
        if ($listagem) {

            print "<td  " . $homologado . ">" . $pmda->status($value['status']) . "</td>";
            $alteraStatus = "";
        } else {
            if (!$pmdaLegado) {
                print "<td  " . $homologado . ">" . $pmda->status($value['status']) . "</td>";
                $alteraStatus = "";
            
            /* PMDA - atendido */    
            } elseif($value['status'] == 7) {
                print "<td  " . $homologado . ">" . $pmda->status($value['status']) . "</td>";
                $alteraStatus = "";
            }else {
                $alteraStatus = "|<a href='javascript:alterarStatus(" . $value['id_pmda'] . ")' title='Alterar Status deste PMDA'><img src='core/imagem/status.png'></a>";
                print "<td " . $homologado . "><select class='form-control' id='selStatus" . $value['id_pmda'] . "' data-id_pmda='" . $value['id_pmda'] . "' name='selStatus'>
                                                                                                                            <option value='" . $value['status'] . "'>" . $pmda->status($value['status']) . "</option>";
                print "<option value='0'>Em Edição</option>";
                //print "<option value='1'>Completo</option>";
                print "<option value='2'>Em Análise</option>";
                //print "<option value='3'>Arquivado</option>";
                print "<option value='4'>Aprovado</option>";
                //print "<option value='5'>Anulado</option>";
                //print "<option value='9'>Encerrado</option>";
                if ($pmda->status($value['status']) != 'Arquivado') {
                    print "<option value='1'>Liberar Alterações</option>";
                }
                print "</select></td>";
            }
        }
        print "<td " . $homologado . " id='print'>";
        # pmda's que não estão atendidos 
        if($pmdaLegado && $value['status'] !=7){
            if($value['status'] != 4){
               print "|<a href='?token=" . hash('sha256', md5(VERSAO) . date('dmY')) . "&ac=itn&modulo=pipa&controller=pipa&action=deletePmda&param=" . $value['id_pmda'] . "&idmun=".$value['id_municipio']."' title='Deletar PMDA'><img src='core/imagem/delete.png' name='del_pmda' data-id_pmda='".$value['id_pmda']."'></a>";
            }
            print "<a href='?token=" . hash('sha256', md5(VERSAO) . date('dmY')) . "&ac=itn&modulo=pipa&controller=pipa&action=pmda&param=" . $value['id_pmda'] . "&a=9978&p=" . $busca . "&mun=" . $value['id_municipio'] . "' title='Alterar PMDA'><img src='core/imagem/editar.png' width='30px'></a>" . $alteraStatus;
        }
        print "|<a href='?token=" . hash('sha256', md5(VERSAO) . date('dmY')) . "&ac=itn&modulo=pipa&controller=pipa&action=printView&param=" . $value['id_pmda'] . "&mun=" . $value['id_municipio'] . "' title='Impressão PMDA'><img src='core/imagem/printer.png'></a>";
        print $pmdaLegado ? ("|<a data-toggle='modal' data-target='#modalMensagem' id='btnMsg' name='TrocaMensagem' data-idpmda='" . $value['id_pmda'] . "' data-idusuario='" . $pageSession['session']['seguranca']['idUser'] . "' data-idmunicipio='" . $value['id_municipio'] . "' data-protocolo='" . $protocolo . "' ><img src='core/imagem/msg_tr.png' title='Troca de mensagens PMDA'></a>") : "";
        print "|<a data-toggle='modal' data-target='#modalComentario' id='btnComentario' name='Comentario' data-pmda='" . $value['id_pmda'] . "' title='Lançar Notas / Comentários neste PMDA'><img src='core/imagem/comment.png'></a>";
        print "|<a href='?ac=itn&modulo=pipa&controller=pipa&action=historicoMsg&id_pmda=" . $value['id_pmda'] . "' id='list_msg' name='list_msg' title='Historico de Mensagens do PMDA nº " . $protocolo . "'><img src='core/imagem/notas.png'></a></td>";

        print "<td " . $homologado . ">" . $ultimoAcesso . "</td>";
        print "<td " . $homologado . ">".$value['data_aprov']."</td>";
        print "<td " . $homologado . ">" . (!isset($value['resp_homolog']) ? "-" : Usuario::getNomeId($value['resp_homolog']) ) . "</td>";
        print "<td " . $homologado . ">".$value['dt_analise']."</td>";
    }
}
?>
</table>								
</div>

<!-- Modal Nota Comentário -->
<div class="modal fade" id="modalComentario">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Adicionar Notas / Comentários</h4>
            </div>
            <div class="modal-body">
                <label title="">Adicione a Nota de Observação&nbsp;<span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></label>
                <textarea class="form-control span6" type="text" name="txtText" id="txtText" rows="5" cols="5"/></textarea>
                <input type="hidden" id='txtIdpmda' name='txtIdPmda'>
                <br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btnCadComentario">Gravar</button>
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- Modal Msg -->
<div class="modal fade" id="modalMensagem">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Troca de Mensagens</h4>
            </div>
            <div class="modal-body">

                <div class="col-md-12">
                    <label title="" id="labelMsg">Enviar Mensagem &nbsp;<span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></label>
                    <textarea class="form-control" type="text" name="txtMsg" id="txtMsg" rows="5" cols="5"/></textarea>
                    <input type="hidden" id='txtIdPmdaMsg' name='txtIdPmdaMsg'>
                    <input type="hidden" id='txtIdUsuario' name='txtIdUsuario'>
                    <input type="hidden" id='txtIdMunicipio' name='txtIdMunicipio'>
                    <input type="hidden" id='txtDtEnvio' name='txtDtEnvio' value='<?= date("Y-m-d H:i:s"); ?>'>
                    <input type="hidden" id='txtProtocolo' name='txtProtocolo'>
                    <br> 

                    <button type="button" class="btn btn-primary" id="btnCadMensagem">Enviar</button>
                </div>
                <br>
                <div class="modal-footer">
                    <!--<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>-->
                </div>
            </div>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>
<script>


    $(document).ready(function () {

        $("[name=selStatus]").change(function () {
            alterarStatus($(this).data('id_pmda'));
        });
        
        $("[name=del_pmda]").click(function () {
            var result = confirm('Deseja apagar este PMDA  ? \nOperação irreversível !'); 
            var confirmResult = false;
            if(result){
                confirmResult = confirm('Deseja realmente apagar este registro PMDA ?');
            }
            if(!result || !confirmResult) {
                event.preventDefault();
            }
        });
        
        $('table').click(function () {
            var id = $(this).attr("id");
            //alert(id);
        });

        $('img[name="versoesPmda"]').click(function () {
        });

        $("#selSituacao").hide();
        $('select').change(function () {
            console.log(this.value);
        });

        $("#btnConfirm").hide();
        $("#txtProtocolo").hide();


        $("#lk_alteracao").click(function () {
            $("#btnConfirm").show();
            $("#txtProtocolo").show();
        });
        $("#btnConfirm").click(function () {
            alert("ok");
        });


        $("#rbOpcaoGeral").click(function () {

            $("#lbPesquisa").hide();
            //alert("ok");
            $("#selSituacao").show();
        });

        $("#rbOpcaoMun").click(function () {

            $("#lbPesquisa").show();
            //alert("ok");
            $("#selSituacao").hide();
        });

        /* adicionar comentario nota PMDA  */
        $('a[name="Comentario"]').click(function () {

            $("#txtIdPmda").val($(this).data('pmda'));
            //console.log($(this).data('pmda'));


        });

        /* Mostra Mensagens Analista  */
        $('a[name="TrocaMensagem"]').click(function () {

            $("#txtIdPmdaMsg").val($(this).data('idpmda'));
            $("#txtIdUsuario").val($(this).data('idusuario'));
            $("#txtIdMunicipio").val($(this).data('idmunicipio'));
            $("#txtProtocolo").val($(this).data('protocolo'));

            //alert("teste");

            var id_pmda = $(this).data('idpmda');

            var dados = {
                "id_pmda": id_pmda,
                "opcao": "list_msg",
            };

            $.ajax({
                type: 'POST',
                url: 'mod_pipa/backEnd/View/pmda/mensagemView.php?v=<?= md5(VERSAO) ?>',
                data: dados,
                //dataType: 'json',
                success: function (response) {
                    //alert("Registro adicionado com sucesso !");
                    $("#mensagem").html(response);
                },
                error: function (e) {
                    console.log(JSON.stringify(e));
                }

            });

        });



        /* gravar comentario  */
        $("#btnCadComentario").click(function () {

            var id_pmda = $("#txtIdPmda").val();

            var dados = {
                "id_pmda": id_pmda,
                "texto": $('#txtText').val(),
                "opcao": "comentario",
            }

            $.ajax({
                type: 'POST',
                url: 'mod_pipa/backEnd/View/pmda/funcAdm.php?v=<?= md5(VERSAO) ?>',
                data: dados,
                success: function (response) {
                    //console.log(dados);
                    alert('Comentário gravado com Sucesso !!')
                    $('#txtText').val("");
                    //console.log(id_pmda);
                },
                error: function (response) {
                    console.log(JSON.stringify(response));

                }
            });


        });


    });

    /* Troca de Mensagens PMDA  */
    /* $('a[name="TrocaMensagem"]').click(function(){
     $("#txtIdPmdaMsg").val($(this).data('idpmda'));
     $("#txtIdUsuario").val($(this).data('idusuario'));
     $("#txtIdMunicipio").val($(this).data('idmunicipio'));
     $("#txtProtocolo").val($(this).data('protocolo'));
     
     //console.log($("#txtIdUsuario").val());
     }); */

    /* Gravar Troca de Mensagens */
    $("#btnCadMensagem").click(function () {

        var id_pmda = $("#txtIdPmdaMsg").val();
        var id_usuario = $("#txtIdUsuario").val();
        var id_municipio = $("#txtIdMunicipio").val();
        var dt_envio = $("#txtDtEnvio").val();
        var protocolo = $("#txtProtocolo").val();


        var dados = {
            "id_pmda": id_pmda,
            "id_usuario": id_usuario,
            "id_municipio": id_municipio,
            "status": 0,
            "msg": $('#txtMsg').val(),
            "dt_envio": dt_envio,
            "protocolo": protocolo,
            "tp_mensagem": "A",
            "opcao": "mensagem",
        }

        $.ajax({
            type: 'POST',
            url: 'mod_pipa/backEnd/View/pmda/funcAdm.php?v=<?= md5(VERSAO) ?>',
            data: dados,
            //dataType 'jason',
            success: function (response) {

                alert('Mensagem enviada com sucesso !!')
                $('#txtMsg').val("");
                $("#btnCadMensagem").modal('hide');


                //console.log(dados);
            },
            error: function (response) {
                console.log(JSON.stringify(response));

            }
        });


    });

    /*
     Alterar status pmda via CEDEC
     */
    function alterarStatus(id_pmda) {

        var id_sel = "#selStatus" + id_pmda;

        var dados = {
            "id_pmda": id_pmda,
            "status": $(id_sel).val(),
            "resp": $("#txtId_user").val(),
            "opcao": "gravar",
            "data": '<?=date('Y-m-d H:i:s')?>',
        }

        $.ajax({
            type: 'POST',
            url: 'mod_pipa/backEnd/View/pmda/funcAdm.php?v=<?= md5(VERSAO) ?>',
            data: dados,
            success: function (response) {
                console.log(response);
                alert('Status Alterado com Sucesso !!')
                //location.reload();
                // console.log(response);
            },
            error: function (response) {
                console.log(JSON.stringify(response));
            }
        });

        if ($(id_sel).val() == '5') {
            alert('anulado');
        }

    }


</script>
