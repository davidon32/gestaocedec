<?php include_once PATH.'/core/include.php';?>
<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_compdec/Model/Model.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php include_once "template/page/menu.php"; ?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";

$_funcaBase = new FuncaoBase();

$_compdec = new Compdec();

$_relatorioCompdec = new RelatorioComdec();

$_associacao = new Associacao();

$_regiao = new Regiao();

$_rb_filtro      = isset($_REQUEST['rb_filtro'])      ? utf8_decode($_REQUEST['rb_filtro']) : "" ;
$_sel_associacao = isset($_REQUEST['sel_associacao']) ? utf8_decode($_REQUEST['sel_associacao']) : "";
$_sel_regiao     = isset($_REQUEST['sel_regiao'])     ? utf8_decode($_REQUEST['sel_regiao']) : "";
$_btn_enviar     = isset($_REQUEST['btnEnviar'])     ? true : false;

?>

<body>


    <form action="<?=FuncaoBase::geraLink("compdec", "compdec", "enviaEmail")?>" method="POST" name="frmEnviaEmail" id="frmEnviaEmail" enctype="multipart/form-data">
    
        <label>Opção</label><br>
    <input type="checkbox" value="0" name="rb_filtro" id="rb_existente">Todos Compdec's<br>
    <br>
    
    <label>Assunto</label>
    <input class="form form-control" type="text" name="txtAssunto" id="txtAssunto" maxlength="100">
    <br>
    <label>Mensagem</label>
    <textarea class="form form-control" name="textMensagem" id="textMensagem" maxlength="255" cols="10" rows="10"></textarea>
    <span style="font-size: 8pt">&nbsp;&nbsp;Caracteres :  </span><span id="spCaracter"></span>
    <br>
    <br>
    <label>Anexo</label>
    <input class="form form-control" type="file" name="fileAnexo" id="fileAnexo">
    <br>
    <input class="btn btn-primary" type="submit" name="btnEnviar" id="btnEnviar" value="Enviar">
    <br>
    <br>
           
    
    
</form>


<?php 

$assunto  = isset($_POST['txtAssunto']) ? $_POST['txtAssunto'] : "";
$mensagem = isset($_POST['txtAssunto']) ? $_POST['txtAssunto'] : "";
$opcao    = isset($_POST['rb_filtro'])  ? $_POST['rb_filtro'] : "";


if(($opcao == "0") && ($_btn_enviar)){

    $destinatario = RelatorioComdec::emailCompExist();
 
    Email::emailLote($destinatario, $assunto, $mensagem);
}

$_funcaBase->vifs("volta", "?token=".hash('sha256', md5(VERSAO).date('dmY'))."&ac=itn&modulo=compdec&controller=compdec&action=email");
    print "&nbsp;&nbsp;&nbsp;";
?>

<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>
<script type="text/javascript">

    $(document).ready(function(){
        
        $("#txtAssunto").blur(function(){
            
           if($("#txtAssunto").val().length < 10){
               alert("O Assunto deve conter mais caracteres !");
               $("#btnEnviar").hide();
           } else {
               $('#btnEnviar').show();
           }

        });
        
        $("#textMensagem").blur(function(){
            
           if($("#textMensagem").val().length < 10){
               alert("A Mensagem deve conter mais caracteres !");
               $("#btnEnviar").hide();
           } else {
               $('#btnEnviar').show();
           }
            
        });

        $("#textMensagem").keyup(function(){

            var num = $("#textMensagem").val().length;
       
            $("#spCaracter").text(num);
            
        });
   
    });
    
</script>

