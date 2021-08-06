<?php $id_session = session_id();
    if(empty($id_session)) session_start(); 
  print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
  include_once PATH.'/include.php';


$_login = new Login();

$_usuario = new Usuario();
$listFuncionario = $_usuario->listFuncionario();

//var_dump($listFuncionario);

//$_login->logado();

//var_dump($_modulo);
//var_dump($_usuario);


/* $_usuario_classe->CadastraUsuarioCedec($_id_deposito, $_nome, $_senha, $_email, $_nivel, $_situacao, $_login, $_m_deposito, $_m_pipa, $_m_cce, $_m_decretacao, $_m_comdec, $_m_apoio, $_m_poco, $_m_escola, $_trsenha, $_cpf, $_id_funcionario, $usuarioAdmin);


$_usuario_classe->CadastrarPermissaoPipa($_login, $_cad_pipeiro, $_cad_motorista, $_cad_caminhao, $_cad_contrato, $_cad_acerto, $_rel_rpa, $_rel_bb, $_rel_imposto, $_rel_cadastro, $_rel_contrato, $_cad_rota, $_rel, $_rel_conf, $_rel_conf_pg, $_rel_falt_pg, $_rel_pg, $_rel_cons);


$_usuario_classe->CadastrarPermissaoCce($_login, $_cad_evento, $_cad_consulta, $_cad_rel, $_rel_resumo, $_rel_tp_evento, $_cad_diario)
 */

?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php print TITULO;?></title>
<link href="<?php print SISTEMA;?>/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="/css/easy-autocomplete.css" rel="stylesheet" media="screen">
<link href="<?php print SISTEMA;?>/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
</head>
<body>
	<!-- TOPO /system/topo.php-->
    <?php include_once(PATH.'/system/topo.php'); ?>
	<div class="container">
		
		<!-- MENU -->
		<div class="row-fluid">
			<div class="span2">
			    <?php include_once PATH."/mod_".$modulo.'/app/elemento/'.$modulo.'.menu.php';?>
			    
			</div>

			<div class="span9 fdo_corpo">

				  <form action="?modulo=equipe&secao=usuario&acao=cad_permissao" method="POST" id="frmBuscaFunc" name="frmBuscaFunc">
				  
				  	<label>Usuário</label>
				  	<input type="text" id="txtFuncionario" name="txtFuncionario" title="Digite o nome do usuario">
				  	<input type="hidden" name="txtIdFuncionario" id="txtIdFuncionario">
				  	<input type="submit" class="btn" value="Buscar" id="btnBuscarFuncionario" name="btnBuscarFuncionario" title="Busca nome de Usuario">

				  </form>
			
  
<?php

	$btn = isset($_POST['btnBuscarFuncionario']) ? true : false;

if($btn) {
	
	$id_funcionario = isset($_POST['txtIdFuncionario']) ? $_POST['txtIdFuncionario'] : ""; 

	
	print "<table class='table table-bordered'>";
	print "<tr>";
	print "<th>Código</th>";
	print "<th>Nome</th>";
  	print "<th>Opções</th>";
  	print "</tr>";
	print "<tr>";
		
		print "<td>".$_POST['txtIdFuncionario']."</td>";
		print "<td>".$_POST['txtFuncionario']."</td>";
  		print "<td><a href='?modulo=equipe&secao=usuario&acao=permissao&id=".$_POST['txtIdFuncionario']."'><img src='/imagem/add.png' width='25'></a></td>";
  		print "</tr>";

}


/*
  if($modulo == 'aju_permissao') {

    print '<legend>Módulo Ajuda Humanitária</legend>
  <label>Nível</label> <select name="sel_nivel">
          <option value="0">Escolha o Nível</option>
          <option value="1">Usuario</option>
          <option value="2">Administrador</option>
          <option value="3">Deposito Avançado</option>
          </select>
          <br />
  <table class="table">
  	<tr>
  		<td colspan="6" style="text-align:center">
  		<label><b>Acesso a Cadastro</b></label>
  		</td>
  	</tr>
    <tr>
      <td> <input type="checkbox" name="ck_cad_material" id="ck_cad_material" value="1"/></td>
      <td>Cadastro Material</td>

      <td> <input type="checkbox" name="ck_cad_pagamento" value="1"></td>
      <td>Cadastro Pagamento</td>
      
      <td> <input type="checkbox" name="ck_cad_transferencia" id="ck_cad_transferencia" value="1"></td>
  	  <td>Cadastro Transf Mat</td>
    </tr>
    <tr>
      <td> <input type="checkbox" name="ck_cad_liberacao" id="ck_cad_liberacao" value="1"></td>
      <td>Liberação de Materiais</td>
      
      <td> <input type="checkbox" name="ck_cad_ajuda_suporte" id="ck_cad_ajuda_suporte" value="1"></td>
      <td>Suporte Ajuda</td>
  
      <td> <input type="checkbox" name="ck_cad_usuario" id="ck_cad_usuario" value="1"></td>
      <td>Cadastro usuário</td>
    </td>    
    <tr>
      
      <td> <input type="checkbox" name="ck_cad_conf_ger" id="ck_cad_conf_ger" value="1"></td>
      <td>Configuração Geral Sistema</td>
      
       <td> <input type="checkbox" name="ck_cad_deposito" id="ck_cad_deposito" value="1"></td>
       <td>Cadastro Deposito</td>

       <td></td>
       <td></td>           
    </tr>
  </table>

  <table class="table">
  	<tr>
  		<td colspan="6" style="text-align:center">
  		<label><b>Acesso a Relatorios</b></label>
  		</td>
  	</tr>
    <tr>
      
      <td> <input type="checkbox" name="ck_rel_saldo_geral" id="ck_rel_saldo_geral" value="1"></td>
      <td>Rel. Saldo Geral</td>
  
      <td> <input type="checkbox" name="ck_rel_saldo_p_deposito" id="ck_rel_saldo_p_deposito" value="1"></td>
      <td>Rel. Saldo por Deposito</td>
      
      <td></td>
      <td></td>
    </tr>

    <tr>
      
      <td> <input type="checkbox" name="ck_rel_comp_liberacao" id="ck_rel_comp_liberacao" value="1"></td>
      <td>2ª via Comprovante Liberação</td>
  
      <td> <input type="checkbox" name="ck_rel_mat_liberado" id="ck_rel_mat_liberado" value="1"></td>
      <td>Rel. Material Liberado</td>
      
      <td></td>
      <td></td>
    </tr>
    <tr>
      
      <td> <input type="checkbox" name="ck_rel_mat_pago" id="ck_rel_mat_pago" value="1"></td>
      <td>Rel. Material Pago</td>
      
      <td> <input type="checkbox" name="ck_rel_comp_mat_pago" id="ck_rel_comp_mat_pago" value="1"></td>
      <td>2ª via Comprovante Pagto Mat</td>
      
      <td></td>
      <td></td>
      
     </tr>      
     <tr>
      
      <td> <input type="checkbox" name="ck_rel_mat_transferido" id="ck_rel_mat_transferido" value="1"></td>
      <td>Rel. Material Transferido</td>
      
      <td> <input type="checkbox" name="ck_rel_mat_transito" id="ck_rel_mat_transito" value="1"></td>
      <td>Rel. Material Transito</td>
      
      <td> <input type="checkbox" name="ck_lembrete_libera" id="ck_lembrete_libera" value="1"></td>
      <td>Lembrete de Liberações</td>
    
    </tr>
    <tr>      
      
      <td> <input type="checkbox" name="ck_lembrete_transito" id="ck_lembrete_transito" value="1"></td>
      <td>Lembete Material em Trânsito</td>
      
      <td></td>
      <td></td>
      
      <td></td>
      <td></td>
       
     </tr>
       
</table>';

}

elseif ($_modulo == 'pip_permissao') {

  print ' 
  <legend>Módulo Caminhão Pipa</legend>

    <table class="table">
      <tr>
        <td>Cadastro Pipeiro:<input type="checkbox" name="cad_pipeiro" id="cad_pipeiro" value="1" /></td>
        <td>Cadastro Motorista:<input type="checkbox" name="cad_motorista" id="cad_motorista" value="1" /></td>
        <td>Cadastro Caminhao:<input type="checkbox" name="cad_caminhao" id="cad_caminhao" value="1"/></td>
      </tr>
      <tr>
        <td>Cadastro Contrato<input type="checkbox" name="cad_contrato" id="cad_contrato" value="1"/></td>
        <td>Acerto Pipeiro:<input type="checkbox" name="cad_acerto" id="cad_acerto" value="1" /></td>
        <td>Cadastro Rota:<input type="checkbox" name="cad_rota" id="cad_rota" value="1"/></td>
      </tr>
    </table>
    <table>
           
      <label>Relatórios</label>
      <tr>
        <td>Relatório :<input type="checkbox" name="rel" id="rel" value="1"/></td>
        <td>Relatório RPA:<input type="checkbox" name="rel_rpa" id="rel_rpa" value="1"/></td>
        <td>Relatório Banco Brasil: <input type="checkbox" name="rel_bb" id="rel_bb" value="1"/></td>
      </tr>
      <tr>
        <td>Relatório Impostos:<input type="checkbox" name="rel_imposto" id="rel_imposto" value="1"/></td>
        <td>Relatório Cadastro:<input type="checkbox" name="rel_cadastro" id="rel_cadastro" value="1"/></td>
        <td>Relatório Contrato:<input type="checkbox" name="rel_contrato" id="rel_contrato" value="1"/></td>
      </tr>
      <tr>
        <td>Relatorio de Conferencia de Lancamento<input type="checkbox" name="rel_conf" id="rel_conf" value="1"></td>
        <td>Relatorio de Conf. de Pagamento<input type="checkbox" name="rel_conf_pg" id="rel_conf_pg" value="1"></td>
        <td>Relatório Falta de Pgto: <input type="checkbox" name="rel_falt_pg" id="rel_falt_pg" value="1"></td>
      </tr>

      <tr>
        <td>Relatório Pgto de Materiais: <input type="checkbox" name="rel_pg" id="rel_pg" value="1"></td>
        <td>Relatório Considerações de Despesas: <input type="checkbox" name="rel_cons" id="rel_cons" value="1"></td>
      </tr>
    </table>';

    }
    elseif ($_modulo == 'dec_permissao') {
      
      print '<!-- Permissoes do módulo decreto --> 

        <legend>Módulo Decreto</legend>
          Cadastro 1:<input type="checkbox" name="" id=""/>';
    

    }
    elseif ($_modulo == 'poc_permissao') {
     
        print '<!-- Permissoes do módulo poços artesiano--> 

        <legend>Módulo Poços Artesianos</legend>
          Cadastro 1:<input type="checkbox" name="" id=""/>';

    }
    elseif ($_modulo == 'apo_permissao') {
      print '<!-- Permissoes do módulo equipe de apoio--> 

        <legend>Módulo Equipe de Apoio</legend>
          Cadastro 1:<input type="checkbox" name="" id=""/>';
    }
    elseif ($_modulo == 'esc_permissao') {
     
      print ' <!-- Permissoes do módulo escola de defesa -->

        <legend>Módulo Escola de Defesa Civil</legend>
          Cadastro 1:<input type="checkbox" name="" id=""/>';

    }
    elseif ($_modulo == 'com_permissao') {

      print '<!-- Permissoes do módulo comdec -->

        <legend>Módulo Comdec</legend>
            
          Cadastro 1:<input type="checkbox" name="" id=""/>';
    }
    elseif ($_modulo == 'cce_permissao') {

      print '<!-- Permissoes do módulo cce -->

        <legend>Módulo CCE</legend>';
        
          $dados = $_usuario_classe->pegaPermissao("cce_permissao");
          
          for ($i=0; $i < count($dados) ; $i++) {
              
            if(($dados[$i][0] != "id_permissao") &&
                ($dados[$i][0] != "login")){
              
                print "<input type=\"checkbox\" name=\"ck_".$dados[$i][0]."\" id=\"ck_".$dados[$i][0]."\" value=\"1\"/>".$dados[$i][1]."<br>";
            } 
              
          }
          
          //var_dump($dados);
    }

?>		

	<div align="center">
      <button class="btn btn-primary" type="text" name="btn_enviar" value="btn_enviar">Cadastrar</button>
      </div>

</form>

    </div>
  </div>

  </body>
  </html>

  <?php

  ########################################### ajuda humanitaria #########################################

  $_sel_nivel               = isset($_POST['sel_nivel'])              ? $_POST['sel_nivel']              :"0"; # nivel do usuario                         
  $_ck_cad_material         = isset($_POST['ck_cad_material'])        ? $_POST['ck_cad_material']        :"0"; # acesso cadastro material   
  $_ck_cad_pagamento        = isset($_POST['ck_cad_pagamento'])       ? $_POST['ck_cad_pagamento']       :"0"; # acesso cadastro pagamento material
  $_ck_cad_transferencia    = isset($_POST['ck_cad_transferencia'])   ? $_POST['ck_cad_transferencia']   :"0"; # acesso cadastro transferencia         
  $_ck_cad_liberacao        = isset($_POST['ck_cad_liberacao'])       ? $_POST['ck_cad_liberacao']       :"0"; # acesso liberacao de material     
  $_ck_cad_ajuda_suporte    = isset($_POST['ck_cad_ajuda_suporte'])   ? $_POST['ck_cad_ajuda_suporte']   :"0"; # acesso ajuda suporte sistema        
  $_ck_cad_usuario          = isset($_POST['ck_cad_usuario'])         ? $_POST['ck_cad_usuario']         :"0"; # acesso cadastro de usuario   
  $_ck_cad_deposito         = isset($_POST['ck_cad_deposito'])        ? $_POST['ck_cad_deposito']        :"0"; # acesso as opcoes do deposito (pagamento recebimento)
  $_ck_cad_conf_ger         = isset($_POST['ck_cad_conf_ger'])        ? $_POST['ck_cad_conf_ger']        :"0"; # acesso configuracao geral do sistema
  
  $_ck_relatorio			= 1; 																			   # acesso ao menu relatorio    
  $_ck_rel_saldo_geral      = isset($_POST['ck_rel_saldo_geral'])     ? $_POST['ck_rel_saldo_geral']     :"0"; # acesso relatorio de saldo geral dos depositos
  $_ck_rel_saldo_p_deposito = isset($_POST['ck_rel_saldo_p_deposito'])? $_POST['ck_rel_saldo_p_deposito']:"0"; # acesso ao saldo filtrado por depositos
  
  $_ck_liberacao 			= $_ck_cad_liberacao;															   # acesso ao menu liberacao de material
  $_ck_rel_comp_liberacao   = isset($_POST['ck_rel_comp_liberacao'])  ? $_POST['ck_rel_comp_liberacao']  :"0"; # acesso ao relatorio de comprovante de liberacao (2ª via)    
  $_ck_rel_mat_liberado     = isset($_POST['ck_rel_mat_liberado'])    ? $_POST['ck_rel_mat_liberado']    :"0"; # acesso ao relatorio de material liberado
  $_ck_rel_mat_pago         = isset($_POST['ck_rel_mat_pago'])        ? $_POST['ck_rel_mat_pago']        :"0"; # acesso ao relatorio de material pago
  $_ck_rel_comp_mat_pago    = isset($_POST['ck_rel_comp_mat_pago'])   ? $_POST['ck_rel_comp_mat_pago']   :"0"; # acesso ao relatorio de comprovante de material pago
  
  $_ck_transferencia        = $_ck_cad_transferencia;														   # acesso ao menu transferencia de material entre deposito
  $_ck_rel_mat_transferido  = isset($_POST['ck_rel_mat_transferido']) ? $_POST['ck_rel_mat_transferido'] :"0"; # acesso ao relatorio de material transferido  
  $_ck_rel_mat_transito     = isset($_POST['ck_rel_mat_transito'])    ? $_POST['ck_rel_mat_transito']    :"0"; # acesso ao relatorio de material em transito
  $_ck_lembrete_libera      = isset($_POST['ck_lembrete_libera'])     ? $_POST['ck_lembrete_libera']     :"0"; # visibilidade de lembrete de material liberado
  $_ck_lembrete_transito    = isset($_POST['ck_lembrete_transito'])   ? $_POST['ck_lembrete_transito']   :"0"; # visibilidade de lembrete de material em transito
           
  
  $_btn_enviar              = isset($_POST['btn_enviar'])             ? true                             :"";
    

  ############################################### pipa #################################################

  $_cad_pipeiro   = isset($_POST['cad_pipeiro'])  ? $_POST['cad_pipeiro']  :"0";
  $_cad_motorista = isset($_POST['cad_motorista'])? $_POST['cad_motorista']:"0";
  $_cad_caminhao  = isset($_POST['cad_caminhao']) ? $_POST['cad_caminhao'] :"0";
  $_cad_contrato  = isset($_POST['cad_contrato']) ? $_POST['cad_contrato'] :"0";
  $_cad_acerto    = isset($_POST['cad_acerto'])   ? $_POST['cad_acerto']   :"0";
  $_cad_rota      = isset($_POST['cad_rota'])     ? $_POST['cad_rota']     :"0";
  $_rel           = isset($_POST['rel'])          ? $_POST['rel']          :"0";
  $_rel_rpa       = isset($_POST['rel_rpa'])      ? $_POST['rel_rpa']      :"0";
  $_rel_bb        = isset($_POST['rel_bb'])       ? $_POST['rel_bb']       :"0";
  $_rel_imposto   = isset($_POST['rel_imposto'])  ? $_POST['rel_imposto']  :"0";
  $_rel_cadastro  = isset($_POST['rel_cadastro']) ? $_POST['rel_cadastro'] :"0";
  $_rel_contrato  = isset($_POST['rel_contrato']) ? $_POST['rel_contrato'] :"0";
  $_rel_conf     = isset($_POST['rel_conf'])      ? $_POST['rel_conf']     :"0";
  $_rel_conf_pg  = isset($_POST['rel_conf_pg'])   ? $_POST['rel_conf_pg']  :"0";
  $_rel_falt_pg  = isset($_POST['rel_falt_pg'])   ? $_POST['rel_falt_pg']  :"0";
  $_rel_pg       = isset($_POST['rel_pg'])        ? $_POST['rel_pg']       :"0";
  $_rel_cons     = isset($_POST['rel_cons'])      ? $_POST['rel_cons']     :"0";

############################################### CCE #################################################
  
  if(($_modulo == 'pip_permissao') && ($_btn_enviar)) {

    //var_dump($_POST);

      #@ Lanca a permissao do módulo do cedec_usuario
    if($_usuario_classe->CadastraModulo($_usuario, 'm_pipa', 1)){

      if(Usuario::CadastrarPermissaoPipa($_usuario,
                                        $_cad_pipeiro, 
                                        $_cad_motorista,
                                        $_cad_caminhao,
                                        $_cad_contrato,
                                        $_cad_acerto,
                                        $_rel_rpa, 
                                        $_rel_bb,
                                        $_rel_imposto,
                                        $_rel_cadastro,
                                        $_rel_contrato,
                                        $_cad_rota,
                                        $_rel, 
                                        $_rel_conf,
                                        $_rel_conf_pg,
                                        $_rel_falt_pg,
                                        $_rel_pg,
                                        $_rel_cons)) {

        print "<script type=\"text/javascript\">";

        print "alert('Cadastro realizado com Sucesso !');";

        print "window.close();";

        print "</script>";

      }
    }    
  }elseif(($_modulo == 'aju_permissao') && ($_btn_enviar)) {
  	
  	//var_dump($_POST);

    if($_usuario_classe->CadastraModulo($_usuario, 'm_deposito', 1)){

      if(Usuario::CadastrarPermissaoAjuda($_usuario,
											$_sel_nivel,
											$_ck_cad_material,
											$_ck_cad_pagamento,
											$_ck_cad_transferencia,
											$_ck_cad_liberacao,
											$_ck_cad_ajuda_suporte,
											$_ck_cad_usuario,
											$_ck_cad_conf_ger,
											$_ck_relatorio,
											$_ck_rel_saldo_geral,
											$_ck_rel_saldo_p_deposito,
											$_ck_liberacao,
											$_ck_rel_comp_liberacao,
											$_ck_rel_mat_liberado,
											$_ck_rel_mat_pago,
											$_ck_rel_comp_mat_pago,
											$_ck_transferencia,
											$_ck_rel_mat_transferido,
											$_ck_rel_mat_transito,
											$_ck_lembrete_libera,
											$_ck_lembrete_transito,
											$_ck_inicial = 1,
											$_ck_cad_deposito)){
      
        print "<script type=\"text/javascript\">";
    
        print "alert('Cadastro realizado com Sucesso !');";
    
        print "window.close();";
    
        print "</script>";
      }

    }

  #@ permissao Decreto
  }elseif(($_modulo == 'dec_permissao') && ($_btn_enviar)) {

   // var_dump($_POST);

    /*if($_usuario_classe->CadastraModulo($_usuario, 'm_decreto', 1)){

      if(Usuario::CadastroPermissaoDecretacao(Paramentros)){

          print "<script type=\"text/javascript\">";
        
          print "alert('Cadastro realizado com Sucesso !');";
        
          print "window.close();";
        
          print "</script>";

      }      
    } */
    
/*
  #@ permissao pocos artesianos
  }elseif(($_modulo == 'poc_permissao') && ($_btn_enviar)) { 

    //var_dump($_POST);

    /*if($_usuario_classe->CadastraModulo($_usuario, 'm_poco', 1)){

      if(Usuario::CadastroPermissaoPoco(Parametros)){

          print "<script type=\"text/javascript\">";
        
          print "alert('Cadastro realizado com Sucesso !');";
        
          print "window.close();";
        
          print "</script>";
      }
    }*/
   
/*
  #@ permissao equipe de apoio
  }elseif(($_modulo == 'apo_permissao') && ($_btn_enviar)) {

    //var_dump($_POST);

    /*if($_usuario_classe->CadastraModulo($_usuario, 'm_apoio', 1)){

      if(Usuario::CadastroPermissaoApoio(Parametros)){

          print "<script type=\"text/javascript\">";
        
          print "alert('Cadastro realizado com Sucesso !');";
        
          print "window.close();";
        
          print "</script>";
      }
    }*/
/*
  #@ permissao escola
  }elseif(($_modulo == 'esc_permissao') && ($_btn_enviar)) {

    //var_dump($_POST);

    /*if($_usuario_classe->CadastraModulo($_usuario, 'm_escola', 1)){

      if(Usuario::CadastroPermissaoEscola(Parametros)){

          print "<script type=\"text/javascript\">";
        
          print "alert('Cadastro realizado com Sucesso !');";
        
          print "window.close();";
        
          print "</script>";
      }
    }*/
 /*   
  #@ permissao Compdec
  }elseif(($_modulo == 'com_permissao') && ($_btn_enviar)) {

   // var_dump($_POST);

    /*if($_usuario_classe->CadastraModulo($_usuario, 'm_comdec', 1)){

      if(Usuario::CadastroPermissaoCompdec(Parametros)){

          print "<script type=\"text/javascript\">";
        
          print "alert('Cadastro realizado com Sucesso !');";
        
          print "window.close();";
        
          print "</script>";

      }
    }*/
  /*  
  #@ permissao  cce
  }elseif(($_modulo == 'cce_permissao') && ($_btn_enviar)) {

    var_dump($_POST);

    if($_usuario_classe->CadastraModulo($_usuario, 'm_cce', 1)){

      if(Usuario::CadastroPermissaoCce(Parametros)){

          print "<script type=\"text/javascript\">";
        
          print "alert('Cadastro realizado com Sucesso !');";
        
          print "window.close();";
        
          print "</script>";

      }
    }

  }

   
   */
  
//var_dump($listFuncionario);

?>
</div>
</body>
<script src="/js/jquery-1.11.2.js"></script>
<script src="/js/jquery.easy-autocomplete.js"></script>
	<script type="text/javascript">
		var itens = {
				data: 
						<?php print json_encode($listFuncionario);?>, // array com os dados
					
					getValue: "nome",
	
						list: {
						match: {
							enabled: true
						},
		
							onSelectItemEvent: function() {
								var value = $("#txtFuncionario").getSelectedItemData().id_funcionario;
		
								$("#txtIdFuncionario").val(value);
								//$("#txtIdComunidadeSearch").val(value).trigger("change");
		
							}
	
					}
	
			};
		
		$("#txtFuncionario").easyAutocomplete(itens);

	</script>
</html>