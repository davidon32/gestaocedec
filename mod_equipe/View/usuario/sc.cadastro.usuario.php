<?php session_start();
print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
 include_once '../include.php';

$_conexao = new ConexaoMysql();

$_login = new Login();

$_usuario = new Usuario();

$_login->logado();

$_funcionario = new EquipeFuncionario();



?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php print TITULO;?></title>
<link href="<?php print SISTEMA;?>/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="<?php print SISTEMA;?>/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
</head>

<body onload="esconde()">
  <div class="container">
    <div class="row-fluid text-center">
        <img src="../imagem/topo_ajuda.png" />
        <hr>
      </div>

      <!-- BARRA -->
      <div class="row-fluid">
        <div class="span6 text-left"><small><?php print "Data :".date("d/m/Y");?></small></div>
        <div class="span6 text-right"><small><?php print "Hora :".date("H:i:s");?></small></div>
      </div>
    
      <!-- LOGOUT -->
      <div class="row-fluid text-right">
        <a class="btn btn-primary" href="<?php print SISTEMA;?>/core/logout.php?logout=s" title="Fazer logout do sistema">Logout</a>
        <p>
        <hr>
      </div>

      <!-- MENU -->
      <div class="row-fluid">
          <div class="span3">
              <?php include_once '../administrator/menu.adm.php';?>
          </div>
          
          
            <!-- CORPO -->
            <div class="span5">

               <legend>Cadastro Usuário</legend>
              <!--<form action="valida.cadastro.usuario.php" method="post" name="" id="">-->
              <form action="#" method="POST" name="frm_cad_usuario" id="frm_cad_usuario">

              <table>

                  <tr>
                    <td>Nome:</td>
                    <td><?php $_funcionario->ComboFuncionarioSemUsuario();?>
                        
                        <input type="hidden" name="nome" class="campo" size="40" ></td><td></td>
                  </tr>
                  
                  <tr>
                    <td>Login:</td>
                    <td><input type="text" name="txt_login" class="campo" size="40" ></td><td></td>
                  </tr>
                  <tr>
                    <td>CPF</td>
                    <!-- SENHA -->
                    <td><input type="text" name="cpf" class="campo" onblur="valida()" data-mask="999.999.999-99"></td>
                  </tr>
                  <tr>
                    <td>email:</td>
                    <td><input type="text" name="email" class="campo" size="40" onblur="valida()"></td><td><label class="msg">Campo não</label></td>
                  </tr>
                  <tr>
                  	<td>Depósito:</td>
                  	<td><?php Deposito::PegaDeposito();?></td>
                  </tr>
                  <tr>
                  	<td>Nível:</td>
                  	<td><select name="nivel">
                  			<option></option>
                  			<option value="3">Administrador</option>
                  			<option value="2">Gerente</option>
                  			<option value="1">Usuário</option>
                  			<option value="0">Dep.Avançado</option>
                  		</select>
                  	</td>
                  </tr>
                  <tr>
                  	<td>Situação:</td>
                  	<td><select name="situacao">
                  			<option></option>
                  			<option value="1">Ativo</option>
                  			<option value="0">Inativo</option>
                  	</select></td>
                  </tr>
                  <tr>
                    <td>Usuario Adm.</td>
                    <td><input type="checkbox" name="ckUsuarioAdmin" id="ckUsuarioAdmin" value="1" title="Usuario Administrativo"/></td>
                  </tr>
                 
                 </table>
                 <br />

         	
        	<div class="center">
         		<input type="submit" name="enviar" id="enviar" value="Cadastrar" class="btn btn-primary"/>
        	</div>
          		
          		
            
         </form>

              <?php

                #@ nome do usuario 
                $_nome         = isset($_POST['selNomeFuncionario'])        ? $_funcionario->getFuncionarioId($_POST['selNomeFuncionario'])        : "";

                #@ identificador do funcionario
                $_id_funcionario = isset($_POST['selNomeFuncionario']) ? $_POST['selNomeFuncionario'] : ""; 
                
                #@ login de usuario
                $_loginUsuario        = isset($_POST['txt_login'])       ? $_POST['txt_login']       : "";
                
                #@ cpf 
                $_cpf          = isset($_POST['cpf'])         ? $_POST['cpf']         : "";

                $_senha        = md5("cedec199"); //1a9686a9a911d36609e50c31e79d0e0e
                
                #@ email
                $_email        = isset($_POST['email'])       ? $_POST['email']       : "";
                
                #@ identificador do deposito
                $_id_deposito  = isset($_POST['id_deposito']) ? $_POST['id_deposito'] : "";

                #@ nivel de acesso usuario
                $_nivel        = isset($_POST['nivel'])       ? $_POST['nivel']       : 0;

                #@ situacao do usuario
                $_situacao     = isset($_POST['situacao'])    ? $_POST['situacao']    : 0;
                
                #@ Usuario Administrativo
                $usuarioAdmin  = isset($_POST['ckUsuarioAdmin'])    ? $_POST['ckUsuarioAdmin']    : 0;
                
                #@ modulos
                $_m_deposito   = isset($_POST['ajuda'])       ? $_POST['ajuda']       : 0;
                $_m_pipa       = isset($_POST['pipa'])        ? $_POST['pipa']        : 0;
                $_m_cce        = isset($_POST['cce'])         ? $_POST['cce']         : 0;
                $_m_decretacao = isset($_POST['decretacao'])  ? $_POST['decretacao']  : 0;
                $_m_comdec     = isset($_POST['comdec'])      ? $_POST['comdec']      : 0;
                $_m_apoio      = isset($_POST['apoio'])       ? $_POST['apoio']       : 0;
                $_m_poco       = isset($_POST['poco'])        ? $_POST['poco']        : 0;
                $_m_escola     = isset($_POST['escola'])      ? $_POST['escola']      : 0;
                $_trsenha      = 1;
                
                //var_dump($_POST);
          
                if($_nome != "" && $_loginUsuario != ""){

                //var_dump($_POST);
            
                  if($_usuario->CadastraUsuarioCedec($_id_deposito,
                                                                      $_nome,
                                                                      $_senha,
                                                                      $_email,
                                                                      $_nivel,
                                                                      $_situacao,
                                                                      $_loginUsuario,
                                                                      $_m_deposito,
                                                                      $_m_pipa,
                                                                      $_m_cce,
                                                                      $_m_decretacao,
                                                                      $_m_comdec,
                                                                      $_m_apoio,
                                                                      $_m_poco,
                                                                      $_m_escola,
                                                                      $_trsenha,
                                                                      $_cpf,
                                                                      $_id_funcionario,
                                                                      $usuarioAdmin)){ 
           
                  
                    FuncaoBase::alert('Cadastro Realizado Com Sucesso !!');
                    
                    print "<legend>Módulos</legend>
                        <table align=\"center\" border=\"0\">
                          <tr>
                            <td align=\"left\">Ajuda Humanitária</td>
                            <td><input type=\"checkbox\" name=\"ajuda\" id=\"ck_ajuda\" value=\"1\" onchange=\"permissao();\"></td>
                            <td align=\"left\">Pipa</td>
                            <td><input type=\"checkbox\" name=\"pipa\" id=\"ck_pipa\" value=\"1\" onchange=\"permissao();\"></td>
                          </tr>
                          <tr>
                            <td>Decretos</td>
                            <td><input type=\"checkbox\" name=\"decretacao\" id=\"ck_decretacao\" value=\"1\" onchange=\"permissao();\"></td>
                            <td>Poço Artesiano</td>
                            <td><input type=\"checkbox\" name=\"poco\" id=\"ck_poco\" value=\"1\" onchange=\"permissao();\"></td>
                          </tr>
                          <tr>
                            <td>Equipe de Apoio</td>
                            <td><input type=\"checkbox\" name=\"apoio\" id=\"ck_apoio\" value=\"1\" onchange=\"permissao();\"></td>
                            <td>Escola de Defesa Civil</td>
                            <td><input type=\"checkbox\" name=\"escola\" id=\"ck_escola\" value=\"1\" onchange=\"permissao();\"></td>
                          </tr>
                          <tr>
                            <td>Comdec</td>
                            <td><input type=\"checkbox\" name=\"comdec\" id=\"ck_compdec\" value=\"1\" onchange=\"permissao();\"></td>
                            <td>CCE</td>
                            <td><input type=\"checkbox\" name=\"cce\" id=\"ck_cce\" value=\"1\" onchange=\"permissao();\"></td>
                          </tr>
                          
                        </table>

                        <table>
                          <tr>
                            <td><a class=\"btn window\" id=\"btn_permajuda\" href=\"../secao.php?secao=usuario&acao=aju_permissao&usuario=".$_loginUsuario."\">Permissão Módulo Ajuda</a></td>
                          </tr>

                          <tr>
                            <td><a class=\"btn window\" id=\"btn_permpipa\" href=\"../secao.php?secao=usuario&acao=pip_permissao&usuario=".$_loginUsuario."\">Permissão Módulo Pipa</a></td>
                          </tr>

                          <tr>
                            <td><a class=\"btn window\" id=\"btn_permdecretacao\" href=\"../secao.php?secao=usuario&acao=dec_permissao&usuario=".$_loginUsuario."\">Cadastro Permissão Decretação</a></td>
                          </tr>

                          <tr>
                            <td><a class=\"btn window\" id=\"btn_permpoco\" href=\"../secao.php?secao=usuario&acao=poc_permissao&usuario=".$_loginUsuario."\">Permissão Módulo Poço</a></td>
                          </tr>

                          <tr>
                            <td><a class=\"btn window\" id=\"btn_permapoio\" href=\"../secao.php?secao=usuario&acao=apo_permissao&usuario=".$_loginUsuario."\">Permissão Módulo Apoio</a></td>
                          </tr>

                          <tr>
                            <td><a class=\"btn window\" id=\"btn_permescola\" href=\"../secao.php?secao=usuario&acao=esc_permissao&usuario=".$_loginUsuario."\">Permissão Módulo Escola</a></td>
                          </tr>

                          <tr>
                            <td><a class=\"btn window\" id=\"btn_permcompdec\" href=\"../secao.php?secao=usuario&acao=com_permissao&usuario=".$_loginUsuario."\">Permissão Módulo Compdec</a></td>
                          </tr>

                          <tr>
                            <td><a class=\"btn window\" id=\"btn_permcce\" href=\"../secao.php?secao=usuario&acao=cce_permissao&usuario=".$_loginUsuario."\">Permissão Módulo CCE</a></td>
                          </tr>
                        </table>";
                  
                  }else{

                    print "<script type=\"text/javascript\">";

                    print "alert('Erro ao Cadastrar Usuários !');";

                    print "</script>";
                  }
                }
        ?>
      </div>
      </div>
      <div class="span12 text-center">
        <small><?php print RODAPE;?></small>
      </div>

  </div>
<script src="<?php print SISTEMA;?>/js/jquery.js"></script>
<script src="<?php print SISTEMA;?>/js/bootstrap.js"></script>
<script src="<?php print SISTEMA;?>/js/jasny-bootstrap.js"></script>
<script type="text/javascript">

  function esconde(){

    $(".msg").hide();
    $("#btn_permajuda").hide();
    $("#btn_permpipa").hide();
    $("#btn_permdecretacao").hide();
    $("#btn_permpoco").hide();
    $("#btn_permapoio").hide();
    $("#btn_permescola").hide();
    $("#btn_permcompdec").hide();
    $("#btn_permcce").hide();
    
    }

  function valida() {
    if ($(".campo").val() == "") {

      $(".msg").show();
    }else {
      $(".msg").hide();

    }
  }

  function permissao() {

    /* ajuda Humanitaria */
    if($("#ck_ajuda").is(":checked")){
        
        $("#btn_permajuda").show("slow");
   
      }else if($("#ck_ajuda").attr("checked",false)){
        
        $("#btn_permajuda").hide("slow");
        
      } 

      /* pipa */
    if($("#ck_pipa").is(":checked")){
      
      $("#btn_permpipa").show("slow");
   
    }else if($("#ck_pipa").attr("checked",false)){
      
      $("#btn_permpipa").hide("slow");
      
    } 

    /* decretação */
     if($("#ck_decretacao").is(":checked")){
      
      $("#btn_permdecretacao").show("slow");
   
    }else if($("#ck_decretacao").attr("checked",false)){
      
      $("#btn_permdecretacao").hide("slow");
      
    } 

    /* poço */
     if($("#ck_poco").is(":checked")){
      
      $("#btn_permpoco").show("slow");
   
    }else if($("#ck_poco").attr("checked",false)){
      
      $("#btn_permpoco").hide("slow");
      
    } 

    /* apoio */
     if($("#ck_apoio").is(":checked")){
      
      $("#btn_permapoio").show("slow");
   
    }else if($("#ck_apoio").attr("checked",false)){
      
      $("#btn_permapoio").hide("slow");
      
    }

    /* escola */
     if($("#ck_escola").is(":checked")){
      
      $("#btn_permescola").show("slow");
   
    }else if($("#ck_escola").attr("checked",false)){
      
      $("#btn_permescola").hide("slow");
      
    }  

    /* compdec*/
     if($("#ck_compdec").is(":checked")){
      
      $("#btn_permcompdec").show("slow");
   
    }else if($("#ck_compdec").attr("checked",false)){
      
      $("#btn_permcompdec").hide("slow");
      
    } 

    /* cce */
     if($("#ck_cce").is(":checked")){
      
      $("#btn_permcce").show("slow");
   
    }else if($("#ck_cce").attr("checked",false)){
      
      $("#btn_permcce").hide("slow");
      
    } 
  }

      ﻿$(document).ready(function()
        {

          /* Quando algum hyperlink com a classe "window" for clicado */

          $('a.window').click(function()
          {
            var dimensions = (this.rel) 
              ? this.rel
              : '660x600';
            dimensions = dimensions.split('x');
            var width = dimensions[0];
            var height = dimensions[1];
            var bWindow = window.open(this.href, this.id, 'width=' + width + ',height=' + height + ',left=' + (((screen.width - width) / 2) - 20) + ',top=' + (((screen.height - height) / 2) - 20) + ',scrollbars=yes,resizable=yes,toolbars=no');
            bWindow.focus();
            return false; 
          });
        });

</script>
 </body>
</html>



