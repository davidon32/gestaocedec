<?php 

	$dados = $_relatorioCompdec->relCompdecEndereco();
            
            $_tot_reg = count($dados);
            
            ?>
            <br><br>
            <table class="table table-condensed table-bordered">
                <tr>
                	<td colspan="9" style="text-align: center"><legend>Relação de Endereço das Compdecs de Minas Gerais</legend></td>
                </tr>
                <tr>
                    <th>Código</th>
                    <th>Município</th>
                    <th>Endereço Prefeitura</th>
                    <th>Fone</th>
                    <th>Coordenador</th>
                    <th>Tel. Coordenador</th>
                    <th>Celular Coordenador</th>
                    <th width="200px;">E-mail Prefeitura</th>
                    <th>Última Atualização</th>             
                </tr>
            
            <?php
            
            //var_dump($dados[1]);
            
            for ($i=0; $i < $_tot_reg ; $i++) {
            	
            	$dadosCoordenador = $_relatorioCompdec->buscaCoordenador($dados[$i]['id_municipio']);
            	
            	//var_dump($dadosCoordenador);
  
                 print "<tr>
                    <!--<td style=\"font-size: 11px; white-space: nowrap;\">".($i+1)."</td>-->
                    <td style=\"font-size: 11px; white-space: nowrap;\">".($dados[$i]['id_comdec'])."</td>
                    <td style=\"font-size: 11px; white-space: nowrap;\">".$dados[$i]['nome']."</td>
                    <td style=\"font-size: 11px;\">".utf8_encode($dados[$i]['endereco'])."</td>
                    <td style=\"font-size: 11px;\">".$dados[$i]['fone_com1']."</td>";
                 print "<td style=\"font-size: 11px;\">".(!empty($dadosCoordenador['nome']) ? $dadosCoordenador['nome'] : "")."</td>
                    <td style=\"font-size: 11px;\">".(!empty($dadosCoordenador['telefone']) ? $dadosCoordenador['telefone']:"")."</td>
                    <td style=\"font-size: 11px;\">".(!empty($dadosCoordenador['celular']) ? $dadosCoordenador['celular'] :"")."</td>
                    <td style=\"font-size: 11px;\">".$dados[$i]['email']."</td>
					<td style=\"font-size: 11px;\">".DataMysql::dataCompletaVisual($dados[$i]['ultimo_atualiza'])."</th>                    		
                 </tr>";

            }
 
            ?>
            
            <tr>
                <td colspan="9">Total de Registros : <?=$_tot_reg;?></td>
            </tr>      
    
            </table>