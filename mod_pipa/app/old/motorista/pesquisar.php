<?php session_start();
	print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
	include_once PATH.'/include.php';
	
?>
<html>
<head>
<title>Pesquisa de Motorista</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
</head>

<div class="container">
	<div class="row-fluid">
		<legend>Pesquisa de Motorista</legend>
		<br>
		<i style="color: red;"> Obs: Digite o CPF do Motorista previamente Cadastrado no Sistema.</i>
		<br>
		<br>
		<form action="#" method="POST" name="" id="" class="" />
			<table class="table">
			    
			    <tr>
			        <td colspan="2">CPF/CNPJ Motorista</td>
			    </tr>
			    <tr>
			        <td><input type="text" name="txtCpf" id="txtCpf" size="40" /></td>
			        <td><input class="btn btn-primary" type="submit" name="envar" id="enviar" value="Pesquisar" class="" /></td>
			    </tr>
			    <tr>
			        <td><span style="color:red">Obs:<br> CPF formato 999.999.999-99 <br>
                                 CNPJ formato 99.999.999/9999-99
                    </span></td>
			    </tr>
			</table>
			
		</form>

	</div>


	<?php 

	$_cpf= isset($_POST['txtCpf']) ? $_POST['txtCpf'] : null;

			if($_cpf != null) {

			    $dados = Motorista::MotoristaSemContrato($_cpf);

			    //var_dump($dados);
			    
			    if(empty($dados)){
			        
                    print "<span style=\"color:red\">Motorista não cadastrado no sistema !</span>";
                    
			    }else {

    			    for ($i = 0; $i < count($dados); $i++){
    			        
                        //var_dump($dados);
                      
                        if($dados[$i]['situacao'] == "A") {
                            
                            print "<span style='color:red'>".utf8_encode($dados[$i]['nome'])." - ". $dados[$i]['placa']." - Contrato Ativo </span><br>";

                        }else {
                            
                            if($dados[$i]['pessoa'] == "PF") {
                                
    			                 print "<a href=\"#\" name='nome_mot' onclick=\"javascript:levarcodigo('".$dados[$i]['id_motorista']."', '".utf8_encode($dados[$i]['nome'])."');\" title=\"Clique para Adicionar o Motorista\">".utf8_encode($dados[$i]['nome'])."( Motorista sem Contrato )<br></a>";
                            
                            }else {
                            
                                print "<a href=\"#\" onclick=\"javascript:levarcodigo('".$dados[$i]['id_motorista']."', '".utf8_encode($dados[$i]['nome'])."');\" title=\"Clique para Adicionar o Motorista\">".utf8_encode($dados[$i]['nome'])." - ".$dados[$i]['placa']."<br></a>";
                                
                            }
                        }
    
    			    }
    			}
			}
            
            ?>
            
            <br>
            <br>
            <div class="span12 text-center">
                <?php
                    FuncaoBase::Fechar();
                ?>
                
                
                
            </div>
            
            
			        
</div>
	<script src="/js/jquery.js"></script>
	<script src="/js/bootstrap.js"></script>
	<script src="/js/jasny-bootstrap.js"></script>
	<script src="/js/funcaobase.js"></script>
	<script>
   
    function levarcodigo( id_motorista, nome )
    {
       /** O "segredo" está aqui nessas duas linhas, onde é passado o codigo para o <input>
       *    e a descricao para o <label>
       */
       top.opener.document.getElementById("id_motorista").value = id_motorista;
       top.opener.document.getElementById("nome_mot").value = nome;
       window.close();
    }
 
    </script>
	
</body>
</html>



