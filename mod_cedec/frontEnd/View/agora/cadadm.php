<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_cedec/Model/indexModel.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php";?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php";?>
<!-- =================== MENU  ============================ -->
<?php include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";?>

<div class="col-lg10 col-xs-12">

    <a class="btn btn-primary" href="?modulo=cedec&controller=agora&action=index">Voltar</a>
    <br>
    <br>

    <!-- FORMULARIO DE LANÇAMENTO -->
    <div id="frmLancamento">
        <form action="#" method="POST" name="frmCadastro" id="frmCadastro">

            <label>Autor / Nome :</label>
            <input type="text" class="form-control" name="txtAutor" id="txtAutor">
            <br>
            <br>
            <label>Texto :</label>
            <textarea class="form-control" name="txtTexto" id="txtTexto" rows="5"></textarea>
            <br>
            <label>Imagem :</label>&nbsp;&nbsp;<span>(Resolução Máxima 600x600)</span>
            <input type="file" class="form-control" name="txtImagem" id="txtImagem">
            
            <input type="hidden" name="txtCategoria" id="txtCategoria" value="CEDEC-MG">
            <input type="hidden" name="txtDtHora" id="txtDtHora" value="<?=date('Y-m-d H:i:s');?>">
            <input type="hidden" class="form-control" name="txtOrgao" id="txtOrgao" value="CEDEC-MG">

            <br>
            <button type="button" class="btn btn-primary" name="btnSalvar" id="btnSalvar" title="Clique para salvar o Registro !">Salvar</button>
        </form>
    </div>
    
    </div>
</div>

    <?php


$param = isset($_POST['rbBusca'])? $_POST['rbBusca'] : "";
$texto = isset($_POST['txtBusca'])? $_POST['txtBusca'] : "";
$btn = isset($_POST['btnBusca'])? $_POST['btnBusca'] : "";

$defesaAgora = new DefesaAgora();
$lista = array();

if($btn == 'pesquisa'){
    $lista = $defesaAgora->listaSite($param, $texto);
}

?>
<br>

<!--  LISTA DE REGISTROS -->
<table class="table">
    <th>#</th>
    <th>Autor/Nome</th>
    <th>Data / Hora</th>
    <th>Texto</th>
    <th>Imagem</th>
    <th>Status</th>
    <th>Opções</th>

    <?php foreach ($lista as $key => $value) {

        $status = ($value['status1'] == 1) ? 'style=\'color:green;\'' : "";
        
       print "<tr><td $status>".((int)$key+1)."</td>";
       print "<td $status>".$value['autor']."</td>";
       print "<td>".DataMysql::dataCompletaVisual($value['data_hora'])."</td>";
       print "<td $status>".$value['texto']."</td>";
       print "<td style='padding:0;'><ul class='imgHover'>
                    <li style='padding: 0; margin:0;'><img width='50px;' src='anexo/def_civil_agora/".$value['imagem1']."'>
                        <span class='large'>
                            <img width='300px;' src='anexo/def_civil_agora/".$value['imagem1']."' class='large-image' alt='adventure' >
                        </span>
                    </li></ul>
                    </td>";
       print "<td $status>".$defesaAgora->status($value['status1'])."</td>";
       print "<td>
                <a href='?modulo=cedec&controller=agora&action=editar&id=".$value['id']."' id='lkEditar'><img src='core/imagem/editar.png' title='Editar Lançamento'></a>
                <a href='#'><img src='core/imagem/delete.png' title='Deleta o Lançamento !' onclick='deletaLancamento(".$value['id'].")' id='lkDeletar'></a>
                <a href='?modulo=cedec&controller=agora&action=lista&id=".$value['id']."''><img src='core/imagem/view.png' title='Visualizar Lançamento'id='lkVisualizar'></a>";

        print ($value['status1'] == 0) ?"<a href='#'><img src='core/imagem/ok.jpg' title='Ativar Lançamento' id='lkAtivar' onclick='ativar(".$value['id'].");'></a>":"";
        print "</td></tr>";

    }
    ?>

    </table>

</div> 
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>
<script>

$(document).ready(function(){

    /*
     salvar lançamento
    */
    $("#btnSalvar").click(function(event){

        event.preventDefault();

        if(
            ($('#txtAutor').val() == '') ||
            ($('#txtTexto').val() == '')
            )
        
        {
            alert('Preencha os Campos Obrigatórios !');
        }else {

            var form = $("#frmCadastro")[0];
            var dados = new FormData(form);
            dados.append("status", "0");
            dados.append("opcao", "cadastro");

            $.ajax({
                url : 'mod_cedec/View/agora/valida.php',
                type : 'POST',
                data: dados,
                enctype: 'multipart/form-data',
                processData: false,  // Important!
                contentType: false,
                cache: false,
                success : function(response) {
                    if( response == 'formato'){
                    alert(' inválido por favor insira um arquivo no formato png, jpg, jpeg')
                    }else{
                    alert("Aguarde a analise do seu registro para publicação !")
                    location.reload();
                    }
                },
                error : function(response){
                        console.log(JSON.stringify(response));
                }
            });
        }
    });

});

/*
* Ativar Lançamento
*/
function ativar(id){
    var result = confirm('Deseja Ativar este Lançamento !');
    var dados = {
            "id"     :id,
            "opcao"     : "valida",
        };

    if(result){

        $.ajax({
            url : 'mod_cedec/View/agora/valida.php',
            type : 'POST',
            data: dados,
            success : function(response) {
                alert("Registro ativado com Sucesso !");
                location.reload();
                
            },
            error : function(response){
                    console.log(JSON.stringify(response));
            }
        });
    }

}


/*
* 
*/
function deletaLancamento(id){

    var result = confirm('Deseja realmente Deletar o Registro !');
    var dados = {
            "id"     :id,
            "opcao"     : "deletar",
        };

    if(result){

        $.ajax({
            url : 'mod_cedec/View/agora/valida.php',
            type : 'POST',
            data: dados,
            success : function(response) {
                console.log(dados);
                
            },
            error : function(response){
                    console.log(JSON.stringify(response));
            }
        });
    }
}
</script>