<?php session_start();
print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
include_once '../include.php';

$_conexao = new ConexaoMysql();

$_relatorio = new Relatorio();

/* a implementar opcao filtro relatrio de contrato */
//$_cpf          = isset($_GET['cpf'])          ? $_GET['cpf']          : "";
//$_id_motorista = isset($_GET['id'])           ? $_GET['id']           : "";
//$_num_contrato = isset($_GET['num_contrato']) ? $_GET['num_contrato'] : "";

$_situacao= isset($_POST['txtSituacao']) ? $_POST['txtSituacao']: "";
$_ano     = isset($_POST['txtAno'])   ? $_POST['txtAno']  : "";
$_ordem    = isset($_POST['rbOrdem']) ? $_POST['rbOrdem']: "";

if(strlen($_ano) == 0) {
 
 print("<script type='text/javascript'> alert('Por favor preencha o filtro ANO !'
                            ); history.back();</script>");
    
}else {

$dados = $_relatorio -> RelatorioGeralContratoResumido($_situacao, $_ano, $_ordem);

//var_dump($_POST);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php print TITULO; ?></title>

<link href="<?php print SISTEMA; ?>/css/bootstrap.css" rel="stylesheet">
<link href="<?php print SISTEMA; ?>/css/bootstrap-responsive.css" rel="stylesheet">
<link href="<?php print SISTEMA; ?>/css/impressaoNova.css" rel="stylesheet" media="print">
<style type="text/css">

    .rel {
        
        text-align: center;
        font-weight: bold;
        
    }

    @media print {
    
        .imprimir {
            display: none;
            
            
        }
        
    
    }
    
   
    
    
</style>


</head>
<body>
    <div class="container">
        <div class="span12 text-center imprimir"><a class="btn btn-primary" href="javascript:history.back();">Voltar</a></div>
        <div class="span12">
        <br>
        <legend>Resumo de Contratos de Pipeiros</legend>
        <table align="center" class="table table-condensed">
            <tr>
                <td class="rel">Nº Contr</td>
                <td class="rel">Motorista</td>
                <td class="rel">CPF</td>
                <td class="rel">Caminhao</td>
                <td class="rel">Capacidade M³</td>
                <td class="rel">Rota</td>
                <td class="rel">Situação</td>
            </tr>
            
            <?php
            
            $_total = count($dados);
            
            $pf = 0;
            $pj = 0;
            
                for ($i=0; $i < $_total; $i++) {
                    
                    if($dados[$i]['pessoa'] == "PF") {
                       
                       $pf++; 
                        
                    } else {
                        
                        $pj++;
                    }
                    
                    print "<tr>
                            <td>".$dados[$i]['num_contrato']."</td>
                            <td>".utf8_encode($dados[$i]['nome'])."</td>
                            <td>".$dados[$i]['cpf_cnpj']."</td>
                            <td>".$dados[$i]['placa']."</td>
                            <td style='text-align:center'>".$dados[$i]['capacidade']."</td>
                            <td>".$dados[$i]['rota']."-".$dados[$i]['numRota']."</td>
                            <td style='text-align:center'>".$dados[$i]['situacao']."</td>
                            </tr>";
                }
            ?>
                <tr>
                  <td colspan="7"><br></td>
                </tr>
            <tr>
              <td colspan="3">Total de Contratos: <?php print $_total;?></td>
              <td colspan="2">Total PF : <?php print $pf;?></td>  
              <td colspan="2">Total PJ : <?php print $pj;?></td>  
            </tr>
            
        </table>
        </div>
        <div class="span12 text-center">
            <?php print RODAPE; ?>
        </div>
    </div>

<script src="<?php print SISTEMA; ?>/js/jquery.js"></script>
    <script src="<?php print SISTEMA; ?>/js/bootstrap.js"></script>
    <script src="<?php print SISTEMA; ?>/js/jasny-bootstrap.js"></script>
    <script src="<?php print SISTEMA; ?>/js/funcaobase.js"></script>
</body>
</html>

<?php } ?>