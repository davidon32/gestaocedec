<?php include_once PATH.'/core/include.php';?>
<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_ajuda/Model/indexModel.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php";?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php";?>
<!-- =================== MENU  ============================ -->
<?php include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";

$id = isset($_GET['id']) ? $_GET['id'] : "";

$dados = Fornecedor::listaFornecedor($id);
?>
<br>

<div class="col-md-12 text-center">
    <h2>Editar Cadastro de Fornecedor</h2>
</div>
<div class="col-md-12">
    <form action="" method="POST" name="frm_cad_fornecedor" id="frm_cad_fornecedor">
    <div class="col-md-6">
        
        <label>Nome do Fornecedor</label>
        <input type="hidden" name="txtId" id="txtId" value="<?=$dados['id'];?>">
        <input type="text" class="form form-control" name="txtNome" id="txtNome" required maxlength="69" value="<?=$dados['nome'];?>">
        <label>CPF/CNPJ</label>
        <input type="text" class="form form-control" name="txtCpfCnpj" id="txtCpfCnpj" required maxlength="20"  value="<?=$dados['cpfcnpj'];?>">
        <label>Telefone do Fornecedor</label>
        <input type="text" class="form form-control" name="txtTel" id="txtTel" required maxlength="20" data-mask="(00)0000-0000"  value="<?=$dados['tel'];?>">
        <label>Celular do Fornecedor</label>
        <input type="text" class="form form-control" name="txtCel" id="txtCel" required maxlength="20"  data-mask="(00)9 0000-0000"  value="<?=$dados['cel'];?>">
        
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
        <a class="btn btn-success" href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=ajuda&controller=tdap&action=index"" title="Relatorios">
            Voltar
            </a>
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
            txtNome: { required: true, maxlength: 69 },	
            txtCpfCnpj: { required: true, maxlength: 20 },	
            txtTel: { required: true, maxlength: 20 },	
            txtCel: { required: true, maxlength: 20 }	
                            },
                            messages: {
                                    txtNome: { required: 'Preencha o campo nome', minlength: 'No maximo 69 letras' },
                                    txtCpfCnpj: { required: 'Preencha o campo CPF CNPJ', minlength: 'No maximo 20 letras' },
                                    txtTel: { required: 'Preencha o campo Telefone', minlength: 'No maximo 20 letras' },
                                    txtCel: { required: 'Preencha o campo Celular', minlength: 'No maximo 20 letras' },
                            },
                            submitHandler: function(form) { 
                                
                                var dados = {	
						'nome'    : $("#txtNome").val(),
						'cpfcnpj': $("#txtCpfCnpj").val(),
						'tel'     : $("#txtTel").val(),
						'cel'     : $("#txtCel").val(),
						'id'      : $("#txtId").val()
						};

                $.ajax({
                    type: 'POST',
                    url: '?modulo=ajuda&controller=tdap&action=editFornec',
                    data: dados,
                    //dataType: 'json',
                    success: function(response) {

                        alert("Cadastro Atualizado com Sucesso");
                        window.location.href = '?modulo=ajuda&controller=tdap&action=index';

                    },
                    error: function(e){
                        console.log(JSON.stringify(e));
                    }

                });
            }

        });
    });
</script>