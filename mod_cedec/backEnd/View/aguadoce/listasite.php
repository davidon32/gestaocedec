<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_cedec/Model/indexModel.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPageSimplesFull.php";?>

<div class="container">
<div class="col-lg10 col-xs-12 text-center" style="height:100px;">
    <h4>Agua Doce Agora</h4>
    <img src="/core/imagem/logo-agua-doce.png" width="100px;" >
</div>
<div class="col-lg10 col-xs-10"><br>
    <h4>Envie para a o Água Doce Agora, uma informação ou atividade relacionada com o Projeto Água Doce em sua região.</h4>
</div>
<div class="col-lg10 col-xs-2" style="line-height:100px;">
     <a class="btn btn-primary" href="?modulo=cedec&controller=aguadoce&action=cadastro" title="Lançar uma Informação / Atividade sobre o Água Doce Agora.">
        <img width="100" src="core/imagem/botao.gif">    
    </a><br>
</div>

<div class="col-lg10 col-xs-12">

    <!--<a href="?modulo=cedec&controller=agora&action=cadadm" class="btn btn-primary">Voltar</a>-->

    <?php

        $aguaDoce = new AguaDoce();

        $id = isset($_GET['id']) ? $_GET['id'] : "";

        $lista = $aguaDoce->listaSite();        

?>
<br>
<div class="table-responsive">
    <table class="table">
        <th>-</th>
        <th>Autor/Nome</th>
        <th>Data/Hora</th>
        <th>Texto</th>
        <th>Imagem</th>

        <?php
            foreach ($lista as $key => $value) {
                $icone = ($value['categoria'] == 'CEDEC-MG') ? "<img src='/core/imagem/yellow.png' width='20px' height='20px'>" : "<img src='/core/imagem/blue.png' width='20px' height='20px'>";
                $autor = ($value['categoria'] == 'CEDEC-MG') ? "CEDEC-MG": $value['autor'];
                print "<tr>";
                print "<td onclick='view(\"".$value['id']."\")' style=\"vertical-align:middle;\">".$icone."</td>";
                print "<td style='vertical-align:middle;'><a class='btn' onclick='view(\"".$value['id']."\")'>".$autor."</a></td>";
                print "<td style='vertical-align:middle;'><a class='btn' onclick='view(\"".$value['id']."\")'>".DataMysql::dataCompletaVisual($value['data_hora'])."</a></td>";
                print "<td style='text-align:justify;' onclick='view(\"".$value['id']."\")'>".$value['texto']."</td>";
                print "<td style='vertical-align:middle;'><a class='btn' onclick='view(\"".$value['id']."\")'><img src='/anexo/aguadoce/".$value['imagem1']."' width='50px' height='50px'></a></td><tr>";
                print "<tr><td style=\"padding:0; margin:0\" colspan='5'><hr></td></tr>";
            }

        ?>

    </table>
    </div>
</div>

<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePageSimplesFullAguaDoce.php";?>
<script>
    function view(id) {
        window.location = 'index.php?modulo=cedec&controller=aguadoce&action=view&id='+id;
    }
</script>