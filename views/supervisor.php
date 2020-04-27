<link rel='stylesheet' href='<?php echo BASE_URL; ?>/assets/css/operadoras.css'>
<link rel='stylesheet' href='<?php echo BASE_URL; ?>/assets/css/supervisor.css'>



<div id="divsuptop">
    <div class="row">
        <div class="divform col-md-3">
            <form method="POST" id="formcamp" data-type="listMonitor" >
                Selecione a campanha: <label for="group"><?php echo $idgroup . $groupName ?></label>
                <select name="supcamp" id="supcamp" class="form-control" required>
                    <option id="opcamp-1" value="-1" ></option>
                    <option id="opcamp0" value="0" >Todos</option>
                    <?php foreach ($campanha_list as $l): ?>
                        <option id="opcamp<?php echo $l['ID_CAMPANHA']; ?>" value="<?php echo $l['ID_CAMPANHA']; ?>" <?php ($l['ID_CAMPANHA'] == $idcamp) ? 'selected="selected"' : ''; ?>>
                            <?php echo $l['ID_CAMPANHA'] . ' - ' . $l['CAMP_DESC']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>

            </form>

            <!--<form method="POST" id="formgr" data-type="listMonitor" >
                 Selecione o grupo para visualização: <label for="group">GRUPO MONITORADO - <?php echo $idgroup . ' - ' . $groupName ?></label><br>
                 <select name="group" id="group" class="form-control" required>
                     <option id="opgr" value="0" />
                     TODOS
                     </option>
                 </select>
             </form>-->
        </div>

        <div class="filtroAgente ">
            <form id="" class="formagente">
                Digite o nome do Agente para localiza-lo:
                <input class="nomeagente">
                <input class="buttonSelecionar" type="submit" value="TODOS">
            </form>
        </div>
        <div class="col-md-3 divr" id="optionAgente">
            <input id="idagentesup" type="hidden" value="0">
            <div class="row">
                <a title='Escutar' href='#'>
                    <div class="col-md-2 optionag" data-toggle="tooltip" data-placement="bottom" title="Monitorar">
                        <img class="optionOP" id="escuta1" src="<?php echo BASE_URL; ?>/assets/images/monitorar.png">
                    </div>
                </a>
                <a title='Mudar Grupo' href='#' onclick="grupoAgente('0')">
                    <div class="col-md-2 optionag" data-toggle="tooltip" data-placement="bottom" title="Mudar Grupo">
                        <img class="optionOP" src="<?php echo BASE_URL; ?>/assets/images/switching-user.png">
                    </div>
                </a>
                <a title='Pausar' href='#'>
                    <div class="col-md-2 optionag" data-toggle="tooltip" data-placement="bottom" title="Pausar">
                        <img id="despausar" class="optionOP" src="<?php echo BASE_URL; ?>/assets/images/play3.png">
                    </div>
                </a>
                <a title='Encerrar' href='#'>
                    <div class="col-md-2 optionag" data-toggle="tooltip" data-placement="bottom" title="Encerrar">
                        <img class="optionOP" id="Encerrar" src="<?php echo BASE_URL; ?>/assets/images/logout.png">
                    </div>
                </a>

            </div>
            <br>
            <input id="agenteRamal" type="hidden" value="0">
            <div class="row" id="agenteSel">
            </div>
        </div>

        <br/>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <br/>
        <br/>
        <br/><br/>
        <br/>




        <div id="listaCGA" class="col-md-12 agentesbarra">
            <div id="box-toggle">
                <div class="tgl">

                </div>

                <div class="tgl">

                </div>

                <div class="tgl">

                </div>
            </div>

        </div>
        <br/>
<!--        <div id="detalhesCharts" class="col-md-5">
            <div class="row detalheChartsCampanha panel panel-primary" id"detalhesCampanha">
                <div class='panel-heading w-100 text-center'>Detalhes da Campanha <a href="#" onclick="showDivDetalhar()"><img src="<?php echo BASE_URL; ?>/assets/images/plus.png" style="width:14px;height: 14px;"></a></div>
                <div class="row w-100" style="border-top:solid 1px #fff;height: 33px;margin: 0px;">
                    <div class="col-md-2 text-center" style="border-right: solid 1px #ffff;height: 100%;background-color: #004b8b;">
                        <h5 style="font-family:myFirstFont!important;color:#F0FFFF ">TM At:</h5>
                    </div>
                    <div class="col-md-2 text-center" style="border-right: solid 1px #fff;height: 100%;color:#000;background-color: #F08080;">
                        00:05:35
                    </div>
                    <div class="col-md-2" style="border-right: solid 1px #fff;height: 100%;background-color: #004b8b;">
                        <h5 style="font-family:myFirstFont!important;color:#F0FFFF ">TM Livre:</h5>
                    </div>
                    <div class="col-md-2"style="border-right: solid 1px #fff;height: 100%;">

                    </div>
                    <div class="col-md-2" style="border-right: solid 1px #fff;height: 100%;background-color: #004b8b;">
                        <h5 style="font-family:myFirstFont!important;color:#F0FFFF ">TM Pausa:</h5>
                    </div>
                    <div class="col-md-2"style="height: 100%;">

                    </div>
                </div>
                <div class="row" style="border-top:solid 1px #fff;height: 34px;margin: 0px;">
                    <div class="col-md-2" style="border-right: solid 1px #fff;height: 100%;background-color: #004b8b;">
                        <h5 style="font-family:myFirstFont!important;color:#F0FFFF ">TM Tab:</h5>
                    </div>
                    <div class="col-md-2" style="border-right: solid 1px #fff;height: 100%;">

                    </div>
                    <div class="col-md-2" style="border-right: solid 1px #fff;height: 100%;background-color: #004b8b;">
                        <h5 style="font-family:myFirstFont!important;color:#F0FFFF ">R Livres:</h5>
                    </div>
                    <div class="col-md-2"style="border-right: solid 1px #fff;height: 100%;">

                    </div>
                    <div class="col-md-2" style="border-right: solid 1px #fff;height: 100%;background-color: #004b8b;">
                        <h5 style="font-family:myFirstFont!important;color:#F0FFFF ">R Agenda:</h5>
                    </div>
                    <div class="col-md-2"style="height: 100%;">

                    </div>

                </div>
                <div class="row" style="border-top:solid 1px #fff;height: 30px;margin: 0px;">
                    <div class="col-md-2" style="border-right: solid 1px #fff;height: 100%;background-color: #004b8b;">
                        <h5 style="font-family:myFirstFont!important;color:#F0FFFF ">Fin. Geral:</h5>
                    </div>
                    <div class="col-md-2" style="border-right: solid 1px #fff;height: 100%;">

                    </div>
                    <div class="col-md-2" style="border-right: solid 1px #fff;height: 100%;background-color: #004b8b;">
                        <h5 style="font-family:myFirstFont!important;color:#F0FFFF ">TM Tab:</h5>
                    </div>
                    <div class="col-md-2"style="border-right: solid 1px #fff;height: 100%;">

                    </div>
                    <div class="col-md-2" style="border-right: solid 1px #fff;height: 100%;background-color: #004b8b;">
                        <h5 style="font-family:myFirstFont!important;color:#F0FFFF ">TM Tab:</h5>
                    </div>
                    <div class="col-md-2"style="height: 100%;">

                    </div>

                </div>
            </div>

            <div class='row detalheChartsGrupo panel panel-primary'>
                <div class='panel-heading w-100 text-center'>Detalhes do Grupo <a href="#" onclick="showDivDetalhar()"><img src="<?php echo BASE_URL; ?>/assets/images/plus.png" style="width:14px;height: 14px;"></a></div>
                <div class="row w-100" style="border-top:solid 1px #fff;height: 33px;margin: 0px;">
                    <div class="col-md-2 text-center" style="border-right: solid 1px #fff;height: 100%;background-color: #004b8b;">
                        <h5 style="font-family:myFirstFont!important;color:#F0FFFF ">TM At:</h5>
                    </div>
                    <div class="col-md-2" style="border-right: solid 1px #fff;height: 100%;">

                    </div>
                    <div class="col-md-2" style="border-right: solid 1px #fff;height: 100%;background-color: #004b8b;">
                        <h5 style="font-family:myFirstFont!important;color:#F0FFFF ">TM Livre:</h5>
                    </div>
                    <div class="col-md-2"style="border-right: solid 1px #fff;height: 100%;">

                    </div>
                    <div class="col-md-2" style="border-right: solid 1px #fff;height: 100%;background-color: #004b8b;">
                        <h5 style="font-family:myFirstFont!important;color:#F0FFFF ">TM Pausa:</h5>
                    </div>
                    <div class="col-md-2"style="height: 100%;">

                    </div>
                </div>
                <div class="row" style="border-top:solid 1px #fff;height: 34px;margin: 0px;">
                    <div class="col-md-2" style="border-right: solid 1px #fff;height: 100%;background-color: #004b8b;">
                        <h5 style="font-family:myFirstFont!important;color:#F0FFFF ">TM Tab:</h5>
                    </div>
                    <div class="col-md-2" style="border-right: solid 1px #fff;height: 100%;">

                    </div>
                    <div class="col-md-2" style="border-right: solid 1px #fff;height: 100%;background-color: #004b8b;">
                        <h5 style="font-family:myFirstFont!important;color:#F0FFFF ">R Livres:</h5>
                    </div>
                    <div class="col-md-2"style="border-right: solid 1px #fff;height: 100%;">

                    </div>
                    <div class="col-md-2" style="border-right: solid 1px #fff;height: 100%;background-color: #004b8b;">
                        <h5 style="font-family:myFirstFont!important;color:#F0FFFF ">R Agenda:</h5>
                    </div>
                    <div class="col-md-2"style="height: 100%;">

                    </div>

                </div>
                <div class="row" style="border-top:solid 1px #fff;height: 30px;margin: 0px;">
                    <div class="col-md-2" style="border-right: solid 1px #fff;height: 100%;background-color: #004b8b;">
                        <h5 style="font-family:myFirstFont!important;color:#F0FFFF ">Fin. Geral:</h5>
                    </div>
                    <div class="col-md-2" style="border-right: solid 1px #fff;height: 100%;">

                    </div>
                    <div class="col-md-2" style="border-right: solid 1px #fff;height: 100%;background-color: #004b8b;">
                        <h5 style="font-family:myFirstFont!important;color:#F0FFFF ">TM Tab:</h5>
                    </div>
                    <div class="col-md-2"style="border-right: solid 1px #fff;height: 100%;">

                    </div>
                    <div class="col-md-2" style="border-right: solid 1px #fff;height: 100%;background-color: #004b8b;">
                        <h5 style="font-family:myFirstFont!important;color:#F0FFFF ">TM Tab:</h5>
                    </div>
                    <div class="col-md-2"style="height: 100%;">

                    </div>

                </div>
            </div>

            <div class='row detalheChartsOperador panel panel-primary'>
                <div class='panel-heading w-100 text-center'>Detalhes do Agente <a href="#" onclick="showDivDetalhar()"><img src="<?php echo BASE_URL; ?>/assets/images/plus.png" style="width:14px;height: 14px;"></a></div>
                <div class="row w-100" style="border-top:solid 1px #fff;height: 33px;margin: 0px;">
                    <div class="col-md-2 text-center" style="border-right: solid 1px #fff;height: 100%;background-color: #004b8b;">
                        <h5 style="font-family:myFirstFont!important;color:#F0FFFF ">TM At:</h5>
                    </div>
                    <div class="col-md-2" style="border-right: solid 1px #fff;height: 100%;">

                    </div>
                    <div class="col-md-2" style="border-right: solid 1px #fff;height: 100%;background-color: #004b8b;">
                        <h5 style="font-family:myFirstFont!important;color:#F0FFFF ">TM Livre:</h5>
                    </div>
                    <div class="col-md-2"style="border-right: solid 1px #fff;height: 100%;">

                    </div>
                    <div class="col-md-2" style="border-right: solid 1px #fff;height: 100%;background-color: #004b8b;">
                        <h5 style="font-family:myFirstFont!important;color:#F0FFFF ">TM Pausa:</h5>
                    </div>
                    <div class="col-md-2"style="height: 100%;">

                    </div>
                </div>
                <div class="row" style="border-top:solid 1px #fff;height: 34px;margin: 0px;">
                    <div class="col-md-2" style="border-right: solid 1px #fff;height: 100%;background-color: #004b8b;">
                        <h5 style="font-family:myFirstFont!important;color:#F0FFFF ">TM Tab:</h5>
                    </div>
                    <div class="col-md-2" style="border-right: solid 1px #fff;height: 100%;">

                    </div>
                    <div class="col-md-2" style="border-right: solid 1px #fff;height: 100%;background-color: #004b8b;">
                        <h5 style="font-family:myFirstFont!important;color:#F0FFFF ">R Livres:</h5>
                    </div>
                    <div class="col-md-2"style="border-right: solid 1px #fff;height: 100%;">

                    </div>
                    <div class="col-md-2" style="border-right: solid 1px #fff;height: 100%;background-color: #004b8b;">
                        <h5 style="font-family:myFirstFont!important;color:#F0FFFF ">R Agenda:</h5>
                    </div>
                    <div class="col-md-2"style="height: 100%;">

                    </div>

                </div>
                <div class="row" style="border-top:solid 1px #fff;height: 30px;margin: 0px;">
                    <div class="col-md-2" style="border-right: solid 1px #fff;height: 100%;background-color: #004b8b;">
                        <h5 style="font-family:myFirstFont!important;color:#F0FFFF ">Fin. Geral:</h5>
                    </div>
                    <div class="col-md-2" style="border-right: solid 1px #fff;height: 100%;">

                    </div>
                    <div class="col-md-2" style="border-right: solid 1px #fff;height: 100%;background-color: #004b8b;">
                        <h5 style="font-family:myFirstFont!important;color:#F0FFFF ">TM Tab:</h5>
                    </div>
                    <div class="col-md-2"style="border-right: solid 1px #fff;height: 100%;">

                    </div>
                    <div class="col-md-2" style="border-right: solid 1px #fff;height: 100%;background-color: #004b8b;">
                        <h5 style="font-family:myFirstFont!important;color:#F0FFFF ">TM Tab:</h5>
                    </div>
                    <div class="col-md-2"style="height: 100%;">

                    </div>

                </div>
            </div>

        </div>-->
    </div>
</div>

<div id="idDetalhar" class="divDetalhar">
    <img class="loadingGIF"src="<?php echo BASE_URL ?>/assets/images/loading.gif" /> <br/>
    <!--<a href="#" onclick="exitDivDetalhar()">Sair</a>-->
</div>
<div id="fade" class="black_overlay" onclick="exitDivDetalhar()"></div>


<!-- <script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/Chart.min.js"></script> -->
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/supervisor.js"></script>
<!-- <script>    listaCampnhas(); </script> -->
<!-- <script type="text/javascript">
    jQuery.fn.toggleText = function (a, b) {
        return   this.html(this.html().replace(new RegExp("(" + a + "|" + b + ")"), function (x) {
            return(x == a) ? b : a;
        }));
    }

    $(document).ready(function () {
        $('.tgl').before('<span>+</span>');
        $('.tgl').css('display', 'none')
        $('span', '#box-toggle').click(function () {
            $(this).next().slideToggle('slow')
                    .siblings('.tgl:visible').slideToggle('fast');

            $(this).toggleText('+', '-')
                    .siblings('span').next('.tgl:visible').prev()
                    .toggleText('+', '-')
        });
    })
</script> -->
