
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

<legend><?=$view[1]['tabela']->TABLE_COMMENT?></legend>
<table class="table table-bordered table-striped">

    <tr>
                <td class="col-md-3">Identificador do Pedido :</td><td><?=$view[0]['id'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Número Pedido :</td><td><?=$view[0]['numero'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Data Entrada Sistema :</td><td><?=$view[0]['data_entrada_sistema'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Analista CEDEC :</td><td><?=$view[0]['despachante_analista'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Analista DLOG :</td><td><?=$view[0]['despachante_dlog'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Identificador Municipio :</td><td><?=$h_pedido_pedidModel->getNomeIdFk('cedec_municipio','id_municipio', $view[0]['id_municipio'])->nome;?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Identificador Mesorregião :</td><td><?=$h_pedido_pedidModel->getNomeIdFk('com_regiao','id_regiao', $view[0]['id_regiao'])->nome;?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Nome do Coordenador :</td><td><?=$view[0]['nome_coordenador'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Telefone do Coordenador :</td><td><?=$view[0]['tel_coordenador'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Celular do Coordenador :</td><td><?=$view[0]['cel_coordenador'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Email do Coordenador :</td><td><?=$view[0]['email_coordenador'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Nome do Prefeito :</td><td><?=$view[0]['nome_prefeito'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Telefone do Prefeito :</td><td><?=$view[0]['tel_prefeito'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Celular do Prefeito :</td><td><?=$view[0]['cel_prefeito'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Email do Prefeito :</td><td><?=$view[0]['email_prefeito'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Tipo do Desastre :</td><td><?=$h_pedido_pedidModel->getNomeIdFk('dec_cobrade','id_cobrade', $view[0]['id_cobrade'])->nome;?></td>
            </tr></div>

<tr>
                <td class="col-md-3">População Atendida :</td><td><?=$view[0]['pop_atendida'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Decreto SE ou ECP Vigente ? :</td><td><?=(($view[0]['decreto_se_ecp_vig'] == 0) ? "Não" : "Sim");?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Número do Decreto :</td><td><?=$view[0]['numero_decreto'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Data de Vigencia Decreto :</td><td><?=$view[0]['data_vigencia'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Tipo do Decreto :</td><td><?=$view[0]['tipo_decreto'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Esforços Realizados :</td><td><?=$view[0]['esforcos_realizados'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Data Hora Envio Homologação :</td><td><?=$view[0]['data_hora_envio'];?></td>
            </tr></div>



  </table>
<br>
<a class="btn btn-success" href="<?= FuncaoBase::geraLink("ajuda", "h_pedido_pedid", "index") ?>">Voltar</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("ajuda", "h_pedido_pedid", "edit", array('id'=>$view[0]['id'])) ?>">Editar</a>
<br>
<br>

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
