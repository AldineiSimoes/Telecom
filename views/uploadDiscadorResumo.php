<br/>
<div class="PeriodoSel panel panel-primary" style="z-index:0;">
    <div class="panel-heading w-100 text-center">Status Geral do Discador</div>
    <table  class="table">
        <tr class="cabecalho">
            <td>Livres</td>
            <td>Finalizados</td>
            <td>Em Uso</td>
            <td>Agendado</td>
            <td >Total</td>
        </tr>
        <?php foreach ($mailing_status as $l): ?>
            <tr class="cabecalho">
                <?php $total = $l['livres'] + $l['finalizado'] + $l['emuso'] + $l['agendado']; ?>
                <td><?php echo $l['livres']; ?></td>
                <td><?php echo $l['finalizado']; ?></td>
                <td><?php echo $l['emuso']; ?></td>
                <td><?php echo $l['agendado']; ?></td>
                <td><?php echo $total; ?></td>
            </tr>        
        <?php endforeach; ?>

    </table>
</div>
<!-- <div class="PeriodoSel panel panel-primary" style="z-index:0;" id="resDisc">
    <div id="reslista" class="panel-heading w-100 text-center">Resultado da Lista</div>
</div> -->
