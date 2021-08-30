<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_admin/Model/admModel.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>
<?php
$id_usuario = isset($_GET['id']) ? $_GET['id'] : null;
$usuario = Usuario::getDadoUsuario($id_usuario);

$permissaoModulo = Usuario::getPermissaoModulo($usuario['login']);
$permissaoAjudaH = Usuario::getPermissaoAjudaH($usuario['login']);
$permissaoEstoque = Usuario::getPermissaoEstoque($usuario['login']);
$permissaoCompdec = Usuario::getPermissaoCompdec($usuario['login']);
$permissaoCedec = Usuario::getPermissaoCedec($usuario['login']);

$maspNumPol = Usuario::dadosFuncionario($usuario['id_funcionario']);
?>

<div class="col-md-12">
    <legend>Cadastro de Usuario</legend>
    <p style="text-align: right"><button class='btn btn-success' id='resetarSenha'>Resetar Senha </button>&nbsp;Envio de email com instruções !</p>   
    <form action="?token=<?= hash('sha256', md5(VERSAO).date('dmY')); ?>&ac=&modulo=admin&controller=adm&action=cad_user_valida" method="POST" name="frmCadUserRapido" id="frmCadUserRapido">
        <label>Numero Policia</label>
        <input class="form-control" type="text" name="txtNumPol" id="txtNumPol" maxlenght="9" readonly='readonly' value='<?= $maspNumPol[0]['num_masp']; ?>'>

        <label>Nome Completo</label>
        <input class="form-control" type="text" name="txtNome" value="<?= !empty($usuario) ? $usuario['nome'] : ""; ?>" id="txtNome" maxlenght="9" readonly='readonly'>
        <label>Usuario (alternativo S999999)</label>
        <input class="form-control" type="text" name="txtUsuario" value="<?= !empty($usuario) ? $usuario['login'] : ""; ?>" id="txtUsuario" maxlenght="9" readonly='readonly'>

        <label>Lotado</label>
        <select class="form-control" name="selSetor" value="" id="selSetor">
            <option>CEDEC</option>
            <option>GMG</option>
        </select>

        <label>email</label>
        <input class="form-control" type="email" name="txtEmail" value="<?= !empty($usuario) ? $usuario['email_rec'] : ""; ?>" id="txtEmail">
        <input type="hidden" name="opcao" value="<?= !empty($usuario) ? "atualiza" : "caduser"; ?>" >
        <input type="hidden" name="id_usuario" value="<?= !empty($usuario) ? $usuario['id_usuario'] : ""; ?>" >
        <br>



        </div>

        <!-- #############################   Ajuda humanitaria ######################-->
        <div class="col-md-12">
            <br>
            <div class="progress">
                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
            </div>
            <legend>Ajuda Humanitaria</legend>
            <br>
            <div class="col-md-12">
                <input type="checkbox" id="it_m_deposito" data-tabela="cedec_usuario" data-chave="id_usuario" <?= ($permissaoModulo['it_m_deposito']) ? " checked='checked'" : ""; ?>>
                <label>Visualizar Icone Ajuda Humanitaria</label><br>

 <!--<input type="checkbox" id="opcao_deposito_todos1">
     <label style="color:black">Marcar Todos</label><br>-->
                <div class="col-md-4">
                    <legend>Padrão</legend>
                    <input type="checkbox" id="cad_material" data-tabela="aju_permissao" data-chave="id_permissao" <?= ($permissaoAjudaH['cad_material']) ? " checked='checked'" : ""; ?>>
                    <label>Cadastro de material</label><br>

                    <input type="checkbox" id="entrada_nota" data-tabela="aju_permissao" data-chave="id_permissao" <?= ($permissaoAjudaH['entrada_nota']) ? " checked='checked'" : ""; ?>>
                    <label>Entrada Nota</label><br>

                    <input type="checkbox" id="cad_pagamento" data-tabela="aju_permissao" data-chave="id_permissao" <?= ($permissaoAjudaH['cad_pagamento']) ? " checked='checked'" : ""; ?>>
                    <label>Pagamento de Material</label><br><br>

                    <input type="checkbox" id="cad_transferencia" data-tabela="aju_permissao" data-chave="id_permissao" <?= ($permissaoAjudaH['cad_transferencia']) ? " checked='checked'" : ""; ?>>
                    <label>Transferencia de Material</label> ( Somente Administrador )<br>

                    <input type="checkbox" id="cancela_transf" data-tabela="aju_permissao" data-chave="id_permissao" <?= ($permissaoAjudaH['cancela_transf']) ? " checked='checked'" : ""; ?>>
                    <label>Cancelar Transferencia </label>( Somente Diretor )<br><br>

                    <input type="checkbox" id="cad_liberacao" data-tabela="aju_permissao" data-chave="id_permissao" <?= ($permissaoAjudaH['cad_liberacao']) ? " checked='checked'" : ""; ?>>
                    <label>Liberacao de Material </label>( Somente Administrador )<br>

                    <input type="checkbox" id="cancLibPaga" data-tabela="aju_permissao" data-chave="id_permissao" <?= ($permissaoAjudaH['cancLibPaga']) ? " checked='checked'" : ""; ?>>
                    <label>Cancelar Liberação </label>( Somente Diretor )<br><br>

                    <input type="checkbox" id="relatorio" data-tabela="aju_permissao" data-chave="id_permissao" <?= ($permissaoAjudaH['relatorio']) ? " checked='checked'" : ""; ?>>
                    <label>Consulta e Relatorios</label><br>

                    <input type="checkbox" id="rel_saldo_geral" data-tabela="aju_permissao" data-chave="id_permissao" <?= ($permissaoAjudaH['rel_saldo_geral']) ? " checked='checked'" : ""; ?>>
                    <label>Relatorio Saldo Geral</label><br>          

                </div>
                <div class="col-md-4">
                    <legend>Outros</legend>
                    <input type="checkbox" id="cad_ajuda_suporte" data-tabela="aju_permissao" data-chave="id_permissao" <?= ($permissaoAjudaH['cad_ajuda_suporte']) ? " checked='checked'" : ""; ?>>
                    <label>Ajuda e Suporte ao Sistema</label><br>

                    <input type="checkbox" id="cad_usuario" data-tabela="aju_permissao" data-chave="id_permissao" <?= ($permissaoAjudaH['cad_usuario']) ? " checked='checked'" : ""; ?>>
                    <label>Cadastro de Usuario</label><br>

                    <input type="checkbox" id="cad_conf_ger" data-tabela="aju_permissao" data-chave="id_permissao" <?= ($permissaoAjudaH['cad_conf_ger']) ? " checked='checked'" : ""; ?>>
                    <label>Cadastro de Configuracao Geral do sistema</label><br>
                    <input type="checkbox" id="rel_saldo_p_deposito" data-tabela="aju_permissao" data-chave="id_permissao" <?= ($permissaoAjudaH['rel_saldo_p_deposito']) ? " checked='checked'" : ""; ?>>
                    <label>Relatorios de saldo por Deposito</label><br>
                    <input type="checkbox" id="liberacao" data-tabela="aju_permissao" data-chave="id_permissao" <?= ($permissaoAjudaH['liberacao']) ? " checked='checked'" : ""; ?>>
                    <label>Acesso a relatorio</label><br>

                    <input type="checkbox" id="rel_comp_liberacao" data-tabela="aju_permissao" data-chave="id_permissao" <?= ($permissaoAjudaH['rel_comp_liberacao']) ? " checked='checked'" : ""; ?>>
                    <label>2 via liberacao</label><br>

                    <input type="checkbox" id="rel_mat_liberado" data-tabela="aju_permissao" data-chave="id_permissao" <?= ($permissaoAjudaH['rel_mat_liberado']) ? " checked='checked'" : ""; ?>>
                    <label>Relatorio de Material Liberado</label><br>

                    <input type="checkbox" id="rel_mat_pago" data-tabela="aju_permissao" data-chave="id_permissao" <?= ($permissaoAjudaH['rel_mat_pago']) ? " checked='checked'" : ""; ?>>
                    <label>Relatorio de Material Pago</label><br>

                    <input type="checkbox" id="rel_comp_mat_pago" data-tabela="aju_permissao" data-chave="id_permissao" <?= ($permissaoAjudaH['rel_comp_mat_pago']) ? " checked='checked'" : ""; ?>>
                    <label>2 Via recibo de pgto material</label><br>

                    <input type="checkbox" id="transferencia" data-tabela="aju_permissao" data-chave="id_permissao" <?= ($permissaoAjudaH['transferencia']) ? " checked='checked'" : ""; ?>>
                    <label>Acesso a menu Transferencia de Material</label><br>

                    <input type="checkbox" id="rel_mat_transferido" data-tabela="aju_permissao" data-chave="id_permissao" <?= ($permissaoAjudaH['rel_mat_transferido']) ? " checked='checked'" : ""; ?>>
                    <label>Relatorio de Transferencia de Material</label><br>

                    <input type="checkbox" id="rel_mat_transito" data-tabela="aju_permissao" data-chave="id_permissao" <?= ($permissaoAjudaH['rel_mat_transito']) ? " checked='checked'" : ""; ?>>
                    <label>Relatorio de Material em Transito</label><br>

                    <input type="checkbox" id="lembrete_libera" data-tabela="aju_permissao" data-chave="id_permissao" <?= ($permissaoAjudaH['lembrete_libera']) ? " checked='checked'" : ""; ?>>
                    <label>acesso ao lembrete de liberacao na tela inicial</label><br>

                    <input type="checkbox" id="lembrete_transito" data-tabela="aju_permissao" data-chave="id_permissao" <?= ($permissaoAjudaH['lembrete_transito']) ? " checked='checked'" : ""; ?>>
                    <label>Acesso ao Lembrete de Material em Transito</label><br>
                </div>
                <div class="col-md-4">

                    <input type="checkbox" id="inicial" data-tabela="aju_permissao" data-chave="id_permissao" <?= ($permissaoAjudaH['inicial']) ? " checked='checked'" : ""; ?>>
                    <label>Acesso a Pagina inicial do Modulo</label><br>

                    <input type="checkbox" id="cad_deposito" data-tabela="aju_permissao" data-chave="id_permissao" <?= ($permissaoAjudaH['cad_deposito']) ? " checked='checked'" : ""; ?>>
                    <label>Acesso ao submenu deposito</label><br>

                    <input type="checkbox" id="rel_cad_mat" data-tabela="aju_permissao" data-chave="id_permissao" <?= ($permissaoAjudaH['rel_cad_mat']) ? " checked='checked'" : ""; ?>>
                    <label>Acesso relatorio de cadastro de material</label><br>

                    <input type="checkbox" id="rel_resumo_liberacao" data-tabela="aju_permissao" data-chave="id_permissao" <?= ($permissaoAjudaH['rel_resumo_liberacao']) ? " checked='checked'" : ""; ?>>
                    <label>Resumo de liberacoes</label><br>
                </div>
                <div class="col-md-12">
                    <hr>
                    <input type="checkbox" id="pedido_ajuda" data-tabela="aju_permissao" data-chave="id_permissao" <?= ($permissaoAjudaH['pedido_ajuda']) ? " checked='checked'" : ""; ?>>
                    <label>Pedido Ajuda Humanitária</label><br>

                    <input type="checkbox" id="tdap" data-tabela="aju_permissao" data-chave="id_permissao" <?= ($permissaoAjudaH['tdap']) ? " checked='checked'" : ""; ?>>
                    <label>TDAP ( QrCode )</label><br>

                    <input type="checkbox" id="controle_estoque" data-tabela="aju_permissao" data-chave="id_permissao" <?= ($permissaoAjudaH['controle_estoque']) ? " checked='checked'" : ""; ?>>
                    <label>Controle de Estoque</label><br>
                    <br>
                </div>
</div>
                <!--###########################   CONTROLE DE ESTOQUE NOVO #######################-->
                <div class="col-md-12">
                    <br>
                    <div class="progress">
                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                    </div>
                    <div class="col-md-12">
                        <legend>Controle Estoque Novo</legend>

                        <input type="checkbox" id="modulo" data-tabela="aju_cpermissao" data-chave="id_permissao" <?= ($permissaoEstoque['modulo']) ? " checked='checked'" : ""; ?>>
                        <label>Controle de Estoque Novo</label><br>
                        
                        <input type="checkbox" id="cad_principal" data-tabela="aju_cpermissao" data-chave="id_permissao" <?= ($permissaoEstoque['cad_principal']) ? " checked='checked'" : ""; ?>>
                        <label>Cadastros Principais</label><br>
                        
                        <input type="checkbox" id="movimentacao" data-tabela="aju_cpermissao" data-chave="id_permissao" <?= ($permissaoEstoque['movimentacao']) ? " checked='checked'" : ""; ?>>
                        <label>Movimentações</label><br>
                        
                        <div class="col-md-12">
                            <input type="checkbox" id="entrada_nota" data-tabela="aju_cpermissao" data-chave="id_permissao" <?= ($permissaoEstoque['entrada_nota']) ? " checked='checked'" : ""; ?>>
                            <label>Entrada Material</label><br>
                            <input type="checkbox" id="cancela_entrada_nota" data-tabela="aju_cpermissao" data-chave="id_permissao" <?= ($permissaoEstoque['cancela_entrada_nota']) ? " checked='checked'" : ""; ?>>
                            <label>Cancelar Entrada Material</label><br>
                        
                            <input type="checkbox" id="pedido" data-tabela="aju_cpermissao" data-chave="id_permissao" <?= ($permissaoEstoque['pedido']) ? " checked='checked'" : ""; ?>>
                            <label>Pedido</label><br>
                            <input type="checkbox" id="cancela_pedido" data-tabela="aju_cpermissao" data-chave="id_permissao" <?= ($permissaoEstoque['cancela_pedido']) ? " checked='checked'" : ""; ?>>
                            <label>Cancelar Pedido</label><br>

                            <input type="checkbox" id="separar" data-tabela="aju_cpermissao" data-chave="id_permissao" <?= ($permissaoEstoque['separar']) ? " checked='checked'" : ""; ?>>
                            <label>Separaçao Mercadoria</label><br>

                            <input type="checkbox" id="montagem_carga" data-tabela="aju_cpermissao" data-chave="id_permissao" <?= ($permissaoEstoque['montagem_carga']) ? " checked='checked'" : ""; ?>>
                            <label>Montagem de Carga</label><br>
                            <input type="checkbox" id="cancela_mont_carga" data-tabela="aju_cpermissao" data-chave="id_permissao" <?= ($permissaoEstoque['cancela_mont_carga']) ? " checked='checked'" : ""; ?>>
                            <label>Cancelar Montagem de Carga</label><br>
                        </div>
                        
                        <input type="checkbox" id="relatorios" data-tabela="aju_cpermissao" data-chave="id_permissao" <?= ($permissaoEstoque['relatorios']) ? " checked='checked'" : ""; ?>>
                        <label>Relatorios</label><br>

                    </div>
                </div>

            

            <br>
            <br>

            <div class="col-md-12">
                <br>
                <div class="progress">
                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                </div>
                <!-- MODULO TDAP pmda -->
                <legend>CEDEC ( Adm )</legend>
                <input type="checkbox" id="it_m_poco" data-tabela="cedec_usuario" data-chave="id_usuario" <?= ($permissaoModulo['it_m_poco']) ? " checked='checked'" : ""; ?>>
                <label>Visualizar Icone CEDEC </label><br>

                <br>
                <input type="checkbox" id="prefeitura" data-tabela="cedec_permissao" data-chave="id_permissao" <?= ($permissaoCedec['prefeitura']) ? " checked='checked'" : ""; ?>>
                <label>Dados Prefeitura</label><br>
                <br>
                <input type="checkbox" id="municipio" data-tabela="cedec_permissao" data-chave="id_permissao" <?= ($permissaoCedec['municipio']) ? " checked='checked'" : ""; ?>>
                <label>Dados Municipio</label><br>
                <br>        
                <input type="checkbox" id="alterar_municipio" data-tabela="cedec_permissao" data-chave="id_permissao" <?= ($permissaoCedec['alterar_municipio']) ? " checked='checked'" : ""; ?>>
                <label>Alterar Dados Municipio</label><br>
                <br><br>
            </div>



            <div class="col-md-12">
                <br>
                <div class="progress">
                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                </div>
                <!-- MODULO TDAP pmda -->
                <legend>TDAP Pmda</legend>
                <br>
                <input type="checkbox" id="it_m_pipa" data-tabela="cedec_usuario" data-chave="id_usuario" <?= ($permissaoModulo['it_m_pipa']) ? " checked='checked'" : ""; ?>>
                <label>TDAP ( PMDA )</label><br>
                <br><br>
            </div>


            <div class="col-md-12">
                <br>
                <div class="progress">
                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                </div>
                <!-- MODULO EMERGENCIA -->
                <legend>Emergencia</legend>
                <br>
                <input type="checkbox" id="it_m_cce" data-tabela="cedec_usuario" data-chave="id_usuario" <?= ($permissaoModulo['it_m_cce']) ? " checked='checked'" : ""; ?>>
                <label>Visualizar Módulo Emergencia</label> 
                <br><br>
            </div>


            <div class="col-md-12">
                <br>
                <div class="progress">
                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                </div>
                <!-- MODULO DECRETAÇÃO -->
                <legend>Decretação</legend>
                <input type="checkbox" id="it_m_decretacao" data-tabela="cedec_usuario" data-chave="id_usuario" <?= ($permissaoModulo['it_m_decretacao']) ? " checked='checked'" : ""; ?>>
                <label>Visualizar Módulo Decreto</label>

                <br><br>
            </div>


            <div class="col-md-12">
                <br>
                <div class="progress">
                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                </div>
                <!-- MUDULO COMPDEC -->
                <legend>Compdec</legend>
                <input type="checkbox" id="it_m_comdec" data-tabela="cedec_usuario" data-chave="id_usuario" <?= ($permissaoModulo['it_m_comdec']) ? " checked='checked'" : ""; ?>>
                <label>Visualizar Módulo Compdec</label>
                <br>
                <input type="checkbox" id="cad_comdec" data-tabela="com_permissao" data-chave="id_permissao" <?= ($permissaoCompdec['cad_comdec']) ? " checked='checked'" : ""; ?>>
                <label>Cadastro Compdec</label>
                <br>
                <input type="checkbox" id="cad_consulta" data-tabela="com_permissao" data-chave="id_permissao" <?= ($permissaoCompdec['cad_consulta']) ? " checked='checked'" : ""; ?>>
                <label>Consulta Compdec</label>
                <br>
                <input type="checkbox" id="cad_rel" data-tabela="com_permissao" data-chave="id_permissao" <?= ($permissaoCompdec['cad_rel']) ? " checked='checked'" : ""; ?>>
                <label>Relatorios</label>
                <br>
                <input type="checkbox" id="alt_comdec" data-tabela="com_permissao" data-chave="id_permissao" <?= ($permissaoCompdec['alt_comdec']) ? " checked='checked'" : ""; ?>>
                <label>Alterar Compdec</label>
                <br>
                <input type="checkbox" id="admuser" data-tabela="com_permissao" data-chave="id_permissao" <?= ($permissaoCompdec['admuser']) ? " checked='checked'" : ""; ?>>
                <label>Administra Usuario Compdec</label>
                <br>
                <input type="checkbox" id="adduser" data-tabela="com_permissao" data-chave="id_permissao" <?= ($permissaoCompdec['adduser']) ? " checked='checked'" : ""; ?>>
                <label>Adicionar Usuario</label>


            </div>

            <div class="col-md-12">
                <br>
                <div class="progress">
                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                </div>
                <legend>Equipe</legend>
                <input type="checkbox" id="it_m_apoio" data-tabela="cedec_usuario" data-chave="id_usuario" <?= ($permissaoModulo['it_m_apoio']) ? " checked='checked'" : ""; ?> >
                <label>Visualizar Módulo Equipe</label>

                <br><br>
            </div>


            <div class="col-md-12">
                <br>
                <div class="progress">
                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                </div>
                <legend>Escola</legend>
                <input type="checkbox" id="it_m_escola" data-tabela="cedec_usuario" data-chave="id_usuario" <?= ($permissaoModulo['it_m_escola']) ? " checked='checked'" : ""; ?>>
                <label>Visualizar Módulo Escola</label>

                <br><br>
            </div>

            <div class="col-md-12">
                <br>
                <div class="progress">
                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                </div>
                <legend>Poços</legend>
                <input type="checkbox" id="it_m_poco" data-tabela="cedec_usuario" data-chave="id_usuario" <?= ($permissaoModulo['it_m_poco']) ? " checked='checked'" : ""; ?>>
                <label>Visualizar Módulo Poço</label>

                <br><br>
            </div>

        </div>

        <input class="btn btn-info" type="submit" name="btnEnviar" id="btnEnviar" value="Gravar">

    </form>
    <br>
    <div class="col-md-12 text-center">
        <br>
        <a class="btn btn-success" href="?token=<?= hash('sha256', md5(VERSAO).date('dmY')); ?>&ac=&modulo=admin&controller=adm&action=usuario">Voltar</a>
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

            // ajax gravar marcação
            $("input[type=checkbox]").click(function () {

                var opcao = "";

                if ($(this).is(":checked")) {
                    opcao = 1;
                } else {
                    opcao = 0;
                }

                var dados = {
                    "usuario": "<?= $usuario['login'] ?>",
                    "tabela": "" + $(this).data('tabela') + "",
                    "funcao": "" + $(this).attr("id") + "",
                    "opcao": opcao,
                    "chave": "" + $(this).data('chave') + ""
                };

                $.ajax({
                    type: 'POST',
                    url: '<?= FuncaoBase::geraLink("admin", "adm", "gravaPermissao") ?>',
                    data: dados,
                    success: function (response) {
                        console.log(response);

                    }
                });

            });

            // resetar senha interno
            $("#resetarSenha").click(function () {

                var dados = {
                    "btnResetar": "btnResetar",
                    "txtEmail": "<?= $usuario['email_rec'] ?>",
                    "txtUsuario": "<?= $usuario['login'] ?>",
                    "ajax": true,
                };

                $.ajax({
                    type: 'POST',
                    url: '<?= FuncaoBase::geraLink("admin", "adm", "resetar_user_cedec") ?>',
                    data: dados,
                    success: function (response) {
                        if(response.trim() == 'sucesso'){
                            alert('Procedimento Realizado com Sucesso ! \n Aguarde o email para mudança de senha');
                        }else {
                            alert('erro');
                        }
                    }
                });

            });
        });

    </script>