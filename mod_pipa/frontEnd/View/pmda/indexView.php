<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_pipa/Model/IndexModel.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menuExterno.php"; ?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>
<?php
$municipio = new Municipio ();

$comunidade = new Comunidade ();

$pmda = new Pmda ();

$compdec = new Compdec ();

$id_pmda = isset($_GET ['param']) ? $_GET ['param'] : "";

$id_municipio = isset($_COOKIE['seguranca']['id_municipio']) ? $_COOKIE['seguranca']['id_municipio'] : "";

$inputLeitura = 'readonly="readonly" title="Campo não Editável !"';
$btnLeitura = "disabled='disabled'";

if (!empty($id_pmda)) {
    $dados = $pmda->dadosPmda($id_pmda);
    $protocolo = $id_pmda . str_replace("-", "", substr($dados['data'], 0, 10));
    "";
}
?>
<div class="container-fluid">
    <!-- corpo -->
    <b>Municipio :</b>&nbsp;&nbsp;&nbsp; <i><?= Municipio::PegaNomeMunicipio($id_municipio); ?></i>
    &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; 
    <i><?= isset($protocolo) ? "<b>PMDA Nº: </b>" . $protocolo : ""; ?></i>
    <div class="col-md-12">
        <br>
        <br> <button class="btn btn-primary" title="Voltar Menu" id="idVoltarMenu">Voltar</button>

        <p class="pull-right">
            <!-- conta os status do pmda em edição status =0 -->
<?php
$novoPmda = $pmda->verificaCriarPmda($id_municipio);
print "<button type=\"button\" class=\"btn btn-primary\" title=\"Criar novo PMDA\" id=\"addPmda\">Novo PMDA</button>";
?>
        </p>
        <br><br>					
        <?php
        $dadosPmda = $pmda->listaPmda($id_municipio);

        
        ?>
        <table style="width:90%; margin: auto;" class="table table-bordered" id="tblListaPmda">
            <tr>
                <td colspan="5" style="text-align: center"><h4>Histórico dos PMDA</h4></td>
                <td></td>
            </tr>
            <tr>
                <th class="col-md-1" style="width: 1%;"></th>
                <th class="col-md-1" style="width: 15%;">Protocolo</th>
                <th class="col-md-2" style="width: 15%;">Data Criação</th>
                <th class="col-md-2" style="width: 10%;">Situação</th>
                <th class="col-md-2" style="width: 30%;">Opção</th>
                <td style="vertical-align:top" rowspan="<?= count($dadosPmda); ?>">

                    <p style="text-align:center; font-weight:bold;">Legenda</p>
                    <span style="background-color:#D6D6D6; width:40%;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;PMDA que está em Edição<br><br>
                    <span style="background-color:#A9F5A9; width:40%;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;PMDA que Permite Edição
                </td>
            </tr>
<?php
foreach ($dadosPmda as $value) {
    
    $pmdaLegado = $pmda->pmdaLegado($value['data']);
    $protocolo = $value ['id_pmda'] . str_replace("-", "", substr($value ['data'], 0, 10));

    $novo = "";
    # 
    if ($id_pmda == $value ['id_pmda']) {
        $fdo = "background-color:#D6D6D6; color:#6E6E6E;";
        # pmda status edição
    } elseif (($value['status'] == "0") && ($pmdaLegado)) {
        $fdo = "background-color:#A9F5A9; color:#6E6E6E;";
        $novo = "<img width='30px;' src='core/imagem/aqui.gif' title='PMDA em Condições de edição'>";
    } elseif(!$pmdaLegado){
        $fdo = "background-color:#BDB76B; color:#6E6E6E;";
    }else {
        $fdo = "";
    }

    print "<tr>";
    print "<td style='" . $fdo . "'>" . $novo . "</td>";
    print "<td style='" . $fdo . "'>" . $value ['id_pmda'] . str_replace("-", "", substr($value ['data'], 0, 10)) . "</td>";
    print "<td style='" . $fdo . "'>" . DataMysql::dataVisual($value ['data']) . "</td>";
    print "<td  style='" . $fdo . "' id='statusPmda'>" . $pmda->status($value ['status']) . "</td>";
    print "<td style='" . $fdo . "'>";

    print ($pmda->opcao($value ['id_pmda']) < "2") ? (($pmdaLegado) ? "<a name='lk_alterar' id='lk_alterarPmda' onclick='javascript:editar(" . $value['id_pmda'] . "," . $protocolo . ", " . $value['id_municipio'] . ")' title='Alterar PMDA'><img width='30px' src='core/imagem/editar.png'></button>" : "") : "-";
    print "<a name=lk_impressao onclick='javascript:impressao(" . $value['id_pmda'] . ", " . $id_municipio . ")'><img width='30px' src='core/imagem/impressao.png' title='Impressao do PMDA'></a>";
    print ($pmda->opcao($value ['id_pmda']) == "2") ? (($pmdaLegado) ? "<a href='#'><img width='30px' src='core/imagem/request.png' title='Solicitar Alteração' id='lk_alteracao'></a>" :"") : "-";
    print ($pmda->buscaStatus($value ['id_pmda']) == '1') ? (($pmdaLegado) ? "<button value='btnEnviar' id='btnEnviarHom' class='btn btn-primary' onclick='javascrip:homologa(" . $value ['id_pmda'] . ")' title='Solicita a Homologação do PMDA'>Enviar p/ Homologação</button>" : "") : "";
    print ($pmda->buscaStatus($value ['id_pmda']) < '2') ? (($pmdaLegado) ? "&nbsp;<a id='btnVerificar' onclick='javascrip:verificaPendencia(" . $value ['id_pmda'] . ")' title='Verifica o Status do PMDA'><img width='30px' src='core/imagem/atualizar.png'></a>" :"") : "";
    
    # duplicar pmda
    if ( ($pmda->buscaStatus($value ['id_pmda']) == '1') && 
         ($pmda->buscaStatus($value ['id_pmda']) > '2')  &&
         ($pmdaLegado))
         {
            print "&nbsp;<a id='btnVerificar' onclick='javascrip:duplicar(" . $value ['id_pmda'] . ")' title='Criar Cópia deste PMDA'><img width='30px' src='core/imagem/copia.png'></a>";
         }


    # somente mensagem novas
    if (count($pmda->listaMensagem($value ['id_pmda'], '0')) > 0) {
        $title = '/ Nova(s) Mensagem(s) Recebida(s) !';
        $icone = 'msg_not_nova.png';

        print "&nbsp;<a onclick=\"lerMensagemRecebida('" . $value ['id_pmda'] . "','nv')\" title='Troca de Mensagens / Nova(s) Mensagem(s) Recebida(s) !'><img src='core/imagem/msg_tr_nova.png'></a>";
    } elseif (count($pmda->listaMensagem($value ['id_pmda'], '')) > '0') {
        //print "&nbsp;<a data-toggle='modal' data-target='#modalMensagem' data-idpmda='".$value ['id_pmda']."' id='btnMensagem' title='Troca de Mensagens'><img src='core/imagem/msg_tr.png'></a>";
    }

    print "|<a onclick=\"historicoMsg(" . $value['id_pmda'] . ")\" id='list_msg' name='list_msg' title='Historico de Mensagens do PMDA nº " . $protocolo . "'><img src='core/imagem/notas.png'></a></td>";

    //print "<a href='#' id='btnDuplicarPmda' name='btnDuplicarPmda' data-idpmda='" . $value ['id_pmda'] . "' title='Cria um Clone deste PMDA para Edição'> <img src='core/imagem/duplicar.png'></a>";
    print "</td></tr>";
}
?>

        </table>

    </div>
</div>

<!-- Modal Msg -->
<div class="modal fade" id="modalMensagem">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Troca de Mensagens</h4>
            </div>
            <div class="modal-body">

                <div class="col-md-12">
                    <label title="" id="labelMsg">Enviar Mensagem &nbsp;<span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></label>
                    <textarea class="form-control" type="text" name="txtMsg" id="txtMsg" rows="5" cols="5"/></textarea>
                    <input type="hidden" id='txtIdPmdaMsg' name='txtIdPmdaMsg'>
                    <input type="hidden" id='txtIdUsuario' name='txtIdUsuario'>
                    <input type="hidden" id='txtIdMunicipio' name='txtIdMunicipio'>
                    <input type="hidden" id='txtDtEnvio' name='txtDtEnvio' value='<?= date("Y-m-d H:i:s"); ?>'>
                    <input type="hidden" id='txtProtocolo' name='txtProtocolo'>
                    <br> 

                    <button type="button" class="btn btn-primary" id="btnCadMensagem">Enviar</button>
                </div>
                <br>
                <div class="modal-footer">
                    <!--<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>-->
                </div>
            </div>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->


<!-- =================== RODAPE  ============================ -->
<?php include_once "template/page/rodape.php"; ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>
<script type="text/javascript">

    $(document).ready(function () {


        $("#idVoltarMenu").click(function () {
            window.location.href = 'index.php?token=<?=hash('sha256', md5(VERSAO)."-".time())?>&modulo=index&controller=index&action=menue';
        })


        /* Mostra Mensagens Analista  */
        $('a[name="mensagem"]').click(function () {

            var id_pmda = $(this).data('idpmda');
            var status = $(this).data('status');

            //console.log(id_pmda);

            $.ajax({
                url: '/mod_index/app/login/ckLogin.php',
                type: 'POST',
                success: function (response) {
                    if (response == "sucesso") {
                        // codigo

                        var dados = {
                            "id_pmda": id_pmda,
                            "status": status,
                            "opcao": "list_msg",
                        };

                        $.ajax({
                            type: 'POST',
                            url: 'mod_pipa/frontEnd/View/pmda/mensagemView.php',
                            data: dados,
                            //dataType: 'json',
                            success: function (response) {
                                //alert("Registro adicionado com sucesso !");
                                //$("#mensagem").html(response);
                                console.log(response);
                            },
                            error: function (e) {
                                console.log(JSON.stringify(e));
                            }

                        });

                    } else {
                        alert('Sessão expirada !')
                        window.location.href = 'index2.php';
                    }
                },
                error: function (response) {
                    console.log(JSON.stringify(response));
                }
            });


        });


        /* mostrar form cadastro Comunidade*/
        $("#btnMostraCadComunidade").click(function () {

            $.ajax({
                url: '/mod_index/app/login/ckLogin.php',
                type: 'POST',
                success: function (response) {
                    if (response == "sucesso") {
                        $("#frmCadComunidade").show();
                        $("#btnMostraCadComunidade").hide();
                    } else {
                        alert('Sessão expirada !')
                        window.location.href = 'index2.php';
                    }
                },
                error: function (response) {
                    console.log(JSON.stringify(response));
                }
            });
        });


        /* mostrar form cadastro Ponto Captação*/
        $("#btnMostraCadPontoCap").click(function () {
            $.ajax({
                url: '/mod_index/app/login/ckLogin.php',
                type: 'POST',
                success: function (response) {
                    if (response == "sucesso") {
                        $("#frmCadPontoCap").show();
                        $("#btnMostraCadPontoCap").hide();

                    } else {
                        alert('Sessão expirada !')
                        window.location.href = 'index2.php';
                    }
                },
                error: function (response) {
                    console.log(JSON.stringify(response));
                }
            });

        });

        /* mostrar form cadastro Membro Compdec*/
        $("#btnMostraCadMembroCompdec").click(function () {

            //arrumar
            $.ajax({
                url: '/mod_index/app/login/ckLogin.php',
                type: 'POST',
                success: function (response) {
                    if (response == "sucesso") {
                        $("#frmCadMembroCompdec").show();
                        $("#btnMostraCadMembroCompdec").hide();
                    } else {
                        alert('Sessão expirada !')
                        window.location.href = 'index2.php';
                    }
                },
                error: function (response) {
                    console.log(JSON.stringify(response));
                }
            });
        });

        /* mostrar form cadastro Representante */
        $("#btnMostraCadRep").click(function () {
            $("#frmCadRepresentante").show();
            $("#btnMostraCadRep").hide();
        });


        /* limite latitude */
        $("#txtLatPontoCap").blur(function () {

            //coordLat($("#txtLatPontoCap").val());

        });

        /* limite Longitude */
        $("#txtLongPontoCap").blur(function () {

            //coordLong($("#txtLongPontoCap").val());

        });

        var id_pmda = getUrlVars()['param'];

        $("#lk_alteracao").click(function () {

            var result = confirm('Deseja enviar uma solicitação de Alteração do PMDA ?');

            if (result == true) {
            }
        });


        /** 
         */
        $("#tblListaPmda a").click(function () {
            var id_pmda = $(this).data('idpmda');
            var protocolo = $(this).data('protocolo');
            //alert(id_pmda);
            //window.href = '?modulo=pipa&controller=pipa&action=index&param='+id_pmda+'&p='+$protocolo;

        });

        /**
         *
         * gravar dados municipio
         *
         *
         */
        $("#btnInfoMunicipio").click(function () {

            $.ajax({
                url: '/mod_index/app/login/ckLogin.php',
                type: 'POST',
                success: function (response) {
                    if (response == "sucesso") {
                        var dados = {"txtPrefeito": $("#txtPrefeito").val(),
                            "txtTel": $("#txtTel").val(),
                            "txtFax": $("#txtFax").val(),
                            "txtCelPref": $("#txtCelPref").val(),
                            "txtTelPref": $("#txtTelPref").val(),
                            "txtEndereco": $("#txtEndereco").val(),
                            "txtBairro": $("#txtBairro").val(),
                            "txtCep": $("#txtCep").val(),
                            "txtEmail": $("#txtEmail").val(),
                            "txtPopUrbana": $("#txtPopUrbana").val(),
                            "txtPopRural": $("#txtPopRural").val(),
                            "txtAreaTerr": $("#txtAreaTerr").val(),
                            "selCobraIss": $("#selCobraIss").val(),
                            "txtAliquota": $("#txtAliquota").val(),
                            "selResp": $("#selResp").val(),
                            "txtNumLei": $("#txtNumLei").val(),
                            "id_municipio": $("#txtIdMunicipioCom").val(),
                            "btnInfoMunicipio": "gravar",

                        };

                        var result = confirm("Deseja gravar as Alteraçãoes ?");

                        if (result) {

                            $.ajax({
                                url: '/mod_pipa/frontEnd/View/pmda/municipio.php',
                                type: 'POST',
                                data: dados,
                                //dataType : 'json',
                                success: function (response) {
                                    if (response == 'sucesso') {
                                        alert('Dados gravados com Sucesso !');
                                        //window.location = window.location.href+"#municipio";
                                        window.location.reload();
                                    } else {
                                        alert("Não foi possivel gravar verifique os campos obrigatórios !");
                                    }
                                },
                                error: function (response) {
                                    console.log(JSON.stringify(response));
                                },
                            });
                        }
                    } else {
                        alert('Sessão expirada !')
                        window.location.href = 'index2.php';
                    }
                },
                error: function (response) {
                    console.log(JSON.stringify(response));
                }
            });
        });

        /**
         *
         * DUPLICAR PMDA
         *
         *
         */
        $("#btnDuplicarPmda").click(function () {

            var id_pmda = $(this).data('idpmda');
            var id_municipio = $(this).data('idpmda');

            $.ajax({
                url: '/mod_index/app/login/ckLogin.php',
                type: 'POST',
                success: function (response) {
                    if (response == "sucesso") {
                        var dados = {
                            "id_pmda": id_pmda,
                            "id_municipio": id_municipio,
                            "opcao": "duplicar",

                        };

                        var result = confirm("Deseja Duplicar esse Pmda ?");

                        if (result) {

                            $.ajax({
                                url: 'mod_pipa/app/pmda/pmda.php',
                                type: 'POST',
                                data: dados,
                                //dataType : 'json',
                                success: function (response) {
                                    if (response == 'sucesso') {
                                        alert('PMDA Duplicado com Sucesso !');
                                    }
                                },
                                error: function (response) {
                                    console.log(JSON.stringify(response));
                                }
                            });
                        }

                        //$("#txtDescrAcoes").val("");
                        //$("#txtQtdContratado").val("");

                    } else {
                        alert('Sessão expirada !')
                        window.location.href = 'index2.php';
                    }
                },
                error: function (response) {
                    console.log(JSON.stringify(response));
                }
            });
        });



        /*********** Adcionar pmda novo ***********/
        $("#addPmda").click(function () {

            // alerta para novo Pmda
            var novoPmda = <?= $novoPmda ?>;
            if (novoPmda == 0) {

                $.ajax({
                    url: '/mod_index/app/login/ckLogin.php',
                    type: 'POST',
                    success: function (response) {
                        if (response == "sucesso") {
                            //inicio
                            //console.log('opa');
                            var dados = {"envia": "novo",
                                "id_municipio": "<?= isset($_COOKIE['seguranca']['id_municipio']) ? $_COOKIE['seguranca']['id_municipio'] : "-"; ?>",
                            };

                            $.ajax({
                                type: 'POST',
                                //dataType: 'json',
                                url: '/mod_pipa/frontEnd/View/pmda/novo.php',
                                data: dados,
                                success: function (response) {
                                    //console.log(dados);
                                    window.location.reload();
                                }
                            });
                            //fim
                        } else {
                            alert('Sessão expirada !')
                            //window.location.href ='index2.php';
                        }
                        location.reload();
                    },
                    error: function (response) {
                        console.log(JSON.stringify(response));
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Existe PMDA em Edição ou Em análise !',
                    text: 'Não é possivel criar outro PMDA',
                    //footer: '<a href>Why do I have this issue?</a>'
                })
            }
        });

    });

    /* envia para homologação */
    function homologa(id_pmda) {

        $.ajax({
            url: '/mod_index/app/login/ckLogin.php',
            type: 'POST',
            success: function (response) {
                if (response == "sucesso") {
                    var dados = {

                        "btnEnviar": "gravar",
                        "id_pmda": id_pmda,
                        "status": "2",
                        "data": "<?= date('Y-m-d h:i:s'); ?>",
                    };
                    var result = confirm("Deseja enviar o PMDA para Homologação ?");

                    if (result) {

                        $.ajax({
                            type: 'POST',
                            url: '/mod_pipa/frontEnd/View/pmda/homologacao.php',
                            data: dados,
                            success: function (response) {
                                //location.reload();
                                console.log(response);
                            },
                            error: function (response) {
                                console.log(JSON.stringify(response));
                            }
                        });

                        $("#btnVerificar").hide();
                    }
                } else {
                    alert('Sessão expirada !')
                    window.location.href = 'index2.php';
                }
            },
            error: function (response) {
                console.log(JSON.stringify(response));
            }
        });
    }

    /* editar pmda */
    function editar(id_pmda, protocolo, id_municipio) {
        $.ajax({

            url: '/mod_index/app/login/ckLogin.php',
            type: 'POST',
            success: function (response) {
                if (response == "sucesso") {
                    var dados = [];
                    $.ajax({
                        type: 'POST',
                        url: '#',
                        data: dados,
                        success: function (response) {
                            window.location.href = '?token=<?= hash("sha256", md5(VERSAO).date('dmY')); ?>&ac=etn&modulo=pipa&controller=pipa&action=pmda&param=' + id_pmda + '&p=' + protocolo + '&mun=' + id_municipio;
                        },
                        error: function (response) {
                            console.log(JSON.stringify(response));
                        }
                    });

                } else {
                    alert('Sessão expirada !')
                    //window.location.href ='index2.php';
                }
            },
            error: function (response) {
                console.log(JSON.stringify(response));
            }
        });
    }

    /* mensgem pmda */
    function mensagem() {
        $.ajax({

            url: '/mod_index/app/login/ckLogin.php',
            type: 'POST',
            success: function (response) {
                if (response == "sucesso") {
                    var dados = [];
                    $.ajax({
                        type: 'POST',
                        url: '#',
                        data: dados,
                        success: function (response) {
                            window.location.href = '?ac=etn&modulo=pipa&controller=pipa&action=mensagem';
                        },
                        error: function (response) {
                            console.log(JSON.stringify(response));
                        }
                    });

                } else {
                    alert('Sessão expirada !')
                    //window.location.href ='index2.php';
                }
            },
            error: function (response) {
                console.log(JSON.stringify(response));
            }
        });
    }

    /* impressao pmda */
    function impressao(id_pmda, id_municipio) {
        $.ajax({

            url: '/mod_index/app/login/ckLogin.php',
            type: 'POST',
            success: function (response) {
                if (response == "sucesso") {
                    var dados = [];
                    $.ajax({
                        type: 'POST',
                        url: '#',
                        data: dados,
                        success: function (response) {
                            window.location.href = '?token=<?= hash('sha256', md5(VERSAO).date('dmY')) ?>&ac=etn&modulo=pipa&controller=pipa&action=printPmda&param=' + id_pmda + '&mun=' + id_municipio;
                        },
                        error: function (response) {
                            console.log(JSON.stringify(response));
                        }
                    });
                    $("#btnVerificar").hide();
                } else {
                    alert('Sessão expirada !')
                    //window.location.href ='index2.php';
                }
            },
            error: function (response) {
                console.log(JSON.stringify(response));
            }
        });
    }

    /* Verifica Pendencias do PMDA */
    function verificaPendencia(id_pmda) {

        $.ajax({
            url: '/mod_index/app/login/ckLogin.php',
            type: 'POST',
            success: function (response) {
                if (response == "sucesso") {

                    var dados = {

                        "btnEnviar": "verifica",
                        "id_pmda": id_pmda,
                    };
                    var result = confirm("Confirma a Verificação do Status do PMDA ?");

                    if (result) {

                        $.ajax({
                            type: 'POST',
                            url: '/mod_pipa/frontEnd/View/pmda/homologacao.php',
                            data: dados,
                            success: function (response) {
                                //console.log(response);
                                if (response == "0") {

                                    alert("");
                                    location.reload();
                                } else if (response == "1") {
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        title: 'Parabéns ! Seu pmda está em condiçoes de Envio para Homologação ! \n 1) Verifique os parâmetros mínimos para envio ! \n 2) Consulte a Documentação de Preenchimento ! \n 3) Fique atento as Regras de Aprovação do PMDA ! ',
                                        showCloseButton: true,
                                        timer: 5500
                                    }).then((result) => {
                                        window.location.reload();
                                    });

                                    //window.location.reload();

                                    //alert("Este PMDA está com o mínino de condições para ser homologado, \nesta condição porém, deve ser avaliada pelo corpo técnico da Diretoria de Resposta à Desastres ! \n Por favor Clique em \"Enviar p/ Homologação\"");
                                }
                            },
                            error: function (response) {
                                console.log(JSON.stringify(response));
                            }
                        });
                    }

                } else {
                    alert('Sessão expirada !')
                    window.location.href = 'index2.php';
                }
            },
            error: function (response) {
                console.log(JSON.stringify(response));
            }
        });
        
    }    
        /**
         *  DUPLICAR PMRAA
         *
         */
    function duplicar(id_pmda) {

        $.ajax({
            url: '/mod_index/app/login/ckLogin.php',
            type: 'POST',
            success: function (response) {
                if (response == "sucesso") {

                    var dados = {

                        "btnEnviar": "duplicar",
                        "id_pmda": id_pmda,
                    };
                    var result = confirm("Confirma a Duplicação deste PMDA ?");

                    if (result) {

                        $.ajax({
                            type: 'POST',
                            url: '/mod_pipa/frontEnd/View/pmda/duplicar.php',
                            data: dados,
                            success: function (response) {
                                if (response == "sucesso") {
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        title: 'Este PMDA foi duplicado com Sucesso ',
                                        showCloseButton: true,
                                        timer: 5500
                                    }).then((result) => {
                                        window.location.reload();
                                    });
                                }
                            },
                            error: function (response) {
                                console.log(JSON.stringify(response));
                            }
                        });
                    }

                } else {
                    alert('Sessão expirada !')
                    window.location.href = 'index2.php';
                }
            },
            error: function (response) {
                console.log(JSON.stringify(response));
            }
        });


    }

    /**
     * Download termo de compromisso
     */
    function termo_compromisso() {
        window.location.href = 'index.php?token=<?= hash('sha256', md5(VERSAO).date('dmY')); ?>&ac=etn&modulo=pipa&controller=pipa&action=termo&param=<?= $id_pmda; ?>&mun=<?= $id_municipio; ?>';

    }

    /**
     * Download Declaração ISS
     */
    function declaracaoiss() {
        window.location.href = 'index.php?token=<?= hash('sha256', md5(VERSAO).date('dmY')); ?>&ac=etn&modulo=pipa&controller=pipa&action=declaracaoiss&param=<?= $id_pmda; ?>&mun=<?= $id_municipio; ?>';

    }


    /* Ver historico de mensagens  */
    function historicoMsg(id_pmda, $opcao) {
        window.location.href = 'index.php?token=<?= hash('sha256', md5(VERSAO).date('dmY')); ?>&modulo=pipa&controller=pipa&action=historicoMsg&id_pmda=' + id_pmda + '&opcao=msg_pmda';
    }
    /* ver mensagens recebidas */
    function lerMensagemRecebida(id_pmda, opcao) {
        window.location.href = 'index.php?token=<?= hash('sha256', md5(VERSAO).date('dmY')); ?>&ac=etn&modulo=pipa&controller=pipa&action=mensagem&id_pmda=' + id_pmda + '&opcao=' + opcao;
    }

    function ajudacoordenada() {
        window.location.href = 'http://conversor-de-medidas.com/coordenadas-geograficas';
    }

    function passoapasso() {
        window.location.href = 'doc/PMDA_INSTRUCAO_VERSAO_COMPDEC.pdf';
    }
</script>