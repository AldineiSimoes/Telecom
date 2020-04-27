var data;
$(function(){
    $('#formcustos').on('submit',function(e){
        e.preventDefault();
        data = $('#formcustos').serialize();
        $.ajax({
            type: 'POST',
            url: 'relcustos/relcustosDetalhe',
            dataType: 'text',
            data: data,
            success: function(response){
                $('#resumoCustos').html(response).show();
            },
            error:function(xhr, ajaxOptions, thrownError){
                $('#resumoCustos').html(xhr.status+xhr.responseText)}
        });
    });

    $('#camp').on('change',function(){
        idcamp = $('#camp').val();
        $('.gr').remove();
        var html = '<option class="gr" id="opgrupo" value="0">Todos</option>';
        $('#grupo').append(html);
        $.ajax({
            type: 'POST',
            url: 'relDesempenhoGrupo/selGrupo/'+idcamp,
            dataType:'json',
            success:function(json){
                if(json.group.length > 0) {
                    for(var i in json.group) {
                        var html = '<option class="gr" id="opgrupo" value="'+json.group[i].id_grupo+'">'+
                                            json.group[i].descricao+
                                    '</option>';
                        $('#grupo').append(html);
                    }
                }
            }
        });
    });
    
    $('#formDesempnhoGrupo').on('submit',function(e){
        e.preventDefault();
        data = $('#formDesempnhoGrupo').serialize();
        $.ajax({
            type: 'POST',
            url: 'relDesempenhoGrupo/relDesempenhoGrupo',
            dataType: 'text',
            data: data,
            success: function(response){
                $('#resumoGrupo').html(response).show();
            },
            error:function(xhr, ajaxOptions, thrownError){
                $('#resumoGrupo').html(xhr.status+xhr.responseText)}
        });
    });

    $('#formAgentesLogados').on('submit',function(e){
      e.preventDefault();
      $('#agentesView').html('entrou');
      data = $('#formAgentesLogados').serialize();
      $.ajax({
          type: 'POST',
          url: 'relAgentesLogados/agentesLogados',
          dataType: 'text',
          data: data,
          success: function(response){
              $('#agentesView').html(response).show();
          },
          error:function(xhr, ajaxOptions, thrownError){
              $('#agentesView').html(xhr.status+xhr.responseText)}
      });
    })

    $('#formDesempenhoAgentes').on('submit', function (e) {
        e.preventDefault();
        data = $('#formDesempenhoAgentes').serialize();
        $('#idResumo').remove();
        $('#relResumo').html('Processando').show();
        $.ajax({
            type: 'POST',
            url: 'relDesempenhoAgentes/desempenhoAgentes',
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

    $('#formTabulacao').on('submit',function(e){
        e.preventDefault();
        data = $('#formTabulacao').serialize();
        $('#tabulacaoDetalhe').html('Processando').show();
        $.ajax({
            type: 'POST',
            url: 'relTabulacoes/getDetalhe',
            dataType: 'text',
            data: data,
            success: function(response){
                $('#tabulacaoDetalhe').html(response).show();
            },
            error:function(xhr, ajaxOptions, thrownError){
                $('#tabulacaoDetalhe').html(xhr.status+xhr.responseText)}
        });
      })
  
    $('#formDuracaoChamadas').on('submit',function(e){
        e.preventDefault();
        data = $('#formDuracaoChamadas').serialize();
        $.ajax({
            type: 'POST',
            url: 'relDuracaoChamadas/selecao',
            dataType: 'text',
            data: data,
            success: function(response){
                $('#duracaoChamadas').html(response).show();
            },
            error:function(xhr, ajaxOptions, thrownError){
                $('#duracaoChamadas').html(xhr.status+xhr.responseText)}
        });
    })
    $('#formRelPausas').on('submit',function(e){
        e.preventDefault();
        data = $('#formRelPausas').serialize();
        $.ajax({
            type: 'POST',
            url: 'relPausas/selecao',
            dataType: 'text',
            data: data,
            success: function(response){
                $('#pausasGrupo').html(response).show();
            },
            error:function(xhr, ajaxOptions, thrownError){
                $('#pausasGrupo').html(xhr.status+xhr.responseText)}
        });
    })

    $('#formNivelServico').on('submit',function(e){
        e.preventDefault();
        data = $('#formNivelServico').serialize();
        $('divdetalhe').css("font-size: 28;font-weight: bold;display:block;");   
        $.ajax({
            type: 'POST',
            url: 'relNivelServico/getNivelServico',
            dataType: 'text',
            data: data,
            success: function(response){
                $('#nivelServico').html(response).show();
            },
            error:function(xhr, ajaxOptions, thrownError){
                $('#nivelServico').html(xhr.status+xhr.responseText)}
        });
    })
    // $('#exportaNivel').on('click',function(e){
    //     e.preventDefault();
    //     data = $('#formNivelServico').serialize();
    //     $.ajax({
    //         type: 'POST',
    //         url: 'relNivelServico/getNivelServicoDetalhe',
    //         dataType: 'text',
    //         data: data,
    //         success: function(response){
    //             $('#nivelServico').html(response).show();
    //         },
    //         error:function(xhr, ajaxOptions, thrownError){
    //             $('#nivelServico').html(xhr.status+xhr.responseText)}
    //     });
    // })
      
  });

function setReportLig(obj) {
    data = $(obj).serialize();
    var vrtar = 0;
    var vrntar = 0;
    var vr = 0;
    $('.areaLigacoes').remove();
    $('.divarealig').append('<div id="areaLigacoes" class="container areaLigacoes"></div>');
    $('#areaLigacoes').html('<div id="processando"><h3> <img class="loadingGIF" src="assets/images/loading.gif"></h3></div>');
    $('.divarealig').append('<div class="divbtn areaLigacoes" ></div>');
    $('.divarealig').append('<div class="divbtn areaLigacoes" ><a href=#><img src="'+BASE_URL+'/assets/images/excel_icon_2003_32px.png" class="btlistagravacoes" '+
                                                        'title="Excel" onclick="openPopupLig(1)"></a>Excel</div>');
    $('.divarealig').append('<div class="divbtn areaLigacoes" ></div>');
//    $('.divarealig').append('<div class="divbtn" ><a href=#><img src="'+BASE_URL+'/assets/images/pdf.png" class="btlistagravacoes" '+
//                                                        'title="PDF" onclick="openPopupLig(2)"></a>PDF</div>');
    html =  '<div class="panel panel-primary areaLigacoes" style="float:right;margin-left:2px;width:45%;">'+
                    '<div class="panel-heading">TARIFADAS</div>'+
                '<table id="tblig2" class="table w-100">'+
                    '<tr class="lineLig">'+
                        '<th>STATUS</th>'+
                        '<th>LIGAÇÕES</th>'+
                        '<th>PERCENTUAL</th>'+
                    '</tr>'+
                '</table>'+
            '</div>'+
            '<div class="panel panel-primary w-50 areaLigacoes" style="float:right;">'+
                '<div class="panel-heading">NÃO TARIFADAS</div>'+
                '<table id="tblig1" class="table w-100">'+
                    '<tr class="lineLig">'+
                    '<th>STATUS</th>'+
                    '<th>LIGAÇÕES</th>'+
                    '<th>PERCENTUAL</th>'+
                    '</tr>'+
                '</table>'+
            '</div>';
    $('.divarealig').append(html);
    $.ajax({
        type:'POST',
        url:BASE_URL+'/relligacoes/relligacoessel',
        data:data,
        dataType:'json',
        success:function(json){
            if(json.rellig.length > 0) {
                for(var i in json.rellig) {
                    if (json.rellig[i].NUMERO==0) {
                        vrntar = vrntar + parseFloat(json.rellig[i].Total);
                    }
                    if (json.rellig[i].NUMERO==1) {
                        vrtar = vrtar + parseFloat(json.rellig[i].Total);
                    }
                }
                for(var i in json.rellig) {
                    if (json.rellig[i].NUMERO==0) {
                        vr = parseFloat(json.rellig[i].Total);
                        vr = vr/vrntar*100;
                    }
                    if (json.rellig[i].NUMERO==1) {
                        vr = parseFloat(json.rellig[i].Total);
                        vr = vr/vrtar*100;
                    }   
                    vr = vr.toPrecision(2);
                    html =  '<tr class="lineLig areaLigacoes">'+
                                '<td style="width:auto;">'+json.rellig[i].STF_DESC+'</td>'+
                                '<td style="width:auto;text-align:center">'+json.rellig[i].Total+'</td>'+
                                '<td style="width:auto;text-align:center">'+vr+'</td>'+
                            '</tr>';
                    if (json.rellig[i].NUMERO==0) {
                        $('#tblig1').append(html);
                    } else {
                        $('#tblig2').append(html);						
                    }
                }
                html =  '<tr class="lineLig areaLigacoes">'+
                            '<td style="width:auto;">TOTAL</td>'+
                            '<td style="width:auto;text-align:center">'+vrntar+'</td>'+
                            '<td style="width:auto;text-align:center">100</td>'+
                        '</tr>';
                $('#tblig1').append(html);
                html =  '<tr class="lineLig areaLigacoes">'+
                            '<td style="width:auto;">TOTAL</td>'+
                            '<td style="width:auto;text-align:center">'+vrtar+'</td>'+
                            '<td style="width:auto;text-align:center">100</td>'+
                        '</tr>';
                $('#tblig2').append(html);						
            }
        }
    })
    $('#processando').remove();
    return false;
}

function openPopupLig(v) {
    var url = BASE_URL+'/relligacoes/relligacoesDetalhe/'+v+'?'+data;
    window.open(url,"report","width=700,height=500");
}

// function openPopupTabulacoes(dti, dtf, grupo,camp, agente, ddd, tel) {
function openPopupTabulacoes() {
    var url = BASE_URL+'/relTabulacoes/tabulacoesExcel?'+data;
    window.open(url,"report","width=700,height=500");
}

function setReportResumo(obj) {
    var data = $(obj).serialize();
    var url = BASE_URL+'/relresumo/relresumosel?'+data;
    $('#relResumo').remove();
    $('#custosPrincipal').append('<div id="relResumo" ></div>');
    $('#divrelResumo').append('<div class="divbtn" ></div>');
    $('#divrelResumo').append('<div class="divbtn" ><a href=#><img src="'+BASE_URL+'/assets/images/excel_icon_2003_32px.png" class="btnreport" '+
                                'title="Excel" onclick="openPopupRes(1)"></a>Excel</div>');
//    $('#divrelResumo').append('<div class="divbtn" ><a href=#><img src="'+BASE_URL+'/assets/images/pdf.png" class="btnreport" '+
//                                'title="Excel" onclick="openPopupRes(2)"></a>PDF</div>');
    return false;
}

function openPopupRes(v) {
	if (v==1) {
		var url = BASE_URL+'/relresumo/relresumoExcel';
	}
	if (v==2) {
		var url = BASE_URL+'/relresumo/relresumoPDF';
	}
	window.open(url,"report","width=700,height=500");
}

function openPopupNivel() {
    var url = BASE_URL+'/relNivelServico/getNivelServicoDetalhe?'+data;
	window.open(url,"report","width=700,height=500");
}

function setReportCustos(obj) {
	var url = BASE_URL+'/relcustos/relcustossel?'+data;
	$('#divrelCustos').append('<div class="divbtn" ></div>');
	$('#divrelCustos').append('<div class="divbtn" ><a href=#><img src="'+BASE_URL+'/assets/images/excel_icon_2003_32px.png" class="btlistagravacoes" '+
			    		                    'title="Excel" onclick="openPopupCustos(1)"></a>Excel</div>');
	$('#divrelCustos').append('<div class="divbtn" ><a href=#><img src="'+BASE_URL+'/assets/images/pdf.png" class="btlistagravacoes" '+
			    		                    'title="Excel" onclick="openPopupCustos(2)"></a>PDF</div>');
	return false;
}

function openPopupCustos() {
    var url = BASE_URL+'/relcustos/relCustosExcel?'+data;
    window.open(url,"report","width=700,height=500");
}

function openPopupDesempnhoAgente() {
    var url = BASE_URL+'/relDesempenhoAgentes/desempenhoAgentesExcel?'+data;
    window.open(url,"report","width=700,height=500");
}

function openPopupPausasResumo() {
    var url = BASE_URL+'/relPausas/pausasResumo?'+data;
    window.open(url,"report","width=700,height=500");
}
function openPopupPausasDetalhe() {
    var url = BASE_URL+'/relPausas/pausasDetalhe?'+data;
    window.open(url,"report","width=700,height=500");
}
