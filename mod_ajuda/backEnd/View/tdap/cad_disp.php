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
<?php include_once "template/page/corpoHeader.php";

$id = isset($_GET['id']) ? $_GET['id'] : "";
$nome = (!empty($id)) ? Fornecedor::getNome($id) : "";


?>
<br>

<div class="col-md-12 text-center">
    <h2>Cadastro de Dispositivos</h2>
</div>
<div class="col-md-12">
    <form action="" method="POST" name="frm_cad_fornecedor" id="frm_cad_fornecedor">
    <div class="col-md-6">
        
        <label>Nome do Fornecedor</label>
        <input type="text" class="form form-control" name="txtNome" id="txtNome" readonly value="<?=$nome?>">
        <input type="hidden" name="txt_idForn" id="txt_idForn" value="<?=$id?>">
        <label>Telefone Autorizado</label>
        <input type="text" class="form form-control" name="txtCel" id="txtCel" required maxlength="20" data-mask="(00)90000-0000">
        
        
    </div>
    
    <div class="col-md-12">
        <br>
        <button class="btn btn-info" type="submit" name="btnGravar" value="btnSalvar" id="send">Salvar</button>
    </div>

</form>
</div>
    <br>
    <div class="col-md-12 text-center">
        <br>
        <a class="btn btn-success" href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&&modulo=ajuda&controller=tdap&action=index"" title="Relatorios">
            Voltar
            </a>
    </div>
    <br>
    <!-- lista de dispositivos -->
    <div class="col-md-12"><br>
        <table class="table table-bordered table-condensed table-striped">
            <thead>
                <tr>
                    <th colspan="3" class="text-center"><?=Fornecedor::getNome($id);?></th>
                </tr>
                <tr>
                    <th>#</th>
                    <th>Codigo</th>
                    <th>Número</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                    $dispositivos = Fornecedor::listaDisp($id);
                    
                    foreach ($dispositivos as $key => $value) {
                        print "<tr>
                                <td>".($key+1)."</td>
                                <td>".$value['id']."</td>
                                <td>".$value['cel']."</td>
                                <td><a href='".FuncaoBase::geraLink("ajuda", "tdap", "deleteAutorizado", array('id'=>$value['id']))."' title='Desautorizar Celular'><img src='/core/imagem/delete.png'></a></td>
                                </tr>";
                        
                    }
                    ?>
                
            </tbody>
        </table>

    </div>
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>
<script type="text/javascript">
    
    $(document).ready(function(){

    $("#frm_cad_fornecedor").submit(function(e) {
        e.preventDefault();
    }).validate({
        /*debug:true,*/
        rules: {	
            txtCel: { required: true, maxlength: 20 }	
                            },
                            messages: {
                                    txtCel: { required: 'Preencha o campo Celular', minlength: 'No maximo 20 letras' },
                            },
                            submitHandler: function(form) { 
                                
                                var dados = {	
						'fornecedor_id' : $("#txt_idForn").val(),
						'cel'           : $("#txtCel").val()
						};

                $.ajax({
                    type: 'POST',
                    url: '?modulo=ajuda&controller=tdap&action=gravDisp',
                    data: dados,
                    //dataType: 'json',
                    success: function(response) {

                        alert("Cadastro Realizado com Sucesso");
                            location.reload();
                    },
                    error: function(e){
                        console.log(JSON.stringify(e));
                    }

                });
            }

        });
    });
</script>