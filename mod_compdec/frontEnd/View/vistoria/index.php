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

$busca_vistorias = vistoriaController::listagem_geral();

?>


<legend>Termo de Vistoria</legend>

<div class="col-md-12 text-center">
    <a class="btn btn-success" href="<?= FuncaoBase::geraLink('compdec', 'compdec', 'index')?>">Voltar</a>
    <br><br>
</div>
<div class="col-md-6">     
     <a class="btn btn-primary" href="<?= FuncaoBase::geraLink('compdec', 'vistoria', 'novo')?>">Novo Termo</a>
</div>
<div class="col-md-6">
    <a class="btn btn-linkedin" title='Clique para baixar o Modelo' href="<?= FuncaoBase::geraLink('compdec', 'compdec', 'download', array('arquivo'=>'anexo/modelo/RELATORIO_VISTORIA_ATENDIMENTO_EMERGENCIAL.docx'))?>">Baixar Modelo de Termo de Vistoria </a><br><br>
</div>
<div class='col-md-6'>
     <br><br>   
     <form action="<?= FuncaoBase::geraLink('compdec', 'vistoria', 'index')?>" method="POST" name="frmBusca" id="frmBusca">
         <label>Buscar (busca por Endereco ou proprietário)</label>
         <input class='form form-control' type="text" name="txtBusca" id="txtBusca">
         <br><input class='btn btn-primary' type="submit" name="btnBusca" id="btnBusca" value="Buscar">
         
     </form>

</div>
<div class="col-md-6">
   

</div>
<div class="col-md-12">
    <?php
        $buscaTexto = isset($_POST['txtBusca']) ? $_POST['txtBusca'] : "";
        $btnBusca = isset($_POST['btnBusca']) ? $_POST['btnBusca'] : "";
        
        if( $btnBusca == 'Buscar' ){
            
            if(!empty($buscaTexto)) {
                $busca_vistorias = vistoriaController::listagem_geral($buscaTexto);
            }else {
                $busca_vistorias = vistoriaController::listagem_geral();
            }
        }
            
            
                print "<table class='table table-bordered table-condensed table-striped' >";
                print "<tr>";
                print "<th class='col-md-2'>Número</th>";
                print "<th class='col-md-1'>Data Vistoria</th>";
                print "<th class='col-md-4'>Proprietario</th>";
                print "<th class='col-md-4'>Endereço</th>";
                print "<th class='col-md-1'>Opções</th>";
                print "</tr>";

            if(count($busca_vistorias) > 0) {
                foreach ($busca_vistorias as $key => $busca_vistoria) {
                    print "<tr>";
                    print "<td>".$busca_vistoria['numero']."</td>";
                    print "<td>".$busca_vistoria['dt_vistoria']."</td>";
                    print "<td>".$busca_vistoria['prop']."</td>";
                    print "<td>".$busca_vistoria['endereco']."</td>";
                    print "<td><a href='".FuncaoBase::geraLink('compdec', 'vistoria', 'visualizar', array('id'=>$busca_vistoria['id']))."'><img src='/core/imagem/view.png'></a></td>";
                    print "</tr>";

                }
            }else {
                
                print "<tr>";
                print "<td colspan='5' align='center'>Não foi encontrado nenhum registro !</td>";
                print "</tr>";
                
            }
            print "</table>";
            
        
    
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
    

</script>
</body>
</html>

