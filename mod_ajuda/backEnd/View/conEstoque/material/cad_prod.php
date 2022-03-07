<?php include_once PATH . '/core/include.php'; ?>
<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_ajuda/Model/indexModel.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>
<style>	
    #frmCad_produto .error {
        color: red;
    }
</style>


<legend> Cadastro de Materiais </legend>

<div class="row">
    <div class="col-md-12">
        <br>
        <a class="btn btn-success" href="?token=<?= hash('sha256', md5(VERSAO) . date('dmY')); ?>&ac=itn&modulo=ajuda&controller=conestoque&action=material"/>Voltar</a>

    </div>
</div>

<div class="row">
    <br>
    <!-- Formeulario de cadastro de materiais -->
    <form id="frmCad_produto" action="" method="post">
        <div class="col-md-12">

            <div class="col-md-6">
                <label>Nome</label>
                <input class="form-control" name="txtNome" id="txtNome" type="text" required maxlength="70"/>
            </div>
            <div class="col-md-6">
                <label>Descrição</label>
                <input class="form-control" name="txtDescricao" id="txtDescricao" type="text" maxlength="70" required/>
            </div>
            <div class="col-md-6">
                <label>Unidade Medida</label>
                <select class="form-control" name="txtUniMedida" id="txtUniMedida">
                    <option value=''>Escolha a Opção</option>
                    <option value='Unitario'>Unitario</option>
                    <option value='Metro'>Metro</option>
                    <option value='Litro'>Litro</option>
                    <option value='Fardo'>Fardo</option>
                    <option value='Caixa'>Caixa</option>
                    <option value='Saco'>Saco</option>
                </select>
            </div>
            <div class="col-md-6">
                <label>Peso (Kg)</label>
                <input class="form-control" name="txtPeso" id="txtPeso" type="number" maxlength="5" required/>
            </div>
            <div class="col-md-6">
                <label>Valor</label>
                <input class="form-control" name="txt_val" id="txt_val" type="number" maxlength="5" required/>
            </div>
            <div class="col-md-3">
            </div>
            <div class="col-md-12 text-center">
                <br>
                <input class="btn btn-primary" type="submit" name="btnCadProduto" id="btnCadProduto" value="Cadastrar"/>
            </div>
        </div>
    </form>
    <!-- Fim formulario  -->
</div>
<br>

<div class="row">
    <div class="col-md-3">
    </div>
    <div class="col-md-7">
        <table class="table table-bordered">
            <tr>
                <th class="text-center">Cod</th>
                <th class="text-center">Nome</th>
                <th class="text-center">Descrição</th>
                <th class="text-center">Unidade</th>
                <th class="text-center">Peso</th>
                <th class="text-center">Valor</th>
                <th class="text-center">Ação</th>
            </tr>
            <?php
            $unidade = Unidade::getIdNome();
            foreach ($unidade as $key => $value) {
                print "<tr><td>" . $value['id_unidade'] . "</td>
                        <td>" . $value['nome'] . "</td>
                        <td>" . $value['descricao'] . "</td>
                        <td>" . $value['uni_medida'] . "</td>
                        <td>" . $value['peso'] . "</td>
                        <td>R$ " . $value['valor'] . "</td>
                        <td><a href=''><img src='/core/imagem/editar.png'></a></td>
                        </tr>";
            }
            ?>
        </table>
    </div>
    <div class="col-md-2">
    </div>	
</div>



<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>

<script type="text/javascript">

    $(document).ready(function () {
        
        $("#txtPeso").blur(function(){
            var valor = $("#txtPeso").val();
            valor = valor.replace( ",", "." );
            $("#txtPeso").val(valor); 
        });
        $("#txt_val").blur(function(){
            var valor = $("#txt_val").val();
            valor = valor.replace( ",", "." );
            $("#txt_val").val(valor); 
        });

        $("#frmCad_produto").submit(function (e) {
            e.preventDefault();
        }).validate({
            rules: {
                txtNome: {required: true, minlength: 2},
                txtUniMedida: {required: true},
                txtPeso: {required: true, minlength: 1},
                txt_val: {required: true, minlength: 1},
            },
            messages: {
                txtNome: {required: 'Preencha o campo nome', minlength: 'No mínimo 2 letras'},
                txtUniMedida: {required: 'Preencha o campo Unidade de Medida'},
                txtPeso: {required: 'Preencha o campo Peso', minlength: 'No mínimo 1 Numero'},
                txt_val: {required: 'Preencha o campo Valor', minlength: 'No mínimo 1 Numero'},
            },

            submitHandler: function (form) {

                var dados = {
                    "opcao": "cad_prod",
                    'nome': $("#txtNome").val(),
                    'descricao': $("#txtDescricao").val(),
                    'unidadeMedida': $("#txtUniMedida").val(),
                    'peso': $("#txtPeso").val(),
                    'valor': $("#txt_val").val(),
                };

                $.ajax({
                    type: 'POST',
                    url: 'mod_ajuda/backEnd/View/conEstoque/material/valida.php?v=<?= md5(VERSAO) ?>',
                    data: dados,
                    success: function (response) {
                        if (response == 'sucesso') {
                            alert("Cadastro realizado com Sucesso !");
                            location.reload();
                        }
                    },
                    error: function (e) {
                        console.log(JSON.stringify(response));
                        alert("Ocorreu um Erro !");
                    }
                });
                return false;
            }
        });
    });
</script>