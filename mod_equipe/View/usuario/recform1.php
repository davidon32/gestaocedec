<?php include_once "mod_equipe/Model/indexModel.php";
include_once $_SERVER['DOCUMENT_ROOT'] .'/core/include.php';?>
<?php include_once "template/page/headerPageSimples.php";?>
<style>
    #div-icon{
        display: none;
    }
</style>
<div style="width:600px; margin:0 auto;">
    <?php
$sistema = isset($_SESSION['seguranca']['id_municipio'])? true : false;

$usuario = new Usuario();

$_funcaoBase = new FuncaoBase();

$helper = new Html();

$enviaEmail = new Email();

$_funcionario = new EquipeFuncionario();

$municipio = new Municipio();


?>

    <br>
    <br>
    <br>
    <span class="">Digite o email de recuperação de senha</span>
    <?php
            
                $helper->form("#", "POST", "resSenha", "Recuperação de Senha");
                            
                $helper->span("Coloque o email que está Cadastro no sistema !");
                $helper->input("text", "email", "email", false, array('class'=> 'form-control')); 

                print "<br><span style='color:red;' id='ckEsqueciEmail'>Esqueceu seu email ? digite seu municipio</span> &nbsp;&nbsp;&nbsp;&nbsp;";

                print "<input type='checkbox' id='ckMunicipio' name='ckMunicipio' class='form-checkbox'>";

                $helper->input("text", "municipio", "", false, array('class'=> 'form-control')); 
                 
                print "<br>";
                $helper->formEnd("Resetar");
		
			$email = isset($_POST['txtEmail']) ? $_POST['txtEmail'] : false;
            $nomeMun = isset($_POST['txtMunicipio']) ? $_POST['txtMunicipio'] : false;
            $btnEnviar = isset($_POST['btnResetar']) ? true : false;

	if ($btnEnviar) {

        # campos em branco
        if((empty($email)) && (empty($nomeMun))) {
            print "<script>";
            print "Swal.fire('Preencha Um dos campos !');";
            print "</script>";
        }else {

            /* verifica usuario externo */
			if((empty($email))  && (strlen($nomeMun) >0)){

                $email_rec = $usuario->buscaEmailRecMunicipioUserExterno($nomeMun);
                
            }else {
                $email_rec = $usuario->buscaEmailRecUserExterno($email);
            }
            

            /* verifica usuario interno */
            if(count($email_rec) == 0){
                $email_rec = $usuario->buscaEmailRecUser($email);
            }

                    if(!empty($email_rec)){    
                        
                               var_dump($email_rec);             
                       $_resultado = $usuario -> resetaSenha(false, $email_rec);   

                       
                       die();
                        if(!is_null($_resultado)){
                            if ($_resultado[0] == true) {

                                $quebraEmail = substr($email_rec[0]['email_rec'], 0, 4)."******".substr($email_rec[0]['email_rec'], strpos($email_rec[0]['email_rec'], "@"));

                                $usuario = isset($_resultado[2]) ? utf8_decode("Seu usuário é : <br> ".$_resultado[2]."<br> ou <br>".$_resultado[3])."<br>" : "";
                                
                                $mensagem = 
                                # envia o email para o usuario
                                $resultado = $enviaEmail->emailIndividual($email_rec[0]['email_rec'], utf8_decode("SGECEDEC - Recuperação de Senha"), $usuario." ".utf8_decode("<br>Sua nova senha é :\n<b>")." ".$_resultado[1]."</b>".utf8_decode(" <br>\nesta senha é temporária será preciso alterá-la."), "defesacivil@defesacivil.mg.gov.br");
                    
                                #@ redirecionar em case de erro de senha e usuario
                                print "<script>";
                                print "Swal.fire('Senha Resetada com Sucesso !',
                                'Foi enviado um email para : <b>".$quebraEmail."</b>, consulte sua sua caixa de entrada para alterar a senha ! /b Obs: O Sistema enviará um email com a senha temporária que deverá ser trocada.',
                                'info')";
                                print "</script>";
                                
                            }
                        }
                    }else{

                        //print "<script>alert(\"Senha resetada com Sucesso! Consulte sua sua caixa de email para alterar a senha !\");";
                        //print "</script>";
                        print "<br><br><span class='alert alert-error'>Email não está cadastrado na base de dados !</span><br><br>";
                    }
            
			       
		}
	}
			
			?>
</div>

<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>
<?php

    $municipio = new Municipio();
    $municipios = $municipio->dadosSelectMunicipio();

?>


<script>
	$(document).ready(function(){

        $('#esqueciEmail').hide();
        $('#txtMunicipio').hide();
        $('#lbMunicipio').hide();



        $("#ckMunicipio").click(function(){
            
            if($("#ckMunicipio").is(":checked")){
                // checado ?
                $('#esqueciEmail').show();
                $('#txtMunicipio').show();
                $('#lbMunicipio').show();
                $("#txtEmail").val("");
            }else {
                // nao checado
                $('#esqueciEmail').hide();
                $('#txtMunicipio').hide();
                $('#lbMunicipio').hide();
            }

        });
		
        
	var itens = {
			data: 
					<?php print json_encode($municipios);?>, // array com os dados
				
				getValue: "nome",

					list: {
					match: {
						enabled: true
					},
	
						onSelectItemEvent: function() {
							var value = $("#txtMunicipio").getSelectedItemData().id_municipio;
							
								$("#txtIdMunicipio").val(value);
								//$("#txtIdComunidadeSearch").val(value).trigger("change");
							
	
						}

				}

		};

        $("#txtMunicipio").easyAutocomplete(itens);

	});
</script>
