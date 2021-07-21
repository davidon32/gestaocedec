<?php include_once PATH.'/core/include.php';?>
<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_cce/Model/Model.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php";?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php";?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";?>
<?php
//$_conexao = new ConexaoMysql();

$_login = new Login();

//$_login -> logado();

$_usuario = new Usuario();

$_diario = new Diario();

$_id_usuario = $pageSession['session']['seguranca']['idUser'];
?>

<div class="col-md-12 text-center">
    <a href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'))?>&ac=itn&modulo=cce&controller=cce&action=index"class="btn btn-success">Voltar</a>
</div>


					<form action="index.php?token=<?=hash('sha256', md5(VERSAO).date('dmY'))?>&ac=itn&modulo=cce&controller=cce&action=diario" method="POST" name="cadastra_evento">
						
					   <legend>Diário do Plantão</legend>
					   
					   <?php 
					   
					       $_plantao = $_diario->BuscaDiario(date('Y-m-d'));
                           
                           //var_dump($_plantao);
                           
                           $num_plantao = count($_plantao);
                           
                           $_novoDiario = "";
                           $_option = '<option>07:00</option><option>19:00</option>';
                           
                           if($num_plantao == 1) {
                                   
                               if($_plantao[0]['periodo'] == '07:00hs as 19:00hs'){
                                       
                                   $_option = '<option>19:00</option>';
                                       
                               } else {
                                       
                                   $_option = '<option>07:00</option>';
                               }
                               
                           }
					   
    					   if($num_plantao == 2) {
    					       
                               $_novoDiario = "disabled=\"disabled\"";
                               $_option = '<option value=""></option>';
                               //$_novoDiario = ""; 
                           }
                           
                       ?>
					   
					   <table class="table table-bordered">
					       <tr>
                               <td style="text-align:center;">Data</td>
                               <td style="text-align:center;">Período</td>
                               <td style="text-align:center;">Plantonista</td>
                               
                           </tr>
					       <tr>
					           
					           <!-- Horario plantão
					               
					               07:00 as 19:00
					               19:00 as 07:00
					               automatizar
					           
					            -->
					           
					           <td><input type="text" class="form-control" name="txt_dt_diario" id="txt_dt_diario" data-mask="99/99/9999" value="<?php print HOJE;?>" <?php print $_novoDiario;?> /></td>
					           <td>
					               <select class="form-control" name="txt_hr_inicio" id="txt_hr_inicio" <?php print $_novoDiario;?> >
					                   <option value="0">Horário Plantão</option>
					                   <?php print $_option;?>
					               </select>
					              
					               <input type="text" class="form-control" name="txt_hr_fim" id="txt_hr_fim" readonly="readonly"/>
					               <input type="hidden" class="form-control" name="txt_id_user" id="txt_id_user" value="<?php print $_id_usuario;?> " <?php print $_novoDiario;?>/>
					           </td>
					           <td><?php print $_usuario->getNomeId($_id_usuario); ?></td>
					           
					       </tr>
					   </table>
					   
					   <input class="btn btn-primary" type="submit" name="btn_enviar" id="btn_enviar" value="Abrir Plantão" <?php print $_novoDiario;?>>

				    </form>
				    <?php
				    
				        $_dt_diario      = isset($_POST['txt_dt_diario']) ? DataMysql::dataForm($_POST['txt_dt_diario']) : "";
                        $_hr_inicio      = isset($_POST['txt_hr_inicio']) ? $_POST['txt_hr_inicio'] : "";
                        $_hr_fim         = isset($_POST['txt_hr_fim'])    ? $_POST['txt_hr_fim']    : "";
                        $_id_funcionario = isset($_POST['txt_id_user'])   ? $_POST['txt_id_user']   : "";
                        $_btn_enviar     = isset($_POST['btn_enviar'])    ? true                    : "";
                                               
                        /* abre o diário do plantão */
                        if($_btn_enviar ){
                            
                            $_periodo = $_hr_inicio."hs "."as ".$_hr_fim."hs";
                            
                            if($_diario->buscaPlantaoAberto($_periodo, $_dt_diario) == 0) {
                            
                                if ($_hr_inicio != "0"){
                                    
                                    // 2 Lanca o diario no banco
                                    $_diario->CadastroAbreDiario($_dt_diario, $_periodo, $_id_funcionario);
                                        
                                    $_turno = ($_periodo == '07:00hs as 19:00hs') ? 0 : 1;
                                        
                                    $_diario = $_diario->buscaIdDiario($_dt_diario, $_periodo);
                                        
                                    // 3 janela para lancar os historicos                 
                                    print "<script>";
                                        
                                    print "alert('Adicione as Informações do Diário !');";
                                        
                                    print "window.location.href = 'index.php?token=".hash('sha256', md5(VERSAO)."-".time())."&ac=itn&modulo=cce&controller=cce&action=diario';";
                                        
                                    print "window.open(\"index.php?token=".hash('sha256', md5(VERSAO).date('dmY'))."&ac=itn&modulo=cce&controller=historico&action=cadastro&idd=".$_diario['id_diario']."&p=".$_turno."\", \"Pagina2\" , \"left=300, top=200, height = 500 , width = 600\");";
                                                                    
                                    print "</script>";
                                
                                
                                }else {
                                        
                                        print "<script>";
                                        
                                        print "alert('Selecione a Hora do Inicio do Plantão');";
                                        
                                        print "</script>";
                                        
                                }
                           }else {
                               
                               print "<script>";
                                        
                                    print "alert('Plantão já Aberto !');";
                               
                                    print "window.location.href = 'index.php?token=".hash('sha256', md5(VERSAO).date('dmY'))."&ac=itn&modulo=cce&controller=cadastro&action=diario';";
                               
                               print "</script>"; 
                               
                           }
                       }

				        // busca diario
				        $lista = $_diario->getDiario();
                        
                            print "<table class=\"table table-bordered\">
                                    <tr>
                                        <td style=\"text-align:center;\">Data</td>
                                        <td style=\"text-align:center;\">Plantão</td>
                                        <td style=\"text-align:center;\">Visualizar</td>
                                        <td style=\"text-align:center;\">Lançar</td>
                                    </tr>";
                        
                        foreach ($lista as $value){
                            
                            $turno = ($value['periodo'] == '07:00hs as 19:00hs') ? 0 : 1;
                                
                            $_dataLista = DataMysql::dataVisual($value['dt_diario']);
                            
                            print "<tr>
                                      <td style=\"text-align:center;\">".$_dataLista."</td>
                                      <td style=\"text-align:center;\">".$value['periodo']."</td>
                                      <td style=\"text-align:center;\">
                                                                        <a href=\"javascript:window.open('index.php?token=".hash('sha256', md5(VERSAO)."-".time())."&ac=itn&modulo=cce&controller=cce&action=historicoView&id=".$value['id_diario']."',
                                                                                                         'Pagina2',
                                                                                                         'left=300, top=100, height = 600 , width = 900'
                                                                                                         ) \" title='Consulta e Lancamento de Histórico'>
                                                                                                            <i class='fa fa-list'></i>
                                                                                                  </a>
                                       </td>
                                      
                                      <td style=\"text-align:center;\">
                                                                        <a href=\"javascript:window.open('index.php?token=".hash('sha256', md5(VERSAO)."-".time())."&ac=itn&modulo=cce&controller=cce&action=lancDiario&idd=".$value['id_diario']."&p=".$turno."',
                                                                                                         'Pagina2',
                                                                                                         'left=300, top=100, height = 600 , width = 900' 
                                                                                                         ) \" title='Adicionar Histórico'>
                                                                                                            <i class='fa fa-edit'></i>
                                                                                                  </a>
                                                        </td>
                                  </tr>";    
                        }
                        print "</table>";
                        
                        
                    ?>
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>
    <script type="text/javascript">

        $("#txt_dt_diario").datepicker({ 
                dateFormat: 'dd/mm/yy',
                dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
                dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
                dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
                monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
                monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
                nextText: 'Proximo',
                prevText: 'Anterior'
            });

        $("#txt_hr_inicio").change(function(){
          
          if($("#txt_hr_inicio").val() == "07:00"){
          
            $("#txt_hr_fim").val("19:00");
          
          }else if($("#txt_hr_inicio").val() == "19:00"){
          
            $("#txt_hr_fim").val("07:00");
          
          }
        });
    
    </script>
</body>
</html> 

<?php

?>