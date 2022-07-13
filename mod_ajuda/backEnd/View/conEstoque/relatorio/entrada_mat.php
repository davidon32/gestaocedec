<?php include_once PATH.'/core/include.php';?>
<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_ajuda/Model/indexModel.php";?>
<?php

$dados = Material::listaEntradaMaterialId($_GET['id']);

?>

<style type="text/css">

      
    .sem_quebra {
        white-space: nowrap !important;
    }
    
        
	@media print {
            .imprimir {
                display: none;
                
            }
           font-size: 9pt !important;
	}
        
        @media screen{
            
            table {
                
                width: 600px !important;
                
                
            }
            
        }
	
	*{
		font-family: Courier;
		font-size: 13px;
		color:#666666;
		vertical-align:text-top;
	}

	body {
		margin: auto;
	}

	table {
		border-collapse: collapse;
	}

	.cabecalho {
		background:#CCCCCC;
		text-align:center;	
	}

	.rodape {
		font-size: 10px;
		text-align: center;
	}

	#bg img { 
        height:100%; 
        opacity:.5; 
        z-index: -1;
        position: absolute;
        margin-left: 10%;
        width: 300px;
        height: 300px;         
	}
        
        
</style>
    
       
<br><br>
<div align="center" class="col-md-12">
    <a href='#' onclick='window.close();'>Fechar</a>
</div>
<br>

    <table align="center" class="table table-cell" border='1'>
        <tr>
            <th>Cod Entrada</th>
            <th>Cod. Mat.</th>
            <th>Nome</th>
            <th>Dt Entr./Saida</th>
        </tr>
        <tr>
        <?php
        print "<td>".$dados[0]['id_produto']."</td>";
        print "<td>".$dados[0]['codProd']."</td>";
        print "<td>".$dados[0]['nome']."</td>";
        print "<td>".$dados[0]['dtEntradaSaida']."</td>";
        ?>
        </tr>
        <tr>
            <th>Origem</th>
            <th>Obs</th>
            <th>Qtd</th>
            <th>Dep. Entrada </th>
        </tr>
            <?php
            
        print "<td>".$dados[0]['origem']."</td>";
        print "<td>".$dados[0]['obs']."</td>";
        print "<td>".$dados[0]['quantidade']."</td>";
        print "<td>".$dados[0]['depDestino']."</td>";
        ?>
        </tr>
            <th>Validade</th>
            <th>Nota_fiscal</th>
            <th>Nota Vinculada</th>
            <th>Descricao</th>
        </tr>
        <tr>
        <?php
        print "<td>".$dados[0]['validade']."</td>";
        print "<td>".$dados[0]['nota_fiscal']."</td>";
        print "<td>".$dados[0]['id_entrada']."</td>";
        print "<td>".$dados[0]['descricao']."</td>";
  
        print "</tr>";
        ?>
        <tr>
            <th>Cancelado</th>
            <th>Feito Por</th>
            <th></th>
            <th></th>
        </tr>
            <?php
            print "<tr>";
            print "<td>".($dados[0]['cancelado'] == 0 ? "Não" : "Sim")."</td>";
            print "<td>".($dados[0]['id_usuario'] == "") ? "-" : Usuario::getNomeId($dados[0]['id_usuario'])."</td>";
            print "<td></td>";
            print "<td></td>";
            print "</tr>";
        
        ?>

</table>

