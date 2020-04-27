$(function () {
    $('#campgrupo').on('change', function () {
        idcamp = $('#campgrupo').val();
        $('.gr').remove();
        $.ajax({
            type: 'POST',
            url: BASE_URL + '/group/selGrupos/' + idcamp,
            dataType: 'json',
            success: function (json) {
                if (json.group.length > 0) {
                    var html = '<option class="gr" id="opgrupo" value="0">Todos</option>';
                    $('#grupo').append(html);
                    for (var i in json.group) {
                        var html = '<option class="gr" id="opgrupo" value="' + json.group[i].id_grupo + '">' +
                                json.group[i].descricao +
                                '</option>';
                        $('#grupo').append(html);
                    }
                }
            }
        });
    });

    $('#formDiscador').on('submit', function (e) {
        e.preventDefault();
        var param = $('#formDiscador').serialize();
        $.ajax({
            type: 'POST',
            url: BASE_URL + '/discador/saveDiscador/' + idoper,
            data: param,
            dataType: 'text',
            success: function () {
                $('#campgrupo').change();
            }
        })
        $('.gr').remove();
        $('#nome').val('');
        $('#campgrupo').val('');
        $('#grupo').val('');
        idoper = 0;
    })

    $('#fPeriodoAdd').on('submit', function (e) {
        e.preventDefault();
        var param = $('#fPeriodoAdd').serialize();
        $.ajax({
            type: 'POST',
            url: BASE_URL + '/discador/periodoDiscAdd',
            data: param,
            dataType: 'text',
            success: function () {
                $('#descPeriodo').val('');
                $('#inicioPeriodo').val('');
                $('#fimPeriodo').val('');
                location.reload();
            }
        })
    })


    $('#selParam').on('change', function () {
        var id = $('#selParam').val();
        $.ajax({
            type: 'POST',
            url: BASE_URL + '/discador/param_sel/' + id,
            dataType: 'text',
            success: function (response) {
                $('#paramList').html(response).show();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $('#paramList').html(xhr.status + xhr.responseText)
            }
        });
    });

    $('#selPeriodo').on('change', function () {
        var id = $('#selPeriodo').val();
        $.ajax({
            type: 'POST',
            url: BASE_URL + '/discador/periodo_sel/' + id,
            dataType: 'text',
            success: function (response) {
                $('#periodoList').html(response).show();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $('#periodoList').html(xhr.status + xhr.responseText)
            }
        });
    });



    $('#selUpload').on('change', function () {
        var id = $('#selUpload').val();
        $('#voltardiscador').removeAttr("disabled")
        //alert(id);
        if (id == '0') {
            $('#arquivo').attr("disabled", "true");
        } else {
            $('#arquivo').removeAttr("disabled");
        }
        $('#layout').val(id);
        $('#resumoLista').html('');
        $.ajax({
            type: 'POST',
            url: BASE_URL + '/discador/mailing_sel/' + id,
            dataType: 'text',
            success: function (response) {
                $('#divfila').html(response).show();
                $('#statusDisc').html(response).show();
                // $('#resDisc').remove();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $('#divfila').html(xhr.status + xhr.responseText)
            }
        });
        $.ajax({
            type: 'POST',
            url: BASE_URL + '/discador/resumoMailingDiscador/' + id + '/0',
            dataType: 'text',
            success: function (response) {
                $('#resumoDiscador').html(response).show();
                $("#reslista").html('Resultado do discador');
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $('#resumoDiscador').html(xhr.status + xhr.responseText)
            }
        });
        $.ajax({
            type: 'POST',
            url: BASE_URL + '/discador/resumoMailing/' + id + '/0',
            dataType: 'text',
            success: function (response) {
                $('#resumoLista').html(response).show();
                $("#reslista").html('Resultado do discador');
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $('#reslista').html('Nenhum registro encontrado '+xhr.status + xhr.responseText)
            }
        });
    });

    $('#groupprioridade').on('change', function () {
        var id = $('#groupprioridade').val();
        $('#areaprioridade').html('');
        $.ajax({
            type: 'POST',
            url: BASE_URL + '/discador/prioridadeList/' + id,
            dataType: 'text',
            success: function (response) {
                $('#areaprioridade').html(response).show();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $('#divfila').html(xhr.status + xhr.responseText)
            }
        });
    });


   $('#formFila').on('submit', function (e) {
       var id = $('#selUpload').val();
       var arq = $('#arquivo').val();
       $('#resumoDiscador').html('<br><br><h1>Importando </h1><img id="loadingGIF" class="loadingGIF" src="<?php echo BASE_URL ?>/assets/images/loading.gif" style="display:none;"/> <br/>')
   });

})

function delPeriodoDiscador(id) {
    $.ajax({
       type: 'POST',
       url: BASE_URL + '/discador/delPeriodoDisc/'+id,
       success: function(response){
           $("#tr"+id).remove();
       },
       error: function (xhr, ajaxOptions, thrownError) {
            alert('Erro ao apagar o periodo desse discador')
       }
    });
}

function savePeriodoDiscadorSel(e) {

    var param = $('#fPeriodoSel').serialize();
    $.ajax({
        type: 'POST',
        url: BASE_URL + '/discador/savePeriodoDiscador',
        data: param,
        dataType: 'text',
        success: function (response) {
            
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert('Erro ao associar período')
        }
    });
    // document.getElementById('pop').style.display='none';
    // document.getElementById('fade').style.display='none';
    // document.getElementById('idDetalhar').style.display='none';
    exitDivDetalhar();
}

function delPeriodo(id) {
    $.ajax({
        type: 'POST',
        url: BASE_URL + '/discador/periodoDiscDel/' + id,
        data: {id: id},
        success: function () {
            $("#p" + id).remove();
        }
    });
}

function selDiscador(id) {
    idoper = id;
    $.ajax({
        type: 'POST',
        url: BASE_URL + '/discador/getDiscador/' + id,
        data: {id: id},
        dataType: 'json',
        success: function (json) {
            $('#nome').val(json.discador.CONF_DESC);
            $('#campgrupo').val(json.discador.ID_CAMPANHA);
            $('#tpDisc').val(json.discador.ID_TIPODISCADOR);
            $('#servidor').val(json.discador.ID_SERVIDOR);
            $('#campgrupo').change();
            setTimeout(function () {
                $('#grupo').val(json.discador.ID_GRUPO);
            }, 1000);
        }
    })
}

function saveParamDisc(e) {
    var param = $('#fParamSel').serialize();
    $.ajax({
        type: 'POST',
        url: BASE_URL + '/discador/saveParametros',
        data: param,
        dataType: 'text',
        success: function () {
            alert('registro salvo com sucesso')
            window.location.href = BASE_URL + '/discador/parametrosDisacador';
        }
    })
    return false;
}
;

function setMailing(id, sit) {
    $.ajax({
        type: 'POST',
        url: BASE_URL + '/discador/setMailing/' + sit,
        data: {id: id},
        dataType: 'text',
        success: function () {
            $('#selUpload').change();
        }
    });
}

function delMailing(id,grupo) {
    if (!confirm('Excluir mailing ?')) {
        return false;
    } else {
        $.ajax({
            type: 'POST',
            url: BASE_URL + '/discador/delMailing/'+ id +'/'+grupo,
            data: {id: id, grupo: grupo},
            dataType: 'text',
            success: function () {
                $('#selUpload').change();
            }
        })
    }
}

function resumoMailing(discador, id) {
    //alert(discador+' '+id);
    $('#reslista').html('');
    $("#reslista").html('Resultado da lista');
    $.ajax({
        type: 'POST',
        url: BASE_URL + '/discador/resumoMailing/' + discador + '/' + id,
        dataType: 'text',
        success: function (response) {
            $('#resumoLista').html(response).show();
            $("#reslista").html('Resultado da lista');
    },
        error: function (xhr, ajaxOptions, thrownError) {
            $('#reslista').append(xhr.status + xhr.responseText)
        }
    });
}

function voltaDiscarSTFIM(codfim, id_arquivo, discador) {
    //alert(codfim+' '+id_arquivo+' '+discador);
    if (discador == 0) {
        discador = $('#layout').val();
    }
    $.ajax({
        type: 'POST',
        url: BASE_URL + '/discador/voltaDiscarStfim/' + codfim + '/' + id_arquivo + '/' + discador,
        dataType: 'text',
        success: function (response) {
            //resumoMailing(id_arquivo);
            //setTimeout(() => {
            //    $('#selUpload').change();                
            //}, 5000);
            if (codfim == 0) {
                $('#selUpload').change();
            }
            $('#' + codfim).remove();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $('#resumoDiscador').html(xhr.status + xhr.responseText)
        }
    });
    document.getElementById('infoDetalhar').style.display = 'none';
    document.getElementById('loadingGIF').style.display = 'block';
    setTimeout(function () {
        document.getElementById('loadingGIF').style.display = 'none';
        exitDivDetalhar();
        document.getElementById('infoDetalhar').style.display = 'block';
        $('#selUpload').change();
    }, 10000);

}


function periodosDiscador(id, grupo, campanha) {
    // if (id=0) (
    //     id = idagenteSel
    //)
    //window.grupoPeriodo = grupo;
    //window.campanhaPeriodo = campanha;
    showDivDetalhar();
    $.ajax({
        type: 'POST',
        url: BASE_URL + '/discador/periodo_sel/' + id,
//        data: {id: id},
        dataType: 'text',
        success: function (response) {
            $('#pop').html('');
            $('#idDetalhar').html(response).show();
            periodoDiscadorSetValue(grupo, campanha);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $('#resultFind').html(xhr.status + xhr.responseText)
            $('#msgRec').html('<h3>Nenhum registro encontrado...</h3>');
        }
    });

    //document.getElementById('fade').style.display='block';
    //document.getElementById('pop').style.display='block';
}

function periodoDiscadorSetValue(grupo, campanha) {
    setTimeout(function () {
                document.getElementById("grupoP").value = grupo;
                document.getElementById("campanha").value = campanha;
            }, 2000);
}

function setPrioridade(id,ativo) {
    var gr = $('#groupprioridade').val();
    $('#areaprioridade').html('');
    $.ajax({
        type: 'POST',
        url: BASE_URL + '/discador/setPrioridade/' + id+'/' + gr+'/' + ativo,
        dataType: 'text',
        success: function (response) {
            $('#areaprioridade').html(response).show();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $('#divfila').html(xhr.status + xhr.responseText)
        }
    });
}

function cadastroPrioridade($id) {
    $('#comtempriodidade').html('');
    var gr = $('#groupprioridade').val();
    $.ajax({
        type: 'POST',
        url: BASE_URL + '/discador/cadastroPrioridade',
        dataType: 'text',
        success: function (response) {
            $('#comtempriodidade').html(response).show();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $('#comtempriodidade').html(xhr.status + xhr.responseText)
        }
    });
}