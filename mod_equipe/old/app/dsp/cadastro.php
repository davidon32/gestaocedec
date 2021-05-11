<?php session_start();
print "<!DOCTYPE html>";
include_once PATH.'/include.php';
/************************************************************************************+
 #	Secretária  : Gabinete Militar do Governado de Minas Gerais                      #
#	Órgão       : Coordenadoria Estadual de Defesa Civil do Estado de Minas Gerais   #
#  Autor       : Demetrio S. Passos     											 #
#  Criação     : 00/00/0000														 #
#	Descrição   : cadastro de DSP
#
+************************************************************************************/

$_conexao = new ConexaoMysql();

$helper = new Html();

$_municipio = new Municipio();

$_funcionario = new EquipeFuncionario();

$_funcaoBase = new FuncaoBase();

$_dsp = new EquipeDSP();

$_ano = date('Y');

$_num_dsp = $_dsp->GerarOrdemServico($_ano);

//$data = "04/03/2014 08:49";

//print $_dsp->formataDataHoraPM($data);

//var_dump($_funcionario->dadosCombo());


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
	<div class="container">
		<div class="row-fluid text-center">
			<img src="../imagem/topo_pipa.png" />
			<hr>
		</div>
		<!-- BARRA -->
		<div class="row-fluid">
			<div class="span6 text-left">
				<small><?php print "Data :".date("d/m/Y");?> </small>
			</div>
			<div class="span6 text-right">
				<small><?php print "Hora :".date("H:i:s");?> </small>
			</div>
		</div>

		<!-- LOGOUT -->
		<div class="row-fluid">
			<div class="span12 text-right">
				<a class="btn btn-primary" href="<?php print SISTEMA;?>/core/logout.php?logout=s" title="Logout do Sistema">Logout</a>
				<p>
				
				
				<hr>
			</div>
		</div>

		<div class="row-fluid">

			<!-- MENU -->
			<div class="span3">
				 <?php
                    include_once PATH."/mod_".$modulo.'/app/elemento/'.$modulo.'.menu.php';
                ?>
			</div>

			<!-- CORPO PAGINA  -->
			<div class="span7">

				<legend>Cadastro de DSP</legend>
				<form action="index.php?modulo=equipe&secao=dsp&acao=valida" method="POST" name="frm_cad_dsp">

                    <label>Número DSP</label>
                    <input type="text" name="txt_num_dsp" id="txt_num_dsp" title="Número da DSP" class="" value="<?php print $_num_dsp;?>" readonly="readonly">
                    
                    <label>Tipo</label>
                    <table>
                        <tr>
                            <td>Militar</td>
                            <td>:&nbsp;&nbsp;<input type="radio" name="tpDSP" id="tpDSP" value="0" onclick="javascript:tpMilitar();"></td>
                        </tr>
                        <tr>
                            <td>Civil</td>
                            <td>:&nbsp;&nbsp;<input type="radio" name="tpDSP" id="tpDSP" value="1" onclick="javascript:tpCivil();"></td>
                        </tr>
                    </table>
                    
                    <br>
                    <br>
                    
					<label>Data</label>
					<input type="text" name="txt_dt_dsp" id="txt_dt_dsp" title="Data da DSP" class="" value="<?php print date('d/m/Y');?>">

					
					<label>Ano</label>
					<input type="text" name="txt_ano" value="<?php print $_ano;?>" />
					
					<label>Tipo Ônus</label>
					
					<!--
					  0 = Gabinete
					  1 = Outros Orgãos
					  2 = Sem Onus
					 
					 -->
                    <table>
                        <tr>
                            <td>Gabinete</td>
                            <td>:&nbsp;&nbsp;<input type="radio" name="rbOnus" id="rbOnus" value="0" checked="checked" onclick="javascript:tpMilitar();"></td>
                        <tr>
                        <tr>
                            <td>Outros Órgãos</td>
                            <td>:&nbsp;&nbsp;<input type="radio" name="rbOnus" id="rbOnus" value="1" onclick="javascript:tpCivil();"></td>
                        </tr>
                        <tr>
                            <td>Sem Ônus</td>
                            <td>:&nbsp;&nbsp;<input type="radio" name="rbOnus" id="rbOnus" value="2" onclick="javascript:tpCivil();"></td>
                        </tr>
                    </table>
                    <br>
                    <br>

					<label>Missão</label>
					<textarea rows="5" cols="30" name="txt_missao" id="txt_missao" title="Missão a Cumprir" class="span10 field"></textarea>

					<label>Destino</label>
					<!--<?php Municipio::PegaMunicipio(false, Estado::getArrayNomeUf());?>
					<button type="button" name="btn_add_destino" id="btn_add_destino" class="btn btn-primary">Adicionar</button>
					<br />
					<textarea rows="5" cols="30" name="txt_destino" id="txt_destino" class="spa10" readonly="readonly"></textarea>
					<!-- botao limpar texarea
                    <button type="button" class="btn btn-primary" id="btn_limparm" title="Limpa a caixa para Correção do nome do município" >Corrigir</button>-->
                    <textarea rows="5" cols="30" name="txt_lista_destino" id="txt_lisa_destino" class="span10 field"></textarea>
					
					<!-- armazena a lista com o(s) destinos da DSP -->
					<!-- <input type="hidden" name="txt_lista_destino" id="txt_lista_destino">-->
					
					<label>Tipo de Transporte</label>
					<select name="sel_transporte" id="sel_transporte">
					   <option value="">Selecione Tipo Transporte</option>
					   <option value="1">Veículo Oficial</option>
					   <option value="2">Veículo Particular</option>
					   <option value="3">Aeronave do Estado</option>
					   <option value="4">Vôo Comercial</option>
					   <option value="5">Ônibus Rodoviário</option>
					</select>

					<label>Código DSP</label>
					<?php EquipeDSP::ComboCodDsp();?>

					<label>Data/Hora Partida</label>
					<input type="text" name="txt_dt_partida" id="txt_dt_partida" title="Data e Hora de Partida" class=""
						data-mask="99/99/9999_99:99">

					<label>Data/Hora Chegada</label>
					<input type="text" name="txt_dt_chegada" id="txt_dt_chegada" title="Data e Hora de Chegada" class=""
						data-mask="99/99/9999_99:99">

					<label></label>
					<?php $helper->inputSelect("MembroEquipe", "MembroEquipe", "Membros da Equipe", $_funcionario->dadosCombo(), false);
					
					
					
					?>
					
					<!-- ADICIONAR INTEGRANTE NA DSP-->
					<br>
					<button type="button" id="btn_add_funcionario" value="btn_add_funcionario" class="btn btn-primary">Adicionar</button>
					<br>
					<br><br>
					<span class="alert alert-danger">* Obs : O primeiro membro na lista da equipe será o CMT da DSP.</span>
					<br /><br>
					<textarea rows="5" cols="40" name="txt_funcionario" id="txt_funcionario" class="span10" readonly="readonly"></textarea>
					
					<!-- BOTAO LIMPA TEXTAREA -->
					<button type="button" class="btn btn-primary" id="btn_limpar" title="Limpa a caixa para Correção dos Membros da Equipe" >Corrigir</button>
					<br>
					<!-- CHEFE DIRETO-->
                    <?php $helper->input("select", "chefeDireto", "Chefe Direto", false, $_funcionario->dadosCombo());?>

					
					<!-- armazena a lista com os funcionarios da DSP -->
					<input type="hidden" name="txt_lista_func" id="txt_lista_func">
					<br>
					<br>
					<div class="span12 text-center"><br>					
					<input type="submit" class="btn btn-primary" value="Enviar" name="btn_envia" id="btn_envia" onclick="return confirm('Confirma o Fechamento da DSP ?');" onfocus="javascript:tipo();">
					</div>
					</form>

		
			</div>
            
		<!-- RODAPE -->
		<div class="row-fluid">
		    
			<div class="span12 text-center">
			    <br><br>
				<small><?php print RODAPE;?> </small>
			</div>
		</div>
	</div>

	<script src="/js/jquery.js"></script>
	<script src="/js/bootstrap.js"></script>
	<script src="/js/jasny-bootstrap.js"></script>
	<script src="/js/funcaobase.js"></script>

	<script type="text/javascript">
	
	var nome = "";
    var id_dest = "";
    
    var func = "";
    var id_func = "";

    /* monta lista com os funcionarios da dsp */
	$(document).ready(function(){
	    
	    var qtdFunc = 0;

        /* adicionar funcionarios*/
		$("#btn_add_funcionario").click(function(){
		    

			func += $("#selMembroEquipe option:selected").text() + ",";
			id_func += $("#selMembroEquipe").val() + ",";

			$("#txt_funcionario").val(func);
			$("#txt_lista_func").val(id_func);
			
			qtdFunc++;
			
            if($("input[name=tpDSP]:checked").val() == "1"){ //civil){
            
                $("#btn_add_funcionario").prop("disabled", true);
                /*alert("Só é permitido um Funcionário civil por DSP !!" );*/
                qtdFunc = 0;

            }
            
            if(($("input[name=tpDSP]:checked").val() == "0") && (qtdFunc == 4)){ //militar)
            
                $("#btn_add_funcionario").prop("disabled", true);
                alert("Limite de Militares Alcançado !!" );
                qtdFunc = 0;
            
            }

		});
        /* */
		$("#txt_funcionario").change(function(){

			func = $("#txt_funcionario").val();

			$("#txt_funcionario").val(func);
			$("#txt_lista_func").val(id_func);

			});
			

        $("#tpDSP").attr("checked", true);
        $("#tpDSP").val("0");
        
		
	
	});

    /* monta lista com os destinos da dsp */
	$(document).ready(function(){

		$("#btn_add_destino").click(function(){
			
		  	nome += $("#id_municipio option:selected").text() + ", ";

			id_dest += $("#id_municipio").val() + ",";

			$("#txt_destino").val(nome);
		
			});

		$("#txt_destino").change(function(){

			nome = $("#txt_destino").val();

			$("#txt_destino").val(nome);

			});
	
	});
	
	/* limpa a lista com os funcionarios */
	$(document).ready(function(){

        $("#btn_limpar").click(function(){

            $("#txt_funcionario").val('');
            func = "";
            id_func = "";
            $("#btn_add_funcionario").prop("disabled", false);

            });

    });
    
    /* limpa a lista com os destinos */
    $(document).ready(function(){

        $("#btn_limparm").click(function(){

            $("#txt_destino").val('');
            nome = "";
            id_dest = "";

            });

    });
    
    
    function tpMilitar(){
        
        $("#tpDSP").val("0");
        
    }
    
    function tpCivil(){
        $("#tpDSP").val("1");
    }
    
    
    function tpGmg(){
        
        $("#tpOnus").val("0");
        
    }
    
    function tpOrgao(){
        $("#tpOnus").val("1");
    }
    
     function tpSemOnus(){
        $("#tpOnus").val("2");
    }

</script>

</body>
</html>

