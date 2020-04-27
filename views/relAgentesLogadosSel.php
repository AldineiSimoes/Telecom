<div id="container" class="container w-100" style="position:relative;top:50px;float:rigth;text-align:center;z-index:0;">
<!-- <div class="PeriodoSel panel panel-primary" style="width: 2000px;"> -->
    <!-- <div class="panel-heading  text-center">Agentes Logados</div>
    <table id='tbAgentesLogados' style="text-align: center;font-size:12px;" class="table w-100" > -->
    <div class="panel panel-primary w-50" style="margin-left:450px" >
        <div class="panel-heading w-100">AGENTES LOGADOS</div>
        <table id="tb1" class="table w-100">
        <thead>
			<tr class="cabecalho" >
				<td >DATA</td>
				<td >HORA</td>
				<td >LOGADOS</td>
			</tr>
        </thead>
        <tbody>
            <?php foreach ($agentes_logados as $l): ?>
                <tr style="width: 500px;" >
                    <td ><?php echo $l['data']; ?></td>
                    <td ><?php echo $l['hora']; ?></td>
                    <td ><?php echo $l['logados']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
