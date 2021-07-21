<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_cedec/Model/Model.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php";?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php";?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";?>

<div class="col-lg10 col-xs-12">
    <a href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'))?>&ac=itn&modulo=cedec&controller=agora&action=index" class="btn btn-primary">Voltar</a>
    <?php

        $id = isset($_GET['id'])? $_GET['id'] : "";
        $defesaAgora = new DefesaAgora();

        /* list Ste*/
        if(empty($id)){
            $lista = $defesaAgora->listaAdm();
        }else {
            $lista = $defesaAgora->listaId($id);
        }   
        ?>
<br>
<table class="table">
    <th>#</th>
    <th>Autor/Nome</th>
    <th>Data/Hora</th>
    <th>Texto</th>
    <th>Categoria</th>
    <th>Órgão</th>
    <th>Imagem</th>
    <th>Status</th>
    <th style="width:150px;">Ação</th>

    <?php

foreach ($lista as $key => $value) {

            $style = ($value['status1'] == 1) ? "style='background-color:#81F781;' title='Registro Ativado !'":"style='background-color:#F6CED8; color:#424242;' title='Registro Pendente !'";

            print "<tr>";
            print "<td ".$style.">".($key+1)."</td>";
            print "<td ".$style.">".$value['autor']."</td>";
            print "<td ".$style.">".DataMysql::dataCompletaVisual($value['data_hora'])."</td>";
            print "<td ".$style.">".$value['texto']."</td>";
            print "<td ".$style.">".$value['categoria']."</td>";
            print "<td ".$style.">".$value['orgao']."</td>";
            print "<td ".$style."><img src='/anexo/def_civil_agora/".$value['imagem1']."' width='50'></td>";
            print "<td ".$style.">".$defesaAgora->status($value['status1'])."</td>";
            print "<td ".$style."><a href='?modulo=cedec&controller=agora&action=editar&id=".$value['id']."' id='lkEditar'><img src='core/imagem/editar.png' title='Editar Lançamento'></a>
                                    <a><img src='core/imagem/delete.png' title='Deleta o Lançamento !' onclick='deletaLancamento(".$value['id'].")' id='lkDeletar'></a>
                                <a href='?modulo=cedec&controller=agora&action=view&id=".$value['id']."'><img src='core/imagem/view.png' title='Visualizar Lançamento'id='lkVisualizar'></a>";

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
                url : 'mod_cedec/backEnd/View/agora/valida.php',
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
                url : 'mod_cedec/backEnd/View/agora/valida.php',
                type : 'POST',
                data: dados,
                success : function(response) {
                    //console.log(response);
                    alert('Registro Apagado com Sucesso !');
                    location.reload();
                    
                },
                error : function(response){
                        console.log(JSON.stringify(response));
                }
            });
        }
    }
</script>