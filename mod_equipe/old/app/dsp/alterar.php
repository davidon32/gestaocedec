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

$_id_dsp = $_GET['id'];

$dados = $_dsp->buscaDspDadosId($_id_dsp);

//var_dump($dados);



// verificar data de partida ja venceu
$alterar = DataMysql::compararDatas(date("Y/m/d"),substr($dados[0]['partida'], 0, 10));

if($alterar) {

    $opcoesComboChefia = array('disabled'=>'disabled=\'disabled\'', 'name'=>'selChefeDireto');   
} else {
    $opcoesComboChefia = "";
    
}




var_dump($alterar);

//var_dump(date("Y/m/d"));


?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php print TITULO;?></title>
<link href="<?php print SISTEMA;?>/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="<?php print SISTEMA;?>/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
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
				<legend>Alterar Cadastro de DSP</legend>
				<form action="index.php?modulo=equipe&secao=dsp&acao=valida&id=<?=$_id_dsp;?>" method="POST" name="frm_cad_dsp">
				    
				    <input type="hidden" name="txtIdDsp" value="<?php print $_id_dsp;?>">
				    <input type="hidden" name="tpDSP" value="<?php print $dados[0]['tipo'];?>">

					<label>Data</label>
					<input type="text" name="txt_dt_dsp" id="txt_dt_dsp" title="Data da DSP" class="" <?php print ($alterar) ? "readonly='readonly'" : "";?> value="<?php print DataMysql::dataVisual($dados[0]['dt_dsp']);?>">

					<label>Número DSP</label>
					<input type="text" name="" id="" title="Número da DSP" class="" value="<?php print $dados[0]['num_dsp']."/".$dados[0]['ano'];?>" readonly="readonly">
					<input type="hidden" name="txt_num_dsp" value="<?php print $dados[0]['num_dsp'];?>" />
					<input type="hidden" name="txt_ano" value="<?php print $dados[0]['ano'];?>" />

					<label>Missão</label>
					<textarea rows="5" cols="30" name="txt_missao" id="txt_missao" title="Missão a Cumprir" class="span10 field" <?php print ($alterar) ? "readonly='readonly'" : "";?>>
<?php print utf8_encode(trim($dados[0]['missao'])); ?></textarea>

					<label>Destino</label>
					<!--<?php Municipio::PegaMunicipio(false, Estado::getArrayNomeUf());?>
					<button type="button" name="btn_add_destino" id="btn_add_destino" class="btn btn-primary" <?php print ($alterar) ? "disabled='disabled'" : "";?>>Adicionar</button>
					<br />
					
					<textarea rows="5" cols="30" name="txt_destino" id="txt_destino" class="spa10" readonly="readonly"><?php
					
					   $arrayDestino = explode(',', $dados[0]['destino']);
                       
                       for ($i=0; $i <count($arrayDestino); $i++){
                           
                           if($arrayDestino[$i] != ""){
                             
                             print $arrayDestino[$i].",";  
                               
                           } 
                           
                       } 
                    					
					?>    
					</textarea>

					<!-- botao limpar texarea
                    <button type="button" class="btn btn-primary" id="btn_limparm" title="Limpa a caixa para Correção do nome do município" <?php print ($alterar) ? "disabled='disabled'" : "";?>>Corrigir</button>-->
                    
					
					<!-- armazena a lista com o(s) destinos da DSP -->
					<!-- <input type="hidden" name="txt_lista_destino" id="txt_lista_destino">-->
                    <textarea rows="5" cols="30" name="txt_lista_destino" id="txt_lista_destino'" class="spa10"><?php print utf8_encode($dados[0]['destino'])?></textarea>

                    <?php 
                    
                        $tipoTransporte = "";
                        
                        switch ($dados[0]['tp_transporte']) {
                            case 1:
                                $tipoTransporte = "Veículo Oficial";
                                break;
                            case 2:
                                $tipoTransporte = "Veículo Particular";
                                break;
                            case 3:
                                $tipoTransporte = "Aeronave do Estado";
                                break;
                            case 4:
                                $tipoTransporte = "Vôo Comercial";
                                break;
                            case 5:
                                $tipoTransporte = "Ônibus Rodoviário";
                                break;
                            default:
                                $tipoTransporte = "Selecione o Tipo de Transporte";
                                break;
                        }
                    
                    
                    
                    ?>
                    
                    
                    <label>Tipo de Transporte</label>
                        <select name="sel_transporte" id="sel_transporte">
                            <option value="<?php print $dados[0]['tp_transporte']?>"><?php print $tipoTransporte; ?></option>
                            <option value="1">Veículo Oficial</option>
                            <option value="2">Veículo Particular</option>
                            <option value="3">Aeronave do Estado</option>
                            <option value="4">Vôo Comercial</option>
                            <option value="5">Ônibus Rodoviário</option>
                        </select>

					<label>Código DSP</label>
					<?php EquipeDSP::ComboCodDsp($dados[0]['id_dsp'], $alterar);?>

					<label>Data/Hora Partida</label>
					<input type="text" name="txt_dt_partida" id="txt_dt_partida" title="Data e Hora de Partida" class=""
						data-mask="99/99/9999_99:99" value="<?php print DataMysql::dataCompletaVisual($dados[0]['partida']);?>" <?php print ($alterar) ? "readonly='readonly'" : "";?>>

					<label>Data/Hora Chegada</label>
					<input type="text" name="txt_dt_chegada" id="txt_dt_chegada" title="Data e Hora de Chegada" class=""
						data-mask="99/99/9999_99:99" value="<?php print DataMysql::dataCompletaVisual($dados[0]['chegada']);?>" >

					<br>
					
					<!--  MEMBROS DSP--> 
					<?php $helper->input("select", "membroEquipe", "Membros da Equipe", false, $_funcionario->dadosCombo());
					?>
					
					<button type="button" id="btn_add_funcionario" id="btn_add_funcionario" class="btn btn-primary" <?php print ($alterar) ? "disabled='disabled'" : "";?>>Adicionar</button>
					<br>
					<br><br><br>
					<span class="alert alert-danger">* Obs : O primeiro membro na lista da equipe será o CMT da DSP.</span>
					<br /><br>
					<?php $dadosDiligente = $_dsp->buscaIdNomeDiligente($dados[0]['id_dsp']);

                    $listaDiligente = "";
                    $listaIdDiligente = "";
                    
                    for ($i= 0; $i < count($dadosDiligente); $i++) {
                        
                       $listaDiligente .= $dadosDiligente[$i]['nome'].", ";
                       $listaIdDiligente .= $dadosDiligente[$i]['idFuncionario'].", "; 
    
                    }

					?>
					
					<!-- Lista com os Diligente -->
					<textarea rows="5" cols="30" name="txt_funcionario" id="txt_funcionario" class="span10" readonly="readonly">
<?php print utf8_encode($listaDiligente); ?>
					</textarea>

					<!-- botao limpar texarea -->
					<button type="button" class="btn btn-primary" id="btn_limpar" title="Limpa a caixa para Correção dos Membros da Equipe" <?php print ($alterar) ? "disabled='disabled'" : "";?>>Corrigir</button>
					<br>
					
					<!-- CHEFE DIRETO-->
					<?php $helper->input("select", "chefeDireto", "Chefe Direto", false, $_funcionario->dadosCombo(), array('id_chefe'=>$dados[0]['id_chefe'], 'nome'=>$_funcionario->getFuncionarioId($dados[0]['id_chefe'])));
					//var_dump($dados[0]['id_chefe']);
                    
					?>
					
					<input type="hidden" name="idFunc" id="idFunc" />
					<!-- armazena a lista com os funcionarios da DSP -->
					<input type="hidden" name="txt_lista_func" id="txt_lista_func" value="<?php print $listaIdDiligente; ?>">
					<br><br><br>
										
					<input type="submit" class="btn btn-primary" value="Alterar" name="btn_envia" id="btn_envia" onclick="return confirm('Confirmar a Alteracao da DSP ?');">
					
					</form>

		
			</div>

		<!-- RODAPE -->
		<div class="row-fluid">
			<div class="span12 text-center">
				<small><?php print RODAPE;?> </small>
			</div>
		</div>
	</div>

	<script src="<?php print SISTEMA;?>/js/jquery.js"></script>
	<script src="<?php print SISTEMA;?>/js/bootstrap.js"></script>
	<script src="<?php print SISTEMA;?>/js/jasny-bootstrap.js"></script>
	<script src="<?php print SISTEMA;?>/js/funcaobase.js"></script>

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
            
            if(($("input[name=tpDSP]:checked").val() == "1") && (qtdFunc == 1)){ //civil){
            
                $("#btn_add_funcionario").prop("disabled", true);
                alert("Só é permitido um Funcionário civil por DSP !!" );
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
            
        /* alterar chefe dsp */
        $("#selChefeDireto").change(function(){

            idFunc = $("#selChefeDireto").val();

            $("#idChefe").val(idFunc);

            });
            

        $("#tpDSP").attr("checked", true);
        $("#tpDSP").val("0");
        
    });

    /* monta lista com os destinos da dsp */
	$(document).ready(function(){

		$("#btn_add_destino").click(function(){

			nome += $("#id_municipio option:selected").text() + ",";
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
     </script>

</body>
</html>
