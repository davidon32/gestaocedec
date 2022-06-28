<?php include_once PATH.'/core/include.php';?>
<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_ajuda/Model/indexModel.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php";?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php";?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";?>
<?php

    $id_pmda = isset($_GET['id_pmda']) ? $_GET['id_pmda'] : "";
    
    if(!is_numeric($id_pmda)){
        die();
    }
    
          
    $pmda = new Pmda();
    
    $comunidades = $pmda->buscaComunidades($id_pmda);
    
    $comunidadesAlteracao = $pmda->buscaComunidadesAltera($id_pmda);
    
    
?>

<div class="col-md-12 text-center"><a class='btn btn-success' href='<?= FuncaoBase::geraLink("pipa", "pipa", "pesquisaPmda", array('id_pmda'=>$_GET['id_pmda'], 'idmun'=>$_GET['id_mun'])) ?>'>Voltar</a></div><br><br>
<div class="col-md-6">
    <span>Comunidades Enviadas no PMDA</span>
<table class="table table-condensed">
    <tr>
        <th>Cod. Comun</th>
        <th>Cod.Ponto Cap</th>
        <th>Latitude</th>
        <th>Longitude</th>
        <th>Trecho Pav</th>
        <th>Trecho n Pav</th>
        <th>Pop. Antend</th>
    </tr>
    <?php
    foreach ($comunidades as $key => $value) {
        $linha ="";
        
        if($pmda->buscaComunidadeAlteracao($value['id_comunidade'])){
            $linha = 'text-decoration: line-through';
        }
        
        print "<tr>";
        print "<td ".$linha.">".$value['id_comunidade']."</td>";
        print "<td>".$value['id_ponto']."</td>";
        print "<td>".$value['latitude']."</td>";
        print "<td>".$value['longitude']."</td>";
        print "<td>".$value['trecho_pav']."</td>";
        print "<td>".$value['trecho_n_pav']."</td>";
        print "<td>".$value['pop_atendida']."</td>";
        
        print "</tr>";
        
    }
    ?>
</table>
</div>

<div class="col-md-6">
     <span>Novas Comunidades / Alterações</span>
<table class="table table-condensed">
    <tr>
        <th>Cod. Comun</th>
        <th>Cod.Ponto Cap</th>
        <th>Latitude</th>
        <th>Longitude</th>
        <th>Trecho Pav</th>
        <th>Trecho n Pav</th>
        <th>Pop. Antend</th>
    </tr>
    <?php
    foreach ($comunidadesAlteracao as $key => $value) {
        
        print "<tr>";
        print "<td>".$value['id_comunidade']."</td>";
        print "<td>".$value['id_ponto']."</td>";
        print "<td>".$value['latitude']."</td>";
        print "<td>".$value['longitude']."</td>";
        print "<td>".$value['trecho_pav']."</td>";
        print "<td>".$value['trecho_n_pav']."</td>";
        print "<td>".$value['pop_atendida']."</td>";
        
        print "</tr>";
        
    }
    ?>
</table>
</div>

<!-- 

CONTEUDO FORM 


 -->



<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>
