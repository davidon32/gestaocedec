
<?php 
 $_listaPorAssociacao = $_associacao->qtdCompdecAssociacao();
            
            $_listaPorRegiao = $_regiao->qtdCompdecRegiao();
            
            $_listaPorRegiaoDesenv = $_regiao->qtdCompdecRegiaoDesenv();
            
            /* Existe compdec e está ativa */
            $_totalExistente = $_compdec->qtdCompdecExitente(true, true);
            
            # sem compdec
            $_totalSemCompdec = $_compdec->qtdCompdecExitente(false, false);
            
            print "<br>
            		<table class=\"table table-bordered\">
            			<tr>
            				<th>Municípios com COMPDEC Ativa</th>
            				<th>Municípios COMPDEC Inativa</th>
            				<th>Município Sem COMPDEC</th>	
            			</tr>
						<tr>
            				<td width='33.3%'><canvas id=\"compdecExistente\"></canvas></td>
            				<td width='33.3%'><canvas id=\"compdecInativa\"></canvas></td>
            				<td width='33.3%'><canvas id=\"semCompdec\"></canvas></td>	
            			</tr>
				</table>";
            print "
            		<table class=\"table\">
            			<tr>
            				<th width=\"33.3%\">Municípios com NUPDEC</th>
                                        <th width=\"33.3%\">Plano de Contingência</th>                                        
            				<th width=\"33.3%\">Municipios com Mapeamento de Área de Risco</th>
            				
            			</tr>
                                <tr>
            				<td><canvas id=\"possuiNupdec\"></canvas></td>
                                        <td><canvas id=\"possuiPlano\"></canvas></td>
            				<td><canvas id=\"possuiMapeamento\"></canvas></td>            				
            			</tr>";
            print "<br>
            		<table class=\"table\">
            			<tr>
            				<th width=\"33.3%\">Plano de Contingência</th>
            				<th width=\"33.3%\">Municipios com Capacitação</th>
            				<th width=\"33.3%\">Municipios com Capacitação</th>
            			</tr>
				<tr>
            				<td><canvas id=\"possuiPlano\"></canvas></td>
            				<td><canvas id=\"possuiPlano\"></canvas></td>
            				<td><canvas id=\"possuiPlano\"></canvas></td>
            			</tr>
				</table>";

             print "<br><table class=\"table\">
                        <tr>
	                        <th width='70%'>Compedc´s Existentes</th>
                            <th width='30%'>Qtd</th>
                        </tr>
                        <tr>
                            <td>Total Compdec Existentes ( Lei de criação e Coordenador atuante ):</td>
                            <td><b>".$_totalExistente."</b></td>
                        </tr>
                        <tr>
                            <td>Total Inexistente ( Não tem COMPDEC Regulamentada ):</td>
                            <td><b>".$_totalSemCompdec."</b></td>
                        </tr>
                        
                        
                        <tr>
                            <td><b>Total</b></td>
                            <td><b>".$_totalCompdec = $_totalExistente + $_totalSemCompdec."</b></td>
                        </tr>
               </table>";
             
               print "<table class=\"table table-bordered\">
                                    <tr>
                                        <th width='70%'>Resumo por Associação</th>
                                        <th width='30%'>Qtd</th>
                                    </tr>";
                                    
                                    $_totalCompdecAssociacao = 0;           
                                    
                                    for ($i=0; $i < count($_listaPorAssociacao); $i++) {
                                        
                                        print "<tr>
                                                <td>".utf8_encode($_listaPorAssociacao[$i]['nome'])."</td>
                                                <td>".$_listaPorAssociacao[$i]['num_compdec']."</td>
                                               </tr>";
                                        $_totalCompdecAssociacao += $_listaPorAssociacao[$i]['num_compdec'];
                                    }
                                    
                                        print "<tr>
                                                    <td><b>Total</b></td>
                                                    <td><b>".$_totalCompdecAssociacao."</b></td>
                                               </tr>";
                                    print "</table>";
                             
                             print "<td>
                                        <table class=\"table table-bordered\">
                                            <tr>
                                                <th width='70%'>Resumo por Regiao</th>
                                                <th width='30%'>Qtd</th>
                                            </tr>";
                             $_totalCompdecRegiao = 0;               
                             for ($i=0; $i < count($_listaPorRegiao); $i++) {
                                        
                                        print "<tr>
                                                <td>".utf8_encode($_listaPorRegiao[$i]['nome'])."</td>
                                                <td>".$_listaPorRegiao[$i]['num_compdec']."</td>
                                            </tr>";
                                        $_totalCompdecRegiao += $_listaPorRegiao[$i]['num_compdec'];
                                    }
                                    print "<tr>
                                            <td><b>Total</b></td>
                                            <td><b>".$_totalCompdecRegiao."<b></td>
                                           </tr>";
                                           
                                    print "</table>" ;
                                    
                                    print "<table class=\"table table-bordered\">";
                                        print "<tr>
                                                <th width='70%'>Resumo por Território Desenvolvimento</th>
                                                <th width='30%'>Qtd</th>
                                                
                                               </tr>
                                               <tr>";
                                                    $_totalCompdecRegiaoDesenv = 0;
                                                    
                                                    for ($i=0; $i < count($_listaPorRegiaoDesenv); $i++) {
                                        
                                                        print "<tr>
                                                                <td>".utf8_encode($_listaPorRegiaoDesenv[$i]['nome'])."</td>
                                                                <td>".$_listaPorRegiaoDesenv[$i]['num_compdec']."</td>
                                                            </tr>";
                                                        $_totalCompdecRegiaoDesenv += $_listaPorRegiaoDesenv[$i]['num_compdec'];
                                                    }

                                               print "</tr>";
                                               print "<tr>
                                            <td><b>Total</b></td>
                                            <td><b>".$_totalCompdecRegiaoDesenv."<b></td>
                                           </tr>";
                                    print "</table>";             
                             
                                    print "</td>
                                           </tr>
                                           </table>";
?>        


