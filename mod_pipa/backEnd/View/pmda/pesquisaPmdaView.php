<?php include_once "core/Model/indexModel.php" ?>
<?php include_once "mod_pipa/Model/IndexModel.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php
include_once "template/page/corpoHeader.php";
$permissaoOperador = $_COOKIE['seguranca']['pmdaoperador'];
$permissaoDlog = $_COOKIE['seguranca']['pmdadlog'];
$secao_usuario = $_COOKIE['seguranca']['secao'];
?>
<style>
    .breadcrumb {
        padding: 0px 0 !important;
        margin: 0 !important;
    }
</style>
<div class="">
    <ul class="breadcrumb">
        <li><a href='<?=FuncaoBase::geraLink('index', 'index', 'menu')?>'>Home</a></li>
        <li><a href='<?=FuncaoBase::geraLink('pipa', 'pipa', 'index')?>'>Módulo PMDA</a></li>
        <li><a href='<?=FuncaoBase::geraLink('pipa', 'pipa', 'pmdaindex')?>'>SubMenu PMDA</a></li>
    </ul>
</div>
<div class='col-md-12 text-center'>
    <a class="btn btn-success" href="?ac=itn&modulo=pipa&controller=pipa&action=index">Voltar</a>
</div>



<!-- INICIO DO CORPO-->
<legend>PMDA - Busca - <?= ($permissaoOperador) ? "<span style='color:red'>Usuario Operador PMDA" : "Usuário SEM permissoes de Operador</span>" ?></legend>
<form action="#" method="post" id="form">

    <div class='col-md-6'>
        <div>					
            <input class="form-control" type="text" id="lbPesquisa" name="txtPesquisa" id="txtPesquisa" style="height: 32px;"/>
            <select id="selSituacao" name="selSituacao">
                <option value="4">Aprovado</option>
                <option value="0">Em Edição</option>
                <option value="3">Arquivado</option>
                <option value="8">Todos</option>
                <option value="9">Encerrado</option>
            </select>
            <br>
            <input type="submit" name="btnPesquisa" id="btnPesquisa" class="btn btn-primary" value="Pesquisar"/>

        </div>
    </div>

    <div class='col-md-3'>
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
    </div>


</form>
<div class="col-md-12">
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

    $dadosMun = "";



    if ($btn == 'Pesquisar') {
        $param = $pmda->extraiPmda($busca);

        // busca municipio
        if ($opcao == "municipio") {
            $dadosMun = $municipio->BuscaMunicipio($busca);

            print "<br><br><table class='table'>";
            print "<tr>
		<th>MUNICÍPIO</th>
		<th>Quantidades de PMDA's</th>
		<th>Opção/Ação</th>
		<tr>";

            foreach ($dadosMun as $value) {
                $existePmda = $pmda->listaPmda($value['id_municipio']);
                if (count($existePmda) > 0) {
                    print "<tr>
			<td>" . $value['nome'] . "</td>
			<td>" . count($existePmda) . "</td>
                        <td><a href='?token=" . hash('sha256', md5(VERSAO) . date('dmY')) . "&ac=itn&modulo=pipa&controller=pipa&action=pesquisaPmda&idmun=" . $value['id_municipio'] . "' title='Visualizar/Editar Processos'><img src='/core/imagem/view.png'></a>
			</tr>";
                } else {
                    print "<tr><td style='background-color:#FA5858;text-align:center; color:#ffffff;'>" . $value['nome'] . "</td>
			<td colspan='2' style='background-color:#FA5858;text-align:center; color:#ffffff;'> Não existe pmda para este município !</td>";
                }
            }
            print "</table>";
        } elseif ($opcao == "pmda") { //busca protocolo
            //$dados = $pmda->buscaPmda();
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

        print "<th>Ações</th>";
        print "<th title='Data do último acesso do COMPDEC no sistema'>Último Acesso</th>";
        print "<th>Data Aprovação</th>";
        print "<th>Homologado Por</th>";
        print "<th>Dt Analise</th>";
        print "<th>Estado</th>";


        if ($opcao == "geral") {
            
        }

        $existe_edicao = $pmda->existeEdicao($dados[0]['id_municipio']);

        /* lista de registros */
        foreach ($dados as $key => $value) {

            $dataCriacao = date('Y/m/d', strtotime($value['data']));

            $dataLimite = date('Y/m/d', strtotime(date('2021/03/04')));

            $pmdaLegado = ($dataCriacao > $dataLimite ? true : false);





            $val = Log::buscaultimoAcesso($value['id_municipio']);

            $ultimoAcesso = isset($val['dt_user']) ? DataMysql::dataCompletaVisual($val['dt_user']) : "";

            $protocolo = $value['id_pmda'] . str_replace("-", "", substr($value['data'], 0, 10));
            
            $homologado = "";

            # Aprovado
            if (($value['status'] == 4) && (!$listagem)) {
                $homologado = " style='background-color:#BCF5A9; color:#A4A4A4' title='PMDA Aguardando Liberar o Atendimento' ";
            
            // Atendido / Em Atendimento
            } elseif ($value['status'] == 7 && $value['estado'] == "Em Atendimento") {
                $homologado = " style='background-color:#FA5858; color:#FFFFFF' title='PMDA Atendido' ";
            
            // Atendido / Encerrado 
            } elseif($value['status'] == 7 && $value['estado'] == "Encerrado Atendimento") {
                $homologado = " style='background-color:#F2F5A9; color:#0B610B' title='PMDA Foi Atendido e já se encontra encerrado' ";
            }else {
                
            }
            
            /* Pmda em edição usuario não faz parte da drrd */
            if ($value['status'] < 2 && $secao_usuario != "DRRD" ) {
                print "<tr>
                        <td></td><td>".$protocolo."</td><td>".DataMysql::dataCompletaVisual($value['data'])."</td><td colspan='12'>Processo em Edição - Registro Suprimido ! - </td>
                    </tr>";
            
            #### todos os registros ####    
            } else {
                
                print "<tr>";
                print "<td><img onclick='alert();' src='core\imagem\add1.png' width='30' id='versoesPmda' name='versoesPmda' title='versões PMDA'></td>";
                print "<td " . $homologado . ">" . $protocolo . "</td>";
                print "<td " . $homologado . ">" . DataMysql::dataCompletaVisual($value['data']) . "</td>";
                print "<td " . $homologado . ">" . Municipio::PegaNomeMunicipio($value['id_municipio']) . "
											<input type='hidden' id='txtIdPmda' value='" . $value['id_pmda'] . "'>
											</td>";

                # opção alteração status somente em pesquisa indig
                if ($listagem) {

                    print "<td  " . $homologado . ">" . $pmda->status($value['status']) . "</td>";
                } else {
                    if (!$pmdaLegado) {
                        print "<td  " . $homologado . ">" . $pmda->status($value['status']) . "</td>";
                    } else {
                        print "<td " . $homologado . ">";

                        # em edicao status ( sem acoes para o operador)
                        # completo ( sem acoes para o operaror)

                        if ($value['status'] < 2 && $_COOKIE['seguranca']['secao'] == 'DRRD') {
                            print "<span title ='Status sem Ações para o Operador / Aguardando Ação do COMPDEC'>" . $pmda->status($value['status']) . "</span>";
                        } else {

   ############################### SELECT STATUS ##################################
                            # permissao operador
                            if ($permissaoOperador == 1) {
                                
                                # CANCELADO não tem opções
                                if($value['status'] >= 8) {
                                    print $pmda->status($value['status']);
                                 
                                # ATENDIDO e estado:"Encerrado Atendimento" ou ANULADO
                                } elseif ($value['status'] == 7 && $value['estado'] == "Encerrado Atendimento" || $value['status'] == 5) {
                                    print $pmda->status($value['status']);
                                
                                # status não esteja cancelado e usuario DLS    
                                } elseif ($value['status'] == 7 && $value['estado'] != "Cancelado" || $value['status'] != 8 || $value['status'] != 9 && $secao_usuario != "DLS") {
                                    # SELECT STATUS 
                                    print "<select class='form-control' id='selStatus" . $value['id_pmda'] . "' data-id_pmda='" . $value['id_pmda'] . "' data-status='" . $value['status'] . "' name='selStatus'>";
                                    print "<option value='" . $value['status'] . "'>" . $pmda->status($value['status']) . "</option>";

                                    # em analise
                                    if ($value['status'] == 2) {
                                        print "<option value='4'>Aprovado</option>";
                                    }

                                    # Aprovado
                                    if ($value['status'] == 4) {
                                        # operador Dlog atendido PMDA
                                        if ( $permissaoDlog == 1) {
                                            print "<option value='7'>Atendido</option>";
                                        }
                                        print "<option value='8'>Cancelar</option>";
                                    }

                                    # STATUS ATENDIDO
                                    # DLS - PERMISSAO DE CANCELAR OU ENCERRAR O ATENDIEMTO( FIM DO ATENDIMENTO )
                                    if ($value['status'] == 7 && $value['estado'] != 'Cancelado' && $value['estado'] != 'Encerrado Atendimento' && $secao_usuario == "DLS") {
                                        print "<option value='8'>Cancelar</option>";
                                        print "<option value='9'>Encerrado</option>";

                                        #diretor
                                        if ($_COOKIE['seguranca']['diretor'] == 1) {
                                            print "<option value='4' title='Usuario com Permissoes de Diretor'>Aprovado - Usuario com Permissoes de Diretor</option>";
                                        }
                                    }
                                    print "</select>";
                                } else {
                                    # opcao cancelado
                                    print $pmda->status($value['status']);
                                }
                            } else {
                                print $pmda->status($value['status']);
                            }
                            print "</td>";
                        }
                    }
                }

                ############## icones ###########
                print "<td " . $homologado . " id='print'>";
                # pmda's que não estão atendidos 
                //if($pmdaLegado && $value['status'] !=7){
                # icone em Analise
                if ($value['status'] == 2 && $permissaoOperador == 1) {
                    if (!$existe_edicao) {
                        # enviar para Edição
                        print "<a href='#' class='btn btn-primary' name='enviar_compdec' data-id_pmda='" . $value['id_pmda'] . "' data-status='0' data-estado='Em Edicao' data-resp='" . $pageSession['session']['seguranca']['idUser'] . "' >Enviar p/ COMPDEC</a>";
                    }

                    # deletar PMDA
                    print "|<a href='?token=" . hash('sha256', md5(VERSAO) . date('dmY')) . "&ac=itn&modulo=pipa&controller=pipa&action=deletePmda&param=" . $value['id_pmda'] . "&idmun=" . $value['id_municipio'] . "' title='Deletar PMDA'><img src='core/imagem/delete.png' name='del_pmda' data-id_pmda='" . $value['id_pmda'] . "'></a>";

                    # editar PMDA    
                    print "<a href='?token=" . hash('sha256', md5(VERSAO) . date('dmY')) . "&ac=itn&modulo=pipa&controller=pipa&action=pmda&param=" . $value['id_pmda'] . "&a=9978&p=" . $busca . "&mun=" . $value['id_municipio'] . "' title='Alterar PMDA'><img src='core/imagem/editar.png' width='30px'></a>" . $alteraStatus;

                    # comentario / nota
                    print "|<a data-toggle='modal' data-target='#modalComentario' id='btnComentario' name='Comentario' data-pmda='" . $value['id_pmda'] . "' title='Lançar Notas / Comentários neste PMDA'><img src='core/imagem/comment.png'></a>";
                }

                # icone opcao aprovado
                if ($value['status'] == 4 && $edicao == 0 && $permissaoOperador == 1) {
                    # enviar para Edição ( não pode estar em edição )
                    print "<a href='#' class='btn btn-primary' name='enviar_compdec' data-id_pmda='" . $value['id_pmda'] . "' data-status='0' data-estado='Em Edicao' >Enviar p/ COMPDEC</a>";
                }

                //}
                //
                # imprimir
                print "|<a href='?token=" . hash('sha256', md5(VERSAO) . date('dmY')) . "&ac=itn&modulo=pipa&controller=pipa&action=printView&param=" . $value['id_pmda'] . "&mun=" . $value['id_municipio'] . "' title='Impressão PMDA'><img src='core/imagem/printer.png'></a>";
                print $pmdaLegado ? ("|<a data-toggle='modal' data-target='#modalMensagem' id='btnMsg".$value['id_pmda']."' name='TrocaMensagem' data-idpmda='" . $value['id_pmda'] . "' data-idusuario='" . $pageSession['session']['seguranca']['idUser'] . "' data-idmunicipio='" . $value['id_municipio'] . "' data-protocolo='" . $protocolo . "' ><img src='core/imagem/msg_tr.png' title='Troca de mensagens PMDA'></a>") : "";

                # visualizar Comentarios/Notas
                print "|<a href='?ac=itn&modulo=pipa&controller=pipa&action=historicoMsg&id_pmda=" . $value['id_pmda'] . "' id='list_msg' name='list_msg' title='Historico de Mensagens do PMDA nº " . $protocolo . "'><img src='core/imagem/notas.png'></a>";

                # permissao Operador
                if ($permissaoOperador == 1) {
                    # Liberar Alteração comunidades PMDA
                    if ($value['status'] == 7 && $value['estado'] == 'Em Atendimento' && $value['alterar_com'] == 0) {
                        print "|<a href='#' data-id_pmda='" . $value['id_pmda'] . "' name='liberar_alterar' title='Liberar Alteração de COMUNIDADES'><img src='core/imagem/change.png'></a>";

                        # verifica se esta em atendimento e liberado para alterações de comunidades    
                    } else if ($value['status'] == 7 && $value['estado'] == 'Em Atendimento' && $value['alterar_com'] == 1) {
                        print "<a href='" . FuncaoBase::geraLink("pipa", "pipa", "altera_com_view", array('id_pmda' => $value['id_pmda'], 'id_mun' => $value['id_municipio'])) . "' ><img class='imgCinza' src='core/imagem/change.png' title='Processo liberado para Alteração de Comunidades'></a>";
                    }
                }

                print "</td>";

                print "<td " . $homologado . ">" . $ultimoAcesso . "</td>";
                print "<td " . $homologado . ">" . DataMysql::dataCompletaVisual($value['data_aprov']) . "</td>";
                print "<td " . $homologado . ">" . (!isset($value['resp_homolog']) ? "-" : substr( Usuario::getNomeId($value['resp_homolog']), 0, 20)."..." ) . "</td>";
                print "<td " . $homologado . ">" . DataMysql::dataCompletaVisual($value['dt_analise']) . "</td>";

                
##############################  ESTADO ###################################
                # situacao atendido

                print "<td " . $homologado . ">";

                # acesso somente operador PMDA
                if ( ($permissaoOperador == 1) && ($secao_usuario == "DLS") ){
                    if ($value['status'] == 0 ||
                            $value['status'] == 1 ||
                            $value['status'] == 2 ||
                            $value['status'] == 5){
                        print $value['estado'];
                        
                    } else if ($value['status'] == 7 ||
                                $value['status'] == 8 ||
                                $value['status'] == 9 &&
                                $value['estado'] == "Cancelado" ||
                                $value['estado'] == "Encerrado Atendimento") {
                        print $value['estado'];
                    } else {

                        print "<select class='form form-control' name='selEstado' id='selEstado' data-id_pmda='" . $value['id_pmda'] . "'>";
                        print "<option value='" . $value['estado'] . "'>" . $value['estado'] . "</option>";
                        print "<option value='Em Atendimento'>Em Atendimento</option>";
                        print "<option value='Encerrado Atendimento'>Encerrado Atendimento</option>";
                        print "</select>";
                    }
                } else {
                    print $value['estado'];
                }
                print "</td>";
                
                
            }
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
<div class="modal fade" id="modalMensagem" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
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
        
        
        /* muda o STATUS do processo */
        $("[name=selStatus]").change(function () {
            if ($(this).data('status') == 8) {
                alterarEstado($(this).data('id_pmda'), 'Cancelado');
            } else if($(this).find(":selected").val() == 4){
                alterarEstado($(this).data('id_pmda'), 'Atendido');
            } else {
                alterarStatus($(this).data('id_pmda'));
            }
        });

        /* muda o ESTADO DO PROCESSO */
        $("[name=selEstado]").change(function () {
            alterarEstado($(this).data('id_pmda'));
        });


        /* enviar para o compdec edição */
        $("a[name='enviar_compdec']").click(function () {
            var id_pmda = $(this).data('id_pmda');
            var estado = $(this).data('estado');
            var status = $(this).data('status');
            var data_sit = '<?= date('Y-m-d H:i:s') ?>';
            var id_usuario = $(this).data('resp');
            ;

            var dados = {
                "id_pmda": id_pmda,
                "opcao": "envia_compdec",
                "estado": estado,
                "status": status,
                "dt_estado": data_sit,
                "resp": id_usuario,
            }

            $.ajax({
                type: 'POST',
                url: 'mod_pipa/backEnd/View/pmda/funcAdm.php?v=<?= md5(VERSAO) ?>',
                data: dados,
                success: function (response) {
                    alert('Processo Enviado para o Compdec !!')
                    location.reload();
                },
                error: function (response) {
                    console.log(JSON.stringify(response));

                }
            });

        });



        $("[name=liberar_alterar]").click(function () {
            var result = confirm('Deseja Liberar este PMDA para Alterar as Comunidades  ? \nEstá ação é usada para alteração somente das comunidades a serem atendidas !');
            var id_pmda = $(this).data('id_pmda');
            if (result) {
                liberar_alterar(id_pmda);
            }
        });


        $("[name=del_pmda]").click(function () {
            var result = confirm('Deseja apagar este PMDA  ? \nOperação irreversível !');
            var confirmResult = false;
            if (result) {
                confirmResult = confirm('Deseja realmente apagar este registro PMDA ?');
            }
            if (!result || !confirmResult) {
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

        var estado = ''
        if ($(id_sel).val() == 0) {
            estado = 'Em Edicao';
        } else if ($(id_sel).val() == 1) {
            estado = 'Completo';
        } else if ($(id_sel).val() == 2) {
            estado = 'Analista Cedec';
        } else if ($(id_sel).val() == 4) {
            estado = 'Aguard. Atendimento';
        } else if ($(id_sel).val() == 7) {
            estado = 'Em Atendimento';
        } else if ($(id_sel).val() == 8) {
            estado = 'Cancelado';
        }else if ($(id_sel).val() == 9) {
            estado = 'Cancelado';
        }
        
        var dados = {
            "id_pmda": id_pmda,
            "status": $(id_sel).val(),
            "estado": estado,
            "resp": $("#txtId_user").val(),
            "opcao": "gravar",
            "data": '<?= date('Y-m-d H:i:s') ?>',
        }

        $.ajax({
            type: 'POST',
            url: 'mod_pipa/backEnd/View/pmda/funcAdm.php?v=<?= md5(VERSAO) ?>',
            data: dados,
            success: function (response) {
                alert('Status Alterado com Sucesso !!')
                location.reload();
            },
            error: function (response) {
                console.log(JSON.stringify(response));
            }
        });
    }

    /*
     Alterar ESTADO pmda via CEDEC
     */
    function alterarEstado(id_pmda, estado = null) {

        var id_sel = "#selEstado";
        var val_estado;
        if (estado) {
            val_estado = estado;
        } else {
            val_estado = $(id_sel).val();
        }


        var dados = {
            "id_pmda": id_pmda,
            "estado": val_estado,
            "resp": $("#txtId_user").val(),
            "opcao": "alterar_estado",
            "data": '<?= date('Y-m-d H:i:s') ?>'
        }

        $.ajax({
            type: 'POST',
            url: 'mod_pipa/backEnd/View/pmda/funcAdm.php?v=<?= md5(VERSAO) ?>',
            data: dados,
            success: function (response) {
                //console.log(response);
                alert('Estado Alterado com Sucesso !!');
                location.reload();
            },
            error: function (response) {
                console.log(JSON.stringify(response));
            }
        });

        if ($(id_sel).val() == '5') {
            alert('anulado');
    }

    }

    /*
     Liberar alterar Comunidades
     */
    function liberar_alterar(id_pmda) {
        var dados = {
            "id_pmda": id_pmda,
            "opcao": "liberar_alterar"
        }

        $.ajax({
            type: 'POST',
            url: 'mod_pipa/backEnd/View/pmda/funcAdm.php?v=<?= md5(VERSAO) ?>',
            data: dados,
            success: function (response) {
                console.log(response);
                alert('Pmda com permissao de alterar as Comunidades !')
            },
            error: function (response) {
                console.log(JSON.stringify(response));
            }
        });
    }


</script>
