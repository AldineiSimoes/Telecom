<div class="row detalheChartsCampanha panel panel-primary" id"detalhesCampanha">
    <div class='panel-heading w-100 text-center'>Detalhes da Campanha <a href="#" onclick="showDivDetalhar()"><img src="<?php echo BASE_URL; ?>/assets/images/plus.png" style="width:14px;height: 14px;"></a></div>
    <div class="row w-100" style="border-top:solid 1px #fff;height: 33px;margin: 0px;">
        <div class="col-md-2 text-center" style="border-right: solid 1px #ffff;height: 100%;background-color: #004b8b;">
            <h5 style="font-family:myFirstFont!important;color:#F0FFFF ">TM At:</h5>
        </div>
        <div class="col-md-2 text-center" style="border-right: solid 1px #fff;height: 100%;color:#000;background-color: #F08080;">
            <?php 
            if (!empty($detalhes_campanha)) {
               echo $detalhes_campanha[0]['TMA_ATENDIMENTO']; 
            }
            ?>
        </div>
        <div class="col-md-2" style="border-right: solid 1px #fff;height: 100%;background-color: #004b8b;">
            <h5 style="font-family:myFirstFont!important;color:#F0FFFF ">TM Livre:</h5>
        </div>
        <div class="col-md-2"style="border-right: solid 1px #fff;height: 100%;">
            <?php 
                if (!empty($detalhes_campanha)) {
                echo $detalhes_campanha[0]['max_livre']; 
                }
            ?>
        </div>
        <div class="col-md-2" style="border-right: solid 1px #fff;height: 100%;background-color: #004b8b;">
            <h5 style="font-family:myFirstFont!important;color:#F0FFFF ">TM Pausa:</h5>
        </div>
        <div class="col-md-2"style="height: 100%;">
            <?php 
                // if (!empty($detalhes_campanha)) {
                // echo $detalhes_campanha[0]['max_clerical']; 
                // }
            ?>
        </div>
    </div>
    <div class="row" style="border-top:solid 1px #fff;height: 34px;margin: 0px;">
        <div class="col-md-2" style="border-right: solid 1px #fff;height: 100%;background-color: #004b8b;">
            <h5 style="font-family:myFirstFont!important;color:#F0FFFF ">TM Tab:</h5>
        </div>
        <div class="col-md-2" style="border-right: solid 1px #fff;height: 100%;">
            <?php 
                if (!empty($detalhes_campanha)) {
                echo $detalhes_campanha[0]['max_clerical']; 
                }
            ?>
        </div>
        <div class="col-md-2" style="border-right: solid 1px #fff;height: 100%;background-color: #004b8b;">
            <h5 style="font-family:myFirstFont!important;color:#F0FFFF ">R Livres:</h5>
        </div>
        <div class="col-md-2"style="border-right: solid 1px #fff;height: 100%;">
            <?php 
                if (!empty($detalhes_campanha)) {
                echo $detalhes_campanha[0]['livres']; 
                }
            ?>
        </div>
        <div class="col-md-2" style="border-right: solid 1px #fff;height: 100%;background-color: #004b8b;">
            <h5 style="font-family:myFirstFont!important;color:#F0FFFF ">R Agenda:</h5>
        </div>
        <div class="col-md-2"style="height: 100%;">
            <?php 
                if (!empty($detalhes_campanha)) {
                echo $detalhes_campanha[0]['agendado']; 
                }
            ?>
        </div>

    </div>
    <div class="row" style="border-top:solid 1px #fff;height: 30px;margin: 0px;">
        <div class="col-md-2" style="border-right: solid 1px #fff;height: 100%;background-color: #004b8b;">
            <h5 style="font-family:myFirstFont!important;color:#F0FFFF ">Fin. Geral:</h5>
        </div>
        <div class="col-md-2" style="border-right: solid 1px #fff;height: 100%;">
            <?php 
                if (!empty($detalhes_campanha)) {
                echo $detalhes_campanha[0]['finalizado']; 
                }
            ?>
        </div>
        <div class="col-md-2" style="border-right: solid 1px #fff;height: 100%;background-color: #004b8b;">
            <h5 style="font-family:myFirstFont!important;color:#F0FFFF ">Fin.Tent.:</h5>
        </div>
        <div class="col-md-2"style="border-right: solid 1px #fff;height: 100%;">
            <?php 
                if (!empty($detalhes_campanha)) {
                echo $detalhes_campanha[0]['finalizado_tentativa']; 
                }
            ?>
        </div>
        <div class="col-md-2" style="border-right: solid 1px #fff;height: 100%;background-color: #004b8b;">
            <h5 style="font-family:myFirstFont!important;color:#F0FFFF ">CPC:</h5>
        </div>
        <div class="col-md-2"style="height: 100%;">
            <?php 
                if (!empty($detalhes_campanha)) {
                echo $detalhes_campanha[0]['CPC']; 
                }
            ?>
        </div>
    </div>
</div>
<?php
//   print_r($detalhes_grupo);echo '<br><br>';
//   print_r($detalhes_agente);exit;
?>
<div class='row detalheChartsGrupo panel panel-primary'>
    <div class='panel-heading w-100 text-center'>Detalhes do Grupo <a href="#" onclick="showDivDetalhar()"><img src="<?php echo BASE_URL; ?>/assets/images/plus.png" style="width:14px;height: 14px;"></a></div>
    <div class="row w-100" style="border-top:solid 1px #fff;height: 33px;margin: 0px;">
        <div class="col-md-2 text-center" style="border-right: solid 1px #fff;height: 100%;background-color: #004b8b;">
            <h5 style="font-family:myFirstFont!important;color:#F0FFFF ">TM At:</h5>
        </div>
        <div class="col-md-2" style="border-right: solid 1px #fff;height: 100%;">
        <?php 
            if (!empty($detalhes_grupo)) {
               echo $detalhes_grupo[0]['TMA_ATENDIMENTO']; 
            }
            ?>
        </div>
        <div class="col-md-2" style="border-right: solid 1px #fff;height: 100%;background-color: #004b8b;">
            <h5 style="font-family:myFirstFont!important;color:#F0FFFF ">TM Livre:</h5>
        </div>
        <div class="col-md-2"style="border-right: solid 1px #fff;height: 100%;">
            <?php 
                if (!empty($detalhes_grupo)) {
                echo $detalhes_grupo[0]['max_livre']; 
                }
            ?>
        </div>
        <div class="col-md-2" style="border-right: solid 1px #fff;height: 100%;background-color: #004b8b;">
            <h5 style="font-family:myFirstFont!important;color:#F0FFFF ">TM Pausa:</h5>
        </div>
        <div class="col-md-2"style="height: 100%;">
            <?php 
                // if (!empty($detalhes_grupo)) {
                // echo $detalhes_grupo[0]['max_livre']; 
                // }
            ?>
        </div>
    </div>
    <div class="row" style="border-top:solid 1px #fff;height: 34px;margin: 0px;">
        <div class="col-md-2" style="border-right: solid 1px #fff;height: 100%;background-color: #004b8b;">
            <h5 style="font-family:myFirstFont!important;color:#F0FFFF ">TM Tab:</h5>
        </div>
        <div class="col-md-2" style="border-right: solid 1px #fff;height: 100%;">
            <?php 
                if (!empty($detalhes_grupo)) {
                echo $detalhes_grupo[0]['max_clerical']; 
                }
            ?>
        </div>
        <div class="col-md-2" style="border-right: solid 1px #fff;height: 100%;background-color: #004b8b;">
            <h5 style="font-family:myFirstFont!important;color:#F0FFFF ">R Livres:</h5>
        </div>
        <div class="col-md-2"style="border-right: solid 1px #fff;height: 100%;">
            <?php 
                if (!empty($detalhes_grupo)) {
                echo $detalhes_grupo[0]['livres']; 
                }
            ?>

        </div>
        <div class="col-md-2" style="border-right: solid 1px #fff;height: 100%;background-color: #004b8b;">
            <h5 style="font-family:myFirstFont!important;color:#F0FFFF ">R Agenda:</h5>
        </div>
        <div class="col-md-2"style="height: 100%;">
            <?php 
                if (!empty($detalhes_grupo)) {
                echo $detalhes_grupo[0]['agendado']; 
                }
            ?>
        </div>

    </div>
    <div class="row" style="border-top:solid 1px #fff;height: 30px;margin: 0px;">
        <div class="col-md-2" style="border-right: solid 1px #fff;height: 100%;background-color: #004b8b;">
            <h5 style="font-family:myFirstFont!important;color:#F0FFFF ">Fin. Geral:</h5>
        </div>
        <div class="col-md-2" style="border-right: solid 1px #fff;height: 100%;">
            <?php 
                if (!empty($detalhes_grupo)) {
                echo $detalhes_grupo[0]['finalizado']; 
                }
            ?>
        </div>
        <div class="col-md-2" style="border-right: solid 1px #fff;height: 100%;background-color: #004b8b;">
            <h5 style="font-family:myFirstFont!important;color:#F0FFFF ">TM Tab:</h5>
        </div>
        <div class="col-md-2"style="border-right: solid 1px #fff;height: 100%;">
            <?php 
                if (!empty($detalhes_grupo)) {
                echo $detalhes_grupo[0]['max_livre']; 
                }
            ?>
        </div>
        <div class="col-md-2" style="border-right: solid 1px #fff;height: 100%;background-color: #004b8b;">
            <h5 style="font-family:myFirstFont!important;color:#F0FFFF ">TM Tab:</h5>
        </div>
        <div class="col-md-2"style="height: 100%;">
            <?php 
                if (!empty($detalhes_grupo)) {
                echo $detalhes_grupo[0]['max_livre']; 
                }
            ?>
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
            <?php 
                if (!empty($detalhes_agente)) {
                echo $detalhes_agente[0]['TMA_ATENDIMENTO']; 
                }
            ?>
        </div>
        <div class="col-md-2" style="border-right: solid 1px #fff;height: 100%;background-color: #004b8b;">
            <h5 style="font-family:myFirstFont!important;color:#F0FFFF ">TM Livre:</h5>
        </div>
        <div class="col-md-2"style="border-right: solid 1px #fff;height: 100%;">
            <?php 
                if (!empty($detalhes_agente)) {
                echo $detalhes_agente[0]['max_livre']; 
                }
            ?>
        </div>
        <div class="col-md-2" style="border-right: solid 1px #fff;height: 100%;background-color: #004b8b;">
            <h5 style="font-family:myFirstFont!important;color:#F0FFFF ">TM Pausa:</h5>
        </div>
        <div class="col-md-2"style="height: 100%;">
            <?php 
                // if (!empty($detalhes_agente)) {
                // echo $detalhes_agente[0]['max_livre']; 
                // }
            ?>
        </div>
    </div>
    <div class="row" style="border-top:solid 1px #fff;height: 34px;margin: 0px;">
        <div class="col-md-2" style="border-right: solid 1px #fff;height: 100%;background-color: #004b8b;">
            <h5 style="font-family:myFirstFont!important;color:#F0FFFF ">TM Tab:</h5>
        </div>
        <div class="col-md-2" style="border-right: solid 1px #fff;height: 100%;">
            <?php 
                if (!empty($detalhes_agente)) {
                echo $detalhes_agente[0]['max_clerical']; 
                }
            ?>
        </div>
        <div class="col-md-2" style="border-right: solid 1px #fff;height: 100%;background-color: #004b8b;">
            <h5 style="font-family:myFirstFont!important;color:#F0FFFF ">R Livres:</h5>
        </div>
        <div class="col-md-2"style="border-right: solid 1px #fff;height: 100%;">
            <?php 
                if (!empty($detalhes_agente)) {
                echo $detalhes_agente[0]['livres']; 
                }
            ?>
        </div>
        <div class="col-md-2" style="border-right: solid 1px #fff;height: 100%;background-color: #004b8b;">
            <h5 style="font-family:myFirstFont!important;color:#F0FFFF ">R Agenda:</h5>
        </div>
        <div class="col-md-2"style="height: 100%;">
            <?php 
                if (!empty($detalhes_agente)) {
                echo $detalhes_agente[0]['agendado']; 
                }
            ?>
        </div>

    </div>
    <div class="row" style="border-top:solid 1px #fff;height: 30px;margin: 0px;">
        <div class="col-md-2" style="border-right: solid 1px #fff;height: 100%;background-color: #004b8b;">
            <h5 style="font-family:myFirstFont!important;color:#F0FFFF ">Fin. Geral:</h5>
        </div>
        <div class="col-md-2" style="border-right: solid 1px #fff;height: 100%;">
            <?php 
                if (!empty($detalhes_agente)) {
                echo $detalhes_agente[0]['finalizado']; 
                }
            ?>
        </div>
        <div class="col-md-2" style="border-right: solid 1px #fff;height: 100%;background-color: #004b8b;">
            <h5 style="font-family:myFirstFont!important;color:#F0FFFF ">At.:</h5>
        </div>
        <div class="col-md-2"style="border-right: solid 1px #fff;height: 100%;">
            <?php 
                if (!empty($detalhes_agente)) {
                echo $detalhes_agente[0]['ALO']; 
                }
            ?>
        </div>
        <div class="col-md-2" style="border-right: solid 1px #fff;height: 100%;background-color: #004b8b;">
            <h5 style="font-family:myFirstFont!important;color:#F0FFFF ">CPC:</h5>
        </div>
        <div class="col-md-2"style="height: 100%;">
            <?php 
                if (!empty($detalhes_agente)) {
                echo $detalhes_agente[0]['CPC']; 
                }
            ?>
        </div>

    </div>
</div>
