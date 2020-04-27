
<a href="#" onclick="openPopupDesempnhoAgente()">
            <img src="<?php echo BASE_URL; ?>/assets/images/excel_icon_2003_32px.png">
                Excel
        </a>
<div class="PeriodoSel panel panel-primary" style="width: 2000px;">
                <div class="panel-heading  text-center">Desenpenho dos Agentes</div>
		<table id='tbDesempenhoAgente' style="text-align: center;font-size:12px;" class="table w-150" >
			<thead>
			<tr class="cabecalho" >
				<td >DATA</td>
				<td >NOME</td>
				<td >PRIMEIRO AT.</td>
				<td >ULTIMO AT</td>
				<td >LOGIN</td>
				<td >LOGOUT</td>
				<td >TEMPO LOGADO</td>
				<td >TOTAL ATENDIDAS</td>
				<td >TOTAL RECEPTIVO</td>
				<td >TOTAL ATIVO MANUAL</td>
				<td >ATENDIDAS ATIVO DISCADOR</td>
				<td >TEMPO FALADO</td>
				<td >TEMPO CLERICAL</td>
				<td >TOTAL PAUSAS</td>
				<td >TEMPO PAUSAS</td>
				<td >TEMPO DISPONIVEL</td>
				<td >TMA</td>
				<td >TME</td>
			

			</tr>
			</thead>
			<tbody>
    <?php

//        if($rs==false){
//            echo "<script>alert(Sem registro para o periodo!)</script>";
//            exit();
//        }else
    ?>
    <?php foreach ($desempenho_list as $l): ?>
        <tr style="width: 500px;" >
            <td ><?php echo $l['dia']; ?></td>
            <td ><?php echo $l['nome']; ?></td>
            <td ><?php echo $l['primeiroatt']; ?></td>
            <td ><?php echo $l['ultimoatt']; ?></td>
            <td ><?php echo $l['logon']; ?></td>
            <td ><?php echo $l['logout']; ?></td>
            <td ><?php echo $l['tplogado']; ?></td>
            <td ><?php echo $l['atendidas']; ?></td>
            <td ><?php echo $l['QtdAtendidasReceptivo']; ?></td>
            <td ><?php echo $l['QtdAtendidasAtivomanual']; ?></td>
            <td ><?php echo $l['QtdAtendidasAtivoDiscador']; ?></td>
            <td ><?php echo $l['falado']; ?></td>
            <td ><?php echo $l['tempo_clerical']; ?></td>
            <td ><?php echo $l['qtdpausas']; ?></td>
            <td ><?php echo $l['tempopausas']; ?></td>
            <td ><?php echo $l['livre']; ?></td>
            <td ><?php echo $l['TMA']; ?></td>
            <td ><?php echo $l['TME']; ?></td>
    </tr>
    <?php endforeach; ?>
    <tr  style="width: 400px;" >
        <td >Total</td>
    </tr>

				
				
            </tbody>
    </table>
</div>
