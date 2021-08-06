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

table th {
    
    font-size:10px;
    color: #000000;
    text-align:center;
    background-color: #A4A4A4;
    font-weight: bold;
    
}

</style>
</head>

<body>


    <?php   

    $dtInicial = isset($_POST['txtDtInicial']) ? DataMysql::dataForm($_POST['txtDtInicial']) : false;

    $dtFinal = isset($_POST['txtDtFinal']) ? DataMysql::dataForm($_POST['txtDtFinal']) : false;

    $idMunicipio = isset($_POST['id_municipio']) ? $_POST['id_municipio'] : false;

    $idDeposito = isset($_POST['id_deposito']) ? $_POST['id_deposito'] : false;

    $idTransferencia = isset($_GET['id']) ? $_GET['id'] : false;

    $nivel = $_SESSION['seguranca']['nivel'];
    
    ?>
        <br>
        <div class='text-center'><a href='index.php?token=".hash('sha256', md5(VERSAO)."-".time())."&ac=&modulo=ajuda&secao=transferencia&acao=busca_rel_mat_transferido' class="btn">Voltar</a></div>
    </br>

    <legend> Relatório de Materiais Transferidos entre Depósitos</legend>
    <table class="table table-bordered table-condensed">
        <th>Nº</th>
        <th style='font-size:10px; text-align:center; background-color: #A4A4A4;'>Dt.Transf.</th>
        <th style='font-size:10px; text-align:center; background-color: #A4A4A4;'>Motorista</th>
        <th style='font-size:10px; text-align:center; background-color: #A4A4A4;'>Veículo</th>
        <th style='font-size:10px; text-align:center; background-color: #A4A4A4;'>Placa</th>
        <th style='font-size:10px; text-align:center; background-color: #A4A4A4;'>Dt Saída</th>
        <th style='font-size:10px; text-align:center; background-color: #A4A4A4;'>Dt Chegada</th>
        <th style='font-size:10px; text-align:center; background-color: #A4A4A4;'>Dep.Origem</th>
        <th style='font-size:10px; text-align:center; background-color: #A4A4A4;'>Dep.Destino</th>
        <th style='font-size:10px; text-align:center; background-color: #A4A4A4;'>Situação</th>
        <th style='font-size:10px; text-align:center; background-color: #A4A4A4;'>Responsável</th>
        <th style='font-size:10px; text-align:center; background-color: #A4A4A4;'>Obs</th>
        <th style='font-size:10px; text-align:center; background-color: #A4A4A4;'>Baixa</th>
        <th style='font-size:10px; text-align:center; background-color: #A4A4A4;'>Motivo</th>
        <th style='font-size:10px; text-align:center; background-color: #A4A4A4;'>Material</th>
    
    
    <?php

    /* relatorio de material transferido entre depósitos*/
    if(($idTransferencia == false) && ($nivel == 4)){

        //$_relatorioAjuda->RelatorioVisualizaLiberacao(false, $_SESSION['seguranca']['id_deposito']);
        //$_relatorioAjuda->RelatorioVisualizaLiberacao(false, $_SESSION['seguranca']['id_deposito']);


    } else if((is_numeric($idTransferencia) && $idTransferencia != false)){

        #@ relatorio com o id da liberacao
        //$_relatorioAjuda->RelatorioVisualizaLiberacao($id_liberacao);


    }else {

        #@ relatorio com filtro de opcoes
        //$_relatorioAjuda->MaterialLiberado($_dt_inicial, $_dt_final, $_id_municipio, $_id_deposito, false);
        
        $ajudaRelatorioModel = new AjudaRelatorioModel();
        
        $ajudaRelatorioController = new AjudaRelatorioController();
        
        $ajudaRelatorioModel->setDt_inicial($dtInicial);
        $ajudaRelatorioModel->setDt_final($dtFinal);
        
        $dados = $ajudaRelatorioController->materialTransferencia($ajudaRelatorioModel);

        //var_dump($ajudaRelatorioModel);
        
        for ($i=0; $i < count($dados) ; $i++) {
            
            $ajudaRelatorioModel->setId_transferencia($dados[$i]['id_transferencia']);    
            
            $itemTransf = $ajudaRelatorioController->itemTransferencia($ajudaRelatorioModel);
            
            $background ="";
                        
                        switch ($dados[$i]['situacao']) {
                            case '0':
                                 $background = "alert alert-info";  
                                break;
                            case '1':
                                $background = "alert alert-success";
                                break;
                            case '2':
                                $background = "alert alert-warning";
                                break;
                            
                            default:
                                $background = "";
                                break;
                        }
            
            print "<tr>";
            print "<td style='text-align:center; font-size:10px;' class='".$background."'>".$dados[$i]['id_transferencia']."</td>";
            print "<td style='text-align:center; font-size:10px;' class='".$background."'>".DataMysql::extraiData($dados[$i]['dt_transferencia'])."</td>";
            print "<td style='text-align:center; font-size:10px;' class='".$background."'>".$dados[$i]['motorista']."</td>";       
            print "<td style='text-align:center; font-size:10px;' class='".$background."'>".$dados[$i]['veiculo']."</td>";         
            print "<td style='text-align:center; font-size:10px;' class='".$background."'>".$dados[$i]['placa']."</td>";           
            print "<td style='text-align:center; font-size:10px;' class='".$background."'>".DataMysql::extraiData($dados[$i]['dt_saida'])."</td>";        
            print "<td style='text-align:center; font-size:10px;' class='".$background."'>".DataMysql::extraiData($dados[$i]['dt_chegada'])."</td>";      
            print "<td style='text-align:center; font-size:10px;' class='".$background."'>".Deposito::PegaNomeDeposito($dados[$i]['id_dep_origem'])."</td>";
            print "<td style='text-align:center; font-size:10px;' class='".$background."'>".Deposito::PegaNomeDeposito($dados[$i]['id_dep_destino'])."</td>";  
            print "<td style='text-align:center; font-size:10px;' class='".$background."'>".TransferenciaMaterial::situacaoPgto($dados[$i]['situacao'])."</td>";        
            print "<td style='text-align:center; font-size:10px;' class='".$background."'>".$dados[$i]['responsavel']."<br>".$dados[$i]['doc_res']."</td>";     
            print "<td style='text-align:center; font-size:10px;' class='".$background."'>".$dados[$i]['obs']."</td>";             
            print "<td style='text-align:center; font-size:10px;' class='".$background."'>".$dados[$i]['baixa']."</td>";           
            print "<td style='text-align:center; font-size:10px;' class='".$background."'>".$dados[$i]['motivo']."</td>";          
            print "<td style='text-align:center; font-size:10px;' class='".$background."'>";
            
                print "<table class='table table-condensed table-bordered'>";
                    print "<tr>";
                    print "<td style='font-size:9px; font-weight: bold;' class='".$background."'>Nome</td>";
                    print "<td style='font-size:9px; font-weight: bold;' class='".$background."'>Descrição</td>";
                    print "<td style='font-size:9px; font-weight: bold;' class='".$background."'>Qtd</td>";
                    print "</tr>";
                    
                for ($j=0; $j < count($itemTransf) ; $j++) {
                    print "<tr>";    
                    print "<td class='".$background."'>".$itemTransf[$j]['nome']."</td>";
                    print "<td class='".$background."'>".$itemTransf[$j]['descricao']."</td>";
                    print "<td class='".$background."'>".$itemTransf[$j]['quantidade']."</td>";
                    print "</tr>";
                }
                
                print "</table>";
            
            //var_dump($itemTransf);
            
            print "</td>";
            
            print "</tr>";   
                        
        }

    print "</table>";

    }


    ?>
    <div class="row">
        <div class='text-center'><x-small><?=RODAPE;?></x-small></div>
        
    </div>
    <script src="/js/jquery.js"></script>
    <script src="/js/bootstrap.js"></script>
    <script src="/js/jasny-bootstrap.js"></script>
</body>
</html>

