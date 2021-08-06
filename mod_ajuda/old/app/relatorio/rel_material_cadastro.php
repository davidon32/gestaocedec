<?php session_start();
include_once PATH.'/include.php';
require_once(PATH.'/system/config.inc.php');
require_once(MODEL_AJUDA.'/AjudaRelatorioModel.php');
require_once(CONTROLLER_AJUDA.'/AjudaRelatorioController.php');

$_conexao = new ConexaoMysql();

$_relatorioAjuda = new RelatorioAju();

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo TITULO; ?></title>
<link href="/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
<style>
 
@media print
{
    * {font-size: 10px;}

    .imprimir {

        display: none;
    }

}

table td {
    
    font-size: 10px;
    
}

</style>
</head>

<body>


    <?php 
    
    //var_dump($_POST);  

    $dtInicio = isset($_POST['txtDtInicio']) ? DataMysql::dataForm($_POST['txtDtInicio']) : false;
    $dtFinal  = isset($_POST['txtDtFinal']) ? DataMysql::dataForm($_POST['txtDtFinal']) : false;

    $ordem = isset($_POST['rbOrdem']) ? $_POST['rbOrdem'] : false;

    ?>
        <br>
        <div class='text-center'><a href='index.php?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>"&ac=&modulo=ajuda&secao=material&acao=busca_cadastro' class="btn">Voltar</a></div>
    </br>

    <legend> Relatório Entrada de Materiais</legend>
    <table class="table table-bordered table-condensed">
        <th style='font-size:10px; text-align:center;'>Código</th>
        <th style='font-size:10px; text-align:center;'>Nome</th>
        <th style='font-size:10px; text-align:center;'>Quantidade</th>
        <th style='font-size:10px; text-align:center;'>Origem </th>
        <th style='font-size:10px; text-align:center;'>Depósito Destino</th>
        <th style='font-size:10px; text-align:center;'>Validade</th>
        <th style='font-size:10px; text-align:center;'>Obs</th>
        <th style='font-size:10px; text-align:center;'>Dt.Entrada</th>

    <?php
 
        $ajudaRelatorioModel = new AjudaRelatorioModel();
        
        $ajudaRelatorioController = new AjudaRelatorioController();
        
        $ajudaRelatorioModel->setDt_inicial($dtInicio);
         $ajudaRelatorioModel->setDt_final($dtFinal);
        $ajudaRelatorioModel->setOrdem($ordem);
        
        $dados = $ajudaRelatorioController->relatorioCadastroMaterial($ajudaRelatorioModel);

        $totalRegistro = 0;
        
        for ($i=0; $i < count($dados) ; $i++) {

            $totalRegistro++;
            print "<tr>";
            print "<td style='font-size:10px;'>".$dados[$i]['id_produto']."</td>";
            print "<td style='font-size:10px;'>".$dados[$i]['nome']."</td>";
            print "<td style='font-size:10px;'>".$dados[$i]['quantidade']."</td>";       
            print "<td style='font-size:10px;'>".utf8_encode($dados[$i]['origem'])."</td>";         
            print "<td style='font-size:10px;'>".$dados[$i]['depDestino']."</td>";           
            print "<td style='font-size:10px;'>".$dados[$i]['validade']."</td>";        
            print "<td style='text-align:justify; font-size:10px;'>".$dados[$i]['obs']."</td>";
            print "<td style='font-size:10px;'>".DataMysql::dataVisual($dados[$i]['dtEntradaSaida'])."</td>";
            print "</tr>";
                
                        
        }
    print "<tr><td colspan='6'>&nbsp;</td><td style='text-align:right'>Total Registro</td><td>".$totalRegistro."</td></tr>";
    print "</table>";

    ?>
    <div class="row">
        <div class='text-center'><x-small><?=RODAPE;?></x-small></div>
        
    </div>
    <script src="/js/jquery.js"></script>
    <script src="/js/bootstrap.js"></script>
    <script src="/js/jasny-bootstrap.js"></script>
</body>
</html>

