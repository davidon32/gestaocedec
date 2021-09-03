<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_index/Model/indexModel.php"; ?>  
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>

    <div class="table-responsive">
        <label>Total Registros : <?=count($dados)?> </label><span style="font-size: 10pt; color: silver"> ( Usuarios Ativos )</span>
        <div class='col-md-12'><?=FuncaoBase::voltar();?><br><br></div>
        <table class='table table-bordered'>
            <tr>
                <th title='Código do Usuário'>Código</th>
                <th title='Nome do Usuário' style="min-width: 110px;">Nome</th>
                <th title='Telefone do Usuário' style="min-width: 110px;">Telefone</th>
                <th title='Email do Usuário'>email_rec</th>
                <th title='Local Trabalho'>Função</th>
                <th title='Local Trabalho' style="min-width: 65px;">RPM</th>
                <th title='Local Trabalho'>Lotado</th>
                <th title='Login do Usuário'>Login</th>
                <th title='Data do Último acesso'>Ultimo Acesso</th>
                <th title='Acesso ao Módulo Estoque'>Estoque</th>
                <th title='Acesso ao Módulo PMDA'>Pmda</th>
                <th title='Acesso ao Módulo Plantão'>Plantao</th>
                <th title='Acesso ao Módulo Declaração'>Decretacao</th>
                <th title='Acesso ao Módulo Compdec'>Compdec</th>
                <th title='Acesso ao Módulo Informações da Prefeitura'>Prefeitura</th>
                <th title='Acesso ao Módulo da Escola'>Escola</th>
            </tr>
            <?php
                    
                foreach ($dados as $key => $value) {
                    print "<tr>";
                    print "<td>".$value['id_usuario']."</td>";
                    print "<td>".$value['nome']."</td>";
                    print "<td>".$value['telefone']."<br>".$value['celular']."</td>";
                    print "<td>".$value['email_rec']."</td>";
                    print "<td>".($value['desc_funcao'] == 'Agente Regional de DC' ? 'Regional' : '')."</td>";
                    print "<td>".$value['rpm']."</td>";
                    print "<td>".$value['orgao']."</td>";
                    print "<td>".$value['login']."</td>";
                    print "<td>". DataMysql::dataCompletaVisual($value['ultimo_acesso'])."</td>";
                    print "<td>".($value['estoque'] == 1 ? "<i style='color:blue'>sim</i>": "<i style='color:red'>não</i>")."</td>";
                    print "<td>".($value['pmda'] == 1 ? "<i style='color:blue'>sim</i>": "<i style='color:red'>não</i>")."</td>";
                    print "<td>".($value['plantao'] == 1 ? "<i style='color:blue'>sim</i>": "<i style='color:red'>não</i>")."</td>";
                    print "<td>".($value['decretacao'] == 1 ? "<i style='color:blue'>sim</i>": "<i style='color:red'>não</i>")."</td>";
                    print "<td>".($value['compdec'] == 1 ? "<i style='color:blue'>sim</i>": "<i style='color:red'>não</i>")."</td>";
                    print "<td>".($value['prefeitura'] == 1 ? "<i style='color:blue'>sim</i>": "<i style='color:red'>não</i>")."</td>";
                    print "<td>".($value['escola'] == 1 ? "<i style='color:blue'>sim</i>": "<i style='color:red'>não</i>")."</td>"; 
                    print "</tr>";
                }
            
            ?>
            
            
        </table>    
    </div>

<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>
<script>

    $(document).ready(function () {

    });

</script>