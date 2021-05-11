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

  <div id="frmBusca">
    <form action="#" method="POST" name="frmBusca" id="frmBusca">
        <div class="form-group">
            <div class="radio">
                <input type="radio" name="rbBusca" id="rbAutor" value="autor" checked="checked">
                <span>Autor</span>
            </div>
            <div class="radio">
                <input type="radio" name="rbBusca" id="rbData" value="data">
                <span>Data</span>
            </div>
            <div class="radio">
                <input type="radio" name="rbBusca" id="rbTexto" value="texto">
                <span>Texto</span>
            </div>
        </div>
        
        <input type="text" class="form-control" name="txtBusca" id="txtbusca"><br>
        <button type="submit" class="btn btn-primary" name="btnBusca" id="btnBusca" title="Clique para buscar o Registro !" value="pesquisa">Buscar</button>


    </div>
  </div>

    <?php


$param = isset($_POST['rbBusca'])? $_POST['rbBusca'] : "";
$texto = isset($_POST['txtBusca'])? $_POST['txtBusca'] : "";
$btn = isset($_POST['btnBusca'])? $_POST['btnBusca'] : "";

$defesaAgora = new DefesaAgora();
$lista = array();

if($btn == 'pesquisa'){
    $lista = $defesaAgora->lista($param, $texto, null);
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
                <a href='#'><img src='core/imagem/delete.png' title='Deleta o Lançamento !' onclick='deletaLancamento(".$value['id'].", \"".$value['imagem1']."\")' id='lkDeletar'></a>
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
    function deletaLancamento(id, imagem){

        var result = confirm('Deseja realmente Deletar o Registro !');
        var dados = {
                "id"     :id,
                "opcao"     : "deletar",
                "imagem1"    : imagem,
            };

        if(result){

            $.ajax({
                url : 'mod_cedec/View/agora/valida.php',
                type : 'POST',
                data: dados,
                success : function(response) {
                    location.reload();
                },
                error : function(response){
                        console.log(JSON.stringify(response));
                }
            });
        }
    }
</script>