<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_index/Model/indexModel.php"; ?>  
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>

<div class="col-md-12">

    <p class='text-center'><button class='btn btn-primary' onclick="javascript:history.back();">Voltar</button></p>
    <div class="col-md-12">
      
        <table class="table table-bordered">
            <tr>
                <td>Agente :</td><td><?=isset($_GET['nome']) ? $_GET['nome'] :"";?></td>
            </tr>
            <tr>
                <td>Região :</td><td><?=$_GET['id_rpm']?> RDC - Regiões de Defesa Civil</td>
            </tr>
            <tr>
                <td>Total de Municípios :</td><td><?=isset($dados) ? (count($dados)) :0; ?> </td>
            </tr>
        </table>
        
        <table class="table table-bordered table-condensed">
            <tr>
                <th class="col-md-1">#</th>
                <th class="text-center col-md-1">Cód.</th>
                <th class="text-center">Municipio</th>
                <th class="text-center">Situação Usuário</th>
                <th class="text-center">Situação Compdec</th>
                <th class="text-center col-md-2">Dados Cadastrais</th>
            </tr>
            <?php
                if(count($dados) >0) {
                foreach ($dados as $key => $value) {
                    $situacao = "";
                    if( ($value['com_const'] == 0) || ($value['situacao'] == 'DESATIVADO') ){
                        $situacao = "style='background:#FF0000;color:#FFFFFF' title='Municipio sem COMPDEC !'";
                    }
                    print "<tr>";
                    print "<td ".$situacao.">".($key+1)."</td>";
                    print "<td ".$situacao.">".$value['id_municipio']."</td>";
                    print "<td ".$situacao.">".$value['nome']."</td>";
                    print "<td ".$situacao.">".$value['situacao']."</td>";
                    print "<td ".$situacao.">".(($value['com_const'] == 1) ? "ATIVO": "INATIVO")."</td>";
                    print "<td ".$situacao."><a href='".FuncaoBase::geraLink('compdec', 'compdec', 'visualizar', array('mun'=>$value['id_municipio']))."'>Visualizar</a></td>";
                    print "</tr>";
                }
                }
            
            ?>
        </table>
        
    </div>
    


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

    });

</script>