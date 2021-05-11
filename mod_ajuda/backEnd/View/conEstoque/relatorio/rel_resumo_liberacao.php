<?php session_start();
    require_once("system/config.inc.php");
    require_once(MODEL_AJUDA."/AjudaRelatorioModel.php");
    require_once(CONTROLLER_AJUDA."/AjudaRelatorioController.php");
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo TITULO; ?></title>
<link href="/css/bootstrap.css" rel="stylesheet">
<link href="/css/bootstrap-responsive.css" rel="stylesheet">
<script type="text/javascript" src="<?php print SISTEMA;?>/js/funcaobase.js"></script>
<style>
    
    @media print {
        
        #cabecalho {
            
            display: none;
        }
    }
    
</style>
</head>

<body>
    <?php    

    $_dtInicial = isset($_POST['txtDtInicio']) ? DataMysql::dataForm($_POST['txtDtInicio']) : "";
    $_dtFinal = isset($_POST['txtDtFinal']) ? DataMysql::dataForm($_POST['txtDtFinal']) : "";
    $_idDeposito = isset($_POST['selIdDeposito']) ? $_POST['selIdDeposito'] : "";
    $_ckRegiao = isset($_POST['ckRegiao']) ? $_POST['ckRegiao'] : "";
    $_btnFiltro = isset($_POST['btnFiltro']) ? $_POST['btnFiltro'] : "false";
    
    // cesta
    $_idMaterial = 1;
    
    //var_dump($_POST);
    
    $_ajudaRelatorioController = new AjudaRelatorioController();
    $_ajudaRelatorioModel = new AjudaRelatorioModel();
    
    /* limitar a pesquisa no periodo máximo(anual) inicial e final para o mesmo mes 
     * ex: 01/01/2016 a 31/12/2016*/
    
    // data inicial e final nao pode ficar em Branco
    if((strlen($_dtInicial) > 0) && (strlen($_dtFinal) > 0)){
            
        // verifica se o ano são iguais    
        if(substr($_dtInicial, 0, 4) == substr($_dtFinal, 0, 4)){
        
            //print "data Ok";
            $_ajudaRelatorioModel->setDt_inicial($_dtInicial);  
            $_ajudaRelatorioModel->setDt_final($_dtFinal);
            $_ajudaRelatorioModel->setMaterial($_idMaterial);
            
            //var_dump($_ajudaRelatorioModel);
            
            if($_ajudaRelatorioController->tabelaAuxiliarResumo($_ajudaRelatorioModel)){
            
            $dados = $_ajudaRelatorioController->relResumoLiberacaoDados();
            
            //var_dump($dados);
            
            }
                       
            
        }else {
            
            print "O data de filtro deve ter estar dentro de um mesmo ano !" ;
            print "<script type=\"text/javascript\">
                      <!--alert(\"Cadastro realizado com Sucesso !\");
                      window.location = '".$url."';-->
                    </script>";   
            
        }
        
        
    }
?>
<div class="container">
    </br></br>
    <div align="center" id="cabecalho"><a class='btn' href='index.php?token=<?=hash('sha256', md5(VERSAO));?>&ac=itn&modulo=ajuda&secao=liberacao&acao=rel_busca_resumo'>Voltar</a><br><br></div>
    <div align="center"><legend>Resumo de Liberações de Cesta Básica</legend><br><br></div>
    <div class="row">
        <div class="span6">Período : <?=DataMysql::dataVisual($_dtInicial);?> à <?=DataMysql::dataVisual($_dtFinal);?><br><br></div>
        <div class="span6 text-right">Data: <?=date('d/m/Y');?></div>
    </div>
    
<table class="table table-bordered">
    <tr>
       <th>Depósito</th>
       <th>Janeiro</th>
       <th>Fevereiro</th> 
       <th>Março</th> 
       <th>Abril</th> 
       <th>Maio</th> 
       <th>Junho</th> 
       <th>Julho</th> 
       <th>Agosto</th> 
       <th>Setembro</th> 
       <th>Outubro</th> 
       <th>Novembro</th> 
       <th>Dezembro</th> 
       <th>Total</th>  
    </tr>
    
    <?php
    

    for ($i=0; $i < count($dados); $i++) {
        
        $total = (int) $dados[$i]['Janeiro'] +
                 (int) $dados[$i]['Fevereiro']+
                 (int) $dados[$i]['Marco'] +
                 (int) $dados[$i]['Abril'] +
                 (int) $dados[$i]['Maio']  +
                 (int) $dados[$i]['Junho'] +
                 (int) $dados[$i]['Julho'] +
                 (int) $dados[$i]['Agosto'] +
                 (int) $dados[$i]['Setembro'] +
                 (int) $dados[$i]['Outubro']  +
                 (int) $dados[$i]['Novembro'] +
                 (int) $dados[$i]['Dezembro'];
        print "<tr>";
        print "<td>".$dados[$i]['Deposito']."</td>";
        print "<td style='text-align:center'>".$dados[$i]['Janeiro']."</td>"; 
        print "<td style='text-align:center'>".$dados[$i]['Fevereiro']."</td>"; 
        print "<td style='text-align:center'>".$dados[$i]['Marco']."</td>"; 
        print "<td style='text-align:center'>".$dados[$i]['Abril']."</td>"; 
        print "<td style='text-align:center'>".$dados[$i]['Maio']."</td>"; 
        print "<td style='text-align:center'>".$dados[$i]['Junho']."</td>"; 
        print "<td style='text-align:center'>".$dados[$i]['Julho']."</td>"; 
        print "<td style='text-align:center'>".$dados[$i]['Agosto']."</td>"; 
        print "<td style='text-align:center'>".$dados[$i]['Setembro']."</td>";
        print "<td style='text-align:center'>".$dados[$i]['Outubro']."</td>"; 
        print "<td style='text-align:center'>".$dados[$i]['Novembro']."</td>"; 
        print "<td style='text-align:center'>".$dados[$i]['Dezembro']."</td>";
        print "<td style='text-align:center;font-weight:bold;'>".$total."</td>";
        print "</tr>";   
        
    }
    

    ?>
    
 
</table>

</div>