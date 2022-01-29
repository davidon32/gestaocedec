<?php include_once $_SERVER['DOCUMENT_ROOT'].'/core/include.php';

$id_deposito = isset($_GET['id']) ? $_GET['id'] :"";

$saldo = new ControleSaldo();

if(!empty($id_deposito)){

    
    $dados = $saldo->saldoPorDeposito($id_deposito);
    
    
    
    print "<br><p align=\"center\"><legend>Materiais Disponíveis Dep. Avançado de : ".Deposito::PegaNomeDeposito($id_deposito)."</legend></p>";
    print "<div class=\"col-md-3\"></div>";
    print "<div class=\"col-md-6\">";
    
    print "<table class=\"table table-bordered table-striped\">
                <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Saldo</th>
                <tr>";
    foreach ($dados as $key => $value) {
        print "<tr>
        <td>".($key+1)."</td>
        <td><a name='lk_material' data-id_material='".$value['id_unidade']."'>".$value['id_unidade']." - ".$value['nome']." - ".$value['descricao']."</a></td>
        <td>".$value['saldo']."</td>
        </tr>";
    }
    print "</table>";
    print "</div>";
    print "<div class=\"col-md-3\"></div>";
}
?>

<script>
    $("a[name='lk_material']").click(function(){
        var id_material = $(this).data('id_material'); 
        $("#id_produto").val(id_material).change();
    });

</script>
