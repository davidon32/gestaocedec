<?php include_once PATH . '/core/include.php'; ?>
<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_ajuda/Model/indexModel.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->

<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>


<div class="content">

<a class="btn btn-success" href="<?= FuncaoBase::geraLink("ajuda", "pedido", "separacao") ?>">Voltar</a>
<br>
<br>



<form method="POST" action="" name="frmSepara" id="frmSepara">
    <div class="col-md-4">
        <label>Separação Nº: </label>
        <span class="form-control"><?=$_GET['id'];?></span>
        <input type="hidden" name="id_pedido" id="id_pedido" value="<?=$_GET['id'];?>">
    </div>
        
    <div class="col-md-4">
        <label>Destinatário :</label>
        <span class="form-control"><?=$_GET['dest'];?>/ <?=$_GET['dest_final'];?></span>
    </div>
<div class="col-md-4">
        <label>Emissão :</label>
        <span class="form-control"><?=DataMysql::dataVisual($_GET['dt_emissao']);?></span>
    </div>
    
    <div class="col-md-6">
        <label>Data Entrega </label>
        <input type="text" class="form-control" name="data_entrega" id="data_entrega" required="required" value="<?=date('d/m/Y');?>">
    </div>
        
    <div class="col-md-6">
        <label>Volume</label>
        <input type="number" class="form-control" name="volume" id="volume" required="required">
    </div>
    
    <div class="col-md-6">
        <br>
        <input type="submit" class="btn btn-info" name="brnGrava" id="brnGrava" value="Gravar">
    </div>
</form>

</div>

<br>
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>
<script>

    $(document).ready(function () {
        
        $("#frmSepara").submit(function(e) {
		e.preventDefault();
	}).validate({
		rules: {
                    
                    data_entrega:{ required: true},
                    volume:{ required: true},
                    
			},
			messages: {
                            
                            data_entrega: { required: 'O campo Quantidade não pode ficar em Branco !'},
                            volume: { required: 'O campo Quantidade não pode ficar em Branco !'},
    
			},
			
		submitHandler: function(form) { 

			var form_data = new FormData();

                         /* upload de arquivos */
			//var file_data = $("#fl_nota").prop("files")[0];

                            form_data.append("id_pedido", $("#id_pedido").val());
                            form_data.append("data_entrega", $("#data_entrega").val());
                            form_data.append("volume",       $("#volume").val());
                            form_data.append("situacao", 1); /*situacao separado*/

                            $.ajax({
				type: 'POST',
				url: '<?=FuncaoBase::geraLink('ajuda', 'pedido', 'gravseparar')?>',
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,
				success: function(response) {
                                    console.log(response);
                                        var resposta = response;
					if(resposta.trim() === 'sucesso'){
					alert("Cadastro realizado com Sucesso !");
					//location.reload();
					}
				},
				error: function(e){
					console.log(JSON.stringify(form_data));
					console.log(JSON.stringify(response));
					alert("Ocorreu um Erro !");
				}
				
			});

		}
	});
        
    });
</script>
        