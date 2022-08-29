<?php include_once PATH . '/core/include.php'; ?>
<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_ajuda/Model/indexModel.php"; ?>

<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>

<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>

<br>

<div class="row">
    <div class="col-md-12">
        <!-- Pedido Cesta -->
        <div class="col-md-6">
            
            <!--####################### PEDIDO DE AJUDA HUMANITARIO ###########################-->
            <?php
            $permissao = Usuario::getPermissao('cedec_usuario', 'it_m_registro');
            if ($permissao == "1") {
            ?>
                
            <form action="#" method="POST" name="frmRegistra" id='frmRegistro'>
                <label>Data de Lancamento</label>
                <input class='form form-control' type="date" name="desabrigados" id="desabrigados">
                
                <label>Números de Desabrigados :</label>
                <input class='form form-control' type="number" name="desabrigados" id="desabrigados">
                <br>
                <label>Números de Desabrigados :</label>
                <input class='form form-control' type="number" name="desabrigados" id="desabrigados">
                <br>
                <input class='btn btn-success' type="submit" name="btnGravar" id="btnGravar" value="Gravar">
                
            </form>
          <?php 
         }
         ?>
        </div>


        <div class="col-md-6 text-center">
            <legend>Últimos Registros</legend>
            
           
        </div>

        

    </div>

</div>

<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>