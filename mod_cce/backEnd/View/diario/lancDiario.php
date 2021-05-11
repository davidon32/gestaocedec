<?php include_once PATH.'/core/include.php';?>
<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_cce/Model/Model.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<style>
    #div-icon{
        display: none;
    }

</style>
<?php include_once "template/page/headerPageSimples.php";?>
<?php

$_diario = new Diario();

/* id do diario */
$_id_diario = isset($_GET['idd']) ? $_GET['idd'] : "";

/* turno para o primeiro registro */
$_turno = isset($_GET['p']) ? $_GET['p'] : ""; 

# id historico alteraçao de lançamento de historico
$_id_historico = isset($_GET['idh']) ? $_GET['idh'] : "";

$_complemento = isset($_GET['n']) ? $_GET['n'] : "";

$_dados = $_diario->buscaDiarioId($_id_diario);

?>

<body>
    <div class="col-md-12">
        <div class="row">
            <div><legend>Lançar Registro</legend></div>

            <form action="" method="POST" name="frm_cad_hist" id="frm_cad_hist">
                <div class="col-md-6">
                    <label>Data</label>
                    <input type="text" class="form-control" name="txt_dt_diario" id="txt_dt_diario" value="<?php print DataMysql::dataVisual($_dados['dt_diario']); ?>" disabled="disabled">
                </div>
                <div class="col-md-6">
                    <label>Historico</label>
                    <textarea rows="10" cols="25" class="form-control" name="txt_historico" id="txt_historico" placeholder="Digite o Histórico da Ocorrência" required maxlength="200"></textarea>
                </div>
                <div class="col-md-6">
                    <input type="submit" class="btn btn-primary" name="btn_enviar" id="send" value="Adicionar" />
                </div>
            </form>
        </div>
        <div class="row text-center">
        <?php FuncaoBase::vifs('fechar'); ?></div>

</body>
</html>
<?php include_once "template/page/rodapePagePopup.php";?>

<?php

    $_historico =  isset($_POST['txt_historico']) ? $_POST['txt_historico'] : "";
    $_btn_enviar = isset($_POST['btn_enviar']) ? true : "";

if ($_btn_enviar) {
   
    $_id_funcionario = $pageSession['session']['seguranca']['idUser'];
    
    $_getNum = $_diario->getNumLancDiario($_dados['dt_diario'], $_id_diario);
    
    /* numero sequencial lancamento historico do diário */
    $_num = ($_getNum == 0) ? 1: $_getNum + 1;
        
    /* proximo numero seq historico lancamento diario */
    //$_prox_num = $_num + 1;
    
    /* inclusao de historico diario */        
    if(($_id_historico == "") && ($_complemento == "")) {
        
        $agora = AGORA;
        $hoje = HOJE;
        /* inclusao de historico em data posterior a hoje*/    
        if($hoje != DataMysql::dataVisual($_dados['dt_diario'])) {
          
           if ($_diario -> lancaHistorico($_dados['dt_diario'], utf8_decode($_historico), $_id_funcionario, $agora, $_num, null, DataMysql::dataForm($hoje), $_turno, $_id_diario)) {

            print "<script>";

            print "alert('Lançamento com Sucesso !-');";
            
            print "window.close();";

            print "</script>";
        }     
            
        }else {
            
            
            if ($_diario -> lancaHistorico($_dados['dt_diario'], $_historico, $_id_funcionario, $agora, $_num, null, null, $_turno, $_id_diario)) {

            print "<script>";

            print "alert('Lançamento com Sucesso !');";
            
            print "window.close();";

            print "</script>";
        }
                
            
        }    
        

    /* adicona sub item de registro de diario */
    }else if (($_id_historico != "") && ($_complemento != "")){
            
        $dados = $_diario -> pesquisaHistorico($_id_historico);
            
        $dados['historico'] = "";
        
        $_prox_num_sub = (int)$_diario->getSubNum($_complemento, $dados['id_diario']);
        /* numero do sub lancamento */

        if ($_diario -> lancaHistorico($dados['dt_diario'], utf8_decode($_historico), $_id_funcionario, AGORA, $_complemento, $_prox_num_sub, date('Y-m-d'), $dados['turno'], $_id_diario)) {
    
            print "<script>";
    
            print "alert('Lançamento com Sucesso !');";
            
            print "window.close();";
    
            print "</script>";
        }

            
   }

        

    }


?>
