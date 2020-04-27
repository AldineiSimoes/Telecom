<?php
include 'views/discador.php';
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<div id="discadores" class="container">
    <br>
    <br>
    <div class="row">
        <div class="col-lg-6">
            <div class="row">
                <div class="col-lg-8">
                    <form id="fuploading">
                        <h3> Discador </h3>
                        <select id="selUpload" name="selUpload" class="btn btn-default dropdown-toggle js-example-basic-multiple" style="width: 100%;" >
                            <option id="disc" value="0"> </option>
                                <?php foreach ($discadores_list as $l): ?>
                                    <option id="disc" value="<?php echo $l['ID_DISCADOR']; ?>">
                                       <?=$l['ID_GRUPO'];?> | <?php echo $l['CONF_DESC']; ?>
                                    </option>
                                <?php endforeach; ?>
                        </select>
                    </form>
                    <input id="voltardiscador" onclick="showDivDetalhar()" type="button" disabled="false" value="Rediscar" class="btn btn-primary w-50" />
                </div>
                <div class="col-lg-4">
                    <h3>Incluir fila</h3>
                    <form id="formFila" method="post" action="<?php echo BASE_URL; ?>/discador/regMailing" enctype="multipart/form-data">
                        <input type="hidden" name="layout" id="layout" value="">
                        <p>
                            <input type="file" disabled="false" value="" name="arquivo" id="arquivo" />
                        </p>
                        <input type="submit" value="Enviar" class="btn btn-primary" />
                    </form>
                </div>
            </div>
            <div class="row" id="divfila">

                <hr>              
            </div>
        </div>
        <div id="resumoDiscador" class="col-lg-6">
            <br/>
            <!-- <div class="PeriodoSel panel panel-primary" style="z-index:0;" id="resDisc">
            </div> -->
        </div>
        <div id="resumoLista" class="col-lg-6">
            <br/>
            <div class="PeriodoSel panel panel-primary" style="z-index:0;" id="resDisc">
                <!-- <div id="reslista" class="panel-heading w-100 text-center">Resultado da Lista</div> -->
            </div>
        </div>
    </div>
    <div id="listadiscadores">
    </div>        
    <script>$('#selDisc').change()</script>
</div>
<div id="idDetalhar" class="divDetalhar text-center">
    <img id="loadingGIF" class="loadingGIF"src="<?php echo BASE_URL ?>/assets/images/loading.gif" style="display:none;"/> <br/>
    <div style="font-size: 20px;" id="infoDetalhar" style="display: block;">
        <br><br><br><br><br><br>
        Tem certeza que deseja voltar a discar todo o Mailing?<br>
        <p style="font-size: 10px;">obs: Essa ação não volta a rediscar os atendimentos já realizados</p>
        <br><br>
        <button class="btn btn-info" onclick="voltaDiscarSTFIM(0,0,0)">SIM REDISCAR</button>
        <button class="btn btn-danger" Onclick="exitDivDetalhar()">CANCELAR</button>
        
    </div>
</div>
<div id="fade" class="black_overlay" onclick="exitDivDetalhar()"></div>

