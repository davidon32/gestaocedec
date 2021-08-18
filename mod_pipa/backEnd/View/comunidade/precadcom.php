<?php
include_once PATH . '/core/include.php';
include_once "template/page/headerPageSimples.php";

$comunidade = new Comunidade();

//$id_comunidade = (int) isset($_GET['id']) ? $_GET['id'] : 0;
$id_rota = (int) isset($_GET['r']) ? $_GET['r'] : 0;

$id_municipio = isset($_GET['id']) ? $_GET['id'] : "";
?>
<legend>Solicitação de inclusão de Comunidade</legend>
<br>
<div class="col-md-2">&nbsp;</div>
<div class="col-md-8">
    <form action="#" method="post" name="frmPreCadCom">
        <div class="input-group input-group-lg input_fields_wrap">
            <div class="col-md-12">
            <input class="form form-control" type="text" name="listCom[]">
            <span class="input-group-addon">
                <a class="add_field_button"><img alt="Adicionar Comunidade" src="core/imagem/add.png" width="20px;"></a>
            </span>  
            </div>
            <div class="col-md-12">
            <input class="form form-control" type="text" name="listCom[]">
            <span class="input-group-addon">
                <a class="add_field_button"><img alt="Adicionar Comunidade" src="core/imagem/add.png" width="20px;"></a>
            </span> 
            </div>
        </div>
                
        <br>
        <input class="btn btn-success" type="submit" value="Enviar" name="btnEnviar">
    </form>

</div>
<div class="col-md-8">&nbsp;</div>



<?php
$btnEnviar = isset($_POST['btnEnviar']) ? $_POST['btnEnviar'] : "";

if ($btnEnviar == 'Enviar') {

    $post = $_POST;


    foreach ($post['listCom'] as $value) {
        $dados = array('txtComunidade' => $value,
            'id_municipio' => $id_municipio,
            'tipo_cad' => "pre",
            'origem_cad' => "pre");

        $comunidade->cadComunidade($dados);
    }
}
?>

<table class="table table-bordered">
    <tr>
        <td style="text-align:center;" colspan="2"><b>Histórico de Comunidades enviadas para Cadastro</b></td>
    </tr>
    <tr>
        <th>Comunidade</th>
        <th>Situacao</th>
    </tr>

<?php
$list = $comunidade->listaComunidadePreCadastro($id_municipio);

foreach ($list as $value) {
    print "<tr>";
    print "<td>" . $value['comunidade'] . "</td>";
    print "<td>" . (($value['tipo_cad'] == 'pre') ? 'em Análise' : 'Comunidade Disponivel p/ PMDA') . "</td>";
    print "</tr>";
}
?>
</table>
</div>

<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/jasny-bootstrap.js"></script>
<script type="text/javascript">

    $(document).ready(function () {
        var max_fields = 10; //maximum input boxes allowed
        var wrapper = $(".input_fields_wrap"); //Fields wrapper
        var add_button = $(".add_field_button"); //Add button ID

        var x = 1; //initlal text box count
        $(add_button).click(function (e) { //on add input button click
            e.preventDefault();
            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                $(wrapper).append('<div class="input-group input-group-lg input_fields_wrap">\n\
                                    <input class="form form-control" type="text" name="listCom[]"/>\n\
                                    <span class="input-group-addon">\n\
                                        <a class="remove_field"><img alt="Adicionar Comunidade" src="/core/imagem/remove.png" width="20px;"></a>\n\
                                    </span>\n\
                                </div>'); //add input box
            }
        });

        $(wrapper).on("click", ".remove_field", function (e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })
    });

</script>
