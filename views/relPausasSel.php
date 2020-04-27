<div id="container" class="container w-100" style="position:relative;top:50px;float:rigth;text-align:center;z-index:0;">
    <a href="#" onclick="openPopupPausasDetalhe()">
        <img src="<?php echo BASE_URL; ?>/assets/images/excel_icon_2003_32px.png">
            Excel Detalhado
    </a>
    <a href="#" onclick="openPopupPausasResumo()">
        <img src="<?php echo BASE_URL; ?>/assets/images/excel_icon_2003_32px.png">
            Excel Resumido 
    </a>
<!-- <div class="PeriodoSel panel panel-primary" style="width: 2000px;"> -->
    <!-- <div class="panel-heading  text-center">Agentes Logados</div>
    <table id='tbAgentesLogados' style="text-align: center;font-size:12px;" class="table w-100" > -->
    <div class="panel panel-primary w-50" style="margin-left:450px" >
        <div class="panel-heading w-100">Pausas</div>
        <?php foreach ($pausas_grupo as $l): ?>
            <table id="tb1" class="table w-100">
            <thead>
                <tr class="cabecalho w-50" >
                    <td ><?php echo $l['nome']." - ".$l['cod_agente']; ?></td>
                </tr>
                <tr class="cabecalho" >
                    <td >Tipo pausa</td>
                    <td >Instante</td>
                    <td >Tempo</td>
                </tr>
            </thead>
            <?php $reg = $this->relPausasLista($dti,$dtf,$grupo,$l['cod_agente']); ?>
            <tbody>
                <?php foreach ($reg as $r): ?>
                  <?php foreach ($r as $v): ?>
                    <tr style="width: 500px;" >
                        <td ><?php echo utf8_encode($v['subcod_evento']); ?></td>
                        <td ><?php echo date('d/m/Y H:i:s',  strtotime($v['instante'])); ?></td>
                        <td ><?php echo $v['tempo']; ?></td>
                    </tr>
                <?php endforeach; ?> 
                <?php endforeach; ?> 
                <?php $reg = $this->relPausasTotal($dti,$dtf,$grupo,$l['cod_agente']); ?>
                <tr style="width: 500px;" >
                    <td >Total</td>
                    <td ></td>
                    <td ><?php echo $reg[0]; ?></td>
                </tr>
            </tbody>
            </table>
        <?php endforeach; ?>
    </div>
</div>
