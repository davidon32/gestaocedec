<!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?=$gravataremail;?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?=$pageSession['session']['seguranca']['nome_usuario'];?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="">
        <?php
            /* Acesso Compdec */
          if(isset($pageSession['session']['seguranca']['externo'])) {
            print "<a href=\"?token=".hash('sha256', md5(VERSAO))."&ac=etn&modulo=index&controller=index&action=index1e\"><i class=\"fa fa-home\"></i>&nbsp;&nbsp;&nbsp;<span>Início</span></a>";
            print '</li>';

            print "<!-- Central de Ajuda -->
              <li class=\"header\">CENTRAL DE AJUDA</li>
              <li><a href=\"?token=".hash('sha256', md5(VERSAO))."&modulo=doc&controller=doc&action=index\" title=\"\"><i class=\"fa fa-book\"></i><span>Ajuda do Sistema</span></a></li>
            </ul>";

          /* acesso cedec */
          }else {
            print "<a href=\"?token=".hash('sha256', md5(VERSAO))."&ac=itn&modulo=index&controller=index&action=index1\"><i class=\"fa fa-home\"></i>&nbsp;&nbsp;&nbsp;<span>Início</span></a>";
            print '</li>';
    
            print "<!-- Central de Ajuda -->
              <li class=\"header\">CENTRAL DE AJUDA</li>
              <li><a href=\"?token=".hash('sha256', md5(VERSAO))."&modulo=doc&controller=doc&action=index\" title=\"\"><i class=\"fa fa-book\"></i><span>Ajuda Sistema(Uso Interno)</span></a></li>
              <li><a href=\"?token=".hash('sha256', md5(VERSAO))."&modulo=doc&controller=doc&action=infra\" title=\"\"><i class=\"fa fa-book\"></i><span>Infraestrutura CA</span></a></li>
              <li><a href=\"?token=".hash('sha256', md5(VERSAO))."&modulo=doc&controller=doc&action=link\" title=\"\"><i class=\"fa fa-book\"></i><span>Links Úteis</span></a></li>
              <li><a href=\"?token=".hash('sha256', md5(VERSAO))."&modulo=doc&controller=doc&action=dicas\" title=\"\"><i class=\"fa fa-book\"></i><span>Dicas/Boas Práticas</span></a></li>
            </ul>";

            print "<!-- DOCUMENTAÇÃO EXTERNA -->
            <ul class=\"sidebar-menu\" data-widget=\"tree\">

              <li class=\"header\"><i class=\"fa fa-home\">DOC /PARA COMPDEC</i></li>
              <li><a href=\"?token=".hash('sha256', md5(VERSAO))."&modulo=doc&controller=doc&action=index\" title=\"\"><i class=\"fa fa-book\"></i><span>Ajuda Sistema(Uso do Compdec)</span></a></li>
            ";
          }
        ?>
    </section>
    <!-- /.sidebar -->
  </aside>