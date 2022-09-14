<?php include_once PATH . '/core/include.php'; ?>
<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_ajuda/Model/indexModel.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";
?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>
<link rel="stylesheet" href="/vendor/jstree/dist/themes/default/style.min.css" />
<style>

    my-actions { margin: 0 2em; }
    .order-1 { order: 1; }
    .order-2 { order: 2; }
    .order-3 { order: 3; }

    .right-gap {
        margin-right: auto;
    }
</style>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="/vendor/jstree/dist/jstree.js"></script>

<?php
$cedec_municipio = new H_pedido_pedidajuda_hModel();

$dadosMunicipio = $cedec_municipio->listaid_municipioAutocomplete();
$com_regiao = new H_pedido_pedidajuda_hModel();

$dadosRegiao = $com_regiao->listaid_regiaoAutocomplete();
$dec_cobrade = new H_pedido_pedidajuda_hModel();

$dadosCobrade = $dec_cobrade->listaid_cobradeAutocomplete();

$dadosMaterial = H_pedido_pedidajuda_hModel::MaterialPedido(1);

$option = "<option>Selecione o Material</option>";
foreach ($dadosMaterial as $key => $material) {
    $option .= "<option value='" . $material['id_unidade'] . "'>" . $material['singular'] . "</option>";
}

$id_usuario = isset($_COOKIE['seguranca']['idUser']) ? $_COOKIE['seguranca']['idUser'] : null;
?>

<div class='col-md-12 text-center'>

    <br>
    <?php
    if (isset($_GET['voltar']) and $_GET['voltar'] == 'idx_recente') {
        print "<a class=\"btn btn-success\" href=\"" . FuncaoBase::geraLink("ajuda", "h_pedido_index", "index") . "\">Voltar</a>";
    } else {
        print "<a class=\"btn btn-success\" href=\"" . FuncaoBase::geraLink("ajuda", "h_pedido_pedid", "index") . "\">Voltar</a>";
    }
    ?>
    <br><br>

</div>
<div class='col-md-12'>
    <legend>Pedido Ajuda Humanitária nº:
        <?= $view[0]['numero'] . " / " . substr($view[0]['data_entrada_sistema'], 0, 4) ?> - <?= Municipio::PegaNomeMunicipio($view[0]['id_municipio']) ?></legend>



    <!-- jstree -->
    <div class="col-md-3" data-spy="scroll">
        <div id="html1">
            <ul>
                <li data-jstree='{"opened":true,"selected":true}' id='processo'> Processo Nº -
                    <?= $view[0]['numero'] . "/" . substr($view[0]['data_entrada_sistema'], 0, 4) ?> -
                    <?= DataMysql::dataVisual($view[0]['data_entrada_sistema']) ?>
                    <ul>
                        <li data-jstree='{"disabled":false}' id='show_dados_gerais'> Dados Gerais</li>
                        asas
                        <li data-jstree='{"icon":"//jstree.com/tree.png"}' id='show_material_pedido'>
                            Material do Pedido</li>
                        <?php
                        if ($_COOKIE['seguranca']['secao'] != 'CHEFIA') {
                            ?>
                            <li data-jstree='{"icon":"glyphicon glyphicon-leaf"}' id='show_tramitar'>
                                Tramitação de Pedido</li>
                            <?php
                        }
                        ?>
                        <li data-jstree='{"icon":"glyphicon glyphicon-leaf"}' id='show_anexos'>
                            Arquivo Anexados</li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>


    <!-- Dados Gerais -->
    <div class="col-md-9" id="dados_gerais">


        <form action="<?= FuncaoBase::geraLink("ajuda", "h_pedido_pedid", "edit"); ?>" method="post" accept-charset="utf-8" name="frmH_pedido_pedid" id="frmH_pedido_pedid">

            <div class='row'>
                <div class='col-md-2'>
                    <label>Número Pedido</label>
                    <input type="text" class='form form-control' name='numero' id='numero' value='<?= $view[0]['numero'] . "-" . substr($view[0]['data_entrada_sistema'], 0, 4) ?>' readonly=readonly>
                    <input type="hidden" id='id' name='id' value='<?= $view[0]['id'] ?>'>
                    <input type="hidden" id='despachante_analista' name='despachante_analista' value='<?= $view[0]['despachante_analista'] ?>'>
                    <input type="hidden" id='despachante_dlog' name='despachante_dlog' value='<?= $view[0]['despachante_dlog'] ?>'>
                </div>
            </div>
            <div class='row'>
                <div class='col-md-2'>
                    <label>Data Entrada Sistema</label>
                    <input type="text" class='form form-control' name='data_entrada_sistema' id='data_entrada_sistema' value='<?= DataMysql::dataVisual($view[0]['data_entrada_sistema']) ?>' maxlength='-1' required>
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
                        </span>
                    </div><input type="hidden" name='id_regiao' id='id_regiao' required readonly='readonly' value='<?= $view[0]['id_regiao'] ?>'>
                </div>
            </div>
            <div class='row'>
                <div class='col-md-6'>
                    <label>Nome do Coordenador</label>
                    <input type="text" class='form form-control' name='nome_coordenador' id='nome_coordenador' value='<?= $view[0]['nome_coordenador'] ?>' maxlength='44' required>
                </div>
            </div>
            <div class='row'>
                <div class='col-md-2'>
                    <label>Telefone do Coordenador</label>
                    <input type="text" class='form form-control' name='tel_coordenador' id='tel_coordenador' value='<?= $view[0]['tel_coordenador'] ?>' maxlength='12' required>
                </div>
            </div>
            <div class='row'>
                <div class='col-md-2'>
                    <label>Celular do Coordenador</label>
                    <input type="text" class='form form-control' name='cel_coordenador' id='cel_coordenador' value='<?= $view[0]['cel_coordenador'] ?>' maxlength='12' required>
                </div>
            </div>
            <div class='row'>
                <div class='col-md-6'>
                    <label>Email do Coordenador</label>
                    <input type="text" class='form form-control' name='email_coordenador' id='email_coordenador' value='<?= $view[0]['email_coordenador'] ?>' maxlength='49' required>
                </div>
            </div>
            <div class='row'>
                <div class='col-md-6'>
                    <label>Nome do Prefeito</label>
                    <input type="text" class='form form-control' name='nome_prefeito' id='nome_prefeito' value='<?= $view[0]['nome_prefeito'] ?>' maxlength='44' required>
                </div>
            </div>
            <div class='row'>
                <div class='col-md-2'>
                    <label>Telefone do Prefeito</label>
                    <input type="text" class='form form-control' name='tel_prefeito' id='tel_prefeito' value='<?= $view[0]['tel_prefeito'] ?>' maxlength='12' required>
                </div>
            </div>
            <div class='row'>
                <div class='col-md-2'>
                    <label>Celular do Prefeito</label>
                    <input type="text" class='form form-control' name='cel_prefeito' id='cel_prefeito' value='<?= $view[0]['cel_prefeito'] ?>' maxlength='12' required>
                </div>
            </div>
            <div class='row'>
                <div class='col-md-6'>
                    <label>Email do Prefeito</label>
                    <input type="text" class='form form-control' name='email_prefeito' id='email_prefeito' value='<?= $view[0]['email_prefeito'] ?>' maxlength='49' required>
                </div>
            </div>
            <div class='row'>
                <div class='col-md-6'>
                    <label>Tipo do Desastre</label>
                    <div class="input-group">
                        <input type="text" class='form form-control' name='nomeCobrade_fk' id='nomeCobrade_fk' value='<?= $h_pedido_pedidModel->getNomeIdFk('dec_cobrade', 'id_cobrade', $view[0]['id_cobrade'])->nome; ?>' required readonly='readonly'>
                        <span onclick="" class="input-group-addon" id="btnBuscaid_cobrade">
                            <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                        </span>
                    </div><input type="hidden" name='id_cobrade' id='id_cobrade' required readonly='readonly' value='<?= $view[0]['id_cobrade'] ?>'>
                </div>
            </div>
            <div class='row'>
                <div class='col-md-2'>
                    <label>População Atendida</label>
                    <input type="text" class='form form-control' name='pop_atendida' id='pop_atendida' value='<?= $view[0]['pop_atendida'] ?>' maxlength='-1' required>
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
                    <input type="text" class='form form-control' name='numero_decreto' id='numero_decreto' value='<?= $view[0]['numero_decreto'] ?>' maxlength='19'>
                </div>
            </div>
            <div class='row'>
                <div class='col-md-2'>
                    <label>Data de Vigencia Decreto</label>
                    <input type="text" class='form form-control' name='data_vigencia' id='data_vigencia' value='<?= DataMysql::dataVisual($view[0]['data_vigencia']) ?>' maxlength='-1'>
                </div>
            </div>
            <div class='row'>
                <div class='col-md-6'>
                    <label>Tipo do Decreto</label>
                    <div class="radio">
                        <label>
                            <input type="radio" name="tipo_decreto" id="ECP" value="ECP" checked>
                            ECP
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="tipo_decreto" id="SE" value="SE">
                            SE
                        </label>
                    </div>
                </div>
            </div>
            <div class='row'>
                <div class='col-md-12'>
                    <label>Esforços Realizados: </label>
                    <span style="color: silver" id='caracteres'></span>
                    <textarea class='form form-control' name='esforcos_realizados' id='esforcos_realizados' maxlength='65534' rows="8" required>
                        <?= $view[0]['esforcos_realizados'] ?>
                    </textarea>
                </div>
            </div>
            <div class='row'>
                <div class='col-md-2'>
                    <label>Data Hora Envio Homologação</label>
                    <input type="text" class='form form-control' name='data_hora_envio' id='data_hora_envio' value='<?= DataMysql::dataVisual($view[0]['data_hora_envio']) ?>' maxlength='-1' required>
                </div>
            </div>
            <div class="row">

                <!-- <div class="col-md-12 text-letf">
                    <br>
                    <button type="button" class="btn btn-warning glyphicon glyphicon-shopping-cart" name="add_material" id="add_material" title="Adiconar Material no Pedido"> Adicionar Material</button>
                </div> -->
            </div>

            <div class="col-md-6 text-left">
                <br>
                <button type="submit" class="btn btn-info glyphicon glyphicon-floppy-save" name="btnGravar" id="btnGravar">
                    Gravar</button>
            </div>


        </form>
    </div>

    <!-- #################  Materiais do pedido ##################### -->
    <div class="col-md-9" id="material_pedido">
        <div class="col-md-12">
            <!-- MATERIAIS DO PEDIDO -->
            <legend>Material Pedido pelo Município</legend>
            <table class="table table-bordered table-condensed">

                <tr>
                    <!-- comment -->
                    <!-- <th style="width:10%">Código</th> -->
                    <!-- <th style="width:10%">Cód. MAt</th> -->
                    <th style="width:10%">#</th>
                    <th style="width:70%">Material</th>
                    <th style="width:10%">Qtd</th>
                    <th style="width:20%">Qtd Familias Atend.</th>
                    <!-- <th style="width:10%">Opção</th> -->
                </tr>

                <?php
                $materiaisPedido = H_pedido_pedidajuda_hModel::item_pedido($view[0]['id'], "P");

                if (count($materiaisPedido) > 0) {
                    foreach ($materiaisPedido as $key => $material) {

                        print "<tr>";
                        #print "<td>" . $material['id'] . "</td>";
                        #print "<td>" . $material['codigo'] . "</td>";
                        print "<td>" . ($key + 1) . "</td>";
                        print "<td>" . $material['descricao_item'] . "</td>";
                        print "<td>" . $material['qtd'] . "</td>";
                        print "<td>" . $material['qtd_familia_atendida'] . "</td>";
                        #print "<td>-</td>";
                        print "</tr>";
                    }
                }
                ?>


            </table>
        </div>


        <!-- ###############  MATERIAIS LIBERADOS ################ -->

        <div class="col-md-12">
            <p class="">
            <legend>Material a ser Liberado</legend>
            </p>

            <img title="Adicionar Material" src="/core/imagem/add.png" name="add_material"> Adicionar Material<br><br>
            <table class="table table-bordered table-condensed" id="tbl_material_liberado">

                <tr>
                    <!-- comment -->
                    <!-- <th style="width:10%">Código</th> -->
                    <!-- <th style="width:10%">Cód. Mat</th> -->
                    <th style="width:10%">#</th>
                    <th style="width:50%">Material</th>
                    <th style="width:15%">Qtd</th>
                    <th style="width:15%">Qtd Familias Atend.</th>
                    <th style="width:10%">Opção</th>
                </tr>

                <?php
                $materiaisLiberado = H_pedido_pedidajuda_hModel::item_pedido($view[0]['id'], "L");

                if (count($materiaisLiberado) > 0) {
                    foreach ($materiaisLiberado as $key => $material1) {

                        print "<tr>";
                        #print "<td>" . $material1['id'] . "</td>";
                        #print "<td>" . $material1['codigo'] . "</td>";
                        print "<td>" . ($key + 1) . "</td>";
                        print "<td>" . $material1['descricao_item'] . "</td>";
                        print "<td>" . $material1['qtd'] . "</td>";
                        print "<td>" . $material1['qtd_familia_atendida'] . "</td>";
                        print "<td>";
                        #print "<a href='index.php" . FuncaoBase::geraLink('ajuda', 'h_pedido_pedid', 'edit_itens', array('id' => $view[0]['id'], 'id_item' => $material1['id'])) . "'><img src='/core/imagem/editar.png'></a>";
                        print "<img src='/core/imagem/editar.png' name='edit' data-id='" . $view[0]['id'] . "' data-qtd='" . $material1['qtd'] . "' data-familias_at='" . $material1['qtd_familia_atendida'] . "'>
                        <img src='/core/imagem/save.png' name='salvar' data-id='" . $material1['id'] . "' data-codigo='" . $material1['codigo'] . "' data-descricao_item='" . $material1['descricao_item'] . "'>";
                        print "<a href='index.php" . FuncaoBase::geraLink('ajuda', 'h_pedido_itens', 'delete', array('id' => $material1['id'], 'id_pedido' => $view[0]['id'], 'voltar' => 'edit_ped')) . "'><img src='/core/imagem/delete.png'></a>";

                        print "</td>";
                        print "</tr>";
                    }
                }
                ?>


            </table>

            <p>
            <legend>Despacho</legend></p>
            <img title="Novo Despacho" src="/core/imagem/icon_app/new.png" name="add_despacho" id="add_despacho"> Novo Despacho<br><br>
            <div class="row" id='novoDespacho'>
                <div class="col-md-9">
                    <label>Despacho :</label><span id="span_caracteres">Caracteres Restantes : 255</span>
                    <textarea rows='5' id="text_despacho" class='form form-control' maxlength="255"></textarea>

                </div>
                <!-- Diretores poderão dar o parecer -->

                <div class="col-md-3">
                    <label>Parecer :</label><br>
                    Favorável : <input type='radio' value="1" name="rb_parecer" id="rb_favoravel" checked><br>
                    Desfavorável : <input type='radio' value="0" name="rb_parecer" id="rb_desfavoravel"><br>
                    Enviar p Analista : <input type='radio' value="2" name="rb_parecer" id="rb_analista"><br>
                    <br>
                </div>

                <br>
                <p class="text-left">Salvar <img src='/core/imagem/save.png' id="save_despacho"></p>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12" id='lista_despacho'>
                    <?php
                    include_once 'ajax_lista_despacho.php';
                    ?>
                </div>
            </div>

        </div>
    </div>

    <!-- #################  tramitar processo #################### -->

    <div class="col-md-9" id="tramitar">
        <select class="form form-control" name="sel_tramitar" id="sel_tramitar">
            <option value='<?= $view[0]['status'] ?>' data-status='<?= $view[0]['tramit'] ?>'><?= H_pedido_pedidajuda_hModel::enumFase($view[0]['tramit']) ?></option>
            <option value='2' data-status='analise_dlog' >Analista DLOG</option>
            <option value='4' data-status='aguard_disp'>Aguardando Disponibilidade</option>
            <?php
            if ($view[0]['status'] >= 4) {
                print "<option value='5' data-status='aguard_ret'>Aguardando Retirada</option>";
                print "<option value='6' data-status='atendido'>Atendido</option>";
                print "<option value='7' data-status='cancelado'>Cancelar</option>";
            }

            if ($view[0]['status'] == 2) {
                print "<option value='0' data-status='edicao_compdec'>Enviar para COMPDEC</option>";
            }
            ?>
        </select>


    </div>

    <!-- #################  arquivos anexos #################### -->
    <div class="col-md-9" id="anexos">
        <br>
        <div class="row">
            <div class="col-md-12 text-left">
                <br>
                <button type="button" class="btn btn-warning glyphicon glyphicon-upload" name="upload_arquivos" id="upload_arquivos" title="Fazer upload de arquivos"> Upload Arquivos</button>
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
    </div>


</div>

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
                    <a href="<?= FuncaoBase::geraLink("ajuda", "h_pedido_pedid", "cadastro"); ?>" class="btn btn-success text-left">Cadastrar Novo</a>
                </div>
                <div class="col-md-6 text-right">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--###################  FIM MODAL cedec_municipio ####################-->
<!--######################  MODAL com_regiao ###################-->

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
                    <a href="<?= FuncaoBase::geraLink("ajuda", "h_pedido_pedid", "cadastro"); ?>" class="btn btn-success text-left">Cadastrar Novo</a>
                </div>
                <div class="col-md-6 text-right">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--###################  FIM MODAL com_regiao ####################-->
<!--######################  MODAL dec_cobrade ###################-->

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
                    <a href="<?= FuncaoBase::geraLink("ajuda", "h_pedido_pedid", "cadastro"); ?>" class="btn btn-success text-left">Cadastrar Novo</a>
                </div>
                <div class="col-md-6 text-right">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
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

<script src="/vendor/jstree/dist/jstree.js"></script>


<script>
    $(document).ready(function () {

        /* tramitar processo */
        $("#sel_tramitar").change(function () {
            Swal.fire({
                title: 'Deseja Alterar o Status do Processo ?',
                showDenyButton: true,
                showCancelButton: true,
                showCloseButton: true,
                confirmButtonText: 'Sim',
                denyButtonText: 'Não',
                customClass: {
                    actions: 'my-actions',
                    cancelButton: 'order-1 right-gap',
                    confirmButton: 'order-2',
                    denyButton: 'order-3',
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    var formData = new FormData();
                    formData.append('opcao', 'tamitar_pedido');
                    formData.append('id_pedido', $("#id_pedido").val());
                    formData.append('id_usuario', $("#id_usuario").val());
                    formData.append('status', $("#status").val());
                    formData.append('tramit', $("#tramit").val());

                    $.ajax({
                        url: '/mod_ajuda/backEnd/View/ajuda_h/h_pedido_pedid/ajax.php',
                        type: 'POST',
                        data: formData,
                        processData: false, // tell jQuery not to process the data
                        contentType: false, // tell jQuery not to set contentType
                        success: function (response) {
                            if (response.trim() == 'sucesso') {
                                Swal.fire('Pedido Tramitado com sucesso !').then(function () {
                                    //$('#lista_despacho').load('/mod_ajuda/backEnd/View/ajuda_h/h_pedido_pedid/ajax_lista_despacho.php?id=' + id_pedido);
                                });
                            }
                        },
                        error: function (e) {
                            //console.log(JSON.stringify(e));
                        }
                    });
                    Swal.fire('Status do Processo Alterado !', '', 'success')
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                }
            })

        });


        /* controle de caracteres texto despacho*/
        $("#text_despacho").keyup(function () {
            var caracteres = $("#text_despacho").val().length;
            var restante = 255 - caracteres;
            $("#span_caracteres").text('Caracteres restantes : ' + restante);
        });

        /* SALVAR DESPACHO */
        $("#save_despacho").click(function () {

            var id_usuario = '<?= $id_usuario ?>';
            var id_pedido = '<?= $view[0]['id'] ?>';
            var text_despacho = $("#text_despacho").val();
            var parecer;

            if ($("#rb_favoravel").is(":checked")) {
                parecer = 1;
            } else if ($("#rb_desfavoravel").is(":checked")) {
                parecer = 0;
            } else if ($("#rb_analista").is(":checked")) {
                parecer = 2;
            }



            var formData = new FormData();
            formData.append('opcao', 'gravar_despacho');
            formData.append('id_pedido', id_pedido);
            formData.append('parecer', text_despacho);
            formData.append('id_usuario', id_usuario);
            formData.append('parecer_sit', parecer);

            $.ajax({
                url: '/mod_ajuda/backEnd/View/ajuda_h/h_pedido_pedid/ajax.php',
                type: 'POST',
                data: formData,
                processData: false, // tell jQuery not to process the data
                contentType: false, // tell jQuery not to set contentType
                success: function (response) {
                    if (response.trim() == 'sucesso') {
                        Swal.fire('Despacho gravado com sucesso !').then(function () {
                            $('#lista_despacho').load('/mod_ajuda/backEnd/View/ajuda_h/h_pedido_pedid/ajax_lista_despacho.php?id=' + id_pedido);
                        });
                    }
                },
                error: function (e) {
                    //console.log(JSON.stringify(e));
                }
            });
        });

        $('#novoDespacho').hide();
        $('img[name=salvar]').hide();

        $('#add_despacho').click(function () {
            $('#novoDespacho').show();
            $("#text_despacho").focus();
        });

        /* editar form material */
        $('img[name=edit]').click(function () {

            var qtd = $(this).data('qtd');
            /* quantidade itens */
            $("#tbl_material_liberado").parent().find('td')[2].innerHTML = '<input class=\'form form-control col-md-6\' type=\'text\' name=\'qtd\' value=\'' + qtd + '\'>';

            var familias_at = $(this).data('familias_at');
            /* Familias atendidas */
            $("#tbl_material_liberado").parent().find('td')[3].innerHTML = '<input class=\'form form-control col-md-6\' type=\'text\' name=\'familias\' value=\'' + familias_at + '\'>';

            $("img[name=edit]").hide();
            $("img[name=salvar]").show();
        });

        /* salvar edição material */
        $('img[name=salvar]').click(function () {

            var id_material = $(this).data('id');
            var codigo = $(this).data('codigo');
            var descricao_item = $(this).data('descricao_item');

            var formData = new FormData();
            formData.append('opcao', 'alterar_material');
            formData.append('id', id_material);
            formData.append('codigo', codigo);
            formData.append('qtd', $('input[name=qtd]').val());
            formData.append('qtd_familia_atendida', $('input[name=familias]').val());
            formData.append('descricao_item', descricao_item);

            $.ajax({
                url: '/mod_ajuda/backEnd/View/ajuda_h/h_pedido_pedid/ajax.php',
                type: 'POST',
                data: formData,
                processData: false, // tell jQuery not to process the data
                contentType: false, // tell jQuery not to set contentType
                success: function (response) {
                    Swal.fire('Registro Editado com Sucesso !')
                },
                error: function (e) {
                    //console.log(JSON.stringify(e));
                }
            });
        });

        /* adicionar material form  */
        $('img[name=add_material]').click(function () {

            var linha = "<tr>" +
                    "<td>-</td>" +
                    "<td><select class='form form-control col-md-6 descricao_item_novo' name='descricao_item_novo'>" +
                    "<?= $option ?>" +
                    "</select>" +
                    "</td>" +
                    "<input type='hidden' name='id_material_novo'></td>" +
                    "<td><input class='form form-control col-md-6' type='text' name='qtd_novo' required></td>" +
                    "<td><input class='form form-control col-md-6' type='text' name='familias_at_novo' required></td>" +
                    "<td><img src='/core/imagem/save.png' class='salvar_novo_mat'></td>";

            $("#tbl_material_liberado").append(linha);

        });

        /* setar id do material campo hidden */
        $('#tbl_material_liberado').on('chance', '.descricao_item_novo', function () {
            $("select[name=descricao_item_novo] option:selected").text()
        });


        /* salvar novo material */
        $('#tbl_material_liberado').on('click', '.salvar_novo_mat', function () {


            var id_material = $("select[name=descricao_item_novo]").val();
            var descricao = $("select[name=descricao_item_novo] option:selected").text();
            var qtd = $("input[name=qtd_novo]").val();
            var familias_at = $("input[name=familias_at_novo]").val();
            var id_pedido = $('#id').val();

            //alert(id_material + "-" + descricao + "-" + qtd + "-" + familias_at + "-" + id_pedido);

            var formData = new FormData();
            formData.append('opcao', 'salvar_novo_mat');
            formData.append('codigo', id_material);
            formData.append('qtd', qtd);
            formData.append('qtd_familia_atendida', familias_at);
            formData.append('id_pedido', id_pedido);
            formData.append('descricao_item', '' + descricao + '');
            formData.append('tipo', 'L');

            $.ajax({
                url: '/mod_ajuda/backEnd/View/ajuda_h/h_pedido_pedid/ajax.php',
                type: 'POST',
                data: formData,
                processData: false, // tell jQuery not to process the data
                contentType: false, // tell jQuery not to set contentType
                success: function (response) {
                    console.log(response);
                    Swal.fire('Registro Salvo com Sucesso !').then(function () {
                        $('#html1').jstree("select_node", show_material_pedido, true);
                    });
                },
                error: function (e) {
                    //console.log(JSON.stringify(e));
                }
            });
        });




        $('#html1').jstree();
        $("#dados_gerais").hide();
        $("#material_pedido").hide();
        $("#anexos").hide();
        $("#tramitar").hide();


        $('#html1').on("select_node.jstree", function (e, data) {
            if (data.node.id == 'show_dados_gerais') {
                $("#dados_gerais").fadeToggle();
                $("#material_pedido").hide();
                $("#anexos").hide();
                $("#tramitar").hide();
            }
            if (data.node.id == 'show_material_pedido') {
                $("#material_pedido").fadeToggle();
                $("#dados_gerais").hide();
                $("#anexos").hide();
                $("#tramitar").hide();
            }
            if (data.node.id == 'show_anexos') {
                $("#anexos").fadeToggle();
                $("#dados_gerais").hide();
                $("#material_pedido").hide();
                $("#tramitar").hide();
            }
            if (data.node.id == 'show_tramitar') {
                $("#tramitar").fadeToggle();
                $("#dados_gerais").hide();
                $("#material_pedido").hide();
                $("#anexos").hide();
            }
        });

        $("#add_material").click(function () {
            window.location.href =
                    '<?= FuncaoBase::geraLink("ajuda", "h_pedido_pedid", "add_itens", array('id' => $view[0]['id'])) ?>';
        });

        $("#upload_arquivos").hover(function () {
            setInterval(
                    [].forEach.bind($("#btnGravar"),
                    function (a) {
                        a.style.outline = "5px solid #" + (~~(Math.random() * (1 << 24))).toString(
                                16)
                    },
                    5),
                    1000);
        });

        $("#upload_arquivos").click(function () {
            //$("#btnGravar").addClass("animacao");

            var result = confirm(
                    'Atenção \n Antes de Fazer o upload de arquivos salve as alterações nos dados do pedido\n deseja continuar mesmo assim ?'
                    )


            if (result) {
                window.location.href =
                        '<?= FuncaoBase::geraLink("ajuda", "h_pedido_anexo", "cadastro", array('id' => $view[0]['id'], 'voltar' => $_GET['voltar'])) ?>';
            }
        });

        /* conta os caracteres */
        $("#caracteres").text($("#esforcos_realizados").val().length + " / 65534 ( Caracteres restantes )");
        $("#esforcos_realizados").keyup(function () {
            $("#caracteres").text($("#esforcos_realizados").val().length +
                    " / 65534 ( Caracteres restantes )");
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
                $("#data_vigencia").datepicker();

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
            $("#modal_id_regiao").modal({
                backdrop: 'static',
                keyboard: false
            });
        });
        /* focus no campo pesquisa fornecedor */
        $('#modal_id_regiao').on('shown.bs.modal', function (e) {
            $("#searcid_regiao").focus();
        });
        /* clic form campo FK  */
        $("#nomeCobrade").click(function () {
            $("#modal_id_cobrade").modal({
                backdrop: 'static',
                keyboard: false
            });
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
            data: <?php print json_encode($dadosMunicipio); ?>, // array com os dados
            getValue: "nome",
            /* alterar com nome do item BD */
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
            data: <?php print json_encode($dadosRegiao); ?>, // array com os dados
            getValue: "nome",
            /* alterar com nome do item BD */
            list: {
                match: {
                    enabled: true
                },

                onSelectItemEvent: function () {
                    var id = $("#searcid_regiao").getSelectedItemData().id_regiao;
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
            data: <?php print json_encode($dadosCobrade); ?>, // array com os dados
            getValue: "descricao",
            /* alterar com nome do item BD */
            list: {
                match: {
                    enabled: true
                },

                onSelectItemEvent: function () {
                    var id = $("#searcid_cobrade").getSelectedItemData().id_cobrade;
                    var nome = $("#searcid_cobrade").getSelectedItemData().descricao;

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


    });


</script>