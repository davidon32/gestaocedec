<style>
    * { font-size: 12pt; }
    
</style>
<table width="0" class='table table-bordered'>
    <tbody>
        <tr>
            <td align='center' colspan="2" width="155">
                <img src="/core/imagem/brasao.png"> </td>
            <td colspan="8" width="422">
                <p style="text-align: center"><strong>GOVERNO DO ESTADO DE MINAS GERAIS</strong></p>
                <p style="text-align: center"><strong>GABINETE MILITAR DO GOVERNADOR COORDENADORIA ESTADUAL DE DEFESA CIVIL (CEDEC)</strong></p>
                <p><strong>&nbsp;</strong></p>
            </td>
            <td width="128">
                <p><strong>Pedido n&ordm;</strong></p>
                <p>&nbsp;</p>
                <p class=''><h1><?=$view['0']['numero']."-".$view[0]['ano']?></h1></p>
            </td>
        </tr>
        <tr>
            <td colspan="11" width="705">
                <p><strong>FORMUL&Aacute;RIO DE SOLICITA&Ccedil;&Atilde;O DE AJUDA HUMANIT&Aacute;RIA</strong></p>
                <p><strong>(EXCETO &Aacute;GUA PARA CONSUMO HUMANO)</strong></p>
            </td>
        </tr>
        <tr>
            <td colspan="11" width="705">
                <p>DADOS DO SOLICITANTE</p>
            </td>
        </tr>
        <tr>
            <td colspan="4" width="383">
                <p>Nome do Munic&iacute;pio: </p>
            </td>
            <td colspan="7" width="322">
                <p>Mesorregi&atilde;o</p>
            </td>
        </tr>
        <tr>
            <td colspan="4" width="383">
                <b><?=$view[0]['nome_cedec_municipio']?></b>
            </td>
            <td colspan="7" width="322">
                <b><?=$view[0]['nome_com_regiao']?></b>
            </td>
        </tr>
        <tr>
            <td colspan="4" width="383">
                <p>Nome do(a) Coordenador(a) Municipal de Prote&ccedil;&atilde;o e Defesa Civil</p>
                
            </td>
            <td colspan="3" width="123">
                <p>Telefone</p>
                
            </td>
            <td colspan="4" width="199">
                <p>E-mail</p>
                
            </td>
        </tr>
        <tr>
            <td colspan="4" width="383">
                <b><?=$view[0]['nome_coordenador']?></b>
            </td>
            <td colspan="3" width="123">
                <b><?=$view[0]['tel_coordenador']?> / <?=$view[0]['cel_coordenador']?></b>
            </td>
            <td colspan="4" width="199">
                <b><?=$view[0]['email_coordenador']?></b>
            </td>
        </tr>
        <tr>
            <td colspan="4" width="383">
                <p>Nome do(a) Prefeito(a)</p>
                
            </td>
            <td colspan="3" width="123">
                <p>Telefone</p>
                
            </td>
            <td colspan="4" width="199">
                <p>E-mail</p>
                
            </td>
        </tr>
        <tr>
            <td colspan="4" width="383">
                <b><?=$view[0]['nome_prefeito']?></b>
            </td>
            <td colspan="3" width="123">
                <b><?=$view[0]['tel_prefeito']?> / <?=$view[0]['cel_prefeito']?></b>
            </td>
            <td colspan="4" width="199">
                <b><?=$view[0]['email_prefeito']?></b>
            </td>
        </tr>
        <tr>
            <td colspan="11" width="705">
                <p>DADOS SOBRE O DESASTRE</p>
            </td>
        </tr>
        <tr>
            <td colspan="4" width="383">
                <p>Tipo de Desastre (C&oacute;digo do FIDE<a href="#_ftn1" name="_ftnref1">[1]</a>)</p>
                
            </td>
            <td colspan="4" width="170">
                <p>Popula&ccedil;&atilde;o afetada</p>
                
            </td>
            <td colspan="3" width="152">
                <p>Decreto de SE ou ECP vigente?</p>
                
            </td>
        </tr>
        <tr>
            <td colspan="4" width="383">
                <b><?=$view[0]['nome_dec_cobrade']?></b>
            </td>
            <td colspan="4" width="170">
                <b><?=$view[0]['pop_atendida']?></b>
            </td>
            <td colspan="3" width="152">
                <b><?=($view[0]['decreto_se_ecp_vig'] == 1) ? "Sim" : "Não" ?></b>
            </td>
        </tr>
        <tr>
            <td colspan="3" width="261">
                <p>N&uacute;mero do Decreto</p>
                
            </td>
            <td colspan="3" width="179">
                <p>Data de Vig&ecirc;ncia</p>
                
            </td>
            <td colspan="5" width="265">
                <p>Tipo de Decreto</p>
                
            </td>
        </tr>
        <tr>
            <td colspan="3" width="261">
                <b><?=$view[0]['numero_decreto']?></b>
            </td>
            <td colspan="3" width="179">
                <b><?= DataMysql::dataVisual($view[0]['data_vigencia'])?></b>
            </td>
            <td colspan="5" width="265">
                <b><?=$view[0]['tipo_decreto']?> - <?=($view[0]['tipo_decreto'] == 'ECP') ? 'Estado de Calamidade Pública': 'Situação de Emergência'?></b>
            </td>
        </tr>
        <tr>
</table>

<!-- MATERIAL  DO PEDIDO -->
<table class='table table-bordered'>
    <tr>
            <th colspan="11" width="705" style="text-align: center">
                <p><b>MATERIAL PEDIDO</b></p>
            </th>
        </tr>
        </tr>
            <th width="83">
                <p>C&oacute;d.</p>
            </th>
            <th colspan="4" width="338">
                <p>Descri&ccedil;&atilde;o do Item</p>
            </th>
            <th colspan="4" width="141">
                <p>Quantidade</p>
            </th>
            <th colspan="2" width="144">
                <p>Quantidade de Fam&iacute;lias a serem atendidas</p>
            </th>
        </tr>
        
        <?php
        
        #################################  MATERIAL PEDIDO ####################################################
        
        foreach ($materiaisPedido as $key => $material) {
            
            print "<tr>
                    <td width='83'>
                        <p>".$material['codigo']."</p>
                    </td>
                    <td colspan='4' width='338'>
                        <p>".$material['descricao_item']."</p>
                    </td>
                    <td colspan='4' width='141'>
                        <p>".$material['qtd']."</p>
                    </td>
                    <td colspan='2' width='144'>
                        <p>".$material['qtd_familia_atendida']."</p>
                    </td>
                </tr>";
            }
        ?>
</table>
<table class="table table-bordered">
        <tr>
            <td colspan="11" width="705">
                <p>ESFOR&Ccedil;OS J&Aacute; REALIZADOS PELO MUNIC&Iacute;PIO : </p>
                <b><?=$view[0]['esforcos_realizados']?></b>
            </td>
        </tr>
        
        <tr>
            <td colspan="11" width="705">
                <p>Local <?=$view[0]['nome_cedec_municipio']?>, Data <?= DataMysql::dataExtensoDocumento(DataMysql::dataCompletaVisual($view[0]['data_entrada_sistema']))?>.</p>
            </td>
        </tr>
        <tr>
            <!--<td colspan="11" width="705">
                <p>&nbsp;</p>
                <p>_____________________________________________________________</p>
                <p>Assinatura do Prefeito ou substituto legal</p>
            </td>-->
        </tr>
        <tr>
            <td width="83">&nbsp;</td>
            <td width="72">&nbsp;</td>
            <td width="107">&nbsp;</td>
            <td width="122">&nbsp;</td>
            <td width="38">&nbsp;</td>
            <td width="19">&nbsp;</td>
            <td width="66">&nbsp;</td>
            <td width="47">&nbsp;</td>
            <td width="9">&nbsp;</td>
            <td width="15">&nbsp;</td>
            <td width="128">&nbsp;</td>
        </tr>
    </tbody>
</table>

<p><strong><br /> </strong></p>
<p><strong>&nbsp;</strong></p>
<p><strong>ANEXO B &ndash; Formul&aacute;rio de solicita&ccedil;&atilde;o de ajuda humanit&aacute;ria (exceto &aacute;gua para consumo humano) &ndash; Fl. 02/02</strong></p>
<p>&nbsp;</p>
<table width="0" class='table table-bordered'>
    <tbody>
        <tr>
            <td align='center' colspan="2" width="155">
                <img src="/core/imagem/brasao.png"> </td></td>
            <td colspan="4" width="550">
                <p style="text-align: center"><strong>GOVERNO DO ESTADO DE MINAS GERAIS</strong></p>
                <p style="text-align: center"><strong>GABINETE MILITAR DO GOVERNADOR</strong></p>
                <p style="text-align: center"><strong>COORDENADORIA ESTADUAL DE DEFESA CIVIL (CEDEC)</strong></p>
                <p>&nbsp;</p>
            </td>
        </tr>
        <tr>
            <td colspan="6" width="705">
                <p style="text-align: center"><strong>FORMUL&Aacute;RIO DE SOLICITA&Ccedil;&Atilde;O DE AJUDA HUMANIT&Aacute;RIA</strong></p>
                <p style="text-align: center"   ><strong>(EXCETO &Aacute;GUA PARA CONSUMO HUMANO)</strong></p>
            </td>
        </tr>
        <tr>
            <td colspan="6" width="705">
                <p>PARECER TÉCNICO ALALISTA DO PROCESSO</p>
                <b><?=$view[0]['esforcos_realizados']?></b>
                
            </td>
        </tr>
        
       
       
    </tbody>
</table>

<!-- MATERIAL LIBERADO -->
<table class="table table-bordered">
        <tr>
            <th colspan="6" width="705" class="text-center">
                <p>RETIRADA/DISTRIBUI&Ccedil;&Atilde;O (MATERIAL LIBERADO)</p>
            </th>
        </tr>
        <tr>
            <th width="83">
                <p>C&oacute;d.</p>
            </th>
            <th colspan="2" width="251">
                <p>Descri&ccedil;&atilde;o do Item</p>
            </th>
            <th width="113">
                <p>Data</p>
            </th>
            <th width="76">
                <p>Quant.</p>
            </th>
            <th width="183">
                <p>Respons&aacute;vel pela Entrega (CEDEC)</p>
            </th>
        </tr>
               
        <?php
        
        foreach ($materiaisLiberado as $key => $material) {
            
            print "<tr>
                    <td width='83'>
                        <p>".$material['codigo']."</p>
                    </td>
                    <td colspan='2' width='251'>
                        <p>".$material['descricao_item']."</p>
                    </td>
                    <td width='113'>
                        
                    </td>
                    <td width='76'>
                        <p>".$material['qtd']."</p>
                    </td>
                    <td width='76'>
                       
                    </td>
                    
                </tr>";
            }
        ?>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p><strong><br /> </strong></p>
<p><strong>ANEXO C &ndash; Formul&aacute;rio para presta&ccedil;&atilde;o de contas de fornecimento de ajuda humanit&aacute;ria (exceto &aacute;gua para consumo humano) &ndash; Fl. 01</strong></p>
<table width="0">
    <tbody>
        <tr>
            <td width="165">&nbsp;</td>
            <td colspan="8" width="799">
                <p><strong>GOVERNO DO ESTADO DE MINAS GERAIS</strong></p>
                <p><strong>GABINETE MILITAR DO GOVERNADOR</strong></p>
                <p><strong>COORDENADORIA ESTADUAL DE DEFESA CIVIL (CEDEC)</strong></p>
                <p>&nbsp;</p>
            </td>
        </tr>
        <tr>
            <td colspan="9" width="964">
                <p><strong>FORMUL&Aacute;RIO PARA PRESTA&Ccedil;&Atilde;O DE CONTAS SOBRE FORNECIMENTO DE ITENS DE AJUDA HUMANIT&Aacute;RIA &ndash; EXCETO &Aacute;GUA PARA CONSUMO HUMANO</strong></p>
                <p><strong>(Dever&aacute; ser preenchido um formul&aacute;rio para cada tipo de material)</strong></p>
            </td>
        </tr>
        <tr>
            <td colspan="3" width="365">
                <p>Nome do Munic&iacute;pio:</p>
            </td>
            <td colspan="3" width="235">
                <p>Mesorregi&atilde;o</p>
                <b><?=$view[0]['nome_com_regiao']?></b>
            </td>
            <td width="86">&nbsp;</td>
            <td colspan="2" width="278">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3" width="365">&nbsp;</td>
            <td colspan="3" width="235">&nbsp;</td>
            <td width="86">&nbsp;</td>
            <td colspan="2" width="278">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="5" width="458">
                <p>Nome do(a) Coordenador(a) Municipal de Prote&ccedil;&atilde;o e Defesa Civil</p>
            </td>
            <td width="142">
                <p>Telefone</p>
            </td>
            <td colspan="3" width="364">
                <p>E-mail</p>
            </td>
        </tr>
        <tr>
            <td colspan="5" width="458">&nbsp;</td>
            <td width="142">&nbsp;</td>
            <td colspan="3" width="364">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="5" width="458">
                <p>Nome do(a) Prefeito(a)</p>
            </td>
            <td width="142">
                <p>Telefone</p>
            </td>
            <td colspan="3" width="364">
                <p>E-mail</p>
            </td>
        </tr>
        <tr>
            <td colspan="5" width="458">&nbsp;</td>
            <td width="142">&nbsp;</td>
            <td colspan="3" width="364">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="5" width="458">
                <p>Tipo de material distribu&iacute;do</p>
                <p>(dever&aacute; ser usada uma ficha para tipo de material)&THORN;</p>
            </td>
            <td colspan="4" width="506">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="5" width="458">
                <p>Total de fam&iacute;lias, grupos ou comunidades atendidas&THORN;</p>
            </td>
            <td colspan="4" width="506">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="9" width="964">
                <p><strong>DADOS SOBRE A DISTRIBUI&Ccedil;&Atilde;O</strong></p>
            </td>
        </tr>
        <tr>
            <td colspan="2" width="280">
                <p>Nome do Benefici&aacute;rio (Informar apenas o respons&aacute;vel pelo recebimento)</p>
            </td>
            <td colspan="2" width="151">
                <p>N&uacute;mero do RG</p>
            </td>
            <td colspan="2" width="169">
                <p>Comunidade</p>
            </td>
            <td width="86">
                <p>Quant.</p>
            </td>
            <td width="94">
                <p>Data</p>
            </td>
            <td width="183">
                <p>Assinatura</p>
            </td>
        </tr>
        <tr>
            <td colspan="2" width="280">
                <p>&nbsp;</p>
            </td>
            <td colspan="2" width="151">
                <p>&nbsp;</p>
            </td>
            <td colspan="2" width="169">
                <p>&nbsp;</p>
            </td>
            <td width="86">
                <p>&nbsp;</p>
            </td>
            <td width="94">
                <p>&nbsp;</p>
            </td>
            <td width="183">
                <p>&nbsp;</p>
            </td>
        </tr>
        <tr>
            <td colspan="2" width="280">
                <p>&nbsp;</p>
            </td>
            <td colspan="2" width="151">
                <p>&nbsp;</p>
            </td>
            <td colspan="2" width="169">
                <p>&nbsp;</p>
            </td>
            <td width="86">
                <p>&nbsp;</p>
            </td>
            <td width="94">
                <p>&nbsp;</p>
            </td>
            <td width="183">
                <p>&nbsp;</p>
            </td>
        </tr>
        <tr>
            <td colspan="2" width="280">
                <p>&nbsp;</p>
            </td>
            <td colspan="2" width="151">
                <p>&nbsp;</p>
            </td>
            <td colspan="2" width="169">
                <p>&nbsp;</p>
            </td>
            <td width="86">
                <p>&nbsp;</p>
            </td>
            <td width="94">
                <p>&nbsp;</p>
            </td>
            <td width="183">
                <p>&nbsp;</p>
            </td>
        </tr>
        <tr>
            <td colspan="2" width="280">
                <p>&nbsp;</p>
            </td>
            <td colspan="2" width="151">
                <p>&nbsp;</p>
            </td>
            <td colspan="2" width="169">
                <p>&nbsp;</p>
            </td>
            <td width="86">
                <p>&nbsp;</p>
            </td>
            <td width="94">
                <p>&nbsp;</p>
            </td>
            <td width="183">
                <p>&nbsp;</p>
            </td>
        </tr>
        <tr>
            <td colspan="2" width="280">
                <p>&nbsp;</p>
            </td>
            <td colspan="2" width="151">
                <p>&nbsp;</p>
            </td>
            <td colspan="2" width="169">
                <p>&nbsp;</p>
            </td>
            <td width="86">
                <p>&nbsp;</p>
            </td>
            <td width="94">
                <p>&nbsp;</p>
            </td>
            <td width="183">
                <p>&nbsp;</p>
            </td>
        </tr>
        <tr>
            <td colspan="2" width="280">
                <p>&nbsp;</p>
            </td>
            <td colspan="2" width="151">
                <p>&nbsp;</p>
            </td>
            <td colspan="2" width="169">
                <p>&nbsp;</p>
            </td>
            <td width="86">
                <p>&nbsp;</p>
            </td>
            <td width="94">
                <p>&nbsp;</p>
            </td>
            <td width="183">
                <p>&nbsp;</p>
            </td>
        </tr>
        <tr>
            <td colspan="2" width="280">
                <p>&nbsp;</p>
            </td>
            <td colspan="2" width="151">
                <p>&nbsp;</p>
            </td>
            <td colspan="2" width="169">
                <p>&nbsp;</p>
            </td>
            <td width="86">
                <p>&nbsp;</p>
            </td>
            <td width="94">
                <p>&nbsp;</p>
            </td>
            <td width="183">
                <p>&nbsp;</p>
            </td>
        </tr>
        <tr>
            <td colspan="2" width="280">
                <p>&nbsp;</p>
            </td>
            <td colspan="2" width="151">
                <p>&nbsp;</p>
            </td>
            <td colspan="2" width="169">
                <p>&nbsp;</p>
            </td>
            <td width="86">
                <p>&nbsp;</p>
            </td>
            <td width="94">
                <p>&nbsp;</p>
            </td>
            <td width="183">
                <p>&nbsp;</p>
            </td>
        </tr>
        <tr>
            <td colspan="2" width="280">
                <p>&nbsp;</p>
            </td>
            <td colspan="2" width="151">
                <p>&nbsp;</p>
            </td>
            <td colspan="2" width="169">
                <p>&nbsp;</p>
            </td>
            <td width="86">
                <p>&nbsp;</p>
            </td>
            <td width="94">
                <p>&nbsp;</p>
            </td>
            <td width="183">
                <p>&nbsp;</p>
            </td>
        </tr>
        <tr>
            <td colspan="2" width="280">
                <p>&nbsp;</p>
            </td>
            <td colspan="2" width="151">
                <p>&nbsp;</p>
            </td>
            <td colspan="2" width="169">
                <p>&nbsp;</p>
            </td>
            <td width="86">
                <p>&nbsp;</p>
            </td>
            <td width="94">
                <p>&nbsp;</p>
            </td>
            <td width="183">
                <p>&nbsp;</p>
            </td>
        </tr>
        <tr>
            <td colspan="2" width="280">
                <p>&nbsp;</p>
            </td>
            <td colspan="2" width="151">
                <p>&nbsp;</p>
            </td>
            <td colspan="2" width="169">
                <p>&nbsp;</p>
            </td>
            <td width="86">
                <p>&nbsp;</p>
            </td>
            <td width="94">
                <p>&nbsp;</p>
            </td>
            <td width="183">
                <p>&nbsp;</p>
            </td>
        </tr>
        <tr>
            <td width="165">&nbsp;</td>
            <td width="115">&nbsp;</td>
            <td width="85">&nbsp;</td>
            <td width="66">&nbsp;</td>
            <td width="27">&nbsp;</td>
            <td width="142">&nbsp;</td>
            <td width="86">&nbsp;</td>
            <td width="94">&nbsp;</td>
            <td width="183">&nbsp;</td>
        </tr>
    </tbody>
</table>
<p>Primeira folha</p>
<p>&nbsp;</p>
<p><strong>ANEXO C &ndash; Formul&aacute;rio para presta&ccedil;&atilde;o de contas de fornecimento de ajuda humanit&aacute;ria (exceto &aacute;gua para consumo humano) &ndash; Demais folhas, quando necess&aacute;rio</strong></p>
<table width="0">
    <tbody>
        <tr>
            <td colspan="6" width="964">
                <p><strong>DADOS SOBRE A DISTRIBUI&Ccedil;&Atilde;O (Continua&ccedil;&atilde;o)</strong></p>
            </td>
        </tr>
        <tr>
            <td width="280">
                <p>Nome do Benefici&aacute;rio (Informar apenas o respons&aacute;vel pelo recebimento)</p>
            </td>
            <td width="151">
                <p>N&uacute;mero do RG</p>
            </td>
            <td width="169">
                <p>Comunidade</p>
            </td>
            <td width="86">
                <p>Quant.</p>
            </td>
            <td width="94">
                <p>Data</p>
            </td>
            <td width="183">
                <p>Assinatura</p>
            </td>
        </tr>
        <tr>
            <td width="280">
                <p>&nbsp;</p>
            </td>
            <td width="151">
                <p>&nbsp;</p>
            </td>
            <td width="169">
                <p>&nbsp;</p>
            </td>
            <td width="86">
                <p>&nbsp;</p>
            </td>
            <td width="94">
                <p>&nbsp;</p>
            </td>
            <td width="183">
                <p>&nbsp;</p>
            </td>
        </tr>
        <tr>
            <td width="280">
                <p>&nbsp;</p>
            </td>
            <td width="151">
                <p>&nbsp;</p>
            </td>
            <td width="169">
                <p>&nbsp;</p>
            </td>
            <td width="86">
                <p>&nbsp;</p>
            </td>
            <td width="94">
                <p>&nbsp;</p>
            </td>
            <td width="183">
                <p>&nbsp;</p>
            </td>
        </tr>
        <tr>
            <td width="280">
                <p>&nbsp;</p>
            </td>
            <td width="151">
                <p>&nbsp;</p>
            </td>
            <td width="169">
                <p>&nbsp;</p>
            </td>
            <td width="86">
                <p>&nbsp;</p>
            </td>
            <td width="94">
                <p>&nbsp;</p>
            </td>
            <td width="183">
                <p>&nbsp;</p>
            </td>
        </tr>
        <tr>
            <td width="280">
                <p>&nbsp;</p>
            </td>
            <td width="151">
                <p>&nbsp;</p>
            </td>
            <td width="169">
                <p>&nbsp;</p>
            </td>
            <td width="86">
                <p>&nbsp;</p>
            </td>
            <td width="94">
                <p>&nbsp;</p>
            </td>
            <td width="183">
                <p>&nbsp;</p>
            </td>
        </tr>
        <tr>
            <td width="280">
                <p>&nbsp;</p>
            </td>
            <td width="151">
                <p>&nbsp;</p>
            </td>
            <td width="169">
                <p>&nbsp;</p>
            </td>
            <td width="86">
                <p>&nbsp;</p>
            </td>
            <td width="94">
                <p>&nbsp;</p>
            </td>
            <td width="183">
                <p>&nbsp;</p>
            </td>
        </tr>
        <tr>
            <td width="280">
                <p>&nbsp;</p>
            </td>
            <td width="151">
                <p>&nbsp;</p>
            </td>
            <td width="169">
                <p>&nbsp;</p>
            </td>
            <td width="86">
                <p>&nbsp;</p>
            </td>
            <td width="94">
                <p>&nbsp;</p>
            </td>
            <td width="183">
                <p>&nbsp;</p>
            </td>
        </tr>
        <tr>
            <td width="280">
                <p>&nbsp;</p>
            </td>
            <td width="151">
                <p>&nbsp;</p>
            </td>
            <td width="169">
                <p>&nbsp;</p>
            </td>
            <td width="86">
                <p>&nbsp;</p>
            </td>
            <td width="94">
                <p>&nbsp;</p>
            </td>
            <td width="183">
                <p>&nbsp;</p>
            </td>
        </tr>
        <tr>
            <td width="280">
                <p>&nbsp;</p>
            </td>
            <td width="151">
                <p>&nbsp;</p>
            </td>
            <td width="169">
                <p>&nbsp;</p>
            </td>
            <td width="86">
                <p>&nbsp;</p>
            </td>
            <td width="94">
                <p>&nbsp;</p>
            </td>
            <td width="183">
                <p>&nbsp;</p>
            </td>
        </tr>
        <tr>
            <td width="280">
                <p>&nbsp;</p>
            </td>
            <td width="151">
                <p>&nbsp;</p>
            </td>
            <td width="169">
                <p>&nbsp;</p>
            </td>
            <td width="86">
                <p>&nbsp;</p>
            </td>
            <td width="94">
                <p>&nbsp;</p>
            </td>
            <td width="183">
                <p>&nbsp;</p>
            </td>
        </tr>
        <tr>
            <td width="280">
                <p>&nbsp;</p>
            </td>
            <td width="151">
                <p>&nbsp;</p>
            </td>
            <td width="169">
                <p>&nbsp;</p>
            </td>
            <td width="86">
                <p>&nbsp;</p>
            </td>
            <td width="94">
                <p>&nbsp;</p>
            </td>
            <td width="183">
                <p>&nbsp;</p>
            </td>
        </tr>
        <tr>
            <td width="280">
                <p>&nbsp;</p>
            </td>
            <td width="151">
                <p>&nbsp;</p>
            </td>
            <td width="169">
                <p>&nbsp;</p>
            </td>
            <td width="86">
                <p>&nbsp;</p>
            </td>
            <td width="94">
                <p>&nbsp;</p>
            </td>
            <td width="183">
                <p>&nbsp;</p>
            </td>
        </tr>
        <tr>
            <td width="280">
                <p>&nbsp;</p>
            </td>
            <td width="151">
                <p>&nbsp;</p>
            </td>
            <td width="169">
                <p>&nbsp;</p>
            </td>
            <td width="86">
                <p>&nbsp;</p>
            </td>
            <td width="94">
                <p>&nbsp;</p>
            </td>
            <td width="183">
                <p>&nbsp;</p>
            </td>
        </tr>
        <tr>
            <td width="280">
                <p>&nbsp;</p>
            </td>
            <td width="151">
                <p>&nbsp;</p>
            </td>
            <td width="169">
                <p>&nbsp;</p>
            </td>
            <td width="86">
                <p>&nbsp;</p>
            </td>
            <td width="94">
                <p>&nbsp;</p>
            </td>
            <td width="183">
                <p>&nbsp;</p>
            </td>
        </tr>
        <tr>
            <td width="280">
                <p>&nbsp;</p>
            </td>
            <td width="151">
                <p>&nbsp;</p>
            </td>
            <td width="169">
                <p>&nbsp;</p>
            </td>
            <td width="86">
                <p>&nbsp;</p>
            </td>
            <td width="94">
                <p>&nbsp;</p>
            </td>
            <td width="183">
                <p>&nbsp;</p>
            </td>
        </tr>
        <tr>
            <td width="280">
                <p>&nbsp;</p>
            </td>
            <td width="151">
                <p>&nbsp;</p>
            </td>
            <td width="169">
                <p>&nbsp;</p>
            </td>
            <td width="86">
                <p>&nbsp;</p>
            </td>
            <td width="94">
                <p>&nbsp;</p>
            </td>
            <td width="183">
                <p>&nbsp;</p>
            </td>
        </tr>
        <tr>
            <td width="280">
                <p>&nbsp;</p>
            </td>
            <td width="151">
                <p>&nbsp;</p>
            </td>
            <td width="169">
                <p>&nbsp;</p>
            </td>
            <td width="86">
                <p>&nbsp;</p>
            </td>
            <td width="94">
                <p>&nbsp;</p>
            </td>
            <td width="183">
                <p>&nbsp;</p>
            </td>
        </tr>
        <tr>
            <td width="280">
                <p>&nbsp;</p>
            </td>
            <td width="151">
                <p>&nbsp;</p>
            </td>
            <td width="169">
                <p>&nbsp;</p>
            </td>
            <td width="86">
                <p>&nbsp;</p>
            </td>
            <td width="94">
                <p>&nbsp;</p>
            </td>
            <td width="183">
                <p>&nbsp;</p>
            </td>
        </tr>
        <tr>
            <td width="280">
                <p>&nbsp;</p>
            </td>
            <td width="151">
                <p>&nbsp;</p>
            </td>
            <td width="169">
                <p>&nbsp;</p>
            </td>
            <td width="86">
                <p>&nbsp;</p>
            </td>
            <td width="94">
                <p>&nbsp;</p>
            </td>
            <td width="183">
                <p>&nbsp;</p>
            </td>
        </tr>
        <tr>
            <td width="280">
                <p>&nbsp;</p>
            </td>
            <td width="151">
                <p>&nbsp;</p>
            </td>
            <td width="169">
                <p>&nbsp;</p>
            </td>
            <td width="86">
                <p>&nbsp;</p>
            </td>
            <td width="94">
                <p>&nbsp;</p>
            </td>
            <td width="183">
                <p>&nbsp;</p>
            </td>
        </tr>
        <tr>
            <td width="280">
                <p>&nbsp;</p>
            </td>
            <td width="151">
                <p>&nbsp;</p>
            </td>
            <td width="169">
                <p>&nbsp;</p>
            </td>
            <td width="86">
                <p>&nbsp;</p>
            </td>
            <td width="94">
                <p>&nbsp;</p>
            </td>
            <td width="183">
                <p>&nbsp;</p>
            </td>
        </tr>
        <tr>
            <td width="280">
                <p>&nbsp;</p>
            </td>
            <td width="151">
                <p>&nbsp;</p>
            </td>
            <td width="169">
                <p>&nbsp;</p>
            </td>
            <td width="86">
                <p>&nbsp;</p>
            </td>
            <td width="94">
                <p>&nbsp;</p>
            </td>
            <td width="183">
                <p>&nbsp;</p>
            </td>
        </tr>
        <tr>
            <td width="280">
                <p>&nbsp;</p>
            </td>
            <td width="151">
                <p>&nbsp;</p>
            </td>
            <td width="169">
                <p>&nbsp;</p>
            </td>
            <td width="86">
                <p>&nbsp;</p>
            </td>
            <td width="94">
                <p>&nbsp;</p>
            </td>
            <td width="183">
                <p>&nbsp;</p>
            </td>
        </tr>
        <tr>
            <td width="280">
                <p>&nbsp;</p>
            </td>
            <td width="151">
                <p>&nbsp;</p>
            </td>
            <td width="169">
                <p>&nbsp;</p>
            </td>
            <td width="86">
                <p>&nbsp;</p>
            </td>
            <td width="94">
                <p>&nbsp;</p>
            </td>
            <td width="183">
                <p>&nbsp;</p>
            </td>
        </tr>
        <tr>
            <td width="280">
                <p>&nbsp;</p>
            </td>
            <td width="151">
                <p>&nbsp;</p>
            </td>
            <td width="169">
                <p>&nbsp;</p>
            </td>
            <td width="86">
                <p>&nbsp;</p>
            </td>
            <td width="94">
                <p>&nbsp;</p>
            </td>
            <td width="183">
                <p>&nbsp;</p>
            </td>
        </tr>
        <tr>
            <td colspan="6" width="964">
                <p>&nbsp;</p>
                <p>Local_______________________, Data ____ de _____________ de ___________.</p>
            </td>
        </tr>
        <tr>
            <td colspan="6" width="964">
                <p>___________________________________________________________</p>
                <p>Assinatura do Prefeito ou substituto legal</p>
            </td>
        </tr>
    </tbody>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p><a href="#_ftnref1" name="_ftn1">[1]</a> Formul&aacute;rio de Informa&ccedil;&otilde;es de Desastre</p>