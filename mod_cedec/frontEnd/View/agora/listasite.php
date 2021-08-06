<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_cedec/Model/indexModel.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPageSimplesFull.php";?>

<div class="container">
<div class="col-lg10 col-xs-12 text-center" style="height:100px;">
    <h4>Defesa Civil Agora</h4>
    <img src="/core/imagem/cedec.png" width="50px;" >
</div>
<div class="col-lg10 col-xs-10"><br>
    <h4>Envie para a CEDEC uma informação ou atividade de Defesa Civil realizada em sua região.</h4>
</div>
<div class="col-lg10 col-xs-2" style="line-height:100px;">
     <a class="btn btn-primary" href="?modulo=cedec&controller=agora&action=cadastro" title="Lançar uma Informação / Atividade de Defesa Civil.">
        <img width="100" src="core/imagem/botao.gif">    
    </a><br>
</div>

<div class="col-lg10 col-xs-12">

    <!--<a href="?modulo=cedec&controller=agora&action=cadadm" class="btn btn-primary">Voltar</a>-->

    <?php

        $defesaAgora = new DefesaAgora();

        $id = isset($_GET['id']) ? $_GET['id'] : "";

        $lista = $defesaAgora->listaSite();
        
?>
<br>
<div class="table-responsive">
    <table class="table">
        <!--<th>-</th>-->
        <th>Data/Hora</th>
        <th>Autor/Nome</th>
        <th>Órgão</th>
        <th>Categoria</th>
        <th>Texto</th>
        <th>Imagem</th>

        <?php
            foreach ($lista as $key => $value) {
                $icone = ($value['categoria'] == 'CEDEC-MG') ? "<img src='/core/imagem/yellow.png' width='20px' height='20px'>" : "<img src='/core/imagem/blue.png' width='20px' height='20px'>";
                
                if(Anexo::getExtensao($value['imagem1']) != "docx"){
                    $iconePostagem = "<img src='/anexo/def_civil_agora/".$value['imagem1']."' width='50px' height='50px'>";
                }else {
                    $iconePostagem = "<img src='/core/imagem/impressao.png' width='50px' height='50px'>";
                }
                print "<tr>";
                print "<!--<td onclick='view(\"".$value['id']."\")' style=\"vertical-align:middle;\">".$icone."</td>-->";
                print "<td style='vertical-align:middle;background-image: url(\"/core/imagem/fdo_lista.png\");background-repeat: repeat-x;background-position:bottom'><a class='btn' onclick='view(\"".$value['id']."\")'>".DataMysql::dataCompletaVisual($value['data_hora'])."</a></td>";
                print "<td style='vertical-align:middle;white-space: initial;width:5%;background-image: url(\"/core/imagem/fdo_lista.png\");background-repeat: repeat-x;background-position:bottom''><a onclick='view(\"".$value['id']."\")'>".$value['autor']."</a></td>";
                print "<td style='vertical-align:middle;background-image: url(\"/core/imagem/fdo_lista.png\");background-repeat: repeat-x;background-position:bottom''><a onclick='view(\"".$value['id']."\")'>".$value['orgao']."</a></td>";
                print "<td style='vertical-align:middle;background-image: url(\"/core/imagem/fdo_lista.png\");background-repeat: repeat-x;background-position:bottom''>".$value['categoria']."</td>";
                print "<td style='text-align:justify;background-image: url(\"/core/imagem/fdo_lista.png\");background-repeat: repeat-x;background-position:bottom'' onclick='view(\"".$value['id']."\")'>".$value['texto']."</td>";
                print "<td style='vertical-align:middle;background-image: url(\"/core/imagem/fdo_lista.png\");background-repeat: repeat-x;background-position:bottom'><a class='btn' onclick='view(\"".$value['id']."\")'>".$iconePostagem."</a></td><tr>";
                print "<tr><td style=\"padding:0; margin:0\" colspan='5'><hr></td></tr>";
            }

        ?>

    </table>
    </div>
</div>

<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePageSimplesFull.php";?>
<script>
    function view(id) {
        window.location = 'index.php?modulo=cedec&controller=agora&action=view&id='+id;
    }
</script>