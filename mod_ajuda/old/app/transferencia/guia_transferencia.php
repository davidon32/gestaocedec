<?php session_start();
print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
include_once PATH.'/include.php';

$_conexao = new ConexaoMysql();

$_login = new Login();

$_login->logado();

$_login->Sessao();

//var_dump($_SESSION);

$id_transferencia = isset($_GET['id']) ? $_GET['id'] : "";

$_transferencia = new TransferenciaMaterial();

$dados = $_transferencia->guiaTransferencia($_id_transferencia);

var_dump($dados);


?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo TITULO; ?></title>
<link href="/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="<?php print SISTEMA;?>/js/funcaobase.js"></script>
</head>

<body>
    
<div class="container">
<table class="table">
    <tr>
        <td><img src="imagem/logo_gab.png"></td>
        <td><img src="imagem/cedec.png"></td>
    </tr>
    <tr>
        <td>
            <table class="table">
                <tr>
                    <td>Guia de Transferência de Materiais entre Depósitos Avançados</td>
                </tr>
                <tr>
                    <td>Data Transferência </td>
                    <td>:<?=date('d/m/Y')?></td>
                </tr>
                <tr>
                    <td>Nome Motorista</td>
                    <td>:<?=$dados[0]['motorista'];?></td>
                </tr>
                <tr>
                    <td>Veículo</td>
                    <td>:<?=$dados[0]['veiculo'];?></td>
                </tr>
                <tr>
                    <td>Placa</td>
                    <td>:<?=$dados[0]['placa'];?></td>
                </tr>
                <tr>
                    <td>Depósito Origem : <?=$dados[0]['depOrigem'];?></td>
                    <td>Depósito Destino : <?=$dados[0]['depDestino'];?></td>
                </tr>
                    
            </table>
            
            
        </td>
    </tr>
    <tr>
        <td>Materiais</td>
    </tr>
    <tr>
        <td>Rodape</td>
    </tr>
  
</table>

</div>