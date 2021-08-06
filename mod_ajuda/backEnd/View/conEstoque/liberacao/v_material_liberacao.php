<?php include_once PATH.'/core/include.php';?>
<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_ajuda/Model/indexModel.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPageSimples.php";?>
<style>

    table th, td {
        text-align:center;
    }
    p {
        text-align:center;
    }
</style>

<?php
$_id_liberacao = isset($_GET['id']) ? $_GET['id'] : "";

if(!empty($_id_liberacao)) {
    $dados = Liberacao::listaProdutos($_id_liberacao);
}

?>

<div class="col-md-2"></div>
<div class="col-md-8 text-center">
    <br><br>
    <a class="btn btn-info" onclick="history.back();">Voltar</a>
    <br><br>
    <p><legend>Materiais da liberação nº: <?=$dados[0]['id_liberacao'];?></legend></p>
    <table class='table table-bordered table-striped'>
        <tr>
            <td width='150'><small>Nome Produto</small></td>
            <td><small>Descricao<small></td>
            <td><small>Quantidade</small></td>
        </tr>
        <?php 

foreach ($dados as $key => $value) {
    print "<tr>
    <td>".Produto::PegaNomeProduto($value['cod'])."</td>
    <td>".$value['descricao']."</td>
    <td>".$value['quantidade']."</td>
    </tr>";
}
?>
    </table>
</div>
<div class="col-md-2"></div>