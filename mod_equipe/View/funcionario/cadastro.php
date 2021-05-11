<?php $id_session = session_id();
    if(empty($id_session)) session_start(); 
print "<!DOCTYPE html>";
include_once PATH.'/include.php';
/***********************************************************************
 * Órgão      : Gabinete Militar do Governador de Minas Gerais
 * Secretária : Coordenadoria Estadual de Defesa Civil de Minas Gerais
 * Descrição  : Cadastro de funcionarios
 * Autor      : Demetrio S. Passos
 * Data       : 01/01/2013
 * 
 ***********************************************************************/

$con = Conexao::getInstance();

$adm = isset($_GET['adm']) ? $_GET['adm'] :"";
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php print TITULO;?></title>
<link href="/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
</head>
<body>
	<!-- TOPO /system/topo.php-->
    <?php include_once(PATH.'/system/topo.php'); ?>
    <div class="container">
     <!-- MENU-->
        <div class="row-fluid">
            <div class="span3">
                <BR>
                <?php include_once PATH."/mod_".$modulo.'/app/elemento/'.$modulo.'.menu.php';?>
            </div>

			<!-- CORPO PAGINA  -->
			<div class="span7">
				<legend>Cadastro de Funcionários</legend>
				<span class='alert alert-error'>A senha padrão para novos usuários é <b>cedec199</b>
					* Será Cadastrado as permissoes padroes de usuários.</span><br><br>
				<form action="index.php?modulo=equipe&secao=funcionario&acao=valida" method="POST" name="frm_cad_funcionario">
					
					<table class="table">
					    <tr>
					        <td width="50%">
					            <label>Nº Policia/MASP</label>
                                <input class="span12" type="text" title="Número de Polícia ou Masp" name="txt_masp" placeholder="Nº Polícia/ Masp" data-mask="9999999-9">
                            
					        </td>
					        <td>
					            <label>Usuário CA</label>
                                <input class="span12" type="text" title="Número de Polícia ou Masp" name="txt_usu_ca" placeholder="Usuário Computador CA">
                            
					        </td>
					    </tr>
					    	<tr>
					        <td colspan="2">
					           <label>Nome</label>
                               <input class="span12" type="text" title="Nome do Funcionario" name="txt_nome" placeholder="Nome">    
					        </td>
					    </tr>
					    
					    <tr>
                            <td>
                                <?=EquipeFuncionario::postoGraduacao();?>    
                            </td>
                            <td>
                                <?=EquipeFuncionario::secaoDiretoria();?>   
                            </td>
                        </tr>
                        
                        <tr>
                            <td>
                                <div class="control control-group">
                                    <label>Tipo</label>
                                    <label class="checkbox inline span2">
                                          <input type="checkbox" id="ck_adt" value="ADT" name="ck_adt" > ADT
                                    </label>
                                    <label class="checkbox inline span2">
                                          <input type="checkbox" id="ck_ade" value="ADE" name="ck_ade"> ADE
                                    </label>
                                    <label class="checkbox inline span2">
                                          <input type="checkbox" id="ck_dad" value="DAD" name="ck_dad"> DAD
                                    </label>
                                </div>
                                
                            </td>
                            <td>
                                <label>Nº Quinquênio / ADE / DAD</label>
                                <input class="span12" type="text" title="Números de Quinquênios" name="txt_quinquenio" placeholder="Quinquênio">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>CPF</label>
                                <input class="span12" type="text" title="CPF do Funcionário" name="txt_cpf" id="txt_cpf" placeholder="CPF" data-mask="999.999.999-99">
                            </td>
                            <td>
                                <label>C.I.</label>
                                <input class="span12" type="text" title="Carteira de Identidade" name="txt_ci" placeholder="C.I">
                            </td>
                        </tr>
                        
                        <tr>
                            <td>
                                <?=EquipeFuncionario::funcaoCargo();?>
                            </td>
                            <td>
                                <?=EquipeFuncionario::funcaoExercida();?>
                            </td>
                        </tr>
                        
                        <tr>
                            <td>
                                <label>Endereço</label>
                                <input class="span12" type="text" title="Endereço do Funcionário" name="txt_endereco" placeholder="Endereço">
                            </td>
                            <td>
                                <label>Bairro</label>
                                <input class="span12" type="text" title="Bairro do Funcionário" name="txt_bairro" placeholder="Bairro">
                            </td>
                        </tr>
                        
                        <tr>
                            <td>
                                <label>Municipio</label>
                                <?php Municipio::PegaMunicipio();?>    
                            </td>
                            <td>
                                <label>Telefone</label>
                                <input class="span12" type="text" title="Telefone" name="txt_tel" data-mask="(99)9999-9999" placeholder="Telefone">    
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Celular</label>
                                <input class="span12" type="text" title="Celular" name="txt_cel" data-mask="(99)9999-9999" placeholder="Celular">  
                            </td>
                            <td>
                                <label>Órgão</label>
                                <select class="span12" name="txt_orgao" title="Órgão">
                                    <option>CEDEC</option>
                                    <option>GMG</option>
                                </select>
                            </td>
                        </tr>
                        
                         <tr>
                            <td>
                                <label>Data Nascimento</label>
                                <input class="span12" type="text" title="Data de Nascimento" name="txt_dt_nascimento" data-mask="99/99/9999" placeholder="Data de Nascimento">
                            </td>
                            <td>
                                <label>Curso</label>
                                <input class="span12" type="text" title="Curso" name="txt_curso" placeholder="Curso">
     
                            </td>
                        </tr>
                        
                        <tr>
                            <td>
                                <label>Email</label>
                                <input class="span12" type="text" title="Email do Funcionário" name="txt_email" placeholder="Email" id="txt_email" onblur="ValidaEmail();">
                            </td>
                            <td>
                                <label>Email2</label>
                                <input class="span12" type="text" title="Email do Funcionário" name="txt_email2" placeholder="Email2" id="txt_email2" onblur="ValidaEmail();">
                            </td>
                        </tr>
						
						<tr>
                            <td colspan="2">
                                <button class="btn btn-primary" type="submit" title="Cadastra Funcionarios" name="btn_envia">Cadastrar</button>    
                            </td>
                        </tr>
                        </table>
				</form>
			</div>
						
			<!-- RODAPE -->
			<div class="row">
				<div class="span12 text-center">
					<small><?php print RODAPE;?></small>
				</div>	
			</div>
		</div>
</div>
			
	<script src="/js/jquery.js"></script>
	<script src="/js/bootstrap.js"></script>
	<script src="/js/jasny-bootstrap.js"></script>
	<script src="/js/funcaobase.js"></script>
	
	<script type="text/javascript">
	
    	$(document).ready(function(){
    	
    	   $("#ck_adt").attr("checked", false);
    	   $("#ck_ade").attr("checked", false);

    
            $("#ck_adt").click(function(){
                              
                    $("#ck_ade").attr("checked",false);    

            });
            
            $("#ck_ade").change(function(){
                
                
                
                    $("#ck_adt").attr("checked",false);    
                    

            });


            $("#txt_cpf").blur(function(){

            	var cpf = $("#txt_cpf").val();

            	if(TestaCPF(cpf)){
            		$("#txt_cpf").css('background-color', '#66CDAA');
            		$("#txt_cpf").css('color', '#ffffff');
            		$("#txt_cpf").attr('title', 'Cpf Válido !');
					
            	}else {
					//alert("erro");
					$("#txt_cpf").css('background-color', '#FF6347');
		        	$("#txt_cpf").attr('title', 'Cpf Inválido !');
		        	$("#txt_cpf").css('color', '#ffffff');
		        	$("#txt_cpf").val("");
					$("#txt_cpf").focus();
            	}

            });
            
        });
  
	</script>
	
</body>
</html>