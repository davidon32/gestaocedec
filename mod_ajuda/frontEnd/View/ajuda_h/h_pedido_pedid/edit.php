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


<?php
$cedec_municipio = new H_pedido_pedidajuda_hModel();

$dadosMunicipio = $cedec_municipio->listaid_municipioAutocomplete();
$com_regiao = new H_pedido_pedidajuda_hModel();

$dadosRegiao = $com_regiao->listaid_mesoAutocomplete();
$dec_cobrade = new H_pedido_pedidajuda_hModel();

$dadosCobrade = $dec_cobrade->listaid_cobradeAutocomplete();
?>
<div class='col-md-12'>
    <legend>Editar Pedido de Ajuda Humanitária nº : <?= $view[0]['numero'] . "-" . substr($view[0]['data_entrada_sistema'], 0, 4) ?></legend>


    <form action="<?= FuncaoBase::geraLink("ajuda", "h_pedido_pedid", "edit", array('voltar' => 'index')); ?>" method="post" accept-charset="utf-8" name="frmH_pedido_pedid" id="frmH_pedido_pedid">

        <div>
            <div class='row'>
                <div class='col-md-2'>
                    <label>Número Pedido</label>
                    <input type="text" class='form form-control' value='<?= $view[0]['numero'] . "-" . substr($view[0]['data_entrada_sistema'], 0, 4) ?>' readonly=readonly>
                    <input type="hidden" class='form form-control' name='numero' id='numero' value='<?= $view[0]['numero'] ?>' readonly=readonly>
                    <input type="hidden" id='id' name='id' value='<?= $view[0]['id'] ?>'>
                    <input type="hidden" id='despachante_analista' name='despachante_analista' value='<?= $view[0]['despachante_analista'] ?>'>
                    <input type="hidden" id='despachante_dlog' name='despachante_dlog' value='<?= $view[0]['despachante_dlog'] ?>'>
                </div>
            </div>
            <div class='row'>
                <div class='col-md-2'>
                    <label>Data Entrada Sistema</label>
                    <input type="text" class='form form-control' name='data_entrada_sistema' id='data_entrada_sistema' value='<?= DataMysql::dataCompletaVisual($view[0]['data_entrada_sistema']) ?>'  maxlength='-1' readonly=readonly>
                </div>
            </div>
            <div class='row'>
                <div class='col-md-6'>
                    <label>Municipio</label>
                    <input type="text" class='form form-control' name='nomeMunicipio_fk' id='nomeMunicipio_fk' value='<?= $h_pedido_pedidModel->getNomeIdFk('cedec_municipio', 'id_municipio', $view[0]['id_municipio'])->nome; ?>' required readonly='readonly'>
                    <input type="hidden" name='id_municipio' id='id_municipio' required readonly='readonly' value='<?= $view[0]['id_municipio'] ?>'>
                </div>
            </div>
            <div class='row'>
                <div class='col-md-6'>
                    <label>Identificador Mesorregião</label>
                    <div class="input-group">
                        <input type="text" class='form form-control' name='nomeRegiao_fk' id='nomeRegiao_fk' value='<?= $h_pedido_pedidModel->getNomeIdFk('com_regiao', 'id_regiao', $view[0]['id_regiao'])->nome; ?>' required readonly='readonly'>
                        <span onclick="" class="input-group-addon" id="btnBuscaid_regiao">
                            <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                        </span> </div><input type="hidden" name='id_regiao' id='id_regiao' required readonly='readonly' value='<?= $view[0]['id_regiao'] ?>'>
                </div>
            </div>
            <div class='row'>  
                <div class='col-md-6'>
                    <label>Nome do Coordenador</label>
                    <input type="text" class='form form-control' name='nome_coordenador' id='nome_coordenador' value='<?= $view[0]['nome_coordenador'] ?>'  maxlength='44' required>
                </div>
            </div>
            <div class='row'>
                <div class='col-md-2'>
                    <label>Telefone do Coordenador</label>
                    <input type="text" class='form form-control' name='tel_coordenador' id='tel_coordenador' value='<?= $view[0]['tel_coordenador'] ?>'  maxlength='12' required>
                </div>
            </div>
            <div class='row'>
                <div class='col-md-2'>
                    <label>Celular do Coordenador</label>
                    <input type="text" class='form form-control' name='cel_coordenador' id='cel_coordenador' value='<?= $view[0]['cel_coordenador'] ?>'  maxlength='12' required>
                </div>
            </div>
            <div class='row'>
                <div class='col-md-6'>
                    <label>Email do Coordenador</label>
                    <input type="text" class='form form-control' name='email_coordenador' id='email_coordenador' value='<?= $view[0]['email_coordenador'] ?>'  maxlength='99' required>
                </div>
            </div>
            <div class='row'>
                <div class='col-md-6'>
                    <label>Nome do Prefeito</label>
                    <input type="text" class='form form-control' name='nome_prefeito' id='nome_prefeito' value='<?= $view[0]['nome_prefeito'] ?>'  maxlength='44' required>
                </div>
            </div>
            <div class='row'>
                <div class='col-md-2'>
                    <label>Telefone do Prefeito</label>
                    <input type="text" class='form form-control' name='tel_prefeito' id='tel_prefeito' value='<?= $view[0]['tel_prefeito'] ?>'  maxlength='12' required>
                </div>
            </div>
            <div class='row'>
                <div class='col-md-2'>
                    <label>Celular do Prefeito</label>
                    <input type="text" class='form form-control' name='cel_prefeito' id='cel_prefeito' value='<?= $view[0]['cel_prefeito'] ?>'  maxlength='12' required>
                </div>
            </div>
            <div class='row'>
                <div class='col-md-6'>
                    <label>Email do Prefeito</label>
                    <input type="text" class='form form-control' name='email_prefeito' id='email_prefeito' value='<?= $view[0]['email_prefeito'] ?>'  maxlength='49' required>
                </div>
            </div>
            <div class='row'>
                <div class='col-md-6'>
                    <label>Tipo do Desastre</label>
                    <div class="input-group">
                        <input type="text" class='form form-control' name='nomeCobrade_fk' id='nomeCobrade_fk' value='<?= $h_pedido_pedidModel->getNomeIdFk('dec_cobrade', 'id_cobrade', $view[0]['id_cobrade'])->nome; ?>' required readonly='readonly'>
                        <span onclick="" class="input-group-addon" id="btnBuscaid_cobrade">
                            <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                        </span> </div><input type="hidden" name='id_cobrade' id='id_cobrade' required readonly='readonly' value='<?= $view[0]['id_cobrade'] ?>'>
                </div>
            </div>
            <div class='row'>
                <div class='col-md-2'>
                    <label>População Atendida</label>
                    <input type="number" class='form form-control' name='pop_atendida' id='pop_atendida' value='<?= $view[0]['pop_atendida'] ?>'  max='1000' required>
                </div>
            </div>
            <div class='row'>
                <div class='col-md-2'>
                    <label>Decreto SE ou ECP Vigente ?</label>
                    <div class="radio">
                        <label>
                            <input type="radio" name="decreto_se_ecp_vig" id="nao" value="0" <?= ($view[0]['decreto_se_ecp_vig']) == "0" ? ' checked' : ""; ?>>
                            Não
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="decreto_se_ecp_vig" id="sim" value="1" <?= ($view[0]['decreto_se_ecp_vig']) == "1" ? ' checked' : ""; ?>>
                            Sim
                        </label>
                    </div>
                </div>
            </div>
            <div class='row'>
                <div class='col-md-2'>
                    <label>Número do Decreto</label>
                    <input type="text" class='form form-control' name='numero_decreto' id='numero_decreto' value='<?= $view[0]['numero_decreto'] ?>'  maxlength='19' >
                </div>
            </div>
            <div class='row'>
                <div class='col-md-2'>
                    <label>Data de Vigencia Decreto</label>
                    <input type="text" class='form form-control' name='data_vigencia' id='data_vigencia' value='<?= DataMysql::dataVisual($view[0]['data_vigencia']) ?>'  maxlength='-1' >
                </div>
            </div>
            <div class='row'>
                <div class='col-md-6'>
                    <label>Tipo do Decreto</label>
                    <div class="radio">
                        <label>
                            <input type="radio" name="tipo_decreto" id="ECP" value="ECP" <?= ($view[0]['tipo_decreto'] == "ECP" ? "checked" : ""); ?>>
                            ECP - Estado de Calamidade Pública
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="tipo_decreto" id="SE" value="SE" <?= ($view[0]['tipo_decreto'] == "SE" ? "checked" : ""); ?>>
                            SE - Situação de Emergência
                        </label>
                    </div>
                </div>
            </div>
            <div class='row'>
                <div class='col-md-12'>
                    <label>Esforços Realizados: </label> <span style="color: silver" id='caracteres'></span>
                    <textarea class='form form-control' name='esforcos_realizados' id='esforcos_realizados' maxlength='65534' rows="8" required>
<?= $view[0]['esforcos_realizados'] ?></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-letf">
                    <br>
                    <button type="button" class="btn btn-warning glyphicon glyphicon-shopping-cart" name="add_material" id="add_material" title="Adiconar Material no Pedido"> Adicionar Material</button>
                </div>
            </div>

            <div class="col-md-12">
                <legend>Materiais Pedidos</legend>
                <table class="table table-bordered table-condensed">

                    <tr><!-- comment -->
                        <th class='col-md-1'>Cod. Item</th>
                        <th class='col-md-1'>Código</th>
                        <th class='col-md-7 '>Material</th>
                        <th class='col-md-1'>Qtd</th>
                        <th class='col-md-1'>Qtd Familias Atend.</th>
                        <th class='col-md-1'>Opção</th>
                    </tr>

                    <?php
                    $materiais = H_pedido_pedidajuda_hModel::item_pedido($view[0]['id']);

                    foreach ($materiais as $key => $material) {

                        print "<tr>";
                        print "<td>" . $material['id'] . "</td>";
                        print "<td>" . $material['codigo'] . "</td>";
                        print "<td>" . $material['descricao_item'] . "</td>";
                        print "<td>" . $material['qtd'] . "</td>";
                        print "<td>" . $material['qtd_familia_atendida'] . "</td>";
                        print "<td>";
                        print "<a href='index.php" . FuncaoBase::geraLink('ajuda', 'h_pedido_pedid', 'add_itens', array('id' => $view[0]['id'], 'id_material' => $material['id'], 'voltar' => 'idx_recente')) . "'><img src='/core/imagem/editar.png'></a>";
                        print "<a href='index.php" . FuncaoBase::geraLink('ajuda', 'h_pedido_itens', 'delete', array('id' => $material['id'], 'action1' => 'edit', 'id' => $view[0]['id'], 'voltar' => 'edit_ped')) . "'><img src='/core/imagem/delete.png'></a>";

                        print "</td>";
                        print "</tr>";
                    }
                    ?>


                </table>
                <hr>
            </div>         
            <br>
            <div class="row">
                <div class="col-md-12 text-left">
                    <br>
                    <p>É necessário anexar o DMAT, somente quando o decreto for <span style='color:red; font-weight: bold'>Municipal</span>. </p>
                    <button type="button" class="btn btn-warning glyphicon glyphicon-upload" name="upload_arquivos" id="upload_arquivos" title="Fazer upload de arquivos"> Upload Arquivos</button>
                    <br>
                    <span style='color:red; font-weight: bold'>Tamanho máximo 2Mb</span>

                </div>
            </div>
            <div class="col-md-12 text-center">
                <legend>Lista de Arquivos Anexados</legend>

                <table class="table table-bordered table-condensed table-striped">

                    <tr>
                        <th>#</th>
                        <th>Data Envio</th>
                        <th>Nome arquivo</th>
                        <th>Descrição</th>
                        <th>Ações</th>
                    </tr>

                    <?php
                    $arquivos = H_pedido_anexoajuda_hModel::ListaAnexo($view[0]['id']);

                    foreach ($arquivos as $key => $arquivo) {


                        print "<tr>";
                        print "<td>" . ($key + 1) . "</td>";
                        print "<td>" . DataMysql::dataCompletaVisual($arquivo['data_envio']) . "</td>";
                        print "<td><a href='" . FuncaoBase::geraLink("cedec", "app", "visualiza", array('file' => $arquivo['nome_arquivo'], 'fl' => 'pedido_h')) . "'>" . $arquivo['nome_arquivo'] . "</a></td>";
                        print "<td>" . $arquivo['descricao'] . "</td>";
                        print "<td><a name='deletar_anexo' data-nome_arquivo='" . $arquivo['nome_arquivo'] . "' data-id='" . $arquivo['id'] . "' title='Apagar Arquivo'><img src='/core/imagem/delete.png'></a></td>";
                        print "</tr>";
                    }
                    ?>

                </table>
            </div>
            <div class="col-md-6 text-left">
                <br>
                <button type="submit" class="btn btn-info glyphicon glyphicon-floppy-save" name="btnGravar" id="btnGravar" title="Gravar Registro"> Gravar</button>
                <button type="button" class="btn btn-info" name="btnEnviar" id="btnEnviar" title="Enviar pedido para Analista da CEDEC" data-id_pedido="<?= $view[0]['id'] ?>"> Enviar para Análise</button>
            </div>

            <div class="col-md-6 text-right">

                <br>
                <?php
                if ($_GET['voltar'] == 'idx_recente') {
                    print "<a class=\"btn btn-success\" href=\"" . FuncaoBase::geraLink("ajuda", "h_pedido_index", "index") . "\">Voltar</a>";
                } else {
                    print "<a class=\"btn btn-success\" href=\"" . FuncaoBase::geraLink("ajuda", "h_pedido_pedid", "index") . "\">Voltar</a>";
                }
                ?>
            </div>
    </form>

    <!--######################  MODAL cedec_municipio ###################-->

    <div class="modal fade" tabindex="-1" role="dialog" id="modal_id_municipio">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Cadastro cedec_municipio</h4>
                </div>
                <div class="modal-body">
                    <label>Pesquisa</label>
                    <input type="text" class="form form-control" name="searcid_municipio" id="searcid_municipio">
                </div>
                <div class="modal-footer">
                    <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                    <div class="col-md-6 text-left">
                        <a href="<?= FuncaoBase::geraLink("ajuda", "h_pedido_pedid", "cadastro"); ?>" class="btn btn-success text-left" >Cadastrar Novo</a>
                    </div>
                    <div class="col-md-6 text-right">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!--###################  FIM MODAL cedec_municipio ####################--><!--######################  MODAL com_regiao ###################-->

    <div class="modal fade" tabindex="-1" role="dialog" id="modal_id_regiao">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Cadastro com_regiao</h4>
                </div>
                <div class="modal-body">
                    <label>Pesquisa</label>
                    <input type="text" class="form form-control" name="searcid_regiao" id="searcid_regiao">
                </div>
                <div class="modal-footer">
                    <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                    <div class="col-md-6 text-left">
                        <a href="<?= FuncaoBase::geraLink("ajuda", "h_pedido_pedid", "cadastro"); ?>" class="btn btn-success text-left" >Cadastrar Novo</a>
                    </div>
                    <div class="col-md-6 text-right">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!--###################  FIM MODAL com_regiao ####################--><!--######################  MODAL dec_cobrade ###################-->

    <div class="modal fade" tabindex="-1" role="dialog" id="modal_id_cobrade">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Cadastro dec_cobrade</h4>
                </div>
                <div class="modal-body">
                    <label>Pesquisa</label>
                    <input type="text" class="form form-control" name="searcid_cobrade" id="searcid_cobrade">
                </div>
                <div class="modal-footer">
                    <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                    <div class="col-md-6 text-left">
                        <a href="<?= FuncaoBase::geraLink("ajuda", "h_pedido_pedid", "cadastro"); ?>" class="btn btn-success text-left" >Cadastrar Novo</a>
                    </div>
                    <div class="col-md-6 text-right">
                        <button type="submit" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!--###################  FIM MODAL dec_cobrade ####################-->

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

            $("#btnEnviar").click(function () {
                Swal.fire({
                    title: 'Deseja enviar o Pedido para o analista da CEDEC ?',
                    text: "CERTIFIQUE-SE QUE O PEDIDO ESTÁ EM CONDIÇÕES DE ENVIO !",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Enviar'
                }).then((result) => {
                    if (result.isConfirmed) {

                        //Swal.fire('Enviado para analista da CEDEC !');
                        var formData = new FormData();
                        var id_pedido = $(this).data('id_pedido');

                        formData.append('opcao', 'envia_pedido');
                        formData.append('id_pedido', id_pedido);
                        formData.append('data_hora_envio', '<?= date('Y-m-d H:i:s') ?>');
                        formData.append('tramit', 'analise_dlog');
                        formData.append('status', '1');
                        $.ajax({
                            url: '/mod_ajuda/frontEnd/View/ajuda_h/h_pedido_pedid/ajax.php',
                            type: 'POST',
                            data: formData,
                            processData: false, // tell jQuery not to process the data
                            contentType: false, // tell jQuery not to set contentType
                            success: function (response) {

                                alert('Operação Realizada com Sucesso !');
                                window.location.href = '<?= FuncaoBase::geraLink('ajuda', 'h_pedido_index', 'index') ?>';
                            },
                            error: function (e) {
                                //console.log(JSON.stringify(e));
                            }
                        });

                    }
                })

            });

            if (getUrlVars().final == 'final') {
                $("*").animate({scrollTop: $(document).height()}, 2000);

            }



            $("#data_entrada_sistema").datepicker("destroy");

            $("#add_material").click(function () {
                window.location.href = '<?= FuncaoBase::geraLink("ajuda", "h_pedido_pedid", "add_itens", array('id' => $view[0]['id'], 'voltar' => 'idx_recente')) ?>';
            });

            $("#upload_arquivos").hover(function () {
                setInterval(
                        [].forEach.bind($("#btnGravar"),
                        function (a) {
                            a.style.outline = "5px solid #" + (~~(Math.random() * (1 << 24))).toString(16)
                        },
                        5),
                        1000);
            });




            $("#upload_arquivos").click(function () {
                //$("#btnGravar").addClass("animacao");

                var result = confirm('Atenção \n Antes de Fazer o upload de arquivos salve as alterações nos dados do pedido\n deseja continuar mesmo assim ?')


                if (result) {
                    window.location.href = '<?= FuncaoBase::geraLink("ajuda", "h_pedido_anexo", "cadastro", array('id' => $view[0]['id'], 'voltar' => $_GET['voltar'])) ?>';
                }
            });

            /* conta os caracteres */
            $("#caracteres").text($("#esforcos_realizados").val().length + " / 65534 ( Caracteres restantes )");
            $("#esforcos_realizados").keyup(function () {
                $("#caracteres").text($("#esforcos_realizados").val().length + " / 65534 ( Caracteres restantes )");
            });

            if ($("#nao").is(":checked")) {
                $("#nao").attr("checked", true);
                $("#sim").attr("checked", false);

                /* campos numero decreto, data vigencia */
                $("#numero_decreto,#data_vigencia").val("");
                $("#numero_decreto,#data_vigencia").attr('readonly', 'readonly');
                $("#data_vigencia").datepicker("destroy");
                $("#numero_decreto,#data_vigencia").css('cursor', 'not-allowed');

            }

            $("[name=decreto_se_ecp_vig]").change(function () {
                if ($("#nao").is(":checked")) {
                $("#nao").attr("checked", true);
                        $("#sim").attr("checked", false);
                        /* campos numero decreto, data vigencia */
                        $("#numero_decreto,#data_vigencia").val("");
                        $("#numero_decreto,#data_vigencia").attr('readonly', 'readonly');
                        $("#data_vigencia").datepicker("destroy");
                        $("#numero_decreto,#data_vigencia").css('cursor', 'not-allowed');
                } else if ($("#sim").is(":checked")) {
                $("#sim").attr("checked", true);
                        $("#nao").attr("checked", false);
                        /* campos numero decreto, data vigencia */
                        $("#numero_decreto,#data_vigencia").removeAttr('readonly');
                        $("#data_vigencia").datepicker({dateFormat: 'dd/mm/yy',
                            monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
                            monthNamesShort: [ 'Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dec'],
                            dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
                            dayNamesMin: [ 'Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab' ],
                        orientation: "bottom left",
                        beforeShow: function () { /* problema datapicker atras controle input*/
                        
                        }
                },) ;

                $("#numero_decreto,#data_vigencia").css('cursor', 'text');
                }
            });

            $("[name=tipo_decreto]").change(function () {
                if ($("#ECP").is(":checked")) {
                    $("#ECP").attr("checked", true);
                    $("#SE").attr("checked", false);
                } else if ($("#SE").is(":checked")) {
                    $("#SE").attr("checked", true);
                    $("#ECP").attr("checked", false);
                }

            });



            /* clic form campo FK  */
            $("#nomeRegiao").click(function () {
                $("#modal_id_regiao").modal({backdrop: 'static', keyboard: false});
            });
            /* focus no campo pesquisa fornecedor */
            $('#modal_id_regiao').on('shown.bs.modal', function (e) {
                $("#searcid_regiao").focus();
            });
            /* clic form campo FK  */
            $("#nomeCobrade").click(function () {
                $("#modal_id_cobrade").modal({backdrop: 'static', keyboard: false});
            });
            /* focus no campo pesquisa fornecedor */
            $('#modal_id_cobrade').on('shown.bs.modal', function (e) {
                $("#searcid_cobrade").focus();
            });
            /* clic form campo FK  */
            $("#nomeMunicipio").click(function () {
                $("#modal_id_municipio").modal('show');
            });
            /* focus no campo pesquisa  */
            $('#modal_id_municipio').on('shown.bs.modal', function (e) {
                $("#searcid_municipio").focus();
            });
            /* clic form campo FK  */
            $("#nomeRegiao").click(function () {
                $("#modal_id_regiao").modal('show');
            });
            /* focus no campo pesquisa fornecedor */
            $('#modal_id_regiao').on('shown.bs.modal', function (e) {
                $("#searcid_regiao").focus();
            });
            /* clic form campo FK fornecedor */
            $("#nomeCobrade").click(function () {
                $("#modal_id_cobrade").modal('show');
            });
            /* focus no campo pesquisa fornecedor */
            $('#modal_id_cobrade').on('shown.bs.modal', function (e) {
                $("#searcid_cobrade").focus();
            });


            /* ###################  fk_cedec_municipio ####################*/
            $('#btnBuscaid_municipio').click(function () {
                $('#modal_id_municipio').modal('show');
            });

            var itens = {
                data:
<?php print json_encode($dadosMunicipio); ?>, // array com os dados
                getValue: "nome", /* alterar com nome do item BD */
                list: {
                    match: {
                        enabled: true
                    },

                    onSelectItemEvent: function () {
                        var id = $("#searcid_municipio").getSelectedItemData().id_municipio;
                        var nome = $("#searcid_municipio").getSelectedItemData().nome;

                        $("#nomeMunicipio_fk").val(nome); // Mudar
                        $("#id_municipio").val(id);
                    },
                    onClickEvent: function () {
                        $('#modal_id_municipio').modal('hide');
                    }
                }
            };
            /*********** autocomplete ***********/
            $("#searcid_municipio").easyAutocomplete(itens);

            /*###########################  final cedec_municipio #####################*/

            /* ###################  fk_com_regiao ####################*/
            $('#btnBuscaid_regiao').click(function () {
                $('#modal_id_regiao').modal('show');
            });

            var itens = {
                data:
<?php print json_encode($dadosRegiao); ?>, // array com os dados
                getValue: "nome", /* alterar com nome do item BD */
                list: {
                    match: {
                        enabled: true
                    },

                    onSelectItemEvent: function () {
                        var id = $("#searcid_regiao").getSelectedItemData().id_meso;
                        var nome = $("#searcid_regiao").getSelectedItemData().nome;

                        $("#nomeRegiao_fk").val(nome); // Mudar
                        $("#id_regiao").val(id);
                    },
                    onClickEvent: function () {
                        $('#modal_id_regiao').modal('hide');
                    }
                }
            };
            /*********** autocomplete ***********/
            $("#searcid_regiao").easyAutocomplete(itens);

            /*###########################  final com_regiao #####################*/

            /* ###################  fk_dec_cobrade ####################*/
            $('#btnBuscaid_cobrade').click(function () {
                $('#modal_id_cobrade').modal('show');
            });

            var itens = {
                data:
<?php print json_encode($dadosCobrade); ?>, // array com os dados
                getValue: "descricao", /* alterar com nome do item BD */
                list: {
                    match: {
                        enabled: true
                    },

                    onSelectItemEvent: function () {
                        var id = $("#searcid_cobrade").getSelectedItemData().id_cobrade;
                        var descricao = $("#searcid_cobrade").getSelectedItemData().descricao;

                        $("#nomeCobrade_fk").val(descricao); // Mudar
                        $("#id_cobrade").val(id);
                    },
                    onClickEvent: function () {
                        $('#modal_id_cobrade').modal('hide');
                    }
                }
            };
            /*********** autocomplete ***********/
            $("#searcid_cobrade").easyAutocomplete(itens);

            /*###########################  final dec_cobrade #####################*/

            $("a[name=deletar_anexo]").click(function () {

                var formData = new FormData();
                formData.append('nome_arquivo', $(this).data('nome_arquivo'));
                formData.append('id', $(this).data('id'));
                $.ajax({
                    url: '<?= FuncaoBase::geraLink("ajuda", "h_pedido_anexo", "delete"); ?>',
                    type: 'POST',
                    data: formData,
                    processData: false, // tell jQuery not to process the data
                    contentType: false, // tell jQuery not to set contentType
                    success: function (response) {
                        if (response.trim() == 'sucesso') {
                            alert('Arquivo apagado com Sucesso !');
                            window.location.reload();
                        }

                    },
                    error: function (e) {
                        //console.log(JSON.stringify(e));
                    }
                });
            });


        });
    </script>
