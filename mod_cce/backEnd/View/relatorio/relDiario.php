<?php include_once PATH.'/core/include.php';

//$_conexao = new ConexaoMysql();

$_diario = new Diario();

$_usuario = new Usuario();

?>

<style type="text/css">
	* {

		font: 12px "Tahoma";
		box-sizing: border-box;
		-moz-box-sizing: border-box;
	}

	.texto {

		font-size: 10px;
		padding: 0;
		margin: 0 border-spacing;

	}

	.campo {

		font-size: 11px;
		padding: 0;
		margin: 0 border-spacing;

	}

	@media screen {

		body {
			margin: 0;
			padding: 0;
			background-color: #FAFAFA;
		}

		.pagina {
			width: 21cm;
			/*min-height: 29.7cm;*/
			padding: 0.5cm;
			margin: 0.5cm auto;
			border: 1px #D3D3D3 solid;
			border-radius: 5px;
			background: white;
			box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
		}

		.paginaLandscape {
			width: 29.7cm;
			min-height: 21cm;
			padding: 0.5cm;
			margin: 0.5cm auto;
			border: 1px #D3D3D3 solid;
			border-radius: 5px;
			background: white;
			box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
		}

		.quebra {

			clear: both;
			page-break-inside: always;
		}

		table {

			width: 100%;
			margin: 0;
			padding: 0;
		}

	}

	@media print {

		.imprimir {

			display: none;
		}

		body {
			margin: 0;
			padding: 0;
		}

		.pagina {
			width: 100%;
			/* min-height: 29.7cm; */
			/* min-height: 28cm; */
			padding: 0.5cm;
			margin: 0.5cm auto;
		}

		.paginaLandscape {
			min-width: 29.7cm;
			
			/* min-height:     28cm; */
			min-height: 21cm;
			padding: 0.5cm;
			margin: 0.5cm auto;
		}

		table {

			width: 100%;
			margin: 0;
			padding: 0;
			border-collapse: collapse;
		}

	}

</style>
        
        <?php
        
            
        
            $_dtInicial = (isset($_POST['txt_dtInicial'])) ? DataMysql::dataForm($_POST['txt_dtInicial']) : null;  
            $_dtFinal   = (isset($_POST['txt_dtFinal']))   ? DataMysql::dataForm($_POST['txt_dtFinal']) : null;  
            $_palavra   = (isset($_POST['txtPalavra']))    ? $_POST['txtPalavra'] : null;
             //var_dump($_POST);
            // var_dump($_dtInicial);
        
            $_relatorio = $_diario->relatorioDiario($_dtInicial,$_dtFinal, $_palavra);
            
            //var_dump($_relatorio);

        ?>
        
        <div class="topo">
            <br>
                <div class="imprimir" style="text-align: center"><?php print FuncaoBase::vifs('volta', 'index.php?token='.hash('sha256', md5(VERSAO)).'&ac=itn&modulo=cce&controller=cce&action=filtroRelDiario'); ?>
                    <?php print FuncaoBase::vifs('imprimir'); ?>
                </div>
        </div>
        
        <div class="pagina">
            <div class="text-center">
                <table class="table table-bordered table-striped">
                    <tr>
                        <td colspan="4" style="text-align: center">DIÁRIO DO PLANTÃO - Período <?php print DataMysql::dataVisual($_dtInicial). " a ". DataMysql::dataVisual($_dtFinal);?> </td>
                    </tr>
                    <tr>
                        <th width="7%" align="center">nº</th>
                        <th width="15%" align="center">Data/Alteração</th>
                        <th width="10%" align="center">Hora</th>
                        <th width="68%" align="center">Histórico</th>
                        <th width="20%" align="center">Funcionário</th>
                    </tr>
                    <?php 
                        
                        
                        for ($i=0; $i < count($_relatorio) ; $i++) {
                            
                            $_dt_altera = ($_relatorio[$i]['dt_altera'] != $_relatorio[$i]['dt_diario'] ) ? $_relatorio[$i]['dt_altera'] : "";
                            
                            print "<tr>
                                    <td>".$_relatorio[$i]['num'].".".$_relatorio[$i]['num_sub']."</td>
                                    <td>".DataMysql::dataVisual($_relatorio[$i]['dt_diario'])."<br>".$_dt_altera."</td>
                                    <td>".$_relatorio[$i]['hora']."</td>
                                    <td style=\"text-align:justify\">".$_relatorio[$i]['historico']."</td>
                                    <td>".$_usuario->getNomeId($_relatorio[$i]['id_funcionario'])."</td>
                                  </tr>";
                            $_dt_diario = $_relatorio[$i]['dt_diario'];
                    }?>
                </table>