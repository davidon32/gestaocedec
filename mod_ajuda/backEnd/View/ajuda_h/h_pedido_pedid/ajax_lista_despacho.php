<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/core/include.php';

$id_pedido = isset($_GET['id']) ? $_GET['id'] : $view[0]['id'];


$despachos = H_pedido_an_tecajuda_hModel::listaDespacho($id_pedido);

?>
<table class="table table-condensed table-bordered">
                        <tr>
                            <th>#</th>
                            <th>Data</th>
                            <th>Analista</th>
                            <th>Seção</th>
                            <th>Despacho</th>
                            <th>Parecer</th>
<!--                            <th>Opções</th>-->
                        </tr>
<?php
foreach ($despachos as $key => $despacho) {
    $dadosUsuario = Usuario::getDadoUsuario($despacho['id_usuario']);
    $parecer_sit = "";
    if( $despacho['parecer_sit'] == 1 ) {
        $parecer_sit = "Favorável";
    } elseif ( $despacho['parecer_sit'] == 0 ) {
        $parecer_sit = "Desfavorável";
    } elseif (  $despacho['parecer_sit'] == 2 ){
        $parecer_sit = "Enviado p/ Analise";
    }

    print "<tr>";
    print "<td>" . ($key + 1) . "</td>";
    print "<td>" . DataMysql::dataCompletaVisual($despacho['data_parecer']) . "</td>";
    print "<td>" . $dadosUsuario['nome'] . "</td>";
    print "<td>" . $dadosUsuario['secao']. "</td>";
    print "<td>" . $despacho['parecer'] . "</td>";
    print "<td>" . $parecer_sit. "</td>";
    //print "<td><a href=''><img width='20px' src='/core/imagem/editar.png'></td>";
    print "</tr>";
}
?>
</table>
