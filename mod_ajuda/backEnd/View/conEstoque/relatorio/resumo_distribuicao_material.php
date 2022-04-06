<?php include_once PATH.'/core/include.php';?>
<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_ajuda/Model/indexModel.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPageSimples.php";?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php";?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";?>
<style>
    
    @media print {
        #cabecalho {
            display: none;
        }
        .imprimir {
            display: none;
        }
        .main-footer{
        display: none;
        }
        .box-header {
            display: none;
        }

        body {
            width: 700px;
            margin: 0 auto;
        }
        th, td {
            padding: 0px !important;
            margin: 0px;
        }

        body {
            font-family: helvetica;
            color: rgba(94,93,82,1);
        }

    } 

    .break { page-break-before: always; }


    .rodape {
        background-color: #C0C0C0;
    }

    hr.linha {
        border: 1px solid blue;
    }

    #div-icon {
        display:none;
    }
    
</style>

<?php
    $_relatorioAjuda = new RelatorioAju();
    
    $id_deposito = isset($_POST['id_deposito'])  ? $_POST['id_deposito']  : NULL;
    $txtDtInicial= isset($_POST['txtDtInicial']) ? $_POST['txtDtInicial'] : NULL;
    $txtDtFinal  = isset($_POST['txtDtFinal'])   ? $_POST['txtDtFinal']   : NULL;
    $id_municipio= isset($_POST['id_municipio']) ? $_POST['id_municipio'] : NULL;
    $pesquisar   = isset($_POST['pesquisar'])    ? $_POST['pesquisar']    : NULL;
    $ck_diario   = isset($_POST['ck_diario'])    ? $_POST['ck_diario']    : NULL;
?>
<div class="row">
    <div class="col-md-12 text-center">
        <img src="core/imagem/topo1.png">
        <br><a class='btn btn-info imprimir' href='index.php?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=ajuda&controller=relatorio&action=busca_resumog'>Voltar</a>
    </div><!--
</div>

   <div class="col-md-12 text-center">
        <p style="text-align:text-center"><h4> Período : <?=$txtDtInicial;?> a <?=$txtDtFinal;?></h4></p>
    </div>
-->
<legend>Em construção</legend>
 

<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>

<script type="text/javascript">

$(document).ready(function(){

});


</script>