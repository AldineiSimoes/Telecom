var idagenteSel = 0;
var grupoSel = 0;
var idcampSel = 0;
var timeMonitora;

$(function () {
    // jQuery.fn.toggleText = function (a, b) {
    //     return   this.html(this.html().replace(new RegExp("(" + a + "|" + b + ")"), function (x) {
    //         return(x == a) ? b : a;
    //     }));
    // }
//    $(document).ready(function () {
//        $('.tgl').before('<span>+</span>');
        // $('.tgl').css('display', 'none')
        // $('span', '#box-toggle').click(function () {
        //     $(this).next().slideToggle('slow')
        //             .siblings('.tgl:visible').slideToggle('fast');

        //     $(this).toggleText('+', '-')
        //             .siblings('span').next('.tgl:visible').prev()
        //             .toggleText('+', '-')
        // });
//    })

    $('#supcamp').bind('change', function () {
        idcampSel = $('#supcamp').val();
        listaCampnhas($('#supcamp').val());
        getMonitoraCampnhas($('#supcamp').val());
        clearInterval(timeMonitora);
        timeMonitora = setInterval(function () {getMonitoraCampnhas($('#supcamp').val())},30000);
        clearInterval(timersup);
        timersup = setInterval(function () {atualizaGruposCampanha($('#supcamp').val())},1000);
    })

    $('#escuta1').on('click', function () {
        monitoraRamalAgente(idagenteSel,grupoSel);
    })

});

function listaCampnhas(idcamp) {
    c = idcamp;
    $('.trdetailresultfind').remove();
    $('#listaCGA').html('<h3> <img class="loadingGIF" src="assets/images/loading.gif"></h3>');
    $('#listaCGA').html('');
    $.ajax({
        type: 'POST',
        url: BASE_URL + '/supervisor/selGruposCampanha/'+idcamp,
        data: {ativo: idcamp},
        dataType: 'text',
        success: function (response) {
            $('#listaCGA').html(response).show();
            esconder();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $('#resultFind').html(xhr.status + xhr.responseText)
            $('#msgRec').html('<h3>Nenhum registro encontrado...</h3>');
        }
    });
}

function atualizaGruposCampanha(idcamp) {
    c = idcamp;
    $.ajax({
        type: 'POST',
        url: BASE_URL + '/supervisor/atualizaGruposCampanha/'+idcamp,
        data: {ativo: idcamp},
        dataType: 'json',
        success: function (json) {
            var html = '';
            var idgr = 0;
            var operadores = 0
            var at = 0
            var livre = 0
            var pausa = 0
            var fila = 0;
            var descricao =''
            if (json.grupos.length > 0) {
                for (var i in json.grupos) {
                    if (idgr != json.grupos[i].id_grupo){
                        $('#'+idgr).html(descricao +'   '+
                        '<div class="resumoGrupo" style="margin-top:5px;padding-top:5px;">'+
                        '<div title="Logados" class="col-md-2 txtResumoGrupo"><img class="imgResumoGrupo" src="'+BASE_URL+'/assets/images/logado.png"> '+operadores+'</div>'+
                '<div title="Livres" class="col-md-2 txtResumoGrupo"><img class="imgResumoGrupo" src="'+BASE_URL+'/assets/images/free.png"> '+livre+'</div>'+
                '<div title="Em Atendimento" class="col-md-2 txtResumoGrupo"><img class="imgResumoGrupo" src="'+BASE_URL+'/assets/images/call.png"> '+at+'</div>'+
                '<div title="Pausados" class="col-md-2 txtResumoGrupo"><img class="imgResumoGrupo" src="'+BASE_URL+'/assets/images/pauseop.png">  '+pausa+'</div>'+
                '<div title="Fila" class="col-md-2 txtResumoGrupo"><img class="imgResumoGrupo" src="'+BASE_URL+'/assets/images/waiting-room.png" style="width: 32px; height: 32px;">  '+fila+'</div>');
   
                        operadores = 0;
                        at = 0;
                        livre = 0;
                        pausa = 0;
                        fila = 0;
                        idgr = json.grupos[i].id_grupo;
                        descricao = json.grupos[i].descricao;
                    }
                    classe = 'black';
                    ddd = json.grupos[i].telefone;
                    ddd = ddd.toString();
                    ddd = ddd.substring(0, 2);
                    telefone = json.grupos[i].telefone;
                    telefone = telefone.toString();
                    telefone = telefone.substring(2, 12);
                    if (json.grupos[i].id_estado == 1) {
                        livre++;
                        classe = 'corlivre';
                    }
                    if (json.grupos[i].id_estado == 6) {
                        classe = 'cortabulando';
                    }
                    if (json.grupos[i].id_estado == 7) {
                        classe = 'coratendendo';
                        at++;
                    }
                    if (json.grupos[i].id_estado == 9) {
                        classe = 'corpausado';
                        pausa++;

                    }
                    operadores++;
                html = '<td >'+json.grupos[i].nome+'</td>'+
                           '<td class="'+classe+'">'+json.grupos[i].estado+ '</td>'+
                    '<td >'+json.grupos[i].tempoAgente+'</td>'+
                    '<td >'+json.grupos[i].direcao+ '</td>'+
                    '<td >(' +ddd+') ' +telefone+'</td>'+
                    '<td >'+json.grupos[i].operadora+ '</td>';

                    $('#'+json.grupos[i].id_grupo+json.grupos[i].codigo).html(html);
                }
                $('#'+idgr).html(descricao +'   '+
                '<div class="resumoGrupo" style="margin-top:5px;padding-top:5px;">'+
                '<div title="Logados" class="col-md-2 txtResumoGrupo"><img class="imgResumoGrupo" src="'+BASE_URL+'/assets/images/logado.png"> '+operadores+'</div>'+
                '<div title="Livres" class="col-md-2 txtResumoGrupo"><img class="imgResumoGrupo" src="'+BASE_URL+'/assets/images/free.png"> '+livre+'</div>'+
                '<div title="Em Atendimento" class="col-md-2 txtResumoGrupo"><img class="imgResumoGrupo" src="'+BASE_URL+'/assets/images/call.png"> '+at+'</div>'+
                '<div title="Pausados" class="col-md-2 txtResumoGrupo"><img class="imgResumoGrupo" src="'+BASE_URL+'/assets/images/pauseop.png">  '+pausa+'</div>'+
                '<div title="Fila" class="col-md-2 txtResumoGrupo"><img class="imgResumoGrupo" src="'+BASE_URL+'/assets/images/waiting-room.png" style="width: 32px; height: 32px;">  '+fila+'</div>');
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $('#resultFind').html(xhr.status + xhr.responseText)
            $('#msgRec').html('<h3>Nenhum registro encontrado...</h3>');
        }
    });
}

function esconder() {
    //$('#box-toggle').css('overflow-y', 'scroll')
    
    $('.tgl').css('display', 'none')
    $('span', '#box-toggle').click(function () {
         $(this).next().slideToggle('slow')
                .siblings('.tgl:visible').slideToggle('fast');
        // $(this).toggleText('+', '-')
        //         .siblings('span').next('.tgl:visible').prev()
        //         .toggleText('+', '-')
    });
}

function optionsAgentes(i,grupo){
    idagenteSel = 0;
    grupoSel = grupo;
    clearInterval(timeMonitora);
    getMonitoraCampnhas();
    agenteSelecionado = '';
    if (document.getElementById("optionAgente").style.display == "block") {
        document.getElementById("optionAgente").style.display = "none";
    } else {
        document.getElementById("optionAgente").style.display = "block";
        idagenteSel = $('#A'+i).attr('class');
        $.ajax({
            type: 'POST',
            url: BASE_URL + '/agentes/getAgenteRamal/'+idagenteSel,
            dataType: 'json',
            success: function (json) {
                agenteSelecionado = json.agente.ramal+' - '+json.agente.nome;
                $('#agenteSel').html('Selecionado : '+json.agente.nome+' ('+json.agente.ramal+')');
                $('#agenteRamal').val(json.agente.ramal);
            }
        })
        getMonitoraCampnhas();
        timeMonitora = setInterval(function () {getMonitoraCampnhas()},30000);
    }
 
}

function monitoraRamalAgente(codagente, idgrupo) {
    $.ajax({
        type: 'POST',
        url: BASE_URL + '/ajax/monitorarRamal',
        data: {id_empresa: "1", monitorado: codagente, idgrupodac: idgrupo, tpmon: "1"}
    })
}


function getMonitoraCampnhas() {
    c = idcampSel;
    //alert(idcampSel+' '+grupoSel+' '+idagenteSel)
    $('#detalhesCampanha').remove('');
    $.ajax({
        type: 'POST',
        url: BASE_URL + '/supervisor/getMonitoraCampanha/'+idcampSel+'/'+grupoSel+'/'+idagenteSel,
        data: {ativo: idcampSel},
        dataType: 'text',
        success: function (response) {
            $('#detalhesCharts').html(response).show();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $('#detalhesCharts').html(xhr.status + xhr.responseText)
        }
    });
}
