var codagente;
var idgrupo;
var lblsup = ['Atendendo', 'Livres', 'Tabulandox', 'Pausa'];
var datasup = [0, 0, 0, 0];
var datasupa = [0, 0, 0, 0];
var atsup = -1;
var livresup = -1;
var idoper = 0;
var timersup;
var timergrafico;
$(function () {
    /*
     $('.tabitem').on('click', function(){
     
     $('.activetab').removeClass('activetab');
     $(this).addClass('activetab');
     
     var item = $('.activetab').index();
     $('.tabbody').hide();
     $('.tabbody').eq(item).show();
     
     });
     
     $('#busca').on('focus', function(){
     $(this).animate({
     width:'250px'
     }, 'fast');
     });
     
     $('#busca').on('blur', function(){
     if($(this).val() == '') {
     $(this).animate({
     width:'100px'
     }, 'fast');
     }
     
     setTimeout(function(){
     $('.searchresults').hide();
     }, 500);
     });
     
     $('#busca').on('keyup', function(){
     var datatype = $(this).attr('data-type');
     var q = $(this).val();
     
     if(datatype != '') {
     $.ajax({
     url:BASE_URL+'/ajax/'+datatype,
     type:'GET',
     data:{q:q},
     dataType:'json',
     success:function(json) {
     if( $('.searchresults').length == 0 ) {
     $('#busca').after('<div class="searchresults"></div>');
     }
     $('.searchresults').css('left', $('#busca').offset().left+'px');
     $('.searchresults').css('top', $('#busca').offset().top+$('#busca').height()+3+'px');
     
     var html = '';
     
     for(var i in json) {
     html += '<div class="si"><a href="'+json[i].link+'">'+json[i].name+'</a></div>';
     }
     
     $('.searchresults').html(html);
     $('.searchresults').show();
     }
     });
     }
     
     });
     */
    usoOperadoras();
    volumeOperadoras();
    getStatusGeralOperadores();
    clearInterval(dash);
    clearInterval(volume);
    var dash = setInterval(function () {
        usoOperadoras();
        getStatusGeralOperadores();
    }, 30000
            )

    var volume = setInterval(function () {
        volumeOperadoras();
    }, 60000
            )

    $('#formrec').bind('submit', function (e) {
        e.preventDefault();
//        $('.pag_item').remove();
//        $('.trdetailresultfind').remove();
        var param = $(this).serialize();
        listRecording(param);
    });
    $('#pagit').bind('change', function (e) {
        e.preventDefault();
        var param = $('#formrec').serialize();
        var p = $('#pagit').val();
        param = param + '&p=' + p;
//        $('.pag_item').remove();
        listRecording(param);
    });
    $('#formOperadora').bind('submit', function (e) {
        e.preventDefault();
        var param = $('#formOperadora').serialize();
        param = 'idoper=' + idoper + '&' + param;
        //alert(param);
        $.ajax({
            type: 'POST',
            url: BASE_URL + '/ajax/saveOperadora',
            data: param,
            dataType: 'text',
            success: function () {
                window.location.href = BASE_URL + '/operadoras';
            }
        })
        idoper = 0;
    })
    $('#escuta').bind('click', function () {
        $.ajax({
            type: 'POST',
            url: BASE_URL + '/ajax/monitorarRamal',
            data: {id_empresa: "1", monitorado: codagente, idgrupodac: idgrupo, tpmon: "1"}
        })
    })
    $('#despausar').bind('click', function () {
        $.ajax({
            type: 'POST',
            url: BASE_URL + '/ajax/despausarRamal',
            data: {agente: codagente}
        })
    })
    $('#Encerrar').bind('click', function () {
        document.getElementById("optionAgente").style.display = "none";
        codagente = $('#agenteRamal').val();
        // alert('Encerrando operador '+codagente);
        $.ajax({
            type: 'POST',
            url: BASE_URL + '/ajax/deslogarRamal',
            data: {agente: codagente},
            success: function () {
                setTimeout(() => {
                    listaCampnhas($('#supcamp').val());
                }, 1000);
            }
        })
    })
    // $('#frmTarifas').bind('submit', function (e) {
    //     var param = $('#frmTarifas').serialize();
    //     alert(param);
    // });

    $('#selectCond').bind('change', function () {
        $('.lineOper').remove();
        ativo = $('#selectCond').val();
        $.ajax({
            type: 'POST',
            url: BASE_URL + '/ajax/selOperadoras',
            data: {ativo: ativo},
            dataType: 'json',
            success: function (json) {
                if (json.listOperadoras.length > 0) {
                    for (var i in json.listOperadoras) {
                        html = '<tr class="lineOper">' +
                                '<a href="#"><td>' + json.listOperadoras[i].OPE_DESC + '</a></td>' +
                                '<td>' + json.listOperadoras[i].OPE_CSP + '</td>' +
                                '<td>' + json.listOperadoras[i].OPE_TECHPREFIX + '</td>' +
                                '<td>' + json.listOperadoras[i].OPE_IP1 + '</td>' +
                                '<td>' + json.listOperadoras[i].OPE_MAXCANAIS + '</td>' +
                                '<td class="tdtrash">' +
                                '<a href="#" onclick="selOperadora(' + json.listOperadoras[i].ID_OPERADORA + ')"' +
                                'title="Editar" ><img class="imgtrash" src="' + BASE_URL + '/assets/images/edit.png"' +
                                'style="width: 20px;height: 20px;margin-right: 30px;" >' +
                                '</a>' +
                                '<a href="' + BASE_URL + '/operadoras/delete/<?php echo $op[' + json.listOperadoras[i].ID_OPERADORA + ']; ?>" ' +
                                'onclick="return confirm(' + 'Excluir operadora ?' + ')">' +
                                '<img class="imgtrash" src="' + BASE_URL + '/assets/images/trash.png" ' +
                                'style="width: 20px;height: 20px;">' +
                                '</a>' +
                                '</td>' +
                                '</tr>';
                        $('#tboperadoras').append(html);
                    }
                }
            }
        })
    })

    // $('#supcamp').bind('change', function () {
    //     $('.gr').remove();
    //     ativo = $('#supcamp').val();
    //     $.ajax({
    //         type: 'POST',
    //         url: BASE_URL + '/group/selGrupos/'+ativo,
    //         data: {ativo: ativo},
    //         dataType: 'json',
    //         success: function (json) {
    //             if (json.group.length > 0) {
    //                 for (var i in json.group) {
    //                     html = '<option class="gr" id="opgr" value="'+json.group[i].id_grupo+'" >'+
    //                             json.group[i].id_grupo+' - '+json.group[i].descricao+
    //                             '</option>';
    //                     $('#group').append(html);

    //                 }
    //             }
    //             $('#group').change();
    //         }
    //     })
    // })
    $(document).ready(function () {
        $('.js-example-basic-multiple').select2();
    });

    $('#selectCondAgents').bind('change', function () {
        idoper = 0;
        $('#nome').val('');
        $('#login').val('');
        $('#senha').val('');
        $('#localAgente').val('');
        $('#tipoRamal').val('');
        $('#ativo').val('');
        $('.lineAgents').remove();
        ativo = $('#selectCondAgents').val();
        $.ajax({
            type: 'POST',
            url: BASE_URL + '/ajax/selAgents',
            data: {ativo: ativo},
            dataType: 'json',
            success: function (json) {
                if (json.listAgents.length > 0) {
                    for (var i in json.listAgents) {
                        html = '<tr class="lineAgents">' +
                                '<td class="tdage">' + json.listAgents[i].nome + '</td>' +
                                '<td class="tdage">' + json.listAgents[i].username + '</td>' +
                                '<td class="tdexcluir">' +
                                '<a href="#" onclick="selAgente(' + json.listAgents[i].id + ')" title="Editar">' +
                                '<img class="imgtrash" src="' + BASE_URL + '/assets/images/edit.png" style="width: 20px;height: 20px;margin-right: 30px;" >' +
                                '</a>' +
                                '<a href=#><img src=' + BASE_URL + '/assets/images/trash.png class="imgtrash" style="width: 20px;height: 20px;"></a></td>' +
                                '</tr>';
                        $('#tbAgents').append(html);
                    }
                }
            }
        })
    })

    $('#selCamp').bind('change', function () {
        var ativo = $('#selCamp').val();
        idoper = 0;
        $('#nome').val('');
        $('#data_inicio').val('');
        $('#data_fim').val('');
        $('#ativo').val('');
        $('.lineCamp').remove();
        $.ajax({
            type: 'POST',
            url: BASE_URL + '/campanhas/selCampanhas/' + ativo,
            data: {ativo: ativo},
            dataType: 'json',
            success: function (json) {
                if (json.campanhas.length > 0) {
                    for (var i in json.campanhas) {
                        var dti = formataData(json.campanhas[i].CAMP_DT_INICIO);
                        var dtf = formataData(json.campanhas[i].CAMP_DT_FIM);
                        html = '<tr class="lineCamp">' +
                                '<td>' + json.campanhas[i].CAMP_DESC + '</td>' +
                                '<td>' + dti + '</td>' +
                                '<td>' + dtf + '</td>' +
                                '<td class="tdtrash">' +
                                '<a href="#" title="Editar">' +
                                '<img onclick="selCampanha(' + json.campanhas[i].ID_CAMPANHA + ')" class="imgtrash" src="' + BASE_URL + '/assets/images/edit.png" style="width: 20px;height: 20px;margin-right: 30px;" >' +
                                '</a>' +
                                '<a href="' + BASE_URL + '/campanhas/delete/' + json.campanhas[i].ID_CAMPANHA + '" onclick="return confirm(' + 'Excluir campanha ?)">' +
                                '<img class="imgtrash" src="' + BASE_URL + '/assets/images/trash.png" style="width: 20px;height: 20px;" >' +
                                '</a>' +
                                '</td></tr>';
                        $('#tbcampanha').append(html);
                    }
                }
            }
        })
    })

    $('#formCampanha').bind('submit', function (e) {
        e.preventDefault();
        var param = $('#formCampanha').serialize();
        $('#resumoCustos').html('<h3>Processando <img src="assets/images/loading.gif"></h3>');
        $.ajax({
            type: 'POST',
            url: BASE_URL + '/campanhas/saveCampanha/' + idoper,
            data: param,
            dataType: 'text',
            success: function () {
                window.location.href = BASE_URL + '/campanhas/listCampanhas';
            }
        })
        idoper = 0;
    })

    $('#formGroup').bind('submit', function (e) {
        e.preventDefault();
        var param = $('#formGroup').serialize();
        $.ajax({
            type: 'POST',
            url: BASE_URL + '/group/saveGroup/' + idoper,
            data: param,
            dataType: 'text',
            success: function () {
                window.location.href = BASE_URL + '/group';
            }
        })
        idoper = 0;
    })

    $('#selGroup').bind('change', function () {
        var ativo = $('#selGroup').val();
        idoper = 0;
        $('#idgroup').val('');
        $('#campanha').val('');
        $('#nome').val('');
        $('#clerical').val('');
        $('#filamax').val('');
        $('#ativo').val('');
        $('.lineGroup').remove();
        $.ajax({
            type: 'POST',
            url: BASE_URL + '/group/listGroup/' + ativo,
            data: {ativo: ativo},
            dataType: 'json',
            success: function (json) {
                if (json.group.length > 0) {
                    for (var i in json.group) {
                        html = '<tr class="lineGroup">' +
                                '<td>' + json.group[i].id_grupo + '</td>' +
                                '<td>' + json.group[i].descricao + '</td>' +
                                '<td class="tdtrash">' +
                                '<a href="#" onclick="editGroup(' + json.group[i].id_grupo + ')" title="Editar">' +
                                '<img class="imgtrash" src="' + BASE_URL + '/assets/images/edit.png" style="width: 20px;height: 20px;margin-right: 30px;" >' +
                                '</a>' +
                                '<a href="' + BASE_URL + '/campanhas/delete/' + json.group[i].id_grupo + '" onclick="return confirm(' + 'Excluir campanha ?)">' +
                                '<img class="imgtrash" src="' + BASE_URL + '/assets/images/trash.png" style="width: 20px;height: 20px;" >' +
                                '</a>' +
                                '</td></tr>';

                        $('#tblistGroup').append(html);

                    }
                }
            }
        })
    })

    $('#saveCadencia').bind('click', function () {
        var param = $('#formCadencia').serialize();
        param = 'idoper=' + idoper + '&' + param;
        $.ajax({
            type: 'POST',
            url: BASE_URL + '/ajax/saveCadencia',
            data: param,
            dataType: 'text'
        })
        idoper = 0;
    })
    $('#delCadencia').bind('click', function () {
        alert('deletou');
    })

    $('#saveRegra').bind('click', function () {
        var param = $('#formRegra').serialize();
        param = 'idoper=' + idoper + '&' + param;
        $.ajax({
            type: 'POST',
            url: BASE_URL + '/ajax/saveRegra',
            data: param,
            dataType: 'text'
        })
        idoper = 0;
    })

    $('#group').bind('change', function (e) {
        e.preventDefault();
        clearMonitor();
        atualizaMonitor($('#supcamp').val(), $('#group').val());
    })

    $('#formgruporota').bind('change', function () {
        var grupo = $('#grouprota').val();
        if (grupo == '' || grupo == null) {
            alert('Selecione um Grupo!');
        } else {
            $.ajax({
                type: 'POST',
                url: 'rotas/rotas_sel/' + grupo,
                dataType: 'text',
                data: {param: grupo},
                success: function (response) {
                    $('#formoprota').html(response).show();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    $('#formoprota').html(xhr.status + xhr.responseText)
                }
            });
        }
    });

    $('#formAgentes').bind('submit', function (e) {
        e.preventDefault();
        var param = $('#formAgentes').serialize();
        $.ajax({
            type: 'POST',
            url: BASE_URL + '/agentes/saveAgente/' + idoper,
            data: param,
            dataType: 'text',
            success: function () {
                window.location.href = BASE_URL + '/agentes';
            }
        })
        idoper = 0;
    })

    $('#selDisc').focus(function () {
        $('#selDisc').change();
    });

    $('#selDisc').bind('change', function () {
        var ativo = $('#selDisc').val();
        idoper = 0;
        $('.gr').remove();
        $('#nome').val('');
        $('#campgrupo').val('');
        $('#grupo').val('');
        $.ajax({
            type: 'POST',
            url: BASE_URL + '/discador/discadoresList',
            dataType: 'text',
            data: {param: ativo},
            success: function (response) {
                $('#listadiscadores').html(response).show();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $('#listadiscadores').html(xhr.status + xhr.responseText)
            }
        });
    });

    $('#formrelresumos').on('submit', function (e) {
        e.preventDefault();
        var data = $('#formrelresumos').serialize();
        $('#areaLigacoes').html('<h3>Processando <img src="assets/images/loading.gif"></h3>');
        $.ajax({
            type: 'GET',
            url: 'relresumo/relresumoDetalhe',
            dataType: 'text',
            data: data,
            success: function (response) {
                $('#relResumo').html(response).show();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $('#relResumo').html(xhr.status + xhr.responseText)
            }
        });
    });

    $('#fUsuario').on('submit', function (e) {
        e.preventDefault();
        var param = $('#fUsuario').serialize();
        $.ajax({
            type: 'POST',
            url: BASE_URL + '/users/add',
            dataType: 'text',
            data: param,
            success: function (response) {
                window.location.href = BASE_URL + '/users';
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $('#relResumo').html(xhr.status + xhr.responseText)
            }
        });
    });
    // $('#tabrec').DataTable({
    //     "bJQueryUI": true,
    //     "sPaginationType": "full_numbers",
    //     "sDom": '<"H"Tlfr>t<"F"ip>',
    //     "oLanguage": {
    //         "sLengthMenu": "Mostrar _MENU_ registros por página",
    //         "sZeroRecords": "Nenhum registro encontrado",
    //         "sInfo": "Mostrando _START_ / _END_ de _TOTAL_ registro(s)",
    //         "sInfoEmpty": "Mostrando 0 / 0 de 0 registros",
    //         "sInfoFiltered": "(filtrado de _MAX_ registros)",
    //         "sSearch": "Pesquisar: ",
    //         "oPaginate": {
    //             "sFirst": "Início",
    //             "sPrevious": "Anterior",
    //             "sNext": "Próximo",
    //             "sLast": "Último"
    //         }
    //     },
    //     "aaSorting": [[0, 'desc']],
    //     "aoColumnDefs": [
    //         {"sType": "num-html", "aTargets": [0]}

    //     ]
    // });        

    $('#formPausa').bind('submit', function (e) {
        e.preventDefault();
        var idpausa = $('#idpausa').val();
        var desc = $('#descPausa').val();
        var ativo = $('#ativoPausa').val();
        var param = $('#formPausa').serialize();
        if (idpausa == 0) {
            $.ajax({
                type: 'POST',
                url: BASE_URL + '/pausas/incluir/' + desc + '/' + ativo,
                data: param,
                dataType: 'text',
                success: function () {
                    window.location.href = BASE_URL + '/pausas';
                }
            })
        } else {
            $.ajax({
                type: 'POST',
                url: BASE_URL + '/pausas/editar/' + idpausa + '/' + desc + '/' + ativo,
                data: param,
                dataType: 'text',
                success: function () {
                    window.location.href = BASE_URL + '/pausas';
                }
            })
        }
        idoper = 0;
    })

    $('#formTabulação').bind('change', function () {
        var camp = $('#campanha').val();
        if (camp == '' || camp == null) {
            alert('Selecione um Grupo!');
        } else {
            $.ajax({
                type: 'POST',
                url: 'tabulacao/getLista/' + camp,
                dataType: 'text',
                data: {param: camp},
                success: function (response) {
                    $('#divtabulacao').html(response).show();
                    $('#idcampanha').val(camp);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    $('#divtabulacao').html(xhr.status + xhr.responseText)
                }
            });
        }
    });


});

function listRecording(param) {
    $('.trdetailresultfind').remove();
    $('#msgRec').html('<h3>Procurando <img src="assets/images/loading.gif"></h3>');
    $.ajax({
        type: 'POST',
        url: BASE_URL + '/recording/listRecords',
        data: param,
        dataType: 'text',
        success: function (response) {
            $('#tabrec').remove();
            $('#resultFind').html(response).show();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $('#resultFind').html(xhr.status + xhr.responseText)
            $('#msgRec').html('<h3>Nenhum registro encontrado...</h3>');
        }
    });
//    $('#msgRec').html('...');
}

function listRecord(param) {
    $('#msgRec').html('Procurando...');
    $.ajax({
        type: 'POST',
        url: BASE_URL + '/ajax/listRecords',
        data: param,
        dataType: 'json',
        success: function (json) {
            if (json.record_list.length > 0) {
                $('.trdetailresultfind').remove();
                for (var i in json.record_list) {
                    caminho = json.record_list[i].caminhoaudio;
                    caminho = caminho.replace(/#/g, '/');
                    audio = json.record_list[i].arquivoaudio;
                    $('#tabrec').append(
                            '<tr class="trdetailresultfind">' +
                            '<td class="trdetailresultfind">' + json.record_list[i].id + '</td>' +
                            '<td class="trdetailresultfind">' +
                            '<a href="#">' +
                            '<img src="' + BASE_URL + '/assets/images/play-button.png" class="btlistagravacoes" ' +
                            'title="Play" onclick="tocarRec(' + json.record_list[i].id + ')">' +
                            '</a>' +
                            //'<a href="#">'+
                            //	'<img src="'+BASE_URL+'/assets/images/pause.png" class="btlistagravacoes" title="Pause"'+
                            //      'onclick="puasaRec('+json.record_list[i].id+')">'+
                            //'</a>'+
                            '<a href="#">' +
                            '<img src="' + BASE_URL + '/assets/images/download.png" class="btlistagravacoes" title="Download"' +
                            'onclick="downRec(' + json.record_list[i].id + ')"></td>' +
                            '</a>' +
                            '<td class="trdetailresultfind">' + json.record_list[i].dh_inicio + '</td>' +
                            '<td class="trdetailresultfind">' + json.record_list[i].ddd + '</td>' +
                            '<td class="trdetailresultfind">' + json.record_list[i].fone + '</td>' +
                            '<td class="trdetailresultfind">' + json.record_list[i].nome_operadora + '</td>' +
                            '<td class="trdetailresultfind">' + json.record_list[i].nome_grupo + '</td>' +
                            '<td class="trdetailresultfind">' + json.record_list[i].duracao + '</td>' +
                            '<td class="trdetailresultfind">' + json.record_list[i].nome_direcao + '</td>' +
                            '<td class="trdetailresultfind">' + json.record_list[i].nome_campanha + '</td>' +
                            '</tr>'

                            );
                }
                $('#msgRec').html('');
            } else {
                $('#msgRec').html('Nenhum registro encontrado');
            }
            if (json.p_count > 0) {
                if (!$('.oppagit').length > 0) {
                    var html;
                    for (i = 1; i <= (json.p_count / 25 + 1); i++) {
                        html += '<option class="oppagit" value="' + i + '">' + i + '</option>';
                    }
                    $('#pagit').html(html);
                }
            }

        },
        error: function (xhr, ajaxOptions, thrownError) {
            $('#msgRec').html(xhr.status + ' ' + xhr.responseText + ' ' + thrownError)
            //$('#msgRec').html('Nenhuma ação executada');
        }
    })
}

function tocarRec(id) {
    $.ajax({
        type: 'POST',
        url: BASE_URL + '/ajax/playRecord',
        data: {id: id},
        datatype: 'text',
        success: function (t) {
            html = '<audio id="audioplay" autoplay controls>' +
                    '<source src="' + t + '" type="audio/mpeg">' +
                    '</audio>';
            document.getElementById('playrec').innerHTML = html;
//        	alert('Tocar '+t)
        }
    })
}

function pausaRec(id) {
    alert('pausado ' + caminho + ' ' + audio)
}
function downRec(id) {
    $.ajax({
        type: 'POST',
        url: BASE_URL + '/ajax/playRecord',
        data: {id: id},
        datatype: 'text',
        success: function (t) {
            window.location.href = t;
//            $('#playrec').attr({'href':"'"+t+"'"});
            // html = '<audio id="audioplay" autoplay controls>' +
            //         '<source src="' + t + '" type="audio/mpeg">' +
            //         '</audio>';
            // document.getElementById('playrec').innerHTML = html;
        }
    })
//    window.location.href = 'file://'+caminho + ' ' + audio;
    //alert('Download ' + caminho + ' ' + audio)
}

function getMonitor(camp, group) {
    var a = group;
    var c = camp;
    var img = '';
    var logados = 0;
    var at = 0;
    var livre = 0;
    var pausado = 0;
    var tabulando = 0;
    var fila = 0;
    timersup = setInterval(function () {
        $.ajax({
            url: BASE_URL + '/ajax/listMonitor',
            type: 'POST',
            data: {a: a, c: c},
            dataType: 'json',
            success: function (json) {
                clearMonitor();
                if (json.users.length > 0) {
                    logados = 0;
                    at = 0;
                    livre = 0;
                    pausado = 0;
                    tabulando = 0;
                    fila = 0;
                    gr1 = -1;
                    for (var i in json.users) {
                        item = i;
                        classe = 'black';
                        ddd = json.users[i].telefone;
                        ddd = ddd.toString();
                        ddd = ddd.substring(0, 2);
                        telefone = json.users[i].telefone;
                        telefone = telefone.toString();
                        telefone = telefone.substring(2, 12);
                        logados++;
                        img = '<img class="pgpimgsup" src=' + BASE_URL + '/assets/images/alert1.png ';
                        if (json.users[i].id_estado == 1) {
                            img = '<img class="pgpimgsup" src=' + BASE_URL + '/assets/images/superv_barra_status_livre.png ';
                            livre++;
                            classe = 'corlivre';
                        }
                        if (json.users[i].id_estado == 6) {
                            img = '<img class="pgpimgsup" src=' + BASE_URL + '/assets/images/superv_barra_status_clerical.png';
                            classe = 'cortabulando';
                            tabulando++;
                        }
                        if (json.users[i].id_estado == 7) {
                            img = '<img class="pgpimgsup" src=' + BASE_URL + '/assets/images/superv_barra_status_atendendo.png';
                            at++;
                            classe = 'coratendendo';
                        }
                        if (json.users[i].id_estado == 9) {
                            img = '<img class="pgpimgsup" src=' + BASE_URL + '/assets/images/superv_barra_status_pausa.png';
                            pausado++;
                            classe = 'corpausado';

                        }
                        if (img != '') {
                            img = img + ' width="20">';
                        }
                        if (gr1 != json.users[i].id_grupo && group == 0) {
                            '<div class="pmonitorgr >'
                            $('#groupsel').append('<div class="phpmonitor" > Grupo : ' +
                                    json.users[i].id_grupo +
                                    '</div>');
                            gr1 = json.users[i].id_grupo;
                        }
                        $('#groupsel').append(
                                '<div class="phpmonitor ' + classe + '" >' +
                                '<div class="clsimgescuta">' +
                                '<a href=# ><img id="escuta" onclick="monitoraRamal(' + json.users[i].codigo + ',' + json.users[i].id_grupo + ')" class="imgAgentesOptions" title="Monitorar" src=' + BASE_URL + '/assets/images/monitorar.png > </a>' +
                                '<a href=# id="despausar"><img class="imgAgentesOptions" title="Despausar" src=' + BASE_URL + '/assets/images/pauseAgente.png > </a>' +
                                '<a href=# id="deslogar"><img class="imgAgentesOptions" title="Deslogar" src=' + BASE_URL + '/assets/images/logout.png > </a>' +
                                '<a href=# id="apmailing"><img class="imgAgentesOptions" title="Ap. mailing" src=' + BASE_URL + '/assets/images/pie-chart.png > </a>' +
                                // '<a href="#"><img class="imgescuta" src='+BASE_URL+'/assets/images/escuta.png width="20" '+
                                //     ' id="monitorar' + json.users[i].codigo +'" onclick="monitorar(' + json.users[i].codigo + ',' + a + ')"></a>' + 
                                '</div>' +
                                '<div class="clstempo ' + classe + '">' + json.users[i].tempo + '</div>' +
                                '<div class="clsteleoperadora ' + classe + '">' + '  (' + ddd + ') ' + telefone + '  ' + json.users[i].operadora + '</div>' +
                                '<div class="clsestadoagente ' + classe + '">' + json.users[i].estado + '</div>' +
                                '<div class="clsimgstadoagente">' + img + '</div>' +
                                '<div class="clsnomeagente">' + json.users[i].nome + '</div>' +
                                '</div>'
                                );
                    }
                    $('#detres').append(
                            '<td class="detit atendendo" >' + at + '</td>' +
                            '<td class="detit livres" >' + livre + '</td>' +
                            '<td class="detit tabulando" >' + tabulando + '</td>' +
                            '<td class="detit pausados" >' + pausado + '</td>'

                            );
                    $('#detres2').append('<td class="detit logados" >' + logados + '</td>');
                    $('#detres3').append('<td class="detit filas" >' + fila + '</td>');
                }
            }
        })
    }, 1000);
}

function getDial(group) {
    var q = group;
    setTimeout(function () {
        $.ajax({
            url: BASE_URL + '/ajax/getDial',
            type: 'POST',
            data: {q: q},
            dataType: 'json',
            success: function (json) {
                clearMonitor();
                if (json.resDial.length > 0) {
                    datasup = [];
                    lblsup = [];
                    for (var i in json.resDial) {
                        lblsup.push(json.resDial[i].descricao);
                        datasup.push(json.resDial[i].qtd);
                    }
                    graficoSup();
                    //  	       	setTimeout(getMonitor(q),10000);
                }
            }
        })
    }, 1000);
    timergrafico = setInterval(function () {
        $.ajax({
            url: BASE_URL + '/ajax/getDial',
            type: 'POST',
            data: {q: q},
            dataType: 'json',
            success: function (json) {
                clearMonitor();
                if (json.resDial.length > 0) {
                    datasup = [];
                    lblsup = [];
                    for (var i in json.resDial) {
                        lblsup.push(json.resDial[i].descricao);
                        datasup.push(json.resDial[i].qtd);
                    }
                    graficoSup();
                    //  	       	setTimeout(getMonitor(q),10000);
                }
            }
        })
    }, 60000);
}

function clearMonitor() {
    $('.phpmonitor').remove();
    $('.detit').remove();
}

function atualizaMonitor(camp, group) {
    idgrupo = group;
    clearInterval(timersup);
    clearInterval(timergrafico);
    getMonitor(camp, group);
    getDial($('#group').val());
}

function monitorar(agente, idgrupo) {
    codagente = agente;
    idgrupo = idgrupo;
    if ($('#agenteOptions').css('display') == 'none') {
        $('#agenteOptions').css('display', 'block');
        $('#agenteOptions').css('left', $('#monitorar' + agente).offset().left + 'px');
        $('#agenteOptions').css('top', $('#monitorar' + agente).offset().top - 160 - $('#agenteOptions').height() + 'px');
    } else {
        $('#agenteOptions').css('display', 'none');
    }
}

// function monitoraRamal(agente, idgrupo) {
//     local = document.URL;
//     ws = new WebSocket('ws://' + SOCKET_SERVER + ':' + SOCKET_PORT);
//     ws.onopen = function (e) {};
//     ws.onerror = function (e) {
//         alert('Erro de conexão : ' + e + ' em ' + SOCKET_SERVER + ':' + SOCKET_PORT)
//     };
//     ws.send("monitorar(1;1;1;" + agente + ";" + local + ";1;)\n")
// }

function monitoraRamal(codagente, idgrupo) {
    $.ajax({
        type: 'POST',
        url: BASE_URL + '/ajax/monitorarRamal',
        data: {id_empresa: "1", monitorado: codagente, idgrupodac: idgrupo, tpmon: "1"}
    })
}

function selOperadora(id) {
    idoper = id;
    $.ajax({
        type: 'POST',
        url: BASE_URL + '/ajax/getOperadora',
        data: {id: id},
        dataType: 'json',
        success: function (json) {
            $('#nome').val(json.operadora[1]);
            $('#apelido').val(json.operadora[8]);
            $('#ip1').val(json.operadora[2]);
            $('#ip2').val(json.operadora[3]);
            $('#tech').val(json.operadora[5]);
            $('#canais').val(json.operadora[7]);
            $('#csp').val(json.operadora[6]);
            $('#local').val(json.operadora[18]);
            $('#ativo').val(json.operadora[13]);
            $('#ip').val(json.operadora[21]);
            $('#area').val(json.operadora[23]);
            $('#publica').val(json.operadora[22]);
            $('#regralocal').val(json.operadora[24]);
            $('#regraldn').val(json.operadora[25]);
        }
    })
}

function selCadencia(id) {
    idoper = id;
    $.ajax({
        type: 'POST',
        url: BASE_URL + '/ajax/getCadencia',
        data: {id: id},
        dataType: 'json',
        success: function (json) {
            $('#descCadencia').val(json.cadencia[1]);
            $('#ativoCadencia').val(json.cadencia[2]);
        }
    })
}

function selRegra(id) {
    idoper = id;
    $.ajax({
        type: 'POST',
        url: BASE_URL + '/ajax/getRegra',
        data: {id: id},
        dataType: 'json',
        success: function (json) {
            $('#descrRegra').val(json.regra.REG_DESC);
            $('#operadoraRegra').val(json.regra.ID_OPERADORA);
            $('#dtiRegra').val(json.regra.REG_INICIO);
            $('#dtfRegra').val(json.regra.REG_FIM);
            $('#casasRegra').val(json.regra.REG_CASADECIMAL);
            $('#ativoRegra').val(json.regra.ATIVO);
        }
    })
}

function selTarifas(id) {
    idoper = id;
    $.ajax({
        type: 'POST',
        url: BASE_URL + '/ajax/getTarifas',
        data: {id: id},
        dataType: 'json',
        success: function (json) {
            $('#id').val(json.tarifas[0].ID);
            $('#selcadLocal').val(json.tarifas[0].kdloc);
            $('#localVrTar').val(json.tarifas[0].tarloc);
            $('#selLde').val(json.tarifas[0].kdlde);
            $('#ldeVrTar').val(json.tarifas[0].tarlde);
            $('#selLdn').val(json.tarifas[0].kdldn);
            $('#ldnVrTar').val(json.tarifas[0].tarldn);
            $('#selVc1').val(json.tarifas[0].kdvc1);
            $('#vc1VrTar').val(json.tarifas[0].tarvc1);
            $('#selVc2').val(json.tarifas[0].kdvc2);
            $('#vc2VrTar').val(json.tarifas[0].tarvc2);
            $('#selVc3').val(json.tarifas[0].kdvc3);
            $('#vc3VrTar').val(json.tarifas[0].tarvc3);
        }
    })
}
function saveRota(e) {
    var param = $('#fRota').serialize();
    var grupo = $('#grouprota').val();
    $.ajax({
        type: 'POST',
        url: BASE_URL + '/rotas/rotas_save/' + grupo,
        dataType: 'text',
        data: param,
        success: function () {
            window.location.href = BASE_URL + '/rotas';
        }
    });
    return false;
}


function grupoAgente(id) {
    if (id == 0) {
        id = $('#idagentesup').val();
    }
    showDivDetalhar();
    $.ajax({
        type: 'POST',
        url: BASE_URL + '/agentes/gruposAgentes/' + id,
//        data: {id: id},
        dataType: 'text',
        success: function (response) {
            $('#pop').html('');
            $('#idDetalhar').html(response).show();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $('#resultFind').html(xhr.status + xhr.responseText)
            $('#msgRec').html('<h3>Nenhum registro encontrado...</h3>');
        }
    });

    //document.getElementById('fade').style.display='block';
    //document.getElementById('pop').style.display='block';
}

function saveGrupoAgente(e) {
    var param = $('#fGruposAgente').serialize();
    $.ajax({
        type: 'POST',
        url: BASE_URL + '/agentes/saveGruposAgente',
        data: param,
        dataType: 'text',
        success: function (response) {
            document.getElementById("optionAgente").style.display = "none";
            setTimeout(() => {
                listaCampnhas($('#supcamp').val());
            }, 5000);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert('Erro ao associar grupos')
        }
    });
    // document.getElementById('pop').style.display='none';
    // document.getElementById('fade').style.display='none';
    // document.getElementById('idDetalhar').style.display='none';
    exitDivDetalhar();
}

function selAgente(id) {
    idoper = id;
    $.ajax({
        type: 'POST',
        url: BASE_URL + '/agentes/getAgente/' + id,
        data: {id: id},
        dataType: 'json',
        success: function (json) {
            $('#idag').val(json.agente.id);
            $('#nome').val(json.agente.nome);
            $('#cpf').val(json.agente.cpf);
            $('#ramal').val(json.agente.ramal);
            $('#login').val(json.agente.username);
            $('#senha').val(json.agente.password);
            $('#localAgente').val(json.agente.ID_LOCALAGENTE);
            $('#tipoRamal').val(json.agente.ID_TIPORAMAL);
            $('#ativo').val(json.agente.ativo);
        }
    })
}

function selUser(id) {
    idoper = id;
    $.ajax({
        type: 'POST',
        url: BASE_URL + '/users/edit/' + id,
        data: {id: id},
        dataType: 'json',
        success: function (json) {
            $('#usuario').val(json.user_info.id);
            $('#login').val(json.user_info.login);
            $('#usermon').val(json.user_info.userMon);
            $('#gro up').val(json.user_info.idgrupo);
        }
    })
}


function selCampanha(id) {
    idoper = id;
    $.ajax({
        type: 'POST',
        url: BASE_URL + '/campanhas/getCampanha/' + id,
        data: {id: id},
        dataType: 'json',
        success: function (json) {
            $('#nome').val(json.campanha.CAMP_DESC);
            $('#data_inicio').val(json.campanha.CAMP_DT_INICIO);
            $('#data_fim').val(json.campanha.CAMP_DT_FIM);
            $('#ativo').val(json.campanha.ATIVO);
        }
    })
}

function editGroup(id) {
    idoper = id;
    $.ajax({
        type: 'POST',
        url: BASE_URL + '/group/getGroup/' + id,
        data: {id: id},
        dataType: 'json',
        success: function (json) {
            $('#idgroup').val(json.group.id_grupo);
            $('#nome').val(json.group.descricao);
            $('#campanha').val(json.group.ID_CAMPANHA);
            $('#filamax').val(json.group.maxfila);
            $('#clerical').val(json.group.tpclerical);
            $('#ativo').val(json.group.ativo);
        }
    })
}

function selPausa(id) {
    idoper = id;
    $.ajax({
        type: 'POST',
        url: BASE_URL + '/pausas/getPausa/' + id,
        data: {id: id},
        dataType: 'json',
        success: function (json) {
            $('#idpausa').val(json.pausa.id_motivopausa);
            $('#descPausa').val(json.pausa.mp_desc);
            $('#ativoPausa').val(json.pausa.ativo);
        }
    })
}

function formataData(data) {
    var dt = new Date(data);
    var dia = dt.getDate();
    var mes = dt.getMonth();
    var ano = dt.getFullYear();
    mes++;
    dia++;
    if (dia < 10) {
        dia = '0' + dia;
    }
    if (mes < 10) {
        mes = '0' + mes;
    }
    data = dia + '/' + mes + '/' + ano;
    return data;
}

function usoOperadoras() {
    var dt = new Date();
    var a = dt.getHours() + ':' + dt.getMinutes();
    var aOperadoras = [];
    var canais = [];
    var uso = [];
    var livres = [];
    aOperadoras[0] = 'x';
    canais[0] = 'CANAIS';
    uso[0] = 'EM USO';
    livres[0] = 'LIVRES';
    $('#myChart3').html('');
    var a = 1;
    $.ajax({
        type: 'POST',
        url: BASE_URL + '/operadoras/getUsoOperadoras',
        dataType: 'json',
        success: function (json) {
            if (json.operadoras.length > 0) {
                for (var i in json.operadoras) {
                    aOperadoras[a] = json.operadoras[i].operadora;
                    canais[a] = json.operadoras[i].qtdcanais;
                    uso[a] = json.operadoras[i].ocupacao;
                    livres[a] = json.operadoras[i].livres;
                    a = a + 1;
                }

                c3.generate({
                    bindto: '#myChart3',

                    data: {
                        x: 'x',
                        type: 'bar',
                        labels: true,
                        columns: [
                            aOperadoras,
                            canais,
                            uso,
                            livres,
                        ],
                        colors: {
                            'CANAIS': '#4682B4',
                            'EM USO': '#CD5C5C',
                            'LIVRES': '#9ACD32',

                        },
                        groups: [
                            ['CANAIS', 'EM USO', 'LIVRES']
                        ]
                    },
                    axis: {
                        y: {
                            show: false
                        },
                        x: {
                            type: 'category',

                        }
                    }

                });
            }
        }
    })
}

function getStatusGeralOperadores() {
    var dt = new Date();
    var a = dt.getHours() + ':' + dt.getMinutes();
    $.ajax({
        type: 'POST',
        url: BASE_URL + '/agentes/getStatusGeral',
        dataType: 'json',
        success: function (json) {
            // $('.detStatusGeralAgentes').remove();
//            for (var i in json.statusOperacao) {
            // html = '<tr class="detStatusGeralAgentes">'+
            //     '<td>'+json.statusOperacao[0]+'</td>'+
            //     '<td>'+json.statusOperacao[1]+'</td>'+
            //     '<td>'+json.statusOperacao[2]+'</td>'+
            //     '<td>'+json.statusOperacao[3]+'</td>'+
            // '</tr>';
            // $('#tbStatusGeralAgentes').append(html);
//            }
            $('#myChart').remove();
            $('#grafico').append('<canvas id="myChart" width="150px" height="150px"></canvas>');
            new Chart(document.getElementById("myChart"), {
                type: 'doughnut',
                data: {
                    labels: ["Atendendo", "Livre", "Pausa", "Tabulando"],
                    datasets: [
                        {
                            label: "Population (millions)",
                            backgroundColor: ["#8e5ea2", "#3cba9f", "#e8c3b9", "#c45850"],
                            //"#3e95cd",
                            data: [json.statusOperacao[1],
                                json.statusOperacao[2],
                                json.statusOperacao[3],
                                json.statusOperacao[4]]
                        }
                    ]
                },
                options: {
                    title: {
                        display: true,
                        text: 'Status Operadores (Logados : ' + json.statusOperacao[0] + ')'
                    },
                }
            });
        }
    })
}

function volumeOperadoras() {
    var aOperadoras = [];
    var disparos = [];
    var completamento = [];
    var nao = [];
    aOperadoras[0] = 'x';
    disparos[0] = 'DISPAROS';
    completamento[0] = 'COMPLETAMENTO';
    nao[0] = 'NAO COMPLETAMENTO';
    $('#myChart4').html('');
    var a = 1;
    $.ajax({
        type: 'POST',
        url: BASE_URL + '/operadoras/getVolumeOperadoras',
        dataType: 'json',
        success: function (json) {
            if (json.operadoras1.length > 0) {
                for (var i in json.operadoras1) {
                    aOperadoras[a] = json.operadoras1[i].OPERADORA;
                    disparos[a] = json.operadoras1[i].DISPAROS;
                    completamento[a] = json.operadoras1[i].COMPLETAMENTO;
                    nao[a] = json.operadoras1[i].NAO;
                    a = a + 1;
                }
                c3.generate({
                    bindto: '#myChart4',

                    data: {
                        x: 'x',
                        type: 'bar',
                        labels: true,
                        columns: [
                            aOperadoras,
                            disparos,
                            completamento,
                            nao,
                        ],
                        colors: {
                            'DISPAROS': '#4682B4',
                            'COMPLETAMENTO': '#CD5C5C',
                            'NAO COMPLETAMENTO': '#9ACD32',

                        },
                        groups: [
                            ['DISPAROS', 'COMPLETAMENTO', 'NAO COMPLETAMENTO']
                        ]
                    },
                    axis: {
                        y: {
                            show: false
                        },
                        x: {
                            type: 'category',

                        }
                    }
                });
            }
        }
    })
}

function dataDoDia() {
    // Obtém a data/hora atual
    var data = new Date();

    // Guarda cada pedaço em uma variável
    var dia = data.getDate();           // 1-31
    var dia_sem = data.getDay();            // 0-6 (zero=domingo)
    var mes = data.getMonth();          // 0-11 (zero=janeiro)
    var ano2 = data.getYear();           // 2 dígitos
    var ano4 = data.getFullYear();       // 4 dígitos
    var hora = data.getHours();          // 0-23
    var min = data.getMinutes();        // 0-59
    var seg = data.getSeconds();        // 0-59
    var mseg = data.getMilliseconds();   // 0-999
    var tz = data.getTimezoneOffset(); // em minutos

    // Formata a data e a hora (note o mês + 1)
    var str_data = dia + '/' + (mes + 1) + '/' + ano4;
    var str_hora = hora + ':' + min + ':' + seg;

    // Mostra o resultado
    //alert('Hoje é ' + str_data + ' às ' + str_hora);    
    //$('#data_inicio').val(str_data);

}

function showDivDetalhar() {
    $('body').css('overflow-y', 'hidden');
    $('.black_overlay').css('display', 'block');
    $('.divDetalhar').css('display', 'block');
    $('.divDetalhar').css('overflow-y', 'auto');
    $('.divDetalhar').animate({left: '50%'});

}

function exitDivDetalhar() {
//    $('#idDetalhar').html("");
    $('.divDetalhar').animate({left: '100%'});
    document.getElementById('fade').style.display = 'none';
    $('body').css('overflow-y', 'auto');


}

$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
});

function agentesGrupo(id) {
    showDivDetalhar();
    $.ajax({
        type: 'POST',
        url: BASE_URL + '/group/agentesGrupo/' + id,
//        data: {id: id},
        dataType: 'text',
        success: function (response) {
            $('#pop').html('');
            $('#idDetalhar').html(response).show();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $('#resultFind').html(xhr.status + xhr.responseText);
            $('#msgRec').html('<h3>Nenhum registro encontrado...</h3>');
        }
    });

    //document.getElementById('fade').style.display='block';
    //document.getElementById('pop').style.display='block';
}

function saveAgentesGrupo(e) {
    var param = $('#fAgentesGrupo').serialize();
    $.ajax({
        type: 'POST',
        url: BASE_URL + '/group/saveAgentesGrupo',
        data: param,
        dataType: 'text',
        success: function (response) {
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert('Erro ao associar grupos');
        }
    });
    // document.getElementById('pop').style.display='none';
    // document.getElementById('fade').style.display='none';
    // document.getElementById('idDetalhar').style.display='none';
    exitDivDetalhar();
}

function addTabulacao(e) {
    var param = $('#addTab').serialize();
    $.ajax({
        type: 'POST',
        url: BASE_URL + '/tabulacao/addTabulacao',
        data: param,
        dataType: 'text',
        success: function (response) {
            $('#divtabulacao').html();
            $('#divtabulacao').html(response).show();
            // location.reload();
            
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert('Erro ao associar grupos');
        }
    });
    // document.getElementById('pop').style.display='none';
    // document.getElementById('fade').style.display='none';
    // document.getElementById('idDetalhar').style.display='none';
    exitDivDetalhar();
}

function delTab(id) {
    $.ajax({
        type: 'POST',
        url: BASE_URL + '/tabulacao/delTabulacao',
        data: {id: id},
        dataType: 'text',
        success: function (response) {
            $('#tr' + id).remove();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert('Erro ao associar grupos');
        }
    });
    // document.getElementById('pop').style.display='none';
    // document.getElementById('fade').style.display='none';
    // document.getElementById('idDetalhar').style.display='none';
    exitDivDetalhar();
}

function userCarteiras(id) {
    if (id == 0) {
        id = $('#idagentesup').val();
    }
    showDivDetalhar();
    $.ajax({
        type: 'POST',
        url: BASE_URL + '/users/userCarteiras/' + id,
        dataType: 'text',
        success: function (response) {
            $('#pop').html('');
            $('#idDetalhar').html(response).show();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $('#resultFind').html(xhr.status + xhr.responseText)
            $('#msgRec').html('<h3>Nenhum registro encontrado...</h3>');
        }
    });

    //document.getElementById('fade').style.display='block';
    //document.getElementById('pop').style.display='block';
}

function saveUserCarteiras(e) {
    var param = $('#fUserCarteiras').serialize();
    $.ajax({
        type: 'POST',
        url: BASE_URL + '/users/saveUserCarteiras',
        data: param,
        dataType: 'text',
        success: function (response) {
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert('Erro ao associar grupos');
        }
    });
    // document.getElementById('pop').style.display='none';
    // document.getElementById('fade').style.display='none';
    // document.getElementById('idDetalhar').style.display='none';
    exitDivDetalhar();
}
