 <!-- Left side column. contains the sidebar 
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less 
    <section class="sidebar">
      <!-- Sidebar user panel 
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?=$gravataremail;?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?=$pageSession['session']['seguranca']['nome_usuario'];?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- sidebar menu: : style can be found in sidebar.less 
      <ul class="sidebar-menu" data-widget="tree">
        <li class="">
        <?php
            print "<a href=\"?token=".hash('sha256', md5(VERSAO).date('dmY'))."&ac=etn&modulo=index&controller=index&action=index1e\"><i class=\"fa fa-home\"></i>&nbsp;&nbsp;&nbsp;<span>Início</span></a>";
        ?>
        
        <!-- Central de Ajuda 
        <li class="header">CENTRAL DE AJUDA</li>
        <li><a href="index.php?modulo=doc&controller=doc&action=index" title=""><i class="fa fa-book"></i><span>Ajuda do Sistema</span></a></li>

      </ul>
    </section>
    <!-- /.sidebar 
  </aside>