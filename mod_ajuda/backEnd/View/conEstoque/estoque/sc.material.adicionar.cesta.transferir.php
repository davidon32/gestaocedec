<?php session_start();

  print "<!DOCTYPE html>";

  include_once '../include.php';

  //unset($_SESSION['cesta']);

  $_conexao = new ConexaoMysql();
  
  $_login = new Login();
  
  $_login->Sessao();

  $_produto = new Produto();
  
  

?>
<html>
  <head>
    <title><?php print TITULO;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
    <!-- Bootstrap -->
    <link href="<?php print SISTEMA;?>/css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="<?php print SISTEMA;?>/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
  </head>
  <body style="background-color: #C4E3F3;">
  	<div class="container">
  		<div class="row">
  			<div class="span12">
          <form action="#" method="POST" name="frm_cesta">
            <table class="table">
                <tr>
                  <td>Descrição</td><td>Quantidade</td><td>Ação</td>
                </tr>
                <tr>
                  <td>
                    <?php $_produto->PegaProduto();?>
                  </td>
                  <td>
                    <input type="text" class="input-mini" name="txt_qtd_produto">
                  </td>

                  <td><button type="submit" class="btn btn-primary" name="btn_enviar">Adicionar <i class="icon-plus-sign"></i></button></td>
                </tr>

            </table>
          <form>


        </div>
  		</div>
	 </div>

	
    
    <script src="<?php print SISTEMA;?>/js/jquery.js"></script>
    <script src="<?php print SISTEMA;?>/js/bootstrap.js"></script>
    <script src="<?php print SISTEMA;?>/js/jasny-bootstrap.js"></script>
    <script src="<?php print SISTEMA;?>/js/funcao.base.js"></script>
  </body>
</html>


<?php

  $_enviar          = isset($_POST['btn_enviar'])      ? true                      : "";                     
  $_txt_cod_produto = isset($_POST['txt_cod_produto']) ? $_POST['txt_cod_produto'] : ""; 
  $_txt_nome        = isset($_POST['txt_nome'])        ? $_POST['txt_nome']        : ""; 
  $_txt_qtd_produto = isset($_POST['txt_qtd_produto']) ? $_POST['txt_qtd_produto'] : ""; 

  if($_enviar) {

    $cesta = AddConta($_txt_cod_produto, $_txt_nome, $_txt_qtd_produto);

  }

  if(isset($cesta)){

    LerCesta($cesta);

  }

  

  
function AddConta($_id_produto, $_nome, $_qtd){

    $_SESSION['cesta'][] = array($_id_produto, $_nome, $_qtd);

    return $_SESSION['cesta'];

}

function LerCesta($_cesta) {

  //var_dump($_SESSION);

  print "<table class=\"table\">";

  print "<tr><td>Nome</td><td>Quantidade</td></tr>";

  for ($i = 0; $i < count($_cesta); $i++) {

    for ($j = 0; $j <count($_cesta[$i]); $j++) {
    
      print "<tr><td>".$_cesta[$i][$j]."</td>";
      //print "<td>".$_cesta[$i+1][$j]."</td></tr>";

    }

  }
  print "</table>";


  


}
//unset($_SESSION['cesta']);

//var_dump($_SESSION['cesta']);

?>
