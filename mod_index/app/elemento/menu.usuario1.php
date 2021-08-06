<style>
    #opcoes {
        color:#FFFFFF;    
    }
</style>

<header class="main-header">
    <!-- Logo -->
    <a href="../../index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>SGE</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>CEDEC-MG</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 4 messages</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <!-- end message -->
                </ul>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">9</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="../../dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs">Alexander Pierce</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  Alexander Pierce - Web Developer
                  <small>Member since Nov. 2012</small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="#" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>



    <div style="width: 40%; float: left">      
        	<x-small>Sessão:&nbsp;<span id="sessao"></span></x-small><span style="width: 150px;">&nbsp;</span>
            <span><x-small><a href='release.txt'><?=VERSAO;?></a></x-small></span>
    </div>
    <div style="text-align: left; width: 10%;float: left;">
        </div>
        <div style="text-align: right; width: 40%;float: left;">
            <span style="text-align: right">
                <small style="float:">
                    <?=(isset($_SESSION['seguranca']['ex'])) ? "": "(".$_usuario->getNome($_SESSION['seguranca']['login']).")";?>
                </small>
                    &nbsp;&nbsp;&nbsp;&nbsp;
            </span>
        </div>
        <div style="text-align: left; width: 10%;float: left;">
            <div class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="opcoes" ><small>Opções</small></a> 
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" >
                        <?php if(isset($_SESSION['seguranca']['ex'])){
                        		print '<li><a href="/index.php?secao=login&acao=logoutEx" title="Logout do Sistema"><small>Logout</small></a></li>';
                        	}else {
                        		print '<li><a href="/index.php?secao=login&acao=logout" title="Logout do Sistema"><small>Logout</small></a></li>';
                        	}
                        ?>
                        	
                        <li><a href="/index.php?secao.php?secao=login&acao=recsenha" title="Trocar a Senha do Usuário"><small>Troca de Senha</small></a></li>
                        <li><a href="/index2.php?secao=usuario&acao=user" title="Dados do Usuário"><small>Dados do Usuário</small></a></li>
                        </ul>
                    </div>
        </div>
<?php
    //var_dump($_SESSION);
    
    //var_dump($_usuario->getEmailFuncionario($_SESSION['seguranca']['id_funcionario']));
        
        //if($_SESSION['seguranca']['login'] != null) {

           /* print "<div class=\"span9 text-left\">
                        <small>".$_usuario->getNome($_SESSION['seguranca']['login'])."</small><br>
                        ".Gravatar::GeraGravatar($_usuario->getEmailFuncionario($_SESSION['seguranca']['id_funcionario']))."
                        
                  </div>";
            print "<div class='span3'>
                    <table align='right'>
                        <tr>
                            <td><small>Data :</small></td>
                            <td><small>".date('d/m/Y')."</small></td>
                        </tr>
                        <tr>
                            <td><small>Hora :</small></td>
                            <td><small>".date("H:i:s")."</small></td> 
                        </tr>
                        <tr>
                            <td colspan='2' align='left'>
                                <div class=\"dropdown\">
                                <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\"><small>Opções</small></a> 
                                    <ul class=\"dropdown-menu\" role='menu' aria-labelledby='dropdownMenu' >
                                        <li><a href=\"/index.php?secao=login&acao=logout\" title=\"Logout do Sistema\"><small>Logout</small></a></li>
                                        <li><a href=\"/index.php?secao.php?secao=login&acao=recsenha\" title=\"Trocar a Senha do Usuário\"><small>Troca de Senha</small></a></li>
                                    </ul>
                                 </div>
                            </td>
                         </tr>
                    </table>            
                   </div>";
                        

            }
            */