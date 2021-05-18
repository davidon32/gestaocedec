<?php include_once PATH.'/core/include.php';?>
<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_cedec/Model/Model.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php";?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php";?>
<!-- =================== MENU  ============================ -->
<?php include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";?>


<div class="col-md-12 text-right">
    <a class="btn btn-success" href="?token=<?=hash('sha256', md5(VERSAO).time());?>&ac=itn&modulo=cedec&controller=municipio&action=rel">Voltar</a>
</div>
<?php
print "<table class='table'><tr>";
    print "<td>#</td><td>Código</td>"
            . "<td>Nome</td>"
            . "<td>Email</td>"
            . "<td></td>";
    print "</tr>";

foreach ($dados as $key=>$value) {
    print "<tr>";
    print "<td>".($key+1)."</td><td>".$value['id_municipio']."</td>"
            . "<td>".$value['nome']."</td>"
            . "<td>".$value['email']."</td>"
            . "<td></td>";
    print "</tr>";
}

print "</table>";