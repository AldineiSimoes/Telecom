<!-- <div id="reslista" class="panel-heading w-100 text-center">Resultado da Lista</div> -->
<div class="PeriodoSel panel panel-primary" style="z-index:0;" id="resDisc">
    <div id="reslista" class="panel-heading w-100 text-center">Resultado da Lista</div>
</div>
<table  class="table">
    <tr class="cabecalho">
        <td>Status</td>
        <td>Qtd</td>
        <td>Ação</td>
    </tr>
    <?php foreach ($mailing_total as $l): ?>
        <tr class="cabecalho" id="<?php echo $l['codfinalizacao'];?>">
            <td><?php echo $l['finalizacao']; ?></td>
            <td><?php echo $l['registros']; ?></td>
            <td><button href="::javascript" class="buttonStyle" onclick="voltaDiscarSTFIM(<?php echo $l['codfinalizacao'] .','.$l['grupo'].','.$l['ID_discador']?>)" title="Voltar a Discar">
            <?php if ($l['codfinalizacao']<>'20' && $l['codfinalizacao']<>'203') {?>
            <img src="<?php echo BASE_URL; ?>/assets/images/return.png" style="width:20px;height:20px;">
            <?php } ?>
            </button></td>
        </tr>        
    <?php endforeach; ?>
</table>
