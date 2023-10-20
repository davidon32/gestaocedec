<?php include_once 'core/include.php'; ?>
<?php include_once 'core/Model/indexModel.php'; ?>
<?php include_once 'mod_compdec/Model/Model.php'; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menuExterno.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>
<?php
$id_municipio = isset($pageSession['session']['seguranca']['id_municipio']) ? $pageSession['session']['seguranca']['id_municipio'] : "";

$interdicoes = interdicaoController::listagem_geral($id_municipio);

?>


<legend>Termo de Interdição</legend>

<div class="col-md-12 text-center">
    <a class="btn btn-success" href="<?= FuncaoBase::geraLink('compdec', 'compdec', 'index')?>">Voltar</a>
    <br><br>
</div>
<div class="col-md-6">     
     <!--<a class="btn btn-primary" href="<?= FuncaoBase::geraLink('compdec', 'interdicao', 'novo')?>">Novo Termo Interdição</a>-->
</div>
<div class="col-md-6">
    <a class="btn btn-linkedin" href="<?= FuncaoBase::geraLink('compdec', 'compdec', 'download', array('arquivo'=>'anexo/modelo/MODELO_DE_NOTIFICACAO_DE_INTERDICAO.docx'))?>">Baixar Modelo de Notificação de Interdição</a><br><br>
</div>
<div class='col-md-12'>
     <br><br>   
     <form action="#" method="POST" name="frmBusca" id="frmBusca">
         <label>Buscar</label> <span>(busca por Endereco ou proprietário)</span>
         <input class='form form-control' type="text" name="txtBusca" id="txtBusca">
         <br><input class='btn btn-primary' type="submit" name="btnBusca" id="btnBusca" value="Buscar">
         
     </form>

</div>
<div class="col-md-12">
    

    <legend>Listagem Termo de Interdição</legend>

    <table class="table table-bordered table-condensed table-striped" >
        <tr>
            <th class="col-md-1">Número</th>
            <th class="col-md-2">Data Interdição</th>
            <th class="col-md-2">Proprietario</th>
            <th class="col-md-3">Endereço</th>
            <th class="col-md-2">Opções</th>
        </tr>
    <?php

    foreach ($interdicoes as $key => $interdicao) {

        print "<tr>";
        print "<td>".$interdicao['numero']."</td>";
        print "<td>". DataMysql::dataCompletaVisual($interdicao['dt_registro'])."</td>";
        print "<td>".$interdicao['notificado']."</td>";
        print "<td>".$interdicao['endereco']."</td>";
            if($interdicao['publicacao'] == 1){
        print "<td title='Copie o código e incorpore em sua plataforma de divulgação !'>";
                print "<a class='btn btn-primary' href='".FuncaoBase::geraLink('compdec', 'interdicao', 'visualizar', array('id'=>$interdicao['id']))."'>Copie o código para publicação</a>
                    ";
            }else {
                //print "<tr>";
            }
                print "</td>";
        print "<td><a href='".FuncaoBase::geraLink("compdec", "interdicao", "visualizar", array('id' => $interdicao['id']))."'><img src='/core/imagem/view.png'></a>";

            if($interdicao['publicacao'] == 0) {
                print "<a name='publicar' data-publicar='1' data-id='".$interdicao['id']."' title='Publicar Termo de Interdição'><img width='35' src='/core/imagem/www.png'></a>";
            }else {
                print "<a name='publicar' data-publicar='0' data-id='".$interdicao['id']."' title='Remover autorização de Publicação Termo de Interdição'><img width='35' src='/core/imagem/www_remove.png'></a>";
            }
            print "</td>";
        print "</tr>";
       
    }
      
    ?>

    </table>

</div>
<div class="col-md-12">
    <?php
        $buscaTexto = isset($_POST['txtBusca']) ? $_POST['txtBusca'] : "";
        $btnBusca = isset($_POST['btnBusca']) ? $_POST['btnBusca'] : "";
        
        if( ($btnBusca == 'Buscar') && (!empty($buscaTexto)) ){
            
            $busca_interdicoes = interdicaoController::listagem_geral($buscaTexto);
            
            
                print "<table class='table table-bordered table-condensed table-striped' >";
                print "<tr>";
                print "<th class='col-md-2'>Número</th>";
                print "<th class='col-md-1'>Data Vistoria</th>";
                print "<th class='col-md-4'>Proprietario</th>";
                print "<th class='col-md-4'>Endereço</th>";
                print "<th class='col-md-4'>-</th>";
                print "<th class='col-md-1'>Opções</th>";
                print "</tr>";

            if(count($busca_interdicoes) > 0) {
                foreach ( $busca_interdicoes as $key => $busca_interdicao ) {
                    print "<tr>";
                    print "<td>".$busca_interdicao['numero']."</td>";
                    print "<td>".$busca_interdicao['dt_vistoria']."</td>";
                    print "<td>".$busca_interdicao['prop']."</td>";
                    print "<td>".$busca_interdicao['endereco']."</td>";
                    print "";
                    print "<td ".$title."><a href='".FuncaoBase::geraLink('compdec', 'vistoria', 'visualizar', array('id'=>$busca_interdicao['id']))."'><img src='/core/imagem/view.png'></a></td>";
                    print "</tr>";

                }
            }else {
                
                print "<tr>";
                print "<td colspan='5' align='center'>Não foi encontrado nenhum registro !</td>";
                print "</tr>";
                
            }
            print "</table>";
            
        }
    
    ?>
    
    
</div>


<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>
<script>
    
    $(document).ready(function(){
       
       $("a[name=publicar]").click(function(event){
           event.preventDefault(); 
           
           var publicar = "";
           if($(this).data('publicar') == 1){
               publicar = "Deseja liberar a publicação on-line deste documento ?"
           }else if ($(this).data('publicar') == 0) {
               publicar = "Deseja remover publicação para este documento ?"
           }
           
           var result = confirm(publicar);
           if(result) {
               $('#incorporar_termo').show();
                var dados = {
                            "opcao": 'publicar',
                            "id_interdicao": $(this).data('id'),
                            "publicar": $(this).data('publicar'),
                        };
            $.ajax({
                type: 'POST',
                url: 'mod_compdec/frontEnd/View/interdicao/ajax.php?v=<?= md5(VERSAO) ?>',
                data: dados,
                success: function (response) {
                    if(response == 'sucesso'){
                        alert('Registro alterado a sua visibilidade !');
                        location.reload();
                    }
                }
            });

           }
       })
        
    });
    

</script>
</body>
</html>

