

<?php include_once PATH . '/core/include.php'; ?>
<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_ajuda/Model/indexModel.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php include_once "template/page/menu.php"; ?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>

<?php


    $secao = isset($_GET['an']) ? $_GET['an'] :"";
   
    $id_pedido = isset($_GET['id']) ? $_GET['id'] :"";
    
    
    if($secao == 'analise_drd'){
        $label_secao = 'DRD - Diretoria de Redução de Desastre';
    }else if($secao == 'analise_dlog'){
        $label_secao = 'Diretoria de Logistica';
    }else if($secao == 'analise_cood') {
        $label_secao = 'Coordenadoria Adjunda';
        
    }

?>


<legend>Analise Técnica Parecer : <span style='color:red'><?=$label_secao?></span></legend>

<form action="<?=FuncaoBase::geraLink("ajuda", "h_pedido_an_tec", "gravar");?>" method="post" accept-charset="utf-8" name="frmH_pedido_an_tec" id="frmH_pedido_an_tec">
    

<div class='row'>
<div class='col-md-2'>
<label>Data envio</label>
<input type="text" class='form form-control' name='data_parecer' id='data_parecer' maxlength='' required >
</div>
</div>
<div class='row'>
<div class='col-md-12'>
<label>Parecer Técnico</label> <span style="color: silver" id='caracteres'></span>
<textarea class='form form-control' name='parecer' id='parecer' maxlength='65534' required rows="8"></textarea>
</div>
</div>

<!-- seção -->
<input type="hidden" class='form form-control' name='tramit_parecer' id='tramit_parecer' maxlength='14' required value='<?=$secao?>' >

<!-- id_pedido -->
<input type="hidden" class='form form-control' name='id_pedido' id='id_pedido' maxlength='14' required value='<?=$id_pedido?>' >


 <div class="col-md-6 text-left">
        <br>
        <input type="submit" class="btn btn-info" name="btnGravar" id="btnGravar" value="Gravar"><br><br>
        <button type="button" class="btn btn-warning" name="despachar_dlog" id="despachar_dlog" title="Enviar para o Responsavel pela Dlog">Despachar DLOG</button>
</div>
<div class="col-md-6 text-right">
        <br>
        <a class="btn btn-success" href="<?=FuncaoBase::geraLink("ajuda", "h_pedido_index", "index")?>">Voltar</a>
</div>   
    
</form>
    
<br>
<br>
<div class="row">
<div class="col-md-12">
  
    <?php
    
    $analises_tecnica = H_pedido_an_tecajuda_hModel::listAnalise($id_pedido);
    
    print "<br><legend> Parecer técnico DRD</legend>";
        foreach ($analises_tecnica as $key => $an_drd) {
 
            print "<div class='row'>";
                print "<div class='col-md-1'>";
                    print "Data :<p>". DataMysql::dataVisual($an_drd['data_parecer'])."</p>";
                print "</div>";

                print "<div class='col-md-11'>";
                    print "Parecer : <p style='text-align: justify'>".$an_drd['parecer']."</p>";
                print "</div>";
            print "</div>";
            print "<hr>";
        }
    
    
    ?>
    
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
        
        $("#frmH_pedido_an_tec").trigger("reset");
        
        
        /* conta os caracteres */
        $("#caracteres").text($("#parecer").val().length+" / 65534 ( Caracteres restantes )");
        $("#parecer").keyup(function(){
            $("#caracteres").text($("#parecer").val().length+" / 65534 ( Caracteres restantes )");
        });
    
    
        /* despachar dlog*/
        $("#despachar_dlog").click(function(){
            
           var result = confirm('Deseja enviar para o despachante da DLOg ? ') ;
           
           if(result) {
           
                var formData = new FormData();
                formData.append('analise_dlog', 'analise_dlog'); 
                $.ajax({
                        url : '<?= FuncaoBase::geralink("ajuda", "h_pedido_pedid", "action"); ?>',
                        type : 'POST',
                        data : formData,
                        processData: false,  // tell jQuery not to process the data
                        contentType: false,  // tell jQuery not to set contentType
                        success : function(response) {
                            Swal.fire('Importação realizada com Sucesso !').then(function(){
                                window.location.reload();
                            );
                        },
                        error : function(e) {
                        //console.log(JSON.stringify(e));
                        }
                    });

            }
            
            });

   
        

    });
</script>
        