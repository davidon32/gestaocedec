<?php include_once PATH . '/core/include.php'; ?>
<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_admin/Model/indexModel.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";

$percAtualizados = ($dados['atualizado'] /853) *100;

$percDesatualizados = ($dados['desatualizados'] /853) *100;

$possuicompdec = $dados['possuiCompdec'];

?> 
<div class="row">
    <div class="col-md-12">
    <legend>DASHBOARD - </legend>
        <div class="col-md-3 col-sm-3 col-xs-6">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Atualizados</span>
              <span class="info-box-number"><?=$dados['atualizado']?><small>/853</small></span>
              <span class="info-box-number"><?=floor($percAtualizados);?><small>%</small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-3 col-xs-6">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="ion ion-ios-gear-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Desatualizados</span>
              <span class="info-box-number"><?=$dados['desatualizados']?><small>/853</small></span>
              <span class="info-box-number"><?=ceil($percDesatualizados);?><small>%</small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-3 col-xs-6">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-gear"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Possui Compdec</span>
              <span class="info-box-number"><?=$possuicompdec;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-3 col-xs-6">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-gear-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Sem Compdec</span>
              <span class="info-box-number"><?=(853-$possuicompdec) ;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

    </div>
</div>

