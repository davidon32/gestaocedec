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
            <td style="vertical-align: middle" class="col-md-10"><?= DefesaAgora::selCategoria(null, "");?></td>
            <td style="vertical-align: middle; text-align: center" class="col-md-2"><b>Total Registros : </b> <span id="total"><?=$defesaAgora::totLista()?></span></td>
        </tr>
    </table>
    
    <table class="table" id="sitelista">
        
        <?php
            foreach ($lista as $key => $value) {
                $icone = ($value['categoria'] == 'CEDEC-MG') ? "<img src='/core/imagem/yellow.png' width='20px' height='20px'>" : "<img src='/core/imagem/blue.png' width='20px' height='20px'>";
                
                if(Anexo::getExtensao($value['imagem1']) != "docx"){
                    $iconePostagem = "<img src='/anexo/def_civil_agora/".$value['imagem1']."' width='200px' height='150px'>";
                }else {
                    $iconePostagem = "<img src='/core/imagem/impressao.png' width='50px' height='50px'>";
                }
                print "<tr>
                            <th class='col-md-1'>Data/Hora</th>
                            <td>: <a onclick='view(\"".$value['id']."\")'>".substr(DataMysql::dataCompletaVisual($value['data_hora']), 0, 10)." - ".substr(DataMysql::dataCompletaVisual($value['data_hora']), 10, 6)."</a></td>
                        <td rowspan='4' onclick='view(\"".$value['id']."\")'>".$value['texto']."</td>
                        <td rowspan='4' style='vertical-align:middle'><a class='btn' onclick='view(\"".$value['id']."\")'>".$iconePostagem."</a></td>
                       </tr>";
                print "<tr>
                        <th>Autor/Nome</th>
                        <td>: <a onclick='view(\"".$value['id']."\")'>".$value['autor']."</a></td>
                       </tr>";
                print "<tr>
                        <th>Órgão</th>
                        <td>: <a onclick='view(\"".$value['id']."\")'>".$value['orgao']."</a></td>
                       </tr>";
                print "<tr>
                        <th>Categoria</th>
                        <td>: ".$value['categoria']."</td>
                       </tr>";
               
                print "<tr><td colspan='4' style='vertical-align:middle;background-image: url(\"/core/imagem/fdo_lista.png\");background-repeat: repeat-x;background-position:bottom'></td><tr>";
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