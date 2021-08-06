<?php include_once PATH.'/core/include.php';?>
<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_cedec/Model/Model.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php";?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php";?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";?>

<div class="col-md-12">    
    <p class="text-right"><a class="btn btn-success" href="?token=<?=hash('sha256', md5(VERSAO).time());?>&ac=itn&modulo=cedec&controller=municipio&action=rel">Voltar</a></p>
<?php

print "<p>Total emails: ".$total."</p><br>";
print "<h3>Lista de email das Prefeituras de Minas Gerais</h3>";
print "<legend>Obs: O limite máximo de email enviados pelo Outlook na Cidade Administrativa é de 50 email por vez, os emails abaixo já estão divididos para envio   :)</legend>";
print "<table class='table table-bordered'>";
    print "<tr><td>";
$num_bloco = 0;
foreach ($dados as $key=>$value) {
    
    if(strlen($value['email']) >0){
    print strtolower($value['email'])."; ";
    }
    if((($key+1) % 50) == 0){
        $num_bloco++;
        print "<br><br><b>Parte ".$num_bloco."</b><hr><br>";
    }
    

}
$num_bloco++;
        print "<br><br><b>Parte ".$num_bloco."</b>";
print "</td></tr></table>";
?>
</div>