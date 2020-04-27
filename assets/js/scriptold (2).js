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
    getStatusGeralOperadores();
    setInterval(function() {
        usoOperadoras();
        getStatusGeralOperadores();
    },30000
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
    $('#deslogar').bind('click', function () {
        $.ajax({
            type: 'POST',
            url: BASE_URL + '/ajax/deslogarRamal',
            data: {agente: codagente}
        })
    })
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
                                '<a href="#"><td><a href="#" onclick="selOperadora(' + json.listOperadoras[i].ID_OPERADORA +
                                ')">' + json.listOperadoras[i].OPE_DESC + '</a></td>' +
                                '<td>' + json.listOperadoras[i].OPE_CSP + '</td>' +
                                '<td>' + json.listOperadoras[i].OPE_TECHPREFIX + '</td>' +
                                '<td>' + json.listOperadoras[i].OPE_IP1 + '</td>' +
                                '<td>' + json.listOperadoras[i].OPE_MAXCANAIS + '</td>' +
                                '</tr>';
                        $('#tboperadoras').append(html);

                    }
                }
            }
        })
    })

    $('#supcamp').bind('change', function () {
        $('.gr').remove();
        ativo = $('#supcamp').val();
        $.ajax({
            type: 'POST',
            url: BASE_URL + '/group/selGrupos/'+ativo,
            data: {ativo: ativo},
            dataType: 'json',
            success: function (json) {
                if (json.group.length > 0) {
                    for (var i in json.group) {
                        html = '<option class="gr" id="opgr" value="'+json.group[i].id_grupo+'" >'+
                                json.group[i].id_grupo+' - '+json.group[i].descricao+
                                '</option>';
                        $('#group').append(html);

                    }
                }
                $('#group').change();
            }
        })
    })
    
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
                                '<a href="#"><td class="tdage"><a href="#" onclick="selAgente(' + json.listAgents[i].id +
                                ')">' + json.listAgents[i].nome + '</a></td>' +
                                '<td class="tdage">' + json.listAgents[i].username + '</td>' +
                                '<td class="tdexcluir"><a href=#><img src=' + BASE_URL + '/assets/images/delete.png class="delete"></a></td>' +
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
                                '<td><a href="#" onclick="selCampanha(' + json.campanhas[i].ID_CAMPANHA + ')">' +
                                json.campanhas[i].CAMP_DESC +
                                '</td>' +
                                '<td>' + dti + '</td>' +
                                '<td>' + dtf + '</td>' +
                                '<td class="tdtrash"><a href="' + BASE_URL + '/campanhas/delete/' + json.campanhas[i].ID_CAMPANHA + '" onclick="return confirm(' + 'Excluir campanha ?)">' +
                                '<img class="imgtrash" src="' + BASE_URL + '/assets/images/trash.png"  ></a></td></tr>';
                        $('#tbcampanha').append(html);
                    }
                }
            }
        })
    })

    $('#formCampanha').bind('submit', function (e) {
        e.preventDefault();
        var param = $('#formCampanha').serialize();
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
                                '<td><a href="#" onclick="editGroup(' + json.group[i].id_grupo + ')">' +
                                json.group[i].descricao +
                                '</td>' +
                                '<td class="tdtrash"><a href="' + BASE_URL + '/campanhas/delete/' + json.group[i].id_grupo + '" onclick="return confirm(' + 'Excluir campanha ?)">' +
                                '<img class="imgtrash" src="' + BASE_URL + '/assets/images/trash.png"  ></a></td></tr>';

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
        atualizaMonitor($('#supcamp').val(),$('#group').val());
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

    $('#formDesempenhoAgentes').on('submit', function (e) {
        e.preventDefault();
        var param = $('#formDesempenhoAgentes').serialize();
        $('#idResumo').remove();
        $.ajax({
            type: 'POST',
            url: 'relDesempenhoAgentes/desempenhoAgentes',
            dataType: 'text',
            data: param,
            success: function (response) {
                $('#relResumo').html(response).show();
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
    
});

function listRecording(param) {
//    $('#msgRec').html('Procurando...');
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
        }
    });
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
        error : function (xhr, ajaxOptions, thrownError) {
            $('#msgRec').html(xhr.status + ' '+xhr.responseText+' '+thrownError)
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

function getMonitor(camp,group) {
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
            data: {a: a,c: c},
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
                        if (gr1 != json.users[i].id_grupo && group==0) {
                            '<div class="pmonitorgr >' 
                                 $('#groupsel').append('<div class="phpmonitor" > Grupo : '+
                                                        json.users[i].id_grupo+
                                                        '</div>');
                            gr1 = json.users[i].id_grupo;
                        }
                        $('#groupsel').append(
                                '<div class="phpmonitor ' + classe + '" >' +
                                //'<a href="#"><img class="imgescuta"  src='+BASE_URL+'/assets/images/despausar.png width="20" '+
                                //'id="despausa'+json.users[i].nome+'" onclick="despausar('+json.users[i].nome+')"></a><br>'+
                                //'<a href="#"><img class="imgescuta"  src='+BASE_URL+'/assets/images/deslogar.png width="20" '+
                                //'id="desloga'+json.users[i].nome+'" onclick="deslogar('+json.users[i].nome+')"></a>'+
                                '<div class="clsimgescuta">' + '<a href="#"><img class="imgescuta"  src=' + BASE_URL + '/assets/images/escuta.png width="20" ' +
                                ' id="monitorar' + json.users[i].codigo +'" onclick="monitorar(' + json.users[i].codigo + ',' + a + ',' + item + ')"></a>' + '</div>' +
                                '<div class="clstempo ' + classe + '">' + json.users[i].tempo + '</div>' +
                                '<div class="clsteleoperadora ' + classe + '">' + '  (' + ddd + ') ' + telefone + '  ' + json.users[i].operadora + '</div>' +
                                '<div class="clsestadoagente ' + classe + '">' + json.users[i].estado + '</div>' +
                                '<div class="clsimgstadoagente">' + img + '</div>' +
                                '<div class="clsnomeagente">' + json.users[i].nome + '</div>' +
                                '</div>'
                                );
                    }
                    $('#detres').append(//'<td class="detit logados" >'+logados+'</td>'+
                            '<td class="detit atendendo" >' + at + '</td>' +
                            '<td class="detit livres" >' + livre + '</td>' +
                            '<td class="detit tabulando" >' + tabulando + '</td>' +
                            '<td class="detit pausados" >' + pausado + '</td>'//+
                            //'<td class="detit filas" >'+fila+'</td>'

                            );
                    $('#detres2').append('<td class="detit logados" >' + logados + '</td>');
                    $('#detres3').append('<td class="detit filas" >' + fila + '</td>');
//				datasup = [at,livre,tabulando,pausado];
//				if ((at != atsup) || (livre != livresup)){
//					atsup = at;
//					livresup = livre;
//					graficoSup();
//				}
//  	       	setTimeout(getMonitor(q),10000);
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

function atualizaMonitor(camp,group) {
    idgrupo = group;
    clearInterval(timersup);
    clearInterval(timergrafico);
    getMonitor(camp,group);
    getDial($('#group').val());
}

function monitorar(agente, idgrupo, item) {
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


function monitoraRamal(agente, idgrupo) {
    local = document.URL;
    ws = new WebSocket('ws://' + SOCKET_SERVER + ':' + SOCKET_PORT);
    ws.onopen = function (e) {};
    ws.onerror = function (e) {
        alert('Erro de conexão : ' + e + ' em ' + SOCKET_SERVER + ':' + SOCKET_PORT)
    };
    ws.send("monitorar(1;1;1;" + agente + ";" + local + ";1;)\n")
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
;

function selAgente(id) {
    idoper = id;
    $.ajax({
        type: 'POST',
        url: BASE_URL + '/agentes/getAgente/' + id,
        data: {id: id},
        dataType: 'json',
        success: function (json) {
            $('#nome').val(json.agente.nome);
            $('#ramal').val(json.agente.ramal);
            $('#login').val(json.agente.username);
            $('#senha').val(json.agente.password);
            $('#localAgente').val(json.agente.ID_LOCALAGENTE);
            $('#tipoRamal').val(json.agente.ID_TIPORAMAL);
            $('#ativo').val(json.agente.ativo);
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

function usoOperadoras(){
    var dt = new Date();
    var a = dt.getHours()+':'+dt.getMinutes();
    $.ajax({
        type: 'POST',
        url: BASE_URL + '/operadoras/getUsoOperadoras',
        dataType: 'json',
        success: function(json) {
            if (json.operadoras.length > 0) {
                $('.detusoOperadora').remove();
                for (var i in json.operadoras) {
                    html = '<tr class="detusoOperadora">'+
                        '<td>'+json.operadoras[i].operadora+'</td>'+
                        '<td>'+json.operadoras[i].ocupacao+'</td>'+
                        '<td>'+json.operadoras[i].livres+'</td>'+
                        '<td>'+json.operadoras[i].qtdcanais+'</td>'+
                    '</tr>';
                    $('#tbusoOperadora').append(html);
                }
            }
        }
    })
}

function getStatusGeralOperadores(){
    var dt = new Date();
    var a = dt.getHours()+':'+dt.getMinutes();
    $.ajax({
        type: 'POST',
        url: BASE_URL + '/agentes/getStatusGeral',
        dataType: 'json',
        success: function(json) {
            $('.detStatusGeralAgentes').remove();
//            for (var i in json.statusOperacao) {
                html = '<tr class="detStatusGeralAgentes">'+
                    '<td>'+json.statusOperacao[0]+'</td>'+
                    '<td>'+json.statusOperacao[1]+'</td>'+
                    '<td>'+json.statusOperacao[2]+'</td>'+
                    '<td>'+json.statusOperacao[3]+'</td>'+
                '</tr>';
                $('#tbStatusGeralAgentes').append(html);
//            }
        }
    })
}

function dataDoDia() {
    // Obtém a data/hora atual
    var data = new Date();

    // Guarda cada pedaço em uma variável
    var dia     = data.getDate();           // 1-31
    var dia_sem = data.getDay();            // 0-6 (zero=domingo)
    var mes     = data.getMonth();          // 0-11 (zero=janeiro)
    var ano2    = data.getYear();           // 2 dígitos
    var ano4    = data.getFullYear();       // 4 dígitos
    var hora    = data.getHours();          // 0-23
    var min     = data.getMinutes();        // 0-59
    var seg     = data.getSeconds();        // 0-59
    var mseg    = data.getMilliseconds();   // 0-999
    var tz      = data.getTimezoneOffset(); // em minutos

    // Formata a data e a hora (note o mês + 1)
    var str_data = dia + '/' + (mes+1) + '/' + ano4;
    var str_hora = hora + ':' + min + ':' + seg;

    // Mostra o resultado
    //alert('Hoje é ' + str_data + ' às ' + str_hora);    
    $('#data_inicio').val(str_data);
    
}
