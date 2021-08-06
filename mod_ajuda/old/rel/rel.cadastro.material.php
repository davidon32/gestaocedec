<?php session_start();
include_once '../include.php';

$_conexao = new ConexaoMysql();

$_login = new Login();

$_login->logado();

$_relatorioAjuda = new RelatorioAju();

$dados = $_relatorioAjuda->relCadastroMaterial($_POST['txt_dt_inicial'], $_POST['filtro']);

?>
<html>
<title><?php print TITULO; ?></title>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php print SISTEMA;?>/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="<?php print SISTEMA;?>/css/bootstrap-responsive.css" rel="stylesheet" media="screen">

<style>
    
    table td {
        
        font-size: 15px; 
    }
    
</style>

</head>
<body>

<div class="span12">
    <div class="span1">&nbsp;</div>
    <div class="span10">
        <div class="span10 text-center"><br><?php FuncaoBase::Imprimir(); print "&nbsp;&nbsp". FuncaoBase::voltar();?></div>
    <table class="table" id="" cellspacing="0" cellpadding="0">
        <tr>
            <td colspan="8"><legend>Relatório de Cadastro de Materials</legend></td>
        </tr>
        <tr>
            <td width="5%">Cod</td>
            <td width="10%">Material</td>
            <td width="10%">Data Entrada</td>
            <td width="15%">Origem</td>
            <td width="5%">Quantidade</td>
            <td width="15%">Dep Destino</td>
            <td width="10%">Validade</td>
            <td width="30%">Obs</td>
        </tr>
        
        <?php
        
            for ($i=0; $i < count($dados); $i++) {
                     
                $validade = $dados[$i]['validade'];

                print "<tr>
                        <td>{$dados[$i]['id_produto']}</td>
                        <td>{$dados[$i]['nome']}</td>
                        <td>".DataMysql::dataVisual($dados[$i]['dtEntradaSaida'])."</td>
                        <td>{$dados[$i]['origem']}</td>
                        <td>{$dados[$i]['quantidade']}</td>
                        <td>{$dados[$i]['depDestino']}</td>
                        <td>";
                        
                        
                        
                        if(strtotime($validade) < strtotime(date('Y-m-d'))){
                            
                          $validade = DataMysql::dataVisual($dados[$i]['validade']);
                                                     
                          print "<span style='color:red'>{$validade}</span>";  
                            
                        }else {
                         
                          print DataMysql::dataVisual($validade);   
                            
                        }
                        
                        print "</td>
                                <td>{$dados[$i]['obs']}</td>
                         </tr>";
            }

            
            ?>    
        
    </table>  
        </div>
   <div class="span1">&nbsp;</div>
   
</div>

</body>
</html>