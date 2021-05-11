<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header print">
      <h1>
       
          <small><?=($_GET['controller'] != 'almoxarifado') ? ucfirst($_GET['controller']) : 'Armazém';?></small>
      </h1>
      <ol class="breadcrumb">
          
          <?php
            if(isset($_COOKIE['seguranca']['externo'])) {
                print "<li><a href=".FuncaoBase::geraLink("index", "index", "index1e")."><i class=\"fa fa-dashboard\"></i> Home</a></li>";
                print "<li><a href=".FuncaoBase::geraLink("index", "index", "menue")."><i class=\"fa\"></i> Menu</a></li>";
            }else {
                print "<li><a href=".FuncaoBase::geraLink("index", "index", "index1")."><i class=\"fa fa-dashboard\"></i> Home</a></li>";
                print "<li><a href=".FuncaoBase::geraLink("index", "index", "menu")."><i class=\"fa\"></i> Menu</a></li>";
            }
            ?>
        <li class="active "><?=($_GET['controller'] == "almoxarifado" ? "Armazém" : $_GET['controller']);?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border print">
            <h3 class="box-title"><?= $this->Contexto($_GET['action'])?></h3>

          <!--<div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>-->
        </div>
        <div class="box-body">
          <?php #include_once('mod_'.$modulo.'/app/'.$secao."/index.php");?>