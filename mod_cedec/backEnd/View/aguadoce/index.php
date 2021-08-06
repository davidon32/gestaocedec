<?php include_once PATH.'/core/include.php';?>
<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_index/Model/indexModel.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php";?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php";?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";?>

<h3><p style="text-align:center; color:blue;">Agua Doce Agora</p></h3>
<hr>
<a href="?modulo=cedec&controller=aguadoce&action=cadadm" class="btn btn-primary" title="Lançamento de novo Registro">Lançamento</a>
<br>
<br>
<a href="?modulo=cedec&controller=aguadoce&action=busca" class="btn btn-primary">Buscar / Alterar</a>
<br>
<br>
<a href="?modulo=cedec&controller=aguadoce&action=lista" class="btn btn-primary" title="Lista">Visualizar Lista</a>
<br><br>
<a href="?modulo=cedec&controller=aguadoce&action=listasite" class="btn btn-primary" title="Lista Site ">Visualizar Lista Site</a>
<br><br>
<table class="table table-bordered">
    <th>#</th>
    <th>Autor/Data</th>
    <th>Texto</th>
    <th>Status</th>

    <?php
        $lista = AguaDoce::listaAdm();
        foreach ($lista as $key => $value) {
            print "<tr>";
            print "<td>".$key."</td>";
            print "<td>".$value['autor']."</td>";
            print "<td>".$value['texto']."</td>";
            print "<td>".(($value['status1'] == 0) ? "Pendente" : "Ativo")."</td>" ;
        }
    ?>

</table>


<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>