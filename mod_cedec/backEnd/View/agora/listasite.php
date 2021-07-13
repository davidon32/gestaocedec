<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_cedec/Model/Model.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPageSimplesFull.php";?>

<style>
    img {
        border-radius: 8px;
    }
    
</style>

<div class="container-fluid">
<div class="col-lg-3 col-xs-3 text-center" style="height:100px;">
    <h4>Defesa Civil Agora</h4>
    <img src="/core/imagem/DEFESACIVILMG_400.png" width="50px;" >
</div>
<div class="col-lg4 col-xs-6"><br>
    <h4>Envie para a CEDEC uma informação ou atividade de Defesa Civil realizada em sua região.</h4>
</div>
<div class="col-lg3 col-xs-3" style="line-height:100px;">
     <a class="btn btn-primary" href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'))?>&ac=itn&modulo=cedec&controller=agora&action=cadastro" title="Lançar uma Informação / Atividade de Defesa Civil.">
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
    <table class="table table-bordered table-condensed">
        <tr>
            <td class="col-md-3"><?= DefesaAgora::selCategoria(null, "Filtro");?></td>
            <td class="col-md-9" style="vertical-align: middle">Total Registros : <span id="total"><?=$defesaAgora::totLista()?></span></td>
        </tr>
    </table>
    
    <table class="table" id="sitelista">
        <tr>
            <th style="background-color: #b9bdb6" class="text-center">Data/Hora</th>
            <th style="background-color: #b9bdb6" class="text-center">Autor/Nome</th>
            <th style="background-color: #b9bdb6" class="text-center">Órgão</th>
            <th style="background-color: #b9bdb6" class="text-center">Categoria</th>
            <th style="background-color: #b9bdb6" class="text-center">Texto</th>
            <th style="background-color: #b9bdb6" class="text-center">Imagem</th>
        </tr>

        <?php
            foreach ($lista as $key => $value) {
                $icone = ($value['categoria'] == 'CEDEC-MG') ? "<img src='/core/imagem/yellow.png' width='20px' height='20px'>" : "<img src='/core/imagem/blue.png' width='20px' height='20px'>";
                
                if(Anexo::getExtensao($value['imagem1']) != "docx"){
                    $iconePostagem = "<img src='/anexo/def_civil_agora/".$value['imagem1']."' width='200px' height='150px'>";
                }else {
                    $iconePostagem = "<img src='/core/imagem/impressao.png' width='50px' height='50px'>";
                }
                print "<tr position=\"".str_replace(" ", "_", $value['categoria'])."\">";
                print "<!--<td onclick='view(\"".$value['id']."\")' style=\"vertical-align:middle;\">".$icone."</td>-->";
                print "<td style='vertical-align:middle;background-image: url(\"/core/imagem/fdo_lista.png\");background-repeat: repeat-x;background-position:bottom'><a class='btn' onclick='view(\"".$value['id']."\")'>".substr(DataMysql::dataCompletaVisual($value['data_hora']), 0, 10)."<br>".substr(DataMysql::dataCompletaVisual($value['data_hora']), 10, 6)."</a></td>";
                print "<td style='vertical-align:middle;white-space: initial;width:5%;background-image: url(\"/core/imagem/fdo_lista.png\");background-repeat: repeat-x;background-position:bottom'><a onclick='view(\"".$value['id']."\")'>".$value['autor']."</a></td>";
                print "<td style='vertical-align:middle;background-image: url(\"/core/imagem/fdo_lista.png\");background-repeat: repeat-x;background-position:bottom'><a onclick='view(\"".$value['id']."\")'>".$value['orgao']."</a></td>";
                print "<td style='vertical-align:middle;background-image: url(\"/core/imagem/fdo_lista.png\");background-repeat: repeat-x;background-position:bottom'>".$value['categoria']."</td>";
                print "<td style='vertical-align:middle;text-align:justify;background-image: url(\"/core/imagem/fdo_lista.png\");background-repeat: repeat-x;background-position:bottom'' onclick='view(\"".$value['id']."\")'>".$value['texto']."</td>";
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
    
    $(document).ready(function(){
        
       //var rowCount = $('#sitelista tr:visible').length -1;
       //$("#total").text(rowCount);
       

    var rows = $("table#sitelista tr:not(:first-child)");



    $("#selCategoria").on("change", function() {
        
        
        var selected = this.value.replace(/[\s\(\\)/]/g, "_");
        
        if (selected !== "Selecione_uma_Categoria") {

            rows.filter("[position=" + selected + "]").show();
            rows.not("[position=" + selected + "]").hide();
            var visibleRows = rows.filter("[position=" + selected + "]");
            
        } else {

            rows.show();

        }
        rowCount = $('#sitelista tr:visible').length -1;
            $("#total").text(rowCount);
        

    });
        
    });
    
    
    
    Redirect();
      function Redirect()
      {
              setTimeout("location.reload(true);",300000);  
      }
 
 
    function view(id) {
        window.location = 'index.php?token=<?=hash('sha256', md5(VERSAO).date('dmY'))?>&ac=itn&modulo=cedec&controller=agora&action=view&id='+id;
    }
    
    
</script>