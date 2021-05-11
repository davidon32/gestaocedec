<?php session_start();
include_once "../include.php";

$_conexao = new ConexaoMysql();

$_contrato = new Contrato();
         
    $nome   = isset($_POST['txtNome']) ? $_POST['txtNome'] : "";
    $placa  = isset($_POST['txtPlaca'])  ? $_POST['txtPlaca']  : "";
    $ano    = isset($_POST['txtAno'])    ? $_POST['txtAno']    : "";
    $btnEnviar = isset($_POST['btnEnviar']) ? true : false;
                    
    if($btnEnviar) {
                           
        $dados = $_contrato->buscaContrato($nome, $placa, $ano); 
                                                                                 
    }
                    
//var_dump($dados);

?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php print TITULO; ?></title>
<link href="<?php print SISTEMA; ?>/css/bootstrap.css" rel="stylesheet" >
<link href="<?php print SISTEMA; ?>/css/bootstrap-responsive.css" rel="stylesheet" >
</head>
<body>
    <div class="container">
        <div class="span12">


<?php

print "<table class=\"table table-bordered\">
        <tr>
            <td colspan='4'><legend>Cadastro de Contratos</legend></td>
        </tr>";



for ($i=0; $i < count($dados) ; $i++) {
    
        print "
            <tr>
                <td width=\"20%\"><b>Nº Contrato/Ano</b></td>
                <td width=\"50%\">".$dados[$i]['num_contrato']."/".$dados[$i]['anoContrato']."</td>
                <td width=\"15%\"><b>Data</b></td>
                <td width=\"15%\">".DataMysql::dataVisual($dados[$i]['data_contrato'])."</td>
            </tr>
            <tr>
                <td><b>Nome</b></td>
                <td>".utf8_encode($dados[$i]['nome'])."</td>
                <td><b>CPF</b></td>
                <td>".$dados[$i]['cpf_cnpj']."</td>
            </tr>
            <tr>
                <td><b>PIS/NIT</b></td>
                <td>".$dados[$i]['pis_pasep']."</td>
                <td><b>Momento</b></td>
                <td>".$dados[$i]['momento']."</td>
            </tr>
            <tr>
                <td><b>Nome Rota</b></td>
                <td>".$dados[$i]['nome_rota']."</td>
                <td><b>Nº Rota</b></td>
                <td>".$dados[$i]['num_rota']."</td>
            </tr>
            <tr>
                <td><b>Placa</b></td>
                <td>".$dados[$i]['placa']."</td>
                <td><b>Capacidade</b></td>
                <td>".$dados[$i]['capacidade']."</td>
            </tr>
            <tr>
                <td><b>Mae</b></td>
                <td colspan=\"3\">".utf8_encode($dados[$i]['mae'])."</td>
            </tr>
            <tr>
                <td><b>Pai</b></td>
                <td colspan=\"3\">".utf8_encode($dados[$i]['pai'])."</td>
            </tr>
            <tr>
                <td><b>Empenho nº</b></td>
                <td>".$dados[$i]['num_empenho']."</td>
                <td><b>Data Empenho</b></td>
                <td>".DataMysql::dataVisual($dados[$i]['dt_empenho'])."</td>
            </tr>
            <tr>
                <td><b>Obsevações<b></td>
                <td colspan='3'>".$dados[$i]['obs']."</td>
            </tr>";
     
            }
  
 
?>
</table>
</div>
</div>
</body>
</html>