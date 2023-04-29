<?php
include_once PATH . '/core/include.php';
require_once(MODEL_AJUDA_BACKEND . '/AjudaRelatorioModel.php');
require_once(CONTROLLER_AJUDA_BACKEND . '/AjudaRelatorioController.php');
?>
<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_ajuda/Model/indexModel.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php
include_once "template/page/corpoHeader.php";
$_relatorioAjuda = new RelatorioAju();
?>
<style>
    @media print
    {
        a:link {
            display: none;
        }
        * {font-size: 10px;}
        .imprimir {
            display: none;
        }
    }
    table td {
        font-size: 10px;  
    }
</style>
<?php
$dtInicio      = isset($_POST['txtDtInicio']) ? DataMysql::dataForm($_POST['txtDtInicio']) : false;
$dtFinal       = isset($_POST['txtDtFinal']) ? DataMysql::dataForm($_POST['txtDtFinal']) : false;
$ordem         = isset($_POST['rbOrdem']) ? $_POST['rbOrdem'] : false;
$nome_material = isset($_POST['txtMaterial']) ? $_POST['txtMaterial'] : false;
$deposito      = isset($_POST['id_deposito']) ? $_POST['id_deposito'] : false;
 

$ajudaRelatorioModel = new AjudaRelatorioModel();

$ajudaRelatorioController = new AjudaRelatorioController();

$ajudaRelatorioModel->setDt_inicial($dtInicio);
$ajudaRelatorioModel->setDt_final($dtFinal);
$ajudaRelatorioModel->setOrdem($ordem);
$ajudaRelatorioModel->setMaterial($nome_material);
$ajudaRelatorioModel->setDeposito($deposito);

$dados = $ajudaRelatorioController->relatorioCadastroMaterial($ajudaRelatorioModel);


?>
<br>
<div class='text-center'><a class="btn btn-success" href='index.php?token=<?= hash('sha256', md5(VERSAO).date('dmY')); ?>&ac=itn&modulo=ajuda&controller=relatorio&action=fbusca_cad_mat' class="btn">Voltar</a></div>
</br>

<p class="text-center"><legend> Relatório Entrada de Materiais</legend></p>
<h3>Período : <?= DataMysql::dataVisual($dtInicio); ?> à <?= DataMysql::dataVisual($dtFinal); ?><br> Ordenado : <?= ucfirst($ajudaRelatorioController->SwOrder($ordem));?></h3>
<table class="table table-bordered table-condensed">
    <th style='font-size:10px; text-align:center;'>Código</th>
    <th style='font-size:10px; text-align:center;'>Nome</th>
    <th style='font-size:10px; text-align:center;'>Quantidade</th>
    <th style='font-size:10px; text-align:center;'>Origem </th>
    <th style='font-size:10px; text-align:center;'>Depósito Destino</th>
    <th style='font-size:10px; text-align:center;'>Validade</th>
    <th style='font-size:10px; text-align:center;'>Obs</th>
    <th style='font-size:10px; text-align:center;'>Lanc. Usuario</th>
    <th style='font-size:10px; text-align:center;'>Arquivo Nota</th>
    <th style='font-size:10px; text-align:center;'>Dt.Entrada</th>

    <?php
    $totalRegistro = 0;
    $cancela = "";
    
    $title = "";

    for ($i = 0; $i < count($dados[0]); $i++) {
        
        if(!empty($dados[0][$i]['id_entrada'])){
            $nom_origem = Material::getMaterial1($dados[0][$i]['id_entrada'])['origem'];
        }
        
        if($dados[0][$i]['cancelado'] == 1){
            $cancela = "color:red;";
            $title = "title='Entrada de Material Cancelada !'";
        }
        
        $usuario = (!empty($dados[$i]['id_usuario'])) ? Usuario::getNomeId($dados[$i]['id_usuario']):"";
        $totalRegistro++;
        print "<tr>";
        print "<td $title style='font-size:10px;{$cancela}'>" . $dados[0][$i]['id_produto'] . "</td>";
        print "<td $title style='font-size:10px;{$cancela}'>" . $dados[0][$i]['codProd']."-".$dados[0][$i]['nome'] . "</td>";
        print "<td $title style='font-size:15px;{$cancela}'><b>" . $dados[0][$i]['quantidade'] . "</b></td>";
        print "<td $title style='font-size:10px;{$cancela}'>" . utf8_encode($dados[0][$i]['origem']). "- " .( ($dados[0][$i]['origem'] == 'Transferencia entre Depositos') ? " ID Entrada : <b>".$dados[0][$i]['id_entrada']."-".$nom_origem."</b>" :  "" )."</td>";
        print "<td $title style='font-size:10px;{$cancela}'>" . $dados[0][$i]['depDestino'] . "</td>";
        print "<td $title style='font-size:10px;{$cancela}'>" . DataMysql::dataVisual($dados[0][$i]['validade']) . "</td>";
        print "<td $title style='text-align:justify; font-size:10px;{$cancela}'>" . $dados[0][$i]['obs'] . "</td>";
        print "<td $title style='text-align:justify; font-size:10px;{$cancela}'>" . $usuario . "</td>";
        print "<td $title style='text-align:justify; font-size:10px;{$cancela}'><a href='anexo/entrada_nota/" . $dados[0][$i]['nota_fiscal'] . "'>" . $dados[0][$i]['nota_fiscal'] . "</a></td>";
        print "<td $title style='font-size:10px;'>" . DataMysql::dataVisual($dados[0][$i]['dtEntradaSaida']) . "</td>";
        print "</tr>";
        $cancela = "";
        $title="";
    }
    print "<tr><td colspan='7'>&nbsp;</td><td style='text-align:right'>Total Registro</td><td>" . $totalRegistro . "</td></tr>";
    print "</table>";
    ?>
    
     
    <table class="table table-bordered table-condensed">
        
            <tr>
                <th>Material</th>
                <th>Total Qtd</th>
            </tr>
            
    <?php
        foreach ($dados[1] as $key => $value) {
            
           
            print "<tr>";
            print "<td>".$value['codProd']."-". $value['nome']." / ".$value['origem']."</td>";
            print "<td style='font-size:15px;'><b>".$value['qtd']."</b></td>";
            print "</tr>";
        
        
        }?>
        
    </table>

    
<div class="row">
    <div class="col-md-12">
    
        <p class="p-4"><span style="color: red">Obs: Entradas Canceladas não são Somadas no Relatório</span></p>
    </div>
</div>
      
        
        




    <!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
    <!-- =================== RODAPE  ======================== -->
    <?php include_once "template/page/rodape.php" ?>
    <?php include_once "template/page/barra_config_template.php"; ?>
    <!-- =============== HEADER HTML PAGE ================= -->
    <?php include_once "template/page/rodapePage.php"; ?>
