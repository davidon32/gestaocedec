<?php session_start();
include_once '../include.php';

$_conexao = new ConexaoMysql();

$_relatorioProcesso = new RelatorioProcesso();

$dados = $_relatorioProcesso->status();

$dado_reconhecido = $_relatorioProcesso->reconhecido();

var_dump($dados);

?>

<br>

<table border="1">
    <tr>
        <td colspan="4" align="center">Resumo Status Processos</td>
    </tr>
    <tr>
        <td>Total Siga</td>
        <td>Total Homologado</td>
        <td>Total Arquivado</td>
        <td>Total Análise</td>
    </tr>
    <tr>
        <td align="center"><?php print $dados[0]['status']; ?></td>
        <td align="center"><?php print $dados[1]['status']; ?></td>
        <td align="center"><?php print $dados[2]['status']; ?></td>
        <td align="center"><?php print $dados[3]['status']; ?></td>
    </tr>
</table>
<br>
<table border="1">
    <tr>
        <td colspan="2" align="center">Status Reconhecimento</td>
    </tr>
    <tr>
        <td>Reconhecido</td>
        <td>Não Reconhecido</td>
        
    </tr>
    <tr>
        <td align="center"><?php print $dado_reconhecido[0]['stat_reconhecido']; ?></td>
        <td align="center"><?php print $dado_reconhecido[1]['stat_reconhecido']; ?></td>
        
    </tr>
</table>
