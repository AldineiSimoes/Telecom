var idagenteSel = 0;
var grupoSel = 0;
var idcampSel = 0;
var timeMonitora;
var timesupervisor;
var tempogeral;

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

    $('#monitoraAtivos').on('click', function () {
        alert('ok');
    })
    
    $('#despausar').on('click', function(){
        despausarAgente(idagenteSel);
    })
    $('#tempo').on('change', function(){
        alert($('#idgrupo').val());
        alert($('#tempo').val());
        clearInterval(timesupervisor);
        grupoDetalhesCorpo(id);
        timesupervisor = setInterval(function(){grupoDetalhesCorpo(id)},30000);
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
            var btninfo = '';
            if (json.grupos.length > 0) {
                for (var i in json.grupos) {
                    if (idgr != json.grupos[i].id_grupo){
                        $('#'+idgr).html(descricao +'   '+
                        btninfo+
                        '<div class="resumoGrupo" style="margin-top:5px;padding-top:5px;">'+
                        '<div title="Logados" class="col-md-1 txtResumoGrupo"><img class="imgResumoGrupo" src="'+BASE_URL+'/assets/images/logado.png"> '+operadores+'</div>'+
                        '<div title="Livres" class="col-md-1 txtResumoGrupo"><img class="imgResumoGrupo" src="'+BASE_URL+'/assets/images/free.png"> '+livre+'</div>'+
                        '<div title="Em Atendimento" class="col-md-1 txtResumoGrupo"><img class="imgResumoGrupo" src="'+BASE_URL+'/assets/images/call.png"> '+at+'</div>'+
                        '<div title="Pausados" class="col-md-1 txtResumoGrupo"><img class="imgResumoGrupo" src="'+BASE_URL+'/assets/images/pauseop.png">  '+pausa+'</div>'+
                        '<div title="Fila" class="col-md-1 txtResumoGrupo"><img class="imgResumoGrupo" src="'+BASE_URL+'/assets/images/waiting-room.png" style="width: 32px; height: 32px;">  '+fila+'</div>'+
                        '<div class="col-md-1 tResumoGrupo"style="font: 12px;"> Tempo Livre </div>'+
                        '<div class="col-md-1 tResumoGrupo" id="livre'+idgr+'"> 00:00:00 </div>'+
                        '<div class="col-md-1 tResumoGrupo"> T.Médio clerical </div>'+
                        '<div class="col-md-1 tResumoGrupo" id="clerical'+idgr+'"> 00:00:00 </div>'+
                        '<div class="col-md-1 tResumoGrupo"> T.Médio espera </div>'+
                        '<div class="col-md-1 tResumoGrupo" id="espera'+idgr+'"> 00:00:00 </div>'+
                        '<div class="col-md-1 tResumoGrupo"> T.Médio Atendim. </div>'+
                        '<div class="col-md-1 tResumoGrupo" id="atende'+idgr+'"> 00:00:00 </div>'
                        );
   
                        operadores = 0;
                        at = 0;
                        livre = 0;
                        pausa = 0;
                        fila = 0;
                        idgr = json.grupos[i].id_grupo;
                        descricao = idgr+' - '+json.grupos[i].descricao+
                        '  ==> [ Mailing : '+json.grupos[i].LIVRES+' livres | '+
                        json.grupos[i].AGENDADO+' agendados | '+
                        json.grupos[i].FINALIZADO+' finalizados | '+
                        json.grupos[i].ALO+' ALO | '+
                        json.grupos[i].CPC+' CPC | '+
                        json.grupos[i].SUCESSO+' Sucesso ]';
                        if (json.grupos[i].discou > 0) {
                            btninfo = '<a href="#" onclick="grupoDetalhes('+idgr+')"><img title="Detalhes do grupo"  class="infoGrupo" style="width:30px; padding-right:10px;" src="'+BASE_URL+'/assets/images/info.png" align="right"></img></a>'
                        } else {
                            btninfo = '<a href="#" ><img title="Sem discagem"  class="infoGrupo" style="width:30px; padding-right:10px;" src="'+BASE_URL+'/assets/images/cancel.png" align="right"></img></a>'
                        }
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
                    // alert(json.grupos[i].nome+' '+json.grupos[i].tempoAgente);
                    operadores++;
                    html = '<td >'+json.grupos[i].nome+'</td>'+
                           '<td class="'+classe+'">'+json.grupos[i].estado+ '</td>'+
                    '<td >'+json.grupos[i].tempoAgente+'</td>'+
                    '<td >'+json.grupos[i].direcao+ '</td>'+
                    '<td >(' +ddd+') ' +telefone+'</td>'+
                    '<td >'+json.grupos[i].operadora+ '</td>'+
                     '<td >'+json.grupos[i].origem+ '</td>'+
                    '<td >'+json.grupos[i].direcao+ '</td>';
                    // alert(json.grupos[i].id_grupo+json.grupos[i].codigo);
                    $('#'+json.grupos[i].id_grupo+json.grupos[i].id).html(html);
                }
                $('#'+idgr).html(descricao +'   '+
                btninfo+
                '<div class="resumoGrupo" style="margin-top:5px;padding-top:5px;">'+
                '<div title="Logados" class="col-md-1 txtResumoGrupo"><img class="imgResumoGrupo" src="'+BASE_URL+'/assets/images/logado.png"> '+operadores+'</div>'+
                '<div title="Livres" class="col-md-1 txtResumoGrupo"><img class="imgResumoGrupo" src="'+BASE_URL+'/assets/images/free.png"> '+livre+'</div>'+
                '<div title="Em Atendimento" class="col-md-1 txtResumoGrupo"><img class="imgResumoGrupo" src="'+BASE_URL+'/assets/images/call.png"> '+at+'</div>'+
                '<div title="Pausados" class="col-md-1 txtResumoGrupo"><img class="imgResumoGrupo" src="'+BASE_URL+'/assets/images/pauseop.png">  '+pausa+'</div>'+
                '<div title="Fila" class="col-md-1 txtResumoGrupo"><img class="imgResumoGrupo" src="'+BASE_URL+'/assets/images/waiting-room.png" style="width: 32px; height: 32px;">  '+fila+'</div>'+
                '<div class="col-md-1 tResumoGrupo"style="font: 12px;"> Tempo Livre </div>'+
                '<div class="col-md-1 tResumoGrupo" id="livre'+idgr+'"> 00:00:00 </div>'+
                '<div class="col-md-1 tResumoGrupo"> T.Médio clerical </div>'+
                '<div class="col-md-1 tResumoGrupo" id="clerical'+idgr+'"> 00:00:00 </div>'+
                '<div class="col-md-1 tResumoGrupo"> T.Médio espera </div>'+
                '<div class="col-md-1 tResumoGrupo" id="espera'+idgr+'"> 00:00:00 </div>'+
                '<div class="col-md-1 tResumoGrupo"> T.Médio Atendim. </div>'+
                '<div class="col-md-1 tResumoGrupo" id="atende'+idgr+'"> 00:00:00 </div>'
                );
            }
            if (json.detalhes_grupo.length > 0) {
                for (var i in json.detalhes_grupo) {
                    $('#livre'+json.detalhes_grupo[i].id_grupo).html(json.detalhes_grupo[i].max_livre);
                    $('#clerical'+json.detalhes_grupo[i].id_grupo).html(json.detalhes_grupo[i].TMC_FALANDO);
                    $('#espera'+json.detalhes_grupo[i].id_grupo).html(json.detalhes_grupo[i].TME_ESPERA);
                    $('#atende'+json.detalhes_grupo[i].id_grupo).html(json.detalhes_grupo[i].TMA_ATENDIMENTO);
                }
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
    
    // $('.tgl').css('display', 'none')
    $('span', '#box-toggle').click(function () {
         $(this).next().slideToggle('slow');
                // .siblings('.tgl:visible').slideToggle('fast');
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
                $('#agenteRamal').val();
                $('#idagentesup').val(json.agente.id);
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

function despausarAgente(codagente){
    //alert(codagente);
    $.ajax({
        type: 'POST',
        url: BASE_URL + '/ajax/despausarRamal',
        data: {agente: codagente}
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

function grupoDetalhes(id) {
    showDivDetalhar();
    $('#pop').html('');
    var html = '<div style="margin: 10px;">'+
                    '<p class="de_ate w-50" ><label>Ultimos</label>'+
                    '<input type="hidden" id="idgrupo" value="0"></input>'+
                    '<select id="tempo" name="tempo" style="width: 120px;" onchange="setTempo()" class="form-control">'+
                        '<option value="600" >10 min</option>'+
                        '<option value="1800" >30 min</option>'+
                        '<option value="3600">1 hora </option>'+
                    '</select>'+
                    '</p>'+
                '</div>'+
                '<div id="idDetalhe">'+
                '</div>';

    $('#idDetalhar').html(html);
    $('#idgrupo').val(id);
    clearInterval(timesupervisor);
    grupoDetalhesCorpo(id,600);
    timesupervisor = setInterval(function(){grupoDetalhesCorpo(id,600)},10000);
    //document.getElementById('fade').style.display='block';
    //document.getElementById('pop').style.display='block';
}

function grupoDetalhesCorpo(idgr,tempo) {
    $.ajax({
        type: 'POST',
        url: BASE_URL + '/supervisor/grupoDetalhes/' + idgr+'/'+tempo,
//        data: {id: id},
        dataType: 'text',
        success: function (response) {
            $('#pop').html('');
            $('#idDetalhe').html(response).show();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $('#idDetalhar').html(xhr.status + xhr.responseText)
            $('#idDetalhe').html('<h3>Nenhum registro encontrado...</h3>');
        }
    });

}

function setTempo() {
    tempogeral = $('#tempo').val();
    clearInterval(timesupervisor);
    grupoDetalhesCorpo($('#idgrupo').val(),$('#tempo').val());
    timesupervisor = setInterval(function(){grupoDetalhesCorpo($('#idgrupo').val(),$('#tempo').val())},30000);
}

function monitoraAtivos() {
    monitoramento(1);
    clearInterval(timeMonitora);
    timeMonitora = setInterval(function () {monitoramento(1)},10000);
}

function monitoraReceptivo() {
    monitoramento(2);
    clearInterval(timeMonitora);
    timeMonitora = setInterval(function () {monitoramento(2)},10000);
}

function monitoramento(tipo) {
    var urk = '';
    if (tipo==1) {
        url = BASE_URL + '/monitoramento/ativos';
    } else {
        url = BASE_URL + '/monitoramento/receptivo';
    }
    $.ajax({
        type: 'POST',
        url: url,
        dataType: 'text',
        success: function (response) {
            $('#monitora').html(response).show();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $('#monitora').html(xhr.status + xhr.responseText)
        }
    });
}

function zerarRegistros(id_discador,tipo_registro){
    $.ajax({
        type: 'POST',
        url: BASE_URL + '/monitoramento/zerarRegistros/' + id_discador+'/'+tipo_registro,
        dataType: 'text',
        // data: {id_discador:id_discador,tipo_registro:tipo_registro},
        success: function(response){
            if(response==1){
                alert('Solicitado');
            }
        },
        error:function(xhr, ajaxOptions, thrownError){
            alert(xhr.status+xhr.responseText);
            $('#retorno').html(xhr.status+xhr.responseText)}
        });
}
