<?php include_once PATH.'/core/include.php';
?>
<style>
    #div-icon{
        display: none;
    }

</style>
<?php include_once "template/page/headerPageSimples.php";?>
<?php
//$_conexao = new ConexaoMysql();

$_diario = new Diario();

/* id historico */
$_id_historico = isset($_GET['idh']) ? $_GET['idh'] : "";

$dados = $_diario->buscaHistorico($_id_historico);

?>

<body>
    <div class="container">
        <div class="row">
            <div><legend>Lançar Registro</legend></div>
            
            <form action="" method="POST" name="frm_cad_hist">
                <div class="col-md-6">
                    <label>Data</label>
                    <input type="text" class="form-control" name="txt_dt_diario" id="txt_dt_diario" value="<?php print DataMysql::dataVisual($dados['dt_diario']); ?>" disabled="disabled">
                </div>
                <div class="col-md-6">
                    <label>Historico</label>
                    <textarea rows="10" cols="25" class="form-control" name="txt_historico" id="txt_historico" placeholder="Digite o Histórico da Ocorrência" required maxlength="300"><?php print ($dados == "") ? " " : utf8_encode(trim($dados['historico'])); ?></textarea>
                </div>
                <div class="col-md-12">
                    <input type="submit" class="btn btn-primary" name="btn_enviar" id="btn_enviar" value="<?php print ($dados == "") ? "Adicionar" : "Alterar";?>" />
                </div>
            </form>
        </div>
        <div class="row text-center">
        <?php FuncaoBase::vifs('fechar'); ?></div>
  </div>
</body>
</html>

<?php

$_historico = isset($_POST['txt_historico']) ? $_POST['txt_historico'] : "";
$_btn_enviar = isset($_POST['btn_enviar']) ? true : "";

if ($_btn_enviar) {
    
    //* atualizar historico */
    if ($_diario -> atualizarHistorico($dados['dt_diario'], utf8_decode($_historico), $dados['hora'], $_id_historico)) {

        print "<script>";

        print "alert('Atualização com Sucesso !');";

        print "window.close();";

        print "</script>";

    }

}?>
