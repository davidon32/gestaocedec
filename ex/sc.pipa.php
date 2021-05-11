<?php
    session_start();
include_once "include_ex.php";
print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";


if(!isset($_SESSION['rota'])){
    
    $_SESSION['rota'] = array();
    
}




?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php print TITULO; ?></title>
<link href="../css/bootstrap.css" rel="stylesheet" media="screen">
<link href="../css/bootstrap-responsive.css" rel="stylesheet" media="screen">
</head>
<body>
    <div class="container-fluid">
        <br>
        <br>    

        <table border="1" id="tbl_rota">
            <tr>
                <td colspan="16" class="text-center">Composição de Rota</td>
            </tr>
            <tr>
                <td colspan="16" class=""><button id="btn1">Adicionar</button></td>
            </tr>
            <tr>
                
                <td>#</td>
                <td>Comunidade</td>
                <td>Reservatorio</td>
                <td>Pavimentado</td>
                <td>Terra</td>
                <td>Total Distância</td>
                <td>Momento Transporte</td>
                <td>População Atendida</td>
                <td>Necessidade Diária</td>
                <td>Necessidade Mensal</td>
                <td>Capacidade Caminhão m³</td>
                <td>Nº Viagens</td>
                <td>Nº Viagens Real</td>
                <td>Local Contrato</td>
                <td>Valor Final</td>
            </tr>
            
            
        </table>

</div>

</body>
</html>

<script src="<?php print SISTEMA;?>/js/jquery.js"></script>
<script src="<?php print SISTEMA;?>/js/bootstrap.js"></script>
<script src="<?php print SISTEMA;?>/js/jasny-bootstrap.js"></script>

<script type="text/javascript">
    
   $(document).ready(function(){
       
       
        $('#pesquisa_produto').on('click', function (e) {

            window.open('sc.pedido.buscar.php','Pesquisa de Produtos','width=400,height=300 left=-50,top=200');

        })

   });*/
        
    
    
</script>





